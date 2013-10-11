{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}

{$jsCode}

{$forCompareProducts = $CI->session->userdata('shopForCompare')}
{$cart_data= ShopCore::app()->SCart->getData();}

<script type="text/javascript">
    var currentProductId = '{echo $model->getId()}';
</script>

<link rel="stylesheet" href="{$SHOP_THEME}/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.6" type="text/css" media="screen" />
<script type="text/javascript" src="{$SHOP_THEME}/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.6"></script>
<div class="content">   
    <div class="center">
        <div class="tovar_frame clearfix{if $model->firstvariant->getstock()== 0} not_avail{/if}">
            <div class="left-tovar_frame">
                <div class="thumb_frame f_l">
                    {if sizeof($model->getSProductImagess()) > 0}
                        {$i = 1}
                        {foreach $model->getSProductImagess() as $image}
                            <span>
                                <a class="grouped_elements fancybox-thumb" rel="fancybox-thumb" href="{echo $image->getThumbUrl()}" data-title-id="fancyboxAdditionalContent">                         
                                    <img src="{echo $image->getThumbUrl()}" width="90" alt="{echo ShopCore::encode($model->getName())} - {echo $i}"/>
                                </a>                                
                            </span>
                            {$i++}
                        {/foreach}
                    {/if}                
                </div>
                <div class="photo_block">
                    <a class="grouped_elements fancybox-thumb" id="varianBPhoto" rel="fancybox-thumb" href="{productImageUrl($model->getMainModImage())}" data-title-id="fancyboxAdditionalContent">
                        <img id="mim{echo $model->getId()}" src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                        <img id="vim{echo $model->getId()}" class="smallpimagev" src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                    </a>
                </div>
                <div class="star_rating">
                    {$CI->load->module('star_rating')->show_star_rating($model)}
                </div>
                <span itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate" id="pageRatingData"> 
                    &nbsp;&nbsp;Рейтинг товара {if $model->firstVariant->getNumber() != ''}«<span itemprop="itemreviewed">{echo $model->firstvariant->getNumber()}</span>»{/if} 
                    <meta itemprop="rating" content="4"> оставило <span itemprop="count">{echo $model->getVotes()}</span> человек(а).
                </span>
                <div class="m-t_10">{echo $CI->load->module('share')->_make_share_form()}</div>
            </div>
            {$style = productInCartI($cart_data, $model->getId(), $model->firstVariant->getId(), $model->firstVariant->getStock())}
            <!-- Fancybox additional blocks -->
            <div id="fancyboxAdditionalContent" style="display: none;">
                <div class="price f-s_26">
                    <span id="pricem76">{echo $model->firstVariant->getPrice()}</span>
                    <sub>{echo $CS}</sub>
                </div>
                {if count($model->getProductVariants())==1}
                    <div class="in_cart"></div>
                    <div class="{echo str_replace('f_l', '', $style.class)} pfancy">
                        <span class="fancybuy {echo $style.identif} bfancy" data-id="{echo $model->getId()}">{echo $style.message}</span>
                    </div>
                {/if}
            </div>
            <!-- Fancybox additional blocks -->

            <div class="func_description">
                <div class="crumbs">
                    {renderCategoryPath($model->getMainCategory())}
                </div>
                <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>&nbsp;&nbsp;&nbsp;
            {if $model->firstVariant->getNumber() != ''}<span class="code">Код:{echo $model->firstVariant->getNumber()}</span>{/if}
            <div>
                <div class="price f-s_26 d-i_b v-a_m">
                    {if $model->getOldPrice() > 0}
                        {if $model->getOldPrice() > $model->firstVariant->toCurrency()}
                            <span class="code" style="font-size: 15px;">Старая цена :</span>
                            <span>
                                <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                    {echo $model->getOldPrice()}
                                    <sub> {$CS}</sub>
                                </del>
                            </span><br />
                        {/if}
                    {/if}
                    <span id="pricem{echo $model->getId()}">                       
                        {if $model->hasDiscounts()}
                            <del class="price price-c_red f-s_12 price-c_9">
                                {echo $model->firstVariant->toCurrency('OrigPrice')} {$CS}
                            </del> 
                            <br />
                        {/if}
                        {echo $model->firstVariant->toCurrency()} <sub>{$CS}</sub>
                    </span>
                </div>
            </div>

            <!--Variants block-->

            <div class="buy clearfix">
                {if count($model->getProductVariants()) > 1}
                    Выбор варианта:</br>
                    {foreach $model->getProductVariants() as $key => $pv}

                        <input type="radio" class="selectVar" id="sVar{echo $pv->getId()}" name="selectVar" {if $model->firstVariant->getId() == $pv->getId()}checked="checked"{/if}
                               
                               value="{echo $pv->getId()}" 
                               data-pp="1" 
                               data-cs = "{$CS}"
                               data-st="{echo $pv->getStock()}" 
                               data-pr="{echo $pv->getPrice()}" 
                               data-pid="{echo $model->getId()}" 
                               data-img="{echo $pv->getmainimage()}" 
                               data-img-small="{echo $pv->getsmallimage()}" 
                               data-vname="{echo $pv->getName()}" 
                               data-vnumber="{echo $pv->getNumber()}"/>
                        <label for="sVar{echo $pv->getId()}">
                            {if $pv->getName() != ''}
                                <i>{echo $pv->getName()}</i><b>: {echo $pv->getPrice()}</b> {$CS}
                            {else:}
                                <i>{echo $model->getName()}</i><b>: {echo $pv->getPrice()}</b> {$CS}
                            {/if}
                        </label></br>
                    {/foreach}
                {/if}
                <div class="in_cart">
                    {if $style.identif == "goToCart"}
                        Уже в корзине
                    {/if}
                </div>
                <div id="p{echo $model->getId()}" class="{$style.class}">
                    <a id="buy{echo $model->getId()}" class="{$style.identif}" href="{$style.link}" data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" >{$style.message}</a>
                </div>
                <span class="v-a_m">
                    <span data-prodid="{echo $model->id}" class="m-r_20 compare
                          {if $forCompareProducts && in_array($model->getId(), $forCompareProducts)}
                              is_avail">
                              <a href="{shop_url('compare')}" class="red">{lang("Compare","admin")}</a>
                          {else:}
                              toCompare blue">
                              <span class="js blue">{lang("Add to compare","admin")}</span>
                              <a href="{shop_url('compare')}" class="red" style="display: none;">{lang("Compare","admin")}</a>
                          {/if}
                    </span>

                    <span class="frame_wish-list">
                        {if !is_in_wish($model->getId())}
                            <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" 
                                  data-varid="{echo $model->firstVariant->getId()}" 
                                  data-prodid="{echo $model->getId()}" 
                                  class="addToWList">
                                <span class="icon-wish"></span>
                                <span class="js blue">{lang("Save to Wish List","admin")}</span>
                            </span>
                            <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                        {else:}
                            <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                        {/if}
                    </span>
            </div>
            {if $model->getFullDescription() != ''}
                <p class="c_b">{echo $model->getFullDescription()}</p>
            {/if}
            <div>
                {echo $CI->load->module('share')->_make_like_buttons()}
            </div>
            <ul class="info_buy one_item">
                <li>
                    <img src="{$SHOP_THEME}images/order_phone.png" class="phone_product"/>
                    <div>
                        <div class="title">{lang("Order by phone","admin")}:</div>
                        <span>(093)<span class="d_n">&minus;</span> 000-20-00,  (093)<span class="d_n">&minus;</span> 000-08-00,   (093)<span class="d_n">&minus;</span> 000-40-00</span>
                    </div>
                </li>
            </ul>
            <ul class="info_buy two_item">
                <li>
                    <img src="{$SHOP_THEME}images/buy.png">
                    <div>
                        <div class="title">{lang("Payment","admin")} <span><a href="/oplata">{lang("(learn more)")}</a></span></div>
                        {if is_array($paymentMethod = getPaymentMethodsList())}
                            {foreach $paymentMethod as $methods}
                            {if $methods.active ==1}<span class="small_marker">{echo $methods.name}</span>{/if}
                        {/foreach}
                    {/if}
                </div>
            </li>
            <li>
                <img src="{$SHOP_THEME}images/deliver.png">
                <div>
                    <div class="title">{lang("Delivery","admin")} <span><a href="/dostavka">{lang("(learn more)")}</a></span></div>
                    {if is_array($deliveryMethod = getDeliveryMethodsList())}
                        {foreach $deliveryMethod as $methods}
                        {if $methods.enabled ==1}<span class="small_marker">{echo $methods.name}</span>{/if}
                    {/foreach}
                {/if}
            </div>
        </li>
    </ul>
    <div class="tabs info_tovar">
        <ul class="nav_tabs">
            {if $model->getFullDescription()}
                <li><a href="#first">{lang("Information","admin")}</a></li>
            {/if}
            {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                <li><a href="#second">{lang("Description","admin")}</a></li>
            {/if}
            {if $model->getRelatedProductsModels()}
                <li><a href="#third">{lang("Accessories","admin")}</a></li>
            {/if}
            <li>
                <a href="#four">
            {//echo SStringHelper::Pluralize($data['total_comments'], array(lang("review","admin"), lang("reviews","admin"), lang("review","admin")))}{if $data['comments_arr']}{echo $data['total_comments']}{else:}Нет комментариев{/if}
        </a>
    </li>
</ul> 
{if $model->getFullDescription()}
    <div id="first">
        <div class="info_text">
            {echo $model->getFullDescription()}
        </div>
    </div>
{/if}
{if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
    <div id="second">
        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
    </div>
{/if}
{if $model->getRelatedProductsModels()}
    <div id="third">
        <ul class="accessories f-s_0">
            {foreach $model->getRelatedProductsModels() as $p}                
                {$rel_prod = currency_convert($p->firstvariant->getPrice(), $p->firstvariant->getCurrency())}
                {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                <li>
                    <div class="small_item">
                        <a class="img" href="{shop_url('product/' . $p->getUrl())}">
                            <span><img src="{productImageUrl($p->getSmallModImage())}" /></span>
                        </a>
                        <div class="info">
                            <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">

                                    {if $p->hasDiscounts()}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $p->firstvariant->toCurrency('OrigPrice')} {$CS}</del><br /> 
                                    {/if}
                                    {echo $p->firstvariant->toCurrency()} 
                                    <sub>{$CS}</sub>
                                </div>
                                <div class="{$style.class} buttons"><a class="{$style.identif}" href="{$style.link}" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" >{$style.message}</a></div> 
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}    
        </ul>
    </div>
{/if}
<div id="four">
    <a name="four"></a>
    {$comments}
</div>
</div>
</div>
</div>
{if $model->getShopKits()->count() > 0}
    <div class="f-s_18 c_6 center">{lang("Special promotion","admin")}</div>
    <div class="promotion carusel_frame carousel_js">
        <div class="carusel">
            <ul class="">
                {foreach $model->getShopKits() as $kid}
                    <li>
                        <div class="f_l smallest_item">
                            <div class="photo_block">
                                <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}" class="photo_block">
                                    <figure>
                                        <img src="{productImageUrl($kid->getMainProduct()->getSmallModImage())}"/>
                                    </figure>
                                </a>
                            </div>
                            <div class="func_description">
                                <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}">{echo ShopCore::encode($kid->getMainProduct()->getName())}</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">{echo $kid->getMainProductPrice()}
                                        <sub>{$CS}</sub>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {$summa = $prices.main.price}
                        {$summa_with_discount = $prices.main.price}
                        <div class="plus_eval">+</div>
                        {$i = 1}
                        {foreach $kid->getShopKitProducts() as $coompl}
                            {$ap = $coompl->getSProducts()}
                            {$kp = currency_convert($ap->getFirstVariant()->getPrice(), $ap->getFirstVariant()->getCurrency())}
                            <div class="f_l smallest_item">                                        
                                <div class="photo_block">
                                    <a href="{shop_url('product/' . $ap->getUrl())}">
                                        <figure>
                                            <img src="{productImageUrl($ap->getSmallModImage())}"/>
                                        </figure>                                        
                                    </a>
                                </div>
                                <div class="func_description">
                                    <a href="{shop_url('product/' . $ap->getUrl())}">{echo ShopCore::encode($ap->getName())}</a>
                                    {if $coompl->getDiscount() != 0}
                                        <del class="d_b price-f-s_12 price-c_red">
                                            <span >{echo $kp.main.price} <sub>{$kp.main.symbol}</sub</span>
                                        </del>
                                    {/if}
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">
                                            <span>{echo number_format($kp.main.price*(1 - $coompl->getdiscount()/100), 2, '.', '')} <sub>{$kp.main.symbol}</sub></span>
                                        </div>
                                    </div>                                        
                                </div> 
                            </div>
                            {if $i == count($kid->getShopKitProducts())}
                                <div class="plus_eval"><div>=</div></div>
                            {else:}
                                <div class="plus_eval">+</div>
                            {/if}
                            {$i++}
                            {$summa += $kp.main.price}
                            {$summa_with_discount += number_format($kp.main.price*(1 - $coompl->getdiscount()/100), 2, '.', '')}
                        {/foreach}
                        <div class="button_block ">
                            <div class="buy">
                                <del class="price f-s_12 price-c_9">
                                    <span>{echo $kid->getAllPriceBefore()} <span>{$CS}</span>
                                    </span>
                                </del>
                                <div class="price f-s_18">
                                    <span>{echo $kid->getTotalPrice()} {$CS}</span>
                                </div>
                                {$inCart = ShopCore::app()->SCart->getData()}
                                {$prod_in_cart = false}
                                {foreach $inCart as $Cart}
                                    {if $Cart[kitId] == $kid->getId()}
                                        {$prod_in_cart = true}
                                    {/if}
                                {/foreach}
                                <div class="buttons {if $prod_in_cart}button_middle_blue{else:}button_gs{/if}">
                                    <div class="buy"> 
                                        {if !$prod_in_cart}                                       
                                            <span data-id="{echo $kid->getId()}" class="add_cart_kid" id="kitBuy">{lang("Buy","admin")}</span>
                                        {else:}
                                            <span class="goToCart">Оформить</br> заказ</span>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
{/if}   

