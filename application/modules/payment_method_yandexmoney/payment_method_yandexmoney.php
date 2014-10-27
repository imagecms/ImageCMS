<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_yandexmoney extends MY_Controller {
    
    public $paymentMethod;
    
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_yandexmoney');
    }
    
    public function index() {
        
    }
    
    public function getAdminForm($id, $payName = null) {
        
    }
    
    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_yandexmoney';
        ShopCore::app()->SSettings->set($saveKey, serialize($_POST['YandexMoney']));

        return true;
    }
    
    
}