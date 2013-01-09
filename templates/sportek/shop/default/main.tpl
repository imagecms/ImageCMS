<!DOCTYPE html>
{if isset($_GET['per_page'])} {$num = $_GET['per_page'] / 12 + 1}{/if}
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />	
		{if $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palatki/kempingovye-palatki' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palatki/dvukhmestnye-palatki'}
		<link rel="canonical" href="http://sportek.ua/shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palatki"/>	
		{/if}	
		{if $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/riukzaki/turisticheskie-ryukzaki'}

		<link rel="canonical" href="http://sportek.ua/shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/riukzaki"/>
		{/if}
		{if $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/stoly-turisticheskie' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/stoly-kukhonnye-kempingovye' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/shkafy-turisticheskie' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/shezlongi' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/raskladushki' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel/raskladnaya-mebel'}
		<link rel="canonical" href="http://sportek.ua/shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel"/>
		{/if}
        {if $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/spalnye-meshki/odyeyalom' || $CI->uri->uri_string == 'shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/spalnye-meshki/letnie-spalniki'}
		<link rel="canonical" href="http://sportek.ua/shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/spalnye-meshki"/>
		{/if}
		{$page_type = $CI->core->core_data['data_type'];}
        {include_tpl('seo_head')}
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/style.css" />
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/libraries/fancybox/css/jquery.fancybox-1.3.4.css" />
        <!--[if IE 6]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie7.css" /><![endif]-->
        <!--[if IE 8]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie8.css" /><![endif]-->    

        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.ui-slider.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.validate.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/fancybox/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.cycle.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/libraries/main.js"></script>
        <script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>


        <!--
                <script type="text/javascript" src="{$SHOP_THEME}js/libraries/slide_list.js"></script>
                <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.main.js"></script>-->


        <!-- Loaders -->
        <script type="text/javascript" src="{$SHOP_THEME}js/loaders/main_loader.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/loaders/product_loader.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/loaders/cart_loader.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/loaders/category_loader.js"></script>

        <script type="text/javascript" src="{$SHOP_THEME}js/loaders/jquery.datePicker-2.1.2.js"></script>
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/loaders/jquery-ui-1.7.3.custom.css" />


        {if $page_type == 'main'}
            <script type="text/javascript" src="{$SHOP_THEME}js/libraries/jcarousellite_1.0.1.min.js"></script>
            <script type="text/javascript" src="{$SHOP_THEME}js/loaders/jcarusel_loader.js"></script>
        {/if}
        <link rel="icon" href="{$SHOP_THEME}images/sportek.ico" type="image/x-icon" />
        {literal}
            <script type="text/javascript">

              var _gaq = _gaq || [];
              _gaq.push(['_setAccount', 'UA-6175648-1']);
              _gaq.push (['_addOrganic', 'meta.ua', 'q']);
              _gaq.push (['_addOrganic', 'search.bigmir.net', 'z']);
              _gaq.push (['_addOrganic', 'search.i.ua', 'q']);
              _gaq.push (['_addOrganic', 'mail.ru', 'q']);
              _gaq.push (['_addOrganic', 'go.mail.ru', 'q']);
              _gaq.push (['_addOrganic', 'google.com.ua', 'q']);
              _gaq.push (['_addOrganic', 'rambler.ru', 'words']);
              _gaq.push (['_addOrganic', 'nova.rambler.ru', 'query']);
              _gaq.push (['_addOrganic', 'nova.rambler.ru', 'words']);
              _gaq.push (['_addOrganic', 'index.online.ua', 'q']);
              _gaq.push (['_addOrganic', 'web20.a.ua', 'query']);
              _gaq.push (['_addOrganic', 'search.ukr.net', 'search_query']);
              _gaq.push (['_addOrganic', 'search.com.ua', 'q']);
              _gaq.push (['_addOrganic', 'search.ua', 'q']);
              _gaq.push(['_trackPageview']);
              _gaq.push(['_trackPageLoadTime']); 
            </script>
        {/literal}

        {if $CI->session->flashdata('makeOrder') === true}
            <script type="text/javascript">
                _gaq.push(['_addTrans',
                    '{echo $model->id}',          
                    '',  
                    '{echo $model->getTotalPrice()}',        
                    '',           
                    '{echo $model->getSDeliveryMethods()->name}',              
                    '',       
                    '',     
                    ''
                ]);

                {foreach $model->getSOrderProductss() as $item}
                    {$total = $total + $item->getQuantity() * $item->toCurrency()}
                    {$product = $item->getSProducts()}
			
                        _gaq.push(['_addItem',
                            '{echo $model->id}',
                            '{echo $product->getUrl()}',
                            '{echo encode(ShopCore::encode($product->getName()))} {echo encode($item->getVariantName())}',
                            '{echo encode($product->getMainCategory()->name)}',
                            '{echo strip_tags($item->toCurrency())}',
                            '{echo $item->getQuantity()}'
                        ]);

                {/foreach}

                    _gaq.push(['_trackTrans']);
            </script>
        {/if}

        {literal}
            <script type="text/javascript">
              (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
              })();
            </script>
        {/literal}

    </head>
    <body>
        <div class="container {if $page_type == 'main' || $CI->uri->segment(2) == 'category' || $CI->uri->segment(2) == 'brand' }no_over{/if}">
            {if $CI->uri->segment(2) == 'category' || $page_type == 'main'}
                {if $CI->uri->segment(2) == 'category' && count($model) > 0}
                    {$hits = getcategoryHits($model->getId())}

                {/if}
                {if $page_type == 'main'}
                    <div class="site_description text {if $page_type != 'main' && count($hits) > 0}action_hit{/if}"  {if $page_type == 'main' || count($hits) == 0}style="padding-top:40px;"{/if}>
                        <h1>Приветствуем Вас в Интернет-магазине спорттоваров Sportek!</h1>
                        <p>Наш Интернет-магазин спортивных товаров и туристического снаряжения был создан для удобных, быстрых и выгодных покупок. У нас Вы в два счета найдете то, что нужно искать днями на рынке или бегая по торговым точкам. У нас Вы сделаете шаг к мечте, радости и удовольствию просто кликнув мышкой. У нас Вы найдете товары для профессионалов и лучшие подарки для Ваших детей.</p>
                        <p><strong>Sportek</strong> - это не просто Интернет-магазин туристического снаряжения.<br /><strong>Sportek</strong> - это мир качества, скидок, низких цен и специальных предложений.</p>
                        <p>Покупая у Нас, вы экономите колоссальные объемы времени, сил и денег, Вы заботитесь о своем здоровье и здоровье Ваших близких. А мы со своей стороны стараемся делать все возможное и даже больше для того, чтобы Вы были счастливы!</p>
                    </div>
                {elseif $CI->uri->segment(2) == 'category' && $model->description && !$_GET['per_page']}
                    {//echo $model->getId()}

                {/if}
            {/if}
            {$class = to}
            {literal}
                <script>
        $(document).ready(function(){
            s_d_h = $('.site_description').height()+77;
            $('.to').css('height', s_d_h )
        });
                </script>
            {/literal}
            {$class = to}
            <div class="top">
                <div class="top_menu">
                    {load_menu('main_menu')}
                </div>
                <div class="auth_menu">
                    {if $_SESSION['DX_user_id']}
                        <span><a href="{site_url('shop/profile')}">Личный кабинет</a></span>
                        <span><a href="{site_url('auth/logout')}">Выход</a></span>
                    {else:}
                        <span><a rel="nofollow" href="{site_url('auth')}" class="js">Вход</a></span>
                        <span><a rel="nofollow" href="{site_url('auth/register')}" class="js">Регистрация</a></span>
                    {/if}
                </div>
            </div>
            <div class="header">
                <div class="logo">
                    <a href="{site_url('')}"></a>
                    <span>Интернет-магазин спортивных товаров и туристического снаряжения</span>
                </div>
                <div class="h_info">

                    <div class="h_contacts">

                        <div><span>(050)<span class="hideme">.</span></span>371-00-33</div>
                        <div><span>(067)<span class="hideme">.</span></span>374-65-62</div>
                        <div><span>(032)<span class="hideme">.</span></span>297-25-75</div>
                        <a href="{site_url('/shop/add_callback')}" class="js">Заказать звонок</a>

                    </div>
                    <div class="search">
                        <form action="{shop_url('search')}" method="get">
                            <div class="text_field"><input type="text" name="text" value="{$_GET['text']}" /></div>
                            <div class="button"><input type="submit" value="Найти" /></div>
                        </form>
                    </div>
                </div>
                <div class="cart">
                    {include_tpl('cart_data')}
                </div>
            </div>
            <div class="main_menu">
                {include_tpl('catalog_menu')}
            </div>		
            {if $CI->uri->segment(2) != 'promotion'}
                <div class="shares">

                    {if isset($baners) && count($baners) > 0  && $CI->uri->segment(2) == 'category' && $baners }
                 
                        <div class="top-cyc clearfix">
                            <div class="cycle clearfix f_l">
                                <ul>
                                    {foreach $baners as $key=>$baner}

                                        {if $baner["img"] != '' && $key != 5 && $key != 6}

                                            <li> <a href="{echo $baner['href']}"><img src="{echo $baner['img']}" /></a> </li>

                                        {/if}
                                    {/foreach}
                                </ul>
                                <div class="pager"></div>
                            </div>
                         {if $baners[5]['img'] != ''}  
                                <div class="f_l bann-one">
								<a href="{echo $baners[5]['href']}">
                                <img src="{echo $baners[5]['img']}">
                                </a>
                            </div>
                            {/if}
                            
                        {if $baners[6]['img'] != ''}  
                            <div class="f_l bann-one">
								<a href="{echo $baners[6]['href']}">
                                <img src="{echo $baners[6]['img']}">
                                </a>
                            </div>
                        {/if}
                        </div>
                       
                        
                    {/if}

                    {if $page_type == 'main'}
                        {$baners = get_page_properties(78)}
                        <div class="top-cyc clearfix">
                            <div class="cycle clearfix f_l">
                               <ul>
                                    {foreach $baners as $key=>$baner}

                                        {if $baner["img"] != '' && $key != 5 && $key != 6}

                                            <li> <a href="{echo $baner['href']}"><img src="{echo $baner['img']}" /></a> </li>

                                        {/if}
                                    {/foreach}
                                </ul>
                                <div class="pager"></div>
                            </div>
                             {if $baners[5]['img'] != ''}  
                                <div class="f_l bann-one">
								<a href="{echo $baners[5]['href']}">
                                <img src="{echo $baners[5]['img']}">
                                </a>
                            </div>
                            {/if}
                            
                        {if $baners[6]['img'] != ''}  
                            <div class="f_l bann-one">
								<a href="{echo $baners[6]['href']}">
                                <img src="{echo $baners[6]['img']}">
                                </a>
                            </div>
                        {/if}
                        
                        </div>
                    {/if}



                    {if $page_type == 'main'}
										<!--
                        <div class="promo33 tleft"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'BECO Intro']);" href="{site_url('shop/category/plavanie-i-daiving?order=name&user_per_page=12&lp=0&rp=550&brand%5B%5D=69')}"><img src="{media_url('uploads/images/b1208/Beco_New.gif')}" alt="Товары для плавания BECO новинка!" /></a></div>
                        <div class="promo33 tcenter"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'Space Corner']);" href="{site_url('shop/product/295')}"><img src="{media_url('uploads/images/b1208/prm_Space_Corner.jpg')}" alt="Тренажер Space Corner" /></a></div>
                        <div class="promo33 tright"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'New Ladas']);" href="{site_url('shop/brand/ladas')}"><img src="{media_url('uploads/images/b1204/Ladas.jpg')}" alt="Детские уголки и стенки Ладас" /></a></div>
										-->
                    {elseif $CI->uri->segment(3) == 'zimnie-vidy-sporta'}
										<!--
                        <span><a href="{site_url('shop/promotion')}"><img src="{media_url('uploads/images/Winter_1.jpg')}" /></a></span>
										-->
                    {elseif $CI->uri->segment(3) == 'turizm-i-otdyh'}
										<!--
                        <div class="promo33 tleft"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'Promo Tents 2012']);" href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palatki?lp=138&rp=9635&order=action&user_per_page=12')}"><img src="{media_url('uploads/images/b1209/prm_Tents.jpg')}" alt="Акция! Туристические палатки" /></a></div>
                        <div class="promo33 tcenter"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'Promo Funiture 2012']);" href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel?lp=110&rp=1959&order=action&user_per_page=12')}"><img src="{media_url('uploads/images/b1209/prm_Furniture.jpg')}" alt="Акция! Мебель туристическая" /></a></div>
                        <div class="promo33 tright"><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'Promo Outdoor Accessories 2012']);" href="{site_url('shop/promotion?searchIn%5B%5D=57&searchBrandIn%5B%5D=28&searchBrandIn%5B%5D=29')}"><img src="{media_url('uploads/images/b1209/prm_Tourism_Accessories.jpg')}" alt="Акция! Аксессуары для туризма" /></a></div>
										-->
                    {else:}
                        <span><a onclick="_gaq.push(['_trackEvent', 'Banners', 'clicks', 'Beco wide intro 2012']);" href="{site_url('shop/category/plavanie-i-daiving?lp=0&rp=550&brand%5B%5D=69&order=name&user_per_page=12')}"><img src="{media_url('uploads/images/Beco.jpg')}" /></a></span>
                    {/if}
                </div>
            {/if}
            {if $page_type == 'main' && isset($noBanner)}
                <div class="shares">
                    <div class="prev"></div>
                    <div class="next"></div>
                    <div class="carusel">
                        <ul>
                            <li><a href="{site_url('#')}"><img src="{$SHOP_THEME}images/temp/slide_1.jpg" alt="" /></a></li>
                            <li><a href="{site_url('#')}"><img src="{$SHOP_THEME}images/temp/slide_2.jpg" alt="" /></a></li>
                            <li><a href="{site_url('#')}"><img src="{$SHOP_THEME}images/temp/slide_3.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                </div>

            {/if}
        {if $page_type == 'main'}<div class="main_wrap global_catalog">{/if}
            {$shop_content}
        {if $page_type == 'main'}</div>{/if}
