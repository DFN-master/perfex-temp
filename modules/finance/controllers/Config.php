<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Config extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Config_model');
    }

    public function index()
    {
        if($this->input->post()){
            $posted = $this->input->post();
            if($this->input->post('finance_auto_conciliacao') == null){
                $posted['finance_auto_conciliacao'] = 0;
            }

            if($this->input->post('finance_create_expense_by_extrato') == null){
                $posted['finance_create_expense_by_extrato'] = 0;
            }

            $this->Config_model->save($posted);
            set_alert('success', _l('atualizada com sucesso.', _l('Configurações')));
            redirect(admin_url('finance/config'));
        }
        
        $data = [];
        $this->load->view('config', $data);
    }

}