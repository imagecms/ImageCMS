<?php
use \AcceptanceTester;

class DeleteStatusCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }   
    
    
    public function VerifyDefaultStatus(AcceptanceTester $I)
    {
        //Проверка наличия одного статуса по умолчанию
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rows);
        $true=0;
        for ($j=1;$j<$rows;$j++){            
            //Поиск атрибута checked для радиоточки
            $atribActiveClass = $I->grabAttributeFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$j]/td[3]/div/span","class");
            $I->comment($atribActiveClass);
            //$I->assertEquals($atribActiveClass, 'prod-on_off ');
            if($atribActiveClass == "prod-on_off "){
                 $true++;
            }
//            $I->click(CallbacksPage::DeleteStatusButtonLine($j));      
//            $I->waitForElement(".//div[@class='modal hide fade in']");
        }
        $I->assertEquals($true, '1');
    }   
    
    
    public function DeleteDefaultStatus(AcceptanceTester $I)
    {
        //$this->rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$this->rows);
        //Определение строчки главной валюты
        for ($this->j=1;$this->j<$this->rows;++$this->j){
            //Поиск атрибута checked для радиоточки
            $this->atribCheck = $I->grabAttributeFrom("//tbody/tr[$this->j]/td[5]/input","checked");
                if($this->atribCheck == TRUE){
                break;
            }
        }
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rows);
        for ($j=1;$j<$rows;$j++){            
            //
            $atribActiveClass = $I->grabAttributeFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$j]/td[3]/div/span","class");
            $I->comment($atribActiveClass);            
            if($atribActiveClass == "prod-on_off "){
                 break;
            }
//            $I->click(CallbacksPage::DeleteStatusButtonLine($j));      
//            $I->waitForElement(".//div[@class='modal hide fade in']");
        }        
    }   
    
}