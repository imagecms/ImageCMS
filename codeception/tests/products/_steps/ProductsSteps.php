<?php
namespace ProductsTester;

class ProductsSteps extends \ProductsTester
{
    public function CreateProduct($name,$nameVariant=null,$price,$hotStatus=null,$newStatus=null, $saleStatus=null,$currency=null,$articul=null,$amount=null,$image2=null,
            $brand=null,$category=null,$addCat=null,$shortDesc=null,$fullDesc=null,$comment='yes',$dateCreate=null,$oldPrice=null,$mainTemp=null,
            $url=null,$mTitle=null,$mDesc=null,$mKeywords=null,$active='yes',$save='save')
    {
        $I = $this;
        $ret = array();
        $I->amOnPage(\ProductsPage::$URL);
        $I->click(\ProductsPage::$CreateProductButton);
        $I->waitForText('Создание товара');
        $I->fillField(\ProductsPage::$NameProduct, $name);
        if (isset($hotStatus)){
            $I->click(\ProductsPage::$HotProductButton);
        }
        if (isset($newStatus)){
            $I->click(\ProductsPage::$NewProductButton);
        }
        if (isset($saleStatus)){
            $I->click(\ProductsPage::$SaleProductButton);
        }
        if (isset($oldPrice)){
            $I->fillField(\ProductsPage::$OldPrice, $oldPrice);
        }
        if(isset($nameVariant)){
            $I->fillField(\ProductsPage::$NameVariantProduct, $nameVariant);
        }
        $I->fillField(\ProductsPage::$Price, $price);
        if(isset($currency)){
//            $I->click(\ProductsPage::$Currency);
            $I->selectOption(\ProductsPage::$Currency, $currency);
        }
        if(isset($articul)){
            $I->fillField(\ProductsPage::$Articul, $articul);
        }
        if(isset($amount)){
            $I->fillField(\ProductsPage::$Amount, $amount);
        }
//        if(isset($image1)){
//            $I->moveMouseOver(\ProductsPage::$ImageIcon);
//            $I->wait('1');
////            $I->click(\ProductsPage::$EditImageButton);
//            $I->attachFile(\ProductsPage::$ImageIcon, "d:\OpenServer\domains\imagecms.loc\uploads_site\images\apgreyder-robotov.jpg");
//        }
        if(isset($image2)){
            $I->moveMouseOver(\ProductsPage::$ImageIcon);
            $I->wait('1');
            $I->click(\ProductsPage::$ImageDownloadButton);
            $I->waitForElement(".//*[@id='images_modal']");
//            $I->wait('3');
            $I->waitForElement(".//*[@id='image_search_result']/span[1]");
            $I->click(".//*[@id='image_search_result']/span[1]");
            $im=$I->grabAttributeFrom(".//*[@id='image_search_result']/span[1]/img", 'src');//*[@id="ProductVariantRow_0"]/td[1]/div/div/img
            $I->comment($im);
            $I->click(".//*[@id='save_image']");
            $I->wait('4');
            $im2=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[1]/div/div/img", 'src');
            $I->comment($im2);
            $I->assertEquals($im2, $im);
            $image = explode("/", $im);        
            $I->comment("$image[0]"."$image[1]");
            $n = count($image);
            $I->comment("$n");
            $n--;
            $I->comment("$image[$n]");
            $ret['image'] = $image[$n];
        }
        if(isset($brand)){
            $I->click(\ProductsPage::$BrandName);
            $I->wait('2');
            $br=$I->grabTextFrom(\ProductsPage::$BrandName."/div/ul/li[$brand]");
            $I->comment($br);
//            $I->click(\ProductsPage::$BrandName);
            $I->click(\ProductsPage::$BrandName."/div/ul/li[$brand]");//*[@id="inputParent_chosen"]/div/ul/li[27]
            $I->wait('1');
            $I->see($br, \ProductsPage::$BrandName.'/a/span');
            $ret['brand'] = $br;
        }
        if(isset($category)){
            $I->click(\ProductsPage::$Category);
            $cat=$I->grabTextFrom(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->comment($cat);            
            $I->click(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->wait('1');
            $I->see($cat, \ProductsPage::$Category.'/a/span');
            $ret['category'] = $cat;
        }                
        if(isset($addCat)){
            $I->click(\ProductsPage::$AdditionalCategory);
            $add=$I->grabTextFrom(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->comment($add);
            $I->wait('3');
            $I->click(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->wait('1');
            $I->see($add, \ProductsPage::$AdditionalCategory.'/ul/li/span');
            $ret['addCategory'] = $add;
        }        
        if(isset($shortDesc)){
            $I->fillField(\ProductsPage::$ShortDescription, $shortDesc);
        }
        if(isset($fullDesc)){
            $I->fillField(\ProductsPage::$FullDescription, $fullDesc);
        }
        switch ($active) {
            case 'yes':
                $activeBut=$I->grabAttributeFrom(\ProductsPage::$ActiveButton, 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off');                
                break;
            case 'no':
                $I->click(\ProductsPage::$ActiveButton);
                $activeBut=$I->grabAttributeFrom(\ProductsPage::$ActiveButton, 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off disable_tovar');
                break;
        } 
        $I->click(\ProductsPage::$PreferencesButton);
        $I->waitForElement(\ProductsPage::$MetaTitle);
        switch ($comment) {
            case 'yes':
                $I->click(\ProductsPage::Comments('1'));
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('1')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                $I->assertEquals($activeRadioBut, 'true');                
                break;
            case 'no':
                $I->click(\ProductsPage::Comments('2'));
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('2')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                $I->assertEquals($activeRadioBut, 'true');
                break;
        }        
        if(isset($dateCreate)){
            $I->fillField(\ProductsPage::$DateOfCreate, $dateCreate);
        }
        $date=$I->grabValueFrom(\ProductsPage::$DateOfCreate);
        $I->comment($date);
        $ret['date'] = $date;
        if(isset($mainTemp)){
            $I->fillField(\ProductsPage::$MainTemplate, $mainTemp);
        }
        if(isset($url)){
            $I->fillField(\ProductsPage::$UrlField, $url);
        }
        if(isset($mTitle)){
            $I->fillField(\ProductsPage::$MetaTitle, $mTitle);
        }
        if(isset($mDesc)){
            $I->fillField(\ProductsPage::$MetaDescription, $mDesc);
        }
        if(isset($mKeywords)){
            $I->fillField(\ProductsPage::$MetaKeywords, $mKeywords);
        }
        switch ($save) {
            case 'save':
                $I->click(\ProductsPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\ProductsPage::$SaveAndExitButton);
                break;
        }
        return $ret;
    }    
    
    public function GenerateNameProduct()
    {
        $I = $this;
        $set="abcdefghijklmnopqrstuvwxyz"; 
        $size = strlen($set)-1; 
        $prefix = 'Product';        
        $end = null;
        $max = 4;
            while($max--)
            $end.=$set[rand(0,$size)]; 
        $name = $prefix.$end;
        echo $name;
        return $name;
    }
    
    
    public function CheckInFields($name=null,$nameVariant=null,$price=null,$hotStatus=null,$newStatus=null, $saleStatus=null,$currency=null,$articul=null,$amount=null,$image=null,
            $brand=null,$category=null,$addCat=null,$shortDesc=null,$fullDesc=null,$comment='yes',$date=null,$oldPrice=null,$mainTemp=null,
            $url=null,$mTitle=null,$mDesc=null,$mKeywords=null,$active='yes')
    {
        $I = $this;
//        $I->waitForElement(\ProductsPage::$AccessoriesButton);
        $I->waitForText($name, '10', '//*[@id="mainContent"]/section/div/div[1]/span[2]');
//        $I->see($name, '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');
        if (isset($name)){
            $I->seeInField(\ProductsPage::$NameProduct, $name);
            $I->see($name, ".//*[@id='ProductVariantRow_0']/td[1]/div/div/span");
        }
        if (isset($hotStatus)){
            $hotClass=$I->grabAttributeFrom(\ProductsPage::$HotProductButton, 'class');
            $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        }
        if (isset($newStatus)){
            $newClass=$I->grabAttributeFrom(\ProductsPage::$NewProductButton, 'class');
            $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");
        }
        if (isset($saleStatus)){
            $saleStatus=$I->grabAttributeFrom(\ProductsPage::$SaleProductButton, 'class');
            $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");
        }
        if (isset($oldPrice)){
            $I->seeInField(\ProductsPage::$OldPrice, $oldPrice);
        }
        if(isset($nameVariant)){
            $I->seeInField(\ProductsPage::$NameVariantProduct, $nameVariant);
        }
        if(isset($price)){
            $I->seeInField(\ProductsPage::$Price, $price);
        }
        if(isset($currency)){
//            $I->click(\ProductsPage::$Currency);
            $I->seeOptionIsSelected(\ProductsPage::$Currency, $currency);
        }
        if(isset($articul)){
            $I->seeInField(\ProductsPage::$Articul, $articul);
        }
        if(isset($amount)){
            $I->seeInField(\ProductsPage::$Amount, $amount);
        }
        if(isset($image)){
//            $im=array();
//            $im[]=$image;
//            $image = explode("/", $image);        
//            $I->comment("$image[0]"."$image[1]");
//            $n = count($image);
//            $I->comment("$n");
//            $n--;
//            $I->comment("$image[$n]");
            $im=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[1]/div/div/img", 'src');
            $I->comment($im);
            $im2 = explode("/", $im);        
            $I->comment("$im2[0]"."$im2[1]");
            $n = count($im2);
            $I->comment("$n");
            $n--;
            $I->comment("$im2[$n]");
            $I->assertEquals($im2[$n], $image);
//            $im=array();
//            $im['image']=$im2;
        }
        if(isset($brand)){            
            $I->see($brand, \ProductsPage::$BrandName.'/a/span');
        }
        if(isset($category)){
            $I->see($category, \ProductsPage::$Category.'/a/span');
        }
                
        if(isset($addCat)){
            $I->see($addCat, \ProductsPage::$AdditionalCategory.'/ul/li/span');
        }
        
        if(isset($shortDesc)){
            $desc1=$I->grabValueFrom(\ProductsPage::$ShortDescription);
            $sdesc=  trim($desc1);
            $I->assertEquals($sdesc, $shortDesc);
        }
        if(isset($fullDesc)){
            $desc2=$I->grabValueFrom(\ProductsPage::$FullDescription);
            $fdesc=  trim($desc2);
            $I->assertEquals($fdesc, $fullDesc);
        }
        switch ($active) {
            case 'yes':
                $activeBut=$I->grabAttributeFrom(\ProductsPage::$ActiveButton, 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off');                
                break;
            case 'no':
                $activeBut=$I->grabAttributeFrom(\ProductsPage::$ActiveButton, 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off disable_tovar');
                break;
        } 
        $I->click(\ProductsPage::$PrefButtonEditing);
        switch ($comment) {
            case 'yes':
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('1')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                $I->assertEquals($activeRadioBut, 'true');                
                break;
            case 'no':                
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('2')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                $I->assertEquals($activeRadioBut, 'true');
                break;
        } 
        if(isset($date)){
            $I->seeInField(\ProductsPage::$DateOfCreate, $date);
        }        
        if(isset($mainTemp)){
            $I->seeInField(\ProductsPage::$MainTemplate, $mainTemp);
        }
        if(isset($url)){
            $I->seeInField(\ProductsPage::$UrlField, $url);
        }
        if(isset($mTitle)){
            $I->seeInField(\ProductsPage::$MetaTitle, $mTitle);
        }
        if(isset($mDesc)){
            $I->seeInField(\ProductsPage::$MetaDescription, $mDesc);
        }
        if(isset($mKeywords)){
            $I->seeInField(\ProductsPage::$MetaKeywords, $mKeywords);
        }        
    }    
    
    
    public function CheckInListLanding($name,$category=null,$articul=null,$hotStatus=null,$newStatus=null,$saleStatus=null,$price,$symbol=null,$active='yes')
    {
        $I = $this;
        $I->waitForText('Список товаров');
        $I->click(\ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $I->see($name, \ProductsPage::ProductNameLine('last()'));
        if(isset($category)){
            $I->see($category, \ProductsPage::CategoryLine('last()'));
        }
        if(isset($articul)){
            $I->see($articul, \ProductsPage::ArticulLine('last()'));
        }
        switch ($active) {
            case 'yes':
                $activeBut=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off');                
                break;
            case 'no':
                $activeBut=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
                $I->comment("$activeBut");
                $I->assertEquals($activeBut, 'prod-on_off disable_tovar');
                break;
        } 
        if (isset($hotStatus)){
            $hotClass=$I->grabAttributeFrom(\ProductsPage::StatusLine1('last()'), 'class');
            $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        }
        if (isset($newStatus)){
            $newClass=$I->grabAttributeFrom(\ProductsPage::StatusLine2('last()'), 'class');
            $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");
        }
        if (isset($saleStatus)){
            $saleStatus=$I->grabAttributeFrom(\ProductsPage::StatusLine3('last()'), 'class');
            $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");
        }
        $I->seeInField(\ProductsPage::PriceFieldLine('last()'), $price);
        if(isset($symbol)){
            $I->see($symbol, \ProductsPage::PriceCurrencySymbolLine('last()'));
        }
        $I->moveMouseOver(\ProductsPage::ProductNameLine('last()'));
        $I->wait('1');
        $I->click(\ProductsPage::ProductReviewButton('last()'));
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
    }   
    
    
    public function CheckInFrontEnd($name,$category=null,$articul=null,$price,$symbolmain=null,$brand=null,$image=null,$hotStatus=null,$newStatus=null, $saleStatus=null,$shortDesc=null,$fullDesc=null,$comment='no',
            $oldPrice=null,$url=null)
    {
        $I = $this;
        $I->waitForElement(\CurrenciesPage::$SearchField);
        $I->see($name, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/div/h1");
        $I->see($category, "html/body/div[1]/div[2]/div[1]/div/div/ul/li['last()']/a/span");
        if(isset($articul)){
            $I->see($articul, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/span/span[1]/span");
        }
        $I->see($price, \CurrenciesPage::$MainFirstPlaceCard);
        $I->see($symbolmain, \CurrenciesPage::$MainSecondPlaceCard);
        if(isset($brand)){
            $I->see($brand, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/span/span[2]/span/a");
        }
        if(isset($image)){
            $I->wait('2');
            $im=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/img', 'src');
            $im = explode("/", $im);        
            $I->comment("$im[0]"."$im[1]");
            $n = count($im);
            $I->comment("$n");
            $n--;
            $I->comment("$im[$n]");
            $I->assertEquals($im[$n], $image);          
        } 
        if(isset($hotStatus)){
            $classHot=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[2]', 'class');
            $I->assertEquals($classHot, "product-status hit");
        }
        if(isset($newStatus)){
            $classNew=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[2]', 'class');
            $I->assertEquals($classNew, "product-status nowelty");
        }
        if(isset($saleStatus)){
            $classSale=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[2]', 'class');
            $I->assertEquals($classSale, "product-status action");
        }
        if(isset($shortDesc)){
            $I->see($shortDesc, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[2]");
        }
        if(isset($fullDesc)){
//            $I->see($fullDesc, ".//*[@id='view']/div[2]/div/div/table");
            $I->scrollToElement($I, ".text");
            $I->wait('2');
            $I->click("html/body/div[1]/div[2]/div[2]/div[3]/ul/li[2]");
            $I->scrollToElement($I, ".text");
            $I->wait('2');
            $I->see($fullDesc, ".//*[@id='second']/div/div[2]");
        }
        $kil=$I->grabCCSAmount($I, '.tabs.tabs-data.tabs-product>li>button');
        $I->comment("$kil");
        switch ($comment) {
            case 'yes':
                $I->scrollToElement($I, '.tabs.tabs-data.tabs-product>li>button');
                $I->wait('2');
                $I->click("html/body/div[1]/div[2]/div[2]/div[3]/ul/li[$kil]/button");
//                $I->scrollToElement($I, '.tabs.tabs-data.tabs-product>li>button');
                $I->waitForText("Текст комментария");                
                $I->seeElement('//*[@class="inside-padd forComments p_r"]/div[1]/div[2]/div/div[2]/div/form/label/span[2]/textarea');
                $I->fillField('//*[@class="inside-padd forComments p_r"]/div[1]/div[2]/div/div[2]/div/form/label/span[2]/textarea', "Great purchase");
                $I->click('//*[@class="inside-padd forComments p_r"]/div[1]/div[2]/div/div[2]/div/form/div[3]/span/div/input');
                $I->waitForElement(".//*[@id='comments']/div[2]/ul/li/div[1]/div[3]/div[1]/p");
                $I->see("Great purchase", ".//*[@id='comments']/div[2]/ul/li/div[1]/div[3]/div[1]/p");
                break;
            case 'no':
                $I->dontSee('Оставить отзыв', \ProductsPage::ButtonsFront('last()'));
                break;
        }
        if(isset($oldPrice)){
            $I->see($oldPrice, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div/div[1]/div[1]/span[1]/span/span[1]");
        }
        if(isset($url)){
            $I->seeCurrentUrlEquals('/shop/product/'.$url);
        }
        if(isset($mTitle)){
            $I->seeInTitle($mTitle);
        }
//        if(isset($mDesc)){
//            $I->seeInField(\ProductsPage::$MetaDescription, $mDesc);
//        }
//        if(isset($mKeywords)){
//            $I->seeInField(\ProductsPage::$MetaKeywords, $mKeywords);
//        } 
    }   
    
    
    public function EditingProduct($name=null,$nameVariant=null,$price,$hotStatus=null,$newStatus=null, $saleStatus=null,$currency=null,$articul=null,$amount=null,$image=null,
            $brand=null,$category=null,$addCat=null,$shortDesc=null,$fullDesc=null,$comment='yes',$date=null,$oldPrice=null,$mainTemp=null,
            $url=null,$mTitle=null,$mDesc=null,$mKeywords=null,$accessory=null,$save='save')
    {
        $I = $this;     
        if (isset($name)){
            $I->fillField(\ProductsPage::$NameProduct, $name);
        }        
        if (isset($hotStatus)){
            $I->click(\ProductsPage::$HotProductButton);
//            $I->wait('2');
//            $hotClass=$I->grabAttributeFrom(\ProductsPage::$HotProductButton, 'class');
//            $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        }
        if (isset($newStatus)){
            $I->click(\ProductsPage::$NewProductButton);
//            $I->wait('1');
//            $newClass=$I->grabAttributeFrom(\ProductsPage::$NewProductButton);
//            $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");
        }
        if (isset($saleStatus)){
            $I->click(\ProductsPage::$SaleProductButton);
//            $I->wait('1');
//            $saleStatus=$I->grabAttributeFrom(\ProductsPage::$SaleProductButton);
//            $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");
        }
        if (isset($oldPrice)){
            $I->fillField(\ProductsPage::$OldPrice, $oldPrice);
        }
        if(isset($nameVariant)){
            $I->fillField(\ProductsPage::$NameVariantProduct, $nameVariant);
        }
        if(isset($price)){
            $I->seeInField(\ProductsPage::$Price, $price);
        }
        if(isset($currency)){
            $I->click(\ProductsPage::$Currency);
            $I->selectOption(\ProductsPage::$Currency, $currency);
        }
        if(isset($articul)){
            $I->fillField(\ProductsPage::$Articul, $articul);
        }
        if(isset($amount)){
            $I->fillField(\ProductsPage::$Amount, $amount);
        }
        if(isset($image2)){
            $I->moveMouseOver(\ProductsPage::$ImageIcon);
            $I->wait('1');
            $I->click(\ProductsPage::$ImageDownloadButton);
            $I->waitForElement(".//*[@id='images_modal']");
//            $I->wait('3');
            $I->waitForElement(".//*[@id='image_search_result']/span[1]");
            $I->click(".//*[@id='image_search_result']/span[1]");
            $im=$I->grabAttributeFrom(".//*[@id='image_search_result']/span[1]/img", 'src');//*[@id="ProductVariantRow_0"]/td[1]/div/div/img
            $I->comment($im);
            $I->click(".//*[@id='save_image']");
            $I->wait('4');
            $im2=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[1]/div/div/img", 'src');
            $I->comment($im2);
            $I->assertEquals($im2, $im);
            $image = explode("/", $im);        
            $I->comment("$image[0]"."$image[1]");
            $n = count($image);
            $I->comment("$n");
            $n--;
            $I->comment("$image[$n]");
            $ret['image'] = $image[$n];
        }
        if(isset($brand)){
            $I->click(\ProductsPage::$BrandName);
            $I->wait('2');
            $br=$I->grabTextFrom(\ProductsPage::$BrandName."/div/ul/li[$brand]");
            $I->comment($br);
//            $I->click(\ProductsPage::$BrandName);
            $I->click(\ProductsPage::$BrandName."/div/ul/li[$brand]");//*[@id="inputParent_chosen"]/div/ul/li[27]
            $I->wait('1');
            $I->see($br, \ProductsPage::$BrandName.'/a/span');
            $ret['brand'] = $br;
        }
        if(isset($category)){
            $I->click(\ProductsPage::$Category);
            $cat=$I->grabTextFrom(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->comment($cat);            
            $I->click(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->wait('1');
            $I->see($cat, \ProductsPage::$Category.'/a/span');
            $ret['category'] = $cat;
        }                
        if(isset($addCat)){
            $I->click(\ProductsPage::$AdditionalCategory);
            $add=$I->grabTextFrom(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->comment($add);
            $I->wait('3');
            $I->click(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->wait('1');
            $I->see($add, \ProductsPage::$AdditionalCategory.'/ul/li/span');
            $ret['addCategory'] = $add;
        }        
        if(isset($shortDesc)){
            $I->fillField(\ProductsPage::$ShortDescription, $shortDesc);
        }
        if(isset($fullDesc)){
            $I->fillField(\ProductsPage::$FullDescription, $fullDesc);
        }
        if(isset($accessory)){
            $I->click(\ProductsPage::$AccessoriesButton);
            $I->fillField(\ProductsPage::$AccessoryEdit, $accessory);
            $I->click('/html/body/ul/li[1]');
            $I->wait('2');
            $I->see('Визуализация:', '//*[@id="relatedProductsNames"]/div/label');
            $I->see('Выбранные товары', '//*[@id="relatedProductsNames"]/div/div/table/thead/tr/th');
            $I->seeElement('//*[@id="relatedProductsNames"]/div/div/table/tbody/tr/td/button');
        }
        $I->click(\ProductsPage::$PreferencesButton);
        $I->waitForElement(\ProductsPage::$MetaTitle);
        switch ($comment) {
            case 'yes':
//                $I->click(\ProductsPage::Comments('1'));
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('1')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                if($activeRadioBut=false){
                    $I->click(\ProductsPage::Comments('1'));
                    break;
                }
                $activeRadioBut2=$I->grabAttributeFrom(\ProductsPage::Comments('1')."/span/input", 'checked');
                $I->comment("$activeRadioBut2");
                $I->assertEquals($activeRadioBut2, 'true');                
                break;
            case 'no':
                $I->click(\ProductsPage::Comments('2'));
                $activeRadioBut=$I->grabAttributeFrom(\ProductsPage::Comments('2')."/span/input", 'checked');
                $I->comment("$activeRadioBut");
                $I->assertEquals($activeRadioBut, 'true');
                break;
        }        
        if(isset($dateCreate)){
            $I->fillField(\ProductsPage::$DateOfCreate, $dateCreate);
        }
        $date=$I->grabValueFrom(\ProductsPage::$DateOfCreate);
        $I->comment($date);
        $ret['date'] = $date;
        if(isset($mainTemp)){
            $I->fillField(\ProductsPage::$MainTemplate, $mainTemp);
        }
        if(isset($url)){
            $I->fillField(\ProductsPage::$UrlField, $url);
        }
        if(isset($mTitle)){
            $I->fillField(\ProductsPage::$MetaTitle, $mTitle);
        }
        if(isset($mDesc)){
            $I->fillField(\ProductsPage::$MetaDescription, $mDesc);
        }
        if(isset($mKeywords)){
            $I->fillField(\ProductsPage::$MetaKeywords, $mKeywords);
        }
        switch ($save) {
            case 'save':
                $I->click(\ProductsPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\ProductsPage::$SaveAndExitButton);
                break;
        }
        return $ret;
    }    
}