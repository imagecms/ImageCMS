<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс exchange
 */
class Exchange {

    private $config = array();
    private $row_name = '1c_config';
    private $ci;

    public function __construct() {
        $this->ci = &get_instance();
        if (!$this->get1CSettings()) {
            //default settings
            $this->config['zip'] = 'no';
            $this->config['filesize'] = 2048000;
            $this->config['validIP'] = '127.0.0.1';
            $this->config['password'] = '';
            $this->config['usepassword'] = false;
            $this->config['userstatuses'] = array();
        } else {
            $this->config = $this->get1CSettings();
        }
    }

    private function get1CSettings() {
        $config = $this->ci->db->where('identif', 'exchange')->get('components')->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    public function install() {
        if (is_array($this->config)) {
            $for_insert = serialize($this->config);
            $this->ci->db->insert($this->settings_table, array('name' => $this->row_name, 'value' => $for_insert));
        }
    }

    public function index() {
        
    }

}

/* End of file exchange.php */