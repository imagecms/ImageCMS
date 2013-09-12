{# Variables
/**
* @start_page.tpl - template for displaying start page
* Variables
*   $banners: (array) which contains shop banners
*/
#}
<div class="start_page container">
    <section class="row-fluid m-b_20">
        
        {include_tpl('../widgets/menu_settings')}
        

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
            {widget('freecode')}
        </div>
    </section>
    <section class="container">
        <div class="row-fluid">
            <div class="span7">
                {widget('infobox1')}
            </div>
            <div class="span5">
                {widget('Kits')}
                {widget('action_products')}
            </div>
    </section>
</div>
{widget('popular_products')}
{widget('new_products')}
<script src="jquery.flexslider.js"></script>
{/*<script type="text/javascript" src="{$THEME}js/jquery.cycle.js"></script>*/}
