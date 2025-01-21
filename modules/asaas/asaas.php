<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Módulo Asaas
Description: Facilite sua gestão de pagamentos com a geração de cobranças via PIX, Boleto ou Cartão. Nas versões Whaticket, Evolution ou PinZap PRO, você também pode enviar e receber notificações diretamente pelo WhatsApp, garantindo praticidade e agilidade no atendimento.
Author: Grms Lab 
Version: 2.0.2.5
Requires at least: 3.0.4.*
Author URI: 
*/

define('ASAAS_MODULE_NAME', 'asaas');

hooks()->add_action('before_render_payment_gateway_settings', 'asaas_before_render_payment_gateway_settings');
hooks()->add_action('app_admin_footer', 'asaas_settings_tab_footer');
hooks()->add_action('admin_init', 'asaas_admin_init');
hooks()->add_action('after_invoice_added', 'asaas_after_invoice_added');
hooks()->add_action('invoice_updated', 'asaas_after_invoice_updated');
hooks()->add_action('before_invoice_deleted', 'asaas_before_invoice_deleted');
hooks()->add_filter('module_asaas_action_links', 'module_asaas_action_links');


$CI = &get_instance();

register_activation_hook(ASAAS_MODULE_NAME, 'asaas_module_activation_hook');

function asaas_module_activation_hook()
{

    $CI = &get_instance();
    $CI->load->helper('asaas_helper');
    $mediaPath = FCPATH . $CI->app->get_media_folder() . '/' . ASAAS_MODULE_NAME;
    module_processing();
    if (!file_exists($mediaPath)) {
        mkdir($mediaPath, 0755, true);
        fopen(rtrim($mediaPath, '/') . '/' . 'index.html', 'w');
    }

    require_once(__DIR__ . '/install.php');
}

function module_asaas_action_links($actions)
{
    $actions[] = '<a href="' .  admin_url("settings?group=payment_gateways#online_payments_asaas_tab")  . '">Conf.</a>';
    $actions[] = '<a href="#" target="_blank">Pág. do Módulo</a>';
    $actions[] = '<a href="https://www.asaas.com/r/0001a506-a5a3-4311-a785-452fccdfd916" target="_blank">Quero ganhar taxa reduzida</a>';
    return $actions;
}

register_payment_gateway('asaas_gateway', ASAAS_MODULE_NAME);

if (!function_exists('asaas_admin_init')) {
    function asaas_admin_init()
    {
        $CI = &get_instance();
        if (!get_option('assas_helpers_status')) {
            // $CI->load->helper(ASAAS_MODULE_NAME . '/asaas_file');
            // die;
        }
    }
}


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

            // console.log( asaas);
            $("#online_payments_asaas_tab > div:nth-child(13) > label").empty();
            $("#online_payments_asaas_tab > div:nth-child(13) > label").html("Valor desconto (Informar porcentagem)");

        });
    </script>
<?php
}

function asaas_after_invoice_added($invoice_id)
{
    if (get_option('paymentmethod_asaas_billet_only')) {
        $CI = &get_instance();
        $CI->load->library('asaas_gateway');
        $CI->load->model('invoices_model');
        $invoice = $CI->invoices_model->get($invoice_id);

        if ($invoice && $invoice->status !=6) {
            if ($invoice->duedate) {

                $allowed_payment_modes = unserialize($invoice->allowed_payment_modes);

                if (in_array(ASAAS_MODULE_NAME, $allowed_payment_modes)) {
                    $billet = $CI->asaas_gateway->charge_billet($invoice);
                    $data = array(
                        'asaas_cobranca_id' => $billet['id'],
                    );
                    $CI->db->where('id', $invoice_id);
                    $CI->db->update(db_prefix() . 'invoices', $data);
                }
            }
        }
        return $invoice_id;
    }
}

$CI->load->helper(ASAAS_MODULE_NAME . '/asaas');

