{$forCompareProducts = $CI->session->userdata('shopForCompare')}
{$cart_data = ShopCore::app()->SCart->getData()}
<article>
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
            <a href="#" rel="v:url" property="v:title">Главная</a>
        </span>/
        <span typeof="v:Breadcrumb">
            <a href="#" rel="v:url" property="v:title">Тепловое оборудование</a>
        </span>/
        <span typeof="v:Breadcrumb">
            <span rel="v:url" property="v:title">Плиты индукционные</span>
        </span>
    </div>
    <div class="row">
        <aside class="span3">
            <div class="checked_filter">
                <div class="title">245 товаров с фильтрами:</div>
                <ul>
                    <li><span class="times">&times;</span><div class="o_h">Apple Apple Apple AppleApple Apple Apple</div></li>
                    <li><span class="times">&times;</span><div class="o_h">Samsung</div></li>
                    <li><span class="times">&times;</span><div class="o_h">Dell</div></li>
                </ul>
                <a href="#"><span class="icon-return"></span>Сбросить все фильтры</a>
            </div>
            <div class="filter">
                <form method="post" action="">
                    <div class="boxFilter">
                        <div class="title">Цена</div>
                        <div class="sliderCont">
                            <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                                <img src="images/slider.png"/>
                                <div class="ui-slider-range ui-widget-header"></div>
                                <a href="#" class="ui-slider-handle" id="left_slider"></a>
                                <a href="#" class="ui-slider-handle" id="right_slider"></a>
                            </div>
                        </div>
                        <div class="formCost t-a_j">
                            <label><input type="text" id="minCost" value="0" data-title="только цифры"/></label>
                            <span class="f-s_12">&ndash;</span>
                            <label><input type="text" id="maxCost" value="8000" data-title="только цифры"/></label>
                            <input type="submit" value="Подобрать" class="btn"/>
                        </div>
                    </div>
                    <div class="boxFilter">
                        <div class="title">Производитель</div>
                        <div class="clearfix check_form">
                            <label class="disabled"><input type="checkbox" disabled="disabled"/><span>Philips <span>(14)</span></span></label>
                            <label><input type="checkbox"/><span>Dex <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Hyundai <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>LG <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Panasonic <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Philips <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Samsung <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sanyo <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sharp <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sony <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Supra <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Thompson <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Toshiba <span>(15)</span></span></label>
                        </div>
                    </div>
                    <div class="boxFilter">
                        <div class="title">Производитель</div>
                        <div class="clearfix check_form">
                            <label class="disabled"><input type="checkbox" disabled="disabled"/><span>Philips <span>(14)</span></span></label>
                            <label><input type="checkbox"/><span>Dex <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Hyundai <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>LG <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Panasonic <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Philips <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Samsung <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sanyo <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sharp <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Sony <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Supra <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Thompson <span>(15)</span></span></label>
                            <label><input type="checkbox"/><span>Toshiba <span>(15)</span></span></label>
                        </div>
                    </div>
                </form>
            </div>
        </aside>
        <div class="span9 right">
            <h1 class="d_i">{echo ShopCore::encode($model->getName())}
                {if ShopCore::$_GET['categoryId'] != ''}
                    - {echo $cat_name}
                {/if}</h1><span class="c_97">Найдено {$totalProducts} товара</span>
            <div class="clearfix t-a_c frame_func_catalog">
                <div class="f_l">
                    <span class="v-a_m">Фильтровать по:</span>
                    <div class="lineForm w_170">
                        <select id="sort" name="order">
                            <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-Нет-</option>
                            <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                            <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                            <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                            <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                            <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                            <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                        </select>
                    </div>
                </div>
                <div class="f_r">
                    <span class="v-a_m">Товаров на странице:</span>
                    <div class="lineForm w_70">
                        <select class="sort" id="sort2" name="order2">
                            <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                            <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                            <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                        </select>
                    </div>
                </div>
                <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                    <button type="button" class="btn active"><span class="icon-cat_pic"></span>Картинками</button>
                    <button type="button" class="btn"><span class="icon-cat_list"></span>Списком</button>
                </div>
            </div>
            <div class="grey-b_r-bord">
                <figure class="f_l m-t_10 w_150">
                    <img src="/uploads/shop/brands/{echo $model->getImage()}"/>
                </figure>
                <p>{echo $model->getDescription()}</p>
            </div>
            <ul class="items items_catalog" data-radio-frame>
                <!-- Start of rendering produts list   -->
                {foreach $products as $product}
                    {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->getId())}
                    {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                    <li class="span3{if $product->getFirstVariant()->getStock() == 0} not-avail{/if}">
                        <div class="description">
                            <div class="frame_response">
                                <!--    Star reiting    -->
                                <div class="star">
                                    <img src="/templates/new_shop_template/shop/default/images/temp/STAR.png"/>
                                </div>
                                <!--    Star reiting    -->
                                <a href="{shop_url('product/'.$product->id.'#four')}" class="count_response">                                    
                                    {totalComments($product->getid())}
                                    {echo SStringHelper::Pluralize((int)totalComments($product->getid()), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                                </a>
                            </div>
                            <a href="{shop_url('product/' . $product->geturl())}">{echo ShopCore::encode($product->getname())}</a>
                            <div class="price price_f-s_16"><span class="f-w_b">{echo number_format($product->firstVariant->getPrice(), ShopCore::app()->SSettings->pricePrecision, ".", "")}</span> {$CS}&nbsp;&nbsp;</div>
                            <button class="btn btn_buy" type="button">Уже в корзине</button>
                            <div class="d_i-b">
                                <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                            </div>
                        </div>
                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="{productImageUrl($product->getmainimage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getid()}"/>
                            </figure>
                        </a>
                    </li>
                {/foreach}
                <!--  End of rendering produts list   -->
            </ul>
            <!--    Pagination    -->
            {$pagination}
            <!--    Pagination    -->
        </div>
    </div>
</article>