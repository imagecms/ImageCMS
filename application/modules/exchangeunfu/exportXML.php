<?php

namespace exchangeunfu;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Export
 */
class ExportXML {

    /** Arrays for db data storage  */
    private $products = array();
    private $users = array();
    private $orders = array();
    private $productivity = array();
    private $partners = array();
    private $prices = array();
    private $categories = array();

    /** array for products ids for partner */
    private $products_ids = array();

    /** object instance of ci */
    private $ci;

    /** contains default locale */
    private $locale;

    /** export storage */
    private $users_export;
    private $partners_export;
    private $productivity_export;
    private $price_export;
    private $order_export;
    private $invoice_export;
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
    public function export($partner_id = null) {
        //load db data
        $this->users = $this->ci->export_model->getUsers();
        $this->partners = $this->ci->export_model->getPartners($partner_id);
        $this->products = $this->ci->export_model->getProducts();
        $this->categories = $this->ci->export_model->getCategories();
        $this->orders = $this->ci->export_model->getOrders($partner_id);
        $this->prices = $this->ci->export_model->getPrices($partner_id);
        $this->productivity = $this->ci->export_model->getProductivity($partner_id);

        if ($partner_id) {
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

            /** products export for partner */
            if (!empty($this->products_ids)) {
                $this->products = $this->ci->export_model->getProducts($this->products_ids);

                /** export products */
                if ($this->products) {
                    $this->exportProducts();
                }
            }
        } else {
            /** all export */
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
            if ($this->categories) {
                $this->exportCategories();
            }

            /** export products */
            if ($this->products) {
                $this->exportProducts();
            }
        }

        /** wrao export  */
        $this->exportWrap();
        exit();
    }

    /**
     * export users
     * <br>
     * <СписокКонтрагентов><br>
     * <ID>f8c151f0-d9db-11e2-90f0-d067e5501078< /ID><br>
     * <Код>ФР-000001< /Код><br>
     * <Наименование>Покупатель 001< /Наименование><br>
     * <Логин /><br>
     * <Пароль /><br>
     * <Емейл>email@mail.com< /Емейл><br>
     * <Телефон>067 2556678< /Телефон><br>
     * <Адрес>м. Львів, вул. Дорошенка 23 / 25< /Адрес><br>
     * < /СписокКонтрагентов>
     */
    public function exportUsers() {
        foreach ($this->users as $user) {
            $this->users_export .=
                    "\t<СписокКонтрагентов>\r\n" .
                    "\t\t<ID>" . $user['external_id'] . "</ID>\r\n" .
                    "\t\t<IDWeb>" . $user['id'] . "</IDWeb>\r\n" .
                    "\t\t<Код>" . $user['code'] . "</Код>\r\n" .
                    "\t\t<Наименование>" . htmlspecialchars($user['username']) . "</Наименование>\r\n" .
                    "\t\t<Логин></Логин>\r\n" .
                    "\t\t<Пароль></Пароль>\r\n" .
                    "\t\t<Емейл>" . $user['email'] . "</Емейл>\r\n" .
                    "\t\t<Телефон>" . $user['phone'] . "</Телефон>\r\n" .
                    "\t\t<Адрес>" . $user['address'] . "</Адрес>\r\n" .
                    "\t</СписокКонтрагентов>\r\n";
        }
    }

    /** export partners
     * <br>
     * <СписокОрганизаций><br>
     * <Наименование>Наша фирма</Наименование><br>
     * <Префикс>НФ</Префикс><br>
     * <Код>00-000001</Код><br>
     * <ID>4643d461-aa49-4b70-9486-a59f80ee6af8</ID><br>
     * </СписокОрганизаций>
     */
    public function exportPartners() {
        foreach ($this->partners as $partner) {
            $this->partners_export .=
                    "\t<СписокОрганизаций>\r\n" .
                    "\t\t<IDWeb>" . $partner['id'] . "</IDWeb>\r\n" .
                    "\t\t<Наименование>" . htmlspecialchars($partner['name']) . "</Наименование>\r\n" .
                    "\t\t<Префикс>" . $partner['prefix'] . "</Префикс>\r\n" .
                    "\t\t<Код>" . $partner['code'] . "</Код>\r\n" .
                    "\t\t<ID>" . $partner['external_id'] . "</ID>\r\n" .
                    "\t\t<Регион>" . $partner['region'] . "</Регион>\r\n" .
                    "\t</СписокОрганизаций>\r\n";
        }
    }

