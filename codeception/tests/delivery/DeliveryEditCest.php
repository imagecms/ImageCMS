<?php
use \DeliveryTester;

class DeliveryEditCest
{
 protected $CreatedMethods = [];
    
    public $Name = "ДоставкаРедактирование";
    
    /**
     * Works after Autorization
     * @staticvar int $callCount 0 - first time didn't work, 
     *                           >0 - searching current delivery in list 
     * 
     * @var bool $methodCreated true if current method($this->name) finded in list
     *                          if false Create new delivery method for edit      
     *                   
     * @param DeliveryTester $I Contoller
     * @guy DeliveryTester\DeliverySteps
     */
    public function _before(DeliveryTester\DeliverySteps $I) {
        static $LoggedIn = false;
        $methodCreated = false;
        if ($LoggedIn == true){
            $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
            $rows = $I->grabClassCount($I, 'niceCheck')-1;
            for($row=1;$row<=$rows;++$row){
                $Cmethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
                if ($this->Name == $Cmethod){
                    $methodCreated = true;
                    $I->click(DeliveryPage::ListMethodLine($row));
                    break;
                }   
            }
            if (!$methodCreated){
                $I->createDelivery($this->Name);
                $I->CheckForAlertPresent('success','create');
                $methodCreated = true;
            }
            $I->waitForText("Редактирование способа доставки: $this->Name", NULL, ".title");
        }    
        $LoggedIn = true;
    }
    
