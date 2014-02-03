<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="ImageCMS" />
        <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
        <link href="{$THEME}css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/style.css?{time()}" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/offcanvas.css" rel="stylesheet" media="screen"/>

        <!--[if lt IE 9]>
            <script src="{$THEME}js/html5shiv.js"></script>
            <script src="{$THEME}js/respond.min.js"></script>
            <![endif]-->
        <link rel="icon" type="image/vnd.microsoft.icon" href="/templates/documentation/images/favicon.png" />
        <link rel="SHORTCUT ICON" href="/templates/documentation/images/favicon.png" />

        <link media="screen" rel="stylesheet" href="{$THEME}js/highlight/styles/googlecode.css"/>
        <script type="text/javascript" src="{$THEME}js/highlight/highlight.pack.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.min.js"></script>

        {if !$hasCRUDAccess}
            <!-- Add mousewheel plugin (this is optional) -->
            <script type="text/javascript" src="{$THEME}js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

            <!-- Add fancyBox -->
            <link rel="stylesheet" href="{$THEME}js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
            <script type="text/javascript" src="{$THEME}js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

            <!-- Optionally add helpers - button, thumbnail and/or media -->
            <link rel="stylesheet" href="{$THEME}js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
            <script type="text/javascript" src="{$THEME}js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
            <script type="text/javascript" src="{$THEME}js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

            <link rel="stylesheet" href="{$THEME}js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
            <script type="text/javascript" src="{$THEME}js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        {/if}

        <script type="text/javascript" src="{$THEME}js/tinymce/tinymce.min.js"></script>

        <script type="text/javascript">
            var hasCRUDAccess = "{echo $hasCRUDAccess}";
            var id = "{echo $CI->core->core_data['id']}";
            hljs.initHighlightingOnLoad();
        </script>
    </head>
    <body>
        {include_tpl('inc/javascriptVars')}
        {include_tpl('inc/jsLangs.tpl')}
    {if !isset($_COOKIE['category_menu'])} {$_COOKIE['category_menu'] = 'begin-work'} {/if} 
    <div class="main-body">
        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="pull-left visible-xs navbar-toggle" data-toggle="offcanvas">
                        <span class="glyphicon glyphicon-chevron-left white"></span>
                        <span class="glyphicon glyphicon-th-list white"></span>
                    </button>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    {if  $CI->uri->uri_string() == ''}
                        <span class="logo f_l navbar-brand">
                            <img src="{$THEME}images/logo.png" alt="logo.png"/>
                        </span>
                    {else:}
                        <a href="{site_url('')}" class="logo f_l navbar-brand">
                            <img src="{$THEME}images/logo.png" alt="logo.png"/>
                        </a>
                    {/if}
                </div>
        {if !$category['parent_id']}{$category_root = $category}{else:}{$category_root = $CI->lib_category->get_category(key($category['path']))}{/if}
        {if $_COOKIE['clicked']}
            {$category_root['menu_cat'] = $_COOKIE['category_menu'];}
        {/if}
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav top_menu_documentation">
                {foreach $top_menu as $key => $value}
                    <li {if $category_root['menu_cat'] == $key}class="active"{/if}>
                        <a href="{site_url($value['category_url'])}" class='top-menu-item' data-category_menu="{$key}">{$value[0]}</a>
                    </li>
                {/foreach}
            </ul>

        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->

</div>
<div class="container">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            {if $CI->core->core_data['data_type'] != '404'}
                <div class="row">
                    <form class="form-group form-inline search-form-user" action="{site_url('search')}" method="GET">
                        <div class="">
                            <input type="text" class="form-control" name="text" placeholder="{lang("Поиск по документации","documentation")}" />
                            <button class="search-btn" type="submit"></button>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            {/if}
            <div class="tree_menu">
                {if $CI->core->core_data['data_type'] != 'search'}
                    {$CI->load->module('documentation')->load_category_menu($category_root['menu_cat'])}
                {/if}
                {if $CI->core->core_data['data_type'] == 'search'}
                    <div class="title">{lang("Найдно в категориях","documentation")}</div>
                    {include_tpl('found_in_categories')}
                {/if}
            </div>
        </div>

        <div class="col-sm-9 main-content">
            <!--div class="jumbotron">
                <h1>Hello, world!</h1>
                <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
            </div-->
            <div class="row main_content">
                {$content}
            </div>
            {if $CI->dx_auth->is_logged_in()}
                <div class="pull-right">
                    {$CI->load->module('documentation')}
                    {if $CI->documentation->hasCRUDAccess()}
                        <a href="/documentation/create_new_page" type="button" class="btn btn-success navbar-btn ">
                            <span class="glyphicon glyphicon-new-window"></span>
                            {lang('Create page','documentation')}
                        </a>
                        {if $CI->core->core_data['data_type'] == 'page'}
                            <a href="/documentation/edit_page/{echo $CI->core->core_data['id']}" type="button" class="btn btn-success navbar-btn ">
                                <span class="glyphicon glyphicon-pencil"></span>
                                {lang('Edit','documentation')}
                            </a>
                        {/if}
                    {/if}
                </div>
            {/if}
        </div>
    </div>

