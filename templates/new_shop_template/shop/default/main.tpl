<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{if (int)$page_number>1}{echo $page_number} - {/if}{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" /> 
        <meta name="generator" content="ImageCMS" />
        {$meta_noindex}
        {$canonical}
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/style.css"/>
        <link rel="stylesheet" href="{$SHOP_THEME}/js/fancybox/source/jquery.fancybox.css?v=2.1.0" type="text/css" media="screen" />
        <link rel="icon" type="image/x-icon" href="{$SHOP_THEME}images/favicon.png"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="js/css3-mediaqueries.js"></script><![endif]-->
    </head>
    <body>
        <div class="mainBody">
            <div class="header">
                <header>
                    <div class="container">
                        <section class="row-fluid">
                            <div class="f_r m-l_25">
                                <nav class="f_l">
                                    <ul class="nav navHorizontal frameEnterReg">
                                        <li>
                                            <span class="f-s_0">
                                                <span class="helper"></span>
                                                <button type="button" data-drop=".drop-enter" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right"><span class="icon-enter"></span><span class="d_l_g">Вход</span></button>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="f-s_0">
                                                <span class="helper"></span>
                                                <span>
                                                    <a href="#" class="t-d_u c_5c"><span class="icon-registration"></span><span class="text-el">Регистрация</span></a>
                                                </span>
                                            </span>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="cleaner f_l f-s_0 isAvail">
                                    <span class="helper"></span>
                                    <span class="f-s_0">
                                        <span class="icon-bask"></span>
                                        <span class="d_l">Корзина</span>
                                        <span>&nbsp;(0)</span>
                                    </span>
                                </div>
                            </div>
                            <nav class="frameHeaderMenu">
                                <ul class="nav navHorizontal headerMenu">
                                    <li class="active"><span><span class="helper"></span><span>Главная</span></span></li>
                                    <li><a href="#"><span class="helper"></span><span>О магазине</span></a></li>
                                    <li><a href="#"><span class="helper"></span><span>Доставка и оплата</span></a></li>
                                    <li><a href="#"><span class="helper"></span><span>Помощь</span></a></li>
                                    <li><a href="#"><span class="helper"></span><span>Контакты</span></a></li>
                                </ul>
                            </nav>
                        </section>
                    </div>
                </header>
                <section class="container">
                    <section class="headerContent row-fluid">
                        <div class="span3">
                            <a href="#" class="logo">
                                <img src="{$SHOP_THEME}images/logo.png"/>
                            </a>
                        </div>
                        <div class="span9 f-s_0">
                            <span class="helper"></span>
                            <div class="w_100 f-s_0 frameUndef_1">
                                <div class="span6">
                                    <div class="frameSearch">
                                        <form method="post" action="#">
                                            <button class="f_r btn" type="submit"><span class="icon-search"></span><span class="text-el">Найти</span></button>
                                            <div class="o_h">
                                                <input type="text" placeholder="Поиск по сайту"/>
                                            </div>
                                            <div id="suggestions" class="drop-search">
                                                <div class="inside-padd">
                                                    <ul class="frame-search-thumbail">
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <span class="helper"></span>
                                                                    <img src="{$SHOP_THEME}images/temp/item_thumb.png">
                                                                </span>
                                                                <span>Оригинальный Phone 4S Black</span>
                                                            </a>
                                                            <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.</div>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <span class="helper"></span>
                                                                    <img src="{$SHOP_THEME}images/temp/item_thumb.png">
                                                                </span>
                                                                <span>Оригинальный Phone 4S Black</span>
                                                            </a>
                                                            <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.</div>
                                                        </li>
                                                    </ul>
                                                    <div class="btn-form">
                                                        <a href="#" class="f-s_0"><span class="icon-show-all"></span><span class="text-el">Показать все результаты</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div><a href="#"><span class="icon-comprasion"></span>Список сравнения (12)</a></div>
                                    <div style="margin-top: 9px;"><a href="#"><span class="icon-wish"></span>Список желаний (5)</a></div>
                                </div>
                                <div class="span3">
                                    <div class="headerPhone"><span class="c_67">+8 (097)</span><span class="d_n">&minus;</span> 572-58-18</div>
                                    <div style="margin-top: 7px;">
                                        <ul class="tabs">
                                            <li>
                                                <a class="t-d_n f-s_0" href="#a" data-drop=".drop-order-call" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="center"><span class="icon-order-call"></span><span class="d_l_b">Заказать звонок</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
            <div class="">
                <!--                     -->
                <div class="mainFrameMenu">
                    <!--фрейм на меню-->
                    <section class="container">
                        <div class="frameMenu">
                            <div class="frame-menu-main">
                                <div class="nav menu-main not-js">
                                    <nav>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" title="Телевизоры" class="title"><span class="helper"></span><span class="title-text">Телевизоры</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" title="Телевизоры" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" title="Телевизоры" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" title="Телевизоры">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" class="title"><span class="helper"></span><span class="title-text">Телефоны</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class="active">
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" class="title"><span class="helper"></span><span class="title-text">Телефоны</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" class="title"><span class="helper"></span><span class="title-text">Телефоны</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" class="title"><span class="helper"></span><span class="title-text">Ноутбуки</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="frame-item-menu">
                                                            <div><a href="#" class="title"><span class="helper"></span><span class="title-text">Компьютеры</span></a></div>
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны 11</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны Телефоны Телефоны Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <span class="helper"></span>
                                                                        <span>Телефоны</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="is-sub">
                                                                        <span class="helper"></span>
                                                                        <span>Мобильные телефоны</span>
                                                                    </a>
                                                                    <div>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="title">Телефоны11</span>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Телефоны</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">Мобильные телефоны</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="">
                    <!--                     class="span9"-->
                    <div class="mainFrameBaner">
                        <!--фрейм на банер-->
                        <section class="container">
                            <div class="frame_baner">
                                <ul class="cycle">
                                    <li>
                                        <a href="#">
                                            <img src="{$SHOP_THEME}images/temp/baner.jpg">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{$SHOP_THEME}images/temp/baner.jpg">
                                        </a>
                                    </li>
                                </ul>
                                <div class="pager"></div>
                                <button class="next" type="button"></button>
                                <button class="prev" type="button"></button>
                            </div>
                        </section>
                    </div>
                    <div class="mainFrameCarousel1">
                        <!--фрейм на елемент-->
                        <section class="container">
                            <div class="frame_carousel_product carousel_js">
                                <div class="m-b_20">
                                    <div class="title_h1 d_i-b v-a_m">Популярные товары</div>
                                    <div class="d_i-b groupButton v-a_m">
                                        <button type="button" class="btn btn_prev"><span class="icon prev"></span><span class="text-el"></span></button>
                                        <button type="button" class="btn btn_next"><span class="icon next"></span><span class="text-el"></span></button>
                                    </div>
                                </div>
                                <div class="carousel bot_border_grey">
                                    <ul class="items items_catalog">
                                        <li class="span3 in_cart">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_cart" type="button"><span class="icon-but"></span>Уже в корзине</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                        <li class="span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_buy" type="button"><span class="icon-but"></span>В корзину</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                        <li class="span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_buy" type="button"><span class="icon-but"></span>В корзину</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                        <li class="not-avail span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.</div>
                                                <button class="btn btn_not_avail" type="button" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="500" data-place="noinherit" data-placement="bottom right"><span class="icon-but"></span>Сообщить о появлении</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                        <li class="not-avail span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.</div>
                                                <button class="btn btn_not_avail" type="button" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="500" data-place="noinherit" data-placement="bottom right"><span class="icon-but"></span>Сообщить о появлении</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="mainFrameCarousel2">
                        <!--фрейм на елемент-->
                        <section class="container">
                            <div class="frame_carousel_product carousel_js">
                                <div class="m-b_20">
                                    <div class="title_h1 d_i-b v-a_m">Популярные товары</div>
                                    <div class="d_i-b groupButton v-a_m">
                                        <button type="button" class="btn btn_prev"><span class="icon prev"></span><span class="text-el"></span></button>
                                        <button type="button" class="btn btn_next"><span class="icon next"></span><span class="text-el"></span></button>
                                    </div>
                                </div>
                                <div class="carousel bot_border_grey">
                                    <ul class="items items_catalog">
                                        <li class="in_cart span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_cart" type="button"><span class="icon-but"></span>Уже в корзине</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                            <span class="top_tovar nowelty">New</span>
                                            <span class="top_tovar promotion">Акция</span>
                                        </li>
                                        <li class="span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_buy" type="button"><span class="icon-but"></span>В корзину</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                            <span class="top_tovar promotion">Акция</span>
                                        </li>
                                        <li class="span3">
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                                    </div>
                                                </div>
                                                <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                                                <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                                <button class="btn btn_buy" type="button"><span class="icon-but"></span>В корзину</button>
                                            </div>
                                            <a href="#" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{$SHOP_THEME}images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="mainFrameNews">
                        <!--фрейм на елемент-->
                        <section class="container">
                            <div class="title_h1">Новости</div>
                            <div class="news_start_page">
                                <ul class="row-fluid">
                                    <li class="span4">
                                        <time><span class="day">05</span><span class="month">/08</span><span class="year">/12</span></time>
                                        <a href="#">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>
                                        <p>ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!</p>
                                    </li>
                                    <li class="span4">
                                        <time><span class="day">05</span><span class="month">/08</span><span class="year">/12</span></time>
                                        <a href="#">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>
                                        <p>ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!</p>
                                    </li>
                                    <li class="span4">
                                        <time><span class="day">05</span><span class="month">/08</span><span class="year">/12</span></time>
                                        <a href="#">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>
                                        <p>ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!</p>
                                    </li>
                                </ul>
                                <a href="#" class="c_97"><span class="icon-archive"></span>Архив новостей</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="frame_brand carousel_js">
                <div class="container p_r">
                    <div class="carousel">
                        <ul class="items">
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand1.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand2.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand3.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand4.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand5.png">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="helper"></span>
                                    <img src="{$SHOP_THEME}images/temp/brand6.png" >
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn_brand btn_prev"></button>
                    <button class="btn_brand btn_next"></button>
                </div>
            </div>
            <div class="hFooter"></div>
        </div>
        <footer>
            <div class="container">
                <div class="row-fluid">
                    <div class="span5">
                        <nav>
                            <ul class="footer_menu">
                                <li><a href="#">Главная</a></li>
                                <li><a href="#">Видео</a></li>
                                <li><a href="#">О магазине</a></li>
                                <li><a href="#">Домашнее  аудио</a></li>
                                <li><a href="#">Доставка и оплата</a></li>
                                <li><a href="#">Фото и камеры</a></li>
                                <li><a href="#">Помощь</a></li>
                                <li><a href="#">Домашняя электроника</a></li>
                                <li><a href="#">Контакты</a></li>
                                <li><a href="#">Авто музыка и видео</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="span4">
                        <ul class="contacts_info">
                            <li><span class="icon-foot-phone"></span><span class="f-w_b">Телефоны:</span> +8 (067)<span class="d_n">&minus;</span> 572-58-18, +8 (067)<span class="d_n">&minus;</span> 572-58-18</li>
                            <li><span class="icon-foot-email"></span><span class="f-w_b">Email:</span> SiteImageCMS@gmail.com</li>
                            <li><span class="icon-foot-skype"></span><span class="f-w_b">Skype:</span> SiteImageCMS</li>
                        </ul>
                    </div>
                    <div class="span3 t-a_r">
                        <div class="copy_right">© SiteImage CMS, 2012</div>
                        <div class="footer_social">
                            <img src="{$SHOP_THEME}images/temp/social_footer.png"/>
                        </div>
                        <a href="#">Создание интернет магазина</a><br/>
                        SEO оптимизация сайта
                    </div>
                </div>
            </div>
        </footer>
        <div class="headerFon"></div>
        <div class="drop-enter drop">
            <div class="icon-times-enter" data-closed="closed-js"></div>
            <div class="drop-content">
                <div class="header_title">
                    Вход для клиентов
                </div>
                <div class="inside_padd">
                    <div class="horizontal_form standart_form">
                        <form method="post" id="login_form">
                            <label>
                                <span class="title">E-mail</span>
                                <span class="frame_form_field">
                                    <span class="icon-email"></span>
                                    <input type="text" name="email"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Пароль</span>
                                <span class="frame_form_field">
                                    <span class="icon-password"></span>
                                    <input type="password" name="password"/>
                                </span>
                            </label>
                            <div class="frameLabel">
                                <span class="title">&nbsp;</span>
                                <span class="frame_form_field c_n">
                                    <a href="#" class="f_l neigh_btn" onclick="ImageCMSApi.formAction('auth/authapi/forgot_password', '')">Забыли пароль?</a>
                                    <input type="button" value="Войти" class="btn btn_cart f_r" onclick="ImageCMSApi.formAction('auth/authapi/login', 'login_form'); return false;"/>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="drop-footer"></div>
        </div>
        <div class="drop-order-call drop" id="a">
            <div class="icon-times-enter" data-closed="closed-js"></div>
            <div class="drop-content">
                <div class="header_title">
                    Заказ звонка
                </div>
                <div class="inside_padd">
                    <div class="horizontal_form standart_form">
                        <form method="post">
                            <label>
                                <span class="title">Ваше имя</span>
                                <span class="frame_form_field">
                                    <span class="icon-person"></span>
                                    <input type="text"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Номер телефона</span>
                                <span class="frame_form_field">
                                    <span class="icon-phone"></span>
                                    <input type="text"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Примерное время</span>
                                <span class="frame_form_field">
                                    <input type="text"/>
                                    <span class="icon-clock"></span>
                                </span>
                            </label>
                            <label>
                                <span class="title">Комментарий</span>
                                <span class="frame_form_field">
                                    <textarea></textarea>
                                </span>
                            </label>
                            <div class="frameLabel">
                                <span class="title">&nbsp;</span>
                                <span class="frame_form_field c_n">
                                    <input type="submit" value="Позвоните мне" class="btn btn_cart f_r"/>
                                </span>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="drop-footer"></div>
        </div>
        <div class="drop drop-report">
            <div class="drop-content">
                <div class="title_h2">Сообщить когда появится</div>
                <div class="icon-times-enter" data-closed="closed-js"></div>
            </div>
            <div class="drop-footer"></div>
        </div>
        <div class="d_n" data-clone="data-report">
            <form method="post" action="#">
                <div class="standart_form">
                    <label>
                        <span class="title">E-mail</span>
                        <span class="frame_form_field">
                            <input type="text" id="email"/>
                            <span class="must">*</span>
                            <span class="help_inline">На почту придет уведомление о появлении данного товара</span>
                        </span>
                    </label>
                </div>
                <div class="t-a_r">
                    <input type="submit" value="Отправить" class="btn btn_cart"/>
                </div>
            </form>
        </div>
        <script src="{$SHOP_THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/jquery.cycle.all.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/jquery.jcarousel.min.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/jquery.ui-slider.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/cusel-min-2.5.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="{$SHOP_THEME}js/scripts.js" type="text/javascript"></script>
        <!--from old main.tpl-->
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jScrollPane.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.form.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/shop.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/jquery.validate.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/autocomplete.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/imagecms.api.js"></script>
    </body>
</html>
