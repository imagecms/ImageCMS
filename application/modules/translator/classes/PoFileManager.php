<?php

namespace translator\classes;

use translator\classes\FileOperator as FileOperator;

class PoFileManager {
    /**
     * Modules folder path
     */

    const MODULES_PATH = "./application/modules/";

    /**
     * Templates folder path
     */
    const TEMPLATES_PATH = "./templates/";

    /**
     * Main lang folder path
     */
    const MAIN_PATH = "./application/language/main/";

    /**
     * Errors holder array
     * @var type 
     */
    private static $ERRORS = array();

    /**
     * Po-file settings array
     * @var type 
     */
    private $po_settings = array();

    /**
     * Po-file settings keys
     * @var type 
     */
    private $po_settings_keys = array(
        'Project-Id-Version',
        'Last-Translator',
        'Language-Team',
        'Basepath',
        'X-Poedit-Language',
        'X-Poedit-Country',
        'SearchPath'
    );

    public function __construct() {
        ;
    }

    /**
     * Set error message
     * @param string $error - error message
     */
    private function setError($error) {
        if ($error)
            self::$ERRORS[] = $error;
    }

    /**
     * Get errors
     * @return array
     */
    public function getErrors() {
        return self::$ERRORS;
    }

    /**
     * Prepare po-file url
     * @param string $name - module or template name
     * @param string$type - type of po-file(modules, templates, main)
     * @param string $lang - language locale
     * @return string
     */
    public function getPoFileUrl($name, $type, $lang) {
        switch ($type) {
            case 'modules':
                $url = self::MODULES_PATH . $name . '/language/' . $lang . '/LC_MESSAGES/' . $name . '.po';
                break;
            case 'templates':
                $url = self::TEMPLATES_PATH . $name . '/language/' . $name . '/' . $lang . '/LC_MESSAGES/' . $name . '.po';
                break;
            case 'main':
                $url = self::MAIN_PATH . $lang . '/LC_MESSAGES/' . $type . '.po';
                break;
            default :
                $url = '';
        }
        return $url;
    }

    /**
     * Prepare settings array
     * @param array $data - settings array
     * @return string
     */
    private function prepareSettingsArray($data = array()) {
        if (!isset($data['projectName']) || !$data['projectName']) {
            $data['projectName'] = '';
        }

        if (!isset($data['translatorName']) || !$data['translatorName']) {
            $data['translatorName'] = '';
        }

        if (!isset($data['translatorEmail']) || !$data['translatorEmail']) {
            $data['translatorEmail'] = '';
        } else {
            str_replace('<', '', $data['translatorEmail']);
            str_replace('>', '', $data['translatorEmail']);
        }

        if (!isset($data['langaugeTeamName']) || !$data['langaugeTeamName']) {
            $data['langaugeTeamName'] = '';
        }

        if (!isset($data['langaugeTeamEmail']) || !$data['langaugeTeamEmail']) {
            $data['langaugeTeamEmail'] = '';
        } else {
            str_replace('<', '', $data['langaugeTeamEmail']);
            str_replace('>', '', $data['langaugeTeamEmail']);
        }

        if (!isset($data['lang']) || !$data['lang']) {
            $data['lang'] = '';
        }

        if (!isset($data['basepath']) || !$data['basepath']) {
            $data['basepath'] = '';
        }

        if (!isset($data['language']) || !$data['language']) {
            $data['language'] = '';
        }

        if (!isset($data['country']) || !$data['country']) {
            $data['country'] = '';
        }

        return $data;
    }

