<?php # Useful methods:
 # @method   ShopCore::app()->SWishList->totalItems()
 # @method   ShopCore::app()->SWishList->totalPrice()
 # @method   SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array( lang('s_product']),lang('s_WL_P'),lang('s_WL_PV')))
 # @var      $CS
?>
<a <?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>logged_in="true" href="<?php echo shop_url ('wish_list/'); ?>"<?php else:?>href="#"<?php endif; ?> id="towishlist"><?php echo lang ('s_WL'); ?></a> (<?php echo ShopCore::app()->SWishList->totalItems()?>)

<?php $mabilis_ttl=1357399731; $mabilis_last_modified=1355325679; ///var/www/imagecms.loc/templates/commerce/shop/default/wish_list_data.tpl ?>