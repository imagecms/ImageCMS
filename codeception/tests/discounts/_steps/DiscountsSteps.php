<?php
namespace DiscountsTester;

class DiscountsSteps extends \DiscountsTester
{
    function CreateDiscount($name = null,$amount= null,$method= 'procent',$value,$type,$begin= null ,$autorizate=null,$gift=null,$untilDate=null,$beginValue=null,$endValue=null,$max=null,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/cp/mod_discount');
        $I->click(\DiscountsPage::$CreateDiscount);
        $I->waitForText('Создание скидки');
        if (isset($name)) {
            $I->fillField(\DiscountsPage::$NameDiscountCreate, $name);
        } 
        if (isset($amount)) {
            $I->click(\DiscountsPage::$UnlimitedCheckboxCreate);
            $I->fillField(\DiscountsPage::$AmountOfUse, $amount);
        }
        switch ($method) {
            case 'procent':                
                $I->fillField(\DiscountsPage::$ValueDiscount, $value);
                break;
            case 'fix':
                $I->click(\DiscountsPage::$SelectMethod);
                $I->click(\DiscountsPage::$SelectMethod.'/option[2]');
                $I->fillField(\DiscountsPage::$ValueDiscount, $value);
                break;
        }
        $I->click(\DiscountsPage::$SelectTypeDiscount);
        $I->click(\DiscountsPage::$SelectTypeDiscount."/option[$type]");
        $I->wait('2');                         
        $I->fillField(\DiscountsPage::$BeginValueDiscount, $begin);
                if (isset($autorizate)) {
                    $I->click(\DiscountsPage::$OnlyForAutorizedCheckbox);                    
                }                
                if (isset($gift)) {
                    $I->click(\DiscountsPage::$GiftSertificateCheckbox);                    
                }            
        $I->click(\DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr/td/a");
        $date=$I->grabValueFrom(\DiscountsPage::$OnDateCreate);
        $I->comment($date);
        if (isset($untilDate)) {
            $I->click(\DiscountsPage::$ConstantDiscountCheckboxCreate);
            $I->fillField(\DiscountsPage::$UntilDateCreate, $untilDate);
        }
        switch ($save) {
            case 'save':
                $I->click(\DiscountsPage::$SaveButton);
                $I->waitForText("Редактирование скидки");
                break;
            case 'saveexit':
                $I->click(\DiscountsPage::$SaveAndExitButton);
                $I->waitForText("Скидки интернет-магазина");
                break;
        }
    }    
    
    function edit()
    {
        $I = $this;
    }
}