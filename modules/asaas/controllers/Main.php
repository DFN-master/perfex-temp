<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends ClientsController
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('asaas_gateway');
        $this->load->library('base_api');
        $this->load->helper('general');
        $this->apiKey  = $this->base_api->getApiKey();
        $this->apiUrl  = $this->base_api->getUrlBase();
    }

    public function index()
    {
        $post_data = json_encode(["type" => "EVP"]);

        $minhas_chaves = $this->create_key($this->apiUrl, $this->apiKey, $post_data);

        var_dump($minhas_chaves);
    }

    public function create_key($api_url, $api_key, $post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url . "/api/v3/pix/addressKeys");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            "access_token: $api_Key",
            "content-type: application/json",
            "User-Agent: MyApp/1.0"
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function list_keys($api_url, $api_key)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url . "/api/v3/pix/addressKeys",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "access_token: $api_Key",
                "content-type: application/json",
                "User-Agent: MyApp/1.0"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function get_key($api_url, $api_key, $id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url . "/api/v3/pix/addressKeys/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "access_token: $api_Key",
                "content-type: application/json",
                "User-Agent: MyApp/1.0"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function delete_key($api_url, $api_key, $id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url . "/api/v3/pix/addressKeys",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "access_token: $api_Key",
                "content-type: application/json",
                "User-Agent: MyApp/1.0"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
