<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
if ($elite_area == 'elitecustomjscss_admin_area_script') {
    $area_type = 'admin';
}
if ($elite_area == 'elitecustomjscss_clients_area_script') {
    $area_type = 'clients';
}
if($elite_area == 'web_to_lead_area_js' ) {
    $area_type = 'web_to_lead';
}

$CI = &get_instance();
$CI->db->select('code, code_view, c_user_type')->from(ElITE_CUSTOM_JS_CSS_TABLE_NAME);
$CI->db->where('code_type', 'js');
$CI->db->group_start();
$CI->db->where('area_type', $area_type);
$CI->db->or_where('area_type', 'both');
$CI->db->group_end();
$CI->db->where('status', 'active');
$result = $CI->db->get()->result_array();

if (!empty($result)) {
    foreach ($result as $value) {
        if( $area_type == 'clients' ) {
            if($value['c_user_type'] == 'not_logged_in' && is_client_logged_in()) {
                return;
            } else if($value['c_user_type'] == 'logged_in' && !is_client_logged_in()) {
                return;
            }
        }

        $jsCode = html_entity_decode(clear_textarea_breaks($value['code']));       
        if ($value['code_view'] == 'with_tag') {
            echo '<script type="text/javascript">';
            echo $jsCode . PHP_EOL;
            echo '</script>';
        } else {
            echo $jsCode . PHP_EOL;
        }
    }
}
?>