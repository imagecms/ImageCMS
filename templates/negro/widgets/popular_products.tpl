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
                                        {if $p->getMainModimage()}
                                            <img src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->getName())}" />
                                        {else:}
                                            <img src="{productImageUrl('no_mm.png')}" alt="{echo ShopCore::encode($p->getName())}" />
                                        {/if}
                        <!--                Discount in percents-->
                                        {if ShopCore::$ci->dx_auth->is_logged_in() === true && $p->firstVariant->toCurrency() != $p->firstVariant->toCurrency('OrigPrice')}
                                             {$discount = round(100 - ($p->firstVariant->toCurrency() / $p->firstVariant->toCurrency('OrigPrice') * 100))}
                                        {/if}
                                        {promoLabel($p->getHit(), $p->getHot(), $discount)}
                                    </span>
                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                </a>
                                <div class="description">
                                    {$CI->load->module('star_rating')->show_star_rating($p)}
                                    {if $discount}
                                        <div class="price-old-catalog">
                                            <span>Старая цена: <span class="old-price"><span>{echo $p->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
                                        </div>
                                    {/if}
                                    {if $p->firstVariant->toCurrency() > 0}
                                        <div class="price-catalog var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
                                            <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
                                            {echo $p->firstVariant->toCurrency('Price',1)} $
                                        </div>
                                    {/if}
                                    {if $CI->uri->segment(2) == "category" || $CI->uri->segment(2) == "brand" || $CI->uri->segment(2) == "search" || $CI->uri->segment(2) == "compare" || $CI->uri->segment(2) == "wish_list"}
                                        <div class="f-s_0 func-button">
                                                {if $p->firstvariant->getstock() != 0}
                                                <!-- buy/inCart button -------------------->
                                                    <div class="btn btn-buy goBuy f_l">
                                                        <button class="buyButton toCart"
                                                                type="button"
                                                                data-prodId="{echo $p->getId()}"
                                                                data-varId="{echo $p->firstVariant->getId()}"
                                                                data-price="{echo $p->firstVariant->toCurrency()}"
                                                                data-name="{echo $p->getName()}"
                                                                data-number="{echo $p->firstVariant->getnumber()}"
                                                                data-maxcount="{echo $p->firstVariant->getstock()}"
                                                                data-vname="{echo $p->firstVariant->getName()}">
                                                            <span class="icon-bask-buy"></span>
                                                            {lang('s_buy')}
                                                        </button>
                                                    </div>
                                                <!-- end of buy/inCart buttons ------------->
                                                {else:}
                                                    <!-- нема в наявності -->
                                                    <div class="d_i-b f_l var_{echo $p->firstVariant->getId()} prod_{echo $p->getId()} v-a_m not-avail_wrap">
                                                        <span class="f-s_12 t-a_l">
                                                            <span class="d_b">Товара нет в наличии</span>
                                                            <button type="button" class="d_l_b f-s_12" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="bottom left">Сообщите</button> о появлении
                                                        </span>
                                                        <span class="datas">
                                                            <input type="hidden" name="ProductId" value="{echo $p->getId()}" />
                                                            <input type="hidden" name="VariantId" value="{echo $p->firstVariant->getId()}" />
                                                        </span>
                                                    </div>
                                                {/if}
                                                {if $CI->uri->segment(2) != "wish_list"}
                                                    <!-- Wish List buttons --------------------->
                                                    <div class="var_{echo $p->firstVariant->getId()} f_l prod_{echo $p->getId()}">
                                                        <div class="btn btn-def" data-title="В список желаний" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                                            <button class="toWishlist"
                                                                data-prodid="{echo $p->getId()}"
                                                                data-varid="{echo $p->firstVariant->getId()}"
                                                                type="button"
                                                                data-title="{lang('s_add_to_wish_list')}"
                                                                data-sectitle="{lang('s_in_wish_list')}"
                                                                data-rel="tooltip">
                                                            <span class="icon-wish"></span>
                                                            <span class="text-el">{lang('s_add_to_wish_list')}</span>
                                                        </button>
                                                        </div>
                                                    </div>
                                                    <!-- end of Wish List buttons -------------->
                                                {/if}
                                           {if $CI->uri->segment(2) != "compare"}
                                                <!-- compare buttons ----------------------->
                                                <div class="d_i-b">
                                                    <div class="btn btn-def f_l" data-title="В список сравнений"  data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                                        <button class="toCompare"
                                                                data-prodid="{echo $p->getId()}"
                                                                type="button"
                                                                data-title="{lang('s_add_to_compare')}"
                                                                data-sectitle="{lang('s_in_compare')}"
                                                                data-rel="tooltip">
                                                            <span class="icon-compare"></span>
                                                            <span class="text-el">{lang('s_add_to_compare')}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end of compare buttons ---------------->
                                            {/if}
                                            {if trim($p->getShortDescription()) != ''}
                                                <div class="short_desc">
                                                    {echo $p->getShortDescription()}
                                                </div>
                                            {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId(), 1)}
                                                <div class="short_desc">
                                                    <p>{echo $props}</p>
                                                </div>
                                            {/if}
                                        </div>     
                                    {/if}
                                </div>
                                {if $CI->uri->segment(2) == "compare"}
                                    <button type="button" class="icon-times-order deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
                                {/if}
                                {if $CI->uri->segment(2) == "wish_list" && ShopCore::$ci->dx_auth->is_logged_in() === true}
                                    <button data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $p->getId()}, this)" class="icon-times-order"></button>
                                {/if}
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