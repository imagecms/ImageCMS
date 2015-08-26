<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Include html_helper from system for adding functionality
 */
require_once __DIR__ . '/../../system/helpers/html_helper.php';

if (!function_exists('href_nofollow')) {

    function href_nofollow($content) {
        return preg_replace_callback('/<(a\s[^>]+)>/isU', 'seo_nofollow_replace', $content);
    }

}

if (!function_exists('seo_nofollow_replace')) {

    function seo_nofollow_replace($match) {
        $CI = & get_instance();

        list($original, $tag) = $match;

        if (strpos($tag, "nofollow")) {
            return $original; // уже есть
        } elseif (strpos($tag, $CI->input->server('SERVER_NAME')) || strpos($tag, 'href="/') || strpos($tag, "href='/")) {
            return $original; // исключения
        } else {
            return "<$tag rel=\"nofollow\">";
        }
    }

}


if (!function_exists('create_tag')) {

    /**
     * Creates a html tag.
     * @param string $tagName
     * @param string $innerText
     * @param array $attributes
     * @return string
     */
    function create_tag($tagName, $innerText, array $attributes = array()) {
        $attributesString = ' ';
        foreach ($attributes as $name => $value) {
            $attributesString .= "{$name}='{$value}' ";
        }
        $attributesString = rtrim($attributesString, ' ');
        return "<{$tagName}{$attributesString}>{$innerText}</{$tagName}>";
    }

}

if (!function_exists('form_property_select')) {

    function form_property_select($name, $data, $selected, $multiple) {
        $selected = !is_array($selected) ? array($selected) : $selected;
        $multiple = $multiple === 'multiple' ? 'multiple="multiple"' : '';
        $result = "<select name='$name' $multiple>";

        if (!$multiple) {
            $result .= "<option value='0' >- " . lang('Unspecified') . " -</option>";
        }

        $data = array_map('htmlspecialchars_decode', $data);
        $selected = array_map('htmlspecialchars_decode', $selected);
        foreach ($data as $option) {

            $selectedAttr = in_array($option, $selected) ? 'selected="selected"' : '';
            $option_value = htmlspecialchars($option, ENT_QUOTES, ini_get("default_charset"), false);
            //            $option_value = $option;
            $option = html_entity_decode($option);
            if (strpos($option_value, '"') !== FALSE) {
                $result .= "<option value='$option_value' $selectedAttr>$option</option>";
            } else {
                $result .= '<option value="' . $option_value . '"' . $selectedAttr . '>' . $option . '</option>';
            }
        }

        $result .= "</select>";

        return $result;
    }

}