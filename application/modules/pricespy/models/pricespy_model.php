<?php

class Pricespy_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     */
    public function getSettings() {
        $settings = $this->db
                ->select('settings')
                ->where('identif', 'pricespy')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings[settings]);
        return $settings;
    }

    /**
     * Deleting user spys products from list
     * @param type $ids
     * @return type
     */
    public function delSpysbyIds($ids) {
        $this->db->where_in('productId', $ids);
        return $this->db->delete('mod_price_spy');
    }

    /**
     * Deleting user spys products from list
     * @param type $hash
     * @return type
     */
    public function delSpyByHash($hash) {
        return $this->db->delete('mod_price_spy', array('hash' => $hash));
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function getProductById($id) {
        return $product = $this->db
                ->where('id', $varId)
                ->get('shop_product_variants')
                ->row();
    }

    /**
     * Insert new spy for user
     * @param type $id
     * @param type $varId
     * @param type $productPrice
     * @return type
     */
    public function setSpy($id, $varId, $productPrice) {
        return $this->db
                        ->set('userId', $this->dx_auth->get_user_id())
                        ->set('productId', $id)
                        ->set('productVariantId', $varId)
                        ->set('productPrice', $productPrice)
                        ->set('oldProductPrice', $productPrice)
                        ->set('hash', random_string('unique', 15))
                        ->insert('mod_price_spy');
    }

}

?>
