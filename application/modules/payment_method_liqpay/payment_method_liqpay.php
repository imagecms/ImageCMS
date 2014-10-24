<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_liqpay extends MY_Controller {
    
    public $paymentMethod;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_liqpay');
    }

    public function index() {
        
    }
    
    public function getAdminForm($id){
        $key = $id.'_'.$this->paymentMethod->getPaymentSystemName();
        $ci = &get_instance();
        $value = $ci->db->where('name',$key)
                        ->get('shop_settings')
                        ->row()
                        ->value;
        $data= unserialize($value);
        
        return '           
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Public key', 'payment_method_liqpay') . ':</label>
                <div class="controls">
                 <input type="text" name="payment_method_liqpay[merchant_id]" value="' . $data['merchant_id'] . '"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Private key', 'payment_method_liqpay') . ':</label>
                <div class="controls">
                 <input type="text" name="payment_method_liqpay[merchant_sig]" value="' . $data['merchant_sig'] . '" />
                </div>
            </div>
     
        ';
    } 

    public function getForm($data1){
//        exit('222');
        // /var/www/offsite.loc/templates/newLevel/shop/order_view.tpl
//        $this->order = \ShopCore::app()->SPaymentSystems->getOrder();
//        var_dump($data1);exit;
        $data = array(
            'public_key' => $this->publicKey,
            'amount' => $data['summ'], // $data1->getTotalPrice()
            'currency' => $data['currId'],
            'description' => $data['desc'],
            'order_id' => $data['orderId'], //$data1->id
            'server_url' => $data['serverUrl'],
            'result_url' => $data['resultUrl'],
        );

        $inv = $this->privateKey . $data['amount'] . $data['currency'] . $data['public_key'] . $data['order_id'] . 'buy' . $data['description'] . $data['result_url'] . $data['server_url'];
        $inv = html_entity_decode($inv);
        $signature = base64_encode(sha1($inv, 1));

        return '<form id="paidForm" method="POST" action="https://www.liqpay.com/api/pay" 
                    accept-charset="utf-8">
                      <input type="hidden" name="public_key" value="' . $data['public_key'] . '"/>
                      <input type="hidden" name="amount" value="' . $data['amount'] . '"/>
                      <input type="hidden" name="currency" value="' . $data['currency'] . '"/>
                      <input type="hidden" name="description" value="' . $data['description'] . '"/>
                      <input type="hidden" name="order_id" value="' . $data['order_id'] . '"/>
                      <input type="hidden" name="result_url" value="' . $data['result_url'] . '"/>
                      ' . "<input type='hidden' name='server_url' value='" . $data['server_url'] . "'/>" . '     
                      <input type="hidden" name="type" value="buy"/>
                      <input type="hidden" name="signature" value="' . $signature . '"/>' .
                "<div class='btn-cart btn-cart-p'>
                    <input type='submit' value='Оплатить'>
                </div>".
                '</form>';
    
    }
    
    public function callback(){
        if($_POST){
            $this->checkPaid($_POST);
        }
    }
    

    public function checkPaid($param){
        $order_id = $param['order_id'];
        
        $sign = base64_encode(sha1(
                        $this->privateKey .
                        $param['amount'] .
                        $param['currency'] .
                        $param['public_key'] .
                        $param['order_id'] .
                        $param['type'] .
                        $param['description'] .
                        $param['status'] .
                        $param['transaction_id'] .
                        $param['sender_phone']
                        , 1));

        $model = $param['model'];
        
        //file_put_contents('uploads/tmp/lppost', $param['status']);
        
        if ($param['status'] == 'wait_secure') {
            $this->waitPaid($model); 
            exit;
        }

        if ($param['signature'] == $sign && $model) 
            if ($param['status'] == 'success')
                $this->successPaid($model); 
            else
                $this->failPaid($model, $this->type . ': status does not true');         
        else 
            $this->failPaid($model, $this->type . ': sigin does not true');
    }
    
    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_payment_method_liqpay';
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_liqpay']));

        return true;
    }
    
    /**
     * success paid
     */
    public function successPaid() {

    }
    
    /**
     * wait paid
     */
    public function waitPaid() {

    }

    /**
     * fail paid
     */
    public function failPaid() {
        
    }

    public function autoload() {
        
    }

    public function _install() {
        
    }

    public function _deinstall() {
        
    }

}

/* End of file sample_module.php */
