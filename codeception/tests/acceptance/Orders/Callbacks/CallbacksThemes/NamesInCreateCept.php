<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
$I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[7]/a');
$I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
$I->see('Темы обратных звонков', 'span.title');
$I->click(CallbacksPage::$CreateThemeButton);
$I->waitForText('Создание темы обратного звонка');
$I->see('Создание темы обратного звонка', 'span.title.w-s_n');
$I->see('Информация', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
$I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div/label');
$I->see('Вернуться', CallbacksPage::$GoBackButton);
$I->see('Создать', CallbacksPage::$SaveButton);
$I->see('Создать и выйти', CallbacksPage::$SaveAndExitButton);