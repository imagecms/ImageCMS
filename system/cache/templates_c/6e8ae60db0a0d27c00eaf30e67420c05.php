<div class="center content">
    <h1><?php echo lang ('orderind_shop_sg'); ?></h1>
    <?php if(count($items) > 0): ?>
        <form method="post" action="<?php echo site_url (uri_string()); ?>" id="cartForm">
            <div class="order-cleaner">
                <table class="cleaner_table forCartProducts" cellspacing="0">
<!--                    <caption><?php echo lang ('s_cart'); ?></caption>-->
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
                                        <div class="price f-s_18 f_l"><?php $summary = $variant->getPrice() *  $item['quantity']  ?>
                                            <?php echo $summary?>
                                            <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                            <span id="allpriceholder" data-summary="<?php echo $summary?>"></span>
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
                                        <?php echo $summary = ShopCore::app()->SCurrencyHelper->convert( $item['totalAmount'] ) ?> <?php if(isset($CS)){ echo $CS; } ?>
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
                                            <a href="<?php echo shop_url ('product/' . $ap->getUrl()); ?>"><?php echo ShopCore::encode($ap->getName())?></a> 
                                            <?php echo ShopCore::encode($kitFirstVariant->getName())?>
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
                        <?php $total += $summary?>
                        <?php $total_nc += $summary_nextc?>
                    <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="foot_cleaner">
                                    <div class="f_r">
                                        <?php if($NextCS == $CS): ?>
                                            <div class="price f-s_26_lh_50 f_l">
                                            <?php else:?>
                                                <div class="price f-s_26 f_l">
                                                <?php endif; ?>
                                                <div class="price f-s_26 f_l">
                                                    <?php if($total <  $item['delivery_free_from']): ?>
                                                        <?php $total +=  $item['delivery_price']  ?>
                                                    <?php endif; ?>
                                                    <?php if(isset( $item['gift_cert_price'] )): ?>
                                                        <?php $total -=  $item['gift_cert_price']  ?>
                                                    <?php endif; ?>
                                                    <?php echo $total?>
                                                    <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                                <?php if($item['delivery_price']  > 0): ?><span style="font-size:16px;"><?php echo lang ('s_delivery'); ?>: <?php echo  $item['delivery_price']  ?> <?php if(isset($CS)){ echo $CS; } ?></span><?php endif; ?>
                                            <?php if($item['gift_cert_price']  > 0): ?><span style="font-size:16px;"><?php echo lang ('s_do_you_syrp_pr'); ?>: <?php echo  $item['gift_cert_price']  ?> <?php if(isset($CS)){ echo $CS; } ?></span><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>
            </tfoot>
            <input type="hidden" name="forCart" value ="1"/>
            
        </table>
    </div>
    <div class="order-cleaner clearfix">
        <div class="f_l method_deliver_buy">
            <?php if(ShopCore::app()->SSettings->__get('usegifts') == 1): ?>
                <div class="block_title_18"><span class="title_18"><?php echo lang ('s_do_you_have'); ?></span></div>
                <label>
                    <input type="text" name="giftcert" id="giftcertkey"/>
                    <input type="button" name="giftcert" value="<?php echo lang ('s_apply_sertif'); ?>" class="giftcertcheck"/>
                </label>
            <?php endif; ?>
            <div class="block_title_18"><span class="title_18"><?php echo lang ('s_sdm'); ?></span></div>
                <?php $counter = true?>
                <?php if(is_true_array($deliveryMethods)){ foreach ($deliveryMethods as $deliveryMethod){ ?>
                    <?php $del_id = $deliveryMethod->getId()?>
                <label>
                    <input type="radio" 
                           <?php if($counter): ?> checked="checked" 
                               <?php $del_id = $deliveryMethod->getId()?> 
                               <?php $counter = false?>
                               <?php $del_price = ceil($deliveryMethod->getPrice())?>
                               <?php $del_freefrom = ceil($deliveryMethod->getFreeFrom())?>
                           <?php endif; ?> 
                           name="met_del" 
                           class="met_del" 
                           value="<?php echo $del_id?>" 
                           data-price="<?php echo ceil($deliveryMethod->getPrice())?>" 
                           data-freefrom="<?php echo ceil($deliveryMethod->getFreeFrom())?>"/>
                    <?php echo $deliveryMethod->getName()?>
                </label>
            <?php }} ?>

            <!--    Show payment methods    -->
            <?php if(sizeof($paymentMethods) > 0): ?>
                <div class="block_title_18"><span class="title_18"><?php echo lang ('s_spm'); ?></span></div>
                <div id="paymentMethods">
                    <?php $counter = true?>
                    <?php if(is_true_array($paymentMethods)){ foreach ($paymentMethods as $paymentMethod){ ?>
                        <label>
                            <input type="radio"
                                   <?php if($counter): ?> checked="checked"
                                       <?php $counter = false?>
                                       <?php $pay_id = $paymentMethod->getId()?>
                                   <?php endif; ?> 
                                   name="met_buy" 
                                   class="met_buy" 
                                   value="<?php echo $pay_id?>" />
                            <?php echo $paymentMethod->getName()?>
                        </label>                        
                    <?php }} ?>
                </div>
            <?php endif; ?>            
            <!--    Show payment methods    -->
        </div>
        <div class="addres_recip f_r">
            <div class="block_title_18">
                <?php if(validation_errors()): ?>
                    <div class="foot_cleaner red" style="background-color: #FFBFBF;border: 1px solid #FF0400;padding: 0 7px"><?php echo validation_errors (); ?></div>
                <?php endif; ?>
                <span class="title_18"><?php echo lang ('s_addresrec'); ?></span>
            </div>
            <div class="label_block">
                <label class="f_l">
                    <?php if($isRequired['userInfo[fullName]']): ?>
                        <span class="red">*</span>
                    <?php endif; ?>
                    <?php echo lang ('s_c_uoy_name_u'); ?>
                    <input type="text"<?php if($isRequired['userInfo[fullName]']): ?> class="required"<?php endif; ?> name="userInfo[fullName]" value="<?php echo $profile['name']; ?>">
                </label>
                <label class="f_l">
                    <?php if($isRequired['userInfo[email]']): ?>
                        <span class="red">*</span>
                    <?php endif; ?>
                    <?php echo lang ('s_c_uoy_user_el'); ?>
                    <input type="text" <?php if($isRequired['userInfo[email]']): ?> class="required email"<?php endif; ?> name="userInfo[email]" value="<?php echo $profile['email']; ?>">
                </label>
                <label class="f_l">
                    <?php if($isRequired['userInfo[phone]']): ?>
                        <span class="red">*</span>
                    <?php endif; ?>
                    <?php echo lang ('s_phone'); ?>
                    <input type="text"<?php if($isRequired['userInfo[phone]']): ?> class="required"<?php endif; ?> name="userInfo[phone]" value="<?php echo $profile['phone']; ?>">
                </label>
                <label class="f_l">
                    <?php if($isRequired['userInfo[deliverTo]']): ?>
                        <span class="red">*</span>
                    <?php endif; ?>
                    <?php echo lang ('s_addresrec'); ?>
                    <input type="text"<?php if($isRequired['userInfo[deliverTo]']): ?> class="required"<?php endif; ?> name="userInfo[deliverTo]" value="<?php echo  $profile['address']  ?>">
                </label>
            </div>
            <label class="c_b d_b">
                <?php if($isRequired['userInfo[commentText]']): ?>
                    <span class="red">*</span>
                <?php endif; ?>
                <?php echo lang ('s_comment'); ?>
                <textarea<?php if($isRequired['userInfo[commentText]']): ?> class="required"<?php endif; ?> name="userInfo[commentText]"></textarea> 
            </label>
            <div>
                <?php echo ShopCore::app()->CustomFieldsWidgetHelper->renderPartOfFormWithCustomFields(-1, 'order', 'cartCustomData')?>
            </div>
        </div>
    </div>
    <div class="foot_cleaner c_b result">
        <span class="v-a_m">
            <span class="c_9 f-s_16">(Сумма товаров: <span class="b" id="price1"><?php echo $total?></span> <?php if(isset($CS)){ echo $CS; } ?> +   Доставка: <span class="b" id="price2"><?php echo $deliveryMethod->getPrice()?></span> <?php if(isset($CS)){ echo $CS; } ?>)</span>
            <span class="c_3 f-s_18">&nbsp;&nbsp;Сумма товаров: <span class="f-s_26 b" id="price3"><?php echo $total + $deliveryMethod->getPrice()?></span> <?php if(isset($CS)){ echo $CS; } ?></span>
        </span>
        <div class="buttons button_big_blue v-a_m">
            <input type="submit" value="<?php echo lang ('s_c_of_z_'); ?>" id="orderSubmit" data-logged="<?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>1<?php else:?>0<?php endif; ?>"/>
        </div>
    </div>
    <input type="hidden" name="deliveryMethodId" id="deliveryMethodId" value="<?php echo $del_id?>" />
    <input type="hidden" name="deliveryMethod" value="1" />
    <input type="hidden" name="paymentMethodId" id="paymentMethodId" value="<?php echo $pay_id?>" />
    <input type="hidden" name="paymentMethod" value="5" />
    <input type="hidden" name="makeOrder" value="1" />
    <?php echo form_csrf (); ?>
</form>
<?php else:?>
    <div class="comparison_slider">
        <div class="f-s_18 m-t_29 t-a_c"><?php echo ShopCore::t(lang('s_cart_empty'))?></div>
    </div>
<?php endif; ?>
</div>
<?php $mabilis_ttl=1357907700; $mabilis_last_modified=1357818537; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/cart.tpl ?>