</div>
<div class="h_footer"></div>
</div>
<footer>

    <div class="down-info-p">
        <div class="container clearfix">
            <div class="info-box1 col-lg-4">
                <div class="title">
                    <span class="icon-blog"></span>
                    <span class="text-el">Записи <a href="http://www.imagecms.net/blog">с блога</a></span>
                </div>
                <ul>
                    {foreach $news as $item}
                        <li>
                            <div class="date">{echo ru_date('d F Y', $item.publish_date)}</div>
                            <a href="http://www.imagecms.net/{echo $item.full_url}">
                                <div class="short-info">{echo $item.title}</div>
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <div class="info-box2 col-lg-4">
                <div class="title">
                    <span class="icon-forum"></span>
                    <span class="text-el">Последнее <a href="http://www.forum.imagecms.net/search.php?action=show_recent">с форума</a></span>
                </div>
                <ul>
                    {foreach $forumThemes as $forum}
                        <li>
                            <div class="date">{$forum.last_poster}, {echo ru_date('d F Y', $forum.last_post)}</div>
                            <a target="_blank" href="http://forum.imagecms.net/viewtopic.php?pid={$forum.last_post_id}#{$forum.last_post_id}">
                                <div class="short-info">{htmlspecialchars($forum.subject)}</div>
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </div>

            <div class="info-box3 col-lg-4">
                <div class="title">
                    <span class="icon-linked"></span>
                    <span class="text-el">Подписка на новости</span>
                </div>
                <form action="http://imagecms.us4.list-manage1.com/subscribe/post?u=24900771ccefdde57835a37fb&amp;id=4eb9f5232f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <label class="for-mail">
                        <input type="text" placeholder="E-mail" name="EMAIL" id="mce-EMAIL"/>
                        <span class="icon-mail"></span>
                    </label>
                    <div class="btn-form-mail">
                        <button class="btn btn-foot" type="submit" name="subscribe" >
                            <span class="text-el">Подписаться</span>
                            <span class="icon-r-arr-b"></span>
                        </button>
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    {form_csrf()}
                </form>

            </div>
        </div>
    </div>

    <div class="content-footer container clearfix">
        <div class="foot-box1 col-sm-3">
            <div class="title">Сайт</div>
            <ul>
                <li><a href="http://imagecms.net/about">О Компании</a></li>
                <li><a href="http://imagecms.net/partners/siteOrder">Заказать сайт</a></li>
                <li><a href="http://imagecms.net/partners/become">Стать партнером</a></li>
                <li><a href="http://imagecms.net/buy">Купить сейчас</a></li>
            </ul>
        </div>
        <div class="foot-box2 col-sm-3">
            <div class="title">Связь</div>
            <ul>
                <li><a href="http://imagecms.net/support/technical-support">Потддержка</a></li>
                <li><a href="http://imagecms.net/blog">Блог</a></li>
                <li><a href="http://forum.imagecms.net">Сообщество</a></li>
            </ul>
        </div>
        <div class="foot-box3 col-sm-3">
            <div class="title">Уроки ImageCMS</div>
            <ul>
                <li><a href="http://imagecms.net/blog/imagecms-lessons/ustanovka-denwer-pervyi-shag-na-puti-sozdaniia-web-prekta">Установка</a></li>
                <li><a href="http://imagecms.net/blog/imagecms-lessons/php-mysql">DenwerPHP</a></li>
                <li><a href="http://imagecms.net/blog/imagecms-lessons/html-css-javascript">HTML-CSS</a></li>
            </ul>
        </div>
        <div class="foot-box4 col-sm-3">
            <div class="title">Инструкции</div>
            <ul>
                <li><a href="/poshagovye-instruktsii/sozdanie-korporativnogo-saita-na-baze-imagecms-corporate">Создание корпоративного сайта</a></li>
                <li><a href="/poshagovye-instruktsii/sozdanie-internet-magazina-na-baze-imagecms-shop">Создание Интернет-магазина</a></li>
            </ul>
        </div>
        <div class="foot-box5 col-sm-3">
            <div class="title">Задавайте вопросы</div>
            <ul>
                <li><span class="text-el f-w_b">+7 (499) 703-37-54</span></li>
                <li><span class="icon-skype-foot"></span><span class="text-el">imagecms</span></li>
                <li><span class="icon-icq-foot"></span><span class="text-el">627-509-412</span></li>
            </ul>
        </div>
    </div>
    <div class="footer-footer container t-a_j o_h">
        <div class="copy-right t-a_l col-sm-4">
            <div class="">2009-2013 © «ImageCMS»</div>
            <div class="all-rights">Все права защищены</div>
        </div>

        <ul class="col-sm-4">
            <li>
                <a href="http://vk.com/imagecms" class="icon-fsoc-vk" onclick="_gaq.push(['_trackPageview', '/socialpage_vk'])" target="blank"></a>
            </li>
            <li>
                <a href="http://www.facebook.com/pages/Image-CMS/231137056897516" class="icon-fsoc-fsb" onclick="_gaq.push(['_trackPageview', '/socialpage_facebook'])" target="blank"></a>
            </li>
            <li>
                <a href="https://plus.google.com/u/0/b/107219447061140923464/107219447061140923464/posts" class="icon-fsoc-gplus" onclick="_gaq.push(['_trackPageview', '/socialpage_plus'])" target="blank"></a>
            </li>
            <li>
                <a href="http://www.youtube.com/user/imagecms" rel="nofollow" target="_blank" class="icon-fsoc-youtube"></a>
            </li>
            <li>
                <a href="http://www.linkedin.com/company/imagecms" rel="nofollow" target="_blank" class="icon-fsoc-in"></a>
            </li>
            <li>
                <a href="https://twitter.com/#!/imagecms" class="icon-fsoc-tweet" onclick="_gaq.push(['_trackPageview', '/socialpage_twitter'])" target="blank"></a>
            </li>
        </ul>
        <div class="t-a_r col-sm-4">

            <span class="stars-foot">
                {$CI->load->module('star_rating')->show_star_rating()}
            </span>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{$THEME}js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$THEME}js/offcanvas.js?{time()}"></script>
</body>
</html>
