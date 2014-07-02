<?php
$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Создание Уведомления о появлении, с ФронтЕнда сайта.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->click('//span[2]/div/button'); 

// Отображение созданого статуса, на странице Список Уведомлений.

$I->amOnPage('/admin');
$I->click(NavigationBarPage::$Orders);
$I->click(NavigationBarPage::$NotificationStatuses);
$I->click(NotificationStatusesPage::$ListCreateButton);
$I->fillField(NotificationStatusesPage::$CreationInputFild, 'QWE фыв !@# 123 ЪХЗ zxc');
$I->click(NotificationStatusesPage::$CreationCreateAndGoBackButton);
$I->click(NavigationBarPage::$Orders);
$I->click(NavigationBarPage::$NotificationsList);
$I->see('QWE фыв !@# 123 ЪХЗ zxc', '//div[@id="mainContent"]/section/div[4]/a[4]');
$I->see('QWE фыв !@# 123 ЪХЗ zxc', '//select[@name="status_id"]');
$I->see('QWE фыв !@# 123 ЪХЗ zxc', '//form[@id="ordersListFilter"]/table/tbody/tr/td[7]/select');
$I->selectOption('//form[@id="ordersListFilter"]/table/tbody/tr/td[7]/select', 'QWE фыв !@# 123 ЪХЗ zxc');
$I->click('QWE фыв !@# 123 ЪХЗ zxc', '//div[@id="mainContent"]/section/div[4]');
$I->click(['link' => 'ad@min.com']);
$I->wait('8');
$I->see('QWE фыв !@# 123 ЪХЗ zxc', '//select');

//  Отображение отредактированого статуса, на странице Список Уведомлений.

$I->amOnPage('admin/components/run/shop/notificationstatuses');
$I->click('QWE фыв !@# 123 ЪХЗ zxc');
$I->fillField(NotificationStatusesPage::$EditingInputFild, 'Бяка');
$I->click(NotificationStatusesPage::$EditingSaveAndGoBackButton);
$I->amOnPage('admin/components/run/shop/notifications');
$I->see('Бяка', '//div[@id="mainContent"]/section/div[4]');
$I->see('Бяка', '//select[@name="status_id"]');
$I->dontSee('QWE фыв !@# 123 ЪХЗ zxc');
$I->see('Бяка', '//form[@id="ordersListFilter"]/table/tbody/tr/td[7]/select');
$I->selectOption('//form[@id="ordersListFilter"]/table/tbody/tr/td[7]/select', 'Бяка');
$I->click('Бяка', '//div[@id="mainContent"]/section/div[4]');
$I->click(['link' => 'ad@min.com']);
$I->wait('8');
$I->dontSee('QWE фыв !@# 123 ЪХЗ zxc');
$I->see('Бяка', '//select');

//  Отображение удаления отредактированого статуса, на странице Список Уведомлений.

$I->amOnPage('/admin/components/run/shop/notificationstatuses');
$I->click(NotificationStatusesPage::$ListMainCheckBox);
$I->click(NotificationStatusesPage::$ListFirstCheckBox);
$I->click(NotificationStatusesPage::$ListSecondCheckBox);
$I->click(NotificationStatusesPage::$ListDeleteButton);
$I->click(NotificationStatusesPage::$DeleteWindowDeleteButton);
$I->waitForElementNotVisible('Бяка');
$I->dontSeeLink('Бяка');
$I->amOnPage('/admin/components/run/shop/notifications');
$I->dontsee('Бяка', './/*[@id="mainContent"]/section');
$I->dontSee('Бяка', '//select[@name="status_id"]');
$I->dontSee('Бяка', '//form[@id="ordersListFilter"]/table/tbody/tr/td[7]/select');        
$I->click(['link' => 'ad@min.com']);
$I->wait('8');
$I->dontSee('Бяка', '//select');
