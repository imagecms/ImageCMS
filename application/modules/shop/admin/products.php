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
class ShopAdminProducts extends ShopAdminController {

    protected $per_page = 20;
    protected $allowedImageExtensions = array('jpg','png','gif');

    protected $imageSizes = array(
        'mainImageWidth'   => 300,
        'mainImageHeight'  => 500,
        'smallImageWidth'  => 150,
        'smallImageHeight' => 200,
    );

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display list of products in category
     * 
     * @param integer $categoryID 
     * @access public
     */
    public function index($categoryID=null, $offset=0)
    {
        $model = SCategoryQuery::create()
            ->findPk((int) $categoryID); 
        
        if($model === null)
            $this->error404('Категория не найдена.');

        $criteria = new Criteria();
        $criteria->setLimit($this->per_page);
        $criteria->setOffset((int)$offset);
        $products = $model->getProducts($criteria);

        // Set total products count
        $totalProducts = $model->countProducts();

        // Create pagination
        $this->load->library('pagination');
        $config['base_url'] = $this->createUrl('products/index/', array('catId'=>$model->getId()));
        $config['container'] = 'shopAdminPage';
        $config['uri_segment'] = 8;
        $config['total_rows'] = $totalProducts;
        $config['per_page'] = $this->per_page;
        $this->pagination->num_links = 6;
        $this->pagination->initialize($config);
      
        $this->render('list', array(
            'model'=>$model,
            'products'=>$products,
            'totalProducts'=>$totalProducts,
            'pagination'=>$this->pagination->create_links_ajax(),
            'category'=>SCategoryQuery::create()->findPk((int) $categoryID),
        ));
    }

