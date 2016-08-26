<?php

namespace translator\classes;

use DirectoryIterator;
use Exception;
use MY_Lang;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class FilesParser
{

    /**
     * FilesParser instance
     * @var FilesParser object
     */
    private static $instance;

    /**
     * Templates folder path
     */
    private static $TEMPLATES_PATH = '';

    /**
     * Main language folder path
     */
    private static $MAIN_PATH = '';

    public static $ALLOW_EXTENSIONS = [
                                       'php',
                                       'tpl',
                                       'js',
                                      ];

    /**
     * Modules locales array
     * @var array
     */
    private static $MODULES_LOCALES = [];

    /**
     * Templates locales array
     * @var array
     */
    private static $TEMPLATES_LOCALES = [];

    /**
     * Main locales array
     * @var array
     */
    private static $MAIN_LOCALES = [];

    public static $PARSE_REGEXPR = [
                                    '(?<!\w)t?langf?\([\"]{1}(?!\')(.*?)[\"]{1}',
                                    "(?<!\w)t?langf?\([']{1}(?!\")(.*?)[']{1}",
                                   ];

    /**
     * @var array
     */
    private static $FINDED_LANGS = [];

    /**
     * @var array
     */
    private static $FINDED_JS_LANGS = [];

    /**
     * @var array
     */
    private static $PARSED_PATHS = [];

    /**
     * FilesParser constructor.
     */
    private function __construct() {

        self::$TEMPLATES_PATH = './templates/';
        self::$MAIN_PATH = './application/language/main/';
    }

    /**
     * Get FilesParser instance
     * @return FilesParser
     */
    public static function getInstatce() {

        if (null === self::$instance) {
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }

    /**
     * Get modules locales
     * @return array
     */
    public function parseModules() {

        try {
            $modules = getModulesPaths();
            foreach ($modules as $moduleName => $modulePath) {
                $language_dir = $modulePath . 'language/';
                if (!file_exists($language_dir)) { // TODO: Спитати Марка чому в shop нема language =))
                    continue;
                }
                $locales = new DirectoryIterator($language_dir);
                foreach ($locales as $locale) {
                    if ($locale->isDir() && !$locale->isDot() && is_dir($language_dir . $locale->getBasename()) && isLocale($locale->getBasename())) {
                        $objLang = new MY_Lang();
                        $objLang->load($moduleName);

                        $module_info = $module_dir . '/module_info.php';
                        $module_info = \get_mainsite_url($module_info);

                        include $module_info;
                        $menu_name = $com_info['menu_name'] ? $com_info['menu_name'] : $moduleName;
                        self::$MODULES_LOCALES[$locale->getBasename()][] = [
                                                                            'module'    => $moduleName,
                                                                            'menu_name' => ucfirst($menu_name),
                                                                           ];
                        unset($com_info);
                    }
                }
            }

            return self::$MODULES_LOCALES;
        } catch (Exception $exc) {
            return [];
        }
    }

    /**
     * Get templates locales
     * @return array
     */
    public function parseTemplates() {

        try {
            if (!is_dir(self::$TEMPLATES_PATH)) {
                return [];
            }

            $templates = new DirectoryIterator(self::$TEMPLATES_PATH);
            foreach ($templates as $template) {
                if ($template->isDir() && !$template->isDot() && is_dir(self::$TEMPLATES_PATH . $template->getBasename() . '/language/' . $template->getBasename())) {
                    $language_dir = self::$TEMPLATES_PATH . $template->getBasename() . '/language/' . $template->getBasename() . '/';
                    $locales = new DirectoryIterator($language_dir);
                    foreach ($locales as $locale) {
                        if ($locale->isDir() && !$locale->isDot() && is_dir($language_dir . $locale->getBasename()) && isLocale($locale->getBasename())) {
                            self::$TEMPLATES_LOCALES[$locale->getBasename()][] = [
                                                                                  'template' => $template->getBasename(),
                                                                                 ];
                        }
                    }
                }
            }
            return self::$TEMPLATES_LOCALES;
        } catch (Exception $exc) {
            return [];
        }
    }

    /**
     * Get main locales
     * @return array
     */
    public function parseMain() {

        try {
            if (!is_dir(self::$MAIN_PATH)) {
                return [];
            }

            $main = new DirectoryIterator(self::$MAIN_PATH);
            foreach ($main as $locale) {
                if ($locale->isDir() && !$locale->isDot() && is_dir(self::$MAIN_PATH . $locale->getBasename()) && isLocale($locale->getBasename())) {
                    self::$MAIN_LOCALES[$locale->getBasename()][] = ['main' => 'main'];
                }
            }
            return self::$MAIN_LOCALES;
        } catch (Exception $exc) {
            return [];
        }
    }

    /**
     * @param string $dir
     * @return array
     */
    public function findLangs($dir = '') {

        if (!in_array($dir, self::$PARSED_PATHS)) {
            $baseDir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
            foreach ($baseDir as $file) {
                if ($file->isFile()) {
                    if (in_array($file->getExtension(), self::$ALLOW_EXTENSIONS) && !strstr($file->getBasename(), 'jsLangs')) {
                        $content = @file($file->getPathname());
                        $implode_content = implode(' ', $content);
                        $lang_exist = FALSE;
                        foreach (self::$PARSE_REGEXPR as $regexpr) {
                            $lang_exist = $lang_exist || preg_match('/' . $regexpr . '/', $implode_content);
                        }

                        if ($lang_exist) {
                            foreach ($content as $line_number => $line) {
                                foreach (self::$PARSE_REGEXPR as $regexpr) {

                                    mb_regex_encoding('UTF-8');
                                    mb_ereg_search_init($line, $regexpr);
                                    $lang = mb_ereg_search();
                                    if ($lang) {
                                        $lang = mb_ereg_search_getregs(); //get first result
                                        do {
                                            $origin = mb_ereg_replace('!\s+!', ' ', $lang[1]);

                                            if (!self::$FINDED_LANGS[$origin]) {
                                                self::$FINDED_LANGS[$origin] = [];
                                            }

                                            if ($file->getExtension() == 'js') {
                                                self::$FINDED_JS_LANGS[$origin] = $origin;
                                            }

                                            $path = str_replace('\\', '/', $file->getPathname());
                                            array_push(self::$FINDED_LANGS[$origin], $path . ':' . ($line_number + 1));
                                            $lang = mb_ereg_search_regs(); //get next result
                                        } while ($lang);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        self::$PARSED_PATHS[] = $dir;
        $data = [
                 'parsed_langs' => self::$FINDED_LANGS,
                 'js_langs'     => self::$FINDED_JS_LANGS,
                ];

        self::$FINDED_LANGS = [];
        self::$FINDED_JS_LANGS = [];
        return $data;
    }

    /**
     * Parse langs by all paths
     * @param string $baseUrl - url to directory of po-file
     * @param array $paths - paths array
     * @return boolean
     */
    public function getParsedPathsLangs($baseUrl, $paths = []) {

        if ($paths) {
            $result = [];
            if ($paths) {
                foreach ($paths as $key => $path) {
                    $scan_path = makeCorrectUrl($baseUrl, $path);
                    if (file_exists($scan_path)) {

                        $finded = $this->findLangs($scan_path);
                        if ($finded['parsed_langs']) {
                            $result['js_langs'][] = $finded['js_langs'];
                            $result['parsed_langs'][] = $finded['parsed_langs'];
                        }
                        if ($key == 0) {
                            $baseUrl = makeCorrectUrl($baseUrl, $path);
                            $baseUrl = substr_replace($baseUrl, '', strlen($baseUrl) - 1);
                        }
                    }
                }
            }
            return $result;
        } else {
            return FALSE;
        }
    }

}