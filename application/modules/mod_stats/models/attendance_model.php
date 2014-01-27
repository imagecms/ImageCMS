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
     *  - registered (mixed) TRUE - only registered, FALSE - only unregistered, NULL or empty - all
     * @return boolean
     */
    public function getCommonAttendance(array $params = array()) {
        $params = array(
            'interval' => 'day',
            'dateFrom' => NULL,
            'dateTo' => NULL,
            'registered' => NULL
        );

        foreach ($params_ as $key => $value) {
            if (key_exists($key, $params)) {
                $params[$key] = $params_[$key];
            }
        }

        $registeredCondition = "";
        if (!is_null($type)) {
            $sign = $type == TRUE ? '>' : '<';
            $registeredCondition = " AND `id_user` {$sign} 0 ";
        }

        $query = "
            SELECT 
                DATE_FORMAT(FROM_UNIXTIME(`time_add`), '" . $this->getDatePattern($params['interval']) . "') as `date`,
                COUNT(DISTINCT `id_user`) as `users_count`
            FROM 
                `mod_stats_attendance`
            WHERE 1 
                " . $this->prepareDateBetweenCondition('created', $params) . " 
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

}

?>
