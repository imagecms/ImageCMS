<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/category.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.ui-slider.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/filter.js"></script>
{$Comments = $CI->load->module('comments')->init($products)}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs($model->id, " / ")}
    </div>
</div>
{$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)}
{if count($banners)}
    <div class="frame_baner">
        <section class="carousel_js baner container">
            <div class="content-carousel">
                 <ul class="cycle">
                    {foreach $banners as $banner}
                        <li>
                            {if trim($banner['url']) != ""}
                                <a href="{echo $banner['url']}">
                                    <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                                </a>
                            {else:}
                                <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                            {/if}
                        </li>
                    {/foreach}
                </ul>
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </section>
    </div>
{/if}
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
                                {$CI->load->module('star_rating')->show_star_rating($p)}
                                {if $Comments[$p->getId()][0] != '0' && $p->enable_comments}
                                    <a href="{shop_url('product/'.$p->url.'#comment')}" class="count_response">
                                        {echo $Comments[$p->getId()]}
                                    </a>
                                {/if}
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

}
                                        <div class="{$var_class} var_{echo $v->id} prod_{echo $p->id}">
                                            {if is_in_wish($p->id, $v->id)}
                                                <div class="btn btn-order goWList" data-title="Уже в желаемых" data-rel="tooltip">
                                                    <button type="button" data-prodid="{echo $p->id}" data-varid="{echo $p->firstVariant->getId()}" class="inWishlist" data-title="В списке желаний" data-sectitle="В списке желаний">
                                                        <span class="icon-wish"></span>
                                                        <span class="text-el">Уже в желаемых</span>
                                                    </button>
                                                </div>
                                            {else:}
                                                <div class="btn btn-def {if $is_logged_in}toWList{else:}goEnter{/if}" data-title="В список желаний" data-varid="{echo $v->id}" data-prodid="{echo $p->id}" data-rel="tooltip">
                                                    <button type="button" data-prodid="{echo $p->id}" data-varid="{echo $p->firstVariant->getId()}" class="toWishlist" data-title="В списке желаний" data-sectitle="В списке желаний">
                                                        <span class="icon-wish"></span>
                                                        <span class="text-el">В список желаний</span>
                                                    </button>
                                                </div>
                                            {/if}
                                        </div>
                                        <!-- end of Wish List buttons -------------->
                                    {/foreach}

                                    <!-- compare buttons ----------------------->
                                    <div class="d_i-b">
                                    {if $forCompareProducts && in_array($p->id, $forCompareProducts)}
                                        <div class="btn btn-order goCompare {$dn_comp}" data-title="Сравнить" data-rel="tooltip">
                                            <button type="button" data-prodid="{echo $p->id}" data-varid="{echo $p->firstVariant->getId()}" class="inCompare"
                                                    data-title="В список сравнений" data-sectitle="В списке сравнений" >
                                                <span class="icon-compare"></span>
                                                <span class="text-el">Уже в сравнение</span>
                                            </button>
                                        </div>
                                        {else:}
                                        <div class="btn btn-def toCompare {$dn_gocomp}" data-title="В список сравнений"  data-prodid="{echo $p->id}" data-rel="tooltip">
                                            <button type="button" data-prodid="{echo $p->id}" data-varid="{echo $p->firstVariant->getId()}" class="toCompare"
                                                    data-title="В список сравнений" data-sectitle="В списке сравнений" >
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

        {$CI->load->module('module_frame')->init()}
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
{widget('popular_products')}