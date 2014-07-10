<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Ymarket_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * Selects the category assigned by the user
     * @return object Information about the selected category
     */
    public function init() {
        $ci = ShopCore::$ci;
        $this->settings = $this->cms_base->get_settings();
        $this->settings['adult'] = $ci->db->where('name', 'adult')->select('value')->get('mod_ymarket')->row()->value;
        $this->settings['unserCats'] = unserialize($ci->db->where('name', 'categories')
                        ->select('value')
                        ->get('mod_ymarket')
                        ->row()
                ->value);
        return $this->settings;
    }
    
    /**
     * Selection of products in the categories specified by the user
     * @return array Product and products variants         
     */
    public function getProducts($idsCat) {
        $products = SProductsQuery::create()
                ->distinct()
                ->filterByCategoryId($idsCat)
                ->useProductVariantQuery()
                    ->filterByStock(array('min' => 1))
                ->endUse()
                ->filterByActive(true)
                ->find();
        $products->populateRelation('ProductVariant');
        return $products;
    }
}