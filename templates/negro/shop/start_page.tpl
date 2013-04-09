{$banners = ShopCore::app()->SBannerHelper->getBanners()}
{if count($banners)}
    <div class="frame_baner">
        <section class="carousel_js baner container">
            <div class="content-carousel">
                 <ul class="cycle">
                    {foreach $banners as $banner}
                        <li>
                            {if trim($banner['url']) != ""}
                                <a href="{echo $banner['url']}">
                                    <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                                </a>
                            {else:}
                                <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                            {/if}
                        </li>
                    {/foreach}
                </ul>
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </section>
    </div>
{/if}
<div class="frame-news-catalog">
    <div class="container">
        {widget('latest_news')}
        {\Category\RenderMenu::create()->showSubCategories('front_menu','0')}
    </div>
</div>
    {widget('popular_products')}
    {widget('action_products')}
    {widget('brands')}