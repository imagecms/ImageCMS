<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class level_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSettings(){
        
        $sql = "select settings from components where name = 'new_level_settings'";
        return unserialize($this->db->query($sql)->row()->settings);
    }
   

}
