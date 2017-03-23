<?php
use mod_stats\classes\MyDateInterval;

/**
 * Class Attendance_model for mod_stats module
 * @uses \CI_Model
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package ImageCMSModule
 */
class Attendance_model extends CI_Model
{

    /**
     * Common attendance by unique users per day(month|year)
     * @param array $params_
     *  - interval (string) day|month|year
     *  - dateFrom (string) YYYY-MM-DD
     *  - dateTo (string) YYYY-MM-DD
     *  - type (string) registered|unregistered|all
     * @return boolean
     */
    public function getCommonAttendance(array $params_ = []) {
        $params = [
                   'interval' => 'day',
                   'dateFrom' => NULL,
                   'dateTo'   => NULL,
                   'type'     => 'all',
                  ];

        foreach ($params_ as $key => $value) {
            if (array_key_exists($key, $params)) {
                $params[$key] = $params_[$key];
            }
        }

        $registeredCondition = '';
        if ($params['type'] != 'all') {
            $sign = $params['type'] == 'registered' ? '>' : '<';
            $registeredCondition = "AND `id_user` {$sign} 0 ";
        }

        $query = "
            SELECT 
                `time_add` as `unix_date`,
                DATE_FORMAT(FROM_UNIXTIME(`time_add`), '" . MyDateInterval::getDatePattern($params['interval']) . "') as `date`,
                COUNT(DISTINCT `id_user`) as `users_count`
            FROM 
                `mod_stats_attendance`
            WHERE 1 
                " . MyDateInterval::prepareDateBetweenCondition('time_add', $params) . "
                {$registeredCondition}
            GROUP BY 
                `date`
        ";

        $result = $this->db->query($query);

        if ($result === FALSE) {
            return FALSE;
        }

        return $result->result_array();
    }

    /**
     * Return array with users wich last activity was less then 2 minutes ago
     * @return boolean
     */
    public function getOnline() {
        $locale = MY_Controller::getCurrentLocale();
        $query = "
            SELECT 
                `mod_stats_attendance`.`id_user`,
                `mod_stats_attendance`.`type_id`,
                `mod_stats_attendance`.`id_entity`,
                IF (`mod_stats_attendance`.`id_user` < 0, 'Guest', `users`.`username`) as `username`,
                IF (`mod_stats_attendance`.`id_user` < 0, '', `users`.`email`) as `email`,
                FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) as `last_activity`,
               
                -- ---- for urls ----
               route.url AS `last_url`,   
                -- ------------------