    /** export productivity
     * <br>
     * <СписокПродуктивность><br>
     * <Дата>2013-08-01< /Дата><br>
     * <Час>6< /Час><br>
     * <Количество>0< /Количество><br>
     * <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8< /IDОрганизация><br>
     * <ID>2013.08.01 - 06< /ID><br>
     * < /СписокПродуктивность>
     */
    public function exportProductivity() {

        $partners = array();
        foreach ($this->partners as $partner) {
            $partners[$partner['external_id']] = $partner['id'];
        }

        foreach ($this->productivity as $productivity) {
            $this->productivity_export .=
                    "\t<СписокПродуктивность>\r\n" .
                    "\t\t<IDWeb>" . $productivity['id'] . "</IDWeb>\r\n" .
                    "\t\t<Дата>" . date('Y-m-d\Th:m:s', $productivity['date']) . "</Дата>\r\n" .
                    "\t\t<Час>" . $productivity['hour'] . "</Час>\r\n" .
                    "\t\t<Количество>" . $productivity['count'] . "</Количество>\r\n" .
                    "\t\t<IDОрганизация>" . $productivity['partner_external_id'] . "</IDОрганизация>\r\n" .
                    "\t\t<IDWebОрганизация>" . $partners[$productivity['partner_external_id']] . "</IDWebОрганизация>\r\n" .
                    "\t\t<ID>" . $productivity['external_id'] . "</ID>\r\n" .
                    "\t</СписокПродуктивность>\r\n";
        }
    }

    /** export prices
     * <br>
     * <СписокЦен><br>
     * <ЭтоАкционнаяЦена>false< /ЭтоАкционнаяЦена><br>
     * <Цена>61< /Цена><br>
     * <IDНоменклатура>67deae56-ed30-11e2-a8fe-9cb70dedbc3c< /IDНоменклатура><br>
     * <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8< /IDОрганизация><br>
     * < /СписокЦен>
     */
    public function exportPrices() {
        foreach ($this->prices as $price) {
            if ($price['action']) {
                $price_bool = 'true';
            } else {
                $price_bool = 'false';
            }

            $partners = array();
            foreach ($this->partners as $partner) {
                $partners[$partner['external_id']] = $partner['id'];
            }

            $products = array();
            foreach ($this->products as $product) {
                $products[$product['id']] = $product['external_id'];
            }

            $this->price_export .=
                    "\t<СписокЦен>\r\n" .
                    "\t\t<IDWeb>" . $price['id'] . "</IDWeb>\r\n" .
                    "\t\t<ЭтоАкционнаяЦена>" . $price_bool . "</ЭтоАкционнаяЦена>\r\n" .
                    "\t\t<Цена>" . $price['price'] . "</Цена>\r\n" .
                    "\t\t<IDНоменклатура>" . $products[$price['product_id']]  . "</IDНоменклатура>\r\n" .
                    "\t\t<IDWebНоменклатура>" . $price['product_id'] . "</IDWebНоменклатура>\r\n" .
                    "\t\t<IDОрганизация>" . $price['partner_external_id'] . "</IDОрганизация>\r\n" .
                    "\t\t<IDWebОрганизация>" . $partners[$price['partner_external_id']] . "</IDWebОрганизация>\r\n" .
                    "\t\t<ID>" . $price['external_id'] . "</ID>\r\n" .
                    "\t</СписокЦен>\r\n";
            $this->products_ids[] = $price['product_external_id'];
        }
    }

