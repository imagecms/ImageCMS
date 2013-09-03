<?php

namespace mod_stats\models;

/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class ProductsBase {

    protected static $instanse;

    /**
     * 
     * @var ActiveRecord
     */
    protected $db;

    private function __construct() {
        $ci = &get_instance();
        $this->db = $ci->db;
    }

    private function __clone() {
        
    }

    /**
     * 
     * @return ProductsBase
     */
    public static function getInstance() {
        if (is_null(self::$instanse)) {
            self::$instanse = new ProductsBase();
        }
        return self::$instanse;
    }

    /**
     * Getting data for selecting brands
     * @return array each brand name and id
     */
    public function getBrands() {
        $locale = \MY_Controller::getCurrentLocale();
        $result = $this->db
                ->select('shop_brands.id,name')
                ->from('shop_brands')
                ->join('shop_brands_i18n', 'shop_brands_i18n.id = shop_brands.id')
                ->where('locale', $locale)
                ->get();
        $brandsList = array();
        foreach ($result->result_array() as $row) {
            $brandsList[] = $row;
        }
        return $brandsList;
    }

}

?>
