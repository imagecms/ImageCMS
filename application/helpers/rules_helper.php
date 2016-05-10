<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


if (!function_exists('admin_or_redirect')) {

    /**
     * @return bool
     */
    function admin_or_redirect() {
        if (PHP_SAPI == 'cli') {
            return true;
        }
        $ci = & get_instance();

        if (!$ci->dx_auth->is_logged_in()) {
            if ($ci->input->is_ajax_request()) {
                redirect('admin/login', '');
            } else {
                redirect('admin/login', '');
            }
            exit;
        }

        if ($ci->dx_auth->is_admin()) {
            return true;
        } else {
            if ($ci->input->is_ajax_request()) {
                redirect('admin/login', '');
            } else {
                redirect('admin/login', '');
            }
            exit;
        }
    }

}

// Check user access to control panel page
if (!function_exists('cp_check_perm')) {

    /**
     * @param string $perm
     * @return bool
     */
    function cp_check_perm($perm) {
        $ci = & get_instance();

        if ($ci->dx_auth->is_logged_in()) {
            if ($ci->dx_auth->get_permission_value($perm)) {
                return TRUE;
            } else {
                $perms = get_permissions_array();

                if (isset($perms[$perm])) {
                    $err_text = lang('No rights for', 'admin') . ': <b>' . $perms[$perm] . '</b>.';

                    echo '<script type="text/javascript">
							$(\'page\').set(\'html\',\'<div id="notice" style="width: 500px;">' . $err_text . '</div>\');
						</script>';
                } else {
                    return TRUE;
                }

                die();
            }
        } else {
            die(lang('Error checking permissions', 'admin'));
        }
    }

}

// Check if user permission
if (!function_exists('check_perm')) {

    /**
     * @param string $perm
     * @return bool
     */
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

    /**
     * @return array
     */
    function get_perms_groups() {
        $group_names = [
                        'cp'          => lang('Operation panel', 'admin'),
                        'lang'        => lang('Languages', 'admin'),
                        'cache'       => lang('Cache', 'admin'),
                        'page'        => lang('Pages', 'admin'),
                        'category'    => lang('Categories', 'admin'),
                        'module'      => lang('Modules', 'admin'),
                        'widget'      => lang('Widgets', 'admin'),
                        'menu'        => lang('Menu', 'admin'),
                        'user'        => lang('Members', 'admin'),
                        'roles'       => lang('Group', 'admin'),
                        'logs'        => lang('Logs', 'admin'),
                        'backup'      => lang('Backup copying', 'admin'),
                        'tinybrowser' => lang('File Editor', 'admin'),
                       ];

        ($hook = get_hook('on_get_perms_groups')) ? eval($hook) : NULL;

        return $group_names;
    }

}

if (!function_exists('get_permissions_array')) {

    /**
     * @return array
     */
    function get_permissions_array() {
        $all_perms = [
                      'cp_access'              => lang('Access Control Panel', 'admin'),
                      'cp_autoupdate'          => lang('System update', 'admin'),
                      'cp_page_search'         => lang('Find pages in the control panel', 'admin'),
                      'lang_create'            => lang('Creating a language', 'admin'),
                      'lang_edit'              => lang('Changing the language', 'admin'),
                      'lang_delete'            => lang('Remove languages', 'admin'),
                      'cp_site_settings'       => lang('Changing site settings', 'admin'),
                      'cache_clear'            => lang('Clearing the cache', 'admin'),
                      'page_create'            => lang('Creating pages', 'admin'),
                      'page_edit'              => lang('Editing pages', 'admin'),
                      'page_delete'            => lang('Delete pages', 'admin'),
                      'category_create'        => lang('Creating categories', 'admin'),
                      'category_edit'          => lang('Edit Categories', 'admin'),
                      'category_delete'        => lang('Category delete', 'admin'),
                      'module_install'         => lang('Install Modules', 'admin'),
                      'module_deinstall'       => lang('Removing Modules', 'admin'),
                      'module_admin'           => lang('Administration module', 'admin'),
                      'widget_create'          => lang('Creating widgets', 'admin'),
                      'widget_delete'          => lang('Removing widgets', 'admin'),
                      'widget_access_settings' => lang('Access to the widget settings', 'admin'),
                      'menu_create'            => lang('Create a menu', 'admin'),
                      'menu_edit'              => lang('Edit menu', 'admin'),
                      'menu_delete'            => lang('Menu deleting', 'admin'),
                      'user_create'            => lang('Create users of their group', 'admin'),
                      'user_create_all_roles'  => lang('Create users of all groups', 'admin'),
                      'user_edit'              => lang('Edit Users', 'admin'),
                      'user_delete'            => lang('Remove Users', 'admin'),
                      'user_view_data'         => lang('Viewing member', 'admin'),
                      'roles_create'           => lang('Creating Groups', 'admin'),
                      'roles_edit'             => lang('Editing Groups', 'admin'),
                      'roles_delete'           => lang('Deleting Groups', 'admin'),
                      'logs_view'              => lang('View Log', 'admin'),
                      'backup_create'          => lang('Backing up', 'admin'),
                      'tinybrowser_all'        => lang('Access to the file editor', 'admin'),
                      'tinybrowser_upload'     => lang('Download files', 'admin'),
                      'tinybrowser_edit'       => lang('Editing Files', 'admin'),
                      'tinybrowser_folders'    => lang('Edit Folders', 'admin'),
                     ];

        ($hook = get_hook('get_permissions_array')) ? eval($hook) : NULL;

        return $all_perms;
    }

}