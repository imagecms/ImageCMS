<?php
use \AcceptanceTester;
class TextElementCest
{
    /**
     * @group Verify
     */
    // Авторизация
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    /**
     * @group Verify
     */
    // Проверка URL и ссылок на страницы "Список, Создание, Редактирование".
    public function VerifyLinkNotfStatuses (AcceptanceTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);   
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListButtonCreate);
        $I->seeInCurrentUrl(NotificationStatusesPage::$CreatePageUrl);
        $I->click(NotificationStatusesPage::$CreationButtonBack);
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkEditing);
        $I->seeInCurrentUrl(NotificationStatusesPage::$EditingPageURL);
        $I->click(NotificationStatusesPage::$EditingButtonBack);
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->click('button.close');
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->click('//div[3]/a[2]');
    }
    
    /**
     * @group Verify
     */
     // Проверка текста и элементов на странице "Статусы уведомлений".
    public function VerifyTextListPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->see('Статусы уведомлений о появлении', NotificationStatusesPage::$ListTitle );
        $I->see('Создать статус', NotificationStatusesPage::$ListButtonCreate);
        $I->see('Удалить', NotificationStatusesPage::$ListButtonDelete);
        $I->see('Новый',  NotificationStatusesPage::$ListNameFirstStatuse);
        $I->see('Выполнен',  NotificationStatusesPage::$ListNameSecondStatuse);
        $I->see('ID',  NotificationStatusesPage::$ListNameFirstCollum);
        $I->see('Имя', NotificationStatusesPage::$ListNameSecondCollum);
        $I->see('Позиция',  NotificationStatusesPage::$ListNameThirdCollum);
    }
    
    // Проверка мини сообщения при фокусировке мыши на названии статуса.
    public function VerifyTextMessage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->moveMouseOver(NotificationStatusesPage::$ListLinkEditing);
        $I->waitForText('Редактировать статус уведомления');
        $I->see('Редактировать статус уведомления', 'div.tooltip-inner');
        $I->moveMouseOver(NotificationStatusesPage::$ListButtonCreate);
    }

    /**
     * @group Verify
     */
    // Проверка текста и элементов в окне "Удаление статуса".
    public function VerifyTextDeleteWindow (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->seeInPageSource('Удаление статуса','//h3');
        $I->seeInPageSource('Удалить ваш статус?');
        $I->seeInPageSource('Удалить', NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->seeInPageSource('Отменить', NotificationStatusesPage::$DeleteWindowButtonCancel);
        $I->seeInPageSource('×', NotificationStatusesPage::$DeleteWindowButtonX);   
    }
    /**
     * @group Verify
     */
    // Проверка текста и элементов на странице "Создание статуса".
    public function VerifyTextCreatePage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->see('Создание статуса уведомления о появлении', NotificationStatusesPage::$CreationNameTitle);
        $I->see('Вернуться', NotificationStatusesPage::$CreationButtonBack );
        $I->see('Создать',  NotificationStatusesPage::$CreationButtonCreate);
        $I->see('Создать и выйти',  NotificationStatusesPage::$CreationButtonCreateAndGoBack);        
        $I->see('Общая информация',  NotificationStatusesPage::$CreationNameBlock);        
        $I->see('Название',  NotificationStatusesPage::$CreationNameFild);        
    }
    /**
     * @group Verify
     */
    // Проверка текста и элементов на странице "Редактирование статуса".
    public function VerifyTextEditPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$EditingPageURL);
        $I->see('Редактирование статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameTitle);
        $I->see('Вернуться',  NotificationStatusesPage::$EditingButtonBack);
        $I->see('Сохранить',  NotificationStatusesPage::$EditingButtonSave);
        $I->see('Сохранить и выйти',  NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->see('Данные статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameBlock);
        $I->see('Название',  NotificationStatusesPage::$EditingNameFild);
    }
    /**
     * @group Verify
     */    
    // Проверка текста и элемента сообщения об обязательности заполнения поля на странице "Создание статуса".
    public function VerifyTextAlertMessageCreatingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->click('Создать');
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }
    /**
     * @group Verify
     */    
    // Проверка текста и элемента сообщения о создании на странице "Создание статуса".
    public function VerifyTextCreateMessageCreatingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput,'qwe 123 !@# ЯЧС');
        $I->click(NotificationStatusesPage::$CreationButtonCreate);
        $I->see('Сообщение',NotificationStatusesPage::$CreationCreateMessage); 
        $I->wait('1');
    }
    /**
     * @group Verify
     */
    // Проверка текста и элемента сообщения об обязательности заполнения поля на странице "Редактирование статуса".
    public function VerifyTextAlertMessageEdictingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListLinkForEditing);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'');
        $I->click('//button[1]');
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }
    /**
     * @group Verify
     */    
    // Проверка текста и элемента сообщения о редактировании на странице "Редактирование статуса".
     public function VerifyTextEdicttMessageEdictingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListLinkForEditing);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'ХоЛеСтеРИннн 123123123');
        $I->click(NotificationStatusesPage::$EditingButtonSave);
        $I->see('Сообщение',NotificationStatusesPage::$EdictingEdictMessage);
        $I->wait('1');
    }
    /**
     * @group Verify
     */
    // Проверка текста и элемента сообщения о удалении в окне "Удаления статуса".
    public function VerifyTextMessageDeletingStatus (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond); 
        $I->click(NotificationStatusesPage::$ListButtonDelete); 
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->waitForText('Статус удален');
        InitTest::ClearAllCach($I);      
    } 
  
    
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