    /**
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function authorization(DeliveryTester\DeliverySteps $I) {
        InitTest::Login($I);
    }
 

    //-----------------------FIELD NAME TESTS-----------------------------------    
    /**
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
    public function eNameEmpty(DeliveryTester\DeliverySteps $I)
    {
        $I->editDelivery('');
        $I->CheckForAlertPresent('required', "edit");
    }
    
    /**
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function eName250(DeliveryTester\DeliverySteps $I)
    {
        $name = InitTest::$text250;
        $this->Name = $name;
                //For deleting
        $this->CreatedMethods[]=$name;
        
        $I->EditDelivery($name,'on');
        $I->CheckForAlertPresent("success", 'edit');
        $I->CheckInList($name);
        
    }
//    /**
//     * @group edit
//     */
//    public function EName500(DeliveryTester $I) {
//        $name = InitTest::$text500;
//                //For deleting
//        $this->CreatedMethods[]=$name;
//        
//        $this->EditDelivery ($I, ['name' => $name]);
//        $this->CheckForAlertPresent($I, 'success',null, null, "edit");
//        $this->CheckInList($I, $name);
//        $this->Name = $name;
//    }
//    /**
//     * @group edit
//     */
//    public function EName501(DeliveryTester $I) {
//        $name = InitTest::$text501;
//                //For deleting
//        $this->CreatedMethods[]=$name;
//        
//        $this->EditDelivery($I, ['name'=>$name]);
//        $this->CheckForAlertPresent($I, 'error', NULL, NULL, 'edit');
//        $I->see("Редактирование способа доставки: ".$this->Name,'.title');
//        }
//
//     /**
//     * @group edit
//     */
//    public function ENameSymbols(DeliveryTester $I) {
//        $name = InitTest::$textSymbols;
//                //For deleting
//        $this->CreatedMethods[]=$name;
//        
//        $this->EditDelivery($I, ['name' => $name]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInList($I, $name);
//    }
//    
//     /**
//     * @group edit
//     */
//    public function ENameNormal(DeliveryTester $I) {
//        $name = "ДоставкаРедактирование";
//                //For deleting
//        $this->CreatedMethods[]=$name;
//        $this->EditDelivery($I, ['name' => $name]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInList($I, $name);
//    }
//    
//    //-----------------------CHECKBOX ACTIVE TESTS------------------------------
//    
//    /**
//     * @group edit
//     */
//    public function EActiveCheck(DeliveryTester $I) {
//        $active = 'on';
//        $this->EditDelivery($I, ['active' => $active]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInList($I, $this->Name, $active);
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EActiveUnCheck(DeliveryTester $I) {
//        $active = 'off';
//        $this->EditDelivery($I, ['active' => $active]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInList($I, $this->Name, $active);
//    }
//    
//    //-----------------------FIELD DESCRIPTION TESTS----------------------------
//    
//    /**
//     * @group edit
//     */
//    public function EDescriptionDescriptionPrice(DeliveryTester $I) {
//        $description = InitTest::$textSymbols;
//        $this->EditDelivery($I, ['description'      => $description,
//                                 'descriptionprice' => $description,
//                                 'active'           => 'on',
//                                ]);
//        $I->seeInField(DeliveryEditPage::$FieldDescription, $description);
//        $I->seeInField(DeliveryEditPage::$FieldDescriptionPrice, $description);
//        $this->CheckInFrontEnd($I, $this->Name, $description);
//    }
//    
//    //-----------------------FIELDS PRICE--------------------------------------- 
//
//    /**
//     * @group edit
//     */
//    public function EPriceSymbols(DeliveryTester $I) {
//        $price = InitTest::$textSymbols;
//        $this->EditDelivery($I, ['price' => $price]);
//        $price = '1234567890';
//        $this->CheckInList($I, $this->Name, NULL, $price);
//    }
//    
//    /**
//     * @group edit
//     */
//        public function EFreeFromSymbols(DeliveryTester $I) {
//        $freefrom = InitTest::$textSymbols;
//        $this->EditDelivery($I, ['freefrom' => $freefrom]);
//        $this->CheckForAlertPresent($I, 'success');
//        $freefrom = '1234567890';
//        $this->CheckInList($I, $this->Name, null, null, $freefrom);
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EPrice15Num(DeliveryTester $I) {
//        $price = 9999999999.999;
//        $this->EditDelivery($I, ['price' => $price]);
//        $this->CheckInList($I, $this->Name, NULL, $price);
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EPrice1Num(DeliveryTester $I){
//        $price = 1;
//        $this->EditDelivery($I, ['price' => "$price"]);
//        $this->CheckInList($I, $this->Name, NULL, $price);
//    }
//
//    /**
//     * @group edit
//     */
//    public function EPrice10Num(DeliveryTester $I) {
//        $price = 55555.55555;
//        $this->EditDelivery($I, ['price' => $price]);
//        $this->CheckInList($I, $this->Name, NULL, $price);
//    }
//
//    //-----------------------FREE FROM TESTS------------------------------------
//    
//    /**
//     * @group edit
//     */
//        public function EFreeFrom1Num(DeliveryTester $I) {
//        $freefrom = 1;
//        $this->EditDelivery($I, ['freefrom' => $freefrom]);
//        $this->CheckInList($I, $this->Name, null, null, $freefrom);
//    }
//    
//    /**
//     * @group edit
//     */
//        public function EFreeFrom10Num(DeliveryTester $I) {
//        $freefrom = 55555.55555;
//        $this->EditDelivery($I, ['freefrom' => $freefrom]);
//        $this->CheckInList($I, $this->Name, null, null, $freefrom);
//    }
//    
//    /**
//     * @group edit
//     */
//        public function EFreeFrom15Num(DeliveryTester $I) {
//        $freefrom = 9999999999.999;
//        $this->EditDelivery($I, ['freefrom' => $freefrom]);
//        $this->CheckInList($I, $this->Name, null, null, $freefrom);
//    }
//    
//    //---------------------CHECKBOX PRICE SPECIFIED & FIELD PRICE SPECIFIED-----
//    
//    /**
//     * @group edit
//     */
//    public function ECheckPriceSpecified(DeliveryTester $I) {
//        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
//        $I->comment($class);
//        $class == 'frame_label no_connection active'? $I->click(DeliveryEditPage::$CheckboxPriceSpecified):print"";
//        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
//        if ($class == 'frame_label no_connection'){
//            $diabledPrice = $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled');
//            $diabledFreefrom = $I->grabAttributeFrom(DeliveryEditPage::$FieldFreeFrom, 'disabled');
//            $I->assertEquals($diabledPrice, NULL);
//            $I->assertEquals($diabledFreefrom, NULL);
//        }else $I->fail ('wrong class of checkbox sum specified');
//        
//        $I->click(DeliveryCreatePage::$CheckboxPriceSpecified);
//        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
//        
//        if ($class == 'frame_label no_connection active'){
//            $diabledPrice = $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled');
//            $diabledFreefrom = $I->grabAttributeFrom(DeliveryEditPage::$FieldFreeFrom, 'disabled');
//            $I->assertEquals($diabledPrice, "true");
//            $I->assertEquals($diabledFreefrom, "true");
//        }else $I->fail ('wrong class of checkbox sum specified');
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EPriceSpecifiedEmpty(DeliveryTester $I) {
//        $this->EditDelivery($I, ['message' => ""]);
//        $this->CheckForAlertPresent($I, 'success', NULL, NULL, 'edit');
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EPriceSpecified250(DeliveryTester $I) {
//        $message = InitTest::$text250;
//        $this->EditDelivery($I, ['message' => $message]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInFrontEnd($I, $this->Name, null, null, null, $message);
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EFieldPriceSpecified500(DeliveryTester $I) {
//        $message = InitTest::$text500;
//        $this->EditDelivery($I, ['message' => $message]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInFrontEnd($I, $this->Name, null, null, null, $message);
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EFieldPriceSpecified501(DeliveryTester $I){
//        $message = InitTest::$text501;
//        $this->EditDelivery($I, ['message' => $message]);
//        $this->CheckForAlertPresent($I, 'error', NULL, null, 'edit');
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EFieldPriceSpecifiedSymbols(DeliveryTester $I) {
//        $message = InitTest::$textSymbols;
//        $this->EditDelivery($I, ['message' => $message]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInFrontEnd($I, $this->Name, null, null, null, $message);
//    }
//    
//    //---------------------PAYMENT METHODS FIELD--------------------------------
//    
//    /**
//     * @group edit
//     */
//    public function EDeliveryPaymentVerify(DeliveryTester $I){
//        $pay = $this->GrabAllCreatedPayments($I);
//        $row = 1;
//        
//        $this->_before($I);
//        
//        foreach ($pay as $Currentpay) {
//            $I->comment($Currentpay);
//            $CreatePagePay = $I->grabTextFrom(DeliveryEditPage::PaymentMethodLabel($row));
//            $I->assertEquals($CreatePagePay, $Currentpay);
//            $row++;
//        }
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EDeliveryPaymentEmpty(DeliveryTester $I){
//        $pay = $this->GrabAllCreatedPayments($I);
//        $this->_before($I);
//        $this->EditDelivery($I, ['payoff' => $pay]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInFrontEnd($I, $this->Name, NULL, null, null, null, 'off');
//    }
//    
//    /**
//     * @group edit
//     */
//    public function EDeliveryPaymentAll(DeliveryTester $I){
//        $pay = $this->GrabAllCreatedPayments($I);
//        $this->_before($I);
//        $this->EditDelivery($I, ['pay' => $pay]);
//        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
//        $this->CheckInFrontEnd($I, $this->Name, NULL, null, null, null, $pay);
//        
//    }
//    
//     /**
//     * @group edit
//     */
//    public function DeleteAllCreatedMethods(DeliveryTester $I) {
//        $I->amOnPage(DeliveryPage::$URL);
//        //Deleting
//        $this->DeleteDeliveryMethods($I, $this->CreatedMethods);
//        unset($this->CreatedMethods);
//    }
}