<?php

class ProductsCreatePage
{
    public static $URL                      = '/admin/components/run/shop/products/create';
    
    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockSettings       = '//div[@class="form-horizontal"]/table/thead//th';
    
    public static $TabSettingsBlockMetaTitle        = '';
    public static $TabSettingsBlockAdditionalTitle  = '';

    //--------------------------------------------------------------------------
    //----------------------------КНОПКИ----------------------------------------
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    public static $ButtonHit                = '//div[@class="inside_padd"]/div[1]/div[2]//button[1]';
    public static $ButtonHot                = '//div[@class="inside_padd"]/div[1]/div[2]//button[2]';
    public static $ButtonAction             = '//div[@class="inside_padd"]/div[1]/div[2]//button[3]';
    
    public static $ButtonAddVariant         = '#addVariant';
    
        //перемикач
        public static $ToggleActive     =  'span.prod-on_off' ;

        //таби
        public static $TabProduct   = '//div[@class="clearfix"]//a[1]';
        public static $TabSettings  = '//div[@class="clearfix"]//a[2]';
    
    
    //--------------------------------------------------------------------------
    //-------------------------ПОЛЯ ДЛЯ ВВОДУ-----------------------------------
    public static $InputName                = '#Name';
    public static $InputOldPrice            = '#oldP';
    public static $InputShortDescription    = '#ShortDescriptions';
    public static $InputFullDescription     = '#FullDescription';
    
    
    //--------------------------------------------------------------------------
    //-------------------------------ТЕКСТ--------------------------------------
    public static $TextOldPriceCurrency     = '#oldP';

    
    //--------------------------------------------------------------------------
    //---------------------ТАБЛИЦЯ ТОВАРУ---------------------------------------
   public static $HeadProductText       = '//div[@class="variantsProduct"]//th[1]';
   public static $HeadVariantNameText   = '//div[@class="variantsProduct"]//th[2]';
   public static $HeadPriceText         = '//div[@class="variantsProduct"]//th[3]';
   public static $HeadCurrencyText      = '//div[@class="variantsProduct"]//th[4]';
   public static $HeadArticleText       = '//div[@class="variantsProduct"]//th[5]';
   public static $HeadAmountText        = '//div[@class="variantsProduct"]//th[6]';
   
