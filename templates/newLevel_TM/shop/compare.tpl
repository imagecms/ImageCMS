{#
/**
* @file Template for compare products
* @updated 26 February 2013;
* Variables
* $products:(object) instance of SProducts. Products in compare
* $categories: (array). Categories of products which are in compare
* Methods
* ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray(int $category_id): method gives product properties names by category id
* ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray(Sproducts $product): method gives product properties values
*/
#}
<div class="frame-inside page-compare">
    <div class="container">
        <!--Start. Show compare list if count products >0 -->
        {if count($products) > 0}
            <div class="no-empty js-no-empty">
                <!-- Start. Buttons for change to show different or all properties -->
                <div class="f-s_0 title-compare without-crumbs clearfix">
                    <div class="frame-title">
                        <h1 class="d_i title">{lang('Сравнение товаров','newLevel')}</h1>
                    </div>
                    <ul class="tabs groups-buttons tabs-compare-diferent" data-cookie="compare">
                        <li class="btn-def {if $_COOKIE['compare'] == "#all-params" || $_COOKIE['compare'] == NULL}active{/if}">
                            <button type="button" data-href="#all-params">
                                <span class="text-el">{lang('Все параметры','newLevel')}</span>
                            </button>
                        </li>
                        <li class="btn-def {if $_COOKIE['compare'] == "#only-dif"}active{/if}">
                            <button type="button" data-href="#only-dif">
                                <span class="text-el">{lang('Только Различия','newLevel')}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <!-- End. Buttons for change to show different or all properties -->
                <div class="p_r">
                    <!--Start. Show categories of products which are in list -->
                    <!--End. Show categories of products which are in list -->
                    <div class="frame-tabs-ref frame-tabs-compare">
                        {foreach $categories as $key => $category}
                            <div id="tab_{$category[Url]}" class="items-carousel" data-refresh {if $_COOKIE['category'] == '#tab_'.$category[Url] || ($_COOKIE['category'] == NULL && $key == 0)}style="display: block;"{/if}>
                                <div class="left-compare">
                                    <ul>
                                        <li></li>
                                    </ul>
                                    <!--Start.Product properties names -->
                                    <ul class="compare-characteristic">
                                        {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                                        {foreach $data as $d}
                                            <li>
                                                <span class="helper helper-comp"></span>
                                                <span>{echo $d} </span>
                                            </li>
                                        {/foreach}
                                    </ul>
                                    <!--End. Product properties names -->
                                </div>
                                <div class="right-compare horizontal-carousel">
                                    <div class="{/*carousel-js-css*/}">
                                        <div class="content-carousel">
                                            <ul class="items items-compare" id="items-catalog-main">
                                                <!--                                    Start. Show product block with characteristic by category-->
                                                {foreach $products as $p}
                                                    {if $p->category_id == $category['Id']}
                                                        <li class="compare_product_{echo $p->getId()}">
                                                            <!--                                                Start. Include product template-->
                                                            <ul class="items items-catalog">
                                                                {getOPI(array($p), array('opi_compare'=>true, 'opi_wishlist'=>true))}
                                                            </ul>
                                                            <!--                                                End. Include product template-->
                                                            <!--Start. Product characteristics -->
                                                            <ul class="compare-characteristic">
                                                                {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($p)}
                                                                {foreach $data as $d}
                                                                    {$cval = ShopCore::encode($d)}
                                                                    {if is_array($pdata[$cval])}
                                                                        <li>
                                                                            <span class="helper helper-comp"></span>
                                                                            <span>
                                                                                {$i = 0}
                                                                                {foreach $pdata[$cval] as $ms}
                                                                                    {echo $ms}
                                                                                    {if $i<(count($pdata[$cval])-1)}
                                                                                        ,
                                                                                    {/if}
                                                                                    {$i++}
                                                                                {/foreach}
                                                                            </span>
                                                                        </li>
                                                                    {else:}
                                                                        {if $pdata[$cval]}
                                                                            <li>
                                                                                <span class="helper helper-comp"></span>
                                                                                <span>{echo $pdata[$cval]}</span>
                                                                            </li>
                                                                        {else:}
                                                                            <li>
                                                                                <span class="helper helper-comp"></span>
                                                                                <span>-</span>
                                                                            </li>
                                                                        {/if}
                                                                    {/if}
                                                                {/foreach}
                                                            </ul>
                                                            <!--End. Product characteristics -->
                                                        </li>
                                                    {/if}
                                                {/foreach}
                                                <!--                      End. Show product block with characteristic by category-->
                                            </ul>
                                        </div>
                                        <div class="group-button-carousel">
                                            <button type="button" class="prev arrow">
                                                <span class="icon_arrow_p"></span>
                                            </button>
                                            <button type="button" class="next arrow">
                                                <span class="icon_arrow_n"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="comprasion-head">
                        <div class="title-h3">{lang('Категория','newLevel')}:</div>
                        <ul class="tabs tabs-compare-category" data-cookie="category">
                            {foreach $categories as $category}
                                <li {if $_COOKIE['category'] == '#tab_'.$category[Url]}class="active"{/if}>
                                    <button data-href="#tab_{$category[Url]}">
                                        <span class="text-el">{$category[Name]}</span>
                                    </button>
                                </li>
                            {/foreach}
                        </ul>
                        {/*}
                        <div class="lineForm">
                            <select name="compare" id="compare">
                                {foreach $categories as $category}
                                    <option value="#tab_{$category[Url]}">{$category[Name]}</option>
                                {/foreach}
                            </select>
                        </div>
                        { */}
                    </div>
                </div>
            </div>
            <div class="js-empty empty">
                <div class="f-s_0 title-compare without-crumbs clearfix">
                    <div class="frame-title">
                        <h1 class="d_i title">{lang('Сравнение товаров','newLevel')}</h1>
                    </div>
                </div>
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">{lang('Вы удалили все товары из сравнения','newLevel')}</span>
                    </div>
                </div>
            </div>
            <!--End. Show compare list if count products >0 -->
        {else:}
            <div class="f-s_0 title-compare without-crumbs clearfix">
                <div class="frame-title">
                    <h1 class="d_i title">{lang('Cравнения товаров','newLevel')}</h1>
                </div>
            </div>
            <div class="msg layout-highlight layout-highlight-msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">{lang('Список сравнения пуст','newLevel')}</span>
                </div>
            </div>
        {/if}
    </div>
</div>
<script type="text/javascript">
    initDownloadScripts(['jquery.equalhorizcell', 'cusel-min-2.5', 'compare'], '', '');
</script>