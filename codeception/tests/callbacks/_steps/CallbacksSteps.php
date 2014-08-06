<?php
namespace CallbacksTester;

class CallbacksSteps extends \CallbacksTester
{
    //Callbacks
    function CreateCallback($name,$phone,$comment = null)
    {
        $I = $this;
        $I->amOnPage('/');
        $I->waitForText('Заказать звонок');
        $I->click(\CallbacksPage::$OrderCallButton);
        $I->waitForElement(\CallbacksPage::$CallMeButton);
        $I->fillField(\CallbacksPage::$UserNameCreate, $name);
        $I->fillField(\CallbacksPage::$TelephoneCreate, $phone);
        if (isset($comment)) {
            $I->fillField(\CallbacksPage::$CommentCreate, $comment);
        }        
        $I->click(\CallbacksPage::$CallMeButton);
    }    
    
    function CheckListLandingAndEditingPage($name1,$phone1,$comment1 = null)
    {
        $I = $this;
        $I->amOnPage('/admin');
        $I->click(\NavigationBarPage::$Orders);
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click(\NavigationBarPage::$CallbacksList);
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('5');
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment("$kil1");
        $kil=  explode(" ", $kil1);
        foreach ($kil as $key =>$value) {
            if($value)  $I->comment("$key: $value");
        }   
        $kil=$kil[4];        
        $I->comment("$kil");
        if ($kil<=14){
            $I->see($name1, \CallbacksPage::UserNameLine("last()").'/..');
            $I->see($phone1, \CallbacksPage::PhoneLine("last()"));
            $I->click(\CallbacksPage::UserNameLine("last()"));
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $I->see($comment1, \CallbacksPage::$CommentEdit);
        }
        else{
            $I->click(\CallbacksPage::PaginationButton(last()-1));
            $I->wait('2');
            $I->see($name1, \CallbacksPage::UserNameLine("last()").'/..');
            $I->see($phone1, \CallbacksPage::PhoneLine("last()"));
            $I->click(\CallbacksPage::UserNameLine("last()"));
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $I->see($comment1, \CallbacksPage::$CommentEdit);
        }
    }
    
    function EditCallback($name,$phone,$comment,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $I->click(\CallbacksPage::UserNameLine('1'));
        $I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
        $I->fillField(\CallbacksPage::$UserNameEdit, $name);
        $I->fillField(\CallbacksPage::$TelephoneEdit, $phone);
        $I->fillField(\CallbacksPage::$CommentEdit, $comment); 
        $datAtr=$I->grabAttributeFrom(\CallbacksPage::$DateEdit, "readonly");
        $I->assertEquals($datAtr, 'true');
        switch ($save) {
            case 'save':
                $I->click(\CallbacksPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\CallbacksPage::$SaveAndExitButton);
                break;
        }
    }
    
    function CheckFieldsEditCallback($name1,$phone1,$comment1)
    {
        $I = $this;
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(\CallbacksPage::$UserNameEdit, $name1);
        $I->seeInField(\CallbacksPage::$TelephoneEdit, $phone1);
        $I->seeInField(\CallbacksPage::$CommentEdit, $comment1);
        $datAtr=$I->grabAttributeFrom(\CallbacksPage::$DateEdit, "readonly");
        $I->assertEquals($datAtr, 'true');
    }
    
    //CallbacksStatuses
    
    function CreateStatusCallback($name,$name1,$default=null)
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(\CallbacksPage::$NameStatus, $name);
        $I->seeInField(\CallbacksPage::$NameStatus, $name);
        if (isset($default)) {
            $I->click(\CallbacksPage::$DefaultStatusCheckboxCreate);
            $I->wait('1');
            $default=$I->grabAttributeFrom(\CallbacksPage::$DefaultStatusCheckboxCreate.'/input', 'checked');
            $I->assertEquals($default, 'true');
        }
        $I->click(\CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(\CallbacksPage::$NameStatus, $name1);
        if (isset($default)) {
            $default2=$I->grabAttributeFrom(\CallbacksPage::$DefaultStatusCheckboxEdit.'/input', 'checked');
            $I->assertEquals($default2, 'true');            
        }
    }  
    
    function CheckStatusCallbackListLanding($name,$default)
    {
        $I = $this;
        $I->click(\CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
        $I->see($name, \CallbacksPage::ThemeNameLine('last()'));
        $def=$I->grabAttributeFrom(\CallbacksPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($def, $default);
    }  
    
    function EditStatusCallback($name,$name1,$save='save',$default=null)
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click(\CallbacksPage::StatusNameLine('1'));
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(\CallbacksPage::$NameStatus, $name);
        $I->seeInField(\CallbacksPage::$NameStatus, $name);
        if (isset($default)) {
            $I->click(\CallbacksPage::$DefaultStatusCheckboxEdit.'/input');
            $I->wait('2');}
        switch ($save) {
            case 'save':
                $I->click(\CallbacksPage::$SaveButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Изменения сохранены');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->seeInField(\CallbacksPage::$NameStatus, $name1); 
                if (isset($default)) {
                    //$I->wait('10');
                    $default2=$I->grabAttributeFrom(\CallbacksPage::$DefaultStatusCheckboxEdit.'/input', 'checked');
                    $I->comment("$default2");
                    $I->assertEquals("$default2", "true");   
                }    
                break;
            case 'saveexit':
                $I->click(\CallbacksPage::$SaveAndExitButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Изменения сохранены');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->waitForText('Статусы обратных звонков');
                $I->see($name1, \CallbacksPage::StatusNameLine('1'));
                if (isset($default)) {
                    $def=$I->grabAttributeFrom(\CallbacksPage::ActiveButtonLine('1'), 'class');
                    $def=  trim((string)$def);
                    $I->assertEquals($def, 'prod-on_off');   
                } 
                break;
        }           
    }
        
    //CallbacksThemes
    
    function CreateThemeCallback($name,$name1,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(\CallbacksPage::$NameTheme, $name);
        $I->seeInField(\CallbacksPage::$NameTheme, $name);
        switch ($save) {
            case 'save':
                $I->click(\CallbacksPage::$SaveButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Тема начата');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->seeInField(\CallbacksPage::$NameTheme, $name1);
                break;
            case 'saveexit':
                $I->click(\CallbacksPage::$SaveAndExitButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Тема начата');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->waitForText('Темы обратных звонков');                
                $I->see($name1, \CallbacksPage::ThemeNameLine('last()'));
                break;
        }
    } 
    
    function EditThemeCallback($name,$name1,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click(\CallbacksPage::ThemeNameLine('1'));
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(\CallbacksPage::$NameTheme, $name);
        $I->seeInField(\CallbacksPage::$NameTheme, $name);
        switch ($save) {
            case 'save':
                $I->click(\CallbacksPage::$SaveButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Изменения сохранены');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->seeInField(\CallbacksPage::$NameTheme, $name1);
                break;
            case 'saveexit':
                $I->click(\CallbacksPage::$SaveAndExitButton);
                $I->waitForElementVisible('.alert.in.fade.alert-success');
                $I->see('Изменения сохранены');
                $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                $I->waitForText('Темы обратных звонков');
                $I->see($name1, './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
                break;
        }        
    }           
}