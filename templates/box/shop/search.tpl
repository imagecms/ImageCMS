{/*
/**
* @file Template for search results
* @updated 26 February 2013;
* Variables
* $products:(object) instance of SProducts
* $totalProducts: (int) Products amount
* $brandsInSearchResult: (object) instance of SBrands
* $pagination: (string) Show pagination
* $tree : (array) All Categories tree.
* $categories: (array). Categories in search results with amount of found products
*
*/}
<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog" {if !$totalProducts > 0}style="width:100% !important"{/if}>
            {if $totalProducts != 0}
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="title"><span class="s-t">{lang('Результаты поиска','newLevel')}</span> <span class="what-search">«{encode($_GET['text'])}»</span></h1>
                    </div>
                <span class="count">({lang('Найдено','newLevel')} {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))})</span>
                </div>
            {/if}
            {if $totalProducts == 0}
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">{lang('Не найдено товаров','newLevel')}</span>
                    </div>
                </div>
            {/if}
            {include_tpl('catalogue_header')}
            {if $totalProducts > 0}
                <ul class="animateListItems items items-catalog {if $_COOKIE['listtable'] == 'table' || $_COOKIE['listtable'] == NULL} table{else:} list{/if}" id="items-catalog-main">
                    <!-- Include template for one product item-->
                    {$CI->load->module('new_level')->OPI($model, array('opi_wishlist'=>true))}
                </ul>
            {/if}            <!--Start. Pagination -->
            {if $pagination}
                {$pagination}
            {/if}
            <!-- End pagination -->
        </div>

        {if $totalProducts > 0}
            <div class="left-catalog">
                <form method="GET" action="" id="catalogForm">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <input type="hidden" name="text" value="{echo $_GET[text]}">
                    <input type="hidden" name="category" value="{echo $_GET[category]}">
                    <input type="hidden" name="user_per_page" value="{echo $_GET[user_per_page]}">
                </form>
                <div class="frame-category-menu layout-highlight">
                    <div class="title-menu-category">
                        <div class="title-default">
                            <div class="title-h3 title">{lang('Категории','newLevel')}</div>
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
                                                <a rel="nofollow" data-id="{echo $subItem['id']}" href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem['id'])}"><span class="text-el">{echo $subItem['name']}</span> <span class="count">({echo $subItem['count']})</span></a>
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

{ /* }
{count($tree)}
{foreach $tree as $item}
    {if $categories[$item->getId()]}
        <ul data-cid="{echo $item->getId()}" {if $item->getParentId() != 0} data-pid="{echo $item->getParentId()}"{/if}>
            <div class="title">
                {echo trim($item->getName())}
            </div>
            {foreach $item->getSubtree() as $subItem}
                {if $categories[$item->getId()][$subItem->getId()]}
                    <li{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                        {if $_GET['category'] && $_GET['category'] == $subItem->getId()}
                            {echo $subItem->getName()}
                        {else:}
                            <a rel="nofollow" data-id="{echo $subItem->getId()}" href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a>
                        {/if}
                        <span class="count">({echo $categories[$item->getId()][$subItem->getId()]})</span>
                    </li>
                {/if}
            {/foreach}
        </ul>
    {/if}
{/foreach}
{ */ }
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>