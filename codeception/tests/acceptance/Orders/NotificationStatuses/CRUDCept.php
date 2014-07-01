<?php
$I = new AcceptanceTester($scenario);
InitTest::login($I);//Логин.
$I->seeInCurrentUrl('/components/run/shop/dashboard');
$I->click(NavigationBarPage::$Orders);//Открытие страницы Статусы уведомлений.
$I->click(NavigationBarPage::$NotificationStatuses);   
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/index');
$I->waitForText('Статусы уведомлений о появлении',2);//Ожыдание Тайтла.
$I->seeInPageSource('Статусы уведомлений о появлении');//Проверка текста на странице "Статусы уведомлений".
$I->seeInPageSource('Создать статус');
$I->seeInPageSource('Удалить');
$I->seeInPageSource('Новый');
$I->seeInPageSource('Выполнен');
$I->seeInPageSource('ID');
$I->seeInPageSource('Имя');
$I->seeInPageSource('Позиция');
$I->click(NotificationStatusesPage::$ListCreateButton);//Кнопка Создать Статус.
$I->seeInCurrentUrl(NotificationStatusesPage::$CreatePageUrl);
$I->waitForText('Создание статуса уведомления о появлении',2);//Ожидание Тайтла.
$I->seeInPageSource('Создание статуса уведомления о появлении');//Проверка Текста на странице Создания.
$I->seeInPageSource('Вернуться','//div/a/span[2]');
$I->seeInPageSource('Создать','//div[2]/div/button[1]');
$I->seeInPageSource('Создать и выйти','//div[2]/div/button[2]');
$I->seeInPageSource('Общая информация','//table/thead/tr/th');
$I->seeInPageSource('Название');
$I->click(NotificationStatusesPage::$CreationCreateButton);//Кнопка Создать при пустом поле(Проверка появления сообщения обязательности поля).
$I->waitForElementVisible('//div/div/div/label');
$I->seeElement('//div/div/div/label');
$I->appendField(NotificationStatusesPage::$CreationInputFild, 'Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.');//Ввод в поле Название.
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);//Создать и выйти.
$I->waitForElementVisible('//div[2]/div[2]');//Проверка сообщения о создании статуса.
$I->see('Статус ожидания создан');
$I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);//Проверка Урла.
$I->see('Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.', '//div/div[3]/section/div[2]');//Проверка присутствия на странице Статусы уведомлений.
$I->click('Привет Питер мы с тобой эба 123 !"№!№ QWE asd zc.');//Открытие страницы Редактирования статуса.
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/edit');//Проверка УРЛа.
$I->seeInPageSource('Редактирование статуса уведомления о появлении');//Ожыдание Тайтла.
$I->seeInPageSource('Вернуться');//Проверка названий страница Редактирование.
$I->seeInPageSource('Сохранить');
$I->seeInPageSource('Сохранить и выйти');
$I->seeInPageSource('Данные статуса уведомления о появлении');
$I->see('Название','//label');
$I->fillField(NotificationStatusesPage::$EditingInputFild,'');//Удаления значений с поля.
$I->click(NotificationStatusesPage::$EditingSaveButton);//Кнопка Сохранить.
$I->waitForElementVisible('//div/div/div/label');//Проверка появления сообщения об обязательности заполнения поля.
$I->seeElement('//div/div/div/label');
$I->appendField(NotificationStatusesPage::$EditingInputFild,'Отредактированный Статус');//Ввод в поле Название, страница "Редактирование".
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);//Нажатие Сохранить и выйти.
$I->waitForElementVisible('//div[2]/div[2]');//Cообщение отредактированого стиатуса.
$I->see('Изменения сохранены');
$I->waitForElementVisible('//a[contains(text(),"Отредактированный Статус")]');//Проверка присутствия отредактированого статуса на странице Статусы уведомлений.
$I->see('Отредактированный Статус', '//div/div[3]/section/div[2]');
$I->click(NotificationStatusesPage::$ListMainCheckBox);//Отметка Главного Чекбокса.
$I->click(NotificationStatusesPage::$ListFirstCheckBox);//Снятие отметки с чекбоксов статусов "Новый","Выполнен".
$I->click(NotificationStatusesPage::$ListSecondCheckBox);
$I->click(NotificationStatusesPage::$ListDeleteButton);//Нажатие кнопки Удалить.
$I->seeInPageSource('Удаление статуса');//Проверка названий окна Удаления.
$I->seeInPageSource('Удалить ваш статус?');   
$I->seeInPageSource('Удалить');   
$I->seeInPageSource('Отменить');
$I->seeInPageSource('×');
$I->click('//div[3]/a');//Нажатие Удалить.
$I->waitForElement('//div[2]/div');//Присутствие сообщения об удалении.
$I->waitForElementNotVisible('//a[contains(text(),"Отредактированный Статус")]');//отсутствие удаленого статуса на странице.//Тест Ту Би Континиуе...КонгратулейшН !!! =)))


