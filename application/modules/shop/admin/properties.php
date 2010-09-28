<?php
/**
 * ShopAdminProperties
 * 
 * @uses ShopController
 * @package 
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class ShopAdminProperties extends ShopAdminController {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display list of properties
     * 
     * @access public
     */
    public function index($categoryId = null)
    {
        if ($categoryId === null)
        {
            $model = SPropertiesQuery::create()->find();
            $category = null;
        }
        else
        {
            $category = SCategoryQuery::create()->findPk((int) $categoryId);

            if ($category !== null)
            {
                $model = SPropertiesQuery::create()
                    ->filterByPropertyCategory($category)
                    ->find();
            }
        }

        $this->render('list', array(
            'model'=>$model,
            'categories'=>ShopCore::app()->SCategoryTree->getTree(),
            'filterCategory'=>$category,
        ));
    }

    /**
     * Create new product property
     * 
     * @access public
     */
    public function create()
    {
        $model = new SProperties;

        //var_dump(get_class_methods($model));

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                $model->fromArray($_POST);

                // Assign property categories
                if (sizeof($_POST['UseInCategories']) > 0 && is_array($_POST['UseInCategories']))
                {
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['UseInCategories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category)
                    {
                        $model->addPropertyCategory($category);
                    }
                }

                $model->save();
                showMessage('Свойство создано');
               

                if ($_POST['_add'])
                    $redirect_url = 'properties/index';

                if ($_POST['_create'])
                    $redirect_url = 'properties/create';

                if ($_POST['_edit'])
                    $redirect_url = 'properties/edit/' . $model->getId();

                $this->ajaxShopDiv($redirect_url);

            }
        }
        else
        {
            $this->render('create', array(
                'model'=>$model,
                'categories'=>ShopCore::app()->SCategoryTree->getTree(),
            ));
        }
    }

    /**
     * Edit property 
     * 
     * @param int $propertyId 
     * @access public
     */
    public function edit($propertyId = null)
    {
        $model = SPropertiesQuery::create()
            ->findPk((int) $propertyId);

        if ($model === null)
            $this->error404('Свойство не найдено.');
 
        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                if (!$_POST['Data'])
                    $_POST['Data'] = '';

                $model->fromArray($_POST);

                ShopProductPropertiesCategoriesQuery::create()
                    ->filterByPropertyId($model->getId())
                    ->delete();

                // Assign property categories
                if (sizeof($_POST['UseInCategories']) > 0 && is_array($_POST['UseInCategories']))
                {
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['UseInCategories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category)
                    {
                        $model->addPropertyCategory($category);
                    }
                }

                $model->save();
                showMessage('Изменения сохранены');

                if ($_POST['_add'])
                    $redirect_url = 'properties/index';

                if ($_POST['_create'])
                    $redirect_url = 'properties/create';

                if ($_POST['_edit'])
                    return;

                $this->ajaxShopDiv($redirect_url);
            }
        }
        else
        {
            $propertyCategories = array();
            foreach ($model->getPropertyCategorys() as $propertyCategory)
            {
                array_push($propertyCategories, $propertyCategory->getId());
            }

            $this->render('edit', array(
                'model'=>$model,
                'categories'=>ShopCore::app()->SCategoryTree->getTree(),
                'propertyCategories'=>$propertyCategories,
            ));
        }
    }

    public function renderForm($categoryId, $productId = null)
    {
        echo ShopCore::app()->SPropertiesRenderer->renderAdmin($categoryId, SProductsQuery::create()->findPk((int) $productId));
    }
        
    public function delete()
    {

    }
}
