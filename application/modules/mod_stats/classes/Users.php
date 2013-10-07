<?php

namespace mod_stats\classes;

/**
 * Users stats 
 * 
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 */
class Users extends \MY_Controller {

    protected static $instanse;

    public function __construct() {
        parent::__construct();
        /** Load users model * */
        $this->load->model('stats_model_users');
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     * 
     * @return Users
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    /**
     * 
     */
    public function templateOnline() {
        $this->load->model('stats_model_urls');
        return $this->stats_model_urls->getOnline();
    }

    /**
     * 
     */
    public function getRegister() {
        $usersRegister = $this->stats_model_users->getRegister($params);
        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        // getting data by only specified field
        $dataByField = array();
        foreach ($usersRegister as $user) {
            $dataByField[$user['date']] = $user['count'];
        }
        unset($usersRegister);

        // filling by zeros for wright data representation in diagram
        $filledWithZeros = $lineDiagramBase->fillMissingWithZero($dataByField);
        unset($dataByField);


        // timestamp for diagram
        $ts = array();
        foreach ($filledWithZeros as $date => $count) {
            $ts[strtotime($date)] = $count;
        }
        ksort($ts);
        unset($filledWithZeros);

        // creating array with structure for nvd3 line diagram
        $ts_ = array();
        foreach ($ts as $key => $value) {
            $ts_[] = array(
                'x' => (int) $key,
                'y' => (int) $value
            );
        }

        $result = array(
            'type' => 'line',
            'data' => array(
                0 => array(
                    'key' => lang('Registrations number'),
                    'values' => $ts_
                )
            )
        );

        return json_encode($result);
    }

    public function templateInformation() {
        $usersInfo = $this->stats_model_users->getInformation();

        // make links from order ids and user names
        foreach ($usersInfo as $num => $user) {
            $ordersIds = explode(",", $user['orders_ids']);
            sort($ordersIds);
            $newOrders = array();
            foreach ($ordersIds as $orderId) {
                $urlOrder = base_url() . 'admin/components/run/shop/orders/edit/' . trim($orderId);
                $newOrders[] = "<a href='{$urlOrder}'>{$orderId}</a>";
            }
            $usersInfo[$num]['orders_ids'] = implode(", ", $newOrders);
            $urlUser = base_url() . 'admin/components/run/shop/users/edit/' . trim($user['user_id']);
            $usersInfo[$num]['username'] = "<a href='{$urlUser}'>{$user['username']}</a>";
        }

        return $usersInfo;
    }

    public function getInformation() {
        $usersInfo = $this->stats_model_users->getInformation();

        if (!count($usersInfo) > 0) {
            return;
        }

        if (!isset($_COOKIE['user_info_dfield']) || !key_exists($_COOKIE['user_info_dfield'], $usersInfo[0])) {
            $_COOKIE['user_info_dfield'] = 'orders_count';
        }

        // data for pie diagram
        $pieData = array();
        foreach ($usersInfo as $user) {
            $pieData[] = array(
                'key' => $user['username'],
                'y' => (int) $user[$_COOKIE['user_info_dfield']]
            );
        }

        return json_encode(array(
            'type' => 'pie',
            'data' => $pieData
        ));
    }

}

?>
