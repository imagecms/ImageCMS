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
        /** Return if not set values **/
        if ($settingName == '' || $settingValue == '') {
            return FALSE;
        }
        
        /** Check exists setting or not **/
        $query = $this->db->where('setting', $settingName)->get($tableName)->row_array();
        
        /** If setting exists then update value else create new setting with new value **/
        if ($query != null) {
            $this->db->where('setting', $settingName)->update($tableName, array ('value' => $settingValue));
        } else {
            $this->db->insert($tableName, array ('setting' => $settingName, 'value' => $settingValue));
        }
        return TRUE;
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
            'count' => array(
                'type' => 'INT',
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

        $this->db->where('name', 'mod_stats');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1));
    }

    /**
     * Deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_stats_search');
        $this->dbforge->drop_table('mod_stats_settings');
    }

}

?>
