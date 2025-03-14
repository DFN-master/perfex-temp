<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * add commission staff
 * @param integer
 */
function add_commission_staff($payment_id) {
	$CI = &get_instance();
	$CI->load->model('commission/commission_model');
	$result = $CI->commission_model->add_commission($payment_id);
	if ($result == true) {
		return 1;
	}
	return 0;
}

/**
 * delete commission staff
 * @param integer
 */
function delete_commission_staff($invoice_id) {
	$CI = &get_instance();
	$CI->db->where('invoice_id', $invoice_id);
	$CI->db->delete(db_prefix().'commission');
	if ($CI->db->affected_rows() > 0) {
		return 1;
	}
	return 0;
}

/**
 * get commission
 * @param  string $staffid
 * @param  string $date
 * @return integer
 */
function get_commission($staffid = '', $date = '') {
	if ($staffid == '') {
		$staffid = get_staff_user_id();
	}
	if ($date == true) {
		$count = sum_from_table(db_prefix() . 'commission', array('field' => 'amount', 'where' => array('staffid' => $staffid, 'year(date)' => date('Y'), 'month(date)' => date('m'))));
		if ($count) {
			return $count;
		}
		return 0;
	}

	$count = sum_from_table(db_prefix() . 'commission', array('field' => 'amount', 'where' => array('staffid' => $staffid)));
	if ($count) {
		return $count;
	}
	return 0;
}

function check_applicable_client($clientid){
	$CI = &get_instance();
	$CI->db->where('applicable_staff', $clientid);
	$CI->db->where('is_client', 1);
	$applicable_staff = $CI->db->get(db_prefix().'applicable_staff')->result_array();
	if ($applicable_staff) {
		return true;
	}
	return false;
}

/**
 * get status modules for all 
 * @param  string $module_name 
 * @return boolean             
 */
function commission_get_status_modules_all($module_name){
    $CI             = &get_instance();
   
    $sql = 'select * from '.db_prefix().'modules where module_name = "'.$module_name.'" AND active =1 ';
    $module = $CI->db->query($sql)->row();
    if($module){
        return true;
    }else{
        return false;
    }
}

/**
 * add commission credit
 * @param array
 */
function add_commission_credit($data) {
	$CI = &get_instance();
	$CI->load->model('commission/commission_model');
	$result = $CI->commission_model->add_commission_credit($data);
	if ($result == true) {
		return 1;
	}
	return 0;
}

/**
 * recalculate commission
 * @param array
 */
function recalculate_commission($data) {
	$CI = &get_instance();
	$CI->load->model('commission/commission_model');
	if(isset($data['invoiceid'])){
		$result = $CI->commission_model->add_commission_by_invoice($data['invoiceid']);
		if ($result == true) {
			return 1;
		}
	}
	return 0;
}