<?php

/**
 * Menu options for Pro and Premium
 * Date: 07.03.13
 * Time: 15:11
 */
if (!$ADMIN_URL)
    $ADMIN_URL = '/admin/components/run/shop/';

$baseMenu = array(
    array(
        'link' => '/admin/dashboard',
        'text' => lang('Dashboard', 'admin', FALSE),
        'class' => 'homeAnchor',
        'icon' => 'icon-home'
    ),
    array(
        'link' => '',
        'text' => lang('Content', 'admin', FALSE),
        'icon' => 'icon-align-justify',
        'subMenu' => array(
            array(
                'link' => '/admin/pages',
                'text' => lang('Create page', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/pages/GetPagesByCategory',
                'text' => lang('Articles list', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#additional_fields',
                'text' => lang('Fields list', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#fields_groups',
                'text' => lang("Group's list ", 'admin', FALSE),
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Categories', 'admin', FALSE),
        'icon' => 'icon-list',
        'subMenu' => array(
            array(
                'link' => '/admin/categories/create_form',
                'text' => lang('Create new', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/categories/cat_list',
                'text' => lang('Categories list', 'admin', FALSE),
            )
        )
    ),
    array(
        'link' => '',
        'text' => lang('Menu', 'admin', FALSE),
        'icon' => 'icon-list-alt',
        'subMenu' => array(
            array(
                'menusList' => true
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Modules', 'admin', FALSE),
        'icon' => 'icon-circle-arrow-down',
        'subMenu' => array(
            array(
                'link' => '/admin/components/modules_table',
                'text' => lang('All modules', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'modulesList' => true
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Widgets', 'admin', FALSE),
        'icon' => 'icon-th',
        'subMenu' => array(
            array(
                'link' => '/admin/widgets_manager/create_tpl',
                'text' => lang('Create widget', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/widgets_manager',
                'text' => lang('Widgets list', 'admin', FALSE),
            )
        )
    ),
    array(
        'link' => '',
        'text' => lang('System', 'admin', FALSE),
        'icon' => 'icon-hdd',
        'subMenu' => array(
            array(
                'link' => '/admin/settings',
                'text' => lang('Global settings', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/components/cp/template_editor',
                'text' => lang('Template editor', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/languages',
                'text' => lang('Languages', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/admin_logs',
                'text' => lang('Events journal', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/backup',
                'text' => lang('Backup', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/rbac/roleList',
                'text' => lang('Roles list', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'id' => 'clearAllCache',
                'pjax' => FALSE,
                'text' => lang('Clear cache', 'admin', FALSE),
            ),
        )
    )
);

$shopMenu = array(
    array(
        'link' => $ADMIN_URL . 'dashboard',
        'text' => lang('Shop dashboard', 'admin', FALSE),
        'icon' => 'icon-home'
    ),
    /** Orders * */
    array(
        'link' => '',
        'text' => lang('Orders', 'admin', FALSE),
        'icon' => 'icon-shopping-cart',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'orders/index',
                'text' => lang('Orders list', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'orderstatuses',
                'text' => lang('Order statuses', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks',
                'text' => lang('Callbacks list_', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks/statuses',
                'text' => lang('Callback statuses', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks/themes',
                'text' => lang('Callback themes', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => $ADMIN_URL . 'notifications',
                'text' => lang('Notifications list_', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'notificationstatuses/index',
                'text' => lang('Notification statuses', 'admin', FALSE),
            ),
        )
    ),
    /** Products * */
    array(
        'link' => '',
        'text' => lang('Products catalogue', 'admin', FALSE),
        'icon' => 'icon-list-alt',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'products/create',
                'text' => lang('Create product', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'categories/index',
                'text' => lang('Product categories', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'search/index',
                'text' => lang('Products list', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'properties/index',
                'text' => lang('Products properties', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'brands/index',
                'text' => lang('Brands', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'kits/index',
                'text' => lang('Produkts kits', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'search/index?WithoutImages=1',
                'text' => lang('Products without images', 'admin', FALSE),
            )
        )
    ),
    /** Users * */
    array(
        'link' => '',
        'text' => lang('Users management', 'admin', FALSE),
        'icon' => 'icon-user',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'users/index',
                'text' => lang('List of users', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/rbac/roleList',
                'text' => lang('RBAC control_', 'admin', FALSE),
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Content', 'admin', FALSE),
        'icon' => 'icon-align-justify',
        'subMenu' => array(
            array(
                'link' => '/admin/pages',
                'text' => lang('Create page', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/pages/GetPagesByCategory',
                'text' => lang('Articles list', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/categories/create_form',
                'text' => lang('Create category', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/categories/cat_list',
                'text' => lang('Categories list', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#additional_fields',
                'text' => lang('Fields list', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#fields_groups',
                'text' => lang("Group's list ", 'admin', FALSE),
            ),
        )
    ),
    /** Modules * */
    array(
        'link' => '',
        'text' => lang('Modules', 'admin', FALSE),
        'icon' => 'icon-circle-arrow-down',
        'subMenu' => array(
            array(
                'link'      => '/admin/components/modules_table',
                'text'      => lang('All modules', 'admin', FALSE),
            ),
            array(
                'divider'   => true
            ),
            array(
                'modulesList' => true
            ),
        )
    ),
    /** Statistics * */
    array(
        'link' => '',
        'text' => lang('Statistics', 'admin', FALSE),
        'icon' => 'icon-statistic',
        'subMenu' => array(
            array(
                'link' => '/admin/components/cp/mod_stats/orders/charts',
                'text' => lang('Orders', 'admin', FALSE),
                'pjax' => FALSE
            ),
            array(
                'link' => '/admin/components/cp/mod_stats/users/online',
                'text' => lang('Users', 'admin', FALSE),
                'pjax' => FALSE
            ),
            array(
                'link' => '/admin/components/cp/mod_stats/products/categories',
                'text' => lang('Products', 'admin', FALSE),
                'pjax' => FALSE
            ),
            array(
                'link' => '/admin/components/cp/mod_stats/categories/attendance',
                'text' => lang('Categories', 'admin', FALSE),
                'pjax' => FALSE
            ),
            array(
                'link' => '/admin/components/cp/mod_stats/search/keywords',
                'text' => lang('Search', 'admin', FALSE),
                'pjax' => FALSE
            )
        )
    ),
    /** Shop settings */
    array(
        'link' => '',
        'text' => lang('Settings', 'admin', FALSE),
        'icon' => 'icon-cog',
        'subMenu' => array(
            array(
                'link' => '/admin/settings',
                'text' => lang('Global settings', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'settings',
                'text' => lang('Shop settings', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/components/cp/template_manager',
                'text' => lang('Managing design', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/languages',
                'text' => lang('Languages', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),           
            array(
                'link' => $ADMIN_URL . 'currencies',
                'text' => lang('Currencies', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'deliverymethods/index',
                'text' => lang('Delivery methods (shipping)', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'paymentmethods/index',
                'text' => lang('Payment methods', 'admin', FALSE),
            ),
            array(
                'link' => '/admin/widgets_manager',
                'text' => lang('Widgets', 'admin', FALSE),
            ),
            array(
                'link' => $ADMIN_URL . 'customfields',
                'text' => lang('Custom fields', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),    
            array(
                'link' => '/admin/admin_logs',
                'text' => lang('Events journal', 'admin', FALSE),
            ),
            array(
                'divider' => true
            ),
            array(
                'id' => 'clearAllCache',
                'pjax' => FALSE,
                'text' => lang('Clear cache', 'admin', FALSE),
            ),
        )
    )  
);

if (preg_match('/Pro/', IMAGECMS_NUMBER)) {
    unset($shopMenu[6]);
}

