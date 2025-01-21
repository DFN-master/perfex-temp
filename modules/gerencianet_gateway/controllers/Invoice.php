<?php

defined('BASEPATH') or exit('No direct script access allowed');

require __DIR__ . '../../../../modules/gerencianet_gateway/vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class Invoice extends ClientsController
{

    public function __construct()
    {
        parent::__construct();

        $CI = &get_instance();

        $this->ci = $CI;

        $this->gn_gateway = $this->gerencianet_gateway;

        $this->load->helper('gerencianet_gateway_helper');
    }

    public function index($invoice_id, $invoice_hash)
    {
        check_invoice_restrictions($invoice_id, $invoice_hash);

        $this->load->model('invoices_model');

        $invoice = $this->invoices_model->get($invoice_id);

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $this->gerar_html($invoice);
        } elseif ($this->input->server('REQUEST_METHOD') === 'POST') {

            $tipo = [1 => 'billet', 2 => 'pix', 3 => 'credit_card'];

            $tipo_pagamento = $this->input->post('gerencianet_pagamento_input_tipo');

            if ($tipo_pagamento == null) {
                set_alert('warning', "Por favar, selecione alguma modo de pagamento do gerência net.");
                redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $invoice->id . '/' . $invoice->hash));
            }

            $options = $this->get_gn_options();

            $invoice->post_data = true;

            $this->gerar_html($invoice);

            switch ($tipo[$tipo_pagamento]) {
                case 'billet':
                    $charge = $this->fetch_payment($invoice);

                    if ($charge) {

                        redirect($charge["data"]["payment"]["banking_billet"]["link"]);
                    } else {
                        $charge = $this->create_billet($invoice);

                        redirect($charge["data"]["payment"]["banking_billet"]["link"]);
                    }
                    break;
                case 'pix':
                    $this->do_pix($options, $invoice);
                    break;
                default:
                    set_alert('warning', "Por favar, selecione alguma modo de pagamento do gerência net.");
                    redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $invoice->id . '/' . $invoice->hash));
                    break;
            }
        }
    }
}
