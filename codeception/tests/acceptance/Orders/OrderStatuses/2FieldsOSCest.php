<?php
use \AcceptanceTester;
class FieldsOSCest
{

//---------------------------AUTORIZATION---------------------------------------
    
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName1Symvol (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение  минимально допустимого значения символов в поле "Название" на странице "Создание статуса".');
        $name=1;
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    /**
     * @group a
     */
    public function CreateField25Symvol (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение  25 символов в поле "Название" на странице "Создание статуса".');
        $name="йцукен123456ЪХЗЩЯЧ09876Qx";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName50Symvol (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение  максимально допустимого количества символов в поле "Название" на странице "Создание статуса".');
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName51Symvol (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение  49 символов в поле "Название" на странице "Создание статуса".');
        $name50="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123q";
        $name51="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123qX";
        $this->COS($I, $name51);
        $this->VOS($I, $name50);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldName49Symvoland1Space (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение 49 символов и 1 пробела  в поле "Название" на странице "Создание статуса".');
        $name49Space1="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123 ";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    
    /**
     * @group a
     */
    public function CreateField1Spaceand49Symvol (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение 1 пробела и 49 символов в поле "Название" на странице "Создание статуса".');
        $name49Space1=" йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $name="йцукен123456ЪХЗЩЯЧ09876QWERTY987zxzxczxc123123123";
        $this->COS($I, $name49Space1);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsCyrillicSmall (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение маленьких символов кириллицы в поле "Название" на странице "Создание статуса".');
        $name="абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsCyrillicBig (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение больших  символов кириллицы в поле "Название" на странице "Создание статуса".');
        $name="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    /**
     * @group a
     */
    public function CreateFieldSymvolsNumeral (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение числовых символов в поле "Название" на странице "Создание статуса".');
        $name="1 2 3 4 5 6 7 8 9 0";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldPunctuation (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение спец—символов в поле "Название" на странице "Создание статуса".');
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsLatinSmall (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение маленьких латинских символов в поле "Название" на странице "Создание статуса".');
        $name="abcdefghijklmnopqrstuvwxyz";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function CreateFieldSymvolsLatinBig (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение больших латинских символов в поле "Название" на странице "Создание статуса".');
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->COS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditingFild1Symvol(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение минимально допустимого значения символов в поле "Название" на странице "Редактирование статуса".');
        $nameEdt="1";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild25Symvol(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение 25 символов в поле "Название" на странице "Редактирование статуса".');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    
    /**
     * @group a
     */
    public function EditingFild50Symvol(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение максимально допустимого значения символов в поле "Название" на странице "Редактирование статуса".');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameEdt);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild51Symvol(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение 51 символа в поле "Название" на странице "Редактирование статуса".');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx1";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Qx";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    /**
     * @group a
     */
    public function EditingFild49SymvolAnd1Space(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение 49 символов и 1 пробела в поле "Название" на странице "Редактирование статуса".');
        $nameEdt="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q ";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    
    /**
     * @group a
     */
    public function EditingFild1SpaceAnd49Symvol(AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение одного пробела и 49 символов в поле "Название" на странице "Редактирование статуса".');
        $nameEdt=" йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $nameAssert="йцукен123456ЪХЗЩЯЧ09876Qxйцукен123456ЪХЗЩЯЧ09876Q";
        $this->EOS($I, $nameEdt);
        $this->VOS($I, $nameAssert);
        $this->DCOS($I);       
    }
    
    
    
    /**
     * @group a
     */
    public function EditFieldSymvolsCyrillicSmall (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение маленьких символов кирилицы в поле "Название" на странице "Редактирование статуса".');
        $name="абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsCyrillicBig (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение больших символов кириллицы в поле "Название" на странице "Редактирование статуса".');
        $name="АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }

    /**
     * @group a
     */
    public function EditFieldSymvolsNumeral (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение цифр в поле "Название" на странице "Редактирование статуса".');
        $name="1 2 3 4 5 6 7 8 9 0";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldPunctuation (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение спец символов в поле "Название" на странице "Редактирование статуса".');
        $name="¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsLatinSmall (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение малениких латинских символов в поле "Название" на странице "Редактирование статуса".');
        $name="abcdefghijklmnopqrstuvwxyz";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }
    
    /**
     * @group a
     */
    public function EditFieldSymvolsLatinBig (AcceptanceTester $I){
        $I->wantTo('Проверить ввод, сохранение и отображение больших латинских символов в поле "Название" на странице "Редактирование статуса".');
        $name="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->EOS($I, $name);
        $this->VOS($I, $name);
        $this->DCOS($I);
    }













//------------------------Protecdet Function------------------------------------




        //----Создание Статуса Заказа.
    
    protected function COS (AcceptanceTester $I, $name){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, $name);
        $I->click(OrderStatusesPage::$CreateButtonCreateAndGoBack);
    }
    
    
    
    
       //----Редактирование Статуса Заказа.
    
    protected function EOS (AcceptanceTester $I, $nameEdt){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, "qweasdqwe");
        $I->click(OrderStatusesPage::$CreateButtonCreate);
        $I->wait('1');
        $I->reloadPage();
        $I->fillField(OrderStatusesPage::$EditFieldName, $nameEdt);
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
    }
    
    
    
    
        //-----Поиск статуса в Списке Статусов.
    
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
    
    
    
    
        //----Удаление Статуса Заказа.
    
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
