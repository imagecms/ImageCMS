<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add_banner($data) {
        $sql = "insert into mod_banner(active,active_to,where_show) values('" . $data['active'] . "','" . $data['active_to'] . "','" . $data['where_show'] . "')";
        $this->db->query($sql);
        $lid = $this->db->insert_id();
        $sql = "insert into mod_banner_i18n(url,id,locale,name,description,photo) values('" . $data['url'] . "','" . $lid . "','" . $data['locale'] . "','" . $data['name'] . "','" . $data['description'] . "','" . $data['photo'] . "')";
        $this->db->query($sql);
        return $lid;
    }

    public function del_banner($id) {

        $sql = "delete from mod_banner where id = '$id'";
        $this->db->query($sql);
        $sql = "delete from mod_banner_i18n where id = '$id'";
        $this->db->query($sql);
    }

    public function get_settings_tpl() {

        $res = $this->db->query("select  settings from components where name = 'banners'")->row();
        $show = unserialize($res->settings);


        return $show['show_tpl'] ? true : false;
    }

    public function edit_banner($data) {

        $sql = "update mod_banner set  active = '" . $data['active'] . "', active_to = '" . $data['active_to'] . "', where_show = '" . $data['where_show'] . "' where id = '" . $data['id'] . "'";
        $this->db->query($sql);
        if ($this->db->where('locale', $data['locale'])->where('id', $data['id'])->get('mod_banner_i18n')->num_rows())
            $sql = "update mod_banner_i18n set url = '" . $data['url'] . "', name = '" . $data['name'] . "', description = '" . $data['description'] . "', photo = '" . $data['photo'] . "' where id = '" . $data['id'] . "' and locale = '" . $data['locale'] . "'";
        else
            $sql = "insert into mod_banner_i18n(url, name, description, photo, locale, id) values('" . $data['url'] . "','" . $data['name'] . "','" . $data['description'] . "','" . $data['photo'] . "','" . $data['locale'] . "','" . $data['id'] . "')";
        $this->db->query($sql);
    }

    public function add_empty_banner($id, $locale) {

        $sql = "insert into mod_banner_i18n(id,locale,url,name,description,photo) values('" . $id . "','" . $locale . "','','','','')";
        $this->db->query($sql);
    }

    public function chose_active($id, $act) {

        $sql = "update mod_banner set active = '" . $act . "' where id = '$id'";
        $this->db->query($sql);
    }

    public function get_all_banner($locale) {

        $query = $this->db->query("select *, mod_banner.id as id from mod_banner join mod_banner_i18n on mod_banner.id = mod_banner_i18n.id and locale = '" . $locale . "' ORDER BY `mod_banner`.`position`");
        if ($query) {
            $query = $query->result_array();
        }

        return $query;
    }

    public function get_one_banner($id, $locale) {
        if (!$locale) {
            $locale = MY_Controller::getCurrentLocale();
        }
        
        $banner = $this->db->query("select * from mod_banner inner join mod_banner_i18n on mod_banner.id = mod_banner_i18n.id where locale = '$locale' and mod_banner.id = '$id'")->result_array();

        if (count($banner) == 0) {
            return FALSE;
        }

        return $banner[0];
    }

}
