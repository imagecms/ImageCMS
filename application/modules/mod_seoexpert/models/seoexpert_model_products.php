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

        if (!$id && !$locale) {
            return FALSE;
        }

//        $this->db->cache_on();
        $category = $this->db
                ->where('id', $id)
                ->where('locale', $locale)
                ->get('mod_seoexpert_products');
//        $this->db->cache_off();


        if ($category->row_array()) {
            $category['settings'] = unserialize($category['settings']);
            return $category;
        }
        return FALSE;
    }

    public function setProductCategory($locale = FALSE,$id = FALSE ) {

        $data = $this->db->select('locale')
                ->where('locale', $locale)
                ->get('mod_seoexpert_products')
                ->row_array();

        if (empty($data))
            return $this->db->insert('mod_seoexpert_products', array('locale' => $locale, 'settings' => serialize($settings)));

        return $this->db->where('locale', $locale)
                        ->update('mod_seoexpert_products', array('settings' => serialize($settings)
        ));
    }

}
