<?php

if (!function_exists('check_admin_redirect')) {

    /**
     * Load page in admin panel.
     * Sample request to admin panel to make redirect: /admin?r=admin/&b=shopAdminPage
     * where $r - is route and $b is div id to update.
     */
    function check_admin_redirect() {
        echo '<script>';
        if (isset($_GET['r'])) {
            $act = $_GET['r'];

            if (!$_GET['b'])
                $div = 'page';
            else
                $div = $_GET['b'];

            echo "setTimeout(function() { ajax_div('$div', '$act') }, 1250)";
        }
        echo '</script>';
    }

    function get_lang_admin_folders() {
        $new_arr = array();

        if ($handle = opendir(APPPATH . 'language/admin/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator') {

                    if (!is_file(APPPATH . 'language/admin/' . $file)) {
                        $new_arr[$file] = $file;
                    }
                }
            }
            closedir($handle);
        } else {
            return FALSE;
        }
        return $new_arr;
    }

    function create_language_select($languages, $locale, $url) {
        if (count($languages) > 1) {
            $html =
                    "<div class='dropdown d-i_b'>";
            foreach ($languages as $language) {
                if ($language['identif'] == $locale) {
                    $html .= "<a class='btn dropdown-toggle btn-small' data-toggle='dropdown' data-lan='" . $language['identif'] . " href='#'>";
                    $html .= $language['lang_name'];
                    $locale = $language['identif'];
                    $html .= "<input type='hidden' name='Locale' value='" . $language['identif'] . "'/>";
                    $html .= "<span class='caret'></span>";
                    $html .= "</a>";
                }
            }
            $html .= "<ul class='dropdown-menu'>";
            foreach ($languages as $language) {
                if ($language['identif'] != $locale) {
                    $html .= "<li>";
                    $html .= "<a href='" . $url . "/" . $language['identif'] . "' class='pjax'>" . $language['lang_name'] . "</a>";
                    $html .= "</li>";
                }
            }
            if (count($languages) > 1)
                $html .= "</ul></div>";
        }
        return $html;
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
        return $html;
    }

    function build_cats_tree($cats, $selected_cats = array()) {
        if (is_array($cats))
            foreach ($cats as $cat) {
                echo "<option";
                if (is_array($selected_cats))
                    foreach ($selected_cats as $k) {
                        if ($k == $cat['id'])
                            echo " selected = 'selected' ";
                    }
                echo " value='" . $cat['id'] . "'>";
                for ($i = 0; $i < $cat['level']; $i++) {
                    echo '-';
                }
                echo $cat['name'] . "</option>";
                if ($cat['subtree'])
                    build_cats_tree($cat['subtree'], $selected_cats);
            }
    }

    function build_cats_tree_ul_li($cats, $item_id = NULL) {
        if (is_array($cats))
            foreach ($cats as $cat) {
                echo "<li>";
                if ($cat['id'] == $item_id) {
                    echo "<b><a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $cat['name'] . "</a></b>";
                } else {
                    echo "<a class='category_item' data-title='" . $cat['name'] . "' data-id='" . $cat['id'] . "' href='#'>" . $cat['name'] . "</a>";
                }
                if ($cat['subtree']) {
                    echo "<ul>";
                    build_cats_tree_ul_li($cat['subtree'], $item_id);
                    echo "</ul>";
                }
            }
    }

    function getCMSNumber() {
        return IMAGECMS_NUMBER;
    }

}

    