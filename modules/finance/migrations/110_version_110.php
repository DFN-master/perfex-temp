<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_110 extends App_module_migration
{
    public function up()
    {
        $CI =& get_instance();
        $dadosQuery = array(
            array('id' => '1','name' => 'Softwares','description' => ''),
            array('id' => '2','name' => 'Domínios','description' => 'Domínios como suamarca.com.br'),
            array('id' => '3','name' => 'Hosting','description' => 'Servidores'),
            array('id' => '4','name' => 'Cartório','description' => ''),
            array('id' => '5','name' => 'DAS','description' => 'Impostos sobre NF'),
            array('id' => '6','name' => 'Telefonia','description' => ''),
            array('id' => '7','name' => 'Luz','description' => ''),
            array('id' => '8','name' => 'Água','description' => ''),
            array('id' => '9','name' => 'Net','description' => ''),
            array('id' => '10','name' => 'Transporte','description' => ''),
            array('id' => '11','name' => 'Contabilidade','description' => ''),
            array('id' => '12','name' => 'Prefeitura','description' => ''),
            array('id' => '13','name' => 'Funcionários','description' => 'Despesas com Folha de Pagamento'),
            array('id' => '14','name' => 'Marketing','description' => 'Anúncios, eventos e outros.'),
            array('id' => '15','name' => 'GPS','description' => 'GUIA DA PREVIDÊNCIA SOCIAL - GPS'),
            array('id' => '16','name' => 'Ativos','description' => 'Imóveis, Equipamentos, Veículos, móveis e outros'),
            array('id' => '17','name' => 'Despesa Bancária','description' => 'Despesas com bancos, máquinas de cartão e outros'),
            array('id' => '18','name' => 'Retirada','description' => 'Retirada dos sócios'),
            array('id' => '19','name' => 'Cartão de Credito','description' => 'Pagamento de fatura de cartão de credito'),
            array('id' => '20','name' => 'DARF','description' => 'Guia GPS/INSS foi alterada para guia DARF'),
            array('id' => '21','name' => 'FGTS','description' => 'Fundo de Garantia do Tempo de Serviço')
        );

        $index = 0;
        $query = '';

        foreach ($dadosQuery as $key) {
            $result = $CI->db->query("SELECT * FROM `".db_prefix()."expenses_categories` WHERE name = '".$key['name']."'");
            $resultQuery = array();
            $resultQuery = $result->result_array();
            if(empty($resultQuery)) {
                if($index != 0){
                    $query .= ",";
                }else{
                    $query = "INSERT INTO `".db_prefix()."expenses_categories`
                    (`name`, `description`) VALUES ";
                }
                $query .= "('".$key['name']."', '".$key['description']."')";
                $index++;
            }
        }

        if(strlen($query) != 0){
            $CI->db->query($query);
        }

        if (!$CI->db->table_exists(db_prefix().'finance_tipo')) {
            $CI->db->query('CREATE TABLE `'.db_prefix().'finance_tipo` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `codigo_conta` INT NOT NULL ,
                `classificacao_conta` INT NOT NULL ,
                `nome_conta` VARCHAR(50) NOT NULL ,
                `tipo_conta` VARCHAR(11) NOT NULL ,
                PRIMARY KEY (`id`)
            );');
        }

        if (!$CI->db->table_exists(db_prefix().'finance_aporte')) {
            $CI->db->query('CREATE TABLE `'.db_prefix().'finance_aporte` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `socio` VARCHAR(50) NOT NULL ,
                `cpf_cnpj` VARCHAR(50) NOT NULL ,
                `comprovante` VARCHAR(50) NOT NULL ,
                `valor` decimal(15,2) ,
                `date` date NOT NULL,
                PRIMARY KEY (`id`)
            );');
        }

        /** Verificar se existe custom_fields transactionid para despesas na tabela tblcustomfields*/
        $result = $CI->db->query("SELECT * FROM `".db_prefix()."customfields` WHERE fieldto = 'expenses' AND slug = 'transactionid'");
        $resultQuery = array();
        $resultQuery = $result->result_array();
        if(empty($resultQuery)) {
            $CI->db->query(
                "INSERT INTO `".db_prefix()."customfields`
                    (`fieldto`, `name`, `slug`, `type`, `options`, `required`, `show_on_table`, `only_admin`, `field_order`, `active`, `disalow_client_to_edit`, `show_on_pdf`, `bs_column`, `default_value`, `display_inline`)
                VALUES
                    ('expenses', 'ID da Transação', 'transactionid', 'input', '', 0, 1, 0, 0, 1, 0, 1, 12, NULL, 0)");
        }

    }
}

