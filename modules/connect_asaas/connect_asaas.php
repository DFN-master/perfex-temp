<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Connect Asaas e Asaas NFSe
Description: Integração com Sistema Financeiro Asaas com a função de recebimento via cartão de crédito, Boleto e Pi, emissão de notas fiscais e admnistração de assinaturas.
Author: Nando Cardoso - Connect Designers
Author URI: https://connectdesigners.com.br
Version: 1.4.3
Requires at least: 2.9.*
*/


define('CONNECT_ASAAS_MODULE_NAME', 'connect_asaas');

hooks()->add_action('before_render_payment_gateway_settings', 'asaas_before_render_payment_gateway_settings');
hooks()->add_action('app_admin_footer', 'asaas_settings_tab_footer');
hooks()->add_action('after_invoice_added', 'asaas_after_invoice_added');
hooks()->add_action('invoice_updated', 'asaas_after_invoice_updated');
hooks()->add_action('before_invoice_deleted', 'asaas_before_invoice_deleted');
hooks()->add_filter('module_connect_asaas_action_links', 'module_connect_asaas_action_links');
hooks()->add_action('after_payment_added', 'asaas_invoice_after_payment_added');
hooks()->add_action('admin_init', 'asaas_invoice_init_menu_items');
hooks()->add_action('app_admin_footer', 'asaas_invoice_admin_js');
hooks()->add_action('admin_init', 'asaas_invoice_add_settings_tab');
hooks()->add_action('after_invoice_view_as_client_link', 'asaas_invoice_after_invoice_view_as_client_link');

$CI = &get_instance();

/*
 * Loads the module function helper
 */
$CI->load->helper(CONNECT_ASAAS_MODULE_NAME . '/connect_asaas');

// Registradores
register_activation_hook(CONNECT_ASAAS_MODULE_NAME, 'asaas_module_activation_hook');
register_language_files(CONNECT_ASAAS_MODULE_NAME, [CONNECT_ASAAS_MODULE_NAME]);

function asaas_module_activation_hook()
{

    $CI = &get_instance();

    $mediaPath = FCPATH . $CI->app->get_media_folder() . '/' . CONNECT_ASAAS_MODULE_NAME;

    if (!file_exists($mediaPath)) {
        mkdir($mediaPath, 0755, true);
        fopen(rtrim($mediaPath, '/') . '/' . 'index.html', 'w');
    }

    require_once(__DIR__ . '/install.php');

    $CI->load->library('connect_asaas/asaas_gateway');
    $CI->load->library('connect_asaas/invoice');
    $CI->load->library("connect_asaas/base_api");
    $CI->load->model('invoices_model');
    $CI->load->model('clients_model');
    $api_key  = $CI->base_api->getApiKey();
    $base_url = $CI->base_api->getUrlBase();

    $municipal_services = $CI->invoice->services($api_key, $base_url);

    $municipal_services = json_decode($municipal_services, true);

    $asaas_invoice_services = $CI->db->get(db_prefix() . 'asaas_invoice_services')->num_rows();

    if ($asaas_invoice_services == 0) {

        foreach ($municipal_services["data"] as $row) {
            $data = [
                'service_id' => $row["id"],
                'description' => $row["description"],
                'issTax' => $row["issTax"]
            ];

            $CI->db->insert(db_prefix() . 'asaas_invoice_services', $data);
        }
    }
}

function module_connect_asaas_action_links($actions)
{
    $actions[] = '<a href="' .  admin_url("settings?group=payment_gateways#online_payments_asaas_tab")  . '">Config. Connect Asaas</a>';
    $actions[] = '<a href="' .  admin_url("settings?group=asaas-nf-settings")  . '">Config. Nota Fiscal</a>';
    $actions[] = '<a href="' .  admin_url("connect_asaas/configuracoes")  . '">Config. Adicional</a>';
    return $actions;
}

register_payment_gateway('asaas_gateway', CONNECT_ASAAS_MODULE_NAME);

function asaas_before_render_payment_gateway_settings($gateway)
{
    return $gateway;
}

