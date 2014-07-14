<?php
use \AcceptanceTester;

include_once 'C:\OpenServer\domains\imagecms.loc\codeception\tests\acceptance\Settings\DeliveryMethods\DeliveryHelpers.php';

class DeliveryEditCest extends DeliveryTestHelpers{
        
    public $name = "ДоставкаРедактирование";

    /**
     * Works after Autorization
     * @staticvar int $callCount 0 - first time didn't work, 
     *                           >0 - searching current delivery in list 
     * 
     * @var bool $methodCreated true if current method($this->name) finded in list
     *                          if false Create new delivery method for edit      
     *                   
     * @param AcceptanceTester $I Contoller
     */
    public function _before(AcceptanceTester $I) {
        static $callCount = 0;
        $methodCreated = false;
        if ($callCount > 0){
            $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
            $rows = $I->grabClassCount($I, 'niceCheck')-1;
            for($row=1;$row<=$rows;++$row){
                $Cmethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
                if ($this->name == $Cmethod){
                    $methodCreated = true;
                    $I->click(DeliveryPage::ListMethodLine($row));
                    break;
                }   
            }
            if (!$methodCreated){
                $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
                $I->click(DeliveryPage::$CreateButton);
                $I->waitForText("Создание способа доставки", NULL, '.title');
                $this->CreateDelivery($I, $this->name);
                $methodCreated = true;
            }
            $I->waitForText("Редактирование способа доставки: $this->name", NULL, ".title");
        }    
        $callCount++;
    }
    
    /**
     * @group current
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
    }
    
    /**
     * @group edit
     */
    public function EditNameEmpty(AcceptanceTester $I)
    {
        $this->EditDelivery($I, ['name'=>'',]);
        $this->CheckForAlertPresent($I, 'required', NULL, DeliveryEditPage::$FieldName,$module="edit");
    }
    
    /**
     * @group edit
     */
    public function EditName250(AcceptanceTester $I)
    {
        $name = InitTest::$text250;
        $this->EditDelivery($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, "success",NULL,NULL,'edit');
        $this->CheckInList($I, $name);
        $this->name = $name;
    }
    /**
     * @group edit
     */
    public function EditName500(AcceptanceTester $I) {
        $name = InitTest::$text500;
        $this->EditDelivery ($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, 'success',null, null, "edit");
        $this->CheckInList($I, $name);
    }
    /**
     * @group edit
     */
    public function EditName501(AcceptanceTester $I) {
        $name = InitTest::$text501;
        $this->EditDelivery($I, ['name'=>$name]);
        $this->CheckForAlertPresent($I, 'error', NULL, NULL, 'edit');
        $I->see("Редактирование способа доставки: ".$this->name,'.title');
        }

     /**
     * @group edit
     */
    public function EditNameSymbols(AcceptanceTester $I) {
        $name = InitTest::$textSymbols;
        $this->EditDelivery($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $name);
    }
    
    /**
     * @group current
     */
    public function EditActiveCheck(AcceptanceTester $I) {
        $active = 'on';
        $this->EditDelivery($I, ['active' => $active]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $this->name, $active);
    }
    
    
    
    //-------------PROTECTED FUNCTIONS------------------------------------------
    
    /**
     * 
     * @todo EditDelivery protected Method
     * @param array $params name                => 'Deliveryname',
     * @param array $params active              => 'off - disabled | on - enabled',
     * @param array $params description         => 'Delivery description',
     * @param array $params descriptionprice    => 'Delivery price description',
     * @param array $params price               => 'Delivery price',
     * @param array $params freefrom            => 'Delivery freefrom',
     * @param array $params message             => 'Delivery sum specified message',
     * @param array $params pay                 => 'Payment methods, '_' - delimiter for few methods',
     */
    protected function EditDelivery(AcceptanceTester $I,$params) {
        $default_params =[  'name'              => NULL,
                            'active'            => NULL,
                            'description'       => NULL,
                            'descriptionprice'  => NULL,
                            'price'             => NULL,
                            'freefrom'          => NULL,
                            'message'           => NULL,
                            'pay'               => NULL 
        ];
        $params = array_merge($default_params,$params);
        extract($params);
        if(isset($name)){
            $I->fillField(DeliveryEditPage::$FieldName, $name);
        }
        
        if(isset($active)) {
            $Cactive = $I->grabAttributeFrom("//*[@id='deliveryUpdate']/div[2]/div[2]/span", 'class');
            $Cactive == 'frame_label no_connection active'?$Cactive = TRUE:$Cactive = FALSE;
            if      ($active == "on" && !$Cactive)   { $I->click(DeliveryEditPage::$CheckboxActive); }
            elseif  ($active == "off" && $Cactive)   { $I->click(DeliveryEditPage::$CheckboxActive); }
        }
        
        if(isset($description)){
            $I->fillField(DeliveryEditPage::$FieldDescription, $description);
        }
        if(isset($descriptionprice)) {
            $I->fillField(DeliveryEditPage::$FieldDescriptionPrice, $descriptionprice);
        }
        $I->click(DeliveryEditPage::$ButtonSave);
        
    }
}