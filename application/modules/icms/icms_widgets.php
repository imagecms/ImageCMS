<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Набор виджетов модуля ICMS
 */
class Icms_Widgets extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Виджет icms_category_tree
     */
    public function icms_category_tree($widget = array()) {
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }
        ;
        $this->template->add_array(array(
            'category' => $settings['category'],
            'depth' => $settings['depth'],
        ));

        return $this->template->fetch('widgets/' . $widget['name'], $data);
    }

    /**
     * Настройка виджета icms_category_tree
     */
    public function icms_category_tree_configure($action = 'show_settings', $widget_data = array()) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }
        switch ($action) {
            case 'show_settings':
                $this->display_tpl('latest_fotos_form', array('widget' => $widget_data));
                break;

            case 'update_settings':
                $this->load->library('Form_validation');
                $this->form_validation->set_rules('category', lang('amt_category'), 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('depth', 'Вложенность', 'trim|required|is_natural_no_zero|min_length[1]');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors());
                    return;
                }

                $data = array(
                    'category' => $_POST['category'],
                    'depth' => $_POST['depth'],
                );

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                showMessage(lang('amt_settings_saved'));
                break;

            case 'install_defaults':
                $data = array(
                    'category' => 0,
                    'depth' => 2,
                );

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                break;
        }
    }

    /*
      function widget_navigation($widget = array()) {
      $this->load->module('core');

      if ($widget['settings'] == FALSE) {
      $settings = $this->defaults;
      } else {
      $settings = $widget['settings'];
      }

      switch ($this->core->core_data['data_type']) {
      case 'category':
      $cur_category = $this->core->cat_content;

      $i = 0;
      $path_count = count($cur_category['path']);

      $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

      $tpl_data = array('navi_cats' => $path_categories);

      return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
      break;

      case 'page':
      if ($this->core->cat_content['id'] > 0) {
      $cur_category = $this->core->cat_content;

      $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

      // Insert Page data
      $path_categories[] = array(
      'path_url' => $this->core->page_content['cat_url'] . $this->core->page_content['url'],
      'name' => $this->core->page_content['title']
      );

      $tpl_data = array('navi_cats' => $path_categories);

      return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
      }
      break;
      }
      } */

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