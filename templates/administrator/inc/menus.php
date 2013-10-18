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
        'text' => lang('Dashboard', 'admin'),
        'class' => 'homeAnchor',
        'icon' => 'icon-home'
    ),
    array(
        'link' => '',
        'text' => lang('Content', 'admin'),
        'icon' => 'icon-align-justify',
        'subMenu' => array(
            array(
                'link' => '/admin/pages',
                'text' => lang('Create page', 'admin'),
            ),
            array(
                'link' => '/admin/pages/GetPagesByCategory',
                'text' => lang('Articles list', 'admin'),
            ),
            array(
                'divider' => true
            ),
            array(
                'header' => true,
                'text' => lang('Custom fields constructor', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#additional_fields',
                'text' => lang('Fields list', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#fields_groups',
                'text' => lang("Group's list ", 'admin'),
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Categories', 'admin'),
        'icon' => 'icon-list',
        'subMenu' => array(
            array(
                'link' => '/admin/categories/create_form',
                'text' => lang('Create new', 'admin'),
            ),
            array(
                'link' => '/admin/categories/cat_list',
                'text' => lang('Categories list', 'admin'),
            )
        )
    ),
    array(
        'link' => '',
        'text' => lang('Menu', 'admin'),
        'icon' => 'icon-list-alt',
        'subMenu' => array(
            array(
                'menusList' => true
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Modules', 'admin'),
        'icon' => 'icon-circle-arrow-down',
        'subMenu' => array(
            array(
                'link' => '/admin/components/modules_table',
                'text' => lang('All modules', 'admin'),
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
        'text' => lang('Widgets', 'admin'),
        'icon' => 'icon-th',
        'subMenu' => array(
            array(
                'link' => '/admin/widgets_manager/create_tpl',
                'text' => lang('Create widget', 'admin'),
            ),
            array(
                'link' => '/admin/widgets_manager',
                'text' => lang('Widgets list', 'admin'),
            )
        )
    ),
    array(
        'link' => '',
        'text' => lang('System', 'admin'),
        'icon' => 'icon-hdd',
        'subMenu' => array(
            array(
                'link' => '/admin/settings',
                'text' => lang('Global settings', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/template_editor',
                'text' => lang('Template editor', 'admin'),
            ),
            array(
                'link' => '/admin/languages',
                'text' => lang('Languages', 'admin'),
            ),
            array(
                'link' => '/admin/cache_all',
                'text' => lang('Cache', 'admin'),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/admin_logs',
                'text' => lang('Events journal', 'admin'),
            ),
            array(
                'link' => '/admin/backup',
                'text' => lang('Backup', 'admin'),
            ),
            array(
                'link' => '/admin/rbac/roleList',
                'text' => lang('Roles list', 'admin'),
            ),
        )
    )
);

$shopMenu = array(
    array(
        'link' => $ADMIN_URL . 'dashboard',
        'text' => lang('Shop dashboard', 'admin'),
        'icon' => 'icon-home'
    ),
    /** Orders * */
    array(
        'link' => '',
        'text' => lang('Orders', 'admin'),
        'icon' => 'icon-shopping-cart',
        'subMenu' => array(
            array(
                'header' => true,
                'text' => lang('Orders', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'orders/index',
                'text' => lang('Orders list', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'orderstatuses',
                'text' => lang('Order statuses', 'admin'),
            ),
            array(
                'header' => true,
                'text' => lang('Callbacks', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks',
                'text' => lang('Callbacks list', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks/statuses',
                'text' => lang('Callback statuses', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'callbacks/themes',
                'text' => lang('Callback themes', 'admin'),
            ),
            array(
                'header' => true,
                'text' => lang('Notifications', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'notifications',
                'text' => lang('Notifications list', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'notificationstatuses/index',
                'text' => lang('Notification statuses', 'admin'),
            ),
            array(
                'header' => true,
                'text' => lang('Other', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/comments',
                'text' => lang('Comments', 'admin'),
            ),
        )
    ),
    /** Products * */
    array(
        'link' => '',
        'text' => lang('Products catalogue', 'admin'),
        'icon' => 'icon-list-alt',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'categories/index',
                'text' => lang('Product categories', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'search/index',
                'text' => lang('Products list', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'properties/index',
                'text' => lang('Products properties', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'brands/index',
                'text' => lang('Brands', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'kits/index',
                'text' => lang('Produkts kits', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'search/index?WithoutImages=1',
                'text' => lang('Products without images', 'admin'),
            )
        )
    ),
    /** Users * */
    array(
        'link' => '',
        'text' => lang('Users management', 'admin'),
        'icon' => 'icon-user',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'users/index',
                'text' => lang('List of users', 'admin'),
            ),
            array(
                'link' => '/admin/rbac/roleList',
                'text' => lang('RBAC control', 'admin'),
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('Content', 'admin'),
        'icon' => 'icon-align-justify',
        'subMenu' => array(
            array(
                'header' => true,
                'text' => lang('Content', 'admin'),
            ),
            array(
                'link' => '/admin/pages',
                'text' => lang('Create page', 'admin'),
            ),
            array(
                'link' => '/admin/pages/GetPagesByCategory',
                'text' => lang('Articles list', 'admin'),
            ),
            array(
                'divider' => true
            ),
            array(
                'header' => true,
                'text' => lang('Categories', 'admin'),
            ),
             array(
                'link' => '/admin/categories/create_form',
                'text' => lang('Create new', 'admin'),
            ),
            array(
                'link' => '/admin/categories/cat_list',
                'text' => lang('Categories list', 'admin'),
            ),
            array(
                'divider' => true
            ),
            array(
                'header' => true,
                'text' => lang('Custom fields constructor', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#additional_fields',
                'text' => lang('Fields list', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/cfcm/index#fields_groups',
                'text' => lang("Group's list ", 'admin'),
            ),
        )
    ),
    /** Modules * */
    array(
        'link' => '',
        'text' => lang('Modules', 'admin'),
        'icon' => 'icon-circle-arrow-down',
        'subMenu' => array(
//            array(
//                'link'      => '/admin/components/modules_table',
//                'text'      => lang('All modules', 'admin'),
//            ),
//            array(
//                'divider'   => true
//            ),
            array(
                'modulesList' => true
            ),
        )
    ),
    /** Statistics * */
    array(
        'link' => '',
        'text' => lang('Statistics', 'admin'),
        'icon' => 'icon-statistic',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'charts/brands',
                'text' => lang('Brands', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'charts/orders',
                'text' => lang('Orders', 'admin'),
            )
        )
    ),
    /** Shop settings * */
    array(
        'link' => '',
        'text' => lang('Settings', 'admin'),
        'icon' => 'icon-cog',
        'subMenu' => array(
            array(
                'link' => $ADMIN_URL . 'settings',
                'text' => lang('Shop settings', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'currencies',
                'text' => lang('Currencies', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'deliverymethods/index',
                'text' => lang('Delivery methods (shipping)', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'paymentmethods/index',
                'text' => lang('Payment methods', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'system/import',
                'text' => lang('Import-Export CSV/XLS', 'admin'),
            ),
            array(
                'link' => '/admin/widgets_manager',
                'text' => lang('Widgets', 'admin'),
            ),
            array(
                'link' => $ADMIN_URL . 'customfields',
                'text' => lang('Custom fields', 'admin'),
            ),
        )
    ),
    array(
        'link' => '',
        'text' => lang('System', 'admin'),
        'icon' => 'icon-hdd',
        'subMenu' => array(
            array(
                'link' => '/admin/settings',
                'text' => lang('Global settings', 'admin'),
            ),
            array(
                'link' => '/admin/components/cp/template_editor',
                'text' => lang('Template editor', 'admin'),
            ),
            array(
                'link' => '/admin/languages',
                'text' => lang('Languages', 'admin'),
            ),
            array(
                'link' => '/admin/cache_all',
                'text' => lang('Cache', 'admin'),
            ),
            array(
                'divider' => true
            ),
            array(
                'link' => '/admin/admin_logs',
                'text' => lang('Events journal', 'admin'),
            ),
            array(
                'link' => '/admin/backup',
                'text' => lang('Backup', 'admin'),
            ),
            array(
                'link' => '/admin/rbac/roleList',
                'text' => lang('Roles list', 'admin'),
            ),
             array(
                'divider' => true
            ),
            array(
                'link' => '/admin/sys_update',
                'text' => lang('System update', 'admin'),
            ),
            array(
                'link' => '/admin/sys_info',
                'text' => lang('System information', 'admin'),
            ),
        )
    )
);

if (preg_match('/Pro/', IMAGECMS_NUMBER)) {
    unset($shopMenu[6]);
}

