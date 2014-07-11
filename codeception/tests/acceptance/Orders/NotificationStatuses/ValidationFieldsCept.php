<?php 
$I = new AcceptanceTester($scenario);
InitTest::login($I);//Логин.

//        Проверка ввода граничных значений в поле "Название", на страницах "Создания" и "Редактирования".

$I->click(NavigationBarPage::$Orders);//Открытие страницы Статусы уведомлений.
$I->click(NavigationBarPage::$NotificationStatuses);
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->fillField(NotificationStatusesPage::$CreationInputFild, '1');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('1', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->fillField(NotificationStatusesPage::$CreationInputFild, 'ааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа12345678901234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('ааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(['link' => '1']);
$I->fillField(NotificationStatusesPage::$EditingInputFild, 'xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа12345678901234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Сохранить и выйти.
$I->see('xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(['link' => 'xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789']);//Проверка присутствия на странице Статусы уведомлений.
$I->fillField(NotificationStatusesPage::$EditingInputFild, '2');
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Сохранить и выйти.
$I->see('2', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.

//        Проверка ввода и сохранения валидных символов в поле "Название" на странице "Создания".

$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, 'abcdefghijklmnopqrstuvwxyz');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('abcdefghijklmnopqrstuvwxyz', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('ABCDEFGHIJKLMNOPQRSTUVWXYZ', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, '1234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('1234567890', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationInputFild, '¿←↑→↓ƒ∞√±≥≤><−⁄÷×–‘’—‚>@!?%<&"€¦§¨«»¯´*№{}[])(^:|\~`;');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->see('¿←↑→↓ƒ∞√±≥≤><−⁄÷×–‘’—‚>@!?%<&"€¦§¨«»¯´*№{}[])(^:|\~`;', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListMainCheckBox);//Отметка Главного Чекбокса.
$I->click(NotificationStatusesPage::$ListFirstCheckBox);//Снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click(NotificationStatusesPage::$ListSecondCheckBox);
$I->click(NotificationStatusesPage::$ListThirdCheckBox);
$I->click(NotificationStatusesPage::$ListDeleteButton);//Нажатие кнопки Удалить.
$I->click('//div[3]/a');//Нажатие Удалить.

//        Проверка ввода и сохранения валидных символов в поле "Название" на странице "Редактирования".

$I->click('//a[contains(text(),"2")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Создать и выйти.
$I->click('//a[contains(text(),"ABCDEFGHIJKLMNOPQRSTUVWXYZ")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Создать и выйти.
$I->click('//a[contains(text(),"абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Создать и выйти.
$I->click('//a[contains(text(),"АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, '1234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Создать и выйти.
$I->click('//a[contains(text(),"1234567890")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, '"¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;")]');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Создать и выйти.
$I->click('//a[contains(text(),"¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;")]');
$I->fillField(NotificationStatusesPage::$EditingInputFild, '  .   .   .    .  ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Сохранить и выйти.
$I->see('. . . .', '//div/div[3]/section/div[2]');
$I->click(NotificationStatusesPage::$ListMainCheckBox);//Отметка Главного Чекбокса.
$I->click(NotificationStatusesPage::$ListFirstCheckBox);//Снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click(NotificationStatusesPage::$ListSecondCheckBox);
$I->click(NotificationStatusesPage::$ListDeleteButton);//Нажатие кнопки Удалить.
$I->click('//div[3]/a');//Нажатие Удалить.
InitTest::ClearAllCach($I);