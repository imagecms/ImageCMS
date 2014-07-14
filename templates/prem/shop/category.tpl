{/*
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
*/}

<div class="frame-inside page-category">
    <div class="container">
        <form method="GET" action="" id="catalogForm">
            <input type="hidden" name="order" value="{echo $_GET[order]}" />
            <input type="hidden" name="text" value="{echo $_GET[text]}">
            <input type="hidden" name="category" value="{echo $_GET[category]}">
            <input type="hidden" name="user_per_page" value="{echo $_GET[user_per_page]}">
        </form>
        <div class="catalog">
            <!-- Start. Category name and count products in category-->
            <div class="f-s_0 title-category">
                <h1 class="title">{echo $title}</h1>
            </div>
            <div class="description-category">{echo $category->getDescription()}</div>
            <!-- End. Category name and count products in category-->
            {if $totalProducts == 0}
                <!-- Start. Empty category-->
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">{lang('Не найдено товаров','newLevel')}</span>
                    </div>
                </div>
                <!-- End. Empty category-->
            {/if}
            {include_tpl('catalogue_header')}
            <!-- Start.If count products in category > 0 then show products list and pagination links -->
            {if $totalProducts > 0}
                <ul class="animateListItems items items-catalog items-product {if $_COOKIE['listtable'] == 'table' || $_COOKIE['listtable'] == NULL} table{else:} list{/if}" id="items-catalog-main">
                    <!-- Include template for one product item-->
                    {getOPI($model, array('opi_wishlist'=>true, 'opi_codeArticle' => true))}
                </ul>
                <!-- render pagination-->
                {$pagination}
            {/if}
            <!-- End.If count products in category > 0 then show products and pagination links -->
        </div>
        <!--widget for popular products in this category-->
    </div>
</div>
<div class="frame-add-stimulation">
    <div class="container">
        <div class="title-h1">{lang('Начните бесплатно, без риска, 14-дневная пробная!', 'newLevel')}</div>
        <div class="sub-title">{lang('Пробная версия 14 дней абсолютно бесплатн', 'newLevel')}о</div>
        <div class="btn-create-shop2 big">
            <a href="#">
                <span class="text-el">{lang('Создать магазин сейчас!', 'newLevel')}</span>
            </a>
        </div>
    </div>
</div>