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
<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js"></script>
<script src="{$SHOP_THEME}js/product.js"></script>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
    {parsetags: 'explicit'}
</script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"> </script> 


<!-- BEGIN LIGHTBOX -->
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.color.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.lightbox.min.js"></script>
<!-- END LIGHTBOX -->


<div class="content">    

    <div class="center">
        <div class="tovar_frame clearfix{if $model->firstvariant->getstock()== 0} not_avail{/if}">
            <div class="thumb_frame f_l">
                {if sizeof($model->getSProductImagess()) > 0}
                    {foreach $model->getSProductImagess() as $image}
                        <span>
                            <a  class="grouped_elements" rel="gal1" href="{echo $image->getThumbUrl()}">                         
                                <img src="{echo $image->getThumbUrl()}" width="90"/>
                            </a>                                
                        </span>
                    {/foreach}
                {/if}                
            </div>
            <div class="photo_block">
                <a class="grouped_elements" rel="gal1" href="{productImageUrl($model->getMainImage())}">
<!--                    <img id="mim{echo $model->getId()}" src="{productImageUrl($model->getMainImage())}" alt=""/>-->
                    <img id="mim{echo $model->getId()}" src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->name)}" />
                    <img id="vim{echo $model->getId()}" class="smallpimagev" src="" alt="" />
                </a>
            </div>
            <div class="func_description">
                <div class="crumbs">
                    {renderCategoryPath($model->getMainCategory())}
                </div>
                <h1>{echo ShopCore::encode($model->getName())}</h1>
                <div class="f-s_0">
                    <span class="code">Код: {echo $model->firstvariant->getNumber()}</span>
                    {$rating = $model->getRating()}
                    {if $rating == 0}{$r = "nostar"}    {/if}
                    {if $rating == 1}{$r = "onestar"}   {/if}
                    {if $rating == 2}{$r = "twostar"}   {/if}
                    {if $rating == 3}{$r = "threestar"} {/if}
                    {if $rating == 4}{$r = "fourstar"}  {/if}
                    {if $rating == 5}{$r = "fivestar"}  {/if}
                    <div class="star_rating">
                        <div id="{echo $model->getId()}_star_rating" class="rating {echo $r} star_rait" data-id="{echo $model->getId()}">
                            <div id="1" class="rate one">
                                <span title="1" class="clickrate">1</a>
                            </div>
                            <div id="2" class="rate two">
                                <span title="2" class="clickrate">2</a>
                            </div>
                            <div id="3" class="rate three">
                                <span title="3" class="clickrate">3</a>
                            </div>
                            <div id="4" class="rate four">
                                <span title="4" class="clickrate">4</a>
                            </div>
                            <div id="5" class="rate five">
                                <span title="5" class="clickrate">5</a>
                            </div>
                        </div>
