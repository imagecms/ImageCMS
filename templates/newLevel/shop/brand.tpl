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
                    <h1 class="d_i">{echo $model->getName()}</h1>
                </div>
                <span class="count">(Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
            </div>

            {if $totalProducts == 0}
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">По вашему запросу товаров не найдено</span>
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
                <ul class="animateListItems items items-catalog {if $_COOKIE['listtable'] == 0} list{else:} table{/if}" id="items-catalog-main">
                    {$CI->load->module('new_level')->OPI($model)}
                </ul>
            {/if}
            {$pagination}
        </div>
        {if $totalProducts > 0}
            <div class="left-catalog">
                <form method="GET" action="" id="seacrh_p_form">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <input type="hidden" name="text" value="{$searched_text}">
                    <input type="hidden" name="category" value="{echo $_GET[category]}">
                </form>
                <div class="frame-category-menu layout-highlight">
                    <div class="title-menu-category">
                        <div class="title-default">
                            <div class="title-h3 title">Найдено в категориях:</div>
                        </div>
                    </div>
                    <div class="inside-padd">
                        <nav>
                            {foreach $tree as $item}
                                <div data-cid="{echo $item->getId()}" {if $item->getParentId() != 0} data-pid="{echo $item->getParentId()}"{/if}>
                                    {$title=false}
                                    {foreach $item->getSubtree() as $subItem}
                                        {$count_item = $categories[$subItem->getId()];}
                                        {if $count_item}
                                            {if !$title}
                                                <div class="title">
                                                    {echo trim($item->getName())}
                                                </div>
                                                {$title = true}
                                            {/if}
                                            <div{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                                                {if $_GET['category'] && $_GET['category'] == $subItem->getId()}
                                                    {echo $subItem->getName()}
                                                {else:}
                                                    <a rel="nofollow" data-id="{echo $subItem->getId()}" href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a>
                                                {/if}
                                                <span class="count">({echo $count_item})</span>
                                            </div>
                                        {/if}
                                    {/foreach}
                                </div>
                            {/foreach}
                        </nav>
                    </div>
                </div>
            </div>
        {/if}

    </div>
</div>
