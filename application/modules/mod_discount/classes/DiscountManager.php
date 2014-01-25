<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class DiscountManager for Mod_Discount module
 * @use \My_Controller
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class DiscountManager extends \MY_Controller {

    public $error = array();
    
    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('mod_discount');
        $this->load->model('discount_model_admin');
    }

    /**
     * create brand discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (int) brand_id: id brand
     * @return array $data params:
     * - (boolean) success: result of create brand discount
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createBrandDiscount($data) {
        
        if (!$this->discount_model_admin->checkEntityExists('brand',$data['brand_id']))
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        $data['type_discount'] = 'brand';
        $data['brand']['brand_id'] = $data['brand_id'];
        unset($data['brand_id']);
        return $this->create($data);
    }

    /**
     * create category discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (int) category_id: id category
     * - (int) child: change childs category
     * @return array $data params:
     * - (boolean) success: result of create category discount
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createCategoryDiscount($data) {

        if (!$this->discount_model_admin->checkEntityExists('category',$data['category_id']))
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        $data['type_discount'] = 'category';
        $data['category']['category_id'] = $data['category_id'];
        $data['category']['child'] = $data['child'];
        unset($data['category_id']);
        return $this->create($data);
    }

    /**
     * create product discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (int) product_id: id product
     * @return array $data params:
     * - (boolean) success: result of create product discount
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createProductDiscount($data) {

        if (!$this->discount_model_admin->checkEntityExists('product',$data['product_id']))
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        $data['type_discount'] = 'product';
        $data['product']['product_id'] = $data['product_id'];
        unset($data['product_id']);
        return $this->create($data);
    }

    /**
     * create user discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (int) user_id: id user
     * @return array $data params:
     * - (boolean) success: result of create user discount
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createUserDiscount($data) {

        if (!$this->discount_model_admin->checkEntityExists('user',$data['user_id']))
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        $data['type_discount'] = 'user';
        $data['user']['user_id'] = $data['user_id'];
        unset($data['user_id']);
        return $this->create($data);
    }

    /**
     * create user group discount discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (int) group_id: id user group
     * @return array $data params:
     * - (boolean) success: result of create user group discount
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createUserGroupDiscount($data) {

        if (!$this->discount_model_admin->checkEntityExists('group_user',$data['group_id']))
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        $data['type_discount'] = 'group_user';
        $data['group_user']['group_id'] = $data['group_id'];
        unset($data['group_id']);
        return $this->create($data);
    }

    /**
     * create comulativ discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * - (float) begin_value: value begin
     * - (float) end_value: value end default null - infinity
     * @return array $data params:
     * - (boolean) success: result of create comulativ
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createComulativDiscount($data) {

        $data['type_discount'] = 'comulativ';
        $data['comulativ']['begin_value'] = $data['begin_value'];
        $data['comulativ']['end_value'] = $data['end_value'];
        unset($data['begin_value']);
        unset($data['end_value']);
        return $this->create($data);
    }

    /**
     * create gift discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * - (string) key: discount key optional
     * - (string) name: discount name
     * - (int) max_apply: max apply discount default null - infinity
     * - (int) type_value: 1 - % 2 - float
     * - (int) value: discount value
     * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
     * - (string) date_begin: data begin discount 
     * - (string) date_end: data end discount default null - infinity
     * @return array $data params:
     * - (boolean) success: result of create gift
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function createGift($data) {

        $data['type_discount'] = 'all_order';
        $data['all_order']['is_gift'] = 1;
        return $this->create($data);
    }

     /**
     * delete discount
     * @access public
     * @author DevImageCms
     * @param (int) id discount:
     * @return (boolean) success: result of deleting
     * @copyright (c) 2013, ImageCMS
     */
    public function deleteDiscount($id){
        
        return $this->discount_model_admin->deleteDiscountById($id);
    }

    /**
     * create discount
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * @return array $data params:
     * - (boolean) success: result of create
     * - (string) errors: message of error
     * @copyright (c) 2013, ImageCMS
     */
    public function create($postArray) {

        $this->validation($postArray);
        
        if (count($this->error) > 0)
            return array('success' => false, 'error' => $this->error);

        if (!$postArray['key'])
            $postArray['key'] = $this->generateDiscountKey();     

        $typeDiscount = $postArray['type_discount'];
        $typeDiscountTableName = 'mod_discount_' . $typeDiscount;

        $data = array(
            'key' => $postArray['key'],
            'max_apply' => $postArray['max_apply'],
            'type_value' => $postArray['type_value'],
            'value' => $postArray['value'],
            'type_discount' => $typeDiscount,
            'date_begin' => strtotime($postArray['date_begin']),
            'date_end' => strtotime($postArray['date_end']),
            'active' => '1'
        );

        $discountId = $this->discount_model_admin->insertDataToDB('mod_shop_discounts', $data);

        $data_locale = array(
            'id' => $discountId,
            'locale' => \MY_Controller::getCurrentLocale(),
            'name' => $postArray['name']
        );

        $typeDiscountData = $postArray[$typeDiscount];

        $this->discount_model_admin->insertDataToDB('mod_shop_discounts_i18n', $data_locale);



        if ($discountId != false) {
            $typeDiscountData['discount_id'] = $discountId;
            $result = $this->discount_model_admin->insertDataToDB($typeDiscountTableName, $typeDiscountData);
        }

        if ($result && $discountId)
            return array('success' => true);
        else 
            return array('success' => false, 'error' => array('wrong query to db'));
    }
    
    /**
     * validation data
     * @access public
     * @author DevImageCms
     * @param array $postArray input params:
     * @copyright (c) 2013, ImageCMS
     */
    public function validation($postArray) {
        
        $typeDiscount = $postArray['type_discount'];
        
        if (!in_array($typeDiscount, array('all_order', 'comulativ', 'user', 'group_user', 'category', 'product', 'brand')))
            $this->error[] = lang('Wrong type discount');
        
        if ($typeDiscount == 'comulativ' &&  !$postArray['comulativ']['begin_value']) 
            $this->error[] = lang('Begin value must be');  
        
        if (!$postArray['value']) 
            $this->error[] = lang('Value must be');        
        
        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] < $postArray[$typeDiscount]['begin_value'] && is_numeric($postArray[$typeDiscount]['end_value'])) 
            $this->error[] = lang('Amount <<from>> can not be greater than the sum <<to>>', 'mod_discount');
        
        if ($typeDiscount == 'product' && !$postArray[$typeDiscount]['product_id']) 
            $this->error[] = lang('Enter a product that is in the database', 'mod_discount');
        
        if ($typeDiscount == 'user' && !$postArray[$typeDiscount]['user_id']) 
            $this->error[] = lang('Enter the user who is in the database', 'mod_discount');
        
        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] == null && $this->discount_model_admin->checkHaveAnyComulativDiscountMaxEndValue()) 
            $this->error[] = lang('There can be more than one discount with said upper threshold as a <<maximum>>!', 'mod_discount');
        
        if ($postArray['type_value'] != 1 && $postArray['type_value'] != 2) 
            $this->error[] = lang('Invalid type value!', 'mod_discount');
       
        if ($postArray['type_value'] == 1 && $postArray['value'] >= 100) 
            $this->error[] = lang('Invalid type value!', 'mod_discount');
        
        if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $postArray['date_begin']))
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        
        if($postArray['date_end'] && !preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $postArray['date_end']))
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        
        if ($postArray['date_begin'] > $postArray['date_end'] && !$postArray['date_end'] == null) 
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        
        if ($postArray['date_end'] && strtotime($postArray['date_end']) < time()) 
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        
        if (strtotime($postArray['date_begin']) < strtotime('2000-01-01')) 
            $this->error[] = lang('Invalid date range!', 'mod_discount');

        

        
    }

    /**
     * Generate key for discount
     *
     * @param int $charsCount
     * @param int $digitsCount
     * @static
     * @return string
     */
    private static function generateDiscountKey($charsCount = 8, $digitsCount = 8) {
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

}


