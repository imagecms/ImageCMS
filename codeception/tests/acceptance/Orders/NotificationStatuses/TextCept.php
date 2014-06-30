<?php
//Логин
$userName = 'ad@min.com';
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/admin/login');
$I->appendField('login', $userName);
$I->appendField('password', 'admin');
$I->click('Войти');
$I->seeInCurrentUrl('/components/run/shop/dashboard');
//открытие страницы Статусы уведомлений
$I->click(['link' => 'Заказы']);
$I->click(['link' => 'Статусы уведомлений']);   
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/index');
//ожыдание Тайтла
$I->waitForText('Статусы уведомлений о появлении',2);
//проверка текста на странице "Статусы уведомлений"
$I->seeInPageSource('Статусы уведомлений о появлении');
$I->seeInPageSource('Создать статус');
$I->seeInPageSource('Удалить');
$I->seeInPageSource('Новый');
$I->seeInPageSource('Выполнен');
$I->seeInPageSource('ID');
$I->seeInPageSource('Имя');
$I->seeInPageSource('Позиция');
//кнопка Создать Статус
$I->click('//div/div[2]/div/a');
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/create');
//ожидание Тайтла
$I->waitForText('Создание статуса уведомления о появлении',2);
//проверка Текста на странице Создания
$I->seeInPageSource('Создание статуса уведомления о появлении');
$I->seeInPageSource('Вернуться','//div/a/span[2]');
$I->seeInPageSource('Создать','//div[2]/div/button[1]');
$I->seeInPageSource('Создать и выйти','//div[2]/div/button[2]');
$I->seeInPageSource('Общая информация','//table/thead/tr/th');
$I->seeInPageSource('Название');
//кнопка Создать при пустом поле(Проверка появления сообщения обязательности поля).
$I->click('//div[2]/div/button'); //Кнопка Создать.
$I->waitForElementVisible('//div/div/div/label');
$I->seeElement('//div/div/div/label');
//Ввод в поле Название.
$I->appendField('Название', 'Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.');
//проверка сообщения о создании статуса.
$I->click('//button[2]');//Создать и выйти.
$I->waitForElementVisible('//div[2]/div[2]');
$I->see('Статус ожидания создан');
//проверка Урла.
$I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses');
//проверка присутствия на странице Статусы уведомлений.
$I->see('Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.', '//div/div[3]/section/div[2]');
//открытие страницы Редактирования статуса.
$I->click('Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.');
//проверка УРЛа.
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/edit');
//ожыдание Тайтла.
$I->seeInPageSource('Редактирование статуса уведомления о появлении');
//проверка названий страница Редактирование.
$I->seeInPageSource('Вернуться');
$I->seeInPageSource('Сохранить');
$I->seeInPageSource('Сохранить и выйти');
$I->seeInPageSource('Данные статуса уведомления о появлении');
//удаления значений с поля.
$I->see('Название','//label');
$I->fillField('Name','');
$I->click('Сохранить');//кнопка Сохранить.
//проверка появления сообщения об обязательности заполнения поля.
$I->waitForElementVisible('//div/div/div/label');
$I->seeElement('//div/div/div/label');
//ввод в поле
$I->appendField('Название','Отредактированный Статус');
//нажватие Сохранить и выйти.
$I->click('Сохранить и выйти');
//сообщение отредактированого стиатуса
$I->waitForElementVisible('//div[2]/div[2]');
$I->see('Изменения сохранены');
//проверка присутствия отредактированого статуса на странице Статусы уведомлений.
$I->waitForElementVisible('//a[contains(text(),"Отредактированный Статус")]');
$I->see('Отредактированный Статус', '//div/div[3]/section/div[2]');
//Отметка Главного Чекбокса.
$I->click('//span/span');
//снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click('//td/span/span');
$I->click('//tr[2]/td/span/span');
//нажатие кнопки Удалить.
$I->click('//div[2]/div/button');
//проверка названий окна Удаления.
$I->seeInPageSource('Удаление статуса');   
$I->seeInPageSource('Удалить ваш статус?');   
$I->seeInPageSource('Удалить');   
$I->seeInPageSource('Отменить');
$I->seeInPageSource('×');
//нажатие Удалить
$I->click('//div[3]/a');
//присутствие сообщения об удалении.
$I->waitForElement('//div[2]/div');
//отсутствие удаленого статуса на странице.
$I->waitForElementNotVisible('//a[contains(text(),"Отредактированный Статус")]');
//Тест Ту Би Континиуе...КонгратулейшН !!! =)))


