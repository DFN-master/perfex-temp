<?php

defined('BASEPATH') or exit('No direct script access allowed');

class License_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function license(){
        /***/
        $host = $_SERVER['HTTP_HOST'];
        if(file_exists(__DIR__.'/../protected/license/license.txt')){
            
            return License_model::licenseVerify();
            
        }else{
            $url = "https://app.diletec.com.br/licenses/?start=true&domain=$host&byname=finance";
            $tuCurl = curl_init();
            curl_setopt($tuCurl, CURLOPT_URL, $url);
            curl_setopt($tuCurl, CURLOPT_POST, 0);
            curl_setopt($tuCurl, CURLOPT_FAILONERROR, 1);
            curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array(/*"Content-Type: application/json"*/));
            
            $tuData = json_decode( curl_exec($tuCurl) );
            curl_close($tuCurl);
            
            if(isset($tuData->data)){
                $archive = fopen(__DIR__.'/../protected/license/license.txt', 'w');
                fwrite($archive, $tuData->data);
                fclose($archive);
            }
        }
    }
    
    public function licenseVerify(){
        $key = file (__DIR__.'/../protected/license/license.txt');
        $url = "https://app.diletec.com.br/licenses/?key=".$key[0];
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_POST, 0);
        curl_setopt($tuCurl, CURLOPT_FAILONERROR, 1);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array(/*"Content-Type: application/json"*/));
        $tuData = json_decode( curl_exec($tuCurl) );
        curl_close($tuCurl);
        
        if($tuData->message === 'Registration expired'){
            $archive = fopen(__DIR__.'/../protected/license/validate.txt', 'w');
            fwrite($archive, 'false');
            fclose($archive);
        }else{
            $archive = fopen(__DIR__.'/../protected/license/validate.txt', 'w');
            fwrite($archive, 'true');
            fclose($archive);
        }
        return $tuData;
    }
    
    public function lv(){
        return file(__DIR__.'/../protected/license/validate.txt');
    }
}