<div class="frame-crumbs">
</div>
<div class="frame-inside">
    <div class="container">
        {if count($products) > 0}
            <div class="clearfix frame-catalog-view">
                <div class="title_h1 f_l">Сравнение товаров</div>
                <ul class="tabs groups-buttons f_l m-l_50">
                    <li>
                        <button data-href="#all-params">
                            Все параметры
                        </button>
                    </li>
                    <li>
                        <button data-href="#only-dif">
                            Только отличия
                        </button>
                    </li>
                </ul>
            </div>
            <div class="p_r">
                <div class="comprasion_head">
                    <div class="title_h2">Категория:</div>
                    <ul class="tabs tabs-comprasion">
                        {foreach $categories as $category}
                            <li><button data-href="#tab_{$category[Url]}"><span class="d_l_b">{$category[Name]}</span></button></li>
                        {/foreach}
                    </ul>
                </div>
                <div class="frame-tabs-ref comprasion-frame-tabs">
                    <!-- 1-st category -->
                    {foreach $categories as $category}
                        <div id="tab_{$category[Url]}" class="categoryCompareBlock" data-refresh>
                            <div class="leftDescription">
                                <ul>
                                    <li></li>
                                </ul>
                                <ul class="characteristic">
                                    {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                                    {foreach $data as $d}
                                        <li>
                                            <span class="helper"></span>
                                            <span>{$d}</span>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                            <div class="rightDescription">
                                <ul class="comprasion_tovars_frame" id="items-catalog-main">
                                    {foreach $products as $p}
                                        {if $p->category_id != $category['Id']}
                                            {continue;}
                                        {else:}
                                            {$promos[0] = $p}
                                            {$CI->template->assign('promos',$promos)}
                                        {/if}
                                        <li class="compare_product_{echo $p->getId()}">
                                            <ul class="items-catalog">
                                                {include_tpl('one_product_item')}
                                            </ul>
                                            <ul class="characteristic">
                                                {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($p)}
                                                {$cnt = 1}   
                                                {foreach $data as $d}
                                                    {$cval = ShopCore::encode($d)}
                                                    <li>
                                                        <span class="helper"></span>
                                                        <span>
                                                            {if count($pdata[$cval]) > 1}
                                                                {$i = 0}
                                                                {foreach $pdata[$cval] as $ms}
                                                                    {echo $ms}
                                                                    {if $i<(count($pdata[$cval])-1)}
                                                                        ,
                                                                    {/if}
                                                                    {$i++}
                                                                {/foreach}
                                                            {else:}
                                                                {if $pdata[$cval]} 
                                                                    {echo $pdata[$cval]} 
                                                                {else:} 
                                                                    - 
                                                                {/if}
                                                            {/if}
                                                        </span>
                                                    </li>
                                                {/foreach}                                                
                                            </ul>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                        </div>
                    {/foreach}
                    <!-- end of 1-st category -->

                </div>
            </div>
        {else:}
            <div class="title_h2">Список сравнений пуст</div>
        {/if}
    </div>
</div>