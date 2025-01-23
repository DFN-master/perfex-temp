<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Config_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        foreach ($data as $key => $value) {
            update_option($key, $value);
        }
    }
}