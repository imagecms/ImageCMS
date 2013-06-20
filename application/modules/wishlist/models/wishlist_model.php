<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
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

    public function getWishLists() {
        return $this->db->get('mod_wish_list')->result_array();
    }

    public function getUserWishProducts() {
        $ids = $this->db
                ->where('mod_wish_list.user_id', $this->dx_auth->get_user_id())
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->group_by('variant_id')
                ->get('mod_wish_list')
                ->result_array();

        foreach ($ids as $id) {
            $ID[] = $id[variant_id];
        }

        return $ID;
    }

    public function addItem($varId, $listId, $listName, $commentProduct) {
        if ($listName != 'false') {
            $this->createWishList($listName, $this->dx_auth->get_user_id());
            $listId = $this->db->insert_id();
        }
        $data = array(
            'variant_id' => $varId,
            'wish_list_id' => $listId,
            'comment' => $commentProduct
        );

        return $this->db->insert('mod_wish_list_products', $data);
    }

    public function createWishList($listName, $user_id) {
        $data = array(
            'title' => $listName,
            'user_id' => $user_id
        );
        return $this->db->insert('mod_wish_list', $data);
    }

}

?>
