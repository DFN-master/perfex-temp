<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Okr model
 */
class Okr_model extends App_Model {
	//create
	/**
	 * setting circulation
	 * @param  array $data
	 * @return $insert_id
	 */
	public function setting_circulation($data) {
		$data['to_date'] = to_sql_date($data['to_date']);
		$data['from_date'] = to_sql_date($data['from_date']);

		if($data['to_date'] == null){
			$data['to_date'] = '';
		}

		if($data['from_date'] == null){
			$data['from_date'] = '';
		}

		$this->db->insert('okr_setting_circulation', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * setting question
	 * @param  array $data
	 * @return $insert_id
	 */
	public function setting_question($data) {
		$this->db->insert('okr_setting_question', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * setting question
	 * @param  array $data
	 * @return $insert_id
	 */
	public function setting_unit($data) {
		$this->db->insert('okr_setting_unit', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * setting category
	 * @param  array $data
	 * @return $insert_id
	 */
	public function setting_category($data) {
		$this->db->insert('okr_setting_category', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * setting evaluation criteria
	 * @param  array $data
	 * @return $insert_id
	 */
	public function setting_evaluation_criteria($data) {
		$this->db->insert('okr_setting_evaluation_criteria', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * new okrs main
	 * @param  array $data
	 * @return $insert_id
	 */
	public function new_okrs_main($data) {
		$main_results = '';
		$target = '';
		$departments = '';
		$unit = '';
		$plan = '';
		$results = '';

		if (isset($data['main_results'])) {
			$main_results = $data['main_results'];
			unset($data['main_results']);
		}
		if (isset($data['target'])) {
			$target = $data['target'];
			unset($data['target']);
		}
		if (isset($data['unit'])) {
			$unit = $data['unit'];
			unset($data['unit']);
		}

		if (isset($data['plan'])) {
			$plan = $data['plan'];
			unset($data['plan']);
		}

		if (isset($data['results'])) {
			$results = $data['results'];
			unset($data['results']);
		}

		if (isset($data['okr_cross'])) {
			$data['okr_cross'] = implode(',', $data['okr_cross']);
		}
		$data['creator'] = get_staff_user_id();
		$data['datecreator'] = date('Y-m-d H:i:s');
		$this->db->insert(db_prefix() . 'okrs', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			$this->notifications($data['person_assigned'], 'okr/show_detail_node/' . $insert_id, _l('designates_you_as_the_okr_manager'));
			if (count($main_results) > 0) {
				foreach ($main_results as $key => $value) {
					$this->db->insert(db_prefix() . 'okrs_key_result', [
						'okrs_id' => $insert_id,
						'main_results' => $value,
						'target' => $target[$key],
						'unit' => $unit[$key],
						'plan' => $plan[$key],
						'results' => $results[$key],
					]);
				}
			}
			$this->update_progress_tree($insert_id);
		}
		return $insert_id;
	}

	//update
	/**
	 * update setting circulation
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_setting_circulation($data, $id) {
		$data['to_date'] = to_sql_date($data['to_date']);
		$data['from_date'] = to_sql_date($data['from_date']);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_setting_circulation', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * update setting question
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_setting_question($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_setting_question', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * update setting unit
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_setting_unit($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_setting_unit', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * update setting category
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_setting_category($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_setting_category', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * update setting evaluation criteria
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_setting_evaluation_criteria($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_setting_evaluation_criteria', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * update okrs main
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_okrs_main($data, $id) {
		$main_results = '';
		$target = '';
		$departments = '';
		$unit = '';
		$plan = '';
		$results = '';

		if (isset($data['main_results'])) {
			$main_results = $data['main_results'];
			unset($data['main_results']);
		}
		if (isset($data['target'])) {
			$target = $data['target'];
			unset($data['target']);
		}
		if (isset($data['unit'])) {
			$unit = $data['unit'];
			unset($data['unit']);
		}

		if (isset($data['plan'])) {
			$plan = $data['plan'];
			unset($data['plan']);
		}

		if (isset($data['results'])) {
			$results = $data['results'];
			unset($data['results']);
		}

		if (isset($data['okr_cross'])) {
			$data['okr_cross'] = implode(',', $data['okr_cross']);
		}

		$data['creator'] = get_staff_user_id();
		$change = $this->get_okrs($id)->change;
		$data['change'] = $change + 1;
		$data['datecreator'] = date('Y-m-d H:i:s');
		if ($data['okr_superior'] && $data['okr_superior'] != '') {
			$okr_superior_check = $this->get_okrs($data['okr_superior']);
		}
		if (isset($okr_superior_check)) {
			$rs = $this->dq_v101($okr_superior_check);
			if (in_array($id, $rs) || $id == $data['okr_superior']) {
				return 0;
			}
		}

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okrs', $data);

		//insert log edit okrs
		$data['editor'] = $data['creator'];
		unset($data['creator']);
		unset($data['datecreator']);

		//$this->db->insert(db_prefix() . 'okrs_log', $data);
		$editor = get_staff_user_id();
		if (count($main_results) > 0) {
			$this->db->where('okrs_id', $id);
			$results_ = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();

			if (count($results_) > 0) {
				$results_[0]['status'] = 'old';
				$results_[0]['editor'] = $editor;
				unset($results_[0]['datecreator']);
				unset($results_[0]['id']);
				unset($results_[0]['tasks']);
				//$this->db->insert(db_prefix() . 'okrs_key_result_log', $results_[0]);
			}
			$this->db->where('okrs_id', $id);
			$this->db->delete(db_prefix() . 'okrs_key_result');

			foreach ($main_results as $key => $value) {
				$this->db->insert(db_prefix() . 'okrs_key_result', [
					'okrs_id' => $id,
					'main_results' => $value,
					'target' => $target[$key],
					'unit' => $unit[$key],
					'plan' => $plan[$key],
					'results' => $results[$key],
				]);

				//insert log edit okrs
				/*$this->db->insert(db_prefix() . 'okrs_key_result_log', [
					'okrs_id' => $id,
					'main_results' => $value,
					'target' => $target[$key],
					'unit' => $unit[$key],
					'plan' => $plan[$key],
					'editor' => $editor,
					'status' => 'new',
					'results' => $results[$key],
				]);*/

			}
			$this->update_progress_tree($id);
		}
		if ($this->db->affected_rows() > 0) {
			log_activity('OKR Updated [ID: ' . $id . ', Objective: ' . $data['your_target'] . ']');
			return true;
		}
		return false;
	}

	//delete
	/**
	 * delete setting circulation
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_setting_circulation($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okr_setting_circulation');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * delete setting question
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_setting_question($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okr_setting_question');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * delete setting unit
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_setting_unit($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okr_setting_unit');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * delete setting category
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_setting_category($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okr_setting_category');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * delete setting evaluation criteria
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_setting_evaluation_criteria($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okr_setting_evaluation_criteria');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	//get
	/**
	 * get circulation
	 * @param  string $id
	 * @return bolean
	 */
	public function get_circulation($id = '') {
		if ($id != '' && $id > 0) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'okr_setting_circulation')->row();
		}
		return $this->db->get(db_prefix() . 'okr_setting_circulation')->result_array();
	}
	/**
	 * get okrs
	 * @param  string $id
	 * @return bolean
	 */
	public function get_okrs($id = '', $eid = '') {
		$sql_select = db_prefix() . 'okrs.*,' .
		db_prefix() . 'okr_setting_circulation.name_circulation,' .
		db_prefix() . 'okr_setting_circulation.from_date,' .
		db_prefix() . 'okr_setting_circulation.to_date';
		if ($id != '' && $id > 0) {
			$this->db->select($sql_select);
			$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
			$this->db->where(db_prefix() . 'okrs.id', $id);
			return $this->db->get(db_prefix() . 'okrs')->row();
		}
		if (is_admin()) {
			$this->db->select($sql_select);
			$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
			if ($eid > 0) {
				$this->db->where(db_prefix() . 'okrs.id <> ' . $eid);
			}
			return $this->db->get(db_prefix() . 'okrs')->result_array();
		}
		$this->load->model('departments_model');
		$list_dept = $this->departments_model->get_staff_departments(false, true);
		$dept = '(';
		for ($i = 0; $i < count($list_dept) - 1; $i++) {
			$dept .= $list_dept[$i] . ',';
		}
		$this->db->select($sql_select);
		$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
		if (count($list_dept) > 0) {
			$dept .= $list_dept[count($list_dept) - 1] . ')';
			$this->db->where('(' . db_prefix() . 'okrs.department IN ' . $dept . ' AND ' . db_prefix() . 'okrs.type =2)');
			$this->db->or_where('(' . db_prefix() . 'okrs.type =3 AND ' . db_prefix() . 'okrs.display = 1)');
			$this->db->or_where('(' . db_prefix() . 'okrs.person_assigned =' . get_staff_user_id() . ')');
		}
		if ($eid > 0) {
			$this->db->where(db_prefix() . 'okrs.id <> ' . $eid);
		}
		return $this->db->get(db_prefix() . 'okrs')->result_array();

	}

	/**
	 * display json tree okrs
	 * @return $html
	 */
	public function display_json_tree_okrs($flag = '') {
		//$okrs = $this->get_okrs();
		$root = $this->get_node_root($flag);
		$json = [];
		$html = '';
		if (count($root) > 0) {
			foreach ($root as $key => $okr) {
				$html .= $this->dq_html('', $okr);
			}
		}
		return $html;
	}
	/**
	 * check node child
	 * @param  integer $okr
	 * @return bolean
	 */
	public function check_node_child($okr) {
		$okrs = $this->get_okrs($okr);
		if ($okrs->okr_superior != '') {
			return true;
		}
		return false;
	}
	/**
	 * get node root
	 * @return $root
	 */
	public function get_node_root($flag = '') {
		$okrs = $this->get_okrs();
		$root = [];
		$cfdate = time();
		$ctdate = time();
		if ($flag > 0) {
			$this->db->where('id', $flag);
			$cir = $this->db->get(db_prefix() . 'okr_setting_circulation')->row();
			if (isset($cir)) {
				$cfdate = strtotime($cir->from_date);
				$ctdate = strtotime($cir->to_date);
			}
		}
		foreach ($okrs as $key => $value) {

			if ($flag > 0) {
				$ofdate = strtotime($value['from_date']);
				$otdate = strtotime($value['to_date']);
				if (($value['okr_superior'] == '' || is_null($value['okr_superior'])) && ((($ofdate <= $ctdate) && ($ofdate >= $cfdate)) || (($otdate <= $ctdate) && ($otdate >= $cfdate)))) {
					$root[] = $value;
				}
			} else {
				if ($value['okr_superior'] == '' || is_null($value['okr_superior'])) {
					$root[] = $value;
				}
			}
		}

		return $root;
	}
	/**
	 * dq html
	 * @param  string $html
	 * @param  array $node
	 * @return $html
	 */
	public function dq_html($html, $node) {
		$key_results = $this->count_key_results($node['id']);

		$progress = $this->okr_model->get_okrs($node['id'])->progress;
		if (is_null($progress)) {
			$progress = 0;
		}
		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id() || is_admin()) {
			$display = '';
		}
		$full_name =
		'<div class="pull-right">' . staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . get_staff_full_name($node['person_assigned']) . '</a> </div>';

		$rattings = '
        <div class="progress no-margin progress-bar-mini cus_tran">
        <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
        </div>
        </div>
        ' . $progress . '%
        </div>
        ';

		$category = category_view($node['category']);
		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$department = $node['department'] != '' && $node['department'] != 0 ? get_department_name_of_okrs($node['department'])->name : '';

		if ($node['status'] == 0) {
			$status = '<span class="label label-warning s-status ">' . _l('unfinished') . '</span>';
		} else {
			$status = '<span class="label label-success s-status ">' . _l('finish') . '</span>';
		}

		$option = '';
		$option .= '<a href="' . admin_url('okr/show_detail_node/' . $node['id']) . '" class="btn btn-default btn-icon">';
		$option .= '<i class="fa fa-eye"></i>';
		$option .= '</a>';
		if ($this->okr_model->get_okrs($node['id'])->status != 1) {
			if ((has_permission('okr', '', 'edit') && $node['type'] != 3) || (has_permission('okr', '', 'edit_company') && $node['type'] == 3) || is_admin()) {
				$option .= '<a href="' . admin_url('okr/new_object_main/' . $node['id']) . '" class="btn btn-default btn-icon">';
				$option .= '<i class="fa fa-edit"></i>';
				$option .= '</a>';
			}
		}
		if ((has_permission('okr', '', 'edit') && $node['type'] != 3) || (has_permission('okr', '', 'delete_company') && $node['type'] == 3) || is_admin()) {
			$option .= '<a href="' . admin_url('okr/delete_okrs/' . $node['id']) . '" class="btn btn-danger btn-icon _delete">';
			$option .= '<i class="fa fa-remove"></i>';
			$option .= '</a>';
		}
		$row[] = $option;
		if ($node['okr_superior'] == '') {
			$html .=
			'<tr class="treegrid-' . $node['id'] . ' expanded ' . $display . '" >
            <td class="text-left vertical-align-middle"><a href="#" class="trigger" data-id="' . $node['person_assigned'] . '" ><div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '</a> <span class="your-target-content">' . $node['your_target'] . '</span></div></td>
            <td class="vertical-align-middle">' . $node['name_circulation'] . '</td>
            <td class="vertical-align-middle"><div class="box effect8" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
            <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
            </div>
            </td>' .
			//<td class="text-danger">+' . $node['change'] . '</td>
			'<td class="vertical-align-middle">' . $rattings . '  </td>
            <td class="vertical-align-middle">' . $category . '  </td>
            <td class="vertical-align-middle">' . $type . '  </td>
            <td class="vertical-align-middle">' . $department . '  </td>
            <td class="vertical-align-middle">' . $status . '</td>';
			if (has_permission('okr', '', 'edit') || is_admin() || has_permission('okr', '', 'delete')) {
				$html .= '<td>' . $option . '</td>';
			}
			$html .= '</tr>';
		} else {
			$html .= '
            <tr class="treegrid-' . $node['id'] . ' treegrid-parent-' . $node['okr_superior'] . ' ' . $display . '" >
            <td class="text-left vertical-align-middle"><a href="#" class="trigger" data-id="' . $node['person_assigned'] . '" ><div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '</a> <span class="your-target-content">' . $node['your_target'] . '</span></div></td>
            <td>' . $node['name_circulation'] . '</td>
            <td class="vertical-align-middle"><div class="box effect8" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
            <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
            </div>
            </td>' .
			//<td class="text-danger">+' . $node['change'] . '</td>
			'<td class="vertical-align-middle">' . $rattings . '</td>
            <td class="vertical-align-middle">' . $category . '  </td>
            <td class="vertical-align-middle">' . $type . '  </td>
            <td class="vertical-align-middle">' . $department . '  </td>
            <td class="vertical-align-middle">' . $status . '</td>';
			if (has_permission('okr', '', 'edit') || is_admin() || has_permission('okr', '', 'delete')) {
				$html .= '<td>' . $option . '</td>';
			}
			$html .= '</tr>';
		}
		$list_dept = $this->departments_model->get_staff_departments(false, true);
		$dept = '(';
		for ($i = 0; $i < count($list_dept) - 1; $i++) {
			$dept .= $list_dept[$i] . ',';
		}
		$this->db->select(
			db_prefix() . 'okrs.*,' .
			db_prefix() . 'okr_setting_circulation.name_circulation,' .
			db_prefix() . 'okr_setting_circulation.from_date,' .
			db_prefix() . 'okr_setting_circulation.to_date'
		);
		$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
		$this->db->where('okr_superior', $node['id']);

		if (count($list_dept) > 0) {
			$dept .= $list_dept[count($list_dept) - 1] . ')';
			$this->db->where(db_prefix() . 'okrs.department IN ' . $dept);
			//$this->db->or_where('(' . db_prefix() . 'okrs.type =3 AND ' . db_prefix() . 'okrs.display = 1)');
			//$this->db->or_where('(' . db_prefix() . 'okrs.person_assigned =' . get_staff_user_id() . ')');
		}
		$child_note = $this->db->get(db_prefix() . 'okrs')->result_array();
		if (count($child_note) > 0) {
			$html_ = '';
			foreach ($child_note as $key => $value) {
				$html_ .= $this->dq_html('', $value);
			}
			$html .= $html_;
		}
		return $html;
	}
	/**
	 * get okrs detailt
	 * @param  integer $okr
	 * @return $results
	 */
	public function get_okrs_detailt($okr) {
		$this->db->where('okrs_id', $okr);
		$key_results = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
		$object = $this->get_okrs($okr);
		$results['object'] = $object;
		$results['key_results'] = $key_results;
		return $results;
	}

	/**
	 * chart tree okrs
	 * @return json
	 */
	public function chart_tree_okrs($flag = '') {
		$root = $this->get_node_root($flag);
		//$okrs = $this->get_okrs();
		$json = [];
		if (count($root) > 0) {
			foreach ($root as $key => $okr) {
				$json[] = $this->dq_json($okr, []);
			}
		}
		return json_encode($json);
	}

	/**
	 * dq json
	 * @param  array $node
	 * @param  array $array_
	 * @return $array
	 */
	public function dq_json($node, $array_) {
		$data_popover = $this->objective_show($node['id']);
		$progress = $node['progress'];
		if (is_null($progress)) {
			$progress = 0;
		}
		$test = '
        <div class="progress-json">
        <div class="project-progress relative" data-value="' . ($progress / 100) . '" data-size="55" data-thickness="5">
        <strong class="okr-percent"></strong>
        </div>
        <span >' . _l('progress') . '</span>
        </div>

        ';

		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id()) {
			$display = '';
		}

		$count_key_results = $this->count_key_results($node['id']);
		$rattings = '<div class="devicer">';
		$rattings .= $test;
		$rattings .= '<div class="box-json">';
		if ($count_key_results->count > 0) {
			$rattings .= '<div class="demo_box" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content=""><div class="bg-1 pull-right"><span class="rate-box-value-1">' . $count_key_results->count . '</span></div></div>';
		} else {
			$rattings .= '<div class="demo_box" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="" > <div class="bg-2"><span class="rate-box-value-2">' . $count_key_results->count . '</span></div></div>';
		}
		$rattings .= '<span class="key-rs-cus">' . _l('key_results') . '</span>';
		$rattings .= '</div>';

		$rattings .= '</div>';

		if ($display == 'hide') {
			$rattings = '';
		}

		$name = '<a href="' . admin_url('okr/show_detail_node/' . $node['id']) . '">' . $node['your_target'] . '</a>';
		if ($display == 'hide') {
			$name = '<i class="fa fa-lock lagre-lock" aria-hidden="true"></i>';
		}
		$role = '';
		if ($node['type'] == 1) {
			$role = get_role_name_staff($node['person_assigned']);
			$title = '<div class="position-absolute mleft-22"><a href="#" class="name_class_chart">' . get_staff_full_name($node['person_assigned']) . '</a><div class="role_name">' . $role . '</div></div>';
			$image = staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left position-absolute']);
		} else if ($node['type'] == 2) {
			$dept_name = _l('department');
			$role = _l('department');
			$dept = get_department_name_of_okrs($node['department']);
			if ($dept) {
				$dept_name = $dept->name;
			}
			$title = '<div class="position-absolute mleft-22"><a href="#" class="name_class_chart">' . $dept_name . '</a><div class="role_name">' . $role . '</div></div>';
			$image = staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left position-absolute']);
		} else {
			$role = _l('company');
			$company_name = get_option('invoice_company_name');
			if ($company_name == '') {
				$company_name = _l('company');
			}
			$title = '<div class="position-absolute mleft-22"><a href="#" class="name_class_chart">' . $company_name . '</a><div class="role_name">' . $role . '</div></div>';
			$image = staff_profile_image(null, ['img img-responsive staff-profile-image-small pull-left position-absolute']);
		}

		$array = array('name' => $name, 'title' => $title, 'job_position_name' => '', 'dp_user_icon' => $rattings, 'display' => $display, 'image' => $image);

		$this->db->where('okr_superior', $node['id']);
		$child_node = $this->db->get(db_prefix() . 'okrs')->result_array();

		if (count($child_node) > 0) {
			foreach ($child_node as $key => $node_) {
				$array['children'][] = $this->dq_json($node_, []);
			}
		}

		return $array;
	}
	/**
	 * count key results
	 * @param  integer $okr
	 * @param  string $where
	 * @return count
	 */
	public function count_key_results($okr, $where = '') {
		return $this->db->query('select count(*) as count from ' . db_prefix() . 'okrs_key_result where okrs_id =' . $okr)->row();
	}
	/**
	 * chart tree okrs clone
	 * @param  integer $okr_id
	 * @return json
	 */
	public function chart_tree_okrs_clone($okr_id) {
		$json = [];
		$this->db->where('id', $okr_id['id']);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json[] = $this->dq_json($okrs[0], []);
		return json_encode($json);
	}
	/**
	 * objective show
	 * @param  integer $okrs
	 * @return $html
	 */
	public function objective_show($okrs) {
		$main = $this->get_okrs($okrs);
		$html = '';
		$html .= '<div class="row"><div class="col-md-12"><div class="name_objective"><h4><i class="fa">&#xf247;</i>  ' . $main->your_target . '</h4></div>';
		$progress = $this->okr_model->get_okrs($okrs)->progress;
		if (is_null($progress)) {
			$progress = 0;
		}
		/*$test = '
			        <div class="project-progress relative" data-value="' . ($progress / 100) . '" data-size="50" data-thickness="5">
			        <strong class="okr-percent"></strong>
			        </div>
		*/

		$this->db->where('okrs_id', $okrs);
		$objective = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
		$html .= '<div class="table-responsive s_table"><table class="table close-shift-items-table items table-main-invoice-edit has-calculations no-mtop">
        <thead><tr>
        <th width="5%" align="center">#</th>
        <th width="25%" align="left">' . _l('main_results') . '</th>
        <th width="10%" align="left">' . _l('target') . '</th>
        <th width="10%" align="left">' . _l('progress') . '</th>
        <th width="15%" align="left">' . _l('confidence_level') . '</th>
        <th width="25%" align="left">' . _l('plan') . '</th>
        <th width="20%" align="left">' . _l('results') . '</a></th>
        </tr></thead><tbody>';
		$count = 0;
		foreach ($objective as $key => $value) {
			$count++;
			switch ($value['confidence_level']) {
			case 1:
				$confidence_level_html = '
                <div class="default is_fine">
                <label>
                <input type="radio" checked><span> ' . _l('is_fine') . '</span>
                </label>
                </div>
                ';
				break;
			case 2:
				$confidence_level_html = '
                <div class="default not_so_good">
                <label>
                <input type="radio" checked><span> ' . _l('not_so_good') . '</span>
                </label>

                </div>
                ';
				break;
			default:
				$confidence_level_html = '
                <div class="default very_good">
                <label>
                <input type="radio"  checked><span> ' . _l('very_good') . '</span>
                </label>
                </div>
                ';
				break;
			}
			$progress_html = '
            <div class="project-progress relative" data-value="' . ($value['progress'] / 100) . '" data-size="50" data-thickness="5">
            <strong class="okr-percent"></strong>
            </div>
            ';
			$unit_ = (isset($this->get_unit($value['unit'])->unit) ? $this->get_unit($value['unit'])->unit : '');
			if ($unit_ != '') {
				$unit_ = ' (' . $unit_ . ')';
			}
			$html .= '
            <tr>
            <td align="center">' . $count . '</td>
            <td>' . $value['main_results'] . '</td>
            <td>' . $value['target'] . $unit_ . '</td>
            <td>' . $progress_html . '</td>
            <td>' . $confidence_level_html . '</td>
            <td><a href="#" id="plan_view" data-toggle="popover" data-placement="bottom" data-content="' . $value['plan'] . '" data-original-title="' . _l('plan') . '">' . $value['plan'] . '</a></td>
            <td><a href="#" id="results_view" data-toggle="popover" data-placement="bottom" data-content="' . $value['results'] . '"  data-original-title="' . _l('results') . '">' . $value['results'] . '</a></td>
            </tr>
            ';
		}
		$html .= '</tbody></table></div></div></div>';
		return $html;
	}
	/**
	 * display json tree checkin
	 * @return $html
	 */
	public function display_json_tree_checkin($flag = '') {
		$okrs = $this->get_okrs();
		$root = $this->get_node_root($flag);
		$json = [];
		$html = '';
		foreach ($root as $key => $okr) {
			$html .= $this->dq_html_checkin('', $okr);
		}
		return $html;
	}
	/**
	 * dq html checkin
	 * @param  string $html
	 * @param  array $node
	 * @return $html
	 */
	public function dq_html_checkin($html, $node) {
		$this->load->model('departments_model');
		$progress = $this->okr_model->get_okrs($node['id'])->progress;
		//get permission people apply
		$staff_apply = [];
		switch ($node['type']) {
		case '1':
			$staff_apply[] = $node['person_assigned'];
			break;
		case '2':
			$staffs_by_department = okrs_get_all_staff_by_department($node['department']);
			if (count($staffs_by_department) > 0) {
				foreach ($staffs_by_department as $key => $staffid) {
					array_push($staff_apply, $staffid['staffid']);
				}
			}
			break;
		case '3':
			/*$staffs_all = $this->staff_model->get();
				if (count($staffs_all) > 0) {
					foreach ($staffs_all as $key => $staffid) {
						array_push($staff_apply, $staffid['staffid']);
					}
			*/
			if (has_permission('okr_checkin', '', 'edit_company')) {
				$staff_apply[] = get_staff_user_id();
			}
			break;
		}

		//check and update creator into array staff apply
		if (!in_array($node['creator'], $staff_apply)) {
			array_push($staff_apply, $node['creator']);
		}

		if (is_null($progress)) {
			$progress = 0;
		}
		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id() || is_admin()) {
			$display = '';
		}
		$checkin_html_status = '';
		$confidence_level = $this->okr_model->get_okrs($node['id'])->confidence_level;
		$upcoming_checkin = $this->okr_model->get_okrs($node['id'])->upcoming_checkin;
		$type = $this->okr_model->get_okrs($node['id'])->type;

		$key_results = $this->count_key_results($node['id']);
		$department = $this->departments_model->get_staff_departments($node['person_assigned']);
		$role = get_role_name_staff($node['person_assigned']);
		$department_name = '';
		if (count($department) > 0) {
			$department_name = $department[0]['name'];
		} else {
			$department_name = '';
		}
		if (!isset($role)) {
			$role = '';
		};

		$category = category_view($node['category']);

		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$department = $node['department'] != '' && $node['department'] != 0 ? get_department_name_of_okrs($node['department'])->name : '';
		$full_name =
		'<div class="pull-right">' . staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . get_staff_full_name($node['person_assigned']) . '</a> </div>';

		$rattings = '
    <div class="progress no-margin progress-bar-mini cus_tran">
    <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
    </div>
    </div>
    ' . $progress . '%
    </div>
    ';
		switch ($confidence_level) {
		case 1:
			$confidence_level_html = '
        <div class="default">
        <div class="changed_1">
        <label>
        <input type="radio" checked><span> ' . _l('is_fine') . '</span>
        </label>
        </div>
        </div>
        ';
			break;
		case 2:
			$confidence_level_html = '
        <div class="default">
        <label>
        <input type="radio" checked><span class="default_ct"> ' . _l('not_so_good') . '</span>
        </label>

        </div>
        ';
			break;
		default:
			$confidence_level_html = '
        <div class="default">
        <div class="changed_2">
        <label>
        <input type="radio"  checked><span> ' . _l('very_good') . '</span>
        </label>
        </div>
        </div>
        ';
			break;
		}
		$today = date("Y-m-d");

		$text_checkin = '
    <button class="checkin_button1 select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    ' . _l('checkin') . '
    </button>';
		if (!has_permission('okr_checkin', '', 'view_own') || !in_array(get_staff_user_id(), $staff_apply)) {
			$text_checkin = '
        <button class="checkin_button select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
        <i class="fa fa-eye" aria-hidden="true"></i>
        ' . _l('view') . '
        </button>';
			$text_checkin = '';
		}

		if (is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
			$text_checkin = '
        <button class="checkin_button2 select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        ' . _l('checkin') . '
        </button>';
		}

		//view approve check-in
		if ($node['approval_status'] == 1 || $node['approval_status'] == 0) {
			if (strtotime($today) > strtotime($upcoming_checkin)) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today) < strtotime($upcoming_checkin)) && $node['type'] == 2) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today) < strtotime($upcoming_checkin)) && $node['type'] == 1) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today) == strtotime($upcoming_checkin)) && $node['type'] == 1) {
				$checkin_html_status = $text_checkin;
			}
			if ($this->okr_model->get_okrs($node['id'])->status == 1) {
				$checkin_html_status = '';
			}
		} else {
			$checkin_html_status = '';
		}
		//$checkin_html_status = $text_checkin;
		$approval_status =
		$node['approval_status'] == 0 ? '<span class="label label-default">' . _l('draft') . '</span>' :
		($node['approval_status'] == 1 ? '<span class="label label-success">' . _l('approved') . '</span>' :
			($node['approval_status'] == 2 ? '<span class="label label-danger">' . _l('rejected') . '</span>' :
				'<span class="label label-primary">' . _l('processing') . '</span>'
			)

		);
		$option = '';
		if ((has_permission('okr', '', 'edit') && $node['type'] != 3) || (has_permission('okr', '', 'edit_company') && $node['type'] == 3) || is_admin()) {
			$option .= '<a href="' . admin_url('okr/new_object_main/' . $node['id']) . '" class="btn btn-default btn-icon">';
			$option .= '<i class="fa fa-edit"></i>';
			$option .= '</a>';
		}

		$row[] = $option;
		if ($node['okr_superior'] == '') {
			$html .=
			'<tr class="treegrid-' . $node['id'] . ' expanded ' . $display . '" >
        <td class="text-left vertical-align-middle"><a href="#" class="trigger" data-id="' . $node['person_assigned'] . '" ><div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '</a> <span class="your-target-content">' . $node['your_target'] . '</span></div></td>
        <td class="vertical-align-middle">' . $node['name_circulation'] . '</td>
        <td><div class="box effect8" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
        <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
        </div>
        </td>
        <td class="vertical-align-middle">' . $rattings . '</td>' .
			//<td class="text-danger">+ ' . $node['change'] . '</td>
			'<td>' . $confidence_level_html . '</td>
        <td class="vertical-align-middle">' . $category . '  </td>
        <td class="vertical-align-middle">' . $type . '  </td>
        <td class="vertical-align-middle">' . $department . '  </td>';
			//view permission checkin
			if (!has_permission('okr_checkin', '', 'view_own') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
				$html .= '<td>' . $checkin_html_status . '</td>';
			} else {
				//$html .= '<td></td>';
				$html .= '<td>' . $checkin_html_status . '</td>';
			}
			$html .= '<td>' . $node['recently_checkin'] . '</td>
        <td class="vertical-align-middle">' . $node['upcoming_checkin'] . '</td>
        <td class="vertical-align-middle">' . $approval_status . '</td>
        </tr>';
		} else {
			$html .= '
        <tr class="treegrid-' . $node['id'] . ' treegrid-parent-' . $node['okr_superior'] . ' ' . $display . '" >
        <td class="text-left vertical-align-middle"><a href="#" class="trigger" data-id="' . $node['person_assigned'] . '"><div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '</a> <span class="your-target-content">' . $node['your_target'] . '</span></div></td>
        <td class="vertical-align-middle">' . $node['name_circulation'] . '</td>
        <td><div class="box effect8" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
        <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
        </div>
        </td>
        <td class="vertical-align-middle">' . $rattings . '</td>' .
			//<td class="text-danger">+ ' . $node['change'] . '</td>
			'<td>' . $confidence_level_html . '</td>
        <td class="vertical-align-middle">' . $category . '  </td>
        <td class="vertical-align-middle">' . $type . '  </td>
        <td class="vertical-align-middle">' . $department . '  </td>';
			//view permission checkin
			if (!has_permission('okr_checkin', '', 'view_own') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
				$html .= '<td>' . $checkin_html_status . '</td>';
			} else {
				$html .= '<td></td>';
			}

			$html .= '<td>' . $node['recently_checkin'] . '</td>
        <td class="vertical-align-middle">' . $node['upcoming_checkin'] . '</td>
        <td class="vertical-align-middle">' . $approval_status . '</td>
        </tr>';
		}
		$list_dept = $this->departments_model->get_staff_departments(false, true);
		$dept = '(';
		for ($i = 0; $i < count($list_dept) - 1; $i++) {
			$dept .= $list_dept[$i] . ',';
		}
		$this->db->select(
			db_prefix() . 'okrs.*,' .
			db_prefix() . 'okr_setting_circulation.name_circulation,' .
			db_prefix() . 'okr_setting_circulation.from_date,' .
			db_prefix() . 'okr_setting_circulation.to_date'
		);
		$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
		$this->db->where('okr_superior', $node['id']);

		if (count($list_dept) > 0) {
			$dept .= $list_dept[count($list_dept) - 1] . ')';
			$this->db->where(db_prefix() . 'okrs.department IN ' . $dept);
			//$this->db->or_where('(' . db_prefix() . 'okrs.type =3 AND ' . db_prefix() . 'okrs.display = 1)');
			//$this->db->or_where('(' . db_prefix() . 'okrs.person_assigned =' . get_staff_user_id() . ')');
		}
		$child_note = $this->db->get(db_prefix() . 'okrs')->result_array();

		if (count($child_note) > 0) {
			$html_ = '';
			foreach ($child_note as $key => $value) {
				$html_ .= $this->dq_html_checkin('', $value);
			}
			$html .= $html_;
		}

		return $html;
	}
	/**
	 * get question
	 * @return array
	 */
	public function get_question() {
		return $this->db->get(db_prefix() . 'okr_setting_question')->result_array();
	}
	/**
	 * get key result
	 * @param  integer $okrs
	 * @return array
	 */
	public function get_key_result($okrs, $kr = '') {
		$this->db->select(db_prefix() . 'okrs_key_result.*,' . db_prefix() . 'okr_setting_unit.unit as unit_text');
		$this->db->join(db_prefix() . 'okr_setting_unit', db_prefix() . 'okr_setting_unit.id = ' . db_prefix() . 'okrs_key_result.unit', 'left');
		$this->db->where(db_prefix() . 'okrs_key_result.okrs_id', $okrs);
		if ($kr > 0) {
			$this->db->where(db_prefix() . 'okrs_key_result.id', $kr);
			return $this->db->get(db_prefix() . 'okrs_key_result')->row();
		}
		return $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
	}
	/**
	 * get evaluation criteria
	 * @param  string $type
	 * @return array
	 */
	public function get_evaluation_criteria($type) {
		$this->db->where('group_criteria', $type);
		return $this->db->get(db_prefix() . 'okr_setting_evaluation_criteria')->result_array();
	}
	/**
	 * add check in
	 * @param array $data
	 */
	public function add_check_in($data) {
		$insert_log_id = 0;
		$approver = '';
		if (isset($data['approver'])) {
			$approver = $data['approver'];
			unset($data['approver']);
		}
		$data['recently_checkin'] = to_sql_date($data['recently_checkin']);
		$data['upcoming_checkin'] = to_sql_date($data['upcoming_checkin']);
		if ($data) {
			$main_results = [];
			$target = [];
			$unit = [];
			$achieved = [];
			$progress = [];
			$confidence_level = [];
			$answer = [];
			if (isset($data['main_results'])) {
				$main_results = $data['main_results'];
			}
			if (isset($data['target'])) {
				$target = $data['target'];
			}
			if (isset($data['unit'])) {
				$unit = $data['unit'];
			}
			if (isset($data['achieved'])) {
				$achieved = $data['achieved'];
			}
			if (isset($data['progress'])) {
				$progress = $data['progress'];
			}
			if (isset($data['confidence_level'])) {
				$confidence_level = $data['confidence_level'];
			}
			if (isset($data['answer'])) {
				$answer = $data['answer'];
			}
			if (isset($data['evaluation_criteria'])) {
				$evaluation_criteria = $data['evaluation_criteria'];
			}
			if (isset($data['comment'])) {
				$comment = $data['comment'];
			}
			if (isset($data['rs_id'])) {
				$key_results_id = $data['rs_id'];
			}
			if (isset($data['complete_okrs'])) {
				$complete_okrs = 1;
			} else {
				$complete_okrs = 0;
			}
			if (!isset($data['upcoming_checkin'])) {
				$data['upcoming_checkin'] = $data['recently_checkin'];
			}
		}
		$count_key_results = count($main_results);
		$arr_id_add = [];
		$total = 0;
		$array = [];
		$created_date = date('Y-m-d H:i:s');
		if (count($main_results) > 0) {
			$this->db->where('okrs_id', $data['id']);
			$this->db->delete(db_prefix() . 'okrs_checkin');
			foreach ($main_results as $key => $value) {
				$confidence_level_check = isset($confidence_level[$key]) ? $confidence_level[$key] : 1;
				$data_new = ['okrs_id' => $data['id'], 'main_results' => $value, 'target' => $target[$key], 'achieved' => $achieved[$key], 'progress' => number_format((float) $progress[$key], 2, '.', ''), 'confidence_level' => $confidence_level_check, 'unit' => $unit[$key], 'answer' => json_encode($answer[$key]), 'comment' => $comment[$key], 'type' => $data['type'], 'recently_checkin' => $data['recently_checkin'], 'upcoming_checkin' => $data['upcoming_checkin'], 'editor' => get_staff_user_id(), 'key_results_id' => $key_results_id[$key], 'complete_okrs' => $complete_okrs, 'created_date' => $created_date];
				if (isset($evaluation_criteria) && isset($evaluation_criteria[$key])) {
					$data_new['evaluation_criteria'] = $evaluation_criteria[$key];
				}
				$this->db->insert(db_prefix() . 'okrs_checkin', $data_new);
				$array[] = $confidence_level_check;
				$insert_id = $this->db->insert_id();

				$arr_id_add[] = $insert_id;
				if ($insert_id) {
					$this->db->where('id', $key_results_id[$key]);
					$this->db->update(db_prefix() . 'okrs_key_result', ['progress' => $progress[$key], 'achieved' => $achieved[$key], 'confidence_level' => $confidence_level_check]);
					$total += $progress[$key];
				}
			}

			$vals = array_count_values($array);

			$one = 0;
			$two = 0;
			$three = 0;
			$confidence_level_main = 1;
			foreach ($vals as $in => $val) {
				switch ($in) {
				case '1':
					$one = $val;
					break;
				case '2':
					$two = $val;
					break;
				case '3':
					$three = $val;
					break;
				}
			}

			$maxValue = 0;

			foreach ($vals as $key => $value) {
				if ($value > $maxValue) {
					$confidence_level_main = $key;
				}
				$maxValue = $value;
			}

			$total_progress_main = ($total / ($count_key_results * 100)) * 100;

			if ($total_progress_main == 100) {
				$complete_okrs = 1;
				foreach ($arr_id_add as $index => $id_add) {
					$this->db->where('id', $id_add);
					$this->db->update(db_prefix() . 'okrs_checkin', ['complete_okrs' => $complete_okrs]);
				}
			}

			foreach ($main_results as $key => $value) {
				$confidence_level_check = isset($confidence_level[$key]) ? $confidence_level[$key] : 1;

				$data_new_log = ['okrs_id' => $data['id'], 'main_results' => $value, 'target' => $target[$key], 'achieved' => $achieved[$key], 'progress' => number_format((float) $progress[$key], 2, '.', ''), 'confidence_level' => $confidence_level_check, 'unit' => $unit[$key], 'answer' => json_encode($answer[$key]), 'comment' => $comment[$key], 'type' => $data['type'], 'recently_checkin' => $data['recently_checkin'], 'upcoming_checkin' => $data['upcoming_checkin'], 'editor' => get_staff_user_id(), 'key_results_id' => $key_results_id[$key], 'progress_total' => $total_progress_main, 'complete_okrs' => $complete_okrs, 'created_date' => $created_date];
				if (isset($evaluation_criteria) && isset($evaluation_criteria[$key])) {
					$data_new_log['evaluation_criteria'] = $evaluation_criteria[$key];
				}
				$this->db->insert(db_prefix() . 'okrs_checkin_log', $data_new_log);
				$insert_log_id = $this->db->insert_id();
			}

			if ($total_progress_main == "100" || $total_progress_main == "100.00" || $total_progress_main == 100) {
				$complete_okrs = 0;
			}

			$this->db->where('id', $data['id']);
			$this->db->update(db_prefix() . 'okrs', ['progress' => $total_progress_main, 'confidence_level' => $confidence_level_main, 'recently_checkin' => ($data['recently_checkin']), 'upcoming_checkin' => ($data['upcoming_checkin']), 'status' => $complete_okrs, 'type' => $data['type'], 'approval_status' => 3]);
			if ($approver == '') {
				$result_approve = $this->send_request_approve($data['id']);
			} else {
				$result_approve = $this->send_request_approve($data['id'], '', $approver);
			}
			if ($result_approve == false) {
				$this->db->where('id', $data['id']);
				$this->db->update(db_prefix() . 'okrs', ['approval_status' => 1]);
			}
			$this->update_progress_tree($data['id']);
		}
		return $insert_log_id;
	}
	/**
	 * get key result checkin
	 * @param  integer $okrs
	 * @return array
	 */
	public function get_key_result_checkin($okrs) {
		$this->db->where('okrs_id', $okrs);
		return $this->db->get(db_prefix() . 'okrs_checkin')->result_array();
	}

	/**
	 * get key result
	 * @param  integer $okrs
	 * @return array
	 */
	public function get_detailed_key_result($krid = '', $okr_id = '') {
		if ($okr_id != '') {
			$this->db->where('okrs_id', $okr_id);
		}
		if ($krid != '') {
			$this->db->where('id', $krid);
			return $this->db->get(db_prefix() . 'okrs_key_result')->row();
		}
		return $this->db->get(db_prefix() . 'okrs_key_result')->result_array();

	}

	/**
	 * get key result checkin log
	 * @param  integer $okrs
	 * @return  array
	 */
	public function get_key_result_checkin_log($okrs) {
		$this->db->distinct();
		$this->db->select('recently_checkin, progress_total');
		$this->db->where('okrs_id', $okrs);
		return $this->db->get(db_prefix() . 'okrs_checkin_log')->result_array();
	}
	/**
	 * highcharts detailt checkin model
	 * @param  integer $okrs
	 * @return $value_final
	 */
	public function highcharts_detailt_checkin_model($okrs) {
		$value_final = [];
		$result_checkin_log = $this->get_key_result_checkin_log($okrs);
		if (count($result_checkin_log) > 0) {
			foreach ($result_checkin_log as $key => $value) {
				$value_final['recently_checkin'][] = $value['recently_checkin'];
				$value_final['progress_total'][] = (int) $value['progress_total'];
			}
		}
		return $value_final;
	}
	/**
	 * display json tree okrs search
	 * @param  integer $okr
	 * @return $html
	 */
	public function display_json_tree_okrs_search($okr) {
		if ($okr == 0) {
			return $this->display_json_tree_okrs();
		}
		$this->db->where('id', $okr);
		$array = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		$html = '';
		$html .= $this->dq_html('', $array[0]);
		return $html;
	}
	/**
	 * chart tree search
	 * @param  integer $okr
	 * @return $json
	 */
	public function chart_tree_search($okr) {
		if ($okr == 0) {
			return $this->chart_tree_okrs1();
		}
		$this->db->where('id', $okr);
		$array = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		$json[] = $this->dq_json($array[0], []);
		return $json;
	}
	/**
	 * chart tree okrs1
	 * @return $json
	 */
	public function chart_tree_okrs1() {
		$root = $this->get_node_root();
		$okrs = $this->get_okrs();
		$json = [];
		foreach ($root as $key => $okr) {
			$json[] = $this->dq_json($okr, []);
		}
		return $json;
	}
	/**
	 * result checkin log
	 * @param  integer  $id
	 * @param  string  $flag
	 * @param  integer $count
	 * @return $log or array
	 */
	public function result_checkin_log($id, $flag = '', $count = 1) {
		$this->db->where('id', $id);
		$log = $this->db->get(db_prefix() . 'okrs_checkin_log')->row();
		if ($flag != '') {
			return $log;
		}
		$upcoming_checkin = $log->upcoming_checkin;
		$recently_checkin = $log->recently_checkin;
		$okrs_id = $log->okrs_id;

		return $this->db->query('SELECT * FROM ' . db_prefix() . 'okrs_checkin_log where okrs_id = ' . $log->okrs_id . ' and recently_checkin = "' . $recently_checkin . '" and upcoming_checkin = "' . $upcoming_checkin . '" limit ' . $count . '')->result_array();
	}
	/**
	 * get okr staff
	 * @param  integer $staffid
	 * @return array
	 */
	public function get_okr_staff($staffid) {
		$query = 'SELECT id FROM ' . db_prefix() . 'okrs where person_assigned = ' . $staffid . '';
		return $this->db->query($query)->result_array();
	}
	/**
	 * display json tree okrs search staff
	 * @param  array $arr_okr
	 * @return $html
	 */
	public function display_json_tree_okrs_search_staff($arr_okr) {
		$html = '';
		$root = [];
		if (count($arr_okr) > 0) {
			foreach ($arr_okr as $key => $okrs) {
				if ($okrs == 0) {
					return $this->display_json_tree_okrs();
				}
				$this->db->where('id', $okrs['id']);

				$root[] = $this->db->get(db_prefix() . 'okrs')->result_array();
			}

			foreach ($root as $key => $okr) {
				$html .= $this->dq_html('', $okr[0]);
			}

		}
		return $html;
	}
	/**
	 * chart tree search staff
	 * @param  array $arr_okr
	 * @return $json
	 */
	public function chart_tree_search_staff($arr_okr) {

		$html = '';
		$root = [];
		$json = [];
		if (count($arr_okr) > 0) {
			foreach ($arr_okr as $key => $okrs) {
				if ($okrs == 0) {
					return $this->chart_tree_okrs1();
				}
				$this->db->where('id', $okrs['id']);
				$root[] = $this->db->get(db_prefix() . 'okrs')->result_array();
			}
			foreach ($root as $key => $okr) {

				$json[] = $this->dq_json($okr[0], []);
			}
		}

		return $json;
	}

	/**
	 * display tree okrs search checkin
	 * @param  integer $okr
	 * @return $html
	 */
	public function display_tree_okrs_search_checkin($okr) {
		if ($okr == 0) {
			return $this->display_json_tree_checkin();
		}
		$this->db->where('id', $okr);
		$array = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		$html = '';
		$html .= $this->dq_html_checkin('', $array[0]);
		return $html;
	}
	/**
	 * display tree checkin search staff
	 * @param  array $arr_okr
	 * @return $html
	 */
	public function display_tree_checkin_search_staff($arr_okr) {
		$html = '';
		$root = [];
		if (count($arr_okr) > 0) {
			foreach ($arr_okr as $key => $okrs) {
				if ($okrs == 0) {
					return $this->display_json_tree_checkin();
				}
				$this->db->where('id', $okrs['id']);
				$root[] = $this->db->get(db_prefix() . 'okrs')->result_array();
			}
			foreach ($root as $key => $okr) {
				$html .= $this->dq_html_checkin('', $okr[0]);
			}
		}
		return $html;
	}
	/**
	 * get progress dashboard
	 * @param  string $type
	 * @return json
	 */
	public function get_progress_dashboard($type) {
		switch ($type) {
		case 1:
			$progress = '50.00';
			$query = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs
            WHERE (recently_checkin <= CAST(DATE(NOW()) AS DATE)
            AND recently_checkin >= CAST((DATE(NOW()) - INTERVAL 7 DAY) AS DATE)) AND `progress` > ' . $progress . '';
			break;
		case 2:
			$progress = '50.00';
			$query = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs
            WHERE (recently_checkin <= CAST(DATE(NOW()) AS DATE)
            AND recently_checkin >= CAST((DATE(NOW()) - INTERVAL 7 DAY) AS DATE)) AND `progress` < ' . $progress . '';
			break;
		default:
			$progress = '50.00';
			$query = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs
            WHERE (recently_checkin <= CAST(DATE(NOW()) AS DATE)
            AND recently_checkin >= CAST((DATE(NOW()) - INTERVAL 7 DAY) AS DATE)) AND `progress` >= ' . $progress . ' and `progress` <= "70.00"';
			break;
		}
		return $this->db->query($query)->row();
	}
	/**
	 * checkin status dashboard
	 * @return array
	 */
	public function checkin_status_dashboard() {
		$query1 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs_checkin where confidence_level = 1';
		$query2 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs_checkin where confidence_level = 2';
		$query3 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs_checkin where confidence_level = 3';

		$is_fine = $this->db->query($query1)->row()->count;
		$not_so_good = $this->db->query($query2)->row()->count;
		$very_good = $this->db->query($query3)->row()->count;

		$total = $is_fine + $not_so_good + $very_good;

		if ($total == 0) {
			$percent_1 = 0;
			$percent_2 = 0;
			$percent_3 = 0;
		} else {
			$percent_1 = ($is_fine / ($total)) * 100;
			$percent_2 = ($not_so_good / ($total)) * 100;
			$percent_3 = ($very_good / ($total)) * 100;
		}
		return $final = [['name' => _l('is_fine'), 'y' => $percent_1], ['name' => _l('not_so_good'), 'y' => $percent_2], ['name' => _l('very_good'), 'y' => $percent_3]];
	}
	/**
	 * okrs company dasdboard
	 * @return array
	 */
	public function okrs_company_dasdboard() {
		$query_oks = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs';
		$query_progress = 'SELECT (sum(progress)/((select count(*) from ' . db_prefix() . 'okrs)*100)*100) as progress  FROM ' . db_prefix() . 'okrs';
		$query_keyres = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs_key_result';

		$query1 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 1';
		$query2 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 2';
		$query3 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 3';

		$is_fine = $this->db->query($query1)->row()->count;
		$not_so_good = $this->db->query($query2)->row()->count;
		$very_good = $this->db->query($query3)->row()->count;
		$okrs_count = $this->db->query($query_oks)->row()->count;
		$okrs_keyres = $this->db->query($query_keyres)->row()->count;
		$okrs_progress = $this->db->query($query_progress)->row()->progress;
		$total = $is_fine + $not_so_good + $very_good;
		$total = $total <= 0 ? $total = 1 : $total;
		$percent_1 = ($is_fine / ($total)) * 100;
		$percent_2 = ($not_so_good / ($total)) * 100;
		$percent_3 = ($very_good / ($total)) * 100;

		if ($total == 0) {
			$total = 3;
			$percent_1 = ($is_fine / ($total)) * 100;
			$percent_2 = ($not_so_good / ($total)) * 100;
			$percent_3 = ($very_good / ($total)) * 100;
		}

		$html = '
        <div class="progress progress_cus_tranform">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . round($percent_3, 2) . '"  style="' . $percent_3 . '%;" data-percent="' . round($percent_3, 2) . '">
        </div>
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="' . round($percent_1, 2) . '"  style="' . $percent_1 . '%;" data-percent="' . round($percent_1, 2) . '">
        </div>
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="' . round($percent_2, 2) . '"  style="' . $percent_2 . '%;" data-percent="' . round($percent_2, 2) . '">
        </div>
        </div>
        ';

		$test = '
        <div class="progress progress_cus_tranform">

        <div class="progress-bar" role="progressbar" aria-valuenow="' . (int) $okrs_progress . '"  style="' . $okrs_progress . '%;" data-percent="' . (int) $okrs_progress . '">
        </div>
        </div>
        ';
		return ['okrs_count' => $okrs_count, 'okrs_progress' => $test, 'okrs_keyres' => $okrs_keyres, 'html' => $html];
	}
	/**
	 * okrs user dasdboard
	 * @return array
	 */
	public function okrs_user_dasdboard() {
		$staff_current = get_staff_user_id();
		$query_oks = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where person_assigned = ' . $staff_current . ' AND type =1';
		$query_progress = 'SELECT (sum(progress)/((select count(*) from ' . db_prefix() . 'okrs where person_assigned = ' . $staff_current . ' AND type = 1)*100)*100) as progress  FROM ' . db_prefix() . 'okrs WHERE type =1';
		$query_keyres = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs_key_result a left join ' . db_prefix() . 'okrs b ON b.id = a.okrs_id
        where b.person_assigned = ' . $staff_current . ' AND type =1';

		$query1 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 1 and person_assigned = ' . $staff_current . ' AND type =1';
		$query2 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 2 and person_assigned = ' . $staff_current . ' AND type =1';
		$query3 = 'SELECT count(*) as count FROM ' . db_prefix() . 'okrs where confidence_level = 3 and person_assigned = ' . $staff_current . ' AND type =1';

		$is_fine = $this->db->query($query1)->row()->count;
		$not_so_good = $this->db->query($query2)->row()->count;
		$very_good = $this->db->query($query3)->row()->count;
		$okrs_count = $this->db->query($query_oks)->row()->count;
		$okrs_keyres = $this->db->query($query_keyres)->row()->count;
		$okrs_progress = $this->db->query($query_progress)->row()->progress;
		$total = $is_fine + $not_so_good + $very_good;
		if ($total == 0) {
			$percent_1 = 0;
			$percent_2 = 0;
			$percent_3 = 0;
		} else {
			$percent_1 = ($is_fine / ($total)) * 100;
			$percent_2 = ($not_so_good / ($total)) * 100;
			$percent_3 = ($very_good / ($total)) * 100;
		}

		$html = '
        <div class="progress progress_cus_tranform">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . round($percent_3, 2) . '"  style="' . $percent_3 . '%;" data-percent="' . round($percent_3, 2) . '">
        </div>
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="' . round($percent_1, 2) . '"  style="' . $percent_1 . '%;" data-percent="' . round($percent_1, 2) . '">
        </div>
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="' . round($percent_2, 2) . '"  style="' . $percent_2 . '%;" data-percent="' . round($percent_2, 2) . '">
        </div>
        </div>
        ';

		$test = '
        <div class="progress progress_cus_tranform">

        <div class="progress-bar" role="progressbar" aria-valuenow="' . (int) $okrs_progress . '"  style="' . $okrs_progress . '%;" data-percent="' . (int) $okrs_progress . '">
        </div>
        </div>
        ';
		return ['okrs_count' => $okrs_count, 'okrs_progress' => $test, 'okrs_keyres' => $okrs_keyres, 'html' => $html];
	}
	/**
	 * get cky current
	 * @return id
	 */
	public function get_cky_current() {
		$query = 'SELECT id FROM ' . db_prefix() . 'okr_setting_circulation where MONTH(NOW()) = month(from_date) and year(from_date) = year(NOW()) Order by id ASC limit 1';
		if (!isset($this->db->query($query)->row()->id)) {
			return '';
		}
		return $this->db->query($query)->row()->id;
	}

	/**
	 * chart tree okrs
	 * @return json
	 */
	public function chart_tree_okrs_circulation($flag = '') {
		$root = $this->get_node_root($flag);
		$okrs = $this->get_okrs();
		$json = [];
		if (count($root) > 0) {
			foreach ($root as $key => $okr) {
				$json[] = $this->dq_json($okr, []);
			}
		}
		return $json;
	}
	/**
	 * get unit
	 * @param  string $id
	 * @return json or array
	 */
	public function get_unit($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'okr_setting_unit')->row();
		}
		return $this->db->get(db_prefix() . 'okr_setting_unit')->result_array();
	}

	/**
	 * delete okrs
	 * @param  integer $id
	 * @return bolean
	 */
	public function delete_okrs($id) {
		$your_target = '';
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okrs', ['progress' => 0]);
		$this->update_progress_tree($id);
		$okr = $this->okr_model->get_okrs($id);
		if ($okr) {
			$your_target = $okr->your_target;
		}
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'okrs');

		$this->db->where('okrs_id', $id);
		$this->db->delete(db_prefix() . 'okrs_key_result');

		$this->db->where('okrs_id', $id);
		$this->db->delete(db_prefix() . 'okrs_checkin');

		$this->db->where('okr_superior', $id);
		$this->db->update(db_prefix() . 'okrs', ['okr_superior' => '']);

		log_activity('OKR Deleted [ID: ' . $id . ', Objective: ' . $your_target . ']');

		return true;
	}

	public function get_info_node($okrs) {
		$this->db->where('id', $okrs);
		$okr = $this->db->get(db_prefix() . 'okrs')->row();
		$this->db->where('okrs_id', $okr->id);
		$key_results = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
		$progress = $okr->progress;
		if (is_null($progress)) {
			$progress = 0;
		}

		$test = '
        <div class="progress no-margin progress-bar-mini cus_tran">
        <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
        </div>
        </div>
        ' . $progress . '%
        </div>
        ';
		$confidence_level = $okr->confidence_level;

		$html = '';
		$html .= '<table border="1" class="w-100">
        <tr>
        <th>' . _l('main_results') . '</th>
        <th>' . _l('target') . '</th>
        <th>' . _l('progress') . '</th>
        <th>' . _l('confidence_level') . '</th>
        <th>' . _l('plan') . '</th>
        <th>' . _l('results') . '</a></th>
        </tr>';

		if (count($key_results) > 0) {
			foreach ($key_results as $key => $value) {
				$html_tasks = '';

				if ($value['tasks'] != '' || $value['tasks'] != null) {
					$tasks = explode(',', $value['tasks']);
					foreach ($tasks as $key_tasks => $value_tasks) {
						$this->db->where('id', $value_tasks);
						$task = $this->db->get(db_prefix() . 'tasks')->row();
						if ($task != '' || $task != null) {
							$html_tasks .= '<a href="' . admin_url('tasks/view/' . $value_tasks) . '" class="display-block main-tasks-table-href-name" onclick="init_task_modal(' . $value_tasks . '); return false;">' . $task->name . ',</a>';
						} else {
							$find_remove_index = array_search($value_tasks, $tasks);
							unset($tasks[$find_remove_index]);
						}
					}
					$this->db->where('id', $value['id']);
					$this->db->update(db_prefix() . 'okrs_key_result', ['tasks' => implode(',', $tasks)]);
				}
				$test1 = '
                <div class="progress no-margin progress-bar-mini cus_tran">
                <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $value['progress'] . '" aria-valuemin="0" aria-valuemax="100" style="' . $value['progress'] . '%;" data-percent="' . $value['progress'] . '">
                </div>
                </div>
                ' . $value['progress'] . '%
                </div>
                ';
				switch ($value['confidence_level']) {
				case 1:
					$confidence_level_html = '
                    <div class="default">
                    <div class="changed_1">
                    <label>
                    <input type="radio" checked><span> ' . _l('is_fine') . '</span>
                    </label>
                    </div>
                    </div>
                    ';
					break;
				case 2:
					$confidence_level_html = '
                    <div class="default">
                    <label>
                    <input type="radio" checked><span class="default_ct"> ' . _l('not_so_good') . '</span>
                    </label>

                    </div>
                    ';
					break;
				default:
					$confidence_level_html = '
                    <div class="default">
                    <div class="changed_2">
                    <label>
                    <input type="radio"  checked><span> ' . _l('very_good') . '</span>
                    </label>
                    </div>
                    </div>
                    ';
					break;
				}

				$unit_ = (isset($this->get_unit($value['unit'])->unit) ? $this->get_unit($value['unit'])->unit : '');
				$html .= '
                <tr>
                <td>' . $value['main_results'] . '</td>
                <td>' . $value['target'] . '(' . $unit_ . ')</td>
                <td class="view_detail_okr_progress">' . $test1 . '</td>
                <td>' . $confidence_level_html . '</td>
                <td><a href="#" id="plan_view" data-toggle="popover" data-placement="bottom" data-content="' . $value['plan'] . '" data-original-title="' . _l('plan') . '">' . $value['plan'] . '</a></td>
                <td><a href="#" id="results_view" data-toggle="popover" data-placement="bottom" data-content="' . $value['results'] . '"  data-original-title="' . _l('results') . '">' . $value['results'] . '</a></td>
                </tr>
                ';
			}
		}
		$html .= '</table>';

		return $html;
	}

	public function notifications($id_staff, $link, $description) {
		$notifiedUsers = [];
		$id_userlogin = get_staff_user_id();

		$notified = add_notification([
			'fromuserid' => $id_userlogin,
			'description' => $description,
			'link' => $link,
			'touserid' => $id_staff,
			'additional_data' => serialize([
				$description,
			]),
		]);
		if ($notified) {
			array_push($notifiedUsers, $id_staff);
		}
		pusher_trigger_notification($notifiedUsers);
	}

	/**
	 * get_okrs_attachments
	 * @param  int  $id
	 * @param  boolean $rel_id
	 * @return object
	 */
	public function get_okrs_attachments($id, $rel_id = false) {
		$this->db->where('id', $id);
		$file = $this->db->get(db_prefix() . 'files')->row();

		if ($file && $rel_id) {
			if ($file->rel_id != $rel_id) {
				return false;
			}
		}
		return $file;
	}

	/**
	 * get_checkin_attachments
	 * @param  int  $id
	 * @param  boolean $rel_id
	 * @return object
	 */
	public function get_checkin_attachments($id, $rel_id = false) {
		$this->db->where('id', $id);
		$this->db->where('rel_type', 'checkin');
		$file = $this->db->get(db_prefix() . 'files')->row();

		if ($file && $rel_id) {
			if ($file->rel_id != $rel_id) {
				return false;
			}
		}
		return $file;
	}

	/**
	 * delete okrs attachment
	 *
	 * @param      $id     The identifier
	 *
	 * @return     bolean
	 */
	public function delete_okrs_attachment($id) {
		$attachment = $this->get_okrs_attachments($id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(OKR_MODULE_UPLOAD_FOLDER . '/okrs_attachments/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix() . 'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}
			if (is_dir(OKR_MODULE_UPLOAD_FOLDER . '/okrs_attachments/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(OKR_MODULE_UPLOAD_FOLDER . '/okrs_attachments/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(OKR_MODULE_UPLOAD_FOLDER . '/okrs_attachments/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * delete_checkin_attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_checkin_attachment($id) {
		$attachment = $this->get_checkin_attachments($id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(OKR_MODULE_UPLOAD_FOLDER . '/checkin/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix() . 'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}
			if (is_dir(OKR_MODULE_UPLOAD_FOLDER . '/checkin/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(OKR_MODULE_UPLOAD_FOLDER . '/checkin/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(OKR_MODULE_UPLOAD_FOLDER . '/checkin/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * get category
	 * @param  integer $id
	 * @return array or json
	 */
	public function get_category($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'okr_setting_category')->row();
		}
		return $this->db->get(db_prefix() . 'okr_setting_category')->result_array();
	}

	/**
	 * display json tree okrs
	 * @return $html
	 */
	public function display_json_tree_okrs_type($type = '') {

		if (!is_admin()) {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$this->db->where('department IN ' . $dept);
			}
		}
		$this->db->where('type', $type);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();

		$json = [];
		$html = '';
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$html .= $this->dq_html('', $okr);
			}
		}

		return $html;
	}
	/**
	 * chart tree okrs
	 * @return json
	 */
	public function chart_tree_okrs_type($type = '') {
		$this->db->where('type', $type);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$json[] = $this->dq_json($okr, []);
			}
		}
		return $json;
	}

	/**
	 * display json tree okrs
	 * @return $html
	 */
	public function display_json_tree_okrs_category($category = '') {
		if (!is_admin()) {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$this->db->where('department IN ' . $dept);
			}
		}
		$this->db->where('category', $category);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();

		$json = [];
		$html = '';
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$html .= $this->dq_html_category('', $okr);
			}
		}
		return $html;

	}
	/**
	 * chart tree okrs
	 * @return json
	 */
	public function chart_tree_okrs_category($category = '') {
		$this->db->where('category', $category);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$json[] = $this->dq_json_category($okr, []);
			}
		}
		return $json;
	}
	/**
	 * dq html
	 * @param  string $html
	 * @param  array $node
	 * @return $html
	 */
	public function dq_html_category($html, $node) {
		$key_results = $this->count_key_results($node['id']);

		$progress = $this->okr_model->get_okrs($node['id'])->progress;
		if (is_null($progress)) {
			$progress = 0;
		}
		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id() || is_admin()) {
			$display = '';
		}
		$full_name =
		'<div class="pull-right">' . staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . get_staff_full_name($node['person_assigned']) . '</a> </div>';

		$rattings = '
        <div class="progress no-margin progress-bar-mini cus_tran">
        <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
        </div>
        </div>
        ' . $progress . '%
        </div>
        ';

		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$department = $node['department'] != '' && $node['department'] != 0 ? get_department_name_of_okrs($node['department'])->name : '';

		if ($node['status'] == 0) {
			$status = '<span class="label label-warning s-status ">' . _l('unfinished') . '</span>';
		} else {
			$status = '<span class="label label-success s-status ">' . _l('finish') . '</span>';
		}

		$option = '';
		$option .= '<a href="' . admin_url('okr/show_detail_node/' . $node['id']) . '" class="btn btn-default btn-icon">';
		$option .= '<i class="fa fa-eye"></i>';
		$option .= '</a>';
		if ($this->okr_model->get_okrs($node['id'])->status != 1) {
			if ((has_permission('okr', '', 'edit') && $node['type'] != 3) || (has_permission('okr', '', 'edit_company') && $node['type'] == 3) || is_admin()) {
				$option .= '<a href="' . admin_url('okr/new_object_main/' . $node['id']) . '" class="btn btn-default btn-icon">';
				$option .= '<i class="fa fa-edit"></i>';
				$option .= '</a>';
			}

		}
		if (has_permission('okr', '', 'delete') || is_admin()) {
			$option .= '<a href="' . admin_url('okr/delete_okrs/' . $node['id']) . '" class="btn btn-danger btn-icon _delete">';
			$option .= '<i class="fa fa-remove"></i>';
			$option .= '</a>';
		}
		$row[] = $option;

		$html .= '
        <tr class="treegrid-' . $node['id'] . ' treegrid-parent-' . $node['okr_superior'] . ' ' . $display . '" >
        <td class="text-left "><a href="#" class="trigger" data-id="' . $node['person_assigned'] . '" ><div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '</a> <span class="your-target-content">' . $node['your_target'] . '</span></div></td>
        <td><div class="box effect8" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
        <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
        </div>
        </td>' .
		//<td class="text-danger">+' . $node['change'] . '</td>
		'<td>' . $rattings . '</td>
        <td>' . category_view($node['category']) . '  </td>
        <td>' . $type . '  </td>
        <td>' . $department . '  </td>
        <td>' . $status . '</td>';
		if (has_permission('okr', '', 'edit') || is_admin() || has_permission('okr', '', 'delete')) {
			$html .= '<td>' . $option . '</td>';
		}
		$html .= '</tr>';

		return $html;
	}

	/**
	 * dq json
	 * @param  array $node
	 * @param  array $array_
	 * @return $array
	 */
	public function dq_json_category($node, $array_) {
		$data_popover = $this->objective_show($node['id']);
		$progress = $this->okr_model->get_okrs($node['id'])->progress;
		if (is_null($progress)) {
			$progress = 0;
		}
		$test = '
        <div class="progress-json">
        <div class="project-progress relative" data-value="' . ($progress / 100) . '" data-size="55" data-thickness="5">
        <strong class="okr-percent"></strong>
        </div>
        <span >' . _l('progress') . '</span>
        </div>

        ';

		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id()) {
			$display = '';
		}

		$count_key_results = $this->count_key_results($node['id']);
		$rattings = '<div class="devicer">';
		$rattings .= $test;
		$rattings .= '<div class="box-json">';
		if ($count_key_results->count > 0) {
			$rattings .= '<div class="demo_box" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content=""><div class="bg-1 pull-right"><span class="rate-box-value-1">' . $count_key_results->count . '</span></div></div>';
		} else {
			$rattings .= '<div class="demo_box" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="" > <div class="bg-2"><span class="rate-box-value-2">' . $count_key_results->count . '</span></div></div>';
		}
		$rattings .= '<span class="key-rs-cus">' . _l('key_results') . '</span>';
		$rattings .= '</div>';

		$rattings .= '</div>';

		if ($display == 'hide') {
			$rattings = '';
		}
		$role = get_role_name_staff($node['person_assigned']);
		$name = '<a href="' . admin_url('okr/show_detail_node/' . $node['id']) . '">' . $node['your_target'] . '</a>';
		if ($display == 'hide') {
			$name = '<i class="fa fa-lock lagre-lock" aria-hidden="true"></i>';
		}
		$title = '<div class="position-absolute mleft-22"><a href="#" class="name_class_chart">' . get_staff_full_name($node['person_assigned']) . '</a><div class="role_name">' . $role . '</div></div>';
		$image = staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left position-absolute']);
		$array = array('name' => $name, 'title' => $title, 'job_position_name' => '', 'dp_user_icon' => $rattings, 'display' => $display, 'image' => $image);

		return $array;
	}

	/**
	 * display json tree okrs
	 * @return $html
	 */
	public function display_json_tree_okrs_department($department = '') {
		if (is_admin()) {
			$this->db->where('department', $department);
			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		} else {
			if ($department == '' || $department == 0) {
				$this->load->model('departments_model');
				$list_dept = $this->departments_model->get_staff_departments(false, true);
				$dept = '(';
				for ($i = 0; $i < count($list_dept) - 1; $i++) {
					$dept .= $list_dept[$i] . ',';
				}
				if (count($list_dept) > 0) {
					$dept .= $list_dept[count($list_dept) - 1] . ')';
					$this->db->where('department IN ' . $dept);
				}

			} else {
				$this->db->where('department', $department);
			}

			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		}

		$json = [];
		$html = '';
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$html .= $this->dq_html_category('', $okr);
			}
		}
		return $html;

	}
	/**
	 * chart tree okrs
	 * @return json
	 */
	public function chart_tree_okrs_department($department = '') {
		if (is_admin()) {
			$this->db->where('department', $department);
			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		} else {
			if ($department == '' || $department == 0) {
				$this->load->model('departments_model');
				$list_dept = $this->departments_model->get_staff_departments(false, true);
				$dept = '(';
				for ($i = 0; $i < count($list_dept) - 1; $i++) {
					$dept .= $list_dept[$i] . ',';
				}
				if (count($list_dept) > 0) {
					$dept .= $list_dept[count($list_dept) - 1] . ')';
					$this->db->where('department IN ' . $dept);
				}

			} else {
				$this->db->where('department', $department);
			}

			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		}
		$json = [];
		if (count($okrs) > 0) {
			foreach ($okrs as $key => $okr) {
				$json[] = $this->dq_json_category($okr, []);
			}
		}
		return $json;
	}
	/**
	 * display json tree checkin
	 * @return $html
	 */
	public function display_json_tree_checkin_type($type = '') {
		if (!is_admin()) {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$this->db->where('department IN ' . $dept);
			}
		}
		$this->db->where('type', $type);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		$html = '';
		foreach ($okrs as $key => $okr) {
			$html .= $this->dq_html_checkin('', $okr);
		}
		return $html;
	}

	/**
	 * display json tree checkin
	 * @return $html
	 */
	public function display_json_tree_checkin_category($category = '') {
		if (!is_admin()) {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$this->db->where('department IN ' . $dept);
			}
		}
		$this->db->where('category', $category);
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$json = [];
		$html = '';
		foreach ($okrs as $key => $okr) {
			$html .= $this->dq_html_checkin('', $okr);
		}
		return $html;
	}

	/**
	 * display json tree checkin
	 * @return $html
	 */
	public function display_json_tree_checkin_department($department = '') {
		if (is_admin()) {
			$this->db->where('department', $department);
			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		} else {
			if ($department == '' || $department == 0) {
				$this->load->model('departments_model');
				$list_dept = $this->departments_model->get_staff_departments(false, true);
				$dept = '(';
				for ($i = 0; $i < count($list_dept) - 1; $i++) {
					$dept .= $list_dept[$i] . ',';
				}
				if (count($list_dept) > 0) {
					$dept .= $list_dept[count($list_dept) - 1] . ')';
					$this->db->where('department IN ' . $dept);
				}

			} else {
				$this->db->where('department', $department);
			}

			$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		}
		$json = [];
		$html = '';
		foreach ($okrs as $key => $okr) {
			$html .= $this->dq_html_checkin('', $okr);
		}
		return $html;
	}
	public function get_edit_okrs_v101($id) {
		$this->db->where('circulation', $id);
		return $rs = $this->db->get(db_prefix() . 'okrs')->result_array();
	}

	public function dq_v101($okrs) {
		$sup = [];
		if ($okrs->okr_superior != '') {
			$sup[] = $okrs->okr_superior;
			$okr = $this->get_okrs($okrs->okr_superior);
			$sup[] = $okr->okr_superior;
			$this->dq_v101($okr);
		}
		return $sup;
	}

	/**
	 * add approval process
	 * @param bool
	 */
	public function add_approval_process($data) {
		unset($data['approval_setting_id']);
		if (isset($data['approver'])) {
			$setting = [];
			foreach ($data['approver'] as $key => $value) {
				$node = [];
				$node['approver'] = $data['approver'][$key];
				$node['staff'] = $data['staff'][$key];

				$setting[] = $node;
			}
			unset($data['approver']);
			unset($data['staff']);
		}
		if (!isset($data['choose_when_approving'])) {
			$data['choose_when_approving'] = 0;
		}
		$data['setting'] = json_encode($setting);
		if (isset($data['notification_recipient'])) {
			$data['notification_recipient'] = implode(",", $data['notification_recipient']);
		}

		if (isset($data['department'])) {
			$data['department'] = implode(",", $data['department']);
		}

		if (isset($data['okrs'])) {
			$data['okrs'] = implode(",", $data['okrs']);
		}

		$this->db->insert(db_prefix() . 'okr_approval_setting', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			return true;
		}
		return false;
	}

	/**
	 * update approval process
	 * @param  int $id
	 * @param  object $data
	 * @return bool
	 */
	public function update_approval_process($id, $data) {

		if (isset($data['approver'])) {
			$setting = [];
			foreach ($data['approver'] as $key => $value) {
				$node = [];
				$node['approver'] = $data['approver'][$key];
				$node['staff'] = $data['staff'][$key];

				$setting[] = $node;
			}
			unset($data['approver']);
			unset($data['staff']);
		}
		if (!isset($data['choose_when_approving'])) {
			$data['choose_when_approving'] = 0;
		}
		$data['setting'] = json_encode($setting);

		if (isset($data['notification_recipient'])) {
			$data['notification_recipient'] = implode(",", $data['notification_recipient']);
		}

		if (isset($data['department'])) {
			$data['department'] = implode(",", $data['department']);
		}

		if (isset($data['okrs'])) {
			$data['okrs'] = implode(",", $data['okrs']);
		}

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_approval_setting', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete approval setting
	 * @param  int $id
	 * @return bool
	 */
	public function delete_approval_setting($id) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			$this->db->delete(db_prefix() . 'okr_approval_setting');

			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	/**
	 * get approval details by rel id and rel type
	 * @param  [type] $rel_id
	 * @param  [type] $rel_type
	 * @return [type]
	 */
	public function get_approval_details_by_rel_id_and_rel_type($rel_id, $rel_type) {
		if ($rel_id != '') {
			$this->db->where('rel_id', $rel_id);
			$this->db->where('rel_type', $rel_type);
			$this->db->order_by('id');
			return $this->db->get(db_prefix() . 'okr_approval_details')->result_array();
		} else {
			return $this->db->get(db_prefix() . 'okr_approval_details')->result_array();
		}
	}

	public function send_notify_approve($id, $request_type) {
		$link = '';
		$link = 'okr/checkin_detailt/' . $id;
		$data_approve = $this->get_approval_details_by_rel_id_and_rel_type($id, $request_type);

		if ($data_approve) {
			foreach ($data_approve as $key => $approver) {
				if ($approver['approve'] == '' || $approver['approve'] == null) {
					$string_sub = _l('sent_you_an_approval_request') . ' ' . _l($request_type);
					$this->notifications($approver['staffid'], $link, strtolower($string_sub));
					return true;
				} elseif ($approver['approve'] == 2) {
					return true;
				}
			}
		}
		return false;
	}

	public function send_request_approve($rel_id, $staff_id = '', $approver = '') {
		$date_send = date('Y-m-d H:i:s');
		if ($staff_id == '') {
			$sender = get_staff_user_id();
		} else {
			$sender = $staff_id;
		}
		$rel_type = $this->get_info_check_in_current_approval($rel_id);

		$data_setting = $this->get_approve_setting($rel_type->department, $rel_id, false);

		if ($data_setting) {
			if ($data_setting->choose_when_approving == 1) {

				$row['staffid'] = $approver;
				$row['date_send'] = $date_send;
				$row['rel_id'] = $rel_id;
				$row['rel_type'] = "checkin";
				$row['sender'] = $sender;
				$this->db->insert(db_prefix() . 'okr_approval_details', $row);
				$insert_id = $this->db->insert_id();

				//Old code: $this->send_notify_approve($insert_id, "checkin");
				$this->send_notify_approve($rel_id, "checkin");

				return true;
			}
		}
		$data_new = $this->get_approve_setting($rel_type->department, $rel_id);

		if (!$data_new) {
			return false;
		}

		$this->delete_approval_details($rel_id, "checkin");

		$list_staff = $this->staff_model->get();
		$list = [];
		$staff_addedfrom = get_staff_user_id();

		foreach ($data_new as $value) {
			$row = [];
			$row['notification_recipient'] = $data_setting->notification_recipient;
			$row['approval_deadline'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $data_setting->number_day_approval . ' day'));

			if ($value->approver !== 'specific_personnel') {
				$value->staff_addedfrom = $staff_addedfrom;
				$value->rel_type = "checkin";
				$value->rel_id = $rel_id;

				$approve_value = $this->get_staff_id_by_approve_value($value, $value->approver);
				if (is_numeric($approve_value) && $approve_value > 0) {
					$approve_value = $this->staff_model->get($approve_value)->email;
				} else {

					$this->db->where('rel_id', $rel_id);
					$this->db->where('rel_type', "checkin");
					$this->db->delete('' . db_prefix() . 'okr_approval_details');

					return $value->approver;
				}
				$row['approve_value'] = $approve_value;

				$staffid = $this->get_staff_id_by_approve_value($value, $value->approver);

				if (empty($staffid)) {
					$this->db->where('rel_id', $rel_id);
					$this->db->where('rel_type', "checkin");
					$this->db->delete('' . db_prefix() . 'okr_approval_details');

					return $value->approver;
				}

				$row['staffid'] = $staffid;
				$row['date_send'] = $date_send;
				$row['rel_id'] = $rel_id;
				$row['rel_type'] = "checkin";
				$row['sender'] = $sender;
				$this->db->insert(db_prefix() . 'okr_approval_details', $row);
				$insert_id = $this->db->insert_id();

				//Old code: $this->send_notify_approve($insert_id, "checkin");
				$this->send_notify_approve($rel_id, "checkin");

			} else if ($value->approver == 'specific_personnel') {
				$row['staffid'] = $value->staff;
				$row['date_send'] = $date_send;
				$row['rel_id'] = $rel_id;
				$row['rel_type'] = "checkin";
				$row['sender'] = $sender;
				$this->db->insert(db_prefix() . 'okr_approval_details', $row);
				$insert_id = $this->db->insert_id();

				//Old code: $this->send_notify_approve($insert_id, "checkin");
				$this->send_notify_approve($rel_id, "checkin");
			}
		}

		return true;
	}
	public function get_approve_setting($type_department, $type_okrs_id, $only_setting = true) {
		$this->db->select('*');
		// Old condition $sql_where = 'find_in_set(' . $type_department . ', department) or find_in_set(' . $type_okrs_id . ', okrs) ORDER BY id DESC';
		$sql_where = 'find_in_set(' . $type_department . ', department) or find_in_set(' . $type_okrs_id . ', okrs) or okrs IS NULL or okrs = "" ORDER BY id DESC';
		$this->db->where($sql_where);
		$approval_setting = $this->db->get(db_prefix() . 'okr_approval_setting')->row();
		if ($approval_setting) {
			if ($only_setting == false) {
				return $approval_setting;
			} else {
				return json_decode($approval_setting->setting);
			}
		} else {
			return false;
		}
	}

	public function get_approve_setting_okr($id, $only_setting = true) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$approval_setting = $this->db->get(db_prefix() . 'okr_approval_setting')->row();
		if ($approval_setting) {
			if ($only_setting == false) {
				return $approval_setting;
			} else {
				return json_decode($approval_setting->setting);
			}
		} else {
			return false;
		}
	}

	public function delete_approval_details($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$this->db->delete(db_prefix() . 'okr_approval_details');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function get_info_check_in_current_approval($okrs_id) {
		$rs = new \stdClass();
		$department = $this->get_okrs($okrs_id)->department;
		$rs->okrs_id = $okrs_id;
		$rs->department = $department;

		return $rs;
	}

	public function get_staff_id_by_approve_value($data, $approve_value) {
		$list_staff = $this->staff_model->get();
		$list = [];
		$staffid = [];

		if ($approve_value == 'department_manager') {
			$staffid = $this->departments_model->get_staff_departments($data->staff_addedfrom)[0]['manager_id'];
		} elseif ($approve_value == 'direct_manager') {
			$staffid = $this->staff_model->get($data->staff_addedfrom)->team_manage;
		}

		return $staffid;
	}

	public function check_approval_details($rel_id, $rel_type) {
		$this->db->where('rel_id', $rel_id);
		$this->db->where('rel_type', $rel_type);
		$approve_status = $this->db->get(db_prefix() . 'okr_approval_details')->result_array();
		if (count($approve_status) > 0) {
			foreach ($approve_status as $value) {
				if ($value['approve'] == -1) {
					return 'reject';
				}
				if ($value['approve'] == 0) {
					$value['staffid'] = explode(', ', $value['staffid']);
					return $value;
				}
			}
			return true;
		}
		return false;
	}

	public function update_approval_details($id, $data) {
		$data['date'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okr_approval_details', $data);
		if ($this->db->affected_rows() > 0) {

			return true;
		}
		return false;
	}

	public function change_approve($data) {
		$this->db->where('rel_id', $data['rel_id']);
		$this->db->where('rel_type', $data['rel_type']);
		$this->db->where('staffid', $data['staffid']);
		$this->db->update(db_prefix() . 'okr_approval_details', $data);

		if ($this->db->affected_rows() > 0) {
			$editor = $this->db->query('SELECT * FROM ' . db_prefix() . 'okrs_checkin where okrs_id = ' . $data['rel_id'] . '')->row()->editor;
			$link = 'okr/checkin_detailt/' . $data['rel_id'];
			if ($data['approve'] == 1) {
				$string_sub = get_staff_full_name($editor) . ' ' . _l('approved_checkin');
			} else {
				$string_sub = get_staff_full_name($editor) . ' ' . _l('rejected_checkin');
			}

			$this->notifications($editor, $link, strtolower($string_sub));

			$this->send_notify_approve($data['rel_id'], "checkin");
			$count_approve_total = $this->count_approve($data['rel_id'], $data['rel_type'])->count;
			$count_approve = $this->count_approve($data['rel_id'], $data['rel_type'], 1)->count;
			$count_reject = $this->count_approve($data['rel_id'], $data['rel_type'], 2)->count;
			if ($count_approve_total == $count_approve) {
				$data_status['status'] = $this->handle_progress_okr_approval_completed($data['rel_id']);
				$data_status['approval_status'] = 1;
				$this->db->where('id', $data['rel_id']);
				$this->db->update(db_prefix() . 'okrs', $data_status);
			} elseif ($count_approve_total == $count_reject || ($count_reject > 0)) {
				$data_status['approval_status'] = 2;
				$this->db->where('id', $data['rel_id']);
				$this->db->update(db_prefix() . 'okrs', $data_status);
			}
			return true;
		}
		return false;
	}

	public function count_approve($rel_id, $rel_type, $approve = '') {
		if ($approve == '') {
			return $this->db->query('SELECT count(distinct(staffid)) as count FROM ' . db_prefix() . 'okr_approval_details where rel_id = ' . $rel_id . ' and rel_type = \'' . $rel_type . '\'')->row();
		} elseif ($approve == 1) {
			return $this->db->query('SELECT count(distinct(staffid)) as count FROM ' . db_prefix() . 'okr_approval_details where rel_id = ' . $rel_id . ' and rel_type = \'' . $rel_type . '\' and approve = ' . $approve . '')->row();
		} elseif ($approve == 2) {
			return $this->db->query('SELECT count(distinct(staffid)) as count FROM ' . db_prefix() . 'okr_approval_details where rel_id = ' . $rel_id . ' and rel_type = \'' . $rel_type . '\' and approve = ' . $approve . '')->row();
		}
	}

	public function handle_progress_okr_approval_completed($okrs_id) {
		$this->db->where('id', $okrs_id);
		$progress = $this->db->get(db_prefix() . 'okrs')->row()->progress;
		if ($progress == 100 || $progress == "100" || $progress = "100.00") {
			return 1;
		}
		return 0;
	}

	//update
	/**
	 * update setting circulation
	 * @param  array $data
	 * @param  integer $id
	 * @return bolean
	 */
	public function update_key_result_with_task($data) {
		$id = $data['id'];
		unset($data['id']);
		if (isset($data['tasks'])) {
			$data['tasks'] = implode(',', $data['tasks']);
		}
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'okrs_key_result', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get all okrs
	 * @return [type] [description]
	 */
	public function get_all_okrs() {
		$this->load->model('departments_model');
		$list_dept = $this->departments_model->get_staff_departments(false, true);
		$this->db->select(
			db_prefix() . 'okrs.your_target,' .
			db_prefix() . 'okrs.display,' .
			db_prefix() . 'okrs.person_assigned,' .
			db_prefix() . 'okrs.status,' .
			db_prefix() . 'okrs.type,' .
			db_prefix() . 'okrs.category,' .
			db_prefix() . 'okrs.department,' .
			db_prefix() . 'okrs.okr_superior,' .
			db_prefix() . 'okrs.parent_key_result,' .
			db_prefix() . 'okrs_key_result.main_results,' .
			db_prefix() . 'okrs_key_result.target,' .
			db_prefix() . 'okrs_key_result.plan,' .
			db_prefix() . 'okrs_key_result.results,' .
			db_prefix() . 'okr_setting_circulation.name_circulation,' .
			db_prefix() . 'okr_setting_category.category,' .
			db_prefix() . 'departments.name as department_name,' .
			db_prefix() . 'okr_setting_unit.unit,' .
			'concat(' . db_prefix() . 'staff.firstname," ",' . db_prefix() . 'staff.lastname) as staff_full_name'
		);

		$this->db->join(db_prefix() . 'okrs', db_prefix() . 'okrs.id = ' . db_prefix() . 'okrs_key_result.okrs_id', 'left');
		$this->db->join(db_prefix() . 'okr_setting_circulation', db_prefix() . 'okr_setting_circulation.id = ' . db_prefix() . 'okrs.circulation', 'left');
		$this->db->join(db_prefix() . 'okr_setting_category', db_prefix() . 'okr_setting_category.id = ' . db_prefix() . 'okrs.category', 'left');
		$this->db->join(db_prefix() . 'departments', db_prefix() . 'departments.departmentid = ' . db_prefix() . 'okrs.department', 'left');
		$this->db->join(db_prefix() . 'okr_setting_unit', db_prefix() . 'okr_setting_unit.id = ' . db_prefix() . 'okrs_key_result.unit', 'left');
		$this->db->join(db_prefix() . 'staff', db_prefix() . 'staff.staffid = ' . db_prefix() . 'okrs.person_assigned', 'left');
		if (!is_admin()) {

			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$this->db->where(db_prefix() . 'okrs.department IN ' . $dept);
				$this->db->or_where('(' . db_prefix() . 'okrs.type =3 AND ' . db_prefix() . 'okrs.display = 1)');
				$this->db->or_where('(' . db_prefix() . 'okrs.person_assigned =' . get_staff_user_id() . ')');
			}
		}
		return $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
	}

	/**
	 * get staff id by name
	 * @param  string $staff_name
	 * @return int
	 */
	public function get_staff_id_by_name($staff_name) {
		$this->db->select('staffid');
		$this->db->where('lower(concat(firstname," ",lastname)) = "' . strtolower(trim($staff_name)) . '"');
		$res = $this->db->get(db_prefix() . 'staff')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['staffid'];
		}
		return 0;
	}

	/**
	 * get department id by name
	 * @param  string $department_name
	 * @return int
	 */
	public function get_department_id_by_name($department_name) {
		$this->db->select('departmentid');
		$this->db->where('lower(name) = "' . strtolower(trim($department_name)) . '"');
		$res = $this->db->get(db_prefix() . 'departments')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['departmentid'];
		}
		return 0;
	}

	/**
	 * get unit id by name
	 * @param  string $unit_name
	 * @return int
	 */
	public function get_unit_id_by_name($unit_name) {
		$this->db->select('id');
		$this->db->where('lower(unit) = "' . strtolower(trim($unit_name)) . '"');
		$res = $this->db->get(db_prefix() . 'okr_setting_unit')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['id'];
		}
		return 0;
	}

	/**
	 * get category id by name
	 * @param  string $category_name
	 * @return int
	 */
	public function get_category_id_by_name($category_name) {
		$this->db->select('id');
		$this->db->where('lower(category) = "' . strtolower(trim($category_name)) . '"');
		$res = $this->db->get(db_prefix() . 'okr_setting_category')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['id'];
		}
		return 0;
	}

	/**
	 * get circulation id by name
	 * @param  string $circulation_name
	 * @return int
	 */
	public function get_circulation_id_by_name($circulation_name) {
		$this->db->select('id');
		$this->db->where('lower(name_circulation) = "' . strtolower(trim($circulation_name)) . '"');
		$res = $this->db->get(db_prefix() . 'okr_setting_circulation')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['id'];
		}
		return 0;
	}

	/**
	 * get okr by multi condition
	 * @param  [type] $your_target
	 * @param  [type] $circulation
	 * @param  [type] $type
	 * @param  [type] $department
	 * @param  [type] $person_assigned
	 * @param  [type] $category
	 * @param  [type] $display
	 * @return [type]
	 */
	public function get_okr_by_multi_condition($your_target, $circulation, $type, $department, $person_assigned, $category, $display, $okr_superior, $parent_key_result) {
		$this->db->select('id');
		$this->db->where('lower(your_target) = "' . strtolower(trim($your_target)) . '"');
		$this->db->where('circulation', $circulation);
		$this->db->where('type', $type);
		$this->db->where('department', $department);
		$this->db->where('person_assigned', $person_assigned);
		$this->db->where('category', $category);
		$this->db->where('display', $display);
		if ($okr_superior > 0) {
			$this->db->where('okr_superior', $okr_superior);
		}
		if ($parent_key_result > 0) {
			$this->db->where('parent_key_result', $parent_key_result);
		}
		$res = $this->db->get(db_prefix() . 'okrs')->result_array();
		if (isset($res) && count($res) > 0) {
			return $res[0]['id'];
		}
		return 0;
	}

	/**
	 * insert okrs
	 * @param  [type] $data
	 * @return [type]
	 */
	public function insert_okrs($data) {
		$this->db->insert(db_prefix() . 'okrs', $data);
		return $this->db->insert_id();
	}

	/**
	 * insert key result
	 * @param  [type] $data
	 * @return [type]
	 */
	public function insert_keyresult($data) {
		$this->db->insert(db_prefix() . 'okrs_key_result', $data);
		return $this->db->insert_id();
	}

	/**
	 * get array circulation
	 * @return array
	 */
	public function get_array_circulation() {
		$res = $this->db->get(db_prefix() . 'okr_setting_circulation')->result_array();
		$arr_cir = array();
		if ($res) {
			foreach ($res as $cir) {
				$arr_cir[$cir['id']] = $cir;
			}
		}
		return $arr_cir;
	}

	/**
	 * get array category
	 * @return array
	 */
	public function get_array_category() {
		$this->db->select('id, category');
		$res = $this->db->get(db_prefix() . 'okr_setting_category')->result_array();
		$arr_cat = array();
		if ($res) {
			foreach ($res as $cat) {
				$arr_cat[$cat['id']] = $cat;
			}
		}
		return $arr_cat;
	}

	/**
	 * get array department
	 * @return array
	 */
	public function get_array_department() {
		$this->db->select('departmentid, name');
		$res = $this->db->get(db_prefix() . 'departments')->result_array();
		$arr_dept = array();
		if ($res) {
			foreach ($res as $dept) {
				$arr_dept[$dept['departmentid']] = $dept;
			}
		}
		return $arr_dept;
	}

	/**
	 * get array okrs
	 * @return array
	 */
	public function get_array_okrs($text = false) {
		$this->db->select('id,your_target');
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		$arr_okrs = [];
		if ($okrs) {
			foreach ($okrs as $okr) {
				if ($text == true) {
					$arr_okrs[strtolower($okr['your_target'])] = $okr['id'];
				} else {
					$arr_okrs[$okr['id']] = $okr['your_target'];
				}

			}
		}
		return $arr_okrs;
	}

	/**
	 * get array key results
	 * @return array
	 */
	public function get_array_key_result($okr_id = '', $text = false) {
		$this->db->select('id,main_results');
		if ($okr_id > 0) {
			$this->db->where('okrs_id', $okr_id);
		}
		$krs = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
		$arr_kr = [];
		if ($krs) {
			foreach ($krs as $kr) {
				if ($text == true) {
					$arr_kr[strtolower($kr['main_results'])] = $kr['id'];
				} else {
					$arr_kr[$kr['id']] = $kr['main_results'];
				}

			}
		}
		return $arr_kr;
	}

	/**
	 *  get tree okrs
	 * @param  tree  &$okr_tree
	 * @param  int  $parent_id
	 * @param  int  $circulation
	 * @param  int  $okr
	 * @param  int  $staff
	 * @param  int  $type
	 * @param  int  $category
	 * @param  int  $department
	 * @param  int $view_global
	 * @param  array  $arr_cir
	 * @return tree
	 */
	public function get_tree_okrs(&$html, &$node, $parent_id, $circulation = 0, $okrid = 0, $staff = 0, $type = 0, $category = 0, $department = 0, $view_global = false, $arr_cir = [], $arr_staff_dept = [], $arr_dept = [], $arr_cat = [], $render_type = 'okr') {
		if ($parent_id > 0) {
			$this->db->where('okr_superior', $parent_id);
		} else {
			$this->db->where('okr_superior is null or okr_superior = 0');
		}
		$okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		if (isset($okrs)) {
			foreach ($okrs as $okr) {
				$flag_circulation = false;
				if ($circulation > 0 && isset($arr_cir[$circulation]) && isset($arr_cir[$okr['circulation']])) {
					$cfdate = strtotime($arr_cir[$circulation]['from_date']);
					$ctdate = strtotime($arr_cir[$circulation]['to_date']);
					$ofdate = strtotime($arr_cir[$okr['circulation']]['from_date']);
					$otdate = strtotime($arr_cir[$okr['circulation']]['to_date']);
					if (($ofdate >= $cfdate && $ofdate <= $ctdate) || ($otdate >= $cfdate && $otdate <= $ctdate)) {
						$flag_circulation = true;
					}
				} else {
					$flag_circulation = true;
				}

				$flag_okr = false;
				if ($okrid > 0) {
					if ($okr['id'] == $okrid || $okr['okr_superior'] == $okrid) {
						$flag_okr = true;
					}
				} else {
					$flag_okr = true;
				}

				$flag_staff = false;
				if ($staff > 0) {
					if ($okr['person_assigned'] == $staff) {
						$flag_staff = true;
					}
				} else {
					$flag_staff = true;
				}

				$flag_type = false;
				if ($type > 0) {
					if ($okr['type'] == $type) {
						$flag_type = true;
					}
				} else {
					$flag_type = true;
				}

				$flag_category = false;
				if ($category > 0) {
					if ($okr['category'] == $category) {
						$flag_category = true;
					}
				} else {
					$flag_category = true;
				}

				$flag_department = false;
				if ($department > 0) {
					if ($okr['department'] == $department) {
						$flag_department = true;
					}
				} else {
					$flag_department = true;
				}

				$flag_access = false;
				if (is_admin() || $okr['person_assigned'] == get_staff_user_id() || $view_global == true) {
					$flag_access = true;
				}
				if (in_array($okr['department'], $arr_staff_dept)) {
					$flag_access = true;
				}
				if ($okr['type'] == 3 && $okr['display'] == 1) {
					$flag_access = true;
				}

				if ($okr['type'] == 1 && $okr['display'] == 1) {
					$depts = $this->departments_model->get_staff_departments($okr['person_assigned'], true);
					for ($i = 0; $i < count($arr_staff_dept); $i++) {
						if (in_array($arr_staff_dept[$i], $depts)) {
							$flag_access = true;
							break;
						}
					}
				}

				$child_node = [];
				if ($flag_circulation && $flag_okr && $flag_staff && $flag_type && $flag_category && $flag_department && $flag_access) {
					$child_node['flag'] = true;
				} else {
					$child_node['flag'] = false;
				}
				$child_node['okr'] = $okr;
				$child_node['children'] = [];
				$node['children'][$okr['id']] = $child_node;
				if ($child_node['flag']) {
					if ($render_type == 'okr') {
						$html[] = $this->create_okr_html($okr, $arr_dept, $arr_cat, $arr_cir);
					} else {
						$html[] = $this->create_checkin_html($okr, $arr_dept, $arr_cat, $arr_cir);
					}

				}
				$this->get_tree_okrs($html, $node['children'][$okr['id']], $okr['id'], $circulation, $okrid, $staff, $type, $category, $department, $view_global, $arr_cir, $arr_staff_dept, $arr_dept, $arr_cat, $render_type);
			}
		}
	}

	/**
	 * create okr html
	 * @param  string $html
	 * @param  object $node
	 * @return string
	 */
	public function create_okr_html($node, $arr_dept, $arr_cat, $arr_cir) {
		$html = '';
		$key_results = $this->count_key_results($node['id']);
		$progress = $node['progress'];
		if (is_null($progress)) {
			$progress = 0;
		}
		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id() || is_admin()) {
			$display = '';
		}
		$staff_name = get_staff_full_name($node['person_assigned']);
		$full_name =
		'<div class="pull-right">' . staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . $staff_name . '</a></div>';

		$rattings = '
        <div class="progress no-margin progress-bar-mini cus_tran">
        <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
        </div>
        </div>
        ' . $progress . '%
        </div>
        ';

		$category = '';
		if ($node['category'] > 0 && isset($arr_cat[$node['category']])) {
			$category = $arr_cat[$node['category']]['category'];
		}
		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$department = '';
		if ($node['department'] > 0 && isset($arr_dept[$node['department']])) {
			$department = $arr_dept[$node['department']]['name'];
		}

		$circulation = '';
		if ($node['circulation'] > 0 && isset($arr_cir[$node['circulation']])) {
			$circulation = $arr_cir[$node['circulation']]['name_circulation'];
		}

		if ($node['status'] == 0) {
			$status = '<span class="label label-warning s-status ">' . _l('unfinished') . '</span>';
		} else {
			$status = '<span class="label label-success s-status ">' . _l('finish') . '</span>';
		}

		$option = '';
		$option .= '<a href="' . admin_url('okr/show_detail_node/' . $node['id']) . '" class="btn btn-default btn-icon">';
		$option .= '<i class="fa fa-eye"></i>';
		$option .= '</a>';
		if ($node['status'] != 1) {
			if ((has_permission('okr', '', 'edit') && $node['type'] == 1) || (has_permission('okr', '', 'edit_department') && $node['type'] == 2) || (has_permission('okr', '', 'edit_company') && $node['type'] == 3) || is_admin()) {
				$option .= '<a href="' . admin_url('okr/new_object_main/' . $node['id']) . '" class="btn btn-default btn-icon">';
				$option .= '<i class="fa fa-edit"></i>';
				$option .= '</a>';
			}
		}
		if ((has_permission('okr', '', 'delete') && $node['type'] == 1) || (has_permission('okr', '', 'delete_department') && $node['type'] == 2) || (has_permission('okr', '', 'delete_company') && $node['type'] == 3) || is_admin()) {
			$option .= '<a href="' . admin_url('okr/delete_okrs/' . $node['id']) . '" class="btn btn-danger btn-icon _delete">';
			$option .= '<i class="fa fa-remove"></i>';
			$option .= '</a>';
		}
		$row[] = $option;
		$profile_html = '';
		$pic = get_option('invoice_company_name');
		if ($node['type'] == 1) {
			$profile_html = '<div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '<span class="your-target-content">' . $node['your_target'] . '</span></div>';
			$pic = $staff_name;
		} else if ($node['type'] == 2) {
			$profile_html = '<div class= "okr__"><i class="fa fa-group" style="font-size: 25px;color:#CFD6E5;"></i><span class="your-target-content">' . $node['your_target'] . '</span></div>';
			$pic = $department;
		} else {
			$profile_html = '<div class= "okr__"><i class="fa fa-sitemap" style="font-size: 25px;color:#CFD6E5;"></i><span class="your-target-content">' . $node['your_target'] . '</span></div>';
		}

		if ($node['okr_superior'] == '') {
			$html .=
			'<tr class="treegrid-' . $node['id'] . ' expanded ' . $display . '" >
            <td class="text-left vertical-align-middle">' . $profile_html . '</td>
            <td class="vertical-align-middle">' . $circulation . '</td>
            <td class="vertical-align-middle"><div class="box effect8 label-info" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
            <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
            </div>
            </td>' .
				'<td class="vertical-align-middle">' . $rattings . '  </td>
            <td class="vertical-align-middle">' . $category . '  </td>
            <td class="vertical-align-middle">' . $type . '  </td>
            <td class="vertical-align-middle">' . $pic . '  </td>
            <td class="vertical-align-middle">' . $status . '</td>';
			$html .= '<td>' . $option . '</td>';
			$html .= '</tr>';
		} else {
			$html .= '
            <tr class="treegrid-' . $node['id'] . ' treegrid-parent-' . $node['okr_superior'] . ' ' . $display . '" >
            <td class="text-left vertical-align-middle">' . $profile_html . '</td>
            <td class="vertical-align-middle">' . $circulation . '</td>
            <td class="vertical-align-middle"><div class="box effect8 label-info" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
            <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
            </div>
            </td>' .
				'<td class="vertical-align-middle">' . $rattings . '</td>
            <td class="vertical-align-middle">' . $category . '  </td>
            <td class="vertical-align-middle">' . $type . '  </td>
            <td class="vertical-align-middle">' . $pic . '  </td>
            <td class="vertical-align-middle">' . $status . '</td>';
			$html .= '<td>' . $option . '</td>';
			$html .= '</tr>';
		}
		return $html;
	}

	/**
	 * create checkin html
	 * @param  object $node
	 * @param  array $arr_dept
	 * @param  array $arr_cat
	 * @param  array $arr_cir
	 * @return string
	 */
	public function create_checkin_html($node, $arr_dept, $arr_cat, $arr_cir) {
		$html = '';
		$progress = $node['progress'];
		if (is_null($progress)) {
			$progress = 0;
		}
		$display = '';
		if ($node['display'] == 2) {
			$display = 'hide';
		}
		if ($node['person_assigned'] == get_staff_user_id() || is_admin()) {
			$display = '';
		}
		//get permission people apply
		$staff_apply = [];
		switch ($node['type']) {
		case '1':
			$staff_apply[] = $node['person_assigned'];
			break;
		case '2':
			$staffs_by_department = okrs_get_all_staff_by_department($node['department']);
			if (count($staffs_by_department) > 0) {
				foreach ($staffs_by_department as $key => $staffid) {
					if ($staffid['staffid'] == get_staff_user_id() && has_permission('okr_checkin', '', 'edit_department')) {
						array_push($staff_apply, $staffid['staffid']);
					}

				}
			}
			break;
		case '3':
			if (has_permission('okr_checkin', '', 'edit_company')) {
				$staff_apply[] = get_staff_user_id();
			}
			break;
		}

		$checkin_html_status = '';
		$confidence_level = $node['confidence_level'];
		$upcoming_checkin = $node['upcoming_checkin'];
		$type = $node['type'];

		$key_results = $this->count_key_results($node['id']);
		//$role = get_role_name_staff($node['person_assigned']);
		$category = '';
		if ($node['category'] > 0 && isset($arr_cat[$node['category']])) {
			$category = $arr_cat[$node['category']]['category'];
		}
		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$department = '';
		if ($node['department'] > 0 && isset($arr_dept[$node['department']])) {
			$department = $arr_dept[$node['department']]['name'];
		}

		$circulation = '';
		if ($node['circulation'] > 0 && isset($arr_cir[$node['circulation']])) {
			$circulation = $arr_cir[$node['circulation']]['name_circulation'];
		}

		$type = $node['type'] != '' ? ($node['type'] == 1 ? _l('personal') : ($node['type'] == 2 ? _l('department') : _l('company'))) : '';

		$staff_name = get_staff_full_name($node['person_assigned']);
		$full_name =
		'<div class="pull-right">' . staff_profile_image($node['person_assigned'], ['img img-responsive staff-profile-image-small pull-left']) . ' <a href="#" class="pull-left name_class">' . get_staff_full_name($node['person_assigned']) . '</a> </div>';

		$rattings = '
    <div class="progress no-margin progress-bar-mini cus_tran">
    <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100" style="' . $progress . '%;" data-percent="' . $progress . '">
    </div>
    </div>
    ' . $progress . '%
    </div>
    ';
		switch ($confidence_level) {
		case 1:
			$confidence_level_html = '
        <div class="default is_fine">
        <label>
        <input type="radio" checked><span> ' . _l('is_fine') . '</span>
        </label>
        </div>
        ';
			break;
		case 2:
			$confidence_level_html = '
        <div class="default not_so_good">
        <label>
        <input type="radio" checked><span> ' . _l('not_so_good') . '</span>
        </label>

        </div>
        ';
			break;
		default:
			$confidence_level_html = '
        <div class="default">
        <div class="very_good">
        <label>
        <input type="radio"  checked><span> ' . _l('very_good') . '</span>
        </label>
        </div>
        </div>
        ';
			break;
		}
		$today = date("Y-m-d");

		$text_checkin = '
    <button class="checkin_button1 select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    ' . _l('checkin') . '
    </button>';
		if (!has_permission('okr_checkin', '', 'view_own') || !in_array(get_staff_user_id(), $staff_apply)) {
			$text_checkin = '
        <button class="checkin_button select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
        <i class="fa fa-eye" aria-hidden="true"></i>
        ' . _l('view') . '
        </button>';
			$text_checkin = '';
		}

		if (is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
			$text_checkin = '
        <button class="checkin_button2 select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        ' . _l('checkin') . '
        </button>';
		}

		$this->db->where('rel_id', $node['id']);
		$this->db->where('rel_type', 'checkin');
		$this->db->where('approve IS NULL');
		$this->db->where('staffid', get_staff_user_id());
		$okr_approval_detail = $this->db->get('okr_approval_details')->row();
		
		$text_approval = '';
		if($okr_approval_detail ){

			$text_approval = '
	        <button class="btn btn-info select-option" data-node="' . $node['id'] . '" data-name="' . $node['your_target'] . '" data-change="' . $key_results->count . '" data-progress="' . $node['progress'] . '">
	        <i class="fa fa-check" aria-hidden="true"></i>
	        ' . _l('okr_go_to_approval') . '
	        </button>';
		}

		//view approve check-in
		if ($node['approval_status'] == 1 || $node['approval_status'] == 0) {
			if (strtotime($today ?? '') > strtotime($upcoming_checkin ?? '')) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today ?? '') < strtotime($upcoming_checkin ?? '')) && $node['type'] == 2) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today ?? '') < strtotime($upcoming_checkin ?? '')) && $node['type'] == 1) {
				$checkin_html_status = $text_checkin;
			} else if ((strtotime($today ?? '') == strtotime($upcoming_checkin ?? '')) && $node['type'] == 1) {
				$checkin_html_status = $text_checkin;
			}
			if ($this->okr_model->get_okrs($node['id'])->status == 1) {
				$checkin_html_status = '';
			}
		} else {
			$checkin_html_status = '';
		}
		$approval_status =
		$node['approval_status'] == 0 ? '' :
		($node['approval_status'] == 1 ? '<span class="label label-success">' . _l('approved') . '</span>' :
			($node['approval_status'] == 2 ? '<span class="label label-danger">' . _l('rejected') . '</span>' :
				'<span class="label label-primary">' . _l('processing') . '</span>'
			)

		);
		$option = '';
		if ((has_permission('okr', '', 'edit') && $node['type'] == 1) || (has_permission('okr', '', 'edit_department') && $node['type'] == 2) || (has_permission('okr', '', 'edit_company') && $node['type'] == 3) || is_admin()) {
			$option .= '<a href="' . admin_url('okr/new_object_main/' . $node['id']) . '" class="btn btn-default btn-icon">';
			$option .= '<i class="fa fa-edit"></i>';
			$option .= '</a>';
		}

		$row[] = $option;
		$profile_html = '';
		$pic = get_option('invoice_company_name');
		if ($node['type'] == 1) {
			$profile_html = '<div class="okr__">' . staff_profile_image($node['person_assigned'], ['img staff-profile-image-small ']) . '<span class="your-target-content">' . $node['your_target'] . '</span></div>';
			$pic = $staff_name;
		} else if ($node['type'] == 2) {
			$profile_html = '<div class= "okr__"><i class="fa fa-group" style="font-size: 25px;color:#CFD6E5;"></i><span class="your-target-content">' . $node['your_target'] . '</span></div>';
			$pic = $department;
		} else {
			$profile_html = '<div class= "okr__"><i class="fa fa-sitemap" style="font-size: 25px;color:#CFD6E5;"></i><span class="your-target-content">' . $node['your_target'] . '</span></div>';
		}
		if ($node['okr_superior'] == '') {
			$html .=
			'<tr class="treegrid-' . $node['id'] . ' expanded ' . $display . '" >
        <td class="text-left vertical-align-middle">' . $profile_html . '</td>
        <td class="vertical-align-middle">' . $circulation . '</td>
        <td class="vertical-align-middle"><div class="box effect8 label-info" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
        <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
        </div>
        </td>
        <td class="vertical-align-middle">' . $rattings . '</td>' .
				'<td>' . $confidence_level_html . '</td>
        <td class="vertical-align-middle">' . $category . '  </td>
        <td class="vertical-align-middle">' . $type . '  </td>
        <td class="vertical-align-middle">' . $pic . '  </td>';
			//view permission checkin
			if (!has_permission('okr_checkin', '', 'view_own') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
				if($text_approval != ''){
					$html .= '<td>' . $text_approval . '</td>';
				}else{
					$html .= '<td>' . $checkin_html_status . '</td>';
				}
			} else {
				//$html .= '<td></td>';
				if($text_approval != ''){
					$html .= '<td>' . $text_approval . '</td>';
				}else{
					$html .= '<td>' . $checkin_html_status . '</td>';
				}
			}
			$html .= '<td class="vertical-align-middle">' . $node['recently_checkin'] . '</td>
        <td class="vertical-align-middle">' . $node['upcoming_checkin'] . '</td>
        <td class="vertical-align-middle">' . $approval_status . '</td>
        </tr>';
		} else {
			$html .= '
        <tr class="treegrid-' . $node['id'] . ' treegrid-parent-' . $node['okr_superior'] . ' ' . $display . '" >
        <td class="text-left vertical-align-middle">' . $profile_html . '</td>
        <td class="vertical-align-middle">' . $circulation . '</td>
        <td class="vertical-align-middle"><div class="box effect8 label-info" data-okr="' . $node['id'] . '" data-toggle="popover" title="' . _l('objective') . '" data-content="">
        <span>' . $key_results->count . ' ' . _l('key_results') . '</span>
        </div>
        </td>
        <td class="vertical-align-middle">' . $rattings . '</td>' .
				'<td>' . $confidence_level_html . '</td>
        <td class="vertical-align-middle">' . $category . '  </td>
        <td class="vertical-align-middle">' . $type . '  </td>
        <td class="vertical-align-middle">' . $pic . '  </td>';
			//view permission checkin
			if (!has_permission('okr_checkin', '', 'view_own') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) {
				if($text_approval != ''){
					$html .= '<td>' . $text_approval . '</td>';
				}else{
					$html .= '<td>' . $checkin_html_status . '</td>';
				}
			} else {
				if($text_approval != ''){
					$html .= '<td>' . $text_approval . '</td>';
				}else{
					$html .= '<td></td>';
				}
			}

			$html .= '<td class="vertical-align-middle">' . $node['recently_checkin'] . '</td>
        <td class="vertical-align-middle">' . $node['upcoming_checkin'] . '</td>
        <td class="vertical-align-middle">' . $approval_status . '</td>
        </tr>';
		}
		return $html;
	}

	/**
	 * update old okrs
	 */
	public function update_old_okrs() {
		$this->db->where('okr_superior > 0 AND parent_key_result = 0');
		$old_okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		if (count($old_okrs) > 0) {
			foreach ($old_okrs as $okr) {
				$this->db->where('okrs_id', $okr['okr_superior']);
				$key_results = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
				if (count($key_results) > 0) {
					$data = [];
					$data['parent_key_result'] = $key_results[0]['id'];
					$this->db->where('id', $okr['id']);
					$this->db->update(db_prefix() . 'okrs', $data);
				}
			}
		}
	}

	/**
	 * update progress tree
	 * @param  int $okr_id
	 * @return
	 */
	public function update_progress_tree($okr_id) {
		$this->db->where('id', $okr_id);
		$okr = $this->db->get(db_prefix() . 'okrs')->row();
		if ($okr && $okr->parent_key_result > 0) {
			$okr_progress = $okr->progress;
			if (is_null($okr_progress)) {
				$okr_progress = 0;
			}
			$this->db->where('parent_key_result', $okr->parent_key_result);
			$related_okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
			$count_kr = 1;
			$total_percent = $okr_progress;
			foreach ($related_okrs as $rokr) {
				if ($rokr['id'] != $okr->id) {
					$count_kr++;
					$total_percent += is_null($rokr['progress']) ? 0 : $rokr['progress'];
				}
			}
			$avg_percent = $total_percent / $count_kr;
			$this->db->where('id', $okr->parent_key_result);
			$this->db->update(db_prefix() . 'okrs_key_result', ['progress' => $avg_percent]);
			$this->db->where('okrs_id', $okr->okr_superior);
			$parent_key_results = $this->db->get(db_prefix() . 'okrs_key_result')->result_array();
			$total_percent_kr = 0;
			$count_kr = 0;
			$avg_percent_kr = 0;
			foreach ($parent_key_results as $pkr) {
				$count_kr++;
				$total_percent_kr += is_null($pkr['progress']) ? 0 : $pkr['progress'];
			}
			if ($count_kr > 0) {
				$avg_percent_kr = $total_percent_kr / $count_kr;
				$this->db->where('id', $okr->okr_superior);
				$this->db->update(db_prefix() . 'okrs', ['progress' => $avg_percent_kr]);
				$this->update_progress_tree($okr->okr_superior);
			}
		}
		return;
	}

	/**
	 * get list okrs
	 * @param  int $okr_id
	 * @param  int $except_okr
	 * @return array
	 */
	public function get_list_okrs($okr_id = '', $except_okr = '') {
		$this->db->select(db_prefix() . "okrs.id," . db_prefix() . "okrs.your_target," . db_prefix() . "departments.name as department_name,concat(" . db_prefix() . "staff.firstname,' '," . db_prefix() . "staff.lastname) as staff_name," . db_prefix() . "okrs.type");
		$this->db->join(db_prefix() . 'departments', db_prefix() . 'departments.departmentid = ' . db_prefix() . 'okrs.department', 'left');
		$this->db->join(db_prefix() . 'staff', db_prefix() . 'staff.staffid = ' . db_prefix() . 'okrs.person_assigned', 'left');
		if ($okr_id > 0) {
			$this->db->where(db_prefix() . 'okrs.id', $okr_id);
		}
		if ($except_okr > 0) {
			$this->db->where(db_prefix() . 'okrs.id <> ' . $okr_id);
		}
		$company_name = get_option('invoice_company_name');
		$array_okrs = $this->db->get(db_prefix() . 'okrs')->result_array();
		if ($array_okrs) {
			for ($i = 0; $i < count($array_okrs); $i++) {
				$name = $company_name;
				if ($array_okrs[$i]['type'] == 1) {
					$name = $array_okrs[$i]['staff_name'];
				} else if ($array_okrs[$i]['type'] == 2) {
					$name = $array_okrs[$i]['department_name'];
				}
				$array_okrs[$i]['sub_name'] = $name;
			}
		}
		return $array_okrs;
	}

	/**
	 * get_dashboard_objectives
	 * @param  string $type
	 * @param  string $scope
	 * @return json
	 */
	public function get_dashboard_objectives($type, $scope) {
		$from_date = date('Y-m-d');
		$to_date = date('Y-m-d');
		$scope_value = $this->get_okr_scope($scope);
		$this->get_from_to_date($type, $from_date, $to_date);
		$sql_where = " JOIN " . db_prefix() . "okr_setting_circulation ON " . db_prefix() . "okrs.circulation = " . db_prefix() . "okr_setting_circulation.id
			WHERE ((" . db_prefix() . "okr_setting_circulation.from_date >= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.from_date <= '" . $to_date . "')
				OR (" . db_prefix() . "okr_setting_circulation.to_date >= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.to_date <= '" . $to_date . "')
				OR (" . db_prefix() . "okr_setting_circulation.from_date <= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . $to_date . "'))
			AND " . db_prefix() . "okrs.type = " . $scope_value;
		if ($scope == 'personal') {
			$staff_id = get_staff_user_id();
			$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.person_assigned = ' . $staff_id;
		} else if ($scope == 'department') {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.department IN ' . $dept;
			}
		}
		$count_not_start = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs" . $sql_where . " AND " . db_prefix() . "okrs.recently_checkin is NULL AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . date('Y-m-d') . "'
		")->row()->qty;
		$count_progress = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs" . $sql_where . " AND " . db_prefix() . "okrs.recently_checkin IS NOT NULL AND " . db_prefix() . "okrs.progress < 100 AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . date('Y-m-d') . "'
		")->row()->qty;
		$count_complete = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs" . $sql_where . " AND " . db_prefix() . "okrs.progress >= 100
		")->row()->qty;
		$count_overdue = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs" . $sql_where . " AND " . db_prefix() . "okrs.progress < 100 AND " . db_prefix() . "okr_setting_circulation.to_date < '" . date('Y-m-d') . "'
		")->row()->qty;

		$result = [];
		$result['total'] = $count_not_start + $count_progress + $count_complete + $count_overdue;

		$chart = [];
		array_push($chart, [
			'name' => _l('okr_not_started'),
			'color' => '#79806e',
			'y' => (int) $count_not_start,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_in_progress'),
			'color' => '#119efa',
			'y' => (int) $count_progress,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_complete'),
			'color' => '#61da5e',
			'y' => (int) $count_complete,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_overdue'),
			'color' => '#f2510e',
			'y' => (int) $count_overdue,
			'z' => 100,
		]);
		$result['chart'] = $chart;
		return $result;
	}

	/**
	 * get_from_to_date
	 * @param  string $type
	 * @param  string &$from_date
	 * @param  string &$to_date
	 * @return
	 */
	private function get_from_to_date($type, &$from_date, &$to_date) {
		if ($type == 'this_week') {
			$from_date = date('Y-m-d', strtotime('monday this week', time()));
			$to_date = date('Y-m-d', strtotime('sunday this week', time()));
		} else if ($type == 'last_week') {
			$cdate = strtotime('-7 days');
			$from_date = date('Y-m-d', strtotime('monday this week', $cdate));
			$to_date = date('Y-m-d', strtotime('sunday this week', $cdate));
		} else if ($type == 'this_month') {
			$from_date = date('Y') . '-' . date('m') . '-01';
			$to_date = date('Y-m-t', time());
		} else if ($type == 'last_month') {
			$from_date = date("Y-m-d", strtotime("first day of previous month"));
			$to_date = date("Y-m-d", strtotime("last day of previous month"));
		} else if ($type == 'this_quarter') {
			$current_quarter = ceil(date('n') / 3);
			$from_date = date('Y-m-d', strtotime(date('Y') . '-' . (($current_quarter * 3) - 2) . '-1'));
			$to_date = date('Y-m-t', strtotime(date('Y') . '-' . ($current_quarter * 3) . '-' . (date("t", strtotime(date('Y') . '-' . ($current_quarter * 3) . '-1')))));
		} else if ($type == 'last_quarter') {
			$current_quarter = ceil(date('n') / 3);
			$last_quarter = $current_quarter - 1;
			if ($last_quarter > 0) {
				$from_date = date('Y-m-d', strtotime(date('Y') . '-' . (($last_quarter * 3) - 2) . '-1'));
				$to_date = date('Y-m-t', strtotime(date('Y') . '-' . ($last_quarter * 3) . '-' . (date("t", strtotime(date('Y') . '-' . ($last_quarter * 3) . '-1')))));
			} else {
				$from_date = (date('Y') - 1) . '-10-01';
				$to_date = (date('Y') - 1) . '-12-31';
			}

		} else if ($type == 'this_year') {
			$from_date = date('Y') . '-01-01';
			$to_date = date('Y') . '-12-31';
		} else if ($type == 'last_year') {
			$from_date = (date('Y') - 1) . '-01-01';
			$to_date = (date('Y') - 1) . '-12-31';
		}
	}

	/**
	 * get_okr_scope
	 * @param  string $scope
	 * @return
	 */
	private function get_okr_scope($scope) {
		$scope_value = 1;
		if ($scope == 'company') {
			$scope_value = 3;
		} elseif ($scope == 'department') {
			$scope_value = 2;
		}
		return $scope_value;
	}

	/**
	 * get_dashboard_key_results
	 * @param  string $type
	 * @param  string $scope
	 * @return json
	 */
	public function get_dashboard_key_results($type, $scope) {
		$from_date = date('Y-m-d');
		$to_date = date('Y-m-d');
		$scope_value = $this->get_okr_scope($scope);
		$this->get_from_to_date($type, $from_date, $to_date);
		$sql_where = " JOIN " . db_prefix() . "okrs ON " . db_prefix() . "okrs.id = " . db_prefix() . "okrs_key_result.okrs_id";
		$sql_where .= " JOIN " . db_prefix() . "okr_setting_circulation ON " . db_prefix() . "okrs.circulation = " . db_prefix() . "okr_setting_circulation.id
			WHERE ((" . db_prefix() . "okr_setting_circulation.from_date >= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.from_date <= '" . $to_date . "')
				OR (" . db_prefix() . "okr_setting_circulation.to_date >= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.to_date <= '" . $to_date . "')
				OR (" . db_prefix() . "okr_setting_circulation.from_date <= '" . $from_date . "' AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . $to_date . "'))
			AND " . db_prefix() . "okrs.type = " . $scope_value;
		if ($scope == 'personal') {
			$staff_id = get_staff_user_id();
			$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.person_assigned = ' . $staff_id;
		} else if ($scope == 'department') {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.department IN ' . $dept;
			}
		}
		$count_not_start = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs_key_result" . $sql_where . " AND (" . db_prefix() . "okrs_key_result.progress is NULL OR " . db_prefix() . "okrs_key_result.progress = 0) AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . date('Y-m-d') . "'
		")->row()->qty;
		$count_progress = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs_key_result" . $sql_where . " AND " . db_prefix() . "okrs_key_result.progress IS NOT NULL AND " . db_prefix() . "okrs_key_result.progress < 100 AND " . db_prefix() . "okrs_key_result.progress > 0 AND " . db_prefix() . "okr_setting_circulation.to_date >= '" . date('Y-m-d') . "'
		")->row()->qty;
		$count_complete = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs_key_result" . $sql_where . " AND " . db_prefix() . "okrs_key_result.progress >= 100
		")->row()->qty;
		$count_overdue = $this->db->query("
			SELECT count(1) as qty
			FROM " . db_prefix() . "okrs_key_result" . $sql_where . " AND " . db_prefix() . "okrs_key_result.progress < 100 AND " . db_prefix() . "okr_setting_circulation.to_date < '" . date('Y-m-d') . "'
		")->row()->qty;

		$result = [];
		$result['total'] = $count_not_start + $count_progress + $count_complete + $count_overdue;

		$chart = [];
		array_push($chart, [
			'name' => _l('okr_not_started'),
			'color' => '#79806e',
			'y' => (int) $count_not_start,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_in_progress'),
			'color' => '#119efa',
			'y' => (int) $count_progress,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_complete'),
			'color' => '#61da5e',
			'y' => (int) $count_complete,
			'z' => 100,
		]);
		array_push($chart, [
			'name' => _l('okr_overdue'),
			'color' => '#f2510e',
			'y' => (int) $count_overdue,
			'z' => 100,
		]);
		$result['chart'] = $chart;
		return $result;
	}

	/**
	 * get_dashboard_checkin
	 * @param  string $type
	 * @param  string $scope
	 * @return json
	 */
	public function get_dashboard_checkin($type, $scope) {
		$from_date = date('Y-m-d');
		$to_date = date('Y-m-d');
		$scope_value = $this->get_okr_scope($scope);
		$this->get_from_to_date($type, $from_date, $to_date);
		$sql_where = "";
		if ($scope == 'personal') {
			$staff_id = get_staff_user_id();
			$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.person_assigned = ' . $staff_id;
		} else if ($scope == 'department') {
			$this->load->model('departments_model');
			$list_dept = $this->departments_model->get_staff_departments(false, true);
			$dept = '(';
			for ($i = 0; $i < count($list_dept) - 1; $i++) {
				$dept .= $list_dept[$i] . ',';
			}
			if (count($list_dept) > 0) {
				$dept .= $list_dept[count($list_dept) - 1] . ')';
				$sql_where = $sql_where . ' AND ' . db_prefix() . 'okrs.department IN ' . $dept;
			}
		}
		$count_normal = 0;
		$count_poor = 0;
		$count_excellent = 0;
		$confidence_level_status = $this->db->query("
			SELECT " . db_prefix() . "okrs_checkin.confidence_level, count(1) as qty
			FROM " . db_prefix() . "okrs_checkin
			JOIN " . db_prefix() . "okrs ON " . db_prefix() . "okrs_checkin.okrs_id = " . db_prefix() . "okrs.id
			WHERE " . db_prefix() . "okrs_checkin.recently_checkin >= '" . $from_date . "' AND " . db_prefix() . "okrs_checkin.recently_checkin <= '" . $to_date . "'
			AND " . db_prefix() . "okrs.type = " . $scope_value . $sql_where . "
			GROUP BY " . db_prefix() . "okrs_checkin.confidence_level
			")->result_array();
		$total = 0;
		foreach ($confidence_level_status as $cls) {
			if ($cls['confidence_level'] == 1) {
				$count_normal = $cls['qty'];
			} else if ($cls['confidence_level'] == 2) {
				$count_poor = $cls['qty'];
			} else if ($cls['confidence_level'] == 3) {
				$count_excellent = $cls['qty'];
			}
			$total += $cls['qty'];
		}
		if ($total == 0) {
			$total = 1;
		}
		$chart = [];
		array_push($chart, [
			'name' => _l('is_fine'),
			'color' => '#03a9f4',
			'y' => $count_normal / $total * 100,
		]);
		array_push($chart, [
			'name' => _l('not_so_good'),
			'color' => '#FF0100',
			'y' => $count_poor / $total * 100,
		]);
		array_push($chart, [
			'name' => _l('very_good'),
			'color' => '#14F34E',
			'y' => $count_excellent / $total * 100,
		]);
		return json_encode($chart);
	}

	/**
	 * Gets the search okrs.
	 *
	 * @param        $q      The quarter
	 */
	public function get_search_okrs($q){
		$where = '1=1 AND (name LIKE "%'.$this->db->escape_like_str($q).'%" OR your_target LIKE "%'.$this->db->escape_like_str($q).'%")';
		return $this->db->query('SELECT * FROM '.db_prefix().'okrs WHERE '.$where)->result_array();
	}

	/**
	 * get key result
	 * @param  integer $okrs
	 * @return array
	 */
	public function get_detailed_key_result_search($q) {
		$this->db->where('1=1 AND (main_results LIKE "%'.$this->db->escape_like_str($q).'%")');
		return $this->db->get(db_prefix() . 'okrs_key_result')->result_array();

	}
}