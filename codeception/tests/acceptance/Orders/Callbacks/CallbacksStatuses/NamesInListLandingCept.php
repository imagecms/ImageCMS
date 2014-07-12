<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[6]/a');
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->see('Статусы обратных звонков', 'span.title');
$I->see('ID', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[1]');
$I->see('Имя', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[2]');
$I->see('По умолчанию', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[3]');
$I->see('Удалить', './/*[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[4]');
$I->see('Создать статус', CallbacksPage::$CreateStatusButton);


