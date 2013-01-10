<!DOCTYPE html>
<html>
    <head>
        <title><?php echo lang ('a_controll_panel'); ?> | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="<?php echo lang ('a_controll_panel'); ?> - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="ImageCMS">

        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>/css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">


        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">

    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container"> 
                    <?php if($ADMIN_URL): ?>
                        <a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>dashboard" class="logo pull-left pjax">
                        <?php else:?>
                            <a href="/admin/dashboard" class="logo pull-left pjax">
                            <?php endif; ?>
                            <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/img/logo.png"/>
                        </a>

                        <?php if($CI->dx_auth->is_logged_in()): ?>
                            <div class="pull-right span4">
                                <div class="clearfix">
                                    <span class="m-r_10">
                                        <?php echo lang ('a_wellcome'); ?>,
                                        <?php if($CI->dx_auth->get_username()): ?>
                                            <a href="/admin/components/run/shop/users/edit/<?php echo $CI->dx_auth->get_user_id()?>" id="user_name">
                                                <?php echo $CI->dx_auth->get_username()?>
                                            </a>
                                            <a href="/admin/logout"><i class="my_icon exit_ico"></i></a>
                                        <?php else:?>
                                            <?php echo lang('a_guest')?>
                                        <?php endif; ?>
                                    </span>
                                    <span class="m-l_10">Просмотр <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>" target="_blank">сайта <span class="f-s_14">→</span></a></span>
                                </div>
                                <form method="get" action="<?php if($ADMIN_URL): ?>/admin/components/run/shop/search/advanced<?php else:?>/admin/admin_search<?php endif; ?>" id="adminAdvancedSearch">
                                    <div class="input-append search">
                                        <button id="adminSearchSubmit" type="submit" class="btn pull-right"><i class="icon-search"></i></button>
                                        <div class="o_h">
                                            <input id="<?php if($ADMIN_URL): ?>shopSearch<?php else:?>baseSearch<?php endif; ?>" name="q" size="16" type="text"  autocomplete="off" tabindex="1" value="<?php echo $_GET['q']; ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <?php if(SHOP_INSTALLED): ?>
                                <div class="btn-group" id="topPanelNotifications" style="display: none;">
                                    <div class="span4 d-i_b">
                                        <a href="/admin/components/run/shop/orders/index" class=" pjax btn btn-large" data-title="Заказы" data-rel="tooltip" data-original-title="Заказы">
                                            <i class="icon-bask "></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="<?php echo lang ('a_product_no_icon'); ?>" data-rel="tooltip" data-original-title="">
                                            <i class="icon-report_exists"></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="Callback" data-rel="tooltip" data-original-title="Callback">
                                            <i class="icon-callback "></i>
                                        </a>
                                        <a href="/admin/components/cp/comments" class="btn btn-large pjax" data-title="<?php echo lang ('a_last_comm'); ?>" data-rel="tooltip" data-original-title="<?php echo lang ('a_last_comm'); ?>">
                                            <i class="icon-comment_head "></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>


                </section>
            </header>

            <?php if($CI->dx_auth->is_logged_in()): ?>
                <div class="frame_nav" id="mainAdminMenu">
                    <div class="container" id="baseAdminMenu">
                        <nav class="navbar navbar-inverse">
                            <ul class="nav">
                                <li class="homeAnchor"><a href="/admin/dashboard" class="pjax"><i class="icon-home"></i><span>Главная</span></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i><?php echo lang ('a_cont'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/pages/GetPagesByCategory/" class="pjax"><?php echo lang ('a_cont_list'); ?></a></li>
                                        <li><a href="/admin/pages" class="pjax"><?php echo lang ('a_create_page'); ?></a></li>

                                        <li class="divider"></li>
                                        <li class="nav-header"><?php echo lang ('a_field_constructor'); ?></li>
                                        <li><a href="/admin/components/cp/cfcm/index#additional_fields" class="pjax">Список полей</a></li>
                                        <li><a href="/admin/components/cp/cfcm/index#fields_groups" class="pjax">Список груп</a></li>
                                        <!--<li><a href="/admin/components/cp/cfcm" class="pjax"><?php echo lang ('a_field_constructor'); ?></a></li>-->

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i><?php echo lang ('a_categories'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/categories/create_form" class="pjax"><?php echo lang ('a_create'); ?></a></li>
                                        <li><a href="/admin/categories/cat_list" class="pjax"><?php echo lang ('a_edit'); ?></a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i><?php echo lang ('a_menu'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">

                                        <?php if(!$menus): ?>
                                            <?php $CI->load->module('menu'); $menus=$CI->menu->get_all_menus()?>
                                        <?php endif; ?>
                                        <li><a href="/admin/components/cp/menu" class="pjax"><?php echo lang ('a_control'); ?></a></li>
                                        <li class="divider"></li>
                                        <?php if(is_true_array($menus)){ foreach ($menus as $menu){ ?>
                                            <li><a href="/admin/components/cp/menu/menu_item/<?php echo $menu['name']; ?>" class="pjax"><?php echo $menu['main_title']; ?></a></li>
                                        <?php }} ?>

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i><?php echo lang ('a_modules'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/components/modules_table/" class="pjax"><?php echo lang ('a_all_modules'); ?></a></li>
                                        <!-- <li><a href="/admin/mod_search/"><?php echo lang ('a_search'); ?></a></li> -->
                                        <li class="divider returnFalse"></a></li>
                                        <?php if(!$components): ?>
                                            <?php $CI->load->module('admin/components'); $components = $CI->components->find_components(TRUE)?>
                                        <?php endif; ?>
                                        <?php if(is_true_array($components)){ foreach ($components as $component){ ?>
                                            <?php if($component['installed'] == TRUE AND $component['admin_file'] == 1): ?>
                                                <li><a href="/admin/components/cp/<?php echo $component['com_name']; ?>" class="pjax"><?php echo $component['menu_name']; ?></a></li>
                                            <?php endif; ?>
                                        <?php }} ?>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i><?php echo lang ('a_widgets'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/widgets_manager/create_tpl" class="pjax"><?php echo lang ('a_create'); ?></a></li>
                                        <li><a href="/admin/widgets_manager" class="pjax"><?php echo lang ('a_edit'); ?></a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i><?php echo lang ('a_system'); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/settings" class="pjax"><?php echo lang ('a_sett_global_sett_menu'); ?></a></li>
                                        <li><a href="/admin/components/cp/template_editor" class="pjax">Редактор шаблонов</a></li>
                                        <li><a href="/admin/languages" class="pjax"><?php echo lang ('a_languages'); ?></a></li>
                                        <li><a href="/admin/cache_all" class="pjax"><?php echo lang ('a_cache'); ?></a></li>

                                        <li class="divider"></li>
                                        <li><a href="/admin/admin_logs" class="pjax"><?php echo lang ('a_event_journal'); ?></a></li>
                                        <li><a href="/admin/backup" class="pjax"><?php echo lang ('a_backup_copy'); ?></a></li>
                                        <li><a href="/admin/rbac/roleList" class="pjax">Список ролей</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php if(SHOP_INSTALLED): ?>
                                <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#">Администрировать магазин <span class="f-s_14">→</span></a>
                            <?php endif; ?>
                        </nav>
                    </div>

                    <?php if(SHOP_INSTALLED): ?>
                        <div style="display:none;" class="container" id="shopAdminMenu"  > <?php $this->include_tpl('shop_menu.tpl', 'C:\wamp\www\imagecms.loc\templates\administrator'); ?> </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div id="loading"></div>
            <div class="container" id="mainContent">
                <?php if(isset($content)){ echo $content; } ?>
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
                                <?php echo lang ('a_'.$this->CI->config->item('language')); ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/settings/switch_admin_lang/english"><?php echo lang ('a_english'); ?> (beta)</a></li>
                                <li><a href="/admin/settings/switch_admin_lang/russian"><?php echo lang ('a_russian'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        <?php echo lang ('a_version'); ?>: <b><?php echo getCMSNumber()?></b>
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
                    <?php echo lang ('a_your_remark'); ?>:
                    <textarea></textarea>
                </label>
                <input type="submit" value="<?php echo lang ('a_send_report'); ?>" class="btn btn-info"/>
                <input type="button" value="<?php echo lang ('a_cancel'); ?>" class="btn btn-info" style="float:right" name="cancel_button"/>
                <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" id="ip_address"/>
            </form>
        </div>
        <script>
            <?php if($CI->dx_auth->is_logged_in()): ?>
                var userLogined = true;
            <?php else:?>
                var userLogined = false;
            <?php endif; ?>
                
                var locale = '<?php echo $this->CI->config->item('language')?>';
        </script>

        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/jquery.form.js" type="text/javascript"></script>        

        <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/functions.js" type="text/javascript"></script>
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/scripts.js" type="text/javascript"></script>

        <script type="text/javascript" src="/js/elrte-1.3/js/elrte.min.js"></script>
        <script type="text/javascript" src="/js/elfinder-2.0/js/elfinder.min.js"></script>


        <?php if($this->CI->config->item('language') == 'russian'): ?>
            <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/jquery-validate/messages_ru.js" type="text/javascript"></script>
            <script type="text/javascript" src="/js/elrte-1.3/js/i18n/elrte.ru.js"></script>
            <script type="text/javascript" src="/js/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
        <?php endif; ?>

        
        <!--
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base.min.js" type="text/javascript"></script>       
        -->
        
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base_i.js" type="text/javascript"></script>       
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base_m.js" type="text/javascript"></script>       
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base_r.js" type="text/javascript"></script>       
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base_v.js" type="text/javascript"></script>       
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>/js/admin_base_y.js" type="text/javascript"></script>       

        <script>
            <?php if($CI->uri->segment('4') == 'shop'): ?>
                var isShop = true;
            <?php else:?>
                var isShop = false;
            <?php endif; ?>
                var lang_only_number = "<?php echo lang ('a_numbers_only'); ?>";
                var show_tovar_text = "<?php echo lang ('a_show'); ?>";
                var hide_tovar_text = "<?php echo lang ('a_dont_show'); ?>";

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
                $('.prod-on_off').die('click').live('click', function(){
                    var $this = $(this);
                    if (!$this.hasClass('disabled')){
                        if ($this.hasClass('disable_tovar')){
                            $this.animate({
                                'left': '0'
                            }, 200).removeClass('disable_tovar');
                            if ($this.parent().data('only-original-title') == undefined){
                                $this.parent().attr('data-original-title', show_tovar_text)
                                $('.tooltip-inner').text(show_tovar_text);
                            }
                            $this.closest('td').next().children().removeClass('disabled').removeAttr('disabled');
                        }
                        else{
                            $this.animate({
                                'left': '-28px'
                            }, 200).addClass('disable_tovar');
                            if ($this.parent().data('only-original-title') == undefined){
                                $this.parent().attr('data-original-title', hide_tovar_text)
                                $('.tooltip-inner').text(hide_tovar_text);
                            }
                            $this.closest('td').next().children().addClass('disabled').attr('disabled','disabled');
                        }
                    }
                });
            }
            $(window).load(function(){
                number_tooltip_live();
                prod_on_off();
            })
            base_url = '<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>';
            
            var elfToken = '<?php echo $CI->lib_csrf->get_token()?>';
            </script>
        
        <div id="jsOutput" style="display: none;"></div>
    </body>
</html><?php $mabilis_ttl=1357909077; $mabilis_last_modified=1357742253; //C:\wamp\www\imagecms.loc\/templates/administrator/main.tpl ?>