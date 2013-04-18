<div class="f_l">
    <div style="margin-top: 9px;" id="wishListDataModule">
        {$cWL = ShopCore::app()->SWishList->totalItems()}
        <span {if !$cWL}class="d_n"{/if} data-rel="ref">
            <a {if ShopCore::$ci->dx_auth->is_logged_in()===true}logged_in="true" href="{shop_url('wish_list/')}"{else:}href="#"{/if} class="f-s_0">
                <span class="icon-wish"></span>
                <span class="text-el">{echo lang('s_WL')}</span>
            </a>
        </span>
        <span class="{if $cWL}d_n{/if} c_97 f-s_0" data-rel="notref">
            <span class="icon-wish"></span>
            <span class="text-el">{echo lang('s_WL')}</span>
        </span>
        &nbsp;<span id="wishListCountModule" class="c_97">({echo $cWL})</span>
    </div>
</div>