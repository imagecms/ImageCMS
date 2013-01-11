                            <a href="/admin/components/run/shop/orders/search/?status_id=1" class="btn btn-large pjax" data-title="<?php echo lang ('a_orders'); ?>" data-rel="tooltip" data-original-title="<?php echo lang ('a_orders'); ?>">
                                <i class="icon-bask <?php if($totalNewOrders): ?> active <?php endif; ?>"></i>
                                <?php if($totalNewOrders): ?><span class="badge badge-important"><?php echo $totalNewOrders?></span><?php endif; ?>
                            </a>
                            <a href="/admin/components/run/shop/search/index?WithoutImages=1" class="btn btn-large pjax" data-title="<?php echo lang ('a_product_no_icon'); ?>" data-rel="tooltip" data-original-title="">
                                <i class="icon-report_exists <?php if($toralProductsWithoutImage): ?>active<?php endif; ?>"></i>
                                <?php if($toralProductsWithoutImage): ?><span class="badge badge-important"><?php echo $toralProductsWithoutImage?></span><?php endif; ?>
                            </a>
                            <a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>callbacks#callbacks_1" class="btn btn-large pjax" data-title="<?php echo lang ('a_callback'); ?>" data-rel="tooltip" data-original-title="<?php echo lang ('a_callback'); ?>">
                                <i class="icon-callback <?php if($totalNewCallbacks): ?> active <?php endif; ?>"></i>
                                <?php if($totalNewCallbacks): ?> <span class="badge badge-important"><?php echo $totalNewCallbacks?></span> <?php endif; ?>
                            </a>
                            <a href="/admin/components/cp/comments" class="btn btn-large pjax" data-title="<?php echo lang ('a_last_comm'); ?>" data-rel="tooltip" data-original-title="<?php echo lang ('a_last_comm'); ?>">
                                <i class="icon-comment_head <?php if($totalNewComments): ?> active <?php endif; ?>"></i>
                                <?php if($totalNewComments): ?> <span class="badge badge-important"><?php echo $totalNewComments?></span>  <?php endif; ?>
                            </a>


	
<?php $mabilis_ttl=1357998639; $mabilis_last_modified=1357832877; //C:\wamp\www\imagecms.loc\/application/modules/shop/admin\templates\notifications\topBlock.tpl ?>