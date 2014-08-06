<?php
use \DeliveryTester;

class DeliveryAlertMessagesCest
{
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