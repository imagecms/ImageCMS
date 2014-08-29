<?php
use \CurrenciesTester;

class CurrencyTemplateCest
{
    private  $ADDITSYM, $k;   
    public function Autorization(CurrenciesTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(CurrenciesPage::$URL);
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ProductCreate(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Товар1";
        $price="1300";        
        $I->CreateProduct($name, $price, $j=null);       
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template1Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="1";
        $amount="2";
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens=null,$delimThousands=null,$amount);      
        $price="1.300,00";        
        $format1="$SYMBOL #";
        $delimTens1=",";
        $delimThousands1=".";        
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens1,$delimThousands1,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $SYMBOL);
        $I->assertEquals($SecondMAIN, $price);
    }               
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template2Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="2";
        $amount="4";
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens=null,$delimThousands=null,$amount);      
        $price="1 300,0000";        
        $format1="$SYMBOL #";
        $delimTens1=",";
        $delimThousands1=" ";        
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens1,$delimThousands1,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $SYMBOL);
        $I->assertEquals($SecondMAIN, $price);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ICMS_1527_Template3Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");        
        if ($j<$rows){
            $this->k=$j+1;
            $I->click(CurrenciesPage::ActiveButtonLine($this->k));
        }
        else{
            $this->k=$j-1;
            $I->click(CurrenciesPage::ActiveButtonLine($this->k));
        }
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($this->k), "class");
        $I->comment("$butActiveClass");
        $I->assertEquals($butActiveClass, 'prod-on_off');
        $this->ADDITSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($this->k));        
        $ROWADDIT=  $this->k;
        $I->comment("Addit Symbol: $this->ADDITSYM");        
        $I->comment("Row Addit: $ROWADDIT");
        $rate2="2";
        $template="3";
        $amount="1";
        $I->EditCurrency($this->k, $name=null, $isocode=null, $symbol=null, $rate2, $template, $format=null, $delimTens=null, $delimThousands=null, $amount, $notNull='off', $save='saveexit');
        $I->waitForText('Список валют');
        $priceAddit="2.600,0";
        $rate="1";        
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens=null,$delimThousands=null,$amount);      
        $price="1.300,0";        
        $format1="# $SYMBOL";
        $delimTens1=",";
        $delimThousands1=".";        
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens1,$delimThousands1,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $price);
        $I->assertEquals($SecondMAIN, $SYMBOL);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $priceAddit);
        $I->assertEquals($SecondAddit, $this->ADDITSYM);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function DelimitersTemplateEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="3";
        $amount="4";
        $delimTens="_";
        $delimThousands="@";
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template,$format=null,$delimTens1=null,$delimThousands1=null,$amount);
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens,$delimThousands,$amount);      
        $price="1@300_0000";
        $priceAddit="2@600_0000";
        $format1="# $SYMBOL";               
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens,$delimThousands,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $price);
        $I->assertEquals($SecondMAIN, $SYMBOL);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $priceAddit);
        $I->assertEquals($SecondAddit, $this->ADDITSYM);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template4Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="4";
        $template1="1";
        $amount="0";
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template1,$format=null,$delimTens=null,$delimThousands=null,$amount);
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens=null,$delimThousands=null,$amount);      
        $price="1 300"; 
        $priceAddit="2.600";
        $format1="# $SYMBOL";
        $delimTens1=",";
        $delimThousands1=" ";        
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens1,$delimThousands1,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $price);
        $I->assertEquals($SecondMAIN, $SYMBOL);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $this->ADDITSYM);
        $I->assertEquals($SecondAddit, $priceAddit);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function NotNullsEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $format="# $SYMBOL";
        $amount="3";
        $delimTens=".";
        $delimThousands="@";
        $template1="2";
        $amount1="2";
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template1,$format1=null,$delimTens1=null,$delimThousands1=null,$amount1);
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template=null,$format,$delimTens,$delimThousands,$amount,$notNull='on');      
        $price="1@300";
        $priceAddit="2 600,00";
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format,$delimTens,$delimThousands,$amount,$notNull='on');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар1');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $price);
        $I->assertEquals($SecondMAIN, $SYMBOL);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $this->ADDITSYM);
        $I->assertEquals($SecondAddit, $priceAddit);
    }           
        
     /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Product2Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Товар3";
        $price="1650.0504";        
        $I->CreateProduct($name, $price, $j=null);       
    }
    
     /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function NotNullsTemplateEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="4";
        $amount="3"; 
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template,$format=null,$delimTens=null,$delimThousands=null,$amount,$notNull1='on');
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$format=null,$delimTens=null,$delimThousands=null,$amount,$notNull='on');      
        $price="1 650,05";
        $priceAddit="3 300,1";
        $format1="# $SYMBOL";
        $delimTens1=",";
        $delimThousands1=" ";
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$format1,$delimTens1,$delimThousands1,$amount,$notNull='on');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар3');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $price);
        $I->assertEquals($SecondMAIN, $SYMBOL);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $priceAddit);
        $I->assertEquals($SecondAddit, $this->ADDITSYM);
    }
    
     /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function NotNulls2TemplateEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j)); 
        $amount="1";
        $price="1 650,1";
        $I->click(CurrenciesPage::CurrencyNameLine($j));        
        $I->waitForElement('.//*[@id="mod_name"]/label');        
        $I->selectOption(\CurrenciesPage::$CurrencyTemplate, 1);
        $text=$I->grabTextFrom(\CurrenciesPage::$CurrencyTemplate."/option[1]");
        $I->comment($text);               
        $I->selectOption(\CurrenciesPage::$AmountDecimals, $amount);
        $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
        $I->click(\CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPrices);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар3');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $SYMBOL);
        $I->assertEquals($SecondMAIN, $price);
    }
}