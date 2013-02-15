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
                            <button type="submit" class="btn f-s_0"><span class="icon-filter"></span><span class="text-el">Подобрать</span></button>
                        </div>
                    </div>
                    <div class="boxFilter">
                        <div class="title">Производитель</div>
                        <div class="clearfix check_form">
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox" disabled="disabled"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                        </div>
                    </div>
                    <div class="boxFilter">
                        <div class="title">Производитель</div>
                        <div class="clearfix check_form">
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                            <div class="frameLabel"><span class="niceCheck b_n"><input type="checkbox"/></span><span>Philips <span>(14)</span></span></div>
                        </div>
                    </div>
                </form>
            </div>
        </aside>
        <div class="span9 right">
            <h1 class="d_i">{echo $category->getName()}</h1><span class="c_97">Найдено {echo $totalProducts} товара</span>
            <div class="clearfix t-a_c frame_func_catalog">
                <div class="f_l">
                    <span class="v-a_m">Фильтровать по:</span>
                    <div class="lineForm w_170">
                        <select class="sort" id="sort" name="order">
                            <option selected="selected" value="1">по Рейтингу</option>
                            <option value="2">От дешевых к дорогим</option>
                            <option value="3">От дорогих к дешевым</option>
                            <option value="4">Популярные</option>
                            <option value="5">Новинки</option>
                            <option value="6">Акции</option>
                        </select>
                    </div>
                </div>
                <div class="f_r">
                    <span class="v-a_m">Товаров на странице:</span>
                    <div class="lineForm w_70">
                        <select class="sort" id="sort2" name="order2">
                            <option selected="selected" value="1">20</option>
                            <option value="2">40</option>
                            <option value="3">60</option>
                            <option value="4">80</option>
                        </select>
                    </div>
                </div>
                <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                    <button type="button" class="btn active"><span class="icon-cat_pic"></span><span class="text-el">Картинками</span></button>
                    <button type="button" class="btn"><span class="icon-cat_list"></span><span class="text-el">Списком</span></button>
                </div>
            </div>
            {if count($products)>0}
                <ul class="items items_catalog" data-radio-frame>
                    {foreach $products as $product}
                        <li class="in_cart span3">
                            <div class="description">
                                <div class="frame_response">
                                    <div class="star">
                                        <img src="images/temp/STAR.png"/>
                                    </div>
                                    <a href="#" class="count_response"><span class="icon-comment"></span>{totalComments($product->getId())} відгуків</a>
                                </div>
                                <a href="{shop_url('product/'.$product->getUrl())}">{echo $product->getName()}</a>
                                <div class="price price_f-s_16"><span class="f-w_b">{echo $product->firstVariant->getPrice()}</span> {$CS}&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                                <button class="btn btn_cart" type="button">Уже в корзине</button>
                                <div class="d_i-b">
                                    <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                    <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                </div>
                            </div>
                            <a href="#" class="photo">
                                <span class="helper"></span>
                                <figure>
                                    <img src="images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                                </figure>
                            </a>
                        </li>
                    {/foreach}
                </ul>
            {/if}
            <div class="pagination">
                {$pagination}
            </div>
        </div>
    </div>
</article>
