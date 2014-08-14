<?php
use \OrdersTester;
class TextElementOCACest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER CREATE PAGE WAY------------------------------
    
    /**
     * @group a
     */
    public function WayCreatePage (OrdersTester $I){
        $I->wantTo('Verify Way to "Create Order" Page.');
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->seeInCurrentUrl(CreateOrderAdminPage::$CrtPURL);
        $I->wait('1');
    }
    
//------------------TEXT ELEMENT CREATING PAGE PRODUCT--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreatePageProduct (OrdersTester $I){
         $I->wantTo('Verify Text on Product Page.');
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
    public function VerifyTextCreatePageUser (OrdersTester $I){
        $I->wantTo('Verify Text on User Page.');
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
    public function VerifyTextCreatePageOrder (OrdersTester $I){
        $I->wantTo('Verify Text on Order Page.');
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
    public function VerifyTextMessagePresence (OrdersTester $I){
        $I->wantTo('Verify Message "only numbers".');
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
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyButtonAddToBasket( $I){
        $I->wantTo('Verify Buttons:"Add Basket", "In Basket", "Delete" Presence.');
        $I->createProduct($nameProduct = 'Твр 123 for click butn', $nameVariantProduct = NULL, $priceProduct = 1);        
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('//table[1]/tbody/tr[1]/td[1]/div/input', 'Твр 123 for click butn');
        $I->wait('1');
        $I->see('Твр 123 for click butn','//body/ul[2]/li[1]/a');
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
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyButtonOutStock(OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Button "Out Stock" Presence.');
        $I->createProduct($nameProduct = 'Товар для Verify BTN7456 нету на складе.', $nameVariantProduct = NULL, $priceProduct = 1, $articleProduct = NULL, $amountProduct = 0);
        $I->click(\NavigationBarPage::$Orders);
            $I->click(\NavigationBarPage::$OrdersList);
            $I->wait('2');
            $I->click(\OrdersListPage::$ListButtCreateOrder);
            $I->wait('2');
            $I->fillField('//table[1]/tbody/tr[1]/td[1]/div/input', 'Товар для Verify BTN7456 нету на складе.');
            $I->wait('1');
            $I->see('Товар для Verify BTN7456 нету на складе.','//body/ul[2]/li[1]/a');
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
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldDefoultAmountInBasket(OrdersTester\OrdersSteps $I){
        $I->wantTo('VerifyDefoltValueOnFieldAmount.');
        $I->createProduct($nameProduct = 'ТоварVerify Defoult98765 AmountinBasket', $nameVariantProduct = NULL, $priceProduct = 1);
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('//table[1]/tbody/tr[1]/td[1]/div/input', 'ТоварVerify Defoult98765 AmountinBasket');
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
    public function VerifyTextMessageAddUser1 (OrdersTester $I) {
        $I->wantTo('Verify Alert Message On Create Order Page.');
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
    public function VerifyTextMessageAddUser2 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Unfilled "User" and "E-meil".');
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
    public function VerifyTextMessageAddUser3 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Unfilled "User".');
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
    public function VerifyTextMessageAddUser4 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Unfilled "E-meil".');
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
    public function VerifyTextMessageAddUser5 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Numeral Filled "E-meil".');
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
    public function VerifyTextMessageAddUser6 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Cirilic Filled "E-meil".');
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
    public function VerifyTextMessageAddUser7 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Latin Filled "E-meil".');
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
    public function VerifyTextMessageAddUser8 (OrdersTester $I) {
        $I->wantTo('Verify Text Message Symbol Filled "E-meil".');
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
    public function VerifyTextMessageButtonCreateDefolt (OrdersTester $I) {
        $I->wantTo('Verify Text Message Unfilled Values.');
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtCreate);
        $I->wait('1');
        $I->see('Пользователь не выбран', CreateOrderAdminPage::$CrtUMessageAlertPresence);        
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyTextMessageButtonCreateAddProducts (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Text Message User Not Selected.');
        $I->createProduct($nameProduct = 'Товар для Text Message', $nameVariantProduct = NULL, $priceProduct = 1);
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        $I->click(CreateOrderAdminPage::$CrtPButtProduct);
        $I->fillField('//table[1]/tbody/tr[1]/td[1]/div/input', 'Товар для Text Message');
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
