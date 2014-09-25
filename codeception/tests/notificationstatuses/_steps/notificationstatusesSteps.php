<?php

namespace NotificationStatusesTester;

class notificationstatusesSteps

extends \NotificationStatusesTester

{

   //-------------------------Create Category----------------------------------    
    

    
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
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/a/span');
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/div/input', $Category_Product);
        $I->wait('2');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/ul/li');
        $I->wait('1');
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('2');
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
    
    
    
}