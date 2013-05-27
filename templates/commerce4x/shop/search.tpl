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
    <div class="container">
        <div class="row">
            <aside class="span3">
                <div class="filter">
                    <!-- Start. Categories tree with navigation -->
                    <div class="boxFilter">
                        <div class="title">{lang('s_sea_found_in_categories')}:</div>
                        <nav>
                            <ul>
                                {foreach $tree as $item}
                                    <ul data-cid="{echo $item->getId()}" {if $item->getParentId() != 0} data-level="3" data-pid="{echo $item->getParentId()}"{/if}>
                                        {$title=false}
                                        {foreach $item->getSubtree() as $subItem}
                                            {$count_item = $categories[$subItem->getId()];}
                                            {if $count_item}
                                                {if !$title}
                                                    <div class="title">
                                                        {echo trim($item->getName())}
                                                        {$title=true}
                                                    </div>
                                                {/if}
                                                <li{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                                                    <span>
                                                        {if $_GET['category'] && $_GET['category'] == $subItem->getId()}
                                                            {echo $subItem->getName()}
                                                        {else:}
                                                            <a class="filter_by_cat" rel="nofollow" data-id="{echo $subItem->getId()}" href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a>
                                                        {/if}
                                                        <span class="count">({echo $count_item})</span>
                                                    </span>
                                                </li>
                                            {/if}
                                        {/foreach}
                                    </ul>
                                {/foreach}
                            </ul>
                        </nav>
                    </div>
                    <!-- End. Categories tree with navigation -->
                </div>
            </aside>
            <div class="span9 right">
                {if !empty(ShopCore::$_GET['text'])}
                    <h1 class="d_i">  {lang('s_sea_search_for')}: "{encode(trim($_GET['text']))}" </h1>
                {/if}
                <span class="c_97">
                    Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
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
                                        <option value="" {if !$order_method}selected="selected"{/if}>-{lang('s_no')}-</option>
                                        <option value="rating" {if $order_method=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                                        <option value="price" {if $order_method=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                                        <option value="price_desc" {if $order_method=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                                        <option value="hit" {if $order_method=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                                        <option value="hot" {if $order_method=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                                        <option value="action" {if $order_method=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End. Sort by block -->
                            <!-- Start. Per page block -->
                            <div class="f_r">
                                <span class="v-a_m">{lang('s_products_per_page')}:</span>
                                <div class="lineForm w_70">
                                    <select class="sort" id="sort2" name="user_per_page">
                                        <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                                        <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                                        <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                                        <option value="48" {if ShopCore::$_GET['user_per_page']=='48'}selected="selected"{/if} >48</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="category" value="{$_GET['category']}">
                            <input type="hidden" name="text" value="{$_GET['text']}">
                        </form>
                        <!-- End. Per page block -->
                        <!-- Start. Buttons for change view mode (list/images) -->
                        <div class="groupButton list_pic_btn">
                            <button type="button" class="btn showAsTable {if $_COOKIE['listtable'] != 1}active{/if}"><span class="icon-cat_pic"></span><span class="text-el">{lang('s_in_images')}</span></button>
                            <button type="button" class="btn showAsList {if $_COOKIE['listtable'] == 1}active{/if}"><span class="icon-cat_list"></span><span class="text-el">{lang('s_in_list')}</span></button>
                        </div>
                        <!-- End. Buttons for change view mode (list/images) -->
                    </div>

                    <!--Start. Product block -->
                    <ul class="items items_catalog {if $_COOKIE['listtable'] == 1}list{/if}" data-radio-frame>
                        {$Comments = $CI->load->module('comments')->init($products)}
                        {foreach $products as $p}
                            <li class="span3 {if $p->firstvariant->getstock()==0} not_avail{/if}">
                                <div class="description">
                                    <div class="frame_response">
                                        <!-- Start. Star rating and comments count -->
                                        {$CI->load->module('star_rating')->show_star_rating($p)}

                                        {if $Comments[$p->getId()][0] != '0' && $p->enable_comments}
                                            <a href="{shop_url('product/'.$p->url.'#comment')}" class="count_response">
                                                {echo $Comments[$p->getId()]}
                                            </a>
                                        {/if}
                                        <!-- End. Star rating and comments count -->
                                    </div>
                                    <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                    <!-- Start. Price -->
                                    <div class="price price_f-s_16">
                                        <!--$model->hasDiscounts() - checking for the existence of discounts.
                                             If there is a discount price without discount C-->
                                        {if $p->hasDiscounts()}
                                            <span class="d_b old_price">
                                                <span class="f-w_b">{echo $p->firstVariant->toCurrency('OrigPrice')} </span>
                                                {$CS}
                                            </span>
                                        {/if}
                                        <!--If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                                        will display the price already discounted-->
                                        <span class="f-w_b" >{echo $p->firstVariant->toCurrency()} </span>{$CS}
                                    </div>
                                    <!-- End. Price -->
                                    <!--Start. Check amount of goods -->
                                    {if $p->firstvariant->getstock() != 0}
                                        <button class="btn btn_buy btnBuy"
                                                type="button"

                                                data-prodid="{echo $p->getId()}"
                                                data-varid="{echo $p->firstVariant->getId()}"
                                                data-price="{echo $p->firstVariant->toCurrency()}"
                                                data-name="{echo ShopCore::encode($p->getName())}"
                                                data-maxcount="{echo $p->firstVariant->getstock()}"
                                                data-number="{echo $p->firstVariant->getNumber()}"
                                                data-img="{echo $p->firstVariant->getSmallPhoto()}"
                                                data-url="{echo shop_url('product/'.$p->getUrl())}"
                                                data-origPrice="{if $p->hasDiscounts()}{echo $p->firstVariant->toCurrency('OrigPrice')}{/if}"
                                                data-stock="{echo $p->firstVariant->getStock()}"
                                                >
                                            {lang('s_buy')}
                                        </button>
                                    {else:}
                                        <button data-placement="bottom right"
                                                data-place="noinherit"
                                                data-duration="500"
                                                data-effect-off="fadeOut"
                                                data-effect-on="fadeIn"
                                                data-drop=".drop-report"
                                                data-prodid="{echo $p->firstVariant->getId()}"
                                                type="button"
                                                class="btn btn_not_avail">
                                            <span class="icon-but"></span>
                                            <span class="text-el">{lang('s_message_o_report')}</span>
                                        </button>
                                    {/if}
                                    <!-- End. Check amount of goods -->
                                    <!-- Start. Buttons "Add to wish list" and "add to compare" -->
                                    <div class="d_i-b">
                                        <!-- to compare button -->
                                        <button class="btn btn_small_p toCompare"
                                                data-prodid="{echo $p->getId()}"
                                                type="button"
                                                data-title="{lang('s_add_to_compare')}"
                                                data-sectitle="{lang('s_in_compare')}"
                                                data-rel="tooltip">
                                            <span class="icon-comprasion_2"></span>
                                            <span class="text-el">{lang('s_add_to_compare')}</span>
                                        </button>

                                        <!-- to wish list button -->
                                        <button class="btn btn_small_p toWishlist"
                                                data-price="{echo $p->firstVariant->toCurrency()}"
                                                data-prodid="{echo $p->getId()}"
                                                data-varid="{echo $p->firstVariant->getId()}"
                                                type="button"
                                                data-title="{lang('s_add_to_wish_list')}"
                                                data-sectitle="{lang('s_in_wish_list')}"
                                                data-rel="tooltip">
                                            <span class="icon-wish_2"></span>
                                            <span class="text-el">{lang('s_add_to_wish_list')}</span>
                                        </button>
                                    </div>
                                    <!-- End. Buttons -->

                                    <div class="short_description">
                                        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId())}
                                    </div>

                                </div>
                                <!-- Start. Photo block -->
                                <div class="photo-block">
                                    <a class="photo" href="{shop_url('product/' . $p->getUrl())}">
                                        <figure>
                                            <span class="helper"></span>
                                            <img src="{echo $p->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($p->name)} - {echo $p->getId()}" />
                                        </figure>
                                    </a>
                                </div>
                                <!-- End. Photo block -->

                                <!-- creating hot bubble for products image if product is hot -->
                                {if $p->getHot()}
                                    <span class="top_tovar nowelty">{lang('s_shot')}</span>
                                {/if}

                                <!-- creating hot bubble for products image if product is action -->
                                {if $p->getAction()}
                                    <span class="top_tovar promotion">{lang('s_saction')}</span>
                                {/if}

                                <!-- creating hot bubble for products image if product is hit -->
                                {if $p->getHit()}
                                    <span class="top_tovar discount">{lang('s_s_hit')}</span>
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
    <article class="container">
        <div class="bot_border_grey m-b_10">
            {if !empty(ShopCore::$_GET['text'])}
                <div class="d_i title_h1">{lang('s_sea_search_for')} <span class="alert-small">:"{encode($_GET['text'])}"</span></div>
            {/if}
        </div>
        <div class="alert alert-search-result">
            <div class="title_h2 t-a_c">{echo ShopCore::t(lang('s_not_found'))}</div>
        </div>
    </article>
    <!-- End. Show message -->
{/if}

{widget('view_product')}
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
{if widget('view_product') != NULL}
    <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>
{/if}