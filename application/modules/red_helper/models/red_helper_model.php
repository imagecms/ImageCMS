<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Red_helper_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings() {
        $settings = $this->db
                ->select('settings')
                ->where('identif', 'red_helper')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings) {
        return $this->db->where('identif', 'red_helper')
                        ->update('components', array('settings' => serialize($settings)
        ));
    }

}

?>
