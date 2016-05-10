<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * @param string $str
 * @return string
 */
function translit($str) {
    $tr = [
           'А'  => 'A',
           'Б'  => 'B',
           'В'  => 'V',
           'Г'  => 'G',
           'Д'  => 'D',
           'Е'  => 'E',
           'Ж'  => 'ZH',
           'З'  => 'Z',
           'И'  => 'I',
           'Й'  => 'I',
           'К'  => 'K',
           'Л'  => 'L',
           'М'  => 'M',
           'Н'  => 'N',
           'О'  => 'O',
           'П'  => 'P',
           'Р'  => 'R',
           'С'  => 'S',
           'Т'  => 'T',
           'У'  => 'U',
           'Ф'  => 'F',
           'Х'  => 'H',
           'Ц'  => 'TS',
           'Ч'  => 'CH',
           'Ш'  => 'SH',
           'Щ'  => 'SHCH',
           'Ъ'  => '',
           'Ы'  => 'Y',
           'Ь'  => "'",
           'Э'  => 'E',
           'Ю'  => 'IU',
           'Я'  => 'IA',
           'Г'  => 'G',
           'Ї'  => 'YI',
           'І'  => 'I',
           'Є'  => 'E',
           'а'  => 'a',
           'б'  => 'b',
           'в'  => 'v',
           'г'  => 'g',
           'д'  => 'd',
           'е'  => 'e',
           'ж'  => 'zh',
           'з'  => 'z',
           'и'  => 'i',
           'й'  => 'i',
           'к'  => 'k',
           'л'  => 'l',
           'м'  => 'm',
           'н'  => 'n',
           'о'  => 'o',
           'п'  => 'p',
           'р'  => 'r',
           'с'  => 's',
           'т'  => 't',
           'у'  => 'u',
           'ф'  => 'f',
           'х'  => 'h',
           'ц'  => 'ts',
           'ч'  => 'ch',
           'ш'  => 'sh',
           'щ'  => 'shch',
           'ъ'  => '',
           'ы'  => 'y',
           'ь'  => "'",
           'э'  => 'e',
           'ю'  => 'iu',
           'я'  => 'ia',
           'г'  => 'g',
           'ї'  => 'yi',
           'і'  => 'i',
           'є'  => 'e',
           'ё'  => 'e',
           'Ё'  => 'e',
           ' '  => ' ',
           '.'  => '',
           ':'  => '',
           ';'  => '',
           '/'  => '-',
          ];

    return strtr($str, $tr);
}

/**
 *
 * @param string $urlstr
 * @return string
 */
function translit_url($urlstr) {
    if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
        $urlstr = str_replace(' ', '-', $urlstr);
        $urlstr = translit($urlstr);
        $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
    }

    $url = strtolower(url_title($urlstr));
    $url = mb_substr($url, 0, 255);
    return $url;
}