function asaas_settings_tab_footer()
{
?>
    <script>
        $(document).ready(function() {

            $(".form-control datepicker").attr("required", "true");

            function validate_invoice_form(e) {
                e = void 0 === e ? "#invoice-form" : e,
                    appValidateForm($(e), {
                        clientid: {
                            required: {
                                depends: function() {
                                    return !$("select#clientid").hasClass("customer-removed")
                                }
                            }
                        },
                        date: "required",
                        currency: "required",
                        repeat_every_custom: {
                            min: 1
                        },
                        number: {
                            required: !0
                        }
                    }), $("body").find('input[name="number"]').rules("add", {
                        remote: {
                            url: admin_url + "invoices/validate_invoice_number",
                            type: "post",
                            data: {
                                number: function() {
                                    return $('input[name="number"]').val()
                                },
                                isedit: function() {
                                    return $('input[name="number"]').data("isedit")
                                },
                                original_number: function() {
                                    return $('input[name="number"]').data("original-number")
                                },
                                date: function() {
                                    return $('input[name="date"]').val()
                                }
                            }
                        },
                        messages: {
                            remote: app.lang.invoice_number_exists
                        }
                    })
            }
        });

        $("#online_payments_asaas_tab > div:nth-child(13) > div:nth-child(2) > label").html("Valor fixo");

        $("#online_payments_asaas_tab > div:nth-child(13) > div:nth-child(3) > label").html("Porcentagem");

        $("#y_opt_1_Tipo\\ de\\ desconto").change(function() {

            $("#online_payments_asaas_tab > div:nth-child(13) > label").empty();
            $("#online_payments_asaas_tab > div:nth-child(13) > label").html("Valor desconto ");

        });

        $("#y_opt_2_Tipo\\ de\\ desconto").change(function() {
            $("#online_payments_asaas_tab > div:nth-child(13) > label").empty();
            $("#online_payments_asaas_tab > div:nth-child(13) > label").html("Valor desconto (Informar porcentagem)");

        });
    </script>
    <?php
}

