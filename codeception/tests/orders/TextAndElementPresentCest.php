<?php

use \OrdersTester;

class TextAndElementsPresentCast

{
    private $URl_List_Page      = '/admin/components/run/shop/orders';
    private $URl_Create_Page    = '/admin/components/run/shop/orders/create';
    
    private $name_product_category    = 'Длязаказа';
    
    private $name_product    = 'Для создания заказа';
    private $price_product    = '777';
    private $article_product    = 'r2d2';
    private $amount_product    = '333';
    private $category_product    = 'Длязаказа';
    
    private $user_name      = 'Main Powerviolence';
    private $user_password  = '1234567';
    private $user_email     = 'afrika@boombaataa.net';
    private $user_phone     = '9876543210';
    private $user_adress    = 'New York';
    
    private $User_Email = 'ssaasuserlisttr.test@test.com';
    private $User_Password = '98765431';

  
//----------------------------LIST PAGE-----------------------------------------   
    
    /**
     * @group awe
     * @guy OrdersTester\OrdersSteps
     */
    public function Login(OrdersTester\OrdersSteps $I) {
        $I->loginCabinet('ssaasuserlisttr.test@test.com', '98765431');
//        InitTest::Login($I);
    }
    
    
    /**
     * @group awe
     * @guy OrdersTester\OrdersSteps
     */
    public function CrateProductCategory (OrdersTester\OrdersSteps $I) {
        $I->amOnUrl('http://saasuserlisttr.premme.com/admin');
        $I->login('ssaasuserlisttr.test@test.com', '98765431');
        $I->createCategoryProduct($createNameCategory = $this->name_product_category);
    }
    
