<script type="text/javascript" src="{$SHOP_THEME}js/shop_script/category.js"></script>
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs(0, " / ", "Список желаний")}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        {if count($items) > 0}
            <div class="clearfix m-b_15">
                <div class="title_h1 f_l">Список желаний</div>
                {if ShopCore::$ci->dx_auth->is_logged_in() === true}
                    <div class="f_l m-l_30">
                        <div class="btn btn-order" data-drop=".drop-show-friend" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">
                            <button type="button">Показать другу</button>
                        </div>
                    </div>
                {/if}
            </div>
            
            <ul class="items-catalog items-wish-list" id="items-catalog-main">
                {foreach $items as $key => $item}
                    {$promos[0] = $item.model}
                    {$CI->template->assign('promos', $promos)}
                    {$CI->template->assign('wishItemKey', $key)}
                    {include_tpl('one_product_item')}
                {/foreach}
            </ul>
        {else:}
            <div class="clearfix m-b_15">
                <div class="title_h3 f_l">Список желаний пуст</div>
            </div>
        {/if}
    </div>
</div>