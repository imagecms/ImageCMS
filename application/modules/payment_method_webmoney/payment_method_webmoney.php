<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_webmoney extends MY_Controller {

    public $paymentMethod;
    public $moduleName = 'payment_method_webmoney';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_webmoney');
    }

    public function index() {
        
    }

    /**
     * Вытягивает данные способа оплаты
     * @param str $key
     * @return array
     */
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

    /**
     * Вызывается при редактировании способов оплатыв админке
     * @param int $id ид метода оплаты
     * @param string $payName название payment_method_liqpay
     * @return string
     */
    public function getAdminForm($id, $payName = null) {
        if(!$this->dx_auth->is_admin()){
            redirect('/');
            exit;
        }
        
        $nameMethod = $payName ? $payName : $this->paymentMethod->getPaymentSystemName();
        $key = $id . '_' . $nameMethod;
        $data = $this->getPaymentSettings($key);
        
        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('data',$data)
                ->fetchTemplate('adminForm');

        return $codeTpl;
    }

    /**
     * Формирование кнопки оплаты
     * @param obj $param Данные о заказе
     * @return str
     */
    public function getForm($param) {
        $payment_method_id = $param->getPaymentMethod();
        $key = $payment_method_id . '_' . $this->moduleName;
        $paySettings = $this->getPaymentSettings($key);

        $publicKey = $paySettings['merchant_purse'];
        $descr = 'OrderId: ' . $param->id . '; Key: ' . $param->getKey();
        
        $data = array(
            'merchant_purse' => $publicKey,
            'amount' => $param->getTotalPrice(),
            'currency' => \Currency\Currency::create()->getMainCurrency()->getCode(),
            'description' => $descr,
            'order_id' => $param->id,
            'server_url' => site_url() . $this->moduleName.'/callback',
            'result_url' => site_url() . 'shop/order/view/' . $param->getKey(),
        );
        
        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('data',$data)
                ->fetchTemplate('form');
        
        return $codeTpl;
    }

    /**
     * Метод куда система шлет статус заказа
     */
    public function callback() {
        if ($_POST) {
            $this->checkPaid($_POST);
        }
    }

    /**
     * Метов обработке статуса заказа
     * @param array $param пост от метода callback
     */
    private function checkPaid($param) {  
        $ci = &get_instance();
        
        $order_id = $param['LMI_PAYMENT_NO'];
        $userOrder = $ci->db->where('id', $order_id)
                ->get('shop_orders');
        if($userOrder){
            $userOrder = $userOrder->row();
        } else {
            show_error($ci->db->_error_message());
        } 

        $key = $userOrder->payment_method . '_'.$this->moduleName;
        $paySettings = $this->getPaymentSettings($key);
        
        $forHash = $param['LMI_PAYEE_PURSE'] . 
                $param['LMI_PAYMENT_AMOUNT'] . 
                $param['LMI_PAYMENT_NO'] . 
                $param['LMI_MODE'] . 
                $param['LMI_SYS_INVS_NO'] . 
                $param['LMI_SYS_TRANS_NO'] . 
                $param['LMI_SYS_TRANS_DATE'] . 
                $paySettings['merchant_sig'] . 
                $param['LMI_PAYER_PURSE'] . 
                $param['LMI_PAYER_WM']; 
        
        
        if (strtoupper(hash('sha256',$forHash)) === $param['LMI_HASH'] && $order_id){
                $this->successPaid($order_id, $userOrder);
        }           
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_'.$this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_webmoney']));

        return true;
    }

    /**
     * Переводит статус заказа в оплачено, и прибавляет пользователю
     * оплеченную сумму к акаунту
     * @param int $order_id ид заказа который обрабатывается
     * @param obj $userOrder данные заказа
     */
    private function successPaid($order_id, $userOrder) {  
        $ci = &get_instance();
        $amount = $ci->db->select('amout')
                        ->get_where('users', array('id' => $userOrder->user_id));
        
        if($amount){
            $amount = $amount->row()->amout;
        } else {
            show_error($ci->db->_error_message());
        }             
        $amount += $userOrder->total_price;      
        
        $result = $ci->db->where('id',$order_id)
                ->update('shop_orders', array('paid'=>'1'));
        if($ci->db->_error_message()){
            show_error($ci->db->_error_message());
        }
        
        $result = $ci->db
                ->where('id', $userOrder->user_id)
                ->limit(1)
                ->update('users', array(
                    'amout' => str_replace(',', '.', $amount)
        ));
        if($ci->db->_error_message()){
            show_error($ci->db->_error_message());
        }
    }

    public function autoload() {
        
    }

    public function _install() {  
        $ci = &get_instance();
        
        $result = $ci->db->where('name', $this->moduleName)
                ->update('components', array('enabled' => '1'));
        if($ci->db->_error_message()){
            show_error($ci->db->_error_message());
        }
    }

    public function _deinstall() {  
        $ci = &get_instance();
        
        $result = $ci->db->where('payment_system_name', $this->moduleName)
                        ->update('shop_payment_methods', array(
                                'active'=>'0',
                                'payment_system_name'=>'0',
                                ));
        if($ci->db->_error_message()){
            show_error($ci->db->_error_message());
        }
        
        $result = $ci->db->like('name', $this->moduleName)
                        ->delete('shop_settings');
        if($ci->db->_error_message()){
            show_error($ci->db->_error_message());
        }
        
    }

}

/* End of file sample_module.php */
