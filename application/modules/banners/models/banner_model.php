<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Banner_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function add_banner($data) {
        $sql = "insert into mod_banner(active,active_to,where_show) values('" . $data['active'] . "','" . $data['active_to'] . "','" . $data['where_show'] . "')";
        $this->db->query($sql);
        if ($this->db->_error_message()) {
            throw new Exception($this->db->_error_message());
        }

        $lid = $this->db->insert_id();
        $sql = "insert into mod_banner_i18n(url,id,locale,name,description,photo) values('" . $data['url'] . "','" . $lid . "','" . $data['locale'] . "','" . $data['name'] . "','" . $data['description'] . "','" . $data['photo'] . "')";
        $this->db->query($sql);
        if ($this->db->_error_message()) {
            throw new Exception($this->db->_error_message());
        }

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
        $this->db
            ->where('id', $data['id'])
            ->set('group', $data['group'])
            ->set('active', $data['active'])
            ->set('active_to', $data['active_to'])
            ->set('where_show', $data['where_show'])
            ->update('mod_banner');

        if ($this->db->where('locale', $data['locale'])->where('id', $data['id'])->get('mod_banner_i18n')->num_rows()) {
            $sql = "update mod_banner_i18n set url = '" . $data['url'] . "', name = '" . $data['name'] . "', description = '" . str_replace("'", "\'", $data['description']) . "', photo = '" . $data['photo'] . "' where id = '" . $data['id'] . "' and locale = '" . $data['locale'] . "'";
        } else {
            $sql = "insert into mod_banner_i18n(url, name, description, photo, locale, id) values('" . $data['url'] . "','" . $data['name'] . "','" . str_replace("'", "\'", $data['description'])  . "','" . $data['photo'] . "','" . $data['locale'] . "','" . $data['id'] . "')";
        }
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

    public function get_all_banner($locale, $group = 0, $active = 1) {

        $query = $this->db
            ->select('*, mod_banner.id as id')
            ->where('locale', $locale);

        if ($active) {
            $query->where('active', $active);
        }

        $query = $query->join('mod_banner_i18n', 'mod_banner.id = mod_banner_i18n.id')
            ->order_by('position')
            ->get('mod_banner');

        if ($query) {
            $query = $query->result_array();

            if ($group != '0') {
                foreach ($query as $key => $banner) {
                    if (!in_array($group, unserialize($banner['group']))) {
                        unset($query[$key]);
                    }

                    if ($banner['active_to'] != -1 && $banner['active_to'] < time()) {
                        unset($query[$key]);
                    }
                }
            } else {
                foreach ($query as $key => $banner) {
                    if (unserialize($banner['group']) && !strstr($this->input->server('REQUEST_URI'), '/admin/')) {
                        unset($query[$key]);
                    }
                }
            }

        }

        return $query;
    }

    public function get_one_banner($id, $locale) {
        if (!$locale) {
            $locale = MY_Controller::getCurrentLocale();
        }

        $banner = $this->db->query("select * from mod_banner left join mod_banner_i18n on mod_banner.id = mod_banner_i18n.id AND mod_banner_i18n.locale = '$locale' WHERE mod_banner.id = '$id'")->result_array();

        if (count($banner) == 0) {
            return FALSE;
        }

        return $banner[0];
    }

    public function getGroups() {
        $groups = $this->db->get('mod_banner_groups');
        if ($groups) {
            return $groups = $groups->result_array();
        } else {
            return FALSE;
        }
    }

    public function createGroupsTable() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
                   'id'   => [
                              'type'           => 'INT',
                              'auto_increment' => TRUE,
                             ],
                   'name' => [
                              'type'       => 'VARCHAR',
                              'constraint' => '255',
                              'null'       => TRUE,
                             ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_banner_groups');

        if (!in_array('group', $this->getColumnNamesOfTable('mod_banner'))) {
            $this->dbforge->add_column(
                'mod_banner',
                [
                 'group' => [
                             'type'       => 'VARCHAR',
                             'constraint' => '255',
                             'null'       => TRUE,
                            ],
                ]
            );
        }
    }

    /**
     * @param string $tableName
     */
    protected function getColumnNamesOfTable($tableName) {
        $result = $this->db->query('SHOW COLUMNS FROM `' . $tableName . '`');
        $fields = [];
        if ($result) {
            $tableFields = $result->result_array();
            $tableFieldsCount = count($tableFields);
            for ($i = 0; $i < $tableFieldsCount; $i++) {
                $fields[] = $tableFields[$i]['Field'];
            }
            return $fields;
        }
        return [];
    }

}