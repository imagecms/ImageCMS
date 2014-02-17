<?php

/**
 * Class Attendance_model for mod_stats module
 * @uses \CI_Model
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package ImageCMSModule
 */
class Custom_model extends CI_Model {

    /**
     * 
     * @return int
     */
    public function getAllTimeCountUnique() {
        $query = "
            SELECT 
                COUNT(DISTINCT `id_user`) as `count`
            FROM 
                `mod_stats_attendance`
        ";

        return $this->db->query($query)->row()->count;
    }

    /**
     * 
     * @return int
     */
    public function getAllTimeCountUniqueRobots() {
        $query = "
            SELECT 
                COUNT(DISTINCT `id_robot`) as `count`
            FROM 
                `mod_stats_attendance_robots`
        ";

        return $this->db->query($query)->row()->count;
    }

    /**
     * 
     * @return int
     */
    public function getLastViewedPage() {
        $locale = MY_Controller::getCurrentLocale();

        $query = "
            SELECT 
                
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
                END as `page_name`,
                -- ------------------
                
                `users`.`username`
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
            
            LEFT JOIN `users` ON `users`.`id` = `mod_stats_attendance`.`id_user` 
            
            ORDER BY
                `time_add` DESC
            LIMIT 1
        ";

        $result = $this->db->query($query);

        if ($result) {
            return $result->row_array();
        }
        return FALSE;
    }

}