{if count($simprod = getSimilarProduct($model)) > 1}
    <div class="featured carusel_frame carousel_js">
        <div class="f-s_18 c_6 center">{lang("Similar products","admin")}</div>
        <div class="carusel">
            <ul>
                {foreach $simprod as $sp}
                    {$style = productInCart($cart_data, $sp->getId(), $sp->getId(), $sp->firstVariant->getStock())}
                    <li>
                        <div class="smallest_item {if $sp->firstVariant->getStock()==0}not_avail{/if}">
                            <div class="photo_block">
                                <a href="{site_url('shop/product/'.$sp->getUrl())}">
                                    <img src="{productImageUrl($sp->getSmallModImage())}"/>
                                </a>
                            </div>
                            <div class="func_description">
                                <a href="{site_url('shop/product/'.$sp->getUrl())}" class="title">{echo ShopCore::encode($sp->getName())}</a>
                                <div class="buy">
                                    <div class="price f-s_14">
                                        {if $sp->hasDiscounts()}
                                            <del class="price price-c_red f-s_12 price-c_9">
                                                {echo $sp->firstVariant->toCurrency('OrigPrice')} {$CS}
                                            </del>
                                            <br /> 
                                        {/if}

                                        {echo $sp->firstVariant->toCurrency()}
                                        <sub>{$CS}</sub>

                                    </div>                                                                             
                                    <div class="{$style.class} buttons">                                            
                                        <a class="{$style.identif}" href="{$style.link}" data-varid="{echo $sp->firstVariant->getId()}"  data-prodid="{echo $sp->getId()}" >{$style.message}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
{/if} 
<div class="m-t_29 featured">
    {if count(getPromoBlock('hot', 3))>0}
        <div class="box_title"><span class="f-s_24">{lang("New","admin")}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach getPromoBlock('hot', 10) as $hotProduct}                       
                        {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                        <li {if $hotProduct->firstvariant->getstock()==0}class="not_avail"{/if}>
                            <div class="small_item">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                    <span>
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}"/>
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            {if $hotProduct->hasDiscounts()}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstvariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstvariant->getPrice()}
                                            {/if}
                                            {echo $prThree} 
                                            <sub>{$CS}</sub>
                                        </div>
                                        <div class="{$style.class} buttons">
                                            <span class="{$style.identif}" data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}">{$style.message}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div>{/if}
        {widget('latest_news')}
    </div>
</div>
</div>