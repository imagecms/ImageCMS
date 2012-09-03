{# Useful methods:
 # @method   ShopCore::app()->SWishList->totalItems()
 # @method   ShopCore::app()->SWishList->totalPrice()
 # @method   SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array( lang('s_product']),lang('s_WL_P'),lang('s_WL_PV')))
 # @var      $CS
}
<a {if ShopCore::$ci->dx_auth->is_logged_in()===true}logged_in="true" href="{shop_url('wish_list/')}"{else:}href="#"{/if} id="towishlist">{lang('s_WL')}</a> ({echo ShopCore::app()->SWishList->totalItems()})

