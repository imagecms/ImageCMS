{# Variables
# @var model
# @var jsCode
# @var products
# @var totalProducts
# @var brandsInCategory
# @var pagination
# @var cart_data
#}

<div class="content">
    <div class="center">
        <div class="filter">
            <div class="box_title padding_filter">
                <div class="title">Клас</div>
                <div class="lineForm">
                    <select id="class" name="class" tabindex="1">
                        <option value="1" selected="selected">от дешевых к дорогим</option>
                        <option value="2">от дорогих к дешевым</option>
                        <option value="3">популярные</option>
                        <option value="4">новинки</option>
                        <option value="5">акции</option>
                    </select>
                </div>
            </div>
            <div class="title padding_filter">Подбор по параметрам</div>
            <div class="checked_filter padding_filter">
                <span class="c_4f">245 товаров с фильтрами:</span>
                <ul>
                    <li>Apple Apple Apple AppleApple Apple Apple</li>
                    <li>Samsung</li>
                    <li>Dell</li>
                </ul>
                <a href="#" class="reset">Сбросить все фильтры</a>
            </div>
            <form method="post" action="" class="padding_filter clearfix">
                <div class="title">Цена</div>
                <div class="sliderCont">
                    <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                        <div class="ui-slider-range ui-widget-header"></div>
                        <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                        <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                    </div>
                </div>
                <div class="formCost f_l">
                    <label>от</label>
                    <input type="text" id="minCost" value="0"/>
                    <label>до</label>
                    <input type="text" id="maxCost" value="8000"/>
                    <div class="buttons button_bs">
                        <input type="submit" value="ok"/>
                    </div>
                </div>
            </form>
            <form method="post" action="">
                <div class="padding_filter check_frame">
                    <div class="title">Производитель</div>
                    <div class="clearfix check_form">
                        <label class="disabled"><input type="checkbox" disabled="disabled"/><span class="name_model">Philips <span>(14)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Dex <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Hyundai <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">LG <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Panasonic <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Philips <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Samsung <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sanyo <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sharp <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sony <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Supra <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Thompson <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Toshiba <span>(15)</span></span></label>
                    </div>
                </div>
                <div class="padding_filter check_frame">
                    <div class="title">Производитель</div>
                    <div class="clearfix check_form">
                        <label class="disabled"><input type="checkbox" disabled="disabled"/><span class="name_model">Philips <span>(14)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Dex <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Hyundai <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">LG <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Panasonic <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Philips <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Samsung <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sanyo <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sharp <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Sony <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Supra <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Thompson <span>(15)</span></span></label>
                        <label><input type="checkbox"/><span class="name_model">Toshiba <span>(15)</span></span></label>
                    </div>
                </div>
            </form>
        </div>
        <div class="catalog_content">
            <div class="catalog_frame">
                <div class="crumbs">Главная страница / домашняя электроника /</div>
                <div class="box_title clearfix">
                    <div class="f-s_24 f_l">{echo ShopCore::encode($model->getTitle())} <span class="count_search">({$totalProducts})</span></div>
                    <div class="f_r">
                        <form method="GET">
                        <div class="lineForm f_l w_145">
                            <select id="sort" name="sort">
                                <option value="1" selected="selected">от дешевых к дорогим</option>
                                <option value="2">от дорогих к дешевым</option>
                                <option value="3">популярные</option>
                                <option value="4">новинки</option>
                                <option value="5">акции</option>
                            </select>
                        </div>
                        <div class="lineForm f_l w_50 m-l_10">
                            <select id="count" name="count">
                                <option value="1" selected="selected">10</option>
                                <option value="1">20</option>
                            </select>
                        </div>
                        </form>
                    </div>
                </div>
                <ul>
                    <!--  Render produts list   -->
                    {foreach $products as $product}
                    {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                    <li>
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $product->getUrl())}">
                                <img src="{productImageUrl($product->getMainimage())}" alt="{echo ShopCore::encode($product->name)}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->name)}</a>
                            <div class="f-s_0">
                                {if $product->firstVariant->getNumber()}<span class="code">Код {echo ShopCore::encode($product->firstVariant->getNumber())}</span>{/if}
                                <div class="di_b star"><img src="{$SHOP_THEME}images/temp/STAR.png"></div>
                                <a href="#" class="response">145 відгуків</a>
                            </div>
                            <div class="f_l">
                                <div class="buy">
                                    <div class="price f-s_18 f_l">{echo $product->firstVariant->toCurrency()} <sub>{$CS}</sub><span class="d_b">{echo $product->firstVariant->toCurrency('Price', 1)} $</span></div>
                                    <div class="{$style.class} buttons"><a class="{$style.identif}" href="{$style.link}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" >{$style.message}</a></div>
                                </div>
                            </div>
                            <div class="f_r t-a_r">
                                <span class="ajax_refer_marg"><a href="#" class="js gray">Додати до порівняння</a></span>
                                <a href="#" class="js gray">Зберегти у списку бажань</a>
                            </div>
                        </div>
                        {if $product->countProperties() > 0}
                        <p class="c_b">
                            {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($product)}
                            <a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">Подробнее</span> →</a>
                        </p>
                        {/if}
                    </li>
                    {/foreach}
                    <!--  Render produts list   -->                    
                </ul>
                
                <!--    Pagination    -->                
                <div class="pagination d_n">
                    <span class="f_l">
                        ←&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Назад</a>
                    </span>
                    <span class="f_r">
                        <a href="#">Следующая страница</a>&nbsp;&nbsp;&nbsp;&nbsp;→
                    </span>
                    <div class="t-a_c">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="active">4</a>
                        <a href="#">5</a>
                        <a>...</a>
                        <a href="#">10</a>
                    </div>
                </div>
                <!--    Pagination    -->
            </div>
            
            <!--   Right sidebar     -->
            <div class="nowelty_auction">
                <!--   New products block     -->
                <div class="box_title">
                    <span>Новинки</span>
                </div>
                <ul>
                    {foreach getPromoBlock('hot', 3) as $hotProduct}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img width="80" src="{productImageUrl($hotProduct->getSmallimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_14">{echo $hotProduct->firstVariant->toCurrency()} <sub>{$CS}</sub><span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', 1)} $</span></div>
                            </div>
                        </div>
                    </li>
                    {/foreach}
                </ul>
                <!--   New products block     -->
                
                <!--   Promo products block     -->
                <div class="box_title">
                    <span>Акции</span>
                </div>
                <ul>
                    {foreach getPromoBlock('action', 3) as $hotProduct}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img height="50" src="{productImageUrl($hotProduct->getSmallimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_14">{echo $hotProduct->firstVariant->toCurrency()} <sub>{$CS}</sub><span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', 1)} $</span></div>
                            </div>
                        </div>
                    </li>
                    {/foreach}
                </ul>
                <!--   Promo products block     -->                
            </div>
            <!--   Right sidebar     -->
            
        </div>
    </div>
</div>