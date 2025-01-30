<?php

hooks()->add_action('admin_init', function(){
    get_instance()->app_tabs->add_settings_tab('customer_rest_api', [
        'name'     => _l('customer_rest_api'),
        'view'     => 'customers_api/rest_api_settings',
        'icon'     => 'fab fa-app-store',
        'position' => 5,
    ]);
    get_instance()->app_menu->add_sidebar_menu_item('customers_api', [
        'slug'     => 'customers_api',
        'name'     => _l('customers_api'),
        'icon'     => 'fa-brands fa-app-store',
        'href'     => admin_url('customers_api/v1/customers_api/view'),
        'position' => 31,
    ]);

    get_instance()->app_menu->add_sidebar_children_item('customers_api', [
        'slug'     => 'customers_api',
        'name'     => _l('api_settings'),
        'href'     => admin_url('settings?group=customer_rest_api'),
        'position' => 31,
    ]);
    \modules\customers_api\core\Apiinit::ease_of_mind(CUSTOMERS_API_MODULE);
});
