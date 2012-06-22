<?php 

if (!function_exists('check_admin_redirect'))
{
    /**
     * Load page in admin panel.
     * Sample request to admin panel to make redirect: /admin?r=admin/&b=shopAdminPage
     * where $r - is route and $b is div id to update.
     */
    function check_admin_redirect()
    {
        echo '<script>';
        if (isset($_GET['r']))
        {
            $act = $_GET['r'];
            
            if (!$_GET['b'])
                $div = 'page';
            else
                $div = $_GET['b'];
            
            echo "setTimeout(function() { ajax_div('$div', '$act') }, 1250)";
        }
        echo '</script>';
    }
}
