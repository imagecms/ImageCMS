{/*
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
*/}
<!-- Get category tree -->
{ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI);}
<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog" {if !$totalProducts > 0}style="width:100% !important"{/if}>
            <div class="f-s_0 title-category">
                <div class="frame-title">
                    <h1 class="title">{echo $model->getName()}</h1>
                </div>
                <span class="count">({lang('Найдено','newLevelVertical')} {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('товар','newLevelVertical'),lang('товара','newLevelVertical'),lang('товаров','newLevelVertical')))})</span>
            </div>
            {if $totalProducts == 0}
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">{lang('По вашему запросу товаров не найдено','newLevelVertical')}</span>
                    </div>
                </div>
            {/if}

            {include_tpl('catalogue_header')}

            <!--Start. Show brand description if $CI->uri->segment(2) == "brand" and description is not empty-->
            {if $model->getImage() && trim($model->getDescription()) != ""}
                <div class="frame-category-brand">
                    <ul class="item-brand-category items inside-padd">
                        <li>
                            {if $model->getDescription()}
                                {if $model->getImage()}
                                    <span class="photo-block f_l">
                                        <span class="helper"></span>
                                        <img src="/uploads/shop/brands/{echo $model->getImage()}"/>
                                    </span>
                                {/if}
                                <div class="description">
                                    <h2>{echo $model->getName()}</h2>
                                    {echo $model->getDescription()}
                                </div>
                            {/if}
                        </li>
                    </ul>
                </div>
            {/if}
            <!--End. Show brand description-->

            {if $totalProducts > 0}
                <ul class="animateListItems items items-catalog items-product {if $_COOKIE['listtable'] == 'table' || $_COOKIE['listtable'] == NULL} table{else:} list{/if}" id="items-catalog-main">
                    {getOPI($products, array('opi_wishlist'=>true, 'opi_codeArticle' => true))}
                </ul>
            {/if}
            {$pagination}
        </div>
        {if $totalProducts > 0}
            <div class="left-catalog">
                <form method="GET" action="" id="catalogForm">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <input type="hidden" name="user_per_page" value="{echo $_GET[user_per_page]}">
                </form>
                <div class="frame-category-menu layout-highlight">
                    <div class="title-menu-category">
                        <div class="title-default">
                            <div class="title-h3 title">{lang('Найдено в категориях:','newLevelVertical')}</div>
                        </div>
                    </div>
                    <div class="inside-padd">
                        <nav>
                            {foreach $categories as $key => $category}
                                <ul class="nav nav-vertical nav-category">
                                    <li>
                                        <span>{echo trim(key($category))}</span>
                                    </li>
                                    {foreach $category[key($category)] as $subItem}
                                        {if $_GET['category'] && $_GET['category'] == $subItem['id']}
                                            <li class="active">
                                                <span>{echo $subItem['name']}</span>
                                            {else:}
                                            <li>
                                                <a rel="nofollow" data-id="{echo $subItem['id']}"
                                                   {if $_SERVER['QUERY_STRING']}
                                                        href="{shop_url('brand/'. strtolower($model->getUrl()).'/'.$subItem['id'].'?'.$_SERVER['QUERY_STRING'])}"
                                                   {else:}
                                                        href="{shop_url('brand/'. strtolower($model->getUrl()).'/'.$subItem['id'])}"
                                                   {/if}
                                                 >
                                                        <span class="text-el">{echo $subItem['name']}</span>
                                                        <span class="count">({echo $subItem['count']})</span>
                                                </a>
                                            {/if}
                                        </li>
                                    {/foreach}
                                </ul>
                            {/foreach}
                        </nav>
                    </div>
                </div>
            </div>
        {/if}

    </div>
</div>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>