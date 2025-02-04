<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();

add_option('interestandfine_enabled', 1);
if(get_option('iaf_juros') == ""):

$data = array(
    array(
        'name' => 'iaf_juros',
        'value' => '0',
        'autoload' => '1'
    ),
    array(
        'name' => 'iaf_multa',
        'value' => '0',
        'autoload' => '1'
    )
);

$CI->db->insert_batch(db_prefix().'options', $data);
endif;

//Remover desconto option iaf_remover_desconto
if(get_option('iaf_remover_desconto') == '' OR get_option('iaf_remover_desconto') == null){
    add_option('iaf_remover_desconto', 0);
}

if(get_option('iaf_carencia') == '' OR get_option('iaf_carencia') == null){
    add_option('iaf_carencia', 0);
}