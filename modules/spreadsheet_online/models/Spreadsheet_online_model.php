<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Spreadsheet online model
 */
class Spreadsheet_online_model extends App_Model {
	/**
	 * tree my folder
	 * @return html
	 */
	public function tree_my_folder() {
		$data = $this->get_my_folder_by_staff_my_folder();
		$tree = "<tbody>";
		foreach ($data as $data_key => $data_val) {
			if ($data_val['parent_id'] == 0) {
				$tree .= $this->dq_tree_my_folder($data_val);
			}
		}
		$tree .= "<tbody>";
		return $tree;
	}
	/**
	 * dq tree my folder
	 * @param  array $root
	 * @param  int $parent_id
	 * @return html
	 */
	public function dq_tree_my_folder($root, $parent_id = '') {

		$tree_tr = '';
		$class = "share-status";
		$html_change = '<i class="fa fa-group ' . $class . '"></i>';

		$this->db->where('parent_id', $root['id']);
		$online_related = $this->db->get(db_prefix() . 'spreadsheet_online_related')->result_array();

		$type = $root['type'] == 'folder' ? "folder" : "file";
		if ($root['id'] == $parent_id) {
			$this->db->where('id', $root['id']);
			$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
			$parent_id = '';
		}
		
		$status_share = '';
		if ($parent_id == '') {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-name="' . $root['name'] . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '  ' . $status_share . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			$tree_tr .= '<td>';
			$explode = $root['rel_type'] != null ? explode(',', $root['rel_type']) : [];

			foreach ($explode as $key => $value) {

				if ($value == '') {
					$tree_tr .= '';
				} else {
					$rel_data = get_relation_data($value, $online_related[$key]['rel_id']) ? get_relation_data($value, $online_related[$key]['rel_id']) : '';
					$rel_val = $rel_data ? get_relation_values($rel_data, $value) : ['name' => ''];
					$tree_tr .= '<a class="related-to-hanlde" data-relate-type="' . $value . '" data-relate-id="' . $online_related[$key]['rel_id'] . '" data-data-main="' . $rel_val['name'] . '">' . $value . ', </a>';
				}
			}

			$tree_tr .= '</td>';
		} else {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-name="' . $root['name'] . '" data-tt-parent-id="' . $parent_id . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '  ' . $status_share . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			$tree_tr .= '<td>';
			$explode = $root['rel_type'] != null ? explode(',', $root['rel_type']) : [];
			
			foreach ($explode as $key => $value) {
				if ($value == '') {
					$tree_tr .= '';
				} else {
					$rel_data = get_relation_data($value, $online_related[$key]['rel_id']) ? get_relation_data($value, $online_related[$key]['rel_id']) : '';
					$rel_val = $rel_data ? get_relation_values($rel_data, $value) : ['name' => ''];
					$tree_tr .= '<a class="related-to-hanlde" data-relate-type="' . $value . '" data-relate-id="' . $online_related[$key]['rel_id'] . '" data-data-main="' . $rel_val['name'] . '">' . $value . ', </a>';
				}
			}

			$tree_tr .= '</td>';
		}

		$data = $this->get_my_folder_by_parent_id($root['id']);
		foreach ($data as $data_key => $data_val) {
			if (($data_val['id'] == $data_val['parent_id'])) {
				$this->db->where('id', $data_val['id']);
				$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
				$data_val['parent_id'] = "";
			}
			$tree_tr .= $this->dq_tree_my_folder($data_val, $data_val['parent_id']);
		}
		return $tree_tr;
	}
	/**
	 * get my folder
	 * @param  int $id
	 * @return array
	 */
	public function get_my_folder($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();
		}
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * get my folder by staff my folder
	 * @return array
	 */
	public function get_my_folder_by_staff_my_folder() {
		$this->db->where('staffid', get_staff_user_id());
		$this->db->where('category', 'my_folder');
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * get my folder by parent id
	 * @param  int $parent_id
	 * @return  array
	 */
	public function get_my_folder_by_parent_id($parent_id) {
		$this->db->where('parent_id', $parent_id);
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * get my folder by staff share
	 * @return array
	 */
	public function get_my_folder_by_staff_share() {
		$this->db->where('staffid', get_staff_user_id());
		$this->db->where('category', 'share');
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * add folder
	 * @param  $data
	 */
	public function add_folder($data) {
		if (isset($data['id'])) {
			unset($data['id']);
		}
		if (isset($data['parent_id'])) {
			if ($data['parent_id'] == '') {
				$data['parent_id'] = 0;
			}
		}
		$data['staffid'] = get_staff_user_id();
		$data['size'] = "--";
		$data['type'] = "folder";
		$data['category'] = "my_folder";
		$this->db->insert(db_prefix() . 'spreadsheet_online_my_folder', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * edit folder
	 * @param  $data
	 * @return boolean
	 */
	public function edit_folder($data) {
		if (isset($data['parent_id'])) {
			if ($data['parent_id'] == '') {
				$data['parent_id'] = '';
			}
		}
		unset($data['parent_id']);
		$this->db->where('id', $data['id']);
		$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	/**
	 * add file sheet
	 * @param  $data
	 * @return int
	 */
	public function add_file_sheet($data) {


		if (isset($data['id'])) {
			unset($data['id']);
		}
		$data['staffid'] = get_staff_user_id();
		$data['size'] = "--";
		$data['type'] = "file";
		$data['category'] = "my_folder";
		// if (isset($data['image_flag'])) {
		// 	if ($data['image_flag'] == "true") {
		// 		$data['data_form'] = str_replace('[removed]', 'data:image/png;base64,', $data['data_form']);
		// 		$data['data_form'] = str_replace('imga$imga', '"', $data['data_form']);
		// 		$data['data_form'] = str_replace('""', '"', $data['data_form']);
		// 	}
		// }

		// $data_form = $data['data_form'];
		$data['data_form'] = '';
		unset($data['image_flag']);

		$this->db->insert(db_prefix() . 'spreadsheet_online_my_folder', $data);
		$insert_id = $this->db->insert_id();
		handle_spreadsheet_add_file($insert_id);
		$path = SPREAD_ONLINE_MODULE_UPLOAD_FOLDER . '/spreadsheet_online/' . $insert_id . '-' . $data['name'] . '.txt';
		$realpath_data = '/spreadsheet_online/' . $insert_id . '-' . $data['name'] . '.txt';
		// file_force_contents($path, $data_form);
		$this->db->where('id', $insert_id);
		$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['realpath_data' => $realpath_data]);
		return $insert_id;
	}
	/**
	 * get file sheet
	 * @param  string $id
	 * @return array
	 */
	public function get_file_sheet($id = "") {
		if ($id != "") {
			$this->db->where('id', $id);
			$this->db->where('type', "file");
			return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();
		}
		$this->db->where('type', "file");
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * edit file sheet
	 * @param array $data
	 * @return boolean
	 */
	public function edit_file_sheet($data) {
		// if (isset($data['image_flag']) && $data['image_flag'] == "true") {
		// 	$data['data_form'] = str_replace('[removed]', 'data:image/png;base64,', $data['data_form']);
		// 	$data['data_form'] = str_replace('imga$imga', '"', $data['data_form']);
		// 	$data['data_form'] = str_replace('""', '"', $data['data_form']);
		// }
		// $data_form = $data['data_form'];
		$data['data_form'] = '';
		unset($data['image_flag']);

		$this->db->select('name');
		$this->db->where('id', $data['id']);
		$data_old = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();

		$dir = SPREAD_ONLINE_MODULE_UPLOAD_FOLDER . '/spreadsheet_online/' . $data['id'] . '-' . $data_old->name . '.txt';
		if (file_exists($dir)) {
			unlink($dir);
		}

		handle_spreadsheet_add_file($data['id']);

		$path = SPREAD_ONLINE_MODULE_UPLOAD_FOLDER . '/spreadsheet_online/' . $data['id'] . '-' . $data['name'] . '.txt';
		$realpath_data = '/spreadsheet_online/' . $data['id'] . '-' . $data['name'] . '.txt';
		// file_force_contents($path, $data_form);
		$this->db->where('id', $data['id']);
		$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', [
			'name' => $data['name'],
			'parent_id' => $data['parent_id'],
			'data_form' => $data['data_form'],
			'realpath_data' => $realpath_data,
		]);

		return true;
	}
	/**
	 * delete folder file
	 * @param  int $id
	 * @return boolean
	 */
	public function delete_folder_file($id) {
		$this->db->select('name');
		$this->db->where('id', $id);
		$data = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();

		$dir = SPREAD_ONLINE_MODULE_UPLOAD_FOLDER . '/spreadsheet_online/' . $id . '-' . $data->name . '.txt';
		if (file_exists($dir)) {
			unlink($dir);
		}
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'spreadsheet_online_my_folder');

		if ($this->db->affected_rows() > 0) {
			$this->db->select('id');
			$this->db->where('parent_id', $id);
			$speadsheets = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
			if (count($speadsheets) > 0) {
				foreach ($speadsheets as $key => $value) {
					$this->db->select('name');
					$this->db->where('id', $value['id']);
					$data_child = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();
					$dir_child = SPREAD_ONLINE_MODULE_UPLOAD_FOLDER . '/spreadsheet_online/' . $value['id'] . '-' . $data_child->name . '.txt';

					if (file_exists($dir_child)) {
						unlink($dir_child);
					}

					$this->db->where('id', $value['id']);
					$this->db->delete(db_prefix() . 'spreadsheet_online_my_folder');

					$this->db->where('parent_id', $value['id']);
					$this->db->delete(db_prefix() . 'spreadsheet_online_related');

					$this->db->where('id_share', $value['id']);
					$hash_share = $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->result_array();

					foreach ($hash_share as $v) {
						$this->db->where('share_id', $v['id']);
						$this->db->delete(db_prefix() . 'spreadsheet_online_sharing_details');
					}

					$this->db->where('id_share', $value['id']);
					$this->db->delete(db_prefix() . 'spreadsheet_online_hash_share');

				}
			}
			//delete all table child
			$this->db->where('parent_id', $id);
			$this->db->delete(db_prefix() . 'spreadsheet_online_my_folder');

			$this->db->where('parent_id', $id);
			$this->db->delete(db_prefix() . 'spreadsheet_online_related');

			$this->db->where('id_share', $id);
			$hash_share = $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->result_array();

			foreach ($hash_share as $key => $value) {
				$this->db->where('share_id', $value['id']);
				$this->db->delete(db_prefix() . 'spreadsheet_online_sharing_details');
			}

			$this->db->where('id_share', $id);
			$this->db->delete(db_prefix() . 'spreadsheet_online_hash_share');

			
			return true;
		}
		return false;
	}
	/**
	 * get folder zip
	 * @param  string $id
	 * @param  string $name
	 * @return $data
	 */
	public function get_folder_zip($id = "", $name = "download") {
		if ($id != "") {
			$this->db->where('id', $id);
			$this->db->where('type', "folder");
			$data['main'] = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();
			$this->db->where('parent_id', $id);
			$data['child'] = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
			foreach ($data['child'] as $key => $child) {
				if ($child['type'] == "folder") {
					$this->db->where('id', $child['id']);
					$this->db->where('type', "folder");
					$data['child']['data_form_main']['main'] = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();

					$this->db->where('parent_id', $child['id']);
					$data['child']['data_form_main']['child'] = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
				}
			}
			return $data;
		}
		$this->db->where('type', "folder");
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}

	/* creates a compressed zip file */
	public function create_zip($files = array(), $destination = '', $overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if (file_exists($destination) && !$overwrite) {return false;}

		//vars
		$valid_files = array();
		//if files were passed in...
		if (is_array($files)) {
			//cycle through each file
			foreach ($files as $file) {
				//make sure the file exists
				if (file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}

		//if we have good files...
		if (count($valid_files)) {
			//create the archive
			$zip = new ZipArchive();
			if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			//add the files
			foreach ($valid_files as $file) {
				$zip->addFile($file, $file);
				echo "numfiles: " . $zip->numFiles . "\n";
				echo "status:" . $zip->status . "\n";
			}
			//debug

			//close the zip -- done!
			$zip->close();
			//check to make sure the file exists
			return file_exists($destination);
		} else {
			return false;
		}
	}
	/**
	 * get my folder all
	 * @return array
	 */
	public function get_my_folder_all() {
		$this->db->where('type', 'folder');
		$this->db->where('staffid', get_staff_user_id());
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * update share
	 * @param  $data
	 * @return  boolean
	 */
	public function update_share($data) {

		if (isset($data['check'])) {
			unset($data['check']);
		}

		if (!isset($data['is_read'])) {
			$data['is_read'] = 0;
		}

		if (!isset($data['is_write'])) {
			$data['is_write'] = 0;
		}

		if (isset($data['departments_share'])) {
			$departments_share = $data['departments_share'];
			unset($data['departments_share']);
		}

		if (isset($data['staffs_share'])) {
			$staffs_share = $data['staffs_share'];
			unset($data['staffs_share']);
		}

		if (isset($data['client_groups_share'])) {
			$client_groups_share = $data['client_groups_share'];
			unset($data['client_groups_share']);
		}

		if (isset($data['clients_share'])) {
			$clients_share = $data['clients_share'];
			unset($data['clients_share']);
		}


		$share_id = '';
		if (isset($data['share_id'])) {
			$share_id = $data['share_id'];
			unset($data['share_id']);
		}

		$file_id = '';
		if (isset($data['id'])) {
			$file_id = $data['id'];
			$data['id_share'] = $data['id'];
			unset($data['id']);
		}

		$data['hash'] = app_generate_hash();
		
		if($share_id == ''){
			$this->db->insert(db_prefix() . 'spreadsheet_online_hash_share', $data);

			$insert_id = $this->db->insert_id();

			if ($insert_id) {
				if (isset($departments_share) && $data['type'] == 'staff') {
					foreach ($departments_share as $key => $value) {
						$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
							'share_id' => $insert_id,
							'type' => 'department',
							'value' => $value,
						]);
					}
				}
				if (isset($staffs_share) && $data['type'] == 'staff') {
					foreach ($staffs_share as $key => $value) {
						$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
							'share_id' => $insert_id,
							'type' => 'staff',
							'value' => $value,
						]);
					}
				}

				if (isset($client_groups_share) && $data['type'] == 'client') {
					foreach ($client_groups_share as $key => $value) {
						$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
							'share_id' => $insert_id,
							'type' => 'customer_group',
							'value' => $value,
						]);
					}
				}
				if (isset($clients_share) && $data['type'] == 'client') {
					foreach ($clients_share as $key => $value) {
						$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
							'share_id' => $insert_id,
							'type' => 'customer',
							'value' => $value,
						]);
					}
				}
			}

