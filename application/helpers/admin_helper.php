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

    function getCMSNumber() {
        return IMAGECMS_NUMBER;
    }

}


