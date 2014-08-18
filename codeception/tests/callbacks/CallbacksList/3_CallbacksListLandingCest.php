<?php
use \CallbacksTester;

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
    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks");
        $I->waitForText("Список обратных звонков");
    }   
       
    
    public function NamesInListLanding(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $I->see('Список обратных звонков', 'span.title');
        $I->see('Все обратные звонки :', './/*[@id="totalCallbacks"]/b');
        $I->see('ID', './/*[@id="callbacks_all"]/table/thead/tr/th[2]');
        $I->see('Имя пользователя', './/*[@id="callbacks_all"]/table/thead/tr/th[3]');
        $I->see('Телефон', './/*[@id="callbacks_all"]/table/thead/tr/th[4]');
        $I->see('Тема', './/*[@id="callbacks_all"]/table/thead/tr/th[5]');
        $I->see('Статус', './/*[@id="callbacks_all"]/table/thead/tr/th[6]');
        $I->see('Дата', './/*[@id="callbacks_all"]/table/thead/tr/th[7]');
        $I->see('Удалить', './/*[@id="callbacks_all"]/table/thead/tr/th[8]');
        $I->see('Удалить', CallbacksPage::$DeleteCallback);
    }
    
    
    public function DeleteButton(CallbacksTester $I)
    {
        //Удаление одного колбека с помощью кнопки удаления напротив этого колбека
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil); //Количество всех колбеков в списке
        $j=1;
        $id=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");    //id удалённого колбека    
        $I->click(CallbacksPage::DeleteButtonLine($j));
