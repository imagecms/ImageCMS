<?php
use \AcceptanceTester;

class DeleteCallbackByButtonCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks");
        $I->waitForText("Список обратных звонков");
    }   
               
    
   public function DeleteButton(AcceptanceTester $I)
    {
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;
        $id=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");        
        $I->click(CallbacksPage::DeleteButtonLine($j));
//        $I->seeElement('.alert.in.fade.alert-success');
//        $I->see('Обратный звонок удалён');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $kil--;
        $I->comment((string)$kil);
        $I->wait('2');
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);
        if ($kil<=$rows){
                for ($j=1; $j<=$rows; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId");
                                
                    if($noId == $id){
                        $I->fail("not DELETED");
                        break;
                    } 
                    //$j++;
                }                    
        }
        else {
            $pagAll=ceil($kil/$rowMax);
            $j=1;
            $pag=2;
                for ($j=1; $j<=$rowMax; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId");
                                
                    if($noId == $id){
                    $I->fail("not DELETED");
                    break;
                    }
                }    
                    while ($pag<=$pagAll){       
                            $I->click(CallbacksPage::PaginationButton($pag));
                            $I->wait('2');
                            $rowPag=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
                            $I->comment((string)$rowPag);
                                for ($j=1; $j<=$rowPag; $j++){
                                    $noId = $I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                                    $I->comment("$noId");

                                    if($noId == $id){
                                        $I->fail("not DELETED");
                                        break;
                                    }
                                }                            
                            $pag++;
                            if ($pag==3 & $pag<=$pagAll){
                                $pag++;
                                $pagAll++;
                                $I->comment("Pag is added $pag");
                            }    
                    }                    
                //}
        }
    }
    
    
    /*public function DeleteCheckBoxButton(AcceptanceTester $I)
    {
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;
        $id=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");        
        $I->click(CallbacksPage::CheckBoxButtonLine($j));
        $I->click(CallbacksPage::$DeleteCallback);
        $I->waitForElement('.//div[@class="modal hide fade in"]');
        $I->see('Удалить обратный(е) звонок(ки)');
        $I->see('Вы действительно хотите удалить обратный(е) звонок(ки)?');
        $I->see('Отменить', './/*[@id="mainContent"]/div[2]/div[3]/a[1]');
        $I->see('Удалить', './/*[@id="mainContent"]/div[2]/div[3]/a[2]');
        $I->click('.//*[@id="mainContent"]/div[2]/div[3]/a[2]');
//        $I->waitForElementVisible('//*[@class="alert in fade alert-success"]');
//        $I->see('Обратный(е) звонок(ки) удален(ы)');
//        $I->waitForElementNotVisible('//*[@class="alert in fade alert-success"]');
        $kil--;
        $I->comment((string)$kil);
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);
        if ($kil<=$rows){
                for ($j=1; $j<=$rows; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId");

                    if($noId == $id){
                    $I->fail("not DELETED");
                    break;
                    }        
                }                
        }
        else {
            $pagAll=ceil($kil/$rowMax);
            $j=1;
            $pag=2;
                for ($j=1; $j<=$rowMax; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId");
                                
                    if($noId == $id){
                        $I->fail("not DELETED");
                        break;
                    }
                    while ($pag<=$pagAll){       
                            $I->click(CallbacksPage::PaginationButton($pag));
                            $I->wait('2');
                            $rowPag=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
                            $I->comment((string)$rowPag);
                                for ($j=1; $j<=$rowPag; $j++){
                                    $noId = $I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                                    //$noId=$I->dontSee($id, ".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                                    $I->comment("$noId");

                                    if($noId == $id){
                                        $I->fail("not DELETED");
                                        break;
                                    }
                                }
                            $pag++;
                            if ($pag==3){
                                $pag++;
                                $pagAll++;
                                $I->comment("Pag is added $pag");
                            }    
                    }                    
                }
        }
    }
    
    
    public function DeleteFewCheckBoxButton(AcceptanceTester $I)
    {
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;
        $g=2;
        $t=4;
        $id1=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
        $id2=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$g]/td[2]"); 
        $id3=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$t]/td[2]"); 
        $I->click(CallbacksPage::CheckBoxButtonLine($j));
        $I->click(CallbacksPage::CheckBoxButtonLine($g));
        $I->click(CallbacksPage::CheckBoxButtonLine($t));
        $I->click(CallbacksPage::$DeleteCallback);
        $I->waitForElement('.//div[@class="modal hide fade in"]');
        $I->see('Удалить обратный(е) звонок(ки)');
        $I->see('Вы действительно хотите удалить обратный(е) звонок(ки)?');
        $I->see('Отменить', './/*[@id="mainContent"]/div[2]/div[3]/a[1]');
        $I->see('Удалить', './/*[@id="mainContent"]/div[2]/div[3]/a[2]');
        $I->click('.//*[@id="mainContent"]/div[2]/div[3]/a[2]');
        $kil--;
        $I->comment((string)$kil);
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);
        if ($kil<=$rows){
                for ($j=1; $j<=$rows; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment($noId);
                    if($noId == $id1){
                        $I->fail("not DELETED");
                        break;
                    }
                    if($noId == $id2){
                        $I->fail("not DELETED");
                        break;
                    }
                    if($noId == $id3){
                        $I->fail("not DELETED");
                        break;
                    }
                }                
        }
        else {
            $pagAll=ceil($kil/$rowMax);
            $j=1;
            $pag=2;
                for ($j=1; $j<=$rowMax; $j++){
                $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                $I->comment($noId);
                    if($noId == $id1){
                        $I->fail("not DELETED");
                        break;
                    }
                    if($noId == $id2){
                        $I->fail("not DELETED");
                        break;
                    }
                    if($noId == $id3){
                        $I->fail("not DELETED");
                        break;
                    }
                }
                while ($pag<=$pagAll){       
                        $I->click(CallbacksPage::PaginationButton($pag));
                        $I->wait('2');
                        $rowPag=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
                        $I->comment((string)$rowPag);
                            for ($j=1; $j<=$rowPag; $j++){
                                $noId = $I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                                
                                $I->comment("$noId");
                                
                                if($noId == $id1){
                                    $I->fail("not DELETED");
                                    break;
                                }
                                if($noId == $id2){
                                    $I->fail("not DELETED");
                                    break;
                                }
                                if($noId == $id3){
                                    $I->fail("not DELETED");
                                    break;
                                }
                            }
                        $pag++;
                        if ($pag==3){
                            $pag++;
                            $pagAll++;
                            $I->comment("Pag is added $pag");
                        }    
                }
                    
        }
    }
    */
}