<!DOCTYPE html>
<html>
    <head>
        <title>{lang('a_controll_panel')} | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="{lang('a_controll_panel')} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="ImageCMS">

        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-notify.css">
        <!--
       <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.23.custom.css">
        -->

        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">

        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />
        <!-- 
        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        -->
        <link rel="stylesheet" type="text/css" href="/js/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">




        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">


    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                {if $ADMIN_URL}
                <a href="{$ADMIN_URL}dashboard" class="logo span3 pjax">
                    {else:}
                    <a href="/admin/dashboard" class="logo span3 pjax">
                        {/if}
                        <img src="{$THEME}/img/logo.png" style="margin-top: 19px;" />
                    </a>
                    <section class="container">

                        {if $CI->dx_auth->is_logged_in()}
                        <div class="pull-right span3">
                            <div class="clearfix">
                                <div class="pull-left m-r_10">{lang('a_wellcome')}, 
                                    {if $CI->dx_auth->get_username()}
                                    <a href="/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}" id="user_name">
                                        {echo $CI->dx_auth->get_username()}
                                    </a>
                                    <a href="/admin/logout"><i class="my_icon exit_ico"></i></a>
                                    {else:}
                                    {echo lang('a_guest')}
                                    {/if}
                                </div>
                                <div class="pull-right m-l_10">Просмотр <a href="{$BASE_URL}" target="_blank">сайта <span class="f-s_14">→</span></a></div>
                            </div>
                            <form method="get" action="/admin/admin_search">
                                <div class="input-append search">
                                    <button type="submit" class="btn pull-right"><i class="icon-search"></i></button>
                                    <div class="o_h">
                                        <input id="appendedInputButton" name="q" size="16" type="text" class="input-large" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]' autocomplete="off" tabindex="1">
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div class="btn-group" id="topPanelNotifications" style="display: none;">
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


                    </section>
            </header>

            {if $CI->dx_auth->is_logged_in()}
            <div class="frame_nav" id="mainAdminMenu">
                <div class="container" id="baseAdminMenu">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav">
                            <li ><a href="/admin/dashboard"><i class="icon-home"></i><span>Главная</span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i>{lang('a_cont')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/pages/GetPagesByCategory/" class="pjax">{lang('a_cont_list')}</a></li>
                                    <li><a href="/admin/pages" class="pjax">{lang('a_create_page')}</a></li>

                                    <li class="divider"></li>
                                    <li><a href="/admin/components/cp/cfcm" class="pjax">{lang('a_field_constructor')}</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i>{lang('a_categories')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/categories/create_form">{lang('a_create')}</a></li>
                                    <li><a href="/admin/categories/cat_list">{lang('a_edit')}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>{lang('a_menu')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">

                                    {if !$menus}
                                    {$CI->load->module('menu'); $menus=$CI->menu->get_all_menus()}
                                    {/if}
                                    <li><a href="/admin/components/cp/menu" class="ajax_load">{lang('a_control')}</a></li>
                                    <li class="divider"></li>
                                    {foreach $menus as $menu}
                                    <li><a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="ajax_load">{$menu.main_title}</a></li>
                                    {/foreach}

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i>{lang('a_modules')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/components/modules_table/">{lang('a_all_modules')}</a></li>
                                    <!-- <li><a href="/admin/mod_search/">{lang('a_search')}</a></li> -->
                                    <li class="divider returnFalse"></a></li>
                                    {if !$components}
                                    {$CI->load->module('admin/components'); $components = $CI->components->find_components(TRUE)}
                                    {/if}
                                    {foreach $components as $component}
                                    {if $component['installed'] == TRUE AND $component['admin_file'] == 1}
                                    <li><a href="/admin/components/cp/{$component.com_name}">{$component.menu_name}</a></li>
                                    {/if}
                                    {/foreach}
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i>{lang('a_widgets')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/widgets_manager/create_tpl">{lang('a_create')}</a></li>
                                    <li><a href="/admin/widgets_manager">{lang('a_edit')}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i>{lang('a_system')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/settings">{lang('a_sett_global_sett_menu')}</a></li>
                                    <li><a href="/admin/components/cp/template_editor">Редактор шаблонов</a></li>
                                    <li><a href="/admin/languages">{lang('a_languages')}</a></li>
                                    <li><a href="/admin/cache_all">{lang('a_cache')}</a></li>
                                    <!--                                    <li class="dropdown"><a class="returnFalse arrow-right" href="">{lang('a_cache')}</a>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a href="javascript:delete_cache('all')">{lang('a_clean_all')}</a></li>
                                                                                <li><a href="javascript:delete_cache('expried')">{lang('a_clean_old')}</a></li>
                                                                            </ul>
                                                                        </li>-->
                                    <li class="divider"></li>
                                    <li><a href="/admin/admin_logs">{lang('a_event_journal')}</a></li>
                                    <li><a href="/admin/backup">{lang('a_backup_copy')}</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#">Администрировать магазин <span class="f-s_14">→</span></a>
                    </nav>
                </div>

                <div style="display:none;" class="container" id="shopAdminMenu"  > {include_tpl('shop_menu.tpl')} </div>
            </div>
            {/if}
            <div id="loading" style=" display: none; background: url(/templates/administrator/images/ajax-loader.gif) no-repeat 50% 20px; z-index: 10000; position: absolute; height: 600px; width: 100%; background-color: rgba(255, 255, 255, 0.7);"></div>
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
                        <div class="muted">Copyright © ImageCMS 2012</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <div id="elfinder"></div>
        <div class="standart_form frame_rep_bug">
            <form method="post" action="">
                <label>
                    {lang('a_your_remark')}:
                    <textarea></textarea>
                </label>
                <input type="submit" value="{lang('a_send')}" class="btn btn-info"/>
                <input type="hidden" value="{$_SERVER['REMOTE_ADDR']}" id="ip_address"/>

            </form>
        </div>
        <script>
            {if $CI->dx_auth->is_logged_in()}
            var userLogined = true;
            {else:}
            var userLogined = false;
            {/if}
        </script>

        <script src="{$THEME}/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery.form.js" type="text/javascript"></script>        
        <!-- 
        <script type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        -->

        <script src="{$THEME}/js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
        <!-- 
                <script src="/js/jqupload/js/jquery.fileupload.js" type="text/javascript"></script>
                <script src="/js/jqupload/js/jquery.iframe-transport.js" type="text/javascript"></script>
                <script src="/js/jqupload/js/main.js" type="text/javascript"></script>
                <script src="/js/jqupload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
        -->
        <script src="{$THEME}/js/functions.js" type="text/javascript"></script>
        <script src="{$THEME}/js/scripts.js" type="text/javascript"></script>

        <script type="text/javascript" src="/js/elrte-1.3/js/elrte.min.js"></script>
        <script type="text/javascript" src="/js/elfinder-2.0/js/elfinder.min.js"></script>

        <script src="{$THEME}/js/admin_base_i.js" type="text/javascript"></script>        
        <script src="{$THEME}/js/admin_base_m.js" type="text/javascript"></script>        
        <script src="{$THEME}/js/admin_base_v.js" type="text/javascript"></script>        
        <script src="{$THEME}/js/admin_base_y.js" type="text/javascript"></script>
        <script src="{$THEME}/js/admin_base_r.js" type="text/javascript"></script>    

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

            $(document).ready(function(){
            		
                if (!isShop)
                {
                    $('#shopAdminMenu').hide();
                    $('#topPanelNotifications').hide();   
                }
                else
                    $('#baseAdminMenu').hide();
            })
            
            function number_tooltip_live(){
                $('.number input').each(function(){
                    $(this).attr({
                        'data-placement':'top', 
                        'data-title': lang_only_number
                    });
                })
                number_tooltip();
            }
            function prod_on_off(){
                $('.prod-on_off').unbind('click').on('click', function(){
                    var $this = $(this);
                    if (!$this.hasClass('disabled')){
                        if ($this.hasClass('disable_tovar')){
                            $this.animate({
                                'left': '0'
                            }, 200).removeClass('disable_tovar');
                            $this.parent().attr('data-original-title', show_tovar_text)
                            $('.tooltip-inner').text(show_tovar_text);
                            $this.parents('td').next().children().removeClass('disabled');
                        }
                        else{
                            $this.animate({
                                'left': '-28px'
                            }, 200).addClass('disable_tovar');
                            $this.parent().attr('data-original-title', hide_tovar_text)
                            $('.tooltip-inner').text(hide_tovar_text);
                            $this.parents('td').next().children().addClass('disabled');
                        }
                    }
                });
            }
            $(window).load(function(){
                number_tooltip_live();
                prod_on_off();
            })
            base_url = '{/literal}{$BASE_URL}{literal}';
        </script>
        {/literal}
        <div id="jsOutput" style="display: none;"></div>
    </body>
</html>