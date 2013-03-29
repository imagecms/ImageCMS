{if !$promos && $products}{$promos = $products}{/if}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}

{foreach $promos as $p}
    <li>
        <a href="{shop_url('product/' . $p->getUrl())}">
            <span class="photo-block">
                <span class="helper"></span>
                {if $p->getMainModimage()}
                    <img src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->getName())}" />
                {else:}
                    <img src="{productImageUrl('no_mm.png')}" alt="{echo ShopCore::encode($p->getName())}" />
                {/if}
            </span>
            <span class="title">{echo ShopCore::encode($p->getName())}</span>
        </a>
        <div class="description">
            <div class="star">
                <div class="d_i-b">
                    {$rate = round($p->getRating() * 100 / 5)}
                    {$width = "width:$rate%"}
                    <div class="productRate star-small">
                        <div style="{$width}"></div>
                    </div>
                </div>
            </div>
            {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                <div class="price-old-catalog">
                    <span>Старая цена: <span class="old-price"><span>{echo round_price($p->getOldPrice())} <span class="cur">{$CS}</span></span></span></span>
                </div>
            {/if}
            {$vcnt = 1}
            {foreach $p->getProductVariants() as $v}
                {if $vcnt == 1}
                    {$vcnt = NULL}{$var_class = '';}
                {else:}
                    {$var_class = 'd_n';}
                {/if}
                {if $v->getPrice() > 0}
                    <div class="price-catalog {$var_class} var_price_{echo $v->getId()} prod_price_{echo $p->getId()}">
                        <div>{echo $v->getPrice()} <span class="cur">{$CS}</span></div>
                    </div>
                {/if}
            {/foreach}
            {if $CI->uri->segment(2) == "category" || $CI->uri->segment(2) == "brand" || $CI->uri->segment(2) == "search" || $CI->uri->segment(2) == "compare" || $CI->uri->segment(2) == "wish_list"}
                <div class="f-s_0 func-button">
                    {$vcnt = 1}
                    {foreach $p->getProductVariants() as $v}
                        {if $vcnt == 1}
                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                        {else:}
                            {$var_class = 'd_n';}
                        {/if}
                        {if $v->getStock() > 0}
                            <!-- buy/inCart buttons -------------------->
                            {if is_in_cart($p->getId(), $v->getId())}
                                {$dn_incart = ""}{$dn_gobuy = "d_n"}
                            {else:}
                                {$dn_incart = "d_n"}{$dn_gobuy = ""}
                            {/if}
                            <div class="{$var_class} var_{echo $v->getId()} prod_{echo $p->getId()}">
                                <div class="btn btn-order goCart SProducts_{echo $p->getId()}_{echo $v->getId()} {$dn_incart}">
                                    <button type="button">Уже в корзине</button>
                                </div>
                                <div class="btn btn-buy goBuy {$dn_gobuy}" data-varid="{echo $v->getId()}" data-prodid="{echo $p->getId()}">
                                    <button type="button">
                                        <span class="icon-bask-buy"></span>В корзину
                                    </button>
                                </div>
                            </div>
                            <!-- end of buy/inCart buttons ------------->
                        {else:}
                            <!-- нема в наявності -->
                            <div class="{$var_class} var_{echo $v->getId()} prod_{echo $p->getId()} v-a_m not-avail_wrap">
                                <span class="f-s_12 t-a_l">
                                    <span class="d_b">Товара нет в наличии</span>
                                    <button type="button" class="d_l_b f-s_12" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="bottom left">Сообщите</button> о появлении
                                </span>
                                <span class="datas">
                                    <input type="hidden" name="ProductId" value="{echo $p->getId()}" />
                                    <input type="hidden" name="VariantId" value="{echo $v->getId()}" />
                                </span>
                            </div>
                        {/if}

                        {if $CI->uri->segment(2) != "wish_list"}
                            <!-- Wish List buttons --------------------->
                            {if is_in_wish($p->getId(), $v->getId())}
                                {$dn_inwish = ""}{$dn_gowish = "d_n"}
                            {else:}
                                {$dn_inwish = "d_n"}{$dn_gowish = ""}
                            {/if}
                            <div class="{$var_class} var_{echo $v->getId()} prod_{echo $p->getId()}">
                                <div class="btn btn-order goWList {$dn_inwish}" data-title="Уже в желаемых" data-rel="tooltip">
                                    <button type="button">
                                        <span class="icon-wish"></span>
                                        <span class="text-el">Уже в желаемых</span>
                                    </button>
                                </div>
                                <div class="btn btn-def {$dn_gowish} {if $is_logged_in}toWList{else:}goEnter{/if}" data-title="В список желаний" data-varid="{echo $v->getId()}" data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                    <button type="button">
                                        <span class="icon-wish"></span>
                                        <span class="text-el">В список желаний</span>
                                    </button>
                                </div>
                            </div>
                            <!-- end of Wish List buttons -------------->
                        {/if}
                    {/foreach}

                    {if $CI->uri->segment(2) != "compare"}
                        <!-- compare buttons ----------------------->
                        {if $forCompareProducts && in_array($p->id, $forCompareProducts)}
                            {$dn_comp = ""}{$dn_gocomp = "d_n"}
                        {else:}
                            {$dn_comp = "d_n"}{$dn_gocomp = ""}
                        {/if}
                        <div class="d_i-b">
                            <div class="btn btn-order goCompare {$dn_comp}" data-title="Сравнить" data-rel="tooltip">
                                <button type="button">
                                    <span class="icon-compare"></span>
                                    <span class="text-el">Уже в сравнению</span>
                                </button>
                            </div>
                            <div class="btn btn-def toCompare {$dn_gocomp}" data-title="В список сравнений"  data-prodid="{echo $p->getId()}" data-rel="tooltip">
                                <button type="button">
                                    <span class="icon-compare"></span>
                                    <span class="text-el">В список сравнений</span>
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
            <button type="button" class="icon-times-order deleteFromCompare" data-pid="{echo $p->getId()}"></button>
        {/if}
        {if $CI->uri->segment(2) == "wish_list" && ShopCore::$ci->dx_auth->is_logged_in() === true}
            <button onclick="location.href='{shop_url('wish_list/delete/' . $wishItemKey)}'" type="button" class="icon-times-order"></button>
        {/if}
    </li>
{/foreach}