<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_107 extends App_module_migration
{
     public function up()
     {
          /**
          * 0 = Primeira letra maiuscula o resto minuscula
          * 1 = Tudo em Maiuscula
          * 2 = Tudo em Minuscula
          */
          add_option('cepcnpj_font_company', 0);
     }
}