                -- ---- for names ----
            CASE `mod_stats_attendance`.`type_id`
            WHEN 1
              THEN IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url)
            WHEN 2
              THEN IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url)
            WHEN 3
              THEN `shop_category_i18n`.`name`
            WHEN 4
              THEN `shop_products_i18n`.`name`
            END as `page_name`   
                -- ------------------
            FROM 
                (SELECT * FROM `mod_stats_attendance` ORDER BY `id` DESC) as `mod_stats_attendance` 
            LEFT JOIN `users` ON `users`.`id` = `mod_stats_attendance`.`id_user`

            -- ---- for urls ----
            LEFT JOIN `content` ON `content`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 1
            LEFT JOIN `category` ON `category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 2
            LEFT JOIN `shop_category` ON `shop_category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 3
            LEFT JOIN `shop_products` ON `shop_products`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 4
            -- ------------------
            
             -- ---- for names ----
            LEFT JOIN `shop_category_i18n` ON `shop_category`.`id` = `shop_category_i18n`.`id` 
                AND `shop_category_i18n`.`locale` = '{$locale}'
            LEFT JOIN `shop_products_i18n` ON `shop_products`.`id` = `shop_products_i18n`.`id` 
                AND `shop_products_i18n`.`locale` = '{$locale}'
            -- ------------------

            LEFT JOIN route ON route.entity_id = `mod_stats_attendance`.id_entity AND type = (
              CASE `mod_stats_attendance`.`type_id`
              WHEN 1
                THEN 'page'
              WHEN 2
                THEN 'category'
              WHEN 3
                THEN 'shop_category'
              WHEN 4
                THEN 'product'
              END
            )

            WHERE 1
                AND FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) >= NOW() - INTERVAL 120 SECOND
            GROUP BY 
                `mod_stats_attendance`.`id_user`
            ORDER BY 
                `mod_stats_attendance`.`id` DESC
        ";

        $results = $this->db->query($query);

        if ($results) {
            $results = $results->result_array();
            foreach ($results as &$result) {
                if ($result['type_id'] == Attendance::PAGE) {
                    $result['last_url'] = $this->getUrl($result['id_entity'], \core\models\Route::TYPE_PAGE);
                } elseif ($result['type_id'] == Attendance::CATEGORY) {
                    $result['last_url'] = $this->getUrl($result['id_entity'], \core\models\Route::TYPE_CATEGORY);
                } elseif ($result['type_id'] == Attendance::SHOP_CATEGORY) {
                    $result['last_url'] = $this->getUrl($result['id_entity'], \core\models\Route::TYPE_SHOP_CATEGORY);
                } elseif ($result['type_id'] == Attendance::PRODUCT) {
                    $result['last_url'] = $this->getUrl($result['id_entity'], \core\models\Route::TYPE_PRODUCT);
                }
            }

            return $results;
        }

        return false;
    }

    protected function getUrl($id, $type) {
        $urlConfiguration = \core\src\CoreFactory::getConfiguration()->getUrlRules();
        $url              = \core\models\RouteQuery::create()->filterByEntityId($id)->filterByType($type)->findOneOrCreate();
        if ($type == \core\models\Route::TYPE_SHOP_CATEGORY) {
            if ($urlConfiguration['shop_category']['parent'] === '1') {
                $url = $url->getFullUrl();
            } else {
                $url = $url->getUrl();
            }
            if ($urlConfiguration['shop_category']['prefix'] != '') {
                $url = rtrim($urlConfiguration['shop_category']['prefix'], '/') . '/' . $url;
            }

            return $url;
        } elseif ($type == \core\models\Route::TYPE_PRODUCT) {
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

    /**
     * Dynamic of categories attendance
     * @param array $params standart params (date, interval)
     * @param array $categoriesIds ids of categories witch attendance return
     * @return array
     */
    public function getCategoriesAttendance(array $params, array $categoriesIds) {
        $datePattern = MyDateInterval::getDatePattern($params['interval']);
        $dateBetween = MyDateInterval::prepareDateBetweenCondition('time_add', $params);

        $categoriesAttendance = [];
        foreach ($categoriesIds as $categoryId => $categoryIds) {
            $condition = 'AND `id_entity` IN (' . implode(',', $categoryIds) . ')';

            $query = "
                SELECT 
                    `time_add` as `unix_date`,
                    DATE_FORMAT(FROM_UNIXTIME(`time_add`), '{$datePattern}') as `date`,
                    COUNT(DISTINCT `id_user`) as `users_count`
                FROM 
                    `mod_stats_attendance`
                WHERE 1 
                    AND `type_id` = 3
                    {$condition}
                    {$dateBetween}
                GROUP BY 
                    `date`
            ";

            $categoriesAttendance[$categoryId] = $this->db->query($query)->result_array();
        }

        return $categoriesAttendance;
    }

    /**
     * Returns "serfing" history of specified user
     * @param integer $userId
     * @return array
     */
    public function getUserHistory($userId) {
        if (!is_numeric($userId)) {
            return FALSE;
        }

        $locale = MY_Controller::getCurrentLocale();

        $query = "
            SELECT 
                `mod_stats_attendance`.`type_id`,
                `mod_stats_attendance`.`id_entity`,
                FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) as `time`,
                
                -- ---- for urls ----
                CASE `mod_stats_attendance`.`type_id`
                    WHEN 1 THEN `content`.`title`
                    WHEN 2 THEN `category`.`title`
                    WHEN 3 THEN CONCAT('shop/category/',`shop_category`.`full_path`)
                    WHEN 4 THEN CONCAT('shop/product/',`shop_products`.`url`)
                END as `url`,
                -- ------------------
                
                -- ---- for names ----
                CASE `mod_stats_attendance`.`type_id`
                    WHEN 1 THEN CONCAT(`content`.`cat_url`, `content`.`url`)
                    WHEN 2 THEN `category`.`url`
                    WHEN 3 THEN `shop_category_i18n`.`name`
                    WHEN 4 THEN `shop_products_i18n`.`name`
                END as `page_name`   
                -- ------------------
            FROM 
                `mod_stats_attendance`
                
            -- ---- for urls ----
            LEFT JOIN `content` ON `content`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 1
            LEFT JOIN `category` ON `category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 2
            LEFT JOIN `shop_category` ON `shop_category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 3
            LEFT JOIN `shop_products` ON `shop_products`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 4
            -- ------------------
            

            -- ---- for names ----
            LEFT JOIN `shop_category_i18n` ON `shop_category`.`id` = `shop_category_i18n`.`id` 
                AND `shop_category_i18n`.`locale` = '{$locale}'
            LEFT JOIN `shop_products_i18n` ON `shop_products`.`id` = `shop_products_i18n`.`id` 
                AND `shop_products_i18n`.`locale` = '{$locale}'
            -- ------------------
            

            WHERE 
                `id_user` = $userId
            ORDER BY
                `time_add` DESC
                
            LIMIT 200
                
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->result_array();
        }
        return FALSE;
    }

    public function getRobotAttendance($robotId, $date) {
        $locale = MY_Controller::getCurrentLocale();

        $from = strtotime($date . ' 00:00:00');
        $to = strtotime($date . ' 23:59:59');

        $query = "
            SELECT 
                `mod_stats_attendance_robots`.`type_id`,
                `mod_stats_attendance_robots`.`id_entity`,
                FROM_UNIXTIME(`mod_stats_attendance_robots`.`time_add`) as `time`,
                
                -- ---- for urls ----
                CASE `mod_stats_attendance_robots`.`type_id`
                    WHEN 1 THEN `content`.`title`
                    WHEN 2 THEN `category`.`title`
                    WHEN 3 THEN CONCAT('shop/category/',`shop_category`.`full_path`)
                    WHEN 4 THEN CONCAT('shop/product/',`shop_products`.`url`)
                END as `url`,
                -- ------------------
                
                -- ---- for names ----
                CASE `mod_stats_attendance_robots`.`type_id`
                    WHEN 1 THEN CONCAT(`content`.`cat_url`, `content`.`url`)
                    WHEN 2 THEN `category`.`url`
                    WHEN 3 THEN `shop_category_i18n`.`name`
                    WHEN 4 THEN `shop_products_i18n`.`name`
                END as `page_name`   
                -- ------------------
            FROM 
                `mod_stats_attendance_robots`
                
            -- ---- for urls ----
            LEFT JOIN `content` ON `content`.`id` = `mod_stats_attendance_robots`.`id_entity` 
                AND `mod_stats_attendance_robots`.`type_id` = 1
            LEFT JOIN `category` ON `category`.`id` = `mod_stats_attendance_robots`.`id_entity` 
                AND `mod_stats_attendance_robots`.`type_id` = 2
            LEFT JOIN `shop_category` ON `shop_category`.`id` = `mod_stats_attendance_robots`.`id_entity` 
                AND `mod_stats_attendance_robots`.`type_id` = 3
            LEFT JOIN `shop_products` ON `shop_products`.`id` = `mod_stats_attendance_robots`.`id_entity` 
                AND `mod_stats_attendance_robots`.`type_id` = 4
            -- ------------------
            
            -- ---- for names ----
            LEFT JOIN `shop_category_i18n` ON `shop_category`.`id` = `shop_category_i18n`.`id` 
                AND `shop_category_i18n`.`locale` = '{$locale}'
            LEFT JOIN `shop_products_i18n` ON `shop_products`.`id` = `shop_products_i18n`.`id` 
                AND `shop_products_i18n`.`locale` = '{$locale}'
            -- ------------------

            WHERE 1
                AND `mod_stats_attendance_robots`.`id_robot` = {$robotId}
                AND `mod_stats_attendance_robots`.`time_add` > {$from}
                AND `mod_stats_attendance_robots`.`time_add` < {$to}
            ORDER BY
                `mod_stats_attendance_robots`.`time_add` DESC
                
        ";

        $result = $this->db->query($query);

        if ($result) {
            return $result->result_array();
        }
        return FALSE;
    }

}