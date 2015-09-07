<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Ymarket_model extends CI_Model {

    const DEFAULT_TYPE = 1;
    const PRICE_UA_TYPE = 2;
    const NADAVI_UA_TYPE = 3;

    public $settings;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Selects the category assigned by the user
     * @return object Information about the selected category
     */
    public function init($type) {

        $temp = $this->db->where('id', $type)->get('mod_ymarket');
        $this->settings = $this->cms_base->get_settings();
        if ($temp) {
            $temp = $temp->row_array();

            $this->settings['adult'] = $temp['adult'];
            $this->settings['unserCats'] = unserialize($temp['categories']);
            $this->settings['unserBrands'] = unserialize($temp['brands']);
        }
        return $this->settings;
    }

    /**
     * Selects the category assigned by the user
     * @return object Information about the selected category
     */
    public function getBrands() {

        $temp = $this->db
            ->where('locale', \MY_Controller::getCurrentLocale())
            ->get('shop_brands_i18n');

        if ($temp) {
            $temp = $temp->result_array();
        }
        return $temp;
    }

    /**
     * Selection of products in the categories specified by the user
     * @return array Products and products variants
     */
    public function getProducts($idsCat, $ignoreSettings = false, $brandIds) {
        $products = SProductsQuery::create()
            ->distinct();
        if (!$ignoreSettings) {
            if ($idsCat) {
                $products->filterByCategoryId($idsCat);
            }

            if ($brandIds) {
                $products = $products->filterByBrandId($brandIds);
            }

            $products = $products->useProductVariantQuery()
                ->filterByStock(['min' => 1])
                ->filterByPrice(['min' => 0.00001])
                ->endUse()
                ->filterByActive(true);
        }
        $res = $products->find();
        $res->populateRelation('ProductVariant');
        return $res;
    }

    public function getVariants($idsCat, $ignoreSettings = false, $brandIds) {
        if (!$ignoreSettings) {
            $variants = SProductVariantsQuery::create()
                ->useSProductsQuery()
                ->filterByActive(true)
                ->_if($idsCat)
                ->filterByCategoryId($idsCat)
                ->_endif()
                ->_if($brandIds)
                ->filterByBrandId($brandIds)
                ->_endif()
                ->distinct()
                ->endUse()
                ->filterByStock(array('min' => 1))
                ->filterByPrice(array('min' => 0.00001))
                ->find();
        } else {
            $variants = SProductVariantsQuery::create()
                ->useSProductsQuery()
                ->distinct()
                ->endUse()
                ->find();
        }
        return $variants;
    }

    /**
     * Model saves the selected user categories in the table
     */
    public function setCategories() {
        $tempCats = $this->input->post('displayedCats') ? serialize($this->input->post('displayedCats')) : '';
        $displayedBrands = $this->input->post('displayedBrands') ? serialize($this->input->post('displayedBrands')) : '';
        $tempAdult = $this->input->post('adult') ? 1 : 0;

        $tempCatsPriceUa = $this->input->post('displayedCatsPriceUa') ? serialize($this->input->post('displayedCatsPriceUa')) : '';
        $displayedBrandsPriceUa = $this->input->post('displayedBrandsPriceUa') ? serialize($this->input->post('displayedBrandsPriceUa')) : '';

        $tempCatsNadaviUa = $this->input->post('displayedCatsNadaviUa') ? serialize($this->input->post('displayedCatsNadaviUa')) : '';
        $displayedBrandsNadaviUa = $this->input->post('displayedBrandsNadaviUa') ? serialize($this->input->post('displayedBrandsNadaviUa')) : '';

        $idsTemp = $this->db->select('id')->get('mod_ymarket')->result_array();
        $ids = [];
        foreach ($idsTemp as $v) {
            $ids[] = $v['id'];
        }

        $data = ['id' => self::DEFAULT_TYPE, 'categories' => $tempCats, 'brands' => $displayedBrands, 'adult' => $tempAdult];
        $this->saveCategoriesSettings($data, in_array(self::DEFAULT_TYPE, $ids));

        $data = ['id' => self::PRICE_UA_TYPE, 'categories' => $tempCatsPriceUa, 'brands' => $displayedBrandsPriceUa, 'adult' => 0];
        $this->saveCategoriesSettings($data, in_array(self::PRICE_UA_TYPE, $ids));

        $data = ['id' => self::NADAVI_UA_TYPE, 'categories' => $tempCatsNadaviUa, 'brands' => $displayedBrandsNadaviUa, 'adult' => 0];
        $this->saveCategoriesSettings($data, in_array(self::NADAVI_UA_TYPE, $ids));
    }

    /**
     * @param $data - array to save into DB
     * @param bool $update - update or insert, default update
     */
    private function saveCategoriesSettings($data, $update = true) {
        if ($update) {
            $this->db->where('id', $data['id'])
                ->update('mod_ymarket', $data);
        } else {
            $this->db->insert('mod_ymarket', $data);
        }
    }

}