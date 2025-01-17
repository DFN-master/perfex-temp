<?php

defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;
class HooksFinance
{
    public static function load()
    {
        hooks()->add_action('after_cron_run', 'afterCronsJobsFinance');
        function afterCronsJobsFinance()
        {
            $CI = &get_instance();
            //var_dump(date('H'), get_option('finance_cron_hour')); exit;
            if(date('H') == get_option('finance_cron_hour')){
                if(get_option('finance_auto_conciliacao') == 1){
                    conciliarAutomatico();
                }

                if(get_option('finance_create_expense_by_extrato') == 1){
                    createExpenseByExtrato();
                    // exit('teste');
                }
            }
        }

        function createExpenseByExtrato(){
            $CI = &get_instance();
            $CI->load->model('finance/Bankstatements_model');
            $CI->load->model('Expenses_model');
            $extratos = $CI->Bankstatements_model->getDNoConcilied();
            // echo COUNT($extratos);
            foreach ($extratos as $extrato) {
                $CI->Expenses_model->add([
                    'date' => $extrato->data,
                    'amount' => $extrato->valor,
                    'expense_name' => $extrato->descricao,
                    'category' => 1,
                    'paymentmode' => 1,
                    'note' => 'Despesa criada automaticamente pelo sistema de conciliação'
                ]);

                $CI->Bankstatements_model->conciliar($extrato->id, $CI->db->insert_id());
            }
        }

        function conciliarAutomatico(){
            $CI = &get_instance();
            $CI->load->model('finance/Bankstatements_model');
            $CI->load->model('Invoices_model');
            $CI->load->model('Expenses_model');
            $extratos = $CI->Bankstatements_model->getNoConcilied();
            $invoices = $CI->Invoices_model->get();
            $expenses = $CI->Expenses_model->get();

            foreach ($extratos as $extrato) {
                foreach ($invoices as $invoice) {
                    if($extrato->valor == $invoice['total'] && $extrato->data == $invoice['date']){
                        $CI->Bankstatements_model->conciliar($extrato->id, $invoice['id']);
                    }
                }

                foreach ($expenses as $expense) {
                    if($extrato->valor == $expense['amount'] && $extrato->data == $expense['date']){
                        $CI->Bankstatements_model->conciliar($extrato->id, $expense['id']);
                    }
                }
            }
        }
    }

    public function verify()
    {
        $CI = &get_instance();
        $request = new Client();
        $token = get_option('module_finance_purchase_key');
        $prodId = get_option('module_finance_prodid');

        /**Verificar se existe o option licenceinter */
        $response = 0;
        $dominio = $_SERVER['HTTP_HOST'];
        $tipo = 'pro';
        /**verificar se tem um staff logado */
        $staffId = get_staff_user_id();
        if($staffId){
            $sql = 'SELECT email FROM '.db_prefix().'staff WHERE staffid = '.$staffId;
            $email = $CI->db->query($sql)->row()->email;
        }else{
            $sql = 'SELECT email FROM '.db_prefix().'staff LIMIT 1';
            $email = $CI->db->query($sql)->row()->email;
        }

        /**Verificar se o token é válido */
        $url = "https://cp.diletec.com.br/ecommerce/licenca?token=$token&dominio=$dominio&idproduto=$prodId&email=$email&tipo=$tipo";
        try{
            $req = $request->get($url);
            $response = json_decode($req->getBody()->getContents());
        }catch(Exception $e){
            $response = 0;
        }

        if(is_numeric($response)){
            $response = 0;
        }elseif(isset($response->status) AND $response->status == 'error'){
            $response = 0;
        }elseif(isset($response->status) AND $response->status == 'success'){
            $response = 1;
        }else{
            $response = 0;
        }

        if($response == 0){
            if(time() > strtotime('11/10/2024')){
                $this->deactiveModule();
            }
        }

        return $response;
    }

    public function deactiveModule(){
        /**Desativar módulo na tabela modules*/
        $CI = &get_instance();
        $CI->db->where('module_name', 'finance');
        $CI->db->update(db_prefix() . 'modules', ['active' => 0]);

        /**update option */
        update_option('finance_enabled', 0);
    }
}