<?php

// to do validate max_aply, comulativ begin value end value, all_order begin_value

namespace mod_discount\classes;

use MY_Controller;
use MY_Lang;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class DiscountManager for Mod_Discount module
 * @use \My_Controller
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model_admin $discount_model_admin
 */
class DiscountManager extends MY_Controller
{

    public $error = [];

    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_discount');
        $this->load->model('discount_model_admin');
    }

    /**
     * create brand discount
     * @access public
     * @author DevImageCms
     * @param array $data input params:
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

        if (!$this->discount_model_admin->checkEntityExists('brand', $data['brand_id'])) {
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        }
        $data['type_discount'] = 'brand';
        $data['brand']['brand_id'] = $data['brand_id'];
        unset($data['brand_id']);
        return $this->create($data);
    }

    /**
     * create category discount
     * @access public
     * @author DevImageCms
     * @param array $data input params:
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

        if (!$this->discount_model_admin->checkEntityExists('category', $data['category_id'])) {
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        }
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
     * @param array $data input params:
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

        if (!$this->discount_model_admin->checkEntityExists('product', $data['product_id'])) {
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        }
        $data['type_discount'] = 'product';
        $data['product']['product_id'] = $data['product_id'];
        unset($data['product_id']);
        return $this->create($data);
    }

    /**
     * create user discount
     * @access public
     * @author DevImageCms
     * @param array $data input params:
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

        if (!$this->discount_model_admin->checkEntityExists('user', $data['user_id'])) {
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        }
        $data['type_discount'] = 'user';
        $data['user']['user_id'] = $data['user_id'];
        unset($data['user_id']);
        return $this->create($data);
    }

    /**
     * create user group discount discount
     * @access public
     * @author DevImageCms
     * @param array $data input params:
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

        if (!$this->discount_model_admin->checkEntityExists('group_user', $data['group_id'])) {
            $this->error[] = lang('Entity does not exists!', 'mod_discount');
        }
        $data['type_discount'] = 'group_user';
        $data['group_user']['group_id'] = $data['group_id'];
        unset($data['group_id']);
        return $this->create($data);
    }

    /**
     * create comulativ discount
     * @access public
     * @author DevImageCms
     * @param array $data input params:
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
     * @param array $data input params:
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
        $data['max_apply'] = 777;
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
    public function deleteDiscount($id) {

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

        if (count($this->error) > 0) {
            return ['success' => false, 'error' => $this->error];
        }

        if (!$postArray['key']) {
            $postArray['key'] = self::generateDiscountKey();
        }

        $typeDiscount = $postArray['type_discount'];
        $typeDiscountTableName = 'mod_discount_' . $typeDiscount;

        // Check range for cumulative discount
        if ($typeDiscount == 'comulativ' AND $this->discount_model_admin->checkRangeForCumulativeDiscount($postArray[$typeDiscount])) {
            return ['success' => false, 'error' => [lang('Has been already created with the cumulative discount value', 'mod_discount')]];
        }

        $data = [
            'key' => $postArray['key'],
            'type_value' => $postArray['type_value'],
            'value' => $postArray['value'],
            'type_discount' => $typeDiscount,
            'date_begin' => strtotime($postArray['date_begin']),
            'date_end' => strtotime($postArray['date_end']),
            'active' => '1'
        ];

        if ($postArray['max_apply']) {
            $data['max_apply'] = $postArray['max_apply'];
        }

        // gift correction (just in case)
        if ($postArray['all_order']['is_gift']) {
            $data['max_apply'] = 1;
        }

        if ($postArray['certificate']['is_gift']) {
            $data['max_apply'] = 1;
        }

        if ($postArray['type_discount'] == 'certificate') {
            $data['max_apply'] = 1;
            $postArray['all_order']['is_gift'] = 1;
            $postArray['certificate']['is_gift'] = 1;
        }

        $discountId = $this->discount_model_admin->insertDataToDB('mod_shop_discounts', $data);

        $data_locale = [
            'id' => $discountId,
            'locale' => MY_Controller::getCurrentLocale(),
            'name' => $postArray['name']
        ];

        $typeDiscountData = $postArray[$typeDiscount];

        $this->discount_model_admin->insertDataToDB('mod_shop_discounts_i18n', $data_locale);

        if ($discountId != false) {
            $typeDiscountData['discount_id'] = $discountId;
            $typeDiscountTableName = $typeDiscountTableName == 'mod_discount_certificate' ? 'mod_discount_all_order' : $typeDiscountTableName;
            $result = $this->discount_model_admin->insertDataToDB($typeDiscountTableName, $typeDiscountData);
        }

        if ($result && $discountId) {
            return ['success' => true, 'id' => $discountId];
        } else {
            return ['success' => false, 'error' => [lang('Error creating discount', 'mod_discount')]];
        }
    }

    /**
     * validation data
     * @access public
     * @author DevImageCms
     * @param array $postArray
     * @param integer $id (optional) need to be specified on discount editing
     * @copyright (c) 2013, ImageCMS
     */
    public function validation($postArray, $id = null) {

        $typeDiscount = $postArray['type_discount'];

        if (!in_array($typeDiscount, ['certificate', 'all_order', 'comulativ', 'user', 'group_user', 'category', 'product', 'brand'])) {
            $this->error[] = lang('Wrong type discount', 'mod_discount');
        }

        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] && !preg_match('/^[0-9]{1,15}$/', $postArray[$typeDiscount]['end_value'])) {
            $this->error[] = lang('End value must be numeric');
        }

        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['begin_value'] && !preg_match('/^[0-9]{1,15}$/', $postArray[$typeDiscount]['begin_value'])) {
            $this->error[] = lang('Begin value must be numeric');
        }

        if ($typeDiscount == 'certificate' && $postArray[$typeDiscount]['begin_value'] && !preg_match('/^[0-9]{1,15}$/', $postArray[$typeDiscount]['begin_value'])) {
            $this->error[] = lang('Begin value must be numeric');
        }

        if ($typeDiscount == 'all_order' && $postArray[$typeDiscount]['begin_value'] && !preg_match('/^[0-9]{1,15}$/', $postArray[$typeDiscount]['begin_value'])) {
            $this->error[] = lang('Begin value must be numeric');
        }

        if ($postArray['max_apply'] && !preg_match('/^[0-9]{1,15}$/', $postArray['max_apply'])) {
            $this->error[] = lang('Max apply must be numeric');
        }

        if (!$postArray['value'] || !preg_match('/^[0-9]{1,15}$/', $postArray['value'])) {
            $this->error[] = lang('Value must be numeric');
        }

        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] < $postArray[$typeDiscount]['begin_value'] && is_numeric($postArray[$typeDiscount]['end_value'])) {
            $this->error[] = lang('Amount <<from>> can not be greater than the sum <<to>>', 'mod_discount');
        }

        if ($typeDiscount == 'product' && !$postArray[$typeDiscount]['product_id']) {
            $this->error[] = lang('Enter a product that is in the database', 'mod_discount');
        }

        if ($typeDiscount == 'user' && !$postArray[$typeDiscount]['user_id']) {
            $this->error[] = lang('Enter the user who is in the database', 'mod_discount');
        }

        if ($typeDiscount == 'user' && !$this->validateUserDiscount($postArray[$typeDiscount]['user_id']) && $id == null) {
            $this->error[] = lang('This user already have active discount', 'mod_discount');
        }

        if ($typeDiscount == 'group_user' && !$this->validateGroupDiscount($postArray[$typeDiscount]['group_id']) && $id == null) {
            $this->error[] = lang('This group of users already have active discount', 'mod_discount');
        }

        if ($typeDiscount == 'comulativ' && $postArray[$typeDiscount]['end_value'] == null && $this->discount_model_admin->checkHaveAnyComulativDiscountMaxEndValue($id)) {
            $this->error[] = lang('There can be more than one discount with said upper threshold as a <<maximum>>!', 'mod_discount');
        }

        if ($postArray['type_value'] != 1 && $postArray['type_value'] != 2) {
            $this->error[] = lang('Invalid type value!', 'mod_discount');
        }

        if ($postArray['type_value'] == 1 && $postArray['value'] >= 100) {
            $this->error[] = lang('Invalid type value!', 'mod_discount');
        }

        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $postArray['date_begin'])) {
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        }

        if ($postArray['date_end'] && !preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $postArray['date_end'])) {
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        }

        if ($postArray['date_begin'] >= $postArray['date_end'] && !$postArray['date_end'] == null) {
            $this->error[] = lang('Invalid date range!', 'mod_discount');
        }

        if ($typeDiscount == 'comulativ' && $postArray['comulativ']['begin_value'] === $postArray['comulativ']['end_value']) {
            $this->error[] = lang('Values `from` and `to` can not be equal', 'mod_discount');
        }

        if ($typeDiscount == 'comulativ') {
            if ($this->discount_model_admin->checkRangeForCumulativeDiscount($postArray['comulativ'], $id)) {
                $this->error[] = lang('Has been already created with the cumulative discount value', 'mod_discount');
            }
        }
    }

    /**
     * Helper function for checking that user have no discounts already
     * @param integer $userId id of user
     * @return boolean true if user have no discounts alreaty, false otherwise
     */
    public static function validateUserDiscount($userId) {

        $data = BaseDiscount::create()->discountType['user'];
        foreach ($data as $oneDiscountData) {
            if ($oneDiscountData['user_id'] == $userId) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Helper function for checking that user-group have no discounts already
     * @param integer $groupId id of group
     * @return boolean true if user-group have no discounts alreaty, false otherwise
     */
    public static function validateGroupDiscount($groupId) {

        $data = BaseDiscount::create()->discountType['group_user'];
        foreach ($data as $oneDiscountData) {
            if ($oneDiscountData['group_id'] == $groupId) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Generate key for discount
     *
     * @param integer $charsCount
     * @param integer $digitsCount
     * @static
     * @return string
     */
    public static function generateDiscountKey($charsCount = 8, $digitsCount = 8) {
        $ci = get_instance();
        $ci->load->helper('string');
        $result = random_string('alnum', $charsCount + $digitsCount);
        if ($ci->discount_model_admin->checkDiscountCode($result)) {
            return self::generateDiscountKey($charsCount, $digitsCount);
        }
        return strtolower($result);
    }

}