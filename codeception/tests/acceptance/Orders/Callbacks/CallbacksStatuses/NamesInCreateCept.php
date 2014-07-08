<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
$I->click('.//*[@id="orderStatusesList"]/section/div[1]/div[2]/div/a');
$I->waitForText('Создание статуса обратного звонка');
$I->see('Создание статуса обратного звонка', 'span.title');
$I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
$I->see('Название:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
$I->see('По умолчанию', 'span.frame_label.no_connection');
$I->see('Статус будет назначен всем новым запросам.', 'span.help-block');
$I->see('Вернуться', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->see('Создать', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Создать и выйти', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
