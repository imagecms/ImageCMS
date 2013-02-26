{if count(getPromoBlock($productsType, $productsCount))>0}
{$cart_data = ShopCore::app()->SCart->getData()}
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
                <div class="carousel">
                    <ul class="items items_catalog">
                        {foreach $products as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                            <li class="span3 {if $hotProduct->firstvariant->getstock()==0} not-avail{/if}">
                                <div class="description">
                                    <div class="frame_response">
                                        <div class="star">
                                            {$CI->load->module('star_rating')->show_star_rating($hotProduct)}
                                        </div>
                                    </div>
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="price price_f-s_16">
                                        {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstvariant->getPrice()}
                                                {$prTwo = $hotProduct->firstvariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstvariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstvariant->getPrice()}
                                            {/if}
                                        <span class="f-w_b">{echo $prThree} </span> {$CS}
                                        <span class="second_cash"></span>
                                    </div>
                                    {if $hotProduct->firstvariant->getstock()!=0}
                                        <button class="btn btn_buy" type="button" data-prodId="{echo $hotProduct->getId()}" data-varId="{echo $hotProduct->firstVariant->getId()}" data-price="{$prThree}" data-name="{echo $hotProduct->getName()}">{lang('add_to_basket')}</button>
                                    {else:}
                                        <button class="btn btn_not_avail" type="button">{lang('s_message_o_report')}</button>
                                    {/if} 
                                </div>
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="photo">
                                    <span class="helper"></span>
                                    <figure class="w_200 h_180">
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}"/>
                                    </figure>
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </section>    
    </div>
{/if}
                <!-- featured -->