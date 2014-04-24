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
?>
