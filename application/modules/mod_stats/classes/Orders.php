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

    public function test() {
        /* $orders = $this->stats_model_orders->getOrdersByDateRange(array(
          'range' => 'month',
          'paid' => NULL,
          ));

          $orders2 = $this->fillMissingWithZero($orders, 'orders_count'); */


        $paid = $this->getOrders_(array(
            'interval' => 'day',
            'paid' => TRUE
        ));

        $unpaid = $this->getOrders_(array(
            'interval' => 'day',
            'paid' => TRUE
        ));

        echo "<pre>";
        print_r($paid);
        echo "</pre>";
        exit;
    }

    /**
     * Table representation for orders
     */
    public function getInfo($params) {
        return $this->stats_model_orders->getOrdersByDateRange($params);
        
//        echo "<pre>";
//        print_r($orders);
//        echo "</pre>";
        //exit;
    }

    /**
     * 
     */
    public function getPrice() {
        $query = $this->stats_model_orders->getOrdersByPrice();
        $res['type'] = 'line';
        $res['data'][0]['key'] = 'Все закази';
        $res['data'][0]['values'] = $query;
        echo json_encode($res);
    }

    public function getCount() {
        $paid = $this->getOrders_(array('paid' => TRUE));
        $unpaid = $this->getOrders_(array('paid' => FALSE));

        /*
          $result = array(
          'type' => 'line',
          'data' => array(
          0 => array(
          'key' => 'Оплачены',
          'values' => $paid
          ),
          1 => array(
          'key' => 'Неоплачены',
          'values' => $unpaid
          )
          )
          );

          return json_encode($result); */
    }

    /**
     * Fillig no-order days/months/years by zeros (for line diagram)
     * @param array $ordersData
     * @return array identical to $ordersData, but with zeros
     */
    protected function fillMissingWithZero($ordersData, $field) {

        $dateExample = $ordersData[0]['date'];
        $dateRangeType = $this->getDateRangeType($dateExample);

        $newOrdersData = array();
        foreach ($ordersData as $order) {
            $newOrdersData[$order['date']] = $order[$field];
        }

        // lowest date - start
        reset($newOrdersData);
        $start = key($newOrdersData);
        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $start .= "-01";
        }

        $start = strtotime($start);

        // highest date - end
        end($newOrdersData);
        $end = key($newOrdersData);
        if ($dateRangeType == 'year') { // php's date() function don't parse a year - needs to add month 
            $end .= "-01";
        }
        $end = strtotime($end);

        reset($newOrdersData);

        switch ($dateRangeType) {
            case 'year':
                $ordersWithZeros = $this->fillMissingWithZero_year($start, $end, $newOrdersData);
                break;
            case 'month':
                $ordersWithZeros = $this->fillMissingWithZero_month($start, $end, $newOrdersData);
                break;
            default:
                $ordersWithZeros = $this->fillMissingWithZero_days($start, $end, $newOrdersData);
                break;
        }
        return $ordersWithZeros;

        $tsOrders = array();
        foreach ($ordersWithZeros as $date => $count) {
            $tsOrders[strtotime($date)] = $count;
        }
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
     * @param boolean $paid TRUE - Paid, FALSE not paid, NULL - all
     * @return array
     */
    protected function getOrders_($params) {
        $orders = $this->stats_model_orders->getOrdersByDateRange($params);
        $tsOrders = array();
        foreach ($orders as $order) {
            $tsOrders[strtotime($order['date'])] = $order['orders_count'];
        }
        ksort($tsOrders);
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
