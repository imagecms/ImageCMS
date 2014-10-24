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
        var_dump('adasd1');
    }
    
    
    public function getAdminForm( $id, $payName = null) {
        $nameMethod = $payName?$payName:$this->paymentMethod->getPaymentSystemName();
        $key = $id.'_'.$nameMethod;
        $ci = &get_instance();
        $value = $ci->db->where('name',$key)
                        ->get('shop_settings')
                        ->row()
                        ->value;
        $data= unserialize($value);
        
        $form = '
            <div class="control-group">   
                <div class="controls">
                    <span class="help-block">' . lang('Links to create application:', 'main') . '</span>
                    <span class="help-block">' . lang('https://sp-money.yandex.ru/myservices/new.xml', 'main') . '</span>	
                    <span class="help-block">' . lang('https://sp-money.yandex.ru/myservices/online.xml', 'main') . '</span>				
                    <span class="help-block">' . lang('Redirect url, HTTP:', 'main') . '</span>
                    <span class="help-block">
                    ' . shop_url('order/view?result=true&pm=' . $this->paymentMethod->getId()) . '
                    </span>
                </div>				
            </div>	
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Client', 'main') . ':</label>
                <div class="controls">
                <input type="text" name="YandexMoney[client]" value="' . $data['client'] . '"/>
                </div>
            </div>		
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Client_ID', 'main') . ':</label>
                <div class="controls">
                <input type="text" name="YandexMoney[account]" value="' . $data['account'] . '"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('Notification_secret', 'main') . ':</label>
                <div class="controls">
                <input type="text" name="YandexMoney[secret_notif]" value="' . $data['secret_notif'] . '"/>
                </div>
            </div>			
            <div class="control-group">
                <label class="control-label" for="inputRecCount">' . lang('OAuth2 client_secret', 'main') . ':</label>
                <div class="controls">
                <input type="text" name="YandexMoney[secret]" value="' . $data['secret'] . '"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRecCount"></label>
                <div class="controls">
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#paymentmethodsUpdate" data-action="edit" data-submit=""><i class="icon-ok icon-white"></i> ' . lang('Get link for Received token ', 'main') . '</button>			 
                </div>			
            </div> 			
            <div class="control-group">
                <div class="controls">
                    <span class="help-block">' . lang('Follow the link to get Received token:', 'main') . '</span>
                    <span class="help-block">https://sp-money.yandex.ru/oauth/authorize?client_id=' . $data['account'] . '&response_type=code&scope=account-info+operation-history+operation-details&redirect_uri=' . str_replace('/', '%2F', str_replace('://', '%3A%2F%2F', site_url())) . 'shop%2Forder%2Fview%2F</span>				
		</div> 
            </div>    
			 
            <div class="control-group">               
                <label class="control-label" for="inputRecCount">' . lang('Received token', 'main') . ':</label>
                <div class="controls">
                <input type="text" name="YandexMoney[token]" value="' . $data['token'] . '"/>
                </div>
            </div>			
        ';
        return $form;
    }
    
    public function getForm($data1){
        exit('ok');
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

        return '<form id="paidForm" method="POST" action="" 
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
    
    
    /**
      * Save settings
      * @return boollstring
      */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_payment_method_yandexmoney';
        ShopCore::app()->SSettings->set($saveKey, serialize($_POST['YandexMoney']));
        return true;
    }

    /**
      * Load Yandex Money settings
      * @return array
      */
    protected function loadSettings() {
        $settingsKey = $this->paymentMethod->getId() . '_payment_method_yandexmoney';
        $data = unserialize(ShopCore::app()->SSettings->$settingsKey);
	if ($data === false) {
            $data = array();
        }
        return array_map('encode', $data);
    }
    
    
}

