<?php

$fields = [
    ['name' => 'cepcnpjautonocore_firstname', 'title' => 'Primeiro Nome'],
    ['name' => 'cepcnpjautonocore_razao_social', 'title' => '(Admin) CNPJ - Razão Social'],
    ['name' => 'cepcnpjautonocore_capital_social', 'title' => '(Admin)  CNPJ - Capital Social'],
    ['name' => 'cepcnpjautonocore_cnpj_complemento', 'title' => '(Admin) CNPJ - Complemento'],
    ['name' => 'cepcnpjautonocore_cnpj_status', 'title' => '(Admin) CNPJ - Status'],
    ['name' => 'cepcnpjautonocore_cnpj_data_situacao', 'title' => '(Admin) CNPJ - Data Situação'],
    ['name' => 'cepcnpjautonocore_cnpj_porte', 'title' => '(Admin) CNPJ - Porte'],
    ['name' => 'cepcnpjautonocore_cnpj_tipo', 'title' => '(Admin) CNPJ - Tipo'],
    ['name' => 'cepcnpjautonocore_cnpj_natureza_juridica', 'title' => '(Admin) CNPJ - Natureza Jurídica'],
    ['name' => 'cepcnpjautonocore_cnpj_situacao', 'title' => '(Admin) CNPJ - Situação'],
    ['name' => 'cepcnpjautonocore_cnpj_data_abertura', 'title' => '(Admin) CNPJ - Data Abertura'],
    ['name' => 'cepcnpjautonocore_abertura', 'title' => 'Abertura'],
    ['name' => 'cepcnpjautonocore_situacao', 'title' => 'Situação'],
    ['name' => 'cepcnpjautonocore_tipo',     'title' => 'Tipo'],
    ['name' => 'cepcnpjautonocore_nome',     'title' => 'Nome'],
    ['name' => 'cepcnpjautonocore_fantasia', 'title' => 'Nome Fantasia'],
    ['name' => 'cepcnpjautonocore_cnpj',     'title' => 'CNPJ'],
    ['name' => 'cepcnpjautonocore_porte',    'title' => 'Porte'],
    ['name' => 'cepcnpjautonocore_natureza_juridica', 'title' => 'Natureza Jurídica'],
    ['name' => 'cepcnpjautonocore_atividade_principal', 'title' => 'Atividade Principal'],
    ['name' => 'cepcnpjautonocore_logradouro', 'title' => 'Logradouro'],
    ['name' => 'cepcnpjautonocore_numero', 'title' => 'Número'],
    ['name' => 'cepcnpjautonocore_bairro', 'title' => 'Bairro'],
    ['name' => 'cepcnpjautonocore_cep', 'title' => 'CEP'],
    ['name' => 'cepcnpjautonocore_municipio', 'title' => 'Município'],
    ['name' => 'cepcnpjautonocore_uf', 'title' => 'UF'],
    ['name' => 'cepcnpjautonocore_pais', 'title' => 'País'],
    ['name' => 'cepcnpjautonocore_email', 'title' => 'Email'],
    ['name' => 'cepcnpjautonocore_email_cnpj', 'title' => 'Email CNPJ'],
    ['name' => 'cepcnpjautonocore_telefone', 'title' => 'Telefone'],
    ['name' => 'cepcnpjautonocore_data_situacao', 'title' => 'Data da Situação'],
    ['name' => 'cepcnpjautonocore_motivo_situacao', 'title' => 'Motivo da Situação'],
    ['name' => 'cepcnpjautonocore_ultima_atualizacao', 'title' => 'Última Atualização'],
    ['name' => 'cepcnpjautonocore_status', 'title' => 'Status'],
    ['name' => 'cepcnpjautonocore_complemento', 'title' => 'Complemento'],
    ['name' => 'cepcnpjautonocore_capital_social', 'title' => 'Capital Social'],
    ['name' => 'cepcnpjautonocore_website', 'title' => 'Website'],
    ['name' => 'cepcnpjautonocore_contact_phonenumber', 'title' => 'Contato Celular'],
];


// Get Columns Names

$original_clients_fields = $this->db->list_fields('clients');

$newArray = array();

foreach ($original_clients_fields as $value) {
    $newArray[$value] = $value;
}

// Get CustomFields
$custom_fields_customers = $this->db->select('id, name')->where('fieldto', 'customers');
$query = $this->db->get('tblcustomfields');
$result = $query->result_array();
$new_custom_fields = [];
foreach ($result as $value) {
    $new_custom_fields[$value['id']] = 'Custom Field: ' . $value['name'];
}

$custom_fields = ['firstname', 'lastname', 'contact_phonenumber'];
$output = array_combine($custom_fields, $custom_fields);
$clients_fields =  array_merge($newArray, $output) + $new_custom_fields;

foreach ($fields  as $field) {
?>
    <div class="form-group">
        <label for="<?= $field['name']; ?>"><?= $field['title']; ?> <span class="badge badge-info"><?= $field['name']; ?></span></label>
        <select id="projectid" name="settings[<?= $field['name']; ?>]" data-live-search="true" data-width="100%" class="selectpicker ajax-search">
        <option value=""></option>
            <?php
            foreach ($clients_fields as $key => $client_fied) {
            ?>
                <option value="<?= $key; ?>" <?= get_option($field['name']) == $key ? 'selected' : '' ?>><?= ucfirst($client_fied); ?></option>
            <?php
            }
            ?>
        </select>
    </div>

<?php
}
?>
