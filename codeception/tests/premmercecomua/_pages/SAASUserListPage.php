<?php

class SaasUserListPage

{
    //  Сторінка " Список користувачів і їх баланси saas"
    public static $URL = '/admin/components/run/saas/users/lists';
    public static $Title = '//body/div[1]/div[5]/div[3]/section/div[1]/div[1]/span[2]';
    public static $ButtonBack = '';
    
    // фільтр
    public static $FilterDomainLabel = '';
    public static $FilterDomainInput = '';
    public static $FilterActiveLabel = '';
    public static $FilterActiveSelect = '';
    public static $FilterActiveSelectOption = '';
    public static $FilterPhoneLabel = '';
    public static $FilterPhoneInput = '';
    public static $FilterEmailLabel = '';
    public static $FilterEmailInput = '';
    public static $FilterPhysYurLabel = '';
    public static $FilterPhysYurSelect = '';
    public static $FilterPhysYurSelectOption = '';
    public static $FilterCountryLabel = '';
    public static $FilterCountrySelect = '';
    public static $FilterCountrySelectOption = '';
    public static $FilterCityLabel = '';
    public static $FilterCityInput = '';
    public static $FilterTarifLabel = '';
    public static $FilterTarifSelect = '';
    public static $FilterTarifSelectOption = '';
    public static $FilterLevelLabel = '';
    public static $FilterLevelSelect = '';
    public static $FilterLevelSelectOption = '';
    public static $FilterCategoryLabel = '';
    public static $FilterCategorySelect = '';
    public static $FilterCategorySelectOption = '';
    public static $FilterAmountProducntLabel = '';
    public static $FilterAmountProducntInputFrom = '';
    public static $FilterAmountProducntInputTo = '';
    public static $FilterDiskLimitLabel = '';
    public static $FilterDiskLimitInputFrom = '';
    public static $FilterDiskLimitInputTo = '';
    public static $FilterBalansLabel = '';
    public static $FilterBalansInputFrom = '';
    public static $FilterBalansInputTo = '';
    public static $FilterManagerLabel = '';
    public static $FilterManagerSelect = '';
    public static $FilterManagerSelectOption = '';
    public static $FilterDomainCreationLabel = '';
    public static $FilterDomainCreationSelect = '';
    public static $FilterDomainCreationSelectOption = '';
    public static $FilterActivatedByEmailLabel = '';
    public static $FilterActivatedByEmailSelect = '';
    public static $FilterActivatedByEmailSelectOption = '';
    public static $FilterFillProducts = '';
    public static $FilterFillProductsSelect = '';
    public static $FilterFillProductsSelectOption = '';
    public static $FilterButtonFilter = '';
    public static $FilterButtonCancel = '';
   
    

    
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
    public static $WindowAddModuleTitle = '';
    public static $WindowAddModuleSelect = '';
    public static $WindowAddModuleSelectOption = '';
    public static $WindowAddModuleButtonClose = '';
    public static $WindowAddModuleButtonBack = '';
    public static $WindowAddModuleButtonSave = '';

  // вікно Видалити Модуль
    public static $WindowRemoveModuleTitle = '';
    public static $WindowRemoveModuleSelect = '';
    public static $WindowRemoveModuleSelectOption = '';
    public static $WindowRemoveModuleButtonClose = '';
    public static $WindowRemoveModuleButtonBack = '';
    public static $WindowRemoveModuleButtonSave = '';

}

