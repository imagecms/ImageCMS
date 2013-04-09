{if $totalProducts > 0}
<form method="get" id="searchSortForm" action="">
    <div class="head-category clearfix">
         <!-- Start. Order by block -->
        <div class="f_l">
            <span class="v-a_m">Фильтровать по:</span>
            <div class="lineForm w_170">
                <select class="sort" id="sort" name="order">
                    {$sort =ShopCore::app()->SSettings->getSortingFront()}
                    {foreach $sort as $s}
                        <option value="{echo $s['get']}" {if ShopCore::$_GET['order']==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <!-- End. Order by block -->
<!--        Start. Show products as list or table-->
        <nav class="f_l frame-catalog-view t-a_r">
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
<!--        End. Show products as list or table-->
<!--         Start. Product per page  -->
        <div class="f_r">
            <span class="v-a_m">На странице:</span>
            {if ShopCore::$_GET['user_per_page'] == null}
                {ShopCore::$_GET['user_per_page'] =ShopCore::app()->SSettings->frontProductsPerPage;}
            {/if}
            <div class="lineForm d_i-b">
<!--                Load settings-->
                {$per_page_arr = unserialize(ShopCore::app()->SSettings->arrayFrontProductsPerPage)}
                <select id="sort2" name="user_per_page">
                    {foreach $per_page_arr as $pp}
                        <option {if $pp == ShopCore::$_GET['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp}</option>
                    {/foreach}
                </select>
            </div>
        </div>
<!--         End. Product per page  -->
    </div>
<!--                Start. if $CI->uri->segment(2) == "search" then show hidden field-->
    {if $CI->uri->segment(2) == "search"}
        <input type="hidden" name="text" value="{$_GET['text']}">
    {/if}
<!--                End. if $CI->uri->segment(2) == "search" then show hidden field-->
</form>
{/if}
<hr/>
<!--Start. Show brand description if $CI->uri->segment(2) == "brand" and description is not empty-->
<div class="catalog-baner clearfix">
    {if $CI->uri->segment(2) == "brand" && ($model->getImage() || trim($model->getDescription()) != "")}
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
    {/if}
</div>
<!--End. Show brand description-->