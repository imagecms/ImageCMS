{#
/**
* @file Template for search results
* @updated 26 February 2013;
* Variables
* $products:(оbject) instance of SProducts
* $totalProducts: (int) Products amount
* $brandsInSearchResult: (object) instance of SBrands
* $pagination: (string) Show pagination
* $tree : (array) All Categories tree.
* $categories: (array). Categories in search results with amount of found products
*
*/
#}
<!-- Get category tree -->
{ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI);}

<!-- Start.Show search results block, if $totalProduct > 0 -->
{if $totalProducts > 0}
    <div id="search" class="container">
        <div class="row">
            <aside class="span3">
                <div class="filter">
                    <!-- Start. Categories tree with navigation -->
                    <div class="boxFilter">
                        <div class="title">{lang('Найдено в категориях','commerce4x')}:</div>
                        <nav>
                            <ul>
                            {foreach $categories as $key => $category}
                                <ul  data-pid="{echo $key}">
                                    <div class="title">
                                        {echo trim(key($category))}
                                    </div>
                                    {foreach $category[key($category)] as $subItem}
                                        <li{if $_GET['category'] && $_GET['category'] == $subItem['id']} class="active"{/if}>
                                            <span>
                                                {if $_GET['category'] && $_GET['category'] == $subItem['id']}
                                                    {echo $subItem['name']}
                                                {else:}
                                                    <a rel="nofollow" data-id="{echo $subItem['id']}" href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem['id'])}"> {echo $subItem['name']}</a>
                                                {/if}
                                                <span class="count">({echo $subItem['count']})</span>
                                            </span>
                                        </li>

                                    {/foreach}
                                </ul>
                            {/foreach}
                        </nav>
                    </div>
                    <!-- End. Categories tree with navigation -->
                </div>
            </aside>
            <div class="span9 right">
                {if !empty(ShopCore::$_GET['text'])}
                    <h1 class="d_i">  {lang('Вы искали','commerce4x')}: "{encode(trim($_GET['text']))}" </h1>
                {/if}
                <span class="c_97">
                    Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('товар','commerce4x'), lang('товара','commerce4x'), lang('товаров','commerce4x')))}
                </span>
                <div class=" clearfix t-a_ccatalog_frame">
                    <div class="clearfix t-a_c frame_func_catalog">
                        <!-- Start. Sort by block -->
                        <form method="get" id="filter" action="">
                            <input type=hidden name="order" value="{echo $order_method}"/>
                            <input type=hidden name="user_per_page" value="{if !$_GET['user_per_page']}{echo \ShopCore::app()->SSettings->frontProductsPerPage}{else:}{echo $_GET['user_per_page']}{/if}"/>
                            <div class="f_l">
                                <span class="v-a_m">Фильтровать по:</span>
                                <div class="lineForm w_170">
                                    <select class="sort" id="sort" name="order">
                                        {$sort =ShopCore::app()->SSettings->getSortingFront()}
                                        {foreach $sort as $s}
                                        <option value="{echo $s['get']}" {if ShopCore::$_GET['order']==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <!-- End. Sort by block -->
                            <!-- Start. Per page block -->
                            <div class="f_r">
                                <span class="v-a_m">{lang('Товаров на странице','commerce4x')}:</span>
                                <div class="lineForm w_70">
                                    {if ShopCore::$_GET['user_per_page'] == null}
                                        {ShopCore::$_GET['user_per_page'] =ShopCore::app()->SSettings->frontProductsPerPage;}
                                    {/if}
                                    <!--                Load settings-->
                                    {$per_page_arr = unserialize(ShopCore::app()->SSettings->arrayFrontProductsPerPage)}
                                    <select id="sort2" name="user_per_page">
                                        {foreach $per_page_arr as $pp}
                                        <option {if $pp == ShopCore::$_GET['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="category" value="{$_GET['category']}">
                            <input type="hidden" name="text" value="{$_GET['text']}">
                        </form>
                        <!-- End. Per page block -->
                        <!-- Start. Buttons for change view mode (list/images) -->
                        <div class="groupButton list_pic_btn">
                            <button type="button" class="btn showAsTable {if $_COOKIE['listtable'] != 1}active{/if}"><span class="icon-cat_pic"></span><span class="text-el">{lang('Таблицей','commerce4x')}</span></button>
                            <button type="button" class="btn showAsList {if $_COOKIE['listtable'] == 1}active{/if}"><span class="icon-cat_list"></span><span class="text-el">{lang('Списком','commerce4x')}</span></button>
                        </div>
                        <!-- End. Buttons for change view mode (list/images) -->
                    </div>
                    <!--Start. Product block -->
                    <ul class="items items_catalog {if $_COOKIE['listtable'] == 1}list{/if}" data-radio-frame>
                        {$Comments = $CI->load->module('comments')->init($products)}
                        {foreach $products as $product}
                        <!-- product block -->
                        <!-- check if product is in stock -->

                        <li class="span3">

                            <!-- product info block -->
                            <div class="description">
                                <div class="frame_response">

                                    <!-- displaying product's rate -->
                                    {$CI->load->module('star_rating')->show_star_rating($product)}

                                    <!-- displaying comments count -->
                                    {if $Comments[$product->getId()][0] != '0' && $product->enable_comments}
                                    <a href="{shop_url('product/'.$product->url.'#comment')}" class="count_response">
                                        {echo $Comments[$product->getId()]}
                                    </a>
                                    {/if}
                                </div>

                                <!-- displaying product name -->
                                <a href="{shop_url('product/'.$product->getUrl())}" class="prodName">{echo ShopCore::encode($product->getName())}</a>
                                <div>
                                    {$hasCode = $product->firstVariant->getNumber() == '';}
                                    <span class="frame_number" {if $hasCode}style="display:none;"{/if}>Артикул: <span class="code">({if !$hasCode}{echo $product->firstVariant->getNumber()}{/if})</span></span>
                                    {$hasVariant = $product->firstVariant->getName() == '';}
                                    <span class="frame_variant_name" {if $hasVariant}style="display:none;"{/if}>Вариант: <span class="code">({if !$hasVariant}{echo $product->firstVariant->getName()}{/if})</span></span>
                                </div>
                                {if $product->hasDiscounts()}
                                <span class="d_b old_price">
                                    <!--
                                    "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                    output price without discount
                                     To display the number of abatement "$model->firstVariant->getNumDiscount()"
                                    -->
                                    <span class="f-w_b priceOrigVariant">{echo $product->firstVariant->toCurrency('OrigPrice')}</span>

                                    {$CS}
                                </span>
                                {/if}
                                <!-- displaying products first variant price and currency symbol -->
                                <div class="price price_f-s_16"><span class="f-w_b priceVariant">{echo $product->firstVariant->toCurrency()}</span> {$CS}&nbsp;&nbsp;<span class="second_cash"></span></div>

                                <div class="f-s_0">
                                    {if count($product->getProductVariants()) > 1}
                                    <div class=" d_i-b v-a_b m-r_20 p-b_10 variantProd">
                                        <div class="lineForm w_170">
                                            <select id="сVariantSwitcher_{echo $product->firstVariant->getId()}" name="variant">
                                                {foreach $product->getProductVariants() as $key => $pv}
                                                {if $pv->getName()}
                                                {$name = ShopCore::encode($pv->getName())}
                                                {else:}
                                                {$name = ShopCore::encode($product->getName())}
                                                {/if}
                                                <option value="{echo $pv->getId()}" title="{echo $name}">
                                                    {echo $name}
                                                </option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    {/if}
                                    <!-- End. Output of all the options -->
                                    <!-- displaying buy button according to its availability in stock -->
                                    <div class="frame_cart_btns d_i-b v-a_b">
                                        <!-- Start. Collect information about Variants, for future processing -->
                                        {foreach $product->getProductVariants() as $key => $pv}
                                        {if $pv->getStock() > 0}
                                        <button {if $key != 0}style="display:none"{/if}
                                            class="btn btn_buy btnBuy variant_{echo $pv->getId()} variant"
                                            type="button"

                                            data-id="{echo $pv->getId()}"
                                            data-prodid="{echo $product->getId()}"
                                            data-varid="{echo $pv->getId()}"
                                            data-price="{echo $pv->toCurrency()}"
                                            data-name="{echo ShopCore::encode($product->getName())}"
                                            data-vname="{echo ShopCore::encode($pv->getName())}"
                                            data-maxcount="{echo $pv->getstock()}"
                                            data-number="{echo $pv->getNumber()}"
                                            data-mediumImage="{echo $pv->getMediumPhoto()}"
                                            data-img="{echo $pv->getSmallPhoto()}"
                                            data-url="{echo shop_url('product/'.$product->getUrl())}"
                                            data-price="{echo $pv->toCurrency()}"
                                            {if trim(ShopCore::encode($pv->getNumber())) != ''} data-number="{echo $pv->getNumber()}"{/if}
                                            data-origprice="{if $product->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                            data-stock="{echo $pv->getStock()}"
                                            >
                                            {lang('Купить','commerce4x')}
                                    </button>
                                    {else:}
                                    <button {if $key != 0}style="display:none"{/if}
                                        data-drop=".drop-report"

                                        data-id="{echo $pv->getId()}"
                                        data-prodid="{echo $product->getId()}"
                                        data-varid="{echo $pv->getId()}"
                                        data-price="{echo $pv->toCurrency()}"
                                        data-name="{echo ShopCore::encode($product->getName())}"
                                        data-vname="{echo ShopCore::encode($pv->getName())}"
                                        data-maxcount="{echo $pv->getstock()}"
                                        data-number="{echo $pv->getNumber()}"
                                        data-mediumImage="{echo $pv->getMediumPhoto()}"
                                        data-img="{echo $pv->getSmallPhoto()}"
                                        data-url="{echo shop_url('product/'.$product->getUrl())}"
                                        data-price="{echo $pv->toCurrency()}"
                                        {if trim(ShopCore::encode($pv->getNumber())) != ''} data-number="{echo $pv->getNumber()}"{/if}
                                        data-origprice="{if $product->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                        data-stock="{echo $pv->getStock()}"

                                        type="button"
                                        class="btn btn_not_avail variant_{echo $pv->getId()} variant">
                                        <span class="icon-but"></span>
                                        <span class="text-el">{lang('Сообщить о появлении','commerce4x')}</span>
                                    </button>
                                    {/if}
                                    {/foreach}
                                </div>
                                <!-- End. Collect information about Variants, for future processing -->


                                <div class="d_i-b v-a_b">

                                    <!-- to compare button -->
                                    <button class="btn btn_small_p toCompare"
                                            data-prodid="{echo $product->getId()}"
                                            type="button"
                                            data-title="{lang('В список сравнений','commerce4x')}"
                                            data-firtitle="{lang('В список сравнений','commerce4x')}"
                                            data-sectitle="{lang('В списке сравнений','commerce4x')}"
                                            data-rel="tooltip">
                                        <span class="icon-comprasion_2"></span>
                                        <span class="text-el">{lang('В список сравнений','commerce4x')}</span>
                                    </button>
{/*}
                                    {foreach $product->getProductVariants() as $key => $pv}
                                    <!-- to wish list button -->
                                    <button  {if $key != 0}style="display:none"{/if} class="btn btn_small_p toWishlist variant_{echo $pv->getId()} variant" 
                                        data-price="{echo $pv->toCurrency()}"
                                        data-prodid="{echo $product->getId()}"
                                        data-varid="{echo $pv->getId()}"
                                        type="button"
                                        data-title="{lang('В список желаний','commerce4x')}"
                                        data-firtitle="{lang('В список желаний','commerce4x')}"
                                        data-sectitle="{lang('В списке желаний','commerce4x')}"
                                        data-rel="tooltip">
                                        <span class="icon-wish_2"></span>
                                        <span class="text-el">{lang('В список желаний','commerce4x')}</span>
                                    </button>
                                    {/foreach}
{ */}
                                </div>
                            </div>
                            <div class="short_description">
                                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                            </div>

                        </div>

                        <!-- displaying products small mod image -->

                        <div class="photo-block">
                            <a href="{shop_url('product/'.$product->getUrl())}" class="photo">
                                <figure>
                                    <span class="helper"></span>
                                    <img src="{echo $product->firstVariant->getMediumPhoto()}"
                                         alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}" class="vimg"/>
                                </figure>
                            </a>
                        </div>

                        <!-- creating hot bubble for products image if product is hot -->
                        {if $product->getHot()}
                            <span class="top_tovar nowelty">{lang("New","admin")}</span>
                        {/if}

                        <!-- creating hot bubble for products image if product is action -->
                        {if $product->getAction()}
                            <span class="top_tovar promotion">{lang("Promotion","admin")}</span>
                        {/if}

                        <!-- creating hot bubble for products image if product is hit -->
                        {if $product->getHit()}
                        <span class="top_tovar discount">{lang('Hit')}</span>
                        {/if}
                    </li>
                    {/foreach}
                    </ul>
                    <!-- End. Product block -->
                    <!--Start. Pagination -->
                    {if $pagination}
                        {$pagination}
                    {/if}
                    <!-- End pagination -->
                    <!-- End. Search results block -->
                </div>
            </div>
        </div>
    </div>
{else:}
    <!--Start. Show message not found-->
    <article id="search" class="container">
        <div class="bot_border_grey m-b_10">
            {if !empty(ShopCore::$_GET['text'])}
                <div class="d_i title_h1">{lang("You searched for","admin")} <span class="alert-small">:"{encode($_GET['text'])}"</span></div>
            {/if}
        </div>
        <div class="alert alert-search-result">
            <div class="title_h2 t-a_c">{echo ShopCore::t(lang("Your search did not match","admin"))}</div>
        </div>
    </article>
    <!-- End. Show message -->
{/if}

{//widget_ajax('view_product', '#search')}
{widget('view_product')}
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