function asaas_after_invoice_added($invoice_id)
{
    // Se o módulo de parcelamento estiver ativo, chama a função de preparação de fatura
    if (get_option('paymentmethod_connect_asaas_is_installment')) {
        prepararFatura($invoice_id);
    }

    // Se a emissão via boleto estiver habilitada
    if (get_option('paymentmethod_connect_asaas_billet_only')) {

        $CI = &get_instance();
        $CI->load->library('asaas_gateway');
        $CI->load->model('invoices_model');
        $invoice = $CI->invoices_model->get($invoice_id);

        if ($invoice) {

            // Se houver data de vencimento
            if ($invoice->duedate) {

                $allowed_payment_modes = unserialize($invoice->allowed_payment_modes);

                // Verifica se a forma de pagamento do Asaas está habilitada na fatura
                if (in_array(CONNECT_ASAAS_MODULE_NAME, $allowed_payment_modes)) {

                    // Cria cobrança no Asaas
                    $billet = $CI->asaas_gateway->charge_billet($invoice);
                    if (isset($billet['id'])) {
                        $data = [
                            'asaas_cobranca_id' => $billet['id'],
                        ];
                        $CI->db->where('id', $invoice_id);
                        $CI->db->update(db_prefix() . 'invoices', $data);
                        $CI->invoices_model->log_invoice_activity($invoice->id, 'Cobrança adicionada com sucesso ao Asaas. Asaas ID: ' . $billet['id']);
                    }

                    // LOG de início de criação da nota fiscal
                    $CI->load->library('connect_asaas/invoice');
                    $CI->load->library('connect_asaas/base_api');
                    $CI->invoices_model->log_invoice_activity($invoice->id, 'Início da criação da nota fiscal');

                    // Recupera dados necessários
                    $clientid               = $invoice->clientid;
                    $asaas_invoice_ir       = get_option('asaas_invoice_ir');
                    $asaas_invoice_inss     = get_option('asaas_invoice_inss');
                    $asaas_invoice_csll     = get_option('asaas_invoice_csll');
                    $asaas_invoice_cofins   = get_option('asaas_invoice_cofins');
                    $asaas_invoice_iss      = get_option('asaas_invoice_iss');
                    $api_key                = $CI->base_api->getApiKey();
                    $api_url                = $CI->base_api->getUrlBase();

                    // ----------------------------------------------------------------------------
                    // NOVA LÓGICA DE CHECAGEM DA CONFIGURAÇÃO DE EMISSÃO POR CLIENTE OU GLOBAL
                    // ----------------------------------------------------------------------------

                    // Busca se o cliente possui configuração de emissão de NF específica
                    $CI->db->select('value');
                    $CI->db->from(db_prefix() . 'customfieldsvalues');
                    // relid deve ser igual ao clientid da tblinvoices
                    $CI->db->where('relid', $clientid);
                    $query  = $CI->db->get();
                    $result = $query->row();

                    // Define variável padrão
                    $isCriarNotaFiscal = false;

                    if ($result) {
                        // Se encontrou algum valor específico para este cliente
                        $valorConfig = trim($result->value);

                        if ($valorConfig === 'Emitir na criação da fatura') {
                            // Emitir NFSe imediatamente
                            $isCriarNotaFiscal = true;

                        } elseif ($valorConfig === 'Emissão avulsa' || $valorConfig === 'Emitir na confirmação de pagamento') {
                            // Nada acontece
                            $isCriarNotaFiscal = false;

                        } else {
                            // Caso o valor seja diferente dos três acima,
                            // verifica a configuração global asaas_invoice_on_event
                            $asaasInvoiceOnEvent = get_option('asaas_invoice_on_event');
                            $isCriarNotaFiscal   = ($asaasInvoiceOnEvent == 1);
                        }

                    } else {
                        // Se não encontrou registro na tabela customfieldsvalues
                        // então olha a config global asaas_invoice_on_event
                        $asaasInvoiceOnEvent = get_option('asaas_invoice_on_event');
                        $isCriarNotaFiscal   = ($asaasInvoiceOnEvent == 1);
                    }

                    // Log para verificar se vai criar NF ou não
                    $CI->invoices_model->log_invoice_activity($invoice->id, 'Pode criar NFSe na criação: ' . ($isCriarNotaFiscal ? 'SIM' : 'NÃO'));

                    // Se estiver autorizado a criar a NFSe
                    if ($isCriarNotaFiscal) {

                        // Prossegue com a emissão
                        $client = $CI->clients_model->get($clientid);

                        // Descrição
                        $description    = $CI->asaas_gateway->getSetting('description');
                        $invoice_number = $invoice->prefix . str_pad($invoice->number, 6, "0", STR_PAD_LEFT);
                        $description    = str_replace("{invoice_number}", $invoice_number, $description);

                        // Dados do cliente
                        $document   = str_replace(['/', '-', '.'], '', $client->vat);
                        $email      = get_custom_field_value($client->userid, 'customers_email_principal', 'customers')
                                      ?? get_custom_field_value($client->userid, 'customers_e_mail_financeiro', 'customers');
                        $addressNum = get_custom_field_value($client->userid, 'customers_numero', 'customers')
                                      ?? get_custom_field_value($client->userid, 'customers_numero_endereco', 'customers');
                        $complement = get_custom_field_value($client->userid, 'customers_complemento', 'customers');
                        $postalCode = str_replace(['-', '.'], '', $client->zip);

                        // Verifica se o cliente já existe no Asaas
                        $customer = $CI->invoice->search_cliente($document);
                        if ($customer['totalCount'] == "0") {
                            // Cria se não existir
                            $post_data = json_encode([
                                "name"                 => $client->company,
                                "email"                => $email,
                                "cpfCnpj"              => $document,
                                "postalCode"           => $postalCode,
                                "address"              => $client->address,
                                "addressNumber"        => $addressNum,
                                "complement"           => $complement ?? '',
                                "phone"                => $client->phonenumber,
                                "mobilePhone"          => $client->phonenumber,
                                "externalReference"    => $client->userid,
                                "notificationDisabled" => boolval(get_option('paymentmethod_connect_asaas_disable_charge_notification')),
                            ]);

                            $cliente_create = $CI->asaas_gateway->create_customer($api_url, $api_key, $post_data);
                            $cliente_id = $cliente_create['id'];
                            log_activity('Cliente cadastrado no Asaas [Cliente ID: ' . $cliente_id . ']');

                        } else {
                            // Se já existir, pega o ID
                            $cliente_id = $customer['data'][0]['id'];
                        }

                        // Recupera configuração de serviço municipal
                        $municipal_service_default = json_decode(get_option('municipal_service_default')) ?? '';
                        $parts                     = explode(' - ', $municipal_service_default->service_name, 2);
                        $municipalServiceCode      = preg_replace("/\D+/", "", trim($parts[0]));
                        $municipalServiceName      = trim($parts[1]);

                        // Se encontrar pipe (|)
                        $pipePosition = strpos($municipalServiceCode, '|');
                        if ($pipePosition !== false) {
                            $municipalServiceCode = trim(substr($municipalServiceCode, 0, $pipePosition));
                        } else {
                            $municipalServiceCode = trim($municipalServiceCode);
                        }

                        // Monta JSON para criar NF
                        $post_data = json_encode([
                            "customer"             => $cliente_id,
                            "serviceDescription"   => $description,
                            "value"                => $invoice->total,
                            "effectiveDate"        => date('Y-m-d'),
                            "externalReference"    => $invoice->hash,
                            "taxes"                => [
                                "retainIss" => null,
                                "iss"       => $asaas_invoice_iss,
                                "cofins"    => $asaas_invoice_cofins,
                                "csll"      => $asaas_invoice_csll,
                                "inss"      => $asaas_invoice_inss,
                                "ir"        => $asaas_invoice_ir,
                                "pis"       => null
                            ],
                            "municipalServiceCode" => $municipalServiceCode,
                            "municipalServiceName" => $municipalServiceName
                        ]);

                        $CI->invoices_model->log_invoice_activity($invoice->id, '[Asaas - NFSe] - Corpo da requisição para criação: ' . $post_data);

                        // Cria a NFSe via API
                        $create_invoice = $CI->invoice->create_invoice($post_data);

                        $CI->invoices_model->log_invoice_activity($invoice->id, '[Asaas - NFSe] - NF criada com sucesso: ' . ($create_invoice));

                        $create_invoice = json_decode($create_invoice, true);
                    }
                }
            }
        }
        return $invoice_id;
    }
}


