<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->see('Редактирование валют', 'span.title');
$I->see('Свойства', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
$I->see('Название:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/label');
$I->see('ISO Код:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/label');
$I->see('Символ:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/label');
$I->see('Курс валюты:', './/*[@id="mod_name"]/label');
$I->see('(Например: USD)', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/p');
$I->see('(Например: $)', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/p');
$I->see('= 1.000 руб', './/*[@id="mod_name"]/div/p');
$I->see('Вернуться', './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->see('Сохранить', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Сохранить и выйти', './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');