<?php

namespace admin_menu\classes;

class MenuCallbacks {

    private function __construct() {

    }

    private static $instance;

    public static function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Get new orders count view
     * @param array $data
     * @return string
     */
    public function getNewOrdersCount($data = array()) {
        if (SHOP_INSTALLED) {
            $orders_count = count($data) ? array_shift($data) : \SOrdersQuery::create()->filterByStatus(1)->find()->count();

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
    public function getNewCallbacksCount($data = array()) {

//        SELECT `id` FROM `shop_callbacks_statuses` WHERE `is_default`=1;

        if (SHOP_INSTALLED) {
            if (count($data)) {
                $newCallbacksCount = array_shift($data);
            } else {
                $newStatus = \SCallbackStatusesQuery::create()->filterByIsDefault(TRUE)->findOne();
                $newCallbacksCount = $newStatus ? \SCallbacksQuery::create()->filterByStatusId($newStatus->getId())->find()->count() : 0;
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
    public function getNewNotificationsCount($data = array()) {
        if (SHOP_INSTALLED) {
            if (count($data)) {
                $newNotificationsCount = array_shift($data);
            } else {
                $newStatus = \SNotificationStatusesQuery::create()->orderById()->findOne();
                $newNotificationsCount = $newStatus ? \SNotificationsQuery::create()->filterByStatus($newStatus->getId())->find()->count() : 0;
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
    public function getNewCommentsCount($data = array()) {
        if (SHOP_INSTALLED) {
            if (count($data)) {
                $waitingForModerationCount = array_shift($data);
            } else {
                 $waitingForModerationCount = \CI::$APP->load->module('comments')->getWaitingForMaderationCount();
//                $waitingForModerationCount = $waitingForModeration ?
            }
            return ($waitingForModerationCount > 0 ) ? '<span class="menu-counter">' . $waitingForModerationCount . '</span>': '';
        }
        return '';
    }

    /**
     * Get sum of new orders, new callbacks, new notifications counts
     * @return int
     */
    public function getNewOCNSum() {

        $NewOrdersCount = MenuCallback::run('getNewOrdersCount');
        $NewCallbacksCount = MenuCallback::run('getNewCallbacksCount');
        $NewNotificationsCount = MenuCallback::run('getNewNotificationsCount');

        $NewOrdersCount = preg_match('/([\d]+)/', $NewOrdersCount, $NewOrdersCount_matches);
        $NewCallbacksCount = preg_match('/([\d]+)/', $NewCallbacksCount, $NewCallbacksCount_matches);
        $NewNotificationsCount = preg_match('/([\d]+)/', $NewNotificationsCount, $NewNotificationsCount_matches);

        $NewOrdersCount = $NewOrdersCount_matches[1] ? $NewOrdersCount_matches[1] : 0;
        $NewCallbacksCount = $NewCallbacksCount_matches[1] ? $NewCallbacksCount_matches[1] : 0;
        $NewNotificationsCount = $NewNotificationsCount_matches[1] ? $NewNotificationsCount_matches[1] : 0;

        $sum = $NewOrdersCount + $NewCallbacksCount + $NewNotificationsCount;

        return $sum ? '<span class="menu-counter">' . $sum . '</span>' : '';
    }

}
