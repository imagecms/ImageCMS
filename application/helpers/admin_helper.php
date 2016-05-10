<?php

if (!function_exists('check_admin_redirect')) {

    /**
     * @param array $languages
     * @param string $locale
     * @param string $url
     * @param bool|FALSE $pjax
     * @return string
     */
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
                    $html .= '</a>';
                }
            }
            $html .= "<ul class='dropdown-menu pull-right'>";
            foreach ($languages as $language) {
                if ($language['identif'] != $locale) {
                    $html .= '<li>';
                    $html .= "<a href='" . $url . '/' . $language['identif'] . "' class='" . ($pjax ? 'pjax' : '') . "'>" . $language['lang_name'] . '</a>';
                    $html .= '</li>';
                }
            }
            if (count($languages) > 1) {
                $html .= '</ul></div>';
            }
        }
        return $html ?: '';
    }

    /**
     * @return string
     */
    function create_admin_language_select() {

        $CI = &get_instance();
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
        return $html ?: '';
    }

    /**
     * @param array $cats
     * @param array $selected_cats
     */
    function build_cats_tree($cats, $selected_cats = []) {

        if (is_array($cats)) {
            foreach ($cats as $cat) {
                echo '<option';
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
                echo $cat['name'] . '</option>';
                if ($cat['subtree']) {
                    build_cats_tree($cat['subtree'], $selected_cats);
                }
            }
        }
    }

    /**
     * @param array $cats
     * @param null|int $item_id
     * @param int $level
     */
    function build_cats_tree_ul_li($cats, $item_id = NULL, $level = 0) {
        if (is_array($cats)) {

            $subst = '';
            if ($level !== 0) {
                $indents = 3 * ($level - 1);
                $subst = str_repeat('&nbsp;', $indents) . '<span class="simple_tree">↳</span>';
            }

            foreach ($cats as $cat) {
                echo '<li>';
                if ($cat['id'] == $item_id) {
                    echo "<b><a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $subst . $cat['name'] . '</a></b>';
                } else {

                    echo "<a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $subst . $cat['name'] . '</a>';
                }
                if ($cat['subtree']) {
                    build_cats_tree_ul_li($cat['subtree'], $item_id, ++$level);
                }
            }
        }
    }

    /**
     * @return string
     */
    function getCMSNumber() {

        return IMAGECMS_NUMBER;
    }

}

if (!function_exists('get_templates')) {

    /**
     * @return array|bool
     */
    function get_templates() {

        $new_arr_shop = [];
        if ($handle = opendir(TEMPLATES_PATH)) {
            while (false !== ($file = readdir($handle))) {
                if (false === strpos($file, '.') && $file != 'administrator' && $file != 'modules' && !stristr($file, '_mobile')) {
                    if (!is_file(TEMPLATES_PATH . $file)) {
                        if (is_dir(TEMPLATES_PATH . $file . '/shop/')) {
                            $new_arr_shop[$file] = $file;
                        } else {
                            $new_arr[$file] = $file;
                        }
                    }
                }
            }
            closedir($handle);

            $templates = SHOP_INSTALLED ? $new_arr_shop : $new_arr;
            array_multisort($templates);

            return $templates;
        }

        return false;
    }

}