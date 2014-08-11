<?php
use \OrderStatusesTester;
class IntegrationOSCest
{

//---------------------------AUTORIZATION---------------------------------------
    
    /**
     * @group a
     */
    public function Login(OrderStatusesTester $I){
        InitTest::Login($I);
    }   
    
 //------------VERIFY CREATE ORDER STATUS PRESENCE LIST PAGE--------------------
 
     /**
     * @group a
     */
    public function CteatedOSPresenceListPage(OrderStatusesTester$I){
        $I->wantTo('Verify Created Status Present on Status List Page.');
        $nameStatus='123 Super Созданний Status Заказа 890';
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, $nameStatus);
        $I->click(OrderStatusesCreatePage::$CreateButtonCreateAndGoBack);
        $I->waitForText('Статусы заказов');
        $numbeRows = $I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numbeRows'.");
        for($j=1;$j<=$numbeRows;++$j){
            $I->comment("Search In Row:'$j'");
            $searchName = $I->grabTextFrom("//tbody//tr[$j]/td[2]/a");
                if($searchName == $nameStatus){
                   $I->comment("Created Status Presence In Row Number:'$j'.");
                }
        }  
        $I->see("$nameStatus");
        $I->comment('Created Status Presence In Order Statuses List Page.');
    } 
    
    
        
//----VERIFY CREATING STATUSE PRESENT ORDERS LIST PAGE SELECT STATUS--------------

    /**
     * @group a
     */
    public function CreateOSPresenceOrdersList (OrderStatusesTester$I){
        $I->wantTo('Verify Created Status Present on Orders List Page.');
        $nameStatus='123 Super Созданний Status Заказа 890';  
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->wait('1');
        $positionsInOption = $I->grabTagCount($I, 'select option');
        $I->comment("Number Position:'$positionsInOption'.");
        for($j=1;$j<=$positionsInOption;++$j){
            $searchNameOl = $I->grabTextFrom("//td[3]/select/option[$j]");
            if($searchNameOl == $nameStatus){                   
                $I->comment("Order Status '$nameStatus' Detected In Row:'$j' Select List.");                  
            }
        }
        $I->see("$nameStatus", '//td[3]/select/option');
        InitTest::ClearAllCach($I); 
    }
    
   
    
//////------------EDITING CREATING STATUS PRESENT LIST PAGE--------------------------   

 
    /**
     * @group a
     */    
    public function EditingCteatedOS(OrderStatusesTester$I){
        $I->wantTo('Verify Edited Status Present on Status List Page.');
        $nameStatus='123 Super Созданний Status Заказа 890';
        $nameEditStatus='Отредактированний Статус Order';
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $numbeRows= $I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numbeRows'.");
            for($j=1;$j<$numbeRows;++$j){
            $I->comment("Search In Row$'$j'.");
            $searchName=$I->grabTextFrom("//tbody//tr[$j]/td[2]/a");
                if($searchName == $nameStatus){
                    $I->click($searchName);
                    $I->fillField(OrderStatusesCreatePage::$EditFieldName, $nameEditStatus);
                    $I->click(OrderStatusesCreatePage::$EditButtonSaveAndGoBack);
                }            
            }
        $I->waitForText($nameEditStatus);
        $I->see("$nameEditStatus");
    }  
        
        
        
  
//----VERIFY EDICTING STATUSE PRESENT ORDERS LIST PAGE SELECT STATUS------------


    /**
     * @group a
     */
    public function EditingOSPresenceOrdersList (OrderStatusesTester$I){
        $I->wantTo('Verify Edited Status Present on Orders List Page.');
        $nameEditStatus='Отредактированний Статус Order';  
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->wait('1');
        $positionsInOption= $I->grabTagCount($I, 'select option');
        $I->comment("Number Position:'$positionsInOption'.");
        for($j=1;$j<=$positionsInOption;++$j){
            $searchNameOl=$I->grabTextFrom("//td[3]/select/option[$j]");
            if($searchNameOl == $nameEditStatus){                   
                $I->comment("Order Status '$nameEditStatus' Detectet In Row:'$j'List Select");                  
                InitTest::ClearAllCach($I);                    
             }
        }
        $I->see($nameEditStatus,'//td[3]/select');
    }
    
    
 
    
//-----------VERIFY DELETING STATUS NOT PRESENCE LIST PAGE------------------------


    /**
     * @group a
     */
    public function DeleetinqOSListPage (OrderStatusesTester $I){
        $I->wantTo('Verify Deleted Status Present on Status List Page.');
        $nameEditStatus='Отредактированний Статус Order';
        $nameStatus='123 Super Созданний Status Заказа 890';
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $numberStatus=$I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numberStatus'");
        for ($j=1;$j<=$numberStatus;++$j){
            $CurrentStatus = $I->grabTextFrom("//table/tbody/tr[$j]/td[2]/a");
            if ($CurrentStatus != 'Новый' && $CurrentStatus != 'Доставлен'){
                $I->click("//table/tbody/tr[$j]/td[5]/a");
                $I->wait('1');
                $I->click(OrderStatusesListPage::$DeleteButtonDelete);
                $I->wait('1');
                $numberStatus--;
                $j--;
                $I->comment("Status:'$CurrentStatus' is Deleting.");
            }                     
        }
        $I->dontSee($nameStatus);
        $I->dontSee($nameEditStatus);
    }  
    

   
//---------VERIFY DELETING STATUS NOT PRESENCE OPTION BUTTON SET STATUS---------


    /**
     * @group a
     */
    public function VerifyDeletingaStatusNotPresenceOrderListPage (OrderStatusesTester $I){
        $I->wantTo('Verify Created Status Present on Orders List Page.');
        $nameEditStatus='Отредактированний Статус Order';
        $nameStatus='123 Super Созданний Status Заказа 890';
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $positionsInOption= $I->grabTagCount($I, 'select option');
        $I->comment("Number Rows:'$positionsInOption' In List Select");
        if($positionsInOption > 3){
            for($j=1;$j<=$positionsInOption;++$j){
                $nameStSl=$I->grabTextFrom("//table/thead/tr[2]/td[3]/select/option[$j]");
                $I->comment("In Row:'$j', Presence Status:'$nameStSl'.");
           }$I->dontSee('-- Все --','//table/thead/tr[2]/td[3]/select');
           }elseif($positionsInOption == 3){
                $p=$I->grabTextFrom('//table/thead/tr[2]/td[3]/select/option[1]');
                $o=$I->grabTextFrom('//table/thead/tr[2]/td[3]/select/option[2]');
                $k=$I->grabTextFrom('//table/thead/tr[2]/td[3]/select/option[3]');
                $I->comment("In List Select Presence Defolt Statuses:'$p,$o,$k'.");
                }
                
            
        $I->dontSee($nameStatus,'//table/thead/tr[2]/td[3]/select');
        $I->dontSee($nameEditStatus,'//table/thead/tr[2]/td[3]/select');
        InitTest::ClearAllCach($I);
    }
    


}