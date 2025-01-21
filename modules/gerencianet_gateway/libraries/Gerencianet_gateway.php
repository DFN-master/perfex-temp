<?php

ob_start();
/**
 * Gerencianet Perfex CRM
 * @version 1.0
 * @autor Taffarel Xavier
 * @website https://taffarel.dev
 */
defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH . '/modules/gerencianet_gateway/vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class Gerencianet_gateway extends App_gateway
{

    protected $ci;

    public function __construct()
    {
        parent::__construct();

        $this->setId('gerencianet');

        $this->setName('Gerencianet');

        $arr_settings = [
            [
                'name' => 'aplicacao_nome_gerencianet',
                'encrypted' => true,
                'label' => 'Nome da Aplicação no Gerência NET',
            ], [
                'name' => 'production_client_id',
                'encrypted' => true,
                'label' => 'Produção Client ID',
            ],
            [
                'name' => 'production_client_secret',
                'encrypted' => true,
                'label' => 'Produção Client Secret',
            ],
            [
                'name' => 'dev_client_id',
                'encrypted' => true,
                'label' => 'Dev Client ID',
            ],
            [
                'name' => 'dev_client_secret',
                'encrypted' => true,
                'label' => 'Dev Client Secret',
            ],
            [
                'name' => 'check_billet',
                'type' => 'yes_no',
                'default_value' => 1,
                'label' => 'Verificar boleto existente, caso positivo, redirecionar, do contrário um novo será gerado',
            ],
            [
                'name' => 'debug_mode',
                'label' => 'Debug Mode',
                'type' => 'yes_no',
                'default_value' => '0',
            ],
            [
                'name' => 'description_dashboard',
                'label' => 'settings_paymentmethod_description',
                'type' => 'textarea',
                'default_value' => 'Payment for Invoice {invoice_number}',
            ],
            [
                'name' => 'currencies',
                'label' => 'currency',
                'default_value' => 'BRL'
            ],
            [
                'name' => 'test_mode_enabled',
                'type' => 'yes_no',
                'default_value' => 1,
                'label' => 'settings_paymentmethod_testing_mode',
            ], [
                'name' => 'codigo_identificador_conta',
                'label' => 'Código identificador da conta',
                'encrypted' => true,
            ],
            [
                'name' => 'tipo_pagamento_pix',
                'label' => 'PIX',
                'type' => 'yes_no',
                'default_value' => 0,
            ], [
                'name' => 'pagamento_pix_chave',
                'label' => 'CHAVE'
            ], [
                'name' => 'tipo_pagamento_pix_certificado_pem_producao',
                'label' => 'Produção - Caminho do Certificado PEM <span style="color:green;">(Obtido no painel do gerência net)</span>',
                'type' => 'input'
            ], [
                'name' => 'tipo_pagamento_pix_certificado_pem_homologacao',
                'label' => 'Dev - Caminho do Certificado PEM <span style="color:green;">(Obtido no painel do gerência net)</span>',
                'type' => 'input'
            ],
            [
                'name' => 'tipo_pagamento_cartaocredito',
                'label' => 'Cartão de crédito',
                'type' => 'yes_no',
                'default_value' => 0,
            ], [
                'name' => 'tipo_pagamento_boleto',
                'label' => 'Boleto',
                'type' => 'yes_no',
                'default_value' => 0,
            ], [
                'name' => 'juros',
                'label' => 'Juros',
                'type' => 'input',
                'default_value' => 0,
            ], [
                'name' => 'multa',
                'label' => 'Multa',
                'type' => 'input',
                'default_value' => 0,
            ],
        ];

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $arr = array_push($arr_settings, [
                'name' => 'url_webhook_localhost',
                'label' => 'Url do Webhook - Localhost <a href="http://webhookinbox.com/" target="_blank">Pode usar o  http://webhookinbox.com/  </a>'
            ]);
        }

        $this->setSettings($arr_settings);

        $CI = &get_instance();

        $this->ci = $CI;
    }

    public function process_payment($data)
    {
        redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data['invoice']->id . '/' . $data['hash']));
    }

    public function create_billet($data = null)
    {
        if (empty($data)) {
            return;
        }

        if ($this->getSetting('debug_mode')) {
            log_activity('[GERENCIA NET][1] - Criando cobrança');
        }

        $this->ci->load->helper('gerencianet_gateway');

        if ($this->getSetting('test_mode_enabled') == 1) {
            $clientId = $this->decryptSetting('dev_client_id');
            $clientSecret = $this->decryptSetting('dev_client_secret');
            $sandbox = true;
        } else {
            $clientId = $this->decryptSetting('production_client_id');
            $clientSecret = $this->decryptSetting('production_client_secret');
            $sandbox = false;
        }

        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => $sandbox
        ];

        $invoiceNumber = format_invoice_number($data->id);

        $description = str_replace('{invoice_number}', $invoiceNumber, $this->getSetting('description_dashboard'));

        $callbackUrl = site_url('gerencianet_gateway/gerencia_net/callback_boleto?invoiceid=' . $data->id . '&hash=' . $data->hash);

        $valor_cobrado = (int) number_format($data->total, 2, '', '');

        if ($valor_cobrado < 5) {
            set_alert('warning', "O valor não pode ser inferior a R$ 5,00");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
        }

        $item_1 = [
            'name' => $description,
            'amount' => 1,
            'value' => $valor_cobrado
        ];

        $items = [
            $item_1
        ];

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $callbackUrl = $this->getSetting('url_webhook_localhost');
        }

        $metadata = [
            'custom_id' => $data->id,
            'notification_url' => $callbackUrl
        ];

        $body = [
            'items' => $items,
            'metadata' => $metadata
        ];

        $juros = (int) calcularJuros($this->getSetting('juros'));
        $multa =  (int) calcularMulta($this->getSetting('multa'));

        if ($juros > 330) {
            set_alert('warning', "O valor mínimo deve ser 0 e máximo 330.");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
            die;
        }

        if ($multa > 1000) {
            set_alert('warning', "O valor mínimo deve ser 0 e máximo 1000.");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
            die;
        }

        $gateway = new Gerencianet($options);

        $charge = $gateway->createCharge([], $body);

        if ($this->getSetting('debug_mode')) {
            log_activity('[GERENCIA NET][2] - Cobrança criada: ' . json_Encode($charge));
        }

        if ($charge["code"] == 200) {

            if ($this->getSetting('debug_mode')) {
                log_activity('[GERENCIA NET][3] Cobrança criada com sucesso: ' . $charge["data"]["charge_id"]);
            }

            $params = ['id' => $charge["data"]["charge_id"]];

            $vat = $data->client->vat;

            $vat = preg_replace("/[^0-9]/", "", $vat);

            if (!$data->client->phonenumber) {
                if ($this->getSetting('debug_mode')) {
                    log_activity('[GERENCIA NET][4] O telefone do cliente é obrigatório.');
                }
                set_alert('warning', "O telefone do cliente é obrigatório.");
                redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
                die;
            }

            $phone_number = $data->client->phonenumber;

            $phone_number = preg_replace("/[^0-9]/", "", $phone_number);

            if (strlen($data->client->company) <= 1) {
                set_alert('warning', "O nome do cliente é obrigatório.    ");
                redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
                die;
            }

            if (strlen($vat) == 11) {
                $customer = [
                    'name' => $data->client->company,
                    'cpf' => $vat,
                    'phone_number' => $phone_number
                ];
            } elseif (strlen($vat) == 14) {
                $customer = [
                    'phone_number' => $phone_number,
                    'juridical_person' => [
                        'corporate_name' => $data->client->company,
                        'cnpj' => $vat
                    ]
                ];
            }

            if (strtotime(date("Y-m-d")) > strtotime($data->duedate)) {
                $expire_at = date('Y-m-d', strtotime("+1 days", strtotime(date("Y-m-d"))));
            } else {
                $expire_at = $data->duedate;
            }

            $configurations = [ // configurações de juros e mora
                'fine' => (int)$multa, // porcentagem de multa
                'interest' => (int) $juros
            ];

            $bankingBillet = [
                'expire_at' => $expire_at,
                'message' => 'Multa após o vencimento. Protesto após 30 dias corridos de atraso.',
                'customer' => $customer,
                'configurations' => $configurations
            ];

            $payment = ['banking_billet' => $bankingBillet];

            $body = ['payment' => $payment];

            $gateway = new Gerencianet($options);

            if ($this->getSetting('debug_mode')) {
                log_activity('[GERENCIA NET][5] request:' . json_encode($body));
            }

            $pay_charge = $gateway->payCharge($params, $body);

            if ($pay_charge["code"] == 200) {
                if ($this->getSetting('debug_mode')) {
                    log_activity('[GERENCIA NET][6] Atualizando a fatura');
                }
                $this->ci->db->where('id', $data->id);

                $this->ci->db->update(db_prefix() . 'invoices', [
                    'token' => $pay_charge["data"]["charge_id"],
                ]);

                return $pay_charge;
            } else {
                log_activity('[GERENCIA NET][7] Erro ao criar a cobrança: ' . $pay_charge["code"] . ' - ' . json_encode($pay_charge));
                return $charge;
            }
        } else {
            if ($this->getSetting('debug_mode')) {
                log_activity('[GERENCIA NET][8]'. json_encode($charge));
            }
            return $charge;
        }
    }
}
