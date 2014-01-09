        <div class="baner">
             {$banners = ShopCore::app()->SBannerHelper->getBanners(1)}
             {foreach $banners as $banner}
            <a href="" class="figure">
                <img src="/uploads/shop/banners/{echo $banner['image']}"/>
            </a>
            {/foreach}
        </div>
        <ul class="main_menu">{echo ShopCore::app()->SCategoryTree->ulWithTitleMobile()}</ul>