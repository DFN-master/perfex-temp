<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Config extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Config_model');
    }

    public function index()
    {
        $data['post_result'] = "";
        if(isset($_GET["post"])){
            $data['post_result'] = $_GET['post'];
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->Config_model->updateConfig($_POST);
        }

        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $data['link'] = $actual_link;

        $this->load->view('config', $data);
    }
}
