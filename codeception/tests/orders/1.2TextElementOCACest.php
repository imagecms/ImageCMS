<?php
use \AcceptanceTester;
class TextElementOCACest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER CREATE PAGE WAY------------------------------
    
    /**
     * @group a
     */
    public function WayCreatePage (AcceptanceTester $I){
        $I->wantTo('Проверить путь к странице "Создание заказа".');
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->seeInCurrentUrl(CreateOrderAdminPage::$CrtPURL);
        $I->wait('1');
    }
    
//------------------TEXT ELEMENT CREATING PAGE PRODUCT--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreateProductPage (AcceptanceTester $I){
         $I->wantTo('Проверить текст и наличие елементов на странице "Создание заказа(Админ.Панель.), в блоке "Товар".');
         $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
         $I->see('Создание заказа', CreateOrderAdminPage::$CrtPTitle); 
         $I->see('Вернуться', CreateOrderAdminPage::$CrtPButtBack); 
         $I->see('Создать', CreateOrderAdminPage::$CrtPButtCreate); 
         $I->see('Создать и выйти', CreateOrderAdminPage::$CrtPButtCreateAndGoBack); 
         $I->see('Товар', CreateOrderAdminPage::$CrtPButtProduct); 
         $I->see('Пользователь', CreateOrderAdminPage::$CrtPButtUser); 
         $I->see('Заказ', CreateOrderAdminPage::$CrtPButtOrder); 
         $I->see('Поиск товара', CreateOrderAdminPage::$CrtPNameBlockProductSearch); 
         $I->see('ID / Название / Артикул', CreateOrderAdminPage::$CrtPNameFieldIDNameArticul); 
         $I->see('Категория:', CreateOrderAdminPage::$CrtPNameSelectCategory); 
         $I->see('Товар:', CreateOrderAdminPage::$CrtPNameSelectProduct); 
         $I->see('Вариант:', CreateOrderAdminPage::$CrtPNameSelectVariant); 
         $I->see('Товар', CreateOrderAdminPage::$CrtPNameColProduct); 
         $I->see('Вариант', CreateOrderAdminPage::$CrtPNameColVariant); 
         $I->see('Цена', CreateOrderAdminPage::$CrtPNameColPrice); 
         $I->see('Количество', CreateOrderAdminPage::$CrtPNameColNumber); 
         $I->see('Общая цена', CreateOrderAdminPage::$CrtPNameColTotalPrice); 
         $I->see('Удалить', CreateOrderAdminPage::$CrtPNameColDelete); 
    }
    
    
    
//------------------TEXT ELEMENT CREATING PAGE USER-----------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreateUserPage (AcceptanceTester $I){
        $I->wantTo('Проверить текст и наличие елементов на странице "Создание заказа(Админ.Панель.), в блоке "Пользователь".');
         $I->amOnPage(CreateOrderAdminPage::$CrtPURL);  
         $I->click(CreateOrderAdminPage:: $CrtPButtUser);
         $I->click(CreateOrderAdminPage::$CrtULinkCreate);
         $I->see('Пользователь', CreateOrderAdminPage::$CrtUNameBlockUser);
         $I->see('Создать', CreateOrderAdminPage::$CrtULinkCreate);
         $I->see('Создать пользователя:', CreateOrderAdminPage::$CrtUNameBlockCreateUser);
         $I->see('* Полное имя :', CreateOrderAdminPage::$CrtUNameFieldName);
         $I->see('* E-mail :', CreateOrderAdminPage::$CrtUNameFieldEmeil);
         $I->see('Телефон :', CreateOrderAdminPage::$CrtUNameFieldPhone);
         $I->see('Адрес:', CreateOrderAdminPage::$CrtUNameFieldAddress);
         $I->see('Создать', CreateOrderAdminPage::$CrtUButtCreate);
         $I->see('Пользователь', CreateOrderAdminPage::$CrtUNameBlockUser);
         $I->see('Поиск:', CreateOrderAdminPage::$CrtUNameBlockSearch);
         $I->see('ID / Имя / E-mail', CreateOrderAdminPage::$CrtUFieldIDNameEmeil);
    }
    

