<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Components Class
 */
class Components extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
    }

    function index() {
        $this->modules_table();
    }

    function modules_table() {
        $not_installed = array();

        $fs_modules = $this->find_components();
        $db_modules = $this->db->order_by('position', 'asc')->get('components')->result_array();

        // Find not installed modules
        $count = count($fs_modules);
        for ($i = 0; $i < $count; $i++) {
            if ($this->is_installed($fs_modules[$i]['com_name']) == 0) {
                $info = $this->get_module_info($fs_modules[$i]['com_name']);

                $fs_modules[$i]['name'] = $info['menu_name'];
                $fs_modules[$i]['version'] = $info['version'];
                $fs_modules[$i]['description'] = $info['description'];

                array_push($not_installed, $fs_modules[$i]);
            }
        }

        // process modules info
        $count = count($db_modules);
        for ($i = 0; $i < $count; $i++) {
            $info = $this->get_module_info($db_modules[$i]['name']);

            $db_modules[$i]['menu_name'] = $info['menu_name'];
            $db_modules[$i]['version'] = $info['version'];
            $db_modules[$i]['description'] = $info['description'];
            $db_modules[$i]['identif'] = $db_modules[$i]['identif'];

            if (file_exists(APPPATH . 'modules/' . $db_modules[$i]['name'] . '/admin.php')) {
                $db_modules[$i]['admin_file'] = 1;
            } else {
                $db_modules[$i]['admin_file'] = 0;
            }
        }


        $this->template->assign('installed', $db_modules);
        $this->template->assign('not_installed', $not_installed);
        $this->template->show('module_table', FALSE);
    }

    function is_installed($mod_name) {
        return $this->db->get_where('components', array('name' => $mod_name), 1)->num_rows();
    }

    function install($module = '') {
        cp_check_perm('module_install');
        $module = strtolower($module);

        ($hook = get_hook('admin_install_module')) ? eval($hook) : NULL;

        if (file_exists(APPPATH . 'modules/' . $module . '/' . $module . '.php') AND $this->is_installed($module) == 0) {
            // Make module install
            $data = array(
                'name' => $module,
                'identif' => $module
            );

            $this->db->insert('components', $data);

            $this->load->module($module);

            if (method_exists($module, '_install') === TRUE) {
                $this->$module->_install();
            }

            // Update hooks
            $this->load->library('cms_hooks');
            $this->cms_hooks->build_hooks();

            $this->lib_admin->log(lang('ac_istall') . $data['name']);

            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $result = true;
                echo json_encode(array('result' => $result));
            } else {
                return TRUE;
            }
        } else {
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $result = true;
                echo json_encode(array('result' => $result));
            } else {
                return FALSE;
            }
        }
    }

    function deinstall() {
        cp_check_perm('module_deinstall');
        $modules = $_POST['ids'];
        foreach ($modules as $module) {
            $module = strtolower($module);

            ($hook = get_hook('admin_deinstall_module')) ? eval($hook) : NULL;

            if (file_exists(APPPATH . 'modules/' . $module . '/' . $module . '.php') AND $this->is_installed($module) == 1) {
                $this->load->module($module);

                if (method_exists($module, '_deinstall') === TRUE) {
                    $this->$module->_deinstall();
                }

                $this->db->limit(1);
                $this->db->delete('components', array('name' => $module));
                $this->lib_admin->log(lang('ac_deinstall') . $module);
                showMessage('Модуль успешно деинсталирован');
                pjax('/admin/components/modules_table');
            } else {
                showMessage(lang('ac_deinstall_error'), false, 'r');
                pjax('/admin/components/modules_table');
            }

            // Update hooks
            $this->load->library('cms_hooks');
            $this->cms_hooks->build_hooks();
        }
    }

    function find_components($in_menu = FALSE) {
        $components = array();
        if ($in_menu == TRUE) {
            $this->db->where('in_menu', 1);
        }
        $installed = $this->db->get('components')->result_array();

        if ($com_path = opendir(APPPATH . 'modules/')) {
            while (false !== ($file = readdir($com_path))) {
                if ($file != "." && $file != ".." && $file != "index.html" && !is_file($file)) {
                    $info_file = APPPATH . 'modules/' . $file . '/module_info.php';
                    $com_file_admin = APPPATH . 'modules/' . $file . '/admin.php';

                    if (file_exists($info_file)) {
                        include ($info_file);

                        if (file_exists($com_file_admin))
                            $admin_file = 1;
                        else
                            $admin_file = 0;

                        $ins = FALSE;

                        foreach ($installed as $k) {
                            if ($k['name'] == $file) {
                                $ins = TRUE;
                            }
                        }

                        $new_com = array(
                            'menu_name' => $com_info['menu_name'],
                            'com_name' => $file,
                            'admin_file' => $admin_file,
                            'installed' => $ins
                        );

                        array_push($components, $new_com);
                    }
                }
            }
            closedir($com_path);
        }

        return $components;
    }

    function component_settings($component) {
        cp_check_perm('module_admin');

        $this->db->where('name', $component);
        $query = $this->db->get('components', 1);

        if ($query->num_rows() == 1) {
            $com = $query->row_array();
            $this->template->add_array($com);
        } else {
            $this->template->assign('com_name', $component);
            $this->template->assign('identif', $component);
            $this->template->assign('status', 0);
        }

        $this->template->show('component_settings', FALSE);
    }

    // Save component settings
    function save_settings($component) {
        cp_check_perm('module_admin');

        $this->db->where('name', $component);
        $query = $this->db->get('components', 1);

        $com = $query->row_array();

        ($hook = get_hook('admin_component_save_settings')) ? eval($hook) : NULL;

        if ($query->num_rows() >= 1) {
            $data = array(
                'enabled' => (int) $this->input->post('status'),
                //'identif' => $this->input->post('identif'),
                'identif' => $com['name'],
                'autoload' => (int) $this->input->post('autoload'),
                'in_menu' => (int) $this->input->post('in_menu')
            );

            $this->db->where('name', $component);
            $this->db->update('components', $data);

            $this->lib_admin->log(lang('ac_module_sett_changed') . $com['name']);

            //showMessage('Настройки сохранены');
        } else {
            // Error, module not found
        }

        jsCode("ajax_div('modules_table',base_url + 'admin/components/modules_table/');");
    }

    // Load component admin class in iframe/xhr
    function init_window($module) {
        // buildWindow($id,$title,$contentURL,$width,$height,$method = 'iframe')
        //$module = $this->input->post('component');
        $info_file = realpath(APPPATH . 'modules/' . $module) . '/module_info.php';

        if (file_exists($info_file)) {
            include_once ($info_file);

            switch ($com_info['admin_type']) {
                case 'window':
                    //buildWindow($module . '_window', 'Модуль: ' . $com_info['menu_name'], site_url('admin/components/cp/' . $module), $com_info['w'], $com_info['h'], $com_info['window_type']);
                    //pjax('/admin/components/cp/'.$module, '.row-fluid');
                    $this->cp($module);
                    break;

                case 'inside':
                    //pjax('/admin/components/cp/'.$module, '.row-fluid');
                    $this->cp($module);
                    //updateDiv('page', site_url('admin/components/cp/' . $module));
                    break;
            }
        }
    }

    function cp($module) {
        $func = $this->uri->segment(5);
        if ($func == FALSE)
            $func = 'index';

        //($hook = get_hook('admin_run_module_panel')) ? eval($hook) : NULL;

        $this->load->module('core/core');
        $args = $this->core->grab_variables(6);

        $this->template->assign('SELF_URL', site_url('admin/components/cp/' . $module));

        //echo '<div id="' . $module . '_module_block">' . modules::run($module . '/admin/' . $func, $args) . '</div>';
        echo modules::run($module . '/admin/' . $func, $args);

        //ajax_links($module);
    }

    /**
     * Run module
     */
