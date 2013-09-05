{if count($products) > 0}    
<!--фрейм на елемент-->
<section class="container">
    <div class="frame_carousel_product carousel_js vertical_carousel">
        <div>
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
                {foreach $products as $hotProduct}
                <li class="span3 {if $hotProduct->firstvariant->getStock()==0} not-avail{/if}">

                    <!-- product info block -->
                    <div class="description">

                        <!-- displaying product name -->
                        <a href="{shop_url('product/'.$hotProduct->getUrl())}">
                            {echo ShopCore::encode($hotProduct->getName())}
                        </a>
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
                        {if $hotProduct->getShortDescription() != '' && $hotProduct->getShortDescription() != ' ' && $hotProduct->getShortDescription() != null}
                        <div class="text-desription">{echo $hotProduct->getShortDescription()}</div>
                        {/if}
                    </div>
                    <div class="footer_items_vertical_catalog c_b clearfix">
                        <div class="f_l">
                            <!-- displaying products first variant price and currency symbol -->
                            <div class="price price_f-s_14">
                                {if $hotProduct->hasDiscounts()}
                                <span class="old_price v-a_m">
                                    <span class="f-w_b">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} </span>
                                    <span class="cur">{$CS}</span>
                                </span>                           
                                {/if}
                                <span class="f-s_21 v-a_m">
                                    <span class="f-w_b">
                                        {echo $hotProduct->firstVariant->toCurrency()}
                                    </span>
                                    <span class="cur">{$CS}</span>
                                    <span class="second_cash"></span>
                                </span>
                            </div>
                        </div>
                        <!-- displaying buy button according to its availability in stock -->
                        <div class="f_r">
                            <!-- displaying notify button -->
                            {if $hotProduct->firstvariant->getstock()!=0}
                                <a class="btn btn_buy" href="{shop_url('product/' . $hotProduct->getUrl())}">{lang('s_more')}</a>
                               
                              <!--  <button class="btn btn_buy btnBuy" 
                                        type="button" 


                                        data-id="{echo $hotProduct->firstvariant->getId()}"
                                        data-prodid="{echo $hotProduct->getId()}"
                                        data-varid="{echo $hotProduct->firstvariant->getId()}"
                                        data-price="{echo $hotProduct->firstvariant->toCurrency()}"
                                        data-name="{echo ShopCore::encode($hotProduct->getName())}"
                                        data-vname="{echo ShopCore::encode($hotProduct->firstvariant->getName())}"
                                        data-maxcount="{echo $hotProduct->firstvariant->getstock()}"
                                        data-number="{echo $hotProduct->firstvariant->getNumber()}"
                                        data-img="{echo $hotProduct->firstvariant->getSmallPhoto()}"
                                        data-mainImage="{echo $hotProduct->firstvariant->getMainPhoto()}"
                                        data-largeImage="{echo $hotProduct->firstvariant->getlargePhoto()}"
                                        data-origPrice="{if $hotProduct->hasDiscounts()}{echo $hotProduct->firstvariant->toCurrency('OrigPrice')}{/if}"
                                        data-stock="{echo $hotProduct->firstvariant->getStock()}"
                                        >
                                    {lang('s_more')}
                                </button> -->
                               
                            {else:}
                            <button data-placement="bottom right"
                                    data-place="noinherit"
                                    data-duration="500"
                                    data-effect-off="fadeOut"
                                    data-effect-on="fadeIn"
                                    data-drop=".drop-report"
                                    data-id="{echo $hotProduct->firstvariant->getId()}"
                                        data-prodid="{echo $hotProduct->getId()}"
                                        data-varid="{echo $hotProduct->firstvariant->getId()}"
                                        data-price="{echo $hotProduct->firstvariant->toCurrency()}"
                                        data-name="{echo ShopCore::encode($hotProduct->getName())}"
                                        data-vname="{echo ShopCore::encode($hotProduct->firstvariant->getName())}"
                                        data-maxcount="{echo $hotProduct->firstvariant->getstock()}"
                                        data-number="{echo $hotProduct->firstvariant->getNumber()}"
                                        data-img="{echo $hotProduct->firstvariant->getSmallPhoto()}"
                                        data-mainImage="{echo $hotProduct->firstvariant->getMainPhoto()}"
                                        data-largeImage="{echo $hotProduct->firstvariant->getlargePhoto()}"
                                        data-origPrice="{if $hotProduct->hasDiscounts()}{echo $hotProduct->firstvariant->toCurrency('OrigPrice')}{/if}"
                                        data-stock="{echo $hotProduct->firstvariant->getStock()}"
                                    type="button"
                                    class="btn btn_not_avail">
                                <span class="icon-but"></span>
                                {lang('s_message_o_report')}
                            </button> 
                            {/if}
                        </div>
                    </div>
                    <!-- displaying products small mod image -->
                    <div class="photo-block">
                        <a href="{shop_url('product/'.$hotProduct->getUrl())}" class="photo">
                            <figure>
                                <span class="helper"></span>
                                <img src="{echo $hotProduct->firstvariant->getMediumPhoto()}" 
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