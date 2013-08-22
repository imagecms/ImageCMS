<?php

namespace exchangeunfu;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class export {

    /**
     * Path to upload dir
     * @var string
     */
    private $export_puth = '/application/modules/exchangeunfu/export/';

    /** Arrays for db data storage  */
    private $products = array();
    private $users = array();
    private $orders = array();
    private $productivity = array();
    private $partners = array();
    private $prices = array();
    private $categories = array();

    /** object instance of ci */
    private $ci;

    /** contains default locale */
    private $locale;

    /** export    */
    private $users_export;
    private $partners_export;
    private $productivity_export;
    private $price_export;
    private $order_export;
    private $categories_export;
    private $product_export;
    private $export;

    public function __construct() {
        $this->ci = &get_instance();
        $this->locale = 'ru';
        $this->ci->load->model('../modules/exchangeunfu/models/export_model');
    }

    public function index() {
    }

    /** export */
    public function export() {
        //load db data
        $this->products = $this->ci->export_model->getProducts();
        $this->categories = $this->ci->export_model->getCategories();
        $this->users = $this->ci->export_model->getUsers();
        $this->orders = $this->ci->export_model->getOrders();
        $this->productivity = $this->ci->export_model->getProductivity();
        $this->partners = $this->ci->export_model->getPartners();
        $this->prices = $this->ci->export_model->getPrices();

        /** export users */
        if ($this->users) {
            $this->exportUsers();
        }

        /** export partners */
        if ($this->partners) {
            $this->exportPartners();
        }

        /** export productivity */
        if ($this->productivity) {
            $this->exportProductivity();
        }

        /** export prices */
        if ($this->prices) {
            $this->exportPrices();
        }

        /** export orders */
        if ($this->orders) {
            $this->exportOrder();
        }
        
        /** export categories */
        if($this->categories){
            $this->exportCategories();
        }
        
        /** export products */
        if($this->products){
            $this->exportProducts();
        }

        /** wrao export  */
        $this->exportWrap();
        exit();
    }

    /** export users */
    public function exportUsers() {
        foreach ($this->users as $user) {
            $this->users_export .=
                    "<СписокКонтрагентов>\n" .
                    "<ID>" . $user['external_id'] . "</ID>\n" .
                    "<IDWeb>" . 'ddddd' . "</IDWeb>\n" .
                    "<Код></Код>\n" .
                    "<Наименование>" . $user['username'] . "</Наименование>\n" .
                    "<Логин></Логин>\n" .
                    "<Пароль></Пароль>\n" .
                    "<Емейл>" . $user['email'] . "</Емейл>\n" .
                    "<Телефон>" . $user['phone'] . "</Телефон>\n" .
                    "<Адрес>" . $user['address'] . "</Адрес>\n" .
                    "</СписокКонтрагентов>\n";
        }
//        var_dumps(htmlentities($this->users_export));
        /**
          <СписокКонтрагентов>
          <ID>f8c151f0-d9db-11e2-90f0-d067e5501078</ID>
          <Код>ФР-000001</Код>
          <Наименование>Покупатель 001</Наименование>
          <Логин/>
          <Пароль/>
          <Емейл>email@mail.com</Емейл>
          <Телефон>067 2556678</Телефон>
          <Адрес>м. Львів, вул. Дорошенка 23 / 25</Адрес>
          </СписокКонтрагентов>
         */
    }

    /** export partners */
    public function exportPartners() {
        foreach ($this->partners as $partner) {
            $this->partners_export .=
                    "<СписокОрганизаций>" .
                    "<Наименование>" . $partner['name'] . "</Наименование>\n" .
                    "<Префикс>" . $partner['prefix'] . "</Префикс>\n" .
                    "<Код>" . $partner['code'] . "</Код>\n" .
                    "<ID>" . $partner['external_id'] . "</ID>\n" .
                    "</СписокОрганизаций>\n";
        }

//        var_dumps(htmlentities($this->partners_export));
        /**
          <СписокОрганизаций>
          <Наименование>Наша фирма</Наименование>
          <Префикс>НФ</Префикс>
          <Код>00-000001</Код>
          <ID>4643d461-aa49-4b70-9486-a59f80ee6af8</ID>
          </СписокОрганизаций>
         */
    }

