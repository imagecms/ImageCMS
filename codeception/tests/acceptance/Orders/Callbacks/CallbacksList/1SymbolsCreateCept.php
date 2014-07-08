<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->click('.isDrop');
$I->waitForElement('.btn-form>button');
$I->fillField('.//*[@id="data-callback"]/label[1]/span[2]/input', 'й');
$I->fillField('.//*[@id="data-callback"]/label[2]/span[2]/input', '1');
$I->fillField('.//*[@id="data-callback"]/label[3]/span[2]/textarea', '1');
$I->click('.btn-form>button');
$I->waitForElementNotVisible('.//*[@id="ordercall"]');
$I->amOnPage('/admin');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[5]/a');
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->wait('5');
$kil=$I->grabTextFrom('.//*[@id="totalCallbacks"]/b/following-sibling::node()[1]');
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