<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
            <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/lte_ie_8.css" /><![endif]-->
            <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        <!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if gte IE 9]>
            <style type="text/css">
              .gradient {
                 filter: none;
              }
            </style>
        <![endif]-->
        <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
        <link rel="SHORTCUT ICON" href="favicon.ico" />
    </head>
    <body>
        <div class="main-body">
            <div class="fon-header">
                <header>
                    <div class="menu-header">
                        <div class="container">
                            {load_menu('top_menu')}

                            <div class="f_r">
                                {include_tpl('auth_data')}

                            </div>
                        </div>
                    </div>
                    <div class="content-header">
                        <div class="container">
                            {if $CI->core->core_data['data_type'] == 'main'}
                                <span class="logo f_l">
                                    <img src="{$THEME}images/logo.png"/>
                                </span>
                            {else:}
                                <a href="{site_url()}" class="logo f_l">
                                    <img src="{$THEME}images/logo.png"/>
                                </a>
                            {/if}
                            <div class="content-cleaner-search f_r">
                                <div class="f_r">
                                    <div class="d_i-b phones-header">

                                        <span>8 800 <span class="f-w_b">772-22-22</span></span>
                                        <p class="phones-info">бесплатно по Украине</p>
                                    </div>
                                    <div class="d_i-b phones-header phones-header-last">

                                        <span>097 <span class="f-w_b">772-22-22</span></span>
                                        <p class="phones-info">Мобильный телефон</p>
                                    </div><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                {load_menu('main_menu')}
                {if $CI->core->core_data['data_type'] == 'main'}
                    <!-- Start. Show banner on home page. -->
                    {include_tpl('homebanner')}
                    <!-- End. Show banner on home page. -->
                {/if}
            </div>
            {$content}
            <div class="h-footer"></div>
        </div>
        <footer>
            <div class="content-footer">
                <div class="container">
                    <div class="copy-right f_l">
                        <p>&copy; 2012 Image Robotics - лидер в производстве роботов</p>
                        <p>Powered by ImageCms</p>
                    </div>
                    <div class="box-1 f_r">
                        <ul class="d_i-b t-d_u ">
                            {load_menu('bottom_menu')}

                        </ul>
                    </div>    
                </div>
            </div>
        </footer>



        
        <script type="text/javascript" src="{$THEME}js/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/filter.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.pluginssiteimage.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.cycle.js"></script>
        {/*}<script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>{ */}
        {//include_tpl('login_popup')}
        {//include_tpl('fogot_pass_popup')}

    </body>
</html>