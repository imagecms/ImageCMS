<?php $counter = 0?>
<?php if(is_true_array($paymentMethods)){ foreach ($paymentMethods as $paymentMethod){ ?>
    <label><input type="radio"<?php if($counter == 0): ?> checked="checked"<?php endif; ?> name="met_buy" class="met_buy" value="<?php echo $paymentMethod->getId()?>" /><?php echo $paymentMethod->getName()?></label>
    <?php $counter++?>
<?php }} ?><?php $mabilis_ttl=1357907701; $mabilis_last_modified=1357742253; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/cart_delivery_methods.tpl ?>