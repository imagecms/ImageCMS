{if $totalProducts > 0}
    <div class="frame-header-category">
        <div class="header-category f-s_0">
            <div class="inside-padd clearfix">
                <!-- Start. Order by block -->
                <div class="frame-sort f_l">
                    <span class="title s-t f_l">{lang('Сортировать','newLevel')}:</span>
                    <ul class="nav-sort nav f_l" id="sort" name="order">
                        {$sort =ShopCore::app()->SSettings->getSortingFront()}
                        {foreach $sort as $s}
                            <li{if ShopCore::$_GET['order']==$s['get']}class="active"{/if}>
                                <button type="button" data-value="{echo $s['get']}" class="d_l_3">{echo $s['name_front']}</button>
                                </li>
                            {/foreach}
                    </ul>
                </div>
                <!-- End. Order by block -->
                <!--        Start. Show products as list or table-->
                <nav class="frame-catalog-view f_r">
                    <ul class="tabs groups-buttons tabs-list-table" data-elchange="#items-catalog-main" data-cookie="listtable">
                        <li class="btn-def2 {if $_COOKIE['listtable'] == 'table' || $_COOKIE['listtable'] == NULl}active{/if}">
                            <button type="button" data-href="table" data-title="{lang('Таблица','newLevel')}" data-rel="tooltip">
                                <span class="icon_table_cat"></span><span class="text-el">{lang('Таблица','newLevel')}</span>
                            </button>
                        </li>
                        <li class="btn-def2 {if $_COOKIE['listtable'] == 'list'}active{/if}">
                            <button type="button" data-href="list" data-title="{lang('Список','newLevel')}" data-rel="tooltip">
                                <span class="icon_list_cat"></span><span class="text-el">{lang('Список','newLevel')}</span>
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