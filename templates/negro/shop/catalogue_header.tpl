
{if $totalProducts > 0}
    <div class="head-category clearfix">
        <div class="f_l">
            <span class="v-a_m">На странице:</span>
            <div class="lineForm d_i-b">
                {$per_page_arr = array(12,24,36,48)}
                <select name="user_per_page" id="c" onchange="search_per_page(this)">
                    {foreach $per_page_arr as $pp}
                        <option {if $pp == $_GET['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <nav class="f_r frame-catalog-view t-a_r">
            <ul class="tabs groups-buttons d_i-b" data-type="itemsView" data-elchange="#items-catalog-main" data-elchtglcls="list">
                <li {if $_COOKIE['listtable'] != 1}class="active"{/if}>
                    <button data-href="">
                        <span class="icon-table-cat"></span>Таблицей
                    </button>
                </li>
                <li {if $_COOKIE['listtable'] == 1}class="active"{/if}>
                    <button data-href="">
                        <span class="icon-list-cat"></span>Списком
                    </button>
                </li>
            </ul>
        </nav>
    </div>
{/if}

<div class="catalog-baner clearfix">
    {if $CI->uri->segment(2) == "category" && count($banners = getBannersCat($limit = 3, $model->id)) > 0}
        {foreach $banners as $banner}
            <a href="{echo $banner->getUrl()}">
                <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" class="f_r"/>
            </a>
        {/foreach}
    {elseif $CI->uri->segment(2) == "brand" && ($model->getImage() || trim($model->getDescription()) != "")}
        <div class="alert-search-result alert m-t_10">
            <div class="inside-padd clearfix">
                {if $model->getDescription()}
                    {if $model->getImage()}
                        <img src="/uploads/shop/brands/{echo $model->getImage()}" class="f_l"/>
                    {/if}
                    {echo $model->getDescription()}
                {/if}
            </div>
        </div>
    {else:}
        <hr/>
    {/if}
</div>

{if $totalProducts > 0}
    <nav class="frame-sort clearfix">
        <span class="c_47">Сортировать:</span>
        <ul class="sort_current">
            <li class="{if trim($_GET[order]) == "" || $_GET[order] == "hit"}active{/if}" data-rel="tooltip" data-title="Самые продаваемые" ><button type="button" class="ref" value="hit">Топ продаж</button></li>
            <li class="{if $_GET[order] == "price"}active{/if}" data-rel="tooltip" data-title="По цене, начиная с дешевых" ><button type="button" class="ref"  value="price">Дешевые</button></li>
            <li class="{if $_GET[order] == "price_desc"}active{/if}" data-rel="tooltip" data-title="По цене, начиная с дорогих"><button type="button" class="ref"  value="price_desc">Дорогие</button></li>
            <li class="{if $_GET[order] == "hot"}active{/if}" data-rel="tooltip" data-title="Новинки сезона"><button type="button" class="ref" value="hot">Новинки</button></li>
            <li class="{if $_GET[order] == "discount"}active{/if}" data-rel="tooltip" data-title="Со скидкой"><button type="button" class="ref" value="discount">Скидки</button></li>
            <li class="{if $_GET[order] == "popular"}active{/if}" data-rel="tooltip" data-title="Больше всего просмотров"><button type="button" class="ref" value="popular">Популярные</button></li>
            <li class="{if $_GET[order] == "created_desc"}active{/if}" data-rel="tooltip" data-title="Последние появившиеся"><button type="button" class="ref" value="created_desc">Последние</button></li>
        </ul>
    </nav>
{/if}