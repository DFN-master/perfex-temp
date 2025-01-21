<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Finance extends AdminController
{
    public function index()
    {
        $CI = &get_instance();
        $CI->load->view('finance/dre');

    }

    public function out(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            redirect($url);
            exit;
        }else{
            redirect(admin_url());
            exit;
        }
    }

}