<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: Interest and Fine
Description: Module modify filds in Perfex.
Version: 1.0.0
Requires at least: 2.3.*
*/

define('VERSIONING_INTERESTANDFINE', get_instance()->app_scripts->core_version());

hooks()->add_action('app_admin_footer', 'interestandfine_add_footer_components');
function interestandfine_add_footer_components()
{
    // loaded files js and css
    echo '<script type="text/javascript" src="' . base_url('modules/interestandfine/assets/js/interestandfine.js') . '" /></script>';
}