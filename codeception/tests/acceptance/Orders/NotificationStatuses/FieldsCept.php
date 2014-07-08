<?php 
$I = new AcceptanceTester($scenario);
InitTest::login($I);//Логин.

//        Проверка ввода граничных значений в поле "Название", на страницах "Создания" и "Редактирования".

$I->click(NavigationBarPage::$Orders);//Открытие страницы Статусы уведомлений.
$I->click(NavigationBarPage::$NotificationStatuses);
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->fillField(NotificationStatusesPage::$CreationFildInput, '1');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('1', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->fillField(NotificationStatusesPage::$CreationFildInput, 'ааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа12345678901234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('ааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(['link' => '1']);
$I->fillField(NotificationStatusesPage::$EditingFildInput, 'xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа12345678901234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Сохранить и выйти.
$I->see('xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(['link' => 'xаааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа1234567890123456789']);//Проверка присутствия на странице Статусы уведомлений.
$I->fillField(NotificationStatusesPage::$EditingFildInput, '2');
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Сохранить и выйти.
$I->see('2', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.

//        Проверка ввода и сохранения валидных символов в поле "Название" на странице "Создания".

$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, 'abcdefghijklmnopqrstuvwxyz');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('abcdefghijklmnopqrstuvwxyz', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('ABCDEFGHIJKLMNOPQRSTUVWXYZ', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, '1234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('1234567890', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListButtonCreate);//Кнопка Создать Статус.
$I->appendField(NotificationStatusesPage::$CreationFildInput, '¿←↑→↓ƒ∞√±≥≤><−⁄÷×–‘’—‚>@!?%<&"€¦§¨«»¯´*№{}[])(^:|\~`;');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);//Создать и выйти.
$I->see('¿←↑→↓ƒ∞√±≥≤><−⁄÷×–‘’—‚>@!?%<&"€¦§¨«»¯´*№{}[])(^:|\~`;', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click(NotificationStatusesPage::$ListHeaderCheckBox);//Отметка Главного Чекбокса.
$I->click(NotificationStatusesPage::$ListCheckBoxFirst);//Снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click(NotificationStatusesPage::$ListCheckBoxSecond);
$I->click(NotificationStatusesPage::$ListCheckBoxThird);
$I->click(NotificationStatusesPage::$ListButtonDelete);//Нажатие кнопки Удалить.
$I->click('//div[3]/a');//Нажатие Удалить.

//        Проверка ввода и сохранения валидных символов в поле "Название" на странице "Редактирования".

$I->click('//a[contains(text(),"2")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Создать и выйти.
$I->click('//a[contains(text(),"ABCDEFGHIJKLMNOPQRSTUVWXYZ")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Создать и выйти.
$I->click('//a[contains(text(),"абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Создать и выйти.
$I->click('//a[contains(text(),"АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІ")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, '1234567890');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Создать и выйти.
$I->click('//a[contains(text(),"1234567890")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, '"¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;")]');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Создать и выйти.
$I->click('//a[contains(text(),"¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;")]');
$I->fillField(NotificationStatusesPage::$EditingFildInput, '  .   .   .    .  ');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);//Сохранить и выйти.
$I->see('. . . .', '//div/div[3]/section/div[2]');
$I->click(NotificationStatusesPage::$ListHeaderCheckBox);//Отметка Главного Чекбокса.
$I->click(NotificationStatusesPage::$ListCheckBoxFirst);//Снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click(NotificationStatusesPage::$ListCheckBoxSecond);
$I->click(NotificationStatusesPage::$ListButtonDelete);//Нажатие кнопки Удалить.
$I->click('//div[3]/a');//Нажатие Удалить.
InitTest::ClearAllCach($I);