//        $I->seeElement('.alert.in.fade.alert-success');
//        $I->see('Обратный звонок удалён');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $kil--; //Количество всех колбеков после удаления
        $I->comment((string)$kil);
        $I->wait('2');
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s"); //Количество строк на странице
        $I->comment((string)$rows);
        if ($kil<=$rows){//Если только одна страница в списке колбеков
                for ($j=1; $j<=$rows; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId"); //Считывает id колбеков на странице по строчкам
                                
                    if($noId == $id){
                        $I->fail("NOT DELETED"); //Если считается id удалённого колбека, то тест провален
                        break;
                    } 
                    //$j++;
                }
        $I->assertEquals($kil, $rows); //Проверка правельности отображения количества колбеков в списке
        }
        else {//При наличие пагинации в списке
            $pagAll=ceil($kil/$rowMax); //Количество страниц в списке
            $j=1;
            $pag=2; //Номер страницы
                for ($j=1; $j<=$rowMax; $j++){//Для первой страницы
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment("$noId");
                                
                    if($noId == $id){
                    $I->fail("NOT DELETED");
                    break;
                    }
                }    
                    while ($pag<=$pagAll){//Для остальных страниц начиная со второй       
                            $I->click(CallbacksPage::PaginationButton($pag)); //Переход на следующую страницу
                            $I->wait('2');
                            $rowPag=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s"); //Количество строк на странице
                            $I->comment((string)$rowPag);
                                for ($j=1; $j<=$rowPag; $j++){
                                    $noId = $I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                                    $I->comment("$noId");

                                    if($noId == $id){
                                        $I->fail("NOT DELETED");
                                        break;
                                    }
                                }                            
                            $pag++;
                            if ($pag==3 & $pag<=$pagAll){ //При переходе на вторую страницу она становится третьей по счёту из-за появления кнопки "Предыдущая страница"
                                $pag++;                   //Надо увеличить значение на 1, чтобы перейти на следующую страницу
                                $pagAll++;                //Надо увеличить значение количества страниц на 1 для правильной работы цикла
                                $I->comment("Pag is added $pag");
                            }                           
                    }
                if ($pag==3 & $pag>$pagAll){
                    $pagAll--;
                    $I->assertEquals($kil, "$rowMax"*"$pagAll"+"$rowPag"); //Проверка правильности отображения количества колбеков всписке при 2 страницах пагинации
                }
                else {$pagAll=$pagAll-2;
                    $I->assertEquals($kil, "$rowMax"*"$pagAll"+"$rowPag"); //Проверка правильности отображения количества колбеков всписке при пагинации                   
                }
        }
        InitTest::ClearAllCach($I);
    }
    
    
    public function DeleteCheckBoxButton(CallbacksTester $I)
    { 
        //Удаление одного колбека с помощью чекбокса и кнопки "Удалить"
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;
        $id=$I->grabTextFrom(".//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
        $actButDel=$I->grabAttributeFrom(CallbacksPage::$DeleteCallback, "disabled");
        $I->comment($actButDel);
        $I->assertEquals($actButDel, "true"); //Проверка активности кнопки "Удалить"
        $I->checkOption(CallbacksPage::CheckBoxButtonLine($j)); //Активация чекбокса
        $I->wait('1');
        $I->click(CallbacksPage::$DeleteCallback);
        $I->waitForElement('.//div[@class="modal hide fade in"]');
        $I->see('Удалить обратный(е) звонок(ки)');
        $I->see('Вы действительно хотите удалить обратный(е) звонок(ки)?');
        $I->see('Отменить', './/*[@id="mainContent"]/div[2]/div[3]/a[1]');
        $I->see('Удалить', './/*[@id="mainContent"]/div[2]/div[3]/a[2]');
        $I->click('.//*[@id="mainContent"]/div[2]/div[3]/a[2]');
        $I->wait('1');
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
                    $I->fail("NOT DELETED");
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
                        $I->fail("NOT DELETED");
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
                                        $I->fail("NOT DELETED");
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
        }
    }
    
    
    public function DeleteFewCheckBoxButton(CallbacksTester $I)
    { 
        //Удаление нескольких колбеков с помощью чекбоксов и кнопки "Удалить"
        $I->amOnPage('/admin/components/run/shop/callbacks');
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
        $I->wait('2');
        $kil=$kil-3;
        $I->comment((string)$kil);
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);
        if ($kil<=$rows){
                for ($j=1; $j<=$rows; $j++){
                    $noId=$I->grabTextFrom("//*[@id='callbacks_all']/table/tbody/tr[$j]/td[2]");
                    $I->comment($noId);
                    if($noId == $id1){
                        $I->fail("NOT DELETED");
                        break;
                    }
                    if($noId == $id2){
                        $I->fail("NOT DELETED");
                        break;
                    }
                    if($noId == $id3){
                        $I->fail("NOT DELETED");
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
                        $I->fail("NOT DELETED");
                        break;
                    }
                    if($noId == $id2){
                        $I->fail("NOT DELETED");
                        break;
                    }
                    if($noId == $id3){
                        $I->fail("NOT DELETED");
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
                                    $I->fail("NOT DELETED");
                                    break;
                                }
                                if($noId == $id2){
                                    $I->fail("NOT DELETED");
                                    break;
                                }
                                if($noId == $id3){
                                    $I->fail("NOT DELETED");
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
        }
        InitTest::ClearAllCach($I);
    }
    
    
    public function ActiveCheckBox(CallbacksTester $I)
    {
        //Проверка активности чекбоксов при первом переходе на страницу
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;                            
        $I->comment((string)$kil);
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);        
        if ($kil<=$rows){
                for ($j=1; $j<=$rows; $j++){
                    $ActCheck=$I->grabAttributeFrom(CallbacksPage::CheckBoxButtonLine($j), "checked");
                    $I->comment("$ActCheck");
                    if ($ActCheck=="true"){
                        $I->fail("Active Checkbox");
                        break;
                    }
                }
        }
        else {
            $pagAll=ceil($kil/$rowMax);
            $j=1;
            $pag=2;
                for ($j=1; $j<=$rowMax; $j++){
                    $ActCheck=$I->grabAttributeFrom(CallbacksPage::CheckBoxButtonLine($j), "checked");
                    $I->comment("$ActCheck");
                    if ($ActCheck=="true"){
                        $I->fail("Active Checkbox");
                        break;
                    }
                }    
                    while ($pag<=$pagAll){       
                            $I->click(CallbacksPage::PaginationButton($pag));
                            $I->wait('2');
                            $rowPag=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
                            $I->comment((string)$rowPag);
                                for ($j=1; $j<=$rowPag; $j++){
                                    $ActCheck=$I->grabAttributeFrom(CallbacksPage::CheckBoxButtonLine($j), "checked");
                                    $I->comment("$ActCheck");
                                    if ($ActCheck=="true"){
                                        $I->fail("Active Checkbox");
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
        }
    }
    
    
    public function DeleteAllCheckBoxButton(CallbacksTester $I)
    {
        //Удаление всех колбеков из списка
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $rowMax=14;     
        $kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
        $I->comment($kil1);
        $kil=substr($kil1, 39, 41);
        $I->comment($kil);
        $j=1;                            
        $I->comment((string)$kil);
        $rows=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
        $I->comment((string)$rows);
        if ($kil<=$rows){
                $I->click('.//*[@id="callbacks_all"]/table/thead/tr/th[1]/span/span');
                $I->click(CallbacksPage::$DeleteCallback);
                $I->waitForElement('.//div[@class="modal hide fade in"]');
                $I->see('Удалить обратный(е) звонок(ки)');
                $I->see('Вы действительно хотите удалить обратный(е) звонок(ки)?');
                $I->see('Отменить', './/*[@id="mainContent"]/div[2]/div[3]/a[1]');
                $I->see('Удалить', './/*[@id="mainContent"]/div[2]/div[3]/a[2]');
                $I->click('.//*[@id="mainContent"]/div[2]/div[3]/a[2]');
                $I->wait('2');
                $rowsNo=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
                $I->comment((string)$rowsNo);
                $I->assertEquals($rowsNo, '0');
                $I->seeElement('.//*[@id="mainContent"]/div[1]/form/section/div[3]');
                $I->see('Пустой список обратных звонков.');
        }
        else {
            $pagAll=ceil($kil/$rowMax);
            $j=1;            
                for ($j=1; $j<=$pagAll; $j++){
                    $I->click('.//*[@id="callbacks_all"]/table/thead/tr/th[1]/span/span');
                    $I->click(CallbacksPage::$DeleteCallback);
                    $I->waitForElement('.//div[@class="modal hide fade in"]');
                    $I->see('Удалить обратный(е) звонок(ки)');
                    $I->see('Вы действительно хотите удалить обратный(е) звонок(ки)?');
                    $I->see('Отменить', './/*[@id="mainContent"]/div[2]/div[3]/a[1]');
                    $I->see('Удалить', './/*[@id="mainContent"]/div[2]/div[3]/a[2]');
                    $I->click('.//*[@id="mainContent"]/div[2]/div[3]/a[2]');
                    $I->wait('2');                    
                }    
            $rowsNo=$I->grabClassCount($I,"btn btn-small btn-danger my_btn_s");
            $I->comment((string)$rowsNo);
            $I->assertEquals($rowsNo, '0'); 
            $I->seeElement('.//*[@id="mainContent"]/div[1]/form/section/div[3]');
            $I->see('Пустой список обратных звонков.');
        }
        InitTest::ClearAllCach($I);
    }    
}