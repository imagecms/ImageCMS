<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

if (!function_exists('ru_date')) {

    function ru_date() {
        $translation = array(
            "am" => "дп",
            "pm" => "пп",
            "AM" => "ДП",
            "PM" => "ПП",
            "Monday" => "Понедельник",
            "Mon" => "Пн",
            "Tuesday" => "Вторник",
            "Tue" => "Вт",
            "Wednesday" => "Среда",
            "Wed" => "Ср",
            "Thursday" => "Четверг",
            "Thu" => "Чт",
            "Friday" => "Пятница",
            "Fri" => "Пт",
            "Saturday" => "Суббота",
            "Sat" => "Сб",
            "Sunday" => "Воскресенье",
            "Sun" => "Нд",
            "January" => "Января",
            "Jan" => "Січ",
            "February" => "Февраля",
            "Feb" => "Лют",
            "March" => "Март‎а",
            "Mar" => "Бер",
            "April" => "Апреля",
            "Apr" => "Квіт",
            "May" => "Мая",
            //"May" => "Трав",
            "June" => "Июня",
            "Jun" => "Чер",
            "July" => "Июля",
            "Jul" => "Лип",
            "August" => "Августа",
            "Aug" => "Сер",
            "September" => "Сентября",
            "Sep" => "Вер",
            "October" => "Октября",
            "Oct" => "Жов",
            "November" => "Ноября",
            "Nov" => "Лис",
            "December" => "Декабря",
            "Dec" => "Дек",
            "st" => "ое",
            "nd" => "ое",
            "rd" => "е",
            "th" => "ое",
        );

        if (func_num_args() > 1) {
            $timestamp = func_get_arg(1);
            return strtr(date(func_get_arg(0), $timestamp), $translation);
        } else {
            return strtr(date(func_get_arg(0)), $translation);
        }
    }

}