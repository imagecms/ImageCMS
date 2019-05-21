<?php

use CMSFactory\assetManager;

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
        $this->load->helper('gallery');
        $this->load->model('gallery_m');
    }

    /**
     * @param array $widget
     * @return string
     */
    public function latest_fotos(array $widget = []) {

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
                assetManager::create()
                    ->setData('widget', $widget_data)
                    ->renderAdmin('../../templates/latest_fotos_form');
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
     * @param array $widget
     * @return string
     */
    public function album_images(array $widget = []) {

        $images = $this->gallery_m->get_album_images($widget['settings']['album_id'], $widget['settings']['limit']);

        if (!empty($images)) {
            $countImages = count($images);
            for ($i = 0; $i < $countImages; $i++) {
                $images[$i]['url'] = site_url('gallery/album/' . $images[$i]['album_id'] . '/image/' . $images[$i]['id']);
                $images[$i]['file_path'] = media_url('uploads/gallery/' . $images[$i]['album_id'] . '/' . $images[$i]['file_name'] .  $images[$i]['file_ext']);
                $images[$i]['thumb_path'] = media_url('uploads/gallery/' . $images[$i]['album_id'] . '/_thumbs/' . $images[$i]['file_name'] . $images[$i]['file_ext']);
            }
        }

        return assetManager::create()
            ->setData('images', $images)
            ->fetchTemplate('../widgets/' . $widget['name']);
    }


    /**
     * @param string $action
     * @param array $widget_data
     */
    public function album_images_configure($action = 'show_settings', array $widget_data = []) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        switch ($action) {
            case 'show_settings':
                assetManager::create()
                    ->setData('widget', $widget_data)
                    ->setData('albums', $this->gallery_m->get_albums())
                    ->renderAdmin('../../templates/album_images_form');
                break;

            case 'update_settings':

                $this->load->library('Form_validation');
                $this->form_validation->set_rules('limit', lang('Image limit', 'gallery'), 'trim|required|integer');
                $this->form_validation->set_rules('album_id', lang('Choose Album', 'gallery'), 'trim|required|integer');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    exit;
                }

                $data = [
                    'limit' => $this->input->post('limit'),
                    'album_id' => $this->input->post('album_id'),
                ];

                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);

                showMessage(lang('Settings have been saved', 'gallery'));
                if ($this->input->post('action') == 'tomain') {
                    pjax('/admin/widgets_manager/index');
                }
                break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], ['limit' => 15]);
                break;
        }
    }
}