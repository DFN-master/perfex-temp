<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Loyalty model
 */
class Loyalty_model extends App_Model {

	/**
	 * Constructs a new instance.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * { loyalty setting }
	 *
	 * @param  $data   The data
	 */
	public function loyalty_setting($data){
		$result = false;

		$this->db->where('name','loyalty_setting');
		$this->db->update(db_prefix().'options', ['value' => $data['loyalty_setting']]);
		if ($this->db->affected_rows() > 0) {
            $result = true;
        }


        $this->db->where('name','loyalty_earn_points_from_redeemable_transactions');
		$this->db->update(db_prefix().'options', ['value' => $data['loyalty_earn_points_from_redeemable_transactions']]);
		if ($this->db->affected_rows() > 0) {
            $result = true;
        }


        $this->db->where('name','customers_ids_not_use_membership_tab');
		$this->db->update(db_prefix().'options', ['value' => $data['customers_ids_not_use_membership_tab']]);
		if ($this->db->affected_rows() > 0) {
            $result = true;
        }


        $this->db->where('name','customers_group_ids_not_use_membership_tab');
		$this->db->update(db_prefix().'options', ['value' => $data['customers_group_ids_not_use_membership_tab']]);
		if ($this->db->affected_rows() > 0) {
            $result = true;
        }


        return $result;
	}

	/**
	 * Adds a card.
	 *
	 * @param      <type>   $data   The data
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function add_card($data){
		$data['add_from'] = get_staff_user_id();
		$data['date_create'] = date('Y-m-d');

		if(isset($data['subject_card'])){
			$data['subject_card'] = 1;
		}else{
			$data['subject_card'] = 0;
		}

		if(isset($data['client_name'])){
			$data['client_name'] = 1;
		}else{
			$data['client_name'] = 0;
		}

		if(isset($data['membership'])){
			$data['membership'] = 1;
		}else{
			$data['membership'] = 0;
		}

		if(isset($data['company_name'])){
			$data['company_name'] = 1;
		}else{
			$data['company_name'] = 0;
		}

		if(isset($data['member_since'])){
			$data['member_since'] = 1;
		}else{
			$data['member_since'] = 0;
		}

		if(isset($data['custom_field'])){
			$data['custom_field'] = 1;
		}else{
			$data['custom_field'] = 0;
		}

		$this->db->insert(db_prefix().'loy_card',$data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) { 
			return $insert_id;
		}
		return false;
	}

	/**
	 * { update card }
	 *
	 * @param       $data   The data
	 * @param       $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function update_card($data,$id){
		$affectedRows = 0;

		if(isset($data['subject_card'])){
			$data['subject_card'] = 1;
		}else{
			$data['subject_card'] = 0;
		}

		if(isset($data['client_name'])){
			$data['client_name'] = 1;
		}else{
			$data['client_name'] = 0;
		}

		if(isset($data['membership'])){
			$data['membership'] = 1;
		}else{
			$data['membership'] = 0;
		}

		if(isset($data['company_name'])){
			$data['company_name'] = 1;
		}else{
			$data['company_name'] = 0;
		}

		if(isset($data['member_since'])){
			$data['member_since'] = 1;
		}else{
			$data['member_since'] = 0;
		}

		if(isset($data['custom_field'])){
			$data['custom_field'] = 1;
		}else{
			$data['custom_field'] = 0;
		}

		$this->db->where('id',$id);
		$this->db->update(db_prefix().'loy_card',$data);
		if ($this->db->affected_rows() > 0) {
			$affectedRows++;
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'card_picture');
		$avar = $this->db->get(db_prefix() . 'files')->row();
		

		if ($avar && (isset($_FILES['card_picture']['name']) && $_FILES['card_picture']['name'] != '')) {
			if (empty($avar->external)) {
				unlink(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete(db_prefix().'files');
			if ($this->db->affected_rows() > 0) {
				$affectedRows++;
			}

			if (is_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $avar->rel_id);
				}
			}
		}

		
		if ($affectedRows > 0) { 
			return true;
		}
		return false;
	}

	/**
	 * Gets the card.
	 *
	 * @param        $id     The identifier
	 *
	 * @return     The card.
	 */
	public function get_card($id){
		$this->db->where('id',$id);
		$card = $this->db->get(db_prefix().'loy_card')->row();

		$this->db->where('rel_id',$id);
		$this->db->where('rel_type','card_picture');
		$card->card_picture = $this->db->get(db_prefix().'files')->row();

		return $card;
	}

	/**
	 * Gets the list card.
	 *
	 * @return  The list card.
	 */
	public function get_list_card(){
		$cards = $this->db->get(db_prefix().'loy_card')->result_array();
		return $cards;
	}

