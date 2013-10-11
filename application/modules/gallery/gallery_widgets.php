<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 */
class Gallery_Widgets extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('gallery');
    }

    public function latest_fotos($widget = array()) {
        $this->load->helper('gallery');
        $this->load->model('gallery_m');

        if ($widget['settings']['order'] == 'latest')
            $images = gallery_latest_images($widget['settings']['limit']);
        else
            $images = gallery_latest_images($widget['settings']['limit'], 'random');

        if (!empty($images)) {
            for ($i = 0; $i < count($images); $i++) {
                $images[$i]['thumb_path'] = media_url('uploads/gallery/' . $images[$i]['album_id'] . '/_thumbs/' . $images[$i]['file_name'] . $images[$i]['file_ext']);
            }
        }

        $this->template->add_array(array(
            'images' => $images,
        ));

        return $this->template->fetch('widgets/' . $widget['name'], $data);
    }

    public function latest_fotos_configure($action = 'show_settings', $widget_data = array()) {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        switch ($action) {
            case 'show_settings':
                //$this->display_tpl('latest_fotos_form', array('widget' => $widget_data));
                $this->render('latest_fotos_form', array('widget' => $widget_data));
                break;

            case 'update_settings':

                $this->load->library('Form_validation');
                $this->form_validation->set_rules('limit', lang("Image limit", 'gallery'), 'trim|required|integer');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    exit;
                }

                $data = array(
                    'limit' => $_POST['limit'],
                    'order' => $_POST['order'],
                );

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);

                showMessage(lang("Settings have been saved", 'gallery'));
                if ($_POST['action'] == 'tomain')
                    pjax('/admin/widgets_manager/index');
                break;

            case 'install_defaults':
                $data = array(
                    'limit' => 5,
                    'order' => 'latest',
                );

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
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

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/gallery/templates/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/gallery/templates/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/gallery/templates/' . $viewName);
    }

}
