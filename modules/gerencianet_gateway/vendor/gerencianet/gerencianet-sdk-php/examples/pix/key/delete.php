<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__ . '/../../config.json');
$options = json_decode($file, true);

$params = ['chave' => ''];

try {
    $api = Gerencianet::getInstance($options);
    $pix = $api->pixDeleteEvp($params);

    echo json_encode(["code" => 200]);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);

    throw new Error($e->error);
} catch (Exception $e) {
    throw new Error($e->getMessage());
}
