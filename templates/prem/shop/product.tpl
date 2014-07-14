{/*/**
* @file Render shop product;
* @partof main.tpl;
* @updated 26 February 2013;
* Variables
*  $model : PropelObjectCollection of (object) instance of SProducts
*   $model->hasDiscounts() : Check whether the discount on the product.
*   $model->firstVariant : variable which contains the first variant of product;
*   $model->firstVariant->toCurrency() : variable which contains price of product;
*
*/}
{$Comments = $CI->load->module('comments')->init($model)}
{$NextCSIdCond = $NextCS != null}
{$variants = $model->getProductVariants()}
{$sizeAddImg = sizeof($productImages = $model->getSProductAdditionalImages())}
{$hasDiscounts = $model->hasDiscounts()}

<div class="frame-crumbs">
    <div class="container">
        <div class="f_l">
            <a href="#" class="f-s_0">
                <span class="icon-arrow-l"></span>
                <span class="text-el">
                    {lang('Вернуться в каталог', 'newLevel')}
                </span>
            </a>
        </div>
        <div class="f_r f-s_0">
            <a href="#" class="f-s_0 m-r_25">
                <span class="icon-arrow-l"></span>
                <span class="text-el">
                    {lang('Предыдущий', 'newLevel')}
                </span>
            </a>
            <a href="#" class="f-s_0">
                <span class="text-el">
                    {lang('Следующий', 'newLevel')}
                </span>
                <span class="icon-arrow-r"></span>
            </a>
        </div>
    </div>
