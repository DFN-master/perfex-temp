<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Automação de CEP e CNPJ
Description: Module de integração de CEP e CNPJ
Version: 1.0.0
Requires at least: 3.0.0
Author: Diletec
Author URI: https://cp.diletec.com.br/produto/automacao-de-dados-cep-e-cnpj
*/

define('CEPCNPJ_VERSIONING', get_instance()->app_scripts->core_version());

/**hook add footer js */
hooks()->add_action('app_admin_footer', 'cepcnpj_add_footer_components');
hooks()->add_action('app_customers_footer', 'cepcnpj_add_footer_components');
function cepcnpj_add_footer_components()
{
    // loaded files js and css
    echo '<script type="text/javascript" src="' . base_url('modules/cepcnpj/assets/js/cepcnpj.js?v='.CEPCNPJ_VERSIONING) . '" /></script>';
}
//app_customers_footer