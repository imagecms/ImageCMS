<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_yakassa extends MY_Controller
{

    public $paymentMethod;

    public $moduleName = 'payment_method_yakassa';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_yakassa');
    }

    public function index() {
        lang('yakassa', 'payment_method_yakassa');
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
     * @param integer $id ид метода оплаты
     * @param string $payName название payment_method_yakassa
     * @return string
     */
    public function getAdminForm($id, $payName = null) {
        if (!$this->dx_auth->is_admin()) {
            redirect('/');
            exit;
        }

        $nameMethod = $payName ? $payName : $this->paymentMethod->getPaymentSystemName();
        $key = $id . '_' . $nameMethod;
        $data = $this->getPaymentSettings($key);

        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('data', $data)
                ->fetchTemplate('adminForm');

        return $codeTpl;
    }

    //Конвертация в другую валюту

    public function convert($price, $currencyId) {
        if ($currencyId == \Currency\Currency::create()->getMainCurrency()->getId()) {
            $return['price'] = $price;
            $return['code'] = \Currency\Currency::create()->getMainCurrency()->getCode();
            return $return;
        } else {
            $return['price'] = \Currency\Currency::create()->convert($price, $currencyId);
            $return['code'] = \Currency\Currency::create()->getCodeById($currencyId);
            return $return;
        }
    }

    //Наценка

    public function markup($price, $percent) {
        $price = (float) $price;
        $percent = (float) $percent;
        $factor = $percent / 100;
        $residue = $price * $factor;
        return $price + $residue;
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

        $shopid = $paySettings['shopid'];
        $scid = $paySettings['scid'];
        $descr = 'OrderId: ' . $param->id . '; Key: ' . $param->getKey();
        $price = $param->getDeliveryPrice() ? ($param->getTotalPrice() + $param->getDeliveryPrice()) : $param->getTotalPrice();

        if ($paySettings['merchant_currency']) {
            $arrPriceCode = $this->convert($price, $paySettings['merchant_currency']);
            $price = $arrPriceCode['price'];
        }

        if ($paySettings['merchant_markup']) {
            $price = $this->markup($price, $paySettings['merchant_markup']);
        }

        $data = [
                 'shopid'         => $shopid,
                 'scid'           => $scid,
                 'amount'         => $price,
                 'description'    => $descr,
                 'order_id'       => $param->id,
                 'customerNumber' => $_SESSION['DX_user_id'],
                 'result_url'     => site_url() . 'shop/order/view/' . $param->getKey(),
                 'settings'       => $paySettings,
                 'paymentKey'     => $key,
                ];

        $payments = false;
        foreach ($paySettings as $key => $value) {
            if (in_array($key, ['PC', 'AC', 'MC', 'WM', 'AB', 'SB'])) {
                $payments = true;
            }
        }

        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('payments', $payments)
                ->setData('data', $data)
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

    private function checkOrder($callbackParams, $sendCode = FALSE, $aviso = FALSE) {

        if ($this->checkSign($callbackParams)) {
            $code = 0;
        } else {
            $code = 1;
        }

        if ($sendCode) {
            if ($aviso) {
                $this->sendAviso($callbackParams, $code);
            } else {
                $this->sendCode($callbackParams, $code);
            }
            exit;
        } else {
            return $code;
        }
    }

    public function checkSign($callbackParams) {
        $string = $callbackParams['action'] . ';' . $callbackParams['orderSumAmount'] . ';' . $callbackParams['orderSumCurrencyPaycash'] . ';' . $callbackParams['orderSumBankPaycash'] . ';' . $callbackParams['shopId'] . ';' . $callbackParams['invoiceId'] . ';' . $callbackParams['customerNumber'] . ';' . $callbackParams['password'];

        $md5 = strtoupper(md5($string));
        return ($callbackParams['md5'] == $md5);
    }

    public function sendAviso($callbackParams, $code) {
        header('Content-type: text/xml; charset=utf-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
		<paymentAvisoResponse performedDatetime="' . date('c') . '" code="' . $code . '" invoiceId="' . $callbackParams['invoiceId'] . '" shopId="' . $callbackParams['shopid'] . '"/>';
        echo $xml;
    }

    public function sendCode($callbackParams, $code) {
        header('Content-type: text/xml; charset=utf-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
		<checkOrderResponse performedDatetime="' . date('c') . '" code="' . $code . '" invoiceId="' . $callbackParams['invoiceId'] . '" shopId="' . $callbackParams['shopid'] . '"/>';
        echo $xml;
    }

    /**
     * Метов обработке статуса заказа
     * @param array $param пост от метода callback
     */
    private function checkPaid($param) {
        $ci = &get_instance();
        $key = $param['paymentKey'];
        $paySettings = $this->getPaymentSettings($key);
        $param['shopid'] = $paySettings['shopid'];
        $param['password'] = $paySettings['password'];

        $callbackParams = $param;

        $order_id = false;
        if ($callbackParams['action'] == 'checkOrder') {
            $code = $this->checkOrder($param);
            $this->sendCode($param, $code);
            $order_id = (int) $param['orderNumber'];
        }
        if ($callbackParams['action'] == 'paymentAviso') {
            $this->checkOrder($param, TRUE, TRUE);
        }

        if (!$order_id) {
            return false;
        }

        $userOrder = $ci->db->where('id', $order_id)
            ->get('shop_orders');
        if ($userOrder) {
            $userOrder = $userOrder->row();
        } else {
            show_error($ci->db->_error_message());
            exit;
        }
        if ($order_id && $code == 0) {
            $this->successPaid($order_id, $userOrder);
        }
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_yakassa']));

        return true;
    }

    /**
     * Переводит статус заказа в оплачено, и прибавляет пользователю
     * оплеченную сумму к акаунту
     * @param integer $order_id ид заказа который обрабатывается
     * @param obj $userOrder данные заказа
     */
    private function successPaid($order_id, $userOrder) {
        $ci = &get_instance();
        $amount = $ci->db->select('amout')
            ->get_where('users', ['id' => $userOrder->user_id]);

        if ($amount) {
            $amount = $amount->row()->amout;
        } else {
            show_error($ci->db->_error_message());
        }

        /* Учитывается цена с доставкой */
        //        $amount += $userOrder->delivery_price?($userOrder->total_price+$userOrder->delivery_price):$userOrder->total_price;
        /* Учитывается цена без доставки */
        $amount += $userOrder->total_price;

        $result = $ci->db->where('id', $order_id)
            ->update('shop_orders', ['paid' => '1', 'date_updated' => time()]);
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }

        \CMSFactory\Events::create()->registerEvent(['system' => __CLASS__, 'order_id' => $order_id], 'PaimentSystem:successPaid');
        \CMSFactory\Events::runFactory();

        $result = $ci->db
            ->where('id', $userOrder->user_id)
            ->limit(1)
            ->update(
                'users',
                [
                 'amout' => str_replace(',', '.', $amount),
                ]
            );
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }
    }

    public function autoload() {

    }

    public function _install() {
        $ci = &get_instance();

        $result = $ci->db->where('name', $this->moduleName)
            ->update('components', ['enabled' => '1']);
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }
    }

    public function _deinstall() {
        $ci = &get_instance();

        $result = $ci->db->where('payment_system_name', $this->moduleName)
            ->update(
                'shop_payment_methods',
                [
                 'active'              => '0',
                 'payment_system_name' => '0',
                ]
            );
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }

        $result = $ci->db->like('name', $this->moduleName)
            ->delete('shop_settings');
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }
    }

}

/* End of file sample_module.php */