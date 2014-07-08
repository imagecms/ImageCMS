<?php
use \AcceptanceTester;
class IntegrationCreateEditDeleteCest
{
    /**
     * @group Integration
     */
    // Авторизация
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    //    Создание Уведомления о появлении, с ФронтЕнда сайта.
    public function CreateNotificationFront(AcceptanceTester $I){
      $I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
      $I->click('//div[3]/div/div/button');
      $I->click('//span[2]/div/button');   
    }        
    /**
     * @group Integration
     */
    // Проверка сохранения статуса.
    public function VerifySavedCreateStatus (AcceptanceTester $I){    
    $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
    $I->fillField(NotificationStatusesPage::$CreationFildInput, '123 qwe !@# ЯЧС');
    $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
    $I->See('123 qwe !@# ЯЧС', '//div[3]/section/div[2]');
    }
    /**
     * @group Integration
     */
    // Проверка отображения созданого статуса нв странице "Список уведомлений".
    public function CreatingStatusMappingOnThePageNotificationList (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->see('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
     $I->selectOption(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС');
     $I->click(NotificationListPage::$ListButtonCreatedStatus);
     $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');
    } 
    /**
    * @group Integration
    */
    //  Проверка сохранения Редактирования статуса.
    public function VerifySavedEditStatus (AcceptanceTester $I){
    $I->amOnPage(NotificationStatusesPage::$ListPageURL);
    $I->click(NotificationStatusesPage::$ListLinkForEditing);
    $I->fillField(NotificationStatusesPage::$EditingFildInput, 'Гидрокарбонат');
    $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
    $I->See('Гидрокарбонат', '//div[3]/section/div[2]');
       }   
    /**
     * @group Integration
     */
    //  Проверка отображения отредактированого статуса нв странице "Список уведомлений".
        public function EditingStatusMappingOnThePageNotificationList (AcceptanceTester $I){
         $I->amOnPage(NotificationListPage::$ListPageURL);   
         $I->see('Гидрокарбонат',  NotificationListPage::$ListSelectMain);   
         $I->selectOption(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат');    
         $I->click(NotificationListPage::$ListButtonCreatedStatus);  
         $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
         $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
         }   
    /**
     * @group Integration
     */
        //  Проверка удаления отредактированого статуса.
        public function VerifyDeletedEditingStatus(AcceptanceTester $I){
            $I->amOnPage(NotificationStatusesPage::$ListPageURL);
            $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
            $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
            $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
            $I->click(NotificationStatusesPage::$ListButtonDelete);
            $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
            $I->waitForElementNotVisible('Гидрокарбонат');
            $I->dontSeeLink('Гидрокарбонат');   
            }
    /**
     * @group Integration
     */        
         //    Проверка отображения удаления статуса нв странице "Список уведомлений".
        public function DeletingStatusMappingOnThePageNotificationList(AcceptanceTester $I){
             $I->amOnPage(NotificationListPage::$ListPageURL);
             $I->dontsee('Гидрокарбонат',  NotificationListPage::$ListSelectMain); 
             $I->dontsee('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
             $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат'); 
             $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС'); 
             $I->click(NotificationListPage::$ListLinkEditting);
             $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
             $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');             
         }
    
    /**
     * @group Integration
     */
    // Удаление Уведомления
        public function DeleteNotification(AcceptanceTester $I){
            $I->amOnPage(NotificationListPage::$ListPageURL);
            $I->click(NotificationListPage::$ListMainCheckBox);
            $I->click(NotificationListPage::$ListButtonDelete);
            $I->click(NotificationListPage::$DeleteWindowButtonDelete);
            InitTest::ClearAllCach($I);
            } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}    

