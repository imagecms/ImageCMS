<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Users_model extends CI_Model {

    use DateIntervalTrait;

    protected $locale;

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    protected $params = array(
        'interval' => 'day', //  date interval (string: day|month|year)
        'dateFrom' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
        'dateTo' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
    );

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Setting conditions
     * @param array $params
     * - dateFrom
     * - dateTo
     * - interval
     */
    public function setParams(array $params = array()) {
        foreach ($this->params as $key => $value) {
            if (key_exists($key, $params)) {
                $this->params[$key] = $params[$key];
            }
        }
    }

    /**
     * Return array with users wich last activity was less then 2 minutes ago
     * @return boolean
     */
    public function getOnline() {
        $query = "
            SELECT 
                IF (`mod_stats_attendance`.`id_user` = 0, '', `mod_stats_attendance`.`id_user`) as `id_user`,
                `mod_stats_attendance`.`type_id`,
                `mod_stats_attendance`.`id_entity`,
                IF (`mod_stats_attendance`.`id_user` = 0, 'Guest', `users`.`username`) as `username`,
                IF (`mod_stats_attendance`.`id_user` = 0, '', `users`.`email`) as `email`,
                 FROM_UNIXTIME(`mod_stats_attendance`.`time_add`) as `last_activity`,
               
                CASE `mod_stats_attendance`.`type_id`
                    WHEN 1 THEN CONCAT(`content`.`cat_url`, `content`.`url`)
                    WHEN 2 THEN `category`.`url`
                    WHEN 3 THEN CONCAT('shop/category/',`shop_category`.`full_path`)
                    WHEN 4 THEN CONCAT('shop/product/',`shop_products`.`url`)
                END as `last_url`   
                
            FROM 
                `mod_stats_attendance` 
            LEFT JOIN `users` ON `users`.`id` = `mod_stats_attendance`.`id_user`
            
            LEFT JOIN `content` ON `content`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 1
            LEFT JOIN `category` ON `category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 2
            LEFT JOIN `shop_category` ON `shop_category`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 3
            LEFT JOIN `shop_products` ON `shop_products`.`id` = `mod_stats_attendance`.`id_entity` 
                AND `mod_stats_attendance`.`type_id` = 4
        
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
     * @param type $registered
     * @return type
     */
    public function getCommonAttendance($registered = TRUE) {
        $condition = $registered ? '<>' : '=';
        $query = "
            SELECT 
               DATE_FORMAT(FROM_UNIXTIME(`time_add`), '" . $this->getDatePattern($this->params['interval']) . "') as `date`,
               COUNT(`id`)
            FROM 
                `mod_stats_attendance`        
            WHERE 
                `id_user` {$condition} 0
            GROUP BY 
                `date`
           
        ";
                
         
        return $this->db->query($query)->result_array();
    }

    /**
     * 
     * @param type $params
     * @return boolean
     */
    public function getRegister($params) {
        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`created`), '" . $this->getDatePattern($this->params['interval']) . "') as `date`,
                `created` as `unix_date`,    
                COUNT(`id`) as `count`
            FROM 
                (SELECT 
                    `users`.`id`,
                    `users`.`created`
                 FROM 
                    `users`
                 WHERE 1
                     AND FROM_UNIXTIME(`users`.`created`) <= NOW() + INTERVAL 1 DAY 
                 GROUP BY 
                    `users`.`id`
                 ORDER BY 
                    FROM_UNIXTIME(`users`.`created`)
                ) as dtable
            WHERE 1 
                 " . $this->prepareDateBetweenCondition('created', $this->params) . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`created`)
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        return $result->result_array();
    }

}

?>
