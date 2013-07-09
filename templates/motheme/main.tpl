<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {$page_type = $CI->core->core_data['data_type'];}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />

        <link rel="stylesheet" type="text/css" media="screen" href="{$THEME}css/style.css">
            <link rel="stylesheet" type="text/css" media="screen" href="{$THEME}css/form.css">
                <link rel='stylesheet' id='camera-css'  href='{$THEME}css/camera.css' type='text/css' media='all'>
                    <script type="text/javascript" src="{$THEME}js/jquery.js"></script>
                    <script src="{$THEME}js/script.js"></script>
                    <script type="text/javascript" src="{$THEME}js/superfish.js"></script>
                    <script type="text/javascript" src="{$THEME}js/jquery.responsivemenu.js"></script>
                    <script type="text/javascript" src="{$THEME}js/jquery.mobilemenu.js"></script>
                    <script type="text/javascript" src="{$THEME}js/jquery.easing.1.3.js"></script>
                    <script src="{$THEME}js/jquery.ui.totop.js"></script>
                    <script src="{$THEME}js/camera.js"></script>
                    <script src="{$THEME}js/forms.js"></script>
                    <!--[if (gt IE 9)|!(IE)]><!-->
                    <script type="text/javascript" src="js/jquery.mobile.customized.min.js"></script>
                    <!--<![endif]-->
                    {literal}
                        <script>
                            $(document).ready(function() {
                                $().UItoTop({easingType: 'easeOutQuart'});
                                jQuery('#camera_wrap').camera({
                                    loader: false,
                                    pagination: true,
                                    thumbnails: false,
                                    height: '52.52631578947368%',
                                    caption: true,
                                    navigation: false,
                                    fx: 'simpleFade'
                                });
                            });

                        </script>
                        <!--[if lt IE 8]>
                           <div style=' clear: both; text-align:center; position: relative;'>
                             <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
                               <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
                            </a>
                          </div>
                        <![endif]-->
                        <!--[if lt IE 9]>
                                <script src="js/html5.js"></script>
                                <link rel="stylesheet" href="css/ie.css">
                                <link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
                            <link href='http://fonts.googleapis.com/css?family=Lato:400italic' rel='stylesheet' type='text/css'>
                            <link href='http://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
                        <![endif]-->
                    {/literal}

                    <link rel="icon" href="{$THEME}/images/favicon.png" type="image/x-icon" />

                    </head>
                    <body class="page1">
                        <!-- Header -->
                        <header>
                            <div class="header_top">
                                <div class="container_16">
                                    <div class="grid_16">
                                        <h1><a href="{site_url('')}"><img src="{$THEME}images/logo.png" alt="Наша компания бесспорно лучшая в галактике!"></a></h1>
                                        <div class="contacts">
                                            {if $is_logged_in}
                                                {lang('lang_logged_in_as')} <b>{$username}</b>
                                                <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a>
                                            {else:}
                                                <a href="{site_url('auth/login')}">Вход</a>
                                                <a href="{site_url('auth/register')}">Регистрация</a>
                                            {/if}
                                            <div class="clear"></div>
                                            <div class="phone1"><span>Phone:</span> 1-800-123-2134</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BEGIN NAVIGATION -->
                            <div class="menu_border">
                                <div class="menu_bg">
                                    <div class="container_16">
                                        <div class="grid_16 ">
                                            <nav class="">
                                                {load_menu('main_menu')}
                                            </nav>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END NAVIGATION -->

                            <!-- BEGIN SLIDESHOW -->
                            {if $page_type == 'main'}
                                <div class="slider_bg">
                                    <div class="container_16">
                                        <div class="grid_16">
                                            <div class="slider_wrapper">
                                                <div class="" id="camera_wrap">
                                                    <div data-src="{$THEME}images/slide1.jpg"></div>
                                                    <div data-src="{$THEME}images/slide2.jpg"></div>
                                                    <div data-src="{$THEME}images/slide3.jpg"></div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                            <!-- END SLIDESHOW -->

                        </header>
                        <!-- MAIN CONTENT-->
                        <div class="page1_bg">
                            <div class="middle">
                                <div class="container_16">
                                    <div class="wrapper">
                                        <!-- MAIN Page-->
                                        {if $page_type == 'main'}
                                            <div class="grid_10">
                                                {$content}
                                            </div>
                                            <div class="grid_5 prefix_1">
                                                <h2>Новости компании</h2>
                                                {widget('news')}
                                            </div>
                                            <!-- End MAIN Page-->
                                            <!-- Products Page-->
                                        {elseif $category.id == 55}
                                            <div class="grid_11">
                                                {$content}
                                            </div>
                                            <div class="grid_5">
                                                <h2>Продукция</h2>
                                                {widget('product_all')}
                                            </div>
                                            <!-- End Products Page-->
                                            <!-- Blog Page-->
                                        {elseif $category.id == 59 || $category.parent_id == 59}
                                            <div class="grid_11">
                                                {$content}
                                            </div>
                                            <div class="grid_5">
                                                <h2>Категории</h2>
                                                <ul class="list_3">
                                                    {$sub_cats = get_sub_categories('59')}
                                                    {$count = 0}
                                                    {foreach $sub_cats as $sub_cat}
                                                        <li>
                                                            <a href="{site_url('bloh/'. $sub_cat.url)}"
                                                               {if $sub_cat.id == $category.id}
                                                                   class="active"
                                                               {/if}>
                                                                {$sub_cat.name}
                                                            </a>
                                                        </li>
                                                        {$count++}
                                                    {/foreach}
                                                </ul>
                                            </div>
                                            <!-- End Blog Page-->
                                        {else:}
                                            <div class="container_16">
                                                {$content}
                                            </div>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <!-- END MAIN CONTENT -->

                            <div class="page1_bot">
                                <!-- PRODUCT WIDGET-->
                                <div class="top">
                                    <div class="container_16">
                                        {widget('product_main')}
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <!-- END PRODUCT WIDGET -->

                                <div class="bot">
                                    <div>
                                        <div class="container_16">
                                            <div class="grid_4">
                                                <h4>Для клиентов</h4>
                                                <p>Мы заботимся о каждом нашем клиенте, вы получаете бесплатную доставку, возврат и 100% гарантию на все услуги и товары.</p>
                                            </div>
                                            <div class="grid_4">
                                                <h4>Дополнительно</h4>
                                                {load_menu('bottom_menu')}
                                            </div>
                                            <div class="grid_4">
                                                <h4>Ищите нас также</h4>
                                                <div class="social">
                                                    <div>

                                                        <a href="/rss"><img src="{$THEME}images/rss_icon.png" alt=""> Rss feed</a>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div>

                                                        <a href="http://www.facebook.com/pages/Image-CMS/231137056897516"><img src="{$THEME}images/fb_icon.png" alt=""> Facebook</a>
                                                        <div class="clear"></div>
                                                        <div>
                                                        </div>

                                                        <a href="https://twitter.com/#!/imagecms"> <img src="{$THEME}images/twitter_icon.png" alt="">Twitter</a>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid_4">
                                                <h4>Контакты</h4>
                                                <div class="phone1"><span>+1 800 559 6580</span>
                                                    <a href="#">mail@demolink.org</a>
                                                </div>
                                                <address>8901 Marmora Road Glasgow,<br> DO4 89GR.</address>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Footer-->
                        <footer>
                            <div class="container_16">
                                <div class="wrapper">
                                    <div class="grid_16 copy"><a href="{site_url('')}"><img src="{$THEME}images/footer_logo.png" alt=""></a>  <span>&copy;2013 Powered by <a href="http://www.imagecms.net">ImageCms</a></span>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- Footer end-->
                    </body>
                    </html>