{# Variables
# @var products
# @var totalProducts
# @var brandsInSearchResult
# @var pagination
# @var tree
# @var model
# @var canonical
# @var jsCode
# @var current_cat
#}
{# Display sidebar.tpl #}
{$jsCode}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}

<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js" type="text/javascript"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js" type="text/javascript"></script>
<script src="{$SHOP_THEME}js/search.js" type="text/javascript"></script>
<!-- END STAR RATING -->
<!--
{include_tpl('sidebar')}
-->

<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <span typeof="v:Breadcrumb">
        <a href="#" rel="v:url" property="v:title"></a>
    </span>
</div>
<div class="row">
    <aside class="span3">
        <div class="filter">
            <!-- Categories tree -->
            <div class="boxFilter">
            <div class="title">{lang('s_sea_found_in_categories')}:</div>
                <nav>
                    <ul>
                        <input type="hidden" name="text" value="{echo ShopCore::$_GET['text']}">
                        <input type="hidden" name="order" id="h_order" value="{echo ShopCore::$_GET['order']}">
                        <input type="hidden" name="category" id="h_category" value="{echo ShopCore::$_GET['category']}">
                        <input type="hidden" name="user_per_page" id="h_user_per_page" value="{echo ShopCore::$_GET['user_per_page']}" />
                        {foreach $tree as $item}
                            {if $item->getLevel() == 0}
                                <ul>
                                    <div class="title">
                                        {foreach $item->getSubtree() as $subItem}
                                            {$count_item = $categorys[$subItem->getId()];}
                                            {if $count_item}
                                                {echo $item->getName()}{break;}
                                            {/if}
                                        {/foreach}
                                    </div>
                                    {foreach $item->getSubtree() as $subItem}
                                        {$count_item = $categorys[$subItem->getId()];}
                                        {if $count_item}
                                            <li{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                                                <a href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a> 
                                                <span class="count">({echo $count_item})</span>
                                            </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                            {/if}
                        {/foreach}
                    </ul>
                    {widget('latest_news')}
              </nav>
            </div>
        </div>
        </aside>
        <div class="span9 right">
            <h1 class="d_i">{if $current_cat != 0}{echo $current_cat->getName()}{else:}{lang('search_all_categories')} {/if}</h1><span class="c_97">{lang('s_found')} {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}</span>
            <div class=" clearfix t-a_ccatalog_frame">
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
                                        <button type="button" class="btn active"><span class="icon-cat_pic"></span>Картинками</button>
                                        <button type="button" class="btn"><span class="icon-cat_list"></span>Списком</button>
                                    </div>
                                </div>
                {if $totalProducts > 0}
                    <!-- Product block -->
                    <ul class="items items_catalog" data-radio-frame>
                        {foreach $products as $p}
                            {$discount = ShopCore::app()->SDiscountsManager->productDiscount($p->id)}
                            {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                            <li class="in_cart span3">
                                <div class="description">
                                    <div class="frame_response">
                                        <div class="star">
                                           {$CI->load->module('star_rating')->show_star_rating($p)}
                                        </div>
                                    </div>
                                   <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                   <div class="price price_f-s_16">
                                        {if (float)$p->getOldPrice() > 0}
                                                {if $p->getOldPrice() > $p->firstvariant->getPrice()}
                                                    <span class="f-w_b">{echo number_format($p->getOldPrice(), 2, ".", "")}</span> {$CS}
                                                    <span class="second_cash"></span>
                                                {/if}
                                         {/if}
                                         {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                    {$prOne = $p->firstvariant->getPrice()}
                                                    {$prTwo = $p->firstvariant->getPrice()}
                                                    {$prThree = $prOne - $prTwo / 100 * $discount}
                                                    <del class="price price-c_red f-s_12 price-c_9">{echo number_format($p->firstvariant->getPrice(), 2, ".", "")} {$CS}</del>
                                                {else:}
                                                    {$prThree = $p->firstvariant->getPrice()}
                                                {/if}
                                                <span class="f-w_b">{echo number_format($prThree, 2, ".", "")}</span> {$CS}
                                                <span class="second_cash"></span>
                                    </div>
                                  <button class="btn btn_buy" type="button">В корзину</button>
                                    <div class="d_i-b">
                                        <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                        <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                    </div>
                                </div>
                                <a class="photo" href="{shop_url('product/' . $p->getUrl())}">
                                    <span class="helper"></span>
                                    <figure>
                                        <img src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->name)} - {echo $p->getId()}" />
                                    </figure>
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    <!-- Pagination -->
                    {if $pagination}
                        {$pagination}
                    {/if}
                {else:}
                    <p>
                        {echo ShopCore::t(lang('s_not_found'))}.
                    </p>
                {/if}
            </div>
        </div>
</div>