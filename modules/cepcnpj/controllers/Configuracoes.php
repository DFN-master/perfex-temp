<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Configuracoes extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cepcnpj/cepcnpj_model');
    }

    public function index()
    {
        $data['title'] = _l('Configurações');
        $this->load->view('cepcnpj/configuracoes', $data);
    }

    public function save()
    {
        $data = filter_var_array($this->input->post());
        $up = 0;
        foreach ($data as $key => $value) {
            if($key == 'csrf_token_name'){
                continue;
            }
            update_option($key, $value);
            $up++;
        }
        if($up > 0){
            set_alert('success', _l('Configurações salvas com sucesso'));
        }
        redirect(admin_url('cepcnpj/configuracoes'));
    }

}