<?php

$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Проверка присутствия Елементов и Текста в окне Создания Уведомления.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->see('Сообщить о появлении', '//div[9]/div/div/div');
$I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey', '//div[9]/div/div[2]/div/div/div/ul/li/a/span[2]');
$I->see('100', '//div[9]/div/div[2]/div/div/div/ul/li/div/div/span/span/span/span');
$I->see('(3 $)', '//div[9]/div/div[2]/div/div/div/ul/li/div/div/span/span[2]/span');
$I->see('Ваше имя:', '//label/span');
$I->see('E-mail', '//label[2]/span');
$I->see('*', '//label/span[2]/span');
$I->see('*', '//label[2]/span[2]/span');
$I->see('Телефон:', '//label[3]/span');
$I->see('Комментарий:', '//label[4]/span');
$I->see('Отправить', '//span[2]/div/button');
$I->see('Вы получите письмо, когда товар будет доступен', '//label[2]/span[2]/span[2]');
$I->seeElement('//div[9]/div/button');
$I->seeElement('//div[9]/div/div/div');
$I->seeElement('//span[2]/input');
$I->seeElement('//label[2]/span[2]/input');
$I->seeElement('//label[3]/span[2]/input');
$I->seeElement('//textarea');