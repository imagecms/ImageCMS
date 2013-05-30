{#
/**
* @main.tpl - template for displaying shop main page
* Variables
*   $site_title: variable for insert site title
*   $canonical: variable for insert canonical
*   $site_description: variable for insert site description
*   $THEME: variable for template path
*   $site_keywords : variable for insert site keywords
*   $content : variable for insert content of page
*/
#}

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png" />
        <!--[if lte IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/lte_ie_8.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/underscore-min.js"></script>
        <script type="text/javascript" src="{$THEME}js/raphael-min.js"></script>
    </head>
    <body>
        <div class="main-body">
            <div class="fon-header">
                <header>
                    <!--                    Include header template-->
                    {include_tpl('header')}
                </header>
                <!--                Render category menu-->
                {\Category\RenderMenu::create()->load('category_menu')}
            </div>
            <div class="content">
                {$content}
            </div>
            <div class="h-footer"></div>
        </div>
        <footer>
            <!--            Include footer template-->
            {include_tpl('footer')}
        </footer>

        <!-- Start. Config.js -->
        {include_tpl('config.js')}
        <!-- End. Config.js -->


        <script type="text/javascript" src="{$THEME}js/jquery.imagecms.shop.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.cycle.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <!-- Dev. scripts -->
        <script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>

        <!-- Start. Including template file for displaying drop-down login form is user is not logged in -->
        {if !$CI->dx_auth->is_logged_in()}{include_tpl('login_popup')}{/if}
        <!-- End. Including template file for displaying drop-down login form is user is not logged in -->

        <!-- Start. Callback form -->
        {include_shop_tpl('callback')}
        <!-- End. Callback form -->

        <!-- Start. Block report on appearance -->
        {include_shop_tpl('report_appearance')}
        <!-- End. Block report on appearance -->

        <!-- Start. Include js-template for popup cart and order-products-->
        {include_shop_tpl('js_templates')}
        <!-- End. Include js-template for popup cart and order-products-->

        <!-- Start. Include template for autocomplete-->
        {include_shop_tpl('search_autocomplete')}
        <!-- End. Include template for autocomplete-->
    </body>
</html>