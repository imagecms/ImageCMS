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
        return $this->db->where('identif', 'email')
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'patern' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'from' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'from_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'theme' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'ENUM',
                'constraint' => "'HTML','Text'",
                'default' => "HTML"
            ),
            'user_message' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'user_message_active' => array(
                'type' => 'BOOLEAN',
                'default' => TRUE
            ),
            'admin_message' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'admin_message_active' => array(
                'type' => 'BOOLEAN',
                'default' => TRUE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'variables' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        );


        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_email_paterns');




        $this->db
                ->where('identif', 'email')
                ->update('components', array(
                    'settings' => serialize(
                            array(
                                'name' => 'Default Name',
                                'from' => 'Default From',
                                'from_email' => 'default@from.ua',
                                'theme' => 'Default Theme',
                                'wraper' => 'Default $content Wraper',
                                'wraper_activ' => true,
                                'protocol' => 'SMTP',
                                'port' => '80'
                            )
                    ),
                    'enabled' => 1,
                    'autoload' => 1
        ));

        return TRUE;
    }

    /**
     * deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table('mod_email_paterns');

        return TRUE;
    }

}

?>
