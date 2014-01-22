<?php

/**
 * 
 *
 * @author 
 */
class OrdersController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
    }

    /**
     * 
     */
    public function amount() {
        $this->renderAdmin('amount');
    }

    /**
     * 
     */
    public function amount_chart() {
        //$dateFrom = isset($_GET['dateFrom']) ? $_GET['dateFrom'] : date("Y-m-d", time() - 60 * 60 * 24 * 365);
        $this->controller->load('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $this->controller->load('classes/ChartDataRemap.php');
        $dataRemap = new ChartDataRemap;

        $preFinalStruct = $dataRemap->remapFor2Axises($result);

        $labels = array(// для лангів
            'orders_count' => array('label' => 'Orders count'),
            'price_sum' => array('label' => 'Cash', 'bar' => TRUE),
            'products_count' => array('label' => 'Count of products'),
            'quantity' => array('label' => 'Quantity of products'),
            'delivered' => array('label' => 'Count of delivered'),
        );

        $finalStruct = array();
        foreach ($preFinalStruct as $key => $values) {
            $temp = array(
                'key' => $labels[$key]['label'],
                'values' => $values,
            );
            isset($labels[$key]['bar']) ? $temp['bar'] = 'TRUE' : NULL;
            $finalStruct[] = $temp;
        }

        echo json_encode($finalStruct);
    }

    /**
     * 
     */
    public function info() {
        $this->controller->load('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->renderAdmin('info', array('data' => $result));
    }

}

