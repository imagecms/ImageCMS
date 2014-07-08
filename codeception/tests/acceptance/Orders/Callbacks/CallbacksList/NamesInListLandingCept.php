<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->see('Список обратных звонков', 'span.title');
$I->see('Все обратные звонки :', './/*[@id="totalCallbacks"]/b');
$I->see('ID', './/*[@id="callbacks_all"]/table/thead/tr/th[2]');
$I->see('Имя пользователя', './/*[@id="callbacks_all"]/table/thead/tr/th[3]');
$I->see('Телефон', './/*[@id="callbacks_all"]/table/thead/tr/th[4]');
$I->see('Тема', './/*[@id="callbacks_all"]/table/thead/tr/th[5]');
$I->see('Статус', './/*[@id="callbacks_all"]/table/thead/tr/th[6]');
$I->see('Дата', './/*[@id="callbacks_all"]/table/thead/tr/th[7]');
$I->see('Удалить', './/*[@id="callbacks_all"]/table/thead/tr/th[8]');
$I->see('Удалить', './/*[@id="mainContent"]/div[1]/form/section/div[1]/div[2]/div/button');