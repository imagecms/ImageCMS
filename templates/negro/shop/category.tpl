<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/category.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.ui-slider.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/filter.js"></script>
{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs($model->id, " / ")}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog">
            <div class="f-s_0 title-head-ategory">
                <div class="d_i m-r_15">
                    <h1 class="d_i">{echo $model->name}</h1>
                </div>
                {if $totalProducts > 0}
                    <span class="count">(Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
                {/if}
            </div>

            {include_tpl('catalogue_header')}

            {if count($products) > 0}
                <ul class="items-catalog {if $_COOKIE['listtable'] == 1}list{/if}" id="items-catalog-main">
                    {foreach $products as $p}
                        <li>
                            <a href="{shop_url('product/' . $p->url)}">
                                <span class="photo-block">
                                    <span class="helper"></span>

                                    <img src="{productSmallImageUrl($p)}" alt="{echo ShopCore::encode($p->getName())} - {echo $p->getId()}"/>
                                    {if $p->old_price > $p->variants[0]->price}
                                        {$discount = round(100 - ($p->variants[0]->price / $p->old_price * 100))}
                                    {else:}
                                        {$discount = 0}
                                    {/if}
                                    {promoLabel($p->hit, $p->hot, $discount)}
                                </span>
                                <span class="title">{echo ShopCore::encode($p->name)}</span>
                            </a>
                            <div class="description">
                                {if count($p->getProductVariants()) > 1}
                                    <div class="check-variants m-b_15">
                                        <div class="title">Выберите вариант:</div>
                                        <div class="lineForm">
                                            <select name="variant" id="variant_{echo $p->id}" onchange="change_variant(this, {echo $p->getId()})">
                                                {foreach $p->getProductVariants() as $v}
                                                    <option value="{echo $v->getId()}">{echo $v->getName()}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                {/if}

                                <div class="star">
                                    <div class="d_i-b">
                                        {$rate = round(countRating($p->id) * 100 / 5)}
                                        {$width = "width:$rate%"}
                                        <div class="productRate star-small">
                                            <div style="{$width}"></div>
                                        </div>
                                    </div>
                                </div>
                                {if $p->old_price > $p->variants[0]->price}
                                    <div class="price-old-catalog">
                                        <span>Старая цена: <span class="old-price"><span>{echo round_price($p->old_price)} <span class="cur">{$CS}</span></span></span></span>
                                    </div>
                                {/if}
                                {$vcnt = 1}
                                {foreach $p->getProductVariants() as $v}
                                    {if $vcnt == 1}
                                        {$vcnt = NULL}{$var_class = '';}
                                    {else:}
                                        {$var_class = 'd_n';}
                                    {/if}
                                    {if $v->price > 0}
                                        <div class="price-catalog {$var_class} var_price_{echo $v->id} prod_price_{echo $p->id}">
                                            <div>{echo round_price($v->price)} <span class="cur">{$CS}</span></div>
                                        </div>
                                    {/if}
                                {/foreach}

                                <div class="f-s_0 func-button">
                                    {$vcnt = 1}
                                    {foreach $p->getProductVariants() as $v}
                                        {if $vcnt == 1}
                                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                                        {else:}
                                            {$var_class = 'd_n';}
                                        {/if}
                                        {if $v->stock > 0}
                                            <!-- buy/inCart buttons -------------------->
                                            <div class="{$var_class} var_{echo $v->id} prod_{echo $p->id}">

                                                {if is_in_cart($p->id, $v->id)}
                                                    <div class="btn btn-order goCart">
                                                        <button class="buyButton inCart"
                                                                type="button"
                                                                data-prodId="{echo $p->getId()}"
                                                                data-varId="{echo $p->firstVariant->getId()}"
                                                                data-price="{echo $p->firstVariant->toCurrency()}"
                                                                data-name="{echo $p->getName()}"
                                                                data-number="{echo $p->firstVariant->getnumber()}"
                                                                data-maxcount="{echo $p->firstVariant->getstock()}"
                                                                data-vname="{echo $p->firstVariant->getName()}">
                                                            <span class="icon-bask-buy"></span>
                                                            Уже в корзине
                                                        </button>
                                                    </div>
                                                {else:}
                                                    <div class="btn btn-buy goBuy ">
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
                                                {/if}

                                            </div>
                                            <!-- end of buy/inCart buttons ------------->
                                        {else:}
                                            <!-- нема в наявності -->
                                            <div class="{$var_class} var_{echo $v->id} prod_{echo $p->id} v-a_m not-avail_wrap">
                                                <span class="f-s_12 t-a_l">
                                                    <span class="d_b">Товара нет в наличии</span>
                                                    <button type="button" class="d_l_b f-s_12" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="bottom left">Сообщить</button> о появлении
                                                </span>
                                                <span class="datas">
                                                    <input type="hidden" name="ProductId" value="{echo $p->id}" />
                                                    <input type="hidden" name="VariantId" value="{echo $v->id}" />
                                                </span>
                                            </div>
                                        {/if}

                                        <!-- Wish List buttons --------------------->
                                        {if is_in_wish($p->id, $v->id)}
                                            {$dn_inwish = ""}{$dn_gowish = "d_n"}
                                        {else:}
                                            {$dn_inwish = "d_n"}{$dn_gowish = ""}
                                        {/if}
                                        <div class="{$var_class} var_{echo $v->id} prod_{echo $p->id}">
                                            <div class="btn btn-order goWList {$dn_inwish}" data-title="Уже в желаемых" data-rel="tooltip">
                                                <button type="button">
                                                    <span class="icon-wish"></span>
                                                    <span class="text-el">Уже в желаемых</span>
                                                </button>
                                            </div>
                                            <div class="btn btn-def {$dn_gowish} {if $is_logged_in}toWList{else:}goEnter{/if}" data-title="В список желаний" data-varid="{echo $v->id}" data-prodid="{echo $p->id}" data-rel="tooltip">
                                                <button type="button">
                                                    <span class="icon-wish"></span>
                                                    <span class="text-el">В список желаний</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- end of Wish List buttons -------------->
                                    {/foreach}

                                    <!-- compare buttons ----------------------->
                                    <div class="d_i-b">
                                    {if $forCompareProducts && in_array($p->id, $forCompareProducts)}
                                        <div class="btn btn-order goCompare {$dn_comp}" data-title="Сравнить" data-rel="tooltip">
                                            <button type="button">
                                                <span class="icon-compare"></span>
                                                <span class="text-el">Уже в сравнение</span>
                                            </button>
                                        </div>
                                        {else:}
                                        <div class="btn btn-def toCompare {$dn_gocomp}" data-title="В список сравнений"  data-prodid="{echo $p->id}" data-rel="tooltip">
                                            <button type="button">
                                                <span class="icon-compare"></span>
                                                <span class="text-el">В список сравнению</span>
                                            </button>
                                        </div>
                                    {/if}
                                    </div>

                                    <!-- end of compare buttons ---------------->
                                </div>

                                {if trim($p->short_description) != ""}
                                    <div class="short_desc">
                                        {echo $p->short_description}
                                    </div>
                                {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->id, 1)}
                                    <div class="short_desc">
                                        <p>{echo $props}</p>
                                    </div>
                                {/if}

                            </div>
                        </li>
                    {/foreach}
                </ul>
                {$pagination}
            {else:}
                <div class="alert alert-search-result">
                    <div class="title_h2 t-a_c">По вашему запросу товаров не найдено</div>
                </div>
            {/if}
        </div>

        <div class="left-catalog filter">
            <!-- selected filters block -->
            {$minPrice = (int)$priceRange.minCost;}
            {$maxPrice = (int)$priceRange.maxCost;}
            {if $_GET['lp']}
                {$curMin = (int)$_GET['lp'];}
            {else:}
                {$curMin = $minPrice;}
            {/if}
            {if $_GET['rp']}
                {$curMax = (int)$_GET['rp'];}
            {else:}
                {$curMax = $maxPrice;}
            {/if}

            {if $_GET['brand'] != "" || $_GET['p'] != "" || ($_GET['lp'] && $_GET['lp'] != $minPrice) || ($_GET['rp'] && $_GET['rp'] != $maxPrice)}
                <div class="frame-check-filter inside-padd">
                    <div class="title_h4">{echo count($products)} {echo SStringHelper::Pluralize(count($products), array('товар','товара','товаров'))} с фильтрами:</div>
                    <ul class="check-filter">
                        {if $curMin != $minPrice || $curMax != $maxPrice}
                            <li class="ref cleare_price"><span class="icon-remove"></span><div>Цена от {echo $_GET['lp']} до {echo $_GET['rp']} <span class="cur">{$CS}</span></div></li>
                        {/if}
                        {if count($brands) > 0}
                            {foreach $brands as $brand}
                                {foreach $_GET['brand'] as $id}
                                    {if $id == $brand->id}
                                        <li data-name="brand_{echo $brand->id}" class="cleare_filter ref"><span class="icon-remove"></span><div>{echo $brand->name}</div></li>
                                    {/if}
                                {/foreach}
                            {/foreach}
                        {/if}
                        {if count($propertiesInCat) > 0}
                            {foreach $propertiesInCat as $prop}
                                {foreach $prop->possibleValues as $key}
                                    {foreach $_GET['p'][$prop->property_id] as $nm}
                                        {if $nm == $key.value}
                                            <li data-name="p_{echo $prop->property_id}_{echo $key.id}" class="cleare_filter ref"><span class="icon-remove"></span><div>{echo $prop->name}: {echo $key.value}</div></li>
                                        {/if}
                                    {/foreach}
                                {/foreach}
                            {/foreach}
                        {/if}
                    </ul>
                    <button type="button" onclick="location.href = '{site_url($CI->uri->uri_string())}'" class="d_l_o">Сбросить фильтр</button>
                </div>
            {/if}
            <!-- end of selected filters block -->

            {if $totalProducts > 0}
                <form action="" method="get" id="catalog_form">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <div class="popup_container">
                        {include_tpl('filter')}
                    </div>
                </form>
            {/if}
        </div>
    </div>
</div>
{if trim($model->description) != ""}
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {echo trim($model->description)}
            </div>
        </div>
    </div>
{/if}