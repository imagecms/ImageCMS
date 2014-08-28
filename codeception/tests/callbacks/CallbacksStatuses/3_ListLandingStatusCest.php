<?php
use \CallbacksTester;

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
    private $j, $rows, $nameStatus, $sum, $AllNamesStatus, $rowsSt;
    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    } 
    
    
    public function NamesInListLanding(CallbacksTester $I)
    {
        $I->click(NavigationBarPage::$Orders);
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click(NavigationBarPage::$CallbackStatuses);
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('1');
        $I->see('Статусы обратных звонков', ".//*[@id='orderStatusesList']/section/div[1]/div[1]/span[2]");
        $I->see('ID', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[1]');
        $I->see('Имя', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[2]');
        $I->see('По умолчанию', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[3]');
        $I->see('Удалить', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[4]');
        $I->see('Создать статус', CallbacksPage::$CreateStatusButton);
    }
    
    
    public function VerifyDefaultStatus(CallbacksTester $I)
    {
        //Проверяем наличие статуса отмеченного по умолчанию в списке и только одного
        $this->rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$this->rows);
        $true=0;
        for ($this->j=1;$this->j<=$this->rows;$this->j++){            
            //Считываем значение класса у всех статусов в списке
            $atribActiveClass = $I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j),"class");
            $I->comment($atribActiveClass);
            //$I->assertEquals($atribActiveClass, 'prod-on_off ');
            if($atribActiveClass == "prod-on_off "){
                 $true++;
            }
        }
        $I->assertEquals($true, '1');
        InitTest::ClearAllCach($I);
    }   
    
    
    public function DeleteDefaultStatus(CallbacksTester $I)
    {
        //Проверка возможности удаления статуса по умолчанию
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
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
        $I->assertEquals($id, $defaultId);
    }   
   
    
    public function DefaultStatusOff(CallbacksTester $I)
    {
        //Проверка возможности отключения статуса по умолчанию
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->click(CallbacksPage::ActiveButtonLine($this->j));
        $I->dontSeeElement("//*[@class='alert.in.fade.alert-success']/a");
        $I->dontSee("Статус по умолчанию изменен");
        $I->wait(1);
        InitTest::ClearAllCach($I);
        $I->wait(2);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $ActButOn=$I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j), "class");
        $ActButOn=  trim($ActButOn);
        $I->assertEquals($ActButOn, "prod-on_off");
        $DelButAct=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->assertEquals($DelButAct, 'true'); 
        InitTest::ClearAllCach($I);
    }
    
    
     public function ChangeDefaultStatus(CallbacksTester $I)
    {
        //Изменение статуса по умолчанию
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
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
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $this->nameStatus=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$this->j]/td[2]/a");
        $I->comment($this->nameStatus);
        $ActButOn=$I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($this->j), "class");
        $ActButOn=  trim($ActButOn);
        $I->assertEquals($ActButOn, "prod-on_off");
        $DelButAct=$I->grabAttributeFrom(CallbacksPage::DeleteStatusButtonLine($this->j), "disabled");
        $I->comment($DelButAct);
        $I->assertEquals($DelButAct, 'true');
        $true=0;
        for ($k=1;$k<=$this->rows;$k++){            
            //РџРѕРёСЃРє Р°С‚СЂРёР±СѓС‚Р° checked РґР»СЏ СЂР°РґРёРѕС‚РѕС‡РєРё
            $atribActiveClass = $I->grabAttributeFrom(CallbacksPage::ActiveButtonLine($k),"class");
            $atribActiveClass=  trim($atribActiveClass);
            $I->comment($atribActiveClass);
            //$I->assertEquals($atribActiveClass, 'prod-on_off ');
            if($atribActiveClass == "prod-on_off"){
                 $true++;
            }
        }
        $I->assertEquals($true, '1');
    }
    
    
    public function AssigningDefaultStatusToNewCallback(CallbacksTester $I)
    {
        //Присвоение новому колбеку статуса по умолчанию
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
        InitTest::ClearAllCach($I);
    }
    
    
    public function ValuesOfAllStatusesInSelectMenuAndButtonsListLandingCallback(CallbacksTester $I)
    {
        //Проверка наличия всех названий созданных статусов колбеков в селект меню и кнопках на странице "Список обратных звонков"
        $I->amOnPage('/admin');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[5]/a');
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('2');        
        $I->click(".//*[@id='callbacks_all']/table/tbody/tr[1]/td[6]/div/select");
        $this->sum=$I->grabTagCount($I, "select option", 3);
        $I->comment($this->sum);        
        $n=1;
        for ($n=1; $n<=$this->sum; $n++){
            $nameSel[$n]=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr/td[6]/div/select/option[$n]");
            $I->comment("Names status: $nameSel[$n]");
        }
        $this->AllNamesStatus = implode(" ", $nameSel);
        $I->comment("$this->AllNamesStatus");
        $kil1=$this->sum+1;
        $I->comment("$kil1");
        for ($k=2; $k<=$kil1; $k++){
            $nameBut[$k]=$I->grabTextFrom(".//*[@id='mainContent']/div[1]/form/section/div[2]/div/a[$k]");
            $I->comment("$nameBut[$k]");
        }
        $NamesStatusButton = implode(" ", $nameBut);
        $I->comment("$NamesStatusButton");
        $I->assertEquals($NamesStatusButton, $this->AllNamesStatus);
    }    
    
    
    public function ICMS_1489_ValuesOfAllStatusesInSelectMenuEditCallback(CallbacksTester $I)
    {    
        //Проверка наличия всех названий созданных статусов колбеков в селект меню на странице редактирования колбека
        $I->click(".//*[@id='callbacks_all']/table/tbody/tr/td[3]/a");
        $I->waitForText("Редактирование обратного звонка");
        for ($i=1; $i<=$this->sum; $i++){
            $nameEdit[$i]=$I->grabTextFrom(".//*[@id='editCallbackForm']/div[1]/div/select/option[$i]");
            $I->comment("$nameEdit[$i]");
        }
        $NamesStatusEdit = implode(" ", $nameEdit);
        $I->comment($NamesStatusEdit);
        $I->assertEquals($NamesStatusEdit, $this->AllNamesStatus);
        InitTest::ClearAllCach($I);
    }
    
    
    public function ICMS_1489_ValuesOfAllStatusesInListLandingStatuses(CallbacksTester $I)
    {    
        //Проверка наличия всех названий созданных статусов колбеков на странице "Статусы обратных звонков"
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $rowsSt=$I->grabTagCount($I, "tbody tr");
        $I->comment($rowsSt);
        for ($j=1; $j<=$rowsSt; $j++){
            $name[$j]=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$j]/td[2]/a");//           
            $I->comment("$name[$j]");            
        }
        $nameImp = implode(" ", $name);
        $I->comment("$nameImp");
        $I->assertEquals($nameImp, $this->AllNamesStatus);
        $I->assertEquals($this->sum, $rowsSt);
    }    
                
    
    public function DeleteNotDefaultStatus(CallbacksTester $I)
    {
        //Удаление статуса не отмеченного по умолчанию
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->comment((string)$this->j);
        $I->comment((string)$this->rows);
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
//        $I->waitForElementVisible("alert.in.fade.alert-success");
//        $I->See("Статус был удален");
//        $I->waitForElementNotVisible("alert.in.fade.alert-success");
        $I->wait(2);
        $this->rows--;
        $rowsAfterDelete = $I->grabTagCount($I,"tbody tr");
        $I->comment($rowsAfterDelete);
        $I->assertEquals($rowsAfterDelete, $this->rows);
        for ($k=1; $k<=$this->rows; $k++){
                    $noId=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$k]/td[1]");
                    $I->comment("$noId");

                    if($noId == $idDeleteStatus){
                    $I->fail("NOT DELETED");
                    break;
                    }   
        }
        InitTest::ClearAllCach($I);
    }
    
    
    
     
}