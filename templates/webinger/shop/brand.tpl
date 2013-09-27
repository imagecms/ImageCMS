{# Variables
/**
* @brand.tpl - template for displaying shop brand page
* Variables
*   $products: (object) instance of SProduct
*       $product->firstVariant: variable which contains the first variant of product
*       $product->getStock(): method which returns product availability
*       $product->url(): method which return product url
*       $product->name(): method which return product name
*       $product->getmainimage(): method which return product main image
*       $product->getId(): method which return product id
*
*   $pagination: variale which contains HTML code of page pagination
*
*   $totalProducts: variale which contains total count of products in brand category
*
*   $model: (object) instance of SBrands
*
*   $Comments: array which contains count of comments for each product
*/
#}

{$Comments = $CI->load->module('comments')->init($products)}
<article class="container">
    <div class="row-fluid">
        <aside class="span3">
            {include_tpl('filter')}
        </aside>
        <div class="span9 right">
            <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
            <span class="c_97">
                {lang('Найдено','webinger')} {echo $totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('товар','webinger'), lang('товара','webinger'), lang('товаров','webinger')))}
            </span>
            {if count($products) > 0}
                <div class="clearfix t-a_c frame_func_catalog">

                    <div class="f_l">
                        <span class="v-a_m">{lang('Сортировать по','webinger')}:</span>
                        <div class="lineForm w_170 sort">
                            <select class="sort" id="sort" name="order">
                                {$sort =ShopCore::app()->SSettings->getSortingFront()}
                                {foreach $sort as $s}
                                    <option value="{echo $s['get']}" {if ShopCore::$_GET['order']==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="f_r">

                        <span class="v-a_m">{lang('Товаров на странице','webinger')}:</span>
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

                    <div class="groupButton list_pic_btn">
                        <button type="button" class="btn showAsTable {if $_COOKIE['listtable'] != 1}active{/if}"><span class="icon-cat_pic"></span><span class="text-el">{lang('Таблицей','webinger')}</span></button>
                        <button type="button" class="btn showAsList {if $_COOKIE['listtable'] == 1}active{/if}"><span class="icon-cat_list"></span><span class="text-el">{lang('Списком','webinger')}</span></button>
                    </div>
                </div>
            {/if}
            {if $page_number <= 1 && trim(strip_tags($model->getDescription()))}
                <div class="grey-b_r-bord">
                    <figure class="f_l m-t_10 w_150">
                        <img src="/uploads/shop/brands/{echo $model->getImage()}" alt="{$model->getName()}"/>
                    </figure>
                    {echo $model->getDescription()}
                </div>
            {/if}
            <ul class="items items_catalog {if $_COOKIE['listtable'] == 1}list{/if}" data-radio-frame>
                <!-- Start. Rendering produts list   -->
                {foreach $products as $product}
                    <li class="span3{if $product->getFirstVariant()->getStock() == 0} not_avail{/if}">
                        <div class="description">
                            <div class="frame_response">
                                <!--    Star reiting    -->
                                {$CI->load->module('star_rating')->show_star_rating($product)}
                                <!--    Star reiting    -->
                                {if $Comments[$product->getId()][0] != '0' && $product->enable_comments}

                                    <a href="{shop_url('product/'.$product->url.'#comment')}" class="count_response">

                                        {echo $Comments[$product->getId()]}
                                    </a>
                                {/if}
                            </div>
                            <a href="{shop_url('product/' . $product->geturl())}">{echo ShopCore::encode($product->getname())}</a>
                            <div class="price price_f-s_16">
                                {if $product->hasDiscounts()}
                                    <span class="d_b old_price">
                                        <!--
                                        "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                        output price without discount
                                         To display the number of abatement "$model->firstVariant->getNumDiscount()"
                                        -->
                                        <span class="f-w_b priceOrigVariant">{echo $product->firstVariant->toCurrency('OrigPrice')} </span>
                                        {$CS}

                                    </span>
                                {/if}
                                <span class="f-w_b priceVariant">
                                    {echo $product->firstVariant->toCurrency()}
                                </span>

                                {$CS}&nbsp;&nbsp;
                            </div>
                            {$variants = $product->getProductVariants()}
                    {$cnt = 0}{foreach $variants as $v}{if in_array($v->getId(),$__product_parametr['on'])}{$cnt++}{/if}{/foreach}
                    {if count($variants) > 1 && $cnt > 1}

                        <div class=" d_i-b v-a_b m-r_20 p-b_10 variantProd">
                            <div class="lineForm w_170">
                                <select id="сVariantSwitcher_{echo $product->firstVariant->getId()}" name="variant">
                                    {foreach $variants as $key => $pv}
                                        {if in_array($pv->getId(),$__product_parametr['on'])}
                                            {if $pv->getName()}
                                                {$name = ShopCore::encode($pv->getName())}
                                            {else:}
                                                {$name = ShopCore::encode($product->getName())}
                                            {/if}
                                            <option value="{echo $pv->getId()}" title="{echo $name}">
                                                {echo $name}
                                            </option>
                                        {/if}

                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    {/if}
                    <!-- displaying buy button according to its availability in stock -->
                    <div class="frame_cart_btns d_i-b v-a_b">
                        <!-- Start. Collect information about Variants, for future processing -->
                        {foreach $product->getProductVariants() as $key => $pv}
                            {if $pv->getStock() > 0}
                                <div {if $key != 0}style="display:none;"{/if} class="variant_{echo $pv->getId()} variant">{if in_array($pv->getId(),$__product_parametr['in_stock'])}<span class="is_available"><span class="icon-available"></span><span>{lang('Есть в наличии', 'webinger')}</span></span>{else:}<span class="under_order"><span class="icon-under_order"></span><span>{lang('Товар под заказ', 'webinger')}</span></span>{/if}</div>
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
                            {if in_array($pv->getId(),$__product_parametr['in_stock'])}{lang('Купить','webinger')}{else:}Заказать{/if}
                        </button>
                        
                    {else:}
                        <button {if $key != 0}style="display:none"{/if}
                                              data-placement="noinherit"
                                              data-place="center"
                                              data-duration="500"
                                              data-effect-off=    "fadeOut"
                                              data-effect-on="fadeIn"
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
                            <span class="text-el">{lang('Сообщить о появлении','webinger')}</span>
                        </button>
                    {/if}
                {/foreach}
            </div>
            <!-- End. Collect information about Variants, for future processing -->

            <div class="d_i-b">
                <!-- to compare button -->

                <button class="btn btn_small_p toCompare"
                        data-prodid="{echo $product->getId()}"
                        type="button"

                        data-title="{lang('В список сравнений','webinger')}"
                        data-sectitle="{lang('В списке сравнений','webinger')}"
                        data-rel="tooltip">
                    <span class="icon-comprasion_2"></span>
                    <span class="text-el">{lang('В список сравнений','webinger')}</span>
                </button>
                <!-- to wish list button -->

                <button class="btn btn_small_p toWishlist"
                        data-price="{echo $product->firstVariant->toCurrency()}"
                        data-prodid="{echo $product->getId()}"
                        data-varid="{echo $product->firstVariant->getId()}"
                        type="button"

                        data-title="{lang('В список желаний','webinger')}"
                        data-sectitle="{lang('В списке желаний','webinger')}"
                        data-rel="tooltip">
                    <span class="icon-wish_2"></span>
                    <span class="text-el">{lang('В список желаний','webinger')}</span>
                </button>
            </div>

            <div class="photo-block">
                <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                    <figure>
                        <span class="helper"></span>
                        <img src="{echo $product->firstVariant->getMediumPhoto()}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getid()}" class="vimg"/>
                    </figure>
                </a>
            </div>

    </li>
{/foreach}
<!--  End. Rendering produts list   -->
</ul>
<!--  Start pagination    -->
{$pagination}
<!--  End pagination    -->
</div>
</div>
</article>

{widget('view_product')}

<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
