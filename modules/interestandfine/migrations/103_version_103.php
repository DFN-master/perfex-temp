<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_103 extends App_module_migration
{
     public function up()
     {
          //Remover desconto option iaf_carencia
          if(get_option('iaf_carencia') == '' OR get_option('iaf_carencia') == null){
               add_option('iaf_carencia', 0);
          }
     }
}