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
class ShopAdminBrands extends ShopAdminController {


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
        $model = new SBrands;

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                // Check if brand URL is aviable.
                $urlCheck = SBrandsQuery::create()
                    ->where('SBrands.Url = ?', (string) $_POST['Url'])
                    ->findOne();

                if ($urlCheck !== null)
                {
                    exit(showMessage('Указанный URL занят'));
                }

                $model->fromArray($_POST);
                $model->save();

                showMessage('Бренд создан');

                if ($_POST['_add'])
                    $redirect_url = 'brands/c_list';

                if ($_POST['_create'])
                    $redirect_url = 'brands/create';

                if ($_POST['_edit'])
                    $redirect_url = 'brands/edit/' . $model->getId();

                $this->ajaxShopDiv($redirect_url);
    		} 
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
            ));
        } 
    }

    public function edit($brandId = null)
    {
        $model = SBrandsQuery::create()->findPk((int)$brandId);

        if ($model===null)
            $this->error404('Бренд не найден');

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                // Check if brand URL is aviable.
                $urlCheck = SBrandsQuery::create()
                    ->where('SBrands.Url = ?', (string) $_POST['Url'])
                    ->where('SBrands.Id != ?', (int) $model->getId())
                    ->findOne();

                if ($urlCheck !== null)
                {
                    exit(showMessage('Указанный URL занят'));
                }

                $model->fromArray($_POST);
                $model->save();

                showMessage('Изменения сохранены');

                if ($_POST['_add'])
                    $redirect_url = 'brands/c_list';

                if ($_POST['_create'])
                    $redirect_url = 'brands/create';

                if ($_POST['_edit'])
                    return;

                $this->ajaxShopDiv($redirect_url);
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
        $model = SBrandsQuery::create()->findPk($id);

        if ($model != null)
            $model->delete();
    }

    public function c_list()
    {
        $model = SBrandsQuery::create()
            ->orderByName()
            ->find();

        $this->render('list',array(
            'model'=>$model,            
        ));
    }
}
