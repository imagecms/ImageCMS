<?php
use \ProductsTester;

class EditingProductCest
{
    public function Autorization(ProductsTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(ProductsPage::$URL);
        $I->waitForText("Отменить фильтрацию", "10", ProductsPage::$CancelFilterButton);
    }
    
    
    public function NamesInEditing(ProductsTester $I)
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
        $I->click(ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $name=$I->grabTextFrom(ProductsPage::ProductNameLine('last()'));
        $I->click(ProductsPage::ProductNameLine('last()'));
        $I->waitForText($name, "5", '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');         
        $I->see($name, '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->see('Товар', ProductsPage::$ProductButton);
        $I->see('Свойства', ProductsPage::$PropertyButton);
        $I->see('Изображения', ProductsPage::$ImagesButton);
        $I->see('Наборы', ProductsPage::$KitsProductButton);
        $I->see('Информация', ".//*[@id='parameters']/table[1]/thead/tr/th");
        $I->see('Название товара:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/label");
        $I->see('*', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/label/span");
        $I->see('Статус:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[3]/label");
        $I->seeElement(ProductsPage::$HotProductButton);
        $d1=$I->grabAttributeFrom(ProductsPage::$HotProductButton, 'disabled');
        $I->assertEquals($d1, null);
        $I->seeElement(ProductsPage::$NewProductButton);
        $d2=$I->grabAttributeFrom(ProductsPage::$NewProductButton, 'disabled');
        $I->assertEquals($d2, null);
        $I->seeElement(ProductsPage::$SaleProductButton);
        $d3=$I->grabAttributeFrom(ProductsPage::$SaleProductButton, 'disabled');
        $I->assertEquals($d3, null);
        $I->see('Активный:', '//*[@id="parameters"]/table[1]/tbody/tr/td/div/div/div[1]/div[2]/span');
        $I->see('Название варианта товара', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[1]");
        $I->see('Цена', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[2]");
        $I->see('*', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[2]/span");
        $I->see('Валюта', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[3]");
        $I->click(ProductsPage::$Currency);
        for ($k=1; $k<=$kil; $k++){
            $IsoCur[$k]=$I->grabTextFrom(ProductsPage::$Currency."/option[$k]");
            $IsoCur[$k]=trim($IsoCur[$k]);
            $I->comment("$IsoCurAll[$k]");
        }
        $I->assertEquals($IsoCur, $IsoCurAll);
        $I->see('Артикул', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[4]");
        $I->see('Количество', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[5]");
        $I->see('Фото', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/thead/tr[1]/th[6]");
        $I->see('Добавить вариант', ProductsPage::$AddVariantButton);
        $I->see('Название бренда:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/label");
        $I->click(ProductsPage::$BrandName);
        $kilBrands=$I->grabClassCount($I, "active-result");
        $I->comment("Amount Brands: $kilBrands");
        for ($h=2; $h<=$kilBrands; $h++){
            $BrandsInSelectMenu[$h]=$I->grabTextFrom(ProductsPage::$BrandName."/div/ul/li[$h]");
            $I->comment("$BrandsInSelectMenu[$h]");
        }
        $I->click(ProductsPage::$BrandName);
        $I->see('Категория:', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[2]/div/div[2]/label");
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
        $I->see('Разрешить комментирование:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div[1]/label");
        $I->click(ProductsPage::$Currency);
        $I->click(ProductsPage::$Comments);
        $I->see('Да', ProductsPage::$Comments.'/option[1]');
        $I->see('Нет', ProductsPage::$Comments.'/option[2]');
        $I->see('Дата создания:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div[2]/label");
        $I->click(ProductsPage::$DateOfCreate);
        $I->seeElement(".//*[@id='ui-datepicker-div']");
        $I->see('Формат даты: гггг-мм-дд чч:мм:сс', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div[2]/div/p");
        $I->see('Старая цена:', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div[3]/label");                                     
        $I->see("Связанные товары:
ID / Название / Артикул", '//*[@id="parameters"]/table[2]/tbody/tr/td/div/div/div[4]/label');
        $I->see('Главный шаблон:', '//*[@id="parameters"]/table[2]/tbody/tr/td/div/div/div[5]/label');
        $I->see('Основной шаблон товара. По-умолчанию product.tpl', ".//*[@id='parameters']/table[2]/tbody/tr/td/div/div/div[5]/div/p");
        $I->see('Мета-данные', ".//*[@id='parameters']/table[3]/thead/tr/th");
        $I->see('URL:', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div[1]/label");
        $I->see('Автоподбор', ProductsPage::$AutoSelectButton);
        $I->see('Meta Title', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div[2]/label");
        $I->see('Meta Description', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div[3]/label");
        $I->see('Meta Keywords', ".//*[@id='parameters']/table[3]/tbody/tr/td/div/div/div[4]/label");
        $I->see('Вернуться', ProductsPage::$GoBackButton);
        $I->see('Сохранить', ProductsPage::$SaveButton);
        $I->see('Сохранить и выйти', ProductsPage::$SaveAndExitButton);
        $I->scrollToElement($I, '.pjax');
        $I->wait('2');
        $I->click(ProductsPage::$PropertyButton);
        $I->wait('1');
        $I->see('Свойства', '//*[@id="parameters_article"]/table/thead/tr/th');
        $I->click(ProductsPage::$ImagesButton);
        $I->wait('2');
        $I->see('Изображения', '//*[@id="additionalPics"]/table/thead/tr/th');
        $am=$I->grabCCSAmount($I, '.control-group.span6');
        $I->assertEquals($am, '12');
        $I->click(ProductsPage::$KitsProductButton);
        $I->wait('2');
        $I->see('Список наборов товаров пустой', ".//*[@id='kits']/div");
        $I->see('Создать набор', ".//*[@id='kits']/a");
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
    
    
    public function RequiredFieldsSaveButtonInCreate(ProductsTester $I)
    {
        $I->amOnPage(ProductsPage::$URL);
        $I->click(ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $name=$I->grabTextFrom(ProductsPage::ProductNameLine('last()'));
        $I->click(ProductsPage::ProductNameLine('last()'));
        $I->waitForText($name, "5", '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');
        $I->fillField(ProductsPage::$NameProduct, '');
        $I->fillField(ProductsPage::$NameVariantProductEdit, '');
        $I->fillField(ProductsPage::$Price, '');
        $I->fillField(ProductsPage::$Articul, '');
        $I->fillField(ProductsPage::$Amount, '');
        $I->click(ProductsPage::$BrandName);
        $I->click(\ProductsPage::$BrandName."/div/ul/li[1]");
        $I->wait('2');        
        $I->see('Не указано', \ProductsPage::$BrandName.'/a/span');
        $I->click(\ProductsPage::$AdditionalCategory);
        $I->fillField(\ProductsPage::$AdditionalCategory."/ul/li/input",'');
            $I->wait('1');
        $I->seeInField(\ProductsPage::$AdditionalCategory, 'Выберите дополнительные категории');
        $I->fillField(ProductsPage::$ShortDescription, '');
        $I->fillField(ProductsPage::$FullDescription, '');
        $I->fillField(ProductsPage::$DateOfCreate, '');
        $I->fillField(ProductsPage::$OldPrice, '');
        $I->fillField(".//*[@id='RelatedProducts']", '');
        $I->fillField(ProductsPage::$MainTemplate, '');
        $I->fillField(ProductsPage::$UrlField, '');
        $I->fillField(ProductsPage::$MetaTitle, '');
        $I->fillField(ProductsPage::$MetaDescription, '');
        $I->fillField(ProductsPage::$MetaKeywords, '');
        $I->click(ProductsPage::$SaveButton);
        $I->see('Это поле обязательное.', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/label");
        $I->see('Это поле обязательное.', ".//*[@id='ProductVariantRow_0']/td[2]/label");        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsSaveAndExitButtonInCreate(ProductsTester $I)
    {
        $I->amOnPage(ProductsPage::$URL);
        $I->click(ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $name=$I->grabTextFrom(ProductsPage::ProductNameLine('last()'));
        $I->click(ProductsPage::ProductNameLine('last()'));
        $I->waitForText($name, "5", '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');         
        $I->fillField(ProductsPage::$NameProduct, '');
        $I->fillField(ProductsPage::$NameVariantProductEdit, '');
        $I->fillField(ProductsPage::$Price, '');
        $I->fillField(ProductsPage::$Articul, '');
        $I->fillField(ProductsPage::$Amount, '');
        $I->click(ProductsPage::$BrandName);
        $I->click(\ProductsPage::$BrandName."/div/ul/li[1]");
        $I->wait('2');        
        $I->see('Не указано', \ProductsPage::$BrandName.'/a/span');
        $I->click(\ProductsPage::$AdditionalCategory);
        $I->fillField(\ProductsPage::$AdditionalCategory."/ul/li/input",'');
            $I->wait('1');
        $I->seeInField(\ProductsPage::$AdditionalCategory, 'Выберите дополнительные категории');
        $I->fillField(ProductsPage::$ShortDescription, '');
        $I->fillField(ProductsPage::$FullDescription, '');
        $I->fillField(ProductsPage::$DateOfCreate, '');
        $I->fillField(ProductsPage::$OldPrice, '');
        $I->fillField(".//*[@id='RelatedProducts']", '');
        $I->fillField(ProductsPage::$MainTemplate, '');
        $I->fillField(ProductsPage::$UrlField, '');
        $I->fillField(ProductsPage::$MetaTitle, '');
        $I->fillField(ProductsPage::$MetaDescription, '');
        $I->fillField(ProductsPage::$MetaKeywords, '');
        $I->click(ProductsPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/label");
        $I->see('Это поле обязательное.', ".//*[@id='ProductVariantRow_0']/td[2]/label");        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
    }
}