function asaas_after_invoice_updated($invoice)
{
    $invoice_id = $invoice['id'];

    $CI = &get_instance();

    $CI->load->library('asaas_gateway');
    $CI->load->model('invoices_model');
    $CI->load->library('connect_asaas/base_api');
    $api_key  = $CI->base_api->getApiKey();
    $base_url = $CI->base_api->getUrlBase();

    $description      = $CI->asaas_gateway->getSetting('description');
    $discount_value   = $CI->asaas_gateway->getSetting('discount_value');
    $dueDateLimitDays = $CI->asaas_gateway->getSetting('discount_days');
    $discount_type    = $CI->asaas_gateway->getSetting('discount_type');
    $update_charge    = $CI->asaas_gateway->getSetting('update_charge');

    $notificationDisabled = boolval(get_option('paymentmethod_connect_asaas_disable_charge_notification'));

    if ($update_charge == 1) {

        $invoice = $CI->invoices_model->get($invoice_id);
        if ($invoice) {

            $sem_desconto = strpos($invoice->adminnote, "{sem_desconto}", 0);

            if ($discount_type == 1) {

                $discount = [
                    'type' => 'FIXED',
                    "value" => $discount_value,
                    "dueDateLimitDays" => $dueDateLimitDays,
                ];
            }

            if ($discount_type == 2) {

                $discount = [
                    'type' => 'PERCENTAGE',
                    "value" => $discount_value,
                    "dueDateLimitDays" => $dueDateLimitDays,
                ];
            }


            if (is_bool($sem_desconto)) {
                $discount =  [
                    'type' => 'PERCENTAGE',
                    "value" => $discount_value,
                    "dueDateLimitDays" => $dueDateLimitDays,
                ];
            }

            $invoice_number = $invoice->prefix . str_pad($invoice->number, 6, "0", STR_PAD_LEFT);

            $description = mb_convert_encoding(str_replace("{invoice_number}", $invoice_number, $description), 'UTF-8', 'ISO-8859-1');

            if ($invoice->duedate) {

                $client = $invoice->client;

                $email_client = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_email_padrao'), 'customers');

                $addressNumber = get_custom_field_value($client->userid,  get_option('asaas_campo_personalisado_numero_endereco_padrao'), 'customers');

                $bairro = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_bairro_padrao'), 'customers');

                $complement = get_custom_field_value($client->userid, 'customers_complemento', 'customers');

                $clientid = $invoice->client->userid;

                if (!$client->asaas_customer_id) {

                    $post_data = json_encode([
                        "name"                 => $client->company,
                        "email"                => $email_client,
                        "cpfCnpj"              => $client->vat,
                        "postalCode"           => $client->zip,
                        "address"              => $client->address,
                        "addressNumber"        => $addressNumber,
                        "complement"           => "",
                        "province"             => $bairro,
                        "phone"                => $client->phonenumber,
                        "mobilePhone"          => $client->phonenumber,
                        "externalReference"    => $invoice->hash,
                        "notificationDisabled" => $notificationDisabled,
                        'complement'          => $complement
                    ]);

                    $cliente_create = $CI->asaas_gateway->create_customer($base_url, $api_key, $post_data);

                    $cliente_id = $cliente_create['id'];

                    $CI->db->where('userid', $clientid)->update(db_prefix() . 'clients', ['asaas_customer_id' => $cliente_id]);

                    log_activity('Cliente cadastrado no Asaas [Cliente ID: ' . $cliente_id . ']');
                } else {
                    // se existir recupera os dados para cobranca
                    $cliente_id = $client->asaas_customer_id;
                }

                $allowed_payment_modes = unserialize($invoice->allowed_payment_modes);

                if (in_array('asaas', $allowed_payment_modes) || in_array('connect_asaas', $allowed_payment_modes)) {

                    $CI->asaas_gateway->listar_todas_cobrancas_e_atualizar($base_url, $api_key, $invoice->hash);

                    $invoice = $CI->invoices_model->get($invoice_id);

                    $charge = $CI->asaas_gateway->recuperar_uma_unica_cobranca($invoice->asaas_cobranca_id);

                    if ($charge) {

                        $post_data = json_encode([
                            "customer"      => $cliente_id,
                            "billingType"   => $charge->billingType,
                            "dueDate"       => $invoice->duedate,
                            "value"         => $invoice->total,
                            "description"   => $description,
                            "postalService" => false
                        ]);

                        $update_charge = $CI->asaas_gateway->update_charge($invoice->asaas_cobranca_id, $post_data);
                    } else {
                        $CI->asaas_gateway->charge_billet($invoice);
                    }
                }
            }
        }
    }
}

