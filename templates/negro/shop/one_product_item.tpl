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
            {$CI->load->module('star_rating')->show_star_rating($p)}
            {if $p->hasDiscounts()}
                <div class="price-old-catalog">
                    <span>Старая цена: <span class="old-price"><span>{echo $p->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
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
                        <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
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
                        {if $p->firstvariant->getstock() != 0}
                            <!-- buy/inCart buttons -------------------->
                            <div class="{$var_class} var_{echo $v->getId()} prod_{echo $p->getId()}">
                                 <button class="btn btn_buy"
                                        type="button"
                                        data-prodId="{echo $p->getId()}"
                                        data-varId="{echo $p->firstVariant->getId()}"
                                        data-price="{echo $p->firstVariant->toCurrency()}"
                                        data-name="{echo $p->getName()}"
                                        data-number="{echo $p->firstVariant->getnumber()}"
                                        data-maxcount="{echo $p->firstVariant->getstock()}"
                                        data-vname="{echo $p->firstVariant->getName()}">
                                    {lang('s_buy')}
                                </button>
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