<?php

 class SaasDepartmenstPage

{
    public static $ListURL = '/admin/components/cp/saas/users_departments/allUsersDepartments';
    

    public static $ListTitle = '//body/div[1]/div[5]/div/section/div[1]/div[1]/span[2]';
    public static $ListButtonBack = '//body/div[1]/div[5]/div/section/div[1]/div[2]/div/a[1]';
    public static $ListButtonCreate = '//body/div[1]/div[5]/div/section/div[1]/div[2]/div/a[2]';
    public static $ListButtonDelete = '//body/div[1]/div[5]/div/section/div[1]/div[2]/div/button';
    public static $ListHeadCheckBox = '//section/div[2]/div/div/table/thead/tr/th[1]/span/span';
    public static $ListHeadID = '//section/div[2]/div/div/table/thead/tr/th[2]';
    public static $ListHeadName = '//section/div[2]/div/div/table/thead/tr/th[3]';
    public static $ListHeadDescription = '//section/div[2]/div/div/table/thead/tr/th[4]';
    public static $ListHeadDate = '//section/div[2]/div/div/table/thead/tr/th[5]';
    
    public static function LineCheckBox($row)             { return "//section/div[2]/div/div/table/tbody/tr[$row]/td[1]/span/span"; }
    public static function LineID($row)                   { return "//section/div[2]/div/div/table/tbody/tr[$row]/td[2]/a"; }
    public static function LineName($row)                 { return "//section/div[2]/div/div/table/tbody/tr[$row]/td[3]/a"; }
    public static function LineDescription($row)          { return "//section/div[2]/div/div/table/tbody/tr[$row]/td[4]"; }
    public static function LineDate($row)                 { return "//section/div[2]/div/div/table/tbody/tr[$row]/td[5]"; }
    
    public static $WindowDelete = '//body/div[1]/div[5]/div/div';
    public static $WindowDeleteTitle = '//body/div[1]/div[5]/div/div/div[1]/h3';
    public static $WindowDeleteQuestion = '//body/div[1]/div[5]/div/div/div[1]/button';
    public static $WindowDeleteButtonClose = '//body/div[1]/div[5]/div/div/div[1]/button';
    public static $WindowDeleteButtonCancel = '//body/div[1]/div[5]/div/div/div[3]/a[2]';
    public static $WindowDeleteButtonDelete = '//body/div[1]/div[5]/div/div/div[3]/a[1]';
    
    public static $CreateTitle = '//body/div[1]/div[5]/section/div/div[1]/span[2]';
    public static $CreateBlockStatuslabel = '//body/div[1]/div[5]/section/form/div/table/thead/tr/th';
    public static $CreateButtonBack = '//body/div[1]/div[5]/section/div/div[2]/div/a';
    public static $CreateButtonSave = '//body/div[1]/div[5]/section/div/div[2]/div/button';
    public static $CreateInputName = '//section/form/div/table/tbody/tr/td/div/div/div[1]/div/input';
    public static $CreateInputNameLabel = '//section/form/div/table/tbody/tr/td/div/div/div[1]/label';
    public static $CreateInputDescription = '//table/tbody/tr/td/div/div/div[2]/div/textarea';
    public static $CreateInputDescriptionLabel = '//section/form/div/table/tbody/tr/td/div/div/div[2]/label';
    
    public static $EditTitle = '//body/div[1]/div[5]/section/div/div[1]/span[2]';
    public static $EditBlockStatusLabel = '//body/div[1]/div[5]/section/form/div/table/thead/tr/th';
    public static $EditButtonBack = '//body/div[1]/div[5]/section/div/div[2]/div/a';
    public static $EditButtonSave = '//body/div[1]/div[5]/section/div/div[2]/div/button';
    public static $EditInputName = '//section/form/div/table/tbody/tr/td/div/div/div[1]/div/input';
    public static $EditInputNameLabel = '//section/form/div/table/tbody/tr/td/div/div/div[1]/label';
    public static $EditInputDescription = '//body/p';
    public static $EditInputDescriptionLabel = '//section/form/div/table/tbody/tr/td/div/div/div[2]/label';

}