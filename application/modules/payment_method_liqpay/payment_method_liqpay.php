<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_liqpay extends MY_Controller {

    public $paymentMethod;

    public $moduleName = 'payment_method_liqpay';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_liqpay');
    }

    public function index() {
        lang('liqpay', 'payment_method_liqpay');
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

        $publicKey = $paySettings['merchant_id'];
        $privateKey = $paySettings['merchant_sig'];
        $descr = 'OrderId: ' . $param->id . '; Key: ' . $param->getKey();
        $price = $param->getDeliveryPrice() ? ($param->getTotalPrice() + $param->getDeliveryPrice()) : $param->getTotalPrice();
        $code = \Currency\Currency::create()->getMainCurrency()->getCode();

        if ($paySettings['merchant_currency']) {
            $arrPriceCode = $this->convert($price, $paySettings['merchant_currency']);
            $price = $arrPriceCode['price'];
            $code = $arrPriceCode['code'];
        }

        if ($paySettings['merchant_markup']) {
            $price = $this->markup($price, $paySettings['merchant_markup']);
        }

        $data = array(
            'public_key' => $publicKey,
            'amount' => $price,
            'currency' => $code,
            'description' => $descr,
            'order_id' => $param->id,
            'server_url' => site_url() . $this->moduleName . '/callback',
            'result_url' => site_url() . 'shop/order/view/' . $param->getKey(),
        );

        $inv = $privateKey . $data['amount'] . $data['currency'] . $data['public_key'] . $data['order_id'] . 'buy' . $data['description'] . $data['result_url'] . $data['server_url'];
        $inv = html_entity_decode($inv);
        $signature = base64_encode(sha1($inv, 1));

        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('data', $data)
                ->setData('signature', $signature)
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

        $order_id = $param['order_id'];
        $userOrder = $ci->db->where('id', $order_id)
            ->get('shop_orders');
        if ($userOrder) {
            $userOrder = $userOrder->row();
        } else {
            show_error($ci->db->_error_message());
        }

        $key = $userOrder->payment_method . '_' . $this->moduleName;
        $paySettings = $this->getPaymentSettings($key);

        $sign = base64_encode(
            sha1(
                $paySettings['merchant_sig'] .
                $param['amount'] .
                $param['currency'] .
                $param['public_key'] .
                $param['order_id'] .
                $param['type'] .
                $param['description'] .
                $param['status'] .
                $param['transaction_id'] .
                $param['sender_phone'],
                1
            )
        );

        if ($param['signature'] == $sign && $order_id) {
            if ($param['status'] == 'success') {
                $this->successPaid($order_id, $userOrder);
            }
        }
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_liqpay']));

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
            ->update('shop_orders', array('paid' => '1', 'date_updated' => time()));
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }

        \CMSFactory\Events::create()->registerEvent(array('system' => __CLASS__, 'order_id' => $order_id), "PaimentSystem:successPaid");
        \CMSFactory\Events::runFactory();

        $result = $ci->db
            ->where('id', $userOrder->user_id)
            ->limit(1)
            ->update(
                'users',
                array(
                    'amout' => str_replace(',', '.', $amount)
                    )
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
            ->update('components', array('enabled' => '1'));
        if ($ci->db->_error_message()) {
            show_error($ci->db->_error_message());
        }
    }

    public function _deinstall() {
        $ci = &get_instance();

        $result = $ci->db->where('payment_system_name', $this->moduleName)
            ->update(
                'shop_payment_methods',
                array(
                    'active' => '0',
                    'payment_system_name' => '0',
                    )
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