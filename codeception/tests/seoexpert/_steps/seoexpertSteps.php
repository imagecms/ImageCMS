<?php
namespace SeoExpertTester;

class seoexpertSteps extends \SeoExpertTester

{

    
    //-------------------------Create Category----------------------------------    
    

    
    function SeoCreateCategoryProduct( $createNameCategory = NULL, $addParentCategory = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories/create');
        $I->wait('1');
        if(isset($createNameCategory)){
            $I->fillField('#inputName', $createNameCategory);
        }if(isset($addParentCategory)){ 
            $I->click('//div[1]/div[2]/div/div/a');
            $I->fillField('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/div/input', $addParentCategory);
            $I->click('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/ul/li');
        }$I->click('//button[2]'); 
        $I->wait('2');
    }
    
    
    
    
    function SeoCreateDescriptonAndH1($name_category = NULL, $description_category = NULL, $H1_category = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories');
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;$j++){
        $name_search = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[3]/div/a");
            if($name_search == $name_category){
                $ID_category = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[2]/p");                
            }
        }
        $I->amOnPage("/admin/components/run/shop/categories/edit/$ID_category");        
        $I->wait('3');
        $I->fillField('//table[1]/tbody/tr/td/div/div[2]/div/textarea', $description_category);
        $I->fillField('//table[3]/tbody/tr/td/div/div/div[1]/div/input', $H1_category);
        $I->click('//section/div/div[2]/div/button[1]');        
        $I->wait('1');
    }
    
    
    
    function SeoCreatecategoryMetaData($name_category = NULL,
                                        $meta_description = NULL,
                                        $meta_title = NULL,
                                        $meta_keywords = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories');
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;$j++){
        $name_search = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[3]/div/a");
            if($name_search == $name_category){
                $ID_category = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[2]/p");                
            }
        }
        $I->amOnPage("/admin/components/run/shop/categories/edit/$ID_category");        
        $I->wait('3');
        $I->fillField('//section/form/table[3]/tbody/tr/td/div/div/div[2]/div/input', $meta_description);
        $I->fillField('//section/form/table[3]/tbody/tr/td/div/div/div[3]/div/input', $meta_title);
        $I->fillField('//section/form/table[3]/tbody/tr/td/div/div/div[4]/div/input', $meta_keywords);
        $I->click('//section/div/div[2]/div/button[1]');        
        $I->wait('1');
    }
    
    
    //------------------------Create Brands-------------------------------------
    
    
    
    function SeoCreateBrand ($brandName = NULL, $opisanie = NULL, $title = NULL, $description = NULL, $keywords = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/brands/create');
        $I->wait('2');
        $I->fillField('//section/div[2]/div/form/div/div[1]/table/tbody/tr/td/div/div[1]/div[1]/div/input', $brandName);
        if(isset($opisanie)){
            $I->fillField('//section/div[2]/div/form/div/div[1]/table/tbody/tr/td/div/div[2]/div/textarea', $opisanie);
        }if(isset($title)){
            $I->fillField('//section/div[2]/div/form/div/div[1]/table/tbody/tr/td/div/div[3]/div[1]/div/input', $title);
        }if(isset($description)){
            $I->fillField('//section/div[2]/div/form/div/div[1]/table/tbody/tr/td/div/div[3]/div[2]/div/input', $description);
        }if(isset($keywords)){
            $I->fillField('//section/div[2]/div/form/div/div[1]/table/tbody/tr/td/div/div[3]/div[3]/div/input', $keywords);
        }
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('2');
    }
    
    
    
    
    function SeoCreateProduct ($Name_Product = NULL, $Price_Product = NULL, $Brand_Product = NULL, $Category_Product = NULL, $Additional_Category = NULL) {
        $I = $this;        
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->wait('2');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[1]/div[1]/div/input', $Name_Product);
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/tbody/tr/td[3]/input', $Price_Product);
        $I->wait('1');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[2]/div/div/a/span');
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[2]/div/div/div/div/input', $Brand_Product);
        $I->wait('1');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[2]/div/div/div/ul/li');
        $I->wait('1');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/a/span');
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/div/input', $Category_Product);
        $I->wait('2');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[3]/div/div/div/ul/li');
        $I->wait('1');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[4]/div/div/ul/li/input');
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[4]/div/div/ul/li/input', $Additional_Category);
        $I->wait('1');
        $I->click('//section/form/div[2]/div[1]/div/table/tbody/tr/td/div/div[4]/div/div/div/ul/li');
        $I->wait('1');
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('2');
    }
    
    function SeoProductFillFieldMettaData($name_product = NULL, $Meta_Title = NULL, $Meta_Description = NULL, $Meta_Keywords = NULL ) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/search');
        $I->wait('1');
        $I->fillField('//section/div[2]/table/thead/tr[2]/td[3]/input', $name_product);
        $I->wait('1');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('1');
        $I->click('//section/div[2]/table/tbody/tr/td[3]/div/a');
        $I->wait('1');
        $I->click('//section/form/div[1]/div[1]/a[6]');
        $I->wait('1');
        $I->fillField('//section/form/div[2]/div[6]/div/div[1]/table/tbody/tr/td/div/div/div[2]/div/textarea', $Meta_Title);
        $I->fillField('//section/form/div[2]/div[6]/div/div[1]/table/tbody/tr/td/div/div/div[3]/div/textarea', $Meta_Description);
        $I->fillField('//section/form/div[2]/div[6]/div/div[1]/table/tbody/tr/td/div/div/div[4]/div/textarea', $Meta_Keywords);
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('1');

        
    }
    
    
    function SeoCreateProperty($NameProperty = NULL,
                            $CVS = NULL,
                            $Category = NULL,
                            $Values1 = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//section/div[2]/div[1]/form/table/thead/tr[2]/td[3]/input', $NameProperty);
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('2');
        $get_text = $I->grabCCSAmount($I, '.niceCheck');
        $I->comment("$get_text");
        if($get_text > 1){
            $I->click ('//section/div[2]/div[1]/form/table/tbody/tr/td[3]/a');
            $I->wait('1');
            $I->fillField('//tbody/tr/td/div/div[1]/div/input', $NameProperty);
            $I->fillField('//tbody/tr/td/div/div[2]/div/input', $CVS);
            $I->click('//tbody/tr/td/div/div[10]/div/div/ul/li/input');
            $I->wait('2');
            $I->fillField('//tbody/tr/td/div/div[10]/div/div/ul/li/input', $Category);
            $I->wait('1');
            $I->click('//tbody/tr/td/div/div[10]/div/div/div/ul/li'); 
            $I->fillField('//tbody/tr/td/div/div[12]/div/textarea', $Values1);
            $I->click('//section/div/div[2]/div/button[1]');
            $I->wait('1');
        }  elseif($get_text == 1){
            $I->amOnPage('/admin/components/run/shop/properties/create');
            $I->wait('1');
            $I->fillField('//tbody/tr/td/div/div[1]/div/input', $NameProperty);
            $I->fillField('//tbody/tr/td/div/div[2]/div/input', $CVS); 
            $I->click('//tbody/tr/td/div/div[4]/div[2]/span/span');
            $I->click('//tbody/tr/td/div/div[5]/div[2]/span/span');
            $I->click('//tbody/tr/td/div/div[6]/div[2]/span/span');
            $I->click('//tbody/tr/td/div/div[7]/div[2]/span/span');
            $I->click('//tbody/tr/td/div/div[8]/div[2]/span/span');
            $I->click('//tbody/tr/td/div/div[10]/div/div/ul/li/input');
            $I->wait('2');
            $I->fillField('//tbody/tr/td/div/div[10]/div/div/ul/li/input', $Category);
            $I->wait('1');
            $I->click('//tbody/tr/td/div/div[10]/div/div/div/ul/li'); 
            $I->fillField('//tbody/tr/td/div/div[12]/div/textarea', $Values1);
            $I->click('//section/div/div[2]/div/button[1]');
            $I->wait('1');
        }
    }
    
    
    
     function SeoSelectPropertyInProduct($NameProduct = NULL,
                                    $Property1 = NULL) {
        $I = $this; 
        if(isset($NameProduct)){
         $I->amOnPage('/admin/components/run/shop/search');   
         $I->fillField('//section/div[2]/table/thead/tr[2]/td[3]/input', $NameProduct);
         $I->click('//section/div[1]/div[2]/div/button[1]');
         $I->wait('1');
         $I->click('//section/div[2]/table/tbody/tr/td[3]/div/a');
         $I->wait('2');
         $I->click('//body/div[1]/div[5]/section/form/div[1]/div[1]/a[2]');
         $I->wait('2');
         $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');
            if(isset($Property1)){
                $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');            
                $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[2]');            
            }
        $I->wait('1');
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('1');         
        }        
    }

    
    function ActivateCheckBox($checkbox_xpath = NULL) {
        $I = $this;
        $I->wait('1');
        $active = 'span1 active';
        $inactive = 'span1';
        $checkbox_path = $checkbox_xpath;
        $checkbox_class = $I->grabAttributeFrom($checkbox_path, 'class');
            if($checkbox_class == $active){                
                $I->wait('1');
            }elseif($checkbox_class == $inactive) {
                $I->click($checkbox_path);
                $I->wait('1');
            }
        $I->click(\seoexpertPage::$SeoButtSave);  
        $I->wait('1');
    }
    
    
    
    function DeactivateCheckBox($checkbox_xpath = NULL) {
        $I = $this;
        $I->wait('1');
        $active = 'span1 active';
        $inactive = 'span1';
        $checkbox_path = $checkbox_xpath;
        $checkbox_class = $I->grabAttributeFrom($checkbox_path, 'class');
            if($checkbox_class == $active){                
                $I->wait('1');
                $I->click($checkbox_path);                
            }elseif($checkbox_class == $inactive) {
                $I->wait('1');  
            }
        $I->click(\seoexpertPage::$SeoButtSave);  
        $I->wait('1');
    }
  
    function SeoTextAreaActive ($on = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/settings');
        $I->selectOption('//form/div/div[1]/table/tbody/tr/td/div/div/div/div[5]/div/select', 'none');
        $I->click('//section/div[1]/div[2]/div/button');
        $I->wait('1');
    }
   
    
    
    function GetProductID($name_product) {
        $I = $this;
        $I->amOnPage(\ProductSEOPage::$ListURL);
        $I->wait('1');
        $I->fillField(\ProductSEOPage::$ListFildSearch, $name_product);
        $I->click(\ProductSEOPage::$ListButtonFilter);
        $I->wait('1');
        $ID_product = $I->grabTextFrom(\ProductSEOPage::$ListGrabID);        
        return $ID_product;
    }
    
    
    
    function GetPropertyID($name_property) {
        $I = $this;
        $I->amOnPage(\PropertySEOPage::$ListURL);
        $I->wait('1');
        $I->fillField(\PropertySEOPage::$SearchField, $name_property);
        $I->click(\PropertySEOPage::$ButtonFilter);
        $ID_property = $I->grabTextFrom(\PropertySEOPage::$IDField);
        return $ID_property;
        
    }
    
    
    function GetBrandID($name_brand) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/brands');
        $I->wait('1');
        $I->fillField('//section/div[2]/div/form/table/thead/tr[2]/td[3]/input', $name_brand);
        $I->wait('2');
        $ID_brand = $I->grabTextFrom('//section/div[2]/div/form/table/tbody/tr/td[2]');
        return $ID_brand;
        
    }
    
    
    function GetCategoryID($name_category) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories');
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;$j++){
        $name_search = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[3]/div/a");
            if($name_search == $name_category){
                $ID_category = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[2]/p");
                return $ID_category;
            }
        }
    }
    
    function DefoultValues() {
        $I = $this;
        $I->amOnPage(\seoexpertPage::$SeoUrl);
        $I->click(\seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(\seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(\seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(\seoexpertPage::$SeoBaseOptionMakeAutomaticKeywords);
        $I->click(\seoexpertPage::$SeoBaseSelectDescription);
        $I->click(\seoexpertPage::$SeoBaseOptionMakeAutomaticDescription);
        $I->fillField(\seoexpertPage::$SeoBaseFieldSeparator, '/');
        $I->fillField(\seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldSiteName, 'lastbuild.loc');
        $I->fillField(\seoexpertPage::$SeoBaseFieldShortSiteName, 'mini.loc');
        $I->click(\seoexpertPage::$SeoButtSave);
        $I->wait('1');
    }
    
    
    
    function NullValues() {
        $I = $this;
        $I->amOnPage(\seoexpertPage::$SeoUrl);
        $I->click(\seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(\seoexpertPage::$SeoBaseRadioButtSiteNameNo);
        $I->click(\seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(\seoexpertPage::$SeoBaseOptionMakeAutomaticKeywords);
        $I->click(\seoexpertPage::$SeoBaseSelectDescription);
        $I->click(\seoexpertPage::$SeoBaseOptionMakeAutomaticDescription);
        $I->fillField(\seoexpertPage::$SeoBaseFieldSeparator, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldSiteName, '');
        $I->fillField(\seoexpertPage::$SeoBaseFieldShortSiteName, '');
        $I->click(\seoexpertPage::$SeoButtSave);
        $I->wait('1');
    }
    
    
    
    function AmountProductInFront($Amount_Product_Front = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/settings');
        $I->wait('1');
        $I->fillField('//section/div[2]/div[2]/form/div/div[1]/table/tbody/tr/td/div/div[1]/div/div/input', $Amount_Product_Front);        
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('1');
    }
    
    
    
    
    function CheckValuesInPage ($URL_Page, $values){
        $I = $this;
        $I->amOnPage($URL_Page);
        $I->wait('1');
        $I->seeInPageSource($values);
    }
    
    
    
    
    function SettingsCategorySeoPage($Title = NULL,
                            $Description = NULL,
                            $Length_Desc = NULL,
                            $Amount_Brands = NULL,
                            $Keywords = NULL,
                            $CheckBox_Activate = NULL,
                            $Page_Number = NULL) {
        $I = $this;
        $I->amOnPage(\seoexpertPage::$SeoUrl);
        $I->click(\seoexpertPage::$SeoButtShop);
        $I->fillField(\seoexpertPage::$SeoCategoryTitle, $Title);
        $I->fillField(\seoexpertPage::$SeoCategoryDescription, $Description);
        $I->fillField(\seoexpertPage::$SeoCategoryLength, $Length_Desc);
        $I->fillField(\seoexpertPage::$SeoCategoryCountBrands, $Amount_Brands);
        $I->fillField(\seoexpertPage::$SeoCategoryKeywords, $Keywords);
        $I->wait('1');
        if(isset($CheckBox_Activate)){
            $active = 'span1 active';
            $inactive = 'span1';
            $checkbox_path = $CheckBox_Activate;
        $checkbox_class = $I->grabAttributeFrom($checkbox_path, 'class');
            if($checkbox_class == $active){                
                $I->wait('1');
            }elseif($checkbox_class == $inactive) {
                $I->click($checkbox_path);
                $I->wait('1');
            }
        }
        $I->click(\seoexpertPage::$SeoButtSave);
        $I->wait('1');
        if(isset($Page_Number)){
            $I->fillField('//section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/label[6]/span[2]/textarea', $Page_Number);
            $I->click(\seoexpertPage::$SeoButtSave);
            $I->wait('1');
        }
    }
    
    
    function SetBrandSeoPage($Title = NULL,
                            $Description = NULL,
                            $Pagination = NULL,
                            $Length_Desc = NULL,                            
                            $Keywords = NULL,
                            $CheckBox_Activate = NULL) {
        $I = $this;
        $I->amOnPage(\seoexpertPage::$SeoUrl);
        $I->click(\seoexpertPage::$SeoButtShop);
        $I->fillField(\seoexpertPage::$SeoBrandFieldTitle, $Title);
        $I->fillField(\seoexpertPage::$SeoBrandFieldDescription, $Description);
        $I->fillField(\seoexpertPage::$SeoBrandFieldPagination, $Pagination);
        $I->fillField(\seoexpertPage::$SeoBrandFieldLength, $Length_Desc);
        $I->fillField(\seoexpertPage::$SeoBrandFieldKeywords, $Keywords);
            if(isset($CheckBox_Activate)){
            $active = 'span1 active';
            $inactive = 'span1';
            $checkbox_path = $CheckBox_Activate;
        $checkbox_class = $I->grabAttributeFrom($checkbox_path, 'class');
            if($checkbox_class == $active){                
                $I->wait('1');
            }elseif($checkbox_class == $inactive) {
                $I->click($checkbox_path);
                $I->wait('1');
            }
        $I->click(\seoexpertPage::$SeoButtSave);
        $I->wait('1');        
        }
    }
    
    
    
    function DeleteProductCategorys() {
        $I = $this;
        $first_default_category = 'Телефония, МР3-плееры, GPS';
        $second_default_category = 'Домашнее видео';
        $third_default_category = 'Детские товары';
        $fourth_default_category = 'Активный отдых и туризм';
        $fifth_default_category = 'Музыкальные инструменты';
        $I->amOnPage('/admin/components/run/shop/categories');
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->comment("$amount_rows --- количество строк");
        for($j = 1;$j <= $amount_rows;++$j){
        $name_search = $I->grabTextFrom("//section/div[2]/div/div[2]/div/div[$j]/div/div[3]/div/a");
        $I->comment("$name_search даное имя !!!");
            if($name_search != $first_default_category && $name_search != $second_default_category && $name_search != $third_default_category && $name_search != $fourth_default_category && $name_search != $fifth_default_category){
                $I->click("//section/div[2]/div/div[2]/div/div[$j]/div/div[1]");
                $I->wait('1');
                $I->click('//section/div[1]/div[2]/div/button[1]');
                $I->wait('1');
                $I->click('//section/div[4]/div[3]/a[1]');
                $I->wait('2');
                $I->amOnPage('/admin/components/run/shop/categories');
                $I->wait('2');
                $amount_rows--;
                $j--;
                $I->comment("Status:'$name_search' is Deleting.");                
            }
        }
        $I->comment("Все созданные категории, успешно удалены. Остались только дефолтные !!!");
    }
    
}