    /** export orders
     * <br>
     * <СписокЗаказыПокупателя><br>
     * <ID>4f9838cf-da6d-11e2-abcd-d067e5501078< /ID><br>
     * <Номер>НФФР-000001< /Номер><br>
     * <Дата>2013-06-21T15:23:00< /Дата><br>
     * <СрокДоставки>0001-01-01T00:00:00< /СрокДоставки><br>
     * <IDКонтрагент>f8c151f0-d9db-11e2-90f0-d067e5501078< /IDКонтрагент><br>
     * <Адрес>м. Львів, вул. Дорошенка 23 / 25< /Адрес><br>
     * <КонтактныйТелефон>067 2556678< /КонтактныйТелефон><br>
     * <ПризнакПередоплаты>false< /ПризнакПередоплаты><br>
     * <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8< /IDОрганизация><br>
     * <Строки><br>
     * <IDДокумента>4f9838cf-da6d-11e2-abcd-d067e5501079< /IDДокумента><br>
     * <IDНоменклатура>99b84de5-d9da-11e2-90f0-d067e5501078< /IDНоменклатура><br>
     * <Количество>11< /Количество><br>
     * <Цена>201< /Цена><br>
     * <Сумма>2001< /Сумма><br>
     * < /Строки><br>
     * < /СписокЗаказыПокупателя>
     */
    public function exportOrder() {
        /** add order products to order */
        foreach ($this->orders as $key => $order) {
            $this->orders[$key]['order_products'] = $this->ci->export_model->getOrderProducts($order['id']);
        }

        $partners = array();
        foreach ($this->partners as $partner) {
            $partners[$partner['external_id']] = $partner['id'];
        }
        $users = array();
        foreach ($this->users as $user) {
            $users[$user['external_id']] = $user['id'];
        }


        /** get user external id */
        foreach ($this->orders as $order) {
            foreach ($this->users as $user) {
                if ($user['id'] == $order['user_id']) {
                    $order['user_id'] = $user['external_id'];
                    break;
                }
            }

            if ($order['status'] == 2) {
                $this->invoice_export .=
                        "\t<СписокРасходныеНакладные>\r\n" .
                        "\t\t<IDWeb>" . $order['id'] . "</IDWeb>\r\n" .
                        "\t\t<ID>" . $order['invoice_external_id'] . "</ID>\r\n" .
                        "\t\t<Номер>" . $order['invoice_code'] . "</Номер>\r\n" .
                        "\t\t<Дата>" . date('Y-m-d\Th:m:s', $order['invoice_date']) . "</Дата>\r\n" .
                        "\t\t<IDОрганизация>" . $order['partner_external_id'] . "</IDОрганизация>\r\n" .
                        "\t\t<IDWebОрганизация>" . $partners[$order['partner_external_id']] . "</IDWebОрганизация>\r\n" .
                        "\t\t<IDЗаказПокупателя>" . $order['external_id'] . "</IDЗаказПокупателя>\r\n" .
                        "\t\t<IDWebЗаказПокупателя>" . $order['id'] . "</IDWebЗаказПокупателя>\r\n" .
                        "\t\t<IDКонтрагент>" . $order['user_id'] . "</IDКонтрагент>\r\n" .
                        "\t\t<IDWebКонтрагент>" . $users[$order['user_id']] . "</IDWebКонтрагент>\r\n";
            }

            /** convert paid value */
            if ($order['paid']) {
                $order['paid'] = 'true';
            } else {
                $order['paid'] = 'false';
            }

            /** order export data */
            $this->order_export .=
                    "\t<СписокЗаказыПокупателя>\r\n" .
                    "\t\t<IDWeb>" . $order['id'] . "</IDWeb>\r\n" .
                    "\t\t<ID>" . $order['external_id'] . "</ID>\r\n" .
                    "\t\t<Дата>" . date('Y-m-d\Th:m:s', $order['date_created']) . "</Дата>\r\n" .
                    "\t\t<Номер>" . $order['code'] . "</Номер>\r\n" .
                    "\t\t<СрокДоставки>" . date('Y-m-d\Th:m:s', $order['delivery_date']) . "</СрокДоставки>\r\n" .
                    "\t\t<IDКонтрагент>" . $order['user_id'] . "</IDКонтрагент>\r\n" .
                    "\t\t<IDWebКонтрагент>" . $users[$order['user_id']] . "</IDWebКонтрагент>\r\n" .
                    "\t\t<Адрес>" . $order['user_deliver_to'] . "</Адрес>\r\n" .
                    "\t\t<КонтактныйТелефон>" . $order['user_phone'] . "</КонтактныйТелефон>\r\n" .
                    "\t\t<ПризнакПередоплаты>" . $order['paid'] . "</ПризнакПередоплаты>\r\n" .
                    "\t\t<IDОрганизация>" . $order['partner_external_id'] . "</IDОрганизация>\r\n" .
                    "\t\t<IDWebОрганизация>" . $partners[$order['partner_external_id']] . "</IDWebОрганизация>\r\n";

            /** order products export data */
            foreach ($order['order_products'] as $order_product) {
                /** get product external id */
                foreach ($this->products as $product) {
                    if ($product['id'] == $order_product['product_id']) {
                        $order_product['product_external_id'] = $product['external_id'];
                    }
                }
                $products .=
                        "\t\t\t<Строки>\r\n" .
                        "\t\t\t\t<IDДокумента>" . $order_product['external_id'] . "</IDДокумента>\r\n" .
                        "\t\t\t\t<IDWebДокумента>" . $order_product['id'] . "</IDWebДокумента>\r\n" .
                        "\t\t\t\t<IDНоменклатура>" . $order_product['product_external_id'] . "</IDНоменклатура>\r\n" .
                        "\t\t\t\t<IDWebНоменклатура>" . $order_product['product_id'] . "</IDWebНоменклатура>\r\n" .
                        "\t\t\t\t<Количество>" . $order_product['quantity'] . "</Количество>\r\n" .
                        "\t\t\t\t<Цена>" . $order_product['price'] . "</Цена>\r\n" .
                        "\t\t\t\t<Сумма>" . $order_product['quantity'] * $order_product['price'] . "</Сумма>\r\n" .
                        "\t\t\t</Строки>\r\n";

                $this->order_export .= $products;

                if ($order['status'] == 2) {
                    $this->invoice_export .= $products;
                }
            }
            if ($order['status'] == 2) {
                $this->invoice_export .= "\t\t</СписокРасходныеНакладные>\r\n";
            }

            $this->order_export .= "\t\t</СписокЗаказыПокупателя>\r\n";
        }
    }

