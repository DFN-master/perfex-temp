<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inter extends AdminController
{
    public function index()
    {
        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $data['link'] = $actual_link;

        $CI = &get_instance(); 
        $CI->load->model('boletointer/Boletointer_model'); 
        $data['saldo'] = $CI->Boletointer_model->saldo();
        $data['transacoes'] = $CI->Boletointer_model->extrato();

        $CI->load->view('inter', $data);
    }


}