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
<div class="popup_product" data-width="57.4">
    <!-- Making bread crumbs -->
    { widget('path')}
    <div class="item_tovar">
        <ul class="row-fluid">
            <!--Photo block for main product-->
            <li class="span5 clearfix">
                <!-- productImageUrl($model->getMainModImage()) - Link to product -->
                <a rel="position: 'xBlock', adjustX: 10" id="photoGroup" href="{productMainImageUrl($model->firstVariant)}" class="photo cloud-zoom">
                    <figure >
                        <!-- productImageUrl($model->getMainImage()) - Way before the photo to attribute img -->
                        <img id="imageGroup" src="{productMainImageUrl($model->firstVariant)}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                    </figure>                        
                </a>              
                <ul class="frame_thumbs">
                    <!-- Start. Show additional images -->
                    { if sizeof($productImages = $model->getSProductImagess()) > 0}
                    { foreach $productImages as $key => $image}
                    <li>
                        <a  rel="useZoom: 'photoGroup', smallImage: '{echo $image->getThumbUrl()}'" href="{echo $image->getThumbUrl()}" class="photo cloud-zoom-gallery">
                            <figure>
                                <span class="helper"></span>
                                <img src="{productImageUrl($image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                            </figure>
                        </a>                                
                    </li>
                    { /foreach}
                    { /if}        
                    <!-- End. Show additional images -->
                </ul>
                <!-- Output rating for the old product Start -->
                <div class="frame_response c_b">
                    <div class="star">
                        { $CI->load->module('star_rating')->show_star_rating($model)}
                    </div>
                    <!-- displaying comments count -->
                    {if $Comments[$model->getId()][0] != '0' && $model->enable_comments}
                    <a href="{shop_url('product/'.$model->url.'#comment')}" class="count_response">
                        {echo $Comments[$model->getId()]}
                    </a>
                    {/if}
                </div>
                <!-- Output rating for the old product End -->
            </li>
            <!--Photo block for main product end-->
            <li class="span7">
                <h1 class="d_i">{ echo ShopCore::encode($model->getName())}</h1>
                <div class="clearfix frame_buy">
                    <div class="d_i-b v-a_b m-b_20">
                        <!-- Start. Output of all the options -->
                        { if count($model->getProductVariants()) > 1}
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
                        { foreach $model->getProductVariants() as $key => $pv}
                        { if $pv->getMainImage()}{$mainImage = productImageUrl($pv->getMainImage())}{else:}{$mainImage = productImageUrl($model->getMainimage())}{/if}

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
                        <div class=" d_i-b v-a_b">
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
                            { if (int)$model->firstvariant->getstock() == 0}

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

                            { foreach $model->getProductVariants() as $key => $pv}
                            {if $pv->getStock() > 0}
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
                            <a href="#" class="btn ref">Подробнее</a>
                            <div class="d_i-b v-a_m add_func_btn">

                                <!-- Start. Block "Add to Compare" -->
                                <button class="toCompare"  
                                        data-prodid="{echo $model->getId()}"  
                                        type="button" 
                                        data-title="{lang('s_add_to_compare')}"
                                        data-sectitle="{lang('s_in_compare')}"
                                        data-rel="tooltip"
                                        >
                                    <span class="icon-comprasion"></span>
                                    <span class="text-el d_l_b">Сравнить</span>
                                </button>
                                <!-- End. Block "Add to Compare" -->

                                <!--Block Wishlist Start-->
                                <button class="toWishlist" 
                                        data-prodid="{echo $model->getId()}" 
                                        data-varid="{echo $model->firstVariant->getId()}"  
                                        type="button" 
                                        data-title="{lang('s_add_to_wish_list')}"
                                        data-sectitle="{lang('s_in_wish_list')}"
                                        data-rel="tooltip"
                                        >
                                    <span class="icon-wish"></span>
                                    <span class="text-el d_l_b">{lang('s_slw')}</span>
                                </button>
                                <!-- Stop. Block "Add to Wishlist" -->
                                <!--Block Follow the price Start-->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="xBlock"></div>
                <!-- Start. Withdraw button to "share" -->
                <div class="share_tov">
                    {echo $CI->load->module('share')->_make_share_form()}
                </div>
                <div class="frame_tabs" data-height="372">
                    <!-- End. Withdraw button to "share" -->
                    {if $model->getFullDescription() != ''}
                    <div id="info" data-height="175">
                        <div class="text">
                            { echo $model->getFullDescription()}                      
                        </div>
                    </div>
                    {/if}
                    <div id="characteristic" data-height="200">
                        {$prop_tip = $model->getPropertiesWithTip()}
                        {if count($prop_tip) > 0}
                        <table border="0" cellpadding="4" cellspacing="0" class="characteristic">
                            <tbody>
                                {foreach $prop_tip as $prop}
                                <tr>
                                    <td>
                                        <div class="item_add d_i-b">
                                            <span class="icon-infoM"></span><span>{echo $prop.Name}</span>
                                            <div class="drop drop_down">
                                                <div class="drop-content">
                                                    {echo $prop.Desc}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{echo $prop.Value}</td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                        {/if}
                        {$renderProperties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                        {if $renderProperties}
                        {echo $renderProperties}
                        {/if}
                    </div>
                </div>
                <div class="t-a_r m-t_20">
                    <a href="">Подробнее о товаре</a>
                </div>
            </li>
        </ul>
    </div>
    <!--Kit start-->

    <!--Kit end-->
</div>