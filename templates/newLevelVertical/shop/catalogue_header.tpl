{if $totalProducts > 0}
    <div class="header-category clearfix">
        <!-- Start. Order by block -->
        <div class="f_l frame-sort f-s_0">
            <span class="title">{lang('Показывать','newLevel')}:</span>
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
        <!--        Start. Show products as list or table-->
        <nav class="f_r frame-catalog-view f-s_0">
            <span class="title">{lang('Смотреть','newLevel')}:</span>
            <ul class="tabs groups-buttons tabs-list-table" data-type="radio" data-elchange="#items-catalog-main">
                <li class="btn-def {if $_COOKIE['listtable'] == 0}active{/if}">
                    <button type="button" data-href="list" data-title="{lang('Список','newLevel')}" data-rel="tooltip">
                        <span class="icon_list_cat"></span><span class="text-el">{lang('Список','newLevel')}</span>
                    </button>
                </li>
                <li class="btn-def {if $_COOKIE['listtable'] == 1}active{/if}">
                    <button type="button" data-href="table" data-title="{lang('Таблица','newLevel')}" data-rel="tooltip">
                        <span class="icon_table_cat"></span><span class="text-el">{lang('Таблица','newLevel')}</span>
                    </button>
                </li>
            </ul>
        </nav>
        <!--        End. Show products as list or table-->
        <!--         Start. Product per page  -->
        <div class="frame-count-onpage">
            <div class="f-s_0 d_i-b">
                <span class="title">{lang('На странице','newLevel')}:</span>
                {if ShopCore::$_GET['user_per_page'] == null}
                    {ShopCore::$_GET['user_per_page'] =ShopCore::app()->SSettings->frontProductsPerPage;}
                {/if}
                <div class="lineForm">
                    <!--                Load settings-->
                    {$per_page_arr = unserialize(ShopCore::app()->SSettings->arrayFrontProductsPerPage)}
                    <select id="sort2" name="user_per_page">
                        {foreach $per_page_arr as $pp}
                            <option {if $pp == ShopCore::$_GET['user_per_page']}selected="selected"{/if} value="{$pp}">{$pp}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>
        <!--         End. Product per page  -->
    </div>
    <!--                Start. if $CI->uri->segment(2) == "search" then show hidden field-->
    {if $CI->uri->segment(2) == "search"}
        <input type="hidden" name="text" value="{$_GET['text']}">
    {/if}
    <!--                End. if $CI->uri->segment(2) == "search" then show hidden field-->
{/if}