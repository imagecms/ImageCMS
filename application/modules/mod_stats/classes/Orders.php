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
        $orders = $this->stats_model_orders->getOrdersByDateRange(array(
            'paid' => FALSE,
            'fill_empty' => TRUE
        ));
        $tsOrders = array();
        foreach ($orders as $date => $count) {
            $tsOrders[strtotime($date)] = $count;
        }
        ksort($tsOrders);
        /*$tsOrders_ = array();
        foreach ($tsOrders as $key => $value) {
            $tsOrders_[] = array(
                'x' => $key,
                'y' => $value
            );
        }
        return $tsOrders_;*/
        
        echo "<pre>";
        print_r($tsOrders);
        echo "</pre>";
        exit;
    }

    /**
     * Returns json data for line diagram about orders by date
     * @param string $interval year|month|week|day
     * @param string $begin date in format DD-MM-YYYY
     *
    public function getDate() {

        $orders = $this->stats_model_orders->getOrdersAndCounts();

        $paid = array();
        $unpaid = array();

        foreach ($orders as $orders) {
            if ($orders['paid'] == 1) {
                $paid[] = array(
                    'x' => $orders['date_created'],
                    'y' => $orders['products_count']
                );
            }
            $all[] = array(
                'x' => $orders['date_created'],
                'y' => $orders['products_count']
            );
        }

        $result = array(
            'type' => 'line',
            'data' => array(
                0 => array(
                    'key' => 'Все',
                    'values' => $all
                ),
                1 => array(
                    'key' => 'Оплачены',
                    'values' => $paid
                )
            )
        );

        return json_encode($result);

        //        echo "<pre>";
        //        print_r($result);
        //        echo "</pre>";
        //        exit;
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
        $paid = $this->getOrders_(TRUE);
        $unpaid = $this->getOrders_(FALSE);

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

        return json_encode($result);
    }

    protected function getOrders_($paid = NULL) {
        $orders = $this->stats_model_orders->getOrdersByDateRange(array(
            'paid' => $paid,
        ));
        $tsOrders = array();
        foreach ($orders as $date => $count) {
            $tsOrders[strtotime($date)] = $count;
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
