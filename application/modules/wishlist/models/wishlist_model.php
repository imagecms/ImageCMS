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
     *
     * @return boolean
     */
    public function setSettings($settings) {
        $this->db
                ->where('identif', 'wishlist')
                ->update('components', array('settings' => serialize($settings)));
        return TRUE;
    }

}

?>
