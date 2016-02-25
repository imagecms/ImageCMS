<?php

if (!function_exists('sort_names')) {

    /**
     * Sorting names array for translator name selector
     * @param array $arr
     * @return array
     */
    function sort_names($arr) {

        return user_function_sort($arr, 'menu_name');
    }

}

if (!function_exists('get_language_name')) {

    /**
     * @return array
     */
    function get_language_names() {

        $languageCodes = [
            'ab' => lang('Abkhazian', 'translator', FALSE),
            'ae' => lang('Avestan', 'translator', FALSE),
            'an' => lang('Aragonese', 'translator', FALSE),
            'ar' => lang('Arabic', 'translator', FALSE),
            'az' => lang('Azerbaijani', 'translator', FALSE),
            'ba' => lang('Bashkir', 'translator', FALSE),
            'be' => lang('Belarusian', 'translator', FALSE),
            'bg' => lang('Bulgarian', 'translator', FALSE),
            'bh' => lang('Bihari', 'translator', FALSE),
            'bn' => lang('Bengali', 'translator', FALSE),
            'br' => lang('Breton', 'translator', FALSE),
            'bs' => lang('Bosnian', 'translator', FALSE),
            'ca' => lang('Catalan', 'translator', FALSE),
            'co' => lang('Corsican', 'translator', FALSE),
            'cr' => lang('Cree', 'translator', FALSE),
            'cs' => lang('Czech', 'translator', FALSE),
            'cv' => lang('Chuvash', 'translator', FALSE),
            'cy' => lang('Welsh', 'translator', FALSE),
            'da' => lang('Danish', 'translator', FALSE),
            'de' => lang('German', 'translator', FALSE),
            'el' => lang('Greek', 'translator', FALSE),
            'en' => lang('English', 'translator', FALSE),
            'eo' => lang('Esperanto', 'translator', FALSE),
            'es' => lang('Spanish', 'translator', FALSE),
            'et' => lang('Estonian', 'translator', FALSE),
            'eu' => lang('Basque', 'translator', FALSE),
            'fj' => lang('Fijian', 'translator', FALSE),
            'fo' => lang('Faroese', 'translator', FALSE),
            'fr' => lang('French', 'translator', FALSE),
            'ga' => lang('Irish', 'translator', FALSE),
            'he' => lang('Hebrew', 'translator', FALSE),
            'hu' => lang('Hungarian', 'translator', FALSE),
            'hy' => lang('Armenian', 'translator', FALSE),
            'id' => lang('Indonesian', 'translator', FALSE),
            'is' => lang('Icelandic', 'translator', FALSE),
            'it' => lang('Italian', 'translator', FALSE),
            'iu' => lang('Inuktitut', 'translator', FALSE),
            'ja' => lang('Japanese', 'translator', FALSE),
            'jv' => lang('Javanese', 'translator', FALSE),
            'ka' => lang('Georgian', 'translator', FALSE),
            'kk' => lang('Kazakh', 'translator', FALSE),
            'kl' => lang('Kalaallisut', 'translator', FALSE),
            'kn' => lang('Kannada', 'translator', FALSE),
            'ko' => lang('Korean', 'translator', FALSE),
            'kw' => lang('Cornish', 'translator', FALSE),
            'ky' => lang('Kirghiz', 'translator', FALSE),
            'la' => lang('Latin', 'translator', FALSE),
            'lb' => lang('Luxembourgish', 'translator', FALSE),
            'lg' => lang('Ganda', 'translator', FALSE),
            'li' => lang('Limburgish', 'translator', FALSE),
            'ln' => lang('Lingala', 'translator', FALSE),
            'lo' => lang('Lao', 'translator', FALSE),
            'lt' => lang('Lithuanian', 'translator', FALSE),
            'lv' => lang('Latvian', 'translator', FALSE),
            'mh' => lang('Marshallese', 'translator', FALSE),
            'mi' => lang('Maori', 'translator', FALSE),
            'mk' => lang('Macedonian', 'translator', FALSE),
            'mn' => lang('Mongolian', 'translator', FALSE),
            'ne' => lang('Nepali', 'translator', FALSE),
            'nl' => lang('Dutch', 'translator', FALSE),
            'no' => lang('Norwegian', 'translator', FALSE),
            'ny' => lang('Chichewa', 'translator', FALSE),
            'os' => lang('Ossetian', 'translator', FALSE),
            'pi' => lang('Pali', 'translator', FALSE),
            'pl' => lang('Polish', 'translator', FALSE),
            'ps' => lang('Pashto', 'translator', FALSE),
            'pt' => lang('Portuguese', 'translator', FALSE),
            'qu' => lang('Quechua', 'translator', FALSE),
            'ro' => lang('Romanian', 'translator', FALSE),
            'ru' => lang('Russian', 'translator', FALSE),
            'sa' => lang('Sanskrit', 'translator', FALSE),
            'sg' => lang('Sango', 'translator', FALSE),
            'sk' => lang('Slovak', 'translator', FALSE),
            'sl' => lang('Slovenian', 'translator', FALSE),
            'so' => lang('Somali', 'translator', FALSE),
            'sq' => lang('Albanian', 'translator', FALSE),
            'sr' => lang('Serbian', 'translator', FALSE),
            'su' => lang('Sundanese', 'translator', FALSE),
            'sv' => lang('Swedish', 'translator', FALSE),
            'ta' => lang('Tamil', 'translator', FALSE),
            'tk' => lang('Turkmen', 'translator', FALSE),
            'tn' => lang('Tswana', 'translator', FALSE),
            'tr' => lang('Turkish', 'translator', FALSE),
            'tt' => lang('Tatar', 'translator', FALSE),
            'uk' => lang('Ukrainian', 'translator', FALSE),
            'uz' => lang('Uzbek', 'translator', FALSE),
            'vi' => lang('Vietnamese', 'translator', FALSE),
            'yi' => lang('Yiddish', 'translator', FALSE),
            'zh' => lang('Chinese', 'translator', FALSE),
        ];

        asort($languageCodes);
        return $languageCodes;
    }

}

