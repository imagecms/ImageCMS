<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->click(CallbacksPage::$OrderCallButton);
$I->waitForElement(CallbacksPage::$CallMeButton);
$I->fillField(CallbacksPage::$UserNameCreate, 'й');
$I->fillField(CallbacksPage::$TelephoneCreate, '1');
$I->fillField(CallbacksPage::$CommentCreate, '1');
$I->click(CallbacksPage::$CallMeButton);
$I->waitForElementNotVisible('.//*[@id="ordercall"]');
$I->amOnPage('/admin');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[5]/a');
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->wait('5');
$kil1=$I->grabTextFrom('.//*[@id="totalCallbacks"]');
$I->comment($kil1);
//$kil=explode(" ", $kil1);
$kil=substr($kil1, 39, 41);
$I->comment($kil);
if ($kil<=14){
    $I->see('й', './/*[@id="callbacks_all"]/table/tbody/tr[last()]/td[3]');
    $I->see('1', './/*[@id="callbacks_all"]/table/tbody/tr[last()]/td[4]');
    $I->click('.//*[@id="callbacks_all"]/table/tbody/tr[last()]/td[3]/a');
    $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
    $I->see('1', './/*[@id="editCallbackForm"]/div[5]/div/textarea');
}
else{
    $I->click('.//*[@id="gopages"]/div/ul/li[last()-1]/a');
    $I->wait('2');
    $I->see('й', './/*[@id="callbacks_all"]/table/tbody/tr[last()]/td[3]');
    $I->see('1', './/*[@id="callbacks_all"]/table/tbody/tr[last()]/td[4]');
    $I->click('.//*[@id="callbacks_all"]/table/tbody/tr[last()]/td[3]/a');
    $I->waitForElement('.//*[@id="editCallbackForm"]/div[5]/label');
    $I->see('1', './/*[@id="editCallbackForm"]/div[5]/div/textarea');
}