function asaas_before_invoice_deleted($id)
{
    $CI = &get_instance();

    $CI->load->library('connect_asaas/asaas_gateway');
    $CI->load->model('invoices_model');

    $delete_charge = $CI->asaas_gateway->getSetting('delete_charge');


    if ($delete_charge == 1) {

        deleteIvoiceChildren($id);

        $invoice = $CI->invoices_model->get($id);

        $charges = $CI->asaas_gateway->get_charge2($invoice->hash);

        if ($charges) {
            foreach ($charges as $charge) {

                $CI->asaas_gateway->delete_charge($charge->id);

                log_activity('Cobrança removida Asaas [Fatura ID: ' . $charge->id . ']');
            }
        }
    }
    return $id;
}

function asaas_invoice_after_payment_added($insert_id)
{
    // Carrega opções do módulo
    $asaas_invoice_on_event             = get_option('asaas_invoice_on_event');
    $asaas_invoice_municipalServiceCode = get_option('asaas_invoice_municipalServiceCode');
    $asaas_invoice_ir                   = get_option('asaas_invoice_ir');
    $asaas_invoice_inss                 = get_option('asaas_invoice_inss');
    $asaas_invoice_csll                 = get_option('asaas_invoice_csll');
    $asaas_invoice_cofins               = get_option('asaas_invoice_cofins');
    $asaas_invoice_iss                  = get_option('asaas_invoice_iss');

    // Instâncias e carregamentos
    $CI = &get_instance();
    $CI->load->model('invoices_model');
    $CI->load->model('payments_model');
    $CI->load->model('clients_model');

    $CI->load->library('connect_asaas/asaas_gateway');
    $CI->load->library('connect_asaas/invoice');
    $CI->load->library('connect_asaas/base_api');

    // Configurações e variáveis
    $update_payment_invoice_asaas = $CI->asaas_gateway->getSetting('update_payment_invoice_asaas');
    $api_key                      = $CI->base_api->getApiKey();
    $api_url                      = $CI->base_api->getUrlBase();

    // Obtem dados do pagamento inserido
    $payment = $CI->payments_model->get($insert_id);

    // Se o pagamento foi via Asaas e se configurado para atualizar via Asaas
    if ($payment->paymentmode == 'connect_asaas' && $update_payment_invoice_asaas) {

        // Log para indicar o recebimento via Asaas
        $CI->invoices_model->log_invoice_activity($payment->invoiceid, '[ASAAS] - Pagamento recebido via Asaas [Pagamento ID: ' . $insert_id . ']');

        // Busca a fatura e dados essenciais
        $invoice = $CI->invoices_model->get($payment->invoiceid);
        $amount  = $payment->amount;
        $date    = $payment->date;

        $asass_invoice_id = $invoice->asaas_cobranca_id;
        $body_params      = [
            'paymentDate'   => $date,
            'value'         => $amount,
            'notifyCustomer'=> true
        ];

        // Verifica se houve POST de confirmação com data de pagamento (pagamento em dinheiro, por ex.)
        $post = $CI->input->post();
        if (isset($post['date']) && !empty($post)) {
            $response = $CI->asaas_gateway->receive_in_cash($asass_invoice_id, $body_params);
            if (isset($response['status']) && $response['status'] == 'RECEIVED_IN_CASH') {
                log_activity('Pagamento recebido em dinheiro [Fatura ID: ' . $asass_invoice_id . ']');
            }
        }

        //------------------------------------------------------------------------------
        // Nova lógica de checagem: "Emitir na confirmação de pagamento"
        //------------------------------------------------------------------------------

        $clientid = $invoice->clientid;

        // 1) Obter configuração na tblcustomfieldsvalues
        //    - Se value = "Emitir na confirmação de pagamento" => emitir
        //    - Se value = "Emissão avulsa" ou "Emitir na criação da fatura" => não emitir
        //    - Se não existir NENHUM registro ou valor não for nenhum dos citados => checar global
        $CI->db->select('value');
        $CI->db->from(db_prefix() . 'customfieldsvalues');
        $CI->db->where('relid', $clientid); // relid deve ser igual ao clientid da fatura
        $query          = $CI->db->get();
        $resultadoCampo = $query->row();

        $criarNfse = false;

        if ($resultadoCampo) {
            // Se existe configuração específica no campo personalizado
            $valorConfig = trim($resultadoCampo->value);

            if ($valorConfig === 'Emitir na confirmação de pagamento') {
                // Emitir
                $criarNfse = true;

            } elseif ($valorConfig === 'Emissão avulsa' || $valorConfig === 'Emitir na criação da fatura') {
                // Não emitir
                $criarNfse = false;

            } else {
                // Valor diferente dos três, checa global
                // Global = 2 => emitir
                $criarNfse = ($asaas_invoice_on_event == 2);
            }
        } else {
            // Não existe registro para este clientid, checar global
            // Global = 2 => emitir
            $criarNfse = ($asaas_invoice_on_event == 2);
        }

        // Log para checar a decisão final
        $CI->invoices_model->log_invoice_activity($payment->invoiceid, '[ASAAS] - Pagamento recebido via Asaas [Criar NFSE: ' . ($criarNfse ? 'SIM' : 'NÃO') . ']');

        //------------------------------------------------------------------------------
        // Caso esteja habilitado, prossegue com a emissão da NFSe
        //------------------------------------------------------------------------------

        if ($criarNfse) {

            // Coleta dados do cliente
            $client = $CI->clients_model->get($clientid);

            // Descrição que irá para a NF
            $description    = $CI->asaas_gateway->getSetting('description');
            $invoice_number = $invoice->prefix . str_pad($invoice->number, 6, "0", STR_PAD_LEFT);
            $description    = str_replace("{invoice_number}", $invoice_number, $description);

            // Documentos e complementos
            $document   = str_replace(['/', '-', '.'], '', $client->vat);
            $email      = get_custom_field_value($client->userid, 'customers_email_principal', 'customers')
                          ?? get_custom_field_value($client->userid, 'customers_e_mail_financeiro', 'customers');
            $addressNum = get_custom_field_value($client->userid, 'customers_numero', 'customers')
                          ?? get_custom_field_value($client->userid, 'customers_numero_endereco', 'customers');
            $complement = get_custom_field_value($client->userid, 'customers_complemento', 'customers');
            $postalCode = str_replace(['-', '.'], '', $client->zip);

            // Verifica existência do cliente no Asaas
            $customer = $CI->invoice->search_cliente($document);
            if ($customer['totalCount'] == "0") {
                // Cria se não existir
                $post_data = json_encode([
                    "name"                 => $client->company,
                    "email"                => $email,
                    "cpfCnpj"              => $document,
                    "postalCode"           => $postalCode,
                    "address"              => $client->address,
                    "addressNumber"        => $addressNum,
                    "complement"           => $complement ?? '',
                    "phone"                => $client->phonenumber,
                    "mobilePhone"          => $client->phonenumber,
                    "externalReference"    => $client->userid,
                    "notificationDisabled" => boolval(get_option('paymentmethod_connect_asaas_disable_charge_notification')),
                ]);

                $cliente_create = $CI->asaas_gateway->create_customer($api_url, $api_key, $post_data);
                $cliente_id = $cliente_create['id'];
                log_activity('Cliente cadastrado no Asaas [Cliente ID: ' . $cliente_id . ']');
            } else {
                // Se já existir, pega o ID
                $cliente_id = $customer['data'][0]['id'];
            }

            // Recupera configuração de serviço municipal
            $municipal_service_default = json_decode(get_option('municipal_service_default')) ?? '';
            $parts = explode(' - ', $municipal_service_default->service_name, 2);

            $municipalServiceCode = preg_replace("/\D+/", "", trim($parts[0]));
            $municipalServiceName = trim($parts[1]);
            $pipePosition         = strpos($municipalServiceCode, '|');
            if ($pipePosition !== false) {
                $municipalServiceCode = trim(substr($municipalServiceCode, 0, $pipePosition));
            } else {
                $municipalServiceCode = trim($municipalServiceCode);
            }

            // Monta dados para criação da NFSe
            $post_data = json_encode([
                "customer"           => $cliente_id,
                "serviceDescription" => $description,
                "value"              => $invoice->total,
                "effectiveDate"      => date('Y-m-d'),
                "externalReference"  => $invoice->hash,
                "taxes"              => [
                    "retainIss" => null,
                    "iss"       => $asaas_invoice_iss,
                    "cofins"    => $asaas_invoice_cofins,
                    "csll"      => $asaas_invoice_csll,
                    "inss"      => $asaas_invoice_inss,
                    "ir"        => $asaas_invoice_ir,
                    "pis"       => null
                ],
                // Aqui usando 'municipalServiceId' vindo de $asaas_invoice_municipalServiceCode.
                // Caso seja necessário usar o 'municipalServiceCode' propriamente, faça o ajuste.
                "municipalServiceId"   => $asaas_invoice_municipalServiceCode,
                "municipalServiceName" => $municipalServiceName
            ]);

            // Log para depuração da criação
            $CI->invoices_model->log_invoice_activity(
                $payment->invoiceid,
                '[Asaas - NFSe] - Emitir no recebimento. Corpo da requisição para criação:' . $post_data
            );

            // Solicita emissão
            $create_invoice = $CI->invoice->create_invoice($post_data);

            // Log do retorno
            $CI->invoices_model->log_invoice_activity(
                $payment->invoiceid,
                '[Asaas - NFSe] - Emitir no recebimento. Resposta da emissão:' . $create_invoice
            );

            // Decodifica se precisar tratar o retorno
            $create_invoice = json_decode($create_invoice, true);
        }

        // Retorna o ID do pagamento
        return $insert_id;
    }
}


