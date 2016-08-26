<?php

namespace admin_menu\classes;

use SCallbacksQuery;
use SNotificationsQuery;
use SNotificationStatusesQuery;

class MenuCallbacks
{

    private function __construct() {

    }

    /**
     * @var MenuCallbacks
     */
    private static $instance;

    /**
     * @return MenuCallbacks
     */
    public static function getInstance() {

        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Get new orders count view
     * @param array $data
     * @return string
     */
    public function getNewOrdersCount(array $data = []) {

        if (SHOP_INSTALLED) {
            $orders_count = count($data) ? array_shift($data) : \SOrdersQuery::create()->setComment(__METHOD__)->filterByStatus(1)->count();

            if ($orders_count) {
                return '<span class="menu-counter">' . $orders_count . '</span>';
            }
        }
        return '';
    }

    /**
     * Get new callbacks count view
     * @param array $data
     * @return string
     */
    public function getNewCallbacksCount(array $data = []) {

        if (SHOP_INSTALLED) {
            if (count($data)) {
                $newCallbacksCount = array_shift($data);
            } else {
                $newStatus = \SCallbackStatusesQuery::create()->setComment(__METHOD__)->filterByIsDefault(TRUE)->findOne();
                $newCallbacksCount = $newStatus ? SCallbacksQuery::create()->setComment(__METHOD__)->filterByStatusId($newStatus->getId())->count() : 0;
            }
            return $newCallbacksCount ? '<span class="menu-counter">' . $newCallbacksCount . '</span>' : '';
        }
        return '';
    }

    /**
     * Get new notifications count view
     * @param array $data
     * @return string
     */
    public function getNewNotificationsCount(array $data = []) {

        if (SHOP_INSTALLED) {
            if (count($data)) {
                $newNotificationsCount = array_shift($data);
            } else {
                $newStatus = SNotificationStatusesQuery::create()->setComment(__METHOD__)->orderById()->findOne();
                $newNotificationsCount = $newStatus ? SNotificationsQuery::create()->setComment(__METHOD__)->filterByStatus($newStatus->getId())->count() : 0;
            }
            return $newNotificationsCount ? '<span class="menu-counter">' . $newNotificationsCount . '</span>' : '';
        }
        return '';
    }

    /**
     * Get new comments count view
     * @param array $data
     * @return string
     */
    public function getNewCommentsCount(array $data = []) {

        if (SHOP_INSTALLED) {
            if (count($data)) {
                $waitingForModerationCount = array_shift($data);
            } else {
                $waitingForModerationCount = 0;
                if (\CI::$APP->db->where('name', 'comments')->get('components')->result_array()) {
                    $waitingForModerationCount = \CI::$APP->load->module('comments')->getWaitingForMaderationCount();
                }
            }

            return ($waitingForModerationCount > 0) ? '<span class="menu-counter">' . $waitingForModerationCount . '</span>' : '';
        }
        return '';
    }

    /**
     * Get sum of new orders, new callbacks, new notifications counts
     * @return string
     */
    public function getNewOCNSum() {

        $NewOrdersCount = MenuCallback::run('getNewOrdersCount');
        $NewCallbacksCount = MenuCallback::run('getNewCallbacksCount');
        $NewNotificationsCount = MenuCallback::run('getNewNotificationsCount');

        preg_match('/([\d]+)/', $NewOrdersCount, $NewOrdersCount_matches);
        preg_match('/([\d]+)/', $NewCallbacksCount, $NewCallbacksCount_matches);
        preg_match('/([\d]+)/', $NewNotificationsCount, $NewNotificationsCount_matches);

        $NewOrdersCount = $NewOrdersCount_matches[1] ?: 0;
        $NewCallbacksCount = $NewCallbacksCount_matches[1] ?: 0;
        $NewNotificationsCount = $NewNotificationsCount_matches[1] ?: 0;

        $sum = $NewOrdersCount + $NewCallbacksCount + $NewNotificationsCount;

        return $sum ? '<span class="menu-counter">' . $sum . '</span>' : '';
    }

}