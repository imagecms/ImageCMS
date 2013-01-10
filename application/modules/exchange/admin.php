<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        $this->locale = BaseAdminController::getCurrentLocale();
    }

    public function index() {
        $settings = $this->get1CSettings();
        $this->template->add_array(array('settings' => $settings, 'statuses' => $this->get_orders_statuses()));
        $this->display_tpl('settings');
    }

    private function get1CSettings() {
        $config = $this->db->where('identif', 'exchange')->get('components')->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    private function get_orders_statuses() {
        return $this->db->query("SELECT * FROM `shop_order_statuses` 
            JOIN `shop_order_statuses_i18n` ON shop_order_statuses.id=shop_order_statuses_i18n.id 
            WHERE `locale`='" . $this->locale . "'")->result_array();
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

    public function update_settings() {
        $for_update = $this->input->post('1CSettings');
        if ($for_update) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('1CSettings[filesize]', 'Размер единовременно загружаемой части файла', 'integer|required');
            $this->form_validation->set_rules('1CSettings[validIP]', 'IP сервера 1С', 'valid_ip|required');
            $config['zip'] = $for_update['zip'];
            $config['filesize'] = $for_update['filesize'];
            $config['validIP'] = $for_update['validIP'];
            $config['password'] = $for_update['password'];
            $config['usepassword'] = $for_update['usepassword'];
            $config['userstatuses'] = $for_update['statuses'];
            $config['autoresize'] = $for_update['autoresize'];
            if ($this->form_validation->run() == false) {
                showMessage(validation_errors(), '', '');
            } else {
                $this->db->where('identif', 'exchange')->update('components', array('settings' => serialize($config)));
                showMessage("Настройки сохранены");
            }
        }
    }
    
    public function startImagesResize() {
        ShopCore::app()->SWatermark->updateWatermarks(true);
    }

}

/* End of file admin.php */