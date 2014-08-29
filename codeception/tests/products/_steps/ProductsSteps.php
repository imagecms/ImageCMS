<?php
namespace ProductsTester;

class ProductsSteps extends \ProductsTester
{
    public function create()
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
        if(isset($image)){
            $I->moveMouseOver(\ProductsPage::$ImageIcon);
            $I->wait('1');
            $I->click(\ProductsPage::$ImageDownloadButton);
            $I->waitForElement(".//*[@id='images_modal']");
            $I->wait('3');
            $I->click(".//*[@id='image_search_result']/span[1]");
            $im=$I->grabAttributeFrom(".//*[@id='image_search_result']/span[1]/img", 'src');
            $I->comment($im);
            $I->click(".//*[@id='save_image']");
            $I->waitForElementNotVisible(".//*[@id='images_modal']");
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
            $I->see($br, ProductsPage::$BrandName.'/a/span');
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
            $cat=$I->grabTextFrom(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->comment($cat);
            $I->click(\ProductsPage::$Category."/div/ul/li[$category]");
            $I->wait('1');
            $I->see($cat, \ProductsPage::$Category.'/a/span');
        }
        
        if(isset($shortDesc)){
            $I->fillField(\ProductsPage::$ShortDescription, $shortDesc);
        }
        if(isset($fullDesc)){
            $I->fillField(\ProductsPage::$FullDescription, $fullDesc);
        }
        if(isset($comment)){
            $I->selectOption(\ProductsPage::$Comments, $comment);
        }
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
    }    
    
    public function edit()
    {
        $I = $this;
    }
}