<?php
use \CallbacksTester;

class DeleteThemeCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    protected $rows;
    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/themes");
        $I->waitForText("Темы обратных звонков");
    }
    
    
    public function NamesInListLanding(CallbacksTester $I)
    {
        $I->click(NavigationBarPage::$Orders);
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click(NavigationBarPage::$CallbackThemes);
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('1');
        $I->see('Темы обратных звонков', 'span.title');
        $I->see('ID', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[1]');
        $I->see('Название', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[2]');
        $I->see('Удалить', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[3]');
        $I->see('Создать тему', CallbacksPage::$CreateThemeButton);
    }
    
    
    public function DeleteOneTheme(CallbacksTester $I)
    {
        //Удаление одной темы колбеков
        $idDeleteTheme=$I->grabTextFrom('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[1]');
        $I->comment($idDeleteTheme);
        $I->click(CallbacksPage::DeleteThemeButtonLine('1'));
//        $I->waitForElement("alert.in.fade.alert-success");
//        $I->See("Обсуждение удалено");
//        $I->waitForElementNotVisible("alert.in.fade.alert-success");
        $I->wait('2');
        $this->rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$this->rows);
        for ($j=1; $j<=$this->rows; $j++){
                    $noId=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$j]/td[1]");
                    $I->comment("$noId");

                    if($noId == $idDeleteTheme){
                    $I->fail("NOT DELETED");
                    break;
                    } 
        }
        InitTest::ClearAllCach($I);
    }
    
    public function DeleteAllThemes(CallbacksTester $I)
    {
        //Удаление всех тем колбеков
        $I->comment("$this->rows");
        while ($this->rows>0){
            $I->comment("$this->rows");
            $I->click(CallbacksPage::DeleteThemeButtonLine('1'));
            $I->wait('2');
            $this->rows--;
            $I->comment("$this->rows");
        }
        $rowsNo=$I->grabTagCount($I,"tbody tr");
        $I->comment($rowsNo);
        $I->assertEquals($rowsNo, '0');        
    }
    
    
    public function CreateCallbackWithoutThemes(CallbacksTester $I)
    {
        //Проверка возможности отправки колбека без созданных тем колбеков
        $I->amOnPage('/');
        $I->waitForText('Заказать звонок');
        $I->click(CallbacksPage::$OrderCallButton);
        $I->waitForElement(CallbacksPage::$CallMeButton);
        $I->fillField(CallbacksPage::$UserNameCreate, 'www');
        $I->fillField(CallbacksPage::$TelephoneCreate, '11');
        $I->click(CallbacksPage::$CallMeButton);
        $I->waitForElementNotVisible('.//*[@id="ordercall"]');
        $I->amOnPage('/admin');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[5]/a');
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->wait('5');
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        //$kil=explode(" ", $kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        if ($kil<=14){
            $rowCallback=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
            $I->comment((string)$rowCallback);
            $I->see('www', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[3]/a");
            $I->see('11', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[4]");
            $nameThemeList=$I->grabAttributeFrom(".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[5]/div/select", "selected");
            $I->comment("$nameThemeList");
            $I->assertEquals($nameThemeList, null);
            $I->click(".//*[@id='callbacks_all']/table/tbody/tr[last()]/td[3]/a");
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $nameThemeEdit=$I->grabAttributeFrom('.//*[@id="editCallbackForm"]/div[1]/div/select', "selected");
            $I->comment("$nameThemeEdit");
            $I->assertEquals($nameThemeEdit, null);
        }
        else{
            $I->click('.//*[@id="gopages"]/div/ul/li[last()-1]/a');
            $I->wait('2');
            $rowCallback=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
            $I->comment((string)$rowCallback);
            $I->see('www', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[3]/a");
            $I->see('11', ".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[4]");
            $nameThemeList=$I->grabAttributeFrom(".//*[@id='callbacks_all']/table/tbody/tr[$rowCallback]/td[5]/div/select", "selected");
            $I->comment("$nameThemeList");
            $I->assertEquals($nameThemeList, null);
            $I->click(".//*[@id='callbacks_all']/table/tbody/tr[last()]/td[3]/a");
            $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
            $nameThemeEdit=$I->grabAttributeFrom('.//*[@id="editCallbackForm"]/div[1]/div/select', "selected");
            $I->comment("$nameThemeEdit");
            $I->assertEquals($nameThemeEdit, null);          
        } 
        InitTest::ClearAllCach($I);
    }
    
}