<?php

/**
 * @property CI_DB_active_record $db
 */
class Wishlist_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     */
    public function getSettings() {
        $settings = $this->db
                ->select('settings')
                ->where('identif', 'wishlist')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings[settings]);
        return $settings;
    }

    /**
     * Save settings
     * @param type $settings
     * @return boolean
     */
    public function setSettings($settings) {
        $forReturn = $this->db
                ->where('identif', 'wishlist')
                ->update('components', array('settings' => serialize($settings)));
        return $forReturn;
    }

}

?>
