<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cep_cnpj_auto_no_core extends AdminController {

public function __construct()
{
    parent::__construct();
}

public function index() {
echo 'O módulo Cep_cnpj_auto_no_core foi instalado com sucesso.';}

public function create()
{
}

public function store()
{
	$data = $this->input->post();
	redirect(admin_url('cep_cnpj_auto_no_core'));
}

public function edit($id)
{
}

public function update(int $id)
{
	$data = $this->input->post();
	redirect(admin_url("cep_cnpj_auto_no_core/{$id}"));
}

public function destroy(int $id) {redirect(admin_url('cep_cnpj_auto_no_core/$id'));
}
    
public function _remap($method, $params = array())
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        } else {
            $this->index($method);
        }
    }

}