function asaas_invoice_init_menu_items()
{
    $CI = &get_instance();

    if (is_admin()) {

        $CI->app_menu->add_sidebar_menu_item('asaas_invoice', [
            'name' => 'NFSe Asaas',
            'href' => admin_url('connect_asaas/asaas_invoice'),
            'position' => 5,
            'icon' => 'fa-regular fa-file-lines menu-icon',
        ]);

        $CI->app_menu->add_sidebar_children_item('asaas_invoice', [
            'slug' => 'asaas_invoice_listagem',
            'name' => 'Listagem',
            'href' => admin_url('connect_asaas/asaas_invoice'),
            'position' => 5,
        ]);

        $CI->app_menu->add_sidebar_children_item('asaas_invoice', [
            'slug' => 'asaas_invoice_criar',
            'name' => 'Criar Nota Avulsa',
            'href' => admin_url('connect_asaas/asaas_invoice/create'),
            'position' => 5,
        ]);
    }
}

function asaas_invoice_after_invoice_view_as_client_link($invoice)
{
    $asaas_invoice_on_event = get_option('asaas_invoice_on_event');

    if ($asaas_invoice_on_event == '0') {
    ?>
        <li><a href="<?php echo admin_url('connect_asaas/asaas_invoice/issue/' . $invoice->id); ?>">Emitir nota fiscal</a></li>
    <?php
    }
}

