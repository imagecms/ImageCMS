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
        $temp = $ci->db->get('mod_ymarket')->row_array();
        $this->settings['adult'] = $temp['adult'];
        $this->settings['unserCats'] = unserialize($temp['categories']);
        return $this->settings;
    }

    /**
     * Selection of products in the categories specified by the user
     * @return array Products and products variants         
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

    /**
     * Model saves the selected user categories in the table
     */
    public function setCategories() {
        $tempCats  = $this->input->post('displayedCats')?serialize($this->input->post('displayedCats')):'';
        $tempAdult = $this->input->post('adult')?1:0;        
            $this->db->update('mod_ymarket', array('categories' => $tempCats, 'adult' => $tempAdult));
    }

}
