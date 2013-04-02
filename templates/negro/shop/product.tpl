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
                    {foreach $model->getProductVariants() as $v}
                        {if $v->getNumber()}
                            <span class="{$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                                <span class="code">Код: {echo $v->getNumber()}</span>
                            </span>
                        {/if}
                    {/foreach}
                </div>
                <div class="f-s_0 buy-block">
                    <!--Select variant -->
                    {if count($model->getProductVariants()) > 1}
                        <div class="v-a_b d_i-b">
                            <div class="d_i-b check-variants">
                                <div class="title">Выберите вариант:</div>
                                <div class="lineForm">
                                    <select name="variant" id="variantSwitcher">
                                        {foreach $model->getProductVariants() as $key => $pv}
                                             <option value="{echo $pv->getId()}">
                                                    {if $pv->getName()}
                                                        {echo ShopCore::encode($pv->getName())}
                                                    {else:}
                                                        {echo ShopCore::encode($model->getName())}
                                                    {/if}                                                   
                                                </option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                        </div>
                    {/if}
                    <!--End. Select variant -->
                    {if $model->hasDiscounts()}
                        <div class="v-a_b d_i-b">
                            <div class="price-old-catalog">
                                <span>Старая цена: <span class="old-price"><span>{echo $model->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
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
                    {foreach $model->getProductVariants() as $v}
                        {if $v->getStock() > 0}
                             <!-- buy/inCart button -------------------->
                                <div class="btn btn-buy goBuy f_l">
                                    <button class="buyButton toCart"
                                            type="button"
                                            data-prodId="{echo $model->getId()}"
                                            data-varId="{echo $v->getId()}"
                                            data-price="{echo $v->toCurrency()}"
                                            data-name="{echo $model->getName()}"
                                            data-number="{echo $v->getnumber()}"
                                            data-maxcount="{echo $v->getstock()}"
                                            data-vname="{echo $v->getName()}">
                                        <span class="icon-bask-buy"></span>
                                        {lang('s_buy')}
                                    </button>
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
                    {/foreach}
                    <!-- Wish List buttons --------------------->
                    <div class="var_{echo $model->firstVariant->getId()} f_l prod_{echo $model->getId()}">
                        <div class="btn btn-def" data-title="В список желаний" data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" data-rel="tooltip">
                            <button class="toWishlist"
                                data-prodid="{echo $model->getId()}"
                                data-varid="{echo $model->firstVariant->getId()}"
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
                    <!-- compare buttons ----------------------->
                    <div class="d_i-b">
                        <div class="btn btn-def f_l" data-title="В список сравнений"  data-prodid="{echo $model->getId()}" data-rel="tooltip">
                            <button class="toCompare"
                                    data-prodid="{echo $model->getId()}"
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
                <!--Start. Payments method form -->
                    {include_tpl('payments_methods_info.tpl')}
                <!--End. Payments method form -->
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
                <!-- Star rating-->
                <div class="clearfix m-b_10">
                    {$CI->load->module('star_rating')->show_star_rating($model)}
                </div>
                <!-- End rating -->
                <!--Additional images-->
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
                <!--End block-->
                
            </div>
        </div>

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
                            <div class="v-a_b {$var_class} var_{echo $v->getId()} prod_{echo $model->getId()}">
                               <div class="btn btn-buy goBuy f_l">
                                    <button class="buyButton toCart"
                                            type="button"
                                            data-prodId="{echo $model->getId()}"
                                            data-varId="{echo $v->getId()}"
                                            data-price="{echo $v->toCurrency()}"
                                            data-name="{echo $model->getName()}"
                                            data-number="{echo $v->getnumber()}"
                                            data-maxcount="{echo $v->getstock()}"
                                            data-vname="{echo $v->getName()}">
                                        <span class="icon-bask-buy"></span>
                                        {lang('s_buy')}
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
