<?php

namespace NotificationListTester;

class notificationlistSteps 

extends \NotificationListTester

{

     function CreateProductCategory( $createNameCategory = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories/create');
        $I->wait('1');
        if(isset($createNameCategory)){
            $I->fillField('#inputName', $createNameCategory);
        }$I->click('//button[2]'); 
        $I->wait('2');
    }
    
    
    
    
    function CreateProduct ($Name_Product = NULL, 
                            $Price_Product = NULL,
                            $Amount_Product = NULL,
                            $Category_Product = NULL) {
        $I = $this;        
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->wait('2');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[1]/div[1]/div/input', $Name_Product);
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/tbody/tr/td[3]/input', $Price_Product);
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/tbody/tr/td[6]/input', $Amount_Product);
        $I->wait('1');
        $I->selectOption('#comment', $Category_Product);
//        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/a/span');
//        $I->wait('1');
//        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/div/input', $Category_Product);
//        $I->wait('2');
//        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/ul/li');
        $I->wait('1');
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('2');
    }
    
    
    function GetRowNotification($email = NULL) {
        $I = $this;
        $I->amOnPage(\NotificationListPage::$URL);
        $I->wait('5');
        $amount_check = $I->grabCCSAmount($I, '.niceCheck');
        $I->wait('1');
        if($amount_check > 3){
            for($j = 1;$j <= $amount_check;++$j){
            $I->wait('1');
                $email_notification = $I->grabTextFrom(\NotificationListPage::tabAllLineEmailText($j));
                if($email_notification == $email){
                $I->wait('1');
                    $I->wait('1');            
                    $position = $j;
                return $position;
                }
            }
        }
    }
    
    
    function GetIDNotification($email = NULL) {
        $I = $this;
        $I->amOnPage(\NotificationListPage::$URL);
        $I->wait('5');
        $amount_check = $I->grabCCSAmount($I, '.niceCheck');
        $I->wait('1');
        if($amount_check > 3){
            for($j = 1;$j <= $amount_check;++$j){
            $I->wait('1');
                $email_notification = $I->grabTextFrom(\NotificationListPage::tabAllLineEmailText($j));
                if($email_notification == $email){
                $I->wait('1');
                $ID = $I->grabTextFrom(\NotificationListPage::tabAllLineIDLink($j));
                    $I->wait('1');            
                    $ID_notification = $ID;
                return $ID_notification;
                }
            }
        }
    }    

    
    function GetIDStatus($name_statuse = NULL) {
        $I = $this;
        $I->amOnPage(\NotificationStatusesListPage::$URL);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(\NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == $name_statuse){
                $I->wait('1');                
                $ID_Status = $I->grabTextFrom(\NotificationStatusesListPage::lineIDText($j));
                return $ID_Status;
            }
        }
    }
    
    
    
    function GetPositionStatus($name_status = NULL) {
        $I = $this;
        $I->amOnPage(\NotificationStatusesListPage::$URL);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(\NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == $name_status){
                $I->wait('1');                
                $number_position = $I->grabTextFrom(\NotificationStatusesListPage::linePositionText($j));
                $number_position += 2;
                return $number_position;
            }
        }
    }
    
    
    
    function DeleteProductCategorys() {
        $I = $this;
        $first_default_category = 'Телефония, МР3-плееры, GPS';
        $second_default_category = 'Домашнее видео';
        $third_default_category = 'Детские товары';
        $fourth_default_category = 'Активный отдых и туризм';
        $fifth_default_category = 'Музыкальные инструменты';
        $I->amOnPage('/admin/components/run/shop/categories');
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->comment("$amount_rows --- количество строк");
        for($j = 1;$j <= $amount_rows;++$j){
        $name_search = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[3]/div/a");
        $I->comment("$name_search даное имя !!!");
            if($name_search != $first_default_category && $name_search != $second_default_category && $name_search != $third_default_category && $name_search != $fourth_default_category && $name_search != $fifth_default_category){
                $I->click("//section/div[2]/div/div[2]/div/div[$j]/div/div[1]");
                $I->wait('1');
                $I->click('//section/div[1]/div[2]/div/button[1]');
                $I->wait('1');
                $I->click('//section/div[4]/div[3]/a[1]');
                $I->wait('2');
                $I->amOnPage('/admin/components/run/shop/categories');
                $I->wait('2');
                $amount_rows--;
                $j--;
                $I->comment("Status:'$name_search' is Deleting.");                
            }
        }
        $I->comment("Все созданные категории, успешно удалены. Остались только дефолтные !!!");
    }
    

}