<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Stats_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get setting by name
     * @param string $settingName
     * @return boolean|array
     */
    public function getSettingByName($settingName = '') {
        if ($settingName == '') {
            return FALSE;
        }

        /** Query for getting setting * */
        $query = $this->db
                ->select('value')
                ->from('mod_stats_settings')
                ->where('setting', $settingName)
                ->get()
                ->row_array();

        if ($query != null) {
            return $query['value'];
        } else {
            return FALSE;
        }
    }

    /**
     * Set setting value by name and value
     * @param string $settingName
     * @param string $settingValue
     * @param string $tableName
     * @return boolean
     */
    public function updateSettingByNameAndValue($settingName = '', $settingValue = '', $tableName = 'mod_stats_settings') {
        /** Return if not set values * */
        if ($settingName == '' || $settingValue == '') {
            return FALSE;
        }

        /** Check exists setting or not * */
        $query = $this->db->where('setting', $settingName)->get($tableName)->row_array();

        /** If setting exists then update value else create new setting with new value * */
        if ($query != null) {
            $this->db->where('setting', $settingName)->update($tableName, array('value' => $settingValue));
        } else {
            $this->db->insert($tableName, array('setting' => $settingName, 'value' => $settingValue));
        }
        return TRUE;
    }

    public function saveKeyWords($keyword = '') {
        /** Return if not set values * */
        if ($keyword == '') {
            return FALSE;
        }
        /** Insert value * */
        $this->db->insert('mod_stats_search', array(
            'key' => $keyword,
            'date' => time(),
        ));
    }

    public function saveUrl($userId, $url) {
        $this->db->insert('mod_stats_urls', array(
            'id_user' => $userId,
            'url' => $url,
        ));
    }

    /**
     * 
     * @param string $term
     * @param int $limit
     * @return boolean|array
     */
    public function getProductsByIdNameNumber($term, $limit = 7) {
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('id, name')
                ->from('shop_products_i18n')
                ->where('locale', $locale)
                ->like('id', $term)
                ->or_like('name', $term)
                ->limit($limit)
                ->get()
                ->result_array();

        if ($query)
            return $query;
        else
            return false;
    }

    /**
     * Get main currency symbol
     * @return boolean
     */
    public function getMainCurrencySymbol() {
        $query = $this->db->select('symbol')->where('main', 1)->get('shop_currencies')->row_array();

        if ($query)
            return $query['symbol'];
        else
            return false;
    }

    /**
     * Get first level categories
     * @return boolean|array
     */
    public function getCategoriesByIdName($term, $limit = 7) {
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('id, name')
                ->from('shop_category_i18n')
                ->where('locale', $locale)
                ->like('id', $term)
                ->or_like('name', $term)
                ->limit($limit)
                ->get();


        if ($query)
            return $query->result_array();
        else
            return false;
    }

    /**
     * Install module and update settings
     */
    public function install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'key' => array(
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ),
            'date' => array(
                'type' => 'INT',
                'null' => TRUE,
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_stats_search');

        $fields2 = array(
            'setting' => array(
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_field($fields2);
        $this->dbforge->create_table('mod_stats_settings');

        // збереження URL сторінок
        $attendanceFields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'int',
                'constraint' => '5',
                'null' => FALSE,
            ),
            'type_id' => array(
                'type' => 'int',
                'constraint' => '2',
                'null' => FALSE,
            ),
            'id_entity' => array(
                'type' => 'int',
                'constraint' => '6',
                'null' => FALSE,
            ),
            'time_add ' => array(
                'type' => 'int',
                'constraint' => '11',
                'null' => FALSE,
            ),
        );
        $this->dbforge->add_field($attendanceFields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_stats_attendance');


        $this->db->where('name', 'mod_stats');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1
        ));
    }

    /**
     * Deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_stats_search');
        $this->dbforge->drop_table('mod_stats_settings');
        $this->dbforge->drop_table('mod_stats_attendance');
    }

    /**
     * Picks up next negative id for unregistered user who has not visited the site before
     * @return int
     */
    public function getNewUnregisteredUserId() {
        $query = "
            select 
                (min(`id_user`) - 1) as `u2id` 
            FROM 
                `mod_stats_attendance`";

        $result = $this->db->query($query);
        if ($result) {
            $result = $result->row_array();
            return $result['u2id'] < 0 ? $result['u2id'] : -1;
        }
        return 0; // error
    }

    /**
     * If a user has registered on the site, and before was visited it, 
     * it is need to replace his old negative random id with a new real
     * @param int $oldId generated negative id from cookies
     * @param int $newId registered user id
     * @return void
     */
    public function updateAttendanceUserId($oldId, $newId) {
        $this->db->update('mod_stats_attendance', array('id_user' => $newId), array('id_user' => $oldId));
    }

}

?>
