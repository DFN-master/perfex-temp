<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Okr
 */
class Okr extends AdminController {
	/**
	 * __construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('okr_model');
		$this->load->model('departments_model');
		$this->load->model('staff_model');
	}
	/**
	 * dashboard
	 * @return view
	 */
	public function dashboard() {
		if (!has_permission('okr_dashboard', '', 'view') && !has_permission('okr_dashboard', '', 'view_own') && !is_admin()) {
			access_denied('okr_dashboard');
		}
		$active_type = 'this_week';
		if ($this->input->get('type')) {
			$active_type = $this->input->get('type');
		}
		$company_objectives = $this->okr_model->get_dashboard_objectives($active_type, 'company');
		$department_objectives = $this->okr_model->get_dashboard_objectives($active_type, 'department');
		$personal_objectives = $this->okr_model->get_dashboard_objectives($active_type, 'personal');
		$company_key_results = $this->okr_model->get_dashboard_key_results($active_type, 'company');
		$department_key_results = $this->okr_model->get_dashboard_key_results($active_type, 'department');
		$personal_key_results = $this->okr_model->get_dashboard_key_results($active_type, 'personal');
		$company_checkin = $this->okr_model->get_dashboard_checkin($active_type, 'company');
		$department_checkin = $this->okr_model->get_dashboard_checkin($active_type, 'department');
		$personal_checkin = $this->okr_model->get_dashboard_checkin($active_type, 'personal');
		$data['company_objectives'] = json_encode($company_objectives['chart']);
		$data['company_objectives_qty'] = $company_objectives['total'];
		$data['department_objectives'] = json_encode($department_objectives['chart']);
		$data['department_objectives_qty'] = $department_objectives['total'];
		$data['personal_objectives'] = json_encode($personal_objectives['chart']);
		$data['personal_objectives_qty'] = $personal_objectives['total'];
		$data['company_key_results'] = json_encode($company_key_results['chart']);
		$data['company_key_results_qty'] = $company_key_results['total'];
		$data['department_key_results'] = json_encode($department_key_results['chart']);
		$data['department_key_results_qty'] = $department_key_results['total'];
		$data['personal_key_results'] = json_encode($personal_key_results['chart']);
		$data['personal_key_results_qty'] = $personal_key_results['total'];
		$data['company_checkin'] = $company_checkin;
		$data['department_checkin'] = $department_checkin;
		$data['personal_checkin'] = $personal_checkin;
		$data['title'] = _l('dashboard');
		$data['active_type'] = $active_type;
		$this->load->view('dashboard/manage_dashboard', $data);
	}
	/**
	 * checkin
	 * @return view
	 */
	public function checkin() {
		if (!has_permission('okr_checkin', '', 'view') && !has_permission('okr_checkin', '', 'view_own') && !is_admin()) {
			access_denied('okr_checkin');
		}
		$data['title'] = _l('checkin');
		$data['cky_current'] = $this->okr_model->get_cky_current();
		//$data['array_tree'] = $this->okr_model->display_json_tree_checkin();
		$data['circulation'] = $this->okr_model->get_circulation();
		$data['staffs'] = $this->staff_model->get();
		$data['okrs'] = $this->okr_model->get_okrs();
		if (is_admin()) {
			$data['department'] = $this->departments_model->get();
		} else {
			$data['department'] = $this->departments_model->get_staff_departments();
		}
		$data['category'] = $this->okr_model->get_category();
		$okr_tree = array();
		$pokr = ['flag' => true, 'okr' => null, 'children' => []];
		$okr_tree[0] = $pokr;
		$arr_cir = $this->okr_model->get_array_circulation();
		$arr_staff_dept = $this->departments_model->get_staff_departments(false, true);
		$arr_dept = $this->okr_model->get_array_department();
		$arr_cat = $this->okr_model->get_array_category();
		$html = [];
		$this->okr_model->get_tree_okrs($html, $okr_tree[0], 0, '', '', '', '', '', '', false, $arr_cir, $arr_staff_dept, $arr_dept, $arr_cat, 'checkin');
		$html_string = '';
		foreach ($html as $value) {
			$html_string .= $value;
		}
		$data['array_tree'] = $html_string;
		$this->load->view('checkin/manage_checkin', $data);
	}

	/**
	 * okrs
	 * @return view
	 */
	public function okrs() {
		if (!has_permission('okr', '', 'view') && !has_permission('okr', '', 'view_own') && !is_admin()) {
			access_denied('okr');
		}
		//update old data
		$this->okr_model->update_old_okrs();

		$okr_tree = array();
		$pokr = ['flag' => true, 'okr' => null, 'children' => []];
		$okr_tree[0] = $pokr;
		$arr_cir = $this->okr_model->get_array_circulation();
		$arr_staff_dept = $this->departments_model->get_staff_departments(false, true);
		$arr_dept = $this->okr_model->get_array_department();
		$arr_cat = $this->okr_model->get_array_category();
		$html = [];
		$this->okr_model->get_tree_okrs($html, $okr_tree[0], 0, '', '', '', '', '', '', false, $arr_cir, $arr_staff_dept, $arr_dept, $arr_cat, 'okr');
		$html_string = '';
		foreach ($html as $value) {
			$html_string .= $value;
		}

		$this->load->model('staff_model');
		$data['title'] = _l('okrs');
		$data['cky_current'] = $this->okr_model->get_cky_current();
		if (is_admin()) {
			$data['department'] = $this->departments_model->get();
		} else {
			$data['department'] = $this->departments_model->get_staff_departments();
		}
		$data['category'] = $this->okr_model->get_category();
		$data['staffs'] = $this->staff_model->get();
		$data['okrs'] = $this->okr_model->get_okrs();
		$data['array_tree'] = $html_string;
		$data['circulation'] = $this->okr_model->get_circulation();
		$data['array_tree_chart'] = $this->okr_model->chart_tree_okrs();
		$this->load->view('okrs/manage_okrs', $data);
	}

