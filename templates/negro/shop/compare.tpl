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
<div class="frame-inside">
    <div class="container">
        <!--Start. Show compare list if count products >0 -->
        {if count($products) > 0}
             <!-- Start. Buttons for change to show different or all properties -->
             <div class="clearfix frame-catalog-view">
                <div class="title_h1 f_l">Сравнение товаров</div>
                <ul class="tabs groups-buttons f_l m-l_50">
                    <li class="active btn"><button type="button" data-href="#all-params">{lang('s_all_par')}</button></li>
                    <li class="btn"><button type="button" data-href="#only-dif">{lang('s_only_diff')}</button></li>
                </ul>
            </div>
            <!-- End. Buttons for change to show different or all properties -->
            <div class="p_r">
                 <!--Start. Show categories of products which are in list -->
                <div class="comprasion_head">
                    <div class="title_h2">Категория:</div>
                    <ul class="tabs tabs-comprasion">
                        {foreach $categories as $category}
                            <li><button data-href="#tab_{$category[Url]}"><span class="d_l_b">{$category[Name]}</span></button></li>
                        {/foreach}
                    </ul>
                </div>
                <!--End. Show categories of products which are in list -->
                <div class="frame-tabs-ref comprasion-frame-tabs">
                    <!-- 1-st category -->
                    {foreach $categories as $category}
                        <div id="tab_{$category[Url]}" class="categoryCompareBlock" data-refresh>
                            <div class="leftDescription">
                                <ul>
                                    <li style="height: 350px;"></li>
                                </ul>
                                 <!--Start.Product properties names -->
                                <ul class="characteristic">
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
                            <div class="rightDescription">
                                <ul class="comprasion_tovars_frame" id="items-catalog-main">
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
                                                <ul class="characteristic">
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
                        </div>
                    {/foreach}
                </div>
            </div>
            <!--End. Show compare list if count products >0 -->
        {else:}
            <div class="title_h2">Список сравнений пуст</div>
        {/if}
    </div>
</div>