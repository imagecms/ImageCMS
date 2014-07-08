<?php

$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Проверка появления сообщений в поле E-mail.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->fillField('//label[2]/span[2]/input', '');
$I->click('//span[2]/div/button');
$I->see('Поле Email является обязательным.', '//label[2]/span[2]/label');
$I->fillField('//label[2]/span[2]/input', 'йцу 123 юююю !"№!"№');
$I->click('//span[2]/div/button');
$I->see('Поле Email должно содержать корректный адрес электронной почты.', '//label[2]/span[2]/label');