<?php

use \SeoExpertTester;
class ProductSEOCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'СЕОшная категория Product');
    }
    
    

  
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Про100 Бренд');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct = 'Товарчик для SEO експерта', $PriceProduct = '777', $BrandProduct = 'Про100 Бренд', $CategoryProduct = 'СЕОшная категория');

    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProperty(SeoExpertTester\seoexpertSteps $I) {
      $I->SeoCreateProperty($NameProperty = 'Оуххх Х', $CVS = 'XYXYxyxyxyxyXYXY', $Category = 'СЕОшная', $Values1 = 'Первое Свойство', $Values2 = 'Vtoroe Svoystvo', $Values3 = 'Третье свойство', $Values4  = 'The END');
      $I->SeoSelectPropertyInProduct($NameProduct = 'Товарчик для SEO експерта', $Property1 = 'Yes');
    }
    
    

    
    /**
     * @group a
     */
    public function ShopProductPage (SeoExpertTester $I){
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'Оуххх Х');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('2');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");        
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "ID-%ID% ИМЯ=%name% Catg_%category% Бренді:%brand% ЦЕНа(%price%) ВалХ[%CS%] /%p_$a%,.");
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name% %desc% %category% %brand% %price% %CS% %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductLength, '300');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "Ключ %name% ко %category% всему %brand% тут %p_$a%");
        $I->click(seoexpertPage::$SeoProductCheckBoxActive);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('2');
        $I->amOnPage('/shop/product/tovarchik-dlia-seo-eksperta');
        $I->wait('2');
        $I->seeInPageSource('ID-17193 ИМЯ=Товарчик для SEO експерта Catg_СЕОшная категория Product Бренді:Про100 Бренд ЦЕНа(777) ВалХ[руб] /The END,.');
        $I->wait('1');
        $I->seeInPageSource('17193 Товарчик для SEO експерта  СЕОшная категория Product Про100 Бренд 777 руб The END / lastbuild.loc');
        $I->wait('1');
        $I->seeInPageSource('Ключ Товарчик для SEO експерта ко СЕОшная категория Product всему Про100 Бренд тут The END');
        
    }

    
}