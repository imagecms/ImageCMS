{# Useful methods:
 # @method   ShopCore::app()->SWishList->totalItems()
 # @method   ShopCore::app()->SWishList->totalPrice()
 # @method   SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array( lang('s_product']),lang('s_WL_P'),lang('s_WL_PV')))
 # @var      $CS
}
<div style="margin-top: 9px;" id="wishListData">
    {$cWL = ShopCore::app()->SWishList->totalItems()}
    <span class="d_n" data-rel="ref">
        <a {if ShopCore::$ci->dx_auth->is_logged_in()===true}logged_in="true" href="{shop_url('wish_list/')}"{else:}href="#"{/if} id="towishlist" class="d_n f-s_0">
            <span class="icon-wish"></span>
            <span class="text-el">{echo lang('s_WL')}</span>
        </a>
    </span>
    <span class="c_97 f-s_0" data-rel="notref">
        <span class="icon-wish"></span>
        <span class="text-el">{echo lang('s_WL')}</span>
    </span>
        &nbsp;<span id="wishListCount" class="c_97">({echo $cWL})</span>
</div>
