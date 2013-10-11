<?php

/*
 * Copyright (c) 2009 David Soria Parra
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

//require_once 'Gettext_php.php';
require_once 'Gettext_extension.php';

/**
 * Gettext implementation in PHP
 *
 * @copyright (c) 2009 David Soria Parra <sn_@gmx.net>
 * @author David Soria Parra <sn_@gmx.net>
 */
abstract class Gettext {

    private static $instance = null;

    /**
     * Return a translated string
     *
     * If the translation is not found, the original passed message
     * will be returned.
     *
     * @param String $msg The message to translate
     * 
     * @return Translated message
     */
    public abstract function gettext($msg);

    /**
     * Return a translated string in it's plural form
     *
     * Returns the given $count (e.g second, third,...) plural form of the
     * given string. If the id is not found and $num == 1 $msg is returned,
     * otherwise $msg_plural
     *
     * @param String $msg The message to search for
     * @param String $msg_plural A fallback plural form
     * @param Integer $count Which plural form
     *
     * @return Translated string
     */
    public abstract function ngettext($msg1, $msg2, $count);

    /**
     * add new domain and bind some lang file to it
     * @param String $directory Directory to search the mo files in
     * @param String $domain    The current domain
     * @param String $locale    The local
     * @return mixed
     */
    public abstract function addDomain($directory, $domain, $locale);

    /**
     * Returns an instance of a gettext implementation depending on
     * the capabilities of the PHP installation. If the gettext extension
     * is loaded, we use the native gettext() bindings, otherwise we use
     * an own implementation
     *
     * @param String $directory Directory to search the mo files in
     * @param String $domain    The current domain
     * @param String $locale    The local
     *
     * @return Gettext An instance of a Gettext implementation
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Gettext_Extension();
        }

        return self::$instance;
    }

}
