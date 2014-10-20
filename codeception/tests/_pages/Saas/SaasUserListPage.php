<?php

class SaasUserListPage {

    public static $URL = '/admin/components/run/saas/users/lists';
    public static $Title = '//body/div[1]/div[5]/div[3]/section/div[1]/div[1]/span[2]';
    public static $ButtonBack = '//section/div[1]/div[2]/div/a';
    public static $ButtonChancheData = '//section/div[1]/div[2]/div/button';
    public static $ButtonStatuses = '//section/div[1]/div[2]/div/a[2]';
    public static $ButtonDepartments = '//section/div[1]/div[2]/div/a[3]';
    //--- Вікно Зміни даних ---- Вікно Зміни даних ----Вікно Зміни даних --/

    public static $WindowChancheData = '//body/div[1]/div[5]/div[3]';
    public static $WindowChancheDataTitle = '//body/div[1]/div[5]/div[3]/div[1]/h3';
    public static $WindowChancheDataButtonClose = '//body/div[1]/div[5]/div[3]/div[1]/button';
    public static $WindowChancheDataButtonBack = '//body/div[1]/div[5]/div[3]/div[3]/a[2]';
    public static $WindowChancheDataButtonChange = '//body/div[1]/div[5]/div[3]/div[3]/a[1]';
    public static $WindowChancheDataSelectStatus = '//body/div[1]/div[5]/div[3]/div[2]/select[1]';
    public static $WindowChancheDataSelectStatusLabel = '//body/div[1]/div[5]/div[3]/div[2]/b[1]';
    public static $WindowChancheDataSelectManager = '//body/div[1]/div[5]/div[3]/div[2]/select[2]';
    public static $WindowChancheDataSelectManagerLabel = '//body/div[1]/div[5]/div[3]/div[2]/b[2]';
    public static $WindowChancheDataSelectDepartmens = '//body/div[1]/div[5]/div[3]/div[2]/select[3]';
    public static $WindowChancheDataSelectDepartmensLabel = '//body/div[1]/div[5]/div[3]/div[2]/b[3]';

    public static function WindowChancheDataSelectStatusOption($number) {
        return "//body/div[1]/div[5]/div[3]/div[2]/select[1]/option[$number]";
    }

    public static function WindowChancheDataSelectManagerOption($number) {
        return "//body/div[1]/div[5]/div[3]/div[2]/select[2]/option[$number]";
    }

    public static function WindowChancheDataSelectDepartmensOption($number) {
        return "//body/div[1]/div[5]/div[3]/div[2]/select[3]/option[$number]";
    }

    //---- Head ------- Head ------- Head ------- Head ------- Head ------- Head ---

    public static $HeadCheckBox = '//section/div[2]/div/div[1]/table/thead/tr/th[1]/span/span';
    public static $HeadID = '//section/div[2]/div/div[1]/table/thead/tr/th[2]';
    public static $HeadName = '//section/div[2]/div/div[1]/table/thead/tr/th[3]';
    public static $HeadEmail = '//section/div[2]/div/div[1]/table/thead/tr/th[4]';
    public static $HeadPhone = '//section/div[2]/div/div[1]/table/thead/tr/th[5]';
    public static $HeadDomain = '//section/div[2]/div/div[1]/table/thead/tr/th[6]';
    public static $HeadStatuse = '//section/div[2]/div/div[1]/table/thead/tr/th[7]';
    public static $HeadTarif = '//section/div[2]/div/div[1]/table/thead/tr/th[8]';
    public static $HeadBalanse = '//section/div[2]/div/div[1]/table/thead/tr/th[9]';
    public static $HeadDomainEnd = '//section/div[2]/div/div[1]/table/thead/tr/th[10]';
    public static $HeadDayLeft = '//section/div[2]/div/div[1]/table/thead/tr/th[11]';
    public static $HeadActive = '///section/div[2]/div/div[1]/table/thead/tr/th[12]';
    public static $HeadDateAdmin = '//section/div[2]/div/div[1]/table/thead/tr/th[13]';
    public static $HeadDateCabinet = '//section/div[2]/div/div[1]/table/thead/tr/th[14]';
    public static $HeadFillProducts = '//section/div[2]/div/div[1]/table/thead/tr/th[15]';
    public static $HeadAction = '//section/div[2]/div/div[1]/table/thead/tr/th[16]';
    //--- фільтр --- --- фільтр ------ фільтр ------ фільтр ------ фільтр ------ фільтр ---

