<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings() {
        $this->db->cache_on();
        $settings = $this->db->select('settings')
                ->where('identif', 'email')
                ->get('components')
                ->row_array();
        $this->db->cache_off();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings) {
        return $this->db->where('identif', 'wishlist')
                        ->update('components', array('email' => serialize($settings)
        ));
    }

    /**
     * install module(create db tables, set default values)
     */
    public function install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '254',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'Text',
                'null' => TRUE
            ),
            'access' => array(
                'type' => 'ENUM',
                'constraint' => "'public','private','shared'",
                'default' => "shared"
            ),
            'user_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'review_count' => array(
                'type' => 'INT',
                'null' => FALSE,
                'default' => 0
            ),
            'hash' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => FALSE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_email_patterns');

        return TRUE;
    }

    /**
     * deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table('mod_email_patterns');

        return TRUE;
    }

}

?>
