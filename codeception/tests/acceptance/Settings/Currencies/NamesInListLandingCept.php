<?php
//$userName = 'ad@min.com';

$I = new AcceptanceTester($scenario);
initTest::login($I);
//$I->wantTo('log in as regular user');
//$I->amOnPage('/admin/login');
//$I->appendField('login', $userName);
//$I->appendField('password', 'admin');
//$I->click('Войти');
//$I->seeInCurrentUrl('/components/run/shop/dashboard');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul/li[2]/a');
// $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul'==FALSE)
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[8]/ul');
$I->see('Список валют', 'span.title');
$I->see('ID', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[1]');
$I->see('Название', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[2]');
$I->see('ISO Код', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[3]');
$I->see('Символ', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[4]');
$I->see('Главная', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[5]');
$I->see('Дополнительная валюта', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[6]');
$I->see('Удалить', '//*[@id="mainContent"]/section/div[2]/div/form/table/thead/tr/th[7]');
$I->see('Проверить цены', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button');
$I->see('Создать валюту', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a');
