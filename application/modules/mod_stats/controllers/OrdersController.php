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

    public function amount() {
        $this->renderAdmin('amount');
    }

    public function amount_chart() {
        // default params, if they don't exists
        //$dateFrom = isset($_GET['dateFrom']) ? $_GET['dateFrom'] : date("Y-m-d", time() - 60 * 60 * 24 * 30);
        $dateFrom = isset($_GET['dateFrom']) ? $_GET['dateFrom'] : '2005-05-05';
        $dateTo = isset($_GET['dateTo']) ? $_GET['dateTo'] : date("Y-m-d");
        $interval = isset($_GET['interval']) ? $_GET['interval'] : 'day';

        $this->controller->load('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'interval' => $interval,
        ));

        $this->controller->load('classes/DynamicChartData.php');
        $dynamicChartData = new DynamicChartData;
        echo json_encode($dynamicChartData->processData($result));
    }

    public function price() {
        $this->renderAdmin('price', array('data' => 123));
    }

    public function info() {
        $this->controller->load('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $someResult = $this->controller->orders_model->getOrdersInfo(array('paid' => 0, 'dateFrom' => '2005-12-21', 'dateTo' => '2014-01-21', 'interval' => 1));

        $this->controller->load('classes/DynamicChartData.php');


        $dcd = new DynamicChartData;
        $someRes2 = $dcd->processData($someResult);

        echo '<pre>';
        print_r($someRes2);
        echo '</pre>';
        exit;
    }

}