    /** export productivity */
    public function exportProductivity() {

        foreach ($this->productivity as $productivity) {
            $this->productivity_export .=
                    "<СписокПродуктивность>\n" .
                    "<Дата>" . date('Y-m-d', $productivity['date']) . "</Дата>\n" .
                    "<Час>" . $productivity['hour'] . "</Час>\n" .
                    "<Количество>" . $productivity['count'] . "</Количество>\n" .
                    "<IDОрганизация>" . $productivity['partner_external_id'] . "</IDОрганизация>\n" .
                    "</СписокПродуктивность>\n";
        }

        //var_dumps(htmlentities($this->productivity_export));
        /**

          <СписокПродуктивность>
          <Дата>2013-07-01</Дата>
          <Час>0</Час>
          <Количество>0</Количество>
          <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8</IDОрганизация>
          </СписокПродуктивность>
         */
    }

    /** export prices */
    public function exportPrices() {
        foreach ($this->prices as $price) {
            if ($price['action']) {
                $price_bool = 'true';
            } else {
                $price_bool = 'false';
            }

            $this->price_export .=
                    "<СписокЦен>\n" .
                    "<ЭтоАкционнаяЦена>" . $price_bool . "</ЭтоАкционнаяЦена>\n" .
                    "<Цена>" . $price['price'] . "</Цена>\n" .
                    "<IDНоменклатура>" . $price['product_external_id'] . "</IDНоменклатура>\n" .
                    "<IDОрганизация>" . $price['partner_external_id'] . "</IDОрганизация>\n" .
                    "</СписокЦен>\n";
        }
//        var_dumps(htmlentities($this->price_export));
        /**
          <СписокЦен>
          <ЭтоАкционнаяЦена>false</ЭтоАкционнаяЦена>
          <Цена>61</Цена>
          <IDНоменклатура>67deae56-ed30-11e2-a8fe-9cb70dedbc3c</IDНоменклатура>
          <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8</IDОрганизация>
          </СписокЦен>
         */
    }

    /** export orders */
    public function exportOrder() {
        /** add order products to order*/
        foreach ($this->orders as $key => $order) {
            $this->orders[$key]['order_products'] = $this->ci->export_model->getOrderProducts($order['id']);
        }
        
        /** get user external id */
        foreach ($this->orders as $order) {
            foreach ($this->users as $user){
                if($user['id'] == $order['user_id']){
                    $order['user_id'] = $user['external_id'];
                    break;
                }
            }
            
            /** convert paid value */
            if($order['paid']){
                $order['paid'] = 'true';
            }else{
                $order['paid'] = 'false';
            }
            
            /** order export data */
            $this->order_export .=
                "<СписокЗаказыПокупателя>\n" .
                        "<ID>" . $order['external_id'] . "</ID>\n" .
                        "<Дата>" . date('Y-m-d', $order['date_created']) . "</Дата>\n" .
                        "<Номер>" . '' . "</Номер>\n" .
                        "<СрокДоставки>" . '' . "</СрокДоставки>\n" .
                        "<IDКонтрагент>" . $order['user_id'] . "</IDКонтрагент>\n" .
                        "<Адрес>" . $order['user_deliver_to'] . "</Адрес>\n" .
                        "<КонтактныйТелефон>" . $order['user_phone'] . "</КонтактныйТелефон>\n" .
                        "<ПризнакПередоплаты>" . $order['paid'] . "</ПризнакПередоплаты>\n" .
                        "<IDОрганизация>" . $order['partner_external_id '] . "</IDОрганизация>\n";
            
                /** order products export data */
                foreach ($order['order_products'] as $order_product){
                    /** get product external id*/
                    foreach ($this->products as $product){
                        if($product['id'] == $order_product['product_id']){
                            $order_product['product_id'] = $product['external_id'];
                        }
                    }
                     $this->order_export .=
                        "<Строки>\n" .
                            "<IDДокумента>" . $order_product['external_id'] . "</IDДокумента>\n" .
                            "<IDНоменклатура>" . $order_product['product_id'] . "</IDНоменклатура>\n" .
                            "<Количество>" . $order_product['quantity'] . "</Количество>\n" .
                            "<Цена>" . $order_product['price'] . "</Цена>\n" .
                            "<Сумма>" . $order_product['quantity']*$order_product['price'] . "</Сумма>\n" .
                        "</Строки>\n";
                }
                
            $this->order_export .= "</СписокЗаказыПокупателя>\n";
        }
//        var_dumps(htmlentities($this->order_export));

        /**
          <СписокЗаказыПокупателя>
            <ID>4f9838cf-da6d-11e2-abcd-d067e5501078</ID>
            <Номер>НФФР-000001</Номер>
            <Дата>2013-06-21T15:23:00</Дата>
            <СрокДоставки>0001-01-01T00:00:00</СрокДоставки>
            <IDКонтрагент>f8c151f0-d9db-11e2-90f0-d067e5501078</IDКонтрагент>
            <Адрес>м. Львів, вул. Дорошенка 23 / 25</Адрес>
            <КонтактныйТелефон>067 2556678</КонтактныйТелефон>
            <ПризнакПередоплаты>false</ПризнакПередоплаты>
            <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8</IDОрганизация>
            <Строки>
              <IDДокумента>4f9838cf-da6d-11e2-abcd-d067e5501078</IDДокумента>
              <IDНоменклатура>99b84de5-d9da-11e2-90f0-d067e5501078</IDНоменклатура>
              <Количество>10</Количество>
              <Цена>200</Цена>
              <Сумма>2000</Сумма>
            </Строки>
            <Строки>
              <IDДокумента>4f9838cf-da6d-11e2-abcd-d067e5501079</IDДокумента>
              <IDНоменклатура>99b84de5-d9da-11e2-90f0-d067e5501078</IDНоменклатура>
              <Количество>11</Количество>
              <Цена>201</Цена>
              <Сумма>2001</Сумма>
            </Строки>
          </СписокЗаказыПокупателя>
         */
    }
    
