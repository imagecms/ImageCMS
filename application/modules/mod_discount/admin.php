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
        
        if ($this->input->post()){
            $postArray = $this->input->post();
            $typeDiscount = $postArray['type_discount'];
            $typeDiscountTableName = 'mod_discount_'.$typeDiscount;
            
            //Check have any comulativ discount max end value
            if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] == null && $this->discount_model_admin->checkHaveAnyComulativDiscountMaxEndValue()){
                showMessage('Не может существовать более одной скидки, с указанным верхним порогом как “максимум”!','','r');
                exit;
            }
            
            // If empty field with discount key, then generate key
            if ($postArray['key'] == null)
                $postArray['key'] = $this->generateDiscountKey ();
            
            //Prepare data for inserting in the table 'mod_shop_discounts'
            $data = array (
                'name' => $postArray['name'],
                'key' => $postArray['key'],
                'max_apply' => $postArray['max_apply'],
                'type_value' => $postArray['type_value'],
                'value' => $postArray['value'],
                'type_discount' => $typeDiscount,
                'date_begin' => strtotime($postArray['date_begin']),
                'date_end' => strtotime($postArray['date_end']),
                'active' => '1'
            );
            
            //Insert data in table 'mod_shop_discounts' and if success then get discount id
            $discountId = $this->discount_model_admin->insertDataToDB('mod_shop_discounts', $data);
            
            //Prepare data for inserting in the table of selected discount type
            $typeDiscountData = $postArray[$typeDiscount];
            
            //If was error when inserted in the table 'mod_shop_discounts' then exit
            if ($discountId != false){
                $typeDiscountData['discount_id'] = $discountId;
                $result = $this->discount_model_admin->insertDataToDB($typeDiscountTableName, $typeDiscountData);
            }else{
                showMessage('Не удалось создать скидку!','','r');
                exit;
            }
                
            //If discount created success then show message and redirect to discounts list
            if ($result != false){
                showMessage('Скидка успешно создана!');
                pjax('index');
            }

        }else {
            
            //Prepare data for template
            $userGroups = $this->discount_model_admin->getUserGroups(MY_Controller::getCurrentLocale());
            $data = array(
                'userGroups'=>$userGroups,
                'CS' => $this->discount_model_admin->getMainCurrencySymbol(),
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
            );
            
            //Render template and set data
            CMSFactory\assetManager::create()
                       ->setData($data)
                       ->renderAdmin('create');
            }
    }
    
    /**
    * Edit discount   
    */
    public function edit($id) {
        
        
        if ($this->input->post()){
            var_dumps($_POST);
            
            
            
        }else {
            $userGroups = $this->discount_model_admin->getUserGroups(MY_Controller::getCurrentLocale());
            var_dump($this->discount_model_admin->getDiscountAllDataById($id));
            
            $data = array(
                'discount' =>$this->discount_model_admin->getDiscountAllDataById($id),
                'userGroups'=>$userGroups,
                'CS' => $this->discount_model_admin->getMainCurrencySymbol(),
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
            );
            
            CMSFactory\assetManager::create()
                   ->setData($data)
                   ->renderAdmin('edit');
        }
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
        
        $users = $this->discount_model_admin->getUsersByIdNameEmail($sCoef, $sLimit);
        
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
