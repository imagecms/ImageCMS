<div class="baner">
    {$banners = ShopCore::app()->SBannerHelper->getBanners(1)}
    {foreach $banners as $banner}
        <a href="" class="figure">
            <img src="{echo $banner['image']}"/>
        </a>
    {/foreach}
</div>
{\Category\RenderMenu::create()->setConfig(array('url.shop.category'=>'/mobile/category/'))->load('category_menu')}