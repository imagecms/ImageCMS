{if count($products) > 0}    
<div class="mainFrameCarousel1">
    <!--фрейм на елемент-->
    <section class="container">
        <div class="frame_carousel_product carousel_js">
            <div class="m-b_20">
                <div class="title_h1 d_i-b v-a_m">{$title}</div>
                <div class="d_i-b groupButton v-a_m">
                    <button type="button" class="btn btn_prev"><span class="icon prev"></span><span class="text-el"></span></button>
                    <button type="button" class="btn btn_next"><span class="icon next"></span><span class="text-el"></span></button>
                </div>
            </div>
            <div class="carousel bot_border_grey">
                <ul class="items items_catalog">
                    {foreach $products as $product}
                    <li class="span3 {if $product->firstvariant->getStock()==0} not_avail{/if}">
                        <div class="description">
                            <div class="frame_response">
                                <div class="star">
                                    {$CI->load->module('star_rating')->show_star_rating($product)}
                                </div>
                            </div>
                            <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                            <div class="price price_f-s_16">
                                <!--
                                $product->hasDiscounts() - checking for the existence of discounts. 
                                If there is a discount price without discount deduce
                                -->
                                {if $product->hasDiscounts()}
                                <span class="d_b old_price">
                                    <!--
                                    "$product->firstVariant->toCurrency('OrigPrice')" or $product->firstVariant->getOrigPrice()
                                    output price without discount
                                    -->
                                    <span class="f-w_b priceOrigVariant">{echo $product->firstVariant->toCurrency('OrigPrice')}</span>
                                    {$CS}
                                </span>                           
                                {/if}
                                <!--
                                If there is a discount of "$product->firstVariant->toCurrency()" or "$product->firstVariant->getPrice"
                                will display the price already discounted
                                -->
                                <span class="f-w_b" id="priceVariant">{echo $product->firstVariant->toCurrency()}</span> {$CS}
                                <!--To display the amount of discounts you can use $product->firstVariant->getNumDiscount()-->
                            </div>  
                            {if $product->firstvariant->getstock()!=0}

                            <button class="btn btn_buy btnBuy" 
                                    type="button" 
                                    data-id="{echo $product->getId()}"
                                    data-varid="{echo $product->firstVariant->getId()}"
                                    data-prodid="{echo $product->getId()}"
                                    data-price="{echo $product->firstVariant->toCurrency()}" 
                                    data-name="{echo ShopCore::encode($product->getName())}"
                                    data-maxcount="{echo $product->firstVariant->getstock()}"
                                    data-number="{echo $product->firstVariant->getNumber()}"
                                    data-img="{echo $product->firstVariant->getSmallPhoto()}"
                                    data-url="{echo shop_url('product/'.$product->getUrl())}"
                                    data-origPrice="{if $product->hasDiscounts()}{echo $product->firstVariant->toCurrency('OrigPrice')}{/if}"
                                    data-stock="{echo $product->firstVariant->getStock()}"
                                    >
                                {lang('Купить','commerce4x')}
                            </button>
                            {else:}
                            <button 
                                    data-drop=".drop-report"
                                    data-prodid="{echo $product->getId()}"
                                    type="button"
                                    class="btn btn_not_avail">
                                <span class="icon-but"></span>
                                {lang('Сообщить о появлении','commerce4x')}
                            </button> 
                            {/if} 
                        </div>
                        <div class="photo-block">
                            <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                <figure>
                                    <span class="helper"></span>
                                    <img src="{echo $product->firstVariant->getMediumPhoto()}" alt="{echo ShopCore::encode($product->getName())}"/>
                                </figure>
                            </a>
                        </div>
                    </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </section>    
</div>
{/if}
<!-- featured -->