<?php
/**
 * Menu options for Pro and Premium
 * Date: 07.03.13
 * Time: 15:11
 */
if (!$ADMIN_URL) $ADMIN_URL = '/admin/components/run/shop/';

$baseMenu = array(
    array(
        'link'      => '/admin/dashboard',
        'text'      => 'Dashboard',
        'class'     => 'homeAnchor',
        'icon'      => 'icon-home'
    ),
    array(
        'link'      => '',
        'text'      => 'Content',
        'icon'      => 'icon-align-justify',
        'subMenu'   => array(
            array(
                'link'      => '/admin/pages',
                'text'      => 'Create page',
            ),
            array(
                'link'      => '/admin/pages/GetPagesByCategory',
                'text'      => 'Articles list',
            ),
            array(
                'divider'   => true
            ),
            array(
                'header'    => true,
                'text'      => 'Custom fields constructor',
            ),
            array(
                'link'      => '/admin/components/cp/cfcm/index#additional_fields',
                'text'      => 'Fields list',
            ),
            array(
                'link'      => '/admin/components/cp/cfcm/index#fields_groups',
                'text'      => 'Group\'s list ',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Categories',
        'icon'      => 'icon-list',
        'subMenu'   => array(
            array(
                'link'      => '/admin/categories/create_form',
                'text'      => 'Create new',
            ),
            array(
                'link'      => '/admin/categories/cat_list',
                'text'      => 'Categories list',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Menu',
        'icon'      => 'icon-list-alt',
        'subMenu'   => array(
            array(
                'menusList'   => true
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Modules',
        'icon'      => 'icon-circle-arrow-down',
        'subMenu'   => array(
            array(
                'link'      => '/admin/components/modules_table',
                'text'      => 'All modules',
            ),
            array(
                'divider'   => true
            ),
            array(
                'modulesList'   => true
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Widgets',
        'icon'      => 'icon-th',
        'subMenu'   => array(
            array(
                'link'      => '/admin/widgets_manager/create_tpl',
                'text'      => 'Create widget',
            ),
            array(
                'link'      => '/admin/widgets_manager',
                'text'      => 'Widgets list',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'System',
        'icon'      => 'icon-hdd',
        'subMenu'   => array(
            array(
                'link'      => '/admin/settings',
                'text'      => 'Global settings',
            ),
            array(
                'link'      => '/admin/components/cp/template_editor',
                'text'      => 'Template editor',
            ),
            array(
                'link'      => '/admin/languages',
                'text'      => 'Language settings',
            ),
            array(
                'link'      => '/admin/cache_all',
                'text'      => 'Cache',
            ),
            array(
                'divider'   => true
            ),
            array(
                'link'      => '/admin/admin_logs',
                'text'      => 'Events journal',
            ),
            array(
                'link'      => '/admin/backup',
                'text'      => 'Site backup',
            ),
            array(
                'link'      => '/admin/rbac/roleList',
                'text'      => 'User-roles management',
            ),
        )
    )
);

$shopMenu = array(
    array(
        'link'      => $ADMIN_URL.'dashboard',
        'text'      => 'Shop dashboard',
        'icon'      => 'icon-home'

    ),
    array(
        'link'      => '',
        'text'      => 'Orders',
        'icon'      => 'icon-shopping-cart',
        'subMenu'   => array(
            array(
                'header'    => true,
                'text'      => 'Orders',
            ),
            array(
                'link'      => $ADMIN_URL.'orders/index',
                'text'      => 'Orders list',
            ),
            array(
                'link'      => $ADMIN_URL.'orderstatuses',
                'text'      => 'Order statuses',
            ),
            array(
                'header'    => true,
                'text'      => 'Callbacks',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks',
                'text'      => 'Callbacks list',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks/statuses',
                'text'      => 'Callback statuses',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks/themes',
                'text'      => 'Callback themes',
            ),
            array(
                'header'    => true,
                'text'      => 'Notifications',
            ),
            array(
                'link'      => $ADMIN_URL.'notifications',
                'text'      => 'Notifications list',
            ),
            array(
                'link'      => $ADMIN_URL.'notificationstatuses/index',
                'text'      => 'Notification statuses',
            ),
            array(
                'header'    => true,
                'text'      => 'Other',
            ),
            array(
                'link'      => '/admin/components/cp/comments',
                'text'      => 'Comments',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Products catalogue',
        'icon'      => 'icon-list-alt',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'categories/index',
                'text'      => 'Product categories',
            ),
            array(
                'link'      => $ADMIN_URL.'search/index',
                'text'      => 'Products list',
            ),
            array(
                'link'      => $ADMIN_URL.'properties/index',
                'text'      => 'Products properties',
            ),
            array(
                'link'      => $ADMIN_URL.'kits/index',
                'text'      => 'Produkts kits',
            ),
            array(
                'link'      => $ADMIN_URL.'search/index?WithoutImages=1',
                'text'      => 'Products without images',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Users management',
        'icon'      => 'icon-user',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'users/index',
                'text'      => 'List of users',
            ),
            array(
                'link'      => '/admin/rbac/roleList',
                'text'      => 'RBAC control',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Components',
        'icon'      => 'icon-briefcase',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'brands/index',
                'text'      => 'Brands',
            ),
            array(
                'link'      => $ADMIN_URL.'warehouses/index',
                'text'      => 'Stocks',
            ),
            array(
                'link'      => $ADMIN_URL.'banners/index',
                'text'      => 'Banners',
            ),
            array(
                'link'      => $ADMIN_URL.'discounts/index',
                'text'      => 'Regular discounts',
            ),
            array(
                'link'      => $ADMIN_URL.'comulativ/index',
                'text'      => 'Comulative discounts',
            ),
            array(
                'link'      => $ADMIN_URL.'gifts',
                'text'      => 'Gift certificates',
            ),
            array(
                'link'      => $ADMIN_URL.'customfields',
                'text'      => 'Custom fields',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Statistics',
        'icon'      => 'icon-statistic',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'charts/brands',
                'text'      => 'Brands',
            ),
            array(
                'link'      => $ADMIN_URL.'charts/orders',
                'text'      => 'Orders',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Shop settings',
        'icon'      => 'icon-cog',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'settings',
                'text'      => 'Global settings',
            ),
            array(
                'link'      => $ADMIN_URL.'currencies',
                'text'      => 'Currencies',
            ),
            array(
                'link'      => $ADMIN_URL.'deliverymethods/index',
                'text'      => 'Delivery methods (shipping)',
            ),
            array(
                'link'      => $ADMIN_URL.'paymentmethods/index',
                'text'      => 'Payment methods',
            ),
            array(
                'link'      => $ADMIN_URL.'system/import',
                'text'      => 'Automation',
            ),
        )
    )
);


if (preg_match('/Pro/', IMAGECMS_NUMBER))
{
    unset($shopMenu[5]);
}

