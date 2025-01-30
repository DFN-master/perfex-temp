<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_102 extends App_module_migration
{
     public function up()
     {
          $CI = &get_instance();

          /**tabela de log cepcnpj */
          if (!$CI->db->table_exists(db_prefix() . 'cepcnpj_log')) {
               $CI->db->query('CREATE TABLE `' . db_prefix() . 'cepcnpj_log` (
                    `idcepcnpj_log` INT NOT NULL AUTO_INCREMENT,
                    `idcliente` INT NOT NULL,
                    `acao` VARCHAR(255) NULL,
                    `antes` TEXT NULL,
                    `depois` TEXT NULL,
                    `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `view` INT NULL DEFAULT 0,
                    PRIMARY KEY(`idcepcnpj_log`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               ');
          }
     }
}