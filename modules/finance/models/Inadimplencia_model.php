<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inadimplencia_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIna(){
        $this->db->join(db_prefix() . 'clients', 'userid = clientid');
        $this->db->where('status', '1');
        $this->db->or_where('status', '4');
        $dados = $this->db->get(db_prefix() . 'invoices')->result_array();

        $keys = array_column($dados, 'company');
        $ids = array_column($dados, 'userid');
        $QTYs = array_column($dados, 'total');
        $result = [];
        foreach($ids as $k => $v)
        {
            if(!isset($result[$keys[$k]])){
                $result[$keys[$k]] = [];
                $result[$keys[$k]]['total'] = 0;
                $result[$keys[$k]]['qntd'] = 0;
            }
            $result[$keys[$k]]['total'] += $QTYs[$k];
            $result[$keys[$k]]['id'] = $v;
            $result[$keys[$k]]['qntd']++;
        }

       
        return $result;
    }
}