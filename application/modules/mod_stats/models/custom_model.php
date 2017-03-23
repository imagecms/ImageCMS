<?php
use core\models\Route;
use core\models\RouteQuery;
use core\src\CoreFactory;

/**
 * Class Attendance_model for mod_stats module
 *
 * @uses          \CI_Model
 * @author        DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package       ImageCMSModule
 */
class Custom_model extends CI_Model
{

    /**
     *
     * @return int
     */
    public function getAllTimeCountUnique() {
        $query
            = '
            SELECT 
                COUNT(DISTINCT `id_user`) AS `count`
            FROM 
                `mod_stats_attendance`
        ';

        return $this->db->query($query)->row()->count;
    }

    /**
     *
     * @return int
     */
    public function getAllTimeCountUniqueRobots() {
        $query
            = '
            SELECT 
                COUNT(DISTINCT `id_robot`) AS `count`
            FROM 
                `mod_stats_attendance_robots`
        ';

        return $this->db->query($query)->row()->count;
    }

    /**
     *
     * @return int
     */
    public function getLastViewedPage() {
        $locale = MY_Controller::getCurrentLocale();

        $query
                = "
SELECT
    `users`.`username`,
    `type_id`,
    `route`.`type`,
    `id_entity`,
    (CASE `mod_stats_attendance`.`type_id` 
    WHEN 1 THEN `content`.`title` 
    WHEN 2 THEN `category`.`name`
    WHEN 3 THEN `shop_category_i18n`.`name` 
    WHEN 4 THEN `shop_products_i18n`.`name`
END) AS `page_name`
FROM
    `mod_stats_attendance`
LEFT JOIN
    route
ON
    route.entity_id = mod_stats_attendance.id_entity
LEFT JOIN
    `content`
ON
    `content`.`id` = `mod_stats_attendance`.`id_entity` AND `mod_stats_attendance`.`type_id` = 1
LEFT JOIN
    `category`
ON
    `category`.`id` = `mod_stats_attendance`.`id_entity` AND `mod_stats_attendance`.`type_id` = 2
LEFT JOIN
    `shop_category`
ON
    `shop_category`.`id` = `mod_stats_attendance`.`id_entity` AND `mod_stats_attendance`.`type_id` = 3
LEFT JOIN
    `shop_products`
ON
    `shop_products`.`id` = `mod_stats_attendance`.`id_entity` AND `mod_stats_attendance`.`type_id` = 4
LEFT JOIN
    `shop_category_i18n`
ON
    `shop_category`.`id` = `shop_category_i18n`.`id` AND `shop_category_i18n`.`locale` = '{$locale}'
LEFT JOIN
    `shop_products_i18n`
ON
    `shop_products`.`id` = `shop_products_i18n`.`id` AND `shop_products_i18n`.`locale` = '{$locale}'
LEFT JOIN
    `users`
ON
    `users`.`id` = `mod_stats_attendance`.`id_user`
ORDER BY
    `mod_stats_attendance`.`time_add`
DESC
LIMIT 1
        ";
        $result = $this->db->query($query);
        if ($result) {
            $result = $result->row_array();
            if ($result['type_id'] == Attendance::PAGE) {
                $result['url'] = $this->getUrl($result['id_entity'], Route::TYPE_PAGE);
            } elseif ($result['type_id'] == Attendance::CATEGORY) {
                $result['url'] = $this->getUrl($result['id_entity'], Route::TYPE_CATEGORY);
            } elseif ($result['type_id'] == Attendance::SHOP_CATEGORY) {
                $result['url'] = $this->getUrl($result['id_entity'], Route::TYPE_SHOP_CATEGORY);
            } elseif ($result['type_id'] == Attendance::PRODUCT) {
                $result['url'] = $this->getUrl($result['id_entity'], Route::TYPE_PRODUCT);
            }

            return $result;
        }

        return false;
    }

    protected function getUrl($id, $type) {
        $urlConfiguration = CoreFactory::getConfiguration()->getUrlRules();
        $url              = RouteQuery::create()->filterByEntityId($id)->filterByType($type)->findOneOrCreate();
        if ($type == Route::TYPE_SHOP_CATEGORY) {
            if ($urlConfiguration['shop_category']['parent'] === '1') {
                $url = $url->getFullUrl();
            } else {
                $url = $url->getUrl();
            }
            if ($urlConfiguration['shop_category']['prefix'] != '') {
                $url = rtrim($urlConfiguration['shop_category']['prefix'], '/') . '/' . $url;
            }

            return $url;
        } elseif ($type == Route::TYPE_PRODUCT) {
            if ($urlConfiguration['product']['parent'] === '1') {
                $url = $url->getFullUrl();
            } else {
                $url = $url->getUrl();
            }
            if ($urlConfiguration['product']['prefix'] != '') {
                $url = rtrim($urlConfiguration['product']['prefix'], '/') . '/' . $url;
            }

            return $url;
        } else {
            return $url->getFullUrl();
        }

    }

    protected function getCategoryUrl($id) {
        $res = $this->db->select(
            [
             'url',
             'parent_id',
            ]
        )->where('id', $id)->get('category');
        if ($res = $res->row_array()) {
            $parent_url = $this->getCategoryUrl($res['parent_id']);

            return ($parent_url ? $parent_url . '/' : '') . $res['url'];
        }
    }

}