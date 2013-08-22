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
                    "<СписокКонтрагентов>\n" .
                    "<ID>" . $user['external_id'] . "</ID>\n" .
                    "<IDWeb>" . $user['id'] . "</IDWeb>\n" .
                    "<Код>" . $user['code'] . "</Код>\n" .
                    "<Наименование>" . htmlspecialchars($user['username']) . "</Наименование>\n" .
                    "<Логин></Логин>\n" .
                    "<Пароль></Пароль>\n" .
                    "<Емейл>" . $user['email'] . "</Емейл>\n" .
                    "<Телефон>" . $user['phone'] . "</Телефон>\n" .
                    "<Адрес>" . $user['address'] . "</Адрес>\n" .
                    "</СписокКонтрагентов>\n";
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
                    "<СписокОрганизаций>" .
                    "<IDWeb>" . $partner['id'] . "</IDWeb>\n" .
                    "<Наименование>" . htmlspecialchars($partner['name']) . "</Наименование>\n" .
                    "<Префикс>" . $partner['prefix'] . "</Префикс>\n" .
                    "<Код>" . $partner['code'] . "</Код>\n" .
                    "<ID>" . $partner['external_id'] . "</ID>\n" .
                    "<Регион>" . $partner['region'] . "</Регион>\n" .
                    "</СписокОрганизаций>\n";
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
                    "<СписокПродуктивность>\n" .
//                    "<IDWeb>" . $productivity['id'] . "</IDWeb>\n" .
                    "<Дата>" . date('Y-m-d\Th:m:s', $productivity['date']) . "</Дата>\n" .
                    "<Час>" . $productivity['hour'] . "</Час>\n" .
                    "<Количество>" . $productivity['count'] . "</Количество>\n" .
                    "<IDОрганизация>" . $productivity['partner_external_id'] . "</IDОрганизация>\n" .
                    "<IDWebОрганизация>" . $partners[$productivity['partner_external_id']] . "</IDWebОрганизация>\n" .
                    "<ID>" . $productivity['external_id'] . "</ID>\n" .
                    "</СписокПродуктивность>\n";
        }
    }

    /** export prices
     * <br>
      <СписокЦен><br>
     * <ЭтоАкционнаяЦена>false< /ЭтоАкционнаяЦена><br>
     * <Цена>61< /Цена><br>
     * <IDНоменклатура>67deae56-ed30-11e2-a8fe-9cb70dedbc3c< /IDНоменклатура><br>
     * <IDОрганизация>4643d461-aa49-4b70-9486-a59f80ee6af8< /IDОрганизация><br>
      < /СписокЦен>
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
                $products[$product['external_id']] = $product['id'];
            }

            $this->price_export .=
                    "<СписокЦен>\n" .
                    "<IDWeb>" . $price['id'] . "</IDWeb>\n" .
                    "<ЭтоАкционнаяЦена>" . $price_bool . "</ЭтоАкционнаяЦена>\n" .
                    "<Цена>" . $price['price'] . "</Цена>\n" .
                    "<IDНоменклатура>" . $price['product_external_id'] . "</IDНоменклатура>\n" .
                    "<IDWebНоменклатура>" . $products[$price['product_external_id']] . "</IDWebНоменклатура>\n" .
                    "<IDОрганизация>" . $price['partner_external_id'] . "</IDОрганизация>\n" .
                    "<IDWebОрганизация>" . $partners[$price['partner_external_id']] . "</IDWebОрганизация>\n" .
                    "<ID>" . $price['external_id'] . "</ID>\n" .
                    "</СписокЦен>\n";
            $this->products_ids[] = $price['product_external_id'];
        }
    }

    /** export orders
     * <br>
      <СписокЗаказыПокупателя><br>
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
      < /СписокЗаказыПокупателя>
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
                        "<СписокРасходныеНакладные>\n" .
                        "<IDWeb>" . $order['id'] . "</IDWeb>\n" .
                        "<ID>" . $order['invoice_external_id'] . "</ID>\n" .
                        "<Номер>" . $order['invoice_code'] . "</Номер>\n" .
                        "<Дата>" . date('Y-m-d\Th:m:s', $order['invoice_date']) . "</Дата>\n" .
                        "<IDОрганизация>" . $order['partner_external_id'] . "</IDОрганизация>\n" .
                        "<IDWebОрганизация>" . $partners[$order['partner_external_id']] . "</IDWebОрганизация>\n" .
                        "<IDЗаказПокупателя>" . $order['external_id'] . "</IDЗаказПокупателя>\n" .
                        "<IDWebЗаказПокупателя>" . $order['id'] . "</IDWebЗаказПокупателя>\n" .
                        "<IDКонтрагент>" . $order['user_id'] . "</IDКонтрагент>\n" .
                        "<IDWebКонтрагент>" . $users[$order['user_id']] . "</IDWebКонтрагент>\n";
            }

            /** convert paid value */
            if ($order['paid']) {
                $order['paid'] = 'true';
            } else {
                $order['paid'] = 'false';
            }


