<?php
namespace ProductsTester;

class ProductsSteps extends \ProductsTester
{
    public function CreateProduct($name,$nameVariant=null,$price,$currency=null,$articul=null,$amount=null,$image2=null,
            $brand=null,$category=null,$addCat=null,$shortDesc=null,$fullDesc=null,$comment=null,$dateCreate=null,$oldPrice=null,$mainTemp=null,
            $url=null,$mTitle=null,$mDesc=null,$mKeywords=null,$save='save')
    {
        $I = $this;
        $I->amOnPage(\ProductsPage::$URL);
        $I->click(\ProductsPage::$CreateProductButton);
        $I->waitForText('Создание товара');
        $I->fillField(\ProductsPage::$NameProduct, $name);
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
            $im=$I->grabAttributeFrom(".//*[@id='image_search_result']/span[1]/img", 'src');
            $I->comment($im);
            $I->click(".//*[@id='save_image']");
            $I->wait('4');
            $im2=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[6]/div/div/img", 'src');
            $I->comment($im2);
            $I->assertEquals($im2, $im);
        }
        if(isset($brand)){
            $I->click(\ProductsPage::$BrandName);
            $br=$I->grabTextFrom(\ProductsPage::$BrandName."/div/ul/li[$brand]");
            $I->comment($br);
            $I->click(\ProductsPage::$BrandName."/div/ul/li[$brand]");
            $I->wait('1');
            $I->see($br, \ProductsPage::$BrandName.'/a/span');
        }
        if(isset($category)){
            $I->click(\ProductsPage::$Category);
            $cat=$I->grabTextFrom(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->comment($cat);            
            $I->click(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->wait('1');
            $I->see($cat, \ProductsPage::$Category.'/a/span');
        }                
        if(isset($addCat)){
            $I->click(\ProductsPage::$AdditionalCategory);
            $add=$I->grabTextFrom(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->comment($add);
            $I->wait('3');
            $I->click(\ProductsPage::$AdditionalCategory."/div/ul/li[$addCat]");
            $I->wait('1');
            $I->see($add, \ProductsPage::$AdditionalCategory.'/ul/li/span');
        }        
        if(isset($shortDesc)){
            $I->fillField(\ProductsPage::$ShortDescription, $shortDesc);
        }
        if(isset($fullDesc)){
            $I->fillField(\ProductsPage::$FullDescription, $fullDesc);
        }
        if(isset($comment)){
            $I->click(\ProductsPage::$Comments);
            $I->wait('2');
            $I->selectOption(\ProductsPage::$Comments, $comment);
        }
        if(isset($dateCreate)){
            $I->fillField(\ProductsPage::$DateOfCreate, $dateCreate);
        }
        $date=$I->grabValueFrom(\ProductsPage::$DateOfCreate);
        $I->comment($date);
        if (isset($oldPrice)){
            $I->fillField(\ProductsPage::$OldPrice, $oldPrice);
        }
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
        return $date;
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
    
    
    public function CheckInFields($name,$nameVariant=null,$price,$currency=null,$articul=null,$amount=null,$image2=null,
            $brand=null,$category=null,$addCat=null,$shortDesc=null,$fullDesc=null,$comment=null,$date=null,$oldPrice=null,$mainTemp=null,
            $url=null,$mTitle=null,$mDesc=null,$mKeywords=null)
    {
        $I = $this;
        $I->waitForText($name, "5", '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');
        $I->seeInField(\ProductsPage::$NameProduct, $name);
        if(isset($nameVariant)){
            $I->seeInField(\ProductsPage::$NameVariantProduct, $nameVariant);
        }
        $I->seeInField(\ProductsPage::$Price, $price);
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
            $im2=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[6]/div/div/img", 'src');
            $I->comment($im2);
            $I->assertEquals($im2, $image);
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
        if(isset($comment)){
            $I->seeOptionIsSelected(\ProductsPage::$Comments, $comment);
        }
        if(isset($date)){
            $I->seeInField(\ProductsPage::$DateOfCreate, $date);
        }
        if (isset($oldPrice)){
            $I->seeInField(\ProductsPage::$OldPrice, $oldPrice);
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
    
    
    public function CheckInListLanding($name,$category=null,$articul=null,$price,$symbol=null)
    {
        $I = $this;
        $I->waitForText('Список товаров');
        $I->click(".//*[@id='filter_form']/section/div[2]/div/div[1]/ul/li[8]/a");
        $I->wait('2');
        $I->see($name, \ProductsPage::ProductNameLine('last()'));
        if(isset($category)){
            $I->see($category, \ProductsPage::CategoryLine('last()'));
        }
        if(isset($articul)){
            $I->see($articul, \ProductsPage::ArticulLine('last()'));
        }
        $class=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($class, "prod-on_off");
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
    
    
    public function CheckInFrontEnd($name,$category=null,$articul=null,$price,$symbolmain=null,$brand=null,$shortDesc=null,$fullDesc=null,$comment='Нет',
            $oldPrice=null,$url=null)
    {
        $I = $this;
        $I->waitForElement(".//*[@id='inputString']");
        $I->see($name, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/div/h1");
        $I->see($category, "html/body/div[1]/div[2]/div[1]/div/div/ul/li['last()']/a/span");
        if(isset($articul)){
            $I->see($articul, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/span/span[1]/span");
        }
        $I->see($price, 'html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div/div[1]/div[1]/span/span[1]/span/span[1]');
        $I->see($symbolmain, 'html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div/div[1]/div[1]/span/span[1]/span/span[2]');
        if(isset($brand)){
            $I->see($brand, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/span/span[2]/span/a");
        }
        if(isset($shortDesc)){
            $I->see($shortDesc, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[2]");
        }
        if(isset($fullDesc)){
//            $I->see($fullDesc, ".//*[@id='view']/div[2]/div/div/table");
            $I->click("Полное описание");
            $I->wait('2');
            $I->see($fullDesc, ".//*[@id='second']/div/div[2]");
        }
        switch ($comment) {
            case 'Да':
                $I->click("html/body/div[1]/div[2]/div[2]/div[3]/ul/li[4]/button");
                $I->waitForText("Текст комментария");
                $I->seeElement(".//*[@id='comments']/div[2]/div/div[2]/div/form/label/span[2]/textarea");
                $I->fillField(".//*[@id='comments']/div[2]/div/div[2]/div/form/label/span[2]/textarea", "Great purchase");
                $I->click(".//*[@id='comments']/div[2]/div/div[2]/div/form/div[3]/span/div/input");
                $I->waitForElement(".//*[@id='comments']/div[2]/ul/li/div[1]/div[3]/div[1]/p");
                $I->see("Great purchase", ".//*[@id='comments']/div[2]/ul/li/div[1]/div[3]/div[1]/p");
                break;
            case 'Нет':
                $I->dontSeeElement("html/body/div[1]/div[2]/div[2]/div[3]/ul/li[4]/button");
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
}