    public static $FilterButtonHide = '//section/div[3]/div/button[1]';
    public static $FilterButtonShow = '//section/div[3]/div/button[2]';
    public static $FilterDomainLabel = "//ul[@class='toggle']//li[1]/label";
    public static $FilterDomainInput = "//ul[@class='toggle']//li[1]/input";
    public static $FilterActiveLabel = "//ul[@class='toggle']//li[2]/label";
    public static $FilterActiveSelect = "//ul[@class='toggle']//li[2]/select";

    public static function FilterActiveSelectOption($number) {
        return "//ul[@class='toggle']//li[2]/select/option[$number]";
    }

    public static $FilterPhoneLabel = "//ul[@class='toggle']//li[3]/label";
    public static $FilterPhoneInput = "//ul[@class='toggle']//li[3]/input";
    public static $FilterNameLabel = "//ul[@class='toggle']//li[4]/label";
    public static $FilterNameInput = "//ul[@class='toggle']//li[4]/input";
    public static $FilterEmailLabel = "//ul[@class='toggle']//li[5]/label";
    public static $FilterEmailInput = "//ul[@class='toggle']//li[5]/input";
    public static $FilterCountryLabel = "//ul[@class='toggle']//li[6]/label";
    public static $FilterCountrySelect = "//ul[@class='toggle']//li[6]/select";

    public static function FilterCountrySelectOption($number) {
        return "//ul[@class='toggle']//li[6]/select/option[$number]";
    }

    public static $FilterCityLabel = "//ul[@class='toggle']//li[7]/label";
    public static $FilterCityInput = "//ul[@class='toggle']//li[7]/input";
    public static $FilterTariffLabel = "//ul[@class='toggle']//li[8]/label";
    public static $FilterTariffSelect = "//ul[@class='toggle']//li[8]/select";

    public static function FilterTariffSelectOption($number) {
        return "//ul[@class='toggle']//li[8]/select/option[$number]";
    }

    public static $FilterLevelLabel = "//ul[@class='toggle']//li[9]/label";
    public static $FilterLevelSelect = "//ul[@class='toggle']//li[9]/select";

    public static function FilterLevelSelectOption($number) {
        return "//ul[@class='toggle']//li[9]select/option[$number]/";
    }

    public static $FilterCategoryLabel = "//ul[@class='toggle']//li[10]/label";
    public static $FilterCategorySelect = "//ul[@class='toggle']//li[10]/select";

    public static function FilterCategorySelectOption($number) {
        return "//ul[@class='toggle']//li[10]/select/option[$number]";
    }

    public static $FilterAmountProducntLabel = "//ul[@class='toggle']//li[11]/label";
    public static $FilterAmountProducntInputFrom = "//ul[@class='toggle']//li[11]//input[@name='prdFrom']";
    public static $FilterAmountProducntInputTo = "//ul[@class='toggle']//li[11]//input[@name='prdTo']";
    public static $FilterDiskLimitLabel = "//ul[@class='toggle']//li[12]/label";
    public static $FilterDiskLimitInputFrom = "//ul[@class='toggle']//li[12]//input[@name='discFrom']";
    public static $FilterDiskLimitInputTo = "//ul[@class='toggle']//li[12]//input[@name='discTo']";
    public static $FilterBalansLabel = "//ul[@class='toggle']//li[13]/label";
    public static $FilterBalansInputFrom = "//ul[@class='toggle']//li[13]//input[@name='balanceFrom']";
    public static $FilterBalansInputTo = "//ul[@class='toggle']//li[13]//input[@name='balanceTo']";
    public static $FilterManagerLabel = "//ul[@class='toggle']//li[14]/label";
    public static $FilterManagerSelect = "//ul[@class='toggle']//li[14]/select";

    public static function FilterManagerSelectOption($number) {
        return "//ul[@class='toggle']//li[14]/select/option[$number]";
    }

    public static $FilterDomainEndLabel = "//ul[@class='toggle']//li[15]/label";
    public static $FilterDomainEnSelect = "//ul[@class='toggle']//li[15]/select";

    public static function FilterDomainEndSelectOption($number) {
        return "//ul[@class='toggle']//li[15]/select/option[$number]";
    }

    public static $FilterActivatedByEmailLabel = "//ul[@class='toggle']//li[16]/label";
    public static $FilterActivatedByEmailSelect = "//ul[@class='toggle']//li[16]/select";

    public static function FilterActivatedByEmailSelectOption($number) {
        return "//ul[@class='toggle']//li[16]/select/option";
    }

    public static $FilterFillProductsLabel = "//ul[@class='toggle']//li[17]/label";
    public static $FilterFillProductsSelect = "//ul[@class='toggle']//li[17]/select";

