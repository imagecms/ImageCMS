<?php

class Socauth_model extends CI_Model
{

    public function __construct() {
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
        $data = [
                 'socialId' => $id,
                 'userId'   => $userId,
                 'social'   => $soc,
                 'isMain'   => 1,
                ];

        $this->db->insert('mod_social', $data);
    }

    /**
     * Delete user social
     * @param string $soc
     * @return bool
     */
    public function delUserSocial($soc) {
        return $this->db->delete('mod_social', ['social' => $soc, 'userId' => $this->dx_auth->get_user_id()]);
    }

    /**
     *
     * @param int $id
     * @return object
     */
    public function getUserSocInfoBySocId($id) {
        return $this->db
            ->where('socialId', $id)
            ->get('mod_social')
            ->row();
    }

    /**
     *
     * @param string $email
     * @return array
     */
    public function getUserByEmail($email) {
        return $this->db
            ->where('email', $email)
            ->get('users')
            ->row_array();
    }

}