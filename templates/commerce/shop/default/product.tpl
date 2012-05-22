{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}

{$jsCode}

{$forCompareProducts = $CI->session->userdata('shopForCompare')}


<script type="text/javascript">
    var currentProductId = '{echo $model->getId()}';
</script>
<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js"></script>
<script src="{$SHOP_THEME}js/product.js"></script>
<script src="{$SHOP_THEME}js/shop.js"></script>

<!-- BEGIN LIGHTBOX -->
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.color.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.lightbox.min.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SHOP_THEME}js/lightbox/styles/jquery.lightbox.min.css" />
<!-- END LIGHTBOX -->


<div class="content">
    <div class="center">
        <div class="tovar_frame clearfix">
            <div class="thumb_frame f_l">
                <span>
                    <a href="#" class="active">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
                <span>
                    <a href="#">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
                <span>
                    <a href="#">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
            </div>
            <div class="photo_block">
                <a href="#">
                    <img src="images/temp/big_img.jpg"/>
                </a>
            </div>
            <div class="func_description">
                <div class="crumbs">
                    {renderCategoryPath($model->getMainCategory())}
                </div>
                <h1>{echo ShopCore::encode($model->getName())}</h1>
                <div class="f-s_0">
                    <span class="code">Код: {echo $model->firstvariant->getNumber()}</span>
                    <div class="di_b star">
                        {$rating = $model->getRating()}
                        <input class="hover-star" type="radio" name="rating-1" value="1" {if $rating==1}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="2" {if $rating==2}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="3" {if $rating==3}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="4" {if $rating==4}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="5" {if $rating==5}checked="checked"{/if}/>
                    </div>
                    <a href="#" class="response">{echo $model->totalComments()} {echo SStringHelper::Pluralize($model->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>
                    <div class="social_small di_b">
                        <a href="#" class="facebook"></a>
                        <a href="#" class="vkontakte"></a>
                        <a href="#" class="twitter"></a>
                        <a href="#" class="mail"></a>
                    </div>
                </div>
                <div class="buy clearfix">
                    <div class="price f-s_26">{echo $model->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $model->firstVariant->toCurrency('Price',1)} $</span></div>
                    <div class="in_cart"></div>
                    {if $model->firstvariant->getstock()== 0}
                        <div class="buttons button_big_green f_l">
                            <a href="" class="goNotifMe">Сообщить о появлении</a>
                        </div>
                        {literal}
                            <script type="text/javascript">
                                $('.in_cart').html('Нет в наличии');
                            </script>
                        {/literal}
                    {else:}
                        <div class="buttons button_big_green f_l">
                            {if !is_in_cart($model->getId())} <a href="" class="goBuy" data-prodid="{echo $model->getId()}" data-varid="{echo $model->firstVariant->getId()}" >Купить</a>
                            {else:}
                                <a href="/shop/cart" data-prodid="echo $model->getId()}" data-varid="{echo $model->firstvariant->getId()}">Оформить заказ</a>
                                {literal}
                                    <script type="text/javascript">
                                        $('.in_cart').html('Уже в корзине');
                                    </script>
                                {/literal}
                            {/if}
                        </div>
                    {/if}
                    <div class="f_l">
                        <span class="ajax_refer_marg">
                            {if $forCompareProducts && in_array($model->getId(), $forCompareProducts)}
                                <a href="{shop_url('compare')}" class="js gray">Сравнить</a>
                            {else:}
                                <a href="{shop_url('compare/add/'. $model->getId())}" data-prodid="{echo $model->getId()}" class="js gray toCompare">Добавить к сравнению</a>
                            {/if}
                        </span>
                        {if !is_in_wish($model->getId())}
                            <a data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
                        {else:}
                            <a href="/shop/wish_list" class="js gray">Уже в списке желаний</a>
                        {/if}
                    </div>
                </div>
                <p class="c_b">{echo $model->getShortDescription()}</p>
                <p>{echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($model)}</p>
                <div><img src="{$SHOP_THEME}images/temp/SOCIAL_like.png"/></div>
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
    <div class="f-s_18 c_6 center">Акционное предложение</div>
    <div class="promotion carusel_frame">
        <div class="carusel">
            {if $model->getKits()->count() > 0}
                {$kits = $model->getKits()}
                {# Display the list of product kits #}
                <ul>
                    <li>
                        {$count = count($kits[0]->getShopKitProducts())}
                        <div class="f_l smallest_item">
                            <div class="photo_block">
                                <a href="/shop/product/'{echo $model->getId()}">
                                    <img src="/uploads/shop/{echo $model->getId()}_small.jpg" />
                                </a>
                            </div>
                            <div class="func_description">
                                <a href="{'/shop/product/'.$model->getId()}">{echo ShopCore::encode($model->getName())}</a>
                                <div class="buy">
                                    <div class="price f-s_14">{echo $model->firstVariant->toCurrency()}<sub> {$CS}</sub><span>{echo $model->firstVariant->toCurrency('Price', 1)} $</span></div> 

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
                                    <a href="{'/shop/product/'.$ap->getUrl()}">{echo ShopCore::encode($ap->getName())}</a>
                                    <div class="buy">
                                        {$kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)}
                                        {if $shopKitProduct->getDiscount()}
                                            {$dis = 1}
                                            <del class="price f-s_12 price-c_9">{echo $s1_1 = $kitFirstVariant->toCurrency()}<sub> {$CS}</sub>
                                            <span>{echo $s1_2 = $kitFirstVariant->toCurrency('Price', 1)} $</span></del>
                                            <div class="price f-s_14 price-c_red">{echo $s2_1 = (int)$kitFirstVariant->toCurrency()*(100-$shopKitProduct->getDiscount())/100}<sub> {$CS}</sub><span>{echo $s2_2 = (int)$kitFirstVariant->toCurrency('Price', 1)*(100-$shopKitProduct->getDiscount())/100} $</span></div>
                                        {else:}
                                            <div class="price f-s_14">{echo $kitFirstVariant->toCurrency()}<sub> {$CS}</sub><span>{echo $kitFirstVariant->toCurrency('Price', 1)} $</span></div>   
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
                                        <del class="price f-s_12 price-c_9">{$sum1_1}<sub> {$CS}</sub><span>{echo $sum1_2} $</span></del>
                                        {/if}
                                        <div class="price f-s_18">{echo $sum2_1} <sub> {$CS}</sub><span> {echo $sum2_2}  $</span></div>
                                    </div>
                                    <div class="buttons button_gs">
                                        <a class="goBuy" href="">Купить</a>
                                    </div>
                                </div>
                            {else:}
                                <div class="plus_eval">+</div>
                            {/if}
                        {/foreach}				
                    </li>
                </ul>
            {/if}
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
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
                            <li>
                                <div class="small_item">
                                    <a class="img" href="{shop_url('product/' . $p->getUrl())}">
                                        <span><img src="{echo '/uploads/shop/'.$p->getId().'_small.jpg'}" /></span>
                                    </a>
                                    <div class="info">
                                        <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
                                        <div class="buy">
                                            <div class="price f-s_16 f_l">{echo $p->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $p->firstVariant->toCurrency('Price', 1)} $</span></div>
                                            <div class="button_gs buttons"><a href="#" class="goBuy">Купить</a></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        {/foreach}    
                    </ul>
                </div>

            {/if}
            <div id="four">
                {if ShopCore::$ci->dx_auth->is_logged_in()}
                    <div class="di_b">
                        <span class="comment_ajax_refer b-r_4 visible">
                            <a href="#" class="t-d_n"><span class="js">Оставить отзыв</span><span class="blue_arrow"></span></a>
                            <span>Вы вошли как {echo ShopCore::$ci->dx_auth->get_username()} | <a href="/auth/logout/" class="js red">Выход</a></span>
                        </span>
                    </div>
                {else:}
                    <div class="di_b">
                        <span class="comment_ajax_refer b-r_4 visible">
                            <span>Для того, чтобы оставить комментарий, Вы должны <a href="#dialog1" rel="nofollow" class="js red" name="modal">авторизироваться</a> на сайте</span>
                        </span>
                    </div>        
                {/if}
                {if ShopCore::$ci->dx_auth->is_logged_in()}
                    <form method="post" action="/comments/add/" class="comment_form clearfix">

                        <input type="hidden" name="comment_item_id" value="{echo $model->getId()}" />
                        <input type="hidden" name="redirect" value="{echo '/shop/product/'.$model->getId()}" />
                        <label>
                            {$comments}
                        </label>
                    </form>
                {/if}
                <ul class="comments">
                    {foreach $comm as $c}
                        {if is_array($c)}
                            {foreach $c as $c1}
                                <li>
                                    <b>{echo $c1.user_name}:</b>
                                    <div class="c_9 f-s_11">Оставлен {echo date('d-m-Y', $c1.date)}</div>
                                    <p>
                                        {echo $c1.text}
                                    </p>
                                </li>
                            {/foreach}
                        {/if}
                    {/foreach}    
                </ul>
            </div>
        </div>
        <div class="nowelty_auction m-t_29">
            <div class="box_title">
                <span>Новинки</span>
            </div>
            <ul>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>