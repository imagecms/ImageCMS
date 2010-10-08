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

        $this->load->helper('Form');
    }

    /**
     * Display orders list
     * 
     * TODO: Add pagination
     * @access public
     */
    public function index()
    {
        $model = SOrdersQuery::create();
        $model->orderByDateCreated('desc');

        if (!ShopCore::$_GET['status'])
            ShopCore::$_GET['status'] = 0;

        $model->filterByStatus(ShopCore::$_GET['status']);

        $model = $model->find();

        $this->render('list', array(
            'model'=>$model, 
        ));
    }

    /**
     * Edit order info
     * 
     * @access public
     */
    public function edit($id)
    {
        $model = SOrdersQuery::create()
            ->findPk((int) $id);

        if ($model === null)
            $this->error404('Заказ не найден.');

        if ($_POST)
        {
            $_POST['Paid'] = (bool) $_POST['Paid'];

            $model->fromArray($_POST);

            // Check if delivery method exists.
            $deliveryMethod = SDeliveryMethodsQuery::create()
                ->findPk((int) $_POST['DeliveryMethod']);

            if ($deliveryMethod === null)
            {
                $deliveryMethod = 0;
                $deliveryPrice = 0;
            }
            else
            {
                $deliveryPrice = $deliveryMethod->getPrice();
                $deliveryMethod = $deliveryMethod->getId();
            }

            $model->setDeliveryMethod($deliveryMethod);
            $model->setDeliveryPrice($deliveryPrice);

            $model->save();

            $this->ajaxShopDiv('orders/index?status='.ShopCore::$_GET['back_to']);
        }
        else
        {
            $this->render('edit', array(
                'model'=>$model,
                'deliveryMethods'=>SDeliveryMethodsQuery::create()->orderByName()->find(), 
            ));
        }
    }

    public function changeStatus()
    {
        $orderId = (int) $_POST['orderId'];
        
        $model = SOrdersQuery::create()
            ->findPk($orderId);

        if ($model !== null)
        {
            switch($_POST['status'])
            {
                case 'progress';
                    $model->setStatus(1);
                break;

                case 'completed':
                    $model->setStatus(2);
                break;
            }

            $model->save();
        }
    }

    public function changePaid()
    {
        $orderId = (int) $_POST['orderId'];
        
        $model = SOrdersQuery::create()
            ->findPk($orderId);

        if ($model !== null)
        {
            if ($model->getPaid() == true)
                $model->setPaid(false);
            else
                $model->setPaid(true);
            
            $model->save();
            echo (int) $model->getPaid();
        }
    }

    public function delete()
    {
        $model = SOrdersQuery::create()
            ->findPk((int) $_POST['orderId']);
        
        if ($model)
        {
            //$model->delete();
        }
    }
}
