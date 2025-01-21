<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Finance
Description: Module financers in Perfex.
Version: 1.1.4
Requires at least: 2.3.*
*/

define('FINANCE_MODULE_NAME', 'finance');
update_option('module_finance_prodid', 35);

$CI = &get_instance();
hooks()->add_action('admin_init', 'finance_permissions');

$CI->load->library('finance/HooksFinance');
$CI->hooksfinance->load();

function finance_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
            'create' => _l('permission_create'),
            'edit'   => _l('permission_edit'),
            'delete' => _l('permission_delete'),
            'inter' => _l('permission_inter'),
    ];

    register_staff_capabilities('finance', $capabilities, _l('finance'));
}

/**
 * Register the activation chat
 */
// register_activation_hook(FINANCE_MODULE_NAME, 'finance_activation_hook');

/**
 * Register new menu item in sidebar menu
 */
if (has_permission(FINANCE_MODULE_NAME, '', 'view')) {

    $CI->app_menu->add_sidebar_menu_item('finance-menu-item-utilities', [
        'name'     => _l('title_finance'), // The name if the item
        'collapse' => true, // Indicates that this item will have submitems
        'href'     => admin_url('finance/'),
        'position' => 5, // The menu position
        'icon'     => 'fa gestion_finance', // Font awesome icon
    ]);

    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'inadimplencia', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Inadimplências', // The name if the item
        'href'     => admin_url('finance/inadimplencia'), // URL of the item
        'position' => 3, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    // The first paremeter is the parent menu ID/Slug
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'caixa', // Required ID/slug UNIQUE for the child menu
        'name'     => _l('caixa'), // The name if the item
        'href'     => admin_url('finance/caixa'), // URL of the item
        'position' => 1, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    // The first paremeter is the parent menu ID/Slug
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'dre', // Required ID/slug UNIQUE for the child menu
        'name'     => 'DRE', // The name if the item
        'href'     => admin_url('finance/dre'), // URL of the item
        'position' => 2, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    // The first paremeter is the parent menu ID/Slug
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'abc', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Curva ABC', // The name if the item
        'href'     => admin_url('finance/abc'), // URL of the item
        'position' => 6, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    // The first paremeter is the parent menu ID/Slug
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'Riscos', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Riscos', // The name if the item
        'href'     => admin_url('finance/riscos'), // URL of the item
        'position' => 7, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    /**Menu Previsões */
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'previsoes', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Previsões', // The name if the item
        'href'     => admin_url('finance/previsoes'), // URL of the item
        'position' => 4, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    /**Menu Tipos */
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'tipos', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Tipos de Contas', // The name if the item
        'href'     => admin_url('finance/tipos'), // URL of the item
        'position' => 10, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    /**Menu Aportes */
    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'slug'     => 'aporte', // Required ID/slug UNIQUE for the child menu
        'name'     => 'Aporte', // The name if the item
        'href'     => admin_url('finance/aporte'), // URL of the item
        'position' => 9, // The menu position
        //'icon'     => 'fa fa-exclamation', // Font awesome icon
    ]);

    /**Menu Despesas do Inter */
    // $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
    //     'name'     => 'Despesas', // The name if the item
    //     'slug'     =>  'despesas', // Indicates that this item will have submitems
    //     'href'     => admin_url('finance/despesas'),
    //     'position' => 5, // The menu position
    //     //'icon'     => 'fa gestion_finance', // Font awesome icon
    // ]);

    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'name'     => 'A Pagar ', // The name if the item
        'slug'     =>  'apagar', // Indicates that this item will have submitems
        'href'     => admin_url('finance/apagar'),
        'position' => 5, // The menu position
        //'icon'     => 'fa gestion_finance', // Font awesome icon
    ]);

    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'name'     => 'A Receber', // The name if the item
        'slug'     =>  'areceber', // Indicates that this item will have submitems
        'href'     => admin_url('finance/areceber'),
        'position' => 5, // The menu position
        //'icon'     => 'fa gestion_finance', // Font awesome icon
    ]);

    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'name'     => 'Extrato', // The name if the item
        'slug'     =>  'extrato', // Indicates that this item will have submitems
        'href'     => admin_url('finance/extrato'),
        'position' => 5, // The menu position
        //'icon'     => 'fa gestion_finance', // Font awesome icon
    ]);

    $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
        'name'     => 'Conciliação de Extrato',
        'slug'     =>  'depesas-import',
        'href'     => admin_url('finance/despesas/conciliacao'),
        'position' => 5
    ]);

    $CI->app_menu->add_setup_menu_item('config', [
        'slug'     => 'config',
        'name'     => 'Configurações Financeiras',
        'position' => 65,
        'href' => admin_url('finance/config')
    ]);
}

if(has_permission(FINANCE_MODULE_NAME, '', 'inter')) {
    $inter = $CI->db->where('module_name', 'boletointer')->where('active', 1)->get(db_prefix() .'modules')->result_array();
    $email = $CI->db->where('staffid', get_staff_user_id())->get(db_prefix() .'staff')->result_array()[0]['email'];

    if(!empty($inter) && get_option('paymentmethod_bancointer_accessEmailInter') == $email){
        $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
            'slug'     => 'inter', // Required ID/slug UNIQUE for the child menu
            'name'     => 'Extrato Inter', // The name if the item
            'href'     => admin_url('finance/inter'), // URL of the item
            'position' => 8, // The menu position
            //'icon'     => 'fa fa-exclamation', // Font awesome icon
        ]);
    }elseif(!empty($inter) AND get_option('paymentmethod_bancointer_accessEmailInter') == ''){
        $CI->app_menu->add_sidebar_children_item('finance-menu-item-utilities', [
            'slug'     => 'inter', // Required ID/slug UNIQUE for the child menu
            'name'     => 'Extrato Inter', // The name if the item
            'href'     => admin_url('finance/inter'), // URL of the item
            'position' => 8, // The menu position
            //'icon'     => 'fa fa-exclamation', // Font awesome icon
        ]);
    }
}

hooks()->add_action('admin_init', 'finance_menu_item');

function finance_menu_item()
{
	$capabilities = [];
    $capability = '';

	$capabilities['capabilities'] = [
		$capability => _l('finance_grant_access_label'),
	];

	register_staff_capabilities(FINANCE_MODULE_NAME, $capabilities, _l('finance_access_label'));
}

/** */
// function finance_load_dre(){
    // $CI = &get_instance();
    // $CI->load->model('finance/dre_model');
    // $CI->load->view('finance/dre');
// }

register_language_files(FINANCE_MODULE_NAME, ['finance']);

/**
 * Load the finance helper
 */
$CI->load->helper(FINANCE_MODULE_NAME . '/finance');

/**
* Register activation module hook
*/
register_activation_hook(FINANCE_MODULE_NAME, 'finance_module_activation_hook');
function finance_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**Activate */
hooks()->add_action('pre_activate_module', 'finance_preactivate');
function finance_preactivate($module_name){
    if ($module_name['system_name'] == FINANCE_MODULE_NAME) {
        $CI = &get_instance();
        $data['submit_url'] = $module_name['system_name'].'/diletec/activate';
        $data['original_url'] = admin_url('modules/activate/'.FINANCE_MODULE_NAME);
        $data['module_name'] = FINANCE_MODULE_NAME;
        $data['title'] = "Module License Activation";
        $token = get_option('module_finance_purchase_key');
        $prodId = get_option('module_finance_prodid');
        if($token AND $prodId){
            $CI->load->library(FINANCE_MODULE_NAME.'/HooksFinance');
            if($CI->hooksfinance->verify()){
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