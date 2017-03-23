<?php

namespace translator\classes;

use Gettext\Translation;
use Gettext\Translations;

class LangReplacer
{

    public static $domainTranslations = [];

    const LANG_FUNC = '(t?langf?)';

    const WORD = '([\s\S]+?)';

    const QUOTE = '[\'\"]{1}';

    const QUOTED_WORD = self::QUOTE . self::WORD . self::QUOTE;

    const QUOTED_DOMAIN = '(?:\s*,\s*' . self::QUOTE . self::WORD . self::QUOTE . ')?';

    const QUOTED_PARAMS = '(?:\s*,\s*' . self::WORD . ')?';

    const EXPRESSION = '/' . self::LANG_FUNC . '\(' . self::QUOTED_WORD . self::QUOTED_DOMAIN . '\)/';


    /*
     *******************************************************************************************************************
     * INTERFACE
     *
     * USAGE
     *  $module = 'aggregator';
     *  $allModules
     *  LangReplacer::replaceModuleLangStrings($module);
     *  LangReplacer::replaceMainLangStrings();
     *  LangReplacer::findCyrillicKeys($module)
     *******************************************************************************************************************
     */

    public static function findCyrillicKeys($module) {
        if ($module == 'main') {
            $langStrings = self::parseMain();
        } else {
            $langStrings = self::parseModule($module);
        }
        $found = [];

        foreach ($langStrings as $file => $found) {
            foreach (array_keys($found) as $key) {

                if (self::isCyrillic($key)) {
                    dump($file, $key);
                }

            }
        }

    }

    public static function replaceMainLangStrings() {

        $mainLangStrings = self::parseMain();

        $module = 'main';
        foreach ($mainLangStrings as $file => $data) {
            $translated = self::changeKeysInFile($file, $data);
            self::updateKeysInMoPoFiles($translated, $module);
        }
        self::savePoMo($module);
    }

    /**
     * Replace key to english translation
     * Add translation to other languages for this key
     * @param $module
     */
    public static function replaceModuleLangStrings($module) {

        $moduleLangStrings = self::parseModule($module);

        foreach ($moduleLangStrings as $file => $data) {
            $translated = self::changeKeysInFile($file, $data);
            self::updateKeysInMoPoFiles($translated, $module);
        }

    }

    private static function savePoMo($saveDomain) {
        foreach (self::$domainTranslations as $domain => $langs) {
            if ($domain == $saveDomain) {

                foreach ($langs as $lang => $translation) {
                    $dir = self::getDomainPoFilePath($domain, $lang);
                    dump(sprintf('Po file saving.. : %s', $dir));
                    $translation->toPoFile($dir);
                    $dir = self::createDomainMoFilePath($domain, $lang);
                    $translation->toMoFile($dir);
                    dump(sprintf('Mo file saving.. : %s', $dir));
                }
            }
        }
    }

    /**
     *
     * @param array $translated
     * @param string $module
     */
    private static function updateKeysInMoPoFiles($translated, $module) {

        $languages = self::getModuleLanguages($module);
        foreach ($languages as $language) {
            $translationsAllLocales[$language] = self::getDomainTranslations($module, $language);
        }

        foreach ($translated as $changed) {
            foreach ($changed as $one) {
                foreach ($translationsAllLocales as $lang => $translationsOneLocale) {
                    /** @var Translation $oldTranslation */
                    $oldTranslation = $translationsOneLocale->find('', $one['from']);

                    if ($oldTranslation) {
                        $newTranslation = new Translation('', $one['to']);
                        $newTranslation->mergeWith($oldTranslation);
                        $translationsOneLocale[] = $newTranslation;

                        if (!$newTranslation->getTranslation()) {
                            $newTranslation->setTranslation($one['from']);
                        }

                    }
                }
            }

        }

    }

