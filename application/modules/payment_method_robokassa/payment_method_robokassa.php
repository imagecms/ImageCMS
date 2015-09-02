<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_robokassa extends MY_Controller {

    public $paymentMethod;

    public $moduleName = 'payment_method_robokassa';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_robokassa');
    }

    public function index() {
        lang('robokassa', 'payment_method_robokassa');
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

        $mrh_login = $paySettings['login'];
        $mrh_pass1 = $paySettings['password1'];

        $inv_desc = "Оплата заказа номер " . $param->getId();
        //        // номер заказа
        $inv_id = $param->getId();
        $out_summ = $price = $param->getDeliveryPrice() ? ($param->getTotalPrice() + $param->getDeliveryPrice()) : $param->getTotalPrice();

        if ($paySettings['merchant_currency']) {
            $arrPriceCode = $this->convert($out_summ, $paySettings['merchant_currency']);
            $out_summ = $arrPriceCode['price'];
        }

        if ($paySettings['merchant_markup']) {
            $out_summ = $this->markup($price, $paySettings['merchant_markup']);
        }

        //        // формирование подписи
        $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

        return '<form method="post" action="https://merchant.roboxchange.com/Index.aspx">
                <input type="hidden" name="MrchLogin" value="' . $mrh_login . '" />
                <input type="hidden" name="OutSum" value="' . $out_summ . '" />
                <input type="hidden" name="InvId" value="' . $inv_id . '" />
                <input type="hidden" name="Desc" value="' . $inv_desc . '" />
                <input type="hidden" name="SignatureValue" value="' . $crc . '" />
                <div class="btn-cart btn-cart-p">
                <input type="submit" value="Оплатить" />
                </div>
                </form>';
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

        $order_id = $param['InvId'];
        $userOrder = $ci->db->where('id', $order_id)
            ->get('shop_orders');
        if ($userOrder) {
            $userOrder = $userOrder->row();
        } else {
            show_error($ci->db->_error_message());
        }

        $key = $userOrder->payment_method . '_' . $this->moduleName;
        $paySettings = $this->getPaymentSettings($key);
        $mrh_pass2 = $paySettings['password2'];
        $out_summ = $_POST["OutSum"];
        $inv_id = $_POST["InvId"];
        $crc = strtoupper($_REQUEST["SignatureValue"]);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

        // Check sum
        if ($out_summ != ShopCore::app()->SCurrencyHelper->convert($param['OutSum'])) {
            return false;
        }

        // Check sign
        if ($my_crc != $crc) {
            return false;
        }

        // Set order paid
        $this->successPaid($order_id, $userOrder);

        return true;
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_robokassa']));

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
        $amount += $userOrder->total_price;

        $result = $ci->db->where('id', $order_id)
            ->update('shop_orders', array('paid' => '1', 'date_updated' => time()));
        if (!$result) {
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
        if (!$result) {
            show_error($ci->db->_error_message());
        }
    }

    public function autoload() {

    }

    public function _install() {
        $ci = &get_instance();

        $result = $ci->db->where('name', $this->moduleName)
            ->update('components', array('enabled' => '1'));
        if (!$result) {
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
        if (!$result) {
            show_error($ci->db->_error_message());
        }

        $result = $ci->db->like('name', $this->moduleName)
            ->delete('shop_settings');
        if (!$result) {
            show_error($ci->db->_error_message());
        }
    }

}

/* End of file sample_module.php */