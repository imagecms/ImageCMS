<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Products {

    protected static $instanse;

    /**
     * 
     * @return ProductsBase
     */
    public static function getInstance() {
        if (is_null(self::$instanse)) {
            self::$instanse = new Products();
        }
        return self::$instanse;
    }

    /**
     * Getting data from base
     * @param array $data associative array with params
     */
    protected function getDataFromBase($data) {
        
    }

    /**
     * 
     * @param array $params (brands)
     */
    public function getPieData($params) {
        
    }

    public function getAllBrands() {
        return \mod_stats\models\ProductsBase::getInstance()->getAllBrands();
    }

}

?>