    /**
     * @param string $file
     * @param array $data
     * @return array
     */
    private static function changeKeysInFile($file, $data) {
        $translated = [];
        if (is_writable($file)) {
            $content = $newContent = file_get_contents($file);
            foreach ($data as $signature => $data) {
                $function = $data['function'];
                $word = $data['string'];
                $domain = $data['domain'];
                $params = $data['params'];
                $translation = self::translate($domain, $word, 'en_US');
                if ($translation && $translation !== $word) {
                    $newSignature = self::createReplacement($function, $translation, $domain, $params);
                    $translated[$domain][] = [
                                              'from'   => $word,
                                              'to'     => $translation,
                                              'domain' => $domain,
                                             ];
                    dump(sprintf('%s replaced to %s', $signature, $newSignature));
                    $newContent = str_replace($signature, $newSignature, $newContent);
                    //                    dump(sprintf('Changed %s to %s', $word, $translation));
                } else {
                    dump(sprintf("No default translation for: '%s' in domain %s", $word, $domain));
                }

            }

            if ($newContent && $newContent !== $content) {
                dump(sprintf('File %s saved: %s', $file, file_put_contents($file, $newContent) ? 'TRUE' : 'FALSE'));
            } else {
                //                dump("Warning: {$file} no content or no changes");
            }
        } else {
            dump("File: {$file} is not writable");

        }

        return $translated;

    }

    public static function getMainPaths() {
        return [
                APPPATH . 'core',
                APPPATH . 'errors',
                APPPATH . 'helpers',
                APPPATH . 'libraries',
                APPPATH . 'modules/shop/classes',
                APPPATH . 'modules/shop/helpers',

                PUBPATH . 'system/language/form_validation',
                PUBPATH . 'system/language/email_lang',
                PUBPATH . 'system/language/upload',
                PUBPATH . 'system/libraries',
                PUBPATH . 'templates/administrator/js/jquery-validate',
                PUBPATH . 'application/modules/shop/widgets',
                PUBPATH . 'application/modules/shop/models',

               ];
    }

    /*
     *******************************************************************************************************************
     * PARSE
     *******************************************************************************************************************
     */

    /**
     * Find lang calls in module files
     *
     * @param $module
     * @return array
     */
    public static function parseModule($module) {
        return self::parseDir(self::getModulePath($module));
    }

    /**
     * Find all main lang calls in main directories
     * @return array
     */
    public static function parseMain() {

        $results = [];
        foreach (self::getMainPaths() as $mainPath) {

            $add = self::parseDir($mainPath);
            if (is_array($add)) {
                $results = array_merge($results, $add);
            }
        }
        return $results;
    }

    /**
     * Search lang function call in all php|tpl files recursively
     * @param $dir
     * @return array
     */
    public static function parseDir($dir) {
        $dirIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
        $results = [];
        /** @var \SplFileInfo $item */
        foreach ($dirIterator as $item) {
            if ($item->isFile() && in_array($item->getExtension(), ['php', 'tpl']) && !strstr($item->getBasename(), 'jsLangs')) {
                $res = self::find(file_get_contents($item->getRealPath()));
                if (count($res[0])) {
                    foreach ($res[0] as $key => $signature) {
                        $results[$item->getRealPath()][$signature] = [
                                                                      'function' => $res[1][$key],
                                                                      'string'   => $res[2][$key],
                                                                      'domain'   => $res[3][$key],
                                                                      'params'   => $res[4][$key],
                                                                     ];
                    }
                }
            }
        }

        return $results;
    }

    /*
     *******************************************************************************************************************
     *  Translate
     *******************************************************************************************************************
     */

    /**
     * @param $domain
     * @param $word
     * @param string $lang
     * @return null|string
     */
    public static function translate($domain, $word, $lang = 'en_US') {

        $domain = $domain ?: 'main';
        $translations = self::getDomainTranslations($domain, $lang);

        $translation = $translations->find(null, $word);

        return $translation ? $translation->getTranslation() : null;
    }

