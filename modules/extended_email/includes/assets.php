<?php

// Remover verificação de cache comentada

hooks()->add_action('app_init', EXTENDED_EMAIL_MODULE.'_actLib');
function extended_email_actLib()
{
    $CI = &get_instance();
    $CI->load->library(EXTENDED_EMAIL_MODULE.'/extended_email_aeiou');
    // Remover validação de compra
    /*
    $envato_res = $CI->extended_email_aeiou->validatePurchase(EXTENDED_EMAIL_MODULE);
    if (!$envato_res) {
        set_alert('danger', 'One of your modules failed its verification and got deactivated. Please reactivate or contact support.');
    }
    */
}

hooks()->add_action('pre_activate_module', EXTENDED_EMAIL_MODULE.'_sidecheck');
function extended_email_sidecheck($module_name)
{
    if (EXTENDED_EMAIL_MODULE == $module_name['system_name']) {
        // Remover ativação do módulo comentada
        //modules\extended_email\core\Apiinit::activate($module_name);
    }
}

hooks()->add_action('pre_deactivate_module', EXTENDED_EMAIL_MODULE.'_deregister');
function extended_email_deregister($module_name)
{
    if (EXTENDED_EMAIL_MODULE == $module_name['system_name']) {
        delete_option(EXTENDED_EMAIL_MODULE.'_verification_id');
        delete_option(EXTENDED_EMAIL_MODULE.'_last_verification');
        delete_option(EXTENDED_EMAIL_MODULE.'_product_token');
        delete_option(EXTENDED_EMAIL_MODULE.'_heartbeat');
    }
}

// Remover desativação do módulo durante a atualização
/*
hooks()->add_action('before_perform_update', 'deactivate_extended_email_module');
function deactivate_extended_email_module($latest_version)
{
    $CI = &get_instance();
    $CI->app_modules->deactivate('extended_email');
}
*/

// Remover chamada comentada para ease_of_mind
//\modules\extended_email\core\Apiinit::ease_of_mind(EXTENDED_EMAIL_MODULE);
