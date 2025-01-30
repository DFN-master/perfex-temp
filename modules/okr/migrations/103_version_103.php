<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_Version_103 extends App_module_migration {
	public function up() {
		$CI = &get_instance();
		if (!$CI->db->field_exists('type', db_prefix() . 'okr_setting_circulation')) {
			$CI->db->query('ALTER TABLE `' . db_prefix() . "okr_setting_circulation`
              ADD COLUMN `type` VARCHAR(45) NULL DEFAULT 'okr_custom'"
			);
		}
		if (!$CI->db->field_exists('year', db_prefix() . 'okr_setting_circulation')) {
			$CI->db->query('ALTER TABLE `' . db_prefix() . "okr_setting_circulation`
              ADD COLUMN `year` INT(11) NULL DEFAULT 0"
			);
		}
		if (!$CI->db->field_exists('quarter', db_prefix() . 'okr_setting_circulation')) {
			$CI->db->query('ALTER TABLE `' . db_prefix() . "okr_setting_circulation`
              ADD COLUMN `quarter` INT(11) NULL DEFAULT 0"
			);
		}
		if (!$CI->db->field_exists('month', db_prefix() . 'okr_setting_circulation')) {
			$CI->db->query('ALTER TABLE `' . db_prefix() . "okr_setting_circulation`
              ADD COLUMN `month` INT(11) NULL DEFAULT 0"
			);
		}
	}

}
