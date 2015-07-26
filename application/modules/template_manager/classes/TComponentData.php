<?php

namespace template_manager\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Class for checking the license of template
 *
 * 
 */
class TComponentData { // TLicense

    const KEY_FILE_NAME = 'tlicense.key';
    const TYPE_NONE = -1;
    const TYPE_FREE = 0;
    const TYPE_PAID = 1;

    private $licenseType;

    /**
     * Gathering data about template license
     * @param string $templateName name of template
     */
    public function __construct($templateName) {
        $keyPath = PUBPATH . "templates/$templateName/" . self::KEY_FILE_NAME;
        $keyPath = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $keyPath);

        if (file_exists($keyPath)) {
            $this->licenseType = self::TYPE_NONE;
        }

        $curKey = file_get_contents($keyPath);

        if ($curKey == self::generateKey($templateName, $_SERVER['HTTP_HOST'], self::TYPE_FREE)) {
            $this->licenseType = self::TYPE_FREE;
            return;
        }

        if ($curKey == self::generateKey($templateName, $_SERVER['HTTP_HOST'], self::TYPE_PAID)) {
            $this->licenseType = self::TYPE_PAID;
            return;
        }

        $this->licenseType = self::TYPE_NONE;
    }

    /**
     * Checking if template has license
     * @return boolean
     */
    public function checkLicense() {
        // for tests - shoud be deleted before production
        if (defined('UNIT_TESTS_PATH'))
            return true;

        if (self::isLocal()) {
            return true;
        }
        return $this->licenseType != self::TYPE_NONE ? true : false;
    }

    /**
     * Returns type of license
     * @return int 
     *      -1 - no license, 
     *      0 - free license
     *      1 - paid license
     */
    public function getLicenseType() {
        return $this->licenseType;
    }

    private static function isLocal() {
        switch (substr($_SERVER['SERVER_ADDR'], 0, strrpos($_SERVER['SERVER_ADDR'], '.'))) {
            case '127.0.0':
            case '127.0.1':
            case '10.0.0':
            case '172.16.0':
            case '192.168.0':
                return true;
        }

        if (strtolower(array_pop(explode('.', $_SERVER['HTTP_HOST']))) === 'loc') {
            return true;
        }

        return false;
    }

    /**
     * Ця ф-я є таких місцях: (якщо раптом треба буде щось змінити в формуванні ключа, то змінити тре бде і там)
     *  - головний проект: /application/modules/template_manager/classes/TComponentData.php
     *  - магазин доповнень оф. сайту: /addons/application/modules/shop/classes/TLicense.php
     *  - скрипт генерації файлу ліцензії "tlic"
     */
    private static function generateKey($templateName, $domain, $type) {
        if ($type == self::TYPE_PAID) { // paid
            $dummy = 'fpnsdg97f-p43279gr9g974';
        } else { // free
            $dummy = '0347y087fg0e87f4fgy9f7r';
        }
        $key = $templateName . $domain . $dummy;
        // changing some valid symbols to "unlawful" for domain names
        $key = str_replace(array('e', 'y', 'u', 'i', 'o', 'a'), array('@', '%', '$', '^', '&', '!'), $key);
        $key = sha1($key);
        $key = array_reverse(str_split($key));
        $key = base64_encode(implode("", $key));
        return $key;
    }

}

?>
