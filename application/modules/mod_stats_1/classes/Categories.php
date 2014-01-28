<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author Igor
 */
class Categories extends \MY_Controller {

    protected static $_instanse;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model_categories');
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }
    /**
     * 
     * @return Categories
     */
    public static function create() {

        (null !== self::$_instanse) OR self::$_instanse = new self();
        return self::$_instanse;
    }
    
    
    
    public function getBrandsInCategories(){
        /** Get children categories ids**/
        $childCategoriesIds = $this->stats_model_categories->getAllChildCategoriesIds($_COOKIE['cat_id_for_stats']);
        /** Get brands in category **/
        $brands = $this->stats_model_categories->getBrandsIdsAndCount($childCategoriesIds);
        
        /**  data for pie diagram **/
        $pieData = array();
        foreach ($brands as $brand) {
            $pieData[] = array(
                'key' => $brand['name'],
                'y' => (int) $brand['count']
            );
        }

        return json_encode(array(
            'type' => 'pie',
            'data' => $pieData
        ));
    }
    
    public function templateBrandsInCategories(){
        return \ShopCore::app()->SCategoryTree->getTree();
    }
    
    public function getMostVisited() {
        

    }

}
?>
