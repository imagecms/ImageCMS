<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[7]/a');
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->see('Темы обратных звонков', 'span.title');
$I->see('ID', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[1]');
$I->see('Название', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[2]');
$I->see('Удалить', '//form[@id="orderStatusesList"]/section/div[2]/div/table/thead/tr/th[3]');
$I->see('Создать тему', CallbacksPage::$CreateThemeButton);

