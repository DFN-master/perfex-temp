<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_102 extends App_module_migration
{
     public function up()
     {
          //Remover desconto option iaf_remover_desconto
          if(get_option('iaf_remover_desconto') == '' OR get_option('iaf_remover_desconto') == null){
               add_option('iaf_remover_desconto', 0);
          }
     }
}