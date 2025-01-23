<?php

namespace modules\google_drive\core;

require_once __DIR__.'/../third_party/node.php';
require_once __DIR__.'/../vendor/autoload.php';
use Firebase\JWT\JWT as Google_drive_JWT;
use Firebase\JWT\Key as Google_drive_Key;
use WpOrg\Requests\Requests as Google_drive_Requests;

class Apiinit
{
    public static function the_da_vinci_code($module_name)
    {
        // Mantemos a estrutura, mas removemos a lógica de verificação da licença

        // Simular que o módulo foi verificado com sucesso
        $verified = true;

        // Mesmo sem a verificação, garantimos que o módulo continue ativo
        if (!$verified) {
            get_instance()->app_modules->deactivate($module_name);
        }

        return $verified;
    }

    /**
     * Verifica se funções críticas estão presentes, desativa o módulo se forem removidas.
     * 
     * @param  [string] $module_name [nome do módulo]
     * 
     * @return [void]
     */
    public static function ease_of_mind($module_name)
    {
        if (!\function_exists($module_name . '_actLib') || !\function_exists($module_name . '_sidecheck') || !\function_exists($module_name . '_deregister')) {
            get_instance()->app_modules->deactivate($module_name);
        }
    }

    /**
     * Exibe a tela de ativação do módulo, que será carregada.
     * 
     * @param  [string] $module [nome do módulo]
     * 
     * @return [void]
     */
    public static function activate($module)
    {
        // Aqui removemos a exigência de verificação da licença, ativando o módulo diretamente
        // O código foi simplificado para sempre considerar o módulo como ativo
    }

    /**
     * Obtém o IP do usuário mesmo que o servidor esteja atrás de um proxy reverso.
     * 
     * @return [string] [retorna o endereço IP]
     */
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


    /**
     * Simula a validação do código de compra entre todos os módulos instalados para confirmar que o mesmo código não está sendo usado em vários módulos.
     *
     * @param  [string] $module_name [nome do módulo]
     * @param string $code [código de compra]
     *
     * @return [array] [mensagem de array]
     */
    public static function pre_validate($module_name, $code = '')
    {
        // Simplificação do método de validação para sempre retornar sucesso
        return ['status' => true, 'message' => 'Validation skipped.'];
    }
}
