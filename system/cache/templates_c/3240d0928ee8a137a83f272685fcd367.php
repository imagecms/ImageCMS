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
<?php $mabilis_ttl=1357909944; $mabilis_last_modified=1357742253; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/cart_data.tpl ?>