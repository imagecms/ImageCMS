<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="Bluefish 2.0.2" />
    {if $CI->uri->segment(1) == 'sitemap'}<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />{/if}
    <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/style.css" />
    <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/libraries/fancybox/css/jquery.fancybox-1.3.4.css" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie6.css" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie7.css" /><![endif]-->
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie8.css" /><![endif]-->

    <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery-1.6.4.min.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery-ui-1.8.15.custom.min.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.ui-slider.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.validate.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/libraries/fancybox/jquery.fancybox-1.3.4.js"></script>


    <!--  
            <script type="text/javascript" src="{$SHOP_THEME}js/libraries/slide_list.js"></script>
            <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.main.js"></script>-->


    <!-- Loaders -->
    <script type="text/javascript" src="{$SHOP_THEME}js/loaders/main_loader.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/loaders/product_loader.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/loaders/cart_loader.js"></script>
    <script type="text/javascript" src="{$SHOP_THEME}js/loaders/category_loader.js"></script>

    <script type="text/javascript" src="{$SHOP_THEME}js/loaders/jquery.datePicker-2.1.2.js"></script>
    <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/loaders/jquery-ui-1.7.3.custom.css" />

{if $CI->uri->segment(1) == 'auth' && $CI->uri->segment(2) == '' || $CI->uri->segment(1) == 'auth' && $CI->uri->segment(2) == 'register'}<meta name="robots" content="noindex, nofollow" />{/if}

<link rel="icon" href="{$SHOP_THEME}images/favicon.png" type="image/x-icon" />

{literal}
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-6175648-1']);
      _gaq.push (['_addOrganic', 'meta.ua', 'q']);
      _gaq.push (['_addOrganic', 'search.bigmir.net', 'z']);
      _gaq.push (['_addOrganic', 'search.i.ua', 'q']);
      _gaq.push (['_addOrganic', 'mail.ru', 'q']);
      _gaq.push (['_addOrganic', 'go.mail.ru', 'q']);
      _gaq.push (['_addOrganic', 'google.com.ua', 'q']);
      _gaq.push (['_addOrganic', 'rambler.ru', 'words']);
      _gaq.push (['_addOrganic', 'nova.rambler.ru', 'query']);
      _gaq.push (['_addOrganic', 'nova.rambler.ru', 'words']);
      _gaq.push (['_addOrganic', 'index.online.ua', 'q']);
      _gaq.push (['_addOrganic', 'web20.a.ua', 'query']);
      _gaq.push (['_addOrganic', 'search.ukr.net', 'search_query']);
      _gaq.push (['_addOrganic', 'search.com.ua', 'q']);
      _gaq.push (['_addOrganic', 'search.ua', 'q']);
      _gaq.push(['_trackPageview']);
      _gaq.push(['_trackPageLoadTime']); 

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
    </script>
{/literal}

</head>
<body>

    <div class="container">

        <div class="top">
            <div class="top_menu">
                {load_menu('main_menu')}
            </div>
            <div class="auth_menu">
                {if $_SESSION['DX_user_id']}
                    <span><a href="{site_url('shop/profile')}">Личный кабинет</a></span>
                    <span><a href="{site_url('auth/logout')}">Выход</a></span>
                {else:}
                    <span><a href="{site_url('auth')}" class="js">Вход</a></span>
                    <span><a href="{site_url('auth/register')}" class="js">Регистрация</a></span>
                {/if}
            </div>
        </div>
        <div class="header">
            <div class="logo">
                <a href="{site_url('')}"></a>
                <span>Интернет-магазин спортивных товаров и туристического снаряжения</span>
            </div>
            <div class="h_info">
                <div class="h_contacts">
                    <div><span>(050)</span>371-00-33</div>
                    <div><span>(067)</span>374-65-62</div>
                    <div><span>(032)</span>297-25-75</div>
                    <a href="{site_url('/shop/add_callback')}" class="js">Заказать звонок</a>
                    {/*}<a id="work" href="{site_url('/shop/work_day')}" class="js">Режим роботи</a>{*/}
                    </div>
                    <div class="search">
                    <form action="{shop_url('search')}" method="get">
                    <div class="text_field"><input type="text" name="text" value="{$_GET['text']}" /></div>
                    <div class="button"><input type="submit" value="Найти" /></div>
                    </form>
                    </div>
                    </div>
                    <div class="cart">
                    {include_tpl('shop/default/cart_data')}
                    </div>
                    </div>
                    <div class="main_menu">
                    {include_tpl('shop/default/catalog_menu')}
                    </div>
                    <div class="main_wrap p_bot">
                    {$content}
                    {if $CI->uri->segment(1) == 'contacts'}
                    <div id="call_to_me">
                    {include_tpl('shop/default/form_call_me')}
                    </div>
                    {/if}
                    </div>
                    </div>
                    <div class="bottom_info">
                    <div class="b"></div>
        
                    </div>
                    {$news = category_pages(63, 3)}
                    {if $news}
                    <div class="footer_news container">
                    <div class="cat-n-tit">Новости</div>
                    <ul class="clearfix">
                    {foreach $news as $new}
                    
                    <li> 
                    <div class="clearfix title">
                    <span class="f_l news-ico"></span>
                    <div class="name-n">
                    <span class="name">{echo $new.title}</span>
                    <span class="time"> {echo date("d.m.y", $new.created)}  </span>
                    </div>
                    </div>
                    <div>{echo $new.prev_text}</div>
                    </li>
                    
                    {/foreach}
                    </ul>
                    </div>
                 
                    {/if}
    
                    <div class="footer">
                    <div class="container">
                    <div class="f_left">
                    <div class="footer_menu">
                    {load_menu('main_menu')}
                    </div>
                    <div class="social_networks">
                    <a class="fb" target="_blank" href="http://www.facebook.com/pages/SPORTEKNET/156562627743180?sk=wall"></a>
                    <a class="tw" target="_blank" href="http://twitter.com/#!/sporteknet"></a>
                    <a class="vk" target="_blank" href="http://vkontakte.ru/sporteknet"></a>
                    </div>
                    </div>
                    <div class="f_right">
                    <span><img src="{$SHOP_THEME}images/siteimage.png" alt="раскрутка сайта" /><a href="http://www.siteimage.com.ua/raskrutka-sajtov-main" title="раскрутка сайта" target="_blank">Раскрутка сайта</a>, Интернет-агентство "Сайт Имидж". <br />Powered by ImageCMS <a href="http://www.imagecms.net/" target="_blank" title="ImageCMS">скрипт интернет магазина</a>.</span>
                    <span><a href="http://www.novasports.com.ua/">Оптовая торговля спортивным и туристическим снаряжением</a></span>
                    <span>79040 Украина, г. Львов, ул. Городоцкая, 357</span>
                 {if $CI->uri->segment(2) != 'product'}   {include_tpl('shop/default/rating')} {/if}
         
                    </div>
                    </div>
                    </div>
                    {literal}
                    <!-- Yandex.Metrika counter -->
                    <div style="display:none;"><script type="text/javascript">
                    (function(w, c) {
                    (w[c] = w[c] || []).push(function() {
                    try {
                    w.yaCounter4345378 = new Ya.Metrika({id:4345378, enableAll: true, ut:"noindex", webvisor:true});
                    }
                    catch(e) { }
                    });
                    })(window, "yandex_metrika_callbacks");
                    </script></div>
                    <script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
                    <noscript><div><img src="//mc.yandex.ru/watch/4345378?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->
                    {/literal}
                    </body>
                    </html>