    /**
     * @param $domain
     * @param string $locale
     * @return Translations
     */
    public static function getDomainTranslations($domain, $locale = 'en_US') {

        if (!isset(self::$domainTranslations[$domain][$locale])) {
            self::$domainTranslations[$domain][$locale] = Translations::fromPoFile(self::getDomainPoFilePath($domain, $locale));

        }
        return self::$domainTranslations[$domain][$locale];
    }

    /*
     *******************************************************************************************************************
     * REGEXP
     *******************************************************************************************************************
     */

    /**
     * Find all language calls in string
     * @param $fileContent
     * @param string $word
     * @return array
     */
    public static function find($fileContent, $word = '') {
        $expression = self::createExpression($word);
        preg_match_all($expression, $fileContent, $matches);
        return $matches;
    }

    public static function isCyrillic($word) {
        return preg_match('/[\p{Cyrillic}]/u', $word) || preg_match('/[А-Яа-яЁё]/u', $word);
    }

    /**
     * Create lang function call
     * @param $function
     * @param $word
     * @param $domain
     * @param $params
     * @return string
     */
    public static function createReplacement($function, $word, $domain, $params) {
        return sprintf("%s('%s'%s%s)", $function, $word, $domain ? sprintf(", '%s'", $domain) : '', $params ? sprintf(', %s', $params) : '');
    }

    /**
     * Create regular expression for lang call
     * @param $word
     * @return string
     */
    private static function createExpression($word = null) {

        $word = $word ? "($word)" : self::WORD;
        $quotedWord = self::QUOTE . $word . self::QUOTE;
        $expression = '/' . self::LANG_FUNC . '\(' . $quotedWord . self::QUOTED_DOMAIN . self::QUOTED_PARAMS . '\)/';

        return $expression;

    }

    /*
     *******************************************************************************************************************
     * PATHS
     *******************************************************************************************************************
     */

    /**
     * Get lang directories for module
     *
     * @param $module
     * @return array ['en_US', ...]
     */
    public static function getModuleLanguages($module) {
        $languages = [];

        if (in_array($module, ['shop', '', 'main'])) {
            $path = PUBPATH . APPPATH . 'language/main/*';
        } else {
            $path = self::getModulePath($module) . '/language/*';
        }

        foreach (glob($path) as $item) {
            $languages[] = substr($item, strrpos($item, '/') + 1);
        }
        return $languages;
    }

    /**
     * Get po file path
     * @param string $domain
     * @param string $locale
     * @return string
     */
    public static function getDomainPoFilePath($domain, $locale = 'en_US') {
        if (in_array($domain, ['shop', '', 'main'])) {
            $domain = 'main';
        }

        $dir = self::getTranslationDir($domain, $locale);
        return sprintf('%s%s.po', $dir, $domain);

    }

    /**
     * Create new mo file path
     * @param $domain
     * @param string $locale
     * @return string
     */
    public static function createDomainMoFilePath($domain, $locale = 'en_US') {
        if (in_array($domain, ['shop', '', 'main'])) {
            $domain = 'main';
        }

        $dir = self::getTranslationDir($domain, $locale);
        return sprintf('%s%s_%s.mo', $dir, $domain, time());
    }

    /**
     * Languages directory
     *
     * @param $domain
     * @param $locale
     * @return string
     */
    public static function getTranslationDir($domain, $locale) {
        if (in_array($domain, ['shop', '', 'main'])) {
            $transPath = PUBPATH . APPPATH . "language/main/{$locale}/LC_MESSAGES/";
        } else {
            $transPath = self::getModulePath($domain) . "/language/{$locale}/LC_MESSAGES/";
        }
        return $transPath;
    }

    /**
     * Full path to module
     * @param $moduleName
     * @return string
     */
    public static function getModulePath($moduleName) {
        return PUBPATH . APPPATH . 'modules/' . $moduleName;
    }

    public static function getAllModules() {
        $modules = [];
        $paths = PUBPATH . APPPATH . 'modules/*';

        foreach (glob($paths) as $path) {

            $modules[] = substr($path, strrpos($path, '/') + 1);
        }

        return $modules;
    }

}