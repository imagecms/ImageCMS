<span class="helper"></span>
<div class="d_i-b">
    <div id="wishListDataModule">
        {$cWL = ShopCore::app()->SWishList->totalItems()}
        <span {if !$cWL}class="d_n"{/if} data-rel="ref">
            <a {if ShopCore::$ci->dx_auth->is_logged_in()===true}logged_in="true" href="{shop_url('wish_list/')}"{else:}href="#"{/if} class="f-s_0 v-a_m">
                <span class="icon-wish v-a_m"></span>
                <span class="text-el v-a_m">{echo lang('s_WL')}</span>
            </a>
        </span>
        <span class="{if $cWL}d_n{/if} ref f-s_0 v-a_m" data-rel="notref">
            <span class="icon-wish v-a_m"></span>
            <span class="text-el v-a_m">{echo lang('s_WL')}</span>
        </span>
        &nbsp;<span id="wishListCountModule" class="ref v-a_m">({echo $cWL})</span>
    </div>
</div>