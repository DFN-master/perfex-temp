<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aporte_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAportes(){
        $dados = $this->db->get(db_prefix().'finance_aporte')->result_array();
        $format = get_option('dateformat');
        $format = explode("|", $format)[0];
        foreach($dados as $key => $value){
            $date = DateTime::createFromFormat('Y-m-d', $value['date']);
            $dados[$key]['date'] = $date->format($format);
        }
        return $dados;
    }

    public function postAportes($dados){
        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        foreach ($dados as $key => $value) {
            $this->db->where('cpf_cnpj', $value['cpf_cnpj']);
            $verify = $this->db->get(db_prefix().'finance_aporte')->result_array();
            $date_pri = DateTime::createFromFormat($format, $value["date"]);
            $dados[$key]['date'] = $date_pri->format('Y-m-d');
            if(isset($verify[0])){
                unset($dados[$key]);
            }
        }

        if(!empty($dados)){
            $this->db->insert_batch(db_prefix().'finance_aporte', $dados);
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function updateAportes($dados){
        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        $id = $dados['update'];
        unset($dados['update']);

        $date_pri = DateTime::createFromFormat($format, $dados["date"]);
        $dados['date'] = $date_pri->format('Y-m-d');

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'finance_aporte', $dados);

        return $id;
    }

    public function deleteAportes($id){
        $this->db->where('id', $id);
        $this->db->delete(db_prefix().'finance_aporte');

        header("Location: ?deleted=true");
    }

}