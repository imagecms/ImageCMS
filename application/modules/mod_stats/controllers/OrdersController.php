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

        $this->assetManager
                ->setData('data', 123)
                ->renderAdmin('orders/amount');
    }

    public function price() {
        $this->assetManager
                ->setData('data', 123)
                ->renderAdmin('orders/price');
    }

    public function info() {
        $this->assetManager
                ->setData('data', 123)
                ->renderAdmin('orders/info');
    }

}
