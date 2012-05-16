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
                    </div>
                </div>
                <ul>
                    <li>
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/item_1.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Ноутбук Apple MacBook Pro 13” MD313R</a>
                            <div class="f-s_0">
                                <span class="code">Код 13445795</span>
                                <div class="di_b star"><img src="images/temp/STAR.png"></div>
                                <a href="#" class="response">145 відгуків</a>
                            </div>
                            <div class="f_l">
                                <div class="buy">
                                    <div class="price f-s_18 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                            <div class="f_r t-a_r">
                                <span class="ajax_refer_marg"><a href="#" class="js gray">Додати до порівняння</a></span>
                                <a href="#" class="js gray">Зберегти у списку бажань</a>
                            </div>
                        </div>
                        <p class="c_b">Экран 15.4" (1440x900) LED, глянцевый / Intel Core i7 (2.4 ГГц) / RAM 4 ГБ / HDD 750 ГБ / AMD Radeon HD 6750M, 1 ГБ / DVD Super Multi DL / Wi-Fi / Bluetooth / веб-камера / кардридер SD / OS X Lion / 2.54 кг
                            <a href="#" class="t-d_n"><span class="t-d_u">Детальніше</span> →</a>
                        </p>
                    </li>
                    <li class="not_avail">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/item_1.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Ноутбук Apple MacBook Pro 13” MD313R</a>
                            <div class="f-s_0">
                                <span class="not_avail_icon">Нет в наличии</span>
                                <span class="code">Код 13445795</span>
                                <div class="di_b star"><img src="images/temp/STAR.png"></div>
                                <a href="#" class="response">145 відгуків</a>
                            </div>
                            <div class="f_l">
                                <div class="buy">
                                    <div class="price f-s_18 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_greys buttons"><a href="#">Сообщить <br/>о появлении</a></div>
                                </div>
                            </div>
                            <div class="f_r t-a_r">
                                <span class="ajax_refer_marg"><a href="#" class="js gray">Додати до порівняння</a></span>
                                <a href="#" class="js gray">Зберегти у списку бажань</a>
                            </div>
                        </div>
                        <p class="c_b">Экран 15.4" (1440x900) LED, глянцевый / Intel Core i7 (2.4 ГГц) / RAM 4 ГБ / HDD 750 ГБ / AMD Radeon HD 6750M, 1 ГБ / DVD Super Multi DL / Wi-Fi / Bluetooth / веб-камера / кардридер SD / OS X Lion / 2.54 кг
                            <a href="#" class="t-d_n"><span class="t-d_u">Детальніше</span> →</a>
                        </p>
                    </li>
                    <li>
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/item_1.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black + Флешка на 32GB!!</a>
                            <div class="f-s_0">
                                <span class="code">Код 13445795</span>
                                <div class="di_b star"><img src="images/temp/STAR.png"></div>
                                <a href="#" class="response">145 відгуків</a>
                            </div>
                            <div class="f_l">
                                <div class="buy">
                                    <div class="price f-s_18 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_middle_blue buttons"><a href="#">Оформить<br/>заказ</a></div>
                                </div>
                            </div>
                            <div class="f_r t-a_r">
                                <span class="ajax_refer_marg"><a href="#" class="js gray">Додати до порівняння</a></span>
                                <a href="#" class="js gray">Зберегти у списку бажань</a>
                            </div>
                        </div>
                        <p class="c_b">Экран 15.4" (1440x900) LED, глянцевый / Intel Core i7 (2.4 ГГц) / RAM 4 ГБ / HDD 750 ГБ / AMD Radeon HD 6750M, 1 ГБ / DVD Super Multi DL / Wi-Fi / Bluetooth / веб-камера / кардридер SD / OS X Lion / 2.54 кг
                            <a href="#" class="t-d_n"><span class="t-d_u">Детальніше</span> →</a>
                        </p>
                    </li>
                </ul>
                
                <!--    Pagination    -->                
                <div class="pagination">
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