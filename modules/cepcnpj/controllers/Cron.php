<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends App_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(CEPCNPJ_MODULE_NAME . '/Croncepcnpj');
    }

    public function index()
    {
        if(get_option('diletec_cron_cep_run')){
            exit("Desative o uso da CRON para rodar essa opção");
        }
        $this->croncepcnpj->cronsCepCnpjupdateDados();
    }
}