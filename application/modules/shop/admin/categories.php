<?php
/**
 * ShopAdminCategories 
 * 
 * @uses ShopController
 * @package 
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class ShopAdminCategories extends ShopAdminController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($id=null)
    {
        // Show categories list
    }

    /**
     * Create new category.
     * 
     * @access public
     */
    public function create()
    {
        $model = new SCategory;

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                // Check if category URL is aviable.
                $urlCheck = SCategoryQuery::create()
                    ->where('SCategory.Url = ?', (string) $_POST['Url'])
                    ->where('SCategory.ParentId = ?', (int) $_POST['ParentId'])
                    ->findOne();

                if ($urlCheck !== null)
                {
                    exit(showMessage('Указанный URL занят'));
                }

                $model->fromArray($_POST);
                $model->save();

                // Build categories tree to get category full uri path.
                $tree = ShopCore::app()->SCategoryTree->getTree();
                $category = $tree[$model->getId()];
                $model->setFullPath(implode('/',$category->getFullUriPath()));
                $model->setFullPathIds(serialize($category->getFullPathIdsVirtual()));
                $model->save();

                showMessage('Категория создана');
                jsCode('loadShopSidebarCats();'); 
                $this->redirect();
    		} 
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
                'categories'=>ShopCore::app()->SCategoryTree->getTree(), // Categories array for parent_id dropdown.
            ));
        }
    }

    /**
     * Edit category
     * 
     * @access public
     */
    public function edit($id = null)
    {
        $model = SCategoryQuery::create()->findPk((int) $id);
        
        if ($model===null)
            $this->error404('Категория не найдена');

        /**
         *  Update category data
         */
        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                // Check if category URL is aviable.
                $urlCheck = SCategoryQuery::create()
                    ->where('SCategory.Url = ?', (string) $_POST['Url'])
                    ->where('SCategory.ParentId = ?', (int) $_POST['ParentId'])
                    ->where('SCategory.Id != ?', (int) $model->getId())
                    ->findOne();

                if ($urlCheck !== null)
                {
                    exit(showMessage('Указанный URL занят'));
                }

                $model->fromArray($_POST);
                $model->save();

                // Build categories tree to get category full uri path.
                $tree = ShopCore::app()->SCategoryTree->getTree();
                $category = $tree[$model->getId()];
                $model->setFullPath(implode('/',$category->getFullUriPath()));
                $model->setFullPathIds(serialize($category->getFullPathIdsVirtual()));
                $model->save();

                showMessage('Изменения сохранены');
                jsCode('loadShopSidebarCats();');
                $this->redirect();
    		} 
        }

        $this->render('edit',array(
            'model'=>$model,
            'modelArray'=>$model->toArray(),
            'categories'=>ShopCore::app()->SCategoryTree->getTree(),
        ));
    }

    /**
     * Delete category
     * 
     * @access public
     * @return void
     */
    public function delete()
    {
        // Get category id
        $category_id = $this->input->post('id');

        // Delete category
        $model = SCategoryQuery::create()->findOneByID((int) $category_id);

        if ($model !== null)
            $model->delete();
        else
            showMessage('Ошибка удаления категории.');
    }

    /**
     * Show list of categories
     * 
     * @access public
     * @return void
     */
    public function c_list()
    {
        $this->render('list', array(
            'tree'=>ShopCore::app()->SCategoryTree->getTree(),
        ));
    }

    /**
     * Save categories position.
     * 
     * @access public
     * @return void
     */
    public function save_positions()
    {
        $positions = $_POST['positions'];

        if (sizeof($positions) == 0)
            return false;

        $tree = ShopCore::app()->SCategoryTree->getTree();

        foreach ($positions as $key=>$val)
        {
            $item_data = explode('_', substr($val, 4));
            $category = $tree[$item_data[0]];

            if ($category instanceof SCategory)
            {
                $category->setPosition((int) $item_data[1]);
                $category->save();
            }
        }
    }

    protected function redirect()
    {
        // Redirect to list
        if ($_POST['_add'])
            $this->ajaxShopDiv('categories/c_list');

        // Redirect to create new object
        if ($_POST['_create'])
            $this->ajaxShopDiv('categories/create'); 

        // No redirect
        if ($_POST['_edit'])
        {
            // ok. dont't leave this page!
        }
    }
}
