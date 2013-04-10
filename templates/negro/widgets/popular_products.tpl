{if count($products) > 0}
    <section class="special-proposition">
        <div class="title_h1 container">Горячие новинки</div>
        <div class="m-w_1090">
            <div class="carousel_js products-carousel">
                <div class="content-carousel container">
                    <ul class="items-catalog">
                        {foreach $products as $p}
                            <li>
                                <a href="{shop_url('product/' . $p->getUrl())}">
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" />
                                        <!-- creating hot bubble for products image if product is hot -->
                                        {if $p->getHot()}
                                            <span class="prod_status nowelty">{lang('s_shot')}</span>
                                        {/if}
                                        <!-- creating hot bubble for products image if product is hit -->
                                        {if $p->getHit()}
                                            <span class="prod_status hit">{lang('s_s_hit')}</span>
                                        {/if}
                                        <!-- creating hot bubble for products image if product is action -->
                                        {if $p->getAction()}
                                            <span class="prod_status action">{lang('s_saction')}</span>
                                        {/if}
                                    </span>
                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                </a>
                                <div class="description">
                                    <!-- displaying product's rate -->
                                    {$CI->load->module('star_rating')->show_star_rating($p)}
                                     <!-- Check for discount-->
                                    {if ShopCore::$ci->dx_auth->is_logged_in() === true && $p->firstVariant->toCurrency() != $p->firstVariant->toCurrency('OrigPrice')}
                                         {$discount =true}
                                    {/if}
                                    <!--                                    old price-->
                                    {if $p->hasDiscounts() && $discount}
                                        <div class="price-old-catalog">
                                            <span>Старая цена: <span class="old-price"><span>{echo $p->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
                                        </div>
                                    {/if}
<!--                                    Price with discount-->
                                    {if $p->firstVariant->toCurrency() > 0}
                                        <div class="price-catalog var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
                                            <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
                                            {echo $p->firstVariant->toCurrency('Price',1)} $
                                        </div>
                                    {/if}
                                </div>
                            </li>
                    {/foreach}
                    </ul>
                </div>
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </div>
    </section>
{/if}