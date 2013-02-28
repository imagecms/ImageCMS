{#
/**
* @file Template for search results
* @updated 26 February 2013;
* Variables
* $products:(оbject) instance of SProducts
* $cart_data: Array of products in cart  
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
    <div class="row">
        <aside class="span3">
            <div class="filter">
                <!-- Start. Categories tree with navigation -->
                <div class="boxFilter">
                    <div class="title">{lang('s_sea_found_in_categories')}:</div>
                    <nav>
                        <ul>
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
                                                    <span>
                                                        {if $_GET['category'] && $_GET['category'] == $subItem->getId()}
                                                            {echo $subItem->getName()}
                                                        {else:}
                                                            <a href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a>     
                                                        {/if}
                                                        <span class="count">({echo $count_item})</span>
                                                    </span>
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
                <!-- End. Categories tree with navigation -->
            </div>
        </aside>
        <div class="span9 right">
            {if !empty(ShopCore::$_GET['text'])}
                <h1 class="d_i">  {lang('s_sea_search_for')}:"{encode($_GET['text'])}" </h1>
            {/if}
            <span class="c_97">
                ({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
            </span>
            <div class=" clearfix t-a_ccatalog_frame">
                <div class="clearfix t-a_c frame_func_catalog">
                    <!-- Start. Sort by block -->
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
                    <!-- End. Sort by block -->
                    <!-- Start. Per page block -->
                    <div class="f_r">
                        <span class="v-a_m">{lang('s_products_per_page')}:</span>
                        <div class="lineForm w_70">
                            <select class="sort" id="sort2" name="order2">
                                <option selected="selected" value="1">20</option>
                                <option value="2">40</option>
                                <option value="3">60</option>
                                <option value="4">80</option>
                            </select>
                        </div>
                    </div>
                    <!-- End. Per page block -->
                    <!-- Start. Buttons for change view mode (list/images) -->
                    <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                        <button type="button" class="btn active"><span class="icon-cat_pic"></span>{lang('s_in_images')}</button>
                        <button type="button" class="btn"><span class="icon-cat_list"></span>{lang('s_in_list')}</button>
                    </div>
                    <!-- End. Buttons for change view mode (list/images) -->
                </div>

                <!--Start. Product block -->
                <ul class="items items_catalog" data-radio-frame>
                    {$Comments = $CI->load->module('comments')->init($products)}
                    {foreach $products as $p}
                        <li class="span3 {if $p->firstvariant->getstock()==0} not-avail{/if}">
                            <div class="description">
                                <div class="frame_response">
                                    <!-- Start. Star rating and comments count -->
                                    {$CI->load->module('star_rating')->show_star_rating($p)}
                                    {echo $Comments[$p->getId()]}
                                    <!-- End. Star rating and comments count --> 
                                </div>
                                <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                <!-- Start. Price -->
                                <div class="price price_f-s_16">
                                    <!--$model->hasDiscounts() - checking for the existence of discounts. 
                                         If there is a discount price without discount C-->
                                    {if $p->hasDiscounts()}
                                        <span class="d_b old_price">
                                            <span class="f-w_b">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                            {$CS}
                                        </span>                           
                                    {/if}
                                    <!--If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                                    will display the price already discounted-->
                                    <span class="f-w_b" >{echo $p->firstVariant->toCurrency()}</span>{$CS}
                                </div>
                                <!-- End. Price -->
                                <!--Start. Check amount of goods -->
                                {if $p->firstvariant->getstock() != 0}
                                    <button class="btn btn_buy" 
                                            type="button" 
                                            data-prodId="{echo $p->getId()}" 
                                            data-varId="{echo $p->firstVariant->getId()}" 
                                            data-price="{echo $p->firstVariant->toCurrency()}" 
                                            data-name="{echo $p->getName()}">
                                        {lang('add_to_basket')}
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
                                        {lang('s_message_o_report')}
                                    </button>
                                {/if} 
                                <!-- End. Check amount of goods -->   
                                <!-- Start. Buttons "Add to wish list" and "add to compare" -->
                                <div class="d_i-b">
                                    <!-- to compare button -->
                                    <button class="btn btn_small_p toCompare"  
                                            data-prodid="{echo $p->getId()}"  
                                            type="button" 
                                            title="{lang('s_add_to_compare')}">
                                        <span class="icon-comprasion_2"></span>
                                    </button>

                                    <!-- to wish list button -->
                                    <button class="btn btn_small_p toWishlist" 
                                            data-prodid="{echo $p->getId()}" 
                                            data-varid="{echo $p->firstVariant->getId()}"  
                                            type="button" 
                                            title="{lang('s_add_to_wish_list')}">
                                        <span class="icon-wish_2"></span>
                                    </button>
                                </div>
                                <!-- End. Buttons -->
                            </div>
                            <!-- Start. Photo block -->
                            <a class="photo" href="{shop_url('product/' . $p->getUrl())}">
                                <span class="helper"></span>
                                <figure>
                                    <img src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->name)} - {echo $p->getId()}" />
                                </figure>
                            </a>
                            <!-- End. Photo block -->
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
            {else:}
                <!-- Start.If products not found show message-->
                <div class="row" >
                    <aside class="span3">
                        <div class="filter">
                            <div class="boxFilter">
                                <div class="title">{lang('s_sea_found_in_categories')}:</div>
                            </div>
                        </div>
                    </aside>
                    <div class="span9 right" style="padding-top:15px;">
                        <div class="bot_border_grey">     
                            {if !empty(ShopCore::$_GET['text'])}
                                <h1 class="d_i">  {lang('s_sea_search_for')}:"{encode($_GET['text'])}" </h1>
                            {/if}
                            <span class="c_97 ">
                                ({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
                            </span>
                        </div>    
                        <div class="span9 right" style="padding-top:15px;">
                            {echo ShopCore::t(lang('s_not_found'))}</li>
                        </div>
                    </div>
                </div>
                <!-- End. Show message -->
            {/if}
        </div>
    </div>
</div>