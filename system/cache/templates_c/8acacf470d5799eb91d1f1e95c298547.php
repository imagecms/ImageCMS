<?php include ('/var/www/sportek.loc/application/libraries/mabilis/functions/func.truncate.php');  ?><!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo lang ('a_products_del_title'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo lang ('a_products_del_body'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>products/ajaxDeleteProducts')" ><?php echo lang ('a_delete'); ?></a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ('a_cancel'); ?></a>
    </div>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<div class="modal hide fade modal_move_to_cat">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Перемещение товаров</h3>
    </div>
    <div class="modal-body">
        <select name="" id="moveCategoryId" style="width:285px;">
            <?php if(is_true_array($categories)){ foreach ($categories as $category){ ?>
                <option <?php if($category->getId() == $categoryId): ?>selected<?php endif; ?> value="<?php echo $category->getId()?>"><?php echo str_repeat ('-',$category->getLevel()); ?> <?php echo ShopCore::encode($category->getName())?></option>
            <?php }} ?>
        </select>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary move_to_cat">Переместить</a>
        <a href="#" class="btn" onclick="$('.modal_move_to_cat').modal('hide');"><?php echo lang ('a_cancel'); ?></a>
    </div>
</div>

<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    

<form action="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>search/index/" id="filter_form" method="get">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"><?php if(isset($_GET['WithoutImages']) AND $_GET['WithoutImages'] == 1): ?><?php echo lang ('a_products_without_images'); ?><?php else:?><?php echo lang ('a_goods_list'); ?><?php endif; ?><?php if($totalProducts!=null): ?> (<?php echo $totalProducts?>)<?php endif; ?></span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button title="<?php echo lang ('a_filtrate'); ?>" type="submit" class="btn btn-small"><i class="icon-filter"></i><?php echo lang ('a_filter'); ?></button>
                    <a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>search/index<?php if($_GET['WithoutImages'] == 1): ?>?WithoutImages=1<?php endif; ?>" title="Сбросить фильтр" type="button" class="btn btn-small pjax"><i class="icon-refresh"></i><?php echo lang ('a_cancel_filter'); ?></a>
                    <div class="dropdown d-i_b">
                        <button type="button" class="btn btn-small dropdown-toggle disabled action_on" data-toggle="dropdown">
                            <i class="icon-tag"></i>
                            <?php echo lang ('a_mark'); ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="to_hit" href="#" onclick="product.toHit()" ><?php echo lang ('a_hit'); ?></a></li>
                            <li><a href="#" class="tonew" onclick="product.toNew()"><?php echo lang ('a_hot'); ?></a></li>
                            <li><a href="#" class="toaction" onclick="product.toAction()"><?php echo lang ('a_action'); ?></a></li>
                            <li><a href="#" class="clone" onclick="product.cloneTo()"><?php echo lang ('a_copy_product'); ?></a></li>
                            <li><a href="#" class="tocategory" onclick="product.toCategory()"><?php echo lang ('a_move_to_category'); ?></a></li>
                        </ul>
                    </div>
                    <a class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i><?php echo lang ('a_delete'); ?></a>
                    <a class="btn btn-small btn-success pjax" href="/admin/components/run/shop/products/create" ><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_cr'); ?></a>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">
            <table class="table table-striped table-bordered table-hover table-condensed products_table">
                <thead>
                    <tr style="cursor: pointer;">
                        <th class="t-a_c span1">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </th>
                        <th class="span1 product_list_order" data-column="Id"><?php echo lang ('a_ID'); ?>
                            <?php if(isset( $_GET['orderMethod'] ) AND  $_GET['orderMethod']  == 'Id'): ?>
                                <?php if($_GET['order']  == 'ASC'): ?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </th>
                        <th class="span3 product_list_order" data-column="Name"><?php echo lang ('a_name'); ?>
                            <?php if(isset( $_GET['orderMethod'] ) AND  $_GET['orderMethod']  == 'Name'): ?>
                                <?php if($_GET['order']  == 'ASC'): ?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </th>
                        <th class="span2 product_list_order" data-column="CategoryId"><?php echo lang ('a_category'); ?>
                            <?php if(isset( $_GET['orderMethod'] ) AND  $_GET['orderMethod']  == 'CategoryId'): ?>
                                <?php if($_GET['order']  == 'ASC'): ?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </th>
                        <th class="span1"><?php echo lang ('a_art_b'); ?></th>
                        <th class="span1 product_list_order" data-column="Active"><?php echo lang ('a_active'); ?>
                            <?php if(isset( $_GET['orderMethod'] ) AND  $_GET['orderMethod']  == 'Active'): ?>
                                <?php if($_GET['order']  == 'ASC'): ?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </th>
                        <th class="span2"><?php echo lang ('a_status'); ?></th>
                        <th class="span2 product_list_order" data-column="Price"><?php echo lang ('a_price'); ?>
                            <?php if(isset( $_GET['orderMethod'] ) AND  $_GET['orderMethod']  == 'Price'): ?>
                                <?php if($_GET['order']  == 'ASC'): ?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                                <?php else:?>
                                    &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </th>
                    </tr>
                    <tr class="head_body">
                <input type="hidden" name="WithoutImages" value="<?php echo $_GET['WithoutImages']; ?>"/>    
                <input type="hidden" name="orderMethod" value="<?php echo $_GET['orderMethod']; ?>"/>    
                <input type="hidden" name="order" value="<?php echo $_GET['order']; ?>"/>    
                <td class="t-a_c">

                </td>
                <td class="number">
                    <div>
                        <input name="filterID" type="text" value="<?php echo $_GET['filterID']; ?>"/>
                    </div>
                </td>
                <td>
                    <input type="text" name="text" value="<?php echo $_GET['text']; ?>"/>
                </td>
                <td>
                    <select class="prodFilterSelect" name="CategoryId">
                        <option value="0"><?php echo lang ('amt_all'); ?></option>
                        <?php if(is_true_array($categories)){ foreach ($categories as $category){ ?>
                            <?php $selected = ''?>
                            <?php if($category->getId() == (int) $_GET['CategoryId']): ?>
                                <?php $selected='selected="selected"'?>
                            <?php endif; ?>
                            <option value="<?php echo $category->getId()?>" <?php if(isset($selected)){ echo $selected; } ?> ><?php echo str_repeat ('-',$category->getLevel()); ?> <?php echo ShopCore::encode($category->getName())?></option>
                        <?php }} ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="number" value="<?php echo $_GET['number']; ?>"/>
                </td>
                <td>
                    <select class="prodFilterSelect" name="Active">
                        <option value=""><?php echo lang ('amt_all'); ?></option>
                        <option value="true" <?php if($_GET['Active'] == 'true'): ?>selected="selected"<?php endif; ?>><?php echo lang ('a_yes'); ?></option>
                        <option value="false" <?php if($_GET['Active'] == 'false'): ?>selected="selected"<?php endif; ?>><?php echo lang ('a_no'); ?></option>
                    </select>
                </td>
                <td>
                    <select class="prodFilterSelect" name="s">
                        <option value=""><?php echo lang ('amt_all'); ?></option>
                        <option value="Hit" <?php if($_GET['s'] == 'Hit'): ?>selected="selected"<?php endif; ?>><?php echo lang ('a_hit'); ?></option>
                        <option value="Hot" <?php if($_GET['s'] == 'Hot'): ?>selected="selected"<?php endif; ?>><?php echo lang ('a_hot'); ?></option>
                        <option value="Action" <?php if($_GET['s'] == 'Action'): ?>selected="selected"<?php endif; ?>><?php echo lang ('a_action'); ?></option>
                    </select>
                </td>
                <td class="number">
                    <label>
                        <span class="pull-left"><span class="neigh_form_field help-inline"></span>От&nbsp;&nbsp;</span>
                        <span class="o_h d_b"><input type="text" name="min_price" value="<?php echo $_GET['min_price']; ?>"/></span>
                    </label>
                    <label>
                        <span class="pull-left"><span class="neigh_form_field help-inline"></span>До&nbsp;&nbsp;</span>
                        <span class="o_h d_b"><input type="text" name="max_price" value="<?php echo $_GET['max_price']; ?>"/></span>
                    </label>
                </td>
                <?php echo form_csrf (); ?>
                </form>
                </tr>
                </thead>
                <tbody>
                    <?php if(is_true_array($products)){ foreach ($products as $p){ ?>
                        <?php $variants = $p->getProductVariants()?>
                        <?php if(sizeof($variants) == 1): ?>
                            <tr data-id="<?php echo $p->getId()?>" class="simple_tr">
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="<?php echo $p->getId()?>" data-id="<?php echo $p->getId()?>"/>
                                        </span>
                                    </span>
                                </td>
                                <td><p><?php echo $p->getId()?></p></td>
                                <td class="share_alt">
                                    <a href="/shop/product/<?php echo $p->getUrl()?>" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="<?php echo lang ('a_go_to_website'); ?>"><i class="icon-share-alt"></i></a>
                                     <a href="/admin/components/run/shop/products/edit/<?php echo $p->getId()?><?php echo $_SESSION['ref_url']; ?>" class="pjax title" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo func_truncate (ShopCore::encode($p->getName()),100); ?></a>
                                </td>
                                <td class="share_alt">
                                    <a href="/shop/category/<?php echo $p->getMainCategory()->getFullPath()?>" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="<?php echo lang ('a_go_to_website'); ?>"><i class="icon-share-alt"></i></a>
                                    <a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>categories/edit/<?php echo $p->getMainCategory()->getId()?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo $p->getMainCategory()->getName()?></a></td>
                                <td>
                                    <p><?php echo $variants[0]->getNumber()?></p>
                                </td>
                                <td>
                                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
                                        <?php if($p->getActive() == true): ?>
                                            <span class="prod-on_off" data-id="<?php echo $p->getId()?>"></span>
                                        <?php else:?>
                                            <span class="prod-on_off disable_tovar" data-id="<?php echo $p->getId()?>"></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($p->getHit() == true): ?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHit" data-rel="tooltip" data-placement="top" data-original-title="хит"><i class="icon-fire"></i></button>
                                        <?php else:?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHit" data-rel="tooltip" data-placement="top" data-original-title="хит"><i class="icon-fire"></i></button>
                                        <?php endif; ?>

                                    <?php if($p->getHot() == true): ?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHot" data-rel="tooltip" data-placement="top" data-original-title="новинка"><i class="icon-gift"></i></button>
                                        <?php else:?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHot" data-rel="tooltip" data-placement="top" data-original-title="новинка"><i class="icon-gift"></i></button>
                                        <?php endif; ?>

                                    <?php if($p->getAction() == true): ?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setAction" data-rel="tooltip" data-placement="top" data-original-title="акция"><i class="icon-star"></i></button>
                                        <?php else:?>
                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setAction" data-rel="tooltip" data-placement="top" data-original-title="акция"><i class="icon-star"></i></button>
                                        <?php endif; ?>
                                </td>
                                <td>
                                    <span class="pull-right"><span class="neigh_form_field help-inline"></span>&nbsp;&nbsp;<?php echo ShopCore::app()->SCurrencyHelper->getSymbolById($variants[0]->getCurrency())?></span>
                                    <div class="p_r o_h frame_price number">
                                        <input type="text" value="<?php echo number_format($variants[0]->getPriceInMain(), 2, ".", "")?>" class="js_price" data-value="<?php echo number_format($variants[0]->getPriceInMain(), 2, ".", "")?>">
                                        <button class="btn btn-small refresh_price" data-id="<?php echo $p->getId()?>" type="button"><i class="icon-refresh"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php else:?>
                            <tr data-id="<?php echo $p->getId()?>" class="simple_tr">
                                <td colspan="8">
                                    <table>
                                        <thead class="no_vis">
                                            <tr>
                                                <td class="span1"></td>
                                                <td class="span1"></td>
                                                <td class="span3"></td>
                                                <td class="span2"></td>
                                                <td class="span1"></td>
                                                <td class="span1"></td>
                                                <td class="span2"></td>
                                                <td class="span2"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="t-a_c">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ids" value="<?php echo $p->getId()?>" data-id="<?php echo $p->getId()?>"/>
                                                        </span>
                                                    </span>
                                                </td>
                                                <td><p><?php echo $p->getId()?></p></td>
                                                <td class="share_alt">
                                                    <a href="/shop/product/<?php echo $p->getId()?>" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="<?php echo lang ('a_go_to_website'); ?>"><i class="icon-share-alt"></i></a>
                                                    <a href="/admin/components/run/shop/products/edit/<?php echo $p->getId()?><?php echo $_SESSION['ref_url']; ?>" class="title" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo func_truncate (ShopCore::encode($p->getName()),100); ?></a>
                                                </td>
                                                <td><a href="/shop/category/<?php echo $p->getMainCategory()->getUrl()?>" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo $p->getMainCategory()->getName()?></a></td>
                                                <td></td>
                                                <td>
                                                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
                                                        <?php if($p->getActive() == true): ?>
                                                            <span class="prod-on_off" data-id="<?php echo $p->getId()?>"></span>
                                                        <?php else:?>
                                                            <span class="prod-on_off disable_tovar" data-id="<?php echo $p->getId()?>"></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if($p->getHit() == true): ?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHit" data-rel="tooltip" data-placement="top" data-original-title="хит"><i class="icon-fire"></i></button>
                                                        <?php else:?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHit" data-rel="tooltip" data-placement="top" data-original-title="хит"><i class="icon-fire"></i></button>
                                                        <?php endif; ?>

                                                    <?php if($p->getHot() == true): ?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHot" data-rel="tooltip" data-placement="top" data-original-title="новинка"><i class="icon-gift"></i></button>
                                                        <?php else:?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setHot" data-rel="tooltip" data-placement="top" data-original-title="новинка"><i class="icon-gift"></i></button>
                                                        <?php endif; ?>

                                                    <?php if($p->getAction() == true): ?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small btn-primary active <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setAction" data-rel="tooltip" data-placement="top" data-original-title="акция"><i class="icon-star"></i></button>
                                                        <?php else:?>
                                                        <button type="button" data-id="<?php echo $p->getId()?>" class="btn btn-small <?php if($p->getActive() != true): ?> disabled<?php endif; ?> setAction" data-rel="tooltip" data-placement="top" data-original-title="акция"><i class="icon-star"></i></button>
                                                        <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="#" class="t-d_n variants"><span class="js">Варианты</span> <span class="f-s_14">↓</span></a>
                                                </td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td colspan="8">
                                                    <table>
                                                        <thead class="no_vis">
                                                            <tr>
                                                                <td class="span1"></td>
                                                                <td class="span1"></td>
                                                                <td class="span3"></td>
                                                                <td class="span2"></td>
                                                                <td class="span1"></td>
                                                                <td class="span1"></td>
                                                                <td class="span2"></td>
                                                                <td class="span2"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="sortable save_positions_variant" data-url="/admin/components/run/shop/search/save_positions_variant">

                                                            <?php if(is_true_array($variants)){ foreach ($variants as $v){ ?>

                                                                <tr data-title="<?php echo lang ('a_drag_variant_product'); ?>">
                                                                    <td class="t-a_c">
                                                                        <input name="idv" type="hidden" value="<?php echo $v->id?>"/>
                                                                    </td>
                                                                    <td></td>
                                                                    <td>
                                                                        <span class="simple_tree">&#8627;</span>&nbsp;&nbsp;
                                                                        <?php if($v->getName() != ''): ?>
                                                                            <span><?php echo $v->getName()?></span>
                                                                        <?php else:?>
                                                                            <span><?php echo $p->getName()?></span>
                                                                        <?php endif; ?> 
                                                                    </td>
                                                                    <td></td>
                                                                    <td><p><?php echo $v->getNumber()?></p></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <span class="pull-right"><span class="neigh_form_field help-inline"></span>&nbsp;&nbsp;<?php echo ShopCore::app()->SCurrencyHelper->getSymbolById($v->getCurrency())?></span>
                                                                        <div class="p_r o_h frame_price number">
                                                                            <input type="text" value="<?php echo number_format($v->getPriceInMain(), 2, ".", "")?>" class="js_price" data-value="<?php echo number_format($v->getPriceInMain(), 2, ".", "")?>">
                                                                            <button class="btn btn-small refresh_price" data-id="<?php echo $v->getProductId()?>" variant-id="<?php echo $v->getId()?>" type="button"><i class="icon-refresh"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php }} ?>
                </tbody>
            </table>
            <?php if($totalProducts == 0): ?>
                <div class="row-fluid news">
                    <div class="span12">
                        <div class="alert alert-info">
                            <p><?php echo lang ('a_empty_select_result'); ?></p>                                
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
        <?php if($pagination > ''): ?>
            <div class="clearfix">
                <?php if(isset($pagination)){ echo $pagination; } ?>
            </div>
        <?php endif; ?>
    </section>
<?php $mabilis_ttl=1357819573; $mabilis_last_modified=1357731418; ///var/www/sportek.loc/application/modules/shop/admin/templates/search/list.tpl ?>