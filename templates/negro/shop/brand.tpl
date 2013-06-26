<div class="frame-crumbs">
    <div class="container">
        {widget('path')}
    </div>
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

            {if count($products) == 0}
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el">По вашему запросу товаров не найдено</span>
                    </div>
                </div>
            {/if}

            {include_tpl('catalogue_header')}

            {if count($products) > 0}
                <ul class="items items-catalog {if $_COOKIE['listtable'] == 1}list{/if}" id="items-catalog-main">
                    {include_tpl('one_product_item')}
                </ul>
            {/if}
            {$pagination}
        </div>
        {if $totalProducts > 0}
            <div class="left-catalog filter">
                <form method="GET" action="" id="seacrh_p_form">
                    <input type="hidden" name="order" value="{echo $_GET[order]}" />
                    <input type="hidden" name="text" value="{$searched_text}">
                    <input type="hidden" name="category" value="{echo $_GET[category]}">
                </form>
                {$cat = searchResultsInCategories($tree, $incats)}
                <div class="block-filter">
                    <div class="title-h3">Категории</div>
                    <div class="inside-padd">
                        {foreach $cat[0] as $key_0 => $item_0}
                            {if $item_0[childs] > 0 || $item_0[count] > 0}
                                <div class="title-h4">{$item_0[name]}</div>
                                <nav>
                                    <ul class="search-result">
                                        {foreach $cat[$key_0] as $key_1 => $item_1}
                                            {if $item_1[childs] > 0 || $item_1[count] > 0}
                                                <li {if $key_1 == $_GET['category']}class="active"{/if}>
                                                    {if $item_1[count] > 0}
                                                        <span><a href="{shop_url('brand/'.$model->getUrl().'?category='.$key_1)}">{$item_1[name]} <span class="count">({$item_1[count]})</span></a></span>
                                                    {else:}
                                                        <span>{$item_1[name]}</span>
                                                    {/if}
                                                    {if $item_1[childs] > 0}
                                                        <ul class="search-result">
                                                            {foreach $cat[$key_1] as $key_2 => $item_2}
                                                                {if $key_2 == $_GET['category']}
                                                                    <li class="active"><span>{$item_2[name]}</span></li>
                                                                        {else:}
                                                                    <li><a href="{shop_url('brand/'.$model->getUrl().'?category='.$key_2)}">{$item_2[name]} <span class="count">({$item_2[count]})</span></a></li>
                                                                    {/if}
                                                                {/foreach}
                                                        </ul>
                                                    {/if}
                                                </li>
                                            {/if}
                                        {/foreach}
                                    </ul>
                                </nav>
                            {/if}
                        {/foreach}
                    </div>
                </div>

            </div>
        {/if}

    </div>
</div>
