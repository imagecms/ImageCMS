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
                    <div class="price f-s_26">{echo $model->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $model->firstVariant->toCurrency('Price', 1)} $</span></div>
                    <!--<div class="buttons button_big_green f_l">
                        <a href="#">Купить</a>
                        </div>-->
                    <!--<div class="buttons button_big_blue f_l">
                        <a href="#">Оформить заказ</a>
                        </div>-->
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
            <ul>
                <li>
                    <div class="f_l smallest_item">
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
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                                <span class="discount">-15%</span>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <del class="price f-s_12 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                                <div class="price f-s_14 price-c_red">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                                <span class="discount">-15%</span>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">=</div>
                    <div class="button_block">
                        <div class="buy">
                            <del class="price f-s_14 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                            <div class="price f-s_18">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                        <div class="buttons button_middle_blue">
                            <a href="#">Оформить комплект</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="f_l smallest_item">
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
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="{$SHOP_THEME}images/temp/small_img.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <del class="price f-s_12 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                                <div class="price f-s_14 price-c_red">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
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
                    </div>
                    <div class="plus_eval">=</div>
                    <div class="button_block">
                        <div class="buy">
                            <del class="price f-s_14 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                            <div class="price f-s_18">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                        <div class="buttons button_middle_blue">
                            <a href="#">Оформить комплект</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
    <div class="center">
        <div class="tabs f_l w_770 info_tovar">
            <ul class="nav_tabs">
                <li><a href="#first">Информация</a></li>
                <li><a href="#second">Характеристики</a></li>
                <li><a href="#third">Аксессуары</a></li>
                <li><a href="#four">Отзывы(5)</a></li>
            </ul>
            <div id="first">
                <div class="info_text">
                    {echo $model->getFullDescription()}
                </div>
            </div>
            <div id="second">
                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
            </div>
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
<!--                                         <div class="price f-s_26">{echo $model->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $model->getOldPrice()}$</span></div>-->
                                        <div class="price f-s_16 f_l">{echo $p->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $model->getOldPrice()}$</span></div>
                                        <div class="button_gs buttons"><a href="#" class="goBuy">Купить</a></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                    {/foreach}    
                </ul>
            </div>
        </div>
        <div id="four">
            <div class="di_b">
                <span class="comment_ajax_refer b-r_4 visible">
                    <a href="#" class="t-d_n"><span class="js">Оставить отзыв</span><span class="blue_arrow"></span></a>
                    <span>Для того, чтобы оставить комментарий, Вы должны <a href="#" class="js red">авторизироваться</a> на сайте</span>
                </span>
            </div>
            <form method="post" action="#" class="comment_form clearfix">
                <label>
                    Ваше имя
                    <input type="text">
                </label>
                <label>
                    Комментарий
                    <textarea></textarea>
                </label>
                <label class="buttons button_middle_blue f_l">
                    <input type="submit" value="Оставить отзыв"/>
                </label>
            </form>
            <ul class="comments">
                <li>
                    <b>Артем Шиков:</b>
                    <div class="c_9 f-s_11">Оставлен 1 марта 2012</div>
                    <p>
                        Производительность толком оценить немогу, так как ничего тяжело в 3D не моделил и не рендерил, и HD видео не обрабатывал. Но 27 дюймов IPS матрицы для работы с графикой - одинг восторг. Безумно удобно работать под маковоской осью, все под рукой благодаря мультитачу. Работает бесшумно, иногда кряхтит жесткий, когда что-то соображает тяжело)), даже на не слабой загрузке греется терпимо. Эргономика принесена в жертву, об этом много писали, прочувствовал на себе. Теперь 15-дюймов ноута кажутся 10-ю дюймами. Шикарная машина.
                        Плюсы: качество сборки бесшумность произвоительность дизайн качество изображения
                        Минусы: неэргономичность пачкотливость стекла матрицы
                    </p>
                </li>
                <li>
                    <b>Артем Шиков:</b>
                    <div class="c_9 f-s_11">Оставлен 1 марта 2012</div>
                    <p>
                        Производительность толком оценить немогу, так как ничего тяжело в 3D не моделил и не рендерил, и HD видео не обрабатывал. Но 27 дюймов IPS матрицы для работы с графикой - одинг восторг. Безумно удобно работать под маковоской осью, все под рукой благодаря мультитачу. Работает бесшумно, иногда кряхтит жесткий, когда что-то соображает тяжело)), даже на не слабой загрузке греется терпимо. Эргономика принесена в жертву, об этом много писали, прочувствовал на себе. Теперь 15-дюймов ноута кажутся 10-ю дюймами. Шикарная машина.
                        Плюсы: качество сборки бесшумность произвоительность дизайн качество изображения
                        Минусы: неэргономичность пачкотливость стекла матрицы
                    </p>
                </li>
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