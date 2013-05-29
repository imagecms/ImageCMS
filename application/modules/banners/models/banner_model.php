<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {


    public function __construct(){
		parent::__construct();
    }

    public function add_banner($data){
        $sql = "insert into mod_banner(active,active_to,where_show) values('" . $data['active'] . "','" . $data['active_to'] . "','" . $data['where_show'] . "')";
        $this->db->query($sql);
        $lid = $this->db->insert_id();
        $sql = "insert into mod_banner_i18n(url,id,locale,name,description,photo) values('" . $data['url'] . "','" . $lid . "','" . $data['locale'] . "','" . $data['name'] . "','" . $data['description'] . "','" . $data['photo'] . "')";
        $this->db->query($sql);
        return $lid;

    }

    public function del_banner($id){

        $sql = "delete from mod_banner where id = '$id'";
        $this->db->query($sql);
        $sql = "delete from mod_banner_i18n where id = '$id'";
        $this->db->query($sql);

    }

    public function edit_banner($data){

        $sql = "update mod_banner set  active = '" . $data['active'] . "', active_to = '" . $data['active_to'] . "', where_show = '" . $data['where_show'] . "' where id = '" . $data['id'] . "'";
        $this->db->query($sql);
        $sql = "update mod_banner_i18n set url = '" . $data['url'] . "', name = '" . $data['name'] . "', description = '" . $data['description'] . "', photo = '" . $data['photo'] . "' where id = '" . $data['id'] . "' and locale = '" . $data['locale'] . "'";
        $this->db->query($sql);

    }


    public function add_empty_banner($id, $locale){

        $sql = "insert into mod_banner_i18n(id,locale,url,name,description,photo) values('" . $id . "','" . $locale . "','','','','')";
        $this->db->query($sql);

    }

    public function chose_active($id,$act){

        $sql = "update mod_banner set active = '" . $act . "' where id = '$id'";
        $this->db->query($sql);

    }

    public function get_all_banner($locale){

       return $this->db->query("select * from mod_banner inner join mod_banner_i18n on mod_banner.id = mod_banner_i18n.id where locale = '". $locale ."'")->result_array();

    }

    public function get_one_banner($id,$locale){

        $banner = $this->db->query("select * from mod_banner inner join mod_banner_i18n on mod_banner.id = mod_banner_i18n.id where locale = '$locale' and mod_banner.id = '$id'")->result_array();
        if (count($banner) == 0)
            $banner = $this->db->query("select * from mod_banner where mod_banner.id = '$id'")->result_array();

        return $banner[0];

    }



}

