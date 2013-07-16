{/*
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
*/}
<!-- Get category tree -->
{ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI);}
<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog" {if !$totalProducts > 0}style="width:100% !important"{/if}>
            {if $totalProducts != 0}
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="d_i"><span class="s-t">Результаты поиска</span> <span class="what-search">«{encode($_GET['text'])}»</span></h1>
                    </div>
                    <span class="count">({$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
                </div>
            {/if}
            {if $totalProducts == 0}
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">По вашему запросу товаров не найдено</span>
                    </div>
                </div>
            {/if}
            {include_tpl('catalogue_header')}
            {if $totalProducts > 0}
                <ul class="animateListItems items items-catalog {if $_COOKIE['listtable'] == 0} list{else:} table{/if}" id="items-catalog-main">
                    {include_tpl('one_product_item')}
                </ul>
            {/if}            <!--Start. Pagination -->
            {if $pagination}
                {$pagination}
            {/if}
            <!-- End pagination -->
        </div>

        {if $totalProducts > 0}
            <div class="left-catalog">
                <form method="GET" action="" id="seacrh_p_form">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <input type="hidden" name="text" value="{echo $_GET[text]}">
                    <input type="hidden" name="category" value="{echo $_GET[category]}">
                    <input type="hidden" name="user_per_page" value="{echo $_GET[user_per_page]}">
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
