<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Sendsms_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     * @return array
     */
    public function getTemplates($locale = 'ru') {
        $settings = $this->db
                ->select('settings')
                ->where('locale', $locale)
                ->get('mod_sendsms');
        if ($settings) {
            $settings = $settings->row_array();
        }
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    public function getApiSettings() {
        $settings = $this->db->select('settings')
                ->where('name', 'sendsms')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    public function setApiSettings($settings) {
        return $this->db->where('name', 'sendsms')
                        ->update('components', array('settings' => serialize($settings)));
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings, $locale = 'ru') {
        $data = $this->db
                ->select('locale')
                ->where('locale', $locale)
                ->get('mod_sendsms')
                ->row_array();
        if (empty($data))
            return $this->db->insert('mod_sendsms', array('locale' => $locale, 'settings' => serialize($settings)));

        return $this->db->where('locale', $locale)
                        ->update('mod_sendsms', array('settings' => serialize($settings)
        ));
    }

}

?>
