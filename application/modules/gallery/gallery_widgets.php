<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 */
class Gallery_Widgets extends MY_Controller
{

    /**
     * Gallery_Widgets constructor.
     */
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('gallery');
    }

    /**
     * @param array $widget
     * @return string
     */
    public function latest_fotos(array $widget = []) {
        $this->load->helper('gallery');
        $this->load->model('gallery_m');

        if ($widget['settings']['order'] == 'latest') {
            $images = gallery_latest_images($widget['settings']['limit']);
        } else {
            $images = gallery_latest_images($widget['settings']['limit'], 'random');
        }

        if (!empty($images)) {
            $countImages = count($images);
            for ($i = 0; $i < $countImages; $i++) {
                $images[$i]['url'] = site_url($images[$i]['url']);
                $images[$i]['file_path'] = media_url($images[$i]['file_path']);
                $images[$i]['thumb_path'] = media_url('uploads/gallery/' . $images[$i]['album_id'] . '/_thumbs/' . $images[$i]['file_name'] . $images[$i]['file_ext']);
            }
        }

        $this->template->add_array(
            ['images' => $images]
        );

        return $this->template->fetch('widgets/' . $widget['name'], $data);
    }

    /**
     * @param string $action
     * @param array $widget_data
     */
    public function latest_fotos_configure($action = 'show_settings', array $widget_data = []) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        switch ($action) {
            case 'show_settings':
                $this->render('latest_fotos_form', ['widget' => $widget_data]);
                break;

            case 'update_settings':

                $this->load->library('Form_validation');
                $this->form_validation->set_rules('limit', lang('Image limit', 'gallery'), 'trim|required|integer');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    exit;
                }

                $data = [
                         'limit' => $this->input->post('limit'),
                         'order' => $this->input->post('order'),
                        ];

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);

                showMessage(lang('Settings have been saved', 'gallery'));
                if ($this->input->post('action') == 'tomain') {
                    pjax('/admin/widgets_manager/index');
                }
                break;

            case 'install_defaults':
                $data = [
                         'limit' => 5,
                         'order' => 'latest',
                        ];

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                break;
        }
    }

    /**
     * Template functions
     * @param string $file
     * @param array $vars
     */
    public function display_tpl($file, $vars = []) {
        $this->template->add_array($vars);

        $file = realpath(__DIR__) . '/templates/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * @param string $file
     * @param array $vars
     * @return string
     */
    public function fetch_tpl($file, array $vars = []) {
        $this->template->add_array($vars);

        $file = realpath(__DIR__) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    /**
     * @param string $viewName
     * @param array $data
     */
    public function render($viewName, array $data = []) {
        if (!empty($data)) {
            $this->template->add_array($data);
        }
        $this->template->show('file:' . APPPATH . getModContDirName('gallery') . '/gallery/templates/' . $viewName);
    }

}