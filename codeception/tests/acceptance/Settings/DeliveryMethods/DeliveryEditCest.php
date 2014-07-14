<?php
use \AcceptanceTester;

include_once 'C:\OpenServer\domains\imagecms.loc\codeception\tests\acceptance\Settings\DeliveryMethods\DeliveryHelpers.php';

class DeliveryEditCest extends DeliveryTestHelpers{
        
    public $name = "ДоставкаРедактирование";

    /**
     * Works after Autorization
     * @staticvar int $callCount 0 - first time didn't work, 
     *                           1 - Create Delivery Method($name) For Testing, 
     *                           2+ goes to edit page of current delivery
     * @param AcceptanceTester $I Contoller
     */
    public function _before(AcceptanceTester $I) {
        
        static $callCount = 0;
        if($callCount == 1){
            $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
            $I->click(DeliveryPage::$CreateButton);
            $I->waitForText("Создание способа доставки", NULL, '.title');
            $this->CreateDelivery($I, $this->name);
        }
        
        if ($callCount > 1){
            $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
            $rows = $I->grabClassCount($I, 'niceCheck')-1;
            for($row=1;$row<=$rows;++$row){
                $Cmethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
                if ($this->name==$Cmethod){ 
                    $I->click(DeliveryPage::ListMethodLine($row)); 
                    break;
                }
            }
            
        if ($callCount>0) { $I->waitForText("Редактирование способа доставки: $this->name", NULL, ".title"); }
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
     * @group current
     */
    public function EditName(AcceptanceTester $I)
    {
        $this->EditDelivery($I, ['name'=>'',]);
        $this->CheckForAlertPresent($I, 'required', NULL, DeliveryEditPage::$FieldName,$module="edit");

    }
    
    /**
     * @group current
     */
    public function EditName1(AcceptanceTester $I)
    {
    }
    
    //-------------PROTECTED FUNCTIONS------------------------------------------
    
    /**
     * 
     * @todo EditDelivery protected Method
     * @param array $params name                => 'Deliveryname',
     *                      active              => 'off - disabled | on - enabled',
     *                      description         => 'Delivery description',
     *                      descriptionprice    => 'Delivery price description',
     *                      price               => 'Delivery price',
     *                      freefrom            => 'Delivery freefrom',
     *                      message             => 'Delivery sum specified message',
     *                      pay                 => 'Payment methods, '_' - delimiter for few methods'
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
            $I->click(DeliveryEditPage::$ButtonSave);
        }
                
    }
}