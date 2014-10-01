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
        $template="2";
        $amount="2";
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount);      
        $price="1.300,00";                
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->wait('10');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($SYMBOL, $price);
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
        $template="3";
        $amount="4";
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount);      
        $price="1 300,0000";               
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($SYMBOL, $price);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ICMS_1527_Template7Editing(CurrenciesTester\CurrenciesSteps $I)
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
        $template="8";
        $amount="1";
        $I->EditCurrency($this->k, $name=null, $isocode=null, $symbol=null, $rate2, $template, $amount, $notNull='off', $save='saveexit');
        $I->waitForText('Список валют');
        $priceAddit="2.600,0";
        $rate="1";        
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount);
        $I->wait('5');
        $price="1.300,0";                
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($price, $SYMBOL, $priceAddit, $this->ADDITSYM);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template3Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="4";
        $amount="4";        
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template,$amount);
        $I->wait('2');
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount);      
        $price="1 300.0000";
        $priceAddit="2 600.0000";
        $format1="# $SYMBOL";               
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $this->ADDITSYM);
        $I->assertEquals($SecondAddit, $priceAddit);
        $I->CheckProductCart($SYMBOL, $price, $this->ADDITSYM, $priceAddit);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ICMS_1596_Template8Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="9";
        $template1="2";
        $amount="0";
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template1,$amount);
        $I->wait('2');
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount);      
        $price="1 300"; 
        $priceAddit="2.600";              
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($price, $SYMBOL, $this->ADDITSYM, $priceAddit);
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
        $amount="3";        
        $template1="5";
        $amount1="2";
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template1,$amount1);
        $I->wait('2');
        $I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template=null,$amount,$notNull='on');      
        $price="1 300";
        $priceAddit="2,600.00";
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$amount,$notNull='on');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($price, $SYMBOL, $this->ADDITSYM, $priceAddit);
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
    
    public function ICMS_1548_NotNullsTemplateEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
        $rate="1";
        $template="6";
        $amount="3"; 
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template,$amount,$notNull1='on');
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate,$template,$amount,$notNull='on');      
        $price="1650.05";
        $priceAddit="3300.101";        
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount,$notNull='on');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
        InitTest::ClearAllCach($I);
        $I->amOnPage("/");
        $I->fillField(CurrenciesPage::$SearchField, 'товар3');
        $I->waitForElement('//*[@id="suggestions"]');
        $I->wait('2');
        $I->see($price, '//*[@id="suggestions"]/div/ul/li/a/span[3]/span/span/span[1]/span/span[1]');  //Отображение в выпадающем списке в поиске
        $I->see($SYMBOL, '//*[@id="suggestions"]/div/ul/li/a/span[3]/span/span/span[1]/span/span[2]');
        $I->see($priceAddit, '//*[@id="suggestions"]/div/ul/li/a/span[3]/span/span/span[2]/span/span[1]');
        $I->see($this->ADDITSYM, '//*[@id="suggestions"]/div/ul/li/a/span[3]/span/span/span[2]/span/span[2]');
        $I->click(CurrenciesPage::$SearchButton);
        $I->wait('3');
        $FirstMAIN=$I->grabTextFrom(CurrenciesPage::$MainFirstPlace);
        $SecondMAIN=$I->grabTextFrom(CurrenciesPage::$MainSecondPlace);        
        $I->comment("$FirstMAIN"."$SecondMAIN");
        $I->assertEquals($FirstMAIN, $SYMBOL);
        $I->assertEquals($SecondMAIN, $price);
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $this->ADDITSYM);
        $I->assertEquals($SecondAddit, $priceAddit);
        $I->CheckProductCart($SYMBOL, $price, $this->ADDITSYM, $priceAddit);
    }
    
     /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ICMS_1552_NotNulls2TemplateEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j)); 
        $amount="1";
        $template='7';
        $template1='10';
        $price="1650,1";
        $priceAddit="3 300.1";
        $I->EditCurrency($this->k,null,null,null,null,$template1,$amount, $notNull='on');
        $templateText=$I->EditCurrency($j,null,null,null,null,$template,$amount,$notNull='on',$save='saveexit');        
        $I->waitForText('Список валют');        
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $FirstAddit=$I->grabTextFrom(CurrenciesPage::$AdditFirstPlace);
        $SecondAddit=$I->grabTextFrom(CurrenciesPage::$AdditSecondPlace);
        $I->assertEquals($FirstAddit, $priceAddit);
        $I->assertEquals($SecondAddit, $this->ADDITSYM);
        $I->CheckProductCart($SYMBOL, $price, $priceAddit, $this->ADDITSYM);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template10_11Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
//        $rate="1";
        $template="11";
        $template1="12";
        $amount="2";
        $I->EditCurrency($this->k,null,null,null,null,$template1,$amount);
        $I->wait('2');
        $templateText=$I->EditCurrency($j,null,null,null,null,$template,$amount,$notNull='on');      
        $price="1,300"; 
        $priceAddit="2600.00";              
        $I->CheckInFields(null,null,null,null,$templateText,$amount,$notNull='on');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($price, $SYMBOL, $priceAddit, $this->ADDITSYM);
    }
        
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Template12Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $j=$I->SearchMainCurrencyLine();
        $I->comment($j);
        $SYMBOL=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));        
//        $rate="1";
        $template="13";
        $amount="1";        
        $I->EditCurrency($this->k,$name=null,$isocode=null,$symbol=null,$rate=null,$template,$amount);
        $I->wait('2');
        $templateText=$I->EditCurrency($j,$name=null,$isocode=null,$symbol=null,null,$template,$amount);      
        $price="1300,0";
        $priceAddit="2600,0";
        $format1="# $SYMBOL";               
        $I->CheckInFields($name1=null,$isocode=null,$symbol=null,$rate1=null,$templateText,$amount);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->click(CurrenciesPage::$VerifyPricesButton);
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
        $I->CheckProductCart($price, $SYMBOL, $priceAddit,$this->ADDITSYM);
    }
}