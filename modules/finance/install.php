<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * The file is responsible for handing the chat installation
 */
$CI = &get_instance();

add_option('finance_enabled', 1);

$index = 0;
$query = '';
$dadosQuery = array(
    array("table"=>'expenses',   "name"=>'Status',  "slug"=>'expenses_status',  "type"=>'select', "options"=>'Aberto,Pago,Cancelado' ),
    array("table"=>'expenses',   "name"=>'Tipo de Despesa',  "slug"=>'expenses_tipo_despesas',  "type"=>'select', "options"=>'Fixa,Variável,Vendas,Investimento,Outras,Custo Mercadorias Vendidas' ),
    array("table"=>'customers',   "name"=>'Identificador Inter',  "slug"=>'customers_indentificador_inter',  "type"=>'input', "options"=>'' ),
);

foreach ($dadosQuery as $key) {
    $result = $CI->db->query("SELECT * FROM `".db_prefix()."customfields` WHERE slug = '".$key['slug']."'");
    $resultQuery = array();
    $resultQuery = $result->result_array();
    if(empty($resultQuery)) {
        if($index != 0){
            $query .= ",";
        }else{
            $query = "INSERT INTO `".db_prefix()."customfields`
            (`fieldto`, `name`, `slug`, `required`, `type`, `options`, `display_inline`, `field_order`, `active`, `show_on_pdf`, `show_on_ticket_form`, `only_admin`, `show_on_table`, `show_on_client_portal`, `disalow_client_to_edit`, `bs_column`, `default_value`)
            VALUES ";
        }
        $required = 0;
        if($key['slug'] == 'expenses_tipo_despesas' OR $key['slug'] == 'expenses_status'){
            $required = 1;
        }
        $query .= "('".$key['table']."', '".$key['name']."', '".$key['slug']."', '".$required."', '".$key['type']."', '".$key['options']."', '0', '0', '1', '1', '0', '0', '1', '1', '0', '12', '')";
        $index++;
    }
}

if(strlen($query) != 0){
    $CI->db->query($query);
}

if(isset($SERVER['HTTP_HOST']) AND $SERVER['HTTP_HOST'] == 'localhost'){
    $dir = __DIR__.'..\..\..\uploads\aporte';
}else{
    $dir = getcwd().'/uploads/aporte';
}
if (!is_dir($dir)) {
    mkdir($dir, 0755, false);
}

if (!$CI->db->table_exists(db_prefix().'bankstatements')) {
    $CI->db->query('CREATE TABLE `'.db_prefix().'bankstatements` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `idpaymentmodes` INT NOT NULL,
        `data` DATE NOT NULL,
        `descricao` TEXT NOT NULL,
        `valor` decimal(15,2),
        `saldo` decimal(15,2),
        `tipo` VARCHAR(50) NOT NULL,
        `conciliacao_id` INT(11) NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    );');
}

if (!$CI->db->table_exists(db_prefix().'finance_tipo')) {
    $CI->db->query('CREATE TABLE `'.db_prefix().'finance_tipo` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `codigo_conta` INT NOT NULL,
        `classificacao_conta` INT NOT NULL,
        `nome_conta` VARCHAR(50) NOT NULL,
        `tipo_conta` VARCHAR(11) NOT NULL,
        PRIMARY KEY (`id`)
    );');
}

if (!$CI->db->table_exists(db_prefix().'finance_aporte')) {
    $CI->db->query('CREATE TABLE `'.db_prefix().'finance_aporte` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `socio` VARCHAR(50) NOT NULL,
        `cpf_cnpj` VARCHAR(50) NOT NULL,
        `comprovante` VARCHAR(50) NOT NULL,
        `valor` decimal(15,2),
        `date` date NOT NULL,
        PRIMARY KEY (`id`)
    );');
}

/** expenses_categories */
$query = '';
$index = 0;
$dadosQuery = array(
    array('id' => '1','name' => 'Softwares','description' => ''),
    array('id' => '2','name' => 'Domínios','description' => 'Domínios como suamarca.com.br'),
    array('id' => '3','name' => 'Hosting','description' => 'Servidores'),
    array('id' => '4','name' => 'Cartório','description' => ''),
    array('id' => '5','name' => 'DAS','description' => 'Impostos sobre NF'),
    array('id' => '6','name' => 'Telefonia','description' => ''),
    array('id' => '7','name' => 'Luz','description' => ''),
    array('id' => '8','name' => 'Água','description' => ''),
    array('id' => '9','name' => 'Net','description' => ''),
    array('id' => '10','name' => 'Transporte','description' => ''),
    array('id' => '11','name' => 'Contabilidade','description' => ''),
    array('id' => '12','name' => 'Prefeitura','description' => ''),
    array('id' => '13','name' => 'Funcionários','description' => 'Despesas com Folha de Pagamento'),
    array('id' => '14','name' => 'Marketing','description' => 'Anúncios, eventos e outros.'),
    array('id' => '15','name' => 'GPS','description' => 'GUIA DA PREVIDÊNCIA SOCIAL - GPS'),
    array('id' => '16','name' => 'Ativos','description' => 'Imóveis, Equipamentos, Veículos, móveis e outros'),
    array('id' => '17','name' => 'Despesa Bancária','description' => 'Despesas com bancos, máquinas de cartão e outros'),
    array('id' => '18','name' => 'Retirada','description' => 'Retirada dos sócios'),
    array('id' => '19','name' => 'Cartão de Credito','description' => 'Pagamento de fatura de cartão de credito'),
    array('id' => '20','name' => 'DARF','description' => 'Guia GPS/INSS foi alterada para guia DARF'),
    array('id' => '21','name' => 'FGTS','description' => 'Fundo de Garantia do Tempo de Serviço')
);

foreach ($dadosQuery as $key) {
    $result = $CI->db->query("SELECT * FROM `".db_prefix()."expenses_categories` WHERE name = '".$key['name']."'");
    $resultQuery = array();
    $resultQuery = $result->result_array();
    if(empty($resultQuery)) {
        if($index != 0){
            $query .= ",";
        }else{
            $query = "INSERT INTO `".db_prefix()."expenses_categories`
            (`name`, `description`) VALUES ";
        }
        $query .= "('".$key['name']."', '".$key['description']."')";
        $index++;
    }
}

if(strlen($query) != 0){
    $CI->db->query($query);
}

/**insert de Tipos */
if(file_exists(__DIR__.'/finance_tipo.php')){
    require_once(__DIR__ . '/finance_tipo.php');
}