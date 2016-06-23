<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_walletone extends MY_Controller
{

    public $paymentMethod;

    public $moduleName = 'payment_method_walletone';

    /**
     * @var array list of code => number pairs
     */
    private $currencyCodes = [];

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_walletone');
        $config = $this->load->config('payment_method_walletone');
        $this->currencyCodes = $config['currency_codes'];

    }

    public function index() {
        lang('walletone', 'payment_method_walletone');
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
            ->setData('currencyCodes', $this->currencyCodes)
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

        $merchant_id = $paySettings['merchant_id'];
        $signatureKey = $paySettings['electronic_signature'];
        $description = 'OrderId: ' . $param->id . '; Key: ' . $param->getKey();
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

        if (array_key_exists($code, $this->currencyCodes)) {

            $fields = [];
            $fields['WMI_MERCHANT_ID'] = $merchant_id;
            $fields['WMI_PAYMENT_AMOUNT'] = strtr($price, [',' => '.']);
            $fields['WMI_CURRENCY_ID'] = $this->currencyCodes[$code];
            $fields['WMI_DESCRIPTION'] = 'BASE64:' . base64_encode($description);
            $fields['WMI_SUCCESS_URL'] = site_url() . 'shop/order/view/' . $param->getKey();
            $fields['WMI_FAIL_URL'] = site_url() . 'shop/order/view/' . $param->getKey();
            $fields['WMI_PAYMENT_NO'] = $param->id;

            foreach ($fields as $key => $value) {
                $fields[$key] = iconv('utf-8', 'windows-1251', $value);
            }

            $fields['WMI_SIGNATURE'] = $this->createSignature($fields, $signatureKey);

            $codeTpl = \CMSFactory\assetManager::create()
                ->setData('fields', $fields)
                ->fetchTemplate('form');

            return $codeTpl;
        }
    }

    /**
     * @param array $fields
     * @param $key
     * @return string
     */
    private function createSignature(array $fields, $key) {

        uksort($fields, 'strcasecmp');

        $fieldValues = '';

        foreach ($fields as $value) {
            $fieldValues .= $value;
        }

        $signature = base64_encode(pack('H*', md5($fieldValues . $key)));

        return $signature;
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
        $order_id = $param['WMI_PAYMENT_NO'];
        $userOrder = $ci->db->where('id', $order_id)
            ->get('shop_orders');
        if ($userOrder) {
            $userOrder = $userOrder->row();
        } else {
            show_error($ci->db->_error_message());
        }
        $key = $userOrder->payment_method . '_' . $this->moduleName;
        $paySettings = $this->getPaymentSettings($key);

        $signatureKey = $paySettings['electronic_signature'];

        if ($this->validateData($param, $signatureKey)) {
            $this->successPaid($order_id, $userOrder);
            redirect(site_url() . 'shop/order/view/' . $userOrder->key);
        }
    }

    private function validateData($data, $signatureKey) {

        $fields = [];
        foreach ($data as $name => $value) {
            if ($name !== 'WMI_SIGNATURE') { $fields[$name] = $value;
            }
        }

        if ($data['WMI_SIGNATURE'] == $this->createSignature($fields, $signatureKey)) {
            if (strtoupper($data['WMI_ORDER_STATE']) == 'ACCEPTED') {

                $this->printAnswer('Ok', 'Заказ #' . $data['WMI_PAYMENT_NO'] . ' оплачен!');
                return true;

            } else {
                $this->printAnswer('Retry', 'Неверное состояние ' . $data['WMI_ORDER_STATE']);
            }
        } else {
            $this->printAnswer('Retry', 'Неверная подпись ' . $data['WMI_SIGNATURE']);
        }
        return false;

    }

    private function printAnswer($result, $description) {
        print 'WMI_RESULT=' . strtoupper($result) . '&';
        print 'WMI_DESCRIPTION=' . urlencode($description);
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;

        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_walletone']));

        return true;
    }

    /**
     * Переводит статус заказа в оплачено, и прибавляет пользователю
     * оплеченную сумму к акаунту
     * @param integer $order_id ид заказа который обрабатывается
     * @param obj $userOrder данные заказа
     */
    public function successPaid($order_id, $userOrder) {
        $ci = &get_instance();
        $amount = $ci->db->select('amout')
            ->get_where('users', ['id' => $userOrder->user_id]);

        if ($amount) {
            $amount = $amount->row()->amout;
        } else {
            show_error($ci->db->_error_message());
        }

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