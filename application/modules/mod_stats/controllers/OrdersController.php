<?php

/**
 * Class OrdersController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class OrdersController extends ControllerBase {

    private $dataRemap;

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('orders_model');
        $this->controller->import('classes/ChartDataRemap.php');
        $this->dataRemap = new ChartDataRemap();
    }

    /**
     * Prints template for counts
     */
    public function count() {
        // Set default view type
        if (!isset($_GET['view_type'])) {
            $_GET['view_type'] = 'table';
        }

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
    public function getCountChartData() {
        // Get results about orders from model
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $preFinalStruct = $this->dataRemap->remapFor2Axises($result);

        // Remove unwanted values
        unset($preFinalStruct['products_count'], $preFinalStruct['quantity'], $preFinalStruct['delivered']);

        // For langs
        $labels = array(
            'orders_count' => array('label' => 'Orders count'),
            'price_sum' => array('label' => 'Cash', 'bar' => TRUE),
        );

        //Prepare data for diagram
        $chartData = parent::prepareDataForLineChart($preFinalStruct, $labels);
        echo json_encode($chartData);
    }

    /**
     * Render template for statuses
     */
    public function statuses() {
        // Set default view type
        if (!isset($_GET['view_type'])) {
            $_GET['view_type'] = 'table';
        }

        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->assetManager
                ->setData('data', $result)
                ->renderAdmin('orders/statuses');
    }

    /**
     * Output json data for orders statuses and product chart
     */
    public function getStatusesChartData() {
        // Get results about orders from model
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $preFinalStruct = $this->dataRemap->remapForOneAxis($result);

        // Remove unwanted values
        unset($preFinalStruct['price_sum'], $preFinalStruct['quantity']);

        // For langs
        $labels = array(
            'orders_count' => array('label' => 'Orders count'),
            'delivered' => array('label' => 'Count of delivered'),
            'products_count' => array('label' => 'Count of products')
        );

        //Prepare data for diagram
        $chartData = parent::prepareDataForLineMultChart($preFinalStruct, $labels);
        echo json_encode($chartData);
    }

    /**
     * Template for users
     */
    public function users() {
        // Set default view type
        if (!isset($_GET['view_type'])) {
            $_GET['view_type'] = 'table';
        }

        $field = isset($_GET['chart_field']) ? $_GET['chart_field'] : 'orders_count';

        $data = $this->controller->orders_model->getUsers(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '20014-01-01',
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
    public function getUsersChartData() {

        $params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        );

        $field = isset($_GET['chart_field']) ? $_GET['chart_field'] : 'orders_count';

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
