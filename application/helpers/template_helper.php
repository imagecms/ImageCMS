<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Creator: Евгений Хрущ - JohnJ <johnj255@yandex.ru>
 * Date: 08.05.13
 */

if (!function_exists('include_file')) {
    /**
     * Рус: Выводит содержимое шаблона внутри другого шаблона
     * Анг: Write template content in other template
     * @exapmle: {include_file('templatename', array('var1' => 'value1', 'var2' => 'value2'))}
     * @param string $filename - имя файла
     * @param array $vars - переданные в шаблон переменные
     * @return null
     */
    function include_file($filename = '', array $vars = array()) {
        $CI =& get_instance();
        $templator = $CI->template;

        $filename = (strrpos($filename, '.tpl') == strlen($filename) - 4) ? substr($filename, 0, -4) : $filename;

        $templator->add_array($vars);
        $templator->display($filename);
    }
}

if (!function_exists('smarty_make_timestamp')) {
    /**
     * Рус: Внутренняя функция Smarty по обработке входной строки даты/времени.
     * Анг: Smarty-function for processing string parameter for date/time
     * @param $string - дата в формате строки или UNIX_TIMESTAMP (из MySQL)
     * @return int|string - дата в формате UNIX_TIMESTAMP
     */
    function smarty_make_timestamp($string)
    {
        if(empty($string)) {
            $string = "now";
        }
        $time = strtotime($string);
        if (is_numeric($time) && $time != -1)
            return $time;

        // is mysql timestamp format of YYYYMMDDHHMMSS?
        if (preg_match('/^\d{14}$/', $string)) {
            $time = mktime(substr($string,8,2),substr($string,10,2),substr($string,12,2),
                substr($string,4,2),substr($string,6,2),substr($string,0,4));

            return $time;
        }

        // couldn't recognize it, try to return a time
        $time = (int) $string;
        if ($time > 0)
            return $time;
        else
            return time();
    }
}

if (!function_exists('date_format_likeuser_rus')) {
    /**
     * Рус: Выводит время в указанном формате. Во многом аналогичная php функции date, за исключением того, что вывод русифицирован и добавлены новые обозначения в форматной строке.
     * Принцип: преимущественно названия выводятся с большой буквы. Если нужны все маленькие (например, "3 января"), то нужно использовать функцию toLowerCase()
     * Особенности форматной строки (чем отличается от пхп-функции date):
     * M - три первые буквы месяца
     * F - полное название месяца в инфинитиве
     * f - полное название месяца в родительном падеже
     * a - относительная дата (сегодня, вчера)
     * A - относительная дата (Сегодня, Вчера)
     * D - кратко дни недели (Пн, Вт, ...)
     * l - полно дни недели (Понедельник, Вторник, ...)
     * Анг: php function date-analog for russian language
     * @param $string - дата и время в строковом формате, либо в формате UNIX_TIMESTAMP (из MySQL)
     * @param string $format - формат, в котором выводится дата
     * @param string $default_format - формат, в котором выводится дата, если предыдущий формат вывести не удалось (если там используется a или A)
     * @return string - дата по формату
     */
    function date_format_likeuser_rus($string, $format = 'd M Y', $default_format = 'd M Y') {
        if ($string == '') return '';
        $timestamp = smarty_make_timestamp($string);

        $rus_words = array(
            'M' => array('code'   => 'n',
            'values' => array('', 'Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'),
            ),
            'F' => array('code'   => 'n',
                'values' => array('', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'),
            ),
            'f' => array('code'   => 'n',
                'values' => array('', 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'),
            ),
            'a' => array('code'   => '',
                'values' => array('cегодня', 'вчера'),
            ),
            'A' => array('code'   => '',
                'values' => array('Сегодня', 'Вчера'),
            ),
            'D' => array('code'   => 'w',
                'values' => array('Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'),
            ),
            'l' => array('code'   => 'w',
                'values' => array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'),
            ),
        );

        $result = "";
        for ($i = 0; $i < strlen($format); $i++) {
            $symbol = $format{$i};
            if (array_key_exists($symbol, $rus_words)) {
                if (!empty($rus_words[$symbol]['code'])) {
                    $id = date($rus_words[$symbol]['code'], $timestamp);
                    if (is_numeric($id) && array_key_exists($id, $rus_words[$symbol]['values'])) {
                        $result .= $rus_words[$symbol]['values'][$id];
                    }
                } else {
                    $id = 2;
                    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                    if ($timestamp >= $today) {
                        $id = 0;
                    } elseif ($timestamp >= $today - 86400) {
                        $id = 1;
                    }

                    if (array_key_exists($id, $rus_words[$symbol]['values'])) {
                        $result .= $rus_words[$symbol]['values'][$id];
                    } else {
                        $format = str_replace($symbol, $default_format, $format);
                        $i--;
                    }
                }
            } else {
                $result .= date($symbol, $timestamp);
            }
        }

        return $result;
    }
}

if (!function_exists('cutLongWords')) {
    /**
     * Рус: обрезает длинные слова, подставляя в конце "..."
     * Анг: cut long words
     * @param $text - текст, который нужно уберечь от длинных слов
     * @param int $max_long - разрешённая длина слова
     * @param string $replace - шаблон замены обрезанной части. Тут ?0 означает всё слово целиком, а ?1 - необрезанная часть (начинается с ?, так как движок imageCMS ругается, если использовать знак $ в шаблоне, даже если в строке).
     * @return mixed|string
     */
    function cutLongWords($text, $max_long = 10, $replace = '?1...') {
        if (!is_string($text)) {
            $text = (string)$text;
        }
        $max_long = (int)$max_long;
        if ($max_long <= 0) return $text;
        if (!is_string($replace)) {
            $replace = '?1...';
        }
        $replace = preg_replace('/\?(\d+)/', '\$$1', $replace);
        return preg_replace('/([^\s]{' . $max_long . '})[^\s]+/', $replace, $text);
    }
}