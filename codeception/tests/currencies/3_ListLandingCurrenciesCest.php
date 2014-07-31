<?php
use \CurrenciesTester;

class MainCurrencyCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }
    private $j, $butActiveClass, $disabled, $atribCheck, $rows, $MainCurSymb, $price, $MAINSYM, $MAINISO, $ROWMAIN, $ROWADDIT, $ADDITSYM;
    
    public function Autorization(CurrenciesTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }   
    
    
    public function NamesInListLanding(CurrenciesTester $I)
    {
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul/li[2]/a');
        // $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul'==FALSE)
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
        $I->waitForText('Список валют');
        $I->see('Список валют', 'span.title');
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
        
    
    public function VerifyButtons(CurrenciesTester $I)
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
    
    
    public function DeleteMainCur(CurrenciesTester $I)
    {
        //Проверка возможности удаления главной валюты
        $I->click(CurrenciesPage::DeleteButtonLine($this->j));
        $I->wait('3');
        $I->dontSeeElement(".//div[@class='modal hide fade in']");
        InitTest::ClearAllCach($I);
    }
    
    
    public function FrontMainCurInProduct(CurrenciesTester $I)
    {
        //Отображение цены и символа главной валюты на странице сайта
        $symbMainCur=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[4]");
        $isoMainCur=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[3]");
        $I->comment("Symbol Main Currency on CurrencyList: $symbMainCur");
        $I->comment("ISO Code Main Currency on CurrencyList: $isoMainCur");
        $I->click(CurrenciesPage::CurrencyNameLine($this->j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->waitForText('Создание товара');
        $price=200;
        $I->fillField('.//*[@id="Name"]', 'Товар4');
        $I->fillField(".//*[@id='ProductVariantRow_0']/td[2]/input", "$price");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/select");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/select/option[$this->j]");
        $I->wait('1');
        $IsoProduct=$I->grabTextFrom(".//*[@id='ProductVariantRow_0']/td[3]/select/option[$this->j]");
        $I->comment("$IsoProduct");
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForText("Продукт был успешно создан");
        $I->assertEquals($IsoProduct, $isoMainCur);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар4');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $k=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");        
        $I->comment("$k", "$sym");
        $I->assertEquals($k, $price);
        $I->assertEquals($sym, $symbMainCur);        
    }
    
    
    public function VerifyCheckAdditCur(CurrenciesTester $I)
    {
        $I->amOnPage("/admin/components/run/shop/currencies");
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
    
                
    public function VerifyCheckMainCur(CurrenciesTester $I)
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
    
    
    public function VerifyCheckMainAdditCur(CurrenciesTester $I)
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
        $this->MAINSYM=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[4]");
        $this->MAINISO=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[3]");        
        $I->comment("Main Symbol: $this->MAINSYM");
        $I->comment("Main ISO: $this->MAINISO");
        $this->ROWMAIN=$this->j;
        $I->comment("Row Main: $this->ROWMAIN");
        $I->click(CurrenciesPage::CurrencyNameLine($this->j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
    }
    
    
    public function VerifyAdditCurAndMainInProductFront(CurrenciesTester $I)
    {   
        //Проверяем отображение цены в главной и дополнительной валютах на странице сайта
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
        $this->ADDITSYM=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[4]");
        $ADDITISO=$I->grabTextFrom(".//*[@class='']/tr[$this->j]/td[3]");
        $this->ROWADDIT=$this->j;
        $I->comment("Addit Symbol: $this->ADDITSYM");
        $I->comment("Addit ISO: $ADDITISO");
        $I->comment("Row Addit: $this->ROWADDIT");
        $I->click(CurrenciesPage::CurrencyNameLine($this->j));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '4');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->waitForText('Создание товара');
        $price=300;
        $I->fillField('.//*[@id="Name"]', 'Товар5');
        $I->fillField(".//*[@id='ProductVariantRow_0']/td[2]/input", "$price");        
        $I->wait('1');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForText("Продукт был успешно создан");        
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар5');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $kMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $symMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");        
        $I->comment("$kMAIN"."$symMAIN");
        $I->assertEquals($kMAIN, $price);
        $I->assertEquals($symMAIN, $this->MAINSYM);
        $kADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[1]");
        $symADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[2]");
        $i=$price*4;
        $I->comment("$kADDIT", "$symADDIT");
        $I->assertEquals($kADDIT, $i);
        $I->assertEquals($symADDIT, $this->ADDITSYM);
    }
    
    
    public function ChangeMainAndAdditCurInProductFront(CurrenciesTester $I)
    {  
        //Проверяем отображение цены товара на странице сайта после смены главной и дополнительной валюты (смены местами)
        $I->amOnPage("/admin/components/run/shop/currencies");
        InitTest::ClearAllCach($I);
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
        $I->click(CurrenciesPage::$VerifyPrices);
        $I->wait('2');
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар5');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $price=300*4;
        $kMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $symMAIN=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");        
        $I->comment("$kMAIN"."$symMAIN");
        $I->assertEquals($kMAIN, $price);
        $I->assertEquals($symMAIN, $this->ADDITSYM);
        $kADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[1]");
        $symADDIT=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span[2]/span/span[2]");
        $i=$price/4;
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
        
    
    public function VerifyAdditCurOff(CurrenciesTester $I)
    {  
        //Проверяем возможность снятия отметки дополнительной валюты
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::ActiveButtonLine($this->j));
        $I->wait('1');
        $this->butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->j), "class");
        $this->butActiveClass=  str_replace(array(' '),"",$this->butActiveClass);
        $I->comment("$this->butActiveClass");
        $I->assertEquals($this->butActiveClass, 'prod-on_offdisable_tovar');
        InitTest::ClearAllCach($I);
        $I->wait('1');
    }
    
    
    public function DeleteAdditCur(CurrenciesTester $I)
    {   
        //Проверяем возможность удаления дополнительной валюты
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
        InitTest::ClearAllCach($I);
    }
    
    
    public function DeleteCurUsedInProducts(CurrenciesTester $I)
    {   
        //Проверка возможности удаления валюты, которая используется в товарах
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::RadioButtonLine('1'));
        $I->wait('1');
        $IsoCur=$I->grabTextFrom(".//*[@class='']/tr[3]/td[3]");
        $id=$I->grabTextFrom(".//*[@class='']/tr[3]/td[1]");
        $SymbCur=$I->grabTextFrom(".//*[@class='']/tr[3]/td[4]");
        $I->comment("$IsoCur"); 
        $I->comment("$id");
        $I->comment("$SymbCur");
        $MainCurIso=$I->grabTextFrom(".//*[@class='']/tr[1]/td[3]");
        $this->MainCurSymb=$I->grabTextFrom(".//*[@class='']/tr[1]/td[4]");
        $I->comment("$MainCurIso");
        $I->comment("$this->MainCurSymb");        
        $I->click(CurrenciesPage::CurrencyNameLine('1'));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::CurrencyNameLine('3'));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '2');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->waitForText('Создание товара');
        $this->price=100;
        $I->fillField('.//*[@id="Name"]', 'Товар2');
        $I->fillField(".//*[@id='ProductVariantRow_0']/td[2]/input", "$this->price");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/select");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/select/option[3]");
        $I->wait('1');
        $IsoProduct=$I->grabTextFrom(".//*[@id='ProductVariantRow_0']/td[3]/select/option[3]");
        $I->comment("$IsoProduct");
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForText("Продукт был успешно создан");
        $I->assertEquals($IsoProduct, $IsoCur);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар2');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $k=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");
        $i=$k*2;
        $I->comment("$i", "$k", "$sym");
        $I->assertEquals($i, $this->price);
        $I->assertEquals($sym, $this->MainCurSymb);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::CurrencyNameLine('3'));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '4');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
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
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::DeleteButtonLine('3'));
        $I->waitForElement(".//div[@class='modal hide fade in']");
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', './/*[@id="first"]/div[3]/a[1]');
        $I->see('Отменить', './/*[@id="first"]/div[3]/a[2]');
        $I->click('.//*[@id="first"]/div[3]/a[1]');
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
        $I->click(CurrenciesPage::DeleteButtonLine('3'));
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
    
    
    public function VerifyProductFrontAfterDeleteProdCurrency(CurrenciesTester $I)
    {   
        //Проверка отображения цены товара после удаления валюты, в которой была указана его цена
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(".//*[@id='inputString']", 'товар2');
        $I->click("html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button");
        $I->wait('1');
        $k2=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]");
        $sym2=$I->grabTextFrom(".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]");
        $i2=$k2*4;
        $I->comment("$i2");
        $I->comment("$k2");
        $I->comment("$sym2");
        $I->assertEquals($i2, $this->price);
        $I->assertEquals($sym2, $this->MainCurSymb);
    }
    
    
    public function DeleteCurUsedInPaymentMethods(CurrenciesTester $I)
    {   
        //Проверка возможности удаления валюты, которая используется в способах оплаты
        $I->amOnPage("/admin/components/run/shop/currencies");        
        $SymbolCur=$I->grabTextFrom(".//*[@class='']/tr[4]/td[4]");
        $id=$I->grabTextFrom(".//*[@class='']/tr[4]/td[1]");
        $I->comment("$SymbolCur"); 
        $I->comment("$id");
        $I->amOnPage('/admin/components/run/shop/paymentmethods/create');
        $I->waitForText('Создание способа оплаты');
        $I->fillField(PaymentCreatePage::$FieldName, 'Оплата');        
        $I->click(PaymentCreatePage::$SelectCurrency);
        $I->click(PaymentCreatePage::SelectCurrency('4'));
        $I->wait('1');
        $SelectCur=$I->grabTextFrom(PaymentCreatePage::SelectCurrency('4'));        
        $I->comment("$SelectCur"); 
        $SelectCur = trim(preg_replace("/\s+/", " ", $SelectCur));
        $Cur= explode(" ", $SelectCur);  
        foreach ($Cur as $key =>$value) {
            if($value)  $I->comment("$key: $value");
        }      
        $text=$Cur[2];
        $I->comment($text);
        $I->click(PaymentCreatePage::$ButtonCreate);
        $I->waitForText("Способ оплаты создан");
        $I->assertEquals($SymbolCur, $text);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->click(CurrenciesPage::DeleteButtonLine('4'));
        $I->waitForElement(".//div[@class='modal hide fade in']");
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', './/*[@id="first"]/div[3]/a[1]');
        $I->see('Отменить', './/*[@id="first"]/div[3]/a[2]');
        $I->click('.//*[@id="first"]/div[3]/a[1]');
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Невозможно удалить валюту. Эта валюта используется в Способах оплаты.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->amOnPage('/admin/components/run/shop/paymentmethods/index');
        $I->click(PaymentListPage::CheckboxLine('last()'));
        $I->wait('2');
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForElement(".//*[@id='mainContent']/div/div[1]");
        $I->wait('1');
        $I->click(".//*[@id='mainContent']/div/div[1]/div[3]/a[1]");
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Способ оплаты удален');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->amOnPage("/admin/components/run/shop/currencies");
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
            $I->comment($idAfter);
            if($idAfter == $id){
                $I->fail("NOT DELETED");
                break;
            } 
        }
        InitTest::ClearAllCach($I);
    }
}
    
    
    

