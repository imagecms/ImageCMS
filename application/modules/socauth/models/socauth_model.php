<?php

class Socauth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     */
    public function getSettings() {
        $settings = $this->db
                ->select('settings')
                ->where('identif', 'socauth')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings[settings]);
        return $settings;
    }

    /**
     * Create cosial link to user profile
     * @param type $soc
     * @param type $socId
     */
    public function setLink($soc, $socId) {
        $this->db->set('socialId', $socId);
        $this->db->set('userId', $this->dx_auth->get_user_id());
        $this->db->set('social', $soc);
        $this->db->insert('mod_social');
    }

    /**
     * Create social user
     * @param type $id
     * @param type $soc
     * @param type $userId
     */
    public function setUserSoc($id, $soc, $userId) {
        $this->db->set('socialId', $id);
        $this->db->set('userId', $userId);
        $this->db->set('social', $soc);
        $this->db->set('isMain', '1');
        $this->db->insert('mod_social');
    }

    /**
     * Delete user social
     * @param type $soc
     * @return type
     */
    public function delUserSocial($soc) {
        return $this->db->delete('mod_social', array('social' => $soc, 'userId' => $this->dx_auth->get_user_id()));
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getUserSocInfoBySocId($id) {
        return $this->db
                        ->where('socialId', $id)
                        ->get('mod_social')
                        ->row();
    }

    /**
     * 
     * @param type $email
     * @return type
     */
    public function getUserByEmail($email) {
        return $this->db
                        ->where('email', $email)
                        ->get('users', 1)
                        ->result_array();
    }

}

?>