function asaas_invoice_admin_js()
{
    ?>
    <script>
        $("#inss").on('click', function() {
            var am = $('#amount').val();
            var ta = $('#iss').val();
            var total = (am * ta) / 100;
            $('#inss_tax').val((total).toFixed(2));
        });
        $("#inss").on('click', function() {
            var am = $('#amount').val();
            var ta = $('#inss').val();
            var total = (am * ta) / 100;
            $('#inss_tax').val((total).toFixed(2));
        });

        //
        $("#cofins").on('input', function() {
            var am = $('#amount').val();
            var ta = $('#cofins').val();
            var total = (am * ta) / 100;
            $('#cofins_tax').val((total).toFixed(2));
        });

        //
        $("#csll").on('input', function() {
            var am = $('#amount').val();
            var ta = $('#csll').val();
            var total = (am * ta) / 100;
            $('#csll_tax').val((total).toFixed(2));
        });

        //
        $("#ir").on('input', function() {
            var am = $('#amount').val();
            var ta = $('#ir').val();
            var total = (am * ta) / 100;
            $('#ir_tax').val((total).toFixed(2));
        });

        //
        $("#pis").on('input', function() {
            var am = $('#amount').val();
            var ta = $('#pis').val();
            //  var total = number_format((am * ta) / 100, 2, ',', '');
            var total = (am * ta) / 100;
            $('#pis_tax').val((total).toFixed(2));
        });

        $("input").keyup(function() {

            var amount = $('#amount').val();

            var inss = $('#inss_tax').val();
            var cofins = $('#cofins_tax').val();
            var csll = $('#csll_tax').val();
            var ir = $('#ir_tax').val();
            var pis = $('#pis_tax').val();

            var total_tax = Number(inss) + Number(cofins) + Number(csll) + Number(ir) + Number(pis);
            $('#total_tax').val((total_tax).toFixed(2));

            var total = Number(amount) - Number(total_tax)

            $('#liquid_amount').val(total);
        });
    </script>

<?php
}

function asaas_invoice_add_settings_tab()
{
    $CI = &get_instance();
    $CI->app_tabs->add_settings_tab('asaas-nf-settings', [
        'name' => 'Emissão de notas ASAAS',
        'view' => 'connect_asaas/invoice/config',
        'position' => 55,
    ]);
}

if (!function_exists('atualizar_base_servicos_municipais')) {
    function atualizar_base_servicos_municipais()
    {
        $ci = &get_instance();
        $ci->load->library('connect_asaas/service');
        $ci->service->atualizarBaseServicos();
    }
}

hooks()->add_action('admin_init', function () {

    $CI = &get_instance();

    $CI->load->model('payments_model');

    $CI->load->model('invoices_model');

    $uri     = $_SERVER['REQUEST_URI'];

    $parse   = parse_url($uri);

    $string  = $parse['path'];

    $pattern = "/^\/admin\/payments\/delete\/(\d+)$/";

    if ($CI->input->method() == 'get') {

        if (preg_match($pattern, $string, $matches)) {

            if (isset($matches[1])) {

                $paymentid        = $matches[1];

                $payment          = $CI->payments_model->get($paymentid);

                $invoice          = $CI->invoices_model->get($payment->invoiceid);

                $asass_invoice_id = $invoice->asaas_cobranca_id;

                if ($asass_invoice_id) {

                    $response = $CI->asaas_gateway->undo_received_in_cash($asass_invoice_id);

                    if (isset($response['status']) && $response['status'] == 'PENDING') {

                        log_activity('Pagamento desfeito em dinheiro [Fatura ID: ' . $asass_invoice_id . ']');
                    }
                }
            }
        }
    }
});


hooks()->add_action('app_init', 'connect_asaas_clients_redirect');


