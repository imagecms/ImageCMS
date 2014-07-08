<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/themes');
$I->moveMouseOver('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->canSeeElement('div.tooltip-inner');
$I->see('Редактировать тему обратного звонка');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->waitForText('Редактирование темы обратного звонка');
$I->see('Редактирование темы обратного звонка', 'span.title.w-s_n');
$I->see('Информация', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
$I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div/label');
$I->see('Вернуться', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->see('Сохранить', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Сохранить и выйти', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');

