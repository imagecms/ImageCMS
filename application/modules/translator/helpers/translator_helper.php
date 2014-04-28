<?php

if (!function_exists('sort_names')) {

    /**
     * Sorting names array for translator name selector
     * @param array $arr
     * @return array
     */
    function sort_names($arr) {
        usort($arr, function($a, $b) {
                    $first = $a['menu_name'];
                    $second = $b['menu_name'];
                    return strnatcmp($first, $second);
                });
        return $arr;
    }

}

if (!function_exists('get_language_name')) {

    function get_language_names() {
        $languageCodes = array(
            "ab" => lang("Abkhazian", 'translator'),
            "ae" => lang("Avestan", 'translator'),
            "an" => lang("Aragonese", 'translator'),
            "ar" => lang("Arabic", 'translator'),
            "az" => lang("Azerbaijani", 'translator'),
            "ba" => lang("Bashkir", 'translator'),
            "be" => lang("Belarusian", 'translator'),
            "bg" => lang("Bulgarian", 'translator'),
            "bh" => lang("Bihari", 'translator'),
            "bn" => lang("Bengali", 'translator'),
            "br" => lang("Breton", 'translator'),
            "bs" => lang("Bosnian", 'translator'),
            "ca" => lang("Catalan", 'translator'),
            "co" => lang("Corsican", 'translator'),
            "cr" => lang("Cree", 'translator'),
            "cs" => lang("Czech", 'translator'),
            "cv" => lang("Chuvash", 'translator'),
            "cy" => lang("Welsh", 'translator'),
            "da" => lang("Danish", 'translator'),
            "de" => lang("German", 'translator'),
            "el" => lang("Greek", 'translator'),
            "en" => lang("English", 'translator'),
            "eo" => lang("Esperanto", 'translator'),
            "es" => lang("Spanish", 'translator'),
            "et" => lang("Estonian", 'translator'),
            "eu" => lang("Basque", 'translator'),
            "fj" => lang("Fijian", 'translator'),
            "fo" => lang("Faroese", 'translator'),
            "fr" => lang("French", 'translator'),
            "ga" => lang("Irish", 'translator'),
            "he" => lang("Hebrew", 'translator'),
            "hu" => lang("Hungarian", 'translator'),
            "hy" => lang("Armenian", 'translator'),
            "id" => lang("Indonesian", 'translator'),
            "is" => lang("Icelandic", 'translator'),
            "it" => lang("Italian", 'translator'),
            "iu" => lang("Inuktitut", 'translator'),
            "ja" => lang("Japanese", 'translator'),
            "jv" => lang("Javanese", 'translator'),
            "ka" => lang("Georgian", 'translator'),
            "kk" => lang("Kazakh", 'translator'),
            "kl" => lang("Kalaallisut", 'translator'),
            "kn" => lang("Kannada", 'translator'),
            "ko" => lang("Korean", 'translator'),
            "kw" => lang("Cornish", 'translator'),
            "ky" => lang("Kirghiz", 'translator'),
            "la" => lang("Latin", 'translator'),
            "lb" => lang("Luxembourgish", 'translator'),
            "lg" => lang("Ganda", 'translator'),
            "li" => lang("Limburgish", 'translator'),
            "ln" => lang("Lingala", 'translator'),
            "lo" => lang("Lao", 'translator'),
            "lt" => lang("Lithuanian", 'translator'),
            "lv" => lang("Latvian", 'translator'),
            "mh" => lang("Marshallese", 'translator'),
            "mi" => lang("Maori", 'translator'),
            "mk" => lang("Macedonian", 'translator'),
            "mn" => lang("Mongolian", 'translator'),
            "ne" => lang("Nepali", 'translator'),
            "nl" => lang("Dutch", 'translator'),
            "no" => lang("Norwegian", 'translator'),
            "ny" => lang("Chichewa", 'translator'),
            "os" => lang("Ossetian", 'translator'),
            "pi" => lang("Pali", 'translator'),
            "pl" => lang("Polish", 'translator'),
            "ps" => lang("Pashto", 'translator'),
            "pt" => lang("Portuguese", 'translator'),
            "qu" => lang("Quechua", 'translator'),
            "ro" => lang("Romanian", 'translator'),
            "ru" => lang("Russian", 'translator'),
            "sa" => lang("Sanskrit", 'translator'),
            "sg" => lang("Sango", 'translator'),
            "sk" => lang("Slovak", 'translator'),
            "sl" => lang("Slovenian", 'translator'),
            "so" => lang("Somali", 'translator'),
            "sq" => lang("Albanian", 'translator'),
            "sr" => lang("Serbian", 'translator'),
            "su" => lang("Sundanese", 'translator'),
            "sv" => lang("Swedish", 'translator'),
            "ta" => lang("Tamil", 'translator'),
            "tk" => lang("Turkmen", 'translator'),
            "tn" => lang("Tswana", 'translator'),
            "tr" => lang("Turkish", 'translator'),
            "tt" => lang("Tatar", 'translator'),
            "uk" => lang("Ukrainian", 'translator'),
            "uz" => lang("Uzbek", 'translator'),
            "vi" => lang("Vietnamese", 'translator'),
            "yi" => lang("Yiddish", 'translator'),
            "zh" => lang("Chinese", 'translator'),
        );

        asort($languageCodes);
        return $languageCodes;
    }

}
if (!function_exists('isLocale')) {

    /**
     * Check locale 
     * @return array - locales
     */
    function isLocale($lang) {
        $langs = array(
            'af_ZA', 'am_ET', 'ar_AE',
            'ar_BH', 'ar_DZ', 'ar_EG',
            'ar_IQ', 'ar_JO', 'ar_KW',
            'ar_LB', 'ar_LY', 'ar_MA',
            'ar_OM', 'ar_QA', 'ar_SA',
            'ar_SY', 'ar_TN', 'ar_YE',
            'as_IN', 'ba_RU', 'be_BY',
            'bg_BG', 'bn_BD', 'bn_IN',
            'bo_CN', 'br_FR', 'ca_ES',
            'co_FR', 'cs_CZ', 'cy_GB',
            'da_DK', 'de_AT', 'de_CH',
            'de_DE', 'de_LI', 'de_LU',
            'dv_MV', 'el_GR', 'en_AU',
            'en_BZ', 'en_CA', 'en_GB',
            'en_IE', 'en_IN', 'en_JM',
            'en_MY', 'en_NZ', 'en_PH',
            'en_SG', 'en_TT', 'en_US',
            'en_ZA', 'en_ZW', 'es_AR',
            'es_BO', 'es_CL', 'es_CO',
            'es_CR', 'es_DO', 'es_EC',
            'es_ES', 'es_GT', 'es_HN',
            'es_MX', 'es_NI', 'es_PA',
            'es_PE', 'es_PR', 'es_PY',
            'es_SV', 'es_US', 'es_UY',
            'es_VE', 'et_EE', 'eu_ES',
            'fa_IR', 'fi_FI', 'fo_FO',
            'fr_BE', 'fr_CA', 'fr_CH',
            'fr_FR', 'fr_LU', 'fr_MC',
            'fy_NL', 'ga_IE', 'gd_GB',
            'gl_ES', 'gu_IN', 'he_IL',
            'hi_IN', 'hr_BA', 'hr_HR',
            'hu_HU', 'hy_AM', 'id_ID',
            'ig_NG', 'ii_CN', 'is_IS',
            'it_CH', 'it_IT', 'ja_JP',
            'ka_GE', 'kk_KZ', 'kl_GL',
            'km_KH', 'kn_IN', 'ko_KR',
            'ky_KG', 'lb_LU', 'lo_LA',
            'lt_LT', 'lv_LV', 'mi_NZ',
            'mk_MK', 'ml_IN', 'mn_MN',
            'mr_IN', 'ms_BN', 'ms_MY',
            'mt_MT', 'nb_NO', 'ne_NP',
            'nl_BE', 'nl_NL', 'nn_NO',
            'oc_FR', 'or_IN', 'pa_IN',
            'pl_PL', 'ps_AF', 'pt_BR',
            'pt_PT', 'ro_RO', 'ru_RU',
            'rw_RW', 'sa_IN', 'se_FI',
            'se_NO', 'se_SE', 'si_LK',
            'sk_SK', 'sl_SI', 'sq_AL',
            'sv_FI', 'sv_SE', 'sw_KE',
            'ta_IN', 'te_IN', 'th_TH',
            'tk_TM', 'tn_ZA', 'tr_TR',
            'tt_RU', 'ug_CN', 'uk_UA',
            'ur_PK', 'vi_VN', 'wo_SN',
            'xh_ZA', 'yo_NG', 'zh_CN',
            'zh_HK', 'zh_MO', 'zh_SG',
            'zh_TW', 'zu_ZA'
        );

        return in_array($lang, $langs);
    }

}

if (!function_exists('getEditorStyles')) {

    function getEditorStyles() {
        $files = scandir('./application/modules/translator/assets/js/src-min');
        $styles = array();
        foreach ($files as $file) {
            if (strstr($file, 'theme-')) {
                $matches = array();
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
        $CI = & get_instance();
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
        $CI = & get_instance();
        if ($settings && is_array($settings))
            return $CI->db->where('identif', 'translator')
                            ->update('components', array('settings' => serialize($settings)
            ));
        else
            return FALSE;
    }

}

if (!function_exists('makeCorrectUrl')) {

    function makeCorrectUrl($from = '', $to = "") {

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
        return $url;
    }

}

function get_sec() {
    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = $mtime[1] + $mtime[0];
    return $mtime;
}

?>
