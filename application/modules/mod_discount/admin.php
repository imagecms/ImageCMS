<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Mod_Discount module
 * @uses BaseAdminController
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model_admin $discount_model_admin
 */
class Admin extends \ShopAdminController {

    function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_discount');
        $this->load->model('discount_model_admin');
        \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('adminScripts');
    }

    /**
     * For displaing list of discounts
     * @return html
     */
    public function index() {
        $filterParam = $this->input->get('filterBy');

        //Save QUERY_STRING to session
        $this->saveQueryToSession($this->input->server('QUERY_STRING'));

        //Get list of discounts 
        $data = array('discountsList' => $this->discount_model_admin->getDiscountsList($filterParam));

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('list', true);
    }

    /**
     * Create discount
     * @return html
     */
    public function create() {

        if ($this->input->post()) {
            $postArray = $this->input->post();

            $discauntManager = new \mod_discount\classes\DiscountManager();

            $result = $discauntManager->create($postArray);

            if ($result['success']) {
                showMessage(lang('Discount successfully created!', 'mod_discount'));
                if ($postArray['action'] == 'tomain') {
                    pjax('/admin/components/init_window/mod_discount/index');
                } else {
                    pjax('/admin/components/init_window/mod_discount/edit/' . $result['id']);
                }
            } else {
                showMessage(implode('<br/> ', $result['error']), '', 'r');
                exit;
            }
        } else {

            //Prepare data for template
            $userGroups = $this->discount_model_admin->getUserGroups(MY_Controller::getCurrentLocale());
            $data = array(
                'userGroups' => $userGroups,
                'CS' => $this->discount_model_admin->getMainCurrencySymbol(),
                'filterQuery' => $_SESSION['QueryDiscountList'],
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
            );

            //Render template and set data
            \CMSFactory\assetManager::create()
                    ->setData($data)
                    ->renderAdmin('create');
        }
    }

    /**
     * Edit discount 
     * @paran (int) $id
     * @paran (string) $locale
     * @return html  
     */
    public function edit($id, $locale = null) {

        if (null === $locale)
            $locale = \MY_Controller::getCurrentLocale();
        if ($this->input->post()) {

            $postArray = $this->input->post();
            $typeDiscount = $postArray['type_discount'];

            $discauntManager = new \mod_discount\classes\DiscountManager();
            $discauntManager->validation($postArray);

            if (count($discauntManager->error) == 0) {

                // If empty field with discount key, then generate key
                if ($postArray['key'] == null)
                    $postArray['key'] = $this->generateDiscountKey();

                //Prepare data for insert in table mod_shop_discounts
                $data = array(
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

                //Prepare data for inserting in the table of selected discount type
                $typeDiscountData = $postArray[$typeDiscount];

                // Insert data
                if ($this->discount_model_admin->updateDiscountById($id, $data, $typeDiscountData, $locale)) {
                    showMessage(lang('Changes saved', 'mod_discount'));
                }
                //Return to list of discounts, if user clicked 'save and exit'
                if ($postArray['action'] == 'tomain')
                    pjax('/admin/components/init_window/mod_discount/index' . $_SESSION['QueryDiscountList']);
                else
                    pjax('/admin/components/init_window/mod_discount/edit/' . $id);
            }else {
                showMessage(implode('<br/> ', $discauntManager->error), '', 'r');
            }
        } else {

            //Get list of user roles and info about current discount
            $userGroups = $this->discount_model_admin->getUserGroups(MY_Controller::getCurrentLocale());
            $discountData = $this->discount_model_admin->getDiscountAllDataById($id, $locale);

            //if can't get info about discount from database then 404 error 
            if ($discountData == false)
                $this->error404(lang('Discount not found', 'mod_discount'));

            //If discount type user then get user name and email
            if ($discountData['type_discount'] == 'user')
                $discountData['user']['userInfo'] = $this->discount_model_admin->getUserNameAndEmailById($discountData['user']['user_id']);

            //If discount type product then get product name
            if ($discountData['type_discount'] == 'product')
                $discountData['product']['productInfo'] = $this->discount_model_admin->getProductById($discountData['product']['product_id']);

            //Prepare date for rendering
            $data = array(
                'discount' => $discountData,
                'userGroups' => $userGroups,
                'CS' => $this->discount_model_admin->getMainCurrencySymbol(),
                'filterQuery' => $_SESSION['QueryDiscountList'],
                'categories' => ShopCore::app()->SCategoryTree->getTree(),
                'languages' => $this->db->get('languages')->result_array(),
                'locale' => $locale
            );

            //Render template and set data
            \CMSFactory\assetManager::create()
                    ->setData($data)
                    ->renderAdmin('edit');
        }
    }

    /**
     * Change status(active or not)
     * @return boolean 
     */
    public function ajaxChangeActive() {
        $id = $this->input->post('id');
        echo $this->discount_model_admin->changeActive($id);
    }

    /**
     * Delete discount by id
     * @return boolean 
     */
    public function ajaxDeleteDiscount() {
        $id = $this->input->post('id');
        echo $this->discount_model_admin->deleteDiscountById($id);
    }

    /**
     * Generate key for discount
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
     * @return json 
     */
    public function autoCompliteUsers() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $users = $this->discount_model_admin->getUsersByIdNameEmail($sCoef, $sLimit);

        if ($users != false) {
            foreach ($users as $user) {
                $response[] = array(
                    'value' => $user['id'] . ' - ' . $user['username'] . ' - ' . $user['email'],
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
     * Autocomlete products
     * @return jsone
     */
    public function autoCompliteProducts() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $products = $this->discount_model_admin->getProductsByIdNameNumber($sCoef, $sLimit);

        if ($products != false) {
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

    /**
     * Save query to session
     * @param string $query
     */
    public function saveQueryToSession($query) {

        session_start();
        $_SESSION['QueryDiscountList'] = '?' . $query;
    }

}

/* End of file admin.php */
