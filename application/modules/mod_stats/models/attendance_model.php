<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Attendance_model extends CI_Model {

    use DateIntervalTrait;

    /**
     * 
     * @param type $params
     * @return boolean
     */
    public function getCommonAttendanceUrl(array $params = array()) {
        $params = array(
            'interval' => 'day',
            'dateFrom' => NULL,
            'dateTo' => NULL,
        );

        foreach ($params_ as $key => $value) {
            if (key_exists($key, $params)) {
                $params[$key] = $params_[$key];
            }
        }

        $query = "
            SELECT
                DATE_FORMAT(`time_add`, '" . $this->getDatePattern($params['interval']) . "') as `date`, 
                COUNT(`id`) as `count`
            FROM 
                (SELECT 
                    DATE_FORMAT(`time_add`, '" . $this->getDatePattern($params['interval']) . "') as `date`, 
                 FROM 
                    `mod_stats_urls`
                 GROUP BY 
                    `users`.`id`
                 ORDER BY 
                    FROM_UNIXTIME(`users`.`created`)
                ) as dtable
            WHERE 1 
                 " . $this->prepareDateBetweenCondition('created', $params) . " 
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
