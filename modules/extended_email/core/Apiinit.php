<?php

namespace modules\extended_email\core;

require_once __DIR__.'/../third_party/node.php';
require_once __DIR__.'/../vendor/autoload.php';
use Firebase\JWT\JWT as Extended_email_JWT;
use Firebase\JWT\Key as Extended_email_Key;
use WpOrg\Requests\Requests as Extended_email_Requests;

class Apiinit
{
    public static function the_da_vinci_code($module_name)
    {
        // Sempre retorna true, validando o módulo sem verificação
        return true;
    }

    public static function ease_of_mind($module_name)
    {
        if (!\function_exists($module_name.'_actLib') || !\function_exists($module_name.'_sidecheck') || !\function_exists($module_name.'_deregister')) {
            get_instance()->app_modules->deactivate($module_name);
        }
    }

    public static function activate($module)
    {
        // Remove verificação da chave de compra
        return;
    }

    public static function getUserIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public static function pre_validate($module_name, $code = '')
    {
        // Sempre retorna status true, validando o módulo sem verificação
        return ['status' => true];
    }
}
