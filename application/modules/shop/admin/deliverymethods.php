<?php
/**
 * ShopAdminBrands
 * 
 * @uses ShopController
 * @package 
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class ShopAdminDeliveryMethods extends ShopAdminController {


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    /**
     * Create new brand
     * 
     * @access public
     */
    public function create()
    {
        $model = new SDeliveryMethods;

        if ($_POST)
        {
            $model->fromArray($_POST);
            $this->form_validation->set_rules($model->rules());  

            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                $model->save();
                $this->redirect();
            }
        }
        else
        {
            $this->render('create', array(
                'model'=>$model,            
            ));
        }
    }

    public function edit($deliveryMethodId = null)
    {
        $model = SDeliveryMethodsQuery::create()->findPk((int) $deliveryMethodId);

        if ($model===null)
            $this->error404('Способ доставки не найден');

        //var_dump($model->encode2());

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                if (!$_POST['Enabled'])
                    $_POST['Enabled'] = false;

                $model->fromArray($_POST);
                $model->save();

                showMessage('Изменения сохранены');
                $this->redirect();
    		} 
        }
        else
        {
            $this->render('edit',array(
                'model'=>$model,
            ));
        } 

    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $model = SDeliveryMethodsQuery::create()->findPk($id);

        if ($model != null)
            $model->delete();
    }

    public function c_list()
    {
        $model = SDeliveryMethodsQuery::create()
            ->orderByName()
            ->find();

        $this->render('list',array(
            'model'=>$model,            
        ));
    }

    protected function redirect()
    {
        // Redirect to list
        if ($_POST['_add'])
            $this->ajaxShopDiv('deliverymethods/c_list');

        // Redirect to create new object
        if ($_POST['_create'])
            $this->ajaxShopDiv('deliverymethods/create');
    }
}
