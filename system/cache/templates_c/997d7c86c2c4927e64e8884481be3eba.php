<?php if(count($items)): ?>
<!--    <caption><?php echo lang ('s_cart'); ?></caption>-->
    <colgroup>
        <col span="1" width="120">
        <col span="1" width="390">
        <col span="1" width="160">
        <col span="1" width="140">
        <col span="1" width="160">
        <col span="1" width="25">
    </colgroup>

    <tbody>
        <?php if(is_true_array($items)){ foreach ($items as $key=>$item){ ?>
            <?php if($item['model']  instanceof SProducts): ?>
                <?php $variants =  $item['model'] ->getProductVariants() ?>
                <?php if(is_true_array($variants)){ foreach ($variants as $v){ ?>
                    <?php if($v->getId() ==  $item['variantId']): ?>
                        <?php $variant = $v?>
                    <?php endif; ?>
                <?php }} ?>
                <tr>
                    <td>
                        <?php if($msg == 1): ?><span class="cert_fancybox"> Ви изпользовали сертификат!</span><?php endif; ?>
                        <?php if($msg == 2): ?><span class="cert_fancybox"> Не верний ключ сертификата!</span><?php endif; ?>
                        <script type="text/javascript">
                            $(".cert_fancybox").fancybox().click()
                        </script>
                        
                        <a href="<?php echo shop_url ('product/' .  $item['model'] ->getUrl()); ?>" class="photo_block">
                            <img src="<?php if(count($variants)>1 && $variant->getSmallImage() != ''): ?><?php echo productImageUrl ($variant->getsmallimage()); ?><?php else:?><?php echo productImageUrl ( $item['model'] ->getMainModimage()); ?><?php endif; ?>" alt="<?php echo ShopCore::encode( $item['model'] ->getName()) ?><?php if(count($variants)>1): ?> - <?php echo ShopCore::encode($variant->name)?><?php endif; ?>"/>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo shop_url ('product/' .  $item['model'] ->getUrl()); ?>"><?php echo ShopCore::encode( $item['model'] ->getName()) ?><?php if(count($variants)>1): ?> - <?php echo ShopCore::encode($variant->name)?><?php endif; ?></a>
                    </td>
                    <td>
                        <div class="price f-s_16 f_l"><?php echo $variant->getPrice()?> <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                        </div>
                    </td>
                    <td>
                        <div class="count">
                            <input name="products[<?php if(isset($key)){ echo $key; } ?>]" type="text" value="<?php echo $item['quantity']; ?>"/>
                            <span class="plus_minus">
                                <button class="count_up inCartProducts">&#9650;</button>
                                <button class="count_down inCartProducts">&#9660;</button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="price f-s_18 f_l">
                            <?php if($item['discount']): ?>
                                <div class="price f-s_12 f_l">Скидка <?php echo  $item['discount']  ?>%</div><br /> 
                                <?php $summary = $variant->getPrice() *  $item['quantity']  ?>
                                <?php echo $summary - $summary / 100 * $item['discount']  ?>
                                <sub><?php if(isset($CS)){ echo $CS; } ?></sub>      <br />       
                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $summary?> <?php if(isset($CS)){ echo $CS; } ?></del> 
                            <?php else:?>
                                <?php $summary = $variant->getPrice() *  $item['quantity']  ?>
                                <?php echo $summary?>
                                <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                            <?php endif; ?>
                            
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo shop_url ('cart/delete/'.$key); ?>" class="delete_text inCartProducts">&times;</a>
                    </td>
                </tr>
            <?php elseif( $item['model']  instanceof ShopKit): ?>
                <tr>
                    <td style="width:90px;padding:2px;">

                        <?php if($item['model'] ->getMainProduct()->getMainImage()): ?>
                            <a href="<?php echo shop_url ('product/' .  $item['model'] ->getProductId()); ?>" class="photo_block">
                                <img src="<?php echo productImageUrl ( $item['model'] ->getMainProduct()->getId() . '_main.jpg'); ?>" border="0"  width="100" />
                            </a>                                        
                        <?php endif; ?>                                   
                    </td>
                    <td>
                        <a href="<?php echo shop_url ('product/' .  $item['model'] ->getMainProduct()->getUrl()); ?>"><?php echo ShopCore::encode( $item['model'] ->getMainProduct()->getName()) ?></a> <?php echo ShopCore::encode( $item['model'] ->getMainProduct()->firstVariant->getName()) ?>
                        <br /><span style="font-size:16px;"><?php echo  $item['model'] ->getMainProduct()->firstVariant->toCurrency() ?> <?php if(isset($CS)){ echo $CS; } ?></span>
                    </td>
                    <td rowspan="<?php echo  $item['model'] ->countProducts() ?>">
                        <?php //echo ShopCore::app()->SCurrencyHelper->convert( $item['price'] ) ?> <?php //$CS?>                               
                        <?php echo  $item['price']  ?> <?php if(isset($CS)){ echo $CS; } ?>                               
                    </td>
                    <td rowspan="<?php echo  $item['model'] ->countProducts() ?>">
                        <div class="count">
                            <input type="text" name="products[<?php if(isset($key)){ echo $key; } ?>]" value="<?php echo $item['quantity']; ?>">
                            <span class="plus_minus">
                                <button class="count_up inCartProducts">&#9650;</button>
                                <button class="count_down inCartProducts">&#9660;</button>
                            </span>
                        </div>
                    </td>
                    <td rowspan="<?php echo  $item['model'] ->countProducts() ?>">
                        <?php //echo $summary = ShopCore::app()->SCurrencyHelper->convert( $item['totalAmount'] ) ?> <?php //$CS?>
                        <?php echo $summary =  $item['totalAmount']  ?> <?php if(isset($CS)){ echo $CS; } ?>
                    </td>
                    <td rowspan="<?php echo  $item['model'] ->countProducts() ?>"><a href="<?php echo shop_url ('cart/delete/' . $key); ?>" rel="nofollow" class="delete_text inCartProducts">&times;</a></td>

                </tr>
                <?php if(is_true_array($item['model'] ->getShopKitProducts())){ foreach ($item['model'] ->getShopKitProducts() as $shopKitProduct){ ?>
                    <?php $ap = $shopKitProduct->getSProducts()?>
                    <?php $ap->setLocale(ShopController::getCurrentLocale())?>
                    <?php $kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)?>
                    <tr>
                        <td style="width:90px;padding:2px;">
                            <?php if($ap->getMainImage()): ?>
                                <a href="<?php echo shop_url ('product/' . $ap->getId()); ?>" class="photo_block">
                                    <img src="<?php echo productImageUrl ($ap->getId() . '_main.jpg'); ?>" border="0" width="100" alt="<?php echo ShopCore::encode($ap->getName())?>" />                                                
                                </a>
                            <?php endif; ?>                      
                        </td>
                        <td>
                            <a href="<?php echo shop_url ('product/' . $ap->getUrl()); ?>"><?php echo ShopCore::encode($ap->getName())?></a> <?php echo ShopCore::encode($kitFirstVariant->getName())?>
                            <?php if($kitFirstVariant->getEconomy() > 0): ?>
                                <br /><s style="font-size:14px;"><?php echo $kitFirstVariant->toCurrency('origPrice')?> <?php if(isset($CS)){ echo $CS; } ?></s>
                                <span style="font-size:16px;"><?php echo $kitFirstVariant->toCurrency()?> <?php if(isset($CS)){ echo $CS; } ?></span>
                            <?php else:?>
                                <span style="font-size:16px;"><?php echo $kitFirstVariant->toCurrency()?> <?php if(isset($CS)){ echo $CS; } ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++?>
                <?php }} ?>
            <?php endif; ?>
<?php $total     += $summary?>
<?php $total_nc  += $summary_nextc?>
<?php }} ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="6">
            <div class="foot_cleaner">
                <div class="f_l f-s_26" style="width: 268px;">                    
                    <?php if(count($discountCom)): ?> 
                        <span class="price f-s_12 price-c_9" style="font-size: 14px;">
                            Накопительная скидка <?php echo $discountCom->getDiscount()?>%
                        </span>
                    <?php endif; ?>
                </div>
                <div class="f_r">
                            <div class="price f-s_26 f_l">
                            <?php if($total <  $item['delivery_free_from']): ?>
                                <?php $total +=  $item['delivery_price']  ?>
                            <?php endif; ?>
                            <?php if(isset( $item['gift_cert_price'] )): ?>
                                <?php $total -=  $item['gift_cert_price']  ?>
                            <?php endif; ?>
                            <?php if(count($discountCom)): ?> 
                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $total?> <?php if(isset($CS)){ echo $CS; } ?></del> 
                                <span class="price f-s_12 price-c_9" style="font-size: 14px;">Скидка <?php echo $discountCom->getDiscount()?>%</span>
                                <?php echo money_format('%i', $total - $total / 100 * $discountCom->getDiscount())?> <?php if(isset($CS)){ echo $CS; } ?> 
                            <?php elseif ( $item['discount']  AND ShopCore::$ci->dx_auth->is_logged_in() === true ): ?>
                                <div class="price f-s_26 f_l">
                                    <?php echo $total - $total / 100 *  $item['discount']  ?> <?php if(isset($CS)){ echo $CS; } ?>
                                </div>
                            <?php else:?>
                                <div class="price f-s_26 f_l">
                                    <?php if(isset( $item['delivery_price'] )): ?>
                                        <?php echo $total+ $item['delivery_price']  ?> <?php if(isset($CS)){ echo $CS; } ?>
                                    <?php endif; ?>
                                </div>

                            <?php endif; ?>
                            <?php if($item['delivery_free_from']): ?><span class="d_b " style="font-size:15px;">+<?php echo  $item['delivery_price']  ?> <?php if(isset($CS)){ echo $CS; } ?></span><?php endif; ?>
                            <span id="dpholder" data-dp="<?php echo  $item['delivery_price']  ?>"></span>
                            <?php if(isset( $item['gift_cert_price'] )): ?><span class="d_b" style="font-size:15px;">-<?php echo  $item['gift_cert_price']  ?> <?php if(isset($CS)){ echo $CS; } ?></span><?php endif; ?>
                            <span id="allpriceholder" data-summary="<?php echo $total?>"></span>
                </div>
            </div>
                
            <div class="f_r sum"><span class="price"><?php echo lang ('s_summ'); ?>:</span><br/>
                <span style="font-size:15px;">Доставка:</span><br/>
                <?php if(isset( $item['gift_cert_price'] )): ?><span style="font-size:15px;">Подарочный сертификат:<?php endif; ?>
            </div>
        </div>
</td>
</tr>
</tfoot>
<input type="hidden" name="forCart" value="1" />
<?php else:?>
    <?php echo lang ('s_cart_empty'); ?>
<?php endif; ?>

<?php $mabilis_ttl=1357907757; $mabilis_last_modified=1357822855; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/cart_products.tpl ?>