{if $totalProducts > 0}
    <div class="frame-header-category">
        <div class="header-category f-s_0">
            <div class="inside-padd">
                <!-- Start. Order by block -->
                <div class="frame-sort d_i-b v-a_t">
                    <div class="lineForm">
                        <select class="sort" id="sort" name="order">
                            {$sort =ShopCore::app()->SSettings->getSortingFront()}
                            {foreach $sort as $s}
                                <option value="{echo $s['get']}" {if ShopCore::$_GET['order']==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <!-- End. Order by block -->
                <!--         Start. Product per page  -->
                <div class="frame-count-onpage d_i-b v-a_t">
                    {if ShopCore::$_GET['user_per_page'] == null}
                        {ShopCore::$_GET['user_per_page'] =ShopCore::app()->SSettings->frontProductsPerPage;}
                    {/if}
                    <div class="lineForm">
                        <!--                Load settings-->
                        {$per_page_arr = unserialize(ShopCore::app()->SSettings->arrayFrontProductsPerPage)}
                        <select id="sort2" name="user_per_page">
                            {foreach $per_page_arr as $pp}
                                <option {if $pp == ShopCore::$_GET['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp} {echo SStringHelper::Pluralize($pp, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))} {lang('на странице', 'newLevel')}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <!--         End. Product per page  -->
                <!--        Start. Show products as list or table-->
                <nav class="frame-catalog-view d_i-b v-a_t">
                    <ul class="tabs tabs-list-table" data-elchange="#items-catalog-main" data-cookie="listtable">
                        <li class="{if $_COOKIE['listtable'] == 'list' || $_COOKIE['listtable'] == NULL}active{/if}">
                            <button type="button" data-href="list" data-title="{lang('Список','newLevel')}" data-rel="tooltip">
                                <span class="icon_list_cat"></span><span class="text-el">{lang('Список','newLevel')}</span>
                            </button>
                        </li>
                        <li class="{if $_COOKIE['listtable'] == 'tablemini'}active{/if}">
                            <button type="button" data-href="tablemini" data-title="{lang('Мини таблица','newLevel')}" data-rel="tooltip">
                                <span class="icon_tablemini_cat"></span><span class="text-el">{lang('Мини таблица','newLevel')}</span>
                            </button>
                        </li>
                        <li class="{if $_COOKIE['listtable'] == 'table'}active{/if}">
                            <button type="button" data-href="table" data-title="{lang('Таблица','newLevel')}" data-rel="tooltip">
                                <span class="icon_table_cat"></span><span class="text-el">{lang('Таблица','newLevel')}</span>
                            </button>
                        </li>
                    </ul>
                </nav>
                <!--        End. Show products as list or table-->
            </div>
            <!--                Start. if $CI->uri->segment(2) == "search" then show hidden field-->
            {if $CI->uri->segment(2) == "search"}
                <input type="hidden" name="text" value="{$_GET['text']}">
            {/if}
            <!--                End. if $CI->uri->segment(2) == "search" then show hidden field-->
        </div>
    </div>
{/if}