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
<div>
    <article class="container">       
        <!-- Making bread crumbs -->
        {widget('path')}
        <div class="item_tovar">
            <ul class="row">
                <!--Photo block for main product-->
                <li class="span5 clearfix">
                    <!-- productImageUrl($model->getMainModImage()) - Link to product -->
                    <a rel="group" id="photoGroup" href="{productMainImageUrl($model->firstVariant)}" class="photo">
                        <figure >
                            <!-- productImageUrl($model->getMainImage()) - Way before the photo to attribute img -->
                            <img id="imageGroup" src="{productMainImageUrl($model->firstVariant)}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                        </figure>                        
                    </a>              
                    <ul class="frame_thumbs">
                        <!-- Start. Show additional images -->
                        {if sizeof($productImages = $model->getSProductImagess()) > 0}
                            {foreach $productImages as $key => $image}
                                <li>
                                    <a rel="group" href="{echo $image->getThumbUrl()}" class="photo">
                                        <figure>
                                            <span class="helper"></span>
                                            <img src="{productImageUrl($image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                        </figure>
                                    </a>                                
                                </li>
                            {/foreach}
                        {/if}        
                        <!-- End. Show additional images -->
                    </ul>
                </li>
                <!--Photo block for main product end-->
                <li class="span7">
                    <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                    <span class="c_97" id="number">{if $model->firstVariant->getNumber() != ''}(Артикул {echo $model->firstVariant->getNumber()}) {/if}</span>

                    <!-- Output rating for the old product Start -->
                    <div class="frame_response">
                        <div class="star">
                            {$CI->load->module('star_rating')->show_star_rating($model)}
                        </div>
                    </div>
                    <!-- Output rating for the old product End -->
                    <div class="clearfix frame_buy">
                        <div class="d_i-b v-a_b m-b_20">
                            <!-- Start. Output of all the options -->
                            {if count($model->getProductVariants()) > 1}
                                <div class=" d_i-b v-a_b m-r_30" id="variantProd">
                                    <span class="title">Выбор варианта:</span>
                                    <div class="lineForm w_170">
                                        <select id="variantSwitcher" name="variant">
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
                                <!-- End. Output of all the options -->

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
                    {/if}
                    <div class=" d_i-b v-a_b m-r_45">
                        <div class="price price_f-s_24">
                            <!-- $model->hasDiscounts() - check for a discount. -->
                            {if $model->hasDiscounts()}
                                <span class="d_b old_price">
                                    <!--
                                    "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                    output price without discount
                                     To display the number of abatement "$model->firstVariant->getNumDiscount()"
                                    -->
                                    <span class="f-w_b" id="priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')} </span>
                                    {$CS}
                                </span>                           
                            {/if}
                            <!--
                            If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                            will display the price already discounted
                            -->
                            <span class="f-w_b" id="priceVariant">{echo $model->firstVariant->toCurrency()} </span>{$CS}
                            <!--To display the amount of discounts you can use $model->firstVariant->getNumDiscount()-->
                        </div>    
                        <!--
                        Buy button applies the 
                        data-prodid - product ID
                        data-varid - variant ID
                        data-price - price Product
                        data-name - name product
                        these are the main four options for the "buy" - button
                        -->
                        {if (int)$model->firstvariant->getstock() == 0}

                            <!-- displaying notify button -->
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
                        {else:}

                            <!-- displaying buy or in cart button -->
                            <button class="btn btn_buy variant"
                                    type="button"
                                    data-prodid="{echo $model->getId()}"
                                    data-varid="{echo $model->firstVariant->getId()}"
                                    data-price="{echo $model->firstVariant->toCurrency()}"
                                    data-name="{echo ShopCore::encode($model->getName())}"
                                    data-number="{echo $model->firstVariant->getnumber()}"
                                    data-maxcount="{echo $model->firstVariant->getstock()}"
                                    data-prodpage="true"
                                    >
                                {lang('s_buy')}
                            </button>
                        {/if}

                        {foreach $model->getProductVariants() as $key => $pv}
                            {if !$pv->getAvailable()}
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
                                    <span class="text-el">Под заказ</span>
                                </button>
                            {elseif $pv->getStock() > 0}
                                 <button style="display: none;" 
                                        class="btn btn_buy variant_{echo $pv->getId()} variant" 
                                        type="button" 
                                        data-prodid="{echo $model->getId()}"
                                        data-varid="{echo $pv->getId()}" 
                                        data-price="{echo $pv->toCurrency()}" 
                                        data-name="{echo ShopCore::encode($model->getName())}"
                                        data-vname="{echo ShopCore::encode($pv->getName())}"
                                        data-maxcount="{echo $pv->getstock()}"
                                        data-prodpage="true">
                                    {lang('s_buy')}
                                </button>
                            {else:}
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
                             
                            {/if}
                        {/foreach}
                    </div>
                </div>
                <div class="d_i-b v-a_b m-b_20 add_func_btn">

                    <!-- Start. Block "Add to Compare" -->
                    <button class="btn btn_small_p toCompare"  
                            data-prodid="{echo $model->getId()}"  
                            type="button" 
                            data-title="{lang('s_add_to_compare')}"
                            data-sectitle="{lang('s_in_compare')}"
                            data-rel="tooltip"
                            >
                        <span class="icon-comprasion_2"></span>
                        <span class="text-el">{lang('s_add_to_compare')}</span>
                    </button>
                    <!-- End. Block "Add to Compare" -->

                    <br/>
                    <!--Block Wishlist Start-->
                    <button class="btn btn_small_p toWishlist" 
                            data-prodid="{echo $model->getId()}" 
                            data-varid="{echo $model->firstVariant->getId()}"  
                            type="button" 
                            data-title="{lang('s_add_to_wish_list')}"
                            data-sectitle="{lang('s_in_wish_list')}"
                            data-rel="tooltip"
                            >
                        <span class="icon-wish_2"></span>
                        <span class="text-el">{lang('s_slw')}</span>
                    </button>
                    <!-- Stop. Block "Add to Wishlist" -->
                    <br/>
                    <!--Block Follow the price Start-->
                </div>
            </div>

            <!-- Start. Withdraw button to "share" -->
            <div class="share_tov">
                {echo $CI->load->module('share')->_make_share_form()}
            </div>
                       
            <!-- End. Withdraw button to "share" -->
             <!-- prop_tip -->
             {$prop_tip = $model->getPropertiesWithTip()}
             {if count($prop_tip) > 0}
                 <div class="clearfix">
                     {foreach $prop_tip as $prop}
                         <div class="caract clearfix">
                             <div class="f_l">{echo $prop.Name}<span class="tip">&nbsp</span></div>
                             <div class="f_l"> - {echo $prop.Value}</div>
                             <div class="info_prop">
                                 {echo $prop.Desc}
                             </div>
                         </div>

                     {/foreach}
                 </div>
             {/if}
            <!-- -->

            <ul class="tabs clearfix">
                <!-- Start. Show the block information if available -->
                {if $model->getFullDescription()        != ''}
                    <li>
                        <button type="button" data-href="#info">
                            <span class="icon-info"></span>
                            <span class="text-el">Информация</span>
                        </button>
                    </li>
                {/if}
                <!-- End. Show the block information if available -->

                <!-- Start. Display characteristics block if you have one -->
                {if $renderProperties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                    <li>
                        <button type="button" data-href="#characteristic">
                            <span class="icon-charack"></span>
                            <span class="text-el">{lang('s_properties')}</span>
                        </button>
                    </li>
                {/if}
                <!-- End. Display characteristics block if you have one -->

                <!--Output of the block if there is one accessory-->
                {if $accessories = $model->getRelatedProductsModels()}            
                    <li>
                        <button type="button" data-href="#accessories">
                            <span class="icon-accss"></span>
                            <span class="text-el">{lang('s_accessories')}</span>
                        </button>
                    </li>
                {/if}

                <!--Output of the block if there is one accessory END-->
                <!--Output of the block comments-->
                {if $Comments && $model->enable_comments}
                    <li>
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
                    </li>
                {/if}
                <!--Output of the block comments END-->
            </ul>

            <div class="frame_tabs">
                <!--Piece of information about the product Start-->
                {if $model->getFullDescription() != ''}
                    <div id="info">
                        <div class="text">
                            {echo $model->getFullDescription()}                      
                        </div>
                    </div>
                {/if}
                <!--Piece of information about the product End-->
                <!--The unit features product Start-->
                {if $renderProperties}
                    <div id="characteristic">   
                        {echo $renderProperties}  
                    </div>
                {/if}
                <!--The unit features product End-->
                <!--Block Accessories Start-->
                {if $accessories}
                    <div id="accessories">
                        <ul class="items items_catalog" data-radio-frame>
                            {foreach $accessories as $p}  
                                <li class="span3 {if $p->firstvariant->getStock() == 0}not-avail{/if}">
                                    <div class="description">
                                        <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                        <div class="price price_f-s_16">
                                            {if $p->hasDiscounts()}
                                                <span class="d_b old_price">
                                                    <!--
                                                    "$p->firstVariant->toCurrency('OrigPrice')" or $p->firstVariant->getOrigPrice()
                                                    output price without discount
                                                    -->
                                                    <span class="f-w_b" id="priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')} </span>
                                                    {$CS}
                                                </span>                                              
                                            {/if}
                                            <span class="f-w_b">{echo $p->firstvariant->toCurrency()} </span>{$CS}
                                        </div>
                                        <!--
                                                    Buy button applies the 
                                                    data-prodid - product ID
                                                    data-varid - variant ID
                                                    data-price - price Product
                                                    data-name - name product
                                                    these are the main four options for the button to "buy"
                                        -->
                                        <button class="btn btn_buy" 
                                                data-varid="{echo $p->firstVariant->getId()}" 
                                                data-prodid="{echo $p->getId()}" 
                                                data-price="{echo $p->firstvariant->toCurrency()}" 
                                                data-name="{echo ShopCore::encode($p->getName())}" 
                                                type="button"
                                                data-number="{echo $p->firstVariant->getnumber()}"
                                                data-maxcount="{echo $p->firstVariant->getstock()}">
                                            {lang('s_buy')}
                                        </button>


                                        <div class="d_i-b"> 
                                            <!-- to compare button -->
                                            <button class="btn btn_small_p toCompare"
                                                    data-prodid="{echo $p->getId()}"  
                                                    type="button" 
                                                    data-title="{lang('s_add_to_compare')}"
                                                    data-sectitle="{lang('s_in_compare')}"
                                                    data-rel="tooltip">
                                                <span class="icon-comprasion_2"></span>
                                            </button>

                                            <!-- to wish list button -->
                                            <button class="btn btn_small_p toWishlist" 
                                                    data-prodid="{echo $p->getId()}" 
                                                    data-varid="{echo $p->firstVariant->getId()}"  
                                                    type="button" 
                                                    data-title="{lang('s_add_to_wish_list')}"
                                                    data-sectitle="{lang('s_in_wish_list')}"
                                                    data-rel="tooltip">
                                                <span class="icon-wish_2"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <!--Photo and link to accessory Start-->
                                    <div class="photo-block">
                                        <a href="{shop_url('product/' . $p->getUrl())}" class="photo">
                                            <figure>
                                                <span class="helper"></span>
                                                <img src="{productImageUrl($p->getSmallModImage())}" alt="{echo ShopCore::encode($p->getName())}"/>
                                            </figure>
                                        </a>
                                    </div>
                                    <!--Photo and link to accessory End-->
                                </li>
                            {/foreach}    

                        </ul>
                    </div>
                {/if}

                
                <!--Block Accessories End-->
                <div id="comment">
                    <div id="for_comments" name="for_comments"></div>
                </div>
            </div>
        </li>
    </ul>
</div>
                
                
<!--Kit start-->
{if $model->getShopKits()->count() > 0}
    <div class="frame_carousel_product carousel_js c_b frameSet">
        <div class="m-b_20">
            <div class="title_h1 d_i-b v-a_m promotion_text">{lang('s_spec_promotion')}</div>
            <div class="d_i-b groupButton v-a_m">
                <button type="button" class="btn btn_prev">
                    <span class="icon prev"></span>
                    <span class="text-el"></span>
                </button>
                <button type="button" class="btn btn_next">
                    <span class="text-el"></span>
                    <span class="icon next"></span>
                </button>
            </div>
        </div>
        <div class="carousel">
            <div class="row">
                <ul class="items items_catalog">
                    {foreach $model->getShopKits() as $kitProducts}                                     
                        <li class="container">
                            <ul class="items items_middle">
                                <li class="span3">
                                    <div class="item_set">
                                        <!--Photo, price, name for parent product-->
                                        <div class="description">
                                            <a href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}">
                                                {echo ShopCore::encode($kitProducts->getMainProduct()->getName())}
                                            </a>
                                            <div class="price price_f-s_16">
                                                <!-- "$kitProducts->getMainProductPrice()" price of the main product-->
                                                <span class="f-w_b">{echo $kitProducts->getMainProductPrice()} </span>
                                                {$CS}
                                            </div>
                                        </div>
                                        <div class="photo-block">
                                            <a href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}" class="photo">
                                                <figure>
                                                    <span class="helper"></span>
                                                    <img src="{productImageUrl($kitProducts->getMainProduct()->getSmallModImage())}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d_i-b">+</div>
                                </li>
                                <!--Output of goods subsidiaries set-->
                                {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}
                                    <li class="{if $kitProducts->countProducts() >= 2}span2{else:}span3{/if}">
                                        <div class="item_set">
                                            <div class="description">
                                                <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}">
                                                    {echo ShopCore::encode($kitProduct->getSProducts()->getName())}
                                                </a>
                                                <!--Conclusion discounts-->
                                                <div class="price price_f-s_16">
                                                    {if $kitProduct->getDiscount()}
                                                        <span class="d_b old_price">
                                                            <!--$kitProduct->getBeforePrice() - Price before discount-->
                                                            <span class="f-w_b">{echo $kitProduct->getBeforePrice()} </span>
                                                            {$CS}
                                                        </span>
                                                    {/if}
                                                    <!--$kitProduct->getDiscountProductPrice() - discount price-->
                                                    <span class="f-w_b">{echo $kitProduct->getDiscountProductPrice()} </span>
                                                    {$CS}
                                                </div>
                                            </div>
                                            <div class="photo-block">
                                                <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}" class="photo">
                                                    <figure>
                                                        <span class="helper"></span>
                                                        <img src="{productImageUrl($kitProduct->getSProducts()->getSmallModImage())}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>
                                                    </figure>
                                                </a>
                                            </div>
                                            <span class="top_tovar discount">-{echo $kitProduct->getDiscount()}%</span>
                                        </div>
                                        <div class="d_i-b">
                                    {if $kitProducts->countProducts() == $key}={else:}+{/if}
                                </div>
                            </li>                                            
                        {/foreach}                       
                        <!--Output of goods subsidiaries set END-->
                        <li class="span3 p-t_40">
                            <div class="price price_f-s_24">
                                <span class="d_b old_price">
                                    <!--$kitProducts->getAllPriceBefore() - The entire set of output price without discount-->
                                    <span class="f-w_b">{echo $kitProducts->getAllPriceBefore()} </span> {$CS}
                                </span>
                                <!-- $kitProducts->getTotalPrice() - the entire set of output price with discount-->
                                <span class="f-w_b">{echo $kitProducts->getTotalPrice()} </span> {$CS}
                            </div>                                   
                            <button class="btn btn_buy" type="button"                                    
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
                        </li>
                    </ul>
                </li>
            {/foreach}                            
        </ul>
    </div>
</div>
</div>
{/if}
<!--Kit end-->

{widget('view_product')}
{widget('similar')}
</article>
</div>