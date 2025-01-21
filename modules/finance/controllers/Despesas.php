<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Despesas extends AdminController
{
    public function index()
    {
        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        $data['link'] = $actual_link;

        $CI = &get_instance();
        $CI->load->model('boletointer/Boletointer_model');

        /**Get inicio, GET fim */
        (isset($_GET['inicio'])) ? $inicio = $_GET['inicio'] : $inicio = null;
        (isset($_GET['fim'])) ? $fim = $_GET['fim'] : $fim = null;
        $data['extratoEnriquecido'] = $CI->Boletointer_model->extratoEnriquecido($inicio, $fim);

        $CI->load->view('despesas', $data);
    }

    public function import(){
        $CI = &get_instance();
        $CI->load->view('despesas-import', []);
    }


    public function importar()
    {
        $CI = &get_instance();
        $CI->load->model('finance/Payment_modes_model');
        $import_file = $this->upload_image('import_file');
        if ($import_file) {
            $csv_file = './temp/' . $import_file;

            // Identifica o delimitador mais provável
            $delimiter = $this->detectDelimiter($csv_file);

            if (($handle = fopen($csv_file, "r")) !== false) {
                $header = [];
                $possibleHeaders = [];
                $lineNumber = 0;

                while (($line = fgetcsv($handle, 1000, $delimiter)) !== false && $lineNumber < 10) {
                    $possibleHeaders[] = $line;
                    $lineNumber++;
                }

                // Identifica o cabeçalho baseado na presença da palavra "data"
                foreach ($possibleHeaders as $i => $headerLine) {
                    foreach ($headerLine as $column) {
                        if (@stripos($column, 'data') !== false) { // Encontrou a palavra "data"
                            $header = $headerLine;
                            break 2; // Sai dos dois loops
                        }
                    }
                }

                fclose($handle);
                if (!empty($header)) {
                    // Se um cabeçalho foi identificado, carrega a view com as informações necessárias
                    $CI->load->view('despesas-definition', ['headers' => $header, 'paymentModes' => $CI->Payment_modes_model->get(), 'filename' => $import_file]);
                } else {
                    // Se nenhum cabeçalho válido foi encontrado, você pode tratar este caso conforme necessário
                    echo "Nenhum cabeçalho válido foi encontrado.";
                }
            }
        }
    }

    private function detectDelimiter($csvFile)
    {
        $file = fopen($csvFile, 'r');
        $countComma = 0;
        $countSemicolon = 0;

        // Lê cada linha do arquivo e conta os delimitadores
        while (($line = fgets($file)) !== false) {
            $countComma += substr_count($line, ',');
            $countSemicolon += substr_count($line, ';');
        }
        fclose($file);

        // Retorna o delimitador com a maior contagem
        return $countSemicolon > $countComma ? ';' : ',';
    }

    public function importFinal(){
        $CI = &get_instance();
        $CI->load->model('finance/Payment_modes_model');
        $CI->load->model('finance/Bankstatements_model');
        $import_file = $CI->input->post('filename');
        if ($import_file) {
            $csv_file = './temp/' . $import_file;
            $delimiter = $this->detectDelimiter($csv_file);
            $header = [];
            $data = [];
            $idpaymentmodes = $CI->input->post('idpaymentmodes');
            if (($handle = fopen($csv_file, "r")) !== false) {
                // Ignora as primeiras cinco linhas
                for ($i = 0; $i < 6; $i++) {
                    fgetcsv($handle, 0, $delimiter);
                }

                $header = array();
                for($i = 0; $i < (count($CI->input->post()) - 2); $i++) {
                    if($CI->input->post($i) != ""){
                        $header[$i] = $CI->input->post($i);
                    }
                }


                while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                    $data[] = array_combine(array_intersect_key($header, $row), array_intersect_key($row, $header));
                }

                fclose($handle);
                $saldo = 0;
                foreach ($data as $key => $value) {
                    if($data[$key]['data'] == ""){
                        break;
                    }
                    $data[$key]['data'] = str_replace('"', '',$data[$key]['data']);
                    $data[$key]['idpaymentmodes'] = $idpaymentmodes;
                    $data[$key]['valor'] = floatval(str_replace(',', '.', preg_replace("/[^0-9,-]/", "", $data[$key]['valor'])));
                    // Criando o objeto DateTime a partir do formato 'd/m/Y'
                    $dataObjeto = DateTime::createFromFormat('d/m/Y', $data[$key]['data']);
                    $data[$key]['data'] = $dataObjeto->format('Y-m-d');
                    if($data[$key]['valor'] < 0){
                        $data[$key]['tipo'] = 'D';
                    }else{
                        $data[$key]['tipo'] = 'C';
                    }
                    if(!isset($data[$key]['saldo'])){
                        $data[$key]['saldo'] = 0;
                    }

                    $CI->Bankstatements_model->add($data[$key]);
                }

                set_alert('success', 'Importação realizada com sucesso!');
                redirect('admin/finance/despesas/import');
            }
        }
    }

    private function upload_image($field_name)
    {
        $upload_dir = './temp/'; // Diretório para armazenar as imagens de produtos

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Cria o diretório recursivamente com permissões de leitura, gravação e execução para todos
        }

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Cria o diretório recursivamente com permissões de leitura, gravação e execução para todos
        }

        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'csv'; // Tipos de arquivo permitidos
        $config['max_size'] = 2048; // Tamanho máximo do arquivo em kilobytes
        $config['encrypt_name'] = true; // Renomeia o arquivo com um nome criptografado

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();

            // Retorna a string no formato desejado: "ano/mes/nomedoarquivo"
            return $upload_data['file_name'];
        } else {
            echo $this->upload->display_errors(); // Exibe mensagens de erro do upload
            log_message('error', 'Erro no upload: ' . $this->upload->display_errors());
        }

        return false;
    }

    public function conciliacao(){
        $CI = &get_instance();
        $CI->load->model('finance/Bankstatements_model');
        $CI->load->model('Invoices_model');
        $CI->load->model('Expenses_model');
        $data['invoices'] = $CI->Invoices_model->get();
        $data['expenses'] = $CI->Expenses_model->get();
        $data['extratos'] = $CI->Bankstatements_model->get();

        $CI->load->view('conciliacao', $data);
    }

    public function conciliar(){
        $CI = &get_instance();
        $CI->load->model('finance/Bankstatements_model');
        $id = $CI->input->post('id');
        $value = $CI->input->post('value');
        $CI->Bankstatements_model->conciliar($id, $value);
        echo 'ok';
    }
}