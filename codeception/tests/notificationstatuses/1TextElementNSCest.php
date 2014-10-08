<?php

use \NotificationStatusesTester;

class TextElementNSCest

{
//---------------------------AUTORIZATION---------------------------------------
    /**
     * @group aa
     */
    public function Login(NotificationStatusesTester $I){
        InitTest::Login($I);
    }
    

//-----------------------VERIFY LINKS BUTTONS-----------------------------------
    
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesList (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);   
        $I->seeInCurrentUrl(NotificationStatusesListPage::$URL);
    } 
    
    
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesCreate1 (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->seeInCurrentUrl(NotificationStatusesListPage::$URL);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->seeInCurrentUrl(NotificationStatusesCreatePage::$URL);
    } 
    
    
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesCreate2 (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->seeInCurrentUrl(NotificationStatusesCreatePage::$URL);
        $I->wait('1');
        $I->click(NotificationStatusesCreatePage::$ButtonBack);
        $I->wait('1');
        $I->seeInCurrentUrl(NotificationStatusesListPage::$URL);        
    } 
    
    
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesEdit1 (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::lineNameLink(1));
        $I->see('Редактирование статуса уведомления о появлении', NotificationStatusesEditPage::$Title);
        $I->click(NotificationStatusesEditPage::$ButtonBack);
        $I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses');
    } 
    
    

//-----------------------VERIFY TEXT LIST PAGE----------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextListPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$HeadCheck);
        $I->see('Статусы уведомлений о появлении', NotificationStatusesListPage::$Title);
        $I->see('Создать статус', NotificationStatusesListPage::$ButtonCreate);
        $I->see('Удалить', NotificationStatusesListPage::$ButtonDelete);
        $I->see('Выполнен', NotificationStatusesListPage::lineNameLink(1));
        $I->see('Новый', NotificationStatusesListPage::lineNameLink(2));
        $I->see('ID', NotificationStatusesListPage::$HeadID);
        $I->see('Имя', NotificationStatusesListPage::$HeadName);
        $I->see('Позиция', NotificationStatusesListPage::$HeadPosition);
    }   
    
    
    
//-----------------------VERIFY TEXT MESSAGE LIST PAGE--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextMessage (NotificationStatusesTester $I){
        $I->wait('1');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->moveMouseOver(NotificationStatusesListPage::lineNameLink(1));
        $I->waitForElement('.tooltip-inner');
        $I->see('Редактировать статус уведомления', '.tooltip-inner');
        $I->moveMouseOver(NotificationStatusesListPage::$ButtonCreate);
        $I->waitForElementNotVisible('.tooltip-inner');
        $I->dontSee('Редактировать статус уведомления', '.tooltip-inner');
    }

    
    
//-----------------------VERIFY TEXT DELETE WINDOW------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextDeleteWindow (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$HeadCheck);
        $I->click(NotificationStatusesListPage::$ButtonDelete);
        $I->waitForText('Удаление статуса', '5', NotificationStatusesListPage::$WindowDeleteTitle);
        $I->seeElement(NotificationStatusesListPage::$WindowDelete);
        $I->see('Удаление статуса', NotificationStatusesListPage::$WindowDeleteTitle);
        $I->see('Удалить ваш статус?', NotificationStatusesListPage::$WindowDeleteQuestion);
        $I->see('Удалить', NotificationStatusesListPage::$WindowDeleteButtonDelete);
        $I->see('Отменить', NotificationStatusesListPage::$WindowDeleteButtonBack);
        $I->see('×', NotificationStatusesListPage::$WindowDeleteButtonClose);   
        $I->click(NotificationStatusesListPage::$WindowDeleteButtonBack);
        $I->wait('1');
    }

    
    
//-----------------------VERIFY TEXT CREATING PAGE------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreatePage (NotificationStatusesTester $I){
        $I->wait('1');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->see('Создание статуса уведомления о появлении', NotificationStatusesCreatePage::$Title);
        $I->see('Вернуться', NotificationStatusesCreatePage::$ButtonBack);
        $I->see('Создать', NotificationStatusesCreatePage::$ButtonCreate);
        $I->see('Создать и выйти', NotificationStatusesCreatePage::$ButtonCreateExit);        
        $I->see('Общая информация', NotificationStatusesCreatePage::$TitleBlockInfo);        
        $I->see('Название', NotificationStatusesCreatePage::$InputNameLabel);        
    }

    
    
//-----------------------VERIFY TEXT EDITING PAGE-------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextEditPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::lineNameLink(1));
        $I->wait('1');
        $I->see('Редактирование статуса уведомления о появлении', NotificationStatusesEditPage::$Title);
        $I->see('Вернуться', NotificationStatusesEditPage::$ButtonBack);
        $I->see('Сохранить', NotificationStatusesEditPage::$ButtonSave);
        $I->see('Сохранить и выйти', NotificationStatusesEditPage::$ButtonSaveExit);
        $I->see('Данные статуса уведомления о появлении', NotificationStatusesEditPage::$TitleBlockEdit);
        $I->see('Название', NotificationStatusesEditPage::$InputNameLabel);
    }

    
    
//-------------VERIFY TEXT ALERT MESSAGE CREATING PAGE--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextAlertMessageCreatingPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->click(NotificationStatusesCreatePage::$ButtonCreate);
        $I->seeElement('label.alert.alert-error');    
    }

    
    
//-----------------------VERIFY TEXT CREATE MESSAGE-----------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreateMessageCreatingPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName,'qwe 123 !@# ЯЧС');
        $I->click(NotificationStatusesCreatePage::$ButtonCreate);
        $I->exactlySeeAlert($I, 'success', 'Статус ожидания создан');
        $I->wait('1');
    }

    
    
//--------------VERIFY TEXT ALERT MESSAGE EDITING PAGE--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextAlertMessageEdictingPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::lineNameLink(1));
        $I->wait('1');
        $I->fillField(NotificationStatusesEditPage::$InputName,'');
        $I->click(NotificationStatusesEditPage::$ButtonSave);
        $I->seeElement('label.alert.alert-error');    
    }

    
    
//-----------------------VERIFY TEXT EDITING MESSAGE----------------------------
    
    /**
     * @group aa
     */
     public function VerifyTextEdicttMessageEdictingPage (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, 'Для проверки присутствия сообщении о редактировании');
        $I->click(NotificationStatusesCreatePage::$ButtonCreate);
        $I->wait('3');
        $I->see('Редактирование статуса уведомления о появлении', NotificationStatusesEditPage::$Title);
        $I->wait('5');
        $I->click(NotificationStatusesEditPage::$ButtonSave);
        $I->exactlySeeAlert($I, 'success', 'Изменения сохранены');
        $I->wait('1');
     }

    
    
//------------VERIFY TEXT DELETING MESSAGE LIST PAGE----------------------------
    
    /**
     * @group a
     */
    public function VerifyTextMessageDeletingStatus (NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('2');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification != 'Новый' && $name_notification != 'Выполнен'){
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineCheck($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->exactlySeeAlert($I, 'success', 'Статус удален');
                $I->wait('1'); 
                $amount_rows--;
                $j--;
            }        
        }
      InitTest::ClearAllCach($I);   
    }
    
    
    
    
    
}