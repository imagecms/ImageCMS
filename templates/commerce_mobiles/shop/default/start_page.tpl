        <div class="baner">
             {$banners = getBanners()}
             {foreach $banners as $banner}
            <a href="{echo $banner->getUrl()}" class="figure">
                <img src="{$SHOP_THEME}/images/temp/baner.jpg"/>
            </a>
            {/foreach}
        </div>
        <ul class="main_menu">{echo ShopCore::app()->SCategoryTree->ulWithTitleMobile()}</ul>