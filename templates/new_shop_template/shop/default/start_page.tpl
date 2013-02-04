<div class="content">

    <!-- Show Brands in circle -->
    {$banners = getBanners()}
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
        {if count(getPromoBlock('popular', 10))>0}
        <div class="box_title"><span class="f-s_24">{lang('s_PP')}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach getPromoBlock('popular', 10) as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                        {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                        <li {if $hotProduct->firstvariant->getstock()==0}class="not_avail"{/if}>
                            <div class="small_item">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                    <span>
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstvariant->getPrice()}
                                                {$prTwo = $hotProduct->firstvariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstvariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstvariant->getPrice()}
                                            {/if}
                                            {echo $prThree} 
                                            <sub>{$CS}</sub>
                                        </div>
                                        <div class="{$style.class} buttons">
                                            <span class="{$style.identif}" data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}">{$style.message}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div>{/if}
                <!-- featured -->
       
        {if count(getPromoBlock('hot', 10))>0}
        <div class="box_title"><span class="f-s_24">{lang('s_new')}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach getPromoBlock('hot', 10) as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                        {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                        <li {if $hotProduct->firstvariant->getstock()==0}class="not_avail"{/if}>
                            <div class="small_item">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                    <span>
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}"/>
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstvariant->getPrice()}
                                                {$prTwo = $hotProduct->firstvariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstvariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstvariant->getPrice()}
                                            {/if}
                                            {echo $prThree} 
                                            <sub>{$CS}</sub>
                                        </div>
                                        <div class="{$style.class} buttons">
                                            <span class="{$style.identif}" data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}">{$style.message}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div>{/if}
         {if count(getPromoBlock('action', 10))>0}
        <div class="box_title"><span class="f-s_24">{lang('s_action')}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach getPromoBlock('action', 10) as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                        {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                        <li {if $hotProduct->firstvariant->getstock()==0}class="not_avail"{/if}>
                            <div class="small_item">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                    <span>
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstVariant->getPrice()}
                                                {$prTwo = $hotProduct->firstVariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstVariant->getPrice()}
                                            {/if}
                                            {echo $prThree} 
                                            <sub>{$CS}</sub>
                                        </div>
                                        <div class="{$style.class} buttons">
                                            <span class="{$style.identif}"  data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}">{$style.message}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div>{/if}
        {widget('latest_news')}
    </div>
</div>