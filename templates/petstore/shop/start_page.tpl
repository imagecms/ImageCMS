<div class="page-main">
    <div class="frame-baner frame-baner-start_page">
        <section class="carousel-js-css baner container resize cycleFrame"><!--remove class="resize" if not resize-->
            <div class="content-carousel clearfix">
                {$CI->load->module('banners')->render()}

                <ul class="f_r mq-max mq-w-768 mq-block">
                    {foreach $CI->load->module('banners')->getByGroup('rightStartPage') as $banner}
                    <li class="addBaner">
                        {if trim($banner.url)}
                        <a href="{site_url($banner.url)}"><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></a>
                        {else:}
                        <span><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></span>
                        {/if}
                    </li>
                    {/foreach}
                </ul>
            </div>
            <div class="group-button-carousel">
                <button type="button" class="prev arrow">
                    <span class="icon_arrow_p"></span>
                </button>
                <button type="button" class="next arrow">
                    <span class="icon_arrow_n"></span>
                </button>
            </div>
        </section>
    </div>

    {widget('brands')}
    <div id="new_products">
        {widget('new_products', TRUE)}
    </div>

    {/*}
    <div class="frame-start-page-category-menu">
        <div class="container">
            {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('start_page_category_menu')}
        </div>
    </div>
    { */}

    <div class="container_menu_info container">
        <div class="menu_info">
            <div class="inside-padd">
               <span class="photo-block">
                   <img src="{$THEME}{$colorScheme}/images/petstore-image1.jpg"/>
               </span>
               <div class="description">
                <div class="title">Питание и  лечение</div>
                <ul class="nav-info">
                    <li><a href="#"><span class="text-el">Корм для собак</span></a></li>
                    <li><a href="#"><span class="text-el">Корм для кошек</span></a></li>
                    <li><a href="#"><span class="text-el">Смесь грызунам</span></a></li>
                    <li><a href="#"><span class="text-el">Корм для рыбок</span></a></li>
                    <li><a href="#"><span class="text-el">Корма для птиц</span></a></li>
                    <li><a href="#"><span class="text-el">Лечение блох</span></a></li>
                    <li><a href="#"><span class="text-el">Уход за шерстью</span></a></li>
                    <li><a href="#"><span class="text-el">Шампуни</span></a></li>
                    <li><a href="#"><span class="text-el">Растворы</span></a></li>
                    <li><a href="#"><span class="text-el">Аппетит</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="menu_info">
        <div class="inside-padd">
           <span class="photo-block">
               <img src="{$THEME}{$colorScheme}/images/petstore-image2.jpg"/>
           </span>
           <div class="description">
            <div class="title">Аксессуары и мебель</div>
            <ul class="nav-info">
                <li><a href="#"><span class="text-el">Корм для собак</span></a></li>
                <li><a href="#"><span class="text-el">Корм для кошек</span></a></li>
                <li><a href="#"><span class="text-el">Смесь грызунам</span></a></li>
                <li><a href="#"><span class="text-el">Корм для рыбок</span></a></li>
                <li><a href="#"><span class="text-el">Корма для птиц</span></a></li>
                <li><a href="#"><span class="text-el">Лечение блох</span></a></li>
                <li><a href="#"><span class="text-el">Уход за шерстью</span></a></li>
                <li><a href="#"><span class="text-el">Шампуни</span></a></li>
                <li><a href="#"><span class="text-el">Растворы</span></a></li>
                <li><a href="#"><span class="text-el">Аппетит</span></a></li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="frame-seotext-benefits container">

  <div class="frame-benefits">
    {widget('benefits')}
</div>  
<div class="frame-seo-text">
    <div class="text seo-text">
        {widget('start_page_seo_text')}
    </div>
</div>

</div>

<div id="ViewedProducts">
    {/*{widget_ajax('ViewedProducts', '#ViewedProducts')}*/}
    {widget('ViewedProducts')}
</div>

</div>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>