<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'flexforumcategories')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumcategories` (
    `id` int(11) NOT NULL,
    `name` mediumtext NOT NULL,
    `slug` mediumtext NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumcategories`
    ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumcategories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}

if (!$CI->db->table_exists(db_prefix() . 'flexforumtopics')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumtopics` (
    `id` int(11) NOT NULL,
    `category` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `user_type` varchar(10) NOT NULL,
    `title` mediumtext NOT NULL,
    `slug` mediumtext NOT NULL,
    `description` LONGTEXT NOT NULL,
    `date_added` datetime NOT NULL,
    `date_updated` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumtopics`
    ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumtopics`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}

if (!$CI->db->table_exists(db_prefix() . 'flexforumlikes')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumlikes` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `user_type` varchar(10) NOT NULL,
    `type_id` int(11) NOT NULL,
    `type` varchar(10) NOT NULL,
    `date_added` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumlikes`
    ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumlikes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}

if (!$CI->db->table_exists(db_prefix() . 'flexforumreplies')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumreplies` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `user_type` varchar(10) NOT NULL,
    `type_id` int(11) NOT NULL,
    `type` varchar(10) NOT NULL,
    `reply` LONGTEXT NOT NULL,
    `date_added` datetime NOT NULL,
    `date_updated` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumreplies`
    ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumreplies`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}

if (!$CI->db->table_exists(db_prefix() . 'flexforumbans')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumbans` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `user_type` varchar(10) NOT NULL,
    `date_added` datetime NOT NULL,
    `date_updated` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumbans`
    ADD PRIMARY KEY (`id`);');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumbans`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');

    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumlikes` ADD COLUMN `banned` tinyint(1) NOT NULL DEFAULT 0');
    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumreplies` ADD COLUMN `banned` tinyint(1) NOT NULL DEFAULT 0');
    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumtopics` ADD COLUMN `banned` tinyint(1) NOT NULL DEFAULT 0');
    $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumtopics` ADD COLUMN `closed` tinyint(1) NOT NULL DEFAULT 0');
}

if (!$CI->db->table_exists(db_prefix() . 'flexforumfollowers')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . 'flexforumfollowers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

  $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumfollowers`
  ADD PRIMARY KEY (`id`);');

  $CI->db->query('ALTER TABLE `' . db_prefix() . 'flexforumfollowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}

//create email templates
$CI->load->library('flexforum/notifications_module');
$CI->notifications_module->create_email_template();
