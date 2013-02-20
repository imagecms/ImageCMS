<div>
    <article>
        <!--                        class="span9"-->
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
        <div class="item_tovar bot_border_grey">
            <div class="row">
                <div class="photo span5 clearfix">

                    <a rel="group" href="{productImageUrl($model->getMainModImage())}">
                        <figure>
                            <img src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                        </figure>                        
                    </a>              
                    <ul class="frame_thumbs">                   
                        <li class="active">
                            <a rel="group" href="{productImageUrl($model->getMainModImage())}">   
                                <figure>
                                    <img src="{productImageUrl($model->getMainimage())}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" />
                                </figure>
                            </a>                                
                        </li>                   
                        {if sizeof($model->getSProductImagess()) > 0}
                            {$i = 1}
                            {foreach $model->getSProductImagess() as $image}
                                <li>
                                    <a rel="group" href="{echo $image->getThumbUrl()}">   
                                        <figure>
                                            <img src="{echo $image->getThumbUrl()}" alt="{echo ShopCore::encode($model->getName())} - {echo $i}"/>
                                        </figure>
                                    </a>                                
                                </li>
                                {$i++}
                            {/foreach}
                        {/if}                     
                    </ul>
                </div>

                <div class="span7">
                    <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                    {if $model->firstVariant->getNumber() != ''}
                        <span class="c_97">(Артикул {echo $model->firstVariant->getNumber()})</span>
                    {/if}
                    <div class="frame_response">
                        <div class="star">
                            <img src="images/temp/STAR.png"/>
                        </div>
                        <a href="#" class="count_response"><span class="icon-comment"></span>145 відгуків</a>
                    </div>
                    <div class="clearfix">
                        <div class="d_i-b v-a_b m-b_20">
                            <div class=" d_i-b v-a_b m-r_30" id="variantProd">
                                <span class="title">Выбор варианта:</span>
                                <div class="lineForm w_170">
                                    <select id="var" name="var">
                                        <option value="1" selected="selected">asdf</option>
                                        <option value="2">adsg</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" d_i-b v-a_b m-r_45">
                                <div class="price price_f-s_24">
                                    {if $model->hasDiscounts()}
                                        <span class="d_b old_price">
                                            <span class="f-w_b">{echo money_format('%i',$model->firstVariant->getOrigPrice())}</span>
                                            {$CS}
                                        </span>                           
                                    {/if}
                                    <span class="f-w_b">{echo money_format('%i',$model->firstVariant->getPrice())}</span>{$CS}
                                </div>
                                <button class="btn btn_buy" type="button">В корзину</button>
                            </div>
                        </div>
                        <div class="d_i-b v-a_b m-b_20">

                            <button data-prodid="{echo $model->id}" class="btn btn_small_p" type="button" title="добавить в список сравнений">
                                <span class="icon-comprasion_2"></span>
                                <span>Добавить к сравнению</span>
                            </button>

                            <br/>
                            <button class="btn btn_small_p" type="button" title="добавить в список желаний">
                                {if !is_in_wish($model->getId())}
                                    <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" 
                                          data-varid="{echo $model->firstVariant->getId()}" 
                                          data-prodid="{echo $model->getId()}" 
                                          class="addToWList">
                                        <span class="icon-wish_2"></span>
                                        <span class="js blue">{lang('s_slw')}</span>
                                    </span>
                                {else:}
                                    <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                                {/if}
                            </button>

                        </div>
                    </div>
                    <div class="share_tov">
                        {echo $CI->load->module('share')->_make_share_form()}
                    </div>
                    <ul class="tabs clearfix">
                        <li><button type="button" data-href="#info"><span class="icon-info"></span><span class="text-el">Информация</span></button></li>
                        {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                            <li>
                                <button type="button" data-href="#characteristic">
                                    <span class="icon-charack"></span>
                                    <span class="text-el">{lang('s_properties')}</span>
                                </button>
                            </li>
                        {/if}
                        {if $model->getRelatedProductsModels()}            
                            <li>
                                <button type="button" data-href="#accessories">
                                    <span class="icon-accss"></span>
                                    <span class="text-el">{lang('s_accessories')}</span>
                                </button>
                            </li>
                        {/if}
                        <li><button type="button" data-href="#comment"><span class="icon-comment-tab"></span><span class="text-el">Отзывы(5)</span></button></li>
                    </ul>
                    <div class="frame_tabs">
                        <div id="info">
                            <div class="text">
                                {if $model->getShortDescription() != ''}
                                    {echo $model->getShortDescription()}
                                {/if}                             
                            </div>
                        </div>
                        <div id="characteristic">   
                            {if ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}  
                            {/if}
                        </div>
                        {if $model->getRelatedProductsModels()}
                            <div id="accessories">
                                <ul class="items items_catalog" data-radio-frame>
                                    {foreach $model->getRelatedProductsModels() as $p}                                       
                                        {$rel_prod = currency_convert($p->firstvariant->getPrice(), $p->firstvariant->getCurrency())}
                                        {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                                        <!--<li class="span3 not-avail">-->
                                        <li class="span3">
                                            <a href="{shop_url('product/' . $p->getUrl())}" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{productImageUrl($p->getSmallModImage())}" alt="Apple MacBook Pro A1286"/>
                                                </figure>
                                            </a>            
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        <img src="images/temp/STAR.png"/>
                                                    </div>
                                                    <a href="#" class="count_response"><span class="icon-comment"></span>145 відгуків</a>
                                                </div>
                                                <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                                <div class="price price_f-s_16">
                                                    <span class="f-w_b">{echo $p->firstvariant->getPrice()}</span> {$CS}
                                                </div>
                                                <button class="btn btn_buy" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" type="button">{$style.message}</button>


                                                <div class="d_i-b">                                                    
                                                    <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                                    <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                                </div>
                                            </div>
                                        </li>
                                    {/foreach}    

                                </ul>
                            </div>
                        {/if}
                        <div id="comment">
                            <div class="title_h2">Отзывы покупателей</div>
                            <ul class="frame-list-comment">
                                <li>
                                    <div class="frame-comment">Samsung S7500 Galaxy Ace Plus изготовлен в самом актуальном на данный момент форм-факторе – моноблок с сенсорным емкостным экраном. Используемые материалы и качество сборки соответствуют самым высоким мировым стандартам, а его дизайну и эргономике можно только завидовать.</div>
                                    <div class="author-data-comment"><span class="author-comment">Владислав</span> <span class="af">26 октября 2012</span></div>
                                </li>
                                <li>
                                    <div class="frame-comment">Samsung S7500 Galaxy Ace Plus изготовлен в самом актуальном на данный момент форм-факторе – моноблок с сенсорным емкостным экраном. Используемые материалы и качество сборки соответствуют самым высоким мировым стандартам, а его дизайну и эргономике можно только завидовать.</div>
                                    <div class="author-data-comment"><span class="author-comment">Владислав</span> <span class="af">26 октября 2012</span></div>
                                </li>
                            </ul>
                            <div class="grey-b_r-bord t-a_c">
                                <button type="button" class="d_l_b treebuchet f-s_18">Смотреть все отзывы</button>
                            </div>
                            <div class="grey-b_r-bord">
                                <div class="title_h2">Оставте свой отзыв о товаре</div>
                                <div class="form-comment">
                                    <form method="post">
                                        <textarea></textarea>
                                        <div class="clearfix">
                                            <label class="f_l">
                                                <span class="v-a_m c_97">Ваше имя:&nbsp;&nbsp;&nbsp;</span>
                                                <span class="d_i-b v-a_m row">
                                                    <span class="span4">
                                                        <input type="text" required/>
                                                    </span>
                                                </span>
                                            </label>
                                            <input type="submit" value="Отправить" class="btn btn_cart f_r"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Kit start-->
        {if $model->getShopKits()->count() > 0}
            <div class="frame_carousel_product carousel_js c_b frameSet">
                <div class="m-b_20">
                    <div class="title_h1 d_i-b v-a_m promotion_text">{lang('s_spec_promotion')}</div>
                    <div class="d_i-b groupButton v-a_m">
                        <button type="button" class="btn btn_prev">
                            <span class="icon prev"></span>
                            <span class="text-el"></span>
                        </button>
                        <button type="button" class="btn btn_next">
                            <span class="text-el"></span>
                            <span class="icon next"></span>
                        </button>
                    </div>
                </div>
                <div class="carousel">
                    <div class="row">
                        <ul class="items items_catalog">
                            {foreach $model->getShopKits() as $kid}                                     
                                <li class="container">
                                    <ul class="items items_middle">
                                        <li class="span3">
                                            <div class="item_set">
                                                <!--Photo, price, name for parent product-->
                                                <div class="description">
                                                    <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}">
                                                        {echo ShopCore::encode($kid->getMainProduct()->getName())}
                                                    </a>
                                                    <div class="price price_f-s_16">
                                                        <span class="f-w_b">{echo $kid->getProductPrice()}</span>
                                                        {$CS}
                                                    </div>
                                                </div>
                                                <a href="{shop_url('product/' . $kid->getMainProduct()->getUrl())}" class="photo">
                                                    <span class="helper"></span>
                                                    <figure>
                                                        <img src="{productImageUrl($kid->getMainProduct()->getSmallModImage())}" alt="{echo ShopCore::encode($kid->getMainProduct()->getName())}"/>
                                                    </figure>
                                                </a>
                                            </div>
                                            <div class="d_i-b">+</div>
                                        </li>

                                        {foreach $kid->getShopKitProducts() as $coompl}
                                            {$ap = $coompl->getSProducts()}
                                            {$kp = currency_convert($ap->getFirstVariant()->getPrice(), $ap->getFirstVariant()->getCurrency())}                                       
                                            <li class="span3">
                                                <div class="item_set">
                                                    <div class="description">
                                                        <a href="{shop_url('product/' . $ap->getUrl())}">
                                                            {echo ShopCore::encode($ap->getName())}
                                                        </a>
                                                        <div class="price price_f-s_16">
                                                            {if $coompl->getDiscount() != 0}
                                                                <span class="d_b old_price">
                                                                    <span class="f-w_b">
                                                                        {echo number_format($kid->getPriceBefore(), ShopCore::app()->SSettings->pricePrecision, '.', '')}                                                         </span>
                                                                        {$kp.main.symbol}
                                                                </span>
                                                            {/if}
                                                            <span class="f-w_b">
                                                                {echo number_format($kid->getPriceBefore(), ShopCore::app()->SSettings->pricePrecision, '.', '')}                                                               
                                                            </span>{$kp.main.symbol}
                                                        </div>
                                                    </div>
                                                    <a href="{shop_url('product/' . $ap->getUrl())}" class="photo">
                                                        <span class="helper"></span>
                                                        <figure>
                                                            <img src="{productImageUrl($ap->getSmallModImage())}"/>
                                                        </figure>
                                                    </a>
                                                    <span class="top_tovar discount">-{echo $coompl->getDiscount()}%</span>
                                                </div>
                                                <div class="d_i-b">+</div>
                                            </li>                                            
                                        {/foreach}
                                        <li class="span3 p-t_40">
                                            <div class="price price_f-s_24">
                                                <span class="d_b old_price"><span class="f-w_b">{echo $kid->getAllPriceBefore()}</span>{$CS}</span>
                                                <span class="f-w_b">{echo $kid->getTotalPrice()}</span>{$CS}
                                            </div>
                                            <button type="button" class="btn btn_buy ">{lang('s_buy')}</button>
                                        </li>
                                    </ul>
                                </li>
                            {/foreach}                            
                        </ul>
                    </div>
                </div>
            </div>
        {/if}
        <!--Kit end-->

        <div class="frame_carousel_product carousel_js c_b">
            <div class="m-b_20">
                <div class="title_h1 d_i-b v-a_m">Похожие товары</div>
                <div class="d_i-b groupButton v-a_m">
                    <button type="button" class="btn btn_prev">
                        <span class="icon prev"></span>
                        <span class="icon-info"></span>
                    </button>
                    <button type="button" class="btn btn_next">
                        <span class="icon-info"></span>
                        <span class="icon next"></span>
                    </button>
                </div>
            </div>
            <div class="carousel">
                <ul class="items items_catalog">
                    <li class="span3 in_cart">
                        <a href="#" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                            </figure>
                        </a>
                        <div class="description">
                            <div class="frame_response">
                                <div class="star">
                                    <img src="images/temp/STAR.png"/>
                                </div>
                            </div>
                            <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                            <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                            <button class="btn btn_cart" type="button">Уже в корзине</button>
                        </div>
                    </li>
                    <li class="span3">
                        <a href="#" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                            </figure>
                        </a>
                        <div class="description">
                            <div class="frame_response">
                                <div class="star">
                                    <img src="images/temp/STAR.png"/>
                                </div>
                            </div>
                            <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                            <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                            <button class="btn btn_buy" type="button">В корзину</button>
                        </div>
                    </li>
                    <li class="span3">
                        <a href="#" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="images/temp/item_catalog.png" alt="Apple MacBook Pro A1286"/>
                            </figure>
                        </a>
                        <div class="description">
                            <div class="frame_response">
                                <div class="star">
                                    <img src="images/temp/STAR.png"/>
                                </div>
                            </div>
                            <a href="#">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple MacBook Pro A1286</a>
                            <div class="price price_f-s_16"><span class="f-w_b">99999</span> грн.&nbsp;&nbsp;<span class="second_cash">(859 $)</span></div>
                            <button class="btn btn_buy" type="button">В корзину</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </article>
</div>