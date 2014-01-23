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
        $this->renderAdmin('price', array('data' => 123));
    }

    public function info() {
        
    }

}
