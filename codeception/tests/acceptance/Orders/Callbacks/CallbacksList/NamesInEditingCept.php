<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
$I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
$I->see('Тема вопроса:', './/*[@id="editCallbackForm"]/div[2]/label');
$I->see('Редактирование обратного звонка', 'span.title.w-s_n');
$I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
$I->see('Статус:', './/*[@id="editCallbackForm"]/div[1]/label');
$I->see('Имя пользователя:', './/*[@id="editCallbackForm"]/div[3]/label');
$I->see('Телефон:', './/*[@id="editCallbackForm"]/div[4]/label');
$I->see('Комментарий:', './/*[@id="editCallbackForm"]/div[5]/label');
$I->see('Дата создания:', './/*[@id="editCallbackForm"]/div[6]/label');
$I->see('Вернуться', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->see('Сохранить', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Сохранить и выйти', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');