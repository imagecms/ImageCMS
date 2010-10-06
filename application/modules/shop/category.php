<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Shop Controller
 * 
 * @uses ShopController
 * @package Shop
 * @version 0.1
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 */
class Category extends ShopController {

    protected $model;

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('string');

        $requestString = trim_slashes($this->uri->uri_string());
        $requestArray = explode('/', $requestString);

        // Remove shop/category from request.
        $categoryPath = implode('/', array_slice($requestArray,2));

        // Search category
        $model = SCategoryQuery::create()
            ->filterByFullPath($categoryPath)
            ->findOne();

        if ($model === null) 
            $this->error404(); 
        else
            $this->model = $model;

        $this->index();
        exit;
	}

    /**
     * Display category products.
     * 
     * @access public
     */
	public function index()
	{
        // Search all brands in current category
        $brandsInCategory = SProductsQuery::create()
            ->filterByCategoryId($this->model->getId())
            ->where('SProducts.BrandId != ?', 0)
            ->select(array('BrandId'))
            ->find()->toArray();

        if (sizeof($brandsInCategory) > 0)
        {
            $brandsInCategory = SBrandsQuery::create()
                ->findPks($brandsInCategory);
        }

        //$products = $this->model->getProducts($criteria);
        $products = SProductsQuery::create();
        $products = $products->filterByCategory($this->model);
        
        if (ShopCore::$_GET['brand'] > 0)
            $products = $products->filterByBrandId((int) ShopCore::$_GET['brand']);

        $products = $products->find();

        $totalProducts = $this->model->countProducts();

        $this->render('category', array(
            'model'=>$this->model,
            'products'=>$products,
            'totalProducts'=>$totalProducts,
            'brandsInCategory'=>$brandsInCategory,
        ));
    }
}

/* End of file category.php */
