<?php

class SaasUserListPage

{
    //   Navigation Page Bar
    public static $NavigationModules = "//body/div[1]/div[3]/div/nav/ul/li[6]/a";
    public static $NavigationModulSaas = "//body/div[1]/div[3]/div/nav/ul/li[6]/ul/li[2]/a";
    public static $NavigationModulSaasTabUser = "//body/div[1]/div[5]/section/div/div[1]/ul/li[2]/a";
    
    //  Сторінка " Список користувачів і їх баланси saas"
    public static $URL = '/admin/components/run/saas/users/lists';
    public static $Title = '//body/div[1]/div[5]/div[3]/section/div[1]/div[1]/span[2]';
    public static $ButtonBack = '//section/div[1]/div[2]/div/a';
    
    // фільтр
    public static $FilterDomainLabel = '//section/div[2]/div/div[2]/form/div/ul/li[1]/label/span';
    public static $FilterDomainInput = '//section/div[2]/div/div[2]/form/div/ul/li[1]/input';
    public static $FilterActiveLabel = '//section/div[2]/div/div[2]/form/div/ul/li[2]/label/span';
    public static function FilterActiveSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[2]/select/option[$number]";
    }
    public static $FilterPhoneLabel = '//section/div[2]/div/div[2]/form/div/ul/li[3]/label/span';
    public static $FilterPhoneInput = '//section/div[2]/div/div[2]/form/div/ul/li[3]/input';
    public static $FilterNameLabel = '//section/div[2]/div/div[2]/form/div/ul/li[4]/label/span';
    public static $FilterNameInput = '//section/div[2]/div/div[2]/form/div/ul/li[4]/input';
    public static $FilterEmailLabel = '//section/div[2]/div/div[2]/form/div/ul/li[5]/label/span';
    public static $FilterEmailInput = '//section/div[2]/div/div[2]/form/div/ul/li[5]/input';
    public static $FilterPhysYurLabel = '//section/div[2]/div/div[2]/form/div/ul/li[6]/label/span';
    public static function FilterPhysYurSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[6]/select/option[$number]";
    }
    public static $FilterCountryLabel = '//section/div[2]/div/div[2]/form/div/ul/li[7]/label/span';
    public static function FilterCountrySelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[7]/select/option[$number]";
    }
    public static $FilterCityLabel = '//section/div[2]/div/div[2]/form/div/ul/li[8]/label/span';
    public static $FilterCityInput = '//section/div[2]/div/div[2]/form/div/ul/li[8]/input';
    public static $FilterTarifLabel = '//section/div[2]/div/div[2]/form/div/ul/li[9]/label/span';
    public static function FilterTarifSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[9]/select/option[$number]";
    }
    public static $FilterLevelLabel = '//section/div[2]/div/div[2]/form/div/ul/li[10]/label/span';
    public static function FilterLevelSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[10]/select/option[$number]";
    }
    
    public static $FilterCategoryLabel = '//section/div[2]/div/div[2]/form/div/ul/li[11]/label/span';
    public static function FilterCategorySelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[11]/select/option[$number]";
    }
    public static $FilterAmountProducntLabel = '//section/div[2]/div/div[2]/form/div/ul/li[12]/label/span';
    public static $FilterAmountProducntInputFrom = '//section/div[2]/div/div[2]/form/div/ul/li[12]/div/label/input[1]';
    public static $FilterAmountProducntInputTo = '//section/div[2]/div/div[2]/form/div/ul/li[12]/div/label/input[2]';
    public static $FilterDiskLimitLabel = '//section/div[2]/div/div[2]/form/div/ul/li[13]/label/span';
    public static $FilterDiskLimitInputFrom = 'html/body/div[1]/div[5]/div[3]/section/div[2]/div/div[2]/form/div/ul/li[13]/div/label/input[1]';
    public static $FilterDiskLimitInputTo = 'html/body/div[1]/div[5]/div[3]/section/div[2]/div/div[2]/form/div/ul/li[13]/div/label/input[2]';
    public static $FilterBalansLabel = '//section/div[2]/div/div[2]/form/div/ul/li[14]/label/span';
    public static $FilterBalansInputFrom = '//section/div[2]/div/div[2]/form/div/ul/li[14]/div/label/input[1]';
    public static $FilterBalansInputTo = '//section/div[2]/div/div[2]/form/div/ul/li[14]/div/label/input[2]';
    public static $FilterManagerLabel = '//section/div[2]/div/div[2]/form/div/ul/li[15]/label/span';
    public static function FilterManagerSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[11]/select/option[$number]";
    }
    public static $FilterDomainEndLabel = '//section/div[2]/div/div[2]/form/div/ul/li[16]/label/span';
    public static function FilterDomainEndSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[16]/select/option[$number]";
    }
    public static $FilterActivatedByEmailLabel = '//section/div[2]/div/div[2]/form/div/ul/li[17]/label/span';
    public static function FilterActivatedByEmailSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[17]/select/option[$number]";
    }
    public static $FilterFillProducts = '//section/div[2]/div/div[2]/form/div/ul/li[18]/label/span';
    public static function FilterFillProductsSelectOption ($number){
        return "//section/div[2]/div/div[2]/form/div/ul/li[18]/select/option[$number]";
    }
    public static $FilterButtonFilter = '//section/div[2]/div/div[2]/form/div/input';
    public static $FilterButtonCancel = '//section/div[2]/div/div[2]/form/div/a';
   
    

    
    //рядки таблиці
    public static function lineIDText($row)                 { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[1]/p"; }
    public static function lineNameText($row)               { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[2]/p"; }
    public static function lineEmailLink($row)              { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[3]/p/a"; }
    public static function linePhoneText($row)              { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[4]"; }
    public static function lineDomainLink($row)             { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[5]/p/a"; }
    public static function lineTarifText($row)              { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[6]"; }
    public static function lineBalansText($row)             { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[7]/input"; }
    public static function lineDomainEndText($row)          { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[8]"; }
    public static function lineDayLeftText($row)            { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[9]"; }
    public static function lineActiveText($row)             { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[10]"; }
    public static function lineDateAdminText($row)          { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[11]"; }
    public static function lineDateCabinetText($row)        { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[12]"; }
    public static function lineFillProductsText($row)       { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[13]"; }
    public static function lineActionlink($row)             { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/label/span"; }
    
     //кнопки, селекти, поля - таблиці.
    public static function ButtonAddModule ($row)           { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[1]/a"; }
    public static function ButtonRemoveModule ($row)        { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[2]/a"; }
    public static function ButtonDisable ($row)             { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[3]/a"; }
    public static function ButtonDelete ($row)              { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[4]/a"; }
    public static function SelectActivate ($row, $number){
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[5]/select/option[$number]";
    }
    public static function SelectManager ($row, $number){
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[6]/select/option[$number]";
    }
    public static function SelectTarif ($row, $number){
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[7]/select/option[$number]";
    }
    public static function FieldAmountPoints ($row)         { return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]/div/div[8]/input"; }
        
    
    
    
    // вікно Додати Модуль
    public static $WindowAddModule = '#addModuleModal';
    public static $WindowAddModuleTitle = '//body/div[1]/div[5]/div[1]/div[1]/h3';
    public static $WindowAddModuleSelect = '//body/div[1]/div[5]/div[1]/div[2]/select';
    public static function WindowAddModuleSelectOption ($number) {
        return "//body/div[1]/div[5]/div[1]/div[2]/select/option[$number]";
    }
    public static $WindowAddModuleButtonClose = '//body/div[1]/div[5]/div[1]/div[1]/button';
    public static $WindowAddModuleButtonBack = '//body/div[1]/div[5]/div[1]/div[3]/button[1]';
    public static $WindowAddModuleButtonSave = '//body/div[1]/div[5]/div[1]/div[3]/button[2]';

  // вікно Видалити Модуль
    public static $WindowRemoveModule = '#delModuleModal';
    public static $WindowRemoveModuleTitle = '//body/div[1]/div[5]/div[2]/div[1]/h3';
    public static $WindowRemoveModuleSelect = '//body/div[1]/div[5]/div[2]/div[2]/select';
    public static function WindowRemoveModuleSelectOption ($number) {
        return "//body/div[1]/div[5]/div[2]/div[2]/select/option[$number]";
    }
    public static $WindowRemoveModuleButtonClose = '//body/div[1]/div[5]/div[2]/div[1]/button';
    public static $WindowRemoveModuleButtonBack = '//body/div[1]/div[5]/div[2]/div[3]/button[1]';
    public static $WindowRemoveModuleButtonSave = '//body/div[1]/div[5]/div[2]/div[3]/button[2]';

}

