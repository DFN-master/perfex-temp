<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cepcnpj extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function out(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            redirect($url);
            exit;
        }else{
            redirect(admin_url('cepcnpj/atualizacoes'));
            exit;
        }
    }

}