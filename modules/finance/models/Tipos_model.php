<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipos_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTipos(){
        return $this->db->get(db_prefix().'finance_tipo')->result_array();
    }

    public function postTipos($dados){
        foreach ($dados as $key => $value) {
            $this->db->where('codigo_conta', $value['codigo_conta']);
            $verify = $this->db->get(db_prefix().'finance_tipo')->result_array();
            if(isset($verify[0])){
                unset($dados[$key]);
            }
        }

        if(!empty($dados)){
            $this->db->insert_batch(db_prefix().'finance_tipo', $dados);
            header("Location: ?import=true");
        }else{
            header("Location: ?import=false");
        }
    }

    public function updateTipos($dados){
        $id = $dados['update'];
        unset($dados['update']);

        $this->db->where('id', $id);
        $this->db->update(db_prefix().'finance_tipo', $dados);

        if($this->db->affected_rows() > 0){
            header("Location: ?edited=true");
        }else{
            header("Location: ?edited=false");
        }
    }

    public function deleteTipos($id){
        $this->db->where('id', $id);
        $this->db->delete(db_prefix().'finance_tipo');

        header("Location: ?deleted=true");
    }

}