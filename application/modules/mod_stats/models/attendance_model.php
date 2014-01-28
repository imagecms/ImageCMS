<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Attendance_model extends CI_Model {

    use DateIntervalTrait;

    /**
     * 
     * @param array $params
     *  - interval (string) day|month|year
     *  - dateFrom (string) YYYY-MM-DD 
     *  - dateTo (string) YYYY-MM-DD 
     *  - type (string) registered|unregistered|all
     * @return boolean
     */
    public function getCommonAttendance(array $params_ = array()) {
        $params = array(
            'interval' => 'day',
            'dateFrom' => NULL,
            'dateTo' => NULL,
            'type' => 'all'
        );

        foreach ($params_ as $key => $value) {
            if (key_exists($key, $params)) {
                $params[$key] = $params_[$key];
            }
        }

        $registeredCondition = "";
        if ($params['type'] != 'all') {
            $sign = $params['type'] == 'registered' ? '>' : '<';
            $registeredCondition = "AND `id_user` {$sign} 0 ";
        }

        $query = "
            SELECT 
                `time_add` as `unix_date`,
                DATE_FORMAT(FROM_UNIXTIME(`time_add`), '" . $this->getDatePattern($params['interval']) . "') as `date`,
                COUNT(DISTINCT `id_user`) as `users_count`
            FROM 
                `mod_stats_attendance`
            WHERE 1 
                " . $this->prepareDateBetweenCondition('time_add', $params) . " 
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
        $query = "
            SELECT 
                `mod_stats_attendance`.`id_user`,
                `mod_stats_attendance`.`type_id`,
                `mod_stats_attendance`.`id_entity`,
                IF (`mod_stats_attendance`.`id_user` < 0, 'Guest', `users`.`username`) as `username`,
                IF (`mod_stats_attendance`.`id_user` < 0, '', `users`.`email`) as `email`,
                FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) as `last_activity`,
               
                -- ---- for urls ----
                CASE `mod_stats_attendance`.`type_id`
                    WHEN 1 THEN CONCAT(`content`.`cat_url`, `content`.`url`)
                    WHEN 2 THEN `category`.`url`
                    WHEN 3 THEN CONCAT('shop/category/',`shop_category`.`full_path`)
                    WHEN 4 THEN CONCAT('shop/product/',`shop_products`.`url`)
                END as `last_url`   
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

            WHERE 1
                AND FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) >= NOW() - INTERVAL 120 SECOND
            GROUP BY 
                `mod_stats_attendance`.`id_user`
            ORDER BY 
                `mod_stats_attendance`.`id` DESC
        ";
        return $this->db->query($query)->result_array();
    }

    /**
     * 
     * @param array $params standart params (date, interval)
     * @param array $comparedCategories 
     */
    public function getCategoriesAttendance(array $params, array $categoriesIds) {
        $datePattern = $this->getDatePattern($params['interval']);
        //$dateBetween = $this->prepareDateBetweenCondition('time_add', $params);

        $categoriesAttendance = array();
        foreach ($categoriesIds as $categoryId => $categoryIds) {
            $condition = "AND `id_entity` IN (" . implode(',', $categoryIds) . ")";

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
                GROUP BY 
                    `date`
            ";

            $categoriesAttendance[$categoryId] = $this->db->query($query)->result_array();
        }

        return $categoriesAttendance;
    }

    /**
     * 
     * @param int $userId
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

}

?>
