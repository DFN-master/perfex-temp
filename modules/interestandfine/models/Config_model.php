<?php
defined('BASEPATH') or exit('No direct script access allowed');
// header('Content-Type: text/html; charset=utf-8');

class Config_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateConfig($dados)
    {
        $multa= $dados["multa"];
        $juros= $dados["juros"];
        $carencia= $dados["carencia"];
        /**Verificar se é int ou float */
        if(is_numeric($multa)){
            $multa = number_format($multa, 2, '.', '');
        }
        /**substituir , por . */
        $multa = str_replace(",", ".", $multa);

        /**Verificar se é int ou float */
        if(is_numeric($juros)){
            $juros = number_format($juros, 2, '.', '');
        }
        /**substituir , por . */
        $juros = str_replace(",", ".", $juros);

        $this->db->set('value', $juros, FALSE);
        $this->db->where('name', "iaf_juros");
        $this->db->update(db_prefix().'options');

        $this->db->set('value', $multa, FALSE);
        $this->db->where('name', "iaf_multa");
        $this->db->update(db_prefix().'options');

        $this->db->set('value', $carencia, FALSE);
        $this->db->where('name', "iaf_carencia");
        $this->db->update(db_prefix().'options');

        /**update remover desconto */
        if(isset($dados["remover_desconto"])){
            $this->db->set('value', $dados["remover_desconto"], FALSE);
            $this->db->where('name', "iaf_remover_desconto");
            $this->db->update(db_prefix().'options');
        }

        header("Location: ?post=true");
    }

    public function custom_sanitize_string($input) {
        return preg_replace('/[^\p{L}\p{N}\s]/u', '', $input);
    }
}