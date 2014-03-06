<?php
namespace mod_stats\classes;
class DateInterval {

    /**
     * Returns date pattern for mysql (select part)
     * @param int|string $dateInterval
     * @return string
     */
    public static function getDatePattern($dateInterval) {
        // date pattern for mysql
        switch ($dateInterval) {
            case 1:
            case 'month':
                return '%Y-%m';
            case 2:
            case 'year':
                return '%Y';
            default: // 0: day
                return '%Y-%m-%d';
        }
    }

    /**
     * 
     * @param string $field
     * @param array $params (all are optional)
     *  - table
     *  - dateFrom
     *  - dateTo
     * @return string condition of date range
     */
    public static function prepareDateBetweenCondition($field, array $params = array()) {
        $table = !isset($params['table']) ? "" : "`{$params['table']}`.";
        $betweenCondition = "";
        if (isset($params['dateFrom']) || isset($params['dateTo'])) {
            $dateFrom = isset($params['dateFrom']) ? $params['dateFrom'] : '2005-01-01';
            $dateTo = isset($params['dateTo']) ? $params['dateTo'] : date('Y-m-d');
            $betweenCondition = "AND FROM_UNIXTIME(`{$field}`) BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'";
        }
        return $betweenCondition;
    }

}