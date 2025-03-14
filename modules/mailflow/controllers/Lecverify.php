<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once __DIR__ .'/../libraries/leclib.php';

/**
 * LenzCreative verify
 */
class Lecverify extends AdminController{
    public function __construct(){
        parent::__construct();
    }

    /**
     * index
     * @return void
     */
    public function index(){
        show_404();
    }

    /**
     * activate
     * @return json
     */
    public function activate()
    {
        $staff = (array) get_staff();
        $staff = array_values($staff);
        $staff = $staff[0] ?? '';

         $license_code = strip_tags(trim($_POST["purchase_key"]));
         $client_name = strip_tags(trim($_POST["username"]));

         $api = new MailflowLic();
         $activate_response = $api->activate_license($license_code, $client_name, true, $staff);

         $msg = '';
         if(empty($activate_response)){
           $msg = 'Server is unavailable.';
         }else{
           $msg = $activate_response['message'];
         }

         $res = array();
         $res['status'] = $activate_response['status'];
         $res['message'] = $msg;

         if ($res['status']) {
             $res['original_url']= $this->input->post('original_url');
         }

         echo json_encode($res);
    }
}