if (!function_exists('isLocale')) {

    /**
     * Check locale
     * @param string $lang
     * @return boolean
     */
    function isLocale($lang) {

        return in_array($lang, config_item('locales'));
    }

}

if (!function_exists('getEditorStyles')) {

    /**
     * @return array
     */
    function getEditorStyles() {

        $files = scandir(getModulePath('translator') . '/assets/js/src-min');
        $styles = [];
        foreach ($files as $file) {
            if (strstr($file, 'theme-')) {
                $matches = [];
                preg_match('/theme-([a-zA-Z_]+)/', $file, $matches);
                if ($matches) {
                    $styles[] = $matches[1];
                }
            }
        }
        return $styles;
    }

}

if (!function_exists('getSettings')) {

    /**
     * Get module settings
     * @return array
     */
    function getSettings() {

        $CI = &get_instance();
        $settings = $CI->db->select('settings')
            ->where('identif', 'translator')
            ->get('components')
            ->row_array();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

}

if (!function_exists('updateSettings')) {

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    function updateSettings($settings) {

        $CI = &get_instance();
        if ($settings && is_array($settings)) {
            return $CI->db->where('identif', 'translator')
                ->update(
                    'components',
                    ['settings' => serialize($settings)
                    ]
                );
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('makeCorrectUrl')) {

    /**
     * @param string $from
     * @param string $to
     * @return mixed|string
     */
    function makeCorrectUrl($from = '', $to = '') {

        $dotsCount = substr_count($to, '..');

        if (substr($from, -1) == '/') {
            $from = substr_replace($from, '', strlen($from) - 2);
        }

        for ($i = 0; $i < $dotsCount; $i++) {
            $pos = strrpos($from, '/');
            $from = substr_replace($from, '', $pos);
        }

        $dotsPos = strrpos($to, '..');
        if ($dotsPos) {
            $to = substr_replace($to, '', 0, $dotsPos + 2);
        }

        if (substr($to, 0, 1) == '.') {
            $to = substr_replace($to, '', 0, 1);
        }

        $url = $from . $to . '/';

        if (substr($url, 0, 1) == '/') {
            $url = substr_replace($url, '', 0, 1);
        }

        if (substr($url, 0, 2) == './') {
            $url = substr_replace($url, '', 0, 2);
        }

        return $url;
    }

}

function get_sec() {

    $mtime = microtime();
    $mtime = explode(' ', $mtime);
    $mtime = $mtime[1] + $mtime[0];
    return $mtime;
}

//________________________________________________________
if (!function_exists('get_mainsite_url')) {

    /**
     *
     * @param string $url
     * @return string
     */
    function get_mainsite_url($url) {

        $true_path = preg_replace('/\/language(.*)/', '', $url);

        if (strstr($true_path, './templates/')) {
            return $url;
        }

        if (MAINSITE) {
            $url_mainsite = MAINSITE . str_replace('./', '/', $true_path);
            if (is_dir($url_mainsite) || file_exists($url_mainsite)) {
                $url = MAINSITE . str_replace('./', '/', $url);
            }
        }

        return $url;
    }

}

if (!function_exists('is_client_module')) {

    function is_client_module($module_name) {

        //        if (is_dir('./application/' . getModContDirName($module_name) . '/' . $module_name) && !is_dir(MAINSITE . '/application/' . getModContDirName($module_name) . '/' . $module_name)) {
        //            return TRUE;
        //        } else {
        return FALSE;
        //        }
    }

}

if (!function_exists('can_edit_file')) {

    function can_edit_file($module_name, $entity_type) {

        if (!MAINSITE) {
            return TRUE;
        }

        if ((!is_client_module($module_name) && $entity_type == 'modules') || (MAINSITE && $entity_type == 'main')) {
            $can_edit_file = FALSE;
        } else {
            $can_edit_file = TRUE;
        }
        return $can_edit_file;
    }

}

if (!function_exists('get_file_name')) {

    function get_file_name($name, $type) {

        switch ($type) {
            case 'modules':
                $module_info = (MAINSITE ? MAINSITE : '.') . '/application/' . getModContDirName($name) . "/{$name}/module_info.php";
                include $module_info;
                $lang = new MY_Lang();
                $lang->load($name);

                return lang('Module', 'translator') . ' - ' . $com_info['menu_name'];
                break;
            case 'templates':
                return lang('Template', 'translator') . ' - ' . $name;
                break;
            case 'main':
                return lang('Main file', 'translator');
                break;
            default:
                return '';
                break;
        }
    }

}