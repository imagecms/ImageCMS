{if $totalProducts > 0}
<form method="get" id="searchSortForm" action="">
    <div class="head-category clearfix">
         <div class="f_l">
            <span class="v-a_m">Фильтровать по:</span>
            <div class="lineForm w_170">
                <select class="sort" id="sort" name="order">
                    <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-{lang('s_no')}-</option>
                    <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                    <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                    <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                    <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                    <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                    <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                </select>
            </div>
        </div>
        <!-- End. Sort by block -->
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
         <div class="f_r">
            <span class="v-a_m">На странице:</span>
            <div class="lineForm d_i-b">
                {$per_page_arr = array(12,24,36,48)}
                <select id="sort2" name="user_per_page">
                    {foreach $per_page_arr as $pp}
                        <option {if $pp == $_COOKIE['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    </div>
    <input type="hidden" name="text" value="{$_GET['text']}">
</form>
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