//------------------TEXT ELEMENT CREATING PAGE ORDER----------------------------   
    
    /**
     * @group a
     */
    public function VerifyTextCreateOrderPage (AcceptanceTester $I){
        $I->wantTo('Проверить текст и наличие елементов на странице "Создание заказа(Админ.Панель.), в блоке "Заказ".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtOrder);
        $I->see('Информация заказа', CreateOrderAdminPage::$CrtONameBlockOrderInfo);
        $I->see('Пользователь:', CreateOrderAdminPage::$CrtONameBlockUser);
        $I->see('Имя:', CreateOrderAdminPage::$CrtONameFieldName);
        $I->see('Фамилия:', CreateOrderAdminPage::$CrtONameFieldFamily);
        $I->see('E-mail:', CreateOrderAdminPage::$CrtONameFieldEmeil);
        $I->see('Телефон:', CreateOrderAdminPage::$CrtONameFieldPhone);
        $I->see('Адрес:', CreateOrderAdminPage::$CrtONameFieldAddres);
        $I->see('Сумма товаров:', CreateOrderAdminPage::$CrtONameFieldTotalPrice);
        $I->see('Обновление', CreateOrderAdminPage::$CrtOButtUpdate);
        $I->see('Информация заказа:', CreateOrderAdminPage::$CrtONameBlockDeviliry);
        $I->see('Способ доставки:', CreateOrderAdminPage::$CrtONameSelectDelivey);
        $I->see('Не выбрано', '//select[1]');
        $I->see('Способ оплаты:', CreateOrderAdminPage::$CrtONameSelectPlaymant);
        $I->see('Не выбрано', '//select[2]');
        $I->see('Подарочный сертификат:', CreateOrderAdminPage::$CrtONameBlockCertificate);
        $I->see('Ввести промо-код:', CreateOrderAdminPage::$CrtONameFieldPromoCode);
    }

    
    
//------------------VERIFY TEXT MESSAGE PRESENCE--------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextMessagePresence (AcceptanceTester $I){
        $I->wantTo('Проверить наличие сообщения "только цифры" в поле "Общая цена" при фокусировке курсора на поле.');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtOrder);
        $I->moveMouseOver(CreateOrderAdminPage::$CrtOFieldTotalPrice);
        $I->waitForElementVisible('//body/div[5]/div[2]');
        $I->see('только цифры', '//body/div[5]/div[2]');
        $I->moveMouseOver(CreateOrderAdminPage::$CrtPButtCreate);
        $I->waitForElementNotVisible('//body/div[5]/div[2]');
        $I->dontSee('только цифры', '//body/div[5]/div[2]');
    }
    
