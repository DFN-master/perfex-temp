<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riscos_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  integer (optional)
     * @return object
     * Get single goal
     */
    public function riscos(){
        $ano = date('Y');
        
        /**
         * Entradas
         */
        $ent = 0; 
        $query = $this->db->query('SELECT ' . db_prefix() . 'invoices.duedate, ' . db_prefix() . 'invoices.total FROM ' . db_prefix() . 'invoices WHERE ' . db_prefix() . 'invoices.status != 5 AND date like ' .'"%'.$ano.'%" OR '. db_prefix() . 'invoices.status != 6 AND duedate like ' .'"%'.$ano.'%"'); //status 5 = Cancelado e 6 = racunho
        $entradas = $query->result_array();
        foreach ($entradas as $key) {
            //$invoices[] = $key['total'];
            $ent = $ent + $key['total'];
        }
        
        /**
         * Saidas
         */
        $sai = 0;
        $queryDespesas = $this->db->query('SELECT * FROM ' . db_prefix() . 'expenses WHERE date like ' .'"%'.$ano.'%"');
        $despesas = $queryDespesas->result_array();
        foreach ($despesas as $key) {
            //$expenses[] = $key['amount'];
            $sai = $sai + $key['amount'];
        }
        
        $limit = $ent - $sai;
        
        /**20% da base e 80% do faturamento*/
        $a = array();
        
        /**30% da base e 15% do faturamento*/
        $b = array();
        
        /**50% da base e 5% do faturamento*/
        $c = array();
        
        /**
         * ABC
         */
        /**
        SELECT cl.company, SUM(inv.total) AS `totalfull` FROM `tblinvoices` as inv INNER JOIN  
        `tblclients` as cl ON (inv.clientid = cl.userid)
        WHERE `duedate` like '%2021%'
        GROUP BY `clientid` ORDER BY totalfull 
        */ 
        $queryAbc = $this->db->query('SELECT cl.company, SUM(inv.total) AS `totalfull` FROM ' . db_prefix() . 'invoices as inv INNER JOIN
        ' . db_prefix() . 'clients as cl ON (inv.clientid = cl.userid)
        WHERE duedate like ' .'"%'.$ano.'%"
        GROUP BY clientid ORDER BY totalfull DESC
        ');
        $abc = $queryAbc->result_array();
        
        $risco = array();
        foreach ($abc as $key) {
            if( ( (string)$ent - (string)$key['totalfull'] ) < (string)$sai){
                array_push($risco, $key);
            }
        }
        
        return [
            'risco' => $risco,
            'entrada' => $ent,
            'saida' => $sai
        ];
    } 
     
     
}