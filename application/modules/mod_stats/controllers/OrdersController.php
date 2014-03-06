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
     * Prints template for charts
     */
    public function charts() {
        // Set default view type
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->renderAdmin('charts', array(
            'data' => $result,
            'viewType' => $viewType,
            'show_by' => !empty($_GET['show_by']) ? $_GET['show_by'] : 'Price')
        );
    }

    public function getChartDataPrice() {
        $this->outputChart(array(
            'price_sum' => lang('Price', 'mod_stats'),
        ));
    }

    public function getChartDataCount() {
        $this->outputChart(array(
            'orders_count' => lang('Orders', 'mod_stats'),
            'products_count' => lang('Products', 'mod_stats'),
            'paid' => lang('Paid', 'mod_stats'),
            'delivered' => lang('Delivered', 'mod_stats')
        ));
    }

    private function outputChart(array $lines) {
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));

        $countsData = array();
        foreach ($result as $i => $row) {
            foreach ($row as $field => $value) {
                if (key_exists($field, $lines)) {
                    $countsData[$field][] = array(
                        'date' => $result[$i]['date'],
                        'x' => $result[$i]['unix_date'] * 1000,
                        'y' => $value
                    );
                }
            }
        }

        $this->controller->import('classes/ZeroFiller');

        $chartData = array();
        foreach ($countsData as $labelKey => $valuesArray) {
            $chartData[] = array(
                'key' => $lines[$labelKey],
                //'values' => $valuesArray,// without filling zeros
                'values' => ZeroFiller::fill($valuesArray, 'x', 'y', isset($_GET['group']) ? $_GET['group'] : 'day'),
            );
        }

        echo json_encode($chartData);
    }

    /**
     * Render template for statuses
     */
    public function info() {
        $result = $this->controller->orders_model->getOrdersInfo(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->assetManager
                ->setData('data', $result)
                ->renderAdmin('orders/info');
    }

    /**
     * Template for users
     */
    public function users() {

        // getting all data
        $data = $this->controller->orders_model->getUsers(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '20014-01-01',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
            'username' => isset($_GET['username']) ? $_GET['username'] : NULL,
            'order_id' => isset($_GET['order_id']) ? $_GET['order_id'] : NULL,
        ));

        // adding links and some data
        for ($i = 0; $i < count($data); $i++) {
            $orderIds = explode(',', $data[$i]['orders_ids']);
            $orderLinks = '';
            foreach ($orderIds as $oId) {
                $orderLinks .= "<a href='/admin/components/run/shop/orders/edit/{$oId}'>{$oId}</a>,";
            }
            $data[$i]['orders_ids'] = trim($orderLinks, ',');
            if (!in_array($data[$i]['username'], array('-', '0'))) {
                $data[$i]['username'] = "<a href='/admin/components/run/shop/users/edit/{$data[$i]['user_id']}'>{$data[$i]['username']}</a>";
            }
            $data[$i]['unpaid'] = $data[$i]['orders_count'] - $data[$i]['paid'];
        }

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
