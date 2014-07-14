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
    private $j, $rows, $nameStatus;
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }   
    
    
    public function VerifyDefaultStatus(AcceptanceTester $I)
    {
        //РџСЂРѕРІРµСЂРєР° РЅР°Р»РёС‡РёСЏ РѕРґРЅРѕРіРѕ СЃС‚Р°С‚СѓСЃР° РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ
        $this->rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rows);
        $true=0;
        for ($this->j=1;$this->j<=$this->rows;$this->j++){            
            //РџРѕРёСЃРє Р°С‚СЂРёР±СѓС‚Р° checked РґР»СЏ СЂР°РґРёРѕС‚РѕС‡РєРё
            $atribActiveClass = $I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j),"class");
            $I->comment($atribActiveClass);
            //$I->assertEquals($atribActiveClass, 'prod-on_off ');
            if($atribActiveClass == "prod-on_off "){
                 $true++;
            }
        }
        $I->assertEquals($true, '1');
    }   
    
    
    public function DeleteDefaultStatus(AcceptanceTester $I)
    {
//        $rows = $I->grabTagCount($I,"tbody tr");
//        $I->comment((string)$rows);
        for ($this->j=1;$this->j<=$this->rows;$this->j++){            
            //
            $atribActiveClass = $I->grabAttributeFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[3]/div/span","class");
            $I->comment($atribActiveClass);            
            if($atribActiveClass == "prod-on_off "){
                 break;
            }
        }
        $DeleteActiveBut=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->assertEquals($DeleteActiveBut, 'true');
        $id=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[1]");
        $I->click(CallbacksPage::DeleteStatusButtonLine($this->j));      
        $I->dontSeeElement(".alert.in.fade.alert-success");
        $I->wait('1');
        $defaultId=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[1]");
        $DelButAct=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->assertEquals($DelButAct, 'true');
        $I->assertEquals($id,$defaultId);   
    }   
   
    
    public function DefaultStatusOff(AcceptanceTester $I)
    {
        $I->click(CallbacksPage::ActiveButtonLine($this->j));
        $I->dontSeeElement("//*[@class='alert.in.fade.alert-success']/a");
        $I->dontSee("Статус по умолчанию изменен");
        $I->wait(1);
        InitTest::ClearAllCach($I);
        $I->wait(1);
        $ActButOn=$I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j), "class");
        $I->assertEquals($ActButOn, "prod-on_off");
        $DelButAct=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->assertEquals($DelButAct, 'true');       
    }
    
    
     public function ChangeDefaultStatus(AcceptanceTester $I)
    {
        if($this->j<$this->rows){
            $this->j++;
            $I->click(CallbacksPage::ActiveButtonLine($this->j));
        }
        else{
            $this->j--;
            $I->click(CallbacksPage::ActiveButtonLine($this->j));
        }        
//        $I->SeeElement("//*[@class='alert.in.fade.alert-success']/a");
//        $I->See("Статус по умолчанию изменен");
        InitTest::ClearAllCach($I);
        $I->wait(1);
        $this->nameStatus=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[2]/a");
        $I->comment($this->nameStatus);
        $ActButOn=$I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j), "class");
        $I->assertEquals($ActButOn, "prod-on_off");
        $DelButAct=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->assertEquals($DelButAct, 'true');
        for ($k=1;$k<=$this->rows;$k++){            
            //РџРѕРёСЃРє Р°С‚СЂРёР±СѓС‚Р° checked РґР»СЏ СЂР°РґРёРѕС‚РѕС‡РєРё
            $atribActiveClass = $I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($k),"class");
            $I->comment($atribActiveClass);
            //$I->assertEquals($atribActiveClass, 'prod-on_off ');
            if($atribActiveClass == "prod-on_off "){
                 $true++;
            }
        }
        $I->assertEquals($true, '1');       
    }
    
    
    public function AssigningDefaultStatusToNewCallback(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->waitForText('Заказать звонок');
        $I->click(CallbacksPage::$OrderCallButton);
        $I->waitForElement(CallbacksPage::$CallMeButton);
        $I->fillField(CallbacksPage::$UserNameCreate, 'name');
        $I->fillField(CallbacksPage::$TelephoneCreate, '123');        
        $I->click(CallbacksPage::$CallMeButton);
        $I->waitForElementNotVisible('.//*[@id="ordercall"]');
        $I->amOnPage('/admin');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[5]/a');
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('5');
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);        
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        if ($kil<=14){
            $rowCallback=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
            $I->comment((string)$rowCallback);
            $I->see('name', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[3]");
            $I->see('123', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[4]");
            $nameStatList=$I->grabTextFrom(CallbacksPage::StatusSelListLandingLine($rowCallback));
            $I->comment($nameStatList);
            $I->assertEquals($nameStatList, $this->nameStatus);
            $I->click(".//*[@id='callbacks_all']/table/tbody/tr[last()]/td[3]/a");
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $nameStatEdit=$I->grabTextFrom(CallbacksPage::$StatusSelEdit);
            $I->comment($nameStatEdit);
            $I->assertEquals($nameStatEdit, $this->nameStatus);
        }
        else{
            $I->click('.//*[@id="gopages"]/div/ul/li[last()-1]/a');
            $I->wait('2');
            $rowCallback=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
            $I->comment((string)$rowCallback);
            $I->see('name', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[3]");
            $I->see('123', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[4]");
            $nameStatList=$I->grabTextFrom(CallbacksPage::StatusSelListLandingLine($rowCallback));
            $I->comment($nameStatList);
            $I->assertEquals($nameStatList, $this->nameStatus);
            $I->click(".//*[@id='callbacks_all']/table/tbody/tr[last()]/td[3]/a");
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $nameStatEdit=$I->grabTextFrom(CallbacksPage::$StatusSelEdit);
            $I->comment($nameStatEdit);
            $I->assertEquals($nameStatEdit, $this->nameStatus);            
        }
    }
    
    
    public function DeleteNotDefaultStatus(AcceptanceTester $I)
    {
        if($this->j<$this->rows){
            $this->j++;
            $idDeleteStatus=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[1]");
            $I->click(CallbacksPage::DeleteStatusButtonLine($this->j));
        }
        else{
            $this->j--;
            $idDeleteStatus=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[1]");
            $I->click(CallbacksPage::DeleteStatusButtonLine($this->j));
        }        
        //$I->waitForElementVisible("alert.in.fade.alert-success");
        //$I->See("Статус был удален");
        //$I->waitForElementNotVisible("alert.in.fade.alert-success");
        $I->wait(1);
        $this->rows--;
        $rowsAfterDelete = $I->grabTagCount($I,"tbody tr");
        $I->assertEquals($rowsAfterDelete, $this->rows);
        for ($k=1; $k<=$this->rows; $k++){
                    $noId=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$k]/td[1]");
                    $I->comment("$noId");

                    if($noId == $idDeleteStatus){
                    $I->fail("NOT DELETED");
                    break;
                    }   
        }
    }
    
    
    
     
}