    /** export categories
     * <br>
     * <СписокГруппНоменклатуры><br>
     * <ID>d6c05886-e480-11e2-b7b6-9cb70dedbc3c< /ID><br>
     * <Наименование>Товары 1< /Наименование><br>
     * <Код>ФР-00000002< /Код><br>
     * < /СписокГруппНоменклатуры>
     */
    public function exportCategories() {
        $parents = array();
        foreach ($this->categories as $category) {
            $parents[$category['id']] = $category['external_id'];
        }
        foreach ($this->categories as $category) {
            $this->categories_export .=
                    "\t<СписокГруппНоменклатуры>\r\n" .
                    "\t\t<IDWeb>" . $category['id'] . "</IDWeb>\r\n" .
                    "\t\t<ID>" . $category['external_id'] . "</ID>\r\n" .
                    "\t\t<Наименование>" . htmlspecialchars($category['name']) . "</Наименование>\r\n" .
                    "\t\t<Код>" . $category['code'] . "</Код>\r\n" .
                    "\t\t<IDРодитель>" . $parents[$category['parent_id']] . "</IDРодитель>\r\n" .
                    "\t\t<IDWebРодитель>" . $category['parent_id'] . "</IDWebРодитель>\r\n" .
                    "\t</СписокГруппНоменклатуры>\r\n";
        }
    }

    /** export roducts
     * <br>
     * <СписокНоменклатуры><br>
     * <ID>67deae56-ed30-11e2-a8fe-9cb70dedbc3c< /ID><br>
     * <Наименование>SMX КАСТРУЛЯ 1,5Л,COLOR< /Наименование><br>
     * <Код>ФР-00000032< /Код><br>
     * <ЭтоГруппа>false< /ЭтоГруппа><br>
     * <IDРодитель>3fde83ef-ed24-11e2-a8fe-9cb70dedbc3c< /IDРодитель><br>
     * <ЕдиницаИзмерения>шт< /ЕдиницаИзмерения><br>
     * <ШтрихКод>8593419900020< /ШтрихКод><br>
     * < /СписокНоменклатуры>
     */
    public function exportProducts() {
        foreach ($this->products as $product) {
            foreach ($this->categories as $category) {
                if ($product['category_id'] == $category['id']) {
                    $product['category_external_id'] = $category['external_id'];
                    break;
                }
            }
            $this->product_export .=
                    "\t<СписокНоменклатуры>\r\n" .
                    "\t\t<IDWeb>" . $product['id'] . "</IDWeb>\r\n" .
                    "\t\t<ID>" . $product['external_id'] . "</ID>\r\n" .
                    "\t\t<Наименование>" . htmlspecialchars($product['name']) . "</Наименование>\r\n" .
                    "\t\t<Код>" . $product['code'] . "</Код>\r\n" .
                    "\t\t<IDРодитель>" . $product['category_external_id'] . "</IDРодитель>\r\n" .
                    "\t\t<IDWebРодитель>" . $product['category_id'] . "</IDWebРодитель>\r\n" .
                    "\t\t<ЕдиницаИзмерения>" . $product['measure'] . "</ЕдиницаИзмерения>\r\n" .
                    "\t\t<ШтрихКод>" . $product['barcode'] . "</ШтрихКод>\r\n" .
                    "\t</СписокНоменклатуры>\r\n";
        }
    }

    /** wrap all export results */
    public function exportWrap() {
        $export_body .=
                $this->partners_export .
                $this->users_export .
                $this->categories_export .
                $this->product_export .
                $this->price_export .
                $this->productivity_export .
//                $this->invoice_export .
                $this->order_export;


        if ($export_body) {
            header('content-type: text/xml; charset=utf-8');
            $this->export .= "<?xml version='1.0' encoding='UTF-8'?>" . "\r\n" .
                    "<КонтейнерСписков xmlns='urn:abkt.com.ua:ozzimarket' xmlns:xs='http://www.w3.org/2001/XMLSchema' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>\r\n" .
                    $export_body .
                    "</КонтейнерСписков>\r\n";

            echo $this->export;
        } else {
            echo 'Нет даних для експорта';
        }
    }

}

/* End of file sample_module.php */