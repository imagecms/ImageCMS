<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Updater_model extends CI_Model {


    public function __construct(){
		parent::__construct();
    }
    
    public function select_one_domen($domen){
        
        $sql = "select * from update_user where domen = '$domen'";
        return $this->db->query($sql)->row();
    }
    
    public function select_builds_current_version($version){
        
        $sql = "select * from update_file where version = '$version'";
        return $this->db->query($sql)->result_array();
    }



}

