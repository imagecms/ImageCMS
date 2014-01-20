<?php

/**
 * 
 *
 * @author 
 */
class OrdersController extends ControllerBase {

    public function amount($some) {
        $this->assetManager->registerScript('script');
        $this->assetManager->renderAdmin('orders_amount');
    }

}

?>
