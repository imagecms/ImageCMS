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
        'text'      => 'Главная',
        'class'     => 'homeAnchor',
        'icon'      => 'icon-home'
    ),
    array(
        'link'      => '',
        'text'      => 'a_cont',
        'icon'      => 'icon-align-justify',
        'subMenu'   => array(
            array(
                'link'      => '/admin/pages/GetPagesByCategory',
                'text'      => 'a_cont_list',
            ),
            array(
                'link'      => '/admin/pages',
                'text'      => 'a_create_page',
            ),
            array(
                'divider'   => true
            ),
            array(
                'header'    => true,
                'text'      => 'a_field_constructor',
            ),
            array(
                'link'      => '/admin/components/cp/cfcm/index#additional_fields',
                'text'      => 'Список полей',
            ),
            array(
                'link'      => '/admin/components/cp/cfcm/index#fields_groups',
                'text'      => 'Список групп',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'Категории',
        'icon'      => 'icon-list',
        'subMenu'   => array(
            array(
                'link'      => '/admin/categories/create_form',
                'text'      => 'a_create',
            ),
            array(
                'link'      => '/admin/categories/cat_list',
                'text'      => 'a_edit',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_menu',
        'icon'      => 'icon-list-alt',
        'subMenu'   => array(
            array(
                'menusList'   => true
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_modules',
        'icon'      => 'icon-circle-arrow-down',
        'subMenu'   => array(
            array(
                'link'      => '/admin/components/modules_table',
                'text'      => 'a_all_modules',
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
        'text'      => 'a_widgets',
        'icon'      => 'icon-th',
        'subMenu'   => array(
            array(
                'link'      => '/admin/widgets_manager/create_tpl',
                'text'      => 'a_create',
            ),
            array(
                'link'      => '/admin/widgets_manager',
                'text'      => 'a_edit',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_system',
        'icon'      => 'icon-hdd',
        'subMenu'   => array(
            array(
                'link'      => '/admin/settings',
                'text'      => 'a_sett_global_sett_menu',
            ),
            array(
                'link'      => '/admin/components/cp/template_editor',
                'text'      => 'Редактор шаблонов',
            ),
            array(
                'link'      => '/admin/languages',
                'text'      => 'a_languages',
            ),
            array(
                'link'      => '/admin/cache_all',
                'text'      => 'a_cache',
            ),
            array(
                'divider'   => true
            ),
            array(
                'link'      => '/admin/admin_logs',
                'text'      => 'a_event_journal',
            ),
            array(
                'link'      => '/admin/backup',
                'text'      => 'a_backup_copy',
            ),
            array(
                'link'      => '/admin/rbac/roleList',
                'text'      => 'Список ролей',
            ),
        )
    )
);

$shopMenu = array(
    array(
        'link'      => $ADMIN_URL.'dashboard',
        'text'      => 'Главная',
        'icon'      => 'icon-home'

    ),
    array(
        'link'      => '',
        'text'      => 'a_orders',
        'icon'      => 'icon-shopping-cart',
        'subMenu'   => array(
            array(
                'header'    => true,
                'text'      => 'a_orders',
            ),
            array(
                'link'      => $ADMIN_URL.'orders/index',
                'text'      => 'a_orders_all',
            ),
            array(
                'link'      => $ADMIN_URL.'orderstatuses',
                'text'      => 'a_orderstatuses',
            ),
            array(
                'header'    => true,
                'text'      => 'a_callbacks',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks',
                'text'      => 'a_callbacks',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks/statuses',
                'text'      => 'a_callbacks_statuses',
            ),
            array(
                'link'      => $ADMIN_URL.'callbacks/themes',
                'text'      => 'a_callbacks_themes',
            ),
            array(
                'header'    => true,
                'text'      => 'a_notifications',
            ),
            array(
                'link'      => $ADMIN_URL.'notifications',
                'text'      => 'a_notifications',
            ),
            array(
                'link'      => $ADMIN_URL.'notificationstatuses/index',
                'text'      => 'a_notificationstatuses',
            ),
            array(
                'header'    => true,
                'text'      => 'a_others',
            ),
            array(
                'link'      => '/admin/components/cp/comments',
                'text'      => 'a_comments',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_products_catalog',
        'icon'      => 'icon-list-alt',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'categories/index',
                'text'      => 'a_categories_m',
            ),
            array(
                'link'      => $ADMIN_URL.'search/index',
                'text'      => 'a_products',
            ),
            array(
                'link'      => $ADMIN_URL.'properties/index',
                'text'      => 'a_products_properties',
            ),
            array(
                'link'      => $ADMIN_URL.'kits/index',
                'text'      => 'a_shop_kits',
            ),
            array(
                'link'      => $ADMIN_URL.'search/index?WithoutImages=1',
                'text'      => 'a_products_without_images',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_users',
        'icon'      => 'icon-user',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'users/index',
                'text'      => 'a_users_list',
            ),
            array(
                'link'      => '/admin/rbac/roleList',
                'text'      => 'a_rbac_control',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_components',
        'icon'      => 'icon-briefcase',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'brands/index',
                'text'      => 'a_brands',
            ),
            array(
                'link'      => $ADMIN_URL.'warehouses/index',
                'text'      => 'a_stocks',
            ),
            array(
                'link'      => $ADMIN_URL.'banners/index',
                'text'      => 'a_banners',
            ),
            array(
                'link'      => $ADMIN_URL.'discounts/index',
                'text'      => 'a_reg_discount_sh',
            ),
            array(
                'link'      => $ADMIN_URL.'comulativ/index',
                'text'      => 'a_comulative_discounts',
            ),
            array(
                'link'      => $ADMIN_URL.'gifts',
                'text'      => 'a_gift_certs',
            ),
            array(
                'link'      => $ADMIN_URL.'customfields',
                'text'      => 'a_customfields',
            ),
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_statistics',
        'icon'      => 'icon-statistic',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'charts/brands',
                'text'      => 'a_brands',
            ),
            array(
                'link'      => $ADMIN_URL.'charts/orders',
                'text'      => 'a_orders',
            )
        )
    ),
    array(
        'link'      => '',
        'text'      => 'a_settings',
        'icon'      => 'icon-cog',
        'subMenu'   => array(
            array(
                'link'      => $ADMIN_URL.'settings',
                'text'      => 'a_global_settings',
            ),
            array(
                'link'      => $ADMIN_URL.'currencies',
                'text'      => 'a_currencies',
            ),
            array(
                'link'      => $ADMIN_URL.'deliverymethods/index',
                'text'      => 'a_deliverymethods',
            ),
            array(
                'link'      => $ADMIN_URL.'paymentmethods/index',
                'text'      => 'a_paymentmethods',
            ),
            array(
                'link'      => $ADMIN_URL.'system/import',
                'text'      => 'a_automation',
            ),
        )
    )
);


if (preg_match('/Pro/', IMAGECMS_NUMBER))
{
    unset($shopMenu[5]);
}

