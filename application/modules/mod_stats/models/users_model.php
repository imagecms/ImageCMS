<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Users_model extends CI_Model {

    /**
     * Return array with users wich last activity was less then 2 minutes ago
     * @param int $forLastSeconds
     * @return boolean
     */
    public function getOnline($forLastSeconds = 120) {
        if (!is_numeric($forLastSeconds)) {
            return FALSE;
        }
        $query = "
            SELECT 
                `mod_stats_urls`.`id_user`,
                `users`.`username`,
                `users`.`email`,
                `mod_stats_urls`.`time_add` as `last_activity`,
                `url` as `last_url`
            FROM 
                `mod_stats_urls` 
            LEFT JOIN `users` ON `users`.`id` = `mod_stats_urls`.`id_user`
            WHERE 1
                AND `mod_stats_urls`.`time_add` >= NOW() - INTERVAL 120 SECOND
            GROUP BY `mod_stats_urls`.`id_user`
        ";
        return $this->db->query($query)->result_array();
    }

}

?>
