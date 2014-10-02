<?php

use \OrdersTester;

class TextAndElementsPresentCast

{
    private $URl_List_Page      = '/admin/components/run/shop/orders';
    private $URl_Create_Page    = '/admin/components/run/shop/orders/create';
    

    
//----------------------------LIST PAGE-----------------------------------------   
    
    /**
     * @group aa
     */
    public function Login(OrdersTester $I) {
        InitTest::Login($I);
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
        $I->see('Список заказов (0)',OrdersListPage::$Title);
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
     * @group aa
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
    
    
}

