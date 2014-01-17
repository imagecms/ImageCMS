<?php

namespace mod_stats\classes;

/**
 * Helpers for classes thad getting data for nv3d line diagram
 * (common methods)
 * @author kolia
 */
class LineDiagramBase {

    protected static $_instance;
    protected $params;

    public function __construct() {
        $this->params = $this->getParamsFromCookies();
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     *
     * @return LineDiagramBase
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * For query (select)
     * @return string date pattern for mysql
     */
    public function prepareDatePattern() {
        // date pattern for mysql
        switch ($this->params['interval']) {
            case 'month':
                return '%Y-%m';
            case 'year':
                return '%Y';
            default:
                return '%Y-%m-%d'; // day
        }
    }

    /**
     * For query (where)
     * @return string condition of date range
     */
    public function prepareDateBetweenCondition($field, $table = NULL) {
        $table = is_null($table) ? "" : "`{$table}`.";
        // start date
        $start_date = $this->getBetweenDate($this->params['start_date'], 'start');
        $end_date = $this->getBetweenDate($this->params['end_date'], 'end');

        // where between... for query
        if (!is_null($start_date) || !is_null($end_date)) {
            $start_date = is_null($start_date) == TRUE ? "'2000-01-01 00:00:00'" : "'{$start_date}'";
            $end_date = is_null($end_date) == TRUE ? 'NOW()' : "'{$end_date}'";
            return "AND FROM_UNIXTIME({$table}`{$field}`) BETWEEN {$start_date} AND {$end_date}";
        } else {
            return '';
        }
    }

    /**
     * Returns params for query
     * @return type
     */
    public function getParamsFromCookies() {

        if (!isset($_COOKIE['group_by']))
            $_COOKIE['group_by'] = 'day';
        if (!isset($_COOKIE['start_date_input']))
            $_COOKIE['start_date_input'] = date("Y-m-d 00:00:00", strtotime('now - 1 month'));
        if (!isset($_COOKIE['end_date_input']))
            $_COOKIE['end_date_input'] = date("Y-m-d 00:00:00");

        $params['interval'] = $_COOKIE['group_by'];
        $params['start_date'] = $_COOKIE['start_date_input'];
        $params['end_date'] = $_COOKIE['end_date_input'];

        return $params;
    }

    /**
     * Fillig no-order days/months/years by zeros (for line diagram)
     * @param array $data
     * @return array identical to $data, but with zeros
     */
    public function fillMissingWithZero($data) {
        if (!count($data) > 0) {
            return $data;
        }
        // lowest date - start
        reset($data);
        $start = key($data);

        $dateRangeType = $this->getDateRangeType($start);

        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $start .= "-01";
        }

        $start = strtotime($start);

        // highest date - end
        end($data);
        $end = key($data);
        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $end .= "-01";
        }
        $end = strtotime($end);

        reset($data);

        // filling depending on group type
        switch ($dateRangeType) {
            case 'year':
                $ordersWithZeros = $this->fillMissingWithZero_year($start, $end, $data);
                break;
            case 'month':
                $ordersWithZeros = $this->fillMissingWithZero_month($start, $end, $data);
                break;
            default:
                $ordersWithZeros = $this->fillMissingWithZero_days($start, $end, $data);
                break;
        }

        return $ordersWithZeros;
    }

    /**
     * 
     * @param type $start
     * @param type $end
     * @param int $ordersData
     * @return int
     */
    public function fillMissingWithZero_year($start, $end, $ordersData) {
        $current = $end;
        $ordersWith0 = array();
        $to = $start - (60 * 60 * 24);
        do {
            $date = date('Y', $current);
            if (!key_exists($date, $ordersData)) {
                $ordersData[$date] = 0;
                $ordersWith0[$date . "-01"] = 0;
            } else {
                $ordersWith0[$date . "-01"] = $ordersData[$date];
            }
            $countOfDays = date('L', $current) == 0 ? 365 : 366;
            $current -= $countOfDays * 60 * 60 * 24;
        } while ($current > $to);

        return $ordersWith0;
    }

    /**
     * 
     * @param type $start
     * @param type $end
     * @param int $ordersData
     * @return int
     */
    public function fillMissingWithZero_month($start, $end, $ordersData) {
        $current = $start;
        do {
            $date = date('Y-m', $current);
            if (!key_exists($date, $ordersData)) {
                $ordersData[$date] = 0;
            }
            $countOfDays = date('t', $current);
            $current += $countOfDays * 60 * 60 * 24;
        } while ($current < $end);
        return $ordersData;
    }

    /**
     * 
     * @param type $start
     * @param type $end
     * @param int $ordersData
     * @return int
     */
    public function fillMissingWithZero_days($start, $end, $ordersData) {
        for ($i = $start; $i <= $end; $i += 60 * 60 * 24) {
            $date = date('Y-m-d', $i);
            if (!key_exists($date, $ordersData)) {
                $ordersData[$date] = 0;
            }
        }
        ksort($ordersData);
        return $ordersData;
    }

    /**
     * Get the specified date type
     * @param string $someDate date (YYYY-MM-DD|YYYY-MM|YYYY)
     * @return string day|month|year
     */
    public function getDateRangeType($someDate) {
        $datePatterns = array(
            '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/' => 'day',
            '/^[0-9]{4}-[0-9]{2}$/' => 'month',
            '/^[0-9]{4}$/' => 'year',
        );

        foreach ($datePatterns as $pattern => $type) {
            if (preg_match($pattern, $someDate)) {
                return $type;
            }
        }

        return FALSE;
    }

    /**
     * Helper function for prepareBetweenCondition()
     * mysql needs date in format YYYY-MM-DD HH:MM:SS
     * @param type $date
     * @param type $startOrEnd
     * @return boolean
     */
    protected function getBetweenDate($date, $startOrEnd) {
        if ($date === NULL)
            return NULL;

        $type = $this->getDateRangeType($date);

        // to include specified end month
        switch ($startOrEnd) {
            case "start":
                $lastDay = "01";
                break;
            case "end":
                $lastDay = "31";
                break;
            default:
                $lastDay = "01";
        }

        // to include all specified end year 
        if ($type == 'year' & $startOrEnd == 'end') {
            $month = "12";
        } else {
            $month = "01";
        }

        $hour = " 00:00:00";

        // filling date format according to wich part is missing
        switch ($type) {
            case "day":
                return $date . $hour;
            case "month":
                return $date .= "-{$lastDay}" . $hour;
            case "year":
                return $date . "-{$month}-{$lastDay}" . $hour;
            default :
                return NULL;
        }
    }

}

?>
