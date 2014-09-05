<?php
use \CurrenciesTester;

class CurrencyListCest
{
    private  $MainCurSymb, $price, $MAINSYM, $MAINISO, $ROWMAIN, $ROWADDIT, $ADDITSYM;
    public function Autorization(CurrenciesTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }   
    
    
    public function NamesInListLanding(CurrenciesTester $I)
    {
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul/li[2]/a');        
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
        $I->waitForText('Список валют');
        $I->see('Список валют', ".//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
        $I->see('ID', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[1]');
        $I->see('Название', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[2]');
        $I->see('ISO Код', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[3]');
        $I->see('Символ', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[4]');
        $I->see('Главная', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[5]');
        $I->see('Дополнительная валюта', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[6]');
        $I->see('Удалить', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[7]');
        $I->see('Проверить цены', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button');
        $I->see('Создать валюту', CurrenciesPage::$CreateCurrencyButton);
    } 
        
     /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function VerifyButtons(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        //Определяем класс кнопки-переключателя у главной валюты
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("$butActiveClass");
        //Проверяем активность кнопки удаления напротив главной валюты
        $disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($j), "disabled");
        codecept_debug($disabled);
               $I->assertEquals($disabled, 'true');  
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function DeleteMainCur(CurrenciesTester\CurrenciesSteps $I)
    {
        //Проверка возможности удаления главной валюты
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $I->click(CurrenciesPage::DeleteButtonLine($j));
        $I->wait('3');
        $I->dontSeeElement(".//div[@class='modal hide fade in']");
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function FrontMainCurInProduct(CurrenciesTester\CurrenciesSteps $I)
    {
        //Отображение цены и символа главной валюты на странице сайта
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $symbMainCur=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
        $isoMainCur=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($j));
        $I->comment("Symbol Main Currency on CurrencyList: $symbMainCur");
        $I->comment("ISO Code Main Currency on CurrencyList: $isoMainCur");
        $I->click(CurrenciesPage::CurrencyNameLine($j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $name="Товар4";
        $price="200";        
        $IsoProduct=$I->CreateProduct($name, $price, $j);
        $I->assertEquals($IsoProduct, $isoMainCur);
        $I->amOnPage("/");
        $I->wait('2');
        $I->fillField(".//*[@id='inputString']", 'товар4');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $k=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");        
        $I->comment("$k", "$sym");
        $I->assertEquals($k, $price.",00");
        $I->assertEquals($sym, $symbMainCur);        
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function VerifyCheckAdditCur(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        //Определяем класс кнопки-переключателя у главной валюты
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("Additional Currency Button: $butActiveClass");
        //Проверяем возможность отметить дополнительную валюту напротив главной
        $I->assertEquals($butActiveClass, 'prod-on_off disable_tovar');
        $I->click(CurrenciesPage::ActiveButtonLine($j));
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("Additional Currency Button After Check On Main: $butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off disable_tovar');
        //Проверяем активность кнопки удаления после нажатия на кнопку-переключатель
        $disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($j), "disabled");
        $I->assertEquals($disabled, 'true');         
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function VerifyCheckMainCur(CurrenciesTester\CurrenciesSteps $I)
    {
        //Проверка снятия отметки главной валюты
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $I->click(CurrenciesPage::RadioButtonLine($j));
        $atribCheck = $I->grabAttributeFrom(CurrenciesPage::RadioButtonLine($j),"checked");
        $I->assertEquals($atribCheck, 'true');

        //Проверка переключения главной валюты и проверка количества отметок главных валют
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");
        if($j<$rows){
            $j++;
            $I->click(CurrenciesPage::RadioButtonLine($j));
        }
        else{
            $j--;
            $I->click(CurrenciesPage::RadioButtonLine($j));
        }
        $true = 0;
        for ($k=1;$k<=$rows;++$k)
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
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function VerifyCheckMainAdditCur(CurrenciesTester\CurrenciesSteps $I)
    {   //Проверяем возможность отметить главную валюту напротив дополнительной и проверка отметки дополнительной валюты напротив не главной
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");
        if ($j<$rows){
            $j++;
            $I->click(CurrenciesPage::ActiveButtonLine($j));
        }
        else{
            $j--;
            $I->click(CurrenciesPage::ActiveButtonLine($j));
        }
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off');
        $I->click(CurrenciesPage::RadioButtonLine($j));
        $I->wait('1');
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off disable_tovar');
        $this->MAINSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
        $MAINISO=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($j));        
        $I->comment("Main Symbol: $this->MAINSYM");
        $I->comment("Main ISO: $MAINISO");
        $this->ROWMAIN=$j;
        $I->comment("Row Main: $this->ROWMAIN");
        $I->click(CurrenciesPage::CurrencyNameLine($j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function  ICMS_1510_VerifyAdditCurAndMainInProductFront(CurrenciesTester\CurrenciesSteps $I)
    {   
        //Проверяем отображение цены в главной и дополнительной валютах на странице сайта
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $this->MAINSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");        
        if ($j<$rows){
            $k=$j+1;
            $I->click(CurrenciesPage::ActiveButtonLine($k));
        }
        else{
            $k=$j-1;
            $I->click(CurrenciesPage::ActiveButtonLine($k));
        }
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($k), "class");
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off');
        $this->ADDITSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($k));
        $ADDITISO=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($k));
        $this->ROWADDIT=$k;
        $I->comment("Addit Symbol: $this->ADDITSYM");
        $I->comment("Addit ISO: $ADDITISO");
        $I->comment("Row Addit: $this->ROWADDIT");
        $I->click(CurrenciesPage::CurrencyNameLine($k));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '4');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
//        $I->wait('6');
        $I->click(CurrenciesPage::$VerifyPrices);
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
//        $I->see('Цены обновлены');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name="Товар5";
        $price="300";         
        $I->CreateProduct($name, $price, $j);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар5');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('3');
        $kMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $symMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");        
        $I->comment("$kMAIN"."$symMAIN");
        $I->assertEquals($kMAIN, $price.",00");
        $I->assertEquals($symMAIN, $this->MAINSYM);
        $kADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[1]");
        $symADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[2]");
        $i=$price*4;
        $I->comment("$kADDIT", "$symADDIT");
        $I->assertEquals($kADDIT, $i);
        $I->assertEquals($symADDIT, $this->ADDITSYM);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ChangeMainAndAdditCurInProductFront(CurrenciesTester\CurrenciesSteps $I)
    {  
        //Проверяем отображение цены товара на странице сайта после смены главной и дополнительной валюты (смены местами)        
        InitTest::ClearAllCach($I);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->click(CurrenciesPage::RadioButtonLine($this->ROWADDIT));
        $I->click(CurrenciesPage::CurrencyNameLine($this->ROWADDIT));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::ActiveButtonLine($this->ROWMAIN));
        $I->click(CurrenciesPage::CurrencyNameLine($this->ROWMAIN));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '0.25');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
//        $I->wait('6');
        $I->click(CurrenciesPage::$VerifyPrices);        
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
//        $I->see('Цены обновлены');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар5');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('3');
        $price=300*4;
        $price1='1.200';
        $I->comment((string)$price);
        $kMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $symMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$kMAIN"."$symMAIN");
        $I->assertEquals($kMAIN, $price1.",00");
        $I->assertEquals($symMAIN, $this->ADDITSYM);
        $kADDIT=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $symADDIT=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $i=$price/4;
        $I->comment("Addit price:$i");
        $I->comment("$kADDIT", "$symADDIT");
        $I->assertEquals($kADDIT, $i);
        $I->assertEquals($symADDIT, $this->MAINSYM);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::RadioButtonLine($this->ROWMAIN));
        $I->click(CurrenciesPage::CurrencyNameLine($this->ROWMAIN));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::ActiveButtonLine($this->ROWADDIT));
        $I->click(CurrenciesPage::CurrencyNameLine($this->ROWADDIT));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '4');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        $I->wait('2');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function VerifyAdditCurOff(CurrenciesTester\CurrenciesSteps $I)
    {  
        //Проверяем возможность снятия отметки дополнительной валюты
        $I->amOnPage(CurrenciesPage::$URL);
        $I->click(CurrenciesPage::ActiveButtonLine($this->ROWADDIT));
        $I->wait('1');
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->ROWADDIT), "class");
        $butActiveClass=  str_replace(array(' '),"",$butActiveClass);
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_offdisable_tovar');
        InitTest::ClearAllCach($I);
        $I->wait('1');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function DeleteAdditCur(CurrenciesTester\CurrenciesSteps $I)
    {   
        //Проверяем возможность удаления дополнительной валюты
        $j=$I->SearchMainCurrencyLine();        
        $rows = $I->grabTagCount($I,"tbody tr");        
        $I->comment("Main row:$j");
        $I->comment("Rows:$rows");
        $I->wait('5');
        if ($j<$rows){
            $j++;
            $I->click(CurrenciesPage::ActiveButtonLine($j));
        }
        else{
            $j--;
            $I->click(CurrenciesPage::ActiveButtonLine($j));
        }
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off');
        $I->DeleteWindowOperation($j);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта успешно удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $rowsAfterDel = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rowsAfterDel);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function DeleteCurUsedInProducts(CurrenciesTester\CurrenciesSteps $I)
    {   
        //Проверка возможности удаления валюты, которая используется в товарах
        $I->amOnPage("/admin/components/run/shop/currencies");
        $j=2;
        $I->click(CurrenciesPage::RadioButtonLine($j));
        $I->wait('1');
        $y=3;
        $IsoCur=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($y));
        $id=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($y));
        $SymbCur=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($y));
        $I->comment("$IsoCur"); 
        $I->comment("$id");
        $I->comment("$SymbCur");
        $MainCurIso=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($j));
        $this->MainCurSymb=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
        $I->comment("$MainCurIso");
        $I->comment("$this->MainCurSymb");        
        $I->click(CurrenciesPage::CurrencyNameLine($j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::CurrencyNameLine($y));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '2');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $name="Товар2";
        $this->price="100";        
        $IsoProduct=$I->CreateProduct($name, $this->price, $y);
        $I->assertEquals($IsoProduct, $IsoCur);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар2');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('3');
        $k=$I->grabTextFrom('//*[@id="items-catalog-main"]/li[1]/div[1]/div[2]/span/span[1]/span/span[1]');
        $sym=$I->grabTextFrom('//*[@id="items-catalog-main"]/li[1]/div[1]/div[2]/span/span[1]/span/span[2]');
        $i=$k*2;
        $I->comment("$i", "$k", "$sym");
        $I->assertEquals($i.",00", $this->price.",00");
        $I->assertEquals($sym, $this->MainCurSymb);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->click(CurrenciesPage::CurrencyNameLine($y));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '4');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->wait('6');
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
//        $I->see('Изменения сохранены');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->click(CurrenciesPage::$VerifyPrices);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Цены обновлены', '.alert.in.fade.alert-success');
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар2');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $k3=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym3=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");
        $i3=$k3*4;
        $I->comment("$i3", "$k3", "$sym3");
        $I->assertEquals($i3, $this->price);
        $I->assertEquals($sym, $this->MainCurSymb);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->DeleteWindowOperation($y);
        $I->waitForElement(".//*[@id='recount']");
        $I->wait('1');
        $I->see('Пересчет');
        $I->see('Валюта используется в товарах. Пересчитать?');
        $I->see('Пересчитать', ".//*[@id='recount']/div[3]/a[1]");
        $I->see('Отменить', ".//*[@id='recount']/div[3]/a[2]");
        $I->click(".//*[@id='recount']/div[3]/a[1]");
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Преобразование завершено. Сейчас валюта может быть удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->DeleteWindowOperation($y);   
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта успешно удалена');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->wait('2');
        $rows = $I->grabTagCount($I,"tbody tr");
        for ($i=1; $i<=$rows; $i++){
            $idAfter = $I->grabTextFrom(CurrenciesPage::IdCurrencyLine($i));
            $I->comment($idAfter);
            if($idAfter == $id){
                $I->fail("NOT DELETED");
                break;
            } 
        }
        $I->click(CurrenciesPage::$VerifyPrices);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Цены обновлены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
    }
    
    
    public function  ICMS_1509_VerifyProductFrontAfterDeleteProdCurrency(CurrenciesTester $I)
    {   
        //Проверка отображения цены товара после удаления валюты, в которой была указана его цена
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар2');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('3');
        $k2=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym2=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");
        $i2=$k2*4;
        $I->comment("$i2");
        $I->comment("$k2");
        $I->comment("$sym2");
        $I->assertEquals($i2.",00", $this->price.",00");
        $I->assertEquals($sym2, $this->MainCurSymb);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function DeleteCurUsedInPaymentMethods(CurrenciesTester\CurrenciesSteps $I)
    {   
        //Проверка возможности удаления валюты, которая используется в способах оплаты
        $I->amOnPage("/admin/components/run/shop/currencies");
        $y=4;
        $SymbolCur=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($y));
        $id=$I->grabTextFrom(CurrenciesPage::IdCurrencyLine($y));
        $I->comment("$SymbolCur"); 
        $I->comment("$id");
        $I->amOnPage(PaymentCreatePage::$URL);
        $I->waitForText('Создание способа оплаты');
        $I->fillField(PaymentCreatePage::$FieldName, 'Оплата');        
        $I->click(PaymentCreatePage::$SelectCurrency);
        $I->click(PaymentCreatePage::SelectCurrency($y));
        $I->wait('1');
        $SelectCur=$I->grabTextFrom(PaymentCreatePage::SelectCurrency($y));        
        $I->comment("$SelectCur"); 
        $SelectCur = trim(preg_replace("/\s+/", " ", $SelectCur));
        $Cur= explode(" ", $SelectCur);  
        foreach ($Cur as $key =>$value) {
            if($value)  $I->comment("$key: $value");
        }      
        $text=$Cur[2];
        $I->comment($text);
        $I->click(PaymentCreatePage::$ButtonCreate);
        $I->waitForText("Редактирование способа оплаты");
        $I->assertEquals($SymbolCur, $text);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->DeleteWindowOperation($y);
        $I->exactlySeeAlert($I, 'error', 'Невозможно удалить валюту. Эта валюта используется в Способах оплаты.');
        //$I->waitForElementVisible('.alert.in.fade.alert-error');
//        $I->waitForText('Невозможно удалить валюту. Эта валюта используется в Способах оплаты.', 3);
        //$I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->amOnPage(PaymentListPage::$URL);
        $I->click(PaymentListPage::CheckboxLine('last()'));
        $I->wait('2');
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForElement(".//*[@id='mainContent']/div/div[1]");
        $I->wait('1');
        $I->click(".//*[@id='mainContent']/div/div[1]/div[3]/a[1]");
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Способ оплаты удален');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->amOnPage(CurrenciesPage::$URL);
        $I->DeleteWindowOperation($y);   
        $I->waitForElementNotVisible(CurrenciesPage::$DeleteWindow);
        $I->wait(2);
//        $I->exactlySeeAlert($I, 'success', 'Валюта успешно удалена','100');
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
//        $I->see('Валюта успешно удалена');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $rows = $I->grabTagCount($I,"tbody tr");
        for ($j=1; $j<=$rows; $j++){
            $idAfter = $I->grabTextFrom(CurrenciesPage::IdCurrencyLine($j));
            $I->comment($idAfter);
            if($idAfter == $id){
                $I->fail("NOT DELETED");
                break;
            } 
        }
        InitTest::ClearAllCach($I);
    }
}