</div>
{if $page_type == 'main'}
    <div class="bottom_info to">
        <div class="t"></div>
        <div class="b"></div>
        <!-- {widget('recent_product_comments')}    -->
    </div>
{else:}
    {if $CI->uri->segment(2) == 'product'  && count($model) > 0}
        {$hits = getcategoryHits($model->getMainCategory()->getId(), 4)}
        {if count($hits) > 0}
            <div class="bottom_info spring pageinside">
                <div class="b"></div>
                <div class="container">
                    <!--                    <div class="box_title">Акции и Хиты</div>-->
                    <div class="box_title_spring"></div>
                    <ul class="wares">

                        {foreach $hits as $p}
                            <li>
                                <!--                                <div class="santa-cap"></div>-->
                                <div class="image"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" /></a></div>
                                <a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                <div class="price_buy"><div class="block_price"><span class="price_product">{echo $p->firstVariant->toCurrency()}</span> <span class="grn">{$CS}</span></div>{if $alreadyInCartArr}{if array_search($p->id, $alreadyInCartArr) !== false}<a class="alreadyIn_small" href="{shop_url('cart')}">В корзине</a>{else:}<a href="{shop_url('product/' . $p->getUrl())}">Купить</a>{/if}{else:}<a href="{shop_url('product/' . $p->getUrl())}">Купить</a>{/if}</div>
                            {if $p->getAction()}<div class="act"></div>{/if}
                        {if $p->getHit()}<div class="hit"></div>{/if}
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{else:}
    <div class="bottom_info p_top"><div class="b"></div></div>
{/if}
{else:}
    {if  $CI->uri->segment(2) == 'category'}
        {if count($hits) > 0}
            <div class="bottom_info spring {if $_GET['per_page']} pageinside{/if}">
                <div class="t"></div>
                <div class="b"></div>
                <div class="container">
                    <!--<div class="box_title">Акции и хиты</div>-->
                    <div class="box_title_spring"></div>
                    {$hits = getcategoryHits($model->getId(), 4)}
                    <ul class="wares">
                        {foreach $hits as $p}
                            <li>
                                <!--                                <div class="santa-cap"></div>-->
                                <div class="image"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" /></a></div>
                                <a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                <div class="price_buy"><div class="block_price"><span class="price_product">{echo $p->firstVariant->toCurrency()}</span> <span class="grn">{$CS}</span></div>{if array_search($p->id, $alreadyInCartArr) !== false}<a class="alreadyIn_small" href="{shop_url('cart')}">В корзине</a>{else:}<a href="{shop_url('product/' . $p->getUrl())}">Купить</a>{/if}</div>
                            {if $p->getAction()}<div class="act"></div>{/if}
                        {if $p->getHit()}<div class="hit"></div>{/if}
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}

