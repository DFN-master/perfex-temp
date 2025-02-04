<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Juros e Multas
Description: Modulo de atualização de juros e multas.
Version: 1.0.5
Requires at least: 2.3.*
Author: Nando Cardoso - Connect Designers
Author URI: https://connectdesigners.com.br
*/

define('INTERESTANDFINE_MODULE_NAME', 'interestandfine');
register_activation_hook(INTERESTANDFINE_MODULE_NAME, 'interestandfine_module_activation_hook');
register_language_files(INTERESTANDFINE_MODULE_NAME, [INTERESTANDFINE_MODULE_NAME]);

function interestandfine_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

$CI = &get_instance();
$custonfilds = array();

/**
 * Load the Interestand Fine helper
 */
$CI->load->helper(INTERESTANDFINE_MODULE_NAME . '/interestandfine');
$CI->load->library(INTERESTANDFINE_MODULE_NAME . '/CronTax');
$CI->crontax->loadCron();

hooks()->add_action('admin_init', 'interestandfine_menu_iten_profile');
function interestandfine_menu_iten_profile()
{
    $CI = &get_instance();

    $CI->app_menu->add_sidebar_menu_item('admin-interestandfine', [
        'name'     => _l('Interest_and_Fine'), // The name if the item
        'collapse' => 2, // Indicates that this item will have submitems
        'position' => 10, // The menu position
        'icon'     => 'fa fa-file-text', // Font awesome icon
    ]);

    $CI->app_menu->add_sidebar_children_item('admin-interestandfine', [
        'slug'     => 'interestandfine-config', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Configurações', // The name if the item
        'href'     => admin_url('interestandfine/config'), // URL of the item
        'position' => 1, // The menu position
    ]);
}