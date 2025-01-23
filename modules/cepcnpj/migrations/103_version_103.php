<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_103 extends App_module_migration
{
     public function up()
     {
          if(!get_option('diletec_cron_cep_run')){
               add_option('diletec_cron_cep_run', 1);
          }
     }
}