<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->click('.isDrop');
$I->waitForElement('.btn-form>button');
$I->fillField('.//*[@id="data-callback"]/label[1]/span[2]/input', '');
$I->fillField('.//*[@id="data-callback"]/label[2]/span[2]/input', '');
$I->fillField('.//*[@id="data-callback"]/label[3]/span[2]/textarea', '');
$I->click('.btn-form>button');
$I->waitForElement('.//*[@id="data-callback"]/label[1]/span[2]/label');
$I->see('Поле Имя является обязательным.', './/*[@id="data-callback"]/label[1]/span[2]/label');
$I->see('Поле Телефон является обязательным.', './/*[@id="data-callback"]/label[2]/span[2]/label');
