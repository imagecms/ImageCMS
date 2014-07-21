<?php
use \AcceptanceTester;
class FieldsOSCest
{

//---------------------------AUTORIZATION---------------------------------------
    

    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
    public function CreateFieldName1Symvol (AcceptanceTester $I){
        $name=1;
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    
    public function CreateField25Symvol (AcceptanceTester $I){
        $name="йцукен123456ЪХЗЩЯЧ09876Qx";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function CreateFieldName50Symvol (AcceptanceTester $I){
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function CreateFieldName51Symvol (AcceptanceTester $I){
        $name50="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $name51="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123qX";
        $this->COS($I, $name51);
        $this->VOS($I, $name50);
        $this->DCOS($I);
    }
    
    
    public function CreateFieldName49Symvoland1Space (AcceptanceTester $I){
        $name49Space1="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123 ";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
        public function CreateField1Spaceand49Symvol (AcceptanceTester $I){
        $name49Space1=" йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function CreateFieldSymvolsCyrillicSmall (AcceptanceTester $I){
        $name="abcdefghijklmnopqrstuvwxyz";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function CreateFieldSymvolsCyrillicBig (AcceptanceTester $I){
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    
        public function CreateFieldSymvolsNumeral (AcceptanceTester $I){
        $name="1 2 3 4 5 6 7 8 9 0";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
        public function CreateFieldPunctuation (AcceptanceTester $I){
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
        public function CreateFieldSymvolsLatinSmall (AcceptanceTester $I){
        $name="abcdefghijklmnopqrstuvwxyz";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
        public function CreateFieldSymvolsLatinBig (AcceptanceTester $I){
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function EditingFild1Symvol(AcceptanceTester $I){
        $nameEdt="1";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    
    public function EditingFild25Symvol(AcceptanceTester $I){
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    
    
    public function EditingFild50Symvol(AcceptanceTester $I){
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    public function EditingFild51Symvol(AcceptanceTester $I){
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx1";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    public function EditingFild49Symvoland1Space(AcceptanceTester $I){
           $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q ";
           $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
           $this->EOS($I, $nameEdt);
           $this->VOS($I, $nameAssert);
           $this->DCOS($I);       
    }
    
    

        public function EditingFild1Spaceand49Symvol(AcceptanceTester $I){
           $nameEdt=" йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
           $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
           $this->EOS($I, $nameEdt);
           $this->VOS($I, $nameAssert);
           $this->DCOS($I);       
    }
    
    
    
    
    public function EditFieldSymvolsCyrillicSmall (AcceptanceTester $I){
        $name="абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function EditFieldSymvolsCyrillicBig (AcceptanceTester $I){
        $name="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    
    public function EditFieldSymvolsNumeral (AcceptanceTester $I){
        $name="1 2 3 4 5 6 7 8 9 0";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function EditFieldPunctuation (AcceptanceTester $I){
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function EditFieldSymvolsLatinSmall (AcceptanceTester $I){
        $name="abcdefghijklmnopqrstuvwxyz";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    public function EditFieldSymvolsLatinBig (AcceptanceTester $I){
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }



















    protected function COS (AcceptanceTester $I, $name){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, $name);
        $I->click(OrderStatusesPage::$CreateButtonCreateAndGoBack);
    }
    protected function EOS (AcceptanceTester $I, $nameEdt){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, "qweasdqwe");
        $I->click(OrderStatusesPage::$CreateButtonCreate);
        $I->wait('1');
        $I->reloadPage();
        $I->fillField(OrderStatusesPage::$EditFieldName, $nameEdt);
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
    }

    protected function VOS (AcceptanceTester $I, $name){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $numbeRows = $I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numbeRows'.");
        for($j=1;$j<=$numbeRows;++$j){
            $I->comment("Search In Row:'$j'");
            $searchName = $I->grabTextFrom("//tbody//tr[$j]/td[2]/a");
                if($searchName == $name){
                   $I->comment("Status Presence In Row Number:'$j'.");
                }
        }  
        $I->see("$name");
        $I->comment('Status Presence In Order Statuses List Page.');
    }
    protected function DCOS (AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $numberStatus=$I->grabTagCount($I, 'tbody tr');
        $I->comment("Number Rows:'$numberStatus'");
        for ($j=1;$j<=$numberStatus;++$j){
            $CurrentStatus = $I->grabTextFrom("//table/tbody/tr[$j]/td[2]/a");
            if ($CurrentStatus != 'Новый' && $CurrentStatus != 'Доставлен'){
                $I->click("//table/tbody/tr[$j]/td[5]/a");
                $I->wait('1');
                $I->click(OrderStatusesPage::$DeleteButtonDelete);
                $I->wait('1');
                $numberStatus--;
                $j--;
                $I->comment("Status:'$CurrentStatus' is Deleting.");
            }  
        }
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}    
