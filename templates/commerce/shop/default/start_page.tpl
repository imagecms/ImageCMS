<div class="content">

    <!-- Show Brands in circle -->
    {$banners = getBanners()}
	{if count($banners)}
    <div class="cycle center">
        <ul>
            {foreach $banners as $banner}
                <li>
                    <a href="{echo $banner->getUrl()}">
                        <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" />
                    </a>
                </li>
            {/foreach}
        </ul>
        <span class="nav"></span>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
	{/if}
    <!-- Show Brands in circle -->
    
    
<!--                ТЕСТ ФЕНСІ-->
<!--    <a href="{$SHOP_THEME}/images/temp/cycle_1.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></a>-->
<!--    <a href="{$SHOP_THEME}/images/temp/cycle_2.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></a>-->
<!--                ЕНД-->
    <div class="featured carusel_frame">
        <div class="box_title center"><span class="f-s_24">Популярные товары</span></div>
        <div class="carusel">
            <ul>
                <li>
                    <div class="small_item">
                        <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                        <div class="info">
                            <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">99999 <sub>грн</sub><span class="d_b">859 $</span></div>
                                <div class="button_gs buttons"><a href="#">Купить</a></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="small_item">
                        <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                        <div class="info">
                            <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                <div class="button_gs buttons"><a href="#">Купить</a></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="small_item">
                        <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                        <div class="info">
                            <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                <div class="button_gs buttons"><a href="#">Купить</a></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="small_item">
                        <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_3.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                        <div class="info">
                            <a href="#" class="title">Apple MacBook Pro A1286</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                <div class="button_gs buttons"><a href="#">Купить</a></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="small_item">
                        <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_4.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                        <div class="info">
                            <a href="#" class="title">Apple MacBook Pro A1286</a>
                            <div class="buy">
                                <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                <div class="button_gs buttons"><a href="#">Купить</a></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div><!-- featured -->
                    {$hot = makeResponse('hot', 3)}
                    {var_dump($hot )}
    <div class="center clearfix">
        <div class="tabs f_l">
            <ul class="nav_tabs">
                <li><a href="#first">Новинки</a></li>
                <li><a href="#second">Акції</a></li>
            </ul>
            <div id="first">
                <div id="scroll-box" class="horizontal-only">
                    <ul>
                        {foreach $hot as $hotProduct}
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">{echo $hotProduct->firstVariant->toCurrency()} <sub>{$CS}</sub><span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', 1)} $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {/foreach}
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_greys buttons"><a href="#">Сообщить о<br/> появлении</a></div>
                                    </div>
                                </div>
                            </div>
                        </li><!--
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_3.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_4.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="small_item">
                                <a href="#" class="img"><span><img src="{$SHOP_THEME}/images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                                <div class="info">
                                    <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                    <div class="buy">
                                        <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                        <div class="button_gs buttons"><a href="#">Купить</a></div>
                                    </div>
                                </div>
                            </div>
                        </li>-->

                    </ul>
                </div>
            </div>
            <div id="second">
                
            </div>
        </div>
        {widget('latest_news')}
    </div>
</div>