//    function show_module($module){
//        $func = $this->uri->segment(5);
//        if ($func == FALSE)
//            $func = 'index';
//
//        //($hook = get_hook('admin_run_module_panel')) ? eval($hook) : NULL;
//
//        $this->load->module('core/core');
//        $args = $this->core->grab_variables(6);
//
//        $this->template->assign('SELF_URL', site_url('admin/components/cp/' . $module));
//        echo modules::run($module . '/admin/' . $func, $args);
//        pjax('/application/modules/'.$module.'/admin');
//    }

    function run($module) {
        $func = $this->uri->segment(5);
        if ($func == FALSE)
            $func = 'index';

        ($hook = get_hook('admin_run_module_admin')) ? eval($hook) : NULL;

        $this->load->module('core/core');
        $args = $this->core->grab_variables(6);

        $this->template->assign('SELF_URL', site_url('admin/components/cp/' . $module));

        echo modules::run($module . '/admin/' . $func, $args);
    }

    function com_info() {
        $com_info = $this->get_module_info($this->input->post('component'));

        if ($com_info != FALSE) {
            $info_text = '<h1>' . $com_info['menu_name'] . '</h1><p>' . $com_info['description'] . '</p><p><b>' . lang('ac_author') . '</b> ' . $com_info['author'] . '<br/><b>' . lang('ac_version') . '</b> ' . $com_info['version'] . '</p>';

            jsCode("alertBox.info('" . $info_text . "');");
        } else {
            showMessage(lang('ac_cant_load_module_into_file'), false . 'r');
        }
    }

    function get_module_info($mod_name) {
        ($hook = get_hook('admin_get_module_info')) ? eval($hook) : NULL;

        $info_file = realpath(APPPATH . 'modules/' . $mod_name) . '/module_info.php';
        if (file_exists($info_file)) {
            include ($info_file);
            return $com_info;
        } else {
            return FALSE;
        }
    }

    function change_autoload() {
        if (isset($_POST['mid'])) {
            $mid = $_POST['mid'];
            $row = $this->db->where('id', $mid)->get('components')->row();
            if (count($row) > 0) {
                $autoload = $row->autoload;
                if ($autoload)
                    $autoload = 0;
                else
                    $autoload = 1;
                $this->db->where('id', $mid)->set('autoload', $autoload)->update('components');
                $row->autoload = $autoload;
                echo json_encode(array('result' => $row));
            }else {
                $result = false;
                echo json_encode(array('result' => $result));
            }
        }
    }

    function change_url_access() {
        if (isset($_POST['mid'])) {
            $mid = $_POST['mid'];
            $row = $this->db->where('id', $mid)->get('components')->row();
            if (count($row) > 0) {
                $enabled = $row->enabled;
                if ($enabled)
                    $enabled = 0;
                else
                    $enabled = 1;
                $this->db->where('id', $mid)->set('enabled', $enabled)->update('components');
                $row->enabled = $enabled;
                echo json_encode(array('result' => $row));
            }else {
                $result = false;
                echo json_encode(array('result' => $result));
            }
        }
    }

    function save_components_positions() {
        $positions = $this->input->post('positions');
        if (is_array($positions)) {
            foreach ($positions as $key => $value) {
                if ($this->db->where('name', $value)->set('position', $key)->update('components')) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
            if ($result)
                showMessage(lang('a_positions_updated'));
            else
                showMessage(lang('a_fail'));
        }
    }

    function change_show_in_menu() {
        $id = $this->input->post('id');
        $row = $this->db->where('id', (int) $id)->get('components')->row();
        if (count($row) > 0) {
            $in_menu = $row->in_menu;
            if ($in_menu == 1)
                $in_menu = 0;
            else
                $in_menu = 1;
            if ($this->db->where('id', (int) $id)->set('in_menu', $in_menu)->update('components')) {
                showMessage(lang('a_changes_saved'));
            }
        }
    }

}

/* End of components.php */