    /**
     * Create new product, upload and resize images.
     * 
     * @access public
     */
    public function create()
    {
        $model = new SProducts;

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('error'=>validation_errors(' ', ' ')));
            }
            else
            {
                if ($_POST['Url'])
                {
                    // Check if Url is aviable.
                    $urlCheck = SProductsQuery::create()
                        ->where('SProducts.Url = ?', (string) $_POST['Url'])
                        ->findOne();

                    if ($urlCheck !== null)
                    {
                        echo json_encode(array('error'=>'Указанный URL занят'));
                        exit;
                    }
                }

                $model->fromArray($_POST);
               
                // Add main category relation
                $categoryModel = SCategoryQuery::create()->findPk($model->getCategoryId());
                if ($categoryModel)
                    $model->addCategory($categoryModel);

                // Assign product categories
                if (sizeof($_POST['Categories']) > 0 && is_array($_POST['Categories']))
                {
                    // Get selected categories
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['Categories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category)
                    {
                        if ($category->getId() != $model->getCategoryId())
                            $model->addCategory($category);
                    }
                }

                $model->save();

                $this->_insert_variants($model->getId());
                
                $this->load->library('image_lib');

                // Resize image.
                if (!empty($_FILES['mainPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['mainPhoto']['name']) === true)
                {
                    $imageSizes = $this->getImageSize($_FILES['mainPhoto']['tmp_name']);

                    if ($imageSizes['width'] > $this->imageSizes['mainImageWidth'] && $imageSizes['height'] > $this->imageSizes['mainImageHeight'])
                    {
                        $config['image_library'] = 'gd2';
                        $config['source_image']	= $_FILES['mainPhoto']['tmp_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']	 = $this->imageSizes['mainImageWidth'];
                        $config['height']	 = $this->imageSizes['mainImageHeight'];
                        $config['new_image'] = ShopCore::$imagesUploadPath.$model->getId().'_main.jpg';

                        $this->image_lib->initialize($config); 

                        if ($this->image_lib->resize())
                        {
                            $mainImageResized = true;
                            $model->setMainImage(true);
                        }
                    }
                    else
                    {
                        move_uploaded_file($_FILES['mainPhoto']['tmp_name'], ShopCore::$imagesUploadPath.$model->getId().'_main.jpg');
                        $mainImageResized = true;
                        $model->setMainImage(true);
                    }
                }

                // Image Resized. 
                // Create small image.
                if (empty($_FILES['smallPhoto']['tmp_name']) && $_POST['autoCreateSmallImage'] == 1 && $mainImageResized === true)
                    $smallImageSource = ShopCore::$imagesUploadPath.$model->getId().'_main.jpg';
                elseif(!empty($_FILES['smallPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['smallPhoto']['name']) === true)
                    $smallImageSource = $_FILES['smallPhoto']['tmp_name']; 
                else
                    $smallImageSource = false;
                
                if ($smallImageSource != false)
                {
                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image']	= $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']	 = $this->imageSizes['smallImageWidth'];
                    $config['height']	 = $this->imageSizes['smallImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath.$model->getId().'_small.jpg';

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $model->setSmallImage(true);
                }

                $model->save();

                if ($_POST['_add'])
                    $redirect_url = 'products/index/' . $model->getCategoryId();

                if ($_POST['_create'])
                    $redirect_url = 'products/create';

                if ($_POST['_edit'])
                    $redirect_url = 'products/edit/' . $model->getId();


                echo json_encode(array(
                    'ok'=>true,
                    'redirect_url'=>$redirect_url,
                ));  
    		} 
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
                'categories'=>ShopCore::app()->SCategoryTree->getTree(), 
            ));
        }
    }

    /**
     * Edit product
     *
     * @access public
     */
    public function edit($productId)
    {
        // Select product with variants.
        $model = SProductsQuery::create()
            ->useProductVariantQuery()
                ->orderByPosition()
            ->endUse()
            ->leftJoinWith('ProductVariant')
            ->findPk((int) $productId);

        if ($model === null)
            $this->error404('Товар не найден.');

        if (!empty($_POST))
        {
            $this->form_validation->set_rules($model->rules());
		    
            if ($this->form_validation->run() == FALSE)
            {
                echo json_encode(array('error'=>validation_errors(' ', ' ')));
            }
            else
            {
                if ($_POST['Url'])
                {
                    // Check if Url is aviable.
                    $urlCheck = SProductsQuery::create()
                        ->where('SProducts.Id != ?', $model->getId())
                        ->where('SProducts.Url = ?', (string) $_POST['Url'])
                        ->findOne();

                    if ($urlCheck !== null)
                    {
                        echo json_encode(array('error'=>'Указанный URL занят'));
                        exit;
                    }
                }

                if (!$_POST['Hit'])
                    $_POST['Hit'] = null;

                if (!$_POST['Active'])
                    $_POST['Active'] = null;

                $model->fromArray($_POST);
     
                // Clear product category relations.
                ShopProductCategoriesQuery::create()
                    ->filterByProductId($model->getId())
                    ->delete();

                // Add main category relation
                $categoryModel = SCategoryQuery::create()->findPk($model->getCategoryId());
                if ($categoryModel)
                    $model->addCategory($categoryModel);

                // Assign product categories
                if (sizeof($_POST['Categories']) > 0 && is_array($_POST['Categories']))
                {
                    // Get selected categories
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['Categories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category)
                    {
                        if ($category->getId() != $model->getCategoryId())
                            $model->addCategory($category);
                    }
                }

                $model->save();

                // Delete product variants
                SProductVariantsQuery::create()
                    ->filterByProductId($model->getId())
                    ->delete();

                $this->_insert_variants($model->getId());
               
                // Add product properties
                SProductPropertiesDataQuery::create()
                    ->filterByProductId($model->getId())
                    ->delete();

                if (sizeof($_POST['productProperties']) > 0)
                {
                    foreach ($_POST['productProperties'] as $key => $value)
                    {
                        if ($value)
                        {
                            $pData = new SProductPropertiesData;
                            $pData->setProductId($model->getId());
                            $pData->setPropertyId($key);
                            $pData->setValue($value);

                            $model->addSProductPropertiesData($pData);
                        }
                    }

                    $model->save();
                }

                $this->load->library('image_lib');

                // Resize image.
                if (!empty($_FILES['mainPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['mainPhoto']['name']) === true)
                {
                    if (file_exists(ShopCore::$imagesUploadPath.$model->getId().'_main.jpg'))
                        unlink(ShopCore::$imagesUploadPath.$model->getId().'_main.jpg');

                    $config['image_library'] = 'gd2';
                    $config['source_image']	= $_FILES['mainPhoto']['tmp_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']	 = $this->imageSizes['mainImageWidth'];
                    $config['height']	 = $this->imageSizes['mainImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath.$model->getId().'_main.jpg';

                    $this->image_lib->initialize($config); 

                    if ($this->image_lib->resize())
                    {
                        $mainImageResized = true;
                        $model->setMainImage(true);
                    }
                }

                // Image Resized. 
                // Create small image.
                if (empty($_FILES['smallPhoto']['tmp_name']) && $_POST['autoCreateSmallImage'] == 1 && $mainImageResized === true)
                    $smallImageSource = ShopCore::$imagesUploadPath.$model->getId().'_main.jpg';
                elseif(!empty($_FILES['smallPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['smallPhoto']['name']) === true)
                    $smallImageSource = $_FILES['smallPhoto']['tmp_name']; 
                else
                    $smallImageSource = false;
                
                if ($smallImageSource != false)
                {
                    if (file_exists(ShopCore::$imagesUploadPath.$model->getId().'_small.jpg'))
                        unlink(ShopCore::$imagesUploadPath.$model->getId().'_small.jpg');

                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image']	= $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']	 = $this->imageSizes['smallImageWidth'];
                    $config['height']	 = $this->imageSizes['smallImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath.$model->getId().'_small.jpg';

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $model->setSmallImage(true);
                }

                $model->save();

                if ($_POST['_add'])
                {
                    if (!$_POST['redirect'])
                        $redirect_url = 'products/index/' . $model->getCategoryId();
                    else
                        $redirect_url = str_replace("/admin/components/run/shop/","",base64_decode($_POST['redirect']));
                }

                if ($_POST['_create'])
                    $redirect_url = 'products/create';

                if ($_POST['_edit'])
                    $redirect_url = 'products/edit/' . $model->getId();

                echo json_encode(array(
                    'ok'=>true,
                    'redirect_url'=>$redirect_url,
                ));
    		}
        }
        else
        {
            // Create array from ids of additional product categories.
            $productCategories = array();
            foreach ($model->getCategorys() as $productCategory)
            {
                array_push($productCategories, $productCategory->getId());
            }
    
            $this->render('edit', array(
                'model'=>$model,
                'categories'=>ShopCore::app()->SCategoryTree->getTree(),
                'productCategories'=>$productCategories,
            ));
        }
    }

    /**
     * Delete product
     * 
     * @access public
     */
    public function delete()
    {
        $model = SProductsQuery::create()->findPk((int) $_POST['productId']);

        if ($model!==null)
            $model->delete();
    }

    /**
     * Insert product variants from $_POST data.
     * 
     * @param integer $productId 
     * @access protected
     */
    protected function _insert_variants($productId)
    {
        // Insert product variants
        if (!empty($_POST['variants']))
        { 
            $totalVariants = sizeof($_POST['variants']['Name']);
            $variants = array_fill(0,$totalVariants,array());

            foreach($_POST['variants'] as $key=>$values)
            {
                for($i=0;$i<sizeof($values);$i++)
                {
                    $variants[$i][$key] = $values[$i];
                }
            }

            $i =0;
            foreach($variants as $variant)
            {
                // Add variants with Name and Price filled.
                if ($variant['Name'] != '' && $variant['Price'] != '' && is_numeric($variant['Price']))
                {
                    $productVariant = new SProductVariants;
                    $productVariant->fromArray($variant);
                    $productVariant->setPosition($i);
                    $productVariant->setProductId($productId);
                    $productVariant->save();
                    $i++;
                }
            }
        }
    }

    /**
     * Check if file has allowed extension
     * 
     * @param string $fileName 
     * @access protected
     * @return bool
     */
    protected function _isAllowedExtension($fileName)
    {
        $parts = explode('.', $fileName);
        $ext = strtolower(end($parts));

        if (in_array($ext, $this->allowedImageExtensions))
            return true;
        else
            return false;
    }

    /**
     * Get image width and height.
     * 
     * @param string $file_path Full path to image
     * @access protected
     * @return mixed
     */
    protected function getImageSize($file_path)
    {
		if (function_exists('getimagesize') && file_exists($file_path))
		{
			$image = @getimagesize($file_path);

            $size = array(
                'width'  => $image[0],
                'height' => $image[1],
                );

			return $size;
        }

        return false;
    }

}
