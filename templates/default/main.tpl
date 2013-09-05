<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {$page_type = $CI->core->core_data['data_type'];}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />

        <link rel="stylesheet" type="text/css" href="{$THEME}css/general.css" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/slideshow.css" />

        <script type="text/javascript" src="{$THEME}js/jquery.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.hoverIntent.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.cycle.js"></script>

        <script type="text/javascript" src="/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js"></script>
        <link rel="stylesheet" type="text/css" href="/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" />


        <script type="text/javascript" src="{$THEME}js/jquery.functions.js"></script>
        <script type="text/javascript" src="{$THEME}js/cufon.js"></script>
        <script type="text/javascript" src="{$THEME}js/js.js"></script>

        <link rel="icon" href="{$THEME}images/favicon.png" type="image/x-icon" />

    </head>
    <body>
        <!-- BEGIN LAYOUT -->
        <div id="conteiner">
            <!-- BEGIN HEADER -->
            <div id="header">

                <div class="topmenu">
                    <div class="topmenu_l">
                        <div class="topmenu_r">
                            <ul>
                                {if $is_logged_in}
                                    <li class="first">{lang('lang_logged_in_as')} <b>{$username}</b></li>
                                    <li><a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></li>
                                    {else:}
                                    <li class="first"><a href="{site_url('auth/login')}">Вход</a></li>
                                    <li><a href="{site_url('auth/register')}">Регистрация</a></li>
                                    {/if}
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="left">
                    <!-- BEGIN LOGO -->
                    <div id="logo"><a href="{site_url('')}"><img src="{$THEME}images/logo.png" alt="logo" border="0"/></a></div>
                    <!-- BEGIN SLOGAN -->
                    <div id="slogan">Наша компания бесспорно лучшая в галактике!</div>
                </div>
                <div class="right">
                    Тел. (097) 772-22-22<br />Тел. моб. (097) 772-22-22
                </div>
                <div class="sp"></div>
            </div>
            <!-- END HEADER -->

            <!-- BEGIN NAVIGATION -->
            <div id="navigation">
                {load_menu('main_menu')}
                <!-- BEGIN SEARCH
                <div id="search">
                  <form action="#">
                    <input type="submit" class="submit" value=""/>
                    <input type="text" class="text"/>
                  </form>
                </div> -->
            </div>
            <div id="main">

                {if $page_type == 'main'}
                    <!-- BEGIN SLIDESHOW -->
                    <div id="slideshow">
                        <ul id="slides">
                            <li><a href="#"><img src="{$THEME}images/robot1.jpg" alt="" width="922" height="287" /></a></li>
                            <li><a href="#"><img src="{$THEME}images/robot2.jpg" alt=""  width="922" height="287" /></a></li>
                            <li><a href="#"><img src="{$THEME}images/robot3.jpg" alt=""  width="922" height="287" /></a></li>
                            <li><a href="#"><img src="{$THEME}images/robot4.jpg" alt="" width="922" height="287" /></a></li>
                        </ul>
                        <div id="slideshow_violator" class="clearfix">
                            <div id="slide_navigation" class="clearfix"></div>
                        </div>
                    </div>
                    <!-- END SLIDESHOW -->
                {/if}

                <!-- BEGIN CONTEINER -->
                {if $CI->uri->segment(1) != 'feedback' && $CI->uri->segment(1) != 'gallery'}
                    <div id="content">{$content}</div>
                {else:}
                    <div id="no_sidebar_content">{$content}</div>
                {/if}

                <!-- END CONTENT -->


                {if $CI->uri->segment(1) != 'feedback' && $CI->uri->segment(1) != 'gallery'}

                    {if $category.id == 59 || $category.parent_id == 59}


                        <!-- START SIDEBAR -->
                        <div id="sidebar">


                            <div class="content">
                                <div id="search">
                                    <form action="{site_url('search')}" method="POST">
                                        <input type="submit" class="submit" value=""/>
                                        <input type="text" class="text" name="text" value="Поиск" onfocus="if (this.value == 'Поиск')
                            this.value = '';" onblur="if (this.value == '')
                            this.value = 'Поиск';"/>
                                        {form_csrf()}
                                    </form>
                                </div>
                            </div>

                            <div class="box">
                                <h4 class="title"><span>Категории</span></h4>
                                <div class="content">
                                    <ul>
                                        {$sub_cats = get_sub_categories('59')}
                                        {$count = 0}
                                        {foreach $sub_cats as $sub_cat}
                                            <li {if $count == 0} class="first" {/if}><a href="{site_url('bloh/'. $sub_cat.url)}" {if $sub_cat.id == $category.id} class="active" {/if}>{$sub_cat.name}</a></li>
                                                {$count++}
                                            {/foreach}
                                    </ul>
                                </div>
                            </div>

                            <div class="box">
                                <h4 class="title"><span>Последние комментарии</span></h4>
                                <div class="content">
                                    {widget('comments ')}
                                </div>
                            </div>


                            <div class="box">
                                <h4 class="title"><span>Облако Тегов</span></h4>
                                <div class="content">
                                    <div>
                                        {widget('tags')}
                                    </div>
                                </div>
                            </div>


                            <div class="box"><a href="/rss" class="button1">Подписаться на блог</a></div>
                        </div>
                        <!-- END SIDEBAR -->

                    {elseif $category.id == 55}

                        <div id="sidebar">
                            <div class="box">
                                <h4 class="title"><span>Продукция</span></h4>
                                <div class="content">
                                    {widget('product_all')}
                                </div>
                            </div>
                        </div>

                    {elseif $category.id == 56}

                        <div id="sidebar">
                            <div class="box">
                                <h4 class="title"><span>Услуги</span></h4>
                                <div class="content">
                                    {widget('offers_all')}
                                </div>
                            </div>
                        </div>


                    {elseif $category.id == 58}

                        <div id="sidebar">
                            <div class="box">
                                <h4 class="title"><span>Вакансии</span></h4>
                                <div class="content">
                                    {widget('works')}
                                </div>
                            </div>
                        </div>


                    {elseif $category.id == 57}

                        <div id="sidebar">
                            <div class="box">
                                <h4 class="title"><span>Галерея</span></h4>
                                <div class="content">
                                    {widget('rand_images')}
                                </div>
                            </div>
                        </div>


                    {else:}

                        <!-- START SIDEBAR -->
                        <div id="sidebar">
                            <div class="box">
                                <h4 class="title"><span>Новости компании</span></h4>
                                <div class="content">
                                    {widget('news')}
                                </div>
                            </div>
                            <div class="box">
                                <h4 class="title"><span>Последнее из блога</span></h4>
                                <div class="content">
                                    {widget('blog')}
                                </div>
                            </div>
                            <div class="box"><a href="/rss" class="button1">Подписаться на блог</a></div>
                        </div>
                        <!-- END SIDEBAR -->

                    {/if}


                {/if}





                <div class="sp"></div>
            </div>
            <div class="sp"></div>
        </div>
        <!-- BEGIN FOOTER -->
        <div id="footer">
            <div class="left">© 2012  <strong>Image Robotics</strong> - лидер в производстве роботов<br/>
                <div class="credits">Powered by <a href="http://www.imagecms.net">ImageCms</a></div>
            </div>
            {load_menu('bottom_menu')}
            <div class="sp"></div>
        </div>
        <!-- END FOOTER -->
    </body>
</html>