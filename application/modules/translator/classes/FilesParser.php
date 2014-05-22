<?php

namespace translator\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class FilesParser {

    /**
     * FilesParser instance
     * @var FilesParser object
     */
    private static $instance;

    /**
     * Modules folder path
     */

    const MODULES_PATH = "./application/modules/";

    /**
     * Templates folder path
     */
    const TEMPLATES_PATH = "./templates/";

    /**
     * Main language folder path
     */
    const MAIN_PATH = "./application/language/main/";

    private static $ALLOW_EXTENSIONS = array('php', 'tpl', 'js');

    /**
     * Modules locales array
     * @var type 
     */
    private static $MODULES_LOCALES = array();

    /**
     * Templates locales array
     * @var type 
     */
    private static $TEMPLATES_LOCALES = array();

    /**
     * Main locales array
     * @var type 
     */
    private static $MAIN_LOCALES = array();
    private static $PARSE_REGEXPR = array(
        '(?<!\w)lang\([\"]{1}(?!\')(.*?)[\"]{1}',
        "(?<!\w)lang\([']{1}(?!\")(.*?)[']{1}",
        '(?<!\w)langf\([\"]{1}(?!\')(.*?)[\"]{1}',
        "(?<!\w)langf\([']{1}(?!\")(.*?)[']{1}"
    );
    private static $FINDED_LANGS = array();
    private static $FINDED_JS_LANGS = array();
    private static $PARSED_PATHS = array();

    private function __construct() {
        
    }

    /**
     * Get FilesParser instance
     * @return FilesParser
     */
    public static function getInstatce() {
        if (null === self::$instance)
            return self::$instance = new self();
        else
            return self::$instance;
    }

    /**
     * Get modules locales
     * @return array
     */
    public function parseModules() {
        try {
            $modules = new \DirectoryIterator(self::MODULES_PATH);
            foreach ($modules as $module) {
                if ($module->isDir() && !$module->isDot() && is_dir(self::MODULES_PATH . $module->getBasename() . '/language')) {
                    $module_dir = self::MODULES_PATH . $module->getBasename();
                    $language_dir = $module_dir . '/language/';
                    $locales = new \DirectoryIterator($language_dir);
                    foreach ($locales as $locale) {
                        if ($locale->isDir() && !$locale->isDot() && is_dir($language_dir . $locale->getBasename()) && isLocale($locale->getBasename())) {
                            $objLang = new \MY_Lang();
                            $objLang->load($module->getBasename());
                            include($module_dir . '/module_info.php');
                            $menu_name = $com_info['menu_name'] ? $com_info['menu_name'] : $module->getBasename();
                            self::$MODULES_LOCALES[$locale->getBasename()][] = array(
                                'module' => $module->getBasename(),
                                'menu_name' => ucfirst($menu_name)
                            );
                            unset($com_info);
                        }
                    }
                }
            }
            return self::$MODULES_LOCALES;
        } catch (Exception $exc) {
            return array();
        }
    }

    /**
     * Get templates locales
     * @return array
     */
    public function parseTemplates() {
        try {
            $templates = new \DirectoryIterator(self::TEMPLATES_PATH);
            foreach ($templates as $template) {
                if ($template->isDir() && !$template->isDot() && is_dir(self::TEMPLATES_PATH . $template->getBasename() . '/language/' . $template->getBasename())) {
                    $language_dir = self::TEMPLATES_PATH . $template->getBasename() . '/language/' . $template->getBasename() . '/';
                    $locales = new \DirectoryIterator($language_dir);
                    foreach ($locales as $locale) {
                        if ($locale->isDir() && !$locale->isDot() && is_dir($language_dir . $locale->getBasename()) && isLocale($locale->getBasename())) {
                            self::$TEMPLATES_LOCALES[$locale->getBasename()][] = array(
                                'template' => $template->getBasename()
                            );
                        }
                    }
                }
            }
            return self::$TEMPLATES_LOCALES;
        } catch (Exception $exc) {
            return array();
        }
    }

    /**
     * Get main locales
     * @return array
     */
    public function parseMain() {
        try {
            $main = new \DirectoryIterator(self::MAIN_PATH);
            foreach ($main as $locale) {
                if ($locale->isDir() && !$locale->isDot() && is_dir(self::MAIN_PATH . $locale->getBasename()) && isLocale($locale->getBasename())) {
                    self::$MAIN_LOCALES[$locale->getBasename()][] = array(
                        'main' => 'main'
                    );
                }
            }
            return self::$MAIN_LOCALES;
        } catch (Exception $exc) {
            return array();
        }
    }

    public function findLangs($dir = '') {
        if (!in_array($dir, self::$PARSED_PATHS)) {
            $baseDir = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
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
                                    $lang = array();
                                    mb_regex_encoding("UTF-8");
                                    mb_ereg_search_init($line, $regexpr);
                                    $lang = mb_ereg_search();
                                    if ($lang) {
                                        $lang = mb_ereg_search_getregs(); //get first result
                                        do {
                                            $origin = mb_ereg_replace('!\s+!', ' ', $lang[1]);
                                            if (!self::$FINDED_LANGS[$origin]) {
                                                self::$FINDED_LANGS[$origin] = array();
                                            }

                                            if ($file->getExtension() == 'js') {
                                                self::$FINDED_JS_LANGS[$origin] = $origin;
                                            }
                                            $path = str_replace("\\", "/", $file->getPathname());
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
        $data = array(
            'parsed_langs' => self::$FINDED_LANGS,
            'js_langs' => self::$FINDED_JS_LANGS
        );

        self::$FINDED_LANGS = array();
        self::$FINDED_JS_LANGS = array();

        return $data;
    }

    /**
     * Parse langs by all paths
     * @param string $baseUrl - url to directory of po-file
     * @param array $paths - paths array
     * @return boolean
     */
    public function getParsedPathsLangs($baseUrl, $paths = array()) {
        if ($paths) {
            $result = array();
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

?>
