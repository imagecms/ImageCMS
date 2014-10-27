<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Sample
 */
class Payment_method_privat24 extends MY_Controller {

    public $paymentMethod;
   //private $secretKey = 'R67A5oNj0oG075t4731nBcIXHmk3V70n';
    //private $merchantId = '103303';
    private $secretKey;
    private $merchantIdKey;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_privat24');
    }
    
    public function index() {
        
    }
    
    private function getPaymentSettings($key) {
        $ci = &get_instance();
        $value = $ci->db->where('name', $key)
                ->get('shop_settings');
        if ($value) {
            $value = $value->row()->value;
        } else {
            show_error($ci->db->_error_message());
        }               
        return unserialize($value);
    }
    
    public function getAdminFrom( $id , $payName = null ){
        $nameMethod = $payName ? $payName : $this->paymentMethod->getPaymentSystemName();
        $key = $id . '_' . $nameMethod;
        $data = $this->getPaymentSettings($key);
        return '<div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Merchant ID', 'payment_method_privat24') . ':</label>
                <div class="controls">
                 <input type="text" name="payment_method_privat24[merchant_id]" value="' . $data['merchant_id'] . '"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Merchant secret key', 'payment_method_privat24') . ':</label>
                <div class="controls">
                 <input type="text" name="payment_method_privat24[merchant_sig]" value="' . $data['merchant_sig'] . '" />
                </div>
            </div>';
    }
    
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_payment_method_privat24';
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_privat24']));

        return true;
    }
    
    public function autoload() {
        
    }

    public function _install() {
        $this->db->where('name', 'payment_method_privat24')
                 ->update('components', array('enabled' => '1'));
    }

    public function _deinstall() {
        
    }

}

/* End of file sample_module.php */
