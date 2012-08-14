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
    protected $allowedImageExtensions = array('jpg', 'png', 'gif', 'jpeg');
    public $defaultLanguage = null;
    protected $imageSizes = array(
        'mainImageWidth' => 300,
        'mainImageHeight' => 500,
        'smallImageWidth' => 150,
        'smallImageHeight' => 200,
        'mainModImageWidth' => null,
        'mainModImageHeight' => null,
        'smallModImageWidth' => null,
        'smallModImageHeight' => null,
        'maxImageWidth' => 800,
        'maxImageHeight' => 600,
        'smallAddImageWidth' => 90,
        'smallAddImageHeight' => 90,
    );
    protected $imageQuality = 99;

    public function __construct() {
        parent::__construct();

        // Load image sizes.
        $this->imageSizes['mainImageWidth'] = ShopCore::app()->SSettings->mainImageWidth;
        $this->imageSizes['mainImageHeight'] = ShopCore::app()->SSettings->mainImageHeight;
        $this->imageSizes['smallImageWidth'] = ShopCore::app()->SSettings->smallImageWidth;
        $this->imageSizes['smallImageHeight'] = ShopCore::app()->SSettings->smallImageHeight;
        $this->imageSizes['mainModImageWidth'] = ShopCore::app()->SSettings->mainModImageWidth;
        $this->imageSizes['mainModImageHeight'] = ShopCore::app()->SSettings->mainModImageHeight;
        $this->imageSizes['smallModImageWidth'] = ShopCore::app()->SSettings->smallModImageWidth;
        $this->imageSizes['smallModImageHeight'] = ShopCore::app()->SSettings->smallModImageHeight;
        $this->imageSizes['maxImageWidth'] = ShopCore::app()->SSettings->addImageWidth;
        $this->imageSizes['maxImageHeight'] = ShopCore::app()->SSettings->addImageHeight;

        $this->imageSizes['smallAddImageWidth'] = ShopCore::app()->SSettings->smallAddImageWidth;
        $this->imageSizes['smallAddImageHeight'] = ShopCore::app()->SSettings->smallAddImageHeight;

        $this->per_page = ShopCore::app()->SSettings->adminProductsPerPage;

        $this->defaultLanguage = getDefaultLanguage();
    }

    /**
     * Display list of products in category
     *
     * @param integer $categoryID
     * @access public
     */
    public function index($categoryID = null, $offset = 0, $orderField = '', $orderCriteria = '') {
        $model = SCategoryQuery::create()
                ->findPk((int) $categoryID);

        if ($model === null)
            $this->error404('Категория не найдена.');

        $products = SProductsQuery::create()
                ->filterByCategory($model);

        // Set total products count
        $totalProducts = clone $products;
        $totalProducts = $totalProducts->count();

        $products = $products
                ->limit($this->per_page)
                ->offset((int) $offset);

        $nextOrderCriteria = '';

        if ($orderField !== '' && $orderCriteria !== '' && method_exists($products, 'filterBy' . $orderField)) {
            switch ($orderCriteria) {
                case 'ASC':
                    $products = ($orderField != 'Price') ? $products->orderBy($orderField, Criteria::ASC) :
                            $products->leftJoin('ProductVariant')->orderBy($orderField, Criteria::ASC);
                    $nextOrderCriteria = 'DESC';
                    break;

                case 'DESC':
                    $products = ($orderField != 'Price') ? $products->orderBy($orderField, Criteria::DESC) :
                            $products->leftJoin('ProductVariant')->orderBy($orderField, Criteria::DESC);
                    $nextOrderCriteria = 'ASC';
                    break;
            }
        } else
            $products->orderById('desc');

        $products = $products->find();


        $products->populateRelation('ProductVariant');

        // Create pagination
        $this->load->library('pagination');
        $config['base_url'] = $this->createUrl('products/index/', array('catId' => $model->getId()));
        $config['container'] = 'shopAdminPage';
        $config['uri_segment'] = 8;
        $config['total_rows'] = $totalProducts;
        $config['per_page'] = $this->per_page;
        $config['suffix'] = ($orderField != '') ? $orderField . '/' . $orderCriteria : '';
        $this->pagination->num_links = 6;
        $this->pagination->initialize($config);

        $this->render('list', array(
            'model' => $model,
            'products' => $products,
            'totalProducts' => $totalProducts,
            'pagination' => $this->pagination->create_links_ajax(),
            'category' => SCategoryQuery::create()->findPk((int) $categoryID),
            'nextOrderCriteria' => $nextOrderCriteria,
            'orderField' => $orderField,
            'locale' => $this->defaultLanguage['identif'],
        ));
    }

    /**
     * Create new product, upload and resize images.
     *
     * @access public
     */
    public function create() {
        $model = new SProducts;

        if (!empty($_POST)) {
            $this->form_validation->set_rules($model->rules());
            $this->form_validation->set_rules('Created', 'Дата создания', 'required|valid_date');

            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('error' => validation_errors(' ', ' ')));
            } else {
                if ($_POST['Url']) {
                    // Check if Url is aviable.
                    $urlCheck = SProductsQuery::create()
                            ->where('SProducts.Url = ?', (string) $_POST['Url'])
                            ->findOne();

                    if ($urlCheck !== null) {
                        echo json_encode(array('error' => 'Указанный URL занят'));
                        exit;
                    }
                }

                if (!$_POST['RelatedProducts'])
                    $_POST['RelatedProducts'] = array();

                if ($_POST['Created'])
                    $_POST['Created'] = strtotime($_POST['Created']);

                $_POST['Updated'] = time();
                $model->fromArray($_POST);

                // Add main category relation
                $categoryModel = SCategoryQuery::create()->findPk($model->getCategoryId());
                if ($categoryModel)
                    $model->addCategory($categoryModel);

                // Assign product categories
                if (sizeof($_POST['Categories']) > 0 && is_array($_POST['Categories'])) {
                    // Get selected categories
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['Categories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category) {
                        if ($category->getId() != $model->getCategoryId())
                            $model->addCategory($category);
                    }
                }

                $this->_process_warehouses($model);
                $model->save();

                if ($model->getUrl() == '') {
                    $model->setUrl($model->getId());
                    $model->save();
                }

                $this->_insert_variants($model->getId());

                if (sizeof($_POST['productProperties']) > 0) {
                    foreach ($_POST['productProperties'] as $key => $value) {
                        if ($value && $value != ShopCore::app()->SPropertiesRenderer->noValueText) {
                            $pData = new SProductPropertiesData;

                            if (is_array($value)) {
                                foreach ($value as $val) {
                                    if ($val != ShopCore::app()->SPropertiesRenderer->noValueText) {
                                        $pData = new SProductPropertiesData;
                                        $pData->setProductId($model->getId());
                                        $pData->setPropertyId($key);
                                        $pData->setValue($val);
                                        $model->addSProductPropertiesData($pData);
                                    }
                                }
                            } else {
                                $pData->setProductId($model->getId());
                                $pData->setPropertyId($key);
                                $pData->setValue($value);
                                $model->addSProductPropertiesData($pData);
                            }
                        }
                    }

                    $model->save();
                }

                $this->load->library('image_lib');

                // Resize image.
                // Resize images.
                if (!empty($_FILES['mainPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['mainPhoto']['name']) === true) {
                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg');

                    $imageSizes = $this->getImageSize($_FILES['mainPhoto']['tmp_name']);

                    if ($imageSizes['width'] >= $this->imageSizes['mainImageWidth'] OR $imageSizes['height'] >= $this->imageSizes['mainImageHeight']) {
                        $config = array();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['mainPhoto']['tmp_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $this->imageSizes['mainImageWidth'];
                        $config['height'] = $this->imageSizes['mainImageHeight'];
                        $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg';
                        $config['quality'] = $this->imageQuality;

                        $this->image_lib->initialize($config);

                        if ($this->image_lib->resize()) {
                            $mainImageResized = true;
                            $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg', array('main' => 'main'));
                            $model->setMainImage($model->getId() . '_main.jpg');
                        }
                    } else {
                        move_uploaded_file($_FILES['mainPhoto']['tmp_name'], ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg');
                        $mainImageResized = true;
                        // $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg', array('main' => 'main'));
                        $model->setMainImage($model->getId() . '_main.jpg');
                    }

                    //make next size variant for MainImage {
                    if ($this->imageSizes['mainModImageWidth'] && $this->imageSizes['mainModImageHeight']) {
                        if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg'))
                            unlink(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg');


                        $this->image_lib->clear();
                        if ($imageSizes['width'] >= $this->imageSizes['mainImageWidth'] OR $imageSizes['height'] >= $this->imageSizes['mainImageHeight']) {
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $_FILES['mainPhoto']['tmp_name'];
                            $config['create_thumb'] = FALSE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = $this->imageSizes['mainModImageWidth'];
                            $config['height'] = $this->imageSizes['mainModImageHeight'];
                            $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg';
                            $config['quality'] = $this->imageQuality;

                            $this->image_lib->initialize($config);



                            if ($this->image_lib->resize()) {
                                $mainImageResized = true;
                                $model->setMainModImage($model->getId() . '_mainMod.jpg');
                                $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));

                                //$this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));
                            }
                        } else {
                            move_uploaded_file($_FILES['mainPhoto']['tmp_name'], ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg');
                            $mainImageResized = true;
                            $model->setMainModImage($model->getId() . '_mainMod.jpg');
                            $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));
                        }
                    }
                }

                // Image Resized.
                // Create small image.
                if (empty($_FILES['smallPhoto']['tmp_name']) && $_POST['autoCreateSmallImage'] == 1 && $mainImageResized === true)
                    $smallImageSource = ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg';
                elseif (!empty($_FILES['smallPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['smallPhoto']['name']) === true)
                    $smallImageSource = $_FILES['smallPhoto']['tmp_name'];
                else
                    $smallImageSource = false;

                if ($smallImageSource != false) {
                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg');

                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $this->imageSizes['smallImageWidth'];
                    $config['height'] = $this->imageSizes['smallImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg';
                    $config['quality'] = $this->imageQuality;



                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg', array('small' => 'small'));
                    $model->setSmallImage($model->getId() . '_small.jpg');



                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg');

                    $this->image_lib->clear();
                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $this->imageSizes['smallModImageWidth'];
                    $config['height'] = $this->imageSizes['smallModImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg';
                    $config['quality'] = $this->imageQuality;


                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $model->setSmallModImage($model->getId() . '_smallMod.jpg');
                    $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg', array('smallMod' => 'smallMod'));
                }

                $model->save();

                $model = $this->saveAdditionalImages($model);
                $model->save();

                if ($_POST['_add'])
                    $redirect_url = 'products/index/' . $model->getCategoryId();

                if ($_POST['_create'])
                    $redirect_url = 'products/create';

                if ($_POST['_edit'])
                    $redirect_url = 'products/edit/' . $model->getId();


                echo json_encode(array(
                    'ok' => true,
                    'redirect_url' => $redirect_url,
                ));
            }
        }
        else {
            $this->render('create', array(
                'model' => $model,
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
                'cur_date' => date('Y-m-d H:i:s'),
                'warehouses' => SWarehousesQuery::create()->orderByName()->find(),
            ));
        }
    }

    /**
     * Edit product
     *
     * @access public
     */
    public function edit($productId, $locale = null) {
        $locale = $locale == null ? $this->defaultLanguage['identif'] : $locale;

        // Select product with variants.
        $model = SProductsQuery::create()
                ->useProductVariantQuery()
                ->orderByPosition()
                ->endUse()
                ->leftJoinWith('ProductVariant')
                ->findPk((int) $productId);

        if ($model === null)
            $this->error404('Товар не найден.');

        if (!empty($_POST)) {
            $this->form_validation->set_rules($model->rules());
            $this->form_validation->set_rules('Created', 'Дата создания', 'required|valid_date');

            if ($this->form_validation->run($this) == FALSE) {
                echo json_encode(array('error' => validation_errors(' ', ' ')));
            } else {
                if ($_POST['deleteMainImage'] == 1) {
                    @unlink(ShopCore::$imagesUploadPath . $model->getMainImage());
                    @unlink(ShopCore::$imagesUploadPath . $model->getMainModImage());
                    $model->setMainImage(false);
                    $model->setMainModImage(false);
                }

                if ($_POST['deleteSmallImage'] == 1) {
                    @unlink(ShopCore::$imagesUploadPath . $model->getSmallImage());
                    @unlink(ShopCore::$imagesUploadPath . $model->getSmallModImage());
                    $model->setSmallImage(false);
                    $model->setSmallModImage(false);
                }

                if ($_POST['Url']) {
                    // Check if Url is aviable.
                    $urlCheck = SProductsQuery::create()
                            ->where('SProducts.Id != ?', $model->getId())
                            ->where('SProducts.Url = ?', (string) $_POST['Url'])
                            ->findOne();

                    if ($urlCheck !== null) {
                        echo json_encode(array('error' => 'Указанный URL занят'));
                        exit;
                    }
                }

                if (!$_POST['Hit'])
                    $_POST['Hit'] = null;

                if (!$_POST['Active'])
                    $_POST['Active'] = null;

                if (!$_POST['Hot'])
                    $_POST['Hot'] = null;

                if (!$_POST['Action'])
                    $_POST['Action'] = null;

                if ($_POST['Created'])
                    $_POST['Created'] = strtotime($_POST['Created']);

                if (!$_POST['RelatedProducts'])
                    $_POST['RelatedProducts'] = array();

                $_POST['Updated'] = time();

                $_POST['Locale'] = $locale;

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
                if (sizeof($_POST['Categories']) > 0 && is_array($_POST['Categories'])) {
                    // Get selected categories
                    $criteria = new Criteria();
                    $criteria->add(SCategoryPeer::ID, $_POST['Categories'], Criteria::IN);
                    $categoriesModel = SCategoryPeer::doSelect($criteria);

                    foreach ($categoriesModel as $category) {
                        if ($category->getId() != $model->getCategoryId())
                            $model->addCategory($category);
                    }
                }

                if ($model->getUrl() == '')
                    $model->setUrl($model->getId());


                $this->_process_warehouses($model);
                $model->save();

                $this->_insert_variants($model->getId(), $locale);

                // Add product properties
                SProductPropertiesDataQuery::create()
                        ->filterByProductId($model->getId())
                        ->delete();

                if (sizeof($_POST['productProperties']) > 0) {
                    foreach ($_POST['productProperties'] as $key => $value) {
                        if ($value && $value != ShopCore::app()->SPropertiesRenderer->noValueText) {
                            $pData = new SProductPropertiesData;

                            if (is_array($value)) {
                                foreach ($value as $val) {
                                    if ($val != ShopCore::app()->SPropertiesRenderer->noValueText) {
                                        $pData = new SProductPropertiesData;
                                        $pData->setProductId($model->getId());
                                        $pData->setPropertyId($key);
                                        $pData->setValue($val);
                                        $model->addSProductPropertiesData($pData);
                                    }
                                }
                            } else {
                                $pData->setProductId($model->getId());
                                $pData->setPropertyId($key);
                                $pData->setValue($value);
                                $model->addSProductPropertiesData($pData);
                            }
                        }
                    }

                    $model->save();
                }

                $this->load->library('image_lib');

                // Resize images.
                if (!empty($_FILES['mainPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['mainPhoto']['name']) === true) {
                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg');

                    $imageSizes = $this->getImageSize($_FILES['mainPhoto']['tmp_name']);

                    if ($imageSizes['width'] >= $this->imageSizes['mainImageWidth'] OR $imageSizes['height'] >= $this->imageSizes['mainImageHeight']) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['mainPhoto']['tmp_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $this->imageSizes['mainImageWidth'];
                        $config['height'] = $this->imageSizes['mainImageHeight'];
                        $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg';
                        $config['quality'] = $this->imageQuality;

                        $this->image_lib->initialize($config);

                        if ($this->image_lib->resize()) {
                            $mainImageResized = true;
                            //$this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg', array('main' => 'main'));
                            $model->setMainImage($model->getId() . '_main.jpg');
                        }
                    } else {
                        move_uploaded_file($_FILES['mainPhoto']['tmp_name'], ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg');
                        $mainImageResized = true;
                        // $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg', array('main' => 'main'));
                        $model->setMainImage($model->getId() . '_main.jpg');
                    }

                    //make next size variant for MainImage {
                    if ($this->imageSizes['mainModImageWidth'] && $this->imageSizes['mainModImageHeight']) {
                        if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg'))
                            unlink(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg');


                        $this->image_lib->clear();
                        if ($imageSizes['width'] >= $this->imageSizes['mainImageWidth'] OR $imageSizes['height'] >= $this->imageSizes['mainImageHeight']) {
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $_FILES['mainPhoto']['tmp_name'];
                            $config['create_thumb'] = FALSE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = $this->imageSizes['mainModImageWidth'];
                            $config['height'] = $this->imageSizes['mainModImageHeight'];
                            $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg';
                            $config['quality'] = $this->imageQuality;

                            $this->image_lib->initialize($config);



                            if ($this->image_lib->resize()) {
                                $mainImageResized = true;
                                $model->setMainModImage($model->getId() . '_mainMod.jpg');
                                $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));

                                //$this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));
                            }
                        } else {
                            move_uploaded_file($_FILES['mainPhoto']['tmp_name'], ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg');
                            $mainImageResized = true;
                            $model->setMainModImage($model->getId() . '_mainMod.jpg');
                            $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_mainMod.jpg', array('mainMod' => 'mainMod'));
                        }
                    }
                }

                // Image Resized.
                // Create small image.
                if (empty($_FILES['smallPhoto']['tmp_name']) && $_POST['autoCreateSmallImage'] == 1 && $mainImageResized === true)
                    $smallImageSource = ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg';
                elseif (!empty($_FILES['smallPhoto']['tmp_name']) && $this->_isAllowedExtension($_FILES['smallPhoto']['name']) === true)
                    $smallImageSource = $_FILES['smallPhoto']['tmp_name'];
                else
                    $smallImageSource = false;

                if ($smallImageSource != false) {
                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg');

                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $this->imageSizes['smallImageWidth'];
                    $config['height'] = $this->imageSizes['smallImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg';
                    $config['quality'] = $this->imageQuality;



                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_small.jpg', array('small' => 'small'));
                    $model->setSmallImage($model->getId() . '_small.jpg');



                    if (file_exists(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg'))
                        unlink(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg');

                    $this->image_lib->clear();
                    $this->image_lib->clear();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $smallImageSource;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $this->imageSizes['smallModImageWidth'];
                    $config['height'] = $this->imageSizes['smallModImageHeight'];
                    $config['new_image'] = ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg';
                    $config['quality'] = $this->imageQuality;


                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $model->setSmallModImage($model->getId() . '_smallMod.jpg');
                    $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_smallMod.jpg', array('smallMod' => 'smallMod'));
                }

                $model->save();
                $model = $this->saveAdditionalImages($model);
                $model->save();

                if ($mainImageResized === true)
                    $this->draw_watermark(ShopCore::$imagesUploadPath . $model->getId() . '_main.jpg', array('main' => 'main'));

                if ($_POST['_add']) {
                    if (!$_POST['redirect'])
                        $redirect_url = 'products/index/' . $model->getCategoryId();
                    else {
                        $redirect_url = str_replace("admin/components/run/shop/", "", base64_decode($_POST['redirect']));
                    }
                }

                if ($_POST['_create'])
                    $redirect_url = 'products/create';

                if ($_POST['_edit'])
                    $redirect_url = 'products/edit/' . $model->getId() . '/' . $locale;

                echo json_encode(array(
                    'ok' => true,
                    'redirect_url' => $redirect_url,
                ));
            }
        }
        else {
            // Create array from ids of additional product categories.
            $productCategories = array();
            foreach ($model->getCategorys() as $productCategory)
                array_push($productCategories, $productCategory->getId());


            $additionalImagePositions = array();

            foreach ($model->getSProductImagess() as $addImage) {
                $additionalImagePositions[$addImage->getPosition()] = $addImage;
            }

            $model->setLocale($locale);

            foreach ($model->getProductVariants() as $variant) {
                $variant->setLocale($locale);
            }

            $this->render('edit', array(
                'model' => $model,
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
                'productCategories' => $productCategories,
                'additionalImagePositions' => $additionalImagePositions,
                'warehouses' => SWarehousesQuery::create()->orderByName()->find(),
                'locale' => $locale
            ));
        }
    }

    protected function _process_warehouses($model) {
        // Process warehouses
        SWarehouseDataQuery::create()
                ->filterByProductId($model->getId())
                ->delete();

        if (sizeof($_POST['warehouses']) > 0) {
            foreach ($_POST['warehouses'] as $key => $val) {
                if ((int) $_POST['warehouses_c'][$key] > 0 && $val > 0) {
                    // Add warehouse data
                    $wData = new SWarehouseData();
                    $wData->setCount($_POST['warehouses_c'][$key]);
                    $wData->setWarehouseId($val);
                    $wData->setProductId($model->getId());
                    $model->addSWarehouseData($wData);
                }
            }
        }
    }

    /**
     * Resize and save additional images.
     *
     * @param integer $productId Product Id
     * @access public
     */
  public function saveAdditionalImages(SProducts $model) {
    	// Check if we have to delete some images
    	if (sizeof($_POST['imagesForDelete']) > 0) {
        	foreach ($_POST['imagesForDelete'] as $key => $pos) {
            	$image = SProductImagesQuery::create()
                    	->filterByProductId($model->getId())
                    	->filterByPosition($pos)
                    	->findOne();

            	if ($image)
                	$image->delete();

            	@unlink(ShopCore::$imagesUploadPath . $model->getId() . "_$pos.jpg");
        	}
    	}

    	$this->load->library('image_lib');


    	$productId = $model->getId();
    	$imgs = SProductImagesQuery::create()->filterByProductId($productId)->orderByPosition(Criteria::DESC)->findOne();   	 
    	if ($imgs)
        	$i = intval ($imgs->getPosition()) + 1;
    	else
        	$i = 0;

    	foreach ($_FILES as $key => $file) {
        	if (strstr($key, 'additionalImage_') && $this->_isAllowedExtension($file['name'])) {
            	$fileName = ShopCore::$imagesUploadPath . $productId . "_$i.jpg";
            	$thumbPath = ShopCore::$imagesUploadPath . 'additionalImageThumbs/' . $productId . "_$i.jpg";

            	$imgSizes = $this->getImageSize($file['tmp_name']);

            	if ($imgSizes['width'] >= $this->imageSizes['maxImageWidth'] OR $imgSizes['height'] >= $this->imageSizes['maxImageHeight']) {
                	$this->image_lib->clear();
                	$config['image_library'] = 'gd2';
                	$config['source_image'] = $file['tmp_name'];
                	$config['create_thumb'] = false;
                	$config['maintain_ratio'] = true;
                	$config['width'] = $this->imageSizes['maxImageWidth'];
                	$config['height'] = $this->imageSizes['maxImageHeight'];
                	$config['new_image'] = $fileName;
                	$config['quality'] = $this->imageQuality;

                	$this->image_lib->initialize($config);
                	$this->image_lib->resize();
            	} else {
                	move_uploaded_file($file['tmp_name'], $fileName);
            	}

            	// Create thumb
            	$this->image_lib->clear();
            	$config['image_library'] = 'gd2';
            	$config['source_image'] = $fileName;
            	$config['create_thumb'] = false;
            	$config['maintain_ratio'] = true;
            	$config['width'] = $this->imageSizes['smallAddImageWidth'];
            	$config['height'] = $this->imageSizes['smallAddImageHeight'];
            	$config['new_image'] = $thumbPath;
            	$config['quality'] = $this->imageQuality;
            	$this->image_lib->initialize($config);
            	$this->image_lib->resize();

            	// Draw watermark
            	$this->draw_watermark($fileName, array('additionalImage'));

            	SProductImagesQuery::create()
                    	->filterByProductId($model->getId())
                    	->filterByImageName($productId . "_$i.jpg")
                    	->delete();

            	$newImage = new SProductImages;
            	$newImage->setImageName($productId . "_$i.jpg");
            	$newImage->setPosition($i);
            	$model->addSProductImages($newImage);
        	}

        	$i++;
    	}

    	return $model;
	}


    /**
     * Delete product
     *
     * @access public
     */
    public function delete() {
        $model = SProductsQuery::create()->findPk((int) $_POST['productId']);

        if ($model !== null)
            $model->delete();
    }

    /**
     * Insert product variants from $_POST data.
     *
     * @param integer $productId
     * @access protected
     */
    protected function _insert_variants($productId, $locale = null) {
        $locale = $locale == null ? $this->defaultLanguage['identif'] : $locale;

        // Insert product variants
        if (!empty($_POST['variants'])) {
            $totalVariants = sizeof($_POST['variants']['Name']);
            $variants = array_fill(0, $totalVariants, array());
            $keepById = array();
            $files = array();

            if (isset($_FILES['variants'])) {
                if (isset($_FILES['variants']['name']['mainPhoto'])) {
                    foreach ($_FILES['variants']['name']['mainPhoto'] as $key => $value) {
                        $files[$key]['mainPhoto'] = array(
                            'name' => $_FILES['variants']['name']['mainPhoto'][$key],
                            'type' => $_FILES['variants']['type']['mainPhoto'][$key],
                            'tmp_name' => $_FILES['variants']['tmp_name']['mainPhoto'][$key],
                            'error' => $_FILES['variants']['error']['mainPhoto'][$key],
                            'size' => $_FILES['variants']['size']['mainPhoto'][$key]
                        );
                    }
                }

                if (isset($_FILES['variants']['name']['smallPhoto'])) {
                    foreach ($_FILES['variants']['name']['smallPhoto'] as $key => $value) {
                        $files[$key]['smallPhoto'] = array(
                            'name' => $_FILES['variants']['name']['smallPhoto'][$key],
                            'type' => $_FILES['variants']['type']['smallPhoto'][$key],
                            'tmp_name' => $_FILES['variants']['tmp_name']['smallPhoto'][$key],
                            'error' => $_FILES['variants']['error']['smallPhoto'][$key],
                            'size' => $_FILES['variants']['size']['smallPhoto'][$key]
                        );
                    }
                }
            }

            foreach ($_POST['variants'] as $key => $values) {
                for ($i = 0; $i < sizeof($values); $i++)
                    $variants[$i][$key] = $values[$i];
            }

            $i = 0;
            foreach ($variants as $variant) {

                // Apply variant images
                if (array_key_exists($variant['CurrentId'], $files)) {
                    if (isset($files[$variant['CurrentId']]['mainPhoto']))
                        $variant['mainPhoto'] = $files[$variant['CurrentId']]['mainPhoto'];
                    if (isset($files[$variant['CurrentId']]['smallPhoto']))
                        ;
                    $variant['smallPhoto'] = $files[$variant['CurrentId']]['smallPhoto'];
                }
                // For new variants
                if (isset($variant['RandomId']) && !empty($variant['RandomId'])) {
                    if (array_key_exists($variant['RandomId'], $files)) {
                        if (isset($files[$variant['RandomId']]['mainPhoto']))
                            $variant['mainPhoto'] = $files[$variant['RandomId']]['mainPhoto'];
                        if (isset($files[$variant['RandomId']]['smallPhoto']))
                            ;
                        $variant['smallPhoto'] = $files[$variant['RandomId']]['smallPhoto'];
                    }
                }

                // Add valuta and the corresponding prices
                if ($variant['Price'] != '' && is_numeric($variant['Price']) && $variant['Valuta']) {
                    $variant['ValutaPrice'] = $variant['Price'];
                    $cur_valuta = $variant['Valuta'];
                    $valuta = getCurrency();
                    $variant['Price'] = round($variant['Price'] / $valuta[$cur_valuta][rate]);
                }

                // Add variants with Name and Price filled.
                if ($variant['Price'] != '' && is_numeric($variant['Price'])) {
                    if (isset($variant['CurrentId']) && $variant['CurrentId'] > 0) {
                        $productVariant = SProductVariantsQuery::create()
                                ->where('SProductVariants.ProductId = ?', $productId)
                                ->where('SProductVariants.Id = ?', $variant['CurrentId'])
                                ->findOne();
                    } else {
                        $productVariant = new SProductVariants;
                    }

                    $variant['locale'] = $locale;

                    $productVariant->fromArray($variant);
                    $productVariant->setPosition($i);
                    $productVariant->setProductId($productId);
                    $productVariant->save();

                    $variantId = $productVariant->getId();

                    $this->load->library('image_lib');

                    if ($this->_isAllowedExtension($variant['mainPhoto']['name'])) {

                        $fileName = ShopCore::$imagesUploadPath . $productId . "_vM$variantId.jpg";
                        $imgSizes = $this->getImageSize($variant['mainPhoto']['tmp_name']);

                        if ($imgSizes['width'] >= $this->imageSizes['maxImageWidth'] OR $imgSizes['height'] >= $this->imageSizes['maxImageHeight']) {
                            $this->image_lib->clear();
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $variant['mainPhoto']['tmp_name'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = true;
                            $config['width'] = $this->imageSizes['maxImageWidth'];
                            $config['height'] = $this->imageSizes['maxImageHeight'];
                            $config['new_image'] = $fileName;
                            $config['quality'] = $this->imageQuality;

                            $this->image_lib->initialize($config);

                            if ($this->image_lib->resize()) {
                                $mainImageResized = true;
                                $productVariant->setMainimage($productId . "_vM$variantId.jpg");
                            }
                        } else {
                            $mainImageResized = true;
                            $productVariant->setMainimage($productId . "_vM$variantId.jpg");
                            move_uploaded_file($variant['mainPhoto']['tmp_name'], $fileName);
                        }
                    }

                    if (empty($variant['smallPhoto']['tmp_name']) && $mainImageResized === true)
                        $smallImageSource = $fileName;
                    elseif (!empty($variant['smallPhoto']['tmp_name']) && $this->_isAllowedExtension($variant['smallPhoto']['name']) === true)
                        $smallImageSource = $variant['smallPhoto']['tmp_name'];
                    else
                        $smallImageSource = false;

                    if ($smallImageSource != false) {
                        $fileName = ShopCore::$imagesUploadPath . $productId . "_vS$variantId.jpg";

                        if (file_exists($fileName))
                            unlink($fileName);

                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $smallImageSource;
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = true;
                        $config['width'] = $this->imageSizes['smallImageWidth'];
                        $config['height'] = $this->imageSizes['smallImageHeight'];
                        $config['new_image'] = $fileName;
                        $config['quality'] = $this->imageQuality;

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $productVariant->setSmallimage($productId . "_vS$variantId.jpg");

                        $this->draw_watermark($fileName, array('thumb' => 'thumb'));
                        $this->draw_watermark($smallImageSource, array('variantSmall' => 'variantSmall'));
                    }

                    $productVariant->save();
                    $mainImageResized = false;
                    $keepById[] = $variantId;
                    $i++;
                }
            }
        }

        // Delete variants
        if (sizeof($keepById) > 0) {
            $model = SProductVariantsQuery::create()
                    ->where('SProductVariants.ProductId = ?', $productId)
                    ->where('SProductVariants.Id NOT IN ?', $keepById)
                    ->find();
            $model->delete();
        } else {
            $model = SProductVariantsQuery::create()
                    ->where('SProductVariants.ProductId = ?', $productId)
                    ->find();
            $model->delete();
        }
    }

    /**
     * Draw watermark
     * @var string $file_path
     */
    private function draw_watermark($fullPath, $format) {
        $logo = './uploads/watermark/';

        $settings = &ShopCore::app()->SSettings;
        foreach ($format as $form) {


            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $settings->watermark_watermark_image;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;

            switch ($form) {
                case 'mainMod':

                    $config['width'] = $this->imageSizes['mainModImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['mainModImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'mainModImageWidth.png';
                    $var = $logo . 'mainModImageWidth.png';

                    break;
                case 'main':
                    $config['width'] = $this->imageSizes['mainImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['mainImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'mainImageWidth.png';
                    $var = $logo . 'mainImageWidth.png';

                    break;
                case 'small':
                    $config['width'] = $this->imageSizes['smallImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['smallImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'smallImageWidth.png';
                    $var = $logo . 'smallImageWidth.png';


                    break;
                case 'smallMod':
                    $config['width'] = $this->imageSizes['smallModImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['smallModImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'smallModImageWidth.png';
                    $var = $logo . 'smallModImageWidth.png';

                    break;
                case 'thumb':
                    $config['width'] = $this->imageSizes['smallImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['smallImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'smallImageWidth.png';
                    $var = $logo . 'smallImageWidth.png';

                    break;
                case 'createThumb':
                    $config['width'] = $this->imageSizes['smallAddImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['smallAddImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'smallAddImageWidth.png';
                    $var = $logo . 'smallAddImageWidth.png';

                    break;
                case 'additionalImage':
                    $config['width'] = $this->imageSizes['maxImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['maxImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'maxImageWidth.png';
                    $var = $logo . 'maxImageWidth.png';

                    break;
                case 'variantSmall':
                    $config['width'] = $this->imageSizes['smallImageWidth'] / 100 * $settings->watermark_interest;
                    $config['height'] = $this->imageSizes['smallImageHeight'] / 100 * $settings->watermark_interest;
                    $config['new_image'] = $logo . 'variantSmall.png';
                    $var = $logo . 'variantSmall.png';

                    break;
            }
            $this->image_lib->initialize($config);
            $this->image_lib->resize();



            if (!$settings->watermark_active)
                return;

            if ($settings->watermark_watermark_font_path == '') {
                $settings->watermark_watermark_font_path = './system/fonts/1.ttf';
            }

            $config = array();
            $config['source_image'] = $fullPath;
            $config['wm_vrt_alignment'] = $settings->watermark_wm_vrt_alignment;
            $config['wm_hor_alignment'] = $settings->watermark_wm_hor_alignment;
            $config['wm_padding'] = $settings->watermark_watermark_padding;

            if ($settings->watermark_watermark_type == 'overlay') {
                $config['wm_type'] = 'overlay';
                $config['wm_opacity'] = $settings->watermark_watermark_image_opacity;
                $config['wm_overlay_path'] = $var;
            } else {
                if ($settings->watermark_watermark_text == '')
                    return FALSE;

                $config['wm_text'] = $settings->watermark_watermark_text;
                $config['wm_type'] = 'text';
                $config['wm_font_path'] = $settings->watermark_watermark_font_path;
                $config['wm_font_size'] = $settings->watermark_watermark_font_size;
                $config['wm_font_color'] = $settings->watermark_watermark_color;
            }

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->watermark();
        }
    }

    /**
     * Check if file has allowed extension
     *
     * @param string $fileName
     * @access protected
     * @return bool
     */
    protected function _isAllowedExtension($fileName) {
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
    protected function getImageSize($file_path) {
        if (function_exists('getimagesize') && file_exists($file_path)) {
            $image = @getimagesize($file_path);

            $size = array(
                'width' => $image[0],
                'height' => $image[1],
            );

            return $size;
        }

        return false;
    }

    public function ajaxChangeActive($productId = null) {
        $model = SProductsQuery::create()
                ->findPk($productId);

        if ($model !== null) {
            $model->setActive(!$model->getActive());
            $model->save();
        }

        if (sizeof($_POST['ids'] > 0)) {
            $model = SProductsQuery::create()
                    ->findPks($_POST['ids']);

            if (!empty($model)) {
                foreach ($model as $product) {
                    $product->setActive(!$product->getActive());
                    $product->save();
                }
            }
        }
    }

    public function ajaxChangeHit($productId = null) {
        $model = SProductsQuery::create()
                ->findPk($productId);

        if ($model !== null) {
            $model->setHit(!$model->getHit());
            $model->save();
        }

        if (sizeof($_POST['ids'] > 0)) {
            $model = SProductsQuery::create()
                    ->findPks($_POST['ids']);

            if (!empty($model)) {
                foreach ($model as $product) {
                    $product->setHit(!$product->getHit());
                    $product->save();
                }
            }
        }
    }

    public function ajaxChangeHot($productId = null) {
        $model = SProductsQuery::create()
                ->findPk($productId);

        if ($model !== null) {
            $model->setHot(!$model->getHot());
            $model->save();
        }

        if (sizeof($_POST['ids'] > 0)) {
            $model = SProductsQuery::create()
                    ->findPks($_POST['ids']);

            if (!empty($model)) {
                foreach ($model as $product) {
                    $product->setHot(!$product->getHot());
                    $product->save();
                }
            }
        }
    }

    public function ajaxChangeAction($productId = null) {
        $model = SProductsQuery::create()
                ->findPk($productId);

        if ($model !== null) {
            $model->setAction(!$model->getAction());
            $model->save();
        }

        if (sizeof($_POST['ids'] > 0)) {
            $model = SProductsQuery::create()
                    ->findPks($_POST['ids']);

            if (!empty($model)) {
                foreach ($model as $product) {
                    $product->setAction(!$product->getAction());
                    $product->save();
                }
            }
        }
    }

    public function ajaxCloneProducts() {
        //TODO: clone images
        if (sizeof($_POST['ids'])) {
            $products = SProductsQuery::create()->findPks($_POST['ids']);
            foreach ($products as $p) {
                $cloned = $p->copy();
                $cloned->setName($cloned->getName() . ' (копия)');
                $cloned->setUpdated(time());
                $cloned->setMainImage('');
                $cloned->setSmallImage('');
                $cloned->save();
                $cloned->setUrl($cloned->getId());
                $cloned->save();

                // Clone product variants
                $variants = SProductVariantsQuery::create()
                        ->filterByProductId($p->getId())
                        ->find();

                foreach ($variants as $v) {
                    $variantClone = $v->copy();
                    $variantClone->setProductId($cloned->getId());
                    $variantClone->setMainimage('');
                    $variantClone->setSmallimage('');
                    $variantClone->save();
                }

                // Clone category relations
                $cats = ShopProductCategoriesQuery::create()
                        ->filterByProductId($p->getId())
                        ->find();

                foreach ($cats as $catClone) {
                    $catClone = $catClone->copy();
                    $catClone->setProductId($cloned->getId());
                    $catClone->save();
                }

                // Clone properties
                $props = SProductPropertiesDataQuery::create()
                        ->filterByProductId($p->getId())
                        ->find();

                if ($props->count() > 0) {
                    foreach ($props as $prop) {
                        $propClone = new SProductPropertiesData;
                        $propClone->setProductId($cloned->getId());
                        $propClone->setPropertyId($prop->getPropertyId());
                        $propClone->setValue($prop->getValue());

                        $cloned->addSProductPropertiesData($propClone);
                    }
                }

                $cloned->save();

                // Clone main/small image
                if ($p->getMainImage()) {
                    $source_file = ShopCore::$imagesUploadPath . $p->getMainImage();
                    if (file_exists($source_file)) {
                        copy($source_file, ShopCore::$imagesUploadPath . $cloned->getId() . '_main.jpg');
                        $cloned->setMainImage($cloned->getId() . '_main.jpg');
                    }
                }

                if ($p->getSmallImage()) {
                    $source_file = ShopCore::$imagesUploadPath . $p->getSmallImage();
                    if (file_exists($source_file)) {
                        copy($source_file, ShopCore::$imagesUploadPath . $cloned->getId() . '_small.jpg');
                        $cloned->setSmallImage($cloned->getId() . '_small.jpg');
                    }
                }

                $cloned->save();
            }
        }
    }

    /**
     * Delete products
     */
    public function ajaxDeleteProducts() {
        if (sizeof($_POST['ids'] > 0)) {
            $model = SProductsQuery::create()
                    ->findPks($_POST['ids']);

            if (!empty($model)) {
                foreach ($model as $product) {
                    $product->delete();
                }
            }
        }
    }

    /**
     * Show move products window
     * @param $categoryId
     */
    public function ajaxMoveWindow($categoryId) {
        $this->render('_moveWindow', array(
            'categories' => ShopCore::app()->SCategoryTree->getTree(),
            'categoryId' => $categoryId,
        ));
    }

    /**
     * Move products to another category
     */
    public function ajaxMoveProducts() {
        $newCategoryModel = SCategoryQuery::create()
                ->findPk($_POST['categoryId']);

        $products = SProductsQuery::create()
                ->findPks($_POST['ids']);

        if ($newCategoryModel !== null && !empty($products)) {
            foreach ($products as $product) {
                // Delete main category relation
                ShopProductCategoriesQuery::create()
                        ->filterByProductId($product->getId())
                        ->filterByCategoryId($product->getCategoryId())
                        ->delete();

                // Add new main category relation
                $product->setCategoryId($newCategoryModel->getId());
                $product->addCategory($newCategoryModel);
                $product->save();
            }
        }
    }

    public function translate($id) {
        $model = SProductsQuery::create()->findPk((int) $id);

        if ($model === null)
            $this->error404('Товар не найден.');

        $languages = ShopCore::$ci->cms_admin->get_langs();

        $translatableFieldNames = $model->getTranslatableFieldNames();

        /**
         *  Update product translation
         */
        if (!empty($_POST)) {
            //form validating
            $translatingRules = $model->translatingRules();
            foreach ($languages as $language) {
                foreach ($translatableFieldNames as $fieldName) {
                    $this->form_validation->set_rules($fieldName . '_' . $language['identif'], $model->getLabel($fieldName) . ' язык ' . $language['lang_name'], $translatingRules[$fieldName]);
                }
            }

            if ($this->form_validation->run() == FALSE) {
                showMessage(validation_errors());
            } else {
                foreach ($languages as $language) {
                    $model->setLocale($language['identif']);
                    foreach ($translatableFieldNames as $fieldName) {
                        $methodName = 'set' . $fieldName;
                        $model->$methodName($this->input->post($fieldName . '_' . $language['identif']));
                    }

                    //begin of processing product variants translating
                    foreach ($_POST['variants' . '_' . $language['identif']] as $key => $values) {
                        for ($i = 0; $i < sizeof($values); $i++) {
                            $variants[$i][$key] = $values[$i];
                        }
                    }

                    foreach ($variants as $variant) {
                        $variantModel = SProductVariantsQuery::create()
                                ->where('SProductVariants.ProductId = ?', $model->getId())
                                ->where('SProductVariants.Id = ?', $variant['CurrentId'])
                                ->findOne();

                        if ($variantModel instanceof SProductVariants) {
                            $variantModel->setLocale($language['identif']);
                            $variantModel->setName($variant['Name']);
                            $variantModel->save();
                        }
                    }
                    //end of processing product variants translating
                }

                $model->save();

                showMessage('Изменения сохранены');
            }
        } else {

            $mceEditorFieldNames = array('ShortDescription', 'FullDescription');
            $requairedFieldNames = array('Name');

            $this->render('translate', array(
                'model' => $model,
                'languages' => $languages,
                'translatableFieldNames' => $translatableFieldNames,
                'mceEditorFieldNames' => $mceEditorFieldNames,
                'requairedFieldNames' => $requairedFieldNames,
            ));
        }
    }

//    //processing I18n table
//    public function processI18n()
//    {
//        $classes = array(
//            'SCategory',
//            'SProducts',
//            'SBrands',
//            'SProductVariants',
//            'SProperties',
//            'SNotificationStatuses',
//            'SDeliveryMethods',
//            'SOrderStatuses',
//            'SPaymentMethods',
//            'SCallbackStatuses',
//            'SCallbackThemes',
//            'ShopBaners'
//        );
//        foreach($classes as $class){
//            $queryClass = $class.'Query';
//        
//            $i18nClass = $class.'I18n';
//            $i18nQueryClass = $i18nClass.'Query';
//            $i18nPeerName = $i18nClass.'Peer';
//
//            $model = $queryClass::create()->find();
//            //clearing i18n table
//            $i18nModel = $i18nQueryClass::create()->find()->delete();
//
//            $i18nFieldNames = $i18nPeerName::getFieldNames(BasePeer::TYPE_PHPNAME);
//            $i18nFieldNames = array_flip($i18nFieldNames);		
//            if (array_key_exists('Locale', $i18nFieldNames)){
//                unset($i18nFieldNames['Locale']);
//            }        
//            $i18nFieldNames = array_flip($i18nFieldNames);
//
//            foreach ($model as $item) {
//                $i18nModel = new $i18nClass;
//                $i18nModel->setLocale('ru');
//
//                foreach ($i18nFieldNames as $i18nFieldName) {
//                    $getterMethodName = 'get'.$i18nFieldName;
//                    $i18nSetterMethodName = 'set'.$i18nFieldName;
//                    $i18nModel->$i18nSetterMethodName($item->$getterMethodName());
//                }
//
//                $i18nModel->save();
//            }
//        }
//                
//        echo 'done';
//    }
}
