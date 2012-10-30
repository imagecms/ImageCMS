<!DOCTYPE html>
<html>

    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-notify.css">
    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">

                    <a href="/admin" class="logo span3">
                        <img src="{$THEME}/img/logo.png"/>
                    </a>
                    <div class="pull-right span3">
                        <div class="clearfix">
                            <div class="pull-left">Здравствуйте, <a href="#">Admin<i class="my_icon exit_ico"></i></a></div>
                            <div class="pull-right">Просмотр <a href="{$BASE_URL}" target="_blank">сайта <span class="f-s_14">→</span></a></div>
                        </div>
                        <form method="post" action="#">
                            <div class="input-append search">
                                <button class="btn pull-right"><i class="icon-search"></i></button>
                                <div class="o_h">
                                    <input id="appendedInputButton" size="16" type="text" class="input-large" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]' autocomplete="off" tabindex="1">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="btn-group">
                        <div class="span4 d-i_b">
                            <a href="#" class="btn btn-large">
                                <i class="icon-bask active"></i>
                                <span class="badge badge-important">6</span>
                            </a>
                            <a href="#" class="btn btn-large">
                                <i class="icon-report_exists"></i>
                            </a>
                            <a href="#" class="btn btn-large">
                                <i class="icon-callback"></i>
                            </a>
                            <a href="#" class="btn btn-large">
                                <i class="icon-comment_head"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </header>
            <div class="frame_nav">
                <div class="container">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav">
                            <li ><a href="/admin/pages"><i class="pjax icon-home"></i><span>Главная</span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i>{lang('a_content')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/pages" class="pjax">{lang('a_create')}</a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0" class="pjax" >Все содержимое по категориях</a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0" class="pjax" >{lang('a_without_cat')}</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/components/cp/cfcm" class="pjax">{lang('a_field_constructor')}</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i>{lang('a_categories')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/categories/create_form" class="pjax">{lang('a_create')}</a></li>
                                    <li><a href="/admin/categories/cat_list" class="pjax">{lang('a_edit')}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>{lang('a_menu')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">

                                    <li><a href="/admin/components/cp/menu" class="pjax">{lang('a_control')}</a></li>
                                    <li class="divider"></li>
                                    {foreach $menus as $menu}
                                        <li><a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="pjax	">{$menu.main_title}</a></li>
                                    {/foreach}

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i>{lang('a_modules')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/components/modules_table/" class="pjax">{lang('a_all_modules')}</a></li>
                                    <li><a href="/admin/mod_search/" class="pjax">{lang('a_search')}</a></li>
                                    <li class="divider returnFalse"></a></li>
                                    {if $components}
                                        {foreach $components as $component}
                                            {if $component['installed'] == TRUE AND $component['admin_file'] == 1}
                                                <li><a href="/admin/components/cp/{$component.com_name}" class="pjax" >{$component.menu_name}</a></li>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i>{lang('a_widgets')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/widgets_manager/create_tpl" class="pjax">{lang('a_create')}</a></li>
                                    <li><a href="/admin/widgets_manager" class="pjax">{lang('a_edit')}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i>{lang('a_system')}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/settings" class="pjax">{lang('a_sett_global_sett_menu')}</a></li>
                                    <li><a href="/admin/languages" class="pjax">{lang('a_languages')}</a></li>
                                    <li class="dropdown"><a class="returnFalse arrow-right" href="">{lang('a_cache')}</a>
                                        <ul class="dropdown-menu">
                                            <li><a  href="javascript:delete_cache('all')">{lang('a_clean_all')}</a></li>
                                            <li><a  href="javascript:delete_cache('expried')">{lang('a_clean_old')}</a></li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/admin_logs" class="pjax">{lang('a_event_journal')}</a></li>
                                    <li><a href="/admin/backup" class="pjax">{lang('a_backup_copy')}</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-small pull-right btn-info" href="#">Администрировать сайт <span class="f-s_14">→</span></a>
                    </nav>
                </div>
            </div>
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
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Русский
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Английский</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        Версия: <b>3.01.26</b>
                        <div class="muted">Помогите нам стать еще лучше - <a href="#">сообщите об ошибке</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © imageCMS 2012</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{$THEME}/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery.form.js" type="text/javascript"></script>
        <script src="{$THEME}/js/scripts.js" type="text/javascript"></script>
        <script src="{$THEME}/js/functions.js" type="text/javascript"></script>
        {literal}
            <script>

            $(document).ready(function(){
                    //menu active sniffer
                    $('a.pjax').on('click', function(e){
                            $('nav li').removeClass('active');
                            $(this).closest('li').addClass('active').closest('li.dropdown').addClass('active').removeClass('open');
                            $.pjax({url: $(this).attr('href'), container:'#mainContent'});
                    return false;
                })
            })


            </script>
            }
        {/literal}
        <div id="jsOutput" style="display: none;"></div>
    </body>
</html>