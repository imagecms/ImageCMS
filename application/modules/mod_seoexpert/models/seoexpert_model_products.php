<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model_products extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get all categories from database
     * @param string $locale
     * @return boolean|array
     */
    public function getAllCategories($locale = 'ru') {
        $sql = "SELECT  `shop_category_i18n`.`id`, `shop_category_i18n`.`name` ,  `mod_seoexpert_products`.`cat_id` ,  `mod_seoexpert_products`.`settings` 
                    FROM  `mod_seoexpert_products` 
                    JOIN  `shop_category_i18n` ON  `mod_seoexpert_products`.`cat_id` =  `shop_category_i18n`.`id` 
                    WHERE  `mod_seoexpert_products`.`locale` =  '" . $locale . "'
                    AND  `shop_category_i18n`.`locale` =  '" . $locale . "'";

        $res = $this->db->query($sql);
        if ($categories = $res->result_array()) {
            foreach ($categories as $key => $value) {
                $categories[$key]['settings'] = unserialize($value['settings']);
            }
            return $categories;
        }
        return FALSE;
    }

    /**
     * Get product category settings by id
     * @param int $id
     * @param string $locale
     * @return boolean|array
     */
    public function getProductCategory($id = FALSE, $locale = FALSE) {

        if (!$id) {
            return FALSE;
        }
        if (!$locale){
            $locale = \MY_Controller::getCurrentLocale();
        }
        
//        $this->db->cache_on();
        $category = $this->db
                ->where('cat_id', $id)
                ->where('locale', $locale)
                ->get('mod_seoexpert_products')
                ->row_array();
//        $this->db->cache_off();


        if ($category) {
            $category['settings'] = unserialize($category['settings']);
            return $category;
        }
        return FALSE;
    }

    /**
     * Set product category settings
     * @param string $locale
     * @param int $id Category ID
     * @param array $settings
     * @return boolean
     */
    public function setProductCategory($id = FALSE, $settings = array(), $locale = FALSE) {

        if (!$id || !$settings) {
            return FALSE;
        }
        
        $data = $this->db
                ->select('locale')
                ->where('cat_id', $id)
                ->where('locale', $locale)
                ->get('mod_seoexpert_products')
                ->row_array();

        if (empty($data))
            return $this->db->insert('mod_seoexpert_products', array('cat_id'=> $id, 'locale' => $locale, 'settings' => serialize($settings)));
        
        
        return $this->db
                        ->where('cat_id', $id)
                        ->where('locale', $locale)
                        ->update('mod_seoexpert_products', array(
                            'settings' => serialize($settings)
        ));

        return FALSE;
    }

    /**
     * Get category by id,locale
     * @param int $id
     * @param string $locale
     * @return boolean|array
     */
    public function getCategoryByIdAndLocale($id = FALSE, $locale = FALSE) {
        if (!$id) {
            return FALSE;
        }
        if (!$locale) {
            $locale = \MY_Controller::getCurrentLocale();
        }

        $query = $this->db->select('name')->where('id', $id)->where('locale', $locale)->get('shop_category_i18n')->row_array();
        if ($query) {
            return $query;
        }
        return FALSE;
    }
    
    /**
     * Get categories ids array
     * @return boolean|array
     */
    public function getCategoriesArray(){
        //        $this->db->cache_on();
        $res = $this->db->select('cat_id')
                ->get('mod_seoexpert_products')
                ->result_array();
        //        $this->db->cache_off();
        
        $ids = array();
        if ($res){
            foreach ($res as $key=>$value){
                $ids[]  = $value['cat_id'];
            }
            return $ids;
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $id
     * @return boolean|array
     * -id
     * -name
     */
    public function getCategoryNameAndId($id = FALSE){
       if (!$id){
           return FALSE;
       } 
       $res = $this->db->where('id',$id)->get('shop_category_i18n')->row_array();
       
       if ($res){
           return $res;
       }
       return FALSE;
    }

}
