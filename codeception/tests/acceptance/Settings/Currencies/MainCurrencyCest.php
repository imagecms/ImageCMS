<?php
use \AcceptanceTester;

class MainCurrencyCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }
    private $j, $butActiveClass, $disable, $atribCheck, $rows;
    
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }   
    
    public function VerifyButtons(AcceptanceTester $I)
    {
        $this->rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$this->rows);
        //Определение строчки главной валюты
        for ($this->j=1;$this->j<$this->rows;++$this->j){
            //Поиск атрибута checked для радиоточки
            $this->atribCheck = $I->grabAttributeFrom("//tbody/tr[$this->j]/td[5]/input","checked");
                if($this->atribCheck == TRUE){
                break;
            }
        }
        //Определяем класс кнопки-переключателя у главной валюты

        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        //Проверяем активность кнопки удаления напротив главной валюты
        $this->disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($this->j), "disabled");
        codecept_debug($this->disabled);
               $I->assertEquals($this->disabled, 'true');  
    }
    
    public function DeleteMainCur(AcceptanceTester $I)
    {
        $I->click(CurrenciesPage::DeleteButtonLine($this->j));
        $I->wait('3');
        $I->dontSeeElement(".//div[@class='modal hide fade in']");  
    }
    
      public function VerifyCheckAdditCur(AcceptanceTester $I)
    {
         
        //Проверяем возможность отметить дополнительную валюту напротив главной
        $I->assertEquals($this->butActiveClass, 'prod-on_off disable_tovar');

        {   $I->click(CurrenciesPage::ActiveButtonLine($this->j));
            $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
            $I->comment("$this->butActiveClass");
            $I->assertEquals($this->butActiveClass, 'prod-on_off disable_tovar');

        //Проверяем активность кнопки удаления после нажатия на кнопку-переключатель
        $this->disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($this->j), "disabled");
        $I->assertEquals($this->disabled, 'true');
        } 
    }
                
    public function VerifyCheckMainCur(AcceptanceTester $I)
    {
        //Проверка снятия отметки главной валюты
        $I->click(CurrenciesPage::RadioButtonLine($this->j));
        $this->atribCheck = $I->grabAttributeFrom("//tbody/tr[$this->j]/td[5]/input","checked");
        $I->assertEquals($this->atribCheck, 'true');

        //Проверка переключения главной валюты и проверка количества отметок главных валют
        if($this->j<$this->rows){
            $this->j++;
            $I->click(CurrenciesPage::RadioButtonLine($this->j));
        }
        else{
            $this->j--;
            $I->click(CurrenciesPage::RadioButtonLine($this->j));
        }
        $true = 0;
        for ($k=1;$k<=$this->rows;++$k)
        {
            $grabbedAttrib = $I->grabAttributeFrom(CurrenciesPage::RadioButtonLine($k), "checked"); 
            $I->comment("$grabbedAttrib");
            if($grabbedAttrib == "true"){
                 $true++;
            }
        }
        $I->assertEquals($true, '1');
    }
    
    public function VerifyCheckMainAdditCur(AcceptanceTester $I)
    {   //Проверяем возможность отметить главную валюту напротив дополнительной и проверка отметки дополнительной валюты напротив не главной
        if ($this->j<$this->rows){
            $this->j++;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        else{
            $this->j--;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_off');
        $I->click(CurrenciesPage::RadioButtonLine($this->j));
        $I->wait('1');
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_off disable_tovar');        
    }
    
    public function VerifyAdditCurOff(AcceptanceTester $I)
    {   //Проверяем возможность снятия отметки дополнительной валюты
        if ($this->j<$this->rows){
            $this->j++;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        else{
            $this->j--;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_off');
        $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        $I->wait('1');
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_off disable_tovar');
        InitTest::ClearAllCach($I);
        $I->wait('1');
    }
    
    public function DeleteAdditCur(AcceptanceTester $I)
    {   //Проверяем возможность снятия отметки дополнительной валюты
        $I->comment("$this->j");
        $I->wait('5');
        if ($this->j<$this->rows){
            $this->j++;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        else{
            $this->j--;
            $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        }
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_off');
        $I->click(CurrenciesPage::DeleteButtonLine($this->j));      
        $I->waitForElement(".//div[@class='modal hide fade in']");
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', './/*[@id="first"]/div[3]/a[1]');
        $I->see('Отменить', './/*[@id="first"]/div[3]/a[2]');
        $I->click('.//*[@id="first"]/div[3]/a[1]');
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта успешно удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $rowsBeforeDel = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rowsBeforeDel);
        
    }
    
}
    
    
    

