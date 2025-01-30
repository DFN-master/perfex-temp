<?php

hooks()->add_action('app_init', CUSTOMERS_API_MODULE.'_actLib');
function customers_api_actLib()
{
    $CI = &get_instance();
    $CI->load->library(CUSTOMERS_API_MODULE.'/customers_api_aeiou');
    $envato_res = $CI->customers_api_aeiou->validatePurchase(CUSTOMERS_API_MODULE);
    if (!$envato_res) {
        set_alert('danger', 'One of your modules failed its verification and got deactivated. Please reactivate or contact support.');
    }
}

hooks()->add_action('pre_activate_module', CUSTOMERS_API_MODULE.'_sidecheck');
function customers_api_sidecheck ($module_name)
{
    if (CUSTOMERS_API_MODULE == $module_name['system_name']) {
        modules\customers_api\core\Apiinit::activate($module_name);
    }
}

hooks()->add_action('pre_deactivate_module', CUSTOMERS_API_MODULE.'_deregister');
function customers_api_deregister($module_name)
{
    if (CUSTOMERS_API_MODULE == $module_name['system_name']) {
        delete_option(CUSTOMERS_API_MODULE.'_verification_id');
        delete_option(CUSTOMERS_API_MODULE.'_last_verification');
        delete_option(CUSTOMERS_API_MODULE.'_product_token');
        delete_option(CUSTOMERS_API_MODULE.'_heartbeat');
    }
}
