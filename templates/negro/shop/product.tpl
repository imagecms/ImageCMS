<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/category.js"></script>
{$month = array(1=>'Января', 2=>'Февраля', 3=>'Марта', 4=>'Апреля', 5=>'Мая', 6=>'Июня', 7=>'Июля', 8=>'Августа', 9=>'Сентября', 10=>'Октября', 11=>'Ноября', 12=>'Декабря')}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs($model->getCategoryId(), " / ", $model->getName())}

    </div>
</div>
{$Comments = $CI->load->module('comments')->init($model)}
<div class="frame-inside">
    <div class="container">
        <div class="clearfix item-product">
            <div class="right-product">
                <div class="f-s_0 title-head-ategory">
                    <div class="d_i m-r_15">
                        <h1 class="d_i">{echo $model->getName()}</h1>
                    </div>
                    {$vcnt = 1}
                    {foreach $model->getProductVariants() as $v}
                        {if $vcnt == 1}
                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                        {else:}
                            {$var_class = 'd_n';}
                        {/if}
                        {if $v->getNumber()}
                            <span class="{$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <span class="code">Код: {echo $v->getNumber()}</span>
                            </span>
                        {/if}
                    {/foreach}
                </div>
                <div class="f-s_0 buy-block">
                    {if count($model->getProductVariants()) > 1}
                        <div class="v-a_b d_i-b">
                            <div class="d_i-b check-variants">
                                <div class="title">Выберите вариант:</div>
                                <div class="lineForm">
                                    <select name="variant" id="variant" onchange="change_variant(this, {echo $model->getId()})">
                                        {$vcnt = 1}
                                        {foreach $model->getProductVariants() as $v}
                                            <option value="{echo $v->getId()}" {if $vcnt == 1}selected="selected"{$vcnt = NULL}{/if}>{echo $v->getName()}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                        </div>
                    {/if}
                    {if $model->getOldPrice() > $model->firstVariant->getPrice()}
                        <div class="v-a_b d_i-b">
                            <div class="price-old-catalog">
                                <span>Старая цена: <span class="old-price"><span>{echo $model->getOldPrice()} <span class="cur">{$CS}</span></span></span></span>
                            </div>
                        </div>
                    {/if}

                    {$vcnt = 1}
                    {foreach $model->getProductVariants() as $v}
                        {if $vcnt == 1}
                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                        {else:}
                            {$var_class = 'd_n';}
                        {/if} 
                        {if $v->getPrice() > 0}
                            <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <div class="price-product">
                                    <div>{echo $v->toCurrency()} <span class="cur">{$CS}</span></div>
                                </div>
                            </div>
                        {/if}
                    {/foreach}

                    <br />

                    {$vcnt = 1}
                    {foreach $model->getProductVariants() as $v}
                        {if $vcnt == 1}
                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                        {else:}
                            {$var_class = 'd_n';}
                        {/if} 
                        {if $v->getStock() > 0}
                            <!-- buy/inCart buttons -------------------->
                            {if is_in_cart($model->getId(), $v->getId())}
                                {$dn_incart = ""}{$dn_gobuy = "d_n"}
                            {else:}
                                {$dn_incart = "d_n"}{$dn_gobuy = ""}
                            {/if}
                            <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <div class="btn btn-order-product goCart SProducts_{echo $model->getId()}_{echo $v->getId()} {$dn_incart}">
                                    <button>Уже в корзине</button>
                                </div>
                                <div class="btn btn-buy-product goBuy {$dn_gobuy}" data-varid="{echo $v->getId()}" data-prodid="{echo $model->getId()}">
                                    <button 
                                        data-prodid="{echo $model->getId()}"
                                        data-varid="{echo $model->firstVariant->getId()}"
                                        data-price="{echo $model->firstVariant->toCurrency()}"
                                        data-name="{echo ShopCore::encode($model->getName())}"
                                        data-number="{echo $model->firstVariant->getnumber()}"
                                        data-maxcount="{echo $model->firstVariant->getstock()}"
                                        data-prodpage="true"
                                        >
                                        <span class="icon icon-bask-buy"></span>
                                        {lang('s_buy')}
                                    </button>
                                </div>
                            </div>                            
                            <!-- end of buy/inCart buttons ------------->
                        {else:}
                            <!-- нема в наявності -->
                            <div class="{$var_class} v-a_b not-avail_wrap var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <span class="helper v-a_b"></span>
                                <span class="f-s_12 t-a_l v-a_b">
                                    <span class="d_b">Товара нет в наличии</span>
                                    <button type="button" class="d_l_b f-s_12" 
                                            data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="bottom left">Сообщить</button> о появлении
                                </span>
                                <span class="datas">
                                    <input type="hidden" name="ProductId" value="{echo $model->getId()}" />
                                    <input type="hidden" name="VariantId" value="{echo $v->getId()}" />
                                </span>
                            </div>
                        {/if}
                        <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                            <div class="btn btn-order" data-event="buy" data-drop=".drop-order-call" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">
                                <button data-prodid="{echo $model->getId()}" data-varid="{echo $v->getId()}" data-comment="Заказан товар: {echo $model->getName()}{if count($model->getProductVariants()) > 1}, вариант: {echo $v->getName()}{/if}">
                                    Купить в 1 клик
                                </button>
                            </div>
                        </div>
                    {/foreach}

                    <br />

                    {$vcnt = 1}
                    {foreach $model->getProductVariants() as $v}
                        {if $vcnt == 1}
                            {$vcnt = NULL}{$var_class = 'd_i-b';}
                        {else:}
                            {$var_class = 'd_n';}
                        {/if} 

                        <!-- Product Spy buttons --------------------->
                        <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                            {if is_in_spy($_SESSION[DX_user_id], $v->getId())}
                                {$dn_inspy = ""}{$dn_tospy = "d_n"}
                            {else:}
                                {$dn_inspy = "d_n"}{$dn_tospy = ""}
                            {/if}
                            <div class="btn btn-order inSpy {$dn_inspy}">
                                <button type="button">
                                    <span class="icon-watch-price"></span>
                                    <span class="text-el">Слежение за ценой</span>
                                </button>
                            </div>
                            <div class="btn btn-def {if $is_logged_in}toSpy{else:}goEnter{/if} {$dn_tospy}" data-pp="{echo $v->getPrice()}" data-uid="{echo $_SESSION[DX_user_id]}" data-vid="{echo $v->getId()}" data-pid="{echo $model->getId()}">
                                <button type="button">
                                    <span class="icon-watch-price"></span>
                                    <span class="text-el">Следить за ценой</span>
                                </button>
                            </div>
                        </div>
                        <!-- End of Product Spy buttons ------------>

                        <!-- Wish List buttons --------------------->
                        {if is_in_wish($model->getId(), $v->getId())}
                            {$dn_inwish = ""}{$dn_gowish = "d_n"}
                        {else:}
                            {$dn_inwish = "d_n"}{$dn_gowish = ""}
                        {/if}
                        <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                            <div class="btn btn-order goWList {$dn_inwish}" data-title="Уже в желаемых">
                                <button type="button">
                                    <span class="icon-wish"></span>
                                    <span class="text-el">Уже в желаемых</span>
                                </button>
                            </div>
                            <div class="btn btn-def {$dn_gowish} {if $is_logged_in}toWList{else:}goEnter{/if}" data-title="В список желаний" data-varid="{echo $v->getId()}" data-prodid="{echo $model->getId()}">
                                <button type="button"
                                        data-prodid="{echo $model->getId()}" 
                                        data-varid="{echo $model->firstVariant->getId()}"  
                                        type="button" 
                                        data-title="{lang('s_add_to_wish_list')}"
                                        data-sectitle="{lang('s_in_wish_list')}"
                                        data-rel="tooltip"
                                        >
                                    <span class="icon-wish"></span>
                                    <span class="text-el">{lang('s_slw')}</span>
                                </button>
                            </div>
                        </div>
                        <!-- end of Wish List buttons -------------->
                    {/foreach}

                    <!-- compare buttons ----------------------->
                    {if $forCompareProducts && in_array($model->id, $forCompareProducts)}
                        {$dn_comp = ""}{$dn_gocomp = "d_n"}
                    {else:}
                        {$dn_comp = "d_n"}{$dn_gocomp = ""}
                    {/if}
                    <div class="v-a_b d_i-b">
                        <div class="btn btn-order goCompare {$dn_comp}" data-title="Уже в сравнение">
                            <button type="button">
                                <span class="icon-compare"></span>
                                <span class="text-el">Уже в сравнению</span>
                            </button>
                        </div>
                        <div class="btn btn-def toCompare {$dn_gocomp}" data-title="В список сравнений"  data-prodid="{echo $model->getId()}">
                            <button type="button">
                                <span class="icon-compare"></span>
                                <span class="text-el"
                                      data-prodid="{echo $model->getId()}"  
                                      type="button" 
                                      data-title="{lang('s_add_to_compare')}"
                                      data-sectitle="{lang('s_in_compare')}"
                                      data-rel="tooltip"
                                      >{lang('s_add_to_compare')}</span>
                            </button>
                        </div>
                    </div>
                    <!-- end of compare buttons ---------------->
                </div>

                {if trim($model->getShortDescription()) != ''}
                    <div class="small-description">
                        {echo $model->getShortDescription()}
                    </div>
                {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($model->getId(), 1)}
                    <div class="small-description">
                        <p>{echo $props}</p>
                    </div>
                {/if}
                <dl class="social-product">
                    <dt><span class="title_h4">Понравился товар?</span></dt>
                    <dt><span class="title_h4">Расскажи друзьям</span></dt>
                    <dd class="social">
                        {echo $CI->load->module('share')->_make_share_form()}
                    </dd>
                </dl>

                <ul class="delivery-payment_product clearfix">
                    <li>
                        <span class="icon-delivery"></span>
                        <div>
                            <div class="title">Доставка</div>
                            <ul>
                                {foreach $delivery_methods as $dm}
                                    <li>{echo $dm->getName()} 
                                        <span class="green">
                                            {if (int)$dm->getPrice() == 0}
                                                (Бесплатно)
                                            {elseif $dm->getPrice() < 0}
                                                <br />(Стоимость согласно тарифам перевозчика)
                                            {else:}
                                                ({echo $dm->getPrice()} {$CS})
                                            {/if}
                                        </span>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    </li>
                    <li>
                        <span class="icon-payment"></span>
                        <div>
                            <div class="title">Оплата</div>
                            <ul>
                                {foreach $payments_methods as $pm}
                                    <li>{echo $pm->getName()}</li>
                                {/foreach}
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="left-product">
                {$vcnt = 1}
                {foreach $model->getProductVariants() as $v}
                    {if $vcnt == 1}
                        {$vcnt = NULL}{$var_class = 'd_b';}{$rel = 'rel="group"'}
                    {else:}
                        {$var_class = 'd_n';}{$rel = ''}
                    {/if}
                    <a {$rel} class="{$var_class} var_photo_{echo $v->getId()} prod_photo_block" href="#main_pic_{echo $v->getId()}">
                        <span class="photo-block">
                            <span class="helper"></span>
                            <img src="{productImageUrl($v->getMainImage())}" alt="{echo $model->getName() ." - ".$v->getName()}" />

                            {if $model->getOldPrice() > $model->firstVariant->getPrice()}
                                {$discount = round(100 - ($model->firstVariant->getPrice() / $model->getOldPrice() * 100))}
                            {else:}
                                {$discount = 0}
                            {/if}
                            {promoLabel($model->getHit(), $model->getHot(), $discount)}
                        </span>
                    </a>
                {/foreach}

                <div class="clearfix m-b_10">
                    <div class="star f_l">
                        <div class="d_i-b">
                            {$rate = round($model->getRating() * 100 / 5)}
                            {$width = "width:$rate%"}
                            <div class="productRate star-small">
                                <div style="{$width}"></div>
                            </div>
                        </div>
                    </div>

                    {if $totalComm = totalComments($model->getId())}
                        <span onclick="tabComment()" class="ref f_r">{$totalComm} {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('отзыв','отзыва','отзывов'))}</span>
                    {/if}
                </div>

                {if sizeof($model->getSProductImagess()) > 0}
                    <ul class="frame-thumbail">
                        {$i = 1}
                        {foreach $model->getSProductImagess() as $image}
                            <li>
                                <a href="#additioan_pic_{$i}" rel="group">
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img src="{echo $image->getThumbUrl()}" alt="{echo ShopCore::encode($model->getName())} - {echo $i}"/>
                                    </span>
                                </a>
                            </li>
                            {$i++}
                        {/foreach}
                    </ul>
                {/if}

            </div>
        </div>

        {if $model->getShopKits()->count() > 0}               
            <section class="frame-complect">
                <div class="carousel_js products-carousel">
                    <div class="content-carousel w_815">
                        <div class="title_h1">{lang('s_spec_promotion')}</div>
                        <ul>
                            {foreach $model->getShopKits() as $kitProducts} 
                                <li class="f_l">
                                    <ul class="items-complect">
                                        <!-- основний товар -->
                                        <li>
                                            <div class="f_l">

                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="{productImageUrl($model->getSmallImage())}" alt="{echo ShopCore::encode($model->getName())}" />
                                                </span>
                                                <span class="title">{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}</span>

                                                <div class="description">
                                                    <div class="o_h">
                                                        <div class="price-complect d_i-b">
                                                            <div>{echo ShopCore::encode($model->firstVariant->getPrice())} <span class="cur">{$CS}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="f_l plus-complect">+</div>
                                        </li>
                                        <!-- /основний товар -->

                                        {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}
                                            <!-- додатковий товар -->
                                            <li>
                                                <div class="f_l">
                                                    <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{productImageUrl($kitProduct->getSProducts()->getSmallImage())}" alt=" {echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>
                                                        </span>
                                                        <span class="title"> {echo ShopCore::encode($kitProduct->getSProducts()->getName())}</span>
                                                    </a>
                                                    <div class="description">
                                                        <div class="o_h">
                                                            {if $kitProduct->getDiscount()}
                                                                <div class="d_i-b m-r_10">
                                                                    <span>
                                                                        <span class="old-price">
                                                                            <span>
                                                                                {echo $kitProduct->getBeforePrice()}<span class="cur">{$CS}</span>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            {/if}
                                                            <div class="price-complect">
                                                                <div>
                                                                    {echo $kitProduct->getDiscountProductPrice()} <span class="cur">{$CS}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="f_l plus-complect">{if $kitProducts->countProducts() == $key}={else:}+{/if}</div>
                                            </li>
                                            <!-- /додатковий товар -->

                                        {/foreach}
                                        <!-- сума -->
                                        <li>
                                            <div class="t-a_c">
                                                <div class="price-old-catalog d_i-b m-b_10">
                                                    <span>
                                                        <span class="old-price">
                                                            <span>
                                                                {echo $kitProducts->getAllPriceBefore()} <span class="cur">{$CS}</span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-a_c m-b_10">
                                                <div class="price-product d_i-b">
                                                    <div>{echo $kitProducts->getTotalPrice()}<span class="cur"> {$CS}</span></div>
                                                </div>
                                            </div>
                                            <div class="t-a_c">

                                                <div class="btn btn-buy-product goBuy {$dn_gobuy}" data-kitid="{//echo $kid->getId()}" data-price="{$sum}">
                                                    <button 
                                                        data-price="{echo $kitProducts->getTotalPrice()}" 
                                                        data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}" 
                                                        data-prodid="{echo json_encode(array_merge($kitProducts->getProductIdCart()))}" 
                                                        data-prices ="{echo json_encode($kitProducts->getPriceCart())}"
                                                        data-name="{echo ShopCore::encode(json_encode($kitProducts->getNamesCart()))}" 
                                                        data-kit="true"
                                                        data-kitId="{echo $kitProducts->getId()}"
                                                        data-number="{echo $model->firstVariant->getnumber()}"
                                                        data-maxcount="{echo $model->firstVariant->getstock()}"
                                                        >
                                                        {lang('s_buy')}
                                                    </button>
                                                </div>
