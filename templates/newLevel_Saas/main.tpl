<!DOCTYPE html>
<html>
    <head>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all"/>

        <link rel="icon" href="" type="image/x-icon" />
        <link rel="shortcut icon" href="" type="image/x-icon" />

        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
    </head>
    <body> 
        <script>
            {literal}
                var k = 0;
                for (var i in $.browser) {
                    k++;
                    if (k === 3)
                        $('body').addClass('is' + i);
                }
            {/literal}
        </script>

        <div class="main-body">
            <header {if strstr($CI->uri->uri_string(), 'support/ticket/')}class="fixed"{/if}>
                <div class="container">
                    <div class="logo">
                        <img src="{$THEME}img/logo.jpg" alt="Логотип"/>
                    </div>
                    <ul class="right-header items">
                        <li class="item-profile">
                            <button type="button" class="btn-profile btn">
                                <span class="frame-ico">
                                    <span class="helper"></span>
                                    <span class="icon-person"></span>
                                </span>
                                <span class="d_i-b">
                                    <span class="text-el">Профиль</span>
                                    <span class="icon-arrow"></span>
                                </span>
                            </button>
                            <ul class="drop nav">
                                <li>
                                    <a href="#">
                                        <span class="text-el">Личные данные</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="text-el">Выход</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="btn-shop btn">
                                <span class="frame-ico">
                                    <span class="helper"></span>
                                    <span class="icon-bask"></span>
                                </span>
                                <span class="text-el">Магазин</span>
                            </a>
                        </li>
                        <li>
                            <span class="divider"></span>
                        </li>
                        <li>
                            <a href="{site_url('')}" class="btn-admin btn">
                                <span class="text-el">Админчасть</span>
                            </a>
                        </li>
                    </ul>
                    <div class="content-header">
                        <a href="#" class="header-out-info-lost">
                            Осталось 
                            <span style="font-size: 22px;">14</span>
                            дней 
                        </a>
                        <div class="info-header">
                            <span class="info-text-phone">
                                Незнаете с чего начать?
                                <span class="d_i-b">{echo siteinfo('siteinfo_mainphone')}</span>
                            </span>
                            <a href="#consult" class="btn-consultation fancybox">
                                <span class="text-el">Консультация</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="left">
                    {load_menu('saas_left_menu')}
                </div>
                {if $CI->core->core_data['data_type'] == 'main'}
                    <div class="right"
                         data-mq-elem-pool=".main-body"
                         data-mq-prop-pool="height"
                         data-mq-prop="min-height"
                         data-mq-prop-add="-87"

                         data-mq-max="1280"
                         data-mq-min="0"
                         data-mq-target="#right"
                         >
                        <div class="panel-default">
                            <div class="title-default-out">
                                <div class="title">
                                    Тур по системе
                                </div>
                            </div>
                            {// var_dumps(category_pages(81,11))}
                            <ol class="items-refers-vertical">
                                {$tutorial_pages = category_pages(81,11);}
                                {foreach $tutorial_pages as $number => $page}
                                    <li>
                                        <a href="{echo site_url($page['cat_url'])}#t{echo ++$number}" class="after-icon">
                                            {echo $page['title']}
                                        </a>
                                    </li>
                                {/foreach}

                            </ol>
                            <div class="footer-panel">
                                <div class="inside-padd">
                                    <a href="{site_url('tutorial')}" class="btn btn-primary">
                                        <span class="text-el">Полная документация</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-default out-adding-service">
                            <div class="title-default-out">
                                <div class="title">
                                    Дополнительные услуги
                                </div>
                            </div>
                            {$CI->load->module('cfcm')->get_form(80, 97, 'page', 'additional_services_form_min')}
                        </div>
                    </div>
                {/if}
                <!--                content-->
                <div class="content">
                    {echo $content}
                </div>
                <!--                content-->

            </div>
        </div>
        <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
        <script type="text/javascript" src="{$THEME}js/tabs.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="{$THEME}js/fancybox/jquery.fancybox-1.3.4.css" media="all" />
        <script type="text/javascript" src="{$THEME}js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <div class="d_n">
            <div style="max-width: 530px;" id="consult" class="fancy">
                <div class="panel-default">
                    <div class="title-default-out">
                        <div class="title">
                            Консультация
                        </div>
                    </div>
                    <div class="footer-panel">
                        <div class="inside-padd">
                            <span class="s-t">Ваш запрос обработает менеджер и отправит ответ в ближайшие сроки</span>
                        </div>
                    </div>
                    <form method="post" action="#">
                        <div class="content-panel">
                            <textarea placeholder="Введите Ваше сообщение&hellip;" style="padding-left: 27px;"></textarea>
                        </div>
                        <div class="footer-panel clearfix">
                            <button type="submit" class="btn btn-primary f_l" style="margin: 11px 28px;">
                                <span class="text-el">Отправить</span>
                            </button>
                            <div class="hidden-type-file f_r btn-attach-file btn">
                                <span class="icon-attach"></span>
                                <span class="text-el">Прикрепить</span>
                                <input type="file" title="Выберете файл"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>