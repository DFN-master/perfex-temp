<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aporte extends AdminController
{
    public function DownloadAporte($id, $filename){
        $this->load->helper('download');
        $path = ($_SERVER['HTTP_HOST'] == 'localhost' ? __DIR__.'..\..\..\..\uploads\aporte/'.$id.'/'.$filename : getcwd().'/uploads/aporte/'.$id.'/'.$filename);
        force_download($path, null);
    }

    public function index()
    {
        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $data['link'] = $actual_link;

        $CI = &get_instance();
        $CI->load->model('Aporte_model');

        $data['get'] = $CI->Aporte_model->getAportes();

        if(isset($_GET["delete"])){
            $CI->Aporte_model->deleteAportes($_GET['delete']);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_FILES['file'])){
                $file = $_FILES['file'];
                $filename = $file['name'];
                $filetype = $file['type'];
                $filetemp = $file['tmp_name'];
            }

            if($_POST['update'] == '' || $_POST['update'] == 'NULL'){
                $dados[] = $_POST;
                $dados[0]['comprovante'] = $filename;
                
                $dados[0]['cpf_cnpj'] = preg_replace("/[^0-9]/", "", $dados[0]['cpf_cnpj']);
                unset($dados[0]['update']);
                
                $id = $CI->Aporte_model->postAportes($dados);
            }else{
                if($filename != ""){
                    $_POST['comprovante'] = $filename;
                }
                $id = $CI->Aporte_model->updateAportes($_POST);
            }
            $dir = ($_SERVER['HTTP_HOST'] == 'localhost' ? __DIR__.'../../../../uploads/aporte/'.$id.'/' : getcwd().'/uploads/aporte/'.$id.'/');


            if($id != false && isset($_FILES['file'])){
                if (!is_dir($dir)) {
                    mkdir($dir, 0755);
                }
                if(is_uploaded_file($filetemp)) {
                    if(move_uploaded_file($filetemp, $dir . $filename)) {
                        header("Location: ?posted=true");  
                    }else{
                        header("Location: ?posted=false");
                    }
                }
            }
            
        }

        

        $CI->load->view('aporte', $data);
    }


}