{#
/**
* @file - template for displaying shop category page
* Variables
*   $category: (object) instance of SCategory
*       $category->getDescription(): method which returns category description
*       $category->getName(): method which returns category name according to currenct locale
*   $products: PropelObjectCollection of (object)s instance of SProducts
*       $product->firstVariant: variable which contains the first variant of product
*       $product->firstVariant->toCurrency(): method which returns price according to current currencya and format
*   $totalProducts: integer contains products count
*   $pagination: string variable contains html code for displaying pagination
*   $pageNumber: integer variable contains the current page number
*   $banners: array of (object)s of SBanners which have to be displayed in current page
*/
#}

{$Comments = $CI->load->module('comments')->init($products)}
<article>
    <!-- Show Banners in circle -->
    <div class="mainFrameBaner">
        <section class="container">
            {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)}
            {if count($banners)}
                <div class="frame_baner">
                    <ul class="cycle">
                        {foreach $banners as $banner}
                            <li>
                                <a href="{echo $banner['url']}">
                                    <img src="/uploads/shop/banners/{echo $banner['image']}" />
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    <div class="pager"></div>
                    <button class="next" type="button"></button>
                    <button class="prev" type="button"></button>
                </div>
            {/if}
        </section>
    </div>
    <!-- Show banners in circle -->

    <!-- Block for bread crumbs with a call of shop_helper function to create it according to category model -->
    {widget('path')}

    <!-- main category page content -->
    <div class="row">
        <!-- here filter tpl is including -->
        {include_tpl('filter')}

        <!-- catalog container -->
        <div class="span9 right">

            <!-- category title and products count output -->
            <h1 class="d_i">{echo ShopCore::encode($category->getName())}</h1><span class="c_97">{lang('s_found')} {echo $totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}</span>
            <div class="clearfix t-a_c frame_func_catalog">

                <!-- sort block -->
                <div class="f_l">
                    <span class="v-a_m">{lang('s_order_by')}:</span>
                    <div class="lineForm w_170 sort">
                        <select class="sort" id="sort" name="order">
                            <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-{lang('s_no')}-</option>
                            <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                            <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                            <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                            <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                            <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                            <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                        </select>
                    </div>
                </div>

                <!-- products on page count -->
                <div class="f_r">
                    <span class="v-a_m">{lang('s_products_per_page')}:</span>
                    <div class="lineForm w_70 sort">
                        <select class="sort" id="sort2" name="user_per_page">
                            <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                            <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                            <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                            <option value="48" {if ShopCore::$_GET['user_per_page']=='48'}selected="selected"{/if} >48</option>
                        </select>
                    </div>
                </div>

                <!-- selecting product list type -->
                <div class="groupButton list_pic_btn">
                    <button type="button" class="btn showAsTable {if $_COOKIE['listtable'] != 1}active{/if}"><span class="icon-cat_pic"></span><span class="text-el">{lang('s_in_images')}</span></button>
                    <button type="button" class="btn showAsList {if $_COOKIE['listtable'] == 1}active{/if}"><span class="icon-cat_list"></span><span class="text-el">{lang('s_in_list')}</span></button>
                </div>
            </div>

            <!-- displaying category description if page number is 1 -->
            {if $page_number == 1 && $category->getDescription() != '' && $category->getDescription() != ' ' && $category->getDescription() != null}
                <div class="grey-b_r-bord">
                    <p><span style="font-weight:bold">{echo ShopCore::encode($category->getName())}</span> &mdash; {echo $category->getDescription()}</p>
                </div>
            {/if}

            <!-- rendering product list if products count more than 0 -->
            {if count($products)>0}

                <!-- product list container -->
                <ul class="items items_catalog {if $_COOKIE['listtable'] == 1}list{/if}" data-radio-frame>

                    <!-- starts loop for array with products -->
                    {foreach $products as $product}

                        <!-- product block -->
                        <!-- check if product is in stock -->
                        <li class="{if (int)$product->getallstock() == 0}not-avail{/if}span3">

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
                                <a href="{shop_url('product/'.$product->getUrl())}">{echo ShopCore::encode($product->getName())}</a>

                                <!-- displaying products first variant price and currency symbol -->
                                <div class="price price_f-s_16"><span class="f-w_b">{echo $product->firstVariant->toCurrency()}</span> {$CS}&nbsp;&nbsp;<span class="second_cash"></span></div>

                                <!-- displaying buy button according to its availability in stock -->

                                {if (int)$product->getallstock() == 0}

                                    <!-- displaying notify button -->
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
                                        <span class="text-el">{lang('s_message_o_report')}</span>
                                    </button>
                                {else:}

                                    <!-- displaying buy or in cart button -->
                                    <button class="btn btn_buy" type="button"
                                            data-prodid="{echo $product->getId()}"
                                            data-varid="{echo $product->firstVariant->getId()}"
                                            data-price="{echo $product->firstVariant->toCurrency()}"
                                            data-name="{echo ShopCore::encode($product->getName())}"
                                            data-number="{echo $product->firstVariant->getnumber()}"
                                            data-maxcount="{echo $product->firstVariant->getstock()}"
                                            data-vname="{echo $product->firstVariant->getName()}"
                                            >
                                        {lang('s_buy')}
                                    </button>
                                {/if}

                                <div class="d_i-b">

                                    <!-- to compare button -->
                                    <button class="btn btn_small_p toCompare"  
                                            data-prodid="{echo $product->getId()}"  
                                            type="button" 
                                            data-title="{lang('s_add_to_compare')}"
                                            data-sectitle="{lang('s_in_compare')}"
                                            data-rel="tooltip">
                                        <span class="icon-comprasion_2"></span>
                                        <span class="text-el">{lang('s_add_to_compare')}</span>
                                    </button>

                                    <!-- to wish list button -->
                                    <button class="btn btn_small_p toWishlist" 
                                            data-prodid="{echo $product->getId()}" 
                                            data-varid="{echo $product->firstVariant->getId()}"  
                                            type="button" 
                                            data-title="{lang('s_add_to_wish_list')}"
                                            data-sectitle="{lang('s_in_wish_list')}"
                                            data-rel="tooltip">
                                        <span class="icon-wish_2"></span>
                                        <span class="text-el">{lang('s_add_to_wish_list')}</span>
                                    </button>
                                </div>

                                <div class="short_description">
                                    {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                </div>

                            </div>

                            <!-- displaying products small mod image -->
                            <div class="photo-block">
                                <a href="{shop_url('product/'.$product->getUrl())}" class="photo">
                                    <span class="helper"></span>
                                    <figure>
                                        <img src="{productImageUrl($product->getSmallImage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}"/>
                                    </figure>
                                </a>
                            </div>

                            <!-- creating hot bubble for products image if product is hot -->
                            {if $product->getHot()}
                                <span class="top_tovar nowelty">{lang('s_shot')}</span>
                            {/if}

                            <!-- creating hot bubble for products image if product is action -->
                            {if $product->getAction()}
                                <span class="top_tovar promotion">{lang('s_saction')}</span>
                            {/if}

                            <!-- creating hot bubble for products image if product is hit -->
                            {if $product->getHit()}
                                <span class="top_tovar discount">{lang('s_s_hit')}</span>
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            {/if}

            <!-- pagination variable from category.php controller -->
            {$pagination}
        </div>
    </div>

</article>
