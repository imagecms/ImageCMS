{/*
/**
* @main.tpl - template for displaying shop main page
* Variables
*   $site_title: variable for insert site title
*   $canonical: variable for insert canonical
*   $site_description: variable for insert site description
*   $THEME: variable for template path
*   $site_keywords : variable for insert site keywords
*   $content : variable for insert content of page
*/}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <meta name = "format-detection" content = "telephone=no" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="{$THEME}{$colorScheme}/style.css" media="all" />

        <link rel="shortcut icon" href="{$THEME}images/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="{$THEME}images/favicon.ico" type="image/x-icon" />

        <!--[if lte IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/lte_ie_8.css" /><![endif]-->
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" />
            <script src="{$THEME}js/localStorageJSON.js"></script>
        <![endif]-->

        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
    </head>
    <body class="is{echo $agent[0]} not-js">        
        <div class="main-body">
            <div class="fon-header">
                <header>
                    {include_tpl('header')}
                </header>
                {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
            </div>
            <div class="content">
                {$content}
            </div>
            <div class="h-footer"></div>
        </div>
        <footer>
            {include_tpl('footer')}
        </footer>


        {include_tpl('user_toolbar')}

        {include_tpl('config.js')}

        <script type="text/javascript" src="{$THEME}js/underscore-min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.imagecms.shop.js?{echo rand()}"></script>

        <script type="text/javascript" src="{$THEME}js/raphael-min.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js?{echo rand()}"></script>
        {include_shop_tpl('js_templates')}
    </body>
</html>