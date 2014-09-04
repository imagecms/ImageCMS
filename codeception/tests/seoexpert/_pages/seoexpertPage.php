<?php

class seoexpertPage
{

    
    public static $SeoUrl = "/admin/components/init_window/mod_seo";   
    public static $SeoTitle = "//div[1]/div[5]/section/div/div[1]/span[2]";
    public static $SeoButtBack = "//div[1]/div[5]/section/div/div[2]/div/a/span[2]";
    public static $SeoButtSave = "//div[1]/div[5]/section/div/div[2]/div/button";
    public static $SeoButtBase = "//div[1]/div[5]/section/form/div/div[1]/div/a[1]";
    public static $SeoButtShop = "//body/div[1]/div[5]/section/form/div/div[1]/div/a[2]";
    public static $SeoInfoPopoverTitle = ".popover-title";
    public static $SeoInfoPopoverContent = ".popover-content";
    
    //   Base Page
    
    public static $SeoBaseRadioButtSiteNameYes = "//table[1]/tbody/tr/td/div/div/div/div[1]/div/div/span[1]/span";
    public static $SeoBaseRadioButtSiteNameNo = "//tbody/tr/td/div/div/div/div[1]/div/div/span[2]/span";
    public static $SeoBaseRadioButtCategoryNameYes = "//tbody/tr/td/div/div/div/div[2]/div/div/span[1]/span";
    public static $SeoBaseRadioButtCategoryNameNo = "//tbody/tr/td/div/div/div/div[2]/div/div/span[2]/span";
    public static $SeoBaseFieldSeparator = "//table[1]/tbody/tr/td/div/div/div/div[3]/div/input";
    public static $SeoBaseSelectKeywords = "//table[1]/tbody/tr/td/div/div/div/div[4]/div/select";
    public static $SeoBaseSelectDescription = "//table[1]/tbody/tr/td/div/div/div/div[5]/div/select";
    public static $SeoBaseFieldSiteName = "//tbody/tr/td/div/div/div/div/div[1]/div/input";
    public static $SeoBaseFieldShortSiteName = "//tbody/tr/td/div/div/div/div/div[2]/div/input";
    public static $SeoBaseFieldDescription = "//tbody/tr/td/div/div/div/div/div[3]/div/input";
    public static $SeoBaseFieldKeywords = "//tbody/tr/td/div/div/div/div/div[4]/div/input";
    
    //   Shop Page
       
         // Product Block
    
    public static $SeoProductBlockTitle = "//div[2]/table/tbody/tr[1]/td/div/div/div[1]/div[2]";
    public static $SeoProductTitle = "//tbody/tr[1]/td/div/div/label[1]/span[2]/textarea";
    public static $SeoProductDescription = "//tbody/tr[1]/td/div/div/label[2]/span[2]/textarea";
    public static $SeoProductLength = "//table/tbody/tr[1]/td/div/div/label[3]/span[2]/input";
    public static $SeoProductKeywords = "//tbody/tr[1]/td/div/div/label[4]/span[2]/textarea";
    public static $SeoProductCheckBoxActive = "//tbody/tr[1]/td/div/div/div[2]/div/span[2]/span";
    public static $SeoProductCheckBoxMetadata = "//tbody/tr[1]/td/div/div/div[3]/div/span[2]/span";
    public static $SeoProductButtAdvanced = "//table/tbody/tr[1]/td/div/div/div[4]/div/a";
    
    //  Advanced Page
    
