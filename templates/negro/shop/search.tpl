<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/category.js"></script>
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs(0, " / ", "Поиск")}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog" {if !$totalProducts > 0}style="width:100% !important"{/if}>
            <div class="f-s_0 title-head-ategory">
                <div class="d_i m-r_15">
                    <div class="d_i title_h1">Вы искали: <span class="alert-small">«{$searched_text}»</span></div>
                </div>
                {if $totalProducts > 0}
                    <span class="count">(Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
                {/if}
            </div>
            
            {include_tpl('catalogue_header')}
            
            {if count($products) > 0}
                <ul class="items-catalog {if $_COOKIE['listtable'] == 1}list{/if}" id="items-catalog-main">
                    {include_tpl('one_product_item')}
                </ul>
            {else:}
                <div class="alert alert-search-result">
                    <div class="title_h2 t-a_c">По вашему запросу товаров не найдено</div>
                </div>
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

                {$cat = searchResultsInCategories($tree, $categorys)}
                <div class="block-filter">
                    <div class="title_h3">Категории</div>
                    <div class="inside-padd">
                        {foreach $cat[0] as $key_0 => $item_0}
                            {if $item_0[childs] > 0 || $item_0[count] > 0}
                                <div class="title_h4">{$item_0[name]}</div>
                                <nav>
                                    <ul class="search-result">
                                        {foreach $cat[$key_0] as $key_1 => $item_1}
                                            {if $item_1[childs] > 0 || $item_1[count] > 0}
                                                <li {if $key_1 == $_GET['category']}class="active"{/if}>
                                                    {if $item_1[count] > 0}
                                                        <span><a href="{shop_url('search?text='.$_GET[text].'&category='.$key_1)}">{$item_1[name]} <span class="count">({$item_1[count]})</span></a></span>
                                                    {else:}
                                                        <span>{$item_1[name]}</span>
                                                    {/if}
                                                    {if $item_1[childs] > 0}
                                                        <ul class="search-result">
                                                            {foreach $cat[$key_1] as $key_2 => $item_2}
                                                                {if $key_2 == $_GET['category']}
                                                                    <li class="active"><span>{$item_2[name]}</span> <span class="count">({$item_2[count]})</span></li>
                                                                {else:}
                                                                    <li><a href="{shop_url('search?text='.$_GET[text].'&category='.$key_2)}">{$item_2[name]} <span class="count">({$item_2[count]})</span></a></li>
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
