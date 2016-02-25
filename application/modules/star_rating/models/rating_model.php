<?php

use CMSFactory\ModuleSettings;

class Rating_model extends CI_Model
{

    /**
     * Get rating rom database
     * @param int $id_g
     * @param string $type_g
     * @return array
     */
    public function get_rating($id_g = null, $type_g = null) {
        $res = $this->db->where('id_type', $id_g)->where('type', $type_g)->get('rating')->row();
        return $res;
    }

    /**
     * Update rating
     * @param integer $id
     * @param string $type
     * @param array $data
     */
    public function update_rating($id, $type, $data) {
        $this->db->where('id_type', $id)->where('type', $type)->update('rating', $data);
    }

    /**
     * Insert rating in database if rate at first
     * @param array $data
     */
    public function insert_rating($data) {
        $this->db->insert('rating', $data);
    }

    /**
     * Get module settings
     * @return array
     */
    public function get_settings() {
        $res = ModuleSettings::ofModule('star_rating')->get();
        return $res;
    }

    /**
     * Update module settings
     * @param array $settings
     */
    public function update_settings($settings) {
        $this->db->set('settings', $settings);
        $this->db->where('name', 'star_rating');
        $this->db->update('components');
    }

}