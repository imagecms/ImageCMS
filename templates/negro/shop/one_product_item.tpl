{if !$promos && $products}{$promos = $products}{/if}
{foreach $promos as $p}
    {$Comments = $CI->load->module('comments')->init($p)}
    <li>
        <a href="{shop_url('product/' . $p->getUrl())}">
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{productSmallImageUrl($p)}" alt="{echo ShopCore::encode($p->getName())}" />
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
            {$CI->load->module('star_rating')->show_star_rating($p)}
            {if $Comments[$p->getId()][0] != '0' && $p->enable_comments}
                <a href="{shop_url('product/'.$p->url.'#comment')}" class="count_response">
                    {echo $Comments[$p->getId()]}
                </a>
            {/if}
            <!-- Check for discount-->
            {if ShopCore::$ci->dx_auth->is_logged_in() === true && $p->firstVariant->toCurrency() != $p->firstVariant->toCurrency('OrigPrice')}
                 {$discount =true}
            {/if}
<!--           Start. Old price-->
            {if $p->hasDiscounts() && $discount}
                <div class="price-old-catalog">
                    <span>Старая цена: <span class="old-price"><span>{echo $p->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
                </div>
            {/if}
<!--            End. Old price-->
<!--            Start. Price-->
            {if $p->firstVariant->toCurrency() > 0}
                <div class="price-catalog var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
                    <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
                </div>
            {/if}
<!--            End. Price-->
            {if $CI->uri->segment(2) == "category" || $CI->uri->segment(2) == "brand" || $CI->uri->segment(2) == "search" || $CI->uri->segment(2) == "compare" || $CI->uri->segment(2) == "wish_list"}
                <div class="f-s_0 func-button">
                        {if $p->firstvariant->getstock() != 0}
                        <!-- buy/inCart button -------------------->
                            <div class="btn-buy">
                                <button class="buyButton toCart"
                                        type="button"
                                        data-prodId="{echo $p->getId()}"
                                        data-varId="{echo $p->firstVariant->getId()}"
                                        data-price="{echo $p->firstVariant->toCurrency()}"
                                        data-name="{echo $p->getName()}"
                                        data-number="{echo $p->firstVariant->getnumber()}"
                                        data-maxcount="{echo $p->firstVariant->getstock()}"
                                        data-vname="{echo $p->firstVariant->getName()}">
                                    <span class="icon_cleaner_buy"></span>
                                    <span class="text-el">{lang('s_buy')}</span>
                                </button>
                            </div>
                        <!-- end of buy/inCart buttons ------------->
                        {else:}
                            <!-- Start. Notify button -->
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
                            <!-- End. Notify button -->
                        {/if}
<!--                     Add to wishlist, if $CI->uri->segment(2) != "wish_list"-->
                        {if $CI->uri->segment(2) != "wish_list"}
                            <!-- Wish List buttons --------------------->
                            <div class="var_{echo $p->firstVariant->getId()} f_l prod_{echo $p->getId()}">
                                <div class="btn-def" data-title="В список желаний" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                    <button class="toWishlist"
                                        data-prodid="{echo $p->getId()}"
                                        data-varid="{echo $p->firstVariant->getId()}"
                                        type="button"
                                        data-title="{lang('s_add_to_wish_list')}"
                                        data-sectitle="{lang('s_in_wish_list')}"
                                        data-rel="tooltip">
                                    <span class="icon_wish"></span>
                                    <span class="text-el">{lang('s_add_to_wish_list')}</span>
                                </button>
                                </div>
                            </div>
                            <!-- end of Wish List buttons -------------->
                        {/if}
<!--                     Add to compare, if $CI->uri->segment(2) != "compare"-->
                   {if $CI->uri->segment(2) != "compare"}
                        <!-- compare buttons ----------------------->
                        <div class="d_i-b">
                            <div class="btn-def f_l" data-title="В список сравнений"  data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                <button class="toCompare"
                                        data-prodid="{echo $p->getId()}"
                                        type="button"
                                        data-title="{lang('s_add_to_compare')}"
                                        data-sectitle="{lang('s_in_compare')}"
                                        data-rel="tooltip">
                                    <span class="icon_compare"></span>
                                    <span class="text-el">{lang('s_add_to_compare')}</span>
                                </button>
                            </div>
                        </div>
                        <!-- end of compare buttons ---------------->
                    {/if}
<!--                    Start. Description-->
                    {if trim($p->getShortDescription()) != ''}
                        <div class="short_desc">
                            {echo $p->getShortDescription()}
                        </div>
                    {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId(), 1)}
                        <div class="short_desc">
                            <p>{echo $props}</p>
                        </div>
                    {/if}
                    <!-- End. Description-->
                </div>     
            {/if}
        </div>
<!--        Start. Remove buttons if compare or wishlist-->
        {if $CI->uri->segment(2) == "compare"}
            <button type="button" class="icon_times-order deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
        {/if}
        {if $CI->uri->segment(2) == "wish_list" && ShopCore::$ci->dx_auth->is_logged_in() === true}
            <button data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $p->getId()}, this)" class="icon_times-order"></button>
        {/if}
<!--        End. Remove buttons if compare or wishlist-->
    </li>
{/foreach}