    /**
     * Make po-file settings formated string
     * @param array $data - settings array
     * @return boolean
     */
    private function makePoFileSettings($data = array()) {
        if (!empty($data)) {
            $data = $this->prepareSettingsArray($data);
            $settings = array(
                'msgid ""',
                'msgstr ""',
                '"Project-Id-Version: ' . $data['projectName'] . '\n"',
                '"Report-Msgid-Bugs-To: \n"',
                '"POT-Creation-Date: ' . date('Y-m-d h:iO', time()) . '\n"',
                '"PO-Revision-Date: ' . date('Y-m-d h:iO', time()) . '\n"',
                '"Last-Translator: ' . $data['translatorName'] . ' <' . $data['translatorEmail'] . '>\n"',
                '"Language-Team: ' . $data['langaugeTeamName'] . ' <' . $data['langaugeTeamEmail'] . '>\n"',
                '"Language: ' . $data['lang'] . '\n"',
                '"MIME-Version: 1.0\n"',
                '"Content-Type: text/plain; charset=UTF-8\n"',
                '"Content-Transfer-Encoding: 8bit\n"',
                '"X-Poedit-KeywordsList: _;gettext;gettext_noop;lang\n"',
                '"X-Poedit-Basepath: ' . $data['basepath'] . '\n"',
                '"X-Poedit-SourceCharset: utf-8\n"',
                '"X-Generator: Poedit 1.5.7\n"',
                '"X-Poedit-Language: ' . $data['language'] . '\n"',
                '"X-Poedit-Country: ' . $data['country'] . '\n"'
            );

            if (isset($data['paths']) && count($data['paths']) > 0) {
                foreach ($data['paths'] as $number => $path) {
                    $settings[] = '"X-Poedit-SearchPath-' . $number . ': ' . $path . '\n"';
                }
            }

            return implode("\n", $settings);
        } else {
            self::$ERRORS[] = lang('Settings array is empty', 'translator');
            return FALSE;
        }
    }

    /**
     * Create po-file
     * @param string $name - module or template name
     * @param string $type - type of po-file(modules, templates, main)
     * @param string $lang - language locale
     * @param array $settings - settings array
     * @return boolean
     */
    public function create($name, $type, $lang, $settings) {
        if ($name && $type && $lang) {
            $url = $this->getPoFileUrl($name, $type, $lang);

            if (file_exists($url)) {
                $this->setError(lang('File is already exists.', 'translator'));
                return FALSE;
            }

            if (!@fopen($url, "wb")) {
                $this->setError(lang('Can not create file. Check if path to the file is correct - ', 'translator') . $url);
                return FALSE;
            }

            $settings = $this->makePoFileSettings($settings);
            if (file_put_contents($url, b"\xEF\xBB\xBF" . $settings)) {
                return TRUE;
            } else {
                $this->setError(lang('Can not create file. Check if path to the file is correct - ', 'translator') . $url);
                return FALSE;
            }
        }
    }

    /**
     * Save po-file from array
     * @param string $name - module or template name
     * @param string $type - type of po-file(modules, templates, main)
     * @param string $lang - language locale
     * @param array $data - po-file data
     * @return boolean
     */
    public function save($name, $type, $lang, $data) {
        $url = $this->getPoFileUrl($name, $type, $lang);

        if (!$url) {
            $this->setError(lang('Wrong po-file path', 'translator'));
            return FALSE;
        }

        if (!FileOperator::getInstatce()->checkFile($url)) {
            $errors = FileOperator::getInstatce()->getErrors();
            $this->setError($errors['error']);
            return FALSE;
        }

        $settings = $this->makePoFileSettings((array) $data['settings']);
        unset($data['settings']);

        $po_file_data = $this->makePoFileData($data);
        $po_file_content = b"\xEF\xBB\xBF" . $settings . "\n\n" . $po_file_data;

        if (file_put_contents($url, $po_file_content)) {
            if ($this->convertToMO($url)) {
                return TRUE;
            } else {
                $this->setError(lang('Operation failed. Can not convert to mo-file.', 'translator'));
                return FALSE;
            }
        } else {
            $this->setError(lang('Can not save po-file.', 'translator'));
            return FALSE;
        }
    }

    /**
     * Prepare correct po-file data
     * @param type $data
     * @return string
     */
    private function preparePoFileData($data) {
        if (!isset($data['comment']) || !$data['comment']) {
            $data['comment'] = '';
        }

        if (!isset($data['links']) || !$data['links']) {
            $data['links'] = '';
        }

        if (!isset($data['fuzzy']) || !$data['fuzzy']) {
            $data['fuzzy'] = '';
        }

        if (!isset($data['translation']) || !$data['translation']) {
            $data['translation'] = '';
        }
        return $data;
    }

