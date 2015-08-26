<?php

if (!function_exists('check_admin_redirect')) {

    function create_language_select($languages, $locale, $url, $pjax = FALSE) {
        if (count($languages) > 1) {
            $html = "<div class='dropdown d-i_b'>";
            foreach ($languages as $language) {
                if ($language['identif'] == $locale) {
                    $html .= "<a class='btn dropdown-toggle btn-small' data-toggle='dropdown' data-lan='" . $language['identif'] . "' href='#'>";
                    $html .= $language['lang_name'];
                    $locale = $language['identif'];
                    $html .= "<input type='hidden' name='Locale' value='" . $language['identif'] . "'/>";
                    $html .= "<span class='caret'></span>";
                    $html .= "</a>";
                }
            }
            $html .= "<ul class='dropdown-menu pull-right'>";
            foreach ($languages as $language) {
                if ($language['identif'] != $locale) {
                    $html .= "<li>";
                    $html .= "<a href='" . $url . "/" . $language['identif'] . "' class='" . ($pjax ? 'pjax' : '') . "'>" . $language['lang_name'] . "</a>";
                    $html .= "</li>";
                }
            }
            if (count($languages) > 1) {
                $html .= "</ul></div>";
            }
        }
        return $html ? : '';
    }

    function create_admin_language_select() {

        $CI = & get_instance();
        $languages = $CI->db->select('lang_name, locale')->order_by('lang_name')->get('languages')->result_array();
        $current_locale = $CI->config->item('language');
        $current_language = lang('English', 'admin');

        if (count($languages)) {
            $html = '';

            $english_exists = FALSE;
            foreach ($languages as $language) {
                $html .= '<li><a href="/admin/settings/switch_admin_lang/' . $language['locale'] . '">' . $language['lang_name'] . '</a></li>';
                if ($current_locale == $language['locale']) {
                    $current_language = $language['lang_name'];
                }

                if (!$english_exists && strstr($language['locale'], 'en')) {
                    $english_exists = TRUE;
                }
            }

            if (!$english_exists) {
                $html = '<li><a href="/admin/settings/switch_admin_lang/en_US">' . lang('English', 'admin') . '</a></li>' . $html;
            }

            $html = '<div class="dropup d-i_b"><button type="button" class="btn dropdown-toggle" data-toggle="dropdown">' .
                    $current_language . '<span class="caret"></span></button>
            <ul class="dropdown-menu">' .
                    $html .
                    '</ul>
            </div>';
        }
        return $html ? : '';
    }

    function build_cats_tree($cats, $selected_cats = []) {
        if (is_array($cats)) {
            foreach ($cats as $cat) {
                echo "<option";
                if (is_array($selected_cats)) {
                    foreach ($selected_cats as $k) {
                        if ($k == $cat['id']) {
                            echo " selected = 'selected' ";
                        }
                    }
                }
                echo " value='" . $cat['id'] . "'>";
                for ($i = 0; $i < $cat['level']; $i++) {
                    echo '-';
                }
                echo $cat['name'] . "</option>";
                if ($cat['subtree']) {
                    build_cats_tree($cat['subtree'], $selected_cats);
                }
            }
        }
    }

    function build_cats_tree_ul_li($cats, $item_id = NULL) {
        if (is_array($cats)) {
            foreach ($cats as $cat) {
                echo "<li>";
                if ($cat['id'] == $item_id) {
                    echo "<b><a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $cat['name'] . "</a></b>";
                } else {
                    echo "<a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $cat['name'] . "</a>";
                }
                if ($cat['subtree']) {
                    build_cats_tree_ul_li($cat['subtree'], $item_id);
                }
            }
        }
    }

    function getCMSNumber() {
        return IMAGECMS_NUMBER;
    }

}

if (!function_exists('get_templates')) {

    function get_templates() {
        $new_arr_shop = [];
        if ($handle = opendir(TEMPLATES_PATH)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator' && $file != 'modules' && !stristr($file, '_mobile')) {
                    if (!is_file(TEMPLATES_PATH . $file)) {
                        if (SHOP_INSTALLED && is_dir(TEMPLATES_PATH . $file . '/shop/')) {
                            $new_arr_shop[$file] = $file;
                        }
                        $new_arr[$file] = $file;
                    }
                }
            }
            closedir($handle);
        } else {
            return FALSE;
        }

        if (SHOP_INSTALLED) {
            array_multisort($new_arr_shop);
            return $new_arr_shop;
        } else {
            array_multisort($new_arr);
            return $new_arr;
        }
    }

}