	/**
	 * delete card
	 * @param  int $id
	 * @return bool
	 */
	public function delete_card($id) {
		
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'card_picture');
		$attachment = $this->db->get(db_prefix().'files')->row();
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix().'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id);
				}
			}
		}

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'loy_card');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}


	/**
	 * delete card picture
	 * @param  int $id
	 * @return bool    
	 */
	public function delete_card_picture($id) {
		$attachment = $this->get_card_picture('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete(db_prefix().'files');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(LOYALTY_MODULE_UPLOAD_FOLDER . '/card_picture/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * Gets the card picture.
	 *
	 * @param        $card   The card
	 * @param      string  $id     The identifier
	 *
	 * @return       The card picture.
	 */
	public function get_card_picture($card, $id = '') {
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $card);
		}
		$this->db->where('rel_type', 'loy_card');
		$result = $this->db->get(db_prefix().'files');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * Adds a loyalty rule.
	 *
	 * @param     $data   The data
	 */
	public function add_loyalty_rule($data){
		$data['add_from'] = get_staff_user_id();
		$data['date_create'] = date('Y-m-d');
		$data['minium_purchase'] = str_replace(',', '', $data['minium_purchase']);
		$data['purchase_value'] = str_replace(',', '', $data['purchase_value']);
		$data['start_date'] = to_sql_date($data['start_date']);
		$data['end_date'] = to_sql_date($data['end_date']);

		if(isset($data['client']) && count($data['client']) > 0){
			$data['client'] = implode(',', $data['client']);
		}else{
			$data['client'] = '';
		}

		if(isset($data['enable'])){
			$data['enable'] = 1;
		}else{
			$data['enable'] = 0;
		}

		if(isset($data['redeem_pos'])){
			$data['redeem_pos'] = 1;
		}else{
			$data['redeem_pos'] = 0;
		}

		if(isset($data['redeem_portal'])){
			$data['redeem_portal'] = 1;
		}else{
			$data['redeem_portal'] = 0;
		}

		$product_category = [];
		if(isset($data['product_category'])){
			$product_category = $data['product_category'];
			unset($data['product_category']);
		}

		$point = [];
		if(isset($data['point'])){
			$point = $data['point'];
			unset($data['point']);
		}

		$product = [];	
		if(isset($data['product'])){
			$product = $data['product'];
			unset($data['product']);
		}

		$point_product = [];
		if(isset($data['point_product'])){
			$point_product = $data['point_product'];
			unset($data['point_product']);
		}

		$rule_name = [];
		if(isset($data['rule_name'])){
			$rule_name = $data['rule_name'];
			unset($data['rule_name']);
		}

		$point_from = [];
		if(isset($data['point_from'])){
			$point_from = $data['point_from'];
			unset($data['point_from']);
		}

		$point_to = [];
		if(isset($data['point_to'])){
			$point_to = $data['point_to'];
			unset($data['point_to']);
		}

		$point_weight = [];
		if(isset($data['point_weight'])){
			$point_weight = $data['point_weight'];
			unset($data['point_weight']);
		}

		$status = [];
		if(isset($data['status'])){
			$status = $data['status'];
			unset($data['status']);
		}

		$this->db->insert(db_prefix().'loy_rule',$data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) { 

			if($data['rule_base'] == 'product_category'){
				
				foreach($product_category as $key => $pr){
					$this->db->insert(db_prefix().'loy_rule_detail', [
						'loy_rule' => $insert_id,
						'rel_type' => $data['rule_base'],
						'rel_id' => $pr,
						'loyalty_point' => $point[$key],
					]);
				}
				
			}

			if($product['0'] != ''){
				
				foreach($product as $k => $pd){
					$this->db->insert(db_prefix().'loy_rule_detail', [
						'loy_rule' => $insert_id,
						'rel_type' => $data['rule_base'],
						'rel_id' => $pd,
						'loyalty_point' => $point_product[$k],
					]);
				}
				
			}


			if(count($rule_name) > 0){
				foreach($rule_name as $stt => $val){
					$this->db->insert(db_prefix().'loy_redemp_detail', [
						'loy_rule' => $insert_id,
						'rule_name' => $val,
						'point_from' => $point_from[$stt],
						'point_to' => $point_to[$stt],
						'point_weight' => $point_weight[$stt],
						'status' => $status[$stt],
					]);
				}
			}

			return $insert_id;
		}
		return false;
	}

	/**
	 * { update loyalty rule }
	 *
	 * @param  $data   The data
	 * @param  $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function update_loyalty_rule($data,$id){
		$data['minium_purchase'] = str_replace(',', '', $data['minium_purchase']);
		$data['purchase_value'] = str_replace(',', '', $data['purchase_value']);
		$data['start_date'] = to_sql_date($data['start_date']);
		$data['end_date'] = to_sql_date($data['end_date']);

		if(isset($data['client']) && count($data['client']) > 0){
			$data['client'] = implode(',', $data['client']);
		}else{
			$data['client'] = '';
		}

		if(isset($data['enable'])){
			$data['enable'] = 1;
		}else{
			$data['enable'] = 0;
		}

		if(isset($data['redeem_pos'])){
			$data['redeem_pos'] = 1;
		}else{
			$data['redeem_pos'] = 0;
		}

		if(isset($data['redeem_portal'])){
			$data['redeem_portal'] = 1;
		}else{
			$data['redeem_portal'] = 0;
		}


		$product_category = [];
		if(isset($data['product_category'])){
			$product_category = $data['product_category'];
			unset($data['product_category']);
		}

		$point = [];
		if(isset($data['point'])){
			$point = $data['point'];
			unset($data['point']);
		}

		$product = [];	
		if(isset($data['product'])){
			$product = $data['product'];
			unset($data['product']);
		}

		$point_product = [];
		if(isset($data['point_product'])){
			$point_product = $data['point_product'];
			unset($data['point_product']);
		}

		$rule_name = [];
		if(isset($data['rule_name'])){
			$rule_name = $data['rule_name'];
			unset($data['rule_name']);
		}

		$point_from = [];
		if(isset($data['point_from'])){
			$point_from = $data['point_from'];
			unset($data['point_from']);
		}

		$point_to = [];
		if(isset($data['point_to'])){
			$point_to = $data['point_to'];
			unset($data['point_to']);
		}

		$point_weight = [];
		if(isset($data['point_weight'])){
			$point_weight = $data['point_weight'];
			unset($data['point_weight']);
		}

		$status = [];
		if(isset($data['status'])){
			$status = $data['status'];
			unset($data['status']);
		}

		$this->db->where('loy_rule',$id);
		$this->db->delete(db_prefix().'loy_rule_detail');

		$this->db->where('loy_rule',$id);
		$this->db->delete(db_prefix().'loy_redemp_detail');

			if($data['rule_base'] == 'product_category'){
				foreach($product_category as $key => $pr){
					$this->db->insert(db_prefix().'loy_rule_detail', [
						'loy_rule' => $id,
						'rel_type' => $data['rule_base'],
						'rel_id' => $pr,
						'loyalty_point' => $point[$key],
					]);
				}
			}

			if($data['rule_base'] == 'product'){
				foreach($product as $k => $pd){
					$this->db->insert(db_prefix().'loy_rule_detail', [
						'loy_rule' => $id,
						'rel_type' => $data['rule_base'],
						'rel_id' => $pd,
						'loyalty_point' => $point_product[$k],
					]);
				}
			}


			if(count($rule_name) > 0){
				foreach($rule_name as $stt => $val){
					$this->db->insert(db_prefix().'loy_redemp_detail', [
						'loy_rule' => $id,
						'rule_name' => $val,
						'point_from' => $point_from[$stt],
						'point_to' => $point_to[$stt],
						'point_weight' => $point_weight[$stt],
						'status' => $status[$stt],
					]);
				}
			}

		$this->db->where('id',$id);
		$this->db->update(db_prefix().'loy_rule',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the loyalty rule.
	 *
	 * @param      string  $id     The identifier
	 *
	 * @return     The loyalty rule.
	 */
	public function get_loyalty_rule($id = ''){
		if($id != ''){
			$this->db->where('id',$id);
			$loy_rule = $this->db->get(db_prefix().'loy_rule')->row();
			if($loy_rule){
				if($loy_rule->rule_base == 'product_category'){
					$this->db->where('loy_rule',$id);
					$this->db->where('rel_type','product_category');
					$loy_rule->rule_detail = $this->db->get(db_prefix().'loy_rule_detail')->result_array();
				}elseif($loy_rule->rule_base == 'product'){
					$this->db->where('loy_rule',$id);
					$this->db->where('rel_type','product');
					$loy_rule->rule_detail = $this->db->get(db_prefix().'loy_rule_detail')->result_array();
				}else{
					$loy_rule->rule_detail = '';
				}

				$this->db->where('loy_rule',$id);
				$loy_rule->redemp_detail = $this->db->get(db_prefix().'loy_redemp_detail')->result_array();
			}

			return $loy_rule;
		}else{
			return $this->db->get(db_prefix().'loy_rule')->result_array();
		}
	}

	/**
	 * { delete loyalty rule }
	 *
	 * @param   $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function delete_loyalty_rule($id){
		$this->db->where('loy_rule',$id);
		$this->db->delete(db_prefix().'loy_rule_detail');

		$this->db->where('loy_rule',$id);
		$this->db->delete(db_prefix().'loy_redemp_detail');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'loy_rule');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}


	/**
	 * { list clients by group }
	 *
	 * @param      <type>  $group  The group
	 *
	 * @return     <array>  ( list clients )
	 */
	public function list_clients_by_group($group){
		return $this->db->query('select cg.groupid, cli.userid, cli.company from '.db_prefix().'customer_groups cg left join '.db_prefix().'clients cli on cg.customer_id = cli.userid where groupid = '.$group)->result_array();
	}

	/**
	 * Adds a membership rule.
	 *
	 * @param     $data   The data
	 */
	public function add_membership_rule($data){
		$data['add_from'] = get_staff_user_id();
		$data['date_create'] = date('Y-m-d');
	
		if(isset($data['client']) && count($data['client']) > 0){
			$data['client'] = implode(',', $data['client']);
		}else{
			$data['client'] = '';
		}

		$this->db->insert(db_prefix().'loy_mbs_rule',$data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) { 
			return $insert_id;
		}
		return false;
	}

	/**
	 * { update membership rule }
	 *
	 * @param  $data   The data
	 * @param  $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function update_membership_rule($data,$id){
		
		if(isset($data['client']) && count($data['client']) > 0){
			$data['client'] = implode(',', $data['client']);
		}else{
			$data['client'] = '';
		}

		$this->db->where('id',$id);
		$this->db->update(db_prefix().'loy_mbs_rule',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the membership rule
	 *
	 * @param      string  $id     The identifier
	 *
	 * @return     The loyalty rule.
	 */
	public function get_membership_rule($id = ''){
		if($id != ''){
			$this->db->where('id',$id);
			return $this->db->get(db_prefix().'loy_mbs_rule')->row();
		}else{
			return $this->db->get(db_prefix().'loy_mbs_rule')->result_array();
		}
	}

	/**
	 * { delete membership rule }
	 *
	 * @param   $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function delete_membership_rule($id){
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'loy_mbs_rule');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Adds a membership program.
	 *
	 * @param     $data   The data
	 */
	public function add_membership_program($data){
		$data['add_from'] = get_staff_user_id();
		$data['date_create'] = date('Y-m-d');
		$data['start_date'] = to_sql_date($data['start_date']);
		$data['end_date'] = to_sql_date($data['end_date']);

		$data['voucher_value'] = str_replace(',', '', $data['voucher_value']);
		$data['minium_purchase'] = str_replace(',', '', $data['minium_purchase']);

		$product_category = [];
		if(isset($data['product_category'])){
			$product_category = $data['product_category'];
			unset($data['product_category']);
		}

		$percent_cate = [];
		if(isset($data['percent_cate'])){
			$percent_cate = $data['percent_cate'];
			unset($data['percent_cate']);
		}

		$product = [];	
		if(isset($data['product'])){
			$product = $data['product'];
			unset($data['product']);
		}

		$percent_product = [];
		if(isset($data['percent_product'])){
			$percent_product = $data['percent_product'];
			unset($data['percent_product']);
		}

		if(isset($data['membership']) && is_array($data['membership']) && count($data['membership']) > 0){
			$data['membership'] = implode(',', $data['membership']);
		}

		$this->db->insert(db_prefix().'loy_mbs_program',$data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) { 

			if($data['discount'] == 'product_category'){
				foreach($product_category as $key => $pr){
					$this->db->insert(db_prefix().'loy_program_detail', [
						'mbs_program' => $insert_id,
						'rel_type' => $data['discount'],
						'rel_id' => $pr,
						'percent' => $percent_cate[$key],
					]);
				}
			}

			if($data['discount'] == 'product'){
				foreach($product as $k => $pd){
					$this->db->insert(db_prefix().'loy_program_detail', [
						'mbs_program' => $insert_id,
						'rel_type' => $data['discount'],
						'rel_id' => $pd,
						'percent' => $percent_product[$k],
					]);
				}
			}

			return $insert_id;
		}
		return false;
	}

	/**
	 * { update membership program }
	 *
	 * @param  $data   The data
	 * @param  $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function update_membership_program($data,$id){
		if(isset($data['membership']) && is_array($data['membership']) && count($data['membership']) > 0){
			$data['membership'] = implode(',', $data['membership']);
		}
		$data['start_date'] = to_sql_date($data['start_date']);
		$data['end_date'] = to_sql_date($data['end_date']);

		$data['voucher_value'] = str_replace(',', '', $data['voucher_value']);
		$data['minium_purchase'] = str_replace(',', '', $data['minium_purchase']);

		$product_category = [];
		if(isset($data['product_category'])){
			$product_category = $data['product_category'];
			unset($data['product_category']);
		}

		$percent_cate = [];
		if(isset($data['percent_cate'])){
			$percent_cate = $data['percent_cate'];
			unset($data['percent_cate']);
		}

		$product = [];	
		if(isset($data['product'])){
			$product = $data['product'];
			unset($data['product']);
		}

		$percent_product = [];
		if(isset($data['percent_product'])){
			$percent_product = $data['percent_product'];
			unset($data['percent_product']);
		}

		$this->db->where('mbs_program',$id);
		$this->db->delete(db_prefix().'loy_program_detail');

		if($data['discount'] == 'product_category'){
			foreach($product_category as $key => $pr){
				$this->db->insert(db_prefix().'loy_program_detail', [
					'mbs_program' => $id,
					'rel_type' => $data['discount'],
					'rel_id' => $pr,
					'percent' => $percent_cate[$key],
				]);
			}
		}

		if($data['discount'] == 'product'){
			foreach($product as $k => $pd){
				$this->db->insert(db_prefix().'loy_program_detail', [
					'mbs_program' => $id,
					'rel_type' => $data['discount'],
					'rel_id' => $pd,
					'percent' => $percent_product[$k],
				]);
			}
		}

		$this->db->where('id',$id);
		$this->db->update(db_prefix().'loy_mbs_program',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the membership program
	 *
	 * @param      string  $id     The identifier
	 *
	 * @return     The loyalty program.
	 */
	public function get_membership_program($id = ''){
		if($id != ''){
			$this->db->where('id',$id);
			$mbs_program = $this->db->get(db_prefix().'loy_mbs_program')->row();

			if($mbs_program){
				if($mbs_program->discount == 'product_category'){
					$this->db->where('mbs_program',$id);
					$this->db->where('rel_type','product_category');
					$mbs_program->discount_detail = $this->db->get(db_prefix().'loy_program_detail')->result_array();
				}elseif($mbs_program->discount == 'product'){
					$this->db->where('mbs_program',$id);
					$this->db->where('rel_type','product');
					$mbs_program->discount_detail = $this->db->get(db_prefix().'loy_program_detail')->result_array();
				}else{
					$mbs_program->discount_detail = '';
				}
			}

			return $mbs_program;

		}else{
			return $this->db->get(db_prefix().'loy_mbs_program')->result_array();
		}
	}

	/**
	 * { delete membership program }
	 *
	 * @param   $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function delete_membership_program($id){
		$this->db->where('mbs_program', $id);
		$this->db->delete(db_prefix().'loy_program_detail');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'loy_mbs_program');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the rule by client.
	 *
	 * @param       $client  The client
	 *
	 * @return      The rule by client.
	 */
	public function get_rule_by_client($client){
		$point = client_loyalty_point($client);
		$groups = $this->client_groups_model->get_customer_groups($client);
		$date = date('Y-m-d');

		if(count($groups) > 0){
			$groups_lst = array();
			foreach($groups as $gr){
				$groups_lst[] = $gr['groupid'];
			}

			return $this->db->query('select * from '.db_prefix().'loy_rule where (find_in_set('.$client.', client) or client_group IN ('.implode(',', $groups_lst).') ) and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" ) and enable = 1')->result_array();
		}else{
			return $this->db->query('select * from '.db_prefix().'loy_rule where find_in_set('.$client.', client) and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" ) and enable = 1')->result_array();
		}
	}

	/**
	 * Adds a transation.
	 *
	 * @param      $payment_id  The payment identifier
	 *
	 * @return     boolean  
	 */
	public function add_transation($payment_id){
		$this->load->model('payments_model');
		$this->load->model('invoices_model');
		$this->load->model('currencies_model');


		$payment = $this->payments_model->get($payment_id);
		$invoices = $this->invoices_model->get($payment->invoiceid);
		$point = 0;
		$cur_point = 0;

		if($invoices){
			$base_currency = $this->currencies_model->get_base_currency();
			$invoice_currency = $this->currencies_model->get($invoices->currency);
			$currency_rate = 1;
			if($invoice_currency->name != $base_currency->name){
				$currency_rate = loy_get_currency_rate($invoice_currency->name, $base_currency->name);
			}

			$list_rule = $this->get_rule_by_client($invoices->clientid);

			$cur_point = client_loyalty_point($invoices->clientid);
			$this->db->where('rel_id', $invoices->id);
			$this->db->where('rel_type','invoice');
			$invoice_items = $this->db->get(db_prefix().'itemable')->result_array();

			if($invoices->status == Invoices_model::STATUS_PAID){
				if(count($list_rule) > 0){
					foreach($list_rule as $rule){
						if($rule['rule_base'] == 'card_total'){
							$total_converted = (float) ($invoices->total * $currency_rate);
							if($rule['minium_purchase'] <= $total_converted){
								$point += $rule['poin_awarded']*( floor($total_converted/$rule['purchase_value']) );
							}
						}elseif($rule['rule_base'] == 'product_category'){
							$this->db->where('rel_type','product_category');
							$this->db->where('loy_rule',$rule['id']);
							$rule_dt_prc = $this->db->get(db_prefix().'loy_rule_detail')->result_array();

							foreach($invoice_items as $item_iv){
								$item_group = get_group_by_item_name($item_iv['description'], $item_iv['long_description']);
								if($item_group != 0){
									if(count($rule_dt_prc) > 0){
										foreach($rule_dt_prc as $dt_prc){
											if($dt_prc['rel_id'] == $item_group){
												$point += $dt_prc['loyalty_point']*$item_iv['qty']; 
											}
										}
									}
								}
							}
						}elseif($rule['rule_base'] == 'product'){
							$this->db->where('rel_type','product');
							$this->db->where('loy_rule',$rule['id']);
							$rule_dt_prc2 = $this->db->get(db_prefix().'loy_rule_detail')->result_array();

							foreach($invoice_items as $item_iv2){
								$item = get_item_id_by_item_name($item_iv2['description'], $item_iv2['long_description']);
								if($item != 0){
									if(count($rule_dt_prc2) > 0){
										foreach($rule_dt_prc2 as $dt_prc2){
											if($dt_prc2['rel_id'] == $item){
												$point += $dt_prc2['loyalty_point']*$item_iv2['qty']; 
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		if($point > 0){
			if(get_option('loyalty_earn_points_from_redeemable_transactions') == 1 || total_rows(db_prefix().'loy_redeem_log', ['invoice' => $invoices->id]) == 0){

				$this->db->insert(db_prefix().'loy_transation',[
					'reference' => 'order_debit',
					'client' => $invoices->clientid,
					'invoice' => $invoices->id,
					'date_create' => date('Y-m-d H:i:s'),
					'loyalty_point' => $point,
					'type' => 'debit',
				]);
				$insert_transation = $this->db->insert_id();
				if($insert_transation){
					$new_point = $cur_point + $point;
					$this->db->where('userid',$invoices->clientid);
					$this->db->update(db_prefix().'clients',['loy_point' => $new_point]);

					return true;
				}
			}
		}

		return true;
	}

	/**
	 * Adds a credit mbs program.
	 *
	 * @param  $invoice_id  The invoice identifier
	 */
	public function add_credit_mbs_program($invoice_id){
		$this->load->model('invoices_model');
		$this->load->model('credit_notes_model');

		$invoice = $this->invoices_model->get($invoice_id);

		$total_discount = 0;
		if($invoice){
			$list_pg = $this->get_program_by_client($invoice->clientid);
			$this->db->where('rel_id', $invoice->id);
			$this->db->where('rel_type','invoice');
			$invoice_items = $this->db->get(db_prefix().'itemable')->result_array();

			if($list_pg != false && count($list_pg) > 0){
				foreach($list_pg as $pg){
					if($pg['discount'] == 'card_total'){

						if(is_numeric($pg['discount_percent'])){
							$total_discount += ($invoice->total*$pg['discount_percent'])/100;
						}

					}elseif($pg['discount'] == 'product_category'){

						$this->db->where('rel_type','product_category');
						$this->db->where('mbs_program',$pg['id']);
						$rule_dt_prg = $this->db->get(db_prefix().'loy_program_detail')->result_array();

						foreach($invoice_items as $item_iv){
							$item_group = get_group_by_item_name($item_iv['description'], $item_iv['long_description']);
							if($item_group != 0){
								if(count($rule_dt_prg) > 0){
									foreach($rule_dt_prg as $dt_prc){
										if($dt_prc['rel_id'] == $item_group){
											$total_discount += (($item_iv['rate']*$dt_prc['percent'])/100)*$item_iv['qty'];
										}
									}
								}
							}
						}

					}elseif($pg['discount'] == 'product'){

						$this->db->where('rel_type','product');
						$this->db->where('mbs_program',$pg['id']);
						$rule_dt_prg2 = $this->db->get(db_prefix().'loy_program_detail')->result_array();

						foreach($invoice_items as $item_iv2){
							$item = get_item_id_by_item_name($item_iv2['description'], $item_iv2['long_description']);
							if($item != 0){
								if(count($rule_dt_prg2) > 0){
									foreach($rule_dt_prg2 as $dt_prc2){
										if($dt_prc2['rel_id'] == $item){
											$total_discount += (($item_iv2['rate']*$dt_prc2['percent'])/100)*$item_iv2['qty'];
										}
									}
								}
							}
						}
					}
				}
			}
		}

		if($total_discount > 0){
			$next_credit_note_number = get_option('next_credit_note_number');
            $__number = $next_credit_note_number;

			$data['clientid'] = $invoice->clientid;
			$data['show_shipping_on_credit_note'] = 'on';
			$data['date'] = date('Y-m-d');
			$data['number'] = str_pad($__number, get_option('number_padding_prefixes'), '0', STR_PAD_LEFT);
			$data['show_quantity_as'] = 1;
			$data['quantity'] = 1;
			$data['newitems'][1] = [
				'order' => 1,
				'description' => client_membership($invoice->clientid).' '._l('membership_program'),
				'long_description' => '',
				'qty' => 1,
				'unit' => '',
				'rate' => $total_discount,
			];
			$data['subtotal'] = $total_discount;
			$data['total'] = $total_discount;
			$data['currency'] = $invoice->currency;

			$credit_note = $this->credit_notes_model->add($data);
			if($credit_note){
				$apply_data['amount'] = $total_discount;
				$apply_data['invoice_id'] = $invoice_id;
				$_result = $this->credit_notes_model->apply_credits($credit_note, $apply_data);

				if($_result){
					return true;
				}
			}

		}

		return true;

	}

	/**
	 * Gets the program by client.
	 *
	 * @param      <type>  $client  The client
	 */
	public function get_program_by_client($client){
		$point = client_loyalty_point($client);
		$rank = client_rank($client);
		$date = date('Y-m-d');
		if($rank){
			return $this->db->query('select * from '.db_prefix().'loy_mbs_program where find_in_set('.$rank->id.', membership) and ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.' ) OR loyalty_point_to <= '.$point.') and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" )')->result_array();
		}else{
			return [];
		}
	}

	/**
	 * Adds a transation manual.
	 *
	 * @param  $data   The data
	 */
	public function add_transation_manual($data){
	
		$data['reference'] = 'manual_credit';
		$data['date_create'] = date('Y-m-d H:i:s');
		$data['add_from'] = get_staff_user_id();

		$client_point = client_loyalty_point($data['client']);

		if($data['type'] == 'remove' && $data['loyalty_point'] > $client_point){
			return 'invalid_point';
		}else{
			$this->db->insert(db_prefix().'loy_transation',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id){
				if($data['type'] != 'remove'){
					$point = ($data['loyalty_point'] + client_loyalty_point($data['client']));
				}else{
					$point = ($client_point - $data['loyalty_point']);
				}

				$this->db->where('userid',$data['client']);
				$this->db->update(db_prefix().'clients', ['loy_point' => $point ]);

				return $insert_id;
			}
		}

		return false;
	}

	/**
	 * { delete transation }
	 *
	 * @param   $id     The identifier
	 *
	 * @return     boolean  
	 */
	public function delete_transation($id){
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'loy_transation');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the transation by client.
	 *
	 * @param  $client  The client
	 */
	public function get_transation_by_client($client){
		$this->db->where('client',$client);
		$this->db->order_by('date_create','desc');
		return $this->db->get(db_prefix().'loy_transation')->result_array();
	}

	/**
	 * Adds a redeem log program.
	 *
	 * @param        $cart_data  The cartesian data
	 * @param        $data       The data
	 */
	public function add_redeem_log_program($cart_data, $data){
		$old_point = client_loyalty_point($data['userid']);

		$this->db->where('number', $cart_data->number_invoice);
      	$invoice =  $this->db->get(db_prefix().'invoices')->row();

      	if($data['voucher'] != '' && $data['discount_total'] > 0){
      		$iv_id = 0;
			if($invoice){
				$iv_id = $invoice->id;
			}
      		$this->db->insert(db_prefix().'loy_voucher_inv_log', [
				'client' => $data['userid'],
				'voucher_code' => $data['voucher'],
				'invoice' => $iv_id,
				'time' => date('Y-m-d H:i:s'),
				'value' => $data['discount_total'],
			]);
			$vc_inv_log = $this->db->insert_id();
      	}

		if(isset($data['redeem_from']) && $cart_data->discount > 0){
			if($data['redeem_from'] != ''){
				$this->db->where('userid',$data['userid']);
				$this->db->update(db_prefix().'clients', ['loy_point' => ($old_point - $data['redeem_from']),]);
				if ($this->db->affected_rows() > 0) {
					$iv_id = 0;
					if($invoice){
						$iv_id = $invoice->id;
					}

					$this->db->insert(db_prefix().'loy_redeem_log',[
						'client' => $data['userid'],
						'cart' => $cart_data->id,
						'invoice' => $iv_id,
						'time' => date('Y-m-d H:i:s'),
						'old_point' => $old_point,
						'new_point' => ($old_point - $data['redeem_from']),
						'redeep_from' => $data['redeem_from'],
						'redeep_to' => $data['redeem_to'],
					]);
					$insert_id = $this->db->insert_id();
					if($insert_id){
						return $insert_id;
					}
				}
			}
		}
	}

	/**
	 * { apply redeem log inv }
	 *
	 * @param        $inv_id  The inv identifier
	 * @param        $data    The data
	 */
	public function apply_redeem_log_inv($inv_id, $data){
		$this->db->where('id', $inv_id);
		$invoice = $this->db->get(db_prefix().'invoices')->row();
		if($invoice){

			if($data['voucher_code'] != '' && $data['voucher_value'] > 0 && $invoice->discount_total >= $data['voucher_value']){
	      		$iv_id = 0;
				if($invoice){
					$iv_id = $invoice->id;
				}
	      		$this->db->insert(db_prefix().'loy_voucher_inv_log', [
					'client' => $invoice->clientid,
					'voucher_code' => $data['voucher_code'],
					'invoice' => $iv_id,
					'time' => date('Y-m-d H:i:s'),
					'value' => $data['voucher_value'],
				]);
				$vc_inv_log = $this->db->insert_id();
	      	}

	      	$programs = $this->db->get(db_prefix().'loy_mbs_program')->result_array();
	      	if(count($programs) > 0){
	      		foreach($programs as $pg){
	      			if(isset($data['program_'.$pg['id']])  ){
	      				if($invoice->discount_total >= $data['program_'.$pg['id']]){
		      				$this->db->insert(db_prefix().'loy_program_discount_log',[
		      					'client' => $invoice->clientid,
		      					'mbs_program' => $pg['id'],
		      					'invoice' => $inv_id,
		      					'time' => date('Y-m-d H:i:s'),
		      					'value' => $data['program_'.$pg['id']],
		      				]);
		      			}
	      			}
	      		}
	      	}

			$old_point = client_loyalty_point($invoice->clientid);
			if(isset($data['redeem_from']) && $invoice->discount_total > 0 && $data['redeem_from'] != ''){
				$this->db->where('userid', $invoice->clientid);
				$this->db->update(db_prefix().'clients', ['loy_point' => ($old_point - $data['redeem_from']) ]);
				if ($this->db->affected_rows() > 0) { 
					$this->db->insert(db_prefix().'loy_redeem_log',[
						'client' => $invoice->clientid,
						'cart' => 0,
						'invoice' => $inv_id,
						'time' => date('Y-m-d H:i:s'),
						'old_point' => $old_point,
						'new_point' => ($old_point - $data['redeem_from']),
						'redeep_from' => $data['redeem_from'],
						'redeep_to' => $data['redeem_to'],
					]);
					$insert_id = $this->db->insert_id();
					if($insert_id){
						return $insert_id;
					}
				}
			}
		}
	}

	/**
	 * { get redeem log by client }
	 */
	public function get_redeem_log_by_client($client){
		return $this->db->query('select * from '.db_prefix().'loy_redeem_log where client = '.$client.' order by time desc' )->result_array();
	}

	/**
	 * { apply voucher to portal }
	 */
	public function apply_voucher_to_portal($client, $invoice_id, $voucher){
		$this->load->model('currencies_model');
		$this->load->model('invoices_model');

		$currency_rate = 1;
		if($invoice_id != ''){
			$_invoice = $this->invoices_model->get($invoice_id);

			$base_currency = $this->currencies_model->get_base_currency();
			$invoice_currency = $this->currencies_model->get($_invoice->currency);

			
			if($base_currency->name != $invoice_currency->name){
				$currency_rate = loy_get_currency_rate($base_currency->name, $invoice_currency->name);
			}
		}
		

		$data = [];
		$point = client_loyalty_point($client);
		$rank = client_rank($client);
		$date = date('Y-m-d');

		if($rank){
			$_voucher = $this->db->query('select * from '.db_prefix().'loy_mbs_program where find_in_set('.$rank->id.', membership) and ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.') OR loyalty_point_to <= '.$point.') and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" ) and voucher_code = "'.$voucher.'" order by loyalty_point_to desc')->row();

			if ($_voucher) {
				$voucher_value = $_voucher->voucher_value;
				if($_voucher->formal == 2){
					$voucher_value = (float) ($_voucher->voucher_value * $currency_rate);
				}

				$data = [
					'discount' => $voucher_value, 
					'formal' => $_voucher->formal,
					'minimum_order_value' => $_voucher->minium_purchase, 
				];
			}
		}

		return $data;
	}

	/**
	 * { apply voucher to portal }
	 */
	public function apply_voucher_to_portal_admin($client, $voucher){
		$this->load->model('currencies_model');
		$this->load->model('clients_model');

		$_client = $this->clients_model->get($client);

		$base_currency = $this->currencies_model->get_base_currency();
		$client_currency = $this->currencies_model->get($_client->default_currency);

		$currency_rate = 1;
		if($base_currency->name != $client_currency->name){
			$currency_rate = loy_get_currency_rate($base_currency->name, $client_currency->name);
		}

		$data = [];
		$point = client_loyalty_point($client);
		$rank = client_rank($client);
		$date = date('Y-m-d');

		if($rank){
			$_voucher = $this->db->query('select * from '.db_prefix().'loy_mbs_program where find_in_set('.$rank->id.', membership) and ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.') OR loyalty_point_to <= '.$point.') and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" ) and voucher_code = "'.$voucher.'" order by loyalty_point_to desc')->row();

			if ($_voucher) {
				$voucher_value = $_voucher->voucher_value;
				if($_voucher->formal == 2){
					$voucher_value = (float) ($_voucher->voucher_value * $currency_rate);
				}

				$data = [
					'discount' => $voucher_value,
					'formal' => $_voucher->formal,
					'minimum_order_value' => $_voucher->minium_purchase, 
				];
			}
		}

		return $data;
	}

	/**
	 * { apply mbs program discount }
	 *
	 * @param        $client  The client
	 */
	public function apply_mbs_program_discount($client){
		$data = [];
		$program = $this->get_program_by_client($client);

		if(count($program) > 0){
			foreach($program as $pro){
				$this->db->where('mbs_program', $pro['id']);
				$pro_detail = $this->db->get(db_prefix().'loy_program_detail')->result_array();
				if($pro['discount'] == 'product'){
					foreach($pro_detail as $val){
						$data[] = [
							'items' => $val['rel_id'],
							'discount' => $val['percent'],
							'formal' => '1',
							'voucher' => '',
							'group_items' => '',
							'minimum_order_value' => $pro['minium_purchase'],
							'name_trade_discount' => $pro['program_name'],
							'program_id' => $pro['id']
						];
					}
				}elseif($pro['discount'] == 'product_category'){
					foreach($pro_detail as $val_cate){
						$items = product_ids_by_cate($val_cate['rel_id']);

						$data[] = [
							'items' => implode(',', $items),
							'discount' => $val_cate['percent'],
							'formal' => '1',
							'voucher' => '',
							'group_items' => '',
							'minimum_order_value' => $pro['minium_purchase'],
							'name_trade_discount' => $pro['program_name'],
							'program_id' => $pro['id']
						];
					}
				}elseif($pro['discount'] == 'card_total'){
					$data[] = [
						'formal' => '1',
						'items' => '',
						'discount' => $pro['discount_percent'],
						'voucher' => '',
						'group_items' => '',
						'minimum_order_value' => $pro['minium_purchase'],
						'name_trade_discount' => $pro['program_name'],
						'program_id' => $pro['id']
					];
				}
			}
		}

		return $data;

	}

	/**
	 * { redeem inv client }
	 *
	 * @param        $data   The data
	 */
	public function redeem_inv_client($data){
		$affected_rows = 0;

		if($data['voucher'] != '' && $data['voucher_value'] != ''){
			$this->db->insert(db_prefix().'loy_voucher_inv_log', [
				'client' => $data['clientid'],
				'voucher_code' => $data['voucher'],
				'invoice' => $data['inv_id'],
				'time' => date('Y-m-d H:i:s'),
				'value' => $data['voucher_value'],
			]);
			$vc_inv_log = $this->db->insert_id();

			if($vc_inv_log){
				$affected_rows++;
			}
		}
		
		$this->db->where('id', $data['inv_id']);
		$this->db->update(db_prefix().'invoices', [
			'total' => $data['new_total'],
			'discount_total' =>$data['new_discount']
		]);
		if ($this->db->affected_rows() > 0) { 
			$affected_rows++;
		}

		$log = $this->apply_redeem_log_inv($data['inv_id'], $data);
		if($log){
			$affected_rows++;
		}

		if($affected_rows > 0){
			return true;
		}
		return false;
	}


	/**
	 * check auto create currency rate
	 * @return [type]
	 */
	public function check_auto_create_currency_rate() {
		$this->load->model('currencies_model');
		$currency_rates = $this->get_currency_rate();
		$currencies = $this->currencies_model->get();
		$currency_generator = $this->currency_generator($currencies);

		foreach ($currency_rates as $key => $currency_rate) {
			if (isset($currency_generator[$currency_rate['from_currency_id'] . '_' . $currency_rate['to_currency_id']])) {
				unset($currency_generator[$currency_rate['from_currency_id'] . '_' . $currency_rate['to_currency_id']]);
			}
		}

		//if have API, will get currency rate from here
		if (count($currency_generator) > 0) {
			$this->db->insert_batch(db_prefix() . 'currency_rates', $currency_generator);
		}

		return true;
	}

	/**
	 * currency generator
	 * @param  $variants
	 * @param  integer $i
	 * @return 
	 */
	public function currency_generator($currencies) {

		$currency_rates = [];

		foreach ($currencies as $key_1 => $value_1) {
			foreach ($currencies as $key_2 => $value_2) {
				if ($value_1['id'] != $value_2['id']) {
					$currency_rates[$value_1['id'] . '_' . $value_2['id']] = [
						'from_currency_id' => $value_1['id'],
						'from_currency_name' => $value_1['name'],
						'from_currency_rate' => 1,
						'to_currency_id' => $value_2['id'],
						'to_currency_name' => $value_2['name'],
						'to_currency_rate' => 0,
						'date_updated' => date('Y-m-d H:i:s'),
					];
				}

			}
		}

		return $currency_rates;
	}

	/**
	 * get currency rate
	 * @param  boolean $id
	 * @return [type]
	 */
	public function get_currency_rate($id = false) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'currency_rates')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from ' . db_prefix() . 'currency_rates')->result_array();
		}
	}


	/**
	 * update currency rate setting
	 *
	 * @param      array   $data   The data
	 *
	 * @return     boolean
	 */
	public function update_setting_currency_rate($data) {
		$affectedRows = 0;
		if (!isset($data['cr_automatically_get_currency_rate'])) {
			$data['cr_automatically_get_currency_rate'] = 0;
		}

		foreach ($data as $key => $value) {
			$this->db->where('name', $key);
			$this->db->update(db_prefix() . 'options', [
				'value' => $value,
			]);
			if ($this->db->affected_rows() > 0) {
				$affectedRows++;
			}
		}

		if ($affectedRows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Gets the currency rate online.
	 *
	 * @param        $id     The identifier
	 *
	 * @return     bool    The currency rate online.
	 */
	public function get_currency_rate_online($id) {
		$currency_rate = $this->get_currency_rate($id);

		if ($currency_rate) {
			return $this->currency_converter($currency_rate->from_currency_name, $currency_rate->to_currency_name);
		}

		return false;
	}

	/**
	 * Gets all currency rate online.
	 *
	 * @return     bool  All currency rate online.
	 */
	public function get_all_currency_rate_online() {
		$currency_rates = $this->get_currency_rate();
		$affectedRows = 0;
		foreach ($currency_rates as $currency_rate) {
			$rate = $this->currency_converter($currency_rate['from_currency_name'], $currency_rate['to_currency_name']);

			$data_update = ['to_currency_rate' => $rate];
			$success = $this->update_currency_rate($data_update, $currency_rate['id']);

			if ($success) {
				$affectedRows++;
			}
		}

		if ($affectedRows > 0) {
			return true;
		}

		return true;
	}

	/**
	 * update currency rate
	 * @param  [type] $data
	 * @return [type]
	 */
	public function update_currency_rate($data, $id) {

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'currency_rates', ['to_currency_rate' => $data['to_currency_rate'], 'date_updated' => date('Y-m-d H:i:s')]);
		if ($this->db->affected_rows() > 0) {
			$this->db->where('id', $id);
			$current_rate = $this->db->get(db_prefix() . 'currency_rates')->row();

			$data_log['from_currency_id'] = $current_rate->from_currency_id;
			$data_log['from_currency_name'] = $current_rate->from_currency_name;
			$data_log['to_currency_id'] = $current_rate->to_currency_id;
			$data_log['to_currency_name'] = $current_rate->to_currency_name;
			$data_log['from_currency_rate'] = isset($data['from_currency_rate']) ? $data['from_currency_rate'] : '';
			$data_log['to_currency_rate'] = isset($data['to_currency_rate']) ? $data['to_currency_rate'] : '';
			$data_log['date'] = date('Y-m-d H:i:s');
			$this->db->insert(db_prefix() . 'currency_rate_logs', $data_log);
			return true;
		}
		return false;
	}

	/**
	 * currency converter description
	 * @param  string $from   Currency Code
	 * @param  string $to     Currency Code
	 * @param  float $amount
	 * @return float
	 */
	public function currency_converter($from, $to, $amount = 1) {
		$from = strtoupper($from);
		$to = strtoupper($to);

		$url = "https://api.frankfurter.app/latest?amount=$amount&from=$from&to=$to";

		$response = json_decode($this->api_get($url));

		if (isset($response->rates->$to)) {
			return $response->rates->$to;
		} elseif (isset($response->rates)) {
			return (array) $response->rates;
		}

		return false;
	}

	/**
	 * api get
	 * @param  string $url
	 * @return string
	 */
	public function api_get($url) {
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);

		return curl_exec($curl);
	}

	/**
	 * delete currency rate
	 * @param  [type] $id
	 * @return [type]
	 */
	public function delete_currency_rate($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'currency_rates');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * { cronjob currency rates }
	 *
	 * @param        $manually  The manually
	 *
	 * @return     bool    
	 */
	public function cronjob_currency_rates($manually) {
		$currency_rates = $this->get_currency_rate();
		foreach ($currency_rates as $currency_rate) {
			$data_insert = $currency_rate;
			$data_insert['date'] = date('Y-m-d');
			unset($data_insert['date_updated']);
			unset($data_insert['id']);

			$this->db->insert(db_prefix() . 'currency_rate_logs', $data_insert);
		}

		if (get_option('cr_date_cronjob_currency_rates') == 1) {
			$this->get_all_currency_rate_online();
		}

		$asm_global_amount_expiration = get_option('cr_global_amount_expiration');
		if ($asm_global_amount_expiration != 0 && $asm_global_amount_expiration != '') {
			$this->db->where('date < ' . date('Y-m-d', strtotime(date('Y-m-d') . ' - ' . $asm_global_amount_expiration . ' days')));
			$this->db->delete(db_prefix() . 'currency_rate_logs');
		}
		update_option('cr_date_cronjob_currency_rates', date('Y-m-d'));

		return true;
	}
}