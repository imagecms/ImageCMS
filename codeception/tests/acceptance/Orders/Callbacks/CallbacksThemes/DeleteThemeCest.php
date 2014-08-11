<?php
use \AcceptanceTester;

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
    private $rows;
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/themes");
        $I->waitForText("Темы обратных звонков");
    }   
    
    
    public function DeleteOneTheme(AcceptanceTester $I)
    {
        $idDeleteTheme=$I->grabTextFrom('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[1]');
        $I->comment($idDeleteTheme);
        $I->click(CallbacksPage::DeleteThemeButtonLine('1'));
//        $I->waitForElement("alert.in.fade.alert-success");
//        $I->See("Обсуждение удалено");
//        $I->waitForElementNotVisible("alert.in.fade.alert-success");
        $I->wait('2');
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$this->rows);
        for ($j=1; $j<=$this->rows; $j++){
                    $noId=$I->grabTextFrom(".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$j]/td[1]");
                    $I->comment("$noId");

                    if($noId == $idDeleteTheme){
                    $I->fail("NOT DELETED");
                    break;
                    } 
        }
    }
    
    
    public function DeleteAllThemes(AcceptanceTester $I)
    {
        while ($this->rows!=0){
            $I->click(CallbacksPage::DeleteThemeButtonLine('1'));
            $I->wait('1');
            $this->rows--;
            $I->comment($this->rows);
        }
        $rowsNo=$I->grabTagCount($I,"tbody tr");
        $I->comment($rowsNo);
        $I->assertEquals($rowsNo, '0');        
    }
    
}