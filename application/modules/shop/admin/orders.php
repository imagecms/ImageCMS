<?php
/**
 * ShopAdminOrders
 * 
 * @uses ShopController
 * @package 
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class ShopAdminOrders extends ShopAdminController {


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $model = SOrdersQuery::create()
            ->find();

        $this->render('list', array(
            'model'=>$model,            
        ));
    }

}