   //InputFile можна прикріпити файл зображення 
   //(з папки _data) з допомогою attachFile($InputFile,'name.jpg') 
   public static function lineProductInputFile($row)                { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[1]//input[@type='file']"; }
   //загрузить из интернета
   public static function lineProductButtonDownload($row)           { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[1]/div//button[2]"; }
   public static function lineProductButtonDelete($row)             { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[1]/button"; }
   
   public static function lineVariantNameInput($row)                { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[2]/input[@type='text']"; }
   public static function linePriceInput($row)                      { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[3]/input[@type='text']"; }
   
   public static function lineCurrencySelect($row)                  { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[4]/select"; }
   public static function lineCurrencySelectOption($row,$number)    { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[4]/select/option[$number]"; }
   
   public static function lineArticleInput($row)                    { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[5]/input[@type='text']"; }
   public static function lineAmount($row)                          { return "//div[@class='variantsProduct']//tbody/tr[$row]/td[6]/input[@type='text']"; }
   
    //--------------------------------------------------------------------------
    //-----------------ВІКНО ЗАГРУЗКИ ЗОБРАЖЕННЯ З ІНТЕРНЕТУ--------------------
   public static $WindowDownload                         = '#images_modal';
   public static $WindowDownloadTitle                    = '#images_modal .modal-header h3';
   public static $WindowDownloadButtonClose              = '#images_modal .modal-header .close';
   public static $WindowDownloadButtonSearch             = '#images_modal .modal-header button#search_images';
   public static $WindowDownloadButtonMore               = '#loadMoreImages';
   public static $WindowDownloadTextNoElements           = '#image_search_result p:nth-child(1)';
   public static $WindowDownloadTextPlease               = '#image_search_result p:nth-child(2)';
   public static $WindowDownloadCheckSaveAdditional      = '#images_modal .modal-footer input';
   public static $WindowDownloadCheckSaveAdditionalLabel = '#images_modal .modal-footer label';
   public static $WindowDownloadButtonSave               = '#images_modal .modal-footer a:nth-child(3)';
   public static $WindowDownloadButtonCancel             = '#images_modal .modal-footer a:nth-child(2)';
   public static function windowDownloadImage($number)  {return "#image_search_result span:nth-child($number)";}

    //--------------------------------------------------------------------------
    //----------------------------СЕЛЕКТИ---------------------------------------
    public static $SelectBrand                        = '#inputParent_chosen';
    public static $SelectBrandInput                   = '#inputParent_chosen input';
    public static function selectBrandOption($number) { return "//#inputParent_chosen ul li:nth-child($number)";}
    
    
    public static $SelectCategory                     = '#comment_chosen';
    public static $SelectCategoryInput                = '#comment_chosen input';
    public static function selectCategoryOption($number) { return "#comment_chosen ul li:nth-child($number)";}
    
    
    public static $SelectAdditionalCategory           = '#iddCategory_chosen';
    public static $SelectAdditionalCategoryInput      = '#iddCategory_chosen input';
    public static function selectAdditionalCategoryOption($number) { return "#iddCategory_chosen ul.chosen-results li:nth-child($number)";}


    //--------------------------------------------------------------------------
    //------------------------------ЛЕЙБЛИ--------------------------------------
    public static $InputNameLabel               = '//div[@class="inside_padd"]/div[1]/div[1]/label';
    public static $InputOldPriceLabel           = '//div[@class="inside_padd"]/div[1]/div[3]/label';
    public static $InputShortDescriptionLabel   = '//div[@class="inside_padd"]/div[5]/label';
    public static $InputFullDescriptionLabel    = '//div[@class="inside_padd"]/div[6]/label';
    
    public static $ToggleActiveLabel            = '//div[@class="inside_padd"]/div[1]/div[1]/div/div/span';
    
    public static $TableProductLabel            = '//div[@class="inside_padd"]/div[1]/div[4]/label';
    
    public static $FieldStatusLabel                 = '//div[@class="inside_padd"]/div[1]/div[2]/label';
    
    public static $SelectBrandLabel                 = '//div[@class="inside_padd"]/div[2]/label';
    public static $SelectCategoryLabel              = '//div[@class="inside_padd"]/div[3]/label';
    public static $SelectAdditionalCategoryLabel    = '//div[@class="inside_padd"]/div[4]/label';

    //--------------------------------------------------------------------------
    //------------------------------ТАБ НАСТРОЙКИ-------------------------------
    
    
    public static $TabSettingsInputURL              = '#Url';
    public static $TabSettingsInputMetaTitle        = '#Mtag';
    public static $TabSettingsInputMetaDescription  = '#mDesc';
    public static $TabSettingsInputMetaKeywords     = '#mKey';
    
    public static $TabSettingsInputCreateDate       = '#dCreate';
    public static $TabSettingsInputMainTemplate     = '#templateGH';
    
    public static $TabSettingsButtonUpdate          = '#translateProductUrl';
    
    public static $TabSettingsRadioCommentYes       = '//div[@id="settings"]/div/div[2]//div[@class="inside_padd"]/div/div/div[1]/div/span[1]/span';
    public static $TabSettingsRadioCommentNo        = '//div[@id="settings"]/div/div[2]//div[@class="inside_padd"]/div/div/div[1]/div/span[2]/span';
    
    public static $TabSettingsInputURLLabel              = 'label[for="Url"]';
    public static $TabSettingsInputMetaTitleLabel        = 'label[for="Mtag"]';
    public static $TabSettingsInputMetaDescriptionLabel  = 'label[for="mDesc"]';
    public static $TabSettingsInputMetaKeywordsLabel     = 'label[for="mKey"]';
    public static $TabSettingsInputCreateDateLabel       = 'label[for="dCreate"]';
    public static $TabSettingsInputMainTemplateLabel     = 'label[for="templateGH"]';
 
    public static $TabSettingsFieldCommentLabel          = '//div[@id="settings"]/div/div[2]//div[@class="inside_padd"]/div/div/div[1]/label';
    
    public static $TabSettingsRadioCommentYesLabel       = '//div[@id="settings"]/div/div[2]//div[@class="inside_padd"]/div/div/div[1]/div/span[1]';
    public static $TabSettingsRadioCommentNoLabel        = '//div[@id="settings"]/div/div[2]//div[@class="inside_padd"]/div/div/div[1]/div/span[2]';

}