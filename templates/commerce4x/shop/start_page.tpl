{# Variables
/**
* @start_page.tpl - template for displaying start page
* Variables
*   $banners: (array) which contains shop banners
*/
#}
<div class="start_page container">
    <section class="row-fluid m-b_20">
        <div class="span3">
            <nav class="menu_vertical_side">
                <ul class="nav">
                    <li>
                        <span class="title">Видео</span>
                        <ul>
                            <li>
                                <a href="#">DVD</a>
                            </li>
                            <li>
                                <a href="#">TV & HDTV</a>
                            </li>
                            <li>
                                <a href="#">DVD/DVR Плееры</a>
                            </li>
                            <li>
                                <a href="#">Blu-Ray Плееры</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="title">Домашнее аудио</span>
                        <ul>
                            <li>
                                <a href="#">Домашние театры</a>
                            </li>
                            <li>
                                <a href="#">Спикеры</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Show Banners in circle -->
        <div class="span9">
            <div class="mainFrameBaner">
                {$banners = ShopCore::app()->SBannerHelper->getBanners()}
                {if count($banners)}
                <div class="frame_baner">
                    <ul class="cycle">
                        {foreach $banners as $banner}
                        <li>
                            <a href="{echo $banner['url']}">
                                <img src="/uploads/shop/banners/{echo $banner['image']}" alt="banner"/>
                            </a>
                        </li>
                        {/foreach}
                    </ul>
                    <div class="pager"></div>
                    <button class="next" type="button"></button>
                    <button class="prev" type="button"></button>
                </div>
                {/if}
            </div>
            {widget('infobox1')}
        </div>
    </section>
    <section class="container">
        <div class="row-fluid">
            <div class="span8">
                {widget('infobox2')}
            </div>
            <div class="span4">
                {widget('Kits')}
                {//widget('action_products')}
            </div>
    </section>
</div>
{widget('popular_products')}
{widget('new_products')}
<script type="text/javascript" src="{$THEME}js/jquery.cycle.js"></script>