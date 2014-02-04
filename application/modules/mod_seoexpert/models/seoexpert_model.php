<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings($locale = 'ru') {
//        $this->db->cache_on();
        $settings = $this->db->select('settings')
                ->where('locale', $locale)
                ->get('mod_seoexpert')
                ->row_array();
//        $this->db->cache_off();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings, $locale = 'ru') {
        $data = $this->db->select('locale')
                ->where('locale', $locale)
                ->get('mod_seoexpert')
                ->row_array();
        if(empty($data))
            return $this->db->insert('mod_seoexpert', array('locale' => $locale,'settings' => serialize($settings)));
            
            
        return $this->db->where('locale', $locale)
                        ->update('mod_seoexpert', array('settings' => serialize($settings)
        ));
    }

}

?>
