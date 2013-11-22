<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Export_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
      $this->products = $this->ci->db->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')->get('shop_products')->result_array();
      $this->categories = $this->ci->db->join('shop_category_i18n', 'shop_category_i18n.id=shop_category.id')->get('shop_category')->result_array();
      $this->users = $this->ci->db->get('users')->result_array();
      $this->orders = $this->ci->db->get('shop_orders')->result_array();
      $this->productivity = $this->ci->db->get('mod_exchangeunfu_productivity')->result_array();
      $this->partners = $this->ci->db->get('mod_exchangeunfu_partners')->result_array();
      $this->prices = $this->ci->db->get('mod_exchangeunfu_prices')->result_array();
     */
    public function getProducts($products_ids = array()) {

        if (!empty($products_ids)) {
            $query = $this->db->where_in('external_id', $products_ids)
                    ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                    ->join('shop_product_variants', 'shop_products.id=shop_product_variants.product_id')
                    ->get('shop_products');
        } else {
            $query = $this->db
                    ->join('shop_product_variants', 'shop_products.id=shop_product_variants.product_id')
                    ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                    ->get('shop_products');
        }

        return $this->returnResults($query);
    }

    public function getCategories() {
        $query = $this->db->join('shop_category_i18n', 'shop_category_i18n.id=shop_category.id')
                ->get('shop_category');
        return $this->returnResults($query);
    }

    public function getUsers() {
        $query = $this->db
                ->get('users');
        return $this->returnResults($query);
    }

    public function getOrders($partner_id = null) {
        $config = $this->db
                ->where('identif', 'exchangeunfu')
                ->get('components')
                ->row_array();
        $config = unserialize($config['settings']);

        if ($partner_id) {
            $query = $this->db
                    ->where_in('status', $config['userstatuses'])
                    ->where('partner_external_id', $partner_id)
                    ->get('shop_orders');
        } else {
            $query = $this->db
                    ->where_in('status', $config['userstatuses'])
                    ->get('shop_orders');
        }

        return $this->returnResults($query);
    }

    public function getProductivity($partner_id = null) {
        if ($partner_id) {
            $query = $this->db->where('partner_external_id', $partner_id)
                    ->get('mod_exchangeunfu_productivity');
        } else {
            $query = $this->db
                    ->get('mod_exchangeunfu_productivity');
        }

        return $this->returnResults($query);
    }

    public function getPartners($partner_id = null) {
        if ($partner_id) {
            $query = $this->db->where('external_id', $partner_id)
                    ->get('mod_exchangeunfu_partners');
        } else {
            $query = $this->db
                    ->get('mod_exchangeunfu_partners');
        }
        return $this->returnResults($query);
    }

    public function getPrices($partner_id = null) {
        if ($partner_id) {
            $query = $this->db->where('partner_external_id', $partner_id)
                    ->get('mod_exchangeunfu_prices');
        } else {
            $query = $this->db
                    ->get('mod_exchangeunfu_prices');
        }
        return $this->returnResults($query);
    }

    public function getOrderProducts($order_id) {
        $query = $this->db->where('order_id', $order_id)
                ->get('shop_orders_products');
        return $this->returnResults($query);
    }

    private function returnResults($query) {
        $query ? $query = $query->result_array() : $query = FALSE;
        return $query;
    }

}

?>
