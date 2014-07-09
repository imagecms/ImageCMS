<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
$I->click(CallbacksPage::$CreateStatusButton);
$I->waitForText('Создание статуса обратного звонка');
$I->see('Создание статуса обратного звонка', 'span.title');
$I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
$I->see('Название:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
$I->see('По умолчанию', 'span.frame_label.no_connection');
$I->see('Статус будет назначен всем новым запросам.', 'span.help-block');
$I->see('Вернуться', CallbacksPage::$GoBackButton);
$I->see('Создать', CallbacksPage::$SaveButton);
$I->see('Создать и выйти', CallbacksPage::$SaveAndExitButton);
