<?php

return array(
    0 =>
        array(
            'identifier' => 'dashboard',
            'link' => '/admin/dashboard',
            'text' => lang("Dashboard", "admin"),
            'class' => 'homeAnchor',
            'icon' => 'icon-home',
        ),
    1 =>
        array(
            'identifier' => 'content',
            'link' => '',
            'text' => lang("Content", "admin"),
            'icon' => 'icon-align-justify',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'content_head',
                            'header' => true,
                            'text' => lang('Content', 'admin', FALSE),
                        ),
                    1 =>
                        array(
                            'identifier' => 'create_page',
                            'link' => '/admin/pages',
                            'text' => lang("Create page", "admin"),
                        ),
                    2 =>
                        array(
                            'identifier' => 'articles_list',
                            'link' => '/admin/pages/GetPagesByCategory',
                            'text' => lang("Articles list", "admin"),
                            'divider' => true,
                        ),
                    3 =>
                        array(
                            'identifier' => 'categories_head',
                            'header' => true,
                            'text' => lang('Categories', 'admin', FALSE),
                        ),
                    4 =>
                        array(
                            'identifier' => 'create_category',
                            'link' => '/admin/categories/create_form',
                            'text' => lang("Create category", "admin"),
                        ),
                    5 =>
                        array(
                            'identifier' => 'categories_list',
                            'link' => '/admin/categories/cat_list',
                            'text' => lang("Categories list", "admin"),
                            'divider' => true,
                        ),
                    6 =>
                        array(
                            'identifier' => 'additional_fields',
                            'text' => lang("Additional fields", "admin_menu"),
                            'link' => '/admin/components/cp/cfcm/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                            'callback' => '',
                        ),
                ),
        ),
    2 =>
        array(
            'identifier' => 'categories',
            'link' => '',
            'text' => lang("Categories", "admin"),
            'icon' => 'icon-list',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'new_category',
                            'link' => '/admin/categories/create_form',
                            'text' => lang("Create new", "admin"),
                        ),
                    1 =>
                        array(
                            'identifier' => 'categories_list',
                            'link' => '/admin/categories/cat_list',
                            'text' => lang("Categories list", "admin"),
                        ),
                ),
        ),
    5 =>
        array(
            'identifier' => 'widgets',
            'link' => '',
            'text' => lang("Widgets", "admin"),
            'icon' => 'icon-th',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'create_widget',
                            'link' => '/admin/widgets_manager/create_tpl',
                            'text' => lang("Create widget", "admin"),
                        ),
                    1 =>
                        array(
                            'identifier' => 'widgets_list',
                            'link' => '/admin/widgets_manager',
                            'text' => lang("Widgets list", "admin"),
                        ),
                ),
        ),
    //_____________________________________________________________________
    8 =>
        array(
            'identifier' => 'orders',
            'link' => '',
            'text' => lang("Orders", "admin"),
            'icon' => 'icon-shopping-cart',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'orders_header',
                            'header' => true,
                            'text' => lang('Orders', 'admin', FALSE),
                        ),
                    1 =>
                        array(
                            'identifier' => 'orders_list',
                            'link' => '/admin/components/run/shop/orders/index',
                            'text' => lang("Orders list", "admin"),
                        ),
                    2 =>
                        array(
                            'identifier' => 'order_statuses',
                            'link' => '/admin/components/run/shop/orderstatuses',
                            'text' => lang("Order statuses", "admin"),
                            'divider' => true,
                        ),
                    3 =>
                        array(
                            'identifier' => 'callbacks',
                            'header' => true,
                            'text' => lang('Callbacks', 'admin', FALSE),
                        ),
                    4 =>
                        array(
                            'identifier' => 'callbacks_list',
                            'link' => '/admin/components/run/shop/callbacks',
                            'text' => lang("Callbacks list", "admin"),
                        ),
                    5 =>
                        array(
                            'identifier' => 'callback_statuses',
                            'link' => '/admin/components/run/shop/callbacks/statuses',
                            'text' => lang("Callback statuses", "admin"),
                        ),
                    6 =>
                        array(
                            'identifier' => 'callback_themes',
                            'link' => '/admin/components/run/shop/callbacks/themes',
                            'text' => lang("Callback themes", "admin"),
                            'divider' => true,
                        ),
                    7 =>
                        array(
                            'identifier' => 'notifications',
                            'header' => true,
                            'text' => lang('Notifications', 'admin'),
                        ),
                    8 =>
                        array(
                            'identifier' => 'notifications_list',
                            'link' => '/admin/components/run/shop/notifications',
                            'text' => lang("Notifications list", "admin"),
                        ),
                    9 =>
                        array(
                            'identifier' => 'notification_statuses',
                            'link' => '/admin/components/run/shop/notificationstatuses/index',
                            'text' => lang("Notification statuses", "admin"),
                        ),
                ),
        ),
    '9' =>
        array(
            'identifier' => 'products_catalogue',
            'text' => lang("Products catalogue", "admin_menu"),
            'link' => '',
            'class' => '',
            'id' => '',
            'pjax' => '',
            'icon' => 'icon-list-alt',
            'divider' => false,
            'subMenu' =>
                array(
                    '0' =>
                        array(
                            'identifier' => 'product_create',
                            'text' => lang("Create product", "admin_menu"),
                            'link' => '/admin/components/run/shop/products/create',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '1' =>
                        array(
                            'identifier' => 'product_categories',
                            'text' => lang("Product categories", "admin_menu"),
                            'link' => '/admin/components/run/shop/categories/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '2' =>
                        array(
                            'identifier' => 'products_list',
                            'text' => lang("Products list", "admin_menu"),
                            'link' => '/admin/components/run/shop/search/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '3' =>
                        array(
                            'identifier' => 'products_properties',
                            'text' => lang("Products properties", "admin_menu"),
                            'link' => '/admin/components/run/shop/properties/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '4' =>
                        array(
                            'identifier' => 'brands',
                            'text' => lang("Brands", "admin_menu"),
                            'link' => '/admin/components/run/shop/brands/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '5' =>
                        array(
                            'identifier' => 'produkts_kits',
                            'text' => lang("Produkts kits", "admin_menu"),
                            'link' => '/admin/components/run/shop/kits/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    '6' =>
                        array(
                            'identifier' => 'products_without_images',
                            'text' => lang("Products without images", "admin_menu"),
                            'link' => '/admin/components/run/shop/search/index?WithoutImages=1',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                ),
        ),
    10 =>
        array(
            'identifier' => 'users_management',
            'link' => '',
            'text' => lang("Users management", "admin"),
            'icon' => 'icon-user',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'list_of_users',
                            'link' => '/admin/components/run/shop/users/index',
                            'text' => lang("List of users", "admin"),
                        ),
                    1 =>
                        array(
                            'identifier' => 'rbac_control',
                            'link' => '/admin/rbac/roleList',
                            'text' => lang("RBAC control", "admin"),
                        ),
                ),
        ),
    12 =>
        array(
            'identifier' => 'modules',
            'link' => '',
            'text' => lang("Modules", "admin"),
            'icon' => 'icon-circle-arrow-down',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'all_modules',
                            'link' => '/admin/components/modules_table',
                            'text' => lang("All modules", "admin"),
                            'divider' => true,
                        ),
                ),
        ),
    13 =>
        array(
            'identifier' => 'statistics',
            'link' => '',
            'text' => lang("Statistics", "admin"),
            'icon' => 'icon-statistic',
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'statistics_orders',
                            'link' => '/admin/components/cp/mod_stats/orders/charts',
                            'text' => lang("Orders", "admin"),
                            'pjax' => false,
                        ),
                    1 =>
                        array(
                            'identifier' => 'statistics_users',
                            'link' => '/admin/components/cp/mod_stats/users/online',
                            'text' => lang("Users", "admin"),
                            'pjax' => false,
                        ),
                    2 =>
                        array(
                            'identifier' => 'statistics_products',
                            'link' => '/admin/components/cp/mod_stats/products/categories',
                            'text' => lang("Products", "admin"),
                            'pjax' => false,
                        ),
                    3 =>
                        array(
                            'identifier' => 'statistics_categories',
                            'link' => '/admin/components/cp/mod_stats/categories/attendance',
                            'text' => lang("Categories", "admin"),
                            'pjax' => false,
                        ),
                    4 =>
                        array(
                            'identifier' => 'statistics_search',
                            'link' => '/admin/components/cp/mod_stats/search/keywords',
                            'text' => lang("Search", "admin"),
                            'pjax' => false,
                        ),
                ),
        ),
    6 =>
        array(
            'identifier' => 'settings',
            'text' => lang("Settings", "admin_menu"),
            'link' => '',
            'class' => '',
            'id' => '',
            'pjax' => '',
            'icon' => 'icon-cog',
            'divider' => false,
            'subMenu' =>
                array(
                    0 =>
                        array(
                            'identifier' => 'global_settings',
                            'text' => lang("Global settings", "admin_menu"),
                            'link' => '/admin/settings',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    1 =>
                        array(
                            'identifier' => 'shop_settings',
                            'text' => lang("Shop settings", "admin_menu"),
                            'link' => '/admin/components/run/shop/settings',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => true,
                        ),
                    2 =>
                        array(
                            'identifier' => 'currencies',
                            'text' => lang("Currencies", "admin_menu"),
                            'link' => '/admin/components/run/shop/currencies',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    3 =>
                        array(
                            'identifier' => 'delivery_methods_(shipping)',
                            'text' => lang("Delivery methods (shipping)", "admin_menu"),
                            'link' => '/admin/components/run/shop/deliverymethods/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    4 =>
                        array(
                            'identifier' => 'payment_methods',
                            'text' => lang("Payment methods", "admin_menu"),
                            'link' => '/admin/components/run/shop/paymentmethods/index',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => true,
                        ),
                    5 =>
                        array(
                            'identifier' => 'widgets',
                            'text' => lang("Widgets", "admin_menu"),
                            'link' => '/admin/widgets_manager',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    6 =>
                        array(
                            'identifier' => 'custom_fields',
                            'text' => lang("Custom fields", "admin_menu"),
                            'link' => '/admin/components/run/shop/customfields',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    7 =>
                        array(
                            'identifier' => 'template_manager',
                            'text' => lang("Template editor", "admin_menu"),
                            'link' => '/admin/components/cp/template_editor',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    8 =>
                        array(
                            'identifier' => 'languages',
                            'text' => lang("Languages", "admin_menu"),
                            'link' => '/admin/languages',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => true,
                        ),
                    9 =>
                        array(
                            'identifier' => 'events_journal',
                            'text' => lang("Events journal", "admin_menu"),
                            'link' => '/admin/admin_logs',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    10 =>
                        array(
                            'identifier' => 'backup',
                            'text' => lang("Backup", "admin_menu"),
                            'link' => '/admin/backup',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    11 =>
                        array(
                            'identifier' => 'roles_list',
                            'text' => lang("Roles list", "admin_menu"),
                            'link' => '/admin/rbac/roleList',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => true,
                        ),
                    12 =>
                        array(
                            'identifier' => 'system_update',
                            'text' => lang("System update", "admin_menu"),
                            'link' => '/admin/sys_update',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                    13 =>
                        array(
                            'identifier' => 'system_information',
                            'text' => lang("System information", "admin_menu"),
                            'link' => '/admin/sys_info',
                            'class' => '',
                            'id' => '',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => true,
                        ),
                    14 =>
                        array(
                            'identifier' => 'custom_fields',
                            'text' => lang("Clear cache", "admin_menu"),
                            'link' => '',
                            'class' => '',
                            'id' => 'clearAllCache',
                            'pjax' => '',
                            'icon' => '',
                            'divider' => false,
                        ),
                ),
        ),
);