			return true;
		}else{
			$this->db->where('id', $share_id);
			$this->db->update(db_prefix() . 'spreadsheet_online_hash_share', $data);

			$this->db->where('share_id', $share_id);
			$this->db->delete(db_prefix() . 'spreadsheet_online_sharing_details');

			if (isset($departments_share)) {
				foreach ($departments_share as $key => $value) {
					$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
						'share_id' => $share_id,
						'type' => 'department',
						'value' => $value,
					]);
				}
			}
			if (isset($staffs_share)) {
				foreach ($staffs_share as $key => $value) {
					$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
						'share_id' => $share_id,
						'type' => 'staff',
						'value' => $value,
					]);
				}
			}
			
			if (isset($client_groups_share)) {
				foreach ($client_groups_share as $key => $value) {
					$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
						'share_id' => $share_id,
						'type' => 'customer_group',
						'value' => $value,
					]);
				}
			}
			if (isset($clients_share)) {
				foreach ($clients_share as $key => $value) {
					$this->db->insert(db_prefix() . 'spreadsheet_online_sharing_details', [
						'share_id' => $share_id,
						'type' => 'customer',
						'value' => $value,
					]);
				}
			}

			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}

		return false;
	}
	/**
	 * exit object share
	 * @param  $share
	 * @param  $data
	 * @return  boolean
	 */
	public function exit_object_share($share, $data, $update) {
		if ($update == "true") {
			$this->db->where('id', $data['id']);
			$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['staffs_share' => '', 'departments_share' => '', 'clients_share' => '', 'client_groups_share' => '', 'group_share_staff' => '', 'group_share_client' => '']);
			$this->db->where('id_share', $data['id']);
			$this->db->delete(db_prefix() . 'spreadsheet_online_hash_share');
			$list_child = $this->get_my_folder_by_parent_id($data['id']);
			if (count($list_child) > 0) {
				foreach ($list_child as $key => $value) {
					$this->db->where('id_share', $value['id']);
					$this->db->delete(db_prefix() . 'spreadsheet_online_hash_share');
				}
			}
		}

		return true;
	}
	public function delete_hash_dq_child($id) {

	}

	/**
	 * add hash
	 * @param  $data
	 */
	public function add_hash($data) {
		$this->db->insert(db_prefix() . 'spreadsheet_online_hash_share', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	/**
	 * get_hash
	 * @param  $rel_type
	 * @param  $staffid
	 * @param  $share_id
	 * @return
	 */
	public function get_hash($rel_type, $staffid, $share_id) {
		if (is_client_logged_in()) {
			$this->db->where('customer_id', get_client_user_id());
			$groups = $this->db->get(db_prefix() . 'customer_groups')->result_array();
			$where_group = '';
			foreach ($groups as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_customer_group = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer_group")';

			$where_customer = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer")';

			$this->db->where('type = "client"');

			$this->db->where('IF(' . $where_customer_group . ' != "", ' . $where_group . ', 1=1)');
			$this->db->where('IF(' . $where_customer . ' != "", find_in_set(' . get_client_user_id() . ',' . $where_customer . '), 1=1)');

		} else {
			$this->db->where('staffid', get_staff_user_id());
			$staff = $this->db->get(db_prefix() . 'staff')->row();

			$this->db->where('staffid', get_staff_user_id());
			$staff_departments = $this->db->get(db_prefix() . 'staff_departments')->result_array();
			$where_group = '';
			foreach ($staff_departments as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_role = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "department")';

			$this->db->where('IF(' . $where_role . ' != "", ' . $where_group . ', 1=1)');

			$where_staff = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "staff")';

			$this->db->where('type = "staff"');
			$this->db->where('IF(' . $where_staff . ' != "", find_in_set(' . $staff->staffid . ',' . $where_staff . '), 1=1)');
		}

		$this->db->where('is_read', 1);
		$this->db->where('id_share', $share_id);
		$hash_share = $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->row();

		if($hash_share){
			return $hash_share;
		}

		$this->db->where('id', $share_id);
		$file = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();

		if (is_client_logged_in()) {
			$this->db->where('customer_id', get_client_user_id());
			$groups = $this->db->get(db_prefix() . 'customer_groups')->result_array();
			$where_group = '';
			foreach ($groups as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_customer_group = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer_group")';

			$where_customer = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer")';

			$this->db->where('type = "client"');

			$this->db->where('IF(' . $where_customer_group . ' != "", ' . $where_group . ', 1=1)');
			$this->db->where('IF(' . $where_customer . ' != "", find_in_set(' . get_client_user_id() . ',' . $where_customer . '), 1=1)');

		} else {
			$this->db->where('staffid', get_staff_user_id());
			$staff = $this->db->get(db_prefix() . 'staff')->row();

			$this->db->where('staffid', get_staff_user_id());
			$staff_departments = $this->db->get(db_prefix() . 'staff_departments')->result_array();
			$where_group = '';
			foreach ($staff_departments as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_role = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "department")';

			$this->db->where('IF(' . $where_role . ' != "", ' . $where_group . ', 1=1)');

			$where_staff = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "staff")';

			$this->db->where('type = "staff"');
			$this->db->where('IF(' . $where_staff . ' != "", find_in_set(' . $staff->staffid . ',' . $where_staff . '), 1=1)');
		}

		$this->db->where('is_read', 1);
		$this->db->where('id_share', $file->parent_id);
		return $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->row();
	}
	/**
	 * get hash all
	 * @return array
	 */
	public function get_hash_all() {
		return $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->result_array();
	}
	/**
	 * exit_hash
	 * @param  $peopel_id
	 * @param  $share_id
	 * @param  $rel_type
	 * @return boolean
	 */
	public function exit_hash($peopel_id, $share_id, $rel_type) {
		$hash = $this->get_hash_all();

		foreach ($hash as $key => $value) {
			if ($peopel_id == $value['rel_id'] && $share_id == $value['id_share'] && $rel_type == $value['rel_type']) {
				return false;
			}
		}
		return true;
	}
	/**
	 * tree my folder hash
	 * @param  $share
	 * @return boolean
	 */
	public function tree_my_folder_hash($share) {
		return $this->dq_tree_my_folder_hash($share);
	}
	/**
	 * dq tree my folder hash
	 * @param  $root
	 * @return boolean
	 */
	public function dq_tree_my_folder_hash($root) {
		if ($this->exit_hash($root['rel_id'], $root['id_share'], $root['rel_type'])) {
			$root['hash'] = app_generate_hash();
			$this->add_hash($root);
			$root_child = $this->get_my_folder_by_parent_id($root['id_share']);
			foreach ($root_child as $data_key => $data_val) {
				$data_hash['rel_type'] = $root['rel_type'];
				$data_hash['rel_id'] = $root['rel_id'];
				$data_hash['id_share'] = $data_val['id'];
				$data_hash['role'] = $root['role'];
				$this->dq_tree_my_folder_hash($data_hash);
			}
		}

		return true;

	}

	/**
	 * get my folder by staff my folder
	 * @return array
	 */
	public function get_my_folder_by_staff_share_folder($staffid) {


		$this->db->where('find_in_set(' . $staffid . ', staffs_share)');
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}
	/**
	 * tree my folder share
	 * @return html
	 */
	public function tree_my_folder_share() {
		$staffid = get_staff_user_id();
		$data = $this->get_file_share();
		$tree = "<tbody>";
		foreach ($data as $data_key => $data_val) {
			$tree .= $this->dq_tree_my_folder_share($data_val);
		}
		$tree .= "<tbody>";
		return $tree;
	}
	/**
	 * dq tree my folder share
	 * @param  array $root
	 * @param  int $parent_id
	 * @return html
	 */
	public function dq_tree_my_folder_share($root, $parent_id = '', $hash_parent = []) {
		$get_hash = $this->get_hash('staff', get_staff_user_id(), $root['id']);

		if(!$get_hash){
			$get_hash = $hash_parent;
		}

		$tree_tr = '';
		$type = $root['type'] == 'folder' ? "folder" : "file";
		if ($root['id'] == $parent_id) {
			$this->db->where('id', $root['id']);
			$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
			$parent_id = '';
		}

		if($get_hash->is_write == 1){
			$role = 2;
		}else{
			$role = 1;
		}

		


		if ($parent_id == '') {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-role="' . $role . '" data-tt-name="' . $root['name'] . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			// $tree_tr .= '<td>' . $root['size'] . '</td>';
		} else {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-role="' . $role . '" data-tt-name="' . $root['name'] . '" data-tt-parent-id="' . $parent_id . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			// $tree_tr .= '<td>' . $root['size'] . '</td>';
		}

		$data = $this->get_my_folder_by_parent_id($root['id']);
		foreach ($data as $data_key => $data_val) {
			if (($data_val['id'] == $data_val['parent_id'])) {
				$this->db->where('id', $data_val['id']);
				$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
				$data_val['parent_id'] = "";
			}
			$tree_tr .= $this->dq_tree_my_folder_share($data_val, $data_val['parent_id'], $get_hash);
		}
		return $tree_tr;
	}
	/**
	 * get share form hash
	 * @param  string $hash
	 * @return row
	 */
	public function get_share_form_hash($hash) {
		$this->db->where('hash', $hash);
		return $this->db->get(db_prefix() . 'spreadsheet_online_hash_share')->row();

	}

	/**
	 * get my folder by client my folder
	 * @return array
	 */
	public function get_my_folder_by_client_share_folder($clientid) {
		if ($clientid != null || $clientid != '') {
			$this->db->where('find_in_set(' . $clientid . ', clients_share)');
			return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
		}
		return [];
	}

	/**
	 * tree my folder share client
	 * @return html
	 */
	public function tree_my_folder_share_client() {
		
		$data = $this->get_file_share();

		$tree = "<tbody>";

		foreach ($data as $data_key => $data_val) {
			$tree .= $this->dq_tree_my_folder_share_client($data_val);
		}
		$tree .= "<tbody>";
		return $tree;
	}

	public function dq_tree_my_folder_share_client($root, $parent_id = '', $hash_parent = []) {
		$get_hash = $this->get_hash('client', get_client_user_id(), $root['id']);
		$get_hash_role = 0;
	
		if(!$get_hash){
			$get_hash = $hash_parent;
		}

		if($get_hash){
			if($get_hash->is_write == 1){
				$get_hash_role = 2;
			}else{
				$get_hash_role = 1;
			}
		}



		$tree_tr = '';
		$type = $root['type'] == 'folder' ? "folder" : "file";
		if ($root['id'] == $parent_id) {
			$this->db->where('id', $root['id']);
			$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
			$parent_id = '';
		}
		if ($parent_id == '') {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-role="' . $get_hash_role . '" data-tt-name="' . $root['name'] . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			//$tree_tr .= '<td>' . $root['size'] . '</td>';
		} else {
			$tree_tr .= '<tr class="right-menu-position" data-tt-id="' . $root['id'] . '" data-tt-role="' . $get_hash_role . '" data-tt-name="' . $root['name'] . '" data-tt-parent-id="' . $parent_id . '" data-tt-type="' . $type . '">';
			$tree_tr .= '
			<td>
			<span class="tr-pointer ' . $root['type'] . '">' . $root['name'] . '</span>
			</td>';
			$tree_tr .= '<td class="qcont">' . $root['type'] . '</td>';
			//$tree_tr .= '<td>' . $root['size'] . '</td>';
		}

		$data = $this->get_my_folder_by_parent_id($root['id']);
		foreach ($data as $data_key => $data_val) {
			if (($data_val['id'] == $data_val['parent_id'])) {
				$this->db->where('id', $data_val['id']);
				$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => ""]);
				$data_val['parent_id'] = "";
			}
			$tree_tr .= $this->dq_tree_my_folder_share_client($data_val, $data_val['parent_id'], $get_hash);
		}
		return $tree_tr;
	}

	/**
	 * update related
	 * @param  $data
	 * @return boolean
	 */
	public function update_related($data) {
		$data_rel_id = [];

		$rel_type = implode(',', $data['rel_type']);
		$data_rel_type = $data['rel_type'];
		if(isset($data['rel_id'])){
			$data_rel_id = $data['rel_id'];
			unset($data['rel_id']);
		}

		unset($data['rel_type']);

		$data['rel_type'] = $rel_type;

		$this->db->where('id', $data['id']);
		$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', $data);
		$this->db->where('parent_id', $data['id']);
		$this->db->delete(db_prefix() . 'spreadsheet_online_related');

		if (count($data_rel_id) > 0) {
			foreach ($data_rel_id as $keys => $values) {

				$data_s['parent_id'] = $data['id'];
				$data_s['rel_type'] = $data_rel_type[$keys];
				$data_s['rel_id'] = $values;
				$data_s['role'] = 1;
				$data_s['hash'] = app_generate_hash();
				$this->db->insert(db_prefix() . 'spreadsheet_online_related', $data_s);

				$this->db->select('id');
				$this->db->where('parent_id', $data['id']);
				$speadsheets = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();

				if (count($speadsheets) > 0) {
					foreach ($speadsheets as $key_speadsheets => $value_speadsheets) {
						$data_speadsheets['parent_id'] = $value_speadsheets['id'];
						$data_speadsheets['rel_type'] = $data_rel_type[$keys];
						$data_speadsheets['rel_id'] = $values;
						$data_speadsheets['role'] = 1;
						$data_speadsheets['hash'] = app_generate_hash();
						$this->db->insert(db_prefix() . 'spreadsheet_online_related', $data_speadsheets);
						$data_child = [];
						$data_child['rel_type'] = $data['rel_type'];
						$data_child['id'] = $value_speadsheets['id'];
						$this->db->where('id', $value_speadsheets['id']);
						$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', $data_child);
					}
				}

			}
		}
		return true;
	}

	public function get_share_detail($id) {
		$this->db->where('id', $id);
		$this->load->model('clients_model');
		$data = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->row();

		$staffs_share = explode(',', $data->staffs_share);
		$clients_share = explode(',', $data->clients_share);

		$rs['staffs_share'] = [];
		$rs['clients_share'] = [];
		$rs['clients_role'] = [];
		$rs['staffs_role'] = [];

		if (count($staffs_share) > 0) {
			foreach ($staffs_share as $key => $value) {
				if ($value != '') {
					array_push($rs['staffs_share'], get_staff_full_name($value));
					array_push($rs['staffs_role'], ($this->get_hash('staff', $value, $id) ? $this->get_hash('staff', $value, $id)->role : 'Not Role'));
				}
			}
		}

		if (count($clients_share) > 0) {
			foreach ($clients_share as $key => $value) {
				if ($value != '') {
					$name = $this->clients_model->get($value)->company;
					array_push($rs['clients_share'], $name);
					array_push($rs['clients_role'], ($this->get_hash('client', $value, $id) ? $this->get_hash('client', $value, $id)->role : 'Not Role'));
				}
			}
		}
		return $rs;

	}

	public function data_related_id($id) {
		$this->db->where('parent_id', $id);
		$data_main_type = [];
		$data_main_id = [];
		$data = $this->db->get(db_prefix() . 'spreadsheet_online_related')->result_array();
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				array_push($data_main_type, $value['rel_type']);
				array_push($data_main_id, $value['rel_id']);
			}
		}
		$data_s['type'] = $data_main_type;
		$data_s['id'] = $data_main_id;
		return $data_s;
	}
	/**

	 * tree my folder
	 * @return html
	 */
	public function tree_my_folder_related($rel_type, $rel_id) {
		$data = $this->get_my_folder_related($rel_type, $rel_id);
		$tree = "<tbody>";
		if (count($data) > 0) {
			foreach ($data as $data_key => $data_val) {
				$this->db->where('id', $data_val['parent_id']);
				$data_parent = $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
				$tree .= $this->dq_tree_my_folder($data_parent[0]);

			}
		}
		$tree .= "<tbody>";
		return $tree;
	}

	/**
	 * get my folder by staff my folder
	 * @return array
	 */
	public function get_my_folder_related($type, $id) {
		$query = 'select DISTINCT(parent_id) from ' . db_prefix() . 'spreadsheet_online_related where rel_type = "' . $type . '" and rel_id = "' . $id . '"';
		$data = $this->db->query($query)->result_array();
		if (count($data) > 0) {
			return $data;
		} else {
			return [];
		}
	}

	/**
	 * get my folder by client my folder
	 * @return array
	 */
	public function get_folder_type_tree() {
		$this->db->where('type', 'folder');
		$this->db->where('parent_id', '0');
		$this->db->where('staffid', get_staff_user_id());
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}

	/**
	 * get my folder by parent id and type folder
	 * @param  int $parent_id
	 * @return  array
	 */
	public function get_my_folder_by_parent_id_and_type_folder($parent_id) {
		$this->db->where('parent_id', $parent_id);
		$this->db->where('type', 'folder');
		return $this->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();
	}

	public function get_folder_tree() {
		$department = $this->get_folder_type_tree();
		$dep_tree = array();
		foreach ($department as $key => $dep) {
			$node = array();
			$node['id'] = $dep['id'];
			$node['title'] = $dep['name'];
			$node['subs'] = $this->get_child_node($dep['id'], $dep);
			$dep_tree[] = $node;
		}
		return $dep_tree;
	}

	/**
	 * Get child node of department tree
	 * @param  $id      current department id
	 * @param  $arr_dep department array
	 * @return current department tree
	 */
	private function get_child_node($id, $arr_dep) {
		$dep_tree = array();

		$arr = $this->db->query('select * from ' . db_prefix() . 'spreadsheet_online_my_folder where parent_id = ' . $id . ' and type = "folder"')->result_array();

		foreach ($arr as $dep) {
			if ($dep['parent_id'] == $id) {
				$node = array();
				$node['id'] = $dep['id'];
				$node['title'] = $dep['name'];
				$node['subs'] = $this->get_child_node($dep['id'], $dep);
				if (count($node['subs']) == 0) {
					unset($node['subs']);
				}
				$dep_tree[] = $node;
			}
		}
		return $dep_tree;
	}
	/**
	 * [droppable_event description]
	 * @param  [type] $id        [description]
	 * @param  [type] $parent_id [description]
	 * @return [type]            [description]
	 */
	public function droppable_event($id, $parent_id) {
		if($parent_id != $id){
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'spreadsheet_online_my_folder', ['parent_id' => $parent_id]);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
		return false;
	}

	/**
	 * get hash related
	 * @param  $rel_type
	 * @param  $related_to_id
	 * @param  $parent_id
	 * @return
	 */
	public function get_hash_related($rel_type, $related_to_id, $parent_id) {
		$this->db->where('rel_id', $related_to_id);
		$this->db->where('rel_type', $rel_type);
		$this->db->where('parent_id', $parent_id);
		return $this->db->get(db_prefix() . 'spreadsheet_online_related')->row();
	}

	/**
	 * get share form hash related
	 * @param  string $hash
	 * @return row
	 */
	public function get_share_form_hash_related($hash) {
		$this->db->where('hash', $hash);
		return $this->db->get(db_prefix() . 'spreadsheet_online_related')->row();
	}

	/**
	 * get my folder by client my folder view
	 * @return array
	 */
	public function get_my_folder_by_client_share_folder_view($clientid) {
		$this->db->where('type', 'customer');
		$this->db->where('value', $clientid);
		$data = $this->db->get(db_prefix() . 'spreadsheet_online_sharing_details')->result_array();
		if (count($data) > 0) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * [notifications description]
	 * @param  [type] $id_staff    [description]
	 * @param  [type] $link        [description]
	 * @param  [type] $description [description]
	 * @return [type]              [description]
	 */
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
	 * array_to_string_unique
	 * @param  array $array_values
	 * @return string
	 */
	private function array_to_string_unique($array_values) {
		$temp_array = [];
		$res_array = [];
		foreach ($array_values as $value) {
			if (!isset($temp_array[$value]) || $value == '') {
				if ($value != '') {
					$temp_array[$value] = $value;
				}
				$res_array[] = $value;
			}
		}
		return implode(',', $res_array);
	}

	/**
	 * delete sharing
	 * @param integer $id
	 * @return boolean
	 */

	public function delete_sharing($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'spreadsheet_online_hash_share');
		if ($this->db->affected_rows() > 0) {

			$this->db->where('share_id', $id);
			$this->db->delete(db_prefix() . 'spreadsheet_online_sharing_details');

			return true;
		}
		return false;
	}

	/**
	 * get file share
	 * @param  string $hash
	 * @return object
	 */
	public function get_file_share() {
		$CI = &get_instance();

		if (is_client_logged_in()) {
			$this->db->where('customer_id', get_client_user_id());
			$groups = $this->db->get(db_prefix() . 'customer_groups')->result_array();
			$where_group = '';
			foreach ($groups as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['groupid'] . ' and type = "customer_group" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_customer_group = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer_group")';

			$where_customer = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "customer")';

			$CI->db->where('type = "client"');

			$CI->db->where('IF(' . $where_customer_group . ' != "", ' . $where_group . ', 1=1)');
			$CI->db->where('IF(' . $where_customer . ' != "", find_in_set(' . get_client_user_id() . ',' . $where_customer . '), 1=1)');

		} else {
			$this->db->where('staffid', get_staff_user_id());
			$staff = $this->db->get(db_prefix() . 'staff')->row();

			$this->db->where('staffid', get_staff_user_id());
			$staff_departments = $this->db->get(db_prefix() . 'staff_departments')->result_array();
			$where_group = '';
			foreach ($staff_departments as $key => $value) {
				if ($where_group == '') {
					$where_group = '(select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				} else {
					$where_group .= ' OR (select GROUP_CONCAT(value SEPARATOR ",") from ' . db_prefix() . 'spreadsheet_online_sharing_details where value = ' . $value['departmentid'] . ' and type = "department" and share_id = ' . db_prefix() . 'spreadsheet_online_hash_share.id) != ""';
				}
			}

			if ($where_group != '') {
				$where_group = '(' . $where_group . ')';
			} else {
				$where_group = '1=0';
			}

			$where_role = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "department")';

			$CI->db->where('IF(' . $where_role . ' != "", ' . $where_group . ', 1=1)');

			$where_staff = '(SELECT GROUP_CONCAT(value SEPARATOR ",") FROM ' . db_prefix() . 'spreadsheet_online_sharing_details WHERE share_id=' . db_prefix() . 'spreadsheet_online_hash_share.id and ' . db_prefix() . 'spreadsheet_online_sharing_details.type = "staff")';

			$CI->db->where('type = "staff"');
			$CI->db->where('IF(' . $where_staff . ' != "", find_in_set(' . $staff->staffid . ',' . $where_staff . '), 1=1)');
		}

		$CI->db->where('is_read = 1');
		$file_share = $CI->db->get(db_prefix() . 'spreadsheet_online_hash_share')->result_array();

		$where_file_id = '0';
		$file_arr = [];
		foreach($file_share as $value){
			$where_file_id .= ','.$value['id_share'];
			$file_arr[] = $value['id_share'];
		}

		$CI->db->where('id in (' . $where_file_id . ')');

		$files = $CI->db->get(db_prefix() . 'spreadsheet_online_my_folder')->result_array();


		foreach($files as $key => $value){
			if($value['parent_id'] != 0 && in_array($value['parent_id'], $file_arr)){
				unset($files[$key]);
			}
		}

		return $files;
	}
}
