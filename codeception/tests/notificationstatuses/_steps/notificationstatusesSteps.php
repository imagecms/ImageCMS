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
    
    
    
    
}