{if count($products) > 0}    
<!--фрейм на елемент-->
<section class="container">
    <div class="frame_carousel_product carousel_js">
        <div class="m-b_20">
            <div class="title_h1 d_i-b v-a_m">{$title}</div>
            <div class="d_i-b groupButton v-a_m">
                <button type="button" class="btn btn_prev">
                    <span class="icon prev"></span>
                    <span class="text-el"></span>
                </button>
                <button type="button" class="btn btn_next">
                    <span class="icon next"></span>
                    <span class="text-el"></span>
                </button>
            </div>
        </div>
        <div class="carousel bot_border_grey">
            <ul class="items items_catalog">
                {foreach $products as $hotProduct}
                <li class="span3 {if $hotProduct->firstvariant->getStock()==0} not_avail{/if}">

                    <!-- product info block -->
                    <div class="description">
                        <div class="frame_response">

                            <!-- displaying product's rate -->
                            {$CI->load->module('star_rating')->show_star_rating($hotProduct)}

                            <!-- displaying comments count -->
                            {if $Comments[$hotProduct->getId()][0] != '0' && $hotProduct->enable_comments}
                            <a href="{shop_url('product/'.$hotProduct->url.'#comment')}" class="count_response">
                                {echo $Comments[$hotProduct->getId()]}
                            </a>
                            {/if}
                        </div>

                        <!-- displaying product name -->
                        <a href="{shop_url('product/'.$hotProduct->getUrl())}">
                            {echo ShopCore::encode($hotProduct->getName())}
                        </a>

                        <!-- displaying products first variant price and currency symbol -->
                        <div class="price price_f-s_16">
                            {if $hotProduct->hasDiscounts()}
                            <span class="d_b old_price">
                                <span class="f-w_b">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} </span>
                                {$CS}
                            </span>                           
                            {/if}
                            <span class="f-w_b">
                                {echo $hotProduct->firstVariant->toCurrency()}
                            </span> {$CS}&nbsp;&nbsp;
                            <span class="second_cash"></span>
                        </div>

                        <!-- displaying buy button according to its availability in stock -->


                        <!-- displaying notify button -->
                        {if $hotProduct->firstvariant->getstock()!=0}
                        <button class="btn btn_buy btnBuy" 
                                type="button" 
                                data-prodid="{echo $hotProduct->getId()}"
                                data-varid="{echo $hotProduct->firstVariant->getId()}"
                                data-price="{echo $hotProduct->firstVariant->toCurrency()}" 
                                data-name="{echo ShopCore::encode($hotProduct->getName())}"
                                data-maxcount="{echo $hotProduct->firstVariant->getstock()}"
                                data-number="{echo $hotProduct->firstVariant->getNumber()}"
                                data-img="{echo $hotProduct->firstVariant->getSmallPhoto()}"
                                data-url="{echo shop_url('product/'.$hotProduct->getUrl())}"
                                data-origprice="{if $hotProduct->hasDiscounts()}{echo $hotProduct->firstVariant->toCurrency('OrigPrice')}{/if}"
                                data-stock="{echo $hotProduct->firstVariant->getStock()}"
                                >
                            {lang('Купить','commerce4x')}
                        </button>
                        {else:}
                        <button
                                data-drop=".drop-report"
                                data-prodid="{echo $hotProduct->getId()}"
                                type="button"
                                class="btn btn_not_avail">
                            <span class="icon-but"></span>
                            {lang('Сообщить о появлении','commerce4x')}
                        </button> 
                        {/if} 

                        <!-- displaying products small mod image -->
                        <div class="photo-block">
                            <a href="{shop_url('product/'.$hotProduct->getUrl())}" class="photo">
                                <figure>
                                    <span class="helper"></span>
                                    <img src="{echo $hotProduct->firstVariant->getMediumPhoto()}" 
                                         alt="{echo ShopCore::encode($hotProduct->getName())} - {echo $hotProduct->getId()}"/>
                                </figure>
                            </a>
                        </div>
                </li>
                {/foreach}
            </ul>
        </div>
    </div>
</section>   
{/if}
<!-- featured -->