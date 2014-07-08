<?php

$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Проверка появления сообщений в поле Имя.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->fillField('//span[2]/input', '');
$I->click('//span[2]/div/button');
$I->see('Поле Имя является обязательным.', '//span[2]/label');
$I->fillField('//span[2]/input', '1234567890qwertyuiop asdfghjkl; +_)(*&^%$# ЙЦУКЕНГШЩЗОР');
$I->click('//span[2]/div/button');
$I->see('Поле Имя не может превышать 50 символов в длину.', '//span[2]/label');