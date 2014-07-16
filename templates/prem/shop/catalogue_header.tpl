{if $totalProducts > 0}
    <div class="frame-header-category">
        <div class="header-category f-s_0">
            <div class="inside-padd t-a_j">
                <div class="d_i-b">
                    <ul class="tabs tabs-type-layouts">
                        <li class="active">
                            <button type="button">
                                <span class="text-el">{lang('Все', 'newLevel')}</span>
                            </button>
                        </li>
                        <li>
                            <button type="button">
                                <span class="text-el">{lang('Платные', 'newLevel')}</span>
                            </button>
                        </li>
                        <li>
                            <button type="button">
                                <span class="text-el">{lang('Бесплатные', 'newLevel')}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <!-- Start. Order by block -->
                <div class="frame-sort f-s_0 d_i-b">
                    <div class="lineForm">
                        <select class="sort" id="sort" name="order">
                    {if $category}{$order_method = $category->getOrderMethod()}{else:}{$order_method = ''}{/if}
                    {$sort =ShopCore::app()->SSettings->getSortingFront($order_method)}
                    {foreach $sort as $s}
                        <option value="{echo $s['get']}" {if ShopCore::$_GET['order']==$s['get']}selected="selected"{/if}>{echo $s['name_front']}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <!-- End. Order by block -->
        <!-- Start. Product per page  -->
        <div class="frame-count-onpage d_i-b">
            <div class="lineForm">
                <select id="sort2" name="">
                    <option value="">{lang('Категория товаров', 'newLevel')}</option>
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
        </div>
        <!-- End. Product per page  -->
    </div>
</div>
</div>
{/if}
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>