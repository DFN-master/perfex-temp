<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Extrato extends AdminController
{
    public function index()
    {
        /**
         * method Caixa
         */
        if(Extrato::license() == false){ echo 'Entre em contato com o suporte da Diletec.'; return false;}
        $data["license"] =  Extrato::license();
        $CI = &get_instance();
        $CI->load->model('finance/caixa_model');

        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";
        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $caixa = []; //$CI->caixa_model->caixa();
        $datas = $this->input->get();
        if(isset($datas['start']) && $datas['start'] != '' AND isset($datas['end']) && $datas['end'] != ''){
            $inicial = date('Y-m-d', strtotime($datas['start']));
            $final = date('Y-m-d', strtotime($datas['end']));
            $caixa['extrato'] = $CI->caixa_model->extrato($inicial, $final);
        }else{
            $caixa['extrato'] = $CI->caixa_model->extrato();
        }

        $caixa['payment'] = $CI->caixa_model->payment();
        $caixa['link'] = $actual_link;
        //print_r($caixa);
        //echo $caixa['invoices'] - $caixa['expenses'];
        $CI->load->view('extrato', $caixa);
    }

    public function license(){
        /***/
        $host = $_SERVER['HTTP_HOST'];
        if(file_exists(__DIR__.'/../protected/license/license.txt')){

            return Extrato::licenseVerify();

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
                mkdir(__DIR__.'/../protected/license', 0755, true);
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