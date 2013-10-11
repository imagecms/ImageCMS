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

require_once('Gettext.php');

/**
 * Gettext implementation in PHP
 *
 * @copyright (c) 2009 David Soria Parra <sn_@gmx.net>
 * @author David Soria Parra <sn_@gmx.net>
 */
class Gettext_PHP extends Gettext
{
    /**
     * First magic word in the MO header
     */
    const MAGIC1 = 0xde120495;

    /**
     * First magic word in the MO header
     */
    const MAGIC2 = 0x950412de;

    protected $mofile;
    protected $translationTable = array();
    protected $parsed = false;
    protected $domains = array();

    /**
     * Initialize a new gettext class
     *
     * @param String $mofile The file to parse
     */
    public function __construct($params)
    {
//        var_dumps($params);
        list($directory, $domain, $locale) = $params;
        $this->mofile = sprintf("%s/%s/LC_MESSAGES/%s.mo", $directory, $locale, $domain);
    }

    /**
     * @param String $directory
     * @param String $domain
     * @param String $locale
     * @return mixed|void
     */
    public function addDomain($directory, $domain, $locale) {
        $this->mofile = sprintf("%s/%s/LC_MESSAGES/%s.mo", $directory, $locale, $domain);
        $this->parsed = false;
    }

    public function switchDomain($directory, $domain, $locale) {
        $this->addDomain($directory, $domain, $locale);
    }

    /**
     * Parse the MO file header and returns the table
     * offsets as described in the file header.
     *
     * If an exception occured, null is returned. This is intentionally
     * as we need to get close to ext/gettexts beahvior.
     *
     * @oaram Ressource $fp The open file handler to the MO file
     *
     * @return An array of offset
     */
    private function parseHeader($fp)
    {
        $data   = fread($fp, 8);
        $header = unpack("lmagic/lrevision", $data);

        if ((int) self::MAGIC1 != $header['magic']
           && (int) self::MAGIC2 != $header['magic']) {
            return null;
        }

        if (0 != $header['revision']) {
            return null;
        }

        $data    = fread($fp, 4 * 5);
        $offsets = unpack("lnum_strings/lorig_offset/"
                          . "ltrans_offset/lhash_size/lhash_offset", $data);
        return $offsets;
    }

    /**
     * Parse and reutnrs the string offsets in a a table. Two table can be found in
     * a mo file. The table with the translations and the table with the original
     * strings. Both contain offsets to the strings in the file.
     *
     * If an exception occured, null is returned. This is intentionally
     * as we need to get close to ext/gettexts beahvior.
     *
     * @param Ressource $fp     The open file handler to the MO file
     * @param Integer   $offset The offset to the table that should be parsed
     * @param Integer   $num    The number of strings to parse
     *
     * @return Array of offsets
     */
    private function parseOffsetTable($fp, $offset, $num)
    {
        if (fseek($fp, $offset, SEEK_SET) < 0) {
            return null;
        }

        $table = array();
        for ($i = 0; $i < $num; $i++) {
            $data    = fread($fp, 8);
            $table[] = unpack("lsize/loffset", $data);
        }

        return $table;
    }

    /**
     * Parse a string as referenced by an table. Returns an
     * array with the actual string.
     *
     * @param Ressource $fp    The open file handler to the MO fie
     * @param Array     $entry The entry as parsed by parseOffsetTable()
     *
     * @return Parsed string
     */
    private function parseEntry($fp, $entry)
    {
        if (fseek($fp, $entry['offset'], SEEK_SET) < 0) {
            return null;
        }
        if ($entry['size'] > 0) {
            return fread($fp, $entry['size']);
        }

       return '';
    }


    /**
     * Parse the MO file
     *
     * @return void
     */
    private function parse()
    {
        $this->translationTable = array();

        if (!file_exists($this->mofile)) {
            return;
        }

        $filesize = filesize($this->mofile);
        if ($filesize < 4 * 7) {
            return;
        }

        /* check for filesize */
        $fp = fopen($this->mofile, "rb");

        $offsets = $this->parseHeader($fp);
        if (null == $offsets || $filesize < 4 * ($offsets['num_strings'] + 7)) {
            fclose($fp);
            return;
        }

        $transTable = array();
        $table = $this->parseOffsetTable($fp, $offsets['trans_offset'],
                    $offsets['num_strings']);
        if (null == $table) {
            fclose($fp);
            return;
        }

        foreach ($table as $idx => $entry) {
            $transTable[$idx] = $this->parseEntry($fp, $entry);
        }

        $table = $this->parseOffsetTable($fp, $offsets['orig_offset'],
                    $offsets['num_strings']);
        foreach ($table as $idx => $entry) {
            $entry = $this->parseEntry($fp, $entry);

            $formes      = explode(chr(0), $entry);
            $translation = explode(chr(0), $transTable[$idx]);
            foreach($formes as $form) {
                $this->translationTable[$form] = $translation;
            }
        }

        fclose($fp);

        $this->parsed = true;
    }

    /**
     * Return a translated string
     *
     * If the translation is not found, the original passed message
     * will be returned.
     *
     * @return Translated message
     */
    public function gettext($msg)
    {
        if (!$this->parsed) {
            $this->parse();
        }

        if (array_key_exists($msg, $this->translationTable)) {
            return $this->translationTable[$msg][0];
        }
        return $msg;
    }

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
    public function ngettext($msg, $msg_plural, $count)
    {
        if (!$this->parsed) {
            $this->parse();
        }

        $msg = (string) $msg;

        if (array_key_exists($msg, $this->translationTable)) {
            $translation = $this->translationTable[$msg];
            /* the gettext api expect an unsigned int, so we just fake 'cast' */
            if ($count <= 0 || count($translation) < $count) {
                $count = count($translation);
            }
            return $translation[$count - 1];
        }

        /* not found, handle count */
        if (1 == $count) {
            return $msg;
        } else {

            return $msg_plural;
        }
    }
}

