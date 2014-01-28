<?php

/**
 * 
 *
 * @author 
 */
class OrdersController extends ControllerBase {

    /**
     * Prints template for counts
     */
    public function count() {
        // getting view type
        if (isset($_GET['view_type'])) {
            $vt = $_GET['view_type'];
            $viewType = $vt == 'table' || $vt == 'chart' ? $vt : 'chart';
        } else {
            $viewType = 'chart';
        }

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->renderAdmin('count', array('data' => $result, 'viewType' => $viewType));
    }

    /**
     * Output json data for count chart
     */
    public function getCountData() {
        //$dateFrom = isset($_GET['dateFrom']) ? $_GET['dateFrom'] : date("Y-m-d", time() - 60 * 60 * 24 * 365);
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $this->controller->import('classes/ChartDataRemap.php');
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
     * Template for users
     */
    public function users() {
        // getting view type
        if (isset($_GET['view_type'])) {
            $vt = $_GET['view_type'];
            $viewType = in_array($vt, ['table', 'pie_chart', 'bar_chart']) ? $vt : 'table';
        } else {
            $viewType = 'table';
        }

        $field = isset($_GET['chart_field']) ? $_GET['chart_field'] : 'orders_count';

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $data = $this->controller->orders_model->getUsers(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $this->renderAdmin('users', array(
            'data' => $data,
            'viewType' => $viewType,
            'chartField' => isset($_GET['chart_field']) ? $_GET['chart_field'] : 'orders_count',
        ));
    }

    /**
     * Output json data for usres chart
     */
    public function getUsersData() {
        if (!isset($_GET['view_type']))
            exit;
        if (!in_array($_GET['view_type'], ['pie_chart', 'bar_chart']))
            exit;

        $params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        );

        $field = isset($_GET['chart_field']) ? $_GET['chart_field'] : 'orders_count';

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $data = $this->controller->orders_model->getUsers($params);

        $chartData = array();
        foreach ($data as $user) {
            $chartData[] = array(
                'key' => $user['username'],
                'y' => (int) $user[$field]
            );
        }
        echo json_encode($chartData);
    }

}

