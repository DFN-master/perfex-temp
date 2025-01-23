<?php
/*
Module Name: Perfex CRM Finance
Description: Finance Module for Perfex CRM
Author: Diletec
Author URI: https://www.diletec.com.br
*/

defined('BASEPATH') or exit('No direct script access allowed');
define('VERSIONING_FINANCE', get_instance()->app_scripts->core_version());

hooks()->add_action('app_admin_head', 'finance_add_head_components');
hooks()->add_action('app_admin_footer', 'finance_add_footer_components');


function finance_add_head_components()
{
    // Mutual files for both chat views
    echo '<link href="' . base_url('modules/finance/assets/css/style.css') . '" rel="stylesheet" type="text/css"/>';
}

function finance_add_footer_components()
{
    // loaded files js and css
    echo '<script type="text/javascript" src="' . base_url('modules/finance/assets/js/finance.js') . '" /></script>';
}