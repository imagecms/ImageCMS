<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_sberbank extends MY_Controller
{

    public $paymentMethod;

    public $moduleName = 'payment_method_sberbank';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_sberbank');
    }

    public function index() {
        lang('sberbank', 'payment_method_sberbank');
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
        $price = $param->getDeliveryPrice() ? ($param->getTotalPrice() + $param->getDeliveryPrice()) : $param->getTotalPrice();

        $data = [
                 'pm'       => $payment_method_id,
                 'url'      => site_url('payment_method_sberbank/processPayment/' . $param->getKey()),
                 'order_id' => $param->id,
                 'price'    => $price,
                ];

        $codeTpl = \CMSFactory\assetManager::create()
                ->setData('data', $data)
                ->fetchTemplate('form');

        return $codeTpl;
    }

    /**
     * Load pdf generating class and set main settings
     */
    protected function initPdfClass() {
        include SHOP_DIR . 'classes/pdf/tcpdf.php';

        $this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $this->pdf->cms_cache_key = 'SberBankInvoice';

        $this->pdf->setPDFVersion('1.6');
        $this->pdf->SetFont('dejavusanscondensed', '', 8);
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);

        // Set text color to Black
        $this->pdf->SetTextColor(0, 0, 0);
    }

    /**
     * Process payment.
     * Display PDF document
     */
    public function processPayment() {
        $this->initPdfClass();

        // Create new page
        $this->pdf->AddPage();

        $this->drawMainData();
        $this->drawMainData('step2');

        $this->pdf->SetFont('dejavusanscondensed', '', 10);

        $this->pdf->SetXY(5, 10);
        $this->pdf->Cell(47, 5, 'Извещение', 0, 0, 'C');

        $this->pdf->SetXY(5, 60);
        $this->pdf->Cell(47, 5, 'Кассир', 0, 0, 'C');

        $this->pdf->SetXY(5, 135);
        $this->pdf->Cell(47, 5, 'Квитанция', 0, 0, 'C');

        $this->pdf->SetXY(5, 145);
        $this->pdf->Cell(47, 5, 'Кассир', 0, 0, 'C');

        // Draw lines
        $this->pdf->SetLineStyle(['dash' => 2]);
        $this->pdf->Line(52, 5, 52, 170);
        $this->pdf->Line(205, 5, 205, 170); // Right line
        $this->pdf->Line(5, 5, 205, 5); // Top line
        $this->pdf->Line(5, 170, 205, 170); // Bottom line
        $this->pdf->Line(5, 87.5, 205, 87.5); // Middle line
        $this->pdf->Line(5, 5, 5, 170); // Left line
        // Shop generated pdf
        $this->pdf->Output('Sber_Bank_invoice.pdf', 'D');
        exit();
    }

    public function drawMainData($step = 'step1') {
        $width = 145;
        $lineStep = 5;
        $x = 55;
        $y = 15;

        if ($step == 'step2') {
            $y = 95;
        }

        // Draw vertical line from Sum to Home adress
        $this->pdf->Line($x, $y, $x + $width, $y);
        $this->drawTextUnderLine('(наименование получателя платежа)', $x, $y);

        $this->pdf->Line($x, $y + $lineStep * 2, $x + 45, $y + $lineStep * 2);
        $this->drawTextUnderLine('(ИНН получателя платежа)', $x, $y + $lineStep * 2);

        $this->pdf->Line($x + 75, $y + $lineStep * 2, $x + 145, $y + $lineStep * 2);
        $this->drawTextUnderLine('(номер счета получателя платежа)', $x + 75, $y + $lineStep * 2);

        $this->pdf->Line($x, $y + $lineStep * 4, $x + $width, $y + $lineStep * 4);
        $this->drawTextUnderLine('(наименование банка получателя платежа)', $x, $y + $lineStep * 4);

        $this->pdf->Line($x + 10, $y + $lineStep * 6, $x + 45, $y + $lineStep * 6);
        $this->drawTextUnderLine('БИК', $x, $y + $lineStep * 5);

        $this->pdf->Line($x + 75, $y + $lineStep * 6, $x + 145, $y + $lineStep * 6);
        $this->drawTextUnderLine('(номер кор./сч. банка получателя платежа)', $x + 75, $y + $lineStep * 6);

        $this->pdf->Line($x, $y + $lineStep * 8, $x + 55, $y + $lineStep * 8);
        $this->drawTextUnderLine('(наименование платежа)', $x, $y + $lineStep * 8);

        $this->pdf->Line($x + 75, $y + $lineStep * 8, $x + 145, $y + $lineStep * 8);
        $this->drawTextUnderLine('(номер лицевого счета (код) плательщика)', $x + 75, $y + $lineStep * 8);

        $this->pdf->Line($x + 30, $y + $lineStep * 10, $x + $width, $y + $lineStep * 10);
        $this->drawTextUnderLine('Ф.И.О плательщика', $x, $y + $lineStep * 9);

        $this->pdf->Line($x + 30, $y + $lineStep * 11, $x + $width, $y + $lineStep * 11);
        $this->drawTextUnderLine('Адрес плательщика', $x, $y + $lineStep * 10);

        $this->drawTextUnderLine('Сумма платежа:', $x + 85, $y + $lineStep * 11);
        $this->drawTextUnderLine('Итого:', $x + 98, $y + $lineStep * 12);

        $this->pdf->Line($x, $y + $lineStep * 13, $x + 35, $y + $lineStep * 13);
        $this->drawTextUnderLine('(подпись плательщика)', $x, $y + $lineStep * 13);

        // Draw user data
        $key = $_POST['pm'] . '_' . $this->moduleName;

        $data = $this->getPaymentSettings($key);
        if ($data === false) {
            $data = [];
        }
        $data = array_map('encode', $data);

        $this->pdf->SetFont('dejavusanscondensed', '', 9);
        $this->drawTextUnderLine($data['receiverName'], $x, $y - 5);
        $this->drawTextUnderLine($data['receiverInn'], $x, $y + 5);
        $this->drawTextUnderLine($data['account'], $x + 75, $y + 5);
        $this->drawTextUnderLine($data['bankName'], $x, $y + $lineStep * 3);
        $this->drawTextUnderLine($data['BIK'], $x + 10, $y + $lineStep * 5);
        $this->drawTextUnderLine('№ ' . $data['cor_account'], $x + 75, $y + $lineStep * 5);
        $this->drawTextUnderLine('Оплата заказа номер ' . $_POST['order_id'], $x, $y + $lineStep * 7);

        // Draw amount
        $amount = $_POST['price'];
        if ($data['merchant_currency']) {
            $arrPriceCode = $this->convert($amount, $data['merchant_currency']);
            $amount = $arrPriceCode['price'];
        }

        if ($data['merchant_markup']) {
            $amount = $this->markup($amount, $data['merchant_markup']);
        }

        $amount = str_replace('.', ',', $amount);
        $amount = explode(',', $amount);
        $amount = $amount[0] . ' ' . $data['bankNote'] . ' ' . $amount[1] . ' ' . $data['bankNote2'];

        $this->pdf->SetFont('dejavusanscondensed', '', 8);
        $this->drawTextUnderLine($amount, $x + 108, $y + $lineStep * 11);
        $this->pdf->SetFont('dejavusanscondensed', '', 9);
        $this->drawTextUnderLine($amount, $x + 108, $y + $lineStep * 12);
        $this->pdf->SetFont('dejavusanscondensed', '', 8);
    }

    /**
     * Draw text
     *
     * @string  $text
     * @float  $x
     * @float  $y
     * @float  $width
     * @float  $height
     * @return void
     */
    protected function drawTextUnderLine($text, $x, $y) {
        $this->pdf->SetXY($x, $y);
        $this->pdf->Write(5, $text);
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_sberbank']));

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