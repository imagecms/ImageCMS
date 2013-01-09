<div class="container">
    <section class="mini-layout">
        <div class="btn-group myTab" data-toggle="buttons-radio">
            <a href="#new_order" class="btn btn-small active">Новые заказы</a>
            <a href="#bestseller" class="btn btn-small">Бестселлеры</a>
        </div>
        <section class="tab-content">
            <div class="tab-pane active" id="new_order">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Время</th>
                            <th>Заказчик</th>
                            <th>Товары</th>
                            <th>Сумма</th>
                            <th>Оплачен</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($model)>0): ?>
                        <?php if(is_true_array($model)){ foreach ($model as $o){ ?>
                        <tr>
                            <td><a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>/orders/edit/<?php echo $o->getId()?>" data-title="<?php echo lang ('a_edit'); ?>" data-rel="tooltip"><?php echo $o->getId()?> </a></td>
                            <td><span class="badge">
                                    <?php if(is_true_array($orderStatuses)){ foreach ($orderStatuses as $orderStatus){ ?>
                                    <?php if($orderStatus->getId() == $o->getStatus()): ?>
                                    <?php echo $orderStatus->getName()?>
                                    <?php endif; ?>
                                    <?php }} ?>
                                </span></td>
                            <td><?php echo date ("d-m-Y, H:i:s", $o->getDateCreated()); ?></td>
                            <td>
                                <span>
                                    <?php if($o->getUserId()): ?><?php echo ShopCore::encode($o->getUserFullName())?>
                                    <?php else:?> <?php echo ShopCore::encode($o->getUserFullName())?> <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <div class="buy_prod" data-title="<?php echo lang ('a_purch_product_c'); ?>" data-original-title="">
                                    <span><?php echo count($o->getSOrderProductss())?></span>
                                    <i class="icon-info-sign"></i>
                                </div>

                                <div class="d_n">
                                    <?php if(count($o->getSOrderProductss())>0): ?>
                                    <?php if(is_true_array($o->getSOrderProductss())){ foreach ($o->getSOrderProductss() as $p){ ?>
                                    <div class="check_product">
                                        <?php $productUrl = '#'?>
                                        <?php $productModel = $p->getSProducts()?>
                                        <?php if($productModel): ?>
                                        <?php $productUrl = '/shop/product/'.$productModel->getUrl()?>
                                        <a target="_blank" href="<?php if(isset($productUrl)){ echo $productUrl; } ?>"><?php echo $p->getProductName()?></a>
                                        <?php else:?>
                                        <?php echo $p->getProductName()?>
                                        <?php endif; ?>
                                        <?php echo $p->getVariantName()?>
                                        <?php echo $p->getQuantity()?> шт. × <?php echo $p->getPrice(true)?> <?php if(isset($CS)){ echo $CS; } ?>
                                    </div>
                                    <?php }} ?>
                                    <?php endif; ?>
                            </td>
                            <td>						
                                <?php $total = 0?>
                                <?php if(count($o->getSOrderProductss())>0): ?>
                                <?php if(is_true_array($o->getSOrderProductss())){ foreach ($o->getSOrderProductss() as $p){ ?>
                                <?php $total = $total + $p->getQuantity() *  $p->getPrice()?>
                                <?php }} ?>
                                <?php endif; ?>
                                <?php if(isset($total)){ echo $total; } ?> <?php if(isset($CS)){ echo $CS; } ?>
                            </td>
                            <td>
                                <?php if($o->getPaid() == true): ?>
                                <span class="label label-success">да</span>
                                <?php else:?>
                                <span class="label">нет</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php }} ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="bestseller">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество добавлений в корзину</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($bestSellers)>0): ?>
                        <?php if(is_true_array($bestSellers)){ foreach ($bestSellers as $bestSeller){ ?>
                        <tr>
                            <td><?php echo $bestSeller->getId()?></td>
                            <td><a href="<?php echo site_url ("/shop/product") . '/' . $bestSeller->getId(); ?>" target="_blank"><?php echo $bestSeller->getName()?></a></td>
                            <td><?php echo $bestSeller->getFirstVariant()->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></td>
                            <td><?php echo $bestSeller->getAddedToCartCount()?></td>
                        </tr>
                        <?php }} ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="btn-group myTab" data-toggle="buttons-radio">
            <a href="#last_users" class="btn btn-small active">Новые пользователи</a>
            <a href="#last_comments" class="btn btn-small">Последние комментарии</a>
        </div>
        <section class="tab-content">
            <div class="tab-pane active" id="last_users">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Дата регистрации</th>
                            <th>Пользователь</th>
                            <th>Сумма покупок</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_true_array($newUsers)){ foreach ($newUsers as $newUser){ ?>
                        <tr>
                            <td><?php echo $newUser->getId()?></td>
                            <td><?php echo date('Y-m-d, H:i:s', $newUser->getDateCreated())?></td>
                            <td><a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>users/edit/<?php echo $newUser->getId()?>" data-title="<?php echo lang ('a_edit_user_sh'); ?>" data-rel="tooltip"><?php echo $newUser->getFullName()?></a></td>
                            <td><?php echo $amountPurchases[$newUser->getId()]?> <?php if(isset($CS)){ echo $CS; } ?></td>
                        </tr>
                        <?php }} ?>    
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="last_comments">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Текст</th>
                            <th>Дата создания</th>
                            <th>Пользователь</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_true_array($lastCommentsArray)){ foreach ($lastCommentsArray as $comment){ ?>
                        <tr>
                            <td><a href="/admin/components/cp/comments/edit/<?php echo  $comment['id']  ?>" data-title="<?php echo lang ('a_edit_user_sh'); ?>" data-rel="tooltip" class="pjax"><?php echo $comment['id']; ?></a></td>
                            <td>
                                <?php if(0 ==  $comment['status']): ?>
                                <span class="label label-success">Одобрен</span>
                                <?php endif; ?>
                                <?php if(1 ==  $comment['status']): ?>
                                <span class="label label-warning">Ждет одобрения</span>
                                <?php endif; ?>
                                <?php if(2 ==  $comment['status']): ?>
                                <span class="label label-important">Спам</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $comment['text']; ?></td>
                            <td><?php echo date('Y-m-d, H:i:s')?></td>
                            <td><a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>users/edit/<?php echo $comment['user_id']; ?>" data-title="<?php echo lang ('a_edit_user_sh'); ?>" data-rel="tooltip"><?php echo $comment['user_name']; ?></a></td>
                        </tr>
                        <?php }} ?>    
                    </tbody>
                </table>
            </div>
        </section>
    </section>
    <?php if(!$onLocal): ?>
    <section class="mini-layout o_h">
        <div class="frame_title no_fixed">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ('a_imageCMS_news'); ?></span>
        </div>
        <div class="row-fluid news">
            <?php if(is_true_array($api_news)){ foreach ($api_news as $n){ ?>
            <div class="span4">
                <h4><p><?php echo $n['title']; ?></p></h4>
                <p><?php echo $n['prev_text']; ?><span class="muted time"><?php echo date('Y-m-d, H:i:s',  $n['publish_date'] ) ?></span></p>
                <a href="http://imagecms.net/blog/news/<?php echo $n['url']; ?>?utm_source=imagecms&utm_medium=admin&utm_campaign=<?php echo str_replace (array("http://", "/"), "",site_url()); ?>" target="blank">Читать полностью</a>
            </div>
            <?php }} ?>   
        </div>
    </section>
    <?php endif; ?>
</div><?php $mabilis_ttl=1357819569; $mabilis_last_modified=1357731390; ///var/www/sportek.loc/application/modules/shop/admin/templates/dashboard/dashboard.tpl ?>