<?php
defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;

class Diletec extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function activate(){
        if(isset($_POST['module_name']) AND $_POST['module_name'] == 'finance'){
            $token = $_POST['purchase_key'];
            /**Verificar se existe */
            if(!option_exists('module_finance_purchase_key')){
                add_option('module_finance_purchase_key', $token);
            }else{
                update_option('module_finance_purchase_key', $token);
            }

            /**Load libraries/Request */
            $CI = &get_instance();
            $request = new Client();

            $prodId = get_option('module_finance_prodid');

            /**Verificar se existe o option licenceinter */
            $active = 0;
            $dominio = $_SERVER['HTTP_HOST'];
            $tipo = 'pro';
            /**verificar se tem um staff logado */
            $staffId = get_staff_user_id();
            if($staffId){
                $sql = 'SELECT email FROM '.db_prefix().'staff WHERE staffid = '.$staffId;
                $email = $CI->db->query($sql)->row()->email;
            }else{
                $sql = 'SELECT email FROM '.db_prefix().'staff LIMIT 1';
                $email = $CI->db->query($sql)->row()->email;
            }

            /**Verificar se o token é válido */
            $url = "https://cp.diletec.com.br/ecommerce/licenca?token=$token&dominio=$dominio&idproduto=$prodId&email=$email&tipo=$tipo";

            try{

                $req = $request->get($url);
                $response = json_decode($req->getBody()->getContents());
            }catch(Exception $e){
                $response = 0;
            }

            if(is_numeric($response)){
                $response = ["message" => "Licença não é válida!"];
            }elseif(isset($response->status) AND $response->status == 'error'){
                $response = ["message" => "Licença não é válida!"];
            }elseif(isset($response->status) AND $response->status == 'success'){
                $response = ["status" => $response, "message" => "Licença Ativada!"];
                /**ativacao */
                $CI->db->where('module_name', 'finance');
                $CI->db->update(db_prefix() . 'modules', ['active' => 1]);
                /**update option */
                update_option('finance_enabled', 1);
            }else{
                $response = ["message" => "Licença não é válida!"];
            }
            echo json_encode($response);
            exit;
        }
    }

}
