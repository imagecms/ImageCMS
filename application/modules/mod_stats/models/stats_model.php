<?php

/**
 * Class Stats_model for mod_stats module
 * @uses \CI_Model
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package ImageCMSModule
 */
class Stats_model extends CI_Model {

    const TIME_BETWEEN_REQUESTS = 10;

    public function __construct() {
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
            $this->db->where('setting', $settingName)->update($tableName, ['value' => $settingValue]);
        } else {
            $this->db->insert($tableName, ['setting' => $settingName, 'value' => $settingValue]);
        }
        return TRUE;
    }

    /**
     * Save keywords autocomplete
     * @param string $keyword
     * @return boolean
     */
    public function saveKeyWordsAC($keyword = '') {
        return $this->_saveKeyWords($keyword, true);
    }

    /**
     * Save keywords
     * @param string $keyword
     * @return boolean
     */
    public function saveKeyWords($keyword = '') {
        return $this->_saveKeyWords($keyword);
    }

    /**
     *
     * @param string $keyword
     * @param boolean $ac
     * @return boolean
     */
    private function _saveKeyWords($keyword, $ac = false) {
        /** Return if not set values * */
        if ($keyword == '') {
            return FALSE;
        }

        $query = $this->db->where('key', $keyword)->where('date >', time() - self::TIME_BETWEEN_REQUESTS)->get('mod_stats_search');
        if (!$query->num_rows()) {
            /** Insert value * */
            $this->db->insert(
                'mod_stats_search',
                [
                'key' => $keyword,
                'date' => time(),
                'ac' => $ac == true ? 1 : 0
                    ]
            );
        }
        return TRUE;
    }

    public function saveUrl($userId, $url) {
        $this->db->insert(
            'mod_stats_urls',
            [
            'id_user' => $userId,
            'url' => $url,
                ]
        );
    }

    /**
     *
     * @param string $term
     * @param integer $limit
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

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    /**
     * Get main currency symbol
     * @return boolean
     */
    public function getMainCurrencySymbol() {
        $query = $this->db->select('symbol')->where('main', 1)->get('shop_currencies')->row_array();

        if ($query) {
            return $query['symbol'];
        } else {
            return false;
        }
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

        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Install module and update settings
     */
    public function install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ],
            'date' => [
                'type' => 'INT',
                'null' => TRUE,
            ],
            'ac' => [
                'type' => 'INT',
                'null' => TRUE,
            ]
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_stats_search');

        $fields2 = [
            'setting' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ],
        ];
        $this->dbforge->add_field($fields2);
        $this->dbforge->create_table('mod_stats_settings');

        // збереження URL сторінок
        $attendanceFields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'int',
                'constraint' => '5',
                'null' => FALSE,
            ],
            'type_id' => [
                'type' => 'int',
                'constraint' => '2',
                'null' => FALSE,
            ],
            'id_entity' => [
                'type' => 'int',
                'constraint' => '6',
                'null' => FALSE,
            ],
            'time_add ' => [
                'type' => 'int',
                'constraint' => '11',
                'null' => FALSE,
            ],
        ];
        $this->dbforge->add_field($attendanceFields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_stats_attendance');

        // збереження URL сторінок
        $robotsAttendanceFields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'id_robot' => [
                'type' => 'int',
                'constraint' => '5',
                'null' => FALSE,
            ],
            'type_id' => [
                'type' => 'int',
                'constraint' => '2',
                'null' => FALSE,
            ],
            'id_entity' => [
                'type' => 'int',
                'constraint' => '6',
                'null' => FALSE,
            ],
            'time_add ' => [
                'type' => 'int',
                'constraint' => '11',
                'null' => FALSE,
            ],
        ];

        $this->dbforge->add_field($robotsAttendanceFields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_stats_attendance_robots');

        $this->db->where('name', 'mod_stats');
        $this->db->update(
            'components',
            [
            'enabled' => 1,
            'autoload' => 1
                ]
        );
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
     * @param integer $oldId generated negative id from cookies
     * @param integer $newId registered user id
     * @return void
     */
    public function updateAttendanceUserId($oldId, $newId) {
        $this->db->update('mod_stats_attendance', ['id_user' => $newId], ['id_user' => $oldId]);
    }

}