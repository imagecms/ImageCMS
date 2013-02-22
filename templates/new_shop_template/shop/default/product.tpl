{$CI->load->module('comments')->init($model)}
<div>
    <article>       
        <!--renderCategoryPath() - generation of breadcrumbs-->
        {renderCategoryPath($model->getMainCategory())}
        <div class="item_tovar bot_border_grey">
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
                        {if sizeof($model->getSProductImagess()) > 0}
                            {foreach $model->getSProductImagess() as $key => $image}
                                <li>
                                    <a rel="group" href="{echo $image->getThumbUrl()}">   
                                        <figure>
                                            <img src="{echo $image->getThumbUrl()}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
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
                    {if $model->firstVariant->getNumber() != ''}
                        <span class="c_97" id="number">(Артикул {echo $model->firstVariant->getNumber()})</span>
                    {/if}
                    <div class="frame_response">
                        <div class="star">
                            {$CI->load->module('star_rating')->show_star_rating($model)}
                        </div>
                        <a href="#" class="count_response"><span class="icon-comment"></span>145 відгуків</a>
                    </div>

                    <div class="clearfix">
                        <div class="d_i-b v-a_b m-b_20">
                            <!--Output of all the options-->
                            {if count($model->getProductVariants()) > 1}
                                <div class=" d_i-b v-a_b m-r_30" id="variantProd">
                                    <span class="title">Выбор варианта:</span>
                                    <div class="lineForm w_170">
                                        <select id="var" name="variant">
                                            {foreach $model->getProductVariants() as $key => $pv}
                                                <option value="{echo $pv->getId()}">{if $pv->getName()}{echo $pv->getName()}{else:}{echo $model->getName()}{/if}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>
                                <!--Output of all the options END -->
                                <!--transmission of information on the JS to select an option-->
                                {foreach $model->getProductVariants() as $key => $pv}

                            {if $pv->getMainImage()}{$mainImage = $pv->getMainImage()}{else:}{$mainImage = $model->getMainimage()}{/if}
                            <span class="variant_{echo $pv->getId()}" 
                                  data-id="{echo $pv->getId()}"
                                  data-name="{echo $pv->getName()}"
                                  data-price="{echo $pv->toCurrency()}"
                                  data-number="{echo $pv->getNumber()}"
                                  data-origPrice="{if $model->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                  data-mainImage="{echo $mainImage}"
                                  data-smallImage="{echo $pv->getSmallImage()}"
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
                        <button  class="btn btn_buy variant" type="button" data-prodid="{echo $model->getId()}" data-varid="{echo $model->firstVariant->getId()}" data-price="{echo $model->firstVariant->getPrice()}" data-name="{echo $model->getName()}">{lang('s_buy')}</button>

                        {foreach $model->getProductVariants() as $key => $pv}
                            <button style="display: none;" class="btn btn_buy variant_{echo $pv->getId()} variant" type="button" data-prodid="{echo $pv->getId()}" data-varid="{echo $pv->getId()}" data-price="{echo $pv->getPrice()}" data-name="{echo $pv->getName()}">{lang('s_buy')}</button>
                        {/foreach}
                    </div>
                </div>
                <div class="d_i-b v-a_b m-b_20">

                    <button data-prodid="{echo $model->id}" class="btn btn_small_p" type="button" title="добавить в список сравнений">
                        <span class="icon-comprasion_2"></span>
                        <span>Добавить к сравнению</span>
                    </button>

                    <br/>
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

                </div>
            </div>
            <div class="share_tov">
                {echo $CI->load->module('share')->_make_share_form()}
            </div>
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
                {if $renderProperties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
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
                            <div id="cc">{if $total_comments > 0}{echo lang('lang_total_comments') . $total_comments}{else:}Нет комментариев{/if}</div>
                        </span>
                    </button>
                </li>
                <!--Output of the block comments END-->
            </ul>
            <div class="frame_tabs">
                {if $model->getShortDescription() != ''}
                    <div id="info">
                        <div class="text">
                            {echo $model->getShortDescription()}                      
                        </div>
                    </div>
                {/if}
                {if $renderProperties}
                    <div id="characteristic">   
                        {echo $renderProperties}  
                    </div>
                {/if}
                {if $accessories}
                    <div id="accessories">
                        <ul class="items items_catalog" data-radio-frame>
                            {foreach $accessories as $p}  
                                <!--<li class="span3 not-avail">-->
                                <li class="span3 {if $p->firstvariant->getStock() == 0}not-avail{/if}">
                                    <a href="{shop_url('product/' . $p->getUrl())}" class="photo">
                                        <span class="helper"></span>
                                        <figure>
                                            <img src="{productImageUrl($p->getMainImage())}" alt="{echo ShopCore::encode($p->getName())}"/>
                                        </figure>
                                    </a>            
                                    <div class="description">
                                        <div class="frame_response">
                                            <div class="star">
                                                <img src="images/temp/STAR.png"/>
                                            </div>
                                            <a href="#" class="count_response"><span class="icon-comment"></span>145 відгуків</a>
                                        </div>
                                        <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                        <div class="price price_f-s_16">
                                            <span class="f-w_b">{echo $p->firstvariant->toCurrency()}</span> {$CS}
                                        </div>
                                        <button class="btn btn_buy" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" data-price="{echo $p->firstvariant->toCurrency()}" data-name="{echo $p->getName()}" type="button">{lang('s_buy')}</button>


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
                    {foreach $model->getShopKits() as $kid}                                     
                        <li class="container">
                            <ul class="items items_middle">
                                <li class="span3">
                                    <div class="item_set">
                                        <!--Photo, price, name for parent product-->
                                        <div class="description">
                                            <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}">
                                                {echo ShopCore::encode($kid->getMainProduct()->getName())}
                                            </a>
                                            <div class="price price_f-s_16">
                                                <!-- "$kid->getMainProductPrice()" price of the main product-->
                                                <span class="f-w_b">{echo $kid->getMainProductPrice()}</span>
                                                {$CS}
                                            </div>
                                        </div>
                                        <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}" class="photo">
                                            <span class="helper"></span>
                                            <figure>
                                                <img src="{productImageUrl($kid->getMainProduct()->getSmallModImage())}" alt="{echo ShopCore::encode($kid->getMainProduct()->getName())}"/>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="d_i-b">+</div>
                                </li>
                                {foreach $kid->getShopKitProducts() as  $key => $kitProduct}                                        
                                    <li class="span3">
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
                                    {if $kid->countProducts() == $key}={else:}+{/if}
                                </div>
                            </li>                                            
                        {/foreach}
                        <li class="span3 p-t_40">
                            <div class="price price_f-s_24">
                                <span class="d_b old_price">
                                    <!--$kid->getAllPriceBefore() - The entire set of output price without discount-->
                                    <span class="f-w_b">{echo $kid->getAllPriceBefore()}</span> {$CS}
                                </span>
                                <!-- $kid->getTotalPrice() - the entire set of output price with discount-->
                                <span class="f-w_b">{echo $kid->getTotalPrice()}</span> {$CS}
                            </div>                                    
                            <button class="btn btn_buy" type="button" data-prodid="{echo $kid->getMainProduct()->getId()}" data-varid="{echo $kid->getMainProduct()->firstVariant->getId()}" data-price="{echo $kid->getMainProductPrice()}" data-name="{echo $kid->getMainProduct()->getName()}">{lang('s_buy')}</button>

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
                {foreach $simProduct as $product}
                    <li class="span3 {if $product->firstVariant->getStock() == 0}not-avail{/if}">
                        <a href="{site_url('shop/product/'.$product->getUrl())}" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="{productImageUrl($product->getMainImage())}" alt="{echo ShopCore::encode($product->getName())}"/>
                            </figure>
                        </a>
                        <div class="description">                            
                            <a href="{site_url('shop/product/'.$product->getUrl())}">{echo ShopCore::encode($product->getName())}</a>
                            <div class="price price_f-s_16">
                                {if $product->hasDiscounts()}
                                    <span class="d_b old_price">
                                        <span class="f-w_b">{echo $product->firstVariant->toCurrency('OrigPrice')}</span>
                                        {$CS}
                                    </span>                           
                                {/if}
                                <span class="f-w_b">{echo $product->firstVariant->toCurrency()}</span> 
                                {$CS}
                            </div>
                            <button class="btn btn_buy" type="button" data-prodid="{echo $product->getId()}" data-varid="{echo $product->firstVariant->getId()}" data-price="{echo $product->firstVariant->getPrice()}" data-name="{echo $product->getName()}">{lang('s_buy')}</button>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}
<!--similar Products END-->
</article>
</div>