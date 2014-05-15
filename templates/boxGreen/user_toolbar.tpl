<div class="frame-user-toolbar{if $_COOKIE['condUserToolbar'] == 1 || !isset($_COOKIE['condUserToolbar'])} active{/if}">
    <div class="container inside-padd">
        {$countSh = getProductViewsCount()}
        <div class="content-user-toolbar">
            <ul class="items items-user-toolbar" {if $_COOKIE['condUserToolbar'] == 0 && isset($_COOKIE['condUserToolbar'])}style="width: 102px;"{/if}>
                <li class="box-1">
                    {include_shop_tpl('wish_list_data')}
                </li>
                <li class="box-2">
                    {include_shop_tpl('compare_data')}
                </li>
                <li class="box-3">
                    <div class="btn-already-show{if $countSh} pointer{/if}">
                        <button type="button" data-drop=".frame-already-show" data-effect-on="slideDown" data-effect-off="slideUp" data-place="inherit">
                            <span class="text-view-list">
                                <span class="text-el">{lang("Просмотренные товары",'boxGreen')}</span>
                                <span class="text-el">&nbsp;({echo $countSh})</span>
                            </span>
                        </button>
                    </div>
                </li>
                <li class="box-4">
                    <div class="btn-toggle-toolbar">
                        <button type="button" data-rel="0" {if $_COOKIE['condUserToolbar'] == 0 && isset($_COOKIE['condUserToolbar'])}style="display: none;"{else:} class="activeUT"{/if}>
                            <span class="icon_arrow_down"></span>
                            <span class="text-el">{lang('Свернуть','boxGreen')}</span>
                        </button>
                        <button type="button" data-rel="1" class="show{if $_COOKIE['condUserToolbar'] == 0 || isset($_COOKIE['condUserToolbar'])} activeUT{/if}" {if $_COOKIE['condUserToolbar'] == 1 ||  !isset($_COOKIE['condUserToolbar'])}style="display: none;"{/if}>
                            <span class="icon_arrow_down"></span>
                            <span class="text-el">{lang('Развернуть','boxGreen')}</span>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <div class="btn-to-up">
            <button type="button">
                <span class="icon_arrow_p icon_arrow_p2"></span>
                <span class="text-el ref t-d_n">{lang('Наверх','boxGreen')}</span>
            </button>
        </div>
    </div>
    <div class="drop frame-already-show">
        <div class="content-already-show">
            <div id="ViewedProducts">
                {widget('ViewedProducts')}
            </div>
        </div>
    </div>
</div>
