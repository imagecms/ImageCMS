<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model_products extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all categories from database
     * @param string $locale
     * @return boolean|array
     */
    public function getAllCategories($locale = 'ru') {
        $sql = "SELECT  `shop_category_i18n`.`id`, `shop_category_i18n`.`name` ,  `mod_seo_products`.`cat_id` ,
                    `mod_seo_products`.`settings` ,`mod_seo_products`.`active`, `mod_seo_products`.`empty_meta`  
                    FROM  `mod_seo_products` 
                    LEFT JOIN  `shop_category_i18n` ON  `mod_seo_products`.`cat_id` =  `shop_category_i18n`.`id` AND `mod_seo_products`.`locale` =  `shop_category_i18n`.`locale`
                    WHERE  `shop_category_i18n`.`locale` =  '" . $locale . "'";

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
     * @param integer $id
     * @param string $locale
     * @return boolean|array
     */
    public function getProductCategory($id = FALSE, $locale = FALSE) {

        if (!$id) {
            return FALSE;
        }
        if (!$locale) {
            $locale = \MY_Controller::getCurrentLocale();
        }

        //        $this->db->cache_on();
        $category = $this->db
            ->where('cat_id', $id)
            ->where('locale', $locale)
            ->get('mod_seo_products')
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
     * @param integer $id Category ID
     * @param array $settings
     * @param string $locale
     * @return boolean
     */
    public function setProductCategory($id = FALSE, $settings = [], $locale = FALSE) {

        if (!$id || !$settings) {
            return FALSE;
        }

        $data = $this->db
            ->select('locale')
            ->where('cat_id', $id)
            ->where('locale', $locale)
            ->get('mod_seo_products')
            ->row_array();

        if (empty($data)) {
            return $this->db->insert(
                'mod_seo_products',
                ['cat_id' => $id,
                        'locale' => $locale,
                        'settings' => serialize($settings),
                        'active' => $settings['useProductPattern'],
                        'empty_meta' => $settings['useProductPatternForEmptyMeta']
                            ]
            );
        }

        return $this->db
            ->where('cat_id', $id)
            ->where('locale', $locale)
            ->update(
                'mod_seo_products',
                [
                            'settings' => serialize($settings),
                            'active' => $settings['useProductPattern'],
                            'empty_meta' => $settings['useProductPatternForEmptyMeta']
                                ]
            );

        return FALSE;
    }

    /**
     * Get category by id,locale
     * @param integer $id
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
    public function getCategoriesArray() {
        //        $this->db->cache_on();
        $res = $this->db->where('active', '1')
            ->select('cat_id')
            ->get('mod_seo_products')
            ->result_array();
        //        $this->db->cache_off();

        $ids = [];
        if ($res) {
            foreach ($res as $value) {
                $ids[] = $value['cat_id'];
            }
            return $ids;
        }
        return FALSE;
    }

    /**
     * Get category name by id
     * @param type $id
     * @return boolean|array
     * -id
     * -name
     */
    public function getCategoryNameAndId($id = FALSE) {
        if (!$id) {
            return FALSE;
        }
        $res = $this->db->where('id', $id)->get('shop_category_i18n')->row_array();

        if ($res) {
            return $res;
        }
        return FALSE;
    }

    /**
     * Delete category by id
     * @param integer $id
     * @return boolean\
     */
    public function deleteCategoryById($id = FALSE) {
        if (!$id) {
            return FALSE;
        }
        return $this->db->where('cat_id', $id)->delete('mod_seo_products');
    }

    /**
     * Change category active
     * @return boolean
     */
    public function changeActiveCategory($id = NULL) {
        $cat = $this->db->where('cat_id', $id)->get('mod_seo_products')->row();
        $active = $cat->active;
        $unserSettings = unserialize($cat->settings);
        if ($active == 1) {
            $active = 0;
            $unserSettings['useProductPattern'] = 0;
        } else {
            $unserSettings['useProductPattern'] = 1;
            $active = 1;
        }
        $settings = serialize($unserSettings);
        // If updated active succes then return TRUE
        if ($this->db->where('cat_id', $id)->update('mod_seo_products', ['active' => $active, 'settings' => $settings])) {
            return true;
        }

        return false;
    }

    /**
     * Change use for emty meta
     * @return boolean
     */
    public function changeEmptyMetaCategory($id = NULL) {
        $cat = $this->db->where('cat_id', $id)->get('mod_seo_products')->row();
        $active = $cat->empty_meta;

        $unserSettings = unserialize($cat->settings);
        if ($active == 1) {
            $active = 0;
            $unserSettings['useProductPatternForEmptyMeta'] = 0;
        } else {
            $unserSettings['useProductPatternForEmptyMeta'] = 1;
            $active = 1;
        }
        $settings = serialize($unserSettings);

        // If updated active succes then return TRUE
        if ($this->db->where('cat_id', $id)->update('mod_seo_products', ['empty_meta' => $active, 'settings' => $settings])) {
            return true;
        }

        return false;
    }

}