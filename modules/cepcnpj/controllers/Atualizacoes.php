<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Atualizacoes extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cepcnpj/cepcnpj_model');
    }

    public function index()
    {
        $data['title'] = _l('Log de Atualização');
        $data['log'] = $this->cepcnpj_model->getLog();
        $this->load->view('cepcnpj/cepcnpj_log', $data);
    }

    public function view()
    {
        /**request ajax */
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->cepcnpj_model->checkView($id);
            // echo json_encode($this->cepcnpj_model->getLog($id));
        }
    }

    public function upcron()
    {
        if(get_option('diletec_cron_cep_run')){
            if(update_option('diletec_cron_cep_run', 0)){
                set_alert('success', _l('Atualizado com sucesso'));
            }else{
                set_alert('danger', _l('Erro ao atualizar'));
            }
        }else{
            if(update_option('diletec_cron_cep_run', 1)){
                set_alert('success', _l('Atualizado com sucesso'));
            }else{
                set_alert('danger', _l('Erro ao atualizar'));
            }
        }
        redirect(admin_url('cepcnpj/atualizacoes'));
    }

    /**delete ids = []*/
    public function delete($ids = [])
    {
        if (is_admin() OR has_permission('cepcnpj', '', 'delete')) {
            $ids = $this->input->post('ids');
            $this->cepcnpj_model->delete($ids);
            set_alert('success', _l('Deletado com sucesso'));
        }else{
            set_alert('danger', _l('Sem permissão'));
        }
        redirect(admin_url('cepcnpj/atualizacoes'));
    }
}