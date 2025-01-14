<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_113 extends App_module_migration
{
    public function up()
    {
        $CI = &get_instance();
        /** UPDATE required = 1 na tabela customfields where slug = expenses_tipo_despesas OR slug = expenses_status Custo Mercadorias Vendidas "options"=>'Fixa,Variável,Vendas,Investimento,Outras,Custo Mercadorias Vendidas'*/
        $CI->db->query("UPDATE `".db_prefix()."customfields` SET options = 'Fixa,Variável,Vendas,Investimento,Outras,Custo Mercadorias Vendidas' WHERE slug = 'expenses_tipo_despesas'");

        if (!$CI->db->table_exists(db_prefix().'bankstatements')) {
            $CI->db->query('CREATE TABLE `'.db_prefix().'bankstatements` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `idpaymentmodes` INT NOT NULL,
                `data` DATE NOT NULL,
                `descricao` TEXT NOT NULL,
                `valor` decimal(15,2),
                `saldo` decimal(15,2),
                `tipo` VARCHAR(50) NOT NULL,
                `conciliacao_id` INT(11) NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
            );');
        }
    }
}

