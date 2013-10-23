<!DOCTYPE html>
<html>
<head>
    <title>{$site_title}</title>
    <meta name="description" content="{$site_description}" />
    <meta name="keywords" content="{$site_keywords}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="generator" content="ImageCMS" />
    <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href="{$THEME}css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="{$THEME}css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
    <link href="{$THEME}css/style.css" rel="stylesheet" media="screen"/>
    <link href="{$THEME}css/offcanvas.css" rel="stylesheet" media="screen"/>

        <!--[if lt IE 9]>
            <script src="{$THEME}js/html5shiv.js"></script>
            <script src="{$THEME}js/respond.min.js"></script>
            <![endif]-->
            <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
            <link rel="SHORTCUT ICON" href="favicon.ico" />

            <link media="screen" rel="stylesheet" href="{$THEME}js/highlight/styles/googlecode.css"/>
            <script type="text/javascript" src="{$THEME}js/highlight/highlight.pack.js"></script>
            <script type="text/javascript" src="{$THEME}js/jquery.min.js"></script>

            {literal}
            <script>hljs.initHighlightingOnLoad();</script>
            {/literal}

            <script type="text/javascript" src="{$THEME}js/tinymce/tinymce.js"></script>

            <script type="text/javascript">
            var id = "{echo $CI->core->core_data['id']}";
            {literal}
            $(document).ready(function() {
                $(".top_menu_documentation li a").on('click', function() {
                    var categoyMenu = $(this).data('category_menu');
                    var CookieDate = new Date();
                    CookieDate.setFullYear(CookieDate.getFullYear() + 1);
                    document.cookie = "category_menu=" + categoyMenu + " ;expires=" + CookieDate.toGMTString() + ";path=/";
                    window.location = '/';
                });
            });
            {/literal}
            </script>
        </head>
        <body>
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

                            <a id="main_logo" href="{site_url()}" class="logo f_l navbar-brand">
                                <img src="{$THEME}images/logo.png"/>
                            </a>
                        </div>

                        <div class="collapse navbar-collapse">
                            {include_tpl('top_menu')}
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
                        </div><!-- /.nav-collapse -->
                    </div><!-- /.container -->
                </div>
                <div class="container">
                    <div class="row row-offcanvas row-offcanvas-left">
                        <div class="col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                            {if $CI->core->core_data['data_type'] != '404'}
                            <div class="row">
                                <form class="form-group form-inline search-form-user" action="{site_url('search')}" method="POST">
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
                                <div class="title">Администрирование</div>
                                {$CI->load->module('documentation')->load_category_menu($_COOKIE['category_menu'])}
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
                    <div class="row">
                        {$content}
                    </div>
                </div>
            </div>

        </div>
        <div class="h_footer"></div>
    </div>
    <footer>

        <div class="down-info-p">
         <div class="container clearfix">
          <div class="info-box1 col-lg-4">
           <div class="title"><span class="icon-blog"></span><span class="text-el">Записи <a href="#">с блога</a></span></div>
           <ul>
            <li>
             <div class="date">17 Сентября 2013</div>
             <div class="short-info">Одностраничный сайт как инструмент продаж</div>
         </li>
         <li>
             <div class="date">17 Сентября 2013</div>
             <div class="short-info">Поисковая система Bing сменила логотип</div>
         </li>
         <li>
             <div class="date">17 Сентября 2013</div>
             <div class="short-info">Яндекс.Деньги начали работать с США</div>
         </li>
     </ul>
 </div>
 <div class="info-box2 col-lg-4">
   <div class="title"><span class="icon-forum"></span><span class="text-el">Последнее <a href="#">с форума</a></span></div>
   <ul>
    <li>
     <div class="date">Yana, 17 Сентября 2013</div>
     <div class="short-info">Что делать дальше?</div>
 </li>
 <li>
     <div class="date">newmax, 17 Сентября 2013</div>
     <div class="short-info">Ошибка на втором этапе</div>
 </li>
 <li>
     <div class="date">filtrat, 17 Сентября 2013</div>
     <div class="short-info">ImageCMS 4.5 beta</div>
 </li>
</ul>
</div>
<div class="info-box3 col-lg-4">
   <div class="title"><span class="icon-linked"></span><span class="text-el">Подписка на новости</span></div>
   <form>
    <label class="for-mail">
     <input type="text" placeholder="E-mail"/>
     <span class="icon-mail"></span>

 </label>
 <div class="btn-form-mail">
     <button class="btn btn-foot"><span class="text-el">Подписаться</span><span class="icon-r-arr-b"></span></button>
 </div>
</form>
</div>
</div>
</div>

<div class="content-footer container clearfix">
    <div class="foot-box1 col-sm-3">
        <div class="title">Сайт</div>
        <ul>
            <li><a href="#">О Компании</a></li>
            <li><a href="#">Заказать сайт</a></li>
            <li><a href="#">Стать партнером</a></li>
            <li><a href="#">Купить сейчас</a></li>
        </ul>
    </div>
    <div class="foot-box2 col-sm-3">
        <div class="title">Связь</div>
        <ul>
            <li><a href="#">Поддержка</a></li>
            <li><a href="#">Блог</a></li>
            <li><a href="#">Сообщество</a></li>
        </ul>
    </div>
    <div class="foot-box3 col-sm-3">
        <div class="title">Уроки ImageCMS</div>
        <ul>
            <li><a href="#">Установка</a></li>
            <li><a href="#">DenwerPHP</a></li>
            <li><a href="#">HTML-CSS</a></li>
        </ul>
    </div>
    <div class="foot-box4 col-sm-3">
        <div class="title">Инструкции</div>
        <ul>
            <li><a href="#">Создание корпоративного сайта</a></li>
            <li><a href="#">Создание Интернет-магазина</a></li>
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
        <li><a class="icon-fsoc-vk"></a></li>
        <li><a class="icon-fsoc-fsb"></a></li>
        <li><a class="icon-fsoc-gplus"></a></li>
        <li><a class="icon-fsoc-youtube"></a></li>
        <li><a class="icon-fsoc-in"></a></li>
        <li><a class="icon-fsoc-tweet"></a></li>
    </ul>
    <div class="t-a_r col-sm-4">
        <div class="">
            <span class="text-el">Голосуй за ImageCMS:</span>
            <span class="stars-foot"><img src="{$THEME}images/stars.png"></span>
        </div>
        <div class="cms-foot-vote">Проголосовало 36 человек</div>
    </div>
</div>
</footer>





{/*}
<footer>
  {if !$CI->dx_auth->is_logged_in()}
  <div class="pull-right">
    <a href="/auth/login" class="navbar-btn">
        <span class="glyphicon glyphicon-log-in "></span>
        {lang('Log in','documentation')}
    </a>&nbsp;
    <a href="/auth/register" class="navbar-btn">
        <span class="glyphicon glyphicon-log-in "></span>
        {lang('Registration','documentation')}
    </a>
</div>
{else:}
<div class="pull-right">
    <a href="/auth/logout" type="button">
        <span class="glyphicon glyphicon-log-out"></span>
        {lang('Exit','documentation')}
    </a>
</div>
{/if}
</footer>
{ */}


<script type="text/javascript" src="{$THEME}js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$THEME}js/offcanvas.js"></script>
</body>
</html>