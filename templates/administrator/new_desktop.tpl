<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css">
    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">

                    <a href="/admin" class="logo span3">
                        <img src="{$THEME}img/logo.png"/>
                    </a>
                    <div class="pull-right span3">
                        <div class="clearfix">
                            <div class="pull-left m-r_10">{lang('Hello','admin')}, <a href="#">Admin<i class="my_icon exit_ico"></i></a></div>
                            <div class="pull-right m-l_10">{lang('View','admin')} <a href="{$BASE_URL}" target="_blank">{lang('site','admin')} <span class="f-s_14">→</span></a></div>
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
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-bask active"></i>
                                <span class="badge badge-important">6</span>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-report_exists"></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-callback"></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-comment_head"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </header>
            <div class="frame_nav header-menu-out">
                <div class="container">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav">
                            <li ><a href="/admin/pages"><i class="icon-home"></i><span>{lang('Main','admin')}</span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i>{lang("Content","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/pages">{lang("Create","admin")}</a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0">{lang('All content by categories','admin')}</a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0">{lang("Without a category","admin")}</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/components/cp/cfcm">{lang("Field constructor","admin")}</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i>{lang("Categories","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/categories/create_form">{lang("Create","admin")}</a></li>
                                    <li><a href="/admin/categories/cat_list">{lang("Editing","admin")}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>{lang("Menu","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">

                                    <li><a href="/admin/components/cp/menu">{lang("Management","admin")}</a></li>
                                    <li class="divider"></li>
                                    {foreach $menus as $menu}
                                        <li><a href="/admin/components/cp/menu/menu_item/{$menu.name}">{$menu.main_title}</a></li>
                                    {/foreach}

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i>{lang("Modules","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/components/modules_table/">{lang("All modules","admin")}</a></li>
                                    <li><a href="/admin/mod_search/">{lang("Search","admin")}</a></li>
                                    <li class="divider returnFalse"></a></li>
                                    {if $components}
                                        {foreach $components as $component}
                                            {if $component['installed'] == TRUE AND $component['admin_file'] == 1}
                                                <li><a href="/admin/components/cp/{$component.com_name}">{$component.menu_name}</a></li>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i>{lang("Widgets","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/widgets_manager/create_tpl">{lang("Create","admin")}</a></li>
                                    <li><a href="/admin/widgets_manager">{lang("Editing","admin")}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i>{lang("System","admin")}<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/settings">{lang("Site settings","admin")}</a></li>
                                    <li><a href="/admin/languages">{lang("Languages","admin")}</a></li>
                                    <li class="dropdown"><a class="returnFalse arrow-right" href="">{lang("Cache","admin")}</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:delete_cache('all')">{lang("Clear all","admin")}</a></li>
                                            <li><a href="javascript:delete_cache('expried')">{lang("Clear old or Delete outdated posts or information","admin")}</a></li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/admin_logs">{lang("Event journal","admin")}</a></li>
                                    <li><a href="/admin/backup">{lang("Backup copying","admin")}</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-small pull-right btn-info" href="#">{lang('Administrate site','admin')} <span class="f-s_14">→</span></a>
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
                        {lang('Interface','admin')}:
                        <div class="dropup d-i_b">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                {lang('Russian','admin')}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">{lang('English','admin')}</a></li>
                                <li><a href="#">{lang('Russian','admin')}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        {lang('Version','admin')}: <b>3.01.26</b>
                        <div class="muted">{lang('Help us get better','admin')} - <a href="#">{lang('report an error','admin')}</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © imageCMS 2013</div>
                        <a href="http://docs.imagecms.net" target="blank">{lang('Documentation','admin')}</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{$THEME}js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery.form.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>
        <script src="{$THEME}js/functions.js" type="text/javascript"></script>
        <script src="{$THEME}js/admin_base.js" type="text/javascript"></script>
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