    /**
     * @group awe
     * @guy OrdersTester\OrdersSteps
     */
    public function CrateProduct (OrdersTester\OrdersSteps $I) {
        $I->amOnUrl('http://saasuserlisttr.premme.com/admin');
//        $I->login('ssaasuserlisttr.test@test.com', '98765431');
        $I->createProduct(  $name_Product           = $this->name_product,
                            $price_Product          = $this->price_product,
                            $article_Product        = $this->article_product,
                            $amount_Product         = $this->amount_product,
                            $category_Product       = $this->category_product);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function CrateUser (OrdersTester\OrdersSteps $I) {
        $I->createUserUserPage( $user_Name      = $this->user_name,
                                $user_Email     = $this->user_email,
                                $user_Password  = $this->user_password,
                                $user_Phone     = $this->user_phone,
                                $user_Address   = $this->user_adress);
    }

    /**
     * @group a
     */
    public function VerifyWayToListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeInCurrentUrl($this->URl_List_Page);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTitlePresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeElement(OrdersListPage::$Title);
        $I->see('Список заказов');
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyTextPresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->see('Создать заказ', OrdersListPage::$ButtonCreate);
        $I->see('ID', OrdersListPage::$HeadIDLink);
        $I->see('Статус', OrdersListPage::$HeadStatusLink);
        $I->see('Дата', OrdersListPage::$HeadDateLink);
        $I->see('Заказчик', OrdersListPage::$HeadCustomerText);
        $I->see('Товары', OrdersListPage::$HeadProductsText);
        $I->see('Общая цена (без доставки)', OrdersListPage::$HeadTotalPriceLink);
        $I->see('Статус оплаты', OrdersListPage::$HeadPaymentStatusLink);
        $I->see('Заказов на странице', OrdersListPage::$SelectPaginationLabel);
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyElementPresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeElement(OrdersListPage::$FilterIDInput);
        $I->seeElement(OrdersListPage::$FilterDateInputFrom);
        $I->seeElement(OrdersListPage::$FilterDateInputTo);
        $I->seeElement(OrdersListPage::$FilterCustomerInput);
        $I->seeElement(OrdersListPage::$FilterProductsInput);
        $I->seeElement(OrdersListPage::$FilterTotalPriceInputFrom);
        $I->seeElement(OrdersListPage::$FilterTotalPriceInputTo);
        $I->seeElement(OrdersListPage::$FilterStatusSelect);
        $I->seeElement(OrdersListPage::$FilterPaymentStatusSelect);
    }
    
    
    /**
     * @group a
     */
    public function VerifyWayToCreatetPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->click(OrdersListPage::$ButtonCreate);
        $I->wait(1);
        $I->seeInCurrentUrl($this->URl_Create_Page);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTextPresentCreatePage (OrdersTester $I) {
        $I->amOnPage(OrdersListCreatePage::$URL);
        $I->wait(2);
        $I->see('Вернуться', OrdersListCreatePage::$ButtonBack);
        $I->see('Создать', OrdersListCreatePage::$ButtonCreate);
        $I->see('Создать и выйти', OrdersListCreatePage::$ButtonCreateExit);
        $I->see('Создание заказа', OrdersListCreatePage::$Title);
        $I->see('Быстрый поиск товара', OrdersListCreatePage::$TabQuickSearch);
        $I->see('Поиск товара:', OrdersListCreatePage::$TabQuickSearchInputProductLabel);
        $I->see('ID / Название / Артикул', '//section/form/div[1]/div[1]/div[2]/div[1]/div/div[1]/div/span');
        $I->see('Результаты поиска:', OrdersListCreatePage::$TabQuickSearchSelectResultLabel);
        $I->see('Вариант:', OrdersListCreatePage::$TabQuickSearchSelectVariantLabel);
        $I->click(OrdersListCreatePage::$TabAdvancedSearch);
        $I->wait(1);
        $I->see('Расширенный поиск товара', OrdersListCreatePage::$TabAdvancedSearch);
        $I->see('Категория:', OrdersListCreatePage::$TabAdvancedSearchSelectCategoryLabel);
        $I->see('Результаты поиска:', OrdersListCreatePage::$TabAdvancedSearchSelectResultLabel);
        $I->see('Вариант:', OrdersListCreatePage::$TabAdvancedSearchSelectVariantLabel);
        $I->click(OrdersListCreatePage::$TabNewUser);
        $I->wait(1);
        $I->see('Новый пользователь', OrdersListCreatePage::$TabNewUser);
        $I->see('Полное имя: *', OrdersListCreatePage::$TabNewUserInputNameLabel);
        $I->see('E-mail: *', OrdersListCreatePage::$TabNewUserInputEmailLabel);
        $I->see('Телефон:', OrdersListCreatePage::$TabNewUserInputPhoneLabel);
        $I->see('Адрес:', OrdersListCreatePage::$TabNewUserInputAdressLabel);
        $I->see('Способ доставки:', OrdersListCreatePage::$TabNewUserSelectDeliveryLabel);
        $I->see('Способ оплаты:', OrdersListCreatePage::$TabNewUserSelectPaymentLabel);        
        $I->click(OrdersListCreatePage::$TabSearchUser);
        $I->wait(1);
        $I->see('Поиск пользователя', OrdersListCreatePage::$TabSearchUser);
        $I->see('Покупатель:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[1]/label');        
        $I->see('Результаты поиска:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[2]/label');
        $I->see('E-mail:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[3]/label');
        $I->see('Телефон:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[4]/label');
        $I->see('Адрес:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[5]/label');
        $I->see('Способ доставки:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[6]/label');
        $I->see('Способ оплаты:', '//section/form/div[1]/div[2]/div[2]/div[2]/div/div[7]/label');
        $I->see('Корзина', OrdersListCreatePage::$TitleTableBasket);
        $I->see('Товар', OrdersListCreatePage::$HeadProductText);
        $I->see('Артикул', OrdersListCreatePage::$HeadArticleText);
        $I->see('Вариант', OrdersListCreatePage::$HeadVariantText);
        $I->see('Цена', OrdersListCreatePage::$HeadPriceText);
        $I->see('Количество', OrdersListCreatePage::$HeadAmountText);
        $I->see('Общая цена', OrdersListCreatePage::$HeadTotalPriceText);
        $I->see('Подарочный сертификат:', '//section/form/table/tfoot/tr/td/div/div/span[1]/label');
        $I->see('Общий:', OrdersListCreatePage::$FootTotalPriceLabel);
    }
    
    
    /**
     * @group a
     */
    public function VerifyOrderListEmptyPage (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $amount_checkbox = $I->grabCCSAmount($I, '.niceCheck');
        $I->comment("Количество чекбоксов = '$amount_checkbox'");
        if($amount_checkbox > 1){
            $I->click(OrdersListPage::$HeadCheck);
            $I->wait(1);
            $I->click(OrdersListPage::$ButtonDelete);
            $I->wait(1);
            $I->click(OrdersListPage::$WindowDeleteButtonDelete);
        }
        elseif ($amount_checkbox == 1) {
            $I->comment('Список пуст, заказов нет !');
        }
    }
    

