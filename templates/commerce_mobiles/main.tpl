<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
    "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name = "format-detection" content = "telephone=no" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css"/>
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/lt_ie_8.css" /><![endif]-->
        <!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="css/lt_ie_7.css" /><![endif]-->
        <!--[if IE 6]>
            <script src="js/DD_belatedPNG.js"></script>
            <script>
                DD_belatedPNG.fix('.h_f, .head_foot, .frame_search .frame_input input, .main_f_i_f-r, .logo img, .icon, .but_buy, .but_buy .b_buy_in, .but_buy a, .subm_filter, .subm_filter input, .frame_search .frame_input span, .search_button');
            </script>
        <![endif]-->
        <script type="text/javascript" src="{$THEME}js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.main.js"></script>
    </head>
    <body>
        <div class="mainBody">
            <div id="inder"></div>
            <div class="header">
                <ul>
                    <li>
                        {include_tpl('shop/auth_data')}
                    </li>
                    <li>
                        <a href="{mobile_url('search')}" tabindex="1">
                            <span class="icon search_icon"></span><br/>
                            {lang('Поиск','commerce_mobiles')}
                        </a>
                    </li>
                    <li>
                        {include_tpl('shop/cart_data')}
                    </li>
                </ul>
                <a href="{site_url()}" class="f_l logo">
                    <span class="helper"></span>
                    <img src="{$THEME}images/logo.png" class="v-a_m"/>
                </a>
            </div>
            <span class="head_foot"></span>
            {$content}
            <div class="hFooter"></div>
        </div>
        <div class="footer">
            {load_menu('footer_menu_mobile')}
            <div class="p_r">
                <div class="versions">
                    <div class="h_f"></div>
                    <span class="mobile frame_version">
                        <span class="icon phone"></span>
                        <span class="title">{lang('Мобильная версия','commerce_mobiles')}</span>
                    </span>
                    <a href="http://{echo str_replace('http://', '', $settings[MobileVersionSite])}" class="desctop frame_version">
                        <span class="frame_desctop">
                            <span class="icon comp"></span>
                            <span class="title">{lang('Полная версия','commerce_mobiles')}</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="copy">© ImageCMS {date('Y')}</div>
        </div>
    </body>
</html>