</div>
<div class="frame-inside page-product">
    <div class="container">
        <div class="clearfix item-product">
            <div class="right-product">
                <div class="right-product-left">
                    <div class="f-s_0 buy-block">
                        <div class="f-s_0 title-product">
                            {/*if adaptive*/}
                            <span class="icon-adaptive"></span>
                            <!-- Start. Name product -->
                            <div class="frame-title d_i-b">
                                <h1 class="title">{echo  ShopCore::encode($model->getName())}</h1>
                            </div>
                            <!-- End. Name product -->
                        </div>
                        <div class="frame-star">
                            <div class="frame-info-product clearfix">
                                <div class="f_l">
                                    {$CI->load->module('star_rating')->show_star_rating($model, false)}
                                </div>
                                <div class="f_r f-s_0">
                                    <span class="f-s_0 btn-watch">
                                        <span class="icon-watch"></span>
                                        <span class="text-el">
                                            999
                                        </span>
                                    </span>
                                    <button data-trigger="[data-href='#comment']" data-scroll="true" class="btn-count-response">
                                        <span class="icon-comment"></span>
                                        <span class="text-el">
                                            {intval($Comments[$model->getId()])}
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <!-- End. Star rating-->
                        </div>
                        <div class="frame-prices-buy">
                            <div class="f-s_0">
                                <!-- Start. Prices-->
                                <div class="frame-prices f-s_0">
                                    <!-- Start. Check for discount-->
                                    {$oldoprice = $model->getOldPrice() && $model->getOldPrice() != 0 && $model->getOldPrice() > $model->firstVariant->toCurrency()}
                                    {if $hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="curr">{$CS}</span><span class="price priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>
                                            </span>
                                        </span>
                                    {/if}
                                    <!-- End. Check for discount-->
                                    <!-- Start. Check old price-->
                                    {if $oldoprice && !$hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="curr">{$CS}</span><span class="price priceOrigVariant">{echo intval($model->toCurrency('OldPrice'))}</span>                                                
                                            </span>
                                        </span>
                                    {/if}
                                    <!-- End. Check old price-->
                                    <!-- Start. Product price-->
                                    {if $model->firstVariant->toCurrency() > 0}
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span>
                                                    <span class="curr">{$CS}</span><span class="price priceVariant" data-price="{echo $model->firstVariant->toCurrency()}">{echo $model->firstVariant->toCurrency()}</span>
                                                </span>
                                            </span>
                                            {if $NextCSIdCond}
                                                <span class="price-add">
                                                    <span>
                                                        (<span class="curr-add">{$NextCS}</span><span class="price addCurrPrice">{echo $model->firstVariant->toCurrency('Price',$NextCSId)}</span>)
                                                    </span>
                                                </span>
                                            {/if}
                                        </span>
                                    {/if}
                                    <!-- End. Product price-->
                                </div>
                                <!-- End. Prices-->
                                <div class="frame-labels">
                                    <label class="frame-label">
                                        <span class="niceCheck b_n">
                                            <input class="addPrice" name="a1" type="checkbox" value="300">
                                        </span>
                                        <span class="name-count f-s_0">
                                            <span class="frame-text-el">
                                                <span class="text-el">
                                                    {lang('Индивидуальная стилизация', 'newLevel')}
                                                </span>
                                            </span>
                                            <span class="frame-price f-s_0">
                                                <span class="curr">$</span>
                                                <span class="price">300</span></span>
                                            <span class="icon-info"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="funcs-buttons">
                                    <!-- Start. Collect information about Variants, for future processing -->
                                    {foreach $variants as $key => $productVariant}
                                        <div class="frame-count-buy">
                                            <form method="POST" action="">
                                                <div class="btn-create-shop2">
                                                    <button type="button" data-id="{echo $productVariant->getId()}">
                                                        <span class="text-el">{lang('Создать магазин с этим дизайном', 'newLevel')}</span>
                                                    </button>
                                                    {/*}if not authorized{ */}
                                                    <button type="button" data-id="{echo $productVariant->getId()}" data-drop=".drop-enter2">
                                                        <span class="text-el">{lang('Создать магазин с этим дизайном', 'newLevel')}</span>
                                                    </button>
                                                </div>
                                                {form_csrf()}
                                            </form>
                                        </div>
                                    {/foreach}
                                </div>
                                <!-- End. Collect information about Variants, for future processing -->
                            </div>
                        </div>
                    </div>
                    <!-- Start. Description -->
                    {if trim($model->getShortDescription()) != ''}
                        <div class="short-desc">
                            {echo $model->getShortDescription()}
                        </div>
                    {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($model->getId())}
                        <div class="short-desc">
                            <p>{echo $props}</p>
                        </div>
                    {/if}
                    <!--  End. Description -->
                </div>
            </div>
            <div class="left-product">
                <!-- Start. Photo block-->
                <ul class="cycle">
                    <li>
                        <a href="{echo $model->firstVariant->getLargePhoto()}" class="frame-photo-title" title="{echo ShopCore::encode($model->getName())}">
                            <span class="photo-block">
                                <span class="helper"></span>
                                <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())}" title="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" class="vImgPr"/>
                            </span>
                        </a>
                    </li>
                    {foreach $productImages as $key => $image}
                        <li>
                            <a href="{productImageUrl('products/additional/'.$image->getImageName())}" title="{echo ShopCore::encode($model->getName())}" class="frame-photo-title">
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="{echo productImageUrl('products/additional/'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}" title="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                </span>
                            </a>
                        </li>
                    {/foreach}
                </ul>
                <div class="pager"></div>
                <!-- End. Photo block-->
                <div class="t-a_c">
                    <div class="btn-primary big">
                        <a href="#">
                            <span class="text-el">{lang('Демо онлайн', 'newLevel')}</span>
                        </a>
                    </div>
                    <div class="btn-primary big">
                        <a href="#">
                            <span class="text-el">{lang('Админчасть', 'newLevel')}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container f-s_0">
        <!-- Start. Tabs block-->
        <ul class="tabs tabs-data tabs-product" data-rel="tabs">
            {if $fullDescription = $model->getFullDescription()}
                <li class="active">
                    <button data-href="#view">
                        <span class="text-el">
                            {lang('Описание','newLevel')}
                        </span>                            
                    </button>
                </li>
            {/if}
            <li>
                <button data-href="#first">
                    <span class="text-el">
                        {lang('Инструкция','newLevel')}
                    </span>
                </button>
            </li>
            {if $Comments && $model->enable_comments}
                <li>
                    <button type="button" data-href="#comment" onclick="Comments.renderPosts($('#comment .inside-padd'), {literal}{'visibleMainForm': '1'}{/literal})">
                        <span class="text-el">
                            {lang('Комментарии','newLevel')}
                        </span>
                    </button>
                </li>
            {/if}
        </ul>
        <div class="frame-tabs-ref frame-tabs-product">
            {if $fullDescription != ''}
                <div id="view">
                    <div class="inside-padd">
                        <div class="product-descr patch-product-view">
                            <div class="text">
                                <div class="title-h2">{lang('Описание' , 'newLevel')}</div>
                                <h2>{echo  ShopCore::encode($model->getName())}</h2>
                                {echo $fullDescription}
                            </div>
                        </div>
                    </div>
                    <img src="{$THEME}images/temp/1.jpg"/>
                </div>
            {/if}
            <!--             Start. Characteristic-->
            <div id="first">
                <div class="inside-padd">
                    <div class="title-h2">{lang('Свойства', 'newLevel')}</div>
                    <div class="characteristic">

                    </div>
                </div>
            </div>
            <div id="comment">
                <div class="inside-padd forComments p_r">

                </div>
            </div>
        </div>
        <!-- End. Tabs block-->
    </div>
</div>
<script type="text/javascript" src="{$THEME}js/jquery.cycle.all.min.js"></script>

<div class="drop-enter2 drop drop-style" id="enter">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Для установки авторизуйтесь','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" id="login_form2" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/login")}', '#login_form2');
                        return false;" class="f-s_0">
                    <label class="d_i-b v-a_t">
                        <input type="text" name="email" placeholder="E-mail"/>
                    </label>
                    <label class="d_i-b v-a_t">
                        <input type="password" name="password" placeholder="{lang('Пароль','newLevel')}"/>
                    </label>
                    <div class="frame-label d_i-b v-a_t">
                        <span class="btn-default">
                            <button type="submit">
                                <span class="icon_enter_drop"></span>
                                <span class="text-el">{lang('Войти','newLevel')}</span>
                            </button>
                        </span>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
        <div class="form-create-shop3">
            <div class="inside-padd">
                <div class="title">
                    {lang('Или создайте свой магазин', 'newLevel')}
                </div>
                <div class="sub-title">
                    {lang('Аккуратный шаблон дизайна для Интернет-магазина, который отличается лаконичным дизайном и ненавязчивым, удобным для пользователя ', 'newLevel')}
                </div>
                <div class="f-s_0 t-a_c">
                    <img src="{$THEME}images/create_shop.jpg"/>
                    <div class="btn-create-shop2">
                        <a href="">
                            <span class="text-el">{lang('Создать магазин', 'newLevel')}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>