<!--                    <span class="count_people d_b" itemtype="http://schema.org/AggregateRating" itemscope="" itemprop="aggregateRating">
                        <meta itemprop="worstRating" content="1">
                        <span class="ratingValue" itemprop="ratingValue"> 0</span>/
                        <span itemprop="bestRating">5</span> залишило                        
                        <span itemprop="reviewCount" class="reviewCount">0  </span>чоловік.
                    </span>-->
                    </div>
                    <span class="response">{echo $model->totalComments()} {echo SStringHelper::Pluralize($model->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</span>
                    {if count($model->getProductVariants())>1}
                        <select class="m-l_10" name="selectVar">
                            {foreach $model->getProductVariants() as $pv}
                                 <option class="selectVar" value="{echo $pv->getId()}" data-pp="1" data-st="{echo $pv->getStock()}" data-cs="{$NextCS}" data-spr="{echo ShopCore::app()->SCurrencyHelper->convert($pv->getPrice(), $NextCSId)}" data-pr="{echo $pv->getPrice()}" data-pid="{echo $model->getId()}" data-img="{echo $pv->getmainimage()}" data-vname="{echo $pv->getName()}" data-vnumber="{echo $pv->getNumber()}">{echo $pv->getName()}</option>
                            {/foreach}
                         </select>
                    {/if}
                    </div>
                    {echo $CI->load->module('share')->_make_share_form()}
                <div class="buy clearfix">
                    {$style = productInCartI($cart_data, $model->getId(), $model->firstVariant->getId(), $model->firstVariant->getStock())}
                    
                    <div class="price f-s_26"><span id="pricem{echo $model->getId()}">{echo $model->firstVariant->toCurrency()}</span>
                        <sub>{$CS}</sub>
                        {if $NextCS != $CS}
                        <span id="prices{echo $model->getId()}" class="d_b">{echo $model->firstVariant->toCurrency('Price', $NextCSId)}{$NextCS}</span>
                        {/if}
                    </div>
                    <div class="in_cart"></div>
                        <div id="p{echo $model->getId()}" class="{$style.class}">
                            <a id="buy{echo $model->getId()}" class="{$style.identif}" href="{$style.link}" data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" >{$style.message}</a>
                        </div>
                    <div class="f_l">
                        <span class="ajax_refer_marg">
                            {if $forCompareProducts && in_array($model->getId(), $forCompareProducts)}
                                <a href="{shop_url('compare')}">Сравнить</a>
                            {else:}
                                <a href="{shop_url('compare/add/'. $model->getId())}" data-prodid="{echo $model->getId()}" class="js gray toCompare">Добавить к сравнению</a>
                            {/if}
                        </span>
                        <span>
                            {if !is_in_wish($model->getId())}
                                <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
                            {else:}
                                <a href="/shop/wish_list">Уже в списке желаний</a>
                            {/if}</span>
                    </div>
                </div>
                <p class="c_b">{echo $model->getShortDescription()}</p>
                <p>{echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($model)}</p>
                <div>
                     {echo $CI->load->module('share')->_make_like_buttons()}
                </div>
            </div>
        </div>
        <ul class="info_buy">
            <li>
                <img src="{$SHOP_THEME}images/order_phone.png">
                <div>
                    <div class="title">Заказ по телефону:</div>
                    <span></span>
                    <span></span> 
                    <span></span>
                </div>
            </li>
            <li>
                <img src="{$SHOP_THEME}images/buy.png">
                <div>
                    <div class="title">Оплата <span><a href="/oplata">(узнать больше)</a></span></div>
                    {foreach $payment_methods as $methods}
                        <span class="small_marker">{echo $methods.name}</span>
                    {/foreach}
                </div>
            </li>
            <li>
                <img src="{$SHOP_THEME}images/deliver.png">
                <div>
                    <div class="title">Доставка <span><a href="/dostavka">(узнать больше)</a></span></div>
                    {foreach $delivery_methods as $methods}
                        <span class="small_marker">{echo $methods.name}</span>
                    {/foreach}
                </div>
            </li>
        </ul>
    </div>
                


    <!-----------------------------------------------------------------------Акционное предложение начало-->

    {if $model->getKits()->count() > 0}
        {echo '<pre>';}
        {$tir = $model->getKits()}
        {foreach $tir as $ti}
            {echo '<pre>';}
            {echo $ti}
            {echo '</pre>';}
        {/foreach}

        {echo '</pre>';}
        {$kits = $model->getKits()}
        {# Display the list of product kits #}
        <div class="f-s_18 c_6 center">Акционное предложение</div>
        <div class="promotion carusel_frame">
            <div class="carusel">

                <ul>
                    <li>
                        {$count = count($kits[0]->getShopKitProducts())}

                        {$kitt = $kits[0]->getShopKitProducts();}
                        {foreach $kitt as $tr}
                            {echo '<pre>';}
                            {echo $tr}
                            {echo '</pre>';}
                        {/foreach}


                        <div class="f_l smallest_item">
                            <div class="photo_block">
                                <a href="{shop_url('shop/product'. $model->getId())}">
                                    <img src="{productImageUrl($model->getSmallModImage())}" />
                                </a>
                            </div>
                            <div class="func_description">
                                <a href="{'/shop/product/'.$model->getId()}">{echo ShopCore::encode($model->getName())}</a>
                                <div class="buy">

                                    <div class="price f-s_16 f_l">{echo $model->firstVariant->toCurrency()} 
                                        <sub>{$CS}</sub>
                                        {if $NextCS != $CS}
                                        <span class="d_b">{echo $model->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
                                        {/if}
                                    </div>

                                </div>
                            </div>
                            <div class="plus_eval">+</div>
                            {$i = 0}
                            {$sum1_1 = $sum2_1 = $model->firstVariant->toCurrency()}
                            {$sum1_2 = $sum2_2 = $model->firstVariant->toCurrency('Price', 1)}
                            {foreach $kits[0]->getShopKitProducts() as $shopKitProduct}

                                {$ap = $shopKitProduct->getSProducts()}
                                {$ap->setLocale(ShopController::getCurrentLocale())}


                                <div class="f_l smallest_item">
                                    <div class="photo_block">
                                        <a href="{'/shop/product/'.$ap->getUrl()}">
                                            <img src="/uploads/shop/{echo $ap->getId()}_small.jpg" />
                                        </a>
                                    </div>

                                    <div class="func_description">
                                        <a href="{'/shop/product/'.$ap->getId()}">{echo ShopCore::encode($ap->getName())}</a>

                                        <div class="buy">

                                            {$kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)}
                                            {if $shopKitProduct->getDiscount()}

                                                <del class="price f-s_12 price-c_9">{echo $s1_1 = $kitFirstVariant->toCurrency()}<sub> {$CS}</sub>
                                                    {if $NextCS != $CS}
                                                    <span>{echo $s1_2 = $kitFirstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span></del>
                                                    {/if}

                                                <div class="price f-s_14 price-c_red">{echo $s2_1 = (int)$kitFirstVariant->toCurrency()*(100-$shopKitProduct->getDiscount())/100}<sub> {$CS}</sub><span>{echo $s2_2 = (int)$kitFirstVariant->toCurrency('Price', $NextCSId)*(100-$shopKitProduct->getDiscount())/100} {$NextCS}</span></div>

                                            {else:}
                                                <div class="price f-s_14">{echo $kitFirstVariant->toCurrency()}
                                                    <sub> {$CS}</sub>
                                                    {if $NextCS != $CS}}
                                                    <span>{echo $kitFirstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
                                                    {/if}
                                                </div>   
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                                {$sum1_1 += $s1_1}
                                {$sum1_2 += $s1_2}
                                {$sum2_1 += $s2_1}
                                {$sum2_2 += $s2_2}
                                {$i++}

                                {if $i == $count}        
                                    <div class="plus_eval">=</div>
                                    <div class="button_block">
                                        <div class="buy">
                                            {if $dis}

                                                <del class="price f-s_12 price-c_9">{$sum1_1}<sub> {$CS}</sub>
                                                    {if $NextCS != $CS}
                                                    <span>{echo $sum1_2} {$NextCS}</span></del>
                                                    {/if}
                                            {/if}
                                            <div class="price f-s_18">{echo $sum2_1} <sub> {$CS}</sub>
                                                {if $NextCS != $CS}
                                                <span> {echo $sum2_2}  {$NextCS}</span></div>
                                                {/if}
                                        </div>
                                        <div class="buttons button_gs">
                                            <div class="buy">
                                                {foreach $kits as $kit}
                                                    <a class="goBuy" kitId="{echo $kit->id}" instance="ShopKit" data-varid="86" data-prodid="{echo $kit->productId}" href="">Купить</a>
                                                {/foreach}
                                            </div>
                                        </div>
                                    </div>
                                {else:}
                                    <div class="plus_eval">+</div>
                                {/if}
                            {/foreach}				
                    </li>
                </ul>

            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div> 
    {/if}
    <!------------------------------------------------------------------------------------------------------------Finish-->

    {if count(getSimilarProduct($model, 20)) > 1}
        <div class="featured carusel_frame">
            <div class="f-s_18 c_6 center">Похожие товары</div>
            <div class="carusel">
                <ul>
                    {$simprod = getSimilarProduct($model, 20)}
                    {foreach $simprod as $sp}
                        {$style = productInCart($cart_data, $sp->getId(), $sp->firstVariant->getId(), $sp->firstVariant->getStock())}
                        <li>
                            <div class="f_l smallest_item {if $sp->firstvariant->getstock()==0}not_avail{/if}">
                                <div class="photo_block">
                                    <a href="{site_url('shop/product/'.$sp->getId())}">
                                        <img src="{productImageUrl($sp->getSmallModImage())}"/>
                                    </a>
                                </div>
                                <div class="func_description">
                                    <a href="{site_url('shop/product/'.$sp->getId())}" class="title">{echo ShopCore::encode($sp->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_14">{echo $sp->firstVariant->toCurrency()}
                                            <sub> {$CS}</sub>
                                            {if $NextCS != $CS}
                                            <span>{echo $sp->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span> 
                                            {/if}
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

    <div class="center">
        <div class="tabs f_l w_770 info_tovar">
            <ul class="nav_tabs">
                {if $model->getFullDescription()}
                    <li><a href="#first">Информация</a></li>
                {/if}
                {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                    <li><a href="#second">Характеристики</a></li>
                {/if}
                {if $model->getRelatedProductsModels()}
                    <li><a href="#third">Аксессуары</a></li>
                {/if}
                <li><a href="#four">{echo SStringHelper::Pluralize($model->totalComments(), array('Отзыв', 'Отзывы', 'Отзывов'))}({echo $model->totalComments()})</a></li>
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
                            {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                            <li>
                                <div class="small_item">
                                    <a class="img" href="{shop_url('product/' . $p->getUrl())}">
                                        <span><img src="{productImageUrl($p->getSmallModImage())}" /></span>
                                    </a>
                                    <div class="info">
                                        <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
                                        <div class="buy">
                                            <div class="price f-s_16 f_l">{echo $p->firstVariant->toCurrency()}
                                                <sub> {$CS}</sub>
                                                {if $NextCS != $CS}
                                                <span class="d_b">{echo $p->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
                                                {/if}
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
                {$comments}
            </div>
        </div>
        <div class="nowelty_auction m-t_29">
            <div class="box_title">
                <span>Новинки</span>
            </div>
            <ul>                  
                {foreach getPromoBlock('hot', 3) as $hotProduct}                                     
                    {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                    <li>
                        <div class="small_item">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                <span>
                                    <img src="{productImageUrl($hotProduct->getSmallModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                                </span>
                            </a>
                            <div class="info">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">{echo $hotProduct->firstVariant->toCurrency()} 
                                        <sub>{$CS}</sub>
                                        {if $NextCS != $CS}
                                        <span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
                                        {/if}
                                    </div>                               
                                    <div class="{$style.class} buttons"><a class="{$style.identif}" data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}" href="{shop_url('product/' . $hotProduct->getUrl())}">{$style.message}</a></div>
                                </div>   
                            </div>
                        </div>
                    </li>  
                {/foreach}
            </ul>
        </div>
    </div>
</div>