<?php

class ProductCategoryEditPage
{
    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockInfo           = '//section[@class="mini-layout"]//table[1]//th';
    public static $TitleBlockSettings       = '//section[@class="mini-layout"]//table[2]//th';
    public static $TitleBlockMeteData       = '//section[@class="mini-layout"]//table[3]//th';
    
    //кнопки
    Public static $ButtonBack               = '.t-d_u';
    Public static $ButtonSave               = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    Public static $ButtonSaveExit           = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    public static $ButtonLanguage           = '.btn.dropdown-toggle.btn-small';
    
    public static $ButtonSelectImage        = '//div[3]//div[@class="controls"]//button';
    public static $ButtonCreateNewTemplate  = '#create_tpl';
    public static $ButtonAutoFit            = '#translateCategoryTitle';
    
    //поля для вводу
    public static $InputName                = '#inputName';
    public static $InputLogo                = '#Img';
    public static $InputDescription         = '#inputDescr';
    
    public static $InputCategoryTemplate    = '#inputTemplateCategory';
    public static $InputURL                 = '#inputUrl';
    
    public static $InputH1                  = '#inputTagmeta';
    public static $InputMetaDescription     = '#inputTagmetadescription';
    public static $InputMetaTitle           = '#inputTagmetakey';
    public static $InputMetaKeywords        = '#inputaddname';
    
    //підказка
    public static $InputCategoryTemplateHelp    = '//section[@class = "mini-layout"]//table[2]//span[@class="help-block"]';

    //чекбокси
    public static $CheckActive                  = '//table[2]//div[@class="control-group"][4]/div[1]/span/span';
    public static $CheckDontShowShortSiteName   = '//table[2]//div[@class="control-group"][5]//span/span';
    
    //селекти
    public static $SelectParent                   = '#ParentId_chosen';
    public static $SelectParentInput              = '#ParentId_chosen input';
    public static $SelectSort                     = 'select[name="order_method"]';
    
    //опції
    public static function selectParentOptions($number) { return "#ParentId_chosen ul li:nth-child($number)"; }
    public static function selectSortOption($number)    { return "select[name='order_method'] >option:nth-child($number)"; }

    //лейбли
    public static $InputNameLabel               = 'label[for="inputName"]';
    public static $SelectParentLabel            = 'label[for="ParentId"]';
    public static $InputLogoLabel               = 'label[for="Img"]';
    public static $InputDescriptionLabel        = 'label[for="inputDescr"]';
    
    public static $InputCategoryTemplateLabel   = 'label[for="inputTemplateCategory"]';
    public static $InputURLLabel                = 'label[for="inputUrl"]';
    public static $SelectSortLabel              = 'label[for="inputSortdefault"]';
    public static $CheckActiveLabel             = '//table[2]//div[@class="control-group"][4]/div[1]/span';
    public static $CheckDontShowShortSiteName   = '//table[2]//div[@class="control-group"][5]/div/span';
    
    public static $InputH1Label                 = 'label[for="inputTagmeta"]';
    public static $InputMetaDescriptionLabel    = 'label[for="inputTagmetadescription"]';
    public static $InputMetaTitleLabel          = 'label[for="inputTagmetakey"]';
    public static $InputMetaKeywordsLabel       = 'label[for="inputaddname"]';
}