<?php
use \DeliveryTester;

class DeliveryAlertMessagesCest
{
<<<<<<< HEAD
    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function deleteListAlert(DeliveryTester $I)
    {
        $I->amOnPage(DeliveryPage::$URL);
    }
    
    public function creteNameEmptyAlert(DeliveryTester $I)
    {
        $I->amOnPage(DeliveryPage::$URL);
    }
    public function creteNameMaxSymbolsListAlert(DeliveryTester $I)
    {
        $I->amOnPage(DeliveryPage::$URL);
    }
    public function cretePriseSpecifiedAlert(DeliveryTester $I)
    {
        $I->amOnPage(DeliveryPage::$URL);
    }
    
    //    /**_______________________________________________________________________check in alert tests
//     * @group create
//     * @guy DeliveryTester\DeliverySteps
//     */
//    public function nameEmpty(DeliveryTester\DeliverySteps $I) {
//        $I->click(DeliveryCreatePage::$ButtonCreate);
//        $I->CheckForAlertPresent('required','create');
//    }
    
    
    //    /**_______________________________________________________________________CHECK_IN ALERT TESTS
=======
    /**
     * @group message
     */
    public function authorization(DeliveryTester $I){
        InitTest::Login($I);
    }

    /**
     * @group messages
     * @guy DeliveryTester\DeliverySteps
     */
    public function listDeleteAlert(DeliveryTester\DeliverySteps $I)
    {
        $name = "Доставка удаление";
        $I->createDelivery($name);
        
        $I->amOnPage(DeliveryPage::$URL);
        $AllMethodsCount = $I->grabClassCount($I, "niceCheck")-1;
        for ($row = 1;$row <= $AllMethodsCount;++$row){
            $CurrentRowMethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
            if($CurrentRowMethod == $name){
                        $I->click (DeliveryPage::ListCheckboxLine ($row));
            }
        }
        
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->wait(1);
        $I->click(DeliveryPage::$DeleteWindowDelete);
        $I->CheckForAlertPresent('success', 'delete');
    }
    
    /**
     * @group messages
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameEmptyAlert(DeliveryTester\DeliverySteps $I)
    {
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('required', 'create');
    }
    
    /**
     * @group messages
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameMaxSymbolsListAlert(DeliveryTester\DeliverySteps $I)
    {
        $name = InitTest::$text501;
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->fillField(DeliveryCreatePage::$FieldName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('error', 'namemax');
    }
    
    /**
     * @group messages
     * @guy DeliveryTester\DeliverySteps
     */
    public function createNameNormalAlert(DeliveryTester\DeliverySteps $I){
        $name = "ДоставкаСообщение";
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->fillField(DeliveryCreatePage::$FieldName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('success', 'create');
    }
//    
//    public function cretePriseSpecifiedAlert(DeliveryTester $I)
//    {
//        
//    }
       
    
//    /**
>>>>>>> 43ef1494d036da9ef29de9b03d74355acefebe06
//     * @group create
//     * @guy DeliveryTester\DeliverySteps
//     */
//    public function fieldPriseSpecifiedEmpty(DeliveryTester\DeliverySteps $I) {
//        $name = "УточнениеЦеныПусто";
//        //For deleting
//        $this->CreatedMethods[] = $name;
//
//        $I->CreateDelivery($name, 'on', null, null, null, null, "");
//        $I->CheckForAlertPresent('success', 'create');
//    }
    
    
    //    /**_______________________________________________________________________CHECK IN ALERT TEST
//     * @group create
//     * @guy DeliveryTester\DeliverySteps
//     */
//    public function fieldPriseSpecified501(DeliveryTester\DeliverySteps $I) {
//        $name = 'УточнениеЦены501';
//        $message = InitTest::$text501;
//        //For deleting
//        $this->CreatedMethods[] = $name;
//
//        $I->CreateDelivery($name, 'on', null, null, null, null, $message);
//        $I->CheckForAlertPresent('error', 'create');
//  _________________________________________________________________________________________________________BUG
//    }
    
<<<<<<< HEAD
    
    
    //    /**_______________________________________________________________________CHECK IN ALERTS TESTS
//     * @group create
//     * @guy DeliveryTester\DeliverySteps
//     */
//    public function name501(DeliveryTester\DeliverySteps $I) {
//        $I->CreateDelivery(InitTest::$text501);
//        $I->CheckForAlertPresent('error', 'create');
//    }
    
        /**_________________________________________________________________________check in alert tests
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
//    public function eNameEmpty(DeliveryTester\DeliverySteps $I) {
//        $I->editDelivery('');
//        $I->CheckForAlertPresent('required', "edit");
//    }
=======
   
>>>>>>> 43ef1494d036da9ef29de9b03d74355acefebe06

    
        /**-________________________________________________________________________check in alert tests
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
//    public function eName501(DeliveryTester\DeliverySteps $I) {
//        $name = InitTest::$text501;
//        //For deleting
//        $this->CreatedMethods[] = $name;
//
//        $I->EditDelivery($name);
//        $I->CheckForAlertPresent('error', 'edit');
//        $I->see("Редактирование способа доставки: " . $this->Name, '.title');
//    }
    
        /**_________________________________________________________________________check in alert tests
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
//    public function ePriceSpecifiedEmpty(DeliveryTester\DeliverySteps $I) {
//        $I->EditDelivery(null, null, null, null, null, null, '');
//        $I->CheckForAlertPresent('success', 'edit');
//    }
    
    //______________________________________________________________________________________________________________________++++++++++++++++BUG_HERE
    /**_________________________________________________________________________check in alert tests
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
//    public function eFieldPriceSpecified501(DeliveryTester\DeliverySteps $I){
//        $message = InitTest::$text501;
//        $I->EditDelivery(null, null, null, null, null, null, $message);
//        $I->CheckForAlertPresent('error', 'edit');
//    }
    
}