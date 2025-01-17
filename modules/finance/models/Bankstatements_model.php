<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bankstatements_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->order_by('data','DESC')->get('bankstatements')->result();
    }

    public function getNoConcilied()
    {
        return $this->db->where('conciliacao_id', null)->order_by('data','DESC')->get('bankstatements')->result();
    }

    public function getDNoConcilied(){
        return $this->db->where('conciliacao_id', null)->where('tipo', 'D')->order_by('data','DESC')->get('bankstatements')->result();
    }

    public function add($data)
    {
        $this->db->insert(db_prefix().'bankstatements', $data);
        return $this->db->insert_id();
    }

    public function conciliar($id, $value){
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'bankstatements', ['conciliacao_id' => $value]);
    }
}