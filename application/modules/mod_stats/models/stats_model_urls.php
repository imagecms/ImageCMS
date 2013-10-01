<?php

/**
 * 
 *
 * @author kolia
 */
class Stats_model_urls extends CI_Model {

    /**
     * Online users
     * (for last 3 minutes)
     * @return array users online with las page and time
     */
    public function getOnline() {
        $query = "
            SELECT 
                `mod_stats_urls`.`uder_id`,
                `mod_stats_urls`.`url`,
                `mod_stats_urls`.`time_add`,
                `users`.`username`,
                `users`.`email`
            FROM `mod_stats_urls`
            LEFT JOIN `users` ON `mod_stats_urls`.`uder_id` = `users`.`id`
            WHERE 1
                AND `mod_stats_urls`.`time_add` > DATE_SUB(NOW(), INTERVAL 3 MINUTE)
            GROUP BY `mod_stats_urls`.`uder_id`
            ORDER BY `mod_stats_urls`.`time_add` ASC
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $ordersData = array();
        foreach ($result->result_array() as $row) {
            if ((int) $row['uder_id'] == 0) {
                $row['username'] = lang('Guest', 'admin');
                $row['email'] = "-";
            }
            $ordersData[] = $row;
        }

        return $ordersData;
    }

}

?>
