<?php

function checkFileChanges($filePath)
{
    $currentHash = hash_file('sha256', $filePath);
    echo $currentHash;
}

$filePath = '/public_html/crm/modules/asaas/helpers/teste_helper.php';
checkFileChanges($filePath);
echo "\n";
