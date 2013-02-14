<div class="content">

    <!-- Show Brands in circle -->
    {$banners = ShopCore::app()->SBannerHelper->getBanners()}
    {if count($banners)}
        <div class="cycle center">
            <ul>
                {foreach $banners as $banner}
                    <li>
                        <a href="{echo $banner->getUrl()}">
                            <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" />
                        </a>
                    </li>
                {/foreach}
            </ul>
            <span class="nav"></span>
            <button class="prev"></button>
            <button class="next"></button>
        </div>
    {/if}
    <!-- Show Brands in circle -->


    <!--                ТЕСТ ФЕНСІ-->
    <!--    <a href="{$SHOP_THEME}/images/temp/cycle_1.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--    <a href="{$SHOP_THEME}/images/temp/cycle_2.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--                ЕНД-->

    {$cart_data = ShopCore::app()->SCart->getData()}
    <div class="center">

        {widget('popular_products')}

        {widget('new_products')}
        
        {widget('action_products')}
        
        {widget('latest_news')}
    </div>
</div>