<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tests extends ClientsController
{
    public $unit;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function test_emitir_cobranca()
    {
        $invoiceid = $this->input->get('invoiceid');

        if (!$invoiceid) {
            echo 'Informe o ID da fatura';
            die;
        }

        $invoice = $this->invoices_model->get($invoiceid);

        dd(1, $invoice);
        dd(1, banco_inter_emitir_cobranca($invoice));
    }

    public function test_get_boleto()
    {
        $this->load->library("connect_inter/banco_inter_v3_library");
        dd(1, $this->banco_inter_v3_library->getCobranca("c8b155a7-9064-4911-a614-947ecc374d49"));
    }

    public function test_cancelar_boleto()
    {
        $this->load->library("connect_inter/banco_inter_v3_library");
        dd(1, $this->banco_inter_v3_library->cancelarBoleto("d037f599-bb6d-44ef-8439-324ed9dc799e"));
    }

    public function test_create_webhook()
    {
        $this->load->library("connect_inter/banco_inter_v3_library");
        $url = 'https://webhook.site/f60ccccf-1d1f-42c5-9747-e099d0abe029';
        dd(1, $this->banco_inter_v3_library->createWebhook($url));
    }

    public function test_get_webhook()
    {
        $this->load->library("connect_inter/banco_inter_v3_library");
        dd(1, $this->banco_inter_v3_library->getWebhookCadastrado());
    }

    public function test_delete_webhook()
    {
        $this->load->library("connect_inter/banco_inter_v3_library");
        dd(1, $this->banco_inter_v3_library->excluirWebhook());
    }

    public function test_get_pdf()
    {
        $invoice = $this->invoices_model->get(1014);
        $this->load->library("connect_inter/banco_inter_v3_library");
        dd(1, $this->banco_inter_v3_library->baixarPdf($invoice->banco_inter_codigo_solicitacao));
    }

    public function test_certs_exists()
    {
        dd(1, connect_inter_certs_exists());
    }

    public function test_get_certs()
    {

        $hash      = get_option('connect_inter_ssl_file_hash');
        $key_file  = CONNECT_INTER_MODULE_NAME_UPLOADS_FOLDER . "ssl_files/key_{$hash}.key";
        $cert_file = CONNECT_INTER_MODULE_NAME_UPLOADS_FOLDER . "ssl_files/crt_{$hash}.crt";
        if (!file_exists($key_file) || !file_exists($cert_file)) {
            return;
        }
    }

    public function get_custom_fields_invoice()
    {
        $invoiceid = 61;
        // TODO: continuar daqui.
        $custom_fields_invoice = $this->db->select('t1.id,t2.value')
            ->from(db_prefix() . 'customfields t1')
            ->join(db_prefix() . 'customfieldsvalues t2', 't1.id = t2.fieldid', 'LEFT')
            ->where('t2.fieldto', 'invoice')
            ->where('slug !=', 'invoice_quantidade_de_parcelas_para_gerar')
            ->where('relid', $invoiceid)->get()->result_array();

        $custom_fields_invoice = $custom_fields_invoice ?? [];

        // Transforma o resultado em um array associativo [id => value]
        $custom_fields_invoice_assoc = array_combine(
            array_column($custom_fields_invoice, 'id'),
            array_column($custom_fields_invoice, 'value')
        );

        $new_invoice_data = [];

        $new_invoice_data['custom_fields'] = [
            'invoice' => $custom_fields_invoice_assoc
        ];

        dd(1,$new_invoice_data);
    }
}
