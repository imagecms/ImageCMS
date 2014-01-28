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
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
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
        $orders = $this->stats_model_orders->getOrdersByDateRange();
        return $orders;
    }

    /**
     * 
     */
    public function getPrice() {
        $params = \mod_stats\classes\LineDiagramBase::create()->getParamsFromCookies();
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
     * Creating array structure for nvd3 line diagram
     * @param array $params params for data selecting 
     * @param string $field one of the fields of the query in orders model
     * @return array data for line diagram
     */
    protected function getOrders_LineDiagram($params, $field) {
        $orders = $this->stats_model_orders->getOrdersByDateRange($params);

        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        // getting data by only specified field
        $dataByField = array();
        foreach ($orders as $order) {
            $dataByField[$order['date']] = $order[$field];
        }
        unset($orders);

        // filling by zeros for wright data representation in diagram
        $filledWithZeros = $lineDiagramBase->fillMissingWithZero($dataByField);
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
