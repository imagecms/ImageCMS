{# Useful methods:
 # @method   ShopCore::app()->SWishList->totalItems()
 # @method   ShopCore::app()->SWishList->totalPrice()
 # @method   SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array( lang('s_product']),lang('s_WL_P'),lang('s_WL_PV')))
 # @var      $CS
}
<div style="margin-top: 9px;">
    {$cWL = ShopCore::app()->SWishList->totalItems()}
    <div class="d_n">
        <a {if ShopCore::$ci->dx_auth->is_logged_in()===true}logged_in="true" href="{shop_url('wish_list/')}"{else:}href="#"{/if} id="towishlist" class="d_n">
            <span class="icon-wish"></span>
            {echo lang('s_WL')}
        </a><span id="wishListCount"> ({echo $cWL})</span>
    </div>

    <span class="c_97">
        <span class="icon-wish"></span>
        {echo lang('s_WL')}
        <span id="wishListCount"> ({echo $cWL})</span>
    </span>
</div>