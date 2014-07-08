<?php
use \AcceptanceTester;
class TextElementCest
{
    // Авторизация
    public function Login(AcceptanceTester $I)
    {
        InitTest::Login($I);
    }
    
//    //    Создание Уведомления о появлении, с ФронтЕнда сайта.
//    public function CreateNotificationFront(AcceptanceTester $I)
//    {
//      $I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
//      $I->click('//div[3]/div/div/button');
//      $I->click('//span[2]/div/button');   
//    }        


    //    // Проверка сохранения статуса.
//    public function VerifySavedCreateStatus (AcceptanceTester $I)
//    {    
//    $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
//    $I->fillField(NotificationStatusesPage::$CreationFildInput, '123 qwe !@# ЯЧС');
//    $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
//    $I->See('123 qwe !@# ЯЧС', '//div[3]/section/div[2]');
//    }
 
    //    // Проверка отображения созданого статуса нв странице "Список уведомлений".
//    public function CreatingStatusMappingOnThePageNotificationList (AcceptanceTester $I)
//    {
//     $I->amOnPage(NotificationListPage::$ListPageURL);
//     $I->see('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
//     $I->selectOption(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС');
//     $I->click(NotificationListPage::$ListButtonCreatedStatus);
//     $I->wait('1');
//     $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
//     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');
//    }  
    //  Проверка сохранения Редактирования статуса.
       public function erifySavedEditStatus (AcceptanceTester $I)
       {
       $I->amOnPage(NotificationStatusesPage::$ListPageURL);
       $I->click(NotificationStatusesPage::$ListLinkForEditing);
       $I->fillField(NotificationStatusesPage::$EditingFildInput, 'Гидрокарбонат');
       $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
       $I->See('Гидрокарбонат', '//div[3]/section/div[2]');
       }        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}    

