<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Connect Efí
Description: Módulo Recebimento Efí para Perfex CRM - Gateway com recebimentos em PIX, boleto e cartão de crédito.
Version: 1.0.3
Requires at least: 1.0.*
 Author: Nando Cardoso - Connect Designers
Author URI: https://connectdesigners.com.br
*/

define('GERENCIANET_GATEWAY_MODULE_NAME', 'gerencianet_gateway');

$CI = &get_instance();

/**
 * Load the module helper
 */
$CI->load->helper(GERENCIANET_GATEWAY_MODULE_NAME . '/gerencianet_gateway');

/**
 * Register activation module hook
 */
register_activation_hook(GERENCIANET_GATEWAY_MODULE_NAME, 'gerencianet_gateway_activation_hook');

function gerencianet_gateway_activation_hook()
{
    require_once(__DIR__ . '/install.php');
}

/**
 * Actions for inject the custom styles
 */
hooks()->add_filter('module_gerencianet_gateway_action_links', 'module_gerencianet_gateway_action_links');

hooks()->add_filter('before_render_payment_gateway_settings', 'module_gerencianet_payment_gateway_settings');

function module_gerencianet_payment_gateway_settings()
{
?>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if (!document.getElementById('max-valor-juros')) {
                $('div').find('label[for*=juros]').append("<p id='max-valor-juros' style='color:red'>*O máximo valor de juros deve ser igual a 0,033.</p>");
                $('div').find('input[id*=juros]').attr({
                    maxLength: 5,
                    type: "number",
                    step: "0.001",
                    max: "0.033"
                })
            }
            if (!document.getElementById('max-valor-multa')) {
                $('div').find('label[for*=gerencianet_multa]').append("<p id='max-valor-multa' style='color:red'>*O máximo valor de multa deve ser igual a 2.</p>");
                $('div').find('input[id*=gerencianet_multa]').attr({
                    maxLength: 5,
                    type: "number",
                    step: "0.1",
                    max: "2"
                })
            }
        });
    </script>
<?php
    echo "<p style='color:green;'>Se você quiser usar as configurações de Juros e Multas do painel do Gerência net, você pode deixar os campos com os valores iguais a zero.</p>";
}

/**
 * Add additional settings for this module in the module list area
 * @param  array $actions current actions
 * @return array
 */
function module_gerencianet_gateway_action_links($actions)
{
    $actions[] = '<a href="' . admin_url('settings?group=payment_gateways&tab=online_payments_gerencianet_tab') . '">' . _l('settings') . '</a>';

    return $actions;
}

hooks()->add_action('admin_init', 'my_module_init_menu_items');

function my_module_init_menu_items()
{
    $CI = &get_instance();
}

/**
 * Delete all email builder options on uninstall
 */
register_uninstall_hook(GERENCIANET_GATEWAY_MODULE_NAME, 'gerencia_net_uninstall_hook');

function gerencia_net_uninstall_hook()
{

    // if (file_exists('application/libraries/gateways/Gerencianet_gateway.php')) {
    unlink('application/libraries/gateways/Gerencianet_gateway.php');
    // }
}

register_payment_gateway('gerencianet_gateway', 'gerencianet_gateway');

hooks()->add_action('after_invoice_added', 'gerencianet_gateway_after_invoice_added');

function gerencianet_gateway_after_invoice_added($insert_id)
{
    $CI = &get_instance();
    $CI->load->library('gerencianet_gateway/gerencianet_gateway');
    $CI->load->model('invoices_model');
    $invoice = $CI->invoices_model->get($insert_id);

    $allowed_payment_modes = unserialize($invoice->allowed_payment_modes);

    if (in_array('gerencianet', $allowed_payment_modes)) {
        $billet = $CI->gerencianet_gateway->create_billet($invoice);
    }
}
