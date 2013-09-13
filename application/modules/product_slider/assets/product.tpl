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
<div class="popup_product">
    <!-- Making bread crumbs -->
    { widget('path')}
    <div class="item_tovar">
        <ul class="row-fluid">
            <!--Photo block for main product-->
            <li class="span4 clearfix">
                <!-- productImageUrl($model->getMainModImage()) - Link to product -->
                <a rel="position: 'xBlock'" id="photoGroup" href="{echo $model->firstVariant->getLargePhoto()}" class="photoProduct photo cloud-zoom">
                    <figure>
                        <!-- productImageUrl($model->getMainImage()) - Way before the photo to attribute img -->
                        <span class="helper"></span>
                        <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" id="vimg"/>
                    </figure>                        
                </a>              
                <ul class="frame_thumbs clearfix">                    
                    <!-- Start. Show additional images -->
                    { if sizeof($productImages = $model->getSProductImagess()) > 0}
                    { foreach $productImages as $key => $image}
                    <li>
                        <a rel="useZoom: 'photoGroup', smallImage: '{productImageUrl('products/additional/'.$image->getImageName())}'" href="{productImageUrl('products/additional/'.$image->getImageName())}" class="photo cloud-zoom-gallery">
                            <figure>
                                <span class="helper"></span>
                                <img src="{echo productImageUrl('products/additional/thumb_'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                            </figure>
                        </a>                                
                    </li>
                    { /foreach}
                    <li>
                        <a rel="useZoom: 'photoGroup', smallImage: '{echo $model->firstVariant->getMainPhoto()}'" href="{echo $model->firstVariant->getLargePhoto()}" class="photo cloud-zoom-gallery">
                            <figure>
                                <span class="helper"></span>
                                <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                            </figure>
                        </a>                                
                    </li>
                    { /if}   

                    <!-- End. Show additional images -->
                </ul>               
            </li>
            <!--Photo block for main product end-->
            <li class="span8" id="right_popup_product" data-width="65.8"  data-rel="frameP">
                <div class="frame_w_desc">
                    <h1 class="d_i">{ echo ShopCore::encode($model->getName())}</h1>
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
                    <div class="clearfix frame_buy">
                        <div class="f-s_0 d_i-b v-a_b">
                            <!-- Start. Output of all the options -->
                            <div class="f-s_0">
                                {$variants = $model->getProductVariants()}
                        {$cnt = 0}{foreach $variants as $v}{if in_array($v->getId(),$__product_parametr['on'])}{$cnt++}{/if}{/foreach}
                        {if count($variants) > 1 && $cnt > 1}
                            <div class=" d_i-b v-a_b m-b_15 m-r_30 variantProd">
                                <span class="title">{lang('Выбор варианта', 'product_slider')}:</span>
                                <div class="lineForm w_170">
                                    <select id="variantSwitcher" name="variant">
                                        {foreach $variants as $key => $pv}
                                            {if in_array($pv->getId(),$__product_parametr['on'])}
                                                {if $pv->getName()}
                                                    {$name = ShopCore::encode($pv->getName())}
                                                {else:}
                                                    {$name = ShopCore::encode($model->getName())}
                                                {/if}
                                                <option value="{echo $pv->getId()}" title="{echo $name}">
                                                    {echo $name}
                                                </option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <!-- End. Output of all the options -->
                        {/if}
                        <div class=" d_i-b v-a_b m-r_10 m-b_15">
                            <div class="price price_f-s_24">
                                <!-- $model->hasDiscounts() - check for a discount. -->
                                {if $model->hasDiscounts()}
                                    <span class="d_b old_price">
                                        <!--
                                        "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                        output price without discount
                                         To display the number of abatement "$model->firstVariant->getNumDiscount()"
                                        -->

                                        <span class="f-w_b priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>

                                        {$CS}
                                    </span>
                                {/if}
                                <!--
                                If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                                will display the price already discounted
                                -->
                                <span class="f-w_b priceVariant">{echo $model->firstVariant->toCurrency()}</span>{$CS}
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

                            {foreach $variants as $key => $pv}
                                {if $pv->getStock() > 0}
                                    <button {if $key != 0}style="display:none"{/if}
                                                          class="btn btn_buy btnBuy variant_{echo $pv->getId()} variant info"
                                                          type="button"

                                                          data-id="{echo $pv->getId()}"
                                                          data-prodid="{echo $model->getId()}"
                                                          data-varid="{echo $pv->getId()}"
                                                          data-price="{echo $pv->toCurrency()}"
                                                          data-name="{echo ShopCore::encode($model->getName())}"
                                                          data-vname="{echo ShopCore::encode($pv->getName())}"
                                                          data-maxcount="{echo $pv->getstock()}"
                                                          data-number="{echo $pv->getNumber()}"
                                                          data-img="{echo $pv->getSmallPhoto()}"
                                                          data-mainImage="{echo $pv->getMainPhoto()}"
                                                          data-largeImage="{echo $pv->getlargePhoto()}"
                                                          data-origPrice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                          data-stock="{echo $pv->getStock()}"
                                                          >
                                        {lang('Купить','product_slider')}
                                    </button>
                                {else:}
                                    <button  {if $key != 0}style="display:none"{/if}
                                                           class="btn btn_not_avail variant_{echo $pv->getId()} variant info"
                                                           type="button"
                                                           data-placement="top right"
                                                           data-place="noinherit"
                                                           data-duration="500"
                                                           data-effect-off=    "fadeOut"
                                                           data-effect-on="fadeIn"
                                                           data-drop=".drop-report"

                                                           data-id="{echo $pv->getId()}"
                                                           data-prodid="{echo $model->getId()}"
                                                           data-varid="{echo $pv->getId()}"
                                                           data-price="{echo $pv->toCurrency()}"
                                                           data-name="{echo ShopCore::encode($model->getName())}"
                                                           data-vname="{echo ShopCore::encode($pv->getName())}"
                                                           data-maxcount="{echo $pv->getstock()}"
                                                           data-number="{echo $pv->getNumber()}"
                                                           data-img="{echo $pv->getSmallPhoto()}"
                                                           data-mainImage="{echo $pv->getMainPhoto()}"
                                                           data-largeImage="{echo $pv->getlargePhoto()}"
                                                           data-origPrice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                           data-stock="{echo $pv->getStock()}"
                                                           >
                                        <span class="icon-but"></span>
                                        <span class="text-el">{lang('Сообщить о появлении','product_slider')}</span>
                                    </button>
                                {/if}
                            {/foreach}
                        </div>
                        <button class="btn btn-more d_i-b m-b_15 m-r_10">
                            <a href="{shop_url('product/' . $model->geturl())}">{lang('Подробнее', 'product_slider')}</a>
                        </button>
                        <div class="v-a_b d_i-b m-b_15 add_func_btn">
                            <!-- Start. Block "Add to Compare" -->
                            <button class="btn_small_p toCompare d_i-b v-a_m"
                                    data-prodid="{echo $model->getId()}"
                                    type="button"
                                    data-title="{lang('В список сравнений','product_slider')}"
                                    data-firtitle="{lang('В список сравнений','product_slider')}"
                                    data-sectitle="{lang('В списке сравнений','product_slider')}"
                                    data-rel="tooltip"
                                    >
                                <span class="icon-comprasion_2"></span>
                                <span class="text-el">{lang('В список сравнений','product_slider')}</span>
                            </button>
                            <!-- End. Block "Add to Compare" -->

                            <!--Block Wishlist Start-->
                            <div class="wrap_wish-list d_i-b v-a_m">
                                {foreach $variants as $key => $pv}
                                    <div {if $key != 0}style="display:none;"{/if} class="variant_{echo $pv->getId()} variant m-t_5">
                                        <!-- to wish list button -->
                                        <button class="btn_small_p toWishlist"
                                                data-price="{echo $pv->toCurrency()}"
                                                data-prodid="{echo $model->getId()}"
                                                data-varid="{echo $pv->getId()}"
                                                type="button"
                                                data-title="{lang('В список желаний','product_slider')}"
                                                data-firtitle="{lang('В список желаний','product_slider')}"
                                                data-sectitle="{lang('В списке желаний','product_slider')}"
                                                data-rel="tooltip">
                                            <span class="icon-wish_2"></span>
                                            <span class="text-el">{lang('В список желаний','product_slider')}</span>
                                        </button>
                                    </div>
                                {/foreach}
                            </div>
                            <!-- Stop. Block "Add to Wishlist" -->
                            <!--Block Follow the price Start-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="share_tov">
                {echo $CI->load->module('share')->_make_share_form()}
            </div>
        </div>
        <div id="xBlock"></div>
        <!-- Start. Withdraw button to "share" -->
        <div class="frame_tabs">
            {$renderProperties = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model)}
            {if count($renderProperties) >0}
                <div id="characteristic" data-height="55">
                    <table border="0" cellpadding="4" cellspacing="0" class="characteristic">
                        <tbody>
                            {foreach $renderProperties as $prop}
                                <tr>
                                    <td>
                                        {if $prop.Desc && $prop.ShowFaq}
                                            <div class="item_add d_i-b">
                                                <span class="icon-infoM"></span><span>{echo $prop.Name}</span>
                                                <div class="drop drop_down">
                                                    <div class="drop-content">
                                                        {echo $prop.Desc}
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        {else:}
                                            {echo $prop.Name}                                               
                                        {/if}
                                    </td>
                                    <td>{echo $prop.Value}</td>
                                </tr>
                            {/foreach}
                            {foreach $renderProperties as $prop}
                                <tr>
                                    <td>
                                        {if $prop.Desc && $prop.ShowFaq}
                                            <div class="item_add d_i-b">
                                                <span class="icon-infoM"></span><span>{echo $prop.Name}</span>
                                                <div class="drop drop_down">
                                                    <div class="drop-content">
                                                        {echo $prop.Desc}
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        {else:}
                                            {echo $prop.Name}                                               
                                        {/if}
                                    </td>
                                    <td>{echo $prop.Value}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>

                </div>
            {/if}
            <!-- End. Withdraw button to "share" -->
            {if $model->getFullDescription() != ''}
                <div id="info" data-height="45">
                    <div class="text">
                        { echo $model->getFullDescription()}                      
                    </div>
                </div>
            {/if}
        </div>
        <div class="t-a_r m-t_20">
            <a href="{shop_url('product/' . $model->geturl())}">{lang('Подробнее о товаре', 'product_slider')}</a>
        </div>
    </li>
</ul>
</div>
<!--Kit start-->

<!--Kit end-->
</div>
<script>
    var text = new Object();
    text.close = '{lang('Закрыть', 'product_slider')}'
</script>