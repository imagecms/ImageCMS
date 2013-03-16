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
                        {foreach $products as $hotProduct}
                            <li class="span3 {if $hotProduct->firstvariant->getStock()==0} not-avail{/if}">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="photo">
                                    <span class="helper"></span>
                                    <figure class="w_200 h_180">
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}"/>
                                    </figure>
                                </a>
                                <div class="description">
                                    <div class="frame_response">
                                        <div class="star">
                                            {$CI->load->module('star_rating')->show_star_rating($hotProduct)}
                                        </div>
                                    </div>
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="price price_f-s_16">
                                        <!--
                                        $hotProduct->hasDiscounts() - checking for the existence of discounts. 
                                        If there is a discount price without discount deduce
                                        -->
                                        {if $hotProduct->hasDiscounts()}
                                            <span class="d_b old_price">
                                                <!--
                                                "$hotProduct->firstVariant->toCurrency('OrigPrice')" or $hotProduct->firstVariant->getOrigPrice()
                                                output price without discount
                                                -->
                                                <span class="f-w_b" id="priceOrigVariant">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')}</span>
                                                {$CS}
                                            </span>                           
                                        {/if}
                                        <!--
                                        If there is a discount of "$hotProduct->firstVariant->toCurrency()" or "$hotProduct->firstVariant->getPrice"
                                        will display the price already discounted
                                        -->
                                        <span class="f-w_b" id="priceVariant">{echo $hotProduct->firstVariant->toCurrency()}</span>{$CS}
                                        <!--To display the amount of discounts you can use $hotProduct->firstVariant->getNumDiscount()-->
                                    </div>  
                                    {if $hotProduct->firstvariant->getstock()!=0}
                                        <button class="btn btn_buy" 
                                                type="button" 
                                                data-prodId="{echo $hotProduct->getId()}" 
                                                data-varId="{echo $hotProduct->firstVariant->getId()}" 
                                                data-price="{echo $hotProduct->firstVariant->toCurrency()}" 
                                                data-name="{echo $hotProduct->getName()}"
                                                data-number="{echo $hotProduct->firstVariant->getnumber()}"
                                                data-maxcount="{echo $hotProduct->firstVariant->getstock()}">
                                            {lang('s_buy')}
                                        </button>
                                    {else:}
                                        <button data-placement="bottom right"
                                                data-place="noinherit"
                                                data-duration="500"
                                                data-effect-off="fadeOut"
                                                data-effect-on="fadeIn"
                                                data-drop=".drop-report"
                                                data-prodid="{echo $hotProduct->getId()}"
                                                type="button"
                                                class="btn btn_not_avail">
                                            <span class="icon-but"></span>
                                            {lang('s_message_o_report')}
                                        </button> 
                                    {/if} 
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