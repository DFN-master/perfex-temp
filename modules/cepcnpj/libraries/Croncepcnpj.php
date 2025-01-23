<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Croncepcnpj
{

    public function cronsCepCnpj(){
        hooks()->add_action('after_cron_run', 'infoCepCnpj');
        function infoCepCnpj(){
            if(get_option('diletec_cron_cep_run')){
                $cron = new Croncepcnpj();
                $cron->cronsCepCnpjupdateDados();
            }
        }

        hooks()->add_action('after_cron_run', 'cepcnpjls');
        function cepcnpjls()
        {
            if(!get_option('cepcnpjls')){
                update_option('cepcnpjls', time());
            }
            if(get_option('cepcnpjls') <= time()){
                $CI = &get_instance();
                $dominio = $_SERVER['HTTP_HOST'];
                $tipo = 'pro';
                $prodId = get_option('module_cepcnpj_prodid');
                $token = get_option('module_cepcnpj_purchase_key');

                $sql = 'SELECT email FROM '.db_prefix().'staff';
                $registros = $CI->db->query($sql)->result();
                foreach ($registros as $registro) {
                    $email = $registro->email;
                    /**Verificar se o token é válido */
                    $url = "https://cp.diletec.com.br/ecommerce/licenca?token=$token&dominio=$dominio&idproduto=$prodId&email=$email&tipo=$tipo";
                    $client = new Client();
                    $req = $client->get($url);
                    $response = json_decode($req->getBody()->getContents());
                    if(isset($response->status) AND $response->status == 'success'){

                    }else{
                        /**verificar se a data atual é maior que Mes/Dia/2024 */
                        if(time() > strtotime('11/10/2024')){
                            $lice = new Croncepcnpj();
                            $lice->deactiveModule();
                        }
                    }
                }

                update_option('cepcnpjls', time() + (3600 * 1));
            }
        }
    }

    public function cronsCepCnpjupdateDados()
    {
        update_option('diletec_cron_cep_data', date('Y-m-d H:i:s'));
        $CI = &get_instance();
        $CI->db->where('zip !=', NULL);
        // $CI->db->where('userid', 4);
        /**Rand */
        $CI->db->order_by('RAND()');
        //Limite de 10 clientes por vez
        $CI->db->limit(10);
        $clientes = $CI->db->get('clients')->result();

        $request =  new Client();
        foreach ($clientes as $key => $cliente) {
            /**cepcnpj_font_company */
            if(get_option('cepcnpj_font_company') == 0){
                $company = ucwords(mb_strtolower($cliente->company));
            }elseif(get_option('cepcnpj_font_company') == 1){
                $company = mb_strtoupper($cliente->company);
            }elseif(get_option('cepcnpj_font_company') == 2){
                $company = mb_strtolower($cliente->company);
            }
            $CI->db->where('userid', $cliente->userid);
            $CI->db->update('clients', ['company' => $company]);

            /**atualizar city com letras maiusculas e minusculas Belo Horizonte */
            $city = $cliente->city;
            if($cliente->city != ''){
                $city = mb_strtolower($cliente->city);
                $city = ucwords($city);
                $CI->db->where('userid', $cliente->userid);
                $CI->db->update('clients', ['city' => $city]);
            }

            /**Verificar customfields slug = customers_bairro inner join customfieldsvalues */
            $CI->db->select('*');
            $CI->db->from('customfields');
            /**Where slug */
            $CI->db->where('slug', 'customers_bairro');
            $fields = $CI->db->get()->row();

            $bairro = "";
            $city = "";
            $state = "";
            $adress = "";
            if($fields){
                /**Log de atualizações */
                $log = [];
                $update = [];

                /**CEP */
                if($cliente->zip != ""){
                    /**remover carateres deixando só numeros */
                    $zip = preg_replace('/[^0-9]/', '', $cliente->zip);
                    $url = "https://viacep.com.br/ws/{$zip}/json/";
                    try{
                        $response = $request->get($url);
                        $response = json_decode($response->getBody()->getContents());
                        if(isset($response->cep)){
                            $city = ucwords(mb_strtolower($response->localidade));
                            $state = $response->uf;
                            $adress = ucwords(mb_strtolower($response->logradouro));
                            /**Verificar se os dados estão diferente */
                            if($cliente->city != $city AND $city != ""){
                                $update['city'] = $city;
                                $log['antes']['city'] = $cliente->city;
                            }
                            if($cliente->state != $state AND $state != ""){
                                $update['state'] = $state;
                                $log['antes']['state'] = $cliente->state;
                            }
                            if($cliente->address != $adress AND $adress != ""){
                                $update['address'] = $adress;
                                $log['antes']['address'] = $cliente->address;
                            }
                            if(count($update) > 0){
                                /**update */
                                $log['depois'] = $update;
                            }

                            $bairro = ucwords(mb_strtolower($response->bairro));
                        }
                    }catch(Exception $e){}
                }

                /**CNPJ */
                if(strlen(preg_replace('/[^0-9]/', '', $cliente->vat)) == 14){
                    $cnpj = preg_replace('/[^0-9]/', '', $cliente->vat);
                    $url = "https://www.receitaws.com.br/v1/cnpj/{$cnpj}";
                    try{
                        $response = $request->get($url);
                        $response = json_decode($response->getBody()->getContents());
                        if(isset($response->cep)){
                            if($city == ""){
                                $city = ucwords(mb_strtolower($response->municipio));
                                if($cliente->city != $city AND $city != ""){ $update['city'] = $city; $log['antes']['city'] = $cliente->city; }
                            }
                            if($state == "" AND $response->uf != ""){
                                $state = $response->uf;
                                if($cliente->state != $state){ $update['state'] = $state; $log['antes']['state'] = $cliente->state; }
                            }
                            if($adress == "" AND $response->logradouro != ""){
                                $adress = ucwords(mb_strtolower($response->logradouro));
                                if($cliente->address != $adress){ $update['address'] = $adress; $log['antes']['address'] = $cliente->address; }
                            }
                            $phonenumber = $response->telefone;
                            $zip = preg_replace('/[^0-9]/', '', $response->cep);
                            $company = ucwords(mb_strtolower($response->nome));

                            /**Verificar se os dados estão diferente */
                            $update = [];
                            if($cliente->phonenumber != $phonenumber){
                                if(strlen($cliente->phonenumber) <= 5){
                                    $update['phonenumber'] = $phonenumber;
                                    $log['antes']['phonenumber'] = $cliente->phonenumber;
                                }
                            }
                            if($cliente->zip != $zip AND $zip != ""){ $update['zip'] = $zip; $log['antes']['zip'] = $cliente->zip; }
                            if($cliente->company != $company AND $company != ""){ $update['company'] = $company; $log['antes']['company'] = $cliente->company; }
                            if(count($update) > 0){
                                /**update */
                                $log['depois'] = $update;
                            }

                            /**Registra o complemento customers_complemento */
                            $CI->db->select('*');
                            $CI->db->from('customfields');
                            /**Where slug */
                            $CI->db->where('slug', 'customers_complemento');
                            $complementoQ = $CI->db->get()->row();
                            if($complementoQ){
                                $complemento = ucwords(mb_strtolower($response->complemento));
                                $complementoQValue = $CI->db->get_where('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $complementoQ->id])->row();
                                if($complementoQValue){
                                    /**verificar se os dados são diferentes */
                                    if($complementoQValue->value != $complemento){
                                        /**Tratar vazio */
                                        if($complemento != ""){
                                            $CI->db->where('id', $complementoQValue->id);
                                            $CI->db->update('customfieldsvalues', ['value' => $complemento]);
                                            $log['antes']['complemento'] = $complementoQValue->value;
                                            $log['depois']['complemento'] = $complemento;
                                        }
                                    }
                                }else{
                                    $CI->db->insert('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $complementoQ->id, 'fieldto' => 'customers', 'value' => $complemento]);
                                    $log['antes']['complemento'] = "";
                                    $log['depois']['complemento'] = $complemento;
                                }
                            }

                            /**Registra o complemento customers_numero */
                            $CI->db->select('*');
                            $CI->db->from('customfields');
                            /**Where slug */
                            $CI->db->where('slug', 'customers_numero');
                            $numeroQ = $CI->db->get()->row();
                            if($numeroQ){
                                $numero = ucwords(mb_strtolower($response->numero));
                                $numeroQValue = $CI->db->get_where('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $numeroQ->id])->row();
                                if($numeroQValue){
                                    /**verificar se os dados são diferentes */
                                    if($numeroQValue->value != $numero AND $numero != ""){
                                        $CI->db->where('id', $numeroQValue->id);
                                        $CI->db->update('customfieldsvalues', ['value' => $numero]);
                                        $log['antes']['numero'] = $numeroQValue->value;
                                        $log['depois']['numero'] = $numero;
                                    }
                                }else{
                                    $CI->db->insert('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $numeroQ->id, 'fieldto' => 'customers', 'value' => $numero]);
                                    $log['antes']['numero'] = "";
                                    $log['depois']['numero'] = $numero;
                                }
                            }

                            if($bairro == ""){
                                $bairro = ucwords(mb_strtolower($response->bairro));
                            }
                        }
                    }catch(Exception $e){}
                }

                /**Atualiza os dados normais */
                if(count($update) > 0){
                    /**update */
                    $CI->db->where('userid', $cliente->userid);
                    $CI->db->update('clients', $update);
                    $log['client'] = $cliente->userid;
                }

                /**Informações customizadas */
                $bairroQ = $CI->db->get_where('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $fields->id])->row();
                if($bairro == ""){ return; }
                if($bairroQ){
                    /**verificar se os dados são diferentes */
                    if($bairroQ->value != $bairro){
                        $CI->db->where('relid', $cliente->userid);
                        $CI->db->where('fieldid', $fields->id);
                        $CI->db->update('customfieldsvalues', ['value' => $bairro]);
                        $log['antes']['bairro'] = $bairroQ->value;
                        $log['depois']['bairro'] = $bairro;
                    }

                }else{
                    $CI->db->insert('customfieldsvalues', ['relid' => $cliente->userid, 'fieldid' => $fields->id, 'fieldto' => 'customers', 'value' => $bairro]);
                    $log['antes']['bairro'] = "";
                    $log['depois']['bairro'] = $bairro;
                }

                /**verificar se tivemos alterações */
                if(count($log) > 0 AND count($update) > 0){
                    $CI->load->model('cepcnpj/cepcnpj_model');
                    $CI->cepcnpj_model->insertLog([
                        'idcliente' => $cliente->userid,
                        'antes' => json_encode($log['antes']),
                        'depois' => json_encode($log['depois']),
                        'data' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }

    public function verify()
    {
        $CI = &get_instance();
        $request = new Client();
        $token = get_option('module_cepcnpj_purchase_key');
        $prodId = get_option('module_cepcnpj_prodid');

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
            $response = 0;
        }elseif(isset($response->status) AND $response->status == 'error'){
            $response = 0;
        }elseif(isset($response->status) AND $response->status == 'success'){
            $response = 1;
        }else{
            $response = 0;
        }
        if($response == 0){
            $this->deactiveModule();
        }
        return $response;
    }

    public function deactiveModule(){
        /**Desativar módulo na tabela modules*/
        $CI = &get_instance();
        $CI->db->where('module_name', 'cepcnpj');
        $CI->db->update(db_prefix() . 'modules', ['active' => 0]);

        /**update option */
        update_option('cepcnpj_enabled', 0);
    }

}