    public static $SeoAdvencedButtBack = "//section/div/div[2]/div/a[1]/span[2]";
    public static $SeoAdvencedButtDelete = "//body/div[1]/div[5]/section/div/div[2]/div/a[2]";
    public static $SeoAdvencedButtAddCategory = "//body/div[1]/div[5]/section/div/div[2]/div/a[3]";
    public static $SeoAdvencedChekBoxMain = "//body/div[1]/div[5]/section/table/thead/tr/th[1]/span/span";
    public static $SeoAdvencedChekBoxFirst = "//body/div[1]/div[5]/section/table/tbody/tr/td[1]/span/span";
    public static $SeoAdvencedChekBoxActive = "//body/div[1]/div[5]/section/table/tbody/tr/td[3]/div/span";
    public static $SeoAdvencedChekBoxMetaData = "//body/div[1]/div[5]/section/table/tbody/tr/td[4]/div/span";
    public static $SeoAdvencedLinkCategory = "html/body/div[1]/div[5]/section/table/tbody/tr[1]/td[2]/a";    
    public static $SeoAdvencedDeleteWindowTitle = "//body/div[1]/div[5]/div/div[1]/h3";    
    public static $SeoAdvencedDeleteWindowMessage = "//body/div[1]/div[5]/div/div[2]/p";    
    public static $SeoAdvencedDeleteWindowButtX = "//body/div[1]/div[5]/div/div[1]/button";    
    public static $SeoAdvencedDeleteWindowButtDelete = "//body/div[1]/div[5]/div/div[3]/a[1]";    
    public static $SeoAdvencedDeleteWindowButtCancel = "//body/div[1]/div[5]/div/div[3]/a[2]";    

    //  Create Meta-Data For Category Page
    
    public static $SeoCreatePageTitle = "//body/div[1]/div[5]/section/div/div[1]/span[2]";
    public static $SeoCreatePageButtBack = "//body/div[1]/div[5]/section/div/div[2]/div/a/span[2]";
    public static $SeoCreatePageButtSave = "//body/div[1]/div[5]/section/div/div[2]/div/button";
    public static $SeoCreatePageFieldCategory = "//table/tbody/tr/td/div/div/label[1]/span[2]/input[1]";
    public static $SeoCreatePageSelectMenu = "//body/ul[1]";
    public static $SeoCreatePageSelectCategory = "//body/ul[1]/li/a";
    public static $SeoCreatePageFieldTitle = "//tbody/tr/td/div/div/label[2]/span[2]/input";
    public static $SeoCreatePageFieldDescription = "//tbody/tr/td/div/div/label[3]/span[2]/input";
    public static $SeoCreatePageFieldLength = "//tbody/tr/td/div/div/label[4]/span[2]/input";
    public static $SeoCreatePageFieldKeywords = "//tbody/tr/td/div/div/label[5]/span[2]/input";
    public static $SeoCreatePageCheckBoxActive = "//tbody/tr/td/div/div/div[1]/div/span[2]/span";
    public static $SeoCreatePageCheckBoxMetaData = "//tbody/tr/td/div/div/div[2]/div/span[2]/span";
    
    
    // Edit Meta-Data For Category Page
    
    public static $SeoEditPageTitle = "//body/div[1]/div[5]/section/div/div[1]/span[2]";
    public static $SeoEditPageButtBack = "//body/div[1]/div[5]/section/div/div[2]/div/a/span[2]";
    public static $SeoEditPageButtSave = "//body/div[1]/div[5]/section/div/div[2]/div/button[1]";
    public static $SeoEditPageButtSaveAndBack = "//body/div[1]/div[5]/section/div/div[2]/div/button[2]";
    public static $SeoEditPageFieldDescription = "//tbody/tr/td/div/div/label[1]/span[2]/input";
    public static $SeoEditPageFieldLength = "//table/tbody/tr/td/div/div/label[2]/span[2]/input";
    public static $SeoEditPageFieldKeywords = "//tbody/tr/td/div/div/label[3]/span[2]/input";
    public static $SeoEditPageCheckBoxActive = "//tbody/tr/td/div/div/div[1]/div/span[2]/span";
    public static $SeoEditPageCheckBoxMetaDta = "//tbody/tr/td/div/div/div[2]/div/span[2]/span";




    //  Category Block
    
