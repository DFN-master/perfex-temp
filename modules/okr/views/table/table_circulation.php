<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
	'id',
	'name_circulation',
	'type',
	'year',
	'quarter',
	'month',
	'from_date',
	'to_date',
];
$sIndexColumn = 'id';
$sTable = db_prefix() . 'okr_setting_circulation';
$join = [];
$where = [];
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, []);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

	$row = [];
	$row[] = $aRow['name_circulation'];
	$row[] = _l($aRow['type']);
	if ($aRow['type'] != 'okr_custom') {
		$row[] = $aRow['year'];
		if ($aRow['type'] == 'okr_quarterly') {
			$row[] = _l('okr_q' . $aRow['quarter']);
			$row[] = '';
		} else if ($aRow['type'] == 'okr_monthly') {
			$row[] = '';
			$row[] = _l('okr_m' . $aRow['month']);
		} else {
			$row[] = '';
			$row[] = '';
		}
	} else {
		$row[] = '';
		$row[] = '';
		$row[] = '';
	}
	$row[] = _d($aRow['from_date']);
	$row[] = _d($aRow['to_date']);
	$option = '';
	$date_format = get_option('dateformat');
	$date_format = explode('|', $date_format);
	$date_format = $date_format[0];

	if (has_permission('okr_setting', '', 'eidt') || is_admin()) {
		$option .= '<a href="#" class="btn btn-default btn-icon" data-id="' . $aRow['id'] . '" data-name="' . $aRow['name_circulation'] . '" data-fromdate="' . _d($aRow['from_date']) . '" data-todate="' . _d($aRow['to_date']) . '" data-type = "' . $aRow['type'] . '" data-year="' . $aRow['year'] . '" data-quarter="' . $aRow['quarter'] . '" data-month="' . $aRow['month'] . '" onclick="update_setting_circulation(this);" >';
		$option .= '<i class="fa fa-edit"></i>';
		$option .= '</a>';
	}

	if (has_permission('okr_setting', '', 'delete') || is_admin()) {
		$option .= '<a href="' . admin_url('okr/delete_setting_circulation/' . $aRow['id']) . '" class="btn btn-danger btn-icon _delete">';
		$option .= '<i class="fa fa-remove"></i>';
		$option .= '</a>';
	}

	$row[] = $option;

	$output['aaData'][] = $row;

}
