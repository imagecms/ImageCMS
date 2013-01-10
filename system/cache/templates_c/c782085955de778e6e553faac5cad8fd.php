<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo lang ('a_s_gifts_del_1'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo lang ('a_s_gifts_del_2'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>gifts/delete')" ><?php echo lang ('a_delete'); ?></a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ('a_cancel'); ?></a>
    </div>
</div>


<div id="delete_dialog" title="<?php echo lang ('a_s_gifts_del_1'); ?>" style="display: none">
    <?php echo lang ('a_s_gifts_del_3'); ?>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ('a_gift_certificate_list'); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a class="btn btn-small btn-success pjax" href="/admin/components/run/shop/gifts/create" ><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_create_gift_certificate'); ?></a>
                <a class="btn btn-small pjax" href="/admin/components/run/shop/gifts/settings" ><?php echo lang ('sett'); ?></a>
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_cert"><i class="icon-trash icon-white"></i><?php echo lang ('a_delete'); ?></button>
            </div>
        </div>  
    </div>
    <?php if(count($model)>0): ?>
        <form method="post" action="#" class="form-horizontal">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th class="span1 t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </th>
                        <th class="span1"><?php echo lang ('a_ID'); ?></th>
                        <th><?php echo lang ('a_unique_key'); ?></th>
                        <th><?php echo lang ('a_cert_price'); ?></th>
                        <th><?php echo lang ('a_created'); ?></th>
                        <th><?php echo lang ('a_valid_to'); ?></th>
                        <th class="span2"><?php echo lang ('a_cert_active'); ?></th>
                    </tr>    
                </thead>
                <tbody class="sortable">
                    <?php if(is_true_array($model)){ foreach ($model as $c){ ?>
                        <tr data-id="<?php echo $c->getId()?>">
                            <td class="t-a_c">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" name="ids" value="<?php echo $c->getId()?>"/>
                                    </span>
                                </span>
                            </td>
                            <td><?php echo $c->getId()?></td>
                            <td><a class="pjax" href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>gifts/edit/<?php echo $c->getId()?>"><?php echo $c->getKey()?></td>
                            <td><?php echo $c->getPrice()?></td>
                            <td><?php echo date('Y-m-d', $c->getCreated())?></td>
                            <td><?php echo date('Y-m-d', $c->getEspDate())?></td>
                            <td>
                                <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="<?php echo lang ('a_turn_on'); ?>"  data-off="<?php echo lang ('a_turn_off'); ?>">
                                    <span class="prod-on_off ch_active <?php if(date('U')>$c->getEspDate() || $c->getActive() == 0): ?>disable_tovar<?php endif; ?>" data-cid="<?php echo $c->getId()?>"></span>
                                </div>
                            </td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </form>
    <?php else:?>
        <div class="alert alert-info m-t_20">
            <?php echo lang ('a_gift_certificate_list_empty'); ?>
        </div>
    <?php endif; ?>
</section><?php $mabilis_ttl=1357908695; $mabilis_last_modified=1357754004; //C:\wamp\www\imagecms.loc\/application/modules/shop/admin\templates\gifts\index.tpl ?>