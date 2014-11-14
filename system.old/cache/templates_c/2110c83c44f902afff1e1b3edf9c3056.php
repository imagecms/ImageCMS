<!DOCTYPE html>
<html>
    <head>
        <title><?php echo lang ("Operation panel","admin"); ?> | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content="<?php echo lang ("Operation panel","admin"); ?> - Image CMS" />
        <meta name="generator" content="ImageCMS">

        <link rel="icon" type="image/x-icon" href="<?php if(isset($THEME)){ echo $THEME; } ?>images/<?php if(MAINSITE): ?>premmerce_<?php endif; ?>favicon.png"/>

        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">

        <link rel="stylesheet" type="text/css" href="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">
        <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
    </head>
    <body>
            <style>
                .imagecms-close{cursor: pointer;position: absolute;right: -100px;top: 0;height: 31px;background-color: #4e5a68;width: 95px;display: none;z-index: 3;}
                .imagecms-top-fixed-header.imagecms-active{height: 31px;background-color: #37414d;}
                .imagecms-toggle-close-text{color: #fff;}
                .imagecms-top-fixed-header.imagecms-active + .main_body header{padding-top: 31px;}
                .imagecms-top-fixed-header{height: 0;position: fixed;top: 0;left: 0;width: 100%;font-family: Arial, sans-serif;font-size: 12px;color: #223340;vertical-align: baseline;z-index: 1000}
                .imagecms-top-fixed-header .container{position: relative;}
                .imagecms-logo{float: left;}
                .imagecms-ref-skype, .imagecms-phone{font-size: 0;}
                .imagecms-phone{margin-right: 32px;}
                .imagecms-phone .imagecms-text-el{font-size: 12px;color: #fff;}
                .imagecms-ref-skype .imagecms-text-el{font-size: 12px;color: #fff;}
                .imagecms-ref-skype{color: #223340;text-decoration: none;}
                .imagecms-ref-skype:hover{color: #223340;text-decoration: none;}
                .imagecms-list{list-style: none;margin: 0;float: left;display: none;}
                .imagecms-list > li{height: 31px;vertical-align: top;padding: 0 23px;text-align: left;border-right: 1px solid #525f6f;display: inline-block;}
                .imagecms-list > li > a{line-height: 31px;}
                .imagecms-list > li:first-child{border-left: 1px solid #525f6f;}
                .imagecms-ref{color: #fff;text-decoration: none;text-transform: uppercase;font-size: 11px;}
                .imagecms-ref:hover{color: #fff;text-decoration: none;}
                .imagecms-ico-phone, .imagecms-ico-skype{width: auto !important;height: auto !important;position: relative !important;vertical-align: baseline;}
                .imagecms-ico-skype{position: relative;top: 3px;margin-right: 10px;}
                .imagecms-ico-phone{position: relative;top: 2px;margin-right: 6px;}
                .imagecms-buy-license > a{text-decoration: none;height: 100%;display: block;padding: 0 20px;font-size: 0;}
                .imagecms-buy-license > a > .imagecms-text-el{color: #fff;font-weight: normal;font-size: 11px;line-height: 31px;text-transform: uppercase;}
                .imagecms-buy-license{
                    display: none;float: right;height: 31px;box-shadow: 0 1px 1px rgba(0,0,0,.1);
                    background: #0eb48e; /* Old browsers */
                    background: -moz-linear-gradient(top,  #0eb48e 0%, #09a77d 100%); /* FF3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0eb48e), color-stop(100%,#09a77d)); /* Chrome,Safari4+ */
                    background: -webkit-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Chrome10+,Safari5.1+ */
                    background: -o-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Opera 11.10+ */
                    background: -ms-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* IE10+ */
                    background: linear-gradient(to bottom,  #0eb48e 0%,#09a77d 100%); /* W3C */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0eb48e', endColorstr='#09a77d',GradientType=0 ); /* IE6-9 */
                }
                .imagecms-contacts{text-align: center;padding-top: 6px;display: none;}
                .imagecms-buy-license .imagecms-text-el{vertical-align: middle;}
                .imagecms-buy-license .imagecms-ico-donwload{vertical-align: middle;margin-left: 11px;}

                .imagecms-active .imagecms-buy-license, .imagecms-active .imagecms-list, .imagecms-active .imagecms-contacts{display: block;}
            </style>
        
        <?php $this->include_tpl('inc/javascriptVars', '/var/www/image-c.loc/templates/administrator'); ?>
        <?php $this->include_tpl('inc/jsLangs.tpl', '/var/www/image-c.loc/templates/administrator'); ?>
        <?php $langDomain = $CI->land->gettext_domain?>
        <?php $CI->lang->load('admin')?>
        <?php if(SHOP_INSTALLED && (trim($content) == 'Строк тестовой лицензии истек' OR trim($content) == 'Ошибка проверки лицензии.')): ?>
            <div class="imagecms-top-fixed-header<?php if($_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL): ?> imagecms-active<?php endif; ?>">
                <div class="imagecms-inside">
                    <div class="container">
                        <button type="button" class="imagecms-close" <?php if($_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL): ?>style="display: block;"<?php endif; ?> onclick="setCookie('condPromoToolbar', '0');
                                $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                                $(this).hide().next().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> Скрыть</span>
                        </button>
                        <button type="button" class="imagecms-close" <?php if($_COOKIE['condPromoToolbar'] == '0'): ?>style="display: block;"<?php endif; ?> onclick="setCookie('condPromoToolbar', '1');
                                $('.imagecms-top-fixed-header').addClass('imagecms-active');
                                $(this).hide().prev().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> Показать</span>
                        </button>
                        <div class="imagecms-buy-license">
                            <a href="http://www.imagecms.net/shop/prices" target="_blank" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', '/shop/prices']);">
                                <span class="imagecms-text-el">Купить лицензицю</span>
                            </a>
                        </div>
                        <ul class="imagecms-list">
                            <li>
                                <a href="http://www.imagecms.net" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', 'obzor-product-shop']);">Обзор продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', '/kliuchevye-preimushchestva/vozmozhnosti']);">преимущества продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/store/category/shoptemplates" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', 'shoptemplates']);"><?php echo lang ('Шаблоны для Shop', 'newLevel'); ?></a>
                            </li>
                        </ul>
                        <div class="imagecms-contacts">
                            <span class="imagecms-phone">
                                <img src="<?php if(isset($THEME)){ echo $THEME; } ?>icon_phone.png" class="imagecms-ico-phone"/>
                                <span class="imagecms-text-el">+7 (499) 703-37-51</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!SHOP_INSTALLED): ?>
            <div class="imagecms-top-fixed-header<?php if($_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL): ?> imagecms-active<?php endif; ?>">
                <div class="imagecms-inside">
                    <div class="container">
                        <button type="button" class="imagecms-close" <?php if($_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL): ?>style="display: block;"<?php endif; ?> onclick="setCookie('condPromoToolbar', '0');
                                $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                                $(this).hide().next().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> <?php echo lang ('Hide', 'admin'); ?></span>
                        </button>
                        <button type="button" class="imagecms-close" <?php if($_COOKIE['condPromoToolbar'] == '0'): ?>style="display: block;"<?php endif; ?> onclick="setCookie('condPromoToolbar', '1');
                                $('.imagecms-top-fixed-header').addClass('imagecms-active');
                                $(this).hide().prev().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> <?php echo lang ('Show', 'admin'); ?></span>
                        </button>
                        <div class="imagecms-buy-license">
                            <a href="http://www.imagecms.net/download/corporate" target="_blank" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/download/corporate']);">
                                <span class="imagecms-text-el">Скачать бесплатно</span>
                            </a>
                        </div>
                        <ul class="imagecms-list">
                            <li>
                                <a href="http://www.imagecms.net/free-cms-corporate" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/free-cms-corporate']);">Обзор продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/corporate-bazovye-vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/corporate-bazovye-vozmozhnosti']);">Базовые возможности</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/blog" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/blog']);">Блог</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="main_body">
            <div id="fixPage"></div>
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">
                    <?php if(SHOP_INSTALLED): ?>
                        <a href="<?php echo base_url ('admin/components/run/shop/dashboard'); ?>" class="logo pull-left pjax">
                        <?php else:?>
                            <a href="/admin/dashboard" class="logo pull-left pjax">
                            <?php endif; ?>
                            <span class="helper"></span>
                            <img src="<?php if(isset($THEME)){ echo $THEME; } ?>img/logo_new.png"/>
                            <?php /*<img src="<?php if(isset($THEME)){ echo $THEME; } ?>img/logo_premmerce.png"/>*/?>
                        </a>

                        <?php if($CI->dx_auth->is_logged_in()): ?>
                            <div class="pull-right span4 f-s_0 right-header">
                                <span class="helper"></span>
                                <ul class="d_i-b f-s_0">
                                    <?php if(MAINSITE): ?>
                                        <?php if(!$isfree): ?>
                                            <li class="btn_header <?php if($daysLeft <= 5): ?>btn_header-danger<?php endif; ?>">
                                                <button type="button">
                                                    <span class="text-el"><?php if(isset($daysLeft)){ echo $daysLeft; } ?> <?php echo lang ("days left", "admin"); ?></span>
                                                </button>
                                            </li>
                                        <?php else:?>
                                            <li class="btn_header">
                                                <button type="button">
                                                    <span class="text-el"><?php echo lang ("Free tarif", "admin"); ?></span>
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php /* <li class="btn_header btn-mail">
                                    <li class="btn_header">
                                        <button type="button">
                                            <span class="text-el"><?php echo lang ("14 days left", "admin"); ?></span>
                                        </button>
                                    </li>
                                    <li class="btn_header btn_header-danger">
                                        <button type="button">
                                            <span class="text-el"><?php echo lang ("5 days left", "admin"); ?></span>
                                        </button>
                                    </li>
                                    <li class="btn_header">
                                        <button type="button">
                                            <span class="text-el"><?php echo lang ("Free tarif", "admin"); ?></span>
                                        </button>
                                    </li>
                                    <li class="btn_header btn-mail">
                                        <a href="#">
                                            <span class="icon_mail">
                                                <span class="badge badge-important">25</span>
                                            </span>
                                        </a>
                                    </li> */?>

                                    <li class="dropdown d-i_b v-a_m">
                                        <a data-toggle="dropdown" class="btn_header btn-personal-area">
                                            <span>
                                                <span class="icon_person"></span>
                                                <span class="icon_arrow"></span>
                                            </span>
                                        </a>
                                        <ul class="frame-dropdown dropdown-menu">
                                            <li class="head">
                                                <?php if($CI->dx_auth->get_username()): ?>
                                                    <?php echo $CI->dx_auth->get_username()?>
                                                <?php else:?>
                                                    <?php echo lang("Guest","admin")?>
                                                <?php endif; ?>
                                            </li>
                                            <?php if($CI->dx_auth->get_username()): ?>
                                                <li>
                                                    <a href="
                                                       <?php if(SHOP_INSTALLED): ?>/admin/components/run/shop/users/edit/<?php echo $CI->dx_auth->get_user_id()?>
                                                       <?php else:?>/admin/components/cp/user_manager/edit_user/<?php echo $CI->dx_auth->get_user_id()?>
                                                       <?php endif; ?>"
                                                       id="user_name">
                                                        <?php echo lang ("Personal data", "admin"); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="/admin/logout">
                                                    <?php echo lang ("Exit", "admin"); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="btn_header">
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>" target="_blank">
                                            <span class="icon_on-site"></span>
                                            <span class="text-el"><?php echo lang ('To the site','admin'); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php if(SHOP_INSTALLED): ?>
                                <div class="frame-quick-access f-s_0" id="topPanelNotifications" style="display: block;">
                                    <span class="helper"></span>
                                    <div class="d-i_b">
                                        <a href="/admin/components/run/shop/orders/index" class="btn-quick-access pjax">
                                            <span class="frame-icon">
                                                <i class="icon-bask"></i>
                                            </span>
                                            <span class="text-el"><?php echo lang ('Orders','admin'); ?></span>
                                        </a>
                                        <a href="/admin/components/cp/comments" class="btn-quick-access pjax">
                                            <span class="frame-icon">
                                                <i class="icon-comment_head"></i>
                                            </span>
                                            <span class="text-el"><?php echo lang ("Comments","admin"); ?></span>
                                        </a>
                                        <a href="#" class="btn-quick-access pjax">
                                            <span class="frame-icon">
                                                <i class="icon-report_exists"></i>
                                            </span>
                                            <span class="text-el"><?php echo lang ("No photo","admin"); ?></span>
                                        </a>
                                        <a href="#" class="btn-quick-access pjax">
                                            <span class="frame-icon">
                                                <i class="icon-callback"></i>
                                            </span>
                                            <span class="text-el"><?php echo lang ("Callback", "admin"); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                </section>
            </header>
            <?php if($CI->dx_auth->is_logged_in()): ?>
                <div class="frame_nav">
                    <?php if(MAINSITE): ?>
                        <?php include(MAINSITE.'/templates/administrator/inc/menus.php');?>
                    <?php else:?>
                        <?php include('templates/administrator/inc/menus.php');?>
                    <?php endif; ?>
                    <?php if(!SHOP_INSTALLED): ?>
                        <table class="container" id="baseAdminMenu">
                            <tbody class="navbar navbar-inverse">
                                <tr>
                                    <?php if(is_true_array($baseMenu)){ foreach ($baseMenu as $li){ ?>
                                        <?php if($li['subMenu']): ?>
                                            <td class="<?php echo $li['class']; ?> <?php if($li['subMenu']): ?> dropdown<?php endif; ?>">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (bool) $li['text'] ? $li['text'] : $li['text']    ?></a>
                                                <ul class="dropdown-menu">
                                                    <?php if(is_true_array($li['subMenu'])){ foreach ($li['subMenu'] as $sli){ ?>
                                                        <?php if($sli['menusList']): ?>
                                                            <?php if(!$menus): ?>
                                                                <?php $CI->load->module('menu'); $menus=$CI->menu->get_all_menus()?>
                                                            <?php endif; ?>
                                                            <li><a href="/admin/components/cp/menu/index" class="pjax"><?php echo lang ("Management","admin"); ?></a></li>
                                                            <li class="divider"></li>
                                                                <?php if(is_true_array($menus)){ foreach ($menus as $menu){ ?>
                                                                <li><a href="/admin/components/cp/menu/menu_item/<?php echo $menu['name']; ?>" class="pjax"><?php echo $menu['main_title']; ?></a></li>
                                                                <?php }} ?>
                                                            <?php endif; ?>
                                                            <?php if($sli['modulesList']): ?>
                                                                <?php if(!$components): ?>
                                                                    <?php $CI->load->module('admin/components'); $components = $CI->components->find_components_for_menu_list(TRUE)?>
                                                                <?php endif; ?>
                                                                <?php if(is_true_array($components)){ foreach ($components as $component){ ?>
                                                                <li><a href="/admin/components/cp/<?php echo $component['name']?>" class="pjax"><?php echo $component['menu_name']?></a></li>
                                                                <?php }} ?>
                                                            <?php endif; ?>

                                                        <li <?php if($sli['divider']): ?> class="divider"<?php endif; ?><?php if($sli['header']): ?> class="nav-header"<?php endif; ?>>
                                                            <?php if($sli['link']  ||  $sli['id']): ?>
                                                                <a 
                                                                    <?php if($sli['link']): ?> href="<?php echo site_url ( $sli['link'] ); ?>" <?php endif; ?>
                                                                    <?php if($sli['id']): ?> id="<?php echo $sli['id']; ?>" <?php endif; ?>
                                                                    <?php if($sli['pjax']  !== FALSE): ?> class="pjax" <?php endif; ?>
                                                                    >
                                                                    <?php echo (bool) $sli['text'] ? $sli['text'] : $sli['text']    ?>
                                                                </a>
                                                            <?php else:?>
                                                                <?php echo (bool) $sli['text']  ?  $sli['text']  :  $sli['text']    ?>
                                                            <?php endif; ?>
                                                        </li>


                                                    <?php }} ?>
                                                </ul>
                                            </td>
                                        <?php endif; ?>
                                    <?php }} ?>
                                </tr>

                                <?php //if SHOP_INSTALLED?>
                                <!-- <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#"><?php echo lang ('Manage shop','admin'); ?><span class="f-s_14">→</span></a>-->
                                <?php ///if?>
                                <?php $CI->lang->load($langDomain)?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if(SHOP_INSTALLED): ?>
                        <table class="container" >
                            <tbody>
                                <tr>
                                    <?php if(is_true_array($shopMenu)){ foreach ($shopMenu as $li){ ?>
                                        <?php if($li['subMenu']): ?>
                                            <td class="<?php echo $li['class']; ?> <?php if($li['subMenu']): ?> dropdown<?php endif; ?>">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (bool) $li['text'] ? $li['text'] : $li['text']    ?></a>
                                                <ul class="dropdown-menu">
                                                    <?php if(is_true_array($li['subMenu'])){ foreach ($li['subMenu'] as $sli){ ?>
                                                        <li <?php if($sli['divider']): ?> class="divider"<?php endif; ?><?php if($sli['header']): ?> class="nav-header"<?php endif; ?>>
                                                            <?php if($sli['link']  ||  $sli['id']): ?>
                                                                <a 
                                                                    <?php if($sli['link']): ?> href="<?php echo site_url ( $sli['link'] ); ?>" <?php endif; ?>
                                                                    <?php if($sli['id']): ?> id="<?php echo $sli['id']; ?>" <?php endif; ?>
                                                                    <?php if($sli['pjax']  !== FALSE): ?> class="pjax" <?php endif; ?>>
                                                                    <?php echo (bool) $sli['text'] ? $sli['text'] : $sli['text']    ?>
                                                                </a>
                                                            <?php else:?>
                                                                <?php echo  $sli['text'] ? $sli['text'] : $sli['text']    ?>
                                                            <?php endif; ?>

                                                        </li>
                                                        <?php if($sli['modulesList']): ?>
                                                            <?php if(!$components): ?>
                                                                <?php $CI->load->module('admin/components'); $components = $CI->components->find_components_for_menu_list(TRUE)?>
                                                            <?php endif; ?>
                                                            <?php if(is_true_array($components)){ foreach ($components as $component){ ?>
                                                                <li><a href="/admin/components/cp/<?php echo $component['name']?>"><?php echo $component['menu_name']?></a></li>
                                                            <?php }} ?>
                                                            
                                                                <?php if(!MAINSITE): ?>
                                                                <li class="divider"></li>
                                                                    <li><a href="/admin/components/modules_table" class="pjax"><?php echo lang ('All modules', 'admin'); ?></a></li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                    <?php }} ?>
                                                </ul>
                                            </td>
                                        <?php endif; ?>
                                    <?php }} ?>
                                </tr>
                                <!--<a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> <?php echo lang ('Manage site','admin'); ?> </a>-->
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div id="loading"></div>
            <?php $CI->lang->load($langDomain)?>
            <div class="container" id="mainContent"><script>setTimeout(function() {
                        $('.mini-layout').css('padding-top', $('.frame_title:not(.no_fixed)').outerHeight());
                    }, 0);</script>
                        <?php if(isset($content)){ echo $content; } ?>
                </div>
                <?php $CI->lang->load('admin')?>
                <div class="hfooter"></div>
            </div>
            <footer>
                <div class="container">
                    <div class="row-fluid">
                        <div class="span4">
                            <?php echo lang ('Interface','admin'); ?>:
                            <?php echo create_admin_language_select()?>
                        </div>
                        <div class="span4 t-a_c">
                            <?php if(!defined('MAINSITE')): ?>
                                <?php echo lang ("Version","admin"); ?>: <b><?php echo getCMSNumber()?></b>-->
                            <?php endif; ?>
                            <div class="muted"><?php echo lang ('Help us get better','admin'); ?> - <a href="#" id="rep_bug"><?php echo lang ('report an error','admin'); ?></a></div>
                        </div>
                        <?php if(!define(MAINSITE)): ?>
                        <div class="span4 t-a_r">
                            <div class="muted">Copyright © ImageCMS <?php echo date('Y')?></div>
                            <a href="<?php if(MAINSITE): ?>http://docs.premmerce.com/<?php else:?>http://docs.imagecms.net<?php endif; ?>" target="blank"><?php echo lang ('Documentation','admin'); ?></a>
                        </div>
                        <?php else:?>
                        <div class="span4 t-a_r">
                            <div class="muted">Copyright © ImageCMS <?php echo date('Y')?></div>
                            <a href="http://docs.premmerce.com" target="blank"><?php echo lang ('Documentation','admin'); ?></a>
                        </div>                        
                        <?php endif; ?>
                    </div>
                </div>
            </footer>
            <div id="elfinder"></div>
            <div class="standart_form frame_rep_bug">
                <form>
                    <label>
                        <?php echo lang ('Your Name','admin'); ?>:
                        <input type=text name="name"/>
                    </label>
                    <label>
                        <?php echo lang ('Your Email','admin'); ?>:
                        <input type=text name="email"/>
                    </label>
                    <label>
                        <?php echo lang ('Your remark', "admin"); ?>:
                        <textarea name='text'></textarea>
                    </label>
                    <input type="submit" value="<?php echo lang ("Send","admin"); ?>" class="btn btn-info"/>
                    <input type="button" value="<?php echo lang ("Cancel","admin"); ?>" class="btn btn-info" style="float:right" name="cancel_button"/>
                    <input type="hidden" name='ip' value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" id="ip_address"/>
                </form>
            </div>
            <script>
                <?php $settings = $CI->cms_admin->get_settings();?>
                var textEditor = '<?php echo $settings['text_editor']; ?>';
                <?php if($CI->dx_auth->is_logged_in()): ?>
                var userLogined = true;
                <?php else:?>
                var userLogined = false;
                <?php endif; ?>
                var locale = '<?php echo $this->CI->config->item('language')?>';
                var base_url = "<?php echo site_url (); ?>";
            </script>

            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/bootstrap.min.js" type="text/javascript"></script>
            <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/bootstrap-notify.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery.form.js" type="text/javascript"></script>

            <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
            <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-validate/jquery.validate.i18n.js" type="text/javascript"></script>

            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/chosen.js" type="text/javascript"></script>

            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/functions.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/scripts.js" type="text/javascript"></script>

            <script type="text/javascript" src="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elrte-1.3/js/elrte.min.js"></script>
            <script type="text/javascript" src="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elfinder-2.0/js/elfinder.min.js"></script>


            <?php if($this->CI->config->item('language') == 'russian'): ?>
                <script async="async" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-validate/messages_ru.js" type="text/javascript"></script>
                <script type="text/javascript" src="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elrte-1.3/js/i18n/elrte.ru.js"></script>
                <script type="text/javascript" src="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
            <?php endif; ?>

            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/admin_base_i.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/admin_base_m.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/admin_base_r.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/admin_base_v.js" type="text/javascript"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/admin_base_y.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?php if(isset($JS_URL)){ echo $JS_URL; } ?>/tiny_mce/jquery.tinymce.js"></script>
            <script src="<?php if(isset($THEME)){ echo $THEME; } ?>js/autosearch.js" type="text/javascript"></script>

            <script>
                <?php if($CI->uri->segment('4') == 'shop'): ?>
                var isShop = true;
                <?php else:?>
                var isShop = false;
                <?php endif; ?>
                var lang_only_number = "<?php echo lang ("numbers only","admin"); ?>";
                var show_tovar_text = "<?php echo lang ("show","admin"); ?>";
                var hide_tovar_text = "<?php echo lang ("don't show", 'admin'); ?>";

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
                        });
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
                    base_url = '<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>';
                        theme_url = '<?php if(isset($THEME)){ echo $THEME; } ?>';

                        var elfToken = '<?php echo $CI->lib_csrf->get_token()?>';
                </script>
                <div id="jsOutput" style="display: none;"></div>
            </body>
        </html>
<?php $mabilis_ttl=1415876668; $mabilis_last_modified=1415789033; ///var/www/image-c.loc/templates/administrator/main.tpl ?>