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

<div class="frame-crumbs">
    <div class="container">
        {widget('path')}
    </div>
</div>

<div class="frame-inside">
    <div class="container">
        <div class="right-catalog">
            <div class="f-s_0 title-head-ategory">
                <div class="d_i m-r_15">
                    <h1 class="d_i">{echo $category->getName()}</h1>
                </div>
                {if $totalProducts > 0}
                <span class="count">(Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
                {/if}
            </div>
            <!--Start. Banners block-->
            {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)}
            {if count($banners)}
            <div class="frame_baner">
                <section class="carousel_js baner container">
                    <div class="content-carousel">
                        <ul class="cycle">
                            {foreach $banners as $banner}
                            <li>
                                {if trim($banner['url']) != ""}
                                <a href="{echo $banner['url']}">
                                    <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                                </a>
                                {else:}
                                <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                                {/if}
                            </li>
                            {/foreach}
                        </ul>
                        <button type="button" class="prev arrow"></button>
                        <button type="button" class="next arrow"></button>
                    </div>
                </section>
            </div>
            {/if}
            <!--End. Banners-->
            {include_tpl('catalogue_header')}
            {if count($products) > 0}
            <ul class="items items-catalog {if $_COOKIE['listtable'] == 1} list{else:} table{/if}" id="items-catalog-main">
                <!--                    include template for one product item-->
                {include_tpl('one_product_item')}
            </ul>
            <!--                render pagination-->
            {$pagination}
            {else:}
            <!--                Start. Empty category-->
            <div class="alert alert-search-result">
                <div class="title_h2 t-a_c">По вашему запросу товаров не найдено</div>
            </div>
            <!--            End. Empty category-->
            {/if}
        </div>
        <div class="filter">
            <!--        Load filter-->
            {$CI->load->module('smart_filter')->init()}
        </div>
    </div>
    <!--widget for popular products in this category-->
    {widget('popular_products')}
</div>