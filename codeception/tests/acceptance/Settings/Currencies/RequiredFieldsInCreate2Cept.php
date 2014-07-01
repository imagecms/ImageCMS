<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
$I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
$I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
$I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
$I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
