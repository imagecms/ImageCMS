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
        InitTest::ClearAllCach($I);
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
        InitTest::ClearAllCach($I);
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
        InitTest::ClearAllCach($I);
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
        $rowsAfterDel = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rowsAfterDel);        
    }
    
    
    public function DeleteCurUsedInProducts(AcceptanceTester $I)
    {   
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::RadioButtonLine('1'));
        $I->wait('1');
        $SymbolCur=$I->grabTextFrom(".//*[@id='currency_tr4']/td[3]");
        $id=$I->grabTextFrom(".//*[@id='currency_tr4']/td[1]");
        $I->comment("$SymbolCur"); 
        $I->comment("$id");
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->fillField('.//*[@id="Name"]', 'Товар');
        $I->fillField(".//*[@id='ProductVariantRow_0']/td[2]/input", '100');
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/div/a/span");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/div/div/ul/li[3]");
        $SymbProduct=$I->grabTextFrom(".//*[@id='ProductVariantRow_0']/td[3]/div/div/ul/li[3]");
        $I->comment("$SymbProduct");
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForText("Продукт был успешно создан");
        $I->assertEquals($SymbProduct, $SymbolCur);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::DeleteButtonLine('4'));
        $I->waitForElement(".//div[@class='modal hide fade in']");
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', './/*[@id="first"]/div[3]/a[1]');
        $I->see('Отменить', './/*[@id="first"]/div[3]/a[2]');
        $I->click('.//*[@id="first"]/div[3]/a[1]');
        $I->waitForElement(".//*[@id='recount']");
        $I->see('Пересчет');
        $I->see('Валюта используется в товарах. Пересчитать?');
        $I->see('Пересчитать', ".//*[@id='recount']/div[3]/a[1]");
        $I->see('Отменить', ".//*[@id='recount']/div[3]/a[2]");
        $I->click(".//*[@id='recount']/div[3]/a[1]");
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Преобразование завершено. Сейчас валюта может быть удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->click(CurrenciesPage::DeleteButtonLine('4'));
        $I->waitForElement(".//div[@class='modal hide fade in']");
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', './/*[@id="first"]/div[3]/a[1]');
        $I->see('Отменить', './/*[@id="first"]/div[3]/a[2]');
        $I->click('.//*[@id="first"]/div[3]/a[1]');
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта успешно удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $rows = $I->grabTagCount($I,"tbody tr");
        for ($j=1; $j<=$rows; $j++){
            $idAfter = $I->grabTextFrom("//tbody/tr[$j]/td[1]");
            $I->comment($symbAfter);
            if($idAfter == $id){
                $I->fail("NOT DELETED");
                break;
            } 
        }
        InitTest::ClearAllCach($I);
    }
    
}
    
    
    

