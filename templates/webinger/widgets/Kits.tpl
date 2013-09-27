{if $kits->count() > 0}
<div class="container">
    <div class="frame_carousel_product carousel_js vertical_carousel">
        <div class="m-b_10">
            <div class="title_h1 d_i-b v-a_m">{$title}</div>
        </div>
        <div class="carousel">
            <div class="groupButton">
                <button type="button" class="btn btn_prev">
                    <span class="icon prev"></span>
                    <span class="text-el"></span>
                </button>
                <button type="button" class="btn btn_next">
                    <span class="icon next"></span>
                    <span class="text-el"></span>
                </button>
            </div>
            <ul class="items items_catalog">
                
                {foreach $kits as $kitProducts} 
                {$arrUrl = array()}
                {$arrImg = array()}
                <li class="container">
                    <ul class="items items_middle">
                        <li class="span3">
                            <div class="item_set">
                                <!--Photo, price, name for parent product-->
                                <div class="description">
                                    <a href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}">
                                        {echo ShopCore::encode($kitProducts->getMainProduct()->getName())}
                                    </a>
                                    <div class="price price_f-s_16">
                                        <!-- "$kitProducts->getMainProductPrice()" price of the main product-->
                                        <span class="f-w_b">{echo $kitProducts->getMainProductPrice()} </span>
                                        {$CS}
                                    </div>
                                </div>
                                <div class="photo-block">
                                    <a href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}" class="photo">
                                        <figure>
                                            <span class="helper"></span>
                                            <img src="{echo $kitProducts->getMainProduct()->firstvariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <div class="d_i-b">+</div>
                        </li>
                        <!--Output of goods subsidiaries set-->
                        {$arrUrl[] = shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}
                        {$arrImg[] = $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}
                        {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}
                        <li class="{if $kitProducts->countProducts() >= 2}span2{else:}span3{/if}">
                            <div class="item_set">
                                <div class="description">
                                    <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}">
                                        {echo ShopCore::encode($kitProduct->getSProducts()->getName())}
                                    </a>
                                    <!--Conclusion discounts-->
                                    <div class="price price_f-s_14">
                                        {if $kitProduct->getDiscount()}
                                        <span class="old_price v-a_m">
                                            <!--$kitProduct->getBeforePrice() - Price before discount-->
                                            <span class="f-w_b">{echo $kitProduct->getBeforePrice()} </span>
                                            <span class="cur">{$CS}</span>
                                        </span>
                                        {/if}
                                        <!--$kitProduct->getDiscountProductPrice() - discount price-->
                                        <span class="price_f-s_16 v-a_m">
                                            <span class="f-w_b">{echo $kitProduct->getDiscountProductPrice()} </span>
                                            <span class="cur">{$CS}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="photo-block">
                                    <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}" class="photo">
                                        <figure>
                                            <span class="helper"></span>
                                            <img src="{echo $kitProduct->getSProducts()->firstvariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>
                                        </figure>
                                    </a>
                                </div>
                                <span class="top_tovar discount">-{echo $kitProduct->getDiscount()}%</span>
                            </div>
                            <div class="d_i-b">
                                {if $kitProducts->countProducts() == $key}{else:}+{/if}
                            </div>
                        </li>  
                        {$arrUrl[] = shop_url('product/' . $kitProduct->getSProducts()->getUrl())}
                        {$arrImg[] = $kitProduct->getSProducts()->firstVariant->getSmallPhoto()}
                        {/foreach}                       
                    </ul>
                    <!--Output of goods subsidiaries set END-->
                    <div class="footer_items_vertical_catalog">
                        <div class="f_l">
                            <div class="price price_f-s_14">
                                <span class="old_price v-a_m">
                                    <!--$kitProducts->getAllPriceBefore() - The entire set of output price without discount-->
                                    <span class="f-w_b">{echo $kitProducts->getAllPriceBefore()} </span> <span class="cur">{$CS}</span>
                                </span>
                                <!-- $kitProducts->getTotalPrice() - the entire set of output price with discount-->
                                <span class="v-a_m f-s_21">
                                    <span class="f-w_b">{echo $kitProducts->getTotalPrice()} </span> <span class="cur">{$CS}</span>
                                </span>
                            </div>
                        </div>
                        <div class="f_r">
                            <a class="btn btn_buy" href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}#kit">{lang('Подробнее','webinger')}</a>
                           {/*}
                            <button class="btn btn_buy btnBuy" type="button" 
                                    
                                    
                                    data-price="{echo $kitProducts->getTotalPrice()}"
                                    data-prodid="{echo json_encode(array_merge($kitProducts->getProductIdCart()))}"
                                    data-prices ="{echo json_encode($kitProducts->getPriceCart())}"
                                    data-name="{echo ShopCore::encode(json_encode($kitProducts->getNamesCart()))}"
                                    data-kit="true"
                                    data-kitId="{echo $kitProducts->getId()}"
                                    data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}"
                                    data-url='{echo json_encode($arrUrl)}'
                                    data-img='{echo json_encode($arrImg)}'
                                    data-maxcount='{echo $kitProduct->getSProducts()->firstVariant->getStock()}'
                                    
                                    >
                                {lang('Подробнее','webinger')}
                                {//lang('Купить','webinger')}
                            </button>
                            { */}
                        </div>
                    </div>
                </li>
                {/foreach}                            
            </ul>
        </div>
    </div>
</div>
{/if}