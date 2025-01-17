<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webhook extends App_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function info(){
        $post = file_get_contents('php://input');

        $dados = json_decode($post);

        if(isset($dados)){
            $CI = &get_instance();
            $info = $dados->info;
            $link = $dados->link;
            $sql = 'SELECT email, staffid, firstname, lastname FROM '.db_prefix().'staff';
            $registros = $CI->db->query($sql)->result();

            /**insert notifications */
            foreach($registros as $registro){
                $CI->db->insert('tblnotifications', [
                    'isread' => 0,
                    'isread_inline' => 0,
                    'date' => date('Y-m-d H:i:s'),
                    'description' => $info,
                    'fromuserid' => 0,
                    'fromclientid' => 0,
                    'from_fullname' => $registro->firstname.' '.$registro->lastname,
                    'touserid' => $registro->staffid,
                    'fromcompany' => '',
                    'link' => $link,
                    'additional_data' => '',
                ]);
            }
        }
    }
}