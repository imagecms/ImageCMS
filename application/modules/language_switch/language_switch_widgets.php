<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * language_switch widgets
 */
class Language_switch_Widgets extends MY_Controller {

    private $defaults = array();

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('language_switch');
    }

    // Get and display recent comments
    public function language_switch_show($widget = array()) {
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $current_address = '';
        $current_address .= $this->uri->uri_string();


        if ($this->input->server('QUERY_STRING')) {
            $current_address .= '?' . $this->input->server('QUERY_STRING');
        }
        if ($this->uri->segment(1)) {
            if (array_key_exists($this->uri->segment(1), $this->core->langs)) {
                $current_address = substr_replace($current_address, '', 0, strlen($this->uri->segment(1)));
            } else {
                $current_address = '/' . $current_address;
            }
        }


        $languages = $this->db->get('languages')->result_array();
        foreach ($languages as $key => $lang) {
            if ($lang['identif'] == MY_Controller::getCurrentLocale()) {
                $languages[$key]['current'] = 1;
            } else {
                $languages[$key]['current'] = 0;
            }
        }
        return $this->template->fetch('widgets/' . $widget['name'], array('languages' => $languages, 'current_address' => $current_address));
    }

    // Configure widget settings
    public function language_switch_show_configure($action = 'show_settings', $widget_data = array()) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        } // Only admin access 

        switch ($action) {
            case 'show_settings':
                $this->display_tpl('language_switch_show_form', array('widget' => $widget_data));
                break;

            case 'update_settings':
                $this->form_validation->set_rules('image_url', lang('Image', 'language_switch'), 'trim|required');
                $this->form_validation->set_rules('image_title', lang('Description', 'language_switch'), 'trim');
                $this->form_validation->set_rules('href', lang('passage Url', 'language_switch'), 'trim');


                if ($this->form_validation->run() == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                } else {
                    $data = array(
                        'image_url' => trim($_POST['image_url']),
                        'image_title' => htmlspecialchars($_POST['image_title']),
                        'href' => trim(htmlspecialchars($_POST['href'])),
                    );

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage(lang('Settings saved', 'language_switch'));
                }
                break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->defaults);
                break;
        }
    }

    // Template functions
    function display_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    function fetch_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}
