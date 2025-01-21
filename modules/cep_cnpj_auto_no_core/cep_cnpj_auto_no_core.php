<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Connect Cadastros
Description: O Módulo Connect Cadastros - Busca CEP & CNPJ Automático no Core oferece uma solução eficiente e conveniente para agilizar o processo de cadastro, fornecendo informações precisas de CEP e CNPJ de forma automática. Siga as orientações deste manual para aproveitar ao máximo os recursos oferecidos por este módulo.
Author: Nando Cardoso - Connect Designers
Version: 1.0.1
Requires at least: 3.0.*
Author URI: https://connectdesigners.com.br
*/

define('CEPCNPJAUTONOCORE_MODULE_NAME', 'cep_cnpj_auto_no_core');

$CI = &get_instance();
$CI->load->helper(CEPCNPJAUTONOCORE_MODULE_NAME . '/cep_cnpj_auto_no_core');

hooks()->add_action('app_admin_footer', 'cep_append_script');

function cep_append_script()
{
    $CI           = &get_instance();
    $uri          = $CI->uri->uri_string();
    $uris_allowed = [
        'admin/clients/client', 'admin/empresas/clients/client',
        'admin/empresas/client'
    ];
    $re           = "#admin\/empresas\/client\/\d+#";
    preg_match($re, $uri, $matches);

    if (in_array($uri, $uris_allowed) || !empty($matches)) {
        $CI->load->view('cep_cnpj_auto_no_core/includes/admin');
    }
}

hooks()->add_action('app_customers_footer', 'cep_append_script_clients');

function cep_append_script_clients()
{
    $CI = &get_instance();
    $uri          = $CI->uri->uri_string();
    $uris_allowed = [
        'authentication/register',
        'custom_login_vision/authentication/register'
    ];
    if (in_array($uri, $uris_allowed)) {
        $CI->load->view('cep_cnpj_auto_no_core/includes/client');
    }
}

/**
 * Register activation module hook
 */

register_activation_hook(CEPCNPJAUTONOCORE_MODULE_NAME, 'cep_cnpj_auto_no_core_module_activation_hook');

function cep_cnpj_auto_no_core_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

hooks()->add_filter('module_cep_cnpj_auto_no_core_action_links', 'module_cep_cnpj_auto_no_core_action_links');

/**
 * Add additional settings for this module in the module list area
 * @param  array $actions current actions
 * @return array
 */
function module_cep_cnpj_auto_no_core_action_links($actions)
{
    $actions[] = '<a href="' . admin_url('settings?group=cep_cnpj_auto_no_core_settings') . '">Configurações</a>';
    return $actions;
}

hooks()->add_action('admin_init', 'cep_cnpj_auto_no_core_add_settings_tab');

function cep_cnpj_auto_no_core_add_settings_tab()
{
    $CI = &get_instance();
    $CI->app->add_settings_section('cep_cnpj_auto_no_core_settings', [
        'name' => 'Mapeamento - CEP & CNPJ Automático',
        'view' => 'cep_cnpj_auto_no_core/config',
        'position' => 65,
    ]);
}