    /** export categories */
    public function exportCategories(){
        foreach ($this->categories as $category){
            $this->categories_export .=
                    "<СписокНоменклатуры>\n" .
                        "<ID>" . $category['external_id'] ."</ID>\n" .
                        "<Наименование>" . $category['name'] ."</Наименование>\n" .
                        "<Код>" . '' ."</Код>\n" .
                        "<IDРодитель>" . '' ."</IDРодитель>\n" .
                        "<ЭтоГруппа>true</ЭтоГруппа>\n" .
                    "</СписокНоменклатуры>\n";
        }
//        var_dumps(htmlentities($this->categories_export));
        
        
        /**
         <СписокНоменклатуры>
		<ID>d6c05886-e480-11e2-b7b6-9c333333</ID>
		<Наименование>Товары 3</Наименование>
		<Код>ФР-00000002</Код>
                <IDРодитель>d6c05886-e480-11e2-b7b6-9cb70dedbc3c</IDРодитель>
		<ЭтоГруппа>true</ЭтоГруппа>
	</СписокНоменклатуры>
         */
    }
    
    /** export roducts */
    public function exportProducts(){
        foreach ($this->products as $product){
            foreach ($this->categories as $category){
                if($product['category_id'] == $category['id']){
                    $product['category_id'] = $category['external_id'];
                    break;
                }
            }
            $this->product_export .=
                    "<СписокНоменклатуры>\n" .
                        "<ID>" . $product['external_id'] . "</ID>\n" .
                        "<Наименование>" . $product['name'] . "</Наименование>\n" .
                        "<Код>" . '' . "</Код>\n" .
                        "<ЭтоГруппа>false</ЭтоГруппа>\n" .
                        "<IDРодитель>" . $product['category_id'] . "</IDРодитель>\n" .
                        "<ЕдиницаИзмерения>" . '' ."</ЕдиницаИзмерения>\n" .
                        "<ШтрихКод>" . '' . "</ШтрихКод>\n" .
                    "</СписокНоменклатуры>\n";
        }
//        var_dumps(htmlentities($this->product_export));
        
        /**
         <СписокНоменклатуры>
		<ID>67deae56-ed30-11e2-a8fe-9cb70dedbc3c</ID>
		<Наименование>SMX КАСТРУЛЯ 1,5Л,COLOR</Наименование>
		<Код>ФР-00000032</Код>
		<ЭтоГруппа>false</ЭтоГруппа>
		<IDРодитель>3fde83ef-ed24-11e2-a8fe-9cb70dedbc3c</IDРодитель>
		<ЕдиницаИзмерения>шт</ЕдиницаИзмерения>
		<ШтрихКод>8593419900020</ШтрихКод>
	</СписокНоменклатуры>
         */
    }
    
    /** wrap all export results */
    public function exportWrap(){
        header('content-type: text/xml');
            $this->export .= "<?xml version='1.0' encoding='UTF-8'?>" . "\n" .
                "<КонтейнерСписков ВерсияСхемы='0.1'  ДатаФормирования='" . date('Y-m-d') . "'>" . "\n" . 
                    $this->partners_export .
                    $this->users_export .
                    $this->product_export .
                    $this->categories_export .
                    $this->price_export .
                    $this->productivity_export .
                    $this->order_export .
                "</КонтейнерСписков>\n";
            
        file_put_contents(dirname(__FILE__) . '/export/export_' . date('Y-m-d_h:m:s') . '.xml', $this->export);
        echo $this->export;
//        var_dumps(htmlentities($this->export));
    }

}

/* End of file sample_module.php */