    public static $SeoCategoryBlockTitle = "//tbody/tr[2]/td/div/div/div[1]/div[2]";
    public static $SeoCategoryTitle = "//tbody/tr[2]/td/div/div/label[1]/span[2]/textarea";
    public static $SeoCategoryDescription = "//tbody/tr[2]/td/div/div/label[2]/span[2]/textarea";
    public static $SeoCategoryLength = "//tbody/tr[2]/td/div/div/label[3]/span[2]/input";
    public static $SeoCategoryCountBrands = "//tbody/tr[2]/td/div/div/label[4]/span[2]/input";
    public static $SeoCategoryKeywords = "//tbody/tr[2]/td/div/div/label[5]/span[2]/textarea";
    public static $SeoCategoryPaginationPage = "//tbody/tr[2]/td/div/div/label[6]/span[2]/textarea";
    public static $SeoCategoryCheckBoxActive = "//tbody/tr[2]/td/div/div/div[2]/div/span[2]/span";
    public static $SeoCategoryMetadata = "//tbody/tr[2]/td/div/div/div[3]/div/span[2]/span";
   
 
    // Subcategory Block
    
    public static $SeoSubCatBlockTitle = "//tbody/tr[3]/td/div/div/div[1]/div[2]";
    public static $SeoSubCatFieldTitle = "//tbody/tr[3]/td/div/div/label[1]/span[2]/textarea";
    public static $SeoSubCatFieldDescription = "//tbody/tr[3]/td/div/div/label[2]/span[2]/textarea";
    public static $SeoSubCatFieldLength = "//tbody/tr[3]/td/div/div/label[3]/span[2]/input";
    public static $SeosubCatFieldCountBrands = "//tbody/tr[3]/td/div/div/label[4]/span[2]/input";
    public static $SeoSubCatFieldKeywords = "//tbody/tr[3]/td/div/div/label[5]/span[2]/textarea";
    public static $SeoSubCatFieldPaginationPage = "//tbody/tr[3]/td/div/div/label[6]/span[2]/textarea";
    public static $SeoSubCatCheckBoxActive = "//tbody/tr[3]/td/div/div/div[2]/div/span[2]/span";
    public static $SeoSubCatMetadata = "//tbody/tr[3]/td/div/div/div[3]/div/span[2]/span";
    
    
    // Brand Block
    
    
    public static $SeoBrandBlockTitle = "//table/tbody/tr[4]/td/div/div/div[1]/div[2]";
    public static $SeoBrandFieldTitle = "//tbody/tr[4]/td/div/div/label[1]/span[2]/textarea";
    public static $SeoBrandFieldDescription = "//tbody/tr[4]/td/div/div/label[2]/span[2]/textarea";
    public static $SeoBrandFieldPagination = "//tbody/tr[4]/td/div/div/label[3]/span[2]/textarea";
    public static $SeoBrandFieldLength = "//tbody/tr[4]/td/div/div/label[4]/span[2]/input";
    public static $SeoBrandFieldKeywords = "//tbody/tr[4]/td/div/div/label[5]/span[2]/textarea";
    public static $SeoBrandCheckBoxActive = "//tbody/tr[4]/td/div/div/div[2]/div/span[2]/span";
    public static $SeoBrandCheckBoxMetyaData = "//tbody/tr[4]/td/div/div/div[3]/div/span[2]/span";
  
    
    // Search Block
    
    public static $SeoSearchBlockTitle = "//table/tbody/tr[5]/td/div/div/div[1]/div[2]";
    public static $SeoSearchFieldTitle = "//tbody/tr[5]/td/div/div/label[1]/span[2]/textarea";
    public static $SeoSearchFielddescription = "//tbody/tr[5]/td/div/div/label[2]/span[2]/textarea";
    public static $SeoSearchFieldKeywords = "//tbody/tr[5]/td/div/div/label[3]/span[2]/textarea";
    public static $SeoSearchCheckBoxActive = "//tbody/tr[5]/td/div/div/div[2]/div/span[2]/span";
    
    
    
    
    
}