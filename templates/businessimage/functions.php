<?php

if (!function_exists('current_language')) {

    function current_language() {

        /* Get current language locale */
       	$lang_id = CI::$APP->config->config['cur_lang'];
        $lang_data = CI::$APP->db->where(array('id' => $lang_id))->get('languages');
        $lang_data = $lang_data ? $lang_data->row_array() : array();

        return strstr($lang_data['locale'], '_', true);
    }

}

if (!function_exists('locale_date')) {

    function locale_date($format, $timestamp = 0, $nominative_month = false) {

        /* Get current language locale */
        $lang_id = CI::$APP->config->config['cur_lang'];
        $lang_data = CI::$APP->db->where(array('id' => $lang_id))->get('languages');
        $lang_data = $lang_data ? $lang_data->row_array() : array();
        $lang_locale = $lang_data['locale'];

        if(!$timestamp) {
            $timestamp = time();
        }
        elseif(!preg_match("/^[0-9]+$/", $timestamp))
        $timestamp = strtotime($timestamp);

        switch ($lang_locale) {
            case 'ru_RU':
                $F = $nominative_month ? array(1 => "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь") : array(1 => "Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
                $M = array(1 => "Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек");
                $l = array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота");
                $D = array("Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб");
          break;

            case 'uk_UA':
                $F = $nominative_month ? array(1 => "Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень") : array(1 => "Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересеня", "Жовтня", "Листопада", "Грудня");
                $M = array(1 => "Січ", "Лют", "Бер", "Кві", "Тра", "Чер", "Лип", "Сер", "Вер", "Жов", "Лис", "Гру");
                $l = array("Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П&#8217;ятниця", "Субота");
                $D = array("Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб");
          break;

            default:
          return date($format, $timestamp);
        }

        $format = str_replace("F", $F[date("n", $timestamp)], $format);
        $format = str_replace("M", $M[date("n", $timestamp)], $format);
        $format = str_replace("l", $l[date("w", $timestamp)], $format);
        $format = str_replace("D", $D[date("w", $timestamp)], $format);

        return date($format, $timestamp);
    }

}

?>