	/**
	 * setting
	 * @return view
	 */
	public function setting() {
		if (!has_permission('okr_setting', '', 'view') && !has_permission('okr_setting', '', 'view_own') && !is_admin()) {
			access_denied('okr_setting');
		}
		$this->load->model('staff_model');

		$data['tab'] = $this->input->get('tab');

		if ($data['tab'] == '') {
			$data['tab'] = 'circulation';
		}

		$data['title'] = _l($data['tab']);

		$this->load->model('departments_model');

		$data['department'] = $this->departments_model->get();

		$data['okrs'] = $this->okr_model->get_okrs();

		$data['staffs'] = $this->staff_model->get();

		$this->load->view('setting/manage_setting', $data);

	}
	/*
		     * @return table
	*/
	public function table_circulation() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_circulation'));
	}
	/**
	 * setting circulation
	 * @return redirect
	 */
	public function setting_circulation() {

		if ($this->input->post()) {
			$data = $this->input->post();
			$date_format = get_option('dateformat');
			$date_format = explode('|', $date_format);
			$date_format = $date_format[0];
			if (isset($data['type'])) {
				if ($data['type'] == 'okr_yearly' && isset($data['year']) && $data['year'] != '') {
					$data['from_date'] = $data['year'] . '-01-01';
					$data['to_date'] = $data['year'] . '-12-31';
					$data['from_date'] = date($date_format, strtotime($data['from_date']));
					$data['to_date'] = date($date_format, strtotime($data['to_date']));
				} else if ($data['type'] == 'okr_quarterly' && isset($data['quarter']) && $data['quarter'] != '') {
					if ($data['quarter'] == 1) {
						$data['from_date'] = $data['year'] . '-01-01';
						$data['to_date'] = $data['year'] . '-03-31';
					} else if ($data['quarter'] == 2) {
						$data['from_date'] = $data['year'] . '-04-01';
						$data['to_date'] = $data['year'] . '-06-30';
					} else if ($data['quarter'] == 3) {
						$data['from_date'] = $data['year'] . '-07-01';
						$data['to_date'] = $data['year'] . '-09-30';
					} else if ($data['quarter'] == 4) {
						$data['from_date'] = $data['year'] . '-10-01';
						$data['to_date'] = $data['year'] . '-12-31';
					}
					$data['from_date'] = date($date_format, strtotime($data['from_date']));
					$data['to_date'] = date($date_format, strtotime($data['to_date']));
				} else if ($data['type'] == 'okr_monthly' && isset($data['month']) && $data['month'] != '') {
					$y = date('Y');
					$m = $data['month'];
					if ($m < 10) {
						$m = '0' . $m;
					}
					if (isset($data['year']) && $data['year'] > 0 && $data['year'] != '') {
						$y = $data['year'];
					}
					$eday = date("t", strtotime($y . '-' . $m));
					if ($eday < 10) {
						$eday = '0' . $eday;
					}
					$data['from_date'] = $y . '-' . $m . '-01';
					$data['to_date'] = $y . '-' . $m . '-' . $eday;
					$data['from_date'] = date($date_format, strtotime($data['from_date']));
					$data['to_date'] = date($date_format, strtotime($data['to_date']));
				}
				if (!isset($data['year']) || $data['year'] == '') {
					$data['year'] = 0;
				}
				if (!isset($data['quarter']) || $data['quarter'] == '') {
					$data['quarter'] = 0;
				}
				if (!isset($data['month']) || $data['month'] == '') {
					$data['month'] = 0;
				}
				if ($data['id'] == '') {
					unset($data['id']);
					$insert_id = $this->okr_model->setting_circulation($data);
					if ($insert_id) {
						$message = _l('added_successfully');
						set_alert('success', $message);
					}
				} else {
					$id = $data['id'];
					unset($data['id']);
					$success = $this->okr_model->update_setting_circulation($data, $id);
					if ($success) {
						$message = _l('updated_successfully');
						set_alert('success', $message);
					}
				}
			}

			redirect(admin_url('okr/setting?tab=circulation'));
		}
	}
	/**
	 * delete setting circulation
	 * @param  $id
	 * @return  redirect
	 */
	public function delete_setting_circulation($id) {
		$response = $this->okr_model->delete_setting_circulation($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('setting')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=circulation'));
	}
	/**
	 * setting question
	 * @return redirect
	 */
	public function setting_question() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['id'] == '') {
				unset($data['id']);
				$insert_id = $this->okr_model->setting_question($data);
				if ($insert_id) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->okr_model->update_setting_question($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
			}
			redirect(admin_url('okr/setting?tab=question'));
		}
	}
	/**
	 * table question
	 * @return table
	 */
	public function table_question() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_question'));
	}
	/**
	 * delete setting question
	 * @param  integer $id
	 * @return redicrect
	 */
	public function delete_setting_question($id) {
		$response = $this->okr_model->delete_setting_question($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('setting')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=question'));
	}
	/**
	 * setting evaluation criteria
	 * @return redicrect
	 */
	public function setting_evaluation_criteria() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['id'] == '') {
				unset($data['id']);
				$insert_id = $this->okr_model->setting_evaluation_criteria($data);
				if ($insert_id) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->okr_model->update_setting_evaluation_criteria($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
			}
			redirect(admin_url('okr/setting?tab=evaluation_criteria'));
		}
	}
	/**
	 * table evaluation criteria
	 * @return table
	 */
	public function table_evaluation_criteria() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_evaluation_criteria'));
	}
	/**
	 * delete setting evaluation criteria
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_setting_evaluation_criteria($id) {
		$response = $this->okr_model->delete_setting_evaluation_criteria($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('setting')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=evaluation_criteria'));
	}
	/**
	 * new object main
	 * @param  string $id
	 * @return view
	 */
	public function new_object_main($id = '') {
		$this->load->model('departments_model');
		$this->load->model('staff_model');
		$data['title'] = _l('new_okrs');
		$data['circulation'] = $this->okr_model->get_circulation();
		$data['okrs'] = $this->okr_model->get_list_okrs('', $id);
		$data['staffs'] = $this->staff_model->get();
		$data['category'] = $this->okr_model->get_category();
		if (is_admin()) {
			$data['department'] = $this->departments_model->get();
		} else {
			$data['department'] = $this->departments_model->get_staff_departments();
		}
		$data['dateformat'] = $this->departments_model->get();
		$data['unit'] = $this->okr_model->get_unit();
		$data['parent_key_result'] = $this->get_select_key_result([], '');
		$data['okr_superior'] = '';
		if ($id != '') {
			$data['title'] = _l('update_okrs');
			$data['okrs_edit'] = $this->okr_model->get_okrs_detailt($id);
			$okr = $data['okrs_edit']['object'];
			$pid = $okr->okr_superior;
			if ($pid > 0) {
				$array_kr = $this->okr_model->get_key_result($pid);
				$data['parent_key_result'] = $this->get_select_key_result($array_kr, $okr->parent_key_result);
				$data['okr_superior'] = $pid;
			}
		}
		$this->load->view('okrs/new_object_main', $data);
	}
	/**
	 * okrs_new_main
	 * @return redirect
	 */
	public function okrs_new_main() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['id'] == '') {
				$insert_id = $this->okr_model->new_okrs_main($data);
				if ($insert_id) {
					unset($attachments);
					handle_okrs_attachments($insert_id);
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
				redirect(admin_url('okr/okrs'));
			} else {
				$id = $data['id'];
				unset($data['id']);
				unset($attachments);
				$success = $this->okr_model->update_okrs_main($data, $id);
				if ($success) {
					handle_okrs_attachments($id);
					$message = _l('updated_successfully');
					set_alert('success', $message);
				} else {
					$message = _l('OKR_selection_problem_above_invites_you_to_try_again');
					set_alert('danger', $message);
				}
				redirect(admin_url('okr/new_object_main/' . $id));
			}
		}
	}
	/**
	 * get not child
	 * @return echo data
	 */
	public function get_not_child() {
		$data = $this->okr_model->chart_tree_okrs_clone($this->input->post());
		echo ($data);
	}
	/**
	 * objective show
	 * @return json
	 */
	public function objective_show() {
		$id = $this->input->post('id');
		$data = $this->okr_model->objective_show($id);
		echo json_encode([$data]);
	}
	/**
	 * checkin detailt
	 * @param  integer $id
	 * @return view
	 */
	public function checkin_detailt($id) {
		$data['staffs_approval'] = $this->staff_model->get();

		$data['tasks'] = $this->db->get(db_prefix() . 'tasks')->result_array();

		$data['tab'] = $this->input->get('tab');
		if ($data['tab'] == '') {
			$data['tab'] = 'checkin';
		}
		$data['title'] = _l($data['tab']);
		$change = $this->okr_model->count_key_results($id)->count;
		$name = $this->okr_model->get_okrs($id)->your_target;
		$progress = $this->okr_model->get_okrs($id)->progress;
		$circulation = $this->okr_model->get_circulation($this->okr_model->get_okrs($id)->circulation);
		if (is_null($progress)) {
			$progress = 0;
		}
		$checkin_main = $this->okr_model->get_okrs($id);
		$staff_apply = [];
		switch ($checkin_main->type) {
		case '1':
			$staff_apply[] = $checkin_main->person_assigned;
			break;
		case '2':
			$staffs_by_department = okrs_get_all_staff_by_department($checkin_main->department);
			if (count($staffs_by_department) > 0) {
				foreach ($staffs_by_department as $key => $staffid) {
					array_push($staff_apply, $staffid['staffid']);
				}
			}
			break;
		case '3':
			$staffs_all = $this->staff_model->get();
			if (count($staffs_all) > 0) {
				foreach ($staffs_all as $key => $staffid) {
					array_push($staff_apply, $staffid['staffid']);
				}
			}
			break;
		}
		if (!in_array($checkin_main->creator, $staff_apply)) {
			array_push($staff_apply, $checkin_main->creator);
		}

		$question = $this->okr_model->get_question($id);
		$recently_checkin = $this->okr_model->get_okrs($id)->recently_checkin;
		$key_result_checkin = $this->okr_model->get_key_result_checkin($id);
		$get_key_result = $this->okr_model->get_key_result($id);
		$get_evaluation_criteria = $this->okr_model->get_evaluation_criteria(1);
		$data['id'] = $id;
		$data['name'] = $name;
		$data['change'] = $change;
		$data['progress'] = $progress;
		$data['question'] = $question;
		$data['count_question'] = count($question);
		$data['get_key_result'] = $get_key_result;
		$data['evaluation_criteria'] = $get_evaluation_criteria;
		$data['key_result_checkin'] = $key_result_checkin;
		$data['circulation'] = $circulation;
		$data['staff_apply'] = $staff_apply;
		$data['checkin_main'] = $checkin_main;

		$approval_setting = $this->okr_model->get_approve_setting($checkin_main->department, $id);

		$data_approver_setting = $this->okr_model->get_approve_setting($checkin_main->department, $id, false);

		$date_format = get_option('dateformat');
		$date_format = explode('|', $date_format);
		$date_format = $date_format[0];
		$data['data_approve'] = $this->okr_model->get_approval_details_by_rel_id_and_rel_type($id, "checkin");
		$data['special_characters'] = substr($date_format, 1, 1);

		if (is_null($recently_checkin)) {
			$recently_checkin = date($date_format);
		}
		$data['format'] = $date_format[0];

		$data['date_checkin'] = $recently_checkin;

		$allow = false;
		if (has_permission('okr', '', 'view_own')) {
			$allow = true;
		}
		if ($approval_setting) {
			//Approval setting

			foreach ($approval_setting as $key_approval_setting => $value_approval_setting) {
				array_push($staff_apply, $value_approval_setting->staff);
			}
			if ($allow == false && (!in_array(get_staff_user_id(), $staff_apply) || !is_admin())) {
				access_denied('okr');
			}

			if ($data_approver_setting) {
				$data['choose_when_approving'] = $data_approver_setting->choose_when_approving;
			}

		} else {

			if ($allow == false && (!in_array(get_staff_user_id(), $staff_apply) || !is_admin())) {
				access_denied('okr');
			}

		}
		$this->load->view('checkin/checkin_detailt', $data);
	}
	/**
	 * highcharts detailt checkin
	 * @param  integer $id
	 * @return json
	 */
	public function highcharts_detailt_checkin($id) {
		echo json_encode($this->okr_model->highcharts_detailt_checkin_model($id));
	}
	/**
	 * add checkin
	 * @return redirect
	 */
	public function add_check_in() {
		$insert_id = $this->okr_model->add_check_in($this->input->post());
		if ($insert_id) {
			handle_checkin_attachments($insert_id);
			$message = _l('added_successfully');
			set_alert('success', $message);
		}
		redirect(admin_url('okr/checkin_detailt/' . $this->input->post()['id']));
	}
	/**
	 * table history
	 * @return table
	 */
	public function table_history() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_history'));
	}
	/**
	 * get search okrs
	 * @param  integer $id
	 * @return json
	 */
	public function get_search_okrs($id) {
		$array_tree = $this->okr_model->display_json_tree_okrs_search($id);
		$array_tree_chart = $this->okr_model->chart_tree_search($id);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart]);
	}
	/**
	 * view details
	 * @param  integer $id
	 * @return view
	 */
	public function view_details($id) {
		$data['title'] = _l('view_details');
		$log_okr_id = $this->okr_model->result_checkin_log($id, true);
		$question = $this->okr_model->get_question($log_okr_id->okrs_id);
		$data['count_question'] = count($question);
		$get_key_result = $this->okr_model->get_key_result($log_okr_id->okrs_id);
		$key_result_checkin = $this->okr_model->result_checkin_log($id, '', count($get_key_result));
		$name = '';
		$circulation = '';
		$okr = $this->okr_model->get_okrs($log_okr_id->okrs_id);
		if (isset($okr)) {
			$name = $okr->your_target;
			$circulation = $okr->name_circulation;
		}
		$progress = $log_okr_id->progress_total;
		$recently_checkin = $log_okr_id->recently_checkin;
		$get_evaluation_criteria = $this->okr_model->get_evaluation_criteria(1);
		$list_kr_id = [];
		foreach ($key_result_checkin as $krc) {
			$list_kr_id[] = $krc['id'];
		}
		$data['list_checkin_ids'] = $list_kr_id;
		$data['id'] = $log_okr_id->okrs_id;
		$data['name'] = $name;
		$data['circulation'] = $circulation;
		$data['progress'] = $progress;
		$data['question'] = $question;
		$data['get_key_result'] = $get_key_result;
		$data['evaluation_criteria'] = $get_evaluation_criteria;
		$data['key_result_checkin'] = $key_result_checkin;
		$date_format = get_option('dateformat');
		$date_format = explode('|', $date_format);
		$date_format = $date_format[0];
		if (is_null($recently_checkin)) {
			$recently_checkin = date($date_format);
		}

		$data['date_checkin'] = $recently_checkin;
		$this->load->view('checkin/view_details', $data);
	}
	/**
	 * get search okrs staff
	 * @param  integer $staffid
	 * @return
	 */
	public function get_search_okrs_staff($staffid) {
		$flag = 0;
		if ($staffid == 0) {
			$array_id[] = 0;
		} else {
			$array_id = $this->okr_model->get_okr_staff($staffid);
			if (count($array_id) > 0) {
				$flag = 2;
			} else {
				$flag = 1;
			}
		}
		$array_tree = $this->okr_model->display_json_tree_okrs_search_staff($array_id);
		$array_tree_chart = $this->okr_model->chart_tree_search_staff($array_id);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart, 'flag' => $flag]);
	}
	/**
	 * get search checkin
	 * @param  integer $id
	 * @return json
	 */
	public function get_search_checkin($id) {
		$array_tree = $this->okr_model->display_tree_okrs_search_checkin($id);
		echo json_encode(['array_tree_search' => $array_tree]);
	}
	/**
	 * get search checkin staff
	 * @param  integer $staffid
	 * @return json
	 */
	public function get_search_checkin_staff($staffid) {
		if ($staffid == 0) {
			$array_id[] = 0;
		} else {
			$array_id = $this->okr_model->get_okr_staff($staffid);
		}
		$array_tree = $this->okr_model->display_tree_checkin_search_staff($array_id);
		echo json_encode(['array_tree_search' => $array_tree]);
	}
	/**
	 * get_search_okrs_circulation
	 * @param  integer $circulationid
	 * @return json
	 */
	public function get_search_okrs_circulation($circulationid) {
		$array_tree = $this->okr_model->display_json_tree_okrs($circulationid);
		$array_tree_chart = $this->okr_model->chart_tree_okrs_circulation($circulationid);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart]);
	}
	/**
	 * table unit
	 * @return table
	 */
	public function table_unit() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_unit'));
	}
	/**
	 * setting unit
	 * @return redirect
	 */
	public function setting_unit() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['id'] == '') {
				unset($data['id']);
				$insert_id = $this->okr_model->setting_unit($data);
				if ($insert_id) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->okr_model->update_setting_unit($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
			}
			redirect(admin_url('okr/setting?tab=unit'));
		}
	}
	/**
	 * delete setting unit
	 * @param  integer $id
	 * @return  redirect
	 */
	public function delete_setting_unit($id) {
		$response = $this->okr_model->delete_setting_unit($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('setting')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=unit'));
	}

	/**
	 * get search checkin circulation
	 * @param  integer $circulation_id
	 * @return json
	 */
	public function get_search_checkin_circulation($circulation_id) {
		$array_tree = $this->okr_model->display_json_tree_checkin($circulation_id);

		echo json_encode(['array_tree_search' => $array_tree]);
	}
	/**
	 * get staff profile
	 * @param  integer $staffid
	 * @return
	 */
	public function get_staff_profile($staffid) {
		$full_name =
		'<div class="pull-right">' . staff_profile_image($staffid, ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . get_staff_full_name($staffid) . '</a> </div>';
		echo json_encode($full_name);
	}
	/**
	 * delete okrs
	 * @param  integer $id
	 * @return redirect
	 */
	public function delete_okrs($id) {
		$response = $this->okr_model->delete_okrs($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('okr')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/okrs'));
	}
	/**
	 * show detail node
	 * @param  integer $okrs_id
	 * @return  view
	 */
	public function show_detail_node($okrs_id) {
		$okr = $this->okr_model->get_okrs($okrs_id);
		$data['key_results'] = $this->okr_model->get_key_result($okrs_id);
		$data['your_target'] = $okr->your_target;
		$data['okrs_id'] = $okr->id;
		if ($okr->okr_superior > 0) {
			$data['parent_okr'] = $this->okr_model->get_okrs($okr->okr_superior);
			if ($okr->parent_key_result > 0) {
				$data['parent_key_result'] = $this->okr_model->get_key_result($okr->okr_superior, $okr->parent_key_result);
			}
		}
		if ($okr->type == 1) {
			$data['person_assigned'] = staff_profile_image($okr->person_assigned, ['img img-responsive staff-profile-image-small pull-left']) . '  ' . '<span>' . get_staff_full_name($okr->person_assigned) . '</span>';
		} else if ($okr->type == 2) {
			$dept_name = _l('department');
			$dept = get_department_name_of_okrs($okr->department);
			if ($dept) {
				$dept_name = $dept->name;
			}
			$data['person_assigned'] = $dept_name;
		} else {
			$company_name = get_option('invoice_company_name');
			if ($company_name == '') {
				$company_name = _l('company');
			}
			$data['person_assigned'] = $company_name;
		}

		if ($okr->status == 1) {
			$data['status'] = '<span class="label label-success s-status ">' . _l('finish') . '</span>';
		} else {
			$data['status'] = '<span class="label label-warning s-status ">' . _l('unfinished') . '</span>';
		}
		if (is_null($okr->progress)) {
			$okr->progress = 0;
		}

		$data['progress'] =
		'<div class="progress no-margin cus_tran">
      <div class="progress-bar progress-bar-success no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $okr->progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $okr->progress . '%;" data-percent="' . $okr->progress . '">
      </div>
      </div>
      <div>
      ' . $okr->progress . '%
      </div> ';
		$circulation = $this->okr_model->get_circulation($okr->circulation);
		if ($circulation) {
			$data['circulation'] = $circulation->name_circulation . ' (' . $circulation->from_date . ' - ' . $circulation->to_date . ')';
		} else {
			$data['circulation'] = '';
		}
		if ($okr->display == 1) {
			$data['display'] = _l('public');
		} else {
			$data['display'] = _l('private');
		}
		$add_task = 1;
		if ($okr->type == 3 && !(has_permission('okr', '', 'edit_company'))) {
			$add_task = 0;
		} else if ($okr->person_assigned != get_staff_user_id() && (has_permission('okr', '', 'create') || has_permission('okr', '', 'edit'))) {
			$add_task = 0;
		}
		if (is_admin()) {
			$add_task = 1;
		}

		$data['title'] = _l('okr_detail');
		$data['add_task'] = $add_task;
		$this->load->view('okrs/view_details', $data);

	}

	/**
	 * table category
	 * @return table
	 */
	public function table_category() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_category'));
	}

	/**
	 * delete setting category
	 * @param  integer $id
	 * @return  redirect
	 */
	public function delete_setting_category($id) {
		$response = $this->okr_model->delete_setting_category($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('setting')));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=category'));
	}

	/**
	 * setting categoty
	 * @return redirect
	 */
	public function setting_category() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['id'] == '') {
				unset($data['id']);
				$insert_id = $this->okr_model->setting_category($data);
				if ($insert_id) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
			} else {
				$id = $data['id'];
				unset($data['id']);
				$success = $this->okr_model->update_setting_category($data, $id);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
			}
			redirect(admin_url('okr/setting?tab=category'));
		}
	}
	/**
	 *  preview file okrs
	 *
	 * @param      <type>  $id      The identifier
	 * @param      <type>  $rel_id  The relative identifier
	 */
	public function file_okrs($id, $rel_id) {
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin'] = is_admin();
		$data['file'] = $this->okr_model->get_okrs_attachments($id, $rel_id);

		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('okrs/_file_okrs', $data);
	}

	/**
	 * preview_checkin_file
	 * @param  int $id
	 * @param  int $rel_id
	 * @return  view
	 */
	public function preview_checkin_file($id, $rel_id) {
		$data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
		$data['current_user_is_admin'] = is_admin();
		$data['file'] = $this->okr_model->get_checkin_attachments($id, $rel_id);

		if (!$data['file']) {
			header('HTTP/1.0 404 Not Found');
			die;
		}
		$this->load->view('checkin/_file_checkin', $data);
	}

	/**
	 *  delete okrs attachment
	 *
	 * @param    $id     The identifier
	 */
	public function delete_okrs_attachment($id) {
		$this->load->model('misc_model');
		$file = $this->misc_model->get_file($id);
		if ($file->staffid == get_staff_user_id() || is_admin()) {
			echo $this->okr_model->delete_okrs_attachment($id);
		} else {
			header('HTTP/1.0 400 Bad error');
			echo _l('access_denied');
			die;
		}
	}

	/**
	 * delete_checkin_attachment
	 * @param  int $id
	 * @return
	 */
	public function delete_checkin_attachment($id) {
		$this->load->model('misc_model');
		$file = $this->misc_model->get_file($id);
		if ($file->staffid == get_staff_user_id() || is_admin()) {
			echo $this->okr_model->delete_checkin_attachment($id);
		} else {
			header('HTTP/1.0 400 Bad error');
			echo _l('access_denied');
			die;
		}
	}

	/**
	 * table dashboard
	 * @return table
	 */
	public function table_dashboard() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_dashboard'));
	}

	/**
	 * get_search_okrs_type
	 * @param  integer $type
	 * @return json
	 */
	public function get_search_okrs_type($type) {
		$array_tree = $this->okr_model->display_json_tree_okrs_type($type);
		$array_tree_chart = $this->okr_model->chart_tree_okrs_type($type);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart]);
	}

	/**
	 * get_search_okrs_category
	 * @param  integer $category
	 * @return json
	 */
	public function get_search_okrs_category($category) {
		$array_tree = $this->okr_model->display_json_tree_okrs_category($category);
		$array_tree_chart = $this->okr_model->chart_tree_okrs_category($category);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart]);
	}

	/**
	 * get_search_okrs_department
	 * @param  integer $department
	 * @return json
	 */
	public function get_search_okrs_department($department) {
		$array_tree = $this->okr_model->display_json_tree_okrs_department($department);
		$array_tree_chart = $this->okr_model->chart_tree_okrs_department($department);
		echo json_encode(['array_tree_search' => $array_tree, 'array_tree_chart_search' => $array_tree_chart]);
	}

	/**
	 * get search checkin type
	 * @param  integer $type
	 * @return json
	 */
	public function get_search_checkin_type($type) {
		$array_tree = $this->okr_model->display_json_tree_checkin_type($type);

		echo json_encode(['array_tree_search' => $array_tree]);
	}
	/**
	 * get search checkin type
	 * @param  integer $type
	 * @return json
	 */
	public function get_search_checkin_department($department) {
		$array_tree = $this->okr_model->display_json_tree_checkin_department($department);

		echo json_encode(['array_tree_search' => $array_tree]);
	}

	/**
	 * get search checkin type
	 * @param  integer $type
	 * @return json
	 */
	public function get_search_checkin_category($category) {
		$array_tree = $this->okr_model->display_json_tree_checkin_category($category);

		echo json_encode(['array_tree_search' => $array_tree]);
	}

	/**
	 * report
	 * @return view
	 */
	public function report() {
		if (!has_permission('okr_report', '', 'view') && !has_permission('okr_report', '', 'view_own') && !is_admin()) {
			access_denied('okr_report');
		}
		$this->load->model('staff_model');

		$data['title'] = _l('report');
		$data['okrs'] = $this->okr_model->get_okrs();
		$data['progress_good'] = $this->okr_model->get_progress_dashboard(1)->count;
		$data['progress_risk'] = $this->okr_model->get_progress_dashboard(2)->count;
		$data['progress_develope'] = $this->okr_model->get_progress_dashboard(3)->count;
		$data['checkin_status'] = json_encode($this->okr_model->checkin_status_dashboard());
		$data['okrs_company'] = $this->okr_model->okrs_company_dasdboard();
		$data['okrs_user'] = $this->okr_model->okrs_user_dasdboard();
		$data['person_assigned'] = $this->staff_model->get();
		$data['circulation'] = $this->okr_model->get_circulation();
		$data['category'] = $this->okr_model->get_category();
		$data['department'] = $this->departments_model->get();
		$this->load->view('report/manage_report', $data);
	}

	/**
	 * okrs
	 * @return view
	 */
	public function okrs_chart_org() {
		if (!has_permission('okr', '', 'view') && !has_permission('okr', '', 'view_own') && !is_admin()) {
			access_denied('okr');
		}
		$this->load->model('staff_model');
		$data['title'] = _l('okrs');
		$data['cky_current'] = $this->okr_model->get_cky_current();
		if (is_admin()) {
			$data['department'] = $this->departments_model->get();
		} else {
			$data['department'] = $this->departments_model->get_staff_departments();
		}
		$data['category'] = $this->okr_model->get_category();
		$data['staffs'] = $this->staff_model->get();
		$data['okrs'] = $this->okr_model->get_okrs();
		$data['array_tree'] = '';
		$data['circulation'] = $this->okr_model->get_circulation();
		$data['array_tree_chart'] = $this->okr_model->chart_tree_okrs();
		$this->load->view('okrs/manage_okrs_org', $data);
	}

	/**
	 * set okr superior
	 * @param int $id
	 */
	public function set_okr_superior($id) {
		$this->db->where('circulation', $id);
		$rs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$html = '';
		foreach ($rs as $key => $value) {
			$html .= '<option value="' . $value['id'] . '">' . $value['your_target'] . '</option>';
		}
		echo json_encode($html);
	}

	/**
	 * approval table
	 * @return json
	 */
	public function approval_table() {
		if ($this->input->is_ajax_request()) {
			if ($this->input->post()) {

				$select = [
					'id',
					'name',
					'department',

				];

				$where = [];

				$aColumns = $select;
				$sIndexColumn = 'id';
				$sTable = db_prefix() . 'okr_approval_setting';
				$join = [];

				$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
					'id',
					'name',
					'department',
					'okrs',
				]);

				$output = $result['output'];
				$rResult = $result['rResult'];
				foreach ($rResult as $aRow) {
					$row = [];
					$row[] = $aRow['id'];
					$row[] = $aRow['name'];

					$department_name = [];
					$okrs_name = [];


					if ($aRow['department'] != '' || $aRow['department'] != null) {
						$department = explode(',', $aRow['department']);

						if (count($department) > 0) {
							foreach ($department as $key_department => $value_department) {
								$department_name[] = get_department_name_of_okrs($value_department)->name;
							}
						}
					}
					$row[] = count($department_name) > 0 ? implode(',', $department_name) : '';

					if ($aRow['okrs'] != '' || $aRow['okrs'] != null) {
						$okrs = explode(',', $aRow['okrs']);

						if (count($okrs) > 0) {
							foreach ($okrs as $key_okrs => $value_okr) {
								$okrs_name[] = okr_name($value_okr);
							}
						}
					}
					$row[] = count($okrs_name) > 0 ? implode(',', $okrs_name) : '';

					$option = '';

					$option .= '<a href="#" onclick="update_approve(this)" class="btn btn-default btn-icon" data-id="' . $aRow['id'] . '" >';
					$option .= '<i class="fa fa-pencil-square"></i>';
					$option .= '</a>';
					$option .= '<a href="' . admin_url('okr/delete_approval_settings/' . $aRow['id']) . '" class="btn btn-danger btn-icon _delete">';
					$option .= '<i class="fa fa-remove"></i>';
					$option .= '</a>';
					$row[] = $option;
					$output['aaData'][] = $row;
				}
				echo json_encode($output);
				die();
			}
		}
	}

	/**
	 * approval setting
	 * @return redirect
	 */
	public function approval_setting() {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($data['approval_setting_id'] == '') {
				$message = '';
				$success = $this->okr_model->add_approval_setting($data);
				if ($success) {
					$message = l('added_successfully', l('approval_setting'));
				}
				set_alert('success', $message);
				redirect(admin_url('okr/setting?tab=approval_setting'));
			} else {
				$message = '';
				$id = $data['approval_setting_id'];
				$success = $this->okr_model->edit_approval_setting($id, $data);
				if ($success) {
					$message = l('updated_successfully', l('approval_setting'));
				}
				set_alert('success', $message);
				redirect(admin_url('okr/setting?tab=approval_setting'));
			}
		}
	}

	/**
	 * delete approval setting
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_approval_setting($id) {
		if (!$id) {
			redirect(admin_url('okr/setting?tab=approval_setting'));
		}
		$response = $this->okr_model->delete_approval_setting($id);
		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', l('is_referenced', l('approval_setting')));
		} elseif ($response == true) {
			set_alert('success', l('deleted', l('payment_mode')));
		} else {
			set_alert('warning', l('problem_deleting', l('approval_setting')));
		}
		redirect(admin_url('okr/setting?tab=approval_setting'));
	}

	/**
	 * get html approval setting
	 * @param  string $id
	 * @return json
	 */
	public function get_html_approval_setting($id = '') {
		$html = '';
		$staffs = $this->staff_model->get();
		$approver = [
			0 => ['id' => 'direct_manager', 'name' => _l('direct_manager')],
			1 => ['id' => 'department_manager', 'name' => _l('department_manager')],
			2 => ['id' => 'staff', 'name' => _l('staff')]];
		$action = [
			0 => ['id' => 'sign', 'name' => _l('sign')],
			1 => ['id' => 'approve', 'name' => _l('approve')],
		];
		if (is_numeric($id)) {
			$approval_setting = $this->okr_model->get_approval_setting($id);

			$setting = json_decode($approval_setting->setting);

			foreach ($setting as $key => $value) {
				if ($key == 0) {
					$html .= '<div id="item_approve">
          <div class="col-md-11">
          <div class="col-md-4"> ' .
					render_select('approver[' . $key . ']', $approver, array('id', 'name'), 'task_single_related', $value->approver) . '
          </div>
          <div class="col-md-4">
          ' . render_select('staff[' . $key . ']', $staffs, array('staffid', 'full_name'), 'staff', $value->staff) . '
          </div>
          <div class="col-md-4">
          ' . render_select('action[' . $key . ']', $action, array('id', 'name'), 'action', $value->action) . '
          </div>
          </div>
          <div class="col-md-1" style="display: contents;line-height: 84px;white-space: nowrap;">
          <span class="pull-bot">
          <button name="add" class="btn new_vendor_requests btn-success" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
          </span>
          </div>
          </div>';
				} else {
					$html .= '<div id="item_approve">
         <div class="col-md-11">
         <div class="col-md-4">
         ' .
					render_select('approver[' . $key . ']', $approver, array('id', 'name'), 'task_single_related', $value->approver) . '
         </div>
         <div class="col-md-4">
         ' . render_select('staff[' . $key . ']', $staffs, array('staffid', 'full_name'), 'staff', $value->staff) . '
         </div>
         <div class="col-md-4">
         ' . render_select('action[' . $key . ']', $action, array('id', 'name'), 'action', $value->action) . '
         </div>
         </div>
         <div class="col-md-1" style="display: contents;line-height: 84px;white-space: nowrap;">
         <span class="pull-bot">
         <button name="add" class="btn remove_vendor_requests btn-danger" data-ticket="true" type="button"><i class="fa fa-minus"></i></button>
         </span>
         </div>
         </div>';
				}
			}
		} else {
			$html .= '<div id="item_approve">
    <div class="col-md-11">
    <div class="col-md-4"> ' .
			render_select('approver[0]', $approver, array('id', 'name'), 'task_single_related') . '
    </div>
    <div class="col-md-4">
    ' . render_select('staff[0]', $staffs, array('staffid', 'full_name'), 'staff') . '
    </div>
    <div class="col-md-4">
    ' . render_select('action[0]', $action, array('id', 'name'), 'action') . '
    </div>
    </div>
    <div class="col-md-1" style="display: contents;line-height: 84px;white-space: nowrap;">
    <span class="pull-bot">
    <button name="add" class="btn new_vendor_requests btn-success" data-ticket="true" type="button"><i class="fa fa-plus"></i></button>
    </span>
    </div>
    </div>';
		}

		echo json_encode([
			$html,
		]);
	}

	/**
	 * send request approve
	 * @return json
	 */
	public function send_request_approve() {
		$data = $this->input->post();
		$message = 'Send request approval fail';
		$success = $this->accounting_model->send_request_approve($data);
		if ($success === true) {
			$message = 'Send request approval success';
			$data_new = [];
			$data_new['send_mail_approve'] = $data;
			$this->session->set_userdata($data_new);
		} elseif ($success === false) {
			$message = _l('no_matching_process_found');
			$success = false;

		} else {
			$message = l('could_not_find_approver_with', l($success));
			$success = false;
		}
		echo json_encode([
			'success' => $success,
			'message' => $message,
		]);
		die;
	}

	/**
	 * send mail
	 * @return json
	 */
	public function send_mail() {
		if ($this->input->is_ajax_request()) {
			$data = $this->input->post();
			if ((isset($data)) && $data != '') {
				$this->accounting_model->send_mail($data);

				$success = 'success';
				echo json_encode([
					'success' => $success,
				]);
			}
		}
	}

	/**
	 * approve request
	 * @return json
	 */
	public function approve_request() {
		$data = $this->input->post();
		$data['staff_approve'] = get_staff_user_id();
		$success = false;
		$code = '';
		$signature = '';

		if (isset($data['signature'])) {
			$signature = $data['signature'];
			unset($data['signature']);
		}
		$status_string = 'status_' . $data['approve'];
		$check_approve_status = $this->okr_model->check_approval_details($data['rel_id'], "checkin");

		if (isset($data['approve']) && in_array(get_staff_user_id(), $check_approve_status['staffid'])) {

			$success = $this->okr_model->update_approval_details($check_approve_status['id'], $data);

			$message = _l('approved_successfully');

			if ($success) {
				if ($data['approve'] == 1) {
					$message = _l('approved_successfully');
					$data_log = [];

					if ($signature != '') {
						$data_log['note'] = "signed_request";
					} else {
						$data_log['note'] = "approve_request";
					}
					if ($signature != '') {
						switch ($data['rel_type']) {
						case 'payslip':
							$path = ACCOUNTING_PAYSLIP_ATTACHMENTS_FOLDER . $data['rel_id'];
							break;
						case 'receipt':
							$path = ACCOUNTING_RECEIPT_ATTACHMENTS_FOLDER . $data['rel_id'];
							break;
						default:
							$path = ACCOUNTING_PAYSLIP_ATTACHMENTS_FOLDER;
							break;
						}
						accounting_process_digital_signature_image($signature, $path, 'signature_' . $check_approve_status['id']);
						$message = _l('sign_successfully');
					}
					$data_log['rel_id'] = $data['rel_id'];
					$data_log['rel_type'] = $data['rel_type'];
					$data_log['staffid'] = get_staff_user_id();
					$data_log['date'] = date('Y-m-d H:i:s');

					$check_approve_status = $this->okr_model->check_approval_details($data['rel_id'], "checkin");
					if ($check_approve_status === true) {
						$this->okr_model->update_approve_request($data['rel_id'], "checkin", 1);
					}
				} else {
					$message = _l('rejected_successfully');
					$data_log = [];
					$data_log['rel_id'] = $data['rel_id'];
					$data_log['rel_type'] = $data['rel_type'];
					$data_log['staffid'] = get_staff_user_id();
					$data_log['date'] = date('Y-m-d H:i:s');
					$data_log['note'] = "rejected_request";
					$this->accounting_model->add_activity_log($data_log);
					$this->accounting_model->update_approve_request($data['rel_id'], $data['rel_type'], '-1');
				}
			}
		}

		$data_new = [];
		$data_new['send_mail_approve'] = $data;
		$this->session->set_userdata($data_new);
		echo json_encode([
			'success' => $success,
			'message' => $message,
		]);
		die();
	}

	/**
	 * approver setting
	 * @return redirect
	 */
	public function approver_setting() {
		if ($this->input->post()) {
			$data = $this->input->post();

			$id = $data['approval_setting_id'];
			unset($data['approval_setting_id']);
			if ($id == '') {
				$id = $this->okr_model->add_approval_process($data);
				if ($id) {
					$message = _l('added_successfully');
					set_alert('success', $message);
				}
			} else {
				$success = $this->okr_model->update_approval_process($id, $data);
				if ($success) {
					$message = _l('updated_successfully');
					set_alert('success', $message);
				}
			}
		}
		redirect(admin_url('okr/setting?tab=approval_process'));
	}

	/**
	 * delete approval settings
	 * @param  int $id
	 * @return redirect
	 */
	public function delete_approval_settings($id) {
		$response = $this->okr_model->delete_approval_setting($id);
		if ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('okr/setting?tab=approval_process'));
	}

	/**
	 * approve request form
	 * @return json
	 */
	public function approve_request_form() {
		$data = $this->input->post();
		$data['date'] = date('Y-m-d');
		$data['staffid'] = get_staff_user_id();
		$success = $this->okr_model->change_approve($data);
		$message = '';
		if ($success == true) {
			$message = _l('success');
		} else {
			$message = _l('fail');
		}
		echo json_encode([
			'success' => $success,
			'message' => $message,
		]);
		die();
	}