<!--                                                <div class="btn btn-order-product goCart ShopKit_{//echo $kid->getId()} {$dn_incart}">
                                                    <button>Уже в корзине</button>
                                                </div>-->
                                            </div>
                                        </li>
                                        <!-- /сума -->
                                    </ul>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    {if $model->getShopKits()->count() > 1}
                        <button type="button" class="prev arrow"></button>
                        <button type="button" class="next arrow"></button>
                    {/if}
                </div>
            </section>
        {/if}

        <div class="clearfix item-product">
            <div class="right-product f-s_0">
                <ul class="tabs tabs-data">
                    {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                        <li><span data-href="#first">Характеристики</span></li>
                    {/if}
                    {if trim($model->getShortDescription()) != ''}
                        <li><span data-href="#second">Полное описание</span></li>
                    {/if}
                    {//$totalComm = totalComments($model->getId())}
                    <li>
                        <span data-href="#third">

                            <button type="button" data-href="#comment" onclick="renderPosts(this)">
                                <span class="icon-comment-tab"></span>
                                <span class="text-el">                    
                                    <span id="cc">
                                        {if $Comments[$model->getId()][0] !== '0'}
                                            {echo $Comments[$model->getId()]}
                                        {else:}
                                            Оставить отзыв
                                        {/if}
                                    </span>
                                </span>
                            </button>
                        </span>
                    </li>
                    {if $model->getRelatedProducts()}
                        <li><span data-href="#fourth">Аксессуары</span></li>
                    {/if}
                </ul>
                <div class="frame-tabs-ref">
                    <div id="first">
                        <div class="characteristic">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Параметр</th>
                                        <th>Характеристика</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {echo $dl_properties}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="second">
                        <div class="text">
                            <h1>{echo $model->getName()}</h1>
                            {echo $model->getFullDescription()}
                        </div>
                    </div>

                    <div id="third">
                        <!--<div  class="frame-form-comment">-->
                        <div class="frame-form-comment">
                            <div id="comment">

                                <div id="for_comments" name="for_comments"></div>
                            </div>
                        </div>
                        <!--</div>-->
                        

                    </div>

                    {if $model->getRelatedProducts()}
                        {$related = explode(',',$model->getRelatedProducts())}
                        <div id="fourth">
                            <ul class="items-complect clearfix">
                                {foreach $related as $r}
                                    {$p = getProduct($r)}
                                    {if $p->firstVariant->getStock()}
                                        <li>
                                            <div class="f_l">
                                                <a href="{shop_url('product/' . $p->getUrl())}">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        {if $p->getSmallImage()}
                                                            <img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" />
                                                        {else:}
                                                            <img src="{productImageUrl('no_mm.png')}" alt="{echo ShopCore::encode($p->getName())}" />
                                                        {/if}

                                                        {if $p->getOldPrice() > $p->firstVariant->toCurrency()}
                                                            {$discount = (100 - ($p->firstVariant->toCurrency() / $p->getOldPrice() * 100))}
                                                        {else:}
                                                            {$discount = 0}
                                                        {/if}
                                                        {promoLabel($p->getHit(), $p->getHot(), $discount)}
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                                </a>
                                                <div class="description">
                                                    <div class="o_h">
                                                        {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                                                            <div class="d_i-b m-r_10">
                                                                <span><span class="old-price"><span>{echo round_price($p->getOldPrice())} <span class="cur">{$CS}</span></span></span></span>
                                                            </div>
                                                        {/if}
                                                        {if $p->firstVariant->getPrice() > 0}
                                                            <div class="price-complect d_i-b">
                                                                <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
                                                            </div>
                                                        {/if}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    {/if}

                </div>
            </div>
        </div>
    </div>
</div>


<!-- fancy photo -->
<div class="d_n">
    {$vcnt = 1}
    {foreach $model->getProductVariants() as $v}
        {if $vcnt == 1}
            {$vcnt = NULL}{$var_class = 'd_i-b';}
        {else:}
            {$var_class = 'd_n';}
        {/if} 
        {if $v->getMainImage()}
            {$main_src = $v->getMainImage()}
        {elseif $model->getMainImage()}
            {$main_src = $model->getMainImage()}
        {else:}
            {$main_src = 'no_m.png'}
        {/if}
        <div class="fancy-photo fancy" id="main_pic_{echo $v->getId()}">
            <div class="inside-padd">
                <div class="fencyProductInfoMain">
                    <h1 class="d_i m-r_5 c_6">{echo $model->getName()} {echo $v->getName()}</h1>
                    {if $v->getNumber()}
                        <div class="code">Код: {echo $v->getNumber()}</div>
                    {/if}
                </div>
                <div class="photo-block">
                    <span class="helper"></span>
                    <img src="{productImageUrl($main_src)}"/>
                </div>
                <div class="mainphoto_price_container">
                    <div class="t-a_c">
                        {if $v->getPrice() > 0}
                            <div class="price-product v-a_b">
                                <div>{echo $v->getPrice()} <span class="cur">грн.</span></div>
                            </div>
                        {/if}
                        {if $v->getStock() > 0}
                            <!-- buy/inCart buttons -------------------->
                            {if is_in_cart($model->getId(), $v->getId())}
                                {$dn_incart = "d_i-b"}{$dn_gobuy = "d_n"}
                            {else:}
                                {$dn_incart = "d_n"}{$dn_gobuy = "d_i-b"}
                            {/if}
                            <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <div class="btn btn-order-product goCart SProducts_{echo $model->getId()}_{echo $v->getId()} {$dn_incart}">
                                    <button>Уже в корзине</button>
                                </div>
                                <div class="btn btn-buy-product goBuy {$dn_gobuy}" data-varid="{echo $v->getId()}" data-prodid="{echo $model->getId()}">
                                    <button>
                                        <span class="icon icon-bask-buy"></span>
                                        В корзину
                                    </button>
                                </div>
                            </div>
                            <!-- end of buy/inCart buttons ------------->
                        {else:}
                            <!-- нема в наявності -->
                            <div class="{$var_class} v-a_b not-avail_wrap var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <span class="f-s_12 t-a_l p-b_15">
                                    <span class="d_b p-b_10">Товара нет в наличии</span>
                                </span>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    {/foreach}
    {if sizeof($model->getSProductImagess()) > 0}
        {$i = 1}
        {foreach $model->getSProductImagess() as $image}
            <div class="fancy-photo fancy" id="additioan_pic_{$i}">
                <div class="inside-padd">
                    <div class="fencyProductInfoAdd"></div>
                    <div class="photo-block">
                        <span class="helper"></span>
                        <img src="{echo $image->getThumbUrl()}"/>
                    </div>
                    <div class="t-a_c addphoto_price_container"></div>
                </div>
            </div>
            {$i++}
        {/foreach}
    {/if}
</div>
<!-- end of fancy photo -->

{literal}
    <script type="text/javascript">
    {/literal}
        var var_ident = {echo $model->firstVariant->getId()};
    {literal}
        $(document).ready(function(){
            addPhotoContent(var_ident);
        })
    </script>    
{/literal}