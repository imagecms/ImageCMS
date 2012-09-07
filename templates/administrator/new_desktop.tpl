<!DOCTYPE html>
<html>

    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-responsive.css">
    </head>
    <body>
        <div class="main_body">
            <header>
                <section class="container">

                    <a href="#" class="logo span3">
                        <img src="{$THEME}/img/logo.png"/>
                    </a>
                    <div class="pull-right span3">
                        <div class="clearfix">
                            <div class="pull-left">Здравствуйте, <a href="#">Admin<i class="my_icon exit_ico"></i></a></div>
                            <div class="pull-right">Просмотр <a href="#">сайта <span class="f-s_14">→</span></a></div>
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
                            <li class="active"><a href="/admin/pages"><i class="icon-home"></i><span>Главная</span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i>Содержимое<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a id="add_page_link" href="/admin/pages">{lang('a_create')}</a></li>
									<li><a id="" href="/admin/pages/GetPagesByCategory/0" class="returnFalse" >{lang('a_without_cat')}</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i>Категории<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/sys_info">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>Меню<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                </ul>
                            </li>
                            <li class="dropdown active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i>Модули<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i>Виджеты<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i>Система<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-small pull-right btn-info" href="#">Администрировать сайт <span class="f-s_14">→</span></a>
                    </nav>
                </div>
            </div>
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="#">Главная</a> <span class="divider">/</span></li>
                    <li class="active">Список товаров</li>
                </ul>
                <section class="mini-layout" id="mainLayout">
                
                </section>
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
                        <a href="/admin/pages">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{$THEME}/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}/js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src="{$THEME}/js/scripts.js" type="text/javascript"></script>
         {literal}
         <script>
         $(document).ready(function(){
        
        	 $('ul li ul a').on('click', function(e){
            	 $('#mainLayout').load($(this).attr('href'));
//            	 alert(0);
                 window.history.pushState(null, 'test', $(this).attr('href'));
            	 return false;
             })
         })
         
         
         </script>
         }
         {/literal} 
    </body>
</html>