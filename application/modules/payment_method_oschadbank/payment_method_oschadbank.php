<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_oschadbank extends MY_Controller
{

    public $paymentMethod;

    public $moduleName = 'payment_method_oschadbank';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_oschadbank');
    }

    public function index() {
        lang('oschadbank', 'payment_method_oschadbank');
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
                 'PM'       => $payment_method_id,
                 'URL'      => site_url('payment_method_oschadbank/processPayment/' . $param->getKey()),
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
        $this->pdf->cms_cache_key = 'OschadBankInvoice';

        $this->pdf->setPDFVersion('1.6');
        $this->pdf->SetFont('dejavusanscondensed', '', 9);
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

        // Draw bold lines
        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(55, 5, 55, 137);
        // Hor. lines
        $this->pdf->SetLineWidth(0.4);
        $this->pdf->Line(5, 70, 205, 70);
        $this->pdf->Line(5, 71, 205, 71);

        // Write vertical text
        $this->pdf->SetFontSize(8);
        $this->pdf->setXY(5, 50);
        $this->pdf->StartTransform();
        $this->pdf->Rotate(90);
        $this->pdf->write(5, 'Заява на переказ готівки');
        $this->pdf->StopTransform();

        $this->pdf->setXY(5, 115);
        $this->pdf->StartTransform();
        $this->pdf->Rotate(90);
        $this->pdf->write(5, 'Квитанція');
        $this->pdf->StopTransform();

        // Shop generated pdf
        $this->pdf->Output('Oschad_Bank_invoice.pdf', 'D');
        exit();
    }

    /**
     * Draw invoice with user data.
     *
     * @param integer $y
     * @return generated document
     */
    protected function drawMainData($y = 10) {
        $width = 150;
        $lineStep = 5;
        $x = 55;
        if ($y == 'step2') {
            $y = 77;
            $step2 = true;
        } else {
            $step2 = false;
        }

        // Draw vertical line from Sum to Home adress
        $this->pdf->Line($x + 35, $y, $x + 35, $y + 30);

        // Date of operation
        $this->drawTextB('Дата здійснення операції:', $x, $y, 150, 10);
        $this->pdf->Line($x, $y, $x + $width, $y);

        // Sum
        $this->drawTextB('Сумма:', $x, $y + $lineStep, 150, 10);
        $this->pdf->Line($x, $y + $lineStep, $x + $width, $y + $lineStep);

        // Platnik
        $this->drawTextB('Платник:', $x, $y + $lineStep * 2, 150, 10);
        $this->pdf->Line($x, $y + $lineStep * 2, $x + $width, $y + $lineStep * 2);

        // Home adress
        $this->drawTextB('Місце проживання:', $x, $y + $lineStep * 3 + 2, 150, 10);
        $this->pdf->Line($x + 35, $y + $lineStep * 3, $x + $width, $y + $lineStep * 3);
        $this->pdf->Line($x, $y + $lineStep * 4, $x + $width, $y + $lineStep * 4);

        // Recieve
        $this->drawTextB('Отримувач:', $x, $y + $lineStep * 5 + 2, 150, 10);
        $this->drawTextB($pdf, 'Назва:', $x + 35, $y + $lineStep * 5, 150, 10);
        $this->pdf->Line($x + 35, $y + $lineStep * 5, $x + $width, $y + $lineStep * 5);
        $this->pdf->Line($x, $y + $lineStep * 6, $x + $width, $y + $lineStep * 6);

        // Code, Number, MFO of Bank
        $this->pdf->Line($x + 50, $y + $lineStep * 6, $x + 50, $y + $lineStep * 8);
        $this->pdf->Line($x + 51, $y + $lineStep * 6, $x + 51, $y + $lineStep * 8);

        $this->pdf->Line($x + 120, $y + $lineStep * 6, $x + 120, $y + $lineStep * 8);
        $this->pdf->Line($x + 121, $y + $lineStep * 6, $x + 121, $y + $lineStep * 8);

        // Code
        $this->drawTextB('Код:', $x + 20, $y + $lineStep * 7, 150, 10);
        $this->drawTextB('Розрахунковий рахунок:', $x + 70, $y + $lineStep * 7, 150, 10);
        $this->drawTextB('МФО банку:', $x + 125, $y + $lineStep * 7, 150, 10);

        // Line under Code, MFO, etc
        $this->pdf->Line($x, $y + $lineStep * 7, $x + $width, $y + $lineStep * 7);
        $this->pdf->Line($x, $y + $lineStep * 8, $x + $width, $y + $lineStep * 8);

        // Line for numbers
        $n = 0;
        for ($i = 0; $i < 10; $i++) {
            $this->pdf->Line($x + $n, $y + $lineStep * 7, $x + $n, $y + $lineStep * 8);
            $n = $n + 5;
        }
        $n = 0;
        for ($i = 0; $i < 14; $i++) {
            $this->pdf->Line($x + $n + 50, $y + $lineStep * 7, $x + $n + 50, $y + $lineStep * 8);
            $n = $n + 5;
        }
        $n = 0;
        for ($i = 0; $i < 6; $i++) {
            $this->pdf->Line($x + $n + 120, $y + $lineStep * 7, $x + $n + 120, $y + $lineStep * 8);
            $n = $n + 5;
        }

        // Призначення платежу
        $this->drawTextB('Призначення платежу:', $x, $y + $lineStep * 9 + 2, 150, 10);
        $this->pdf->Line($x + 37, $y + $lineStep * 9, $x + $width, $y + $lineStep * 9);
        $this->pdf->Line($x, $y + $lineStep * 10, $x + $width, $y + $lineStep * 10);
        // Vertical line
        $this->pdf->Line($x + 37, $y + $lineStep * 8, $x + 37, $y + $lineStep * 10);

        // Buttom of invoice
        // Draw lines
        if ($step2 == false) {
            $this->drawTextB('Платник:', $x, $y + $lineStep * 11 + 2, 150, 10);
            $this->drawTextB('Контролер:', $x + 35, $y + $lineStep * 11 + 2, 150, 10);
            $this->drawTextB('Бухгалтер:', $x + 75, $y + $lineStep * 11 + 2, 150, 10);
            $this->drawTextB('Касир:', $x + 120, $y + $lineStep * 11 + 2, 150, 10);

            $this->pdf->Line($x + 35, $y + $lineStep * 10, $x + 35, $y + $lineStep * 12);
            $this->pdf->Line($x + 75, $y + $lineStep * 10, $x + 75, $y + $lineStep * 12);
            $this->pdf->Line($x + 120, $y + $lineStep * 10, $x + 120, $y + $lineStep * 12);
        } else {
            $this->drawTextB('Платник:', $x, $y + $lineStep * 11 + 2, 150, 10);
            $this->drawTextB('Контролер:', $x + 60, $y + $lineStep * 11 + 2, 150, 10);
            $this->drawTextB('Касир:', $x + 115, $y + $lineStep * 11 + 2, 150, 10);

            $this->pdf->Line($x + 60, $y + $lineStep * 10, $x + 60, $y + $lineStep * 12);
            $this->pdf->Line($x + 115, $y + $lineStep * 10, $x + 115, $y + $lineStep * 12);
        }

        // Left line
        $this->pdf->Line(205, $y + $lineStep * 4, 205, $y + $lineStep * 10);

        /** Draw user data * */
        $key = $_POST['pm'] . '_' . $this->moduleName;
        $userData = $this->getPaymentSettings($key);
        $userData['date'] = date('d.m.Y');
        // ціна доставки
        $userData['sum'] = $_POST['price'];

        if ($userData['merchant_currency']) {
            $arrPriceCode = $this->convert($userData['sum'], $userData['merchant_currency']);
            $userData['sum'] = $arrPriceCode['price'];
        }

        if ($userData['merchant_markup']) {
            $userData['sum'] = $this->markup($userData['sum'], $userData['merchant_markup']);
        }

        $userData['sum'] = str_replace('.', ',', $userData['sum']);
        $userData['sum'] .= ' ' . $userData['banknote'];
        $userData['purpose'] = 'Оплата замовлення номер ' . $_POST['order_id'];

        for ($i = 0; $i < strlen($userData['code']); $i++) {
            $this->drawTextB($userData['code'][$i], $x + 1 + $i * 5, $y + $lineStep * 8, 150, 10);
        }

        // Розрахунковий рахунок
        for ($i = 0; $i < strlen($userData['account']); $i++) {
            $this->drawTextB($userData['account'][$i], $x + 51 + $i * 5, $y + $lineStep * 8, 150, 10);
        }

        // МФО Банку
        $this->pdf->SetFontSize(9);
        for ($i = 0; $i < strlen($userData['mfo']); $i++) {
            $this->pdf->SetXY($x + 121 + ($i * 5), $y + $lineStep * 7);
            $this->pdf->Cell(5, 5, $userData['mfo'][$i]);
        }

        // Дата
        $this->drawTextB($userData['date'], $x + 45, $y, 150, 10);
        // Сумма
        $this->pdf->SetXY($x + 35, $y + 1);
        $this->pdf->MultiCell(115, 5, $userData['sum'], 0, 'C', 0, 1, '', '', true, null, true);
        // Отримувач
        $this->pdf->SetXY($x + 47, $y + $lineStep * 4 + 1);
        $this->pdf->MultiCell(103, 10, $userData['receiver'], 0, 'C', 0, 1, '', '', true, null, true);

        // Призначення платежу
        $this->pdf->SetXY($x + 38, $y + $lineStep * 8 + 1.5);
        $this->pdf->MultiCell(112, 9, $userData['purpose'], 0, 'C', 0, 1, '', '', true, null, true);

        $this->pdf->SetFont('dejavusanscondensed', '', 9);
        /** End draw user data * */
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
    protected function drawTextB($text, $x, $y, $width, $height) {
        $this->pdf->SetXY($x, $y - 5);
        $this->pdf->Write(5, $text);
    }

    /**
     * Save settings
     *
     * @return bool|string
     */
    public function saveSettings(SPaymentMethods $paymentMethod) {
        $saveKey = $paymentMethod->getId() . '_' . $this->moduleName;
        \ShopCore::app()->SSettings->set($saveKey, serialize($_POST['payment_method_oschadbank']));

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