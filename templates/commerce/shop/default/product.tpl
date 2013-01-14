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
                    <a class="grouped_elements fancybox-thumb" rel="fancybox-thumb" href="{productImageUrl($model->getMainImage())}" data-title-id="fancyboxAdditionalContent" >
                        <img id="mim{echo $model->getId()}" src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                        <img id="vim{echo $model->getId()}" class="smallpimagev" src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                    </a>
                </div>
                <div class="star_rating">
                    <div id="star_rating_{echo $model->getId()}" class="rating {echo count_star($model->getRating())} star_rait" data-id="{echo $model->getId()}">
                        <div id="1" class="rate one">
                            <span title="1" class="clickrate">1</span>
                        </div>
                        <div id="2" class="rate two">
                            <span title="2" class="clickrate">2</span>
                        </div>
                        <div id="3" class="rate three">
                            <span title="3" class="clickrate">3</span>
                        </div>
                        <div id="4" class="rate four">
                            <span title="4" class="clickrate">4</span>
                        </div>
                        <div id="5" class="rate five">
                            <span title="5" class="clickrate">5</span>
                        </div>
                    </div>
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
                                <span>
                                    <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                        {echo $model->getOldPrice()}
                                        <sub> {$CS}</sub>
                                    </del>
                                </span>
                            {/if}
                        {/if}
                        <span id="pricem{echo $model->getId()}">   
                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                {$prOne = $model->firstVariant->getPrice()}
                                {$prTwo = $model->firstVariant->getPrice()}
                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                <del class="price price-c_red f-s_12 price-c_9">{echo $model->firstVariant->getPrice()} {$CS}</del> 
                            {else:}
                                {$prThree = $model->firstVariant->getPrice()}
                            {/if}
                            {echo money_format('%i',$prThree)}<sub> {$CS}</sub>
                        </span>
                    </div>
                </div>

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
                                  <a href="{shop_url('compare')}" class="red">{lang('s_compare')}</a>
                              {else:}
                                  toCompare blue">
                                  <span class="js blue">{lang('s_compare_add')}</span>
                                  <a href="{shop_url('compare')}" class="red" style="display: none;">{lang('s_compare')}</a>
                              {/if}
                        </span>

                        <span class="frame_wish-list">
                            {if !is_in_wish($model->getId())}
                                <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" 
                                      data-varid="{echo $model->firstVariant->getId()}" 
                                      data-prodid="{echo $model->getId()}" 
                                      class="addToWList">
                                    <span class="icon-wish"></span>
                                    <span class="js blue">{lang('s_slw')}</span>
                                </span>
                                <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                            {else:}
                                <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                            {/if}
                        </span>
                </div>
                {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                    {if !is_in_spy(ShopCore::$ci->dx_auth->get_user_id(), $model->getId())}
                        <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" 
                              data-price="{echo $model->firstVariant->toCurrency()}" 
                              data-user_id="{echo ShopCore::$ci->dx_auth->get_user_id()}" 
                              data-varid="{echo $model->firstVariant->getId()}" 
                              data-prodid="{echo $model->getId()}" 
                              class="js gray addtoSpy">
                            {lang('s_sle_product')}
                        </span>
                    {else:}
                        <span data-user_id="{echo ShopCore::$ci->dx_auth->get_user_id()}" 
                              data-varid="{echo $model->firstVariant->getId()}" 
                              data-prodid="{echo $model->getId()}" 
                              class="deleteFromSpy js gray">
                            {lang('s_sle_product_alerady')}
                        </span>
                    {/if}
                    </span>
                {/if}
                {if $model->getShortDescription() != ''}
                    <p class="c_b">{echo $model->getShortDescription()}</p>
                {/if}
                <div>
                    {echo $CI->load->module('share')->_make_like_buttons()}
                </div>
                <ul class="info_buy one_item">
                    <li>
                        <img src="{$SHOP_THEME}images/order_phone.png" class="phone_product"/>
                        <div>
                            <div class="title">{lang('s_zaka_phone')}:</div>
                            <span>(093)<span class="d_n">&minus;</span> 000-20-00,  (093)<span class="d_n">&minus;</span> 000-08-00,   (093)<span class="d_n">&minus;</span> 000-40-00</span>
                        </div>
                    </li>
                </ul>
                <ul class="info_buy two_item">
                    <li>
                        <img src="{$SHOP_THEME}images/buy.png">
                        <div>
                            <div class="title">{lang('s_pay')} <span><a href="/oplata">{lang('s_all_infor_b')}</a></span></div>
                            {foreach $payment_methods as $methods}
                                {if $methods.active ==1}<span class="small_marker">{echo $methods.name}</span>{/if}
                            {/foreach}
                        </div>
                    </li>
                    <li>
                        <img src="{$SHOP_THEME}images/deliver.png">
                        <div>
                            <div class="title">{lang('s_delivery1')} <span><a href="/dostavka">{lang('s_all_infor_b')}</a></span></div>
                            {foreach $delivery_methods as $methods}
                                {if $methods.enabled ==1}<span class="small_marker">{echo $methods.name}</span>{/if}
                            {/foreach}
                        </div>
                    </li>
                </ul>
                <div class="tabs info_tovar">
                    <ul class="nav_tabs">
                        {if $model->getFullDescription()}
                            <li><a href="#first">{lang('s_information')}</a></li>
                        {/if}
                        {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                            <li><a href="#second">{lang('s_properties')}</a></li>
                        {/if}
                        {if $model->getRelatedProductsModels()}
                            <li><a href="#third">{lang('s_accessories')}</a></li>
                        {/if}
                        <li>
                            <a href="#four">
                                {//echo SStringHelper::Pluralize($data['total_comments'], array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}{if $data['comments_arr']}{echo $data['total_comments']}{else:}Нет комментариев{/if}
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
                                    {$discount = ShopCore::app()->SDiscountsManager->productDiscount($p->id)}
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

                                                        {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                            {$prOne = $p->firstvariant->getPrice()}
                                                            {$prTwo = $p->firstvariant->getPrice()}
                                                            {$prThree = $prOne - $prTwo / 100 * $discount}
                                                            <del class="price price-c_red f-s_12 price-c_9">{echo $p->firstvariant->getPrice()} {$CS}</del><br /> 
                                                        {else:}
                                                            {$prThree = $p->firstvariant->getPrice()}
                                                        {/if}
                                                        {echo $prThree} 
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
            <div class="f-s_18 c_6 center">{lang('s_spec_promotion')}</div>
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
                                            <div class="price f-s_16 f_l">{echo $prices.main.price}
                                                <sub>{echo $prices.main.symbol}</sub>
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
                                            <span>{echo $summa} <span>{$CS}</span>
                                            </span>
                                        </del>
                                        <div class="price f-s_18">
                                            <span>{echo $summa_with_discount} {$CS}</span>
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
                                                    <span data-id="{echo $kid->getId()}" class="add_cart_kid" id="kitBuy">{lang('s_buy')}</span>
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

        {if count(getSimilarProduct($model)) > 1}
            <div class="featured carusel_frame carousel_js">
                <div class="f-s_18 c_6 center">{lang('s_similar_product')}</div>
                <div class="carusel">
                    <ul>
                        {$simprod = getSimilarProduct($model)}
                        {foreach $simprod as $sp}
                            {$discount = ShopCore::app()->SDiscountsManager->productDiscount($sp['ProductId'])}
                            {$sim_prod = currency_convert($sp['price'], $sp['currency'])}
                            {$style = productInCart($cart_data, $sp['ProductId'], $sp['ProductId'], $sp['stock'])}
                            <li>
                                <div class="smallest_item {if $sp['stock']==0}not_avail{/if}">
                                    <div class="photo_block">
                                        <a href="{site_url('shop/product/'.$sp['url'])}">
                                            <img src="{productImageUrl($sp['smallModImage'])}"/>
                                        </a>
                                    </div>
                                    <div class="func_description">
                                        <a href="{site_url('shop/product/'.$sp['url'])}" class="title">{echo ShopCore::encode($sp['name'])}</a>
                                        <div class="buy">
                                            <div class="price f-s_14">
                                                {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                    {$prOne = $sim_prod.main.price}
                                                    {$prTwo = $sim_prod.main.price}
                                                    {$prThree = $prOne - $prTwo / 100 * $discount}
                                                    <del class="price price-c_red f-s_12 price-c_9">{echo money_format('%i', $sim_prod.main.price)} {$sim_prod.main.symbol}</del><br /> 
                                                {else:}
                                                    {$prThree = $sim_prod.main.price}
                                                {/if}

                                                {echo money_format('%i', $prThree)}
                                                <sub>{$sim_prod.main.symbol}</sub>

                                                {if $NextCS != $CS AND empty($discount)}
                                                    <span>{echo money_format('%i', $sim_prod.second.price)} {$sim_prod.second.symbol}</span> 
                                                {/if}

                                            </div>                                                                             
                                            <div class="{$style.class} buttons">                                            
                                                <a class="{$style.identif}" href="{$style.link}" data-varid="{echo $sp['VariandId']}"  data-prodid="{echo $sp['ProductId']}" >{$style.message}</a>
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
        <div class="box_title"><span class="f-s_24">{lang('s_new')}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach getPromoBlock('hot', 10) as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
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
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstvariant->getPrice()}
                                                {$prTwo = $hotProduct->firstvariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
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
