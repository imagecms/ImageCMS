{# Variables
/**
* @start_page.tpl - template for displaying start page
* Variables
*   $banners: (array) which contains shop banners
*/
#}
<div class="start_page">

    <!-- Show Banners in circle -->
    <div class="mainFrameBaner">
        <section class="container">
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
                <div class="group-button-carousel">
                    <button class="next" type="button"></button>
                    <button class="prev" type="button"></button>
                </div>
                <div class="pager"></div>
            </div>
            {/if}
        </section>
    </div>
    <!-- Show banners in circle -->

    {widget('popular_products')}
    {widget('new_products')}
    {widget('action_products')}

</div>