    /**
     * @group a
     */
    public function VerifyTextOrderCreatePage (OrdersTester $I) {
        $I->amOnPage(OrdersListCreatePage::$URL);
        $I->wait(2);
        $I->click(OrdersListCreatePage::$TabSearchUser);
        $I->wait(1);
        $I->fillField(OrdersListCreatePage::$TabSearchUserInputUser, '1');
        $I->wait(1);
        $I->click(OrdersListCreatePage::tabSearchUserSelectResultOption(1));
        $I->wait(1);
        $I->click(OrdersListCreatePage::$ButtonCreate);
        $I->wait(1);
        $I->click(OrdersListCreatePage::$ButtonCreateExit);
        $I->wait(2);
        $I->seeInCurrentUrl('/admin/components/run/shop/orders');
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyRowListPage (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(2);
        $I->see('Новый', OrdersListPage::lineStatusText(1));
        $I->see('0', OrdersListPage::lineTotalPriceText(1));
        $I->see('0', OrdersListPage::lineProductsText(1));
        $I->see('Не оплачен', OrdersListPage::linePaymentStatusText(1));
    }

    
    
    /**
     * @group a
     */
    public function VerifyСheckButton (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $I->click(OrdersListPage::lineCheck(1));
        $I->wait(2);
        $I->seeElement(OrdersListPage::$Title);
        $I->see('Фильтр', OrdersListPage::$ButtonFilter);
        $I->see('Изменить статус', OrdersListPage::$ButtonChangeStatus);
        $I->see('Удалить', OrdersListPage::$ButtonDelete);
        $I->click(OrdersListPage::$ButtonChangeStatus);
        $I->wait(1);
        $I->see('СТАТУСЫ ЗАКАЗОВ', '//section/div[1]/div[2]/div/div/ul/li[1]');
        $I->see('Новый', '//section/div[1]/div[2]/div/div/ul/li[2]/a');
        $I->see('Доставлен', '//section/div[1]/div[2]/div/div/ul/li[3]/a');
        $I->see('СТАТУС ОПЛАТЫ', '//section/div[1]/div[2]/div/div/ul/li[4]');
        $I->see('Оплачен', '//section/div[1]/div[2]/div/div/ul/li[5]/a');
        $I->see('Не оплачен', '//section/div[1]/div[2]/div/div/ul/li[6]/a');
        $I->click(OrdersListPage::$ButtonDelete);
        $I->wait(1);        
        $I->seeElement(OrdersListPage::$WindowDelete);
        $I->see('Удаление заказа', OrdersListPage::$WindowDeleteTitle);
        $I->see('Удалить отмеченные заказы?', OrdersListPage::$WindowDeleteQuestion);
        $I->see('Удалить', OrdersListPage::$WindowDeleteButtonDelete);
        $I->see('Отменить', OrdersListPage::$WindowDeleteButtonCancel);
        $I->see('×', OrdersListPage::$WindowDeleteButtonClose);        
    }
        
    
    /**
     * @group a
     */
    public function VerifyFilterStatusAndButtonCancelFilter (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $I->selectOption(OrdersListPage::$FilterStatusSelect, 'Доставлен');
        $I->wait(2);
        $I->dontSee('Новый', OrdersListPage::lineStatusText(1));
        $I->click(OrdersListPage::$ButtonCancelFiltration);
        $I->wait(2);
        $I->see('Новый', OrdersListPage::lineStatusText(1));
    }
    
    /**
     * @group a
     */
    public function VerifyButtonChangeStatusForStatus (OrdersTester $I) {
        $change_status_Made = '//section/div[1]/div[2]/div/div/ul/li[3]/a';
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $I->click(OrdersListPage::lineCheck(1));
        $I->click(OrdersListPage::$ButtonChangeStatus);
        $I->click($change_status_Made);
        $I->wait(2);
        $I->see('Доставлен', OrdersListPage::lineStatusText(1));        
        $I->selectOption(OrdersListPage::$FilterStatusSelect, 'Новый');
        $I->wait(2);
        $I->dontSee('Доставлен', OrdersListPage::lineStatusText(1));
        $I->click(OrdersListPage::$ButtonCancelFiltration);
        $I->wait(2);
        $I->see('Доставлен', OrdersListPage::lineStatusText(1));
    }
    
    
    /**
     * @group a
     */
    public function VerifyFilterPaymentStatus (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $I->see('Не оплачен', OrdersListPage::linePaymentStatusText(1));
        $I->selectOption(OrdersListPage::$FilterPaymentStatusSelect, 'Оплачен');
        $I->wait(2);
        $I->dontSee('Не оплачен', OrdersListPage::linePaymentStatusText(1));
        $I->wait(1);
        $I->click(OrdersListPage::$ButtonCancelFiltration);
        $I->wait(2);
        $I->see('Не оплачен', OrdersListPage::linePaymentStatusText(1));        
    }
    
    
    /**
     * @group a
     */
    public function VerifyButtonChangeStatusForPaymentStatus (OrdersTester $I) {
        $change_payment_status_paid = '//section/div[1]/div[2]/div/div/ul/li[5]/a';
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $I->click(OrdersListPage::lineCheck(1));
        $I->click(OrdersListPage::$ButtonChangeStatus);
        $I->click($change_payment_status_paid);
        $I->wait(2);
        $I->see('Доставлен', OrdersListPage::lineStatusText(1));        
        $I->selectOption(OrdersListPage::$FilterStatusSelect, 'Новый');
        $I->wait(2);
        $I->dontSee('Доставлен', OrdersListPage::lineStatusText(1));
        $I->click(OrdersListPage::$ButtonCancelFiltration);
        $I->wait(2);
        $I->see('Доставлен', OrdersListPage::lineStatusText(1));
    }
    
    /**
     * @group a
     */
    public function DeleteOrders (OrdersTester $I) {
        $I->amOnPage(OrdersListPage::$URL);
        $I->wait(1);
        $amount_checkbox = $I->grabCCSAmount($I, '.niceCheck');
        $I->comment("Количество чекбоксов = '$amount_checkbox'");
        if($amount_checkbox > 1){
            $I->click(OrdersListPage::$HeadCheck);
            $I->wait(1);
            $I->click(OrdersListPage::$ButtonDelete);
            $I->wait(1);
            $I->click(OrdersListPage::$WindowDeleteButtonDelete);
        }
        elseif ($amount_checkbox == 1) {
            $I->comment('Список пуст, заказов нет !');
        }
    }
    
    /**
     * @group a
     */
    public function TabQuick (OrdersTester $I) {
        $I->amOnPage(OrdersListCreatePage::$URL);
        $I->wait(3);
        $I->fillField(OrdersListCreatePage::$TabQuickSearchInputProduct, $this->name_product);
        $I->wait(12);
        $I->click(OrdersListCreatePage::tabQuickSearchSelectResultOption(1));
        $I->wait(4);
        $I->see($this->price_product, OrdersListCreatePage::tabQuickSearchSelectVariantOption(1));
        $I->see($this->name_product, OrdersListCreatePage::$TabQuickSearchLinkProduct);
        $I->see($this->price_product, OrdersListCreatePage::$TabQuickSearchTextVariant);
        $I->see($this->amount_product, OrdersListCreatePage::$TabQuickSearchTextStock);
        $I->click(OrdersListCreatePage::$TabQuickSearchButtonAdd);
        $I->wait(1);
        $I->see($this->name_product, OrdersListCreatePage::lineProductLink(1));
        $I->see($this->article_product, OrdersListCreatePage::lineArticleText(1));
        $I->see('', OrdersListCreatePage::lineVarianText(1));
        $I->see($this->price_product, OrdersListCreatePage::linePriceText(1));
        $I->seeInField(OrdersListCreatePage::lineAmountInput(1), '1');
        $I->see($this->price_product, OrdersListCreatePage::lineTotalPriceText(1));
        $I->see($this->price_product, OrdersListCreatePage::$FootTotalPrice);
        $I->see($this->price_product, OrdersListCreatePage::$FootTotalPriceLabel);
        
    }
}

