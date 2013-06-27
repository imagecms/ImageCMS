<div class="frame-crumbs">
    <div class="container">
        {widget('path')}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        <div class="left-catalog-first">
            <div class="f-s_0 title-category">
                <div class="frame-title">
                    <h1 class="d_i">{echo $category->getName()}</h1>
                </div>
            </div>
            {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)}
            {if count($banners)}
                <div class="frame-baner-catalog frame-baner">
                    <section class="carousel_js baner container">
                        <div class="content-carousel">
                            <ul class="cycle">
                                {foreach $banners as $banner}
                                    <li>
                                        {if trim($banner.url)}
                                            <a href="{site_url($banner.url)}">
                                                <img data-src="{media_url('/uploads/shop/banners/'.$banner.image)}" alt="{ShopCore::encode($banner.name)}" />
                                            </a>
                                        {else:}
                                            <span>
                                                <img data-src="/uploads/shop/banners/{$banner.image}" alt="{ShopCore::encode($banner.name)}" />
                                            </span>
                                        {/if}
                                    </li>
                                {/foreach}
                            </ul>
                            <span class="preloader-baner"></span>
                            <div class="pager"></div>
                        </div>
                        <div class="group-button-carousel">
                            <button type="button" class="prev arrow"></button>
                            <button type="button" class="next arrow"></button>
                        </div>
                    </section>
                </div>
            {/if}

            {\Category\RenderMenu::create()->load('category_menu_first')}
        </div>
        <div class="right-catalog-first">
            <div class="vertical-carousel carousel-category-popular">
            {widget('popular_products_category')}
            </div>
        </div>

    </div>
</div>
{if trim($category->getDescription()) != ""}
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {echo trim($category->getDescription())}
            </div>
        </div>
    </div>
{/if}