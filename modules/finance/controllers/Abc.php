<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Abc extends AdminController
{
    public function index()
    {
        $CI = &get_instance();
        
        // $CI->load->model('finance/license_model');
        // if($CI->license_model->license() == false){ echo 'Entre em contato com o suporte da Diletec.'; return false;}
        // $data["license"] =  $CI->license_model->license();
        
        $CI->load->model('finance/abc_model');
        $abc = $CI->abc_model->abc();
        $CI->load->view('abc', $abc);
        
    }
    
    
}