    public static function FilterFillProductsSelectOption($number) {
        return "//ul[@class='toggle']//li[17]/select/option[$number]";
    }

    public static $FilterStatusesLabel = "//ul[@class='toggle']//li[18]/label";
    public static $FilterStatusesSelect = "//ul[@class='toggle']//li[18]/select";

    public static function FilterStatusesSelectOption($number) {
        return "//ul[@class='toggle']//li[18]/select/option[$number]";
    }

    public static $FilterDepartmentsLabel = "//ul[@class='toggle']//li[19]/label";
    public static $FilterDepartmentsSelect = "//ul[@class='toggle']//li[19]/select";

    public static function FilterDepartmentsSelectOption($number) {
        return "//ul[@class='toggle']//li[19]/select/option[$number]";
    }

    public static $FilterButtonFilter = '//section/div[3]/form/div/input';
    public static $FilterButtonCancel = '//section/div[3]/form/div/a';

    //---- Рядки таблиці

    public static function lineCheckBox($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[1]/span/span";
    }

    public static function lineIDText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[2]/p";
    }

    public static function lineNameText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[3]/p";
    }

    public static function lineEmailLink($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[4]/p/a";
    }

    public static function linePhoneText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[5]";
    }

    public static function lineDomainLink($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[6]/p/a";
    }

    public static function lineStatuseText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[7]/p/a";
    }

    public static function lineTariffText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[8]";
    }

    public static function lineBalansText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[9]/input";
    }

    public static function lineDomainEndText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[10]";
    }

    public static function lineDayLeftText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[11]";
    }

    public static function lineActiveText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[12]";
    }

    public static function lineDateAdminText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[13]";
    }

    public static function lineDateCabinetText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[14]";
    }

    public static function lineFillProductsText($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[15]";
    }

    public static function lineActionlink($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/label/span";
    }

    //-----Силка Список Дій: кнопки, селекти, поля.                                

    public static function ButtonAddModule($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[1]/a";
    }

    public static function ButtonRemoveModule($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[2]/a";
    }

    public static function ButtonDisable($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[3]/a";
    }

    public static function ButtonDelete($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[4]/a";
    }

    public static function SelectActivate($row, $number) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[5]/select/option[$number]";
    }

    public static function SelectManager($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[6]/select";
    }
    public static function SelectManagerOption($row, $number) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[6]/select/option[$number]";
    }

    public static function SelectTariff($row) {
        return "//tbody/tr[$row]/td[16]/div/div[7]/select";
    }
    
    public static function SelectTariffOption($row, $number) {
        return "//tbody/tr[$row]/td[16]/div/div[7]/select/option[$number]";
    }

    public static function InputAmountPoints($row) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[8]/input";
    }

    public static function SelectStatuses($row, $number) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[9]/select/option[$number]";
    }

    public static function SelectDepartments($row, $number) {
        return "//section/div[2]/div/div[1]/table/tbody/tr[$row]/td[16]/div/div[10]/select/option[$number]";
    }

    //----- вікно Додати Модуль

    public static $WindowAddModule = '#addModuleModal';
    public static $WindowAddModuleTitle = '//body/div[1]/div[5]/div[1]/div[1]/h3';
    public static $WindowAddModuleSelect = '//body/div[1]/div[5]/div[1]/div[2]/select';

    public static function WindowAddModuleSelectOption($number) {
        return "//body/div[1]/div[5]/div[1]/div[2]/select/option[$number]";
    }

    public static $WindowAddModuleButtonClose = '//body/div[1]/div[5]/div[1]/div[1]/button';
    public static $WindowAddModuleButtonBack = '//body/div[1]/div[5]/div[1]/div[3]/button[1]';
    public static $WindowAddModuleButtonSave = '//body/div[1]/div[5]/div[1]/div[3]/button[2]';
    //------ вікно Видалити Модуль

    public static $WindowRemoveModule = '#delModuleModal';
    public static $WindowRemoveModuleTitle = '//body/div[1]/div[5]/div[2]/div[1]/h3';
    public static $WindowRemoveModuleSelect = '//body/div[1]/div[5]/div[2]/div[2]/select';

    public static function WindowRemoveModuleSelectOption($number) {
        return "//body/div[1]/div[5]/div[2]/div[2]/select/option[$number]";
    }

    public static $WindowRemoveModuleButtonClose = '//body/div[1]/div[5]/div[2]/div[1]/button';
    public static $WindowRemoveModuleButtonBack = '//body/div[1]/div[5]/div[2]/div[3]/button[1]';
    public static $WindowRemoveModuleButtonSave = '//body/div[1]/div[5]/div[2]/div[3]/button[2]';

}
