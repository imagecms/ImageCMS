<div>
    <article>       
        {renderCategoryPath($model->getMainCategory())}
        <div class="item_tovar bot_border_grey">
            <div class="row">
                <div class="photo span5 clearfix">

                    <a rel="group" href="{productImageUrl($model->getMainModImage())}">
                        <figure>
                            <img src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
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
                        {if sizeof($model->getSProductImagess()) > 0}
                            {$i = 1}
                            {foreach $model->getSProductImagess() as $image}
                                <li>
                                    <a rel="group" href="{echo $image->getThumbUrl()}">   
                                        <figure>
                                            <img src="{echo $image->getThumbUrl()}" alt="{echo ShopCore::encode($model->getName())} - {echo $i}"/>
                                        </figure>
                                    </a>                                
                                </li>
                                {$i++}
                            {/foreach}
                        {/if}                     
                    </ul>
                </div>

                <div class="span7">
                    <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                    {if $model->firstVariant->getNumber() != ''}
                        <span class="c_97">(Артикул {echo $model->firstVariant->getNumber()})</span>
                    {/if}
                    <div class="frame_response">
                        <div class="star">
                            <img src="images/temp/STAR.png"/>
                        </div>
                        <a href="#" class="count_response"><span class="icon-comment"></span>145 відгуків</a>
                    </div>
                    <div class="clearfix">
                        <div class="d_i-b v-a_b m-b_20">
                            <div class=" d_i-b v-a_b m-r_30" id="variantProd">
                                <span class="title">Выбор варианта:</span>
                                <div class="lineForm w_170">
                                    <select id="var" name="var">
                                        <option value="1" selected="selected">asdf</option>
                                        <option value="2">adsg</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" d_i-b v-a_b m-r_45">
                                <div class="price price_f-s_24">
                                    {if $model->hasDiscounts()}
                                        <span class="d_b old_price">
                                            <span class="f-w_b">{echo money_format('%i',$model->firstVariant->getOrigPrice())}</span>
                                            {$CS}
                                        </span>                           
                                    {/if}
                                    <span class="f-w_b">{echo money_format('%i',$model->firstVariant->getPrice())}</span>{$CS}
                                </div>
                                <button class="btn btn_buy" type="button" data-prodid="{echo $model->getId()}" data-varid="{echo $model->firstVariant->getId()}" data-price="{echo $model->firstVariant->getPrice()}" data-name="{echo $model->getName()}">В корзину</button>
                                <!--<button class="btn btn_buy" type="button">В корзину</button>-->
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
                        <li><button type="button" data-href="#info"><span class="icon-info"></span><span class="text-el">Информация</span></button></li>
                        {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                            <li>
                                <button type="button" data-href="#characteristic">
                                    <span class="icon-charack"></span>
                                    <span class="text-el">{lang('s_properties')}</span>
                                </button>
                            </li>
                        {/if}
                        {if $model->getRelatedProductsModels()}            
                            <li>
                                <button type="button" data-href="#accessories">
                                    <span class="icon-accss"></span>
                                    <span class="text-el">{lang('s_accessories')}</span>
                                </button>
                            </li>
                        {/if}
                        <li><button type="button" data-href="#comment"><span class="icon-comment-tab"></span><span class="text-el">Отзывы(5)</span></button></li>
                    </ul>
                    <div class="frame_tabs">
                        <div id="info">
                            <div class="text">
                                {if $model->getShortDescription() != ''}
                                    {echo $model->getShortDescription()}
                                {/if}                             
                            </div>
                        </div>
                        <div id="characteristic">   
                            {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}  
                            {/if}
                        </div>
                        {if $model->getRelatedProductsModels()}
                            <div id="accessories">
                                <ul class="items items_catalog" data-radio-frame>
                                    {foreach $model->getRelatedProductsModels() as $p}                                       
                                        {$rel_prod = currency_convert($p->firstvariant->getPrice(), $p->firstvariant->getCurrency())}
                                        {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                                        <!--<li class="span3 not-avail">-->
                                        <li class="span3">
                                            <a href="{shop_url('product/' . $p->getUrl())}" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{productImageUrl($p->getSmallModImage())}" alt="Apple MacBook Pro A1286"/>
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
                                                    <span class="f-w_b">{echo $p->firstvariant->getPrice()}</span> {$CS}
                                                </div>
                                                <button class="btn btn_buy" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" type="button">{$style.message}</button>


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

                                        {foreach $kid->getShopKitProducts() as $kitProduct}
                                            {$sProducts = $kitProduct->getSProducts()}                                            
                                            <li class="span3">
                                                <div class="item_set">
                                                    <div class="description">
                                                        <a href="{shop_url('product/' . $sProducts->getUrl())}">
                                                            {echo ShopCore::encode($sProducts->getName())}
                                                        </a>
                                                        <div class="price price_f-s_16">
                                                            {if $kitProduct->getDiscount() != 0}
                                                                <span class="d_b old_price">
                                                                    <span class="f-w_b">{echo $kitProduct->getBeforePrice()}</span>
                                                                    {$CS}
                                                                </span>
                                                            {/if}
                                                            <span class="f-w_b">{echo $kitProduct->getDiscountProductPrice()}</span>
                                                            {$CS}
                                                        </div>
                                                    </div>
                                                    <a href="{shop_url('product/' . $sProducts->getUrl())}" class="photo">
                                                        <span class="helper"></span>
                                                        <figure>
                                                            <img src="{productImageUrl($sProducts->getSmallModImage())}"/>
                                                        </figure>
                                                    </a>
                                                    <span class="top_tovar discount">-{echo $kitProduct->getDiscount()}%</span>
                                                </div>
                                                <div class="d_i-b">+</div>
                                            </li>                                            
                                        {/foreach}
                                        <li class="span3 p-t_40">
                                            <div class="price price_f-s_24">
                                                <span class="d_b old_price">
                                                    <span class="f-w_b">{echo $kid->getAllPriceBefore()}</span> {$CS}
                                                </span>
                                                <span class="f-w_b">{echo $kid->getTotalPrice()}</span> {$CS}
                                            </div>
                                            <button type="button" class="btn btn_buy ">{lang('s_buy')}</button>
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
                    {$simprod = getSimilarProduct($model)}
                    {foreach $simprod as $sp}
                        {$sim_prod = currency_convert($sp['price'], $sp['currency'])}
                        {$style = productInCart($cart_data, $sp['ProductId'], $sp['ProductId'], $sp['stock'])}
                        <li class="span3 in_cart {if $sp['stock']== 0}not-avail{/if}">
                            <a href="{site_url('shop/product/'.$sp['url'])}" class="photo">
                                <span class="helper"></span>
                                <figure>
                                    <img src="{productImageUrl($sp['mainImage'])}" alt="{echo ShopCore::encode($sp['name'])}"/>
                                </figure>
                            </a>
                            <div class="description">
                                <div class="frame_response">
                                    <div class="star">
                                        <img src="images/temp/STAR.png"/>
                                    </div>
                                </div>
                                <a href="{site_url('shop/product/'.$sp['url'])}">{echo ShopCore::encode($sp['name'])}</a>
                                <div class="price price_f-s_16">
                                    <span class="f-w_b">{echo money_format('%i', $sim_prod.main.price)}</span> 
                                    {$sim_prod.main.symbol}
                                </div>
                                <button class="btn btn_buy" type="button" data-prodid="{echo $sp['ProductId']}" data-varid="{echo $sp['VariandId']}" data-price="{echo $sim_prod.main.price}" data-name="{echo $sp['name']}">В корзину</button>
                            </div>
                        </li>
                    {/foreach}

                </ul>
            </div>
        </div>
    </article>
</div>