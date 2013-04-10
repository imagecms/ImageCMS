{#
/**
 * @file Render shop product; 
 * @partof main.tpl;
 * @updated 26 February 2013;
 * Variables 
 *  $model : PropelObjectCollection of (object) instance of SProducts
 *   $model->hasDiscounts() : Check whether the discount on the product.
 *   $model->firstVariant : variable which contains the first variant of product;
 *   $model->firstVariant->toCurrency() : variable which contains price of product;
 *
 */
#}
{$Comments = $CI->load->module('comments')->init($model)}
<div class="frame-crumbs">
    <div class="container">
         <!-- Making bread crumbs -->
        {widget('path')}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        <div class="clearfix item-product">
            <div class="right-product">
                <div class="f-s_0 title-head-ategory">
                    <div class="d_i m-r_15">
                        <h1 class="d_i">{echo  ShopCore::encode($model->getName())}</h1>
                    </div>
                   {if $model->firstVariant->getNumber() != ''} <span class="code" id="number">(Артикул {echo $model->firstVariant->getNumber()}) </span>{/if}
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
                     <!-- $model->hasDiscounts() - check for a discount. And show old price-->
                    {if $model->hasDiscounts()}
                        <div class="v-a_b d_i-b">
                            <div class="price-old-catalog">
                                <span>Старая цена: <span class="old-price"><span id="priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
                            </div>
                        </div>
                    {/if}
                    <!-- End. Show old price-->
<!--                    Start. Product price-->
                    <div class="v-a_b d_i-b var_{echo $model->firstVariant->getId()} prod_{echo $model->getId()}">
                        <div class="price-product">
                            <div>
                                <span class="" id="priceVariant">{echo $model->firstVariant->toCurrency()} </span>
                                <span class="cur">{$CS}</span>
                            </div>
                        </div>
                    </div>
<!--                    End. Product price-->
                     <!-- Start. Collect information about Variants, for future processing -->
                      {foreach $model->getProductVariants() as $key => $pv}
                            {if $pv->getMainImage()}{$mainImage = productImageUrl($pv->getMainImage())}{else:}{$mainImage = productImageUrl($model->getMainimage())}{/if}
                            <span class="variant_{echo $pv->getId()}" 
                                  data-id="{echo $pv->getId()}"
                                  data-name="{echo ShopCore::encode($pv->getName())}"
                                  data-price="{echo $pv->toCurrency()}"
                                  data-number="{echo $pv->getNumber()}"
                                  data-origPrice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                  data-mainImage="{echo $mainImage}"
                                  data-smallImage="{echo productImageUrl($pv->getSmallImage())}"
                                  data-stock="{echo $pv->getStock()}"
                                  style="display: none;">
                            </span>
                        {/foreach}
                        <!-- End. Collect information about Variants, for future processing -->
                    <br />
                     <div class="btn btn-buy goBuy f_l">
                    {if (int)$model->firstvariant->getstock() > 0}
                        <!-- displaying buy or in cart button -->
                            <button class="variant buyButton toCart"
                                    type="button"
                                    data-prodid="{echo $model->getId()}"
                                    data-varid="{echo $model->firstVariant->getId()}"
                                    data-price="{echo $model->firstVariant->toCurrency()}"
                                    data-name="{echo ShopCore::encode($model->getName())}"
                                    data-number="{echo $model->firstVariant->getnumber()}"
                                    data-maxcount="{echo $model->firstVariant->getstock()}"
                                    data-prodpage="true">
                                <span class="icon-bask-buy"></span>
                                {lang('s_buy')}
                            </button>
                        {else:}
                             <!-- Start. Displaying notify button -->
                              <button
                                data-placement="top right"
                                data-place="noinherit"
                                data-duration="500"
                                data-effect-off=    "fadeOut"
                                data-effect-on="fadeIn"
                                data-drop=".drop-report"
                                data-prodid="{echo $model->getId()}"
                                type="button"
                                class="btn btn_not_avail variant">
                                <span class="icon-but"></span>
                                <span class="text-el">{lang('s_message_o_report')}</span>
                            </button>
                            <!-- End. Displaying notify button -->
                        {/if}
                         <!--End .Buy button for main prod -->
                        
                        {foreach $model->getProductVariants() as $v}
                            {if $v->getStock() > 0}
                                 <!--Start.Buy/inCart button -------------------->
                                        <button class="buyButton toCart variant_{echo $v->getId()} variant" style="display: none;"
                                                type="button"
                                                data-prodId="{echo $model->getId()}"
                                                data-varId="{echo $v->getId()}"
                                                data-price="{echo $v->toCurrency()}"
                                                data-name="{echo  ShopCore::encode($model->getName())}"
                                                data-number="{echo $v->getnumber()}"
                                                data-maxcount="{echo $v->getstock()}"
                                                data-vname="{echo  ShopCore::encode($v->getName())}">
                                            <span class="icon-bask-buy"></span>
                                            {lang('s_buy')}
                                        </button>
                                    <!-- End. Buy/inCart button -------------------->
                                <!-- end of buy/inCart buttons ------------->                          
                            {else:}
                                <!-- Start. Notify button -->
                                 <button
                                    style="display: none;" 
                                    data-placement="top right"
                                    data-place="noinherit"
                                    data-duration="500"
                                    data-effect-off=    "fadeOut"
                                    data-effect-on="fadeIn"
                                    data-drop=".drop-report"
                                    data-prodid="{echo $model->getId()}" 
                                    type="button"
                                    class="btn btn_not_avail variant_{echo $pv->getId()} variant">
                                    <span class="icon-but"></span>
                                    <span class="text-el">{lang('s_message_o_report')}</span>
                                </button>
                                <!-- End. Notify button -->
                            {/if}
                        {/foreach}
                        </div>
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
<!--                Start. Description -->
                {if trim($model->getShortDescription()) != ''}
                    <div class="small-description">
                        {echo $model->getShortDescription()}
                    </div>
                {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($model->getId(), 1)}
                    <div class="small-description">
                        <p>{echo $props}</p>
                    </div>
                {/if}
                <!--  End. Description -->
                <!--Start .Share-->
                <dl class="social-product">
                    <dd class="social">
                        {echo $CI->load->module('share')->_make_share_form()}
                    </dd>
                </dl>
                <!-- End. Share -->
                <!--Start. Payments method form -->
                    {include_tpl('payments_methods_info')}
                <!--End. Payments method form -->
            </div>
            <div class="left-product">
               <!--Statr. Photo block -->
                <a class="var_photo_{echo $v->getId()} prod_photo_block"  rel="group" id="photoGroup" href="{productMainImageUrl($model->firstVariant)}" class="photo">
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img id="imageGroup" src="{productMainImageUrl($model->firstVariant)}" alt="{echo  ShopCore::encode($model->getName()) ." - ". ShopCore::encode($v->getName())}" />
                        
                    </span>
                </a>
                <!-- End. Photo block-->
                <!-- Star rating -->
                <div class="clearfix m-b_10">
                    {$CI->load->module('star_rating')->show_star_rating($model)}
                </div>
                <!-- End. Star rating-->
                <!--Additional images-->
                {if sizeof($model->getSProductImagess()) > 0}
                    <ul class="frame-thumbail">
                        {foreach $model->getSProductImagess() as $key => $image}
                            <li>
                                <a rel="group" href="{echo $image->getThumbUrl()}">
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img src="{productImageUrl($image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - - {echo ++$key}"/>
                                    </span>
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
                <!--End block-->
            </div>
        </div>
       <!--Kit start-->
       {if $model->getShopKits()->count() > 0}             
            <section class="frame-complect">
                <div class="carousel_js products-carousel">
                    <div class="content-carousel w_815">
                        <div class="title_h1">Вместе дешевле</div>
                        <ul>
                            {foreach $model->getShopKits() as $kitProducts}
                                <li class="f_l">
                                    <ul class="items-complect">
                                        <!-- main product -->
                                        <li>
                                            <div class="f_l">

                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                     <img src="{productImageUrl($kitProducts->getMainProduct()->getSmallModImage())}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                                </span>
                                                <span class="title">{echo ShopCore::encode($model->getName())}</span>

                                                <div class="description">
                                                    <div class="o_h">
                                                        <div class="price-complect d_i-b">
                                                            <div>{echo $kitProducts->getMainProductPrice()}  <span class="cur">{$CS}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="f_l plus-complect">+</div>
                                        </li>
                                        <!-- /end main product -->
                                         {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}
                                            <!-- additional product -->
                                            <li>
                                                <div class="f_l">
                                                    <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{productImageUrl($kitProduct->getSProducts()->getSmallModImage())}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>
                                                        </span>
                                                        <span class="title">{echo ShopCore::encode($kitProduct->getSProducts()->getName())}
                                                </a></span>
                                                    </a>
                                                    <div class="description">
                                                        <div class="o_h">
                                                            {if $kitProduct->getDiscount()}
                                                                <div class="d_i-b m-r_10">
                                                                    <span><span class="old-price"><span>{echo $kitProduct->getBeforePrice()}<span class="cur">{$CS}</span></span></span></span>
                                                                </div>
                                                            {/if}
                                                            <div class="price-complect">
                                                                <div>{echo $kitProduct->getDiscountProductPrice()}<span class="cur">{$CS}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="f_l plus-complect">{if $kitProducts->countProducts() == $key}={else:}+{/if}</div>
                                            </li>
                                            <!-- /additional product -->
                                        {/foreach}
                                        <!-- total -->
                                        <li>
                                            <div class="t-a_c">
                                                <div class="price-old-catalog d_i-b m-b_10">
                                                    <span><span class="old-price"><span>{echo $kitProducts->getAllPriceBefore()} <span class="cur">{$CS}</span></span></span></span>
                                                </div>
                                            </div>
                                            <div class="t-a_c m-b_10">
                                                <div class="price-product d_i-b">
                                                    <div>{echo $kitProducts->getTotalPrice()} <span class="cur"> {$CS}</span></div>
                                                </div>
                                            </div>
                                            <div class="t-a_c">
                                                <div class="btn btn-buy goBuy">
                                                    <button class="buyButton toCart" type="button"                                    
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
                                            </div>
                                        </li>
                                        <!-- /total -->
                                    </ul>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
<!--                        Start. Buttons for next/prev kit-->
                    {if $model->getShopKits()->count() > 1}
                        <button type="button" class="prev arrow"></button>
                        <button type="button" class="next arrow"></button>
                    {/if}
                    <!--                        Start. Buttons for next/prev kit-->
                </div>
            </section>
        {/if}
<!--        End. Buy kits-->
<!--        Start. Tabs block       -->
        <div class="clearfix item-product">
            <div class="right-product f-s_0">
                <ul class="tabs tabs-data">
                    {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                        <li><span data-href="#first">Характеристики</span></li>
                    {/if}
                    {if trim($model->getShortDescription()) != ''}
                        <li><span data-href="#second">Полное описание</span></li>
                    {/if}
                    <!--Output of the block comments-->
                    {if $Comments && $model->enable_comments}
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
                    {/if}
                   {if $accessories = $model->getRelatedProductsModels()}     
                        <li><span data-href="#fourth">Аксессуары</span></li>
                    {/if}
                </ul>
                <div class="frame-tabs-ref">
   <!--             Start. Characteristic-->                 
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
<!--                    End. Characteristic-->
                    <div id="second">
<!--                        Start. Description block-->
                        <div class="text">
                            <h1>{echo  ShopCore::encode($model->getName())}</h1>
                            {echo $model->getFullDescription()}
                        </div>
<!--                        End. Description block-->
                    </div>
                    <div id="third">
                        <!--Start. Comments block-->
                        <div class="frame-form-comment">
                            <div id="comment">
                                <div id="for_comments" name="for_comments"></div>
                            </div>
                        </div>
                         <!--End. Comments block-->
                    </div>
                    <!--Block Accessories Start-->
                    {if $accessories}
                        <div id="fourth">
                            <ul class="items-complect clearfix">
                                {foreach $accessories as $p}
                                    {if $p->firstVariant->getStock()}
                                        <li>
                                            <div class="f_l">
                                                <a href="{shop_url('product/' . $p->getUrl())}">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                            <img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" />
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                                </a>
                                                <div class="description">
                                                    <div class="o_h">
                                                        {if $p->hasDiscounts()}
                                                            <div class="d_i-b m-r_10">
                                                                <span><span class="old-price"><span>{echo $p->firstVariant->toCurrency('OrigPrice')} <span class="cur">{$CS}</span></span></span></span>
                                                            </div>
                                                        {/if}
                                                        <div class="price-complect d_i-b">
                                                            <div>{echo $p->firstVariant->toCurrency()} <span class="cur">{$CS}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    {/if}
                    <!--End. Block Accessories-->
                </div>
           </div>
        </div>
        <!-- End. Tabs block       -->
    </div>
</div>


