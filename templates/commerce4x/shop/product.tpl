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
<article class="container">
    <!-- Making bread crumbs -->
    {widget('path')}
    <div class="item_tovar">
        <div class="row">
            <!--Photo block for main product-->
            <div class="span5 clearfix">
                <!-- productImageUrl($model->getMainModImage()) - Link to product -->
                <div class="photo-block">
                    <a rel="group" href="{echo $model->firstVariant->getLargePhoto()}" class="photo photoProduct">
                        <figure>
                            <span class="helper"></span>
                            <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" class="vimg"/>
                        </figure>
                    </a>
                </div>
                <ul class="frame_thumbs">
                    <!-- Start. Show additional images -->
                    {if sizeof($productImages = $model->getSProductImagess()) > 0}
                        {foreach $productImages as $key => $image}
                            <li>
                                <a rel="group" href="{productImageUrl('products/additional/'.$image->getImageName())}" class="photo">
                                    <figure>
                                        <span class="helper"></span>
                                        <img src="{echo productImageUrl('products/additional/thumb_'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                    </figure>
                                </a>
                            </li>
                        {/foreach}
                    {/if}
                    <!-- End. Show additional images -->
                </ul>
            </div>
                    
                     
            <!--Photo block for main product end-->
            <div class="span7">
                <div class="description" data-rel="frameP">
                    <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                    <span class="d_i-b m-b_10">
                        {$hasCode = $model->firstVariant->getNumber() == '';}
                        <span class="frame_number" {if $hasCode}style="display:none;"{/if}>Артикул: <span class="code">({if !$hasCode}{echo $model->firstVariant->getNumber()}{/if})</span></span>
                        {$hasVariant = $model->firstVariant->getName() == '';}
                        <span class="frame_variant_name" {if $hasVariant}style="display:none;"{/if}>Вариант: <span class="code">({if !$hasVariant}{echo $model->firstVariant->getName()}{/if})</span></span>
                    </span>
                    <!-- Output rating for the old product Start -->
                    <div class="frame_response">
                        <div class="star">
                            {$CI->load->module('star_rating')->show_star_rating($model)}
                        </div>
                    </div>
                    <!-- Output rating for the old product End -->
                    <div class="clearfix frame_buy">
                        <div class="f-s_0 d_i-b v-a_b">
                            <!-- Start. Output of all the options -->
                            <div class="f-s_0 d_i-b v-a_b m-b_20">
                                {$variants = $model->getProductVariants()}
                                {if count($variants) > 1}
                                    <div class=" d_i-b v-a_b m-r_30 variantProd">
                                        <span class="title">Выбор варианта:</span>
                                        <div class="lineForm w_170">
                                            <select id="variantSwitcher" name="variant">
                                                {foreach $variants as $key => $pv}
                                                    {if $pv->getName()}
                                                        {$name = ShopCore::encode($pv->getName())}
                                                    {else:}
                                                        {$name = ShopCore::encode($model->getName())}
                                                    {/if}
                                                    <option value="{echo $pv->getId()}" title="{echo $name}">
                                                        {echo $name}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End. Output of all the options -->
                                {/if}
                                <div class=" d_i-b v-a_b m-r_45">
                                    <div class="price price_f-s_24">
                                        <!-- $model->hasDiscounts() - check for a discount. -->
                                        {if $model->hasDiscounts()}
                                            {//$CI->load->module('mod_discount/discount_api')->get_discount_product_api(array('id'=>$model->getid(),vid=>$model->firstvariant->getid()),'json')}
                                            <span class="d_b old_price">
                                                <!--
                                                "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                                output price without discount
                                                 To display the number of abatement "$model->firstVariant->getNumDiscount()"
                                                -->

                                                <span class="f-w_b priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>

                                                {//echo $model->firstVariant->getVirtual('discounttpl')}
                                                {//var_dump($model->firstVariant->getVirtual('discount'))}

                                                {$CS}
                                            </span>
                                        {/if}
                                        <!--
                                        If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                                        will display the price already discounted
                                        -->
                                        <span class="f-w_b priceVariant">{echo $model->firstVariant->toCurrency()}</span> {$CS}
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
                                                                  class="btn btn_buy btnBuy variant_{echo $pv->getId()} variant"
                                                                  type="button"

                                                                  data-id="{echo $pv->getId()}"
                                                                  data-prodid="{echo $model->getId()}"
                                                                  data-varid="{echo $pv->getId()}"
                                                                  data-price="{echo $pv->toCurrency()}"
                                                                  data-name="{echo ShopCore::encode($model->getName())}"
                                                                  data-vname="{echo ShopCore::encode($pv->getName())}"
                                                                  data-maxcount="{echo $pv->getstock()}"
                                                                  data-number="{echo $pv->getNumber()}"
                                                                  data-url="{echo shop_url('product/' . $model->getUrl())}"
                                                                  data-img="{echo $pv->getSmallPhoto()}"
                                                                  data-mainImage="{echo $pv->getMainPhoto()}"
                                                                  data-largeImage="{echo $pv->getlargePhoto()}"
                                                                  data-origprice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                                  data-stock="{echo $pv->getStock()}"
                                                                  >
                                               {lang("Buy","admin")}
                                            </button>
                                        {else:}
                                            <button  {if $key != 0}style="display:none"{/if}
                                                                   class="btn btn_not_avail variant_{echo $pv->getId()} variant"
                                                                   type="button"
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
                                                                   data-url="{echo shop_url('product/' . $model->getUrl())}"
                                                                   data-mainImage="{echo $pv->getMainPhoto()}"
                                                                   data-largeImage="{echo $pv->getlargePhoto()}"
                                                                   data-origprice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                                   data-stock="{echo $pv->getStock()}"
                                                                   >
                                                <span class="icon-but"></span>
                                                <span class="text-el">{lang('Сообщить о появлении','commerce4x')}</span>
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
                                        data-title="{lang('В список сравнений','commerce4x')}"
                                        data-firtitle="{lang('В список сравнений','commerce4x')}"
                                        data-sectitle="{lang('В списке сравнений','commerce4x')}"
                                        data-rel="tooltip"
                                        >
                                    <span class="icon-comprasion_2"></span>
                                    <span class="text-el">{lang('В список сравнений','commerce4x')}</span>
                                </button>
                                <!-- End. Block "Add to Compare" -->

                                <!--Block Wishlist Start-->
                                {/*}
                                {foreach $variants as $key => $pv}
                                    <div {if $key != 0}style="display:none"{/if} class="variant_{echo $pv->getId()} variant m-t_5">
                                        <!-- to wish list button -->
                                        <button class="btn btn_small_p toWishlist"
                                                data-price="{echo $pv->toCurrency()}"
                                                data-prodid="{echo $model->getId()}"
                                                data-varid="{echo $pv->getId()}"
                                                type="button"
                                                data-title="{lang('Add to wish list')}"
                                                data-firtitle="{lang('Add to wish list')}"
                                                data-sectitle="{lang('In wish list')}"
                                                data-rel="tooltip">
                                            <span class="icon-wish_2"></span>
                                            <span class="text-el">{lang('Add to wish list')}</span>
                                        </button>
                                    </div>
                                {/foreach}
                                { */}
                                <!-- Stop. Block "Add to Wishlist" -->
                                <!--Block Follow the price Start-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start. Withdraw button to "share" -->
                <div class="share_tov">
                    {echo $CI->load->module('share')->_make_share_form()}
                </div>
                <!-- End. Withdraw button to "share" -->
                <ul class="tabs clearfix">
                    <!-- Start. Show the block information if available -->
                    {if $model->getFullDescription() != ''}
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
                                <span class="text-el">{lang('Properties')}</span>
                            </button>
                        </li>
                    {/if}
                    <!-- End. Display characteristics block if you have one -->

                    <!--Output of the block if there is one accessory-->
                    {if $accessories = $model->getRelatedProductsModels()}
                        <li>
                            <button type="button" data-href="#accessories">
                                <span class="icon-accss"></span>
                                <span class="text-el">{lang('Accessories')}</span>
                            </button>
                        </li>
                    {/if}
                    <!--Output of the block if there is one accessory END-->
                    <!--Output of the block comments-->
                    {if $Comments}
                        <li>
                            <button type="button" data-href="#comment" onclick="renderPosts($('[name=for_comments]'))">
                                <span class="icon-comment-tab"></span>
                                <span class="text-el">
                                    <span id="cc">
                                        {if $Comments[$model->getId()][0] !== '0'}
                                            {echo $Comments[$model->getId()]}
                                        {else:}
                                            0 отзывов
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
                    {else:}
                        {if $model->getShortDescription()}
                            <div id="info">
                                <div class="text">
                                    {echo $model->getShortDescription()}
                                </div>
                            </div>
                        {/if}
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
                                    <li class="span3 {if $p->firstvariant->getStock() == 0}not_avail{/if}">
                                        <div class="description">
                                            <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                            <div class="price price_f-s_16">
                                                {if $p->hasDiscounts()}
                                                    <span class="d_b old_price">
                                                        <!--
                                                        "$p->firstVariant->toCurrency('OrigPrice')" or $p->firstVariant->getOrigPrice()
                                                        output price without discount
                                                        -->
                                                        <span class="f-w_b priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')} </span>
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
                                            <button class="btn btn_buy btnBuy"

                                                    data-id="{echo $p->getId()}"
                                                    data-varid="{echo $p->firstVariant->getId()}"
                                                    data-prodid="{echo $p->getId()}"
                                                    data-price="{echo $p->firstvariant->toCurrency()}"
                                                    data-name="{echo ShopCore::encode($p->getName())}"
                                                    type="button"
                                                    data-vname="{echo ShopCore::encode($p->firstVariant->getName())}"
                                                    data-number="{echo $p->firstVariant->getnumber()}"
                                                    data-maxcount="{echo $p->firstVariant->getstock()}"
                                                    data-img="{echo $p->firstVariant->getSmallPhoto()}"
                                                    data-url="{echo shop_url('product/' . $p->getUrl())}"
                                                    data-origprice="{if $p->hasDiscounts()}{echo $p->firstVariant->toCurrency('OrigPrice')}{/if}"
                                                    data-stock="{echo $p->firstVariant->getStock()}"
                                                    >
                                                {lang('Buy')}
                                            </button>
                                            <div class="d_i-b">
                                                <!-- to compare button -->
                                                <button class="btn btn_small_p toCompare"
                                                        data-prodid="{echo $p->getId()}"
                                                        type="button"
                                                        data-title="{lang('Add to compare')}"
                                                        data-sectitle="{lang('In compare')}"
                                                        data-rel="tooltip">
                                                    <span class="icon-comprasion_2"></span>
                                                </button>

                                                <!-- to wish list button -->
                                                <button class="btn btn_small_p toWishlist"
                                                        data-price="{echo $p->firstVariant->toCurrency()}"
                                                        data-prodid="{echo $p->getId()}"
                                                        data-varid="{echo $p->firstVariant->getId()}"
                                                        type="button"
                                                        data-title="{lang('Add to wish list')}"
                                                        data-sectitle="{lang('In wish list')}"
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
                                                    <img src="{echo $p->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($p->getName())}"/>
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
                    {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
                    <div id="comment">
                        <div id="for_comments" name="for_comments">{echo $c['comments']}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Kit start-->
    {if $model->getShopKits()}
        {if $model->getShopKits()->count() > 0}
            <div class="frame_carousel_product carousel_js c_b frameSet">
                <div class="m-b_20">
                    <div class="title_h1 d_i-b v-a_m promotion_text">{lang('Акционное предложение','commerce4x')}</div>
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
                <div>
                    <div class="row carousel">
                        <ul class="items items_catalog">
                            {foreach $model->getShopKits() as $key => $kitProducts}
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
                                                            <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
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
                                                                    <span class="f-w_b">{echo $kitProduct->getKitProductPrice()} </span>
                                                                    {$CS}
                                                                </span>
                                                            {/if}
                                                            <!--$kitProduct->getDiscountProductPrice() - discount price-->
                                                            <span class="f-w_b">{echo $kitProduct->getKitNewPrice()} </span>
                                                            {$CS}
                                                        </div>
                                                    </div>
                                                    <div class="photo-block">
                                                        <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}" class="photo">
                                                            <figure>
                                                                <span class="helper"></span>
                                                                <img src="{echo $kitProduct->getSProducts()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>
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
                                <li class="span3 p-t_40 gen_sum_kits">
                                    <div class="price price_f-s_24">
                                        <span class="d_b old_price">
                                            <!--$kitProducts->getAllPriceBefore() - The entire set of output price without discount-->
                                            <span class="f-w_b">{echo $kitProducts->getTotalPriceOld()} </span> {$CS}
                                        </span>
                                        <!-- $kitProducts->getTotalPrice() - the entire set of output price with discount-->
                                        <span class="f-w_b">{echo $kitProducts->getTotalPrice()} </span> {$CS}
                                    </div>

                                    <button class="btn btn_buy btnBuy" type="button"
                                            data-price="{echo $kitProducts->getTotalPrice()}"
                                            data-prodid="{echo json_encode(array_merge($kitProducts->getProductIdCart()))}"
                                            data-prices ="{echo json_encode($kitProducts->getPriceCart())}"
                                            data-name="{echo ShopCore::encode(json_encode($kitProducts->getNamesCart()))}"
                                            data-kit="true"
                                            data-kitId="{echo $kitProducts->getId()}"
                                            data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}"
                                            data-url='{echo json_encode($kitProducts->getUrls())}'
                                            data-img='{echo json_encode($kitProducts->getImgs())}'
                                            data-maxcount='{echo $kitProducts->getSProducts()->firstVariant->getStock()}'
                                            >
                                        {lang('Buy')}
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
{/if}
<!--Kit end-->

{//widget_ajax('similar' , 'article.container')}
{//widget_ajax('view_product' , 'article.container')}

{widget('view_product')}
{widget('similar')}
</article>
<script type="text/javascript" src="{$THEME}js/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
