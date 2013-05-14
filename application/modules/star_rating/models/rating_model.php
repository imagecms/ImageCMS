<?php

class Rating_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get rating rom database
     * @param id $id_g
     * @param string $type_g
     * @return array
     */
    public function get_rating($id_g = null, $type_g = null) {
        $res = $this->db->where('id_type', $id_g)->where('type', $type_g)->get('rating')->row();
        return $res;
    }
    /**
     * Update rating 
     * @param int $id
     * @param string $type
     * @param array $data
     */
    public function update_rating($id, $type, $data) {
        $this->db->where('id_type', $id)->where('type', $type)->update('rating', $data);
    }
    /**
     * Insert rating in database if rate at first 
     * @param type $data
     */
    public function insert_rating($data) {
        $this->db->insert('rating', $data);
    }
    /**
     * Get module settings
     * @return type
     */
    public function get_settings() {
        $res = $this->db->select('settings')->where('name', 'star_rating')->get('components')->row_array();
        return $res;
    }
    /**
     * Update module settings
     * @param type $settings
     */
    public function update_settings($settings) {
        $this->db->set('settings', $settings);
        $this->db->where('name', 'star_rating');
        $this->db->update('components');
    }
    /**
     * Check is shop installed
     * @return type
     */
    public function is_shop()
    {
        $res = $this->db->where('name','star_rating')->get('components')->row();
        return $res; 
    }   
    
}
?>
