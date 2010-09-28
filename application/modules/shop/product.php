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
class Product extends ShopController {

    public $model = null;

	public function __construct()
	{
	    parent::__construct(); 	

        // Get last uri segment
        $productUrl = $this->uri->segment($this->uri->total_segments());
        
        $model = SProductsQuery::create()
            ->filterByUrl($productUrl)
            ->findOne();

        if ($model === null) 
            $this->error404(); 
        else
            $this->model = $model;

        $this->index();
        exit;
	}

    /**
     * Display product info.
     * 
     * @access public
     */
	public function index()
	{
        //$this->core->set_meta_tags($this->model->getName());
            
        $this->render('product',array(
            'model'=>$this->model,            
        )); 
    }
}

/* End of file product.php */