//            var_dumps($users);
            /** order export data */
            $this->order_export .=
                    "<СписокЗаказыПокупателя>\n" .
                    "<IDWeb>" . $order['id'] . "</IDWeb>\n" .
                    "<ID>" . $order['external_id'] . "</ID>\n" .
                    "<Дата>" . date('Y-m-d\Th:m:s', $order['date_created']) . "</Дата>\n" .
                    "<Номер>" . $order['code'] . "</Номер>\n" .
                    "<СрокДоставки>" . date('Y-m-d\Th:m:s', $order['delivery_date']) . "</СрокДоставки>\n" .
                    "<IDКонтрагент>" . $order['user_id'] . "</IDКонтрагент>\n" .
                    "<IDWebКонтрагент>" . $users[$order['user_id']] . "</IDWebКонтрагент>\n" .
                    "<Адрес>" . $order['user_deliver_to'] . "</Адрес>\n" .
                    "<КонтактныйТелефон>" . $order['user_phone'] . "</КонтактныйТелефон>\n" .
                    "<ПризнакПередоплаты>" . $order['paid'] . "</ПризнакПередоплаты>\n" .
                    "<IDОрганизация>" . $order['partner_external_id'] . "</IDОрганизация>\n" .
                    "<IDWebОрганизация>" . $partners[$order['partner_external_id']] . "</IDWebОрганизация>\n";

            /** order products export data */
            foreach ($order['order_products'] as $order_product) {
                /** get product external id */
                foreach ($this->products as $product) {
                    if ($product['id'] == $order_product['product_id']) {
                        $order_product['product_external_id'] = $product['external_id'];
                    }
                }
                $products .=
                        "<Строки>\n" .
                        "<IDДокумента>" . $order_product['external_id'] . "</IDДокумента>\n" .
                        "<IDWebДокумента>" . $order_product['id'] . "</IDWebДокумента>\n" .
                        "<IDНоменклатура>" . $order_product['product_external_id'] . "</IDНоменклатура>\n" .
                        "<IDWebНоменклатура>" . $order_product['product_id'] . "</IDWebНоменклатура>\n" .
                        "<Количество>" . $order_product['quantity'] . "</Количество>\n" .
                        "<Цена>" . $order_product['price'] . "</Цена>\n" .
                        "<Сумма>" . $order_product['quantity'] * $order_product['price'] . "</Сумма>\n" .
                        "</Строки>\n";

                $this->order_export .= $products;

                if ($order['status'] == 2) {
                    $this->invoice_export .= $products;
                }
            }
            if ($order['status'] == 2) {
                $this->invoice_export .= "</СписокРасходныеНакладные>\n";
            }

            $this->order_export .= "</СписокЗаказыПокупателя>\n";
        }
    }

    /** export categories
     * <br>
      <СписокГруппНоменклатуры><br>
     * <ID>d6c05886-e480-11e2-b7b6-9cb70dedbc3c< /ID><br>
     * <Наименование>Товары 1< /Наименование><br>
     * <Код>ФР-00000002< /Код><br>
      < /СписокГруппНоменклатуры>
     */
    public function exportCategories() {
        $parents = array();
        foreach ($this->categories as $category) {
            $parents[$category['id']] = $category['external_id'];
        }
        foreach ($this->categories as $category) {
            $this->categories_export .=
                    "<СписокГруппНоменклатуры>\n" .
                    "<IDWeb>" . $category['id'] . "</IDWeb>\n" .
                    "<ID>" . $category['external_id'] . "</ID>\n" .
                    "<Наименование>" . htmlspecialchars($category['name']) . "</Наименование>\n" .
                    "<Код>" . $category['code'] . "</Код>\n" .
                    "<IDРодитель>" . $parents[$category['parent_id']] . "</IDРодитель>\n" .
                    "<IDWebРодитель>" . $category['parent_id'] . "</IDWebРодитель>\n" .
                    "</СписокГруппНоменклатуры>\n";
        }
    }

    /** export roducts
     * <br>
      <СписокНоменклатуры><br>
     * <ID>67deae56-ed30-11e2-a8fe-9cb70dedbc3c< /ID><br>
     * <Наименование>SMX КАСТРУЛЯ 1,5Л,COLOR< /Наименование><br>
     * <Код>ФР-00000032< /Код><br>
     * <ЭтоГруппа>false< /ЭтоГруппа><br>
     * <IDРодитель>3fde83ef-ed24-11e2-a8fe-9cb70dedbc3c< /IDРодитель><br>
     * <ЕдиницаИзмерения>шт< /ЕдиницаИзмерения><br>
     * <ШтрихКод>8593419900020< /ШтрихКод><br>
      < /СписокНоменклатуры>
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
                    "<СписокНоменклатуры>\n" .
                    "<IDWeb>" . $product['id'] . "</IDWeb>\n" .
                    "<ID>" . $product['external_id'] . "</ID>\n" .
                    "<Наименование>" . htmlspecialchars($product['name']) . "</Наименование>\n" .
                    "<Код>" . $product['code'] . "</Код>\n" .
                    "<IDРодитель>" . $product['category_external_id'] . "</IDРодитель>\n" .
                    "<IDWebРодитель>" . $product['category_id'] . "</IDWebРодитель>\n" .
                    "<ЕдиницаИзмерения>" . $product['measure'] . "</ЕдиницаИзмерения>\n" .
                    "<ШтрихКод>" . $product['barcode'] . "</ШтрихКод>\n" .
                    "</СписокНоменклатуры>\n";
        }
    }

    /** wrap all export results */
    public function exportWrap() {
        $export_body .=
                $this->partners_export .
                $this->users_export .
                $this->product_export .
                $this->categories_export .
                $this->price_export .
                $this->productivity_export .
                $this->invoice_export .
                $this->order_export;


        if ($export_body) {
            header('content-type: text/xml');
            $this->export .= "<?xml version='1.0' encoding='UTF-8'?>" . "\n" .
                    "<КонтейнерСписков ВерсияСхемы='0.1'" .
                    '
                        xmlns="urn:abkt.com.ua:ozzimarket"
                        xmlns:xs="http://www.w3.org/2001/XMLSchema"
                        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                    '
                    . "  ДатаФормирования='" . date('Y-m-d h:m:s') . "'>" . "\n" .
                    $export_body .
                    "</КонтейнерСписков>\n";

            echo $this->export;
        } else {
            echo 'Нет даних для експорта';
        }
    }

}

/* End of file sample_module.php */