    /**
     * Make po-file data
     * @param array $data - po-file data
     * @return string
     */
    private function makePoFileData($data = array()) {
        $resultData = array();
        foreach ($data as $key => $po) {
            if ($po) {
                $po = $this->preparePoFileData((array) $po);

                if ($po['comment']) {
                    $resultData[] = "# " . $po['comment'] . '"';
                }

                if ($po['links']) {
                    foreach ($po['links'] as $link) {
                        $resultData[] = "#: " . $link . '"';
                    }
                }

                if ($po['fuzzy']) {
                    $resultData[] = "#, fuzzy";
                }

                if ($key) {
                    $resultData[] = 'msgid "' . $key . '"';
                }

                if ($po['translation']) {
                    $resultData[] = 'msgstr "' . $po['translation'] . '"' . "\n";
                } else {
                    $resultData[] = 'msgstr "' . '"' . "\n";
                }
            }
        }
        return implode("\n", $resultData);
    }

    /**
     * Convert po-file to mo-file
     * @param string $url - url to file
     * @return boolean
     */
    public function convertToMO($url = '') {
        require_once(realpath(dirname(__FILE__) . '/..') . '/lib/php-mo.php');

        if ($url) {
            return \phpmo_convert($url);
        }
    }

    public function toArray($name, $type, $lang) {
        $path = $this->getPoFileUrl($name, $type, $lang);

        if (!FileOperator::getInstatce()->checkFile($path)) {
            return FALSE;
        } else {
            $po = file($path);
        }

        $origin = null;
        foreach ($po as $key => $line) {

            if (!($key > 2 && $origin))
                $this->prepareSettingsValues($line);

            $first2symbols = substr($line, 0, 2);
            if (substr($line, 0, 1) == '#' && $first2symbols != '#:' && $first2symbols != '#,') {
                $comment = trim(substr($line, 2, -1));
                continue;
            }
            if ($first2symbols == '#,') {
                $fuzzy = TRUE;
                continue;
            }

            if ($first2symbols == '#:') {
                $links[] = trim(substr($line, 2, -2));
                continue;
            }

            if (substr($line, 0, 5) == 'msgid') {
                if (preg_match('/"(.*?)"/', $line, $matches)) {
                    $origin = $matches[1];
                    if (!strlen($origin)) {
                        $origin = 0;
                    }
                }

                continue;
            }

            if (substr($line, 0, 6) == 'msgstr') {
                if ($origin) {
                    $translations[$origin] = array(
                        'translation' => trim(substr($line, 8, -2)),
                        'comment' => $comment,
                        'links' => $links,
                        'fuzzy' => $fuzzy
                    );
                }
                $fuzzy = FALSE;
                $comment = '';
                unset($links);
            }
        }

        $result = array(
            'settings' => $this->po_settings,
            'po_array' => $translations
        );

        return $result;
    }

    private function prepareSettingsValues($line) {
        foreach ($this->po_settings_keys as $key) {
            if (preg_match('/' . $key . '/', $line)) {
                $from = strpos($line, ':');

                if (substr($line, -5, -4) == '\\') {
                    $value = substr($line, $from + 2, -5);
                } else {
                    $value = substr($line, $from + 2, -4);
                }

                switch ($key) {
                    case 'SearchPath':
                        $this->po_settings['SearchPath'][] = $value;
                        break 2;
                    case 'Last-Translator':
                        $value = explode(' ', $value);
                        $this->po_settings['Last-Translator-Name'] = $value[0];
                        $value[1] = str_replace('<', '', $value[1]);
                        $value[1] = str_replace('>', '', $value[1]);
                        $this->po_settings['Last-Translator-Email'] = $value[1] ? $value[1] : '';
                        break 2;
                    case 'Language-Team':
                        $value = explode(' ', $value);
                        $this->po_settings['Language-Team-Name'] = $value[0];
                        $value[1] = str_replace('<', '', $value[1]);
                        $value[1] = str_replace('>', '', $value[1]);
                        $this->po_settings['Language-Team-Email'] = $value[1] ? $value[1] : '';
                        break 2;
                    case 'Basepath':
                        $this->po_settings['Basepath'] = $value;
                        break 2;
                    default :
                        $this->po_settings[$key] = $value;
                        break 2;
                }
            }
        }
        return $this->po_settings;
    }

}