{if $page_type != 'main' && $CI->uri->segment(2) != 'category'}
    {if count($hits) == 0}
        <div class="bottom_info p_top"><div class="b"></div></div>
    {/if}
{else:}
    {if $CI->uri->segment(2) == 'category' && !$model->description}
        <div class="bottom_info p_top_fixed">
            <!--<div class="b"></div>-->
        </div>
    {elseif $_GET['per_page']}
        <div class="bottom_info"></div>

    {else:}
        <div class="bottom_info {$class}">
            <div class="b"></div>
            <!--            {widget('recent_product_comments')}-->
        </div>
    {/if}
{/if}
{else:}



    <div class="bottom_info {if $CI->uri->segment(2) == 'brand'}{echo $class}{/if}">
        <div class="b"></div>
    </div>
{/if}
{/if}
{/if}


{$news = category_pages(63, 3)}
{if $news}
    <div class="footer_news container">
        <div class="cat-n-tit">Новости</div>
        <ul class="clearfix">
            {foreach $news as $new}

                <li> 
                    <div class="clearfix title">
                        <span class="f_l news-ico"></span>
                        <div class="name-n">
                            <span class="name">{echo $new.title}</span>
                            <span class="time"> {echo date("d.m.y", $new.created)}  </span>
                        </div>
                    </div>
                    <div>{echo $new.prev_text}</div>
                </li>

            {/foreach}
        </ul>
    </div>

