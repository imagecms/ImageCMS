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
*   $page_number: integer variable contains the current page number
*   $banners: array of (object)s of SBanners which have to be displayed in current page
*/
#}

{$Comments = $CI->load->module('comments')->init($products)}
<article class="container">
    <!-- Show Banners in circle -->

        {$CI->load->module('banners')->render($category->getId())}

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
            <h1 class="d_i">{echo $title}</h1>
            {if count($products)>0}
                <span class="c_97">{lang("Found","admin")} {echo $totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang("product","admin"), lang("product","admin"), lang("product","admin")))}</span>
                <div class="clearfix t-a_c frame_func_catalog">
                    <!-- sort block -->
                    <div class="f_l">
                        <span class="v-a_m">{lang("Order by","admin")}:</span>
                        <div class="lineForm w_170 sort">
                            <select class="sort" id="sort" name="order">
                                {$sort =ShopCore::app()->SSettings->getSortingFront()}
                                {foreach $sort as $s}
                                    <option value="{echo $s['get']}" {if $order_method==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <!-- products on page count -->
                    <div class="f_r">
                        <span class="v-a_m">{lang("Products per page","admin")}:</span>
                        <div class="lineForm w_70 sort">
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


                    <!-- selecting product list type -->
                    <div class="groupButton list_pic_btn">
                        <button type="button" class="btn showAsTable {if $_COOKIE['listtable'] != 1}active{/if}"><span class="icon-cat_pic"></span><span class="text-el">{lang("Image view","admin")}</span></button>
                        <button type="button" class="btn showAsList {if $_COOKIE['listtable'] == 1}active{/if}"><span class="icon-cat_list"></span><span class="text-el">{lang("List view","admin")}</span></button>
                    </div>
                </div>

                <!-- displaying category description if page number is 1 -->
                {if $page_number <= 1 && trim(strip_tags($category->getDescription()))}
                    <div class="grey-b_r-bord">
                        <p><span style="font-weight:bold">{echo ShopCore::encode($category->getName())}</span> &mdash; {echo $category->getDescription()}</p>
                    </div>
                {/if}

                <!-- rendering product list if products count more than 0 -->


                <!-- product list container -->
                <ul class="items items_catalog {if $_COOKIE['listtable'] == 1}list{/if}" data-radio-frame>

                    <!-- starts loop for array with products -->
                    {foreach $products as $product}
                        {$desc = $product->getShortDescription()}
                        <!-- product block -->
                        <!-- check if product is in stock -->
                        <li class="{if (int)$product->getallstock() == 0}not_avail{/if} span3">

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
                                    {$variants = $product->getProductVariants()}
                                    {if count($variants) > 1}
                                        <div class=" d_i-b v-a_b m-r_20 p-b_10 variantProd">
                                            <div class="lineForm w_170">
                                                <select id="сVariantSwitcher_{echo $product->firstVariant->getId()}" name="variant">
                                                    {foreach $variants as $key => $pv}
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
                                        {foreach $variants as $key => $pv}
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
                                                                      data-number="{echo $pv->getNumber()}"
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
                                                                      data-number="{echo $pv->getNumber()}"
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
                                        {$CI->load->module('wishlist')->renderWLButton($product->firstvariant->getId())}
                                        {foreach $variants as $key => $pv}
                                            <!-- to wish list button -->
                                            <button {if $key != 0}style="display:none"{/if} class="btn btn_small_p toWishlist variant_{echo $pv->getId()} variant"
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
                                    {if $desc}
                                        {echo strip_tags($desc)}
                                    {else:}
                                        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                    {/if}
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
            {else:}
                <div class="alert alert-search-result">
                    <div class="title_h2 t-a_c">Категория пуста</div>
                </div>
            {/if}
            <!-- pagination variable from category.php controller -->
            {$pagination}
        </div>
    </div>

</article>

{//widget_ajax('view_product' , 'article.container')}
{widget('view_product')}

<script type="text/javascript" src="{$THEME}js/jquery.cycle.all.min.js"></script>

<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
