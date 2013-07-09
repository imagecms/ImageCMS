<div class="frame-user-toolbar">
    <div class="container inside-padd">
        <div class="content-user-toolbar">
            <ul class="items items-user-toolbar">
                <li class="box-1">
                    {include_shop_tpl('wish_list_data')}
                </li>
                <li class="box-2">
                    {include_shop_tpl('compare_data')}
                </li>
                <li class="box-3">
                    <div class="btn-already-show">
                        <button type="button" data-drop=".frame-already-show" data-effect-on="slideDown" data-effect-off="slideUp">
                            <span class="icon_already_show"></span>
                            <span class="text-view-list">
                                <span class="text-el d_l_1">Вы уже смотрели</span>
                                <span class="text-el">&nbsp;({echo count(widget('ViewedProducts'))})</span>
                            </span>
                        </button>
                    </div>
                </li>
                <li class="box-4">
                    <div class="btn-toggle-toolbar">
                        <button type="button" data-rel="0" {if $_COOKIE['condUserToolbar'] == 0}style="display: none;"{else:} class="activeUT"{/if}>
                            <span class="icon_times"></span>
                            <span class="text-el">Свернуть</span>
                        </button>
                        <button type="button" data-rel="1" {if $_COOKIE['condUserToolbar'] == 1}style="display: none;"{else:} class="activeUT"{/if}>
                            <span class="text-el">Развернуть</span>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="drop frame-already-show">
        <div class="content-already-show">
            <div class="horizontal-carousel">
                {widget('ViewedProducts')}
            </div>
        </div>
    </div>
</div>