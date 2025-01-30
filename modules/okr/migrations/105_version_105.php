<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_Version_105 extends App_module_migration {
	public function up() {
		$CI = &get_instance();
		if (!$CI->db->field_exists('parent_key_result', db_prefix() . 'okrs')) {
			$CI->db->query('ALTER TABLE `' . db_prefix() . "okrs`
              ADD COLUMN `parent_key_result` INT(11) NOT NULL DEFAULT 0"
			);
		}
	}

}
