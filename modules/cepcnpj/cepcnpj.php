<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Connect CEP e CNPJ
Description: Modulo de integração de CEP e CNPJ para Perfex CRM
Version: 1.0.7
Requires at least: 3.0.0
Author: Nando Cardoso - Connect Designers
Author URI: https://connectdesigners.com.br
*/

define('CEPCNPJ_MODULE_NAME', 'cepcnpj');
$CI = &get_instance();
update_option('module_cepcnpj_prodid', 52);

/**
 * Register activation module hook
 */
register_activation_hook(CEPCNPJ_MODULE_NAME, 'cepcnpj_activation_hook');
function cepcnpj_activation_hook()
{
    require_once(__DIR__ . '/install.php');
}

hooks()->add_action('admin_init', 'cepcnpj_permissions');
function cepcnpj_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'delete' => _l('permission_delete'),
            'view' => _l('permission_view'),
    ];

    register_staff_capabilities('cepcnpj', $capabilities, _l('cepcnpj'));
}

/**Registrar menu */
hooks()->add_action('admin_init', 'cepcnpj_module_init_menu_items');
function cepcnpj_module_init_menu_items()
{
    $CI = &get_instance();
    /**load model */
    $CI->load->model(CEPCNPJ_MODULE_NAME . '/Cepcnpj_model');
    $bd = $CI->Cepcnpj_model->getCountLog();
    $noti = [];
    if($bd > 0){
        $noti = [
            'class' => 'badge-danger',
            'value' => $bd,
        ];
    }

    /**Permissão */
    if(has_permission('cepcnpj', '', 'view') OR is_admin()){
        $CI->app_menu->add_sidebar_menu_item('cepcnpj', [
            'slug'     => 'cepcnpj',
            'name'     => _l('CEP CNPJ'),
            'icon'     => 'fa fa-bank',
            'href'     => '#',
            'position' => 100,
            'badge'    => $noti,
        ]);

        // Add sub-menu items
        $CI->app_menu->add_sidebar_children_item('cepcnpj', [
            'slug'     => 'infoempresa',
            'name'     => _l('Atualização'),
            'href'     => admin_url('cepcnpj/atualizacoes'),
            'position' => 1,
        ]);

        /**configurações */
        $CI->app_menu->add_sidebar_children_item('cepcnpj', [
            'slug'     => 'cepcnpj-configuracoes',
            'name'     => _l('Configurações'),
            'href'     => admin_url('cepcnpj/configuracoes'),
            'position' => 2,
        ]);
    }

}

/**Activate */
hooks()->add_action('pre_activate_module', 'cepcnpj_preactivate');
function cepcnpj_preactivate($module_name){
    if ($module_name['system_name'] == CEPCNPJ_MODULE_NAME) {
        $CI = &get_instance();
        $data['submit_url'] = $module_name['system_name'].'/diletec/activate';
        $data['original_url'] = admin_url('modules/activate/'.CEPCNPJ_MODULE_NAME);
        $data['module_name'] = CEPCNPJ_MODULE_NAME;
        $data['title'] = "Module License Activation";
        $token = get_option('module_cepcnpj_purchase_key');
        $prodId = get_option('module_cepcnpj_prodid');
        if($token AND $prodId){
            $CI->load->library(CEPCNPJ_MODULE_NAME.'/Croncepcnpj');
            if($CI->croncepcnpj->verify()){
                return true;
            }else{
                echo $CI->load->view($module_name['system_name'].'/activate', $data, true);
                exit;
            }
        }else{
            echo $CI->load->view($module_name['system_name'].'/activate', $data, true);
            exit;
        }
    }
}

/**helpers */
$CI->load->helper(CEPCNPJ_MODULE_NAME . '/cepcnpj');

$CI->load->library(CEPCNPJ_MODULE_NAME . '/Croncepcnpj');
$CI->croncepcnpj->cronsCepCnpj();

register_language_files(CEPCNPJ_MODULE_NAME, [CEPCNPJ_MODULE_NAME]);