{#
/**
 * @file Render shop product; 
 * @partof product.tpl;
 * @updated 26 February 2013;
 * Variables
 *  $Comments : Mostly all the comments on the product page.
 *  $model : PropelObjectCollection of (object) instance of SProducts
 *   $model->hasDiscounts() : Check whether the discount on the product.
 *   $model->firstVariant : variable which contains the first variant of product;
 *   $model->firstVariant->toCurrency() : variable which contains the first variant of product;
 *
 */
#}
{$Comments = $CI->load->module('comments')->init($model)}
<div>
    <article>       
        {//making bread crumbs}
        {widget('path')}
        <div class="item_tovar">
            <div class="row">
                <!--Photo block for main product-->
                <div class="photo span5 clearfix">
                    <!--productImageUrl($model->getMainModImage()) - Link to product-->
                    <a rel="group" id="photoGroup" href="{productImageUrl($model->getMainModImage())}">
                        <figure>
                            <!--productImageUrl($model->getMainImage()) - Way before the photo to attribute img-->
                            <img id="imageGroup" src="{productImageUrl($model->getMainImage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                        </figure>                        
                    </a>              
                    <ul class="frame_thumbs">                   
                        <li class="active">
                            <a rel="group" href="{productImageUrl($model->getMainModImage())}">   
                                <figure>
                                    <img src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                                </figure>
                            </a>                                
                        </li>                   
                        <!--block additional images-->
                        {if sizeof($productImages = $model->getSProductImagess()) > 0}
                            {foreach $productImages as $key => $image}
                                <li>
                                    <a rel="group" href="{echo $image->getThumbUrl()}">   
                                        <figure>
                                            <img src="{productImageUrl($image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                        </figure>
                                    </a>                                
                                </li>
                            {/foreach}
                        {/if}        
                        <!--block additional images End--> 
                    </ul>
                </div>
                <!--Photo block for main product end-->
                <div class="span7">
                    <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                    <span class="c_97" id="number">
                    {if $model->firstVariant->getNumber() != ''}(Артикул {echo $model->firstVariant->getNumber()}) {/if}
                </span>

                <!-- Output rating for the old product Start -->
                <div class="frame_response">
                    <div class="star">
                        {$CI->load->module('star_rating')->show_star_rating($model)}
                    </div>
                </div>
                <!-- Output rating for the old product End -->
                <div class="clearfix">
                    <div class="d_i-b v-a_b m-b_20">
                        <!--Output of all the options-->
                        {if count($model->getProductVariants()) > 1}
                            <div class=" d_i-b v-a_b m-r_30" id="variantProd">
                                <span class="title">Выбор варианта:</span>
                                <div class="lineForm w_170">
                                    <select id="var" name="variant">
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
                            <!--Output of all the options END -->
                            <!--transmission of information on the JS to select an option-->
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
                    <!--Transmission of information on the ESA to select an option END--> 
                {/if}
                <div class=" d_i-b v-a_b m-r_45">
                    <div class="price price_f-s_24">
                        <!--
                        $model->hasDiscounts() - checking for the existence of discounts. 
                        If there is a discount price without discount deduce
                        -->
                        {if $model->hasDiscounts()}
                            <span class="d_b old_price">
                                <!--
                                "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                output price without discount
                                -->
                                <span class="f-w_b" id="priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>
                                {$CS}
                            </span>                           
                        {/if}
                        <!--
                        If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                        will display the price already discounted
                        -->
                        <span class="f-w_b" id="priceVariant">{echo $model->firstVariant->toCurrency()}</span>{$CS}
                        <!--To display the amount of discounts you can use $model->firstVariant->getNumDiscount()-->
                    </div>    
                    <!--
                    Buy button applies the 
                    data-prodid - product ID
                    data-varid - variant ID
                    data-price - price Product
                    data-name - name product
                    these are the main four options for the button to "buy"
                    -->
                    <button  class="btn btn_buy variant" type="button" data-prodid="{echo $model->getId()}" data-varid="{echo $model->firstVariant->getId()}" data-price="{echo $model->firstVariant->getPrice()}" data-name="{echo ShopCore::encode($model->getName())}">{lang('s_buy')}</button>

                    {foreach $model->getProductVariants() as $key => $pv}
                        <button style="display: none;" class="btn btn_buy variant_{echo $pv->getId()} variant" type="button" data-prodid="{echo $pv->getId()}" data-varid="{echo $pv->getId()}" data-price="{echo $pv->toCurrency()}" data-name="{if $pv->getName()}{echo ShopCore::encode($pv->getName())}{else:}{echo ShopCore::encode($model->getName())}{/if}">{lang('s_buy')}</button>
                    {/foreach}
                </div>
            </div>
            <div class="d_i-b v-a_b m-b_20">

                <!--The comparator Start-->
                <button data-prodid="{echo $model->id}" class="btn btn_small_p" type="button" title="добавить в список сравнений">
                    <span class="icon-comprasion_2"></span>
                    <span>Добавить к сравнению</span>
                </button>
                <!--The comparator End-->

                <br/>
                <!--Block Wishlist Start-->
                <button class="btn btn_small_p" type="button" title="добавить в список желаний">
                    {if !is_in_wish($model->getId())}
                        <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" 
                              data-varid="{echo $model->firstVariant->getId()}" 
                              data-prodid="{echo $model->getId()}" 
                              class="addToWList">
                            <span class="icon-wish_2"></span>
                            <span class="js blue">{lang('s_slw')}</span>
                        </span>
                    {else:}
                        <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                    {/if}
                </button>
                <!--Block Wishlist End-->

            </div>
        </div>
        <!--Withdraw button to "share" Start-->
        <div class="share_tov">
            {echo $CI->load->module('share')->_make_share_form()}
        </div>
        <!--Withdraw button to "share" End-->

        <ul class="tabs clearfix">
            <!--Output of the block information if available-->
            {if $model->getShortDescription() != ''}
                <li>
                    <button type="button" data-href="#info">
                        <span class="icon-info"></span>
                        <span class="text-el">Информация</span>
                    </button>
                </li>
            {/if}
            <!--Output of the block informationEND-->
            <!--Characteristics of the output of the block if you have one-->
            {if $renderProperties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                <li>
                    <button type="button" data-href="#characteristic">
                        <span class="icon-charack"></span>
                        <span class="text-el">{lang('s_properties')}</span>
                    </button>
                </li>
            {/if}
            <!--Characteristics of the output of the block END-->
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
            <li>
                <button type="button" data-href="#comment" onclick="renderPosts(this)">
                    <span class="icon-comment-tab"></span>
                    <span class="text-el">                    
                        <span id="cc">
                            {echo $Comments[$model->getId()]}
                        </span>
                    </span>
                </button>
            </li>
            <!--Output of the block comments END-->
        </ul>

        <div class="frame_tabs">
            <!--Piece of information about the product Start-->
            {if $model->getShortDescription() != ''}
                <div id="info">
                    <div class="text">
                        {echo $model->getShortDescription()}                      
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
                                <!--Photo and link to accessory Start-->
                                <a href="{shop_url('product/' . $p->getUrl())}" class="photo">
                                    <span class="helper"></span>
                                    <figure>
                                        <img src="{productImageUrl($p->getMainImage())}" alt="{echo ShopCore::encode($p->getName())}"/>
                                    </figure>
                                </a>            
                                <!--Photo and link to accessory End-->
                                <div class="description">
                                    <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                    <div class="price price_f-s_16">
                                        {if $p->hasDiscounts()}
                                            <span class="d_b old_price">
                                                <!--
                                                "$p->firstVariant->toCurrency('OrigPrice')" or $p->firstVariant->getOrigPrice()
                                                output price without discount
                                                -->
                                                <span class="f-w_b" id="priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                                {$CS}
                                            </span>                                              
                                        {/if}
                                        <span class="f-w_b">{echo $p->firstvariant->toCurrency()}</span> {$CS}
                                    </div>
                                    <!--
                                                Buy button applies the 
                                                data-prodid - product ID
                                                data-varid - variant ID
                                                data-price - price Product
                                                data-name - name product
                                                these are the main four options for the button to "buy"
                                    -->
                                    <button class="btn btn_buy" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" data-price="{echo $p->firstvariant->toCurrency()}" data-name="{echo ShopCore::encode($p->getName())}" type="button">{lang('s_buy')}</button>


                                    <div class="d_i-b">                                                    
                                        <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                        <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                    </div>
                                </div>
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
    </div>
</div>
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
                                                <span class="f-w_b">{echo $kitProducts->getMainProductPrice()}</span>
                                                {$CS}
                                            </div>
                                        </div>
                                        <a href="{shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}" class="photo">
                                            <span class="helper"></span>
                                            <figure>
                                                <img src="{productImageUrl($kitProducts->getMainProduct()->getSmallModImage())}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="d_i-b">+</div>
                                </li>
                                <!--Output of goods subsidiaries set-->
                                {$data = array('names'=>array(), 'ids'=>array(), 'prices'=>array())}
                                {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}  
                                    {array_push($data['names'], $kitProduct->getSProducts()->getName())}
                                    {array_push($data['ids'], $kitProduct->getSProducts()->getId())}
                                    {array_push($data['prices'], (float)trim($kitProduct->getDiscountProductPrice()))}
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
                                                            <span class="f-w_b">{echo $kitProduct->getBeforePrice()}</span>
                                                            {$CS}
                                                        </span>
                                                    {/if}
                                                    <!--$kitProduct->getDiscountProductPrice() - discount price-->
                                                    <span class="f-w_b">{echo $kitProduct->getDiscountProductPrice()}</span>
                                                    {$CS}
                                                </div>
                                            </div>
                                            <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{productImageUrl($kitProduct->getSProducts()->getSmallModImage())}"/>
                                                </figure>
                                            </a>
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
                                            <span class="f-w_b">{echo $kitProducts->getAllPriceBefore()}</span> {$CS}
                                        </span>
                                        <!-- $kitProducts->getTotalPrice() - the entire set of output price with discount-->
                                        <span class="f-w_b">{echo $kitProducts->getTotalPrice()}</span> {$CS}
                                    </div>                                   
                                    <button class="btn btn_buy" type="button" 
                                            data-prodid="{$data['ids'][] =  $kitProducts->getMainProduct()->getId(); echo json_encode(array_merge($data['ids']))}" 
                                            data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}" 
                                            data-price="{echo $kitProducts->getTotalPrice()}" 
                                            data-prices ="{$data['prices'][] = (float)$kitProducts->getMainProductPrice(); echo json_encode($data['prices'])}"
                                            data-name="{$data['names'][] =  $kitProducts->getMainProduct()->getName(); echo ShopCore::encode(json_encode($data['names']))}" 
                                            data-kit="true">{lang('s_buy')}</button>
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


<!--Similar Products-->

{if count($simProduct = getSimilarProduct($model)) > 1}
    <div class="frame_carousel_product carousel_js c_b">
        <div class="m-b_20">
            <div class="title_h1 d_i-b v-a_m">{lang('s_similar_product')}</div>
            <div class="d_i-b groupButton v-a_m">
                <button type="button" class="btn btn_prev">
                    <span class="icon prev"></span>
                    <span class="icon-info"></span>
                </button>
                <button type="button" class="btn btn_next">
                    <span class="icon-info"></span>
                    <span class="icon next"></span>
                </button>
            </div>
        </div>
        <div class="carousel">
            <ul class="items items_catalog">
                <!--Output set of similar products-->
                {foreach $simProduct as $product}
                    <!--
                    Check whether there is product available.
                    If no show it a little lighter.
                    -->
                    <li class="span3 {if $product->firstVariant->getStock() == 0}not-avail{/if}">
                        <!-- $product->getUrl() - the path to the product-->
                        <a href="{site_url('shop/product/'.$product->getUrl())}" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <!--$product->getMainImage() - product image-->
                                <img src="{productImageUrl($product->getMainImage())}" alt="{echo ShopCore::encode($product->getName())}"/>
                            </figure>
                        </a>
                        <div class="description">                            
                            <a href="{site_url('shop/product/'.$product->getUrl())}">{echo ShopCore::encode($product->getName())}</a>
                            <div class="price price_f-s_16">
                                <!--
                                    "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                    output price without discount
                                -->
                                {if $product->hasDiscounts()}
                                    <span class="d_b old_price">
                                        <span class="f-w_b">{echo $product->firstVariant->toCurrency('OrigPrice')}</span>
                                        {$CS}
                                    </span>                           
                                {/if}
                                <!--
                           If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                           will display the price already discounted
                                -->
                                <span class="f-w_b">{echo $product->firstVariant->toCurrency()}</span> 
                                {$CS}
                            </div>
                            <button class="btn btn_buy" type="button" data-prodid="{echo $product->getId()}" data-varid="{echo $product->firstVariant->getId()}" data-price="{echo $product->firstVariant->getPrice()}" data-name="{echo ShopCore::encode($product->getName())}">{lang('s_buy')}</button>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}
<!--Similar Products END-->
</article>
</div>