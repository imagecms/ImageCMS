<?php
use \ProductsTester;

class CreateProductCest
{
    private $AllSymbolsCur, $MAINSYM, $AllIsoCur, $MainIso, $Cat;
    public function Autorization(ProductsTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(ProductsPage::$URL);
        $I->waitForText("Отменить фильтрацию", "10", ProductsPage::$CancelFilterButton);
    }
    
    
    public function NamesInCreate(ProductsTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $kil=$I->grabClassCount($I, "btn btn-small btn-danger");
        $I->comment($kil);
        for ($j=1; $j<=$kil; $j++){
            $IsoCurAll[$j]=$I->grabTextFrom(".//*[@class='']/tr[$j]/td[3]");
            $I->comment("$IsoCurAll[$j]");
        }
        for ($i=1; $i<=$kil; $i++){
           $atribCheck = $I->grabAttributeFrom("//tbody/tr[$i]/td[5]/input","checked");
                if($atribCheck == TRUE){
                break;
            }
        }
        $mainIsoCur=$I->grabTextFrom(".//*[@class='']/tr[$i]/td[3]");
        $I->comment("Main ISO Code: $mainIsoCur");
        
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $value) {
                $I->comment("$value");                
            }            
        $AllCat=  implode("_", $text);
        $I->comment($AllCat);        
        $AllCat=  str_replace(array('-',' ','_'),"", $AllCat);
        $I->comment($AllCat);
        $firstCat=$I->grabTextFrom(".//*[@id='category']/div[2]/div/div[1]/div/div[3]/div/a");
        $I->comment("FirstCategory: $firstCat");
        $I->amOnPage(ProductsPage::$URL);        
        $I->click(ProductsPage::$CreateProductButton);
        $I->waitForElement(".//*[@id='parameters']/table[1]/thead/tr/th");
        $I->see('Создание товара', ".//*[@id='mainContent']/section/div/div[1]/span[2]");
        $I->see('Товар', ProductsPage::$ProductButton);
        $I->see('Информация', ".//*[@id='parameters']/table[1]/thead/tr/th");
        $I->see('Название товара:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/label");
        $I->see('*', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/label/span");
        $I->see('Статус:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[3]/label");
        $I->see('Название варианта товара', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[1]");
        $I->see('Цена', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[2]");
        $I->see('*', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[2]/span");
        $I->see('Валюта', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[3]");
        $I->seeOptionIsSelected(ProductsPage::$Currency, $mainIsoCur);
        $I->click(ProductsPage::$Currency);
        for ($k=1; $k<=$kil; $k++){
            $IsoCur[$k]=$I->grabTextFrom(ProductsPage::$Currency."/option[$k]");
            $I->comment("$IsoCurAll[$k]");
        }
        $I->assertEquals($IsoCur, $IsoCurAll);
        $I->see('Артикул', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[4]");
        $I->see('Количество', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[5]");
        $I->see('Фото', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[6]");
        $I->see('Добавить вариант', ProductsPage::$AddVariantButton);
        $I->see('Название бренда:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/label");
        $I->see('Не указано', ProductsPage::$BrandName.'/a/span');
        $I->click(ProductsPage::$BrandName);
        $kilBrands=$I->grabClassCount($I, "active-result");
        $I->comment("Amount Brands: $kilBrands");
        for ($h=2; $h<=$kilBrands; $h++){
            $BrandsInSelectMenu[$h]=$I->grabTextFrom(ProductsPage::$BrandName."/div/ul/li[$h]");
            $I->comment("$BrandsInSelectMenu[$h]");
        }
        $I->click(ProductsPage::$BrandName);
        $I->see('Категория:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[2]/div/div[2]/label");
        $I->see($firstCat, ProductsPage::$Category.'/a/span');
        $I->click(ProductsPage::$Category);
        $I->wait('1');
        $kilCat=$I->grabClassCount($I, "active-result");
        $kilCategory=$kilCat-$kilBrands;
        $I->comment("Amount Category: $kilCategory");
        for ($y=1; $y<=$kilCategory; $y++){
            $CategoryInSelectMenu[$y]=$I->grabTextFrom(ProductsPage::$Category."/div/ul/li[$y]");
            $I->comment("$CategoryInSelectMenu[$y]");
        }
        $CategoryInMenu=  implode(" ", $CategoryInSelectMenu);
        $I->comment($CategoryInMenu);
        $CategoryInMenu=  str_replace(array('-',' '),"",$CategoryInMenu);
        $I->comment($CategoryInMenu);
        $I->assertEquals($CategoryInMenu, $AllCat);
        $I->click(ProductsPage::$Category);
        $I->see('Дополнительные категории:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[2]/div/div[3]/label");
        $I->seeInField(ProductsPage::$AdditionalCategory.'/ul/li/input', 'Выберите категории');
        $I->click(ProductsPage::$AdditionalCategory);
        for ($x=1; $x<=$kilCategory; $x++){
            $CategoryInSelectMenu1[$x]=$I->grabTextFrom(ProductsPage::$AdditionalCategory."/div/ul/li[$x]");
            $I->comment("$CategoryInSelectMenu1[$x]");
        }
        $CategoryInMenu1=  implode(" ", $CategoryInSelectMenu1);
        $I->comment($CategoryInMenu1);
        $CategoryInMenu1=  str_replace(array('-',' '),"",$CategoryInMenu1);
        $I->comment($CategoryInMenu1);
        $I->assertEquals($CategoryInMenu1, $AllCat);  
        $I->click(ProductsPage::$AdditionalCategory);
        $I->see('Краткое описание:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[3]/label");
        $I->see('Полное описание:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[4]/label");
        $I->see('Настройки', ".//*[@id='parameters']/table[2]/thead/tr/th");
        $I->see('Разрешить комментирование:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[1]/label");
        $I->seeOptionIsSelected(ProductsPage::$Comments, 'Да');
        $I->click(ProductsPage::$Comments);
        $I->see('Да', ProductsPage::$Comments.'/option[1]');
        $I->see('Нет', ProductsPage::$Comments.'/option[2]');
        $I->see('Дата создания:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[2]/label");
        $I->click(ProductsPage::$DateOfCreate);
        $I->seeElement(".//*[@id='ui-datepicker-div']");
        $I->see('Формат даты: гггг-мм-дд чч:мм:сс', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[2]/div/p");
        $I->see('Старая цена:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[3]/label");
        $I->see('Главный шаблон:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[4]/label");
        $I->see('Основной шаблон товара. По-умолчанию product.tpl', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div/div[4]/div/p");
        $I->see('Мета-данные', ".//*[@id='parameters']/table[3]/thead/tr/th");
        $I->see('URL:', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div/div[1]/label");
        $I->see('Автоподбор', ProductsPage::$AutoSelectButton);
        $I->see('Meta Title', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div/div[2]/label");
        $I->see('Meta Description', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div/div[3]/label");
        $I->see('Meta Keywords', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div/div[4]/label");
        $I->see('Вернуться', ProductsPage::$GoBackButton);
        $I->see('Создать', ProductsPage::$SaveButton);
        $I->see('Создать и выйти', ProductsPage::$SaveAndExitButton);
    }
    
     public function CurrencySymbol(ProductsTester $I)
    {
        $I->amOnPage(CurrenciesPage::$URL);
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");
        for($j=1; $j<=$rows; $j++){
            $text[$j]=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
            $iso[$j]=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($j));
            $I->comment($text[$j]);
            $I->comment($iso[$j]);
        }
        $this->AllSymbolsCur=  implode(" ", $text);
        $I->comment($this->AllSymbolsCur);
        $this->AllIsoCur= implode(" ", $iso);
        $I->comment($this->AllIsoCur);
        for ($k=1;$k<$rows;++$k){
            $atribCheck = $I->grabAttributeFrom(CurrenciesPage::RadioButtonLine($k),"checked");
                if($atribCheck == TRUE){
                break;
            }
        }
        $I->comment("Main Currency Line: $k");
        $this->MAINSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($k));
        $this->MainIso=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($k));
    }
    
    
//    public function RequiredFieldsSaveButtonInCreate(ProductsTester $I)
//    {
//        $I->amOnPage(ProductsPage::$URL);
//        $I->click(ProductsPage::$CreateProductButton);
//        $I->waitForText('Создание товара');
//        $I->click(ProductsPage::$SaveButton);
//        $I->see('Это поле обязательное.', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/label");
//        $I->see('Это поле обязательное.', ".//*[@id='ProductVariantRow_0']/td[2]/label");        
//        $I->click(ProductsPage::$GoBackButton);
//        $I->waitForText('Список товаров');
//        InitTest::ClearAllCach($I);
//    }
//    
//    
//    public function RequiredFieldsSaveAndExitButtonInCreate(ProductsTester $I)
//    {
//        $I->amOnPage(ProductsPage::$URL);
//        $I->click(ProductsPage::$CreateProductButton);
//        $I->waitForText('Создание товара');
//        $I->click(ProductsPage::$SaveAndExitButton);
//        $I->see('Это поле обязательное.', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/label");
//        $I->see('Это поле обязательное.', ".//*[@id='ProductVariantRow_0']/td[2]/label");        
//        $I->click(ProductsPage::$GoBackButton);
//        $I->waitForText('Список товаров');
//    }
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
//    public function CreateProduct1(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image1=null,$image2=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//        $I->CheckInFrontEnd($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
        
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
//    public function CreateProduct2(ProductsTester\ProductsSteps $I)
//    {
//        $name='Sony Television';
//        $price='333';
//        $currency='2';
//        $articul='1';
//        $amount='2';
//        $image2='';
//        $brand='2';
//        $category='3';
//        $addCat='5';
//        $comment='0';
//        $oldPrice='406';
//        $I->amOnPage("/admin/components/run/shop/categories/index");
//        $I->wait(3);
//        $I->clickAllElements($I,".btn.expandButton",3);        
//        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
//            foreach ($text as $key =>$value) {
//                $I->comment("$value");
//                if($value)  $I->comment("$key: $value");
//            }             
//        $I->comment("$text[2]");
//        $I->comment("$text[4]");
//        $comment1='Нет';
//        $I->CreateProduct($name, $nameVariant=null, $price, $currency, $articul, $amount,$image1=null, 
//                $image2, $brand, $category, $addCat, $shortDesc=null, 
//                $fullDesc=null, $comment, $dateCreate=null, $oldPrice);
//        $I->CheckInFields($name, $nameVariant=null, $price, $this->MainIso, $articul, $amount, $image2, $brand1=null, 
//                $text[2], $text[4], $shortDesc=null, $fullDesc=null, $comment1);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $text[2], $articul, $price, $this->MAINSYM);
//        $I->CheckInFrontEnd($name, $text[2], $articul, $price, $this->MAINSYM, $brand=null, $shortDesc=null, $fullDesc=null, $comment='Нет', $oldPrice);
//    }
    
    /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct3(ProductsTester\ProductsSteps $I)
    {
        InitTest::changeTextAditorToNative($I);
        $name=$I->GenerateNameProduct();
        $price='100';
        $currency='1';
        $articul='w33в1';
        $amount='8';        
        $brand='2';
        $category='7';        
        $comment='0';  
        $shortDesc='HTC One SV c легкостью справится с твоим напряженным графиком благодаря сверхбыстрому двухъядерному процессору с частотой 1,2 ГГц.';
        $fullDesc='PHP является одним из важных моментов в вопросе безопасности сервера, поскольку PHP-скрипты могут манипулировать файлами и каталогами на диске. В связи с этим существуют конфигурационные настройки, указывающие, какие файлы могут быть доступны и какие операции с ними можно выполнять. Необходимо проявлять осторожность, поскольку любой из файлов с соответствующими правами доступа может быть прочитан каждым, кто имеет доступ к файловой системе.
        Поскольку в PHP изначально предполагался полноправный пользовательский доступ к файловой системе, можно написать скрипт, который позволит читать системные файлы, такие как /etc/passwd, управлять сетевыми соединениями, отправлять задания принтеру, и так далее. Как следствие вы всегда должны быть уверены в том, что файлы, которые вы читаете или модифицируете, соответствуют вашим намерениям.';
        $url='product-descript';
        $I->amOnPage(CurrenciesPage::$URL);
        $I->click(CurrenciesPage::CurrencyNameLine('1'));
        $I->waitForText('Редактирование валют');
        $rate=$I->grabValueFrom(CurrenciesPage::$Rate);
        $price2=  round($price/$rate);
        
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }             
        $I->comment("$text[6]");        
        $comment1='Нет';
        $I->CreateProduct($name, $nameVariant=null, $price, $currency, $articul, $amount, 
                $image2=null, $brand, $category, $addCat=null, $shortDesc, 
                $fullDesc, $comment, $dateCreate=null, $oldPrice=null, $mainTemp=null, $url);
        $I->CheckInFields($name, $nameVariant=null, $price, $this->AllIsoCur[1], $articul, $amount,$image2=null, $brand1=null, 
                $text[6], $addCat=null, $shortDesc, $fullDesc, $comment1,$date=null,$oldPrice=null,$mainTemp=null,$url);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name, $text[6], $articul, $price, $this->AllSymbolsCur[1]);
        $I->CheckInFrontEnd($name, $text[6], $articul, $price2, $this->MAINSYM, $brand=null, $shortDesc, $fullDesc, $comment='Нет', $oldPrice=null,$url);
    }
    
    
//     /**
//     * @guy ProductsTester\ProductsSteps
//     */
//    
//    public function CreateProduct3(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
//    
//     /**
//     * @guy ProductsTester\ProductsSteps
//     */
//    
//    public function CreateProduct4(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
//    
//     /**
//     * @guy ProductsTester\ProductsSteps
//     */
//    
//    public function CreateProduct5(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
//    
//     /**
//     * @guy ProductsTester\ProductsSteps
//     */
//    
//    public function CreateProduct6(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
//    
//     /**
//     * @guy ProductsTester\ProductsSteps
//     */
//    
//    public function CreateProduct7(ProductsTester\ProductsSteps $I)
//    {
//        $name=$I->GenerateNameProduct();
//        $price='100';
//        $date=$I->CreateProduct($name, $nameVariant=null, $price);
//        $amount='1';
//        $brand='Не указано';
//        $addCat='Выберите дополнительные категории';
//        $comment='Нет';
////        $comment='Да';
//        $I->CheckInFields($name, $nameVariant=null, $price, $currency=null, $articul=null, $amount, $image=null, $brand, 
//                $category=null, $addCat, $shortDesc=null, $fullDesc=null, $comment, $date);
//        $I->click(ProductsPage::$GoBackButton);
//        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
//    }
}