{#
/**
* @file Template for compare products
* @updated 26 February 2013;
* Variables
* $products:(оbject) instance of SProducts. Products in compare
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
            <!-- Start. Buttons for change to show different or all properties -->
            <div class="header-compare">
                <div class="">Сравнение товаров</div>
                <ul class="tabs">
                    <li class="active"><button type="button" data-href="#all-params">{lang('s_all_par')}</button></li>
                    <li><button type="button" data-href="#only-dif">{lang('s_only_diff')}</button></li>
                </ul>
            </div>
            <!-- End. Buttons for change to show different or all properties -->
            <div class="p_r">
                <!--Start. Show categories of products which are in list -->
                <div class="comprasion-head">
                    <div class="title">Категория:</div>
                    <ul class="tabs tabs-comprasion">
                        {foreach $categories as $category}
                            <li><button data-href="#tab_{$category[Url]}">{$category[Name]}</button></li>
                            {/foreach}
                    </ul>
                </div>
                <!--End. Show categories of products which are in list -->
                <div class="frame-tabs-ref frame-tabs-compare horizontal-carousel">
                    <!-- 1-st category -->
                    {foreach $categories as $category}
                        <div id="tab_{$category[Url]}" class="categoryCompareBlock" data-refresh>
                            <div class="left-compare">
                                <ul>
                                    <li></li>
                                </ul>
                                <!--Start.Product properties names -->
                                <ul class="compare-characteristic">
                                    {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                                    {foreach $data as $d}
                                        <li>
                                            <span class="helper"></span>
                                            <span>{echo $d} </span>
                                        </li>
                                    {/foreach}
                                </ul>
                                <!--End. Product properties names -->
                            </div>
                            <div class="right-compare">
                                {/*if carousel_js*/}
                                <div class="content-carousel">
                                    <ul class="items items-compare" id="items-catalog-main">
                                        <!--                                    Start. Show product block with characteristic by category-->
                                        {foreach $products as $p}
                                            {if $p->category_id == $category['Id']}
                                                {$promos[0] = $p}
                                                {$CI->template->assign('promos',$promos)}
                                                <li class="compare_product_{echo $p->getId()}">
                                                    <!--                                                Start. Include product template-->
                                                    <ul class="items items-catalog">
                                                        {include_tpl('one_product_item')}
                                                    </ul>
                                                    <!--                                                End. Include product template-->
                                                    <!--Start. Product characteristics -->
                                                    <ul class="compare-characteristic">
                                                        {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($p)}
                                                        {foreach $data as $d}
                                                            {$cval = ShopCore::encode($d)}
                                                            {if is_array($pdata[$cval])}
                                                                <li>
                                                                    <span class="helper"></span>
                                                                    <span>
                                                                        {$i = 0}
                                                                        {foreach $pdata[$cval] as $ms}
                                                                            {echo $ms}
                                                                        {if $i<(count($pdata[$cval])-1)},{/if}
                                                                        {$i++}
                                                                    {/foreach}
                                                                </span>
                                                            </li>
                                                        {else:}
                                                            {if $pdata[$cval]}
                                                                <li>
                                                                    <span class="helper"></span>
                                                                    <span>{echo $pdata[$cval]}</span>
                                                                </li>
                                                            {else:}
                                                                <li>
                                                                    <span class="helper"></span>
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
                {/foreach}
            </div>
        </div>
        <!--End. Show compare list if count products >0 -->
    {else:}
        <div class="title">Список сравнений пуст</div>
    {/if}
</div>
</div>