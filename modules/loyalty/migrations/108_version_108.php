<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_108 extends App_module_migration
{
    public function up()
    {
        $CI = &get_instance();

        add_option('customers_group_ids_not_use_membership_tab', '');

		add_option('customers_ids_not_use_membership_tab', '');
    }
}
