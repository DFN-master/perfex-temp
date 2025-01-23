<?php

defined('BASEPATH') or exit('No direct script access allowed');

add_option('gerencianet_gateway', 'enable');

function copiar_arquivos(
    string $filename_source,
    string $filename_dest
) {
    if(file_exists($filename_dest)){
        unlink($filename_dest);
    }
    copy($filename_source, $filename_dest);
}
// Cria a pasta banco inter para a adição dos certificados.
$pasta_para_upload_chave_e_certificdo = efi_get_media_path_project(). "/efi";

if(!is_dir($pasta_para_upload_chave_e_certificdo)){
    mkdir($pasta_para_upload_chave_e_certificdo, 0777, true);
}
