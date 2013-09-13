{if count($simProduct = getSimilarProduct($model)) > 1}

    <div class="frame_carousel_product carousel_js c_b">
        <div class="m-b_20">
            <div class="title_h1 d_i-b v-a_m">{lang('Похожие товары','webinger')}</div>
            <div class="d_i-b groupButton v-a_m frame_carousel_button">
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
        <div class="carousel bot_border_grey">
            <ul class="items items_catalog">
                <!--Output set of similar products-->
                {foreach $simProduct as $product}
                    <!--
                    Check whether there is product available.
                    If no show it a little lighter.
                    -->
                    <li class="span3 {if $product->firstVariant->getStock() == 0}not-avail{/if}">
                        <!-- $product->getUrl() - the path to the product-->
                        <   div class="description">                            
                            <a href="{site_url('shop/product/'.$product->getUrl())}">{echo ShopCore::encode($product->getName())}</a>
                            <div class="price price_f-s_16">
                                <!--
                                    "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                    output price without discount
                                -->
                                {if $product->hasDiscounts()}
                                    <span class="d_b old_price">
                                        <span class="f-w_b">{echo $product->firstVariant->toCurrency('OrigPrice')} </span>
                                        {$CS}
                                    </span>                           
                                {/if}
                                <!--
                           If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                           will display the price already discounted
                                -->
                                <span class="f-w_b">{echo $product->firstVariant->toCurrency()} </span> 
                                {$CS}
                            </div>
                            <a class="btn btn_buy" href="{shop_url('product/' . $product->getUrl())}">{lang('Подробнее','webinger')}</a>
                            
                            <!--<button class="btn btn_buy" 
                                    type="button" 
                                    data-prodid="{echo $product->getId()}" 
                                    data-varid="{echo $product->firstVariant->getId()}" 
                                    data-price="{echo $product->firstVariant->toCurrency()}"  
                                    data-name="{echo ShopCore::encode($product->getName())}"
                                    data-number="{echo $product->firstVariant->getnumber()}"
                                    data-maxcount="{echo $product->firstVariant->getstock()}">
                                {lang('Подробнее','webinger')}
                                {if in_array($product->firstVariant->getId(),$__product_parametr['in_stock'])}{lang('Купить','webinger')}{else:}{lang('Заказать', 'webinger')}{/if} 
                            </button>
                            -->
                        </div>
                        <div class="photo-block">
                            <a href="{site_url('shop/product/'.$product->getUrl())}" class="photo">
                                <figure>
                                    <span class="helper"></span>
                                    <!--$product->getMainImage() - product image-->
                                    <img src="{productImageUrl($product->getMainImage())}" alt="{echo ShopCore::encode($product->getName())}"/>
                                </figure>
                            </a>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}