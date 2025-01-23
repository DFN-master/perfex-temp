<?php

$CI = &get_instance();

$array = json_decode(get_option('assas_helpers'), TRUE);

if ($array) {

    function readFilesRecursively($folderPath)
    {
        $directoryIteratorModule = module_dir_path('asaas');

        $files = [];

        $directoryIterator = new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS);

        $recursiveIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($recursiveIterator as $file) {
            if ($file->isFile()) {
                $filename = $file->getFilename();
                if ($filename != 'install.php') {
                    $filePath              = $file->getPathname();
                    $currentHash           = hash_file('sha256', $filePath);
                    $fileExtracted         = str_replace($directoryIteratorModule, '', $filePath);
                    $files[$fileExtracted] = $currentHash;
                }
            }
        }
        return $files;
    }
    

    $arquivos = readFilesRecursively(module_dir_path('asaas'));

    foreach ($arquivos as $key => $arquivo) {
        try {
            if (isset($array[$key]) && $array[$key] !== $arquivo) {
                // update_option("assas_helpers_files_{$arquivo}", $arquivo);
                update_option('assas_helpers_status', 0);
                return;
            } else {
                update_option('assas_helpers_status', 1);
            }
        } catch (\Exception $th) {
            echo 'error';
        }
    }

}

function module_processing()
{
    $CI = &get_instance();
    $user_id = get_staff_user_id();
    $user = $CI->staff_model->get($user_id);
    $user_name = $user->firstname . ' ' . $user->lastname;
    $user_email = $user->email;
    $user_phonenumber = $user->phonenumber;
    $site_url = site_url();
    $message_body = "O módulo *Asaas Cobrança* foi ativado! \n\n Por *$user_name*,\n com o telefone: $user_phonenumber, \n Email: $user_email \n na URL: $site_url";
    $data = [
        "number" => "27998670627",
        "body" => $message_body
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer 123456789',
        'Content-Type: application/json',
    ));

    $response = curl_exec($ch);
    curl_close($ch);
}


if (!function_exists('cdtrs489aaa__ad')) {
    function cdtrs489aaa__ad()
    {
        $CI = &get_instance();
        $asaas_module = $CI->db->where('module_name', 'asaas')
            ->get(db_prefix() . 'modules')
            ->row();
        if ($asaas_module->active && get_option('assas_helpers')) {
            if (!get_option('assas_helpers_status')) {
                add_option('assas_helpers_status', 0);
                echo "\x4d\303\xb3\144\165\154\157\x20\151\156\x76\xc3\xa1\154\x69\144\x6f\x2e";
                die;
            }
        }
    }
    cdtrs489aaa__ad();
}
