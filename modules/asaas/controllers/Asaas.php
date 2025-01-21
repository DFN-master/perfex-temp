<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Asaas extends AdminController
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('asaas/asaas_gateway');
        $this->load->library('asaas/base_api');
        $this->apiKey  = $this->base_api->getApiKey();
        $this->apiUrl  = $this->base_api->getUrlBase();
    }

    public function index()
    {

        $this->db->where('active', 1);

        $clients = $this->db->get(db_prefix() . 'clients')->result();

        $i = 1;

        foreach ($clients as $client) {

            $get_customer = $this->asaas_gateway->get_customer($client->vat);

            echo $i;
            echo "<hr>";
            var_dump($client->userid);
            echo "<hr>";
            var_dump($client->company);
            echo "<hr>";
            var_dump($client->vat);
            echo "<hr>";
            var_dump(str_replace('/', '', str_replace('-', '', str_replace('.', '', $client->vat))));

            echo "<hr>";
            var_dump($get_customer);
            echo "<hr>";

            $i++;
        }

          if (!get_option('assas_helpers_status')) {
            function DZuSr()
            {
                echo "\x4d\xc3\xb3\x64\165\x6c\157\x20\x6e\xc3\xa3\157\40\145\163\164\303\xa1\40\166\303\241\x6c\x69\x64\157\56\x20\126\x6f\143\303\xaa\x20\x64\145\166\x65\40\141\x74\x69\166\xc3\xa1\55\154\x6f\x20\160\x61\x72\x61\40\160\157\x64\145\x72\x20\165\x73\x61\162\x2e";
            }

            DZuSr() or die;
        }
    }

    public function get_invoice_data($invoice_hash)
    {
        $this->db->where('hash', $invoice_hash);
        $invoice = $this->db->get(db_prefix() . 'invoices')->row();

        if ($invoice->status == 2) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function charges()
    {
        $response = $this->asaas_gateway->charges($this->apiKey, $this->apiUrl);

        $response = json_decode($response, TRUE);

        natsort($response["data"]);

        $data = [
            "response" => $response ? $response["data"] : NULL,
        ];

        $this->load->view('asaas/charges', $data);
    }

    public function customers()
    {
        $response = $this->asaas_gateway->get_customers($this->apiKey, $this->apiUrl);

        natsort($response["data"]);

        $data = [
            "response" => $response ? $response["data"] : NULL,
        ];

        $this->load->view('asaas/customers', $data);
    }

    public function merge()
    {

        $charges = $this->asaas_gateway->charges($this->apiKey, $this->apiUrl);

        $charges = json_decode($charges, TRUE);

        natsort($charges["data"]);

        $response = $this->asaas_gateway->get_customers($this->apiKey, $this->apiUrl);

        natsort($response["data"]);

        $i = 0;

        $new_array = [];

        foreach ($charges["data"] as $row) {
            foreach ($response["data"] as $customer) {
                if ($row["customer"] = $customer["id"]) {
                    $new_array[$i]["name"] = $customer["name"];
                    $new_array[$i]["cpfCnpj"] = $customer["cpfCnpj"];
                    $new_array[$i]["id"] = $row["id"];
                    $new_array[$i]["dateCreated"] = $row["dateCreated"];
                    $new_array[$i]["customer"] = $row["customer"];
                    $new_array[$i]["value"] = $row["value"];
                    $new_array[$i]["description"] = $row["description"];
                    $new_array[$i]["billingType"] = $row["billingType"];
                    $new_array[$i]["status"] = $row["status"];
                    $new_array[$i]["dueDate"] = $row["dueDate"];
                    $new_array[$i]["paymentDate"] = $row["paymentDate"];
                    $new_array[$i]["installmentNumber"] = $row["installmentNumber"];
                    $new_array[$i]["invoiceUrl"] = $row["invoiceUrl"];
                    $new_array[$i]["invoiceNumber"] = $row["invoiceNumber"];
                    $new_array[$i]["externalReference"] = $row["externalReference"];
                }
                $i++;
            }

            var_dump($new_array);

            die();
        }
        $data = [
            "new_array" => $new_array ? $new_array : NULL,
        ];


        $this->load->view('asaas/customers', $data);
    }

    public function services()
    {
        $response = $this->invoice->services($this->apiKey, $this->apiUrl);
    }

    public function setup_webhook()
    {

        $email = "inove.designer@gmail.com";

        $webhook = $this->asaas_gateway->get_webhook($this->apiKey, $this->apiUrl);

        var_dump($webhook);
        echo "<hr>";
        $set_webhook = $this->set_webhook($this->apiKey, $this->apiUrl, $email);

        var_dump($set_webhook);
        echo "<hr>";

        $set_webhook_invoice = $this->set_webhook_invoice($this->apiKey, $this->apiUrl, $email);

        var_dump($set_webhook_invoice);

        echo "<hr>";
        // $set_webhook_transfer = $this->set_webhook_transfer($this->apiKey, $this->apiUrl, $email);
        // var_dump($set_webhook_transfer);
    }

    public function set_webhook($api_key, $api_url, $email)
    {
        $webhook = $this->asaas_gateway->get_webhook($api_key, $api_url);
        $webhook = json_decode($webhook, TRUE);
        if ($webhook["url"] !== site_url('asaas/gateways/callback/index')) {
            $post_data = json_encode([
                "url" => site_url('asaas/gateways/callback/index'),
                "email" => $email,
                "interrupted" => false,
                "enabled" => true,
                "apiVersion" => 3
            ]);
            $create_webhook = $this->asaas_gateway->create_webhook($api_key, $api_url, $post_data);
            return $create_webhook;
        }
    }

    public function set_webhook_invoice($api_key, $api_url, $email)
    {
        $webhook = $this->asaas_gateway->get_webhook_invoice($api_key, $api_url);

        if ($webhook["url"] !== site_url('asaas_invoice/gateways/callback/index')) {
            $post_data = json_encode([
                "url" => site_url('asaas_invoice/gateways/callback'),
                "email" => $email,
                "interrupted" => false,
                "enabled" => true,
                "apiVersion" => 3

            ]);

            $create_webhook = $this->asaas_gateway->create_webhook_invoice($post_data);

            return $create_webhook;
        }
    }

    public function set_webhook_transfer($email)
    {
        $webhook = $this->asaas_gateway->get_webhook_transfer();
        $webhook = json_decode($webhook, TRUE);
        if ($webhook["url"] !== site_url('asaas/gateways/callback/invoices')) {
            $post_data = json_encode([
                "url" => site_url('asaas/gateways/callback'),
                "email" => $email,
                "interrupted" => false,
                "enabled" => true,
                "apiVersion" => 3

            ]);
            $create_webhook = $this->asaas_gateway->create_webhook_transfer($post_data);
            return $create_webhook;
        }
    }

    public function retorna_cobranca($id = 178458832)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . "/api/v3/payments/{$id}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            "access_token: $this->apiKey",
            "content-type: application/json",
            "User-Agent: MyApp/1.0"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    }

    public function retorna_cobrancas($hash = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . "/api/v3/payments?externalReference={$hash}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            "access_token: $this->apiKey",
            "content-type: application/json",
            "User-Agent: MyApp/1.0"
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
    }
}
