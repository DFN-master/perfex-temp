<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cepcnpj_model extends App_Model
{
    public function getLog($id = null, $where = [])
    {
        if($id){
            $this->db->where('idcepcnpj_log', $id);
        }

        if(!empty($where)){
            $this->db->where($where);
        }

        /**Inner Join Cliente */
        $this->db->select('cepcnpj_log.*, clients.company');
        $this->db->join('clients', 'clients.userid = cepcnpj_log.idcliente', 'left');

        $this->db->order_by('idcepcnpj_log', 'desc');
        return $this->db->get('cepcnpj_log')->result();
    }

    public function insertLog($data)
    {
        $this->db->insert('cepcnpj_log', $data);
        return $this->db->insert_id();
    }

    /**getCountLog where view 0*/
    public function getCountLog()
    {
        if (!$this->db->table_exists(db_prefix() . 'cepcnpj_log')) {
            return 0;
        }
        try{
            $this->db->where('view', 0);
            return $this->db->count_all_results('cepcnpj_log');
        }catch(Exception $e){
            return 0;
        }
    }

    /**check view */
    public function checkView($id)
    {
        if(is_array($id)){
            $this->db->where_in('idcepcnpj_log', $id);
        }elseif($id){
            $this->db->where('idcepcnpj_log', $id);
        }else{
            return false;
        }
        $this->db->update('cepcnpj_log', ['view' => 1]);
    }

    /**delete $ids = [] */
    public function delete($ids = [])
    {
        if(is_array($ids)){
            $this->db->where_in('idcepcnpj_log', $ids);
        }elseif($ids){
            $this->db->where('idcepcnpj_log', $ids);
        }else{
            return false;
        }
        $this->db->delete('cepcnpj_log');
    }
}