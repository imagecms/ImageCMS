<?php

/**
 * Class Categories_model for mod_stats module
 * @uses \CI_Model
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package ImageCMSModule
 */
class Categories_model extends \CI_Model {

    protected $locale;

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Get brands ids and count 
     * @param array $arrayData
     * @return boolean|array
     */
    public function getBrandsIdsAndCount($arrayData = null) {
        if ($arrayData == null) {
            return FALSE;
        }

        $query = "SELECT `shop_brands_i18n`.`name`,`shop_products`.`brand_id`, COUNT(`shop_products`.`brand_id`) as 'count'
                FROM `shop_products` 
                JOIN `shop_brands_i18n` ON `shop_products`.`brand_id`=`shop_brands_i18n`.`id`
                WHERE `category_id` 
                IN " . $arrayData . " AND `shop_brands_i18n`.`locale` = '" . $this->locale . "'
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
     * Helper function for categories attendance 
     * @param int $parentId (optional) id of category childs wich to return
     * @return array 
     */
    public function getCategoriesList($parentId = NULL) {
        $this->db
                ->select(array(
                    'shop_category.id',
                    'shop_category.parent_id',
                    'shop_category_i18n.name',
                    'shop_category.full_path_ids'
                ))
                ->join('shop_category_i18n', "shop_category_i18n.id=shop_category.id AND shop_category_i18n.locale='" . MY_Controller::getCurrentLocale() . "'", 'left')
                ->order_by('position', 'asc');

        if (is_numeric($parentId)) {
            $this->db->where(array('parent_id' => $parentId));
        }

        $result = $this->db->get('shop_category')
                ->result_array();

        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['full_path_ids'] = unserialize($result[$i]['full_path_ids']);
        }

        return $result;
    }

}

?>
