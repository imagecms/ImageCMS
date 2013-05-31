<!DOCTYPE html>
<html>
    <head>
        <title>{lang('a_controll_panel')} | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content="{lang('a_controll_panel')} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="ImageCMS">

        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png"/>

        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">


        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">

    </head>
    <body>
        <div class="main_body">
            <div id="fixPage"></div>
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">
                    {if $ADMIN_URL}
                        <a href="{$ADMIN_URL}dashboard" class="logo pull-left pjax">
                        {else:}
                            <a href="/admin/dashboard" class="logo pull-left pjax">
                            {/if}
                            <img src="{$THEME}img/logo.png"/>
                        </a>

                        {if $CI->dx_auth->is_logged_in()}
                            <div class="pull-right span4">
                                <div class="clearfix">
                                    <span class="m-r_10">
                                        {lang('a_wellcome')},
                                        {if $CI->dx_auth->get_username()}
                                            <a href="
                                               {if SHOP_INSTALLED}/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}
                                               {else:}/admin/components/cp/user_manager/edit_user/{echo $CI->dx_auth->get_user_id()}
                                               {/if}"
                                               id="user_name">
                                                {echo $CI->dx_auth->get_username()}
                                            </a>
                                            <a href="/admin/logout">
                                                <i class="my_icon exit_ico"></i>
                                            </a>
                                        {else:}
                                            {echo lang('a_guest')}
                                        {/if}
                                    </span>
                                    <span class="m-l_10">Просмотр <a href="{$BASE_URL}" target="_blank">сайта <span class="f-s_14">→</span></a></span>
                                </div>
                                <form method="get" action="{if $ADMIN_URL}/admin/components/run/shop/search/advanced{else:}admin/admin_search{/if}" id="adminAdvancedSearch">
                                    <div class="input-append search">
                                        <button id="adminSearchSubmit" type="submit" class="btn pull-right"><i class="icon-search"></i></button>
                                        <div class="o_h">
                                            <input id="{if $ADMIN_URL}shopSearch{else:}baseSearch{/if}" name="q" size="16" type="text"  autocomplete="off" tabindex="1" value="{$_GET['q']}">
                                        </div>
                                    </div>
                                </form>
                            </div>



                            {if SHOP_INSTALLED}
                                <div class="btn-group" id="topPanelNotifications" style="display: block;">
                                    <div class="span4 d-i_b">
                                        <a href="/admin/components/run/shop/orders/index" class=" pjax btn btn-large" data-title="Заказы" data-rel="tooltip" data-original-title="Заказы">
                                            <i class="icon-bask "></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="{lang('a_product_no_icon')}" data-rel="tooltip" data-original-title="">
                                            <i class="icon-report_exists"></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="Callback" data-rel="tooltip" data-original-title="Callback">
                                            <i class="icon-callback "></i>
                                        </a>
                                        <a href="/admin/components/cp/comments" class="btn btn-large pjax" data-title="{lang('a_last_comm')}" data-rel="tooltip" data-original-title="{lang('a_last_comm')}">
                                            <i class="icon-comment_head "></i>
                                        </a>
                                    </div>
                                </div>
                            {/if}
                        {/if}


                </section>
            </header>

            {if $CI->dx_auth->is_logged_in()}
                <div class="frame_nav" id="mainAdminMenu">
                    <div class="container" id="baseAdminMenu">
                        <nav class="navbar navbar-inverse">


                            {include('templates/administrator/inc/menus.php');}

                            <ul class="nav">
                                {foreach $baseMenu as $li}
                                    <li class="{$li.class} {if $li.subMenu} dropdown{/if}">
                                        {if $li.subMenu}
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{$li.icon}"></i>{echo (bool)lang($li.text)?lang($li.text):$li.text}<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                {foreach $li.subMenu as $sli}
                                                    {if $sli.menusList}
                                                        {if !$menus}
                                                            {$CI->load->module('menu'); $menus=$CI->menu->get_all_menus()}
                                                        {/if}

                                                        <li><a href="/admin/components/cp/menu/index" class="pjax">{lang('a_control')}</a></li>
                                                        <li class="divider"></li>
                                                            {foreach $menus as $menu}
                                                            <li><a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="pjax">{$menu.main_title}</a></li>
                                                            {/foreach}
                                                        {/if}


                                                    {if $sli.modulesList}
                                                        {if !$components}
                                                            {$CI->load->module('admin/components'); $components = $CI->components->find_components(TRUE)}
                                                        {/if}

                                                        {foreach $components as $component}
                                                            {if $component['installed'] == TRUE AND $component['admin_file'] == 1}
                                                                <li><a href="/admin/components/cp/{$component.com_name}" class="pjax">{$component.menu_name}</a></li>
                                                                {/if}
                                                            {/foreach}
                                                        {/if}

                                                    <li {if $sli.divider} class="divider"{/if}{if $sli.header} class="nav-header"{/if}>{if $sli.link}<a href="{$sli.link}" class="pjax">{echo (bool)lang($sli.text)?lang($sli.text):$sli.text}</a>{else:}{echo (bool)lang($sli.text)?lang($sli.text):$sli.text}{/if}</li>


                                                {/foreach}
                                            </ul>
                                        {else:}
                                            <a href="{$li.link}" class="pjax">
                                                <i class="{$li.icon}"></i>
                                                <span>{$li.text}</span>
                                            </a>
                                        {/if}
                                    </li>
                                {/foreach}
                            </ul>

                            {if SHOP_INSTALLED}
                                <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#">Администрировать магазин <span class="f-s_14">→</span></a>
                            {/if}
                        </nav>
                    </div>

                    {if SHOP_INSTALLED}
                        <div style="display:none;" class="container" id="shopAdminMenu"  >
                            <nav class="navbar navbar-inverse">
                                <ul class="nav">
                                    {foreach $shopMenu as $li}
                                        <li class="{$li.class} {if $li.subMenu} dropdown{/if}">
                                            {if $li.subMenu}
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{$li.icon}"></i>{echo (bool)lang($li.text)?lang($li.text):$li.text}<b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    {foreach $li.subMenu as $sli}
                                                        <li {if $sli.divider} class="divider"{/if}{if $sli.header} class="nav-header"{/if}>
                                                            {if $sli.link}
                                                                <a href="{site_url($sli.link)}" class="pjax">{echo (bool)lang($sli.text)?lang($sli.text):$sli.text}</a>
                                                            {else:}
                                                                {echo (bool)lang($sli.text)?lang($sli.text):$sli.text}
                                                            {/if}
                                                        </li>
                                                    {/foreach}
                                                </ul>
                                            {else:}
                                                <a href="{$li.link}" class="pjax">
                                                    <i class="{$li.icon}"></i>
                                                    <span>{$li.text}</span>
                                                </a>
                                            {/if}
                                        </li>
                                    {/foreach}
                                </ul>
                                <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> Администрировать сайт </a>
                            </nav>
                        </div>
                    {/if}
                </div>
            {/if}
            <div id="loading"></div>
            <div class="container" id="mainContent">
                {$content}
            </div>
            <div class="hfooter"></div>
        </div>
        <footer>
            <div class="container">
                <div class="row-fluid">
                    <div class="span4">
                        Интерфейс:
                        <div class="dropup d-i_b">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                {lang('a_'.$this->CI->config->item('language'))}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/settings/switch_admin_lang/english">{lang('a_english')} (beta)</a></li>
                                <li><a href="/admin/settings/switch_admin_lang/russian">{lang('a_russian')}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        {lang('a_version')}: <b>{echo getCMSNumber()}</b>
                        <div class="muted">Помогите нам стать еще лучше - <a href="#" id="rep_bug">сообщите об ошибке</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © ImageCMS 2013</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <div id="elfinder"></div>
        <div class="standart_form frame_rep_bug">
            <form method="post" action="">
                <label>
                    Ваше Имя:
                    <input type=text name="name"/>
                </label>
                <label>
                    Ваш Email:
                    <input type=text name="email"/>
                </label>
                <label>
                    {lang('a_your_remark')}:
                    <textarea></textarea>
                </label>
                <input type="submit" value="{lang('a_send_report')}" class="btn btn-info"/>
                <input type="button" value="{lang('a_cancel')}" class="btn btn-info" style="float:right" name="cancel_button"/>
                <input type="hidden" value="{$_SERVER['REMOTE_ADDR']}" id="ip_address"/>
            </form>
        </div>
        <script>
            {$settings = $CI->cms_admin->get_settings();}
                                    var textEditor = '{$settings.text_editor}';
            {if $CI->dx_auth->is_logged_in()}
                                    var userLogined = true;
            {else:}
                                    var userLogined = false;
            {/if}

                                    var locale = '{echo $this->CI->config->item('language')}';
                                    var base_url = "{site_url()}";
        </script>

        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/bootstrap.min.js" type="text/javascript"></script>
        <script async="async" src="{$THEME}js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery.form.js" type="text/javascript"></script>

        <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <script src="{$THEME}js/functions.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>

        <script type="text/javascript" src="/js/elrte-1.3/js/elrte.min.js"></script>
        <script type="text/javascript" src="/js/elfinder-2.0/js/elfinder.min.js"></script>


        {if $this->CI->config->item('language') == 'russian'}
            <script async="async" src="{$THEME}js/jquery-validate/messages_ru.js" type="text/javascript"></script>
            <script type="text/javascript" src="/js/elrte-1.3/js/i18n/elrte.ru.js"></script>
            <script type="text/javascript" src="/js/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
        {/if}


        <!--
        <script src="{$THEME}js/admin_base.min.js" type="text/javascript"></script>
        -->

        <script src="{$THEME}js/admin_base_i.js" type="text/javascript"></script>
        <script src="{$THEME}js/admin_base_m.js" type="text/javascript"></script>
        <script src="{$THEME}js/admin_base_r.js" type="text/javascript"></script>
        <script src="{$THEME}js/admin_base_v.js" type="text/javascript"></script>
        <script src="{$THEME}js/admin_base_y.js" type="text/javascript"></script>
        <script type="text/javascript" src="/js/tiny_mce/jquery.tinymce.js"></script>
        <script src="{$THEME}js/autosearch.js" type="text/javascript"></script>

        <script>
            {if $CI->uri->segment('4') == 'shop'}
                                    var isShop = true;
            {else:}
                                    var isShop = false;
            {/if}
                                    var lang_only_number = "{lang('a_numbers_only')}";
                                    var show_tovar_text = "{lang('a_show')}";
                                    var hide_tovar_text = "{lang('a_dont_show')}";
            {literal}

                $(document).ready(function() {

                    if (!isShop)
                    {
                        $('#shopAdminMenu').hide();
                        //$('#topPanelNotifications').hide();
                    }
                    else
                        $('#baseAdminMenu').hide();
                })

                function number_tooltip_live() {
                    $('.number input').each(function() {
                        $(this).attr({
                            'data-placement': 'top',
                            'data-title': lang_only_number
                        });
                    })
                    number_tooltip();
                }
                function prod_on_off() {
                    $('.prod-on_off').die('click').live('click', function() {
                        var $this = $(this);
                        if (!$this.hasClass('disabled')) {
                            if ($this.hasClass('disable_tovar')) {
                                $this.animate({
                                    'left': '0'
                                }, 200).removeClass('disable_tovar');
                                if ($this.parent().data('only-original-title') == undefined) {
                                    $this.parent().attr('data-original-title', show_tovar_text)
                                    $('.tooltip-inner').text(show_tovar_text);
                                }
                                $this.next().attr('checked', true).end().closest('td').next().children().removeClass('disabled').removeAttr('disabled');
                                if ($this.attr('data-page') != undefined)
                                    $('.setHit, .setHot, .setAction').removeClass('disabled').removeAttr('disabled');
                            }
                            else {
                                $this.animate({
                                    'left': '-28px'
                                }, 200).addClass('disable_tovar');
                                if ($this.parent().data('only-original-title') == undefined) {
                                    $this.parent().attr('data-original-title', hide_tovar_text)
                                    $('.tooltip-inner').text(hide_tovar_text);
                                }
                                $this.next().attr('checked', false).end().closest('td').next().children().addClass('disabled').attr('disabled', 'disabled');
                                if ($this.attr('data-page') != undefined)
                                    $('.setHit, .setHot, .setAction').addClass('disabled').attr('disabled', 'disabled')
                            }
                        }
                    });
                }
                $(window).load(function() {
                    number_tooltip_live();
                    prod_on_off();
                })
                base_url = '{/literal}{$BASE_URL}';

                var elfToken = '{echo $CI->lib_csrf->get_token()}';
            </script>
            <div id="jsOutput" style="display: none;"></div>
        </body>
    </html>