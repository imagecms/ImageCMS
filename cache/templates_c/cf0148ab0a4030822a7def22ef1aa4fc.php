<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($site_title)){ echo $site_title; } ?></title>
        <meta name="description" content="<?php if((int)$page_number>1): ?><?php echo $page_number?> - <?php endif; ?><?php if(isset($site_description)){ echo $site_description; } ?>" />
        <meta name="keywords" content="<?php if(isset($site_keywords)){ echo $site_keywords; } ?>" /> 
        <meta name="generator" content="ImageCMS" />
        <?php if(isset($meta_noindex)){ echo $meta_noindex; } ?>
        <?php if(isset($canonical)){ echo $canonical; } ?>
        <link rel="stylesheet" type="text/css" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>css/style.css" media="all" />
        <!--
        <link rel="stylesheet" type="text/css" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/css/jquery.fancybox-1.3.4.css" media="all" />
        -->

        <link rel="stylesheet" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.0" type="text/css" media="screen" />

        <link rel="icon" type="image/x-icon" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/favicon.png"/>
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/css/ie8_7_6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/css/ie_7.css" /><![endif]-->
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jScrollPane.min.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/cusel-min-2.4.1.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery.ui-slider.js" ></script>
        <!--
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery.fancybox-1.3.4.pack.js" ></script>
        -->
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/fancybox/source/jquery.fancybox.js?v=2.1.0"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/jquery.form.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/scripts.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/shop.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>js/autocomplete.js"></script>
        <?php if(isset($gmeta)){ echo $gmeta; } ?>

        <?php if(isset($yameta)){ echo $yameta; } ?>
        <?php if(isset($renderGA)){ echo $renderGA; } ?>
            
        <?php if(isset($ymetric)){ echo $ymetric; } ?>
    </head>
    <body>
        <div class="main_body">
            <div class="top">
                <div class="center">
                    <?php echo load_menu ('top_menu'); ?>
                    <ul class="user_menu m-l_19 auth_data"><?php $this->include_tpl('auth_data', '/var/www/imagecms.loc/templates/commerce/shop/default'); ?></ul>
                    <ul class="user_menu cart_data_holder">                        
                        <!--                        <li><a href="/" style="color:silver;">ru</a></li>
                                                <li style="margin-left: 0; padding-left: 5px;"><a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>en" style="color:silver;">en</a></li>-->
                        <?php $this->include_tpl('cart_data', '/var/www/imagecms.loc/templates/commerce/shop/default'); ?></ul>
                </div>
            </div><!-- top -->
            <div class="header center">
                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>" class="logo">
                    <img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/imagecms.png">
                </a>
                <div class="frame_form_search">
                    <form name="search" class="clearfix" action="<?php echo shop_url ('search'); ?>" method="get" id="autocomlete">
                        <input type="text" name="text" value="<?php echo lang ('s_se_thi_sit'); ?>"  onfocus="if(this.value=='<?php echo lang ('s_se_thi_sit'); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo lang ('s_se_thi_sit'); ?>';"  id="inputString" autocomplete="off" onkeyup="lookup(event);" class="place_hold"/>
                        <input type="submit" id="search_submit"  value="<?php echo lang ('s_search'); ?>" class="icon"/>
                        <span id="suggestions" style="display: none; width: 0px; right: 0px;"></span>
                    </form>
                </div>
                        
                <div class="phone">
                    <address>(095)<span><span class="d_n">&minus;</span> 555-55-55</span></address>
                    <span class="js showCallback"><?php echo lang ('s_coll_order'); ?></span>
                </div>
                
                <ul class="user_menu">
                    <!--    Show callback's form    -->
                    <?php if(!count(get_currencies())): ?>
                        <li class="p-l_0">
                            <form action="" method="post" name="currencyChangeForm" id="currencyChangeForm">
                                <?php echo lang ('s_currency'); ?>: <select class="changeCurrency" name="setCurrency" >
                                    <?php $result = get_currencies(); 
 if(is_true_array($result)){ foreach ($result as $currency){ ?>
                                        <?php if($currency->getId() != ShopCore::app()->SCurrencyHelper->default->getId()): ?>
                                            <option <?php if(ShopCore::app()->SCurrencyHelper->additional->getId() == $currency->getId()): ?>selected<?php endif; ?> value="<?php echo $currency->getId()?>"><?php echo encode($currency->getName())?></option>
                                        <?php endif; ?>
                                    <?php }} ?>
                                </select>
                                <?php echo form_csrf (); ?>
                            </form>
                        </li>
                    <?php else:?>
                        <li>&nbsp;</li>
                    <?php endif; ?>
                    <!--    Show callback's form    -->

                    <!--    Wish list item's for Header    -->
                    <li id="wishListHolder" class="like blue<?php if(ShopCore::app()->SWishList->totalItems()): ?> is_avail<?php endif; ?>">
                        <?php $this->include_tpl('wish_list_data', '/var/www/imagecms.loc/templates/commerce/shop/default'); ?></li>
                    <!--    Wish list item's for Header    -->

                    <!--    Products in compare list for Header    -->
                    <li id="compareHolder" class="compare blue<?php if($CI->session->userdata('shopForCompare') && count($CI->session->userdata('shopForCompare'))): ?> is_avail<?php endif; ?>">
                        <?php $this->include_tpl('compare_data', '/var/www/imagecms.loc/templates/commerce/shop/default'); ?></li>
                    <!--    Products in compare list for Header    -->
                </ul>
            </div><!-- header -->

                <?php echo ShopCore::app()->SCategoryTree->ul()?>


            <?php if(isset($shop_content)){ echo $shop_content; } ?>

            <div class="hfooter"></div>
        </div>
        <div class="footer">
            <div class="center">
                <div class="carusel_frame brand box_title carousel_js">
                    <div class="carusel clearfix">
                        <ul>
                            <?php $result = ShopCore::app()->SBrandsHelper->mostProductBrands(15, TRUE); 
 if(is_true_array($result)){ foreach ($result as $brand){ ?>
                                <li>
                                    <a href="<?php echo shop_url ( $brand['full_url'] ); ?>">
                                        <img src="<?php echo media_url ( $brand['img_fullpath'] ); ?>" title="<?php echo $brand['name']; ?>" />
                                    </a>
                                </li>
                            <?php }} ?>
                        </ul>
                    </div>
                    <button class="prev"></button>
                    <button class="next"></button>
                </div>
                <?php echo load_menu ('footer_menu'); ?>
                <ul class="contacts f_l">
                    <li>
                        <span class="b"><?php echo lang ('s_tel'); ?>:</span>
                        <span>(095) <span class="d_n">&minus; </span>555-55-55</span>
                    </li>
                    <li>
                        <span class="b"><?php echo lang ('s_email'); ?>:</span>
                        <span>Info@imagecms.net</span>
                    </li>
                    <li>
                        <span class="b"><?php echo lang ('s_skype'); ?>:</span>
                        <span>ImageCMS</span>
                    </li>
                </ul>
                <div class="footer_info f_r">
                    <div>© ImageCMS, <?php echo date ('Y'); ?></div>
                    <div class="social">
                        <a href="#" class="mail"></a>
                        <a href="#" class="g_plus"></a>
                        <a href="#" class="facebook"></a>
                        <a href="#" class="vkontakte"></a>
                        <a href="#" class="twitter"></a>
                        <a href="#" class="odnoklasniki"></a>
                    </div>
                    <a href="http://imagecms.net" target="_blank" class="red"><?php echo lang ('s_footer_create'); ?></a>
                    <div class="s"><?php echo lang ('s_footer_seo'); ?></div>
                </div>
            </div>
        </div><!-- footer -->
        <div class="h_bg_<?php echo whereami (); ?>"></div>
    </body>
</html>
<?php $mabilis_ttl=1357399731; $mabilis_last_modified=1355916586; ///var/www/imagecms.loc/templates/commerce/shop/default/main.tpl ?>