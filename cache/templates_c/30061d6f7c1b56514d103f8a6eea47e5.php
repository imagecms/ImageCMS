<?php $total = ShopCore::app()->SCart->totalItems()?>
<li class="cart <?php if($total): ?>is_avail<?php endif; ?> ">
    <?php if($total): ?>
    <a href="<?php echo shop_url ('cart'); ?>" class="gray goCartData">
    <span class="icon-cart"></span><?php echo lang ('s_cart'); ?>
    </a> 
    <?php else:?>
    <span class="icon-cart"></span><?php echo lang ('s_cart'); ?>
    
    <?php endif; ?>
    (<?php if(isset($total)){ echo $total; } ?>)
</li>
<?php $mabilis_ttl=1357399731; $mabilis_last_modified=1355915264; ///var/www/imagecms.loc/templates/commerce/shop/default/cart_data.tpl ?>