{/if}





<div class="footer">
    <div class="container">
        <div class="f_left">
            <div class="footer_menu">
                {load_menu('main_menu')}
            </div>
            <div class="consultaionFooter">
                <span>Консультации, отгрузки:</span><br/>
                Пн &mdash; Пт: с 9.00 до 18.00
            </div>
            <div class="social_networks">
                <a class="fb" target="_blank" href="http://www.facebook.com/pages/SPORTEKNET/156562627743180?sk=wall"></a>
                <a class="tw" target="_blank" href="http://twitter.com/#!/sporteknet"></a>
                <a class="vk" target="_blank" href="http://vkontakte.ru/sporteknet"></a>
            </div>
        </div>
        <div class="f_right">
            {if $CI->uri->segment(3) == 'turizm-i-otdyh' || $CI->uri->segment(3) == 'igrovye-vidy-sporta' || $CI->uri->segment(3) == 'plavanie-i-daiving' || $CI->uri->segment(3) == 'atletika-i-fizkultura'}
                <span><img src="{$SHOP_THEME}images/siteimage-logo.png" alt="создание интернет магазина" /><a href="http://www.siteimage.com.ua/sozdanie-internet-magazinov" title="создание интернет магазина" target="_blank">Создание интернет магазина</a>, SEO оптимизация сайта.</span>
            {else:}
                <span><img src="{$SHOP_THEME}images/siteimage-logo.png" alt="раскрутка сайта" /><a href="http://www.siteimage.com.ua/raskrutka-sajtov-main" title="раскрутка сайта" target="_blank">Раскрутка сайта</a>, Интернет-агентство "Сайт Имидж".</span>
            {/if}
            <span><a href="http://www.novasports.com.ua/">Оптовая торговля спортивным и туристическим снаряжением</a></span>
            <span>79040 Украина, г. Львов, ул. Городоцкая, 357</span>
     {if $CI->uri->segment(2) != 'product'} 
        
        
           {include_tpl('rating')}
        {/if}
    
        </div>
    </div>
</div>
{literal}
<!-- Yandex.Metrika counter -->
    <div style="display:none;"><script type="text/javascript">
    (function(w, c) {
    (w[c] = w[c] || []).push(function() {
    try {
    w.yaCounter4345378 = new Ya.Metrika({id:4345378, enableAll: true, ut:"noindex", webvisor:true});
    }
    catch(e) { }
    });
    })(window, "yandex_metrika_callbacks");
        </script></div>
    <script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
    <noscript><div><img src="//mc.yandex.ru/watch/4345378?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
{/literal}
</body>
</html>
