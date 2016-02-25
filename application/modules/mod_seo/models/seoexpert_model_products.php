<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model_products extends CI_Model
{

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
                    WHERE  `shop_category_i18n`.`locale` =  '$locale'";

        $res = $this->db->query($sql);
        if ($categories = $res->result_array()) {
            foreach ($categories as $key => $value) {
                $categories[$key]['settings'] = unserialize($value['settings']);
            }
            return $categories;
        }
        return false;
    }

    /**
     * Get product category settings by id
     * @param bool|int $id
     * @param bool|string $locale
     * @return array|bool
     */
    public function getProductCategory($id = false, $locale = false) {

        if (!$id) {
            return false;
        }
        $locale = $locale ?: MY_Controller::getCurrentLocale();

        $category = $this->db
            ->where('cat_id', $id)
            ->where('locale', $locale)
            ->get('mod_seo_products')
            ->row_array();

        if ($category) {
            $category['settings'] = unserialize($category['settings']);
            return $category;
        }

        return false;
    }

    /**
     * Set product category settings
     * @param bool|int $id Category ID
     * @param array $settings
     * @param bool|string $locale
     * @return bool
     */
    public function setProductCategory($id = false, array $settings = [], $locale = false) {

        if (!$id || !$settings) {
            return false;
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
    }

    /**
     * Get category by id,locale
     * @param bool|int $id
     * @param bool|string $locale
     * @return array|bool
     */
    public function getCategoryByIdAndLocale($id = false, $locale = false) {

        if (!$id) {
            return false;
        }

        $locale = $locale ?: MY_Controller::getCurrentLocale();

        $query = $this->db->select('name')->where('id', $id)->where('locale', $locale)->get('shop_category_i18n')->row_array();
        if ($query) {
            return $query;
        }
        return false;
    }

    /**
     * Get categories ids array
     * @return boolean|array
     */
    public function getCategoriesArray() {

        $res = $this->db->where('active', '1')
            ->select('cat_id')
            ->get('mod_seo_products')
            ->result_array();

        $ids = [];
        if ($res) {
            foreach ($res as $value) {
                $ids[] = $value['cat_id'];
            }
            return $ids;
        }
        return false;
    }

    /**
     * Get category name by id
     * @param bool|int $id
     * @return array|bool
     * -id
     * -id
     * -name
     */
    public function getCategoryNameAndId($id = false) {

        if (!$id) {
            return false;
        }
        $res = $this->db->where('id', $id)->get('shop_category_i18n')->row_array();

        if ($res) {
            return $res;
        }
        return false;
    }

    /**
     * Delete category by id
     * @param bool|int $id
     * @return bool
     */
    public function deleteCategoryById($id = false) {

        if (!$id) {
            return false;
        }
        return $this->db->where('cat_id', $id)->delete('mod_seo_products');
    }

    /**
     * Change category active
     * @param null|int $id
     * @return bool
     */
    public function changeActiveCategory($id = null) {

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
        // If updated active success then return TRUE
        if ($this->db->where('cat_id', $id)->update('mod_seo_products', ['active' => $active, 'settings' => $settings])) {
            return true;
        }

        return false;
    }

    /**
     * Change use for empty meta
     * @param null|int $id
     * @return bool
     */
    public function changeEmptyMetaCategory($id = null) {

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

        // If updated active success then return TRUE
        if ($this->db->where('cat_id', $id)->update('mod_seo_products', ['empty_meta' => $active, 'settings' => $settings])) {
            return true;
        }

        return false;
    }

}