<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Widget manager class
 */
class Widgets_manager extends BaseAdminController {

    protected $widget_path;

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
    }

    /**
     * Display widgets list
     */
    public function index() {

        if (!$this->_is_wratible()) {
            $this->template->assign('error', lang("Set the directory access rights to continue the work with widgets", "admin") . '<b>' . $this->widgets_path . '</b>');
            $this->template->show('widgets_list', FALSE);
            exit;
        }

        $locale = self::defaultLocale();
        $query = $this->db
                ->select(array('widgets.*', 'widget_i18n.title'))
                ->join('widget_i18n', "widgets.id = widget_i18n.id AND widget_i18n.locale = '{$locale}'", 'left')
                ->order_by('widgets.id', 'asc')
                ->get('widgets');

        if ($query->num_rows() > 0) {
            $widgets = $query->result_array();
            $cnt = count($widgets);

            for ($i = 0; $i < $cnt; $i++) {
                if (empty($widgets[$i]['data'])) {
                    continue;
                }
                $moduleInfo = $this->load->module('admin/components')->get_module_info($widgets[$i]['data']);
                $subpath = isset($moduleInfo['widgets_subpath']) ? $moduleInfo['widgets_subpath'] . '/' : '';
                $modulePath = getModulePath($widgets[$i]['data']);
                $form_file = $modulePath . $subpath . 'templates/' . $widgets[$i]['method'] . '_form.tpl';

                if (file_exists(realpath($form_file))) {
                    $widgets[$i]['config'] = TRUE;
                }
            }
        }

        $this->template->add_array(array(
            'widgets' => $widgets
        ));

        $this->template->show('widgets_list', FALSE);
    }

    /*
     * Check if widgets folder is wratible
     */

    private function _is_wratible() {
        $this->db->where('s_name', 'main');
        $this->db->select('site_template');
        $query = $this->db->get('settings')->row_array();

        $this->widgets_path = PUBPATH . '/templates/' . $query['site_template'] . '/widgets/';

        if (!is_really_writable($this->widgets_path))
            return false;
        else
            return true;
    }

    public function create() {
        if (!$this->_is_wratible()) {
            showMessage(lang("Set the directory access rights to continue the work with widgets", "admin") . '<b>' . $this->widgets_path . '</b>', '', 'r');
            exit;
        }
        //cp_check_perm('widget_create');

        $this->load->library('form_validation');

        $type = $this->input->post('type');

        if ($this->db->get_where('widgets', array('name' => $this->input->post('name')))->num_rows() > 0) {
            showMessage(lang("Widget with the same identifier already exists. Choose or select another identifier", 'admin'), false, 'r');
            return FALSE;
        }

        if ($type == 'module') {
            $this->form_validation->set_rules('desc', lang("Description ", "admin"), 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('title', lang("Title", "admin"), 'trim');
            $this->form_validation->set_rules('name', lang("Identifier", "admin"), 'trim|required|alpha_dash');
            $this->form_validation->set_rules('module', lang("Module name", "admin"), 'trim|required');
//            $this->form_validation->set_rules('method', lang("Method", "admin"), 'trim|required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                $data = array(
                    'description' => $this->input->post('desc'),
                    'method' => $this->input->post('method'),
                    'data' => $this->input->post('module'), // module name
                    'name' => $this->input->post('name'),
                    'type' => $type,
                    'created' => time()
                );

                $this->db->insert('widgets', $data);
                $data['id'] = $this->db->insert_id();
                $findId = $this->db->insert_id();

                // Copy widgets template
                $moduleInfo = $this->load->module('admin/components')->get_module_info($data['data']);
                $subpath = isset($moduleInfo['widgets_subpath']) ? $moduleInfo['widgets_subpath'] . '/' : '';

                $currentTemplate = $this->db->get('settings')->row()->site_template;

                if (file_exists(TEMPLATES_PATH . $currentTemplate . '/' . 'patterns/widgets/' . $data['method'] . '.tpl')) {
                    $tpl_file = TEMPLATES_PATH . $currentTemplate . '/' . 'patterns/widgets/' . $data['method'] . '.tpl';
                } else {
                    $modulePath = getModulePath($data['data']);
                    $tpl_file = $modulePath . $subpath . 'templates/' . $data['method'] . '.tpl';
                }

                if (file_exists($tpl_file)) {
                    // Get current template folder
                    $this->db->where('s_name', 'main');
                    $this->db->select('site_template');
                    $query = $this->db->get('settings')->row_array();

                    $this->load->helper('file');

                    $tpl_data = read_file($tpl_file);
                    $tpl_data = \translator\classes\Replacer::getInstatce()->replaceFileLangsWithDomain($tpl_data, $query['site_template']);

                    write_file(PUBPATH . '/templates/' . $query['site_template'] . '/widgets/' . $data['name'] . '.tpl', $tpl_data);
                    chmod(PUBPATH . '/templates/' . $query['site_template'] . '/widgets/' . $data['name'] . '.tpl', '511');
                }

                // Try to install widget default settings
                $this->load->module($data['data'] . '/' . $subpath . $data['data'] . '_widgets');
                $m = $data['method'] . '_configure';

                if (method_exists($data['data'] . '_widgets', $m)) {
                    $module = $data['data'] . '_widgets';
                    $this->$module->$m('install_defaults', $data);
                }

                $this->lib_admin->log(lang("Created a widget ", "admin") . " " . $data['name']);

                $modulePath = getModulePath($data['data']);
                $conf_file = $modulePath . $subpath . 'templates/' . $data['method'] . '_form.tpl';
                showMessage(lang("Widget created", "admin") . '.');
            }
        } elseif ($type == 'html') {
            $this->form_validation->set_rules('desc', lang("Description ", "admin"), 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('name', lang("Name", "admin"), 'trim|required|alpha_dash');
            $this->form_validation->set_rules('html_code', lang("HTML", "admin"), 'trim|required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                $data = array(
                    'description' => $this->input->post('desc'),
                    //'data' => $this->input->post('html_code'),
                    'name' => $this->input->post('name'),
                    'type' => $type,
                    'created' => time(),
                        //'locale' => $locale
                );

                $this->lib_admin->log(lang("Created a widget", "admin") . " " . $data['name']);

                $this->db->insert('widgets', $data);
                $findId = $this->db->insert_id();

                showMessage(lang("Widget created", "admin") . '.');
            }
        }

        if ($findId) {
            $locale = MY_Controller::defaultLocale();
            $data = array(
                'id' => $findId,
                'title' => $this->input->post('title') ? $this->input->post('title') : '',
                'data' => $this->input->post('html_code') ? $this->input->post('html_code') : '',
                'locale' => $locale
            );

            $this->db->insert('widget_i18n', $data);

            if ($_POST['action'] == 'tomain') {
                pjax('/admin/widgets_manager/index');
            } else {
                if (file_exists($conf_file))
                    pjax('/admin/widgets_manager/edit_' . $type . '_widget/' . $data['id']);
                else
                    pjax('/admin/widgets_manager/index');
            }
        }
    }

    /**
     * Display widget_create.tpl
     */
    public function create_tpl() {
        //cp_check_perm('widget_create');

        if (!$this->_is_wratible()) {
            $this->template->assign('error', lang("Set the directory access rights to continue the work with widgets", "admin") . '<b>' . $this->widgets_path . '</b>');
            $this->template->show('widgets_list', FALSE);
            exit;
        }

        $blocks = $this->display_create_tpl('tmodule');

        $this->template->assign('blocks', $blocks);

        $this->cache->delete_all();

        $this->template->show('widget_create', FALSE);
    }

    public function edit($id) {
        //cp_check_perm('widget_access_settings');

        $widget = $this->get($id);

        if ($widget->num_rows() == 1) {
            $widget = $widget->row_array();

            if ($widget['type'] == 'module') {
                $widget['settings'] = unserialize($widget['settings']);

                $subpath = isset($widget['settings']['subpath']) ? $widget['settings']['subpath'] . '/' : '';
                echo modules::run($widget['data'] . '/' . $subpath . $widget['data'] . '_widgets/' . $widget['method'] . '_configure', array('show_settings', $widget));
            } elseif ($widget['type'] == 'html') {
                
            }
        } else {
            show_error(lang("Error: widget not found!"));
        }
    }

    public function update_html_widget($id, $locale) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();
        $widget = $this->get($id);
        if ($widget->num_rows() == 1) {
            $widget = $widget->row_array();


            $this->form_validation->set_rules('desc', lang("Description ", "admin"), 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('name', lang("Name", "admin"), 'trim|required|alpha_dash');
            $this->form_validation->set_rules('html_code', lang("HTML", "admin"), 'trim|required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
                return FALSE;
            }

            if ($this->db->where('id !=', $id)->get_where('widgets', array('name' => $this->input->post('name')))->num_rows() > 0) {
                showMessage(lang("Widget with the same identifier already exists. Choose or select another identifier", 'admin'), false, 'r');
                return FALSE;
            }

            $data = array(
                'description' => $_POST['desc'],
                'name' => $this->input->post('name')
            );

            $this->db->where('id', $id);
            $this->db->update('widgets', $data);

            $sql = "select * from widget_i18n where id = '$id' and locale = '$locale'";
            if ($this->db->query($sql)->num_rows() > 0) {

                $data = array(
                    'data' => $this->input->post('html_code'),
                    'title' => $this->input->post('title'),
                );
//                var_dumps_exit($data);
                $this->db->where('id', $id);
                $this->db->where('locale', $locale);
                $this->db->update('widget_i18n', $data);
            } else {

                $data = array(
                    'id' => $id,
                    'data' => $this->input->post('html_code'),
                    'title' => $this->input->post('title'),
                    'locale' => $locale
                );
//                var_dumps_exit($data);

                $this->db->insert('widget_i18n', $data);
            }

            $this->lib_admin->log(lang("Widget settings edited", "admin") . " " . $data['name']);
//            $this->lib_admin->log(lang("Changed a widget", "admin") . " " . $data['name']);
            $this->cache->delete_all();

            showMessage(lang("Changes has been saved", "admin"));
            if ($_POST['action'] == 'tomain')
                pjax('/admin/widgets_manager');
        }
    }

    public function update_widget($id, $update_info = FALSE, $locale = NULL) {
        //cp_check_perm('widget_access_settings');
        $locale = $locale ? $locale : MY_Controller::defaultLocale();
//        var_dumps_exit($locale);
        $widget = $this->get($id);

        if ($widget->num_rows() == 1) {
            $widget = $widget->row_array();

            if ($update_info == 'info') {

                $this->form_validation->set_rules('desc', lang("Description ", "admin"), 'trim|min_length[1]|max_length[500]');
                $this->form_validation->set_rules('name', lang("Name", "admin"), 'trim|required|alpha_dash');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    return FALSE;
                }

                if ($this->db->where('id !=', $id)->get_where('widgets', array('name' => $this->input->post('name')))->num_rows() > 0) {
                    showMessage(lang("Widget with the same identifier already exists. Choose or select another identifier", 'admin'), false, 'r');
                    return FALSE;
                }

                $data = array(
                    'description' => $_POST['desc'],
                    'name' => $this->input->post('name')
                );

                $this->db->where('id', $widget['id']);
                $this->db->update('widgets', $data);

                if ($this->db->where('id', $id)->where('locale', $locale)->get('widget_i18n')->num_rows()) {
                    $dataI18n = array(
                        'data' => '',
                        'title' => $this->input->post('title')
                    );
                    $this->db->where('id', $id)
                            ->where('locale', $locale)
                            ->update('widget_i18n', $dataI18n);
                } else {
                    $dataI18n = array(
                        'id' => $id,
                        'locale' => $locale,
                        'data' => '',
                        'title' => $this->input->post('title')
                    );
                    $this->db->insert('widget_i18n', $dataI18n);
                }


                $this->cache->delete_all();


                showMessage(lang("Changes has been saved", "admin"));
            } else {
                $this->lib_admin->log(lang("Widget settings edited", "admin"));
                if ($widget['type'] == 'module') {
                    $widget['settings'] = unserialize($widget['settings']);
                    $subpath = isset($widget['settings']['subpath']) ? $widget['settings']['subpath'] . '/' : '';
                    modules::run($widget['data'] . '/' . $subpath . $widget['data'] . '_widgets/' . $widget['method'] . '_configure', array('update_settings', $widget));
                    showMessage(lang("Changes has been saved", "admin"));
                }
                if ($_POST['action'] == 'tomain') {
                    pjax('/admin/widgets_manager/edit/' . $id);
                }
            }

            if ($_POST['action'] == 'tomain') {
                pjax('/admin/widgets_manager/');
            } else {
                //pjax('/admin/widgets_manager/edit_module_widget/' . $id . '/info/' . $locale);
            }
        } else {
            show_error(lang("Error: widget not found!"));
        }
    }

    // Update widget config
    public function update_config($id = FALSE, $new_settings = array()) {
        //cp_check_perm('widget_access_settings');
//        echo "<pre>";
//        var_dump($id);
//        exit();

        if ($id != FALSE AND count($new_settings) > 0) {
            $settings = serialize($new_settings);
            $this->db->where('id', $id);
            $this->db->update('widgets', array('settings' => $settings));
        }
    }

    public function delete() {
        //cp_check_perm('widget_delete');

        $name = $this->input->post('ids');
        $this->db->where_in('name', $name);
        $this->db->delete('widgets');

        $this->db->where('s_name', 'main');
        $this->db->select('site_template');
        $query = $this->db->get('settings')->row_array();
        foreach ($name as $n) {
            if (file_exists(PUBPATH . '/templates/' . $query['site_template'] . '/widgets/' . $n . '.tpl')) {
                @unlink(PUBPATH . '/templates/' . $query['site_template'] . '/widgets/' . $n . '.tpl');
            }
            $this->lib_admin->log(lang("Deleted a widget", "admin") . " " . $n);
        }
        showMessage(lang("Widget successfully deleted", "admin"));
        $this->cache->delete_all();

        pjax('/admin/widgets_manager/index');
    }

    public function get($id) {
        return $this->db->get_where('widgets', array('id' => $id));
    }

    public function edit_html_widget($id, $update_info = FALSE, $locale = null) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        $lang = $this->db->get('languages')->result_array();
        //cp_check_perm('widget_access_settings');

        $widget = $this->get($id)->row_array();

        $sql = "select * from widget_i18n where id = '$id' and locale = '$locale'";
        $w_i18 = $this->db->query($sql)->row_array();

        $widget['data'] = $w_i18['data'];
        $widget['title'] = $w_i18['title'];


        /** Init Event. Pre Create Category */
        \CMSFactory\Events::create()->registerEvent(array('widgetId' => $id), 'WidgetHTML:preUpdate');
        \CMSFactory\Events::runFactory();


        $this->template->assign('locale', $locale);
        $this->template->assign('languages', $lang);
        $this->template->add_array(array(
            'widget' => $widget
        ));

        $this->lib_admin->log(lang("Widget edited", "admin"));
        $this->cache->delete_all();

        $this->template->show('widget_edit_html', FALSE);
    }

    public function edit_module_widget($id, $update_info = FALSE, $locale = NULL) {
        //cp_check_perm('widget_access_settings');
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        if ($_POST) {
            $this->update_widget($id, $update_info, $locale);
            $this->cache->delete_all();
            $this->lib_admin->log(lang("Widget edited", "admin"));
        } else {
            $widget = $this->db
                    ->select('widget_i18n.*, widgets.*, widget_i18n.id as i18n_id')
                    ->where('widgets.id', $id)
                    ->join('widget_i18n', 'widget_i18n.id=widgets.id AND locale="' . $locale . '"', 'left')
                    ->get('widgets');

            /** Init Event. Pre Create Category */
            \CMSFactory\Events::create()->registerEvent(array('widgetId' => $id), 'WidgetModule:preUpdate');
            \CMSFactory\Events::runFactory();

            $this->template->add_array(array(
                'widget_id' => $id,
                'widget' => $widget->row_array(),
                'locale' => $locale,
                'languages' => $this->db->get('languages')->result_array()
            ));


            $this->template->show('widget_edit_module', FALSE);
        }
    }

    /**
     * Search for aviable widgets in all modules except admin module
     */
    public function display_create_tpl($type = FALSE) {
        if ($type == 'tmodule') {
            $case = true;
            $type = 'module';
        }
        switch ($type) {
            case 'module':
                $this->load->library('lib_xml');

                $modules = $this->db->get('components')->result_array();

                array_push($modules, array('name' => 'core')); // Add core module

                $all_widgets = array();

                foreach ($modules as $module) {
                    $moduleInfo = $this->load->module('admin/components')->get_module_info($module['name']);
                    $modulePath = getModulePath($module['name']);

                    $widgets_info = realpath($modulePath . 'widgets_info.php');

                    if (file_exists($widgets_info)) {
                        include_once($widgets_info);

                        $module_widgets = array(
                            'widgets' => $widgets,
                            'module' => $module['name'],
                            'module_name' => $this->get_module_name($module['name']),
                        );

                        $subpath = isset($moduleInfo['widgets_subpath']) ? $moduleInfo['widgets_subpath'] . '/' : '';

                        $widgets_file = realpath($modulePath . $subpath . $module['name'] . '_widgets.php');

                        if (file_exists($widgets_file)) {
                            $all_widgets[] = $module_widgets;
                        }
                    }
                }

                $this->template->add_array(array(
                    'widgets' => $all_widgets
                ));
                if ($case)
                    return $all_widgets;
                $this->template->show('widget_create_module', FALSE);
                break;

            case 'html':
                $this->template->show('widget_create_html', FALSE);
                break;
        }
    }

    /**
     * Get widget info title/description/method
     */
    private function parse_widget_xml($xml_folder) {
        $modulePath = getModulePath($xml_folder);

        if ($this->lib_xml->load($modulePath . 'widgets')) {
            $widgets_array = $this->lib_xml->parse();
            $info = $widgets_array['widgets'][0]['widget'];

            $return = array();

            $locale = MY_Controller::defaultLocale();
            foreach ($info as $k => $v) {
                if ($v['i18n_' . $locale]) {
                    $temp = array(
                        'title' => $v['i18n_' . $locale][0]['title'][0],
                        'description' => $v['i18n_' . $locale][0]['description'][0],
                        'method' => $v['method'][0],
                    );

                    array_push($return, $temp);
                }
            }

            if (count($return) > 0) {
                return $return;
            }
        }

        return FALSE;
    }

    private function get_module_name($dir) {
        if ($dir == 'core') {
            return lang("Core", "admin");
        }

        $info = $this->load->module('admin/components')->get_module_info($dir);
        return $info['menu_name'];
    }

}

/* End of widgets.php */
