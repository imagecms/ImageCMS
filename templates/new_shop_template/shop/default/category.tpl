<article>
    {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$model->id);}
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
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        {echo makeBreadCrumbs($category)}
    </div>
    <div class="row">
        {include_tpl('filter')}
        <div class="span9 right">
            <h1 class="d_i">{echo $category->getName()}</h1><span class="c_97">Найдено {echo $totalProducts} {echo SStringHelper::Pluralize($totalProducts, array("товар", "товара", "товаров"))}</span>
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
                        <select class="sort" id="sort2" name="user_per_page">
                            <option selected="selected" value="1">12</option>
                            <option value="2">24</option>
                            <option value="3">36</option>
                            <option value="4">48</option>
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
                        <li class="{if (int)$product->getallstock() == 0}not-avail {else:}in_cart {/if}span3">
                            <div class="description">
                                <div class="frame_response">
                                    <div class="star">
                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                    </div>
                                    <a href="#" class="count_response"><span class="icon-comment"></span>
                                        {totalComments($product->getId())}
                                        {echo SStringHelper::Pluralize((int)totalComments($product->getId()), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}</a>
                                </div>
                                <a href="{shop_url('product/'.$product->getUrl())}">{echo $product->getName()}</a>
                                <div class="price price_f-s_16"><span class="f-w_b">{echo $product->firstVariant->getPrice()}</span> {$CS}&nbsp;&nbsp;<span class="second_cash"></span></div>
                                {if (int)$product->getallstock() == 0}
                                    <button data-placement="bottom right" 
                                            data-place="noinherit" 
                                            data-duration="500" 
                                            data-effect-off="fadeOut" 
                                            data-effect-on="fadeIn" 
                                            data-drop=".drop-report"
                                            data-prodid="{echo $product->getId()}"
                                            type="button" 
                                            class="btn btn_not_avail">
                                        <span class="icon-but"></span>
                                        Сообщить о появлении
                                    </button>
                                {else:}
                                    <button class="btn btn_buy" type="button" 
                                            data-prodid="{echo $product->getId()}" 
                                            data-varid="{echo $product->firstVariant->getId()}"
                                            data-price="{echo $product->firstVariant->getPrice()}"
                                            data-name="{echo $product->firstVariant->getName()}">
                                        Купить
                                    </button>
                                {/if}
                                <div class="d_i-b">
                                    <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                    <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                </div>
                            </div>
                            <a href="#" class="photo">
                                <span class="helper"></span>
                                
                                <figure>
                                    <img src="{productImageUrl($product->getMainModImage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}"/>
                                </figure>
                            </a>
                            {if $product->getHot()}
                                <span class="top_tovar nowelty">{lang('s_shot')}</span>
                            {/if}
                            {if $product->getAction()}
                                <span class="top_tovar promotion">{lang('s_saction')}</span>
                            {/if}
                            {if $product->getHit()}
                                <span class="top_tovar discount">{lang('s_s_hit')}</span>
                            {/if}
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