/**
 * get approve setting
 * @param  integer $id
 * @return bool
 */
	public function get_approve_setting($id) {
		$data_setting = $this->okr_model->get_approve_setting_okr($id, false);
		$data_setting->notification_recipient = array_map('intval', explode(',', $data_setting->notification_recipient ?? ''));
		$data_setting->department = array_map('intval', explode(',', $data_setting->department ?? ''));
		$data_setting->okrs = array_map('intval', explode(',', $data_setting->okrs ?? ''));
		echo json_encode([
			'success' => true,
			'data_setting' => $data_setting,
		]);
		die();
	}

	/**
	 * [update_key_result_with_task description]
	 * @return [type] [description]
	 */
	public function update_key_result_with_task() {
		$data = $this->input->post();
		$success = $this->okr_model->update_key_result_with_task($data);
		if ($success) {
			$message = _l('add_task_success');
			set_alert('success', $message);
		}
		redirect(admin_url('okr/checkin_detailt/' . $data['okrs_id']));
	}

	/**
	 * [task_list_view_key_result description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function task_list_view_key_result($id) {
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'key_results');
		$key_results = $this->db->get(db_prefix() . 'tasks')->result_array();
		$kr = '';
		if (isset($key_results) && count($key_results) > 0) {
			for ($i = 0; $i < count($key_results) - 1; $i++) {
				$kr .= $key_results[$i]['id'] . ',';
			}
			$kr .= $key_results[count($key_results) - 1]['id'];
		}
		echo json_encode($kr);
	}

	/**
	 * task list table
	 * @return view
	 */
	public function task_list_table() {
		$this->app->get_table_data(module_views_path('okr', 'table/table_task'));
	}

	/**
	 * remove task key result
	 * @param  [type] $id      [description]
	 * @param  [type] $id_task [description]
	 * @param  [type] $okrs_id [description]
	 * @return [type]          [description]
	 */
	public function remove_task_key_result($id, $id_task, $okrs_id) {
		$this->db->where('id', $id);
		$key_results = $this->db->get(db_prefix() . 'okrs_key_result')->row()->tasks;
		$tasks = explode(',', $key_results);
		$find_index = array_search($id_task, $tasks);

		unset($tasks[$find_index]);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okrs_key_result', ['tasks' => implode(',', $tasks)]);

		redirect(admin_url('okr/checkin_detailt/' . $okrs_id));
	}

	/**
	 * export okr
	 * @return json
	 */
	public function export_okr() {
		if (!class_exists('XLSXReader_fin')) {
			require_once module_dir_path(OKR_MODULE_NAME) . '/third_party/XLSXReader/XLSXReader.php';
		}
		require_once module_dir_path(OKR_MODULE_NAME) . '/third_party/XLSXWriter/xlsxwriter.class.php';
		//if ($this->input->post()) {
		$all_okrs = $this->okr_model->get_all_okrs();
		$array_okrs = $this->okr_model->get_array_okrs();
		$array_kr = $this->okr_model->get_array_key_result();
		$set_col_tk = [];
		$set_col_tk[_l('your_target')] = 'string';
		$set_col_tk[_l('circulation')] = 'string';
		$set_col_tk[_l('type')] = 'string';
		$set_col_tk[_l('department')] = 'string';
		$set_col_tk[_l('person_assigned')] = 'string';
		$set_col_tk[_l('category')] = 'string';
		$set_col_tk[_l('display')] = 'string';
		$set_col_tk[_l('main_results')] = 'string';
		$set_col_tk[_l('target')] = 'string';
		$set_col_tk[_l('unit')] = 'string';
		$set_col_tk[_l('okr_superior')] = 'string';
		$set_col_tk[_l('parent_key_result')] = 'string';
		$set_col_tk[_l('plan')] = 'string';
		$set_col_tk[_l('results')] = 'string';
		$widthst = [50, 20, 15, 20, 20, 20, 15, 50, 10, 10, 50, 50, 50, 50];
		$writer_header = $set_col_tk;

		$writer = new XLSXWriter();
		$writer->writeSheetHeader('Sheet1', $writer_header, $col_options = ['widths' => $widthst, 'fill' => '#C65911', 'font-style' => 'bold', 'color' => '#FFFFFF', 'border' => 'left,right,top,bottom', 'height' => 25, 'border-color' => '#FFFFFF', 'font-size' => 13, 'font' => 'Calibri']);
		$style1 = array('fill' => '#F8CBAD', 'height' => 25, 'border' => 'left,right,top,bottom', 'border-color' => '#FFFFFF', 'font-size' => 12, 'font' => 'Calibri', 'color' => '#000000');
		$style2 = array('fill' => '#FCE4D6', 'height' => 25, 'border' => 'left,right,top,bottom', 'border-color' => '#FFFFFF', 'font-size' => 12, 'font' => 'Calibri', 'color' => '#000000');
		foreach ($all_okrs as $k => $value) {
			$list_add = [];
			$list_add[] = $value['your_target'];
			$list_add[] = $value['name_circulation'];
			if ($value['type'] == 1) {
				$list_add[] = _l('personal');
			} else if ($value['type'] == 2) {
				$list_add[] = _l('department');
			} else {
				$list_add[] = _l('company');
			}
			$list_add[] = $value['department_name'];
			$list_add[] = $value['staff_full_name'];
			$list_add[] = $value['category'];
			if ($value['display'] == 1) {
				$list_add[] = _l('public');
			} else {
				$list_add[] = _l('private');
			}
			$list_add[] = $value['main_results'];
			$list_add[] = $value['target'];
			$list_add[] = $value['unit'];
			$parent_okr = '';
			$parent_key_result = '';
			if ($value['okr_superior'] > 0 && isset($array_okrs[$value['okr_superior']])) {
				$parent_okr = $array_okrs[$value['okr_superior']];
			}
			if ($value['parent_key_result'] > 0 && isset($array_kr[$value['parent_key_result']])) {
				$parent_key_result = $array_kr[$value['parent_key_result']];
			}
			$list_add[] = $parent_okr;
			$list_add[] = $parent_key_result;
			$list_add[] = $value['plan'];
			$list_add[] = $value['results'];
			if (($k % 2) == 0) {
				$writer->writeSheetRow('Sheet1', $list_add, $style1);
			} else {
				$writer->writeSheetRow('Sheet1', $list_add, $style2);
			}
		}
		$files = glob(OKR_PATH . '*');
		foreach ($files as $file) {
			if (is_file($file)) {
// delete file
				unlink($file);
			}
		}
		$filename = date('YmdHis') . 'okrs.xlsx';
		$writer->writeToFile(str_replace($filename, OKR_PATH . $filename, $filename));
		echo json_encode([
			'site_url' => site_url(),
			'filename' => OKR_PATH . $filename,
		]);
		die;
		//}
	}

	/**
	 * import xlsx opening stock
	 * @param  integer $id
	 * @return view
	 */
	public function import_okr() {
		if (!is_admin() && !has_permission('okr', '', 'create')) {
			access_denied('okr');
		}
		$this->load->model('staff_model');
		$data_staff = $this->staff_model->get(get_staff_user_id());

		/*get language active*/
		if ($data_staff) {
			if ($data_staff->default_language != '') {
				$data['active_language'] = $data_staff->default_language;

			} else {

				$data['active_language'] = get_option('active_language');
			}

		} else {
			$data['active_language'] = get_option('active_language');
		}
		$data['title'] = _l('import_okr');

		$this->load->view('okr/okrs/import_excel_okr', $data);
	}

	/**
	 * import okr data
	 * @return json
	 */
	public function import_okr_data() {
		if (!is_admin() && !has_permission('okr', '', 'create')) {
			access_denied(_l('okr'));
		}

		if(!class_exists('XLSXReader')){
			require_once module_dir_path(OKR_MODULE_NAME) . '/third_party/XLSXReader/XLSXReader.php';
		}
		require_once module_dir_path(OKR_MODULE_NAME) . '/third_party/XLSXWriter/xlsxwriter.class.php';
		

		$total_row_false = 0;
		$total_rows_data = 0;
		$dataerror = 0;
		$total_row_success = 0;
		$total_rows_data_error = 0;
		$filename = '';

		if ($this->input->post()) {
			if (isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
				// Get the temp file path
				$tmpFilePath = $_FILES['file_csv']['tmp_name'];
				// Make sure we have a filepath
				if (!empty($tmpFilePath) && $tmpFilePath != '') {
					$tmpDir = TEMP_FOLDER . '/' . time() . uniqid() . '/';

					if (!file_exists(TEMP_FOLDER)) {
						mkdir(TEMP_FOLDER, 0755);
					}

					if (!file_exists($tmpDir)) {
						mkdir($tmpDir, 0755);
					}

					// Setup our new file path
					$newFilePath = $tmpDir . $_FILES['file_csv']['name'];

					if (move_uploaded_file($tmpFilePath, $newFilePath)) {
						$import_result = true;
						$rows = [];

						$objReader = new PHPExcel_Reader_Excel2007();
						$objReader->setReadDataOnly(true);
						$objPHPExcel = $objReader->load($newFilePath);
						$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
						$sheet = $objPHPExcel->getActiveSheet();

						//innit  file exel error start

						$dataError = new PHPExcel();
						$dataError->setActiveSheetIndex(0);
						//create header file

						// add style to the header
						$styleArray = array(
							'font' => array(
								'bold' => true,

							),

							'borders' => array(
								'top' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
								),
							),
							'fill' => array(

								'rotation' => 90,
								'startcolor' => array(
									'argb' => 'FFA0A0A0',
								),
								'endcolor' => array(
									'argb' => 'FFFFFFFF',
								),
							),
						);

						// set the names of header cells
						$dataError->setActiveSheetIndex(0)

							->setCellValue("A1", "(*)" . _l('your_target'))
							->setCellValue("B1", "(*)" . _l('circulation'))
							->setCellValue("C1", "(*)" . _l('type'))
							->setCellValue("D1", "(*)" . _l('department'))
							->setCellValue("E1", "(*)" . _l('person_assigned'))
							->setCellValue("F1", _l('category'))
							->setCellValue("G1", _l('display'))
							->setCellValue("H1", "(*)" . _l('main_results'))
							->setCellValue("I1", "(*)" . _l('target'))
							->setCellValue("J1", _l('unit'))
							->setCellValue("K1", _l('okr_superior'))
							->setCellValue("L1", _l('parent_key_result'))
							->setCellValue("M1", _l('plan'))
							->setCellValue("N1", _l('results'))

							->setCellValue("O1", _l('error'));

						/*set style for header*/
						$dataError->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);

						// auto fit column to content

						foreach (range('A', 'O') as $columnID) {
							$dataError->getActiveSheet()->getColumnDimension($columnID)
								->setAutoSize(true);

						}

						$dataError->getActiveSheet()->getStyle('A1:O1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$dataError->getActiveSheet()->getStyle('A1:O1')->getFill()->getStartColor()->setARGB('29bb04');
						// Add some data
						$dataError->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
						$dataError->getActiveSheet()->getStyle('A1:O1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

						/*set header middle alignment*/
						$dataError->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

						$dataError->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						/*set row1 height*/
						$dataError->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

						//init file error end

						// start row write 2
						$numRow = 2;
						$total_rows = 0;

						$total_rows_actualy = 0;

						//get data for compare
						$array_okrs = $this->okr_model->get_array_okrs(true);
						$array_key_results = $this->okr_model->get_array_key_result('', true);
						foreach ($rowIterator as $row) {
							$rowIndex = $row->getRowIndex();
							if ($rowIndex > 1) {
								$rd = array();
								$flag = 0;
								$flag2 = 0;
								$flag_mail = 0;
								$string_error = '';
								$flag_contract_form = 0;

								$flag_id_commodity_code;
								$flag_id_warehouse_code;

								$your_target = $sheet->getCell('A' . $rowIndex)->getValue();
								$circulation = $sheet->getCell('B' . $rowIndex)->getValue();
								$type = $sheet->getCell('C' . $rowIndex)->getValue();
								$department = $sheet->getCell('D' . $rowIndex)->getValue();
								$person_assigned = $sheet->getCell('E' . $rowIndex)->getValue();
								$category = $sheet->getCell('F' . $rowIndex)->getValue();
								$display = $sheet->getCell('G' . $rowIndex)->getValue();
								$main_results = $sheet->getCell('H' . $rowIndex)->getValue();
								$target = $sheet->getCell('I' . $rowIndex)->getValue();
								$unit = $sheet->getCell('J' . $rowIndex)->getValue();
								$okr_superior = $sheet->getCell('K' . $rowIndex)->getValue();
								$parent_key_result = $sheet->getCell('L' . $rowIndex)->getValue();
								$plan = $sheet->getCell('M' . $rowIndex)->getValue();
								$results = $sheet->getCell('N' . $rowIndex)->getValue();

								/*check null*/
								if (is_null($your_target) == true) {
									$string_error .= _l('your_target') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($circulation) == true) {
									$string_error .= _l('circulation') . _l('not_yet_entered');
									$flag = 1;
								} else {
									$circulation_id = $this->okr_model->get_circulation_id_by_name($circulation);
									if ($circulation_id == 0) {
										$string_error .= _l('circulation') . _l('is_invalid');
										$flag = 1;
									} else {
										$circulation = $circulation_id;
									}
								}

								$types = ['personal', 'department', 'company'];
								if (is_null($type) == true) {
									$string_error .= _l('type') . _l('not_yet_entered');
									$flag = 1;
								} else {
									if (in_array(trim(strtolower($type)), $types)) {
										$type = trim($type);
										if (trim(strtolower($type)) == 'personal') {
											$type = 1;
											if (is_null($person_assigned) == true) {
												$string_error .= _l('person_assigned') . _l('not_yet_entered');
												$flag = 1;
											} else {
												$staff_id = $this->okr_model->get_staff_id_by_name($person_assigned);
												if ($staff_id == 0) {
													$string_error .= _l('person_assigned') . _l('is_invalid');
													$flag = 1;
												} else {
													$person_assigned = $staff_id;
												}
											}
										} else if (trim(strtolower($type)) == 'department') {
											$type = 2;
											if (is_null($department) == true) {
												$string_error .= _l('department') . _l('not_yet_entered');
												$flag = 1;
											} else {
												$department_id = $this->okr_model->get_department_id_by_name($department);
												if ($department_id == 0) {
													$string_error .= _l('department') . _l('is_invalid');
													$flag = 1;
												} else {
													$department = $department_id;
												}
											}
										} else {
											$type = 3;
										}
									} else {
										$string_error .= _l('type') . _l('is_invalid');
										$flag = 1;
									}
								}

								if (is_null($category) == false) {
									$cat_id = $this->okr_model->get_category_id_by_name($category);
									if ($cat_id == 0) {
										$string_error .= _l('category') . _l('is_invalid');
										$flag = 1;
									} else {
										$category = $cat_id;
									}
								} else {
									$category = 0;
								}

								$displays = ['public', 'private'];
								if (is_null($display) == false) {
									if (in_array(trim(strtolower($display)), $displays)) {
										$display = trim($display);
										if (trim(strtolower($display)) == 'public') {
											$display = 1;
										} else {
											$display = 2;
										}
									} else {
										$string_error .= _l('display') . _l('is_invalid');
										$flag = 1;
									}
								} else {
									$display = 0;
								}

								if (is_null($main_results) == true) {
									$string_error .= _l('main_results') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($target) == true) {
									$string_error .= _l('target') . _l('not_yet_entered');
									$flag = 1;
								}

								if (is_null($unit) == false) {
									$unit_id = $this->okr_model->get_unit_id_by_name($unit);
									if ($unit_id == 0) {
										$string_error .= _l('unit') . _l('is_invalid');
										$flag = 1;
									} else {
										$unit = $unit_id;
									}
								} else {
									$unit = 0;
								}

								$okr_superior_id = 0;
								$parent_key_result_id = 0;

								if (isset($array_okrs[strtolower($okr_superior)])) {
									$okr_superior_id = $array_okrs[strtolower($okr_superior)];
									if (isset($array_key_results[strtolower($parent_key_result)])) {
										$parent_key_result_id = $array_key_results[strtolower($parent_key_result)];
									}
								}

								if ($flag == 1) {
									$dataError->getActiveSheet()->setCellValue('A' . $numRow, $sheet->getCell('A' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('B' . $numRow, $sheet->getCell('B' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('C' . $numRow, $sheet->getCell('C' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('D' . $numRow, $sheet->getCell('D' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('E' . $numRow, $sheet->getCell('E' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('F' . $numRow, $sheet->getCell('F' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('G' . $numRow, $sheet->getCell('G' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('H' . $numRow, $sheet->getCell('H' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('I' . $numRow, $sheet->getCell('I' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('J' . $numRow, $sheet->getCell('J' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('K' . $numRow, $sheet->getCell('K' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('L' . $numRow, $sheet->getCell('L' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('L' . $numRow, $sheet->getCell('M' . $rowIndex)->getValue());
									$dataError->getActiveSheet()->setCellValue('L' . $numRow, $sheet->getCell('N' . $rowIndex)->getValue());

									$dataError->getActiveSheet()->setCellValue('M' . $numRow, $string_error)->getStyle('O' . $numRow)->applyFromArray($styleArray);

									$numRow++;
									$total_rows_data_error++;
								}

								if (get_staff_user_id() != '' && $flag == 0) {
									if (is_null($department) == true) {
										$department = 0;
									}
									if (is_null($person_assigned) == true) {
										$person_assigned = 0;
									}
									if (is_null($plan) == true) {
										$plan = '';
									}
									if (is_null($results) == true) {
										$results = '';
									}
									$row_okr = [];
									$row_okr['your_target'] = $your_target;
									$row_okr['circulation'] = $circulation;
									$row_okr['type'] = $type;
									$row_okr['department'] = $department;
									$row_okr['person_assigned'] = $person_assigned;
									$row_okr['category'] = $category;
									$row_okr['display'] = $display;
									$row_okr['creator'] = get_staff_user_id();
									$row_okr['datecreator'] = date('Y-m-d H:i:s');
									$row_okr['okr_superior'] = $okr_superior_id;
									$row_okr['parent_key_result'] = $parent_key_result;

									$row_kr = [];
									$row_kr['main_results'] = $main_results;
									$row_kr['target'] = $target;
									$row_kr['unit'] = $unit;
									$row_kr['plan'] = $plan;
									$row_kr['results'] = $results;
									$row_kr['datecreator'] = date('Y-m-d H:i:s');

									$rows[] = $row_kr;
									$okr_id = $this->okr_model->get_okr_by_multi_condition($your_target, $circulation, $type, $department, $person_assigned, $category, $display, $okr_superior_id, $parent_key_result);
									if ($okr_id == 0) {
										$okr_id = $this->okr_model->insert_okrs($row_okr);
									}
									if ($okr_id > 0) {
										$row_kr['okrs_id'] = $okr_id;
										$result_value = $this->okr_model->insert_keyresult($row_kr);
										if ($result_value) {
											$total_rows_actualy++;
										}
										if ($row_okr['okr_superior'] > 0 && $row_okr['parent_key_result'] > 0) {
											$this->okr_model->update_progress_tree($okr_id);
										}
									}

								}

								$total_rows++;
								$total_rows_data++;
							}

						}

						if ($total_rows_actualy != $total_rows) {
							$total_rows = $total_rows_actualy;
						}

						$total_rows = $total_rows;
						$data['total_rows_post'] = count($rows);
						$total_row_success = count($rows);
						$total_row_false = $total_rows - (int) count($rows);
						$dataerror = $dataError;
						$message = 'Not enought rows for importing';

						if (($total_rows_data_error > 0) || ($total_row_false != 0)) {
							$objWriter = new PHPExcel_Writer_Excel2007($dataError);

							$filename = 'error_import_okrs_' . get_staff_user_id() . strtotime(date('Y-m-d H:i:s')) . '.xlsx';
							$objWriter->save(str_replace($filename, OKR_PATH . $filename, $filename));

							$filename = OKR_PATH . $filename;

						}

						$import_result = true;
						@delete_dir($tmpDir);

					}

				} else {
					set_alert('warning', _l('import_okr_failed'));
				}
			}

		}
		echo json_encode([
			'message' => 'Not enought rows for importing',
			'total_row_success' => $total_row_success,
			'total_row_false' => $total_rows_data_error,
			'total_rows' => $total_rows_data,
			'site_url' => site_url(),
			'staff_id' => get_staff_user_id(),
			'total_rows_data_error' => $total_rows_data_error,
			'filename' => $filename,
		]);

	}

	/**
	 * reload okr tree
	 * @return json
	 */
	public function reload_okr_tree() {
		if ($this->input->get()) {
			$circulation = $this->input->get('circulation');
			$okr = $this->input->get('okr');
			$staff = $this->input->get('staff');
			$type = $this->input->get('type');
			$category = $this->input->get('category');
			$department = $this->input->get('department');
			$render_type = $this->input->get('render_type');
			$okr_tree = array();
			$pokr = ['flag' => true, 'okr' => null, 'children' => []];
			$okr_tree[0] = $pokr;
			$arr_cir = $this->okr_model->get_array_circulation();
			$arr_staff_dept = $this->departments_model->get_staff_departments(false, true);
			$arr_dept = $this->okr_model->get_array_department();
			$arr_cat = $this->okr_model->get_array_category();
			$html = [];
			$this->okr_model->get_tree_okrs($html, $okr_tree[0], 0, $circulation, $okr, $staff, $type, $category, $department, false, $arr_cir, $arr_staff_dept, $arr_dept, $arr_cat, $render_type);
			$html_string = '';
			foreach ($html as $value) {
				$html_string .= $value;
			}
			echo json_encode(['array_tree_search' => $html_string, 'array_tree_chart_search' => '', 'company_name' => get_option('invoice_company_name')]);
		}
	}

	/**
	 * get select key result
	 * @param  array $array_kr
	 * @param  int $kr
	 * @return string
	 */
	private function get_select_key_result($array_kr, $kr) {
		return render_select('parent_key_result', $array_kr, array('id', 'main_results'), 'parent_key_result', $kr, ['data-width' => '100%', 'class' => 'selectpicker'], array(), '', '', false);
	}

	/**
	 * get select key result
	 * @return string
	 */
	public function get_select_key_result_html() {
		$okr_id = $this->input->post('okr_id');
		$html = $this->get_select_key_result([], '');
		if (isset($okr_id) && $okr_id != '') {
			$array_kr = $this->okr_model->get_key_result($okr_id);
			$kr = '';
			if (count($array_kr) > 0) {
				$kr = $array_kr[0]['id'];
			}
			$html = $this->get_select_key_result($array_kr, $kr);
		}
		echo $html;
	}
}