function connect_asaas_clients_redirect()
{
    $CI = &get_instance();
    if ($CI->input->method() == 'get') {

        $requestUri = $_SERVER['REQUEST_URI'];

        $parse      = parse_url($requestUri);

        $pattern    = "#^/admin/clients/client/\d+$#";

        $path       = $parse['path'];

        if (preg_match($pattern, $path)) {

            $parts = explode('/', $path);

            $clientid = array_pop($parts);

            if (isset($parse['query'])) {

                if ($CI->input->get('group') == 'subscriptions') {

                    redirect(admin_url("connect_asaas/subscriptions?clientid={$clientid}"));
                }
            }
        }

        if ($path == '/admin/subscriptions') {
            redirect(admin_url("connect_asaas/subscriptions"));
        }
    }
}


hooks()->add_filter('client_updated', 'atualizar_cliente');

function atualizar_cliente($data)
{
    if ($data['updated']) {
        $CI = &get_instance();
        $CI->load->library('connect_asaas/customer');
        $CI->load->model('clients_model');

        $clientid      = $data['id'];
        $client        = $CI->clients_model->get($clientid);
        $document      = soNumeros($client->vat);
        $email         = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_email_padrao'), 'customers');
        $addressNumber = get_custom_field_value($client->userid,  get_option('asaas_campo_personalisado_numero_endereco_padrao'), 'customers');
        $bairro        = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_bairro_padrao'), 'customers');
        $userid        = $client->userid;
        $complement    = get_custom_field_value($client->userid, 'customers_complemento', 'customers');

        $post_data = [
            "name"                 => $client->company,
            "company"              => $client->company,
            "cpfCnpj"              => $document,
            "email"                => $email,
            "phone"                => $client->phonenumber,
            "postalCode"           => $client->zip,
            "address"              => $client->address,
            "addressNumber"        => $addressNumber,
            "complement"           => $complement,
            "province"             => $bairro,
            "mobilePhone"          => $client->phonenumber,
            "externalReference"    => $userid,
            "notificationDisabled" => boolval(get_option('paymentmethod_connect_asaas_disable_charge_notification')),
        ];

        if ($asaas_customer_id = $client->asaas_customer_id) {

            $cliente_update = $CI->customer->update($asaas_customer_id, $post_data);

            if (isset($cliente_update->id)) {
                log_activity('Cliente atualizado no Asaas [Cliente ID: ' . $clientid . ']');
            }
        } else {
            $pesquisar_cliente_asaas = $CI->customer->search_customer($document);
            if (!$pesquisar_cliente_asaas) {
                $cliente_create = $CI->customer->create($post_data);
                if (isset($cliente_create['id'])) {
                    $cliente_id = $cliente_create['id'];
                    $CI->db->where('userid',  $userid)->update(db_prefix() . 'clients', ['asaas_customer_id' => $cliente_id]);
                    log_activity('[ASAAS] - Cliente cadastrado no Asaas [Cliente ID: ' . $cliente_id . ']');
                }
            } else {
                if (isset($pesquisar_cliente_asaas['id'])) {
                    $CI->db->where('userid',  $userid)->update(db_prefix() . 'clients', ['asaas_customer_id' => $pesquisar_cliente_asaas['id']]);
                    log_activity('[ASAAS] - Cliente atualizado no Perfex CRM [Cliente ID: ' . $userid . ']');
                }
            }
        }
    }
}


hooks()->add_action('after_client_created', function ($data) {

    $CI = &get_instance();

    $CI->load->library('connect_asaas/customer');

    $userid = $data['id'];

    $client = $data['data'];

    $document = soNumeros($client['vat']);

    $email = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_email_padrao'), 'customers');

    $addressNumber = get_custom_field_value($client->userid,  get_option('asaas_campo_personalisado_numero_endereco_padrao'), 'customers');

    $bairro = get_custom_field_value($client->userid, get_option('asaas_campo_personalisado_bairro_padrao'), 'customers');

    $post_data = [
        "name"                 => $client['company'],
        "company"              => $client['company'],
        "cpfCnpj"              => $document,
        "email"                => $email,
        "phone"                => $client['phonenumber'],
        "postalCode"           => $client['zip'],
        "address"              => $client['address'],
        "addressNumber"        => $addressNumber,
        "complement"           => "",
        "province"             => $bairro,
        "mobilePhone"          => $client['phonenumber'],
        "externalReference"    => $userid,
        "notificationDisabled" => boolval(get_option('paymentmethod_connect_asaas_disable_charge_notification'))
    ];

    $result = $CI->customer->create($post_data);

    if (isset($result['id'])) {
        $CI->db->where('userid',  $userid)->update(db_prefix() . 'clients', ['asaas_customer_id' => $result['id']]);
        log_activity('[ASAAS] - O cliente foi criado no Asaas [Cliente ID: ' . $userid . ']. ID no Asaas' . $result['id']);
    } else {
        log_activity('[ASAAS] - o Cliente não foi criado no Asaas [Cliente ID: ' . $userid . ']. Resposta do Asass:' . json_encode($result));
    }
});
