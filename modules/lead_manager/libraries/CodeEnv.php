<?php
require_once __DIR__ . '/../third_party/node.php';
if (!class_exists('\Requests')) {
    require_once __DIR__ . '/../third_party/Requests.php';
}
if (!class_exists('\Firebase\JWT\SignatureInvalidException')) {
    require_once __DIR__ . '/../third_party/php-jwt/SignatureInvalidException.php';
}
if (!class_exists('\Firebase\JWT\JWT')) {
    require_once __DIR__ . '/../third_party/php-jwt/JWT.php';
}
Requests::register_autoloader();

class CodeEnv {
    private static $personal_token = 'msIvJdiClmzzEqmlA9hFWtIxGsRKo21e';

    function verifyPurchase($name = null, $code = null)
    {
        /* 
        // Original method content is commented out to bypass purchase verification.
        $CI       = &get_instance();
        if (!is_null($name) && is_null($code)) {
            $verified = false;
            if (!option_exists($name . '_is_verified') || get_option($name . '_is_verified') != 1) {
                $CI->app_modules->deactivate($name);
            }
            return $verified;
        }
        $CI->load->config($name . '/conf');
        $code = trim($code);
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $code;
        $curl = curl_init($url);
        $header = array();
        $header[] = 'Authorization: Bearer ' . self::$personal_token;
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $envatoRes = curl_exec($curl);
        curl_close($curl);
        $envatoRes = json_decode($envatoRes);
        $data['status'] = false;
        if (isset($envatoRes) && !empty($envatoRes)) {
            if ($CI->config->item('product_item_id') != $envatoRes->item->id) {
                $data['message'] = 'Product item id not match with purchase key';
            } else {
                ...
            }
        } else {
            $data['message'] = 'Something Went wrong!';
        }
        */
        // Simulating a successful verification
        return ['status' => true];
    }

    public function validatePurchase($module_name)
    {
        /*
        // Original validation logic is commented out to always validate positively.
        ...
        */
        // Always validate the purchase as successful
        return true;
    }

    private function getUserIP()
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
}
