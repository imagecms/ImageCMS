<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Mod_Discount module
 * @uses BaseAdminController
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule

 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
        $this->load->model('discount_model_admin');
        CMSFactory\assetManager::create()
                   ->registerStyle('style')
                   ->registerScript('adminScripts');
    }
    
    /**
    * For displaing list of discounts
    */
    public function index() {
        $data = array('discountsList' => $this->discount_model_admin->getDiscountsList());
                
        CMSFactory\assetManager::create()
                   ->setData($data)
                   ->renderAdmin('list', true);
    }
    
    /**
     * Create discount
     */
    public function create() {
        $user_groups = $this->discount_model_admin->getUserGroups(MY_Controller::getCurrentLocale());
        $data = array(
            'userGroups'=>$user_groups,
            'CS' => $this->discount_model_admin->getMainCurrencySymbol(),
            'categories' => ShopCore::app()->SCategoryTree->getTree(),
        );
        if ($this->input->post()){
            var_dumps($_POST);
        }else {
        CMSFactory\assetManager::create()
                   ->setData($data)
                   ->renderAdmin('create');
        }
    }
    
    /**
    * Edit discount   
    */
    public function edit() {
        
    }
    
    
    /**
     * Change status(active or not)
     */
    public function ajaxChangeActive() {
       $id = $this->input->post('id');

       return $this->discount_model_admin->changeActive($id);
    }
    
    
    /**
     * Generate 
     *
     * @param int $charsCount
     * @param int $digitsCount
     * @static
     * @access public
     * @return string
     */
    
    public static function generateDiscountKey($charsCount = 8, $digitsCount = 8) {
        $chars = array('q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm');

        if ($charsCount > sizeof($chars))
            $charsCount = sizeof($chars);

        $result = array();
        if ($charsCount > 0) {
            $randCharsKeys = array_rand($chars, $charsCount);

            foreach ($randCharsKeys as $key => $val)
                array_push($result, $chars[$val]);
        }

        for ($i = 0; $i < $digitsCount; $i++)
            array_push($result, rand(0, 9));

        shuffle($result);

        $result = implode('', $result);
        
        $ci = get_instance();
        if ($ci->discount_model_admin->checkDiscountCode($result))
            self::generateDiscountKey($charsCount, $digitsCount);

        return $result;
    }
    
    
    /**
     * Autocomlite users by name, email, id for orders create
     */
    public function autoCompliteUsers() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');
        
        $users = $this->discount_model_admin->getProductsByIdNameArticle($sCoef, $sLimit);
        
        if ($users != false){
            foreach ($users as $user) {
                $response[] = array(
                    'value' => $user['id']. ' - ' . $user['username'] . ' - ' . $user['email'],
                    'id' => $user['id'],
                    'name' => $user['username'],
                    'email' => $user['email'],
                );
            }
            echo json_encode($response);
            return;
        }
        echo '';
    }
     /**
      * 
      * @return type
      */       
     public function autoCompliteProducts() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');
        
        $products = $this->discount_model_admin->getProductsByIdNameNumber($sCoef, $sLimit);
        
        if ($products != false){
            foreach ($products as $product) {
                $response[] = array(
                    'value' => $product['name'],
                    'id' => $product['id'],
                );
            }
            echo json_encode($response);
            return;
        }
        echo '';
    }
    
}

/* End of file admin.php */
