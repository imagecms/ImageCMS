<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('admin_or_redirect')) {

    function admin_or_redirect() {
        $ci = & get_instance();

        if (!$ci->dx_auth->is_logged_in()) {
            if ($ci->input->is_ajax_request())
                echo json_encode(array('success' => false, 'redirect' => '/admin/login'));
            else 
                redirect('admin/login', '');
            exit;
        }
        
        if($ci->dx_auth->is_admin())
            return true;
        else{
            if ($ci->input->is_ajax_request())
                echo json_encode(array('success' => false, 'redirect' => '/admin/login'));
            else
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
                    $err_text = lang("No rights for") . ': <b>' . $perms[$perm] . '</b>.';

                    echo '<script type="text/javascript">
							$(\'page\').set(\'html\',\'<div id="notice" style="width: 500px;">' . $err_text . '</div>\');
						</script>';
                } else {
                    return TRUE;
                }

                die();
            }
        } else {
            die(lang("Error checking permissions"));
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
            'cp' => lang("Operation panel"),
            'lang' => lang("Languages"),
            'cache' => lang("Cache"),
            'page' => lang("Pages"),
            'category' => lang("Categories"),
            'module' => lang("Modules"),
            'widget' => lang("Widgets"),
            'menu' => lang("Menu"),
            'user' => lang("Members"),
            'roles' => lang("Group"),
            'logs' => lang("Logs"),
            'backup' => lang("Backup copying"),
            'tinybrowser' => lang("File Editor"),
        );

        ($hook = get_hook('on_get_perms_groups')) ? eval($hook) : NULL;

        return $group_names;
    }

}

if (!function_exists('get_permissions_array')) {

    function get_permissions_array() {
        $all_perms = array(
            'cp_access' => lang("Access Control Panel"),
            'cp_autoupdate' => lang("System update"),
            'cp_page_search' => lang("Find pages in the control panel"),
            'lang_create' => lang("Creating a language"),
            'lang_edit' => lang("Changing the language"),
            'lang_delete' => lang("Remove languages"),
            'cp_site_settings' => lang("Changing site settings"),
            'cache_clear' => lang("Clearing the cache"),
            'page_create' => lang("Creating pages"),
            'page_edit' => lang("Editing pages"),
            'page_delete' => lang("Delete pages"),
            'category_create' => lang("Creating categories"),
            'category_edit' => lang("Edit Categories"),
            'category_delete' => lang("Category delete"),
            'module_install' => lang("Install Modules"),
            'module_deinstall' => lang("Removing Modules"),
            'module_admin' => lang("Administration module"),
            'widget_create' => lang("Creating widgets"),
            'widget_delete' => lang("Removing widgets"),
            'widget_access_settings' => lang("Access to the widget settings"),
            'menu_create' => lang("Create a menu"),
            'menu_edit' => lang("Edit menu"),
            'menu_delete' => lang("Menu deleting"),
            'user_create' => lang("Create users of their group"),
            'user_create_all_roles' => lang("Create users of all groups"),
            'user_edit' => lang("Edit Users"),
            'user_delete' => lang("Remove Users"),
            'user_view_data' => lang("Viewing member"),
            'roles_create' => lang("Creating Groups"),
            'roles_edit' => lang("Editing Groups"),
            'roles_delete' => lang("Deleting Groups"),
            'logs_view' => lang("View Log"),
            'backup_create' => lang("Backing up"),
            'tinybrowser_all' => lang("Access to the file editor"),
            'tinybrowser_upload' => lang("Download files"),
            'tinybrowser_edit' => lang("Editing Files"),
            'tinybrowser_folders' => lang("Edit Folders"),
        );

        ($hook = get_hook('get_permissions_array')) ? eval($hook) : NULL;

        return $all_perms;
    }

}
?>
