<!DOCTYPE html>
<html>
    <head>
        <title>{lang('a_controll_panel')} | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="{lang('a_controll_panel')} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-notify.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.23.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">
    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">

                    <a href="/admin/dashboard" class="logo span3">
                        <img src="{$THEME}/img/logo.png"/>
                    </a>
                    
                    {if $CI->dx_auth->is_logged_in()}
                    <div class="pull-right span3">
                        <div class="clearfix">
                            <div class="pull-left m-r_10">{lang('a_wellcome')}, 
                                {if $CI->dx_auth->get_username()}
                                <a href="/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}">
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

                            <a href="/admin/components/run/shop/orders/index" class="btn btn-large" data-title="Заказы" data-rel="tooltip" data-original-title="Заказы">
                                <i class="icon-bask "></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="{lang('a_product_no_icon')}" data-rel="tooltip" data-original-title="">
                                <i class="icon-report_exists"></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="Callback" data-rel="tooltip" data-original-title="Callback">
                                <i class="icon-callback "></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="Запросы об уведомлении" data-rel="tooltip" data-original-title="Запросы об уведомлении">
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
                                    <li><a href="/admin/pages/GetPagesByCategory/">{lang('a_cont_list')}</a></li>
                                    <li><a href="/admin/pages">{lang('a_create_page')}</a></li>
                                    
                                    <li class="divider"></li>
                                    <li><a href="/admin/components/cp/cfcm" class="ajax_load">{lang('a_field_constructor')}</a></li>

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
                                    <li><a href="/admin/settings">{lang('a_site_settings')}</a></li>
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
                                Русский
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Английский</a></li>
                                <li><a href="#">Русский</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        {lang('a_version')}: <b>{echo getCMSNumber()}</b>
                        <div class="muted">Помогите нам стать еще лучше - <a href="#">сообщите об ошибке</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © ImageCMS 2012</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        
        <script>
            {if $CI->dx_auth->is_logged_in()}
            var userLogined = true;
            {else:}
            var userLogined = false;
            {/if}
        </script>
        
        <script src="{$THEME}/js/jquery-1.8.0.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}/js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery.form.js" type="text/javascript"></script>
        <script type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script src="{$THEME}/js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <script src="/js/jqupload/js/jquery.fileupload.js" type="text/javascript"></script>
        <script src="/js/jqupload/js/jquery.iframe-transport.js" type="text/javascript"></script>
        <script src="/js/jqupload/js/main.js" type="text/javascript"></script>
        <script src="/js/jqupload/js/jquery.fileupload-ui.js" type="text/javascript"></script>

        <script src="{$THEME}/js/functions.js" type="text/javascript"></script>
        <script src="{$THEME}/js/scripts.js" type="text/javascript"></script>

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
            
            {literal}

            $(document).ready(function(){
            		
                if (!isShop)
                {
                    $('#shopAdminMenu').hide();
                    $('#topPanelNotifications').hide();   
                }
                else
                    $('#baseAdminMenu').hide();
            		
            	
                //menu active sniffer
                $('a.pjax').live('click', function(e){
                    $('nav li').removeClass('active');
                    $(this).closest('li').addClass('active').closest('li.dropdown').addClass('active').removeClass('open');
                    $.pjax({url: $(this).attr('href'), container:'#mainContent'});
                    return false;
                })
            })

            base_url = '{/literal}{$BASE_URL}{literal}';
        </script>
        {/literal}
        <div id="jsOutput" style="display: none;"></div>
    </body>
</html>