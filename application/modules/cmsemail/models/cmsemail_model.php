<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Cmsemail_model extends \CI_Model {

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
                ->where('identif', 'cmsemail')
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
        return $this->db->where('identif', 'cmsemail')
                        ->update('components', array('settings' => serialize($settings)
        ));
    }

    /**
     * get wraper
     *
     * @return string
     */
    public function getWraper() {
        $settings = $this->getSettings();
        if ($settings['wraper_activ']) {
            return $settings['wraper'];
        } else {
            return FALSE;
        }
    }

    /**
     * get email type
     *
     * @param string $patern
     * @return string
     */
    public function getEmailType($patern) {
        $query = $this->db
                ->select('type')
                ->where('name', $patern)
                ->get('mod_email_paterns');
        if ($query) {
            return $query->result_row();
        } else {
            return '';
        }
    }

    public function getPaternSettings($patern_name) {
        $query = $this->db->where('name', $patern_name)->get('mod_email_paterns');

        if ($query) {
            return $query->row_array();
        } else {
            return '';
        }
    }

    public function create($data) {
        $this->db->insert('mod_email_paterns', $data);
    }

    public function edit($id, $data) {
        $this->db
                ->where('id', $id)
                ->update('mod_email_paterns', $data);
    }

    public function getAllTemplates() {
        $query = $this->db
                ->get('mod_email_paterns');

        if ($query) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    public function getTemplateById($id) {
        return $this->db
                        ->where('id', $id)
                        ->get('mod_email_paterns')
                        ->row_array();
    }

    public function getTemplateByName($name) {
        return $this->db
                        ->where('name', $name)
                        ->get('mod_email_paterns')
                        ->row_array();
    }

    public function deleteTemplateByID($ids) {
        $this->db
                ->where_in('id', $ids)
                ->delete('mod_email_paterns');
    }

    public function deleteTemplateByNames($names) {
        $this->db
                ->where_in('name', $names)
                ->delete('mod_email_paterns');
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
            'admin_email' => array(
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
                'type' => 'TINYINT',
                'constraint' => '1'
            ),
            'admin_message' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'admin_message_active' => array(
                'type' => 'TINYINT',
                'constraint' => '1'
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
                ->where('identif', 'cmsemail')
                ->update('components', array(
                    'settings' => serialize(
                            array(
                                'from' => 'Default From',
                                'from_email' => 'default@from.ua',
                                'admin_email' => 'admin@from.ua',
                                'theme' => 'Default Theme',
                                'wraper' => 'Default $content Wraper',
                                'wraper_activ' => true,
                                'mailpath' => '/usr/sbin/sendmail',
                                'protocol' => 'SMTP',
                                'port' => '80'
                            )
                    ),
                    'enabled' => 1
        ));

        $sql = file_get_contents('./application/modules/cmsemail/models/paterns.sql');
        $this->db->query($sql);

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

    public function deleteVariable($template_id, $variable) {
        $paternVariables = $this->getTemplateVariables($template_id);
        if ($paternVariables) {
            unset($paternVariables[$variable]);

            return $this->setTemplateVariables($template_id, $paternVariables);
        } else {
            return FALSE;
        }
    }

    public function updateVariable($template_id, $variable, $variableNewValue, $oldVariable) {
        $paternVariables = $this->getTemplateVariables($template_id);
        if ($paternVariables) {
            unset($paternVariables[$oldVariable]);
            $paternVariables[$variable] = $variableNewValue;

            return $this->setTemplateVariables($template_id, $paternVariables);
        } else {
            return FALSE;
        }
    }

    public function addVariable($template_id, $variable, $variableValue) {
        $paternVariables = $this->getTemplateVariables($template_id);
        $paternVariables[$variable] = $variableValue;

        return $this->setTemplateVariables($template_id, $paternVariables);
    }

    public function getTemplateVariables($template_id) {
        $query = $this->db->where('id', $template_id)->get('mod_email_paterns');
        if ($query) {
            $patern = $query->row_array();
            return unserialize($patern['variables']);
        } else {
            return FALSE;
        }
    }

    public function setTemplateVariables($template_id, $paternVariables) {
        return $this->db
                        ->where('id', $template_id)
                        ->update('mod_email_paterns', array('variables' => serialize($paternVariables)));
    }

}

?>
