<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('admin_or_redirect')) {

    function admin_or_redirect() {
        $ci = & get_instance();

        if (!$ci->dx_auth->is_logged_in()) {
            redirect('admin/login', '');
            exit;
        }
        
        if($ci->dx_auth->is_admin())
            return true;
        else{
            redirect('admin/login', '');
            exit;
        }
    }

}

// Check user access to control panel page
if (!function_exists('cp_check_perm')) {

    function cp_check_perm($perm) {
        $ci = & get_instance();

        if ($ci->dx_auth->is_logged_in()) {
            if ($ci->dx_auth->get_permission_value($perm)) {
                return TRUE;
            } else {
                $perms = get_permissions_array();

                if (isset($perms[$perm])) {
                    $err_text = lang('a_acc_per_40') . ': <b>' . $perms[$perm] . '</b>.';

                    echo '<script type="text/javascript">
							$(\'page\').set(\'html\',\'<div id="notice" style="width: 500px;">' . $err_text . '</div>\');
						</script>';
                } else {
                    return TRUE;
                }

                die();
            }
        } else {
            die(lang('a_acc_per_41'));
        }
    }

}

// Check if user permission
if (!function_exists('check_perm')) {

    function check_perm($perm) {
        $ci = & get_instance();

        if ($ci->dx_auth->is_logged_in()) {
            if ($ci->dx_auth->get_permission_value($perm)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}


if (!function_exists('get_perms_groups')) {

    function get_perms_groups() {
        $group_names = array(
            'cp' => lang('a_controll_panel'),
            'lang' => lang('a_languages'),
            'cache' => lang('a_cache'),
            'page' => lang('a_pages'),
            'category' => lang('a_categories'),
            'module' => lang('a_modules'),
            'widget' => lang('a_widgets'),
            'menu' => lang('a_menu'),
            'user' => lang('a_acc_per_2'),
            'roles' => lang('a_acc_per_3'),
            'logs' => lang('a_acc_per_4'),
            'backup' => lang('a_backup_copy'),
            'tinybrowser' => lang('a_acc_per_5'),
        );

        ($hook = get_hook('on_get_perms_groups')) ? eval($hook) : NULL;

        return $group_names;
    }

}

if (!function_exists('get_permissions_array')) {

    function get_permissions_array() {
        $all_perms = array(
            'cp_access' => lang('a_acc_per_1'),
            'cp_autoupdate' => lang('a_sys_update'),
            'cp_page_search' => lang('a_acc_per_6'),
            'lang_create' => lang('a_acc_per_7'),
            'lang_edit' => lang('a_acc_per_8'),
            'lang_delete' => lang('a_acc_per_9'),
            'cp_site_settings' => lang('a_acc_per_10'),
            'cache_clear' => lang('a_acc_per_11'),
            'page_create' => lang('a_acc_per_12'),
            'page_edit' => lang('a_acc_per_13'),
            'page_delete' => lang('a_acc_per_14'),
            'category_create' => lang('a_acc_per_15'),
            'category_edit' => lang('a_acc_per_16'),
            'category_delete' => lang('a_acc_per_17'),
            'module_install' => lang('a_acc_per_18'),
            'module_deinstall' => lang('a_acc_per_19'),
            'module_admin' => lang('a_acc_per_20'),
            'widget_create' => lang('a_acc_per_21'),
            'widget_delete' => lang('a_acc_per_22'),
            'widget_access_settings' => lang('a_acc_per_23'),
            'menu_create' => lang('a_acc_per_24'),
            'menu_edit' => lang('a_acc_per_25'),
            'menu_delete' => lang('a_menu_delete'),
            'user_create' => lang('a_acc_per_26'),
            'user_create_all_roles' => lang('a_acc_per_27'),
            'user_edit' => lang('a_acc_per_28'),
            'user_delete' => lang('a_acc_per_29'),
            'user_view_data' => lang('a_acc_per_30'),
            'roles_create' => lang('a_acc_per_31'),
            'roles_edit' => lang('a_acc_per_32'),
            'roles_delete' => lang('a_acc_per_33'),
            'logs_view' => lang('a_acc_per_34'),
            'backup_create' => lang('a_acc_per_35'),
            'tinybrowser_all' => lang('a_acc_per_36'),
            'tinybrowser_upload' => lang('a_acc_per_37'),
            'tinybrowser_edit' => lang('a_acc_per_38'),
            'tinybrowser_folders' => lang('a_acc_per_39'),
        );

        ($hook = get_hook('get_permissions_array')) ? eval($hook) : NULL;

        return $all_perms;
    }

}
?>
