<?php

/**
 * Description of InitTest
 *
 * @author cray
 */


class InitTest {

    /**
     * @var bool $loggedIn true if you logged in
     */
    protected static $LoggedIn;

    /**
     * @var string $text250 sample for filling field
     */
    public static $text250 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт";

    /**
     * @var string $text251 sample for filling field
     */
    public static $text251 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт1";

    /**
     * @var string $text500 sample for filling field
     */
    public static $text500 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовани";

    /**
     * @var string $text501 sample for filling field
     */
    public static $text501 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовании";

    /**
     * @var string $textSymbols sample for filling field
     */
    public static $textSymbols = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІабвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі,<.>?\/|~`!@#$%^&*(){}[]\'";:';

    public static function Login($I) {
        if (!self::$LoggedIn) {
            $userName = 'ad@min.com';
            $password = 'admin';
            $I->wantTo('log in as admin');
            $I->amOnPage('/admin/login');
            $I->fillField('login', $userName);
            $I->fillField('password', $password);
            $I->click('.btn.btn-info');
            $I->waitForElement(".frame_nav");
        }
        self::$LoggedIn = TRUE;
    }

    public static function Loguot($I) {
        if (self::$LoggedIn) {
            $I->amOnPage('/admin');
            $I->click(".my_icon.exit_ico");
            $I->waitForElement(".form_login.t-a_c");
        }
        self::$LoggedIn = FALSE;
    }

    /**
     * Clear cache work only at admin panel
     * @param AcceptanceTester $I Controller 
     */
    public static function ClearAllCach($I) {
        $I->click(NavigationBarPage::$System);
        $I->click(NavigationBarPage::$SystemClearAllCach);
    }


    //__________________________________________________________________________DATABASE
    const THIS_DATA_DIR     = '\..\_data';
    const OPEN_SERVER_DIR   = '..\..\..\..\..\..';
    const MY_SQL_DIR        = '\modules\database\MySQL-5.5.35\bin';
    /**
     * restore database
     * 
     * @param AcceptanceTester  $I              controller
     * @param string            $username       Db username
     * @param string            $databasename   Db name
     */
    public static function dataBaseBackUp(AcceptanceTester $I,$username = 'root', $databasename = 'cmsprem'){
        /**
         * $mysqlbackup command do this:
         * "cd c:\OpenServer\modules\database\MySQL-5.5.35\bin && mysql.exe -u root cmsprem < C:\OpenServer\cmsprem.sql"
         */
        $mysqlbackup =      'cd ' . __DIR__ .self::OPEN_SERVER_DIR . self::MY_SQL_DIR .         //Open MySQL-5.5.35\bin directory
                            " && " . "mysql.exe -u $username $databasename < ".                 //Restore database
                            __DIR__ . self::THIS_DATA_DIR . "\cmsprem.sql";                     //From codeception\tests\_data\cmsprem.sql
        try{
            $I->comment("I am restoring the database");
            $I->runShellCommand($mysqlbackup);
        }
        catch(Exception $e){                                                                    //IF !BACKUP TRY TO CHANGE USER && DATABASE
            $I->comment("I сatched exception, trying to change username & database and connect once more");
            $username       = 'root';                                                           //Change UserName
            $databasename   = 'cmsprem';                                                        //Change Database
            $mysqlbackup    =   'cd ' . __DIR__ . self::OPEN_SERVER_DIR . self::MY_SQL_DIR .    //Open MySQL-5.5.35\bin directory
                                " && " . "mysql.exe -u $username $databasename < ".             //Restore database
                                __DIR__ . self::THIS_DATA_DIR . "\cmsprem.sql";                 //From codeception\tests\_data\cmsprem.sql
            $I->runShellCommand($mysqlbackup);
        }
    }  
    
//    
//    
//    /**
//     * create dump of database
//     * 
//     * @param AcceptanceTester  $I              controller
//     * @param string            $username       Db username
//     * @param string            $databasename   Db name
//     */
//    public static function dataBaseDump(AcceptanceTester $I,$username = null, $databasename = null){
//        /**
//         * $mysqldump command do this: 
//         * "cd C:\OpenServer\modules\database\MySQL-5.5.35\bin && mysqldump.exe -u root cmsprem > C:\OpenServer\cmsprem.sql"
//         */
//        $mysqldump          =   'cd ' . __DIR__ . self::OPEN_SERVER_DIR . self::MY_SQL_DIR .    //Open MySQL-5.5.35\bin directory  
//                                " && " . "mysqldump.exe -u $username $databasename > " .        //Create database dump
//                                __DIR__ . self::THIS_DATA_DIR . "\cmsprem.sql";                 //Save it to codeception\tests\_data\cmsprem.sql
//        
//        try{
//            $I->comment("I make database dump");
//            $I->runShellCommand($mysqldump);
//        }
//        catch (Exception $e){                                                                   //IF !DUMP TRY TO CHANGE USER && DATABASE
//            $I->comment("I сatched exception, trying to change username & database and connect once more");
//            $username       = 'root';                                                           //Change UserName
//            $databasename   = 'cmsprem';                                                        //Change Database
//            $mysqldump      =   'cd ' . __DIR__ . self::OPEN_SERVER_DIR . self::MY_SQL_DIR .    //Open MySQL-5.5.35\bin directory
//                                " && " . "mysqldump.exe -u $username $databasename > " .        //Create database dump
//                                __DIR__ . self::THIS_DATA_DIR . "\cmsprem.sql";                 //Save it to codeception\tests\_data\cmsprem.sql
//            
//            $I->runShellCommand($mysqldump);
//        }
//    }
//    
}