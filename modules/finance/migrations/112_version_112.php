<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_112 extends App_module_migration
{
    public function up()
    {
        $CI = &get_instance();
        /** UPDATE required = 1 na tabela customfields where slug = expenses_tipo_despesas OR slug = expenses_status*/
        $CI->db->query("UPDATE `".db_prefix()."customfields` SET required = 1 WHERE slug = 'expenses_tipo_despesas' OR slug = 'expenses_status'");
    }
}

