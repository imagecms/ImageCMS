<?php
use CMSFactory\ModuleSettings;

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Cmsemail_model extends \CI_Model
{

    /**
     * Cmsemail_model constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $variableValue
     * @param string $locale
     * @return object
     */
    public function addVariable($template_id, $variable, $variableValue, $locale) {
        $patternVariables = $this->getTemplateVariables($template_id, $locale);
        $patternVariables[$variable] = $variableValue;

        return $this->setTemplateVariables($template_id, $patternVariables, $locale);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {

        $locale = chose_language();
        $data_no_locale = [
                           'name'                 => $data['name'],
                           'patern'               => '',
                           'from'                 => $data['from'],
                           'from_email'           => $data['from_email'],
                           'admin_email'          => $data['admin_email'],
                           'type'                 => $data['type'],
                           'user_message_active'  => $data['user_message_active'],
                           'admin_message_active' => $data['admin_message_active'],
                          ];
        $this->db->insert('mod_email_paterns', $data_no_locale);
        $lid = $this->db->insert_id();
        $data_locale = [
                        'id'            => $lid,
                        'locale'        => $locale,
                        'theme'         => $data['theme'],
                        'user_message'  => $data['user_message'],
                        'admin_message' => $data['admin_message'],
                        'description'   => $data['description'],
                        'variables'     => '',
                       ];
        $this->db->insert('mod_email_paterns_i18n', $data_locale);

        return $lid;
    }

    /**
     * deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table('mod_email_paterns');
        $this->dbforge->drop_table('mod_email_paterns_i18n');

        return TRUE;
    }

    /**
     * @param array $ids
     * @return bool
     */
    public function deleteTemplateByID(array $ids) {
        $this->db
            ->where_in('id', $ids)
            ->delete('mod_email_paterns');
        $this->db
            ->where_in('id', $ids)
            ->delete('mod_email_paterns_i18n');

        return TRUE;
    }

    /**
     * @param array $names
     */
    public function deleteTemplateByNames(array $names) {
        $this->db
            ->where_in('name', $names)
            ->delete('mod_email_paterns');
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $locale
     * @return bool|object
     */
    public function deleteVariable($template_id, $variable, $locale) {
        $patternVariables = $this->getTemplateVariables($template_id, $locale);
        if ($patternVariables) {
            unset($patternVariables[$variable]);

            return $this->setTemplateVariables($template_id, $patternVariables, $locale);
        } else {
            return FALSE;
        }
    }

    public function getTemplateVariables($template_id, $locale) {
        $query = $this->db->where('id', $template_id)->where('locale', $locale)->get('mod_email_paterns_i18n');
        if ($query) {
            $pattern = $query->row_array();
            return unserialize($pattern['variables']);
        } else {
            return FALSE;
        }
    }

    /**
     * @param int $template_id
     * @param array $patternVariables
     * @param string $locale
     * @return object
     */
    public function setTemplateVariables($template_id, $patternVariables, $locale) {
        if ($this->db->where('id', $template_id)->where('locale', $locale)->get('mod_email_paterns_i18n')->num_rows()) {
            return $this->db
                ->where('id', $template_id)
                ->where('locale', $locale)
                ->update('mod_email_paterns_i18n', ['variables' => serialize($patternVariables)]);
        } else {
            return $this->db
                ->insert('mod_email_paterns_i18n', ['id' => $template_id, 'locale' => $locale, 'variables' => serialize($patternVariables)]);
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @param string $locale
     */
    public function edit($id, $data, $locale) {

        $data_no_locale = [
                           'patern'               => '',
                           'from'                 => $data['from'],
                           'from_email'           => $data['from_email'],
                           'admin_email'          => $data['admin_email'],
                           'type'                 => $data['type'],
                           'user_message_active'  => $data['user_message_active'],
                           'admin_message_active' => $data['admin_message_active'],
                          ];
        $this->db->where('id', $id)->update('mod_email_paterns', $data_no_locale);

        $data_locale = [
                        'id'            => $id,
                        'locale'        => $locale,
                        'theme'         => $data['theme'],
                        'user_message'  => $data['user_message'],
                        'admin_message' => $data['admin_message'],
                        'description'   => $data['description'],
                       ];
        if ($this->db->where('id', $id)->where('locale', $locale)->get('mod_email_paterns_i18n')->num_rows()) {
            $this->db->where('id', $id)->where('locale', $locale)->update('mod_email_paterns_i18n', $data_locale);
        } else {
            $data_locale['variables'] = '';
            $this->db->insert('mod_email_paterns_i18n', $data_locale);
        }
    }

    /**
     * @return string|array
     */
    public function getAllTemplates() {
        $locale = chose_language();
        $query = $this->db
            ->select('*, mod_email_paterns.id as id')
            ->join('mod_email_paterns_i18n', "mod_email_paterns_i18n.id = mod_email_paterns.id and mod_email_paterns_i18n.locale = '$locale'", 'left')
            ->get('mod_email_paterns');

        if ($query) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    /**
     * get email type
     *
     * @param string $pattern
     * @return string
     */
    public function getEmailType($pattern) {
        $query = $this->db
            ->select('type')
            ->where('name', $pattern)
            ->get('mod_email_paterns');
        if ($query) {
            return $query->result_row();
        } else {
            return '';
        }
    }

    /**
     * @param string $pattern_name
     * @return string
     */
    public function getPaternSettings($pattern_name) {
        $locale = \MY_Controller::getCurrentLocale();
        $query = $this->db->select('*, mod_email_paterns.id as id')
            ->join('mod_email_paterns_i18n', "mod_email_paterns_i18n.id = mod_email_paterns.id and mod_email_paterns_i18n.locale = '$locale'", 'left')
            ->where('mod_email_paterns.name', $pattern_name)->get('mod_email_paterns');

        if ($query) {
            return $query->row_array();
        } else {
            return '';
        }
    }

    /**
     * @param int $id
     * @param string $locale
     * @return mixed
     */
    public function getTemplateById($id, $locale) {
        return $this->db->select('*, mod_email_paterns.id as id')
            ->join('mod_email_paterns_i18n', "mod_email_paterns_i18n.id = mod_email_paterns.id and mod_email_paterns_i18n.locale = '$locale'", 'left')
            ->where('mod_email_paterns.id', $id)
            ->get('mod_email_paterns')
            ->row_array();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getTemplateByName($name) {
        return $this->db
            ->where('name', $name)
            ->get('mod_email_paterns')
            ->row_array();
    }

    /**
     * get wraper
     *
     * @param bool|string $locale
     * @return string
     */
    public function getWraper($locale = false) {
        $locale = $locale ?: MY_Controller::getCurrentLocale();
        $settings = $this->getSettings($locale);
        if ($settings['wraper_activ']) {
            return $settings['wraper'];
        } else {
            return FALSE;
        }
    }

    /**
     * install module(create db tables, set default values)
     */
    public function install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = [
                   'id'                   => [
                                              'type'           => 'INT',
                                              'auto_increment' => TRUE,
                                             ],
                   'name'                 => [
                                              'type'       => 'VARCHAR',
                                              'constraint' => '256',
                                              'null'       => FALSE,
                                             ],
                   'patern'               => [
                                              'type' => 'TEXT',
                                              'null' => FALSE,
                                             ],
                   'from'                 => [
                                              'type'       => 'VARCHAR',
                                              'constraint' => '256',
                                              'null'       => FALSE,
                                             ],
                   'from_email'           => [
                                              'type'       => 'VARCHAR',
                                              'constraint' => '256',
                                              'null'       => FALSE,
                                             ],
                   'admin_email'          => [
                                              'type'       => 'VARCHAR',
                                              'constraint' => '256',
                                              'null'       => FALSE,
                                             ],
                   'type'                 => [
                                              'type'       => 'ENUM',
                                              'constraint' => "'HTML','Text'",
                                              'default'    => 'HTML',
                                             ],
                   'user_message_active'  => [
                                              'type'       => 'TINYINT',
                                              'constraint' => '1',
                                             ],
                   'admin_message_active' => [
                                              'type'       => 'TINYINT',
                                              'constraint' => '1',
                                             ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_email_paterns');

        $fields = [
                   'id'            => ['type' => 'INT'],
                   'locale'        => [
                                       'type'       => 'VARCHAR',
                                       'constraint' => '5',
                                      ],
                   'theme'         => [
                                       'type'       => 'VARCHAR',
                                       'constraint' => '256',
                                       'null'       => FALSE,
                                      ],
                   'user_message'  => [
                                       'type' => 'TEXT',
                                       'null' => FALSE,
                                      ],
                   'admin_message' => [
                                       'type' => 'TEXT',
                                       'null' => FALSE,
                                      ],
                   'description'   => [
                                       'type' => 'TEXT',
                                       'null' => FALSE,
                                      ],
                   'variables'     => [
                                       'type' => 'TEXT',
                                       'null' => FALSE,
                                      ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('locale', TRUE);
        $this->dbforge->create_table('mod_email_paterns_i18n');

        $this->db
            ->where('identif', 'cmsemail')
            ->update(
                'components',
                [
                 'settings' => serialize(
                     [
                      'from'         => 'Default From',
                      'from_email'   => 'default@from.ua',
                      'admin_email'  => 'admin@from.ua',
                      'theme'        => 'Default Theme',
                      'wraper'       => 'Default $content Wraper',
                      'wraper_activ' => true,
                      'mailpath'     => '/usr/sbin/sendmail',
                      'protocol'     => 'SMTP',
                      'port'         => '80',
                     ]
                 ),
                 'enabled'  => 1,
                ]
            );

        $sql = file_get_contents('./application/' . getModContDirName('cmsemail') . '/cmsemail/models/paterns.sql');
        $this->db->query($sql);
        $sql = file_get_contents('./application/' . getModContDirName('cmsemail') . '/cmsemail/models/patterns_i18n.sql');
        $this->db->query($sql);

        return TRUE;
    }

    /**
     * Save settings
     * @param array $data
     * @return bool
     */
    public function setSettings($data) {
        $settings = $this->getSettings();
        $settings[$data['locale']] = $data['settings'];

        return ModuleSettings::ofModule('cmsemail')->set($settings);
    }

    /**
     * Get module settings
     * @param bool|string $locale
     * @return array
     */
    public function getSettings($locale = FALSE) {

        return ModuleSettings::ofModule('cmsemail')->get($locale ?: null);
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $variableNewValue
     * @param string $oldVariable
     * @param string $locale
     * @return bool|object
     */
    public function updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale) {
        $paternVariables = $this->getTemplateVariables($template_id, $locale);
        if ($paternVariables) {
            unset($paternVariables[$oldVariable]);
            $paternVariables[$variable] = $variableNewValue;

            return $this->setTemplateVariables($template_id, $paternVariables, $locale);
        } else {
            return FALSE;
        }
    }

}