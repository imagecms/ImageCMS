<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
$I->moveMouseOver('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
$I->canSeeElement('div.tooltip-inner');
$I->see('Редактировать статус обратного звонка');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
$I->waitForText('Редактирование статуса обратного звонка');
$I->see('Редактирование статуса обратного звонка', 'span.title.w-s_n');
$I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
$I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
$I->see('По умолчанию', 'span.frame_label.no_connection');
$I->see('Статус будет назначен всем новым запросам.', 'div.help-block');
$I->see('Вернуться', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->see('Сохранить', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Сохранить и выйти', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');

