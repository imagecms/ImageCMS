<?php

use CMSFactory\Events;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * Components Class
 * @property Cms_hooks $cms_hooks
 * @property Lib_admin $lib_admin
 */
class Components extends BaseAdminController
{

    /**
     * array of installed modules
     * @var array
     */
    private $installed = [];

    /**
     * @var array
     */
    private $permited = [];

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');

        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
        $this->setInstalled();
        $this->setPermited();
    }

    public function index() {
        $this->modules_table();
    }

    public function modules_table() {
        $not_installed = [];

        $fs_modules = $this->find_components();
        $db_modules = $this->db->order_by('position', 'asc')->not_like('identif', 'payment_method_')->get('components')->result_array();

        // Find not installed modules
        $count = count($fs_modules);
        for ($i = 0; $i < $count; $i++) {
            if ($this->is_installed($fs_modules[$i]['com_name']) == 0) {
                $info = $this->get_module_info($fs_modules[$i]['com_name']);

                $fs_modules[$i]['name'] = $info['menu_name'];
                $fs_modules[$i]['version'] = $info['version'];
                $fs_modules[$i]['description'] = $info['description'];
                $fs_modules[$i]['icon_class'] = $info['icon_class'];

                array_push($not_installed, $fs_modules[$i]);
            }
        }

        // process modules info
        $count = count($db_modules);
        for ($i = 0; $i < $count; $i++) {
            $module_name = $db_modules[$i]['name'];
            if ($this->module_exists($module_name)) {

                $info = $this->get_module_info($module_name);
                $db_modules[$i]['menu_name'] = $info['menu_name'];
                $db_modules[$i]['version'] = $info['version'];
                $db_modules[$i]['description'] = $info['description'];
                $db_modules[$i]['icon_class'] = $info['icon_class'];
                $db_modules[$i]['identif'] = $db_modules[$i]['identif'];
                $modulePath = getModulePath($module_name);
                if (file_exists($modulePath . 'admin.php')) {
                    $db_modules[$i]['admin_file'] = 1;
                } else {
                    $db_modules[$i]['admin_file'] = 0;
                }
            } else {
                unset($db_modules[$i]);
            }
        }

        if (MAINSITE != '') {
            list($db_modules, $not_installed) = $this->isPermitedModules($db_modules, $not_installed);
        }

        Events::create()->registerEvent(
            [
             'installed'     => $db_modules,
             'not_installed' => $not_installed,
            ],
            'Components:modules_table'
        )->runFactory();

        $frozen_autoload = [
                            'template_manager',
                            'admin_menu',
                            'xbanners',
                            'menu',
                            'cmsemail',
                            'shop',
                           ];
        $frozen_delete = [
                          'template_manager',
                          'admin_menu',
                          'xbanners',
                          'menu',
                          'cmsemail',
                          'shop',
                          'mod_discount',
                          'auth',
                         ];

        $this->template->assign('frozen_autoload', $frozen_autoload);
        $this->template->assign('frozen_delete', $frozen_delete);
        $this->template->assign('installed', $db_modules);
        $this->template->assign('not_installed', $not_installed);
        $this->template->show('module_table', FALSE);
    }

    /**
     * @param string $moduleName
     * @return bool
     */
    private function isNotPermited($moduleName) {
        if (MAINSITE != '') {
            return !in_array($moduleName, $this->permited);
        } else {
            return FALSE;
        }
    }

    /**
     * @param array $db_modules
     * @param array $not_installed
     * @return array
     */
    private function isPermitedModules($db_modules, $not_installed) {
        foreach ($db_modules as $key => $db_module) {
            if ($this->isNotPermited($db_module['name'])) {
                unset($db_modules[$key]);
            }
        }
        foreach ($not_installed as $key => $db_module) {
            if ($this->isNotPermited($db_module['com_name'])) {
                unset($not_installed[$key]);
            }
        }
        return [
                $db_modules,
                $not_installed,
               ];
    }

    private function setInstalled() {
        $installed = $this->db->select('name')->get('components')->result_array();
        $this->installed = array_column($installed, 'name');
    }

    private function setPermited() {
        if (MAINSITE != '' and $this->load->module('mainsaas')) {
            $this->permited = $this->load->module('mainsaas')->getNotPermited();
            $this->permited = array_map('trim', $this->permited);
        }
    }

    /**
     * @param $mod_name
     * @return bool
     */
    public function is_installed($mod_name) {
        return in_array($mod_name, $this->installed);
    }

    public function install($module = '') {
        //cp_check_perm('module_install');

        $module = strtolower($module);

        ($hook = get_hook('admin_install_module')) ? eval($hook) : NULL;

        $modulePath = getModulePath($module);

        if (file_exists($modulePath . $module . '.php') AND $this->is_installed($module) === false) {
            // Make module install
            $data = [
                     'name'    => $module,
                     'identif' => $module,
                    ];

            $this->db->insert('components', $data);

            if ($this->db->_error_message()) {
                echo json_encode(['result' => false]);

                $this->lib_admin->log($this->db->_error_message() . ' ' . $data['name']);
                return false;
            }

            $this->load->module($module);

            if (method_exists($module, '_install') === TRUE) {
                $this->$module->_install();
            }

            // Update hooks
            $this->load->library('cms_hooks');
            $this->cms_hooks->build_hooks();

            $this->lib_admin->log(lang('Installed a module', 'admin') . ' ' . $data['name']);

            if ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest') {
                $result = true;
                echo json_encode(['result' => $result]);
            } else {
                return TRUE;
            }
        } else {
            if ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest') {
                $result = true;
                echo json_encode(['result' => $result]);
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @param string $moduleName
     * @return bool
     */
    public function deinstall($moduleName) {
        $modules = $this->input->post('ids') ?: [$moduleName];

        foreach ($modules as $module) {
            $module = strtolower($module);

            ($hook = get_hook('admin_deinstall_module')) ? eval($hook) : NULL;

            $modulePath = getModulePath($module);

            if (file_exists($modulePath . $module . '.php') AND $this->is_installed($module) === true) {
                $this->load->module($module);

                if (method_exists($module, '_deinstall') === TRUE) {
                    $this->$module->_deinstall();
                }

                $this->db->limit(1);
                $this->db->delete('components', ['name' => $module]);
                $this->lib_admin->log(lang('Deleted a module', 'admin') . ' ' . $module);
                if (PHP_SAPI == 'cli') {
                    return true;
                }
                showMessage(lang('The module successfully uninstall', 'admin'));
                pjax('/admin/components/modules_table');
            } else {
                if (PHP_SAPI == 'cli') {
                    return false;
                }
                showMessage(lang('Module deletion error', 'admin'), false, 'r');
                pjax('/admin/components/modules_table');
            }

            // Update hooks
            $this->load->library('cms_hooks');
            $this->cms_hooks->build_hooks();
        }
    }

    /**
     * Check is module exists
     * @param string $module_name module name
     * @return boolean
     */
    public function module_exists($module_name) {
        return moduleExists($module_name);
    }

    public function find_components($in_menu = FALSE) {
        $components = [];
        if ($in_menu == TRUE) {
            $this->db->where('in_menu', 1);
        }
        $this->db->not_like('identif', 'payment_method_');
        $installed = $this->db->get('components')->result_array();

        $modulesPaths = getModulesPaths();
        foreach ($modulesPaths as $moduleName => $modulePath) {

            $info_file = $modulePath . 'module_info.php';
            $com_file_admin = $modulePath . 'admin.php';

            $lang = new MY_Lang();
            $lang->load($moduleName);

            if (file_exists($info_file)) {
                include $info_file;

                if (file_exists($com_file_admin)) {
                    $admin_file = 1;
                } else {
                    $admin_file = 0;
                }

                $ins = FALSE;

                foreach ($installed as $k) {
                    if ($k['name'] == $moduleName) {
                        $ins = TRUE;
                    }
                }

                $new_com = [
                            'menu_name'  => $com_info['menu_name'],
                            'com_name'   => $moduleName,
                            'admin_file' => $admin_file,
                            'installed'  => $ins,
                            'type'       => $com_info['type'],
                           ];

                array_push($components, $new_com);
            }
        }
        return $components;
    }

    /**
     * Get components which show in menu and have admin.php
     * @return array|boolean
     */
    public function find_components_for_menu_list() {
        /** Get all components which show in menu */
        $components = $this->db->where('in_menu', 1);

        if (MAINSITE) {
            $components = $components->order_by('name', 'asc');
        } else {
            $components = $components->order_by('position', 'asc');
        }

        $components = $components->get('components')
            ->result_array();

        if (MAINSITE != '') {
            $components = $this->isPermitedModules($components, []);
            $components = $components[0];
        }
        /*         * If not components for show in menu */
        if (!$components) {
            return false;
        } else {
            /** Delete components which not have admin.php */
            foreach ($components as $key => $value) {
                if (!file_exists(getModulePath($value['name']) . 'admin.php')) {
                    unset($components[$key]);
                } else {
                    $info_file = getModulePath($value['name']) . 'module_info.php';
                    $lang = new MY_Lang();
                    $lang->load($value['name']);

                    if (file_exists($info_file)) {
                        include $info_file;
                        $components[$key]['type'] = $com_info['type'];
                        $components[$key] = array_merge($components[$key], $com_info);
                    }
                }
            }
        }
        return $components;
    }

    /**
     * @param string $component
     */
    public function component_settings($component) {

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

    /**
     * Save component settings
     * @param string $component
     */
    public function save_settings($component) {
        //cp_check_perm('module_admin');

        $this->db->where('name', $component);
        $query = $this->db->get('components', 1);

        $com = $query->row_array();

        ($hook = get_hook('admin_component_save_settings')) ? eval($hook) : NULL;

        if ($query->num_rows() >= 1) {
            $data = [
                     'enabled'  => (int) $this->input->post('status'),
                //'identif' => $this->input->post('identif'),
                     'identif'  => $com['name'],
                     'autoload' => (int) $this->input->post('autoload'),
                     'in_menu'  => (int) $this->input->post('in_menu'),
                    ];

            $this->db->where('name', $component);
            $this->db->update('components', $data);

            $this->lib_admin->log(lang('Changed the module settings', 'admin') . ' ' . $com['name']);
        }

        jsCode("ajax_div('modules_table',base_url + 'admin/components/modules_table/');");
    }

    /**
     * @param string $module
     */
    private function checkPerm($module) {
        if ($this->isNotPermited($module)) {
            $msg = count($this->permited) ? lang('Error checking permissions') : lang('Please wait for a few minutes. Your configuration file is being created.');
            die($msg);
        }
    }

    /**
     * Load component admin class in iframe/xhr
     * @param string $module
     */
    public function init_window($module) {
        $this->checkPerm($module);
        $lang = new MY_Lang();
        $lang->load($module);

        // buildWindow($id,$title,$contentURL,$width,$height,$method = 'iframe')
        //$module = $this->input->post('component');
        $info_file = getModulePath($module) . 'module_info.php';

        if (file_exists($info_file)) {
            include_once $info_file;

            switch ($com_info['admin_type']) {
                case 'window':
                    //buildWindow($module . '_window', lang('Module','admin') . ': ' . $com_info['menu_name'], site_url('admin/components/cp/' . $module), $com_info['w'], $com_info['h'], $com_info['window_type']);
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

    /**
     * @param string $module
     */
    public function cp($module) {
        $this->checkPerm($module);
        $func = $this->uri->segment(5);

        if ($func == FALSE) {
            $func = 'index';
        }

        $this->load->module('core/core');
        $args = $this->core->grab_variables(6);

        $this->template->assign('SELF_URL', site_url('admin/components/cp/' . $module));

        //echo '<div id="' . $module . '_module_block">' . modules::run($module . '/admin/' . $func, $args) . '</div>';
        echo modules::run($module . '/admin/' . $func, $args);

        //ajax_links($module);
    }

    /**
     * @param string $module
     */
    public function run($module) {
        $this->checkPerm($module);

        $func = $this->uri->segment(5);
        if ($func == FALSE) {
            $func = 'index';
        }

        ($hook = get_hook('admin_run_module_admin')) ? eval($hook) : NULL;

        $this->load->module('core/core');
        $args = $this->core->grab_variables(6);

        $this->template->assign('SELF_URL', site_url('admin/components/cp/' . $module));

        echo modules::run($module . '/admin/' . $func, $args);
    }

    public function com_info() {
        $com_info = $this->get_module_info($this->input->post('component'));

        if ($com_info != FALSE) {
            $info_text = '<h1>' . $com_info['menu_name'] . '</h1><p>' . $com_info['description'] . '</p><p><b>' . lang('Author', 'admin') . '</b> ' . $com_info['author'] . '<br/><b>' . lang('Version ', 'admin') . '</b> ' . $com_info['version'] . '</p>';

            jsCode("alertBox.info('" . $info_text . "');");
        } else {
            showMessage(lang("Can't load module info file", 'admin'), false . 'r');
        }
    }

    /**
     * @param $mod_name
     * @return bool|string
     */
    public function get_module_info($mod_name) {
        $info_file = getModulePath($mod_name) . 'module_info.php';
        $lang = new MY_Lang();
        $lang->load($mod_name);
        if (file_exists($info_file)) {
            include $info_file;
            return $com_info;
        } else {
            return FALSE;
        }
    }

    public function change_autoload() {
        if ($this->input->post('mid')) {
            $mid = $this->input->post('mid');
            $row = $this->db->where('id', $mid)->get('components')->row();
            if (count($row) > 0) {
                $autoload = $row->autoload;
                if ($autoload) {
                    $autoload = 0;
                    $status = lang('Disable', 'admin');
                } else {
                    $autoload = 1;
                    $status = lang('Enable', 'admin');
                }
                $this->db->where('id', $mid)->set('autoload', $autoload)->update('components');
                $row->autoload = $autoload;

                $nameModule = $this->get_module_info($row->identif)['menu_name'];

                $message = lang('Change Autoload. Module : ', 'admin') . ' '
                    . $nameModule . '. ' . lang('Status', 'admin') . ' : ' . $status . '.';
                $this->lib_admin->log($message);
                echo json_encode(['result' => $row]);
            } else {
                $result = false;
                echo json_encode(['result' => $result]);
            }
        }
    }

    public function change_url_access() {
        if ($this->input->post('mid')) {
            $mid = $this->input->post('mid');
            $row = $this->db->where('id', $mid)->get('components')->row();

            if (count($row) > 0) {
                $enabled = $row->enabled;
                if ($enabled) {
                    $enabled = 0;
                    $status = lang('Disable', 'admin');
                } else {
                    $enabled = 1;
                    $status = lang('Enable', 'admin');
                }

                $this->db->where('id', $mid)->set('enabled', $enabled)->update('components');

                $row->enabled = $enabled;
                $nameModule = $this->get_module_info($row->identif)['menu_name'];

                $message = lang('Change URL access. Module : ', 'admin') . ' '
                    . $nameModule . '. ' . lang('Status', 'admin') . ' : ' . $status . '.';
                $this->lib_admin->log($message);
            }
        }
    }

    public function change_show_in_menu() {
        $id = $this->input->post('id');
        $row = $this->db->where('id', (int) $id)->get('components')->row();
        if (count($row) > 0) {
            $in_menu = $row->in_menu;
            if ($in_menu == 1) {
                $in_menu = 0;
                $status = lang('Disable', 'admin');
            } else {
                $in_menu = 1;
                $status = lang('Enable', 'admin');
            }
            $this->db->where('id', (int) $id)->set('in_menu', $in_menu)->update('components');

            $nameModule = $this->get_module_info($row->identif)['menu_name'];

            $message = lang('Change Show in menu. Module : ', 'admin') . ' '
                . $nameModule . '. ' . lang('Status', 'admin') . ' : ' . $status . '.';
            $this->lib_admin->log($message);
        }
    }

    public function save_components_positions() {
        $positions = $this->input->post('positions');
        if (is_array($positions)) {
            foreach ($positions as $key => $value) {
                if ($this->db->where('name', $value)->set('position', $key)->update('components')) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
            if ($result) {
                showMessage(lang('Positions updated', 'admin'));
            } else {
                showMessage(lang('Fail', 'admin'));
            }
        }
    }

}

/* End of components.php */