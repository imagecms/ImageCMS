<?php

/**
 * Description of InitTest
 *
 * @author cray
 */


class InitTest {

    //Username і пароль ,будуть знінені в тесті 
    protected static $UserName = 'ad@min.com';
    protected static $Password = 'admin';
    
    protected static $LoggedIn;

    



    public static function changeTextAditorToNative($I) {
        $I->wait(1);
        $I->click(GeneralPage::$System);
        $I->wait(1);
        $I->click(GeneralPage::$SystemGlobalSettings);
        $I->waitForElement('#textEditor');
        $I->selectOption('#textEditor', 'Native textarea');
        $I->click('.btn.btn-small.btn-primary.action_on.formSubmit');
        $I->wait('3');
    }
    
//DEPRECATED    
//    public static function changeSymbolsAfterCommaInPrice($I,$num) {
//        $I->wait(1);
//        $I->amOnPage('/admin');
//        $I->click(GeneralPage::$Settings);
//        $I->click(GeneralPage::$SettingsShopSettings);
//        $I->waitForText('Настройки магазина',null,'.title');
//        $I->selectOption('select.input-small', $num);
//        $I->click('.btn.btn-small.btn-primary.action_on.formSubmit');
//        $I->wait(0);
//        
//    }

    public static function Login($I) {
        if (!self::$LoggedIn) {
            $I->wantTo('log in as admin');
            $I->amOnPage('/admin/login');
            $I->fillField('login', self::$UserName);
            $I->fillField('password', self::$Password);
            $I->click('.btn.btn-info');
            $I->waitForElement(".frame_nav");
        }
        self::$LoggedIn = TRUE;
        return self::$LoggedIn; ///experimental
    }

    public static function Loguot($I) {
        if (self::$LoggedIn) {
            $I->wait(1);
            $I->amOnPage('/admin');
            $I->click(GeneralPage::$PersonalButton);
            $I->click(GeneralPage::$PersonalButtonLogout);
            $I->wait(3);
//            $I->waitForElement(".form_login.t-a_c");
        }
        self::$LoggedIn = FALSE;
    }

    /**
     * Clear cache work only at admin panel
     * @param AcceptanceTester $I Controller 
     */
    public static function ClearAllCach($I) {
        $I->amOnPage('/admin');
        $I->click(GeneralPage::$System);
        $I->click(GeneralPage::$SystemClearAllCach);
        $I->wait(3);
    }
    
    
    public static $text250 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт";
    public static $text251 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт1";
    public static $text500 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовани";
    public static $text501 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовании";
    public static $textSymbols = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІабвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі,<.>?\/|~`!@#$%^&*(){}[]\'";:';
}