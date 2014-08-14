<?php
use \OrderStatusesTester;
class FieldsOSCest
{

//---------------------------AUTORIZATION---------------------------------------
    
    /**
     * @group aaa
     */
    public function Login(OrderStatusesTester $I){
        InitTest::Login($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName1Symvol (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 1 Symbol on Name.');
        $name=1;
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    /**
     * @group a
     */
    public function CreateField25Symvol (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 25 Symbol on Name.');
        $name="йцукен123456ЪХЗЩЯЧ09876Qx";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group aaa
     */
    public function CreateFieldName50Symvol (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 50 Symbol on Name.');
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName51Symvol (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 51 Symbol on Name.');
        $name50="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $name51="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123qX";
        $I->wait(1);
        $this->COS($I, $name51);
        $this->VOS($I, $name50);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName49Symvoland1Space (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 49 Symbol and 1 Space on Name.');
        $name49Space1="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123 ";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $I->wait(1);
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    /**
     * @group a
     */
    public function CreateField1Spaceand49Symvol (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 1 Space and 49 Symbol on Name.');
        $name49Space1=" йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $I->wait(1);
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsCyrillicSmall (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Cirillic Small Symbol on Name.');
        $name="абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsCyrillicBig (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Cirillic Big Symbol on Name.');
        $name="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    /**
     * @group a
     */
    public function CreateFieldSymvolsNumeral (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Numeral Symbol on Name.');
        $name="1 2 3 4 5 6 7 8 9 0";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldPunctuation (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Punctuation Symbol on Name.');
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsLatinSmall (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Latin Small Symbol on Name.');
        $name="abcdefghijklmnopqrstuvwxyz";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsLatinBig (OrderStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Latin Big Symbol on Name.');
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $I->wait(1);
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditingFild1Symvol(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 1 Symbol on Name.');
        $nameEdt="1";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild25Symvol(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 25 Symbol on Name.');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qx";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    
    /**
     * @group a
     */
    public function EditingFild50Symvol(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 50 Symbol on Name.');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild51Symvol(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 51 Symbol on Name.');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx1";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild49SymvolAnd1Space(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 49 Symbol and 1 space on Name.');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q ";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    
    /**
     * @group a
     */
    public function EditingFild1SpaceAnd49Symvol(OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 1 Space and 49 Symbol on Name.');
        $nameEdt=" йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $I->wait(1);
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    
    
    /**
     * @group a
     */
    public function EditFieldSymvolsCyrillicSmall (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Cirillic Small Symbol on Name.');
        $name="абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsCyrillicBig (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Cirillic Big Symbol on Name.');
        $name="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    /**
     * @group a
     */
    public function EditFieldSymvolsNumeral (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Numeral Symbol on Name.');
        $name="1 2 3 4 5 6 7 8 9 0";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldPunctuation (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Punctuation Symbol on Name.');
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsLatinSmall (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Latin small Symbol on Name.');
        $name="abcdefghijklmnopqrstuvwxyz";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsLatinBig (OrderStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit Latin Dig Symbol on Name.');
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $I->wait(1);
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }













//------------------------Protecdet Function------------------------------------




        //----Создание Статуса Заказа.
    
    protected function COS (OrderStatusesTester $I, $name){
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);
        $I->wait('1');
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, $name);
        $I->click(OrderStatusesCreatePage::$CreateButtonCreateAndGoBack);
        $I->wait('1');
    }
    
    
    
    
       //----Редактирование Статуса Заказа.
    
    protected function EOS (OrderStatusesTester $I, $nameEdt){
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);
        $I->wait('1');
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, "qweasdqwe");
        $I->click(OrderStatusesCreatePage::$CreateButtonCreate);
        $I->wait('1');
        $I->reloadPage();
        $I->fillField(OrderStatusesCreatePage::$EditFieldName, $nameEdt);
        $I->click(OrderStatusesCreatePage::$EditButtonSaveAndGoBack);
        $I->wait('1');
    }
    
    
    
    
        //-----Поиск статуса в Списке Статусов.
    
    protected function VOS (OrderStatusesTester $I, $name){
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->wait('1');
        $numbeRows = $I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numbeRows'.");
        for($j=1;$j<=$numbeRows;++$j){
            $I->comment("Search In Row:'$j'");
            $I->wait('1');
            $searchName = $I->grabTextFrom("//tbody//tr[$j]/td[2]/a");
                if($searchName == $name){
                   $I->comment("Status Presence In Row Number:'$j'.");
                }
        }  
        $I->see("$name");
        $I->comment('Status Presence In Order Statuses List Page.');
        $I->wait('1');
    }
    
    
    
    
        //----Удаление Статуса Заказа.
    
    protected function DCOS (OrderStatusesTester $I){
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->wait('1');
        $numberStatus=$I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numberStatus'");
        for ($j=1;$j<=$numberStatus;++$j){
            $I->wait('1');
            $CurrentStatus = $I->grabTextFrom("//table/tbody/tr[$j]/td[2]/a");
            if ($CurrentStatus != 'Новый' && $CurrentStatus != 'Доставлен'){
                $I->wait('1');
                $I->click("//table/tbody/tr[$j]/td[5]/a");
                $I->wait('1');
                $I->click(OrderStatusesListPage::$DeleteButtonDelete);
                $I->wait('1');
                $numberStatus--;
                $j--;
                $I->comment("Status:'$CurrentStatus' is Deleting.");
            }  
        }
        InitTest::ClearAllCach($I);
    }
    

    
    
}    
