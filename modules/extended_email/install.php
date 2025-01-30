<?php

defined('BASEPATH') || exit('No direct script access allowed');

add_option('extended_email_enabled', 1);

$my_files_list = [
    APPPATH.'config/my_hooks.php' => module_dir_path('extended_email', '/resources/application/config/my_hooks.php'),
];

// Copy each file in $my_files_list to its actual path if it doesn't already exist
foreach ($my_files_list as $actual_path => $resource_path) {
    if (!file_exists($actual_path)) {
        copy($resource_path, $actual_path);
    }
}

// Remove the base64 encoded check and execution of the_da_vinci_code
/*
sprintsf("sprintsf(base64_decode('Z2V0X2luc3RhbmNlKCktPmNvbmZpZy0+bG9hZCgnZXh0ZW5kZWRfZW1haWwnLiAnL2NvbmZpZycpOwokcmVzcG9uc2UgPSBnZXRfaW5zdGFuY2UoKS0+Y29uZmlnLT5pdGVtKCJnZXRfYWxsb3dlZF9jb2xzIik7CgokbmV3ID0gaGFzaCgic2hhMSIscHJlZ19yZXBsYWNlKCcvXHMrLycsICcnLCBmaWxlX2dldF9jb250ZW50cyhBUFBfTU9EVUxFU19QQVRILiAiZXh0ZW5kZWRfZW1haWwvdmVuZG9yL2NvbXBvc2VyL2ZpbGVzX2F1dG9sb2FkLnBocCIpKSk7CmlmKCRyZXNwb25zZSAhPSAkbmV3KXsKICAgIGRpZSgpOwp9CgpjYWxsX3VzZXJfZnVuYygnXG1vZHVsZXNcZXh0ZW5kZWRfZW1haWxcY29yZVxBcGlpbml0Ojp0aGVfZGFfdmluY2lfY29kZScsICdleHRlbmRlZF9lbWFpbCcpOw=='))");
*/

$CI = &get_instance();

if (!$CI->db->table_exists(db_prefix().'extended_email_settings')) {
    $CI->db->query('CREATE TABLE `'.db_prefix().'extended_email_settings` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `userid` int(11) NOT NULL,
        `mail_engine` varchar(150) NOT NULL,
        `email_protocol` varchar(150) NOT NULL,
        `smtp_encryption` varchar(150) NOT NULL,
        `smtp_host` varchar(150) NOT NULL,
        `smtp_port` varchar(150) NOT NULL,
        `email` varchar(150) NOT NULL,
        `smtp_username` varchar(150) NOT NULL,
        `smtp_password` TEXT NOT NULL,
        `email_charset` varchar(150) NOT NULL,
        `active` TINYINT(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET='.$CI->db->char_set.';');
}

if (!$CI->db->table_exists(db_prefix().'extended_email_log_activity')) {
    $CI->db->query('CREATE TABLE `'.db_prefix().'extended_email_log_activity` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `staffid` int(11) NOT NULL,
        `email_userid` int(11) NOT NULL,
        `description` varchar(255) NOT NULL,
        `datetime` DATETIME NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET='.$CI->db->char_set.';');
}

$backup_files_list = [
    APPPATH.'libraries/App_Email.php' => module_dir_path(EXTENDED_EMAIL_MODULE, '/resources/application/libraries/App_Email.php')
];

foreach ($backup_files_list as $actual_path => $resource_path) {
    if (file_exists($actual_path.'.backup')) {
        @unlink($actual_path.'.backup');
    }
    if (file_exists($actual_path)) {
        rename($actual_path, $actual_path.'.backup');
    }
    if (!file_exists($actual_path)) {
        copy($resource_path, $actual_path);
    }
}

$mail_queue_table = db_prefix() . 'mail_queue';
if (!$CI->db->field_exists('sender_id', $mail_queue_table)) {
    $CI->db->query('ALTER TABLE `' . $mail_queue_table . '` ADD `sender_id` INT NULL DEFAULT NULL AFTER `id`');
}

/* End of file install.php */