//------------------VERIFY BUTTON ADD TO BASKET---------------------------------   
    
    /**
     * @group a
     */
    public function VerifyButtonAddToBasket(AcceptanceTester $I){
        $I->wantTo('Проверить присутствие и кликабельность кнопок "Добавить в корзину", "В корзине" и "Удалить товар с корзины".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('#productNameForOrders', CreateProductsOrdersPage::$CrtPrdNameMin);
        $I->wait('1');
        $I->see(CreateProductsOrdersPage::$CrtPrdNameMin,'//body/ul[2]/li[1]/a');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->see('Добавить в корзину', CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);
        $I->click(CreateOrderAdminPage::$CrtPButtDeleteTr1);
        $I->see('Добавить в корзину', CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);            
       
    }
    
//--------------------VERIFY BUTTON OUT STOCK--------------------------------- 
    
    /**
     * @group a
     */
    public function VerifyButtonOutStock(AcceptanceTester $I){
        $I->wantTo('Проверить присутствие и кликабельность кнопки "Нет на складе".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('#productNameForOrders', 'Минимальное Количество Товара');
            $I->wait('1');
            $I->see('Минимальное Количество Товара','//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see('Нет на складе', CreateOrderAdminPage::$CrtPButtOutStock);
            $I->click(CreateOrderAdminPage::$CrtPButtOutStock);
            $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);
            $I->click(CreateOrderAdminPage::$CrtPButtDeleteTr1);
            $I->see('Добавить в корзину', CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);            
       
    }
    
    
//-----------------------VERIFY FIELD AMOUNT IN BASKET-----------------------    
    
    
    /**
     * @group a
     */
    public function VerifyFieldDefoltAmountInBasket(AcceptanceTester $I){
        $I->wantTo('Проверить значение по умолчанию в поле "Количество", после добавления товара в корзину.');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('#productNameForOrders', CreateProductsOrdersPage::$CrtPrdNameMin);
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->seeInField(CreateOrderAdminPage::$CrtPFieldAmount, '1');
        $I->see( '1.00', CreateOrderAdminPage::$CrtPFieldTotalPrice);
        $I->see('1.00', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->click(CreateOrderAdminPage::$CrtPButtOrder);
        $I->click(CreateOrderAdminPage::$CrtOButtUpdate);
        $I->seeInField(CreateOrderAdminPage::$CrtOFieldTotalPrice, '1.00');
       
    }   
    
    
    
    
    
//---------------------Text Message User Page-----------------------------------    
    
    
    
    
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser1 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с незаполненными полями.');
        $I->amOnPage("/admin/components/run/shop/orders/create");
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->wait('1');
        $I->see("Проверьте введенные данные и заполните все обязательные поля", CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser2 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с незаполненными полеми "Имя Пользователя" и "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldAddress, 'qwe 123');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldPhone, '0987654123');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser3 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с незаполненным полем "Имя пользователя".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldAddress, 'йцу )(?*');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldPhone, '1');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldEmeil, 'ad@min.com');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser4 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с незаполненным полем "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldAddress, '"№; 2134 йцу ASD');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldPhone, '0982398746563216549878765465');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldName, 'Gipotolamus ЖВ');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser5 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с введенными числами в поле "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldName, 'Br4TD7 1z');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldEmeil, '0987654123');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser6 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при введенных символах кириллицы в поле "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldName, 'КуМтЕлЯпАсЕ');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldEmeil, 'йцуйцу йцуйцу');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser7 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с введенными символами латиницы в поле "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldName, 'ZURGODZUP');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldEmeil, 'qweQWEasdaPOUI');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    /**
     * @group a
     */
    public function VerifyTextMessageAddUser8 (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании с введенными спец-символами в поле "E-meil".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtUser);
        $I->click(CreateOrderAdminPage::$CrtULinkCreate);
        $I->fillField(CreateOrderAdminPage::$CrtUFieldName, 'b');
        $I->fillField(CreateOrderAdminPage::$CrtUFieldEmeil, '+-*/\!#^:');
        $I->click(CreateOrderAdminPage::$CrtUButtCreate);
        $I->see('Проверьте введенные данные и заполните все обязательные поля', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }


    
    
    
//---------------------Text Message User Page----------------------------------- 
   
    
    /**
     * @group a
     */
    public function VerifyTextMessageButtonCreateDefolt (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании заказа и неуказанных вводных данных.');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtCreate);
        $I->wait('1');
        $I->see('Пользователь не выбран', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    
    
    /**
     * @group a
     */
    public function VerifyTextMessageButtonCreateAddProducts (AcceptanceTester $I) {
        $I->wantTo('Проверить наличие сообщения при создании заказа с добавленным товаром и не выбранном "Пользователе".');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('#productNameForOrders', CreateProductsOrdersPage::$CrtPrdNameMin);
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->click(CreateOrderAdminPage::$CrtPButtOrder);
        $I->click(CreateOrderAdminPage::$CrtOButtUpdate);
        $I->click(CreateOrderAdminPage::$CrtPButtCreateAndGoBack);
        $I->wait('1');
        $I->see('Пользователь не выбран', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    
}