function asaas_after_invoice_updated($invoice)
{
    $invoice_id = $invoice['id'];

    $CI = &get_instance();

    $CI->load->library('asaas_gateway');
    $CI->load->model('invoices_model');
    $sandbox = $CI->asaas_gateway->getSetting('sandbox');
    $debug = $CI->asaas_gateway->getSetting('debug');

    if ($sandbox == '0') {
        $api_key = $CI->asaas_gateway->decryptSetting('api_key');
        $api_url = "https://api.asaas.com";
    } else {
        $api_key = $CI->asaas_gateway->decryptSetting('api_key_sandbox');
        $api_url = "https://sandbox.asaas.com/api";
    }

    $description      = $CI->asaas_gateway->getSetting('description');
    $interest         = $CI->asaas_gateway->getSetting('interest_value');
    $fine             = $CI->asaas_gateway->getSetting('fine_value');
    $discount_value   = $CI->asaas_gateway->getSetting('discount_value');
    $dueDateLimitDays = $CI->asaas_gateway->getSetting('discount_days');
    $billet_only      = $CI->asaas_gateway->getSetting('billet_only');
    $billet_check     = $CI->asaas_gateway->getSetting('billet_check');
    $discount_type    = $CI->asaas_gateway->getSetting('discount_type');
    $update_charge    = $CI->asaas_gateway->getSetting('update_charge');

    $disable_charge_notification = $CI->asaas_gateway->getSetting('disable_charge_notification');

    if ($disable_charge_notification == '1') {
        $notificationDisabled = true;
    } else {
        $notificationDisabled = false;
    }

    if ($update_charge == 1) {

        $invoice = $CI->invoices_model->get($invoice_id);

        if ($invoice && $invoice->status !=6) {

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

                $email_client = $CI->asaas_gateway->get_customer_customfields($client->userid, 'customers', 'customers_email_do_cliente');

                $clientid = $invoice->client->userid;

                $document = str_replace('/', '', str_replace('-', '', str_replace('.', '', $client->vat)));

                if (!$client->asaas_customer_id) {

                    $address_number = $CI->asaas_gateway->get_customer_customfields($client->userid, 'customers', 'customers_numero_do_endere_o');

                    $post_data = json_encode([
                        "name" => $client->company,
                        "email" => $email_client,
                        "cpfCnpj" => $client->vat,
                        "postalCode" => $client->zip,
                        "address" => $client->address,
                        "addressNumber" => $address_number,
                        "complement" => "",
                        "phone" => $client->phonenumber,
                        "mobilePhone" => $client->phonenumber,
                        "externalReference" => $invoice->hash,
                        "notificationDisabled" => $notificationDisabled,
                    ]);

                    $cliente_create = $CI->asaas_gateway->create_customer($api_url, $api_key, $post_data);

                    $cliente_id = $cliente_create['id'];

                    $CI->db->where('userid', $clientid)->update(db_prefix() . 'clients', ['asaas_customer_id' => $cliente_id]);

                    log_activity('Cliente cadastrado no Asaas [Cliente ID: ' . $cliente_id . ']');
                } else {
                    // se existir recupera os dados para cobranca
                    $cliente_id = $client->asaas_customer_id;
                }

                $allowed_payment_modes = unserialize($invoice->allowed_payment_modes);

                if (in_array('asaas', $allowed_payment_modes)) {

                    // primeiro verificar se já existe.
                    $CI->asaas_gateway->listar_todas_cobrancas_e_atualizar($api_url, $api_key, $invoice->hash);

                    $invoice = $CI->invoices_model->get($invoice_id);

                    $charge = $CI->asaas_gateway->recuperar_uma_unica_cobranca($invoice->asaas_cobranca_id);

                    if ($charge) {

                        $post_data = json_encode([
                            "customer" => $cliente_id,
                            "billingType" => $charge->billingType,
                            "dueDate" => $invoice->duedate,
                            "value" => $invoice->total,
                            "description" => $description,
                            "postalService" => false
                        ]);

                        $update_charge = $CI->asaas_gateway->update_charge($invoice->asaas_cobranca_id, $post_data);
                    } else {
                        $billet = $CI->asaas_gateway->charge_billet($invoice);
                    }
                }
            }
        }
    }
}


function asaas_before_invoice_deleted($id)
{
    $CI = &get_instance();
    $CI->load->library('asaas_gateway');
    $CI->load->model('invoices_model');

    $delete_charge = $CI->asaas_gateway->getSetting('delete_charge');

    if ($delete_charge == 1) {

        $invoice = $CI->invoices_model->get($id);

        $charges = $CI->asaas_gateway->get_charge2($invoice->hash);

        if ($charges) {
            foreach ($charges as $charge) {

                $response = $CI->asaas_gateway->delete_charge($charge->id);

                log_activity('Cobrança removida Asaas [Fatura ID: ' . $charge->id . ']');
            }
        }
    }
    return $id;
}
