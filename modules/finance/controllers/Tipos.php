<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tipos extends AdminController
{
    public function index()
    {
        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $data['link'] = $actual_link;

        $CI = &get_instance();
        $CI->load->model('Tipos_model');

        $data['get'] = $CI->Tipos_model->getTipos();

        if(isset($_GET["delete"])){
            $CI->Tipos_model->deleteTipos($_GET['delete']);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $filetemp = $file['tmp_name'];
            $dados = [];

            if(!empty($_FILES['file']['tmp_name'])){
                if($_FILES['file']['type'] == "text/xml"){
                    $arquivo = new DOMDocument();
                    $arquivo->load($filetemp);
    
                    $linhas = $arquivo->getElementsByTagName("Row");
                    foreach($linhas as $key => $linha){
                        if($key != 0){
                            array_push($dados, array(
                                'codigo_conta'          => $linha->getElementsByTagName("Data")->item(0)->nodeValue,
                                'classificacao_conta'   => $linha->getElementsByTagName("Data")->item(1)->nodeValue,
                                'nome_conta'            => $linha->getElementsByTagName("Data")->item(2)->nodeValue,
                                'tipo_conta'            => $linha->getElementsByTagName("Data")->item(3)->nodeValue
                            ));
                        }
                    }
                    $CI->Tipos_model->postTipos($dados);
                }else{
                    $csvAsArray = array_map(function($v){return str_getcsv($v, ";");}, file($filetemp));
                    foreach ($csvAsArray as $key => $value) {
                        if($key != 0){
                            array_push($dados, array(
                                'codigo_conta'          => $value[0],
                                'classificacao_conta'   => $value[1],
                                'nome_conta'            => $value[2],
                                'tipo_conta'            => $value[3],
                            ));
                        }
                    }
                    $CI->Tipos_model->postTipos($dados);
                }
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['update'] == 'NULL'){
                unset($_POST['update']);
                $dados[] = $_POST;
                $CI->Tipos_model->postTipos($dados);
            }else{
                $CI->Tipos_model->updateTipos($_POST);
            }
        }

        $CI->load->view('tipos', $data);
    }


}