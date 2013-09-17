<?php

namespace mod_stats\classes;

/**
 * Orders stats
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 */
class Orders extends \MY_Controller {

    protected static $_instance;

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model_orders');
    }

    /**
     *
     * @return Orders
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Table representation for orders
     */
    public function templateInfo() {
        $params = $this->getParamsFromCookies();
        $orders = $this->stats_model_orders->getOrdersByDateRange($params);
        return $orders;
    }

    /**
     * 
     */
    public function getPrice() {
        $params = $this->getParamsFromCookies();
        $paid = $this->getOrders_LineDiagram($params, 'price_sum');

        $result = array(
            'type' => 'line',
            'data' => array(
                0 => array(
                    'key' => lang('Paid'),
                    'values' => $paid
                )
            )
        );
        return json_encode($result);
    }

    public function getCount() {

        $params = $this->getParamsFromCookies();
        $params['paid'] = TRUE;
        $paid = $this->getOrders_LineDiagram($params, 'orders_count');

        $params['paid'] = NULL;
        $all = $this->getOrders_LineDiagram($params, 'orders_count');
        $delivered = $this->getOrders_LineDiagram($params, 'delivered');

        $result = array(
            'type' => 'line',
            'data' => array(
                0 => array(
                    'key' => lang('All'),
                    'values' => $all
                ),
                1 => array(
                    'key' => lang('Paid'),
                    'values' => $paid
                ),
                2 => array(
                    'key' => lang('Delivered'),
                    'values' => $delivered
                )
            )
        );

        return json_encode($result);
    }

    /**
     * Returns params for query
     * @return type
     */
    protected function getParamsFromCookies() {

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
     * @param array $ordersData
     * @return array identical to $ordersData, but with zeros
     */
    protected function fillMissingWithZero($ordersData) {
        if (!count($ordersData) > 0) {
            return $ordersData;
        }
        // lowest date - start
        reset($ordersData);
        $start = key($ordersData);

        $dateRangeType = $this->getDateRangeType($start);

        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $start .= "-01";
        }

        $start = strtotime($start);

        // highest date - end
        end($ordersData);
        $end = key($ordersData);
        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $end .= "-01";
        }
        $end = strtotime($end);

        reset($ordersData);

        // filling depending on group type
        switch ($dateRangeType) {
            case 'year':
                $ordersWithZeros = $this->fillMissingWithZero_year($start, $end, $ordersData);
                break;
            case 'month':
                $ordersWithZeros = $this->fillMissingWithZero_month($start, $end, $ordersData);
                break;
            default:
                $ordersWithZeros = $this->fillMissingWithZero_days($start, $end, $ordersData);
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
    protected function fillMissingWithZero_year($start, $end, $ordersData) {
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
    protected function fillMissingWithZero_month($start, $end, $ordersData) {
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
    protected function fillMissingWithZero_days($start, $end, $ordersData) {
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
    protected function getDateRangeType($someDate) {
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
     * Creating array structure for nvd3 line diagram
     * @param array $params params for data selecting 
     * @param string $field one of the fields of the query in orders model
     * @return array data for line diagram
     */
    protected function getOrders_LineDiagram($params, $field) {
        $orders = $this->stats_model_orders->getOrdersByDateRange($params);

        // getting data by only specified field
        $dataByField = array();
        foreach ($orders as $order) {
            $dataByField[$order['date']] = $order[$field];
        }
        unset($orders);



        // filling by zeros for wright data representation in diagram
        $filledWithZeros = $this->fillMissingWithZero($dataByField);
        unset($dataByField);



        // timestamp for diagram
        $tsOrders = array();
        foreach ($filledWithZeros as $date => $count) {
            $tsOrders[strtotime($date)] = $count;
        }
        ksort($tsOrders);
        unset($filledWithZeros);

        // creating array with structure for nvd3 line diagram
        $tsOrders_ = array();
        foreach ($tsOrders as $key => $value) {
            $tsOrders_[] = array(
                'x' => $key,
                'y' => $value
            );
        }

        return $tsOrders_;
    }

}

?>
