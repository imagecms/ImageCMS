<?php

/**
 * Description of ProductsBase
 *
 * @author Igor
 */
class Stats_model_categories extends CI_Model {

    private $locale = 'ru';

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    public function getBrandsIdsAndCount($arrayData = null) {
        if ($arrayData == null) {
            return FALSE;
        }

        $query = "SELECT `shop_brands_i18n`.`name`,`shop_products`.`brand_id`, COUNT(`shop_products`.`brand_id`) as 'count'
                FROM `shop_products` 
                JOIN `shop_brands_i18n` ON `shop_products`.`brand_id`=`shop_brands_i18n`.`id`
                WHERE `category_id` 
                IN ".$arrayData." AND `shop_brands_i18n`.`locale` = '".$this->locale."'
                GROUP BY `shop_products`.`brand_id`
                ";
        $result = $this->db->query($query)->result_array();

        return $result;

    }

    /**
     * Get child categories ids
     * @param int $catId
     * @return boolean|array
     */
    public function getAllChildCategoriesIds($catId = null) {
        if ($catId == null) {
            $catId = $this->getCategoryIdFromCookieOrSetFirst();
        }
        
        /** Get full path of curent category* */
        $fullPath = $this->db->select('full_path')->where('id', $catId)->get('shop_category')->row_array();

        if ($fullPath != null) {
            /*             * Get ids of child categories * */
            $result = $this->db->select('id')->from('shop_category')->like('full_path', $fullPath['full_path'])->get()->result_array();
            if ($result != null) {
                return $this->prepareArray($result);
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Prepare array with child categorie's ids
     * @param array $dataArray
     * @return boolean|array
     */
    public function prepareArray($dataArray = null) {
        if ($dataArray == null) {
            return false;
        }
        $result = '(';
        $no = true;
        foreach ($dataArray as $key => $value) {
            if ($no != true) {
                $result .= ',' . $value['id'];
            } else {
                $result .= $value['id'];
                $no = false;
            }
        }
        return $result . ')';
    }

    /**
     * Get category id from cookie or set first
     * @return int
     */
    public function getCategoryIdFromCookieOrSetFirst (){
        $categoryId = $_COOKIE['cat_id_for_stats'];
        if ($categoryId != NULL){
            return $categoryId;
        }else{
            $categories = \ShopCore::app()->SCategoryTree->getTree();
            $firstCategoryId = false;
            foreach ($categories as $category) {
                $firstCategoryId = $category->getId();
                break;
            }
            return $firstCategoryId;
        }
    }
}

?>
