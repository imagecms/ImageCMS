<?php include ('/var/www/sportek.loc/application/libraries/mabilis/functions/func.truncate.php');  ?><div class="container ">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"><?php echo lang ('a_tools_panel'); ?></span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a class="btn btn-small pjax btn-success" href="/admin/pages/index"><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_create_page'); ?></a>
                    <a class="btn btn-small pjax btn-success" href="/admin/categories/create_form"><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_create_cat'); ?></a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span8 content_big_td">
                <h4><?php echo lang ('a_new_pages'); ?></h4>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ('a_title'); ?></th>
                    <?php if(count($latest)>0): ?>
                    <th><?php echo lang ('a_category'); ?></th>
                    <th>URL</th>
                    <th><?php echo lang ('a_date_and_time_cr'); ?></th>
                    <th class="span1"></th>
                    <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($latest)>0): ?>
                        <?php if(is_true_array($latest)){ foreach ($latest as $l){ ?>
                        <tr>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo func_truncate ( $l['title'] , 40, '...'); ?></a>
                            </td>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/<?php echo $l['category']; ?>" class="pjax">
                                    <?php echo func_truncate (get_category_name( $l['category'] ), 20, '...Без категории'); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?><?php echo $l['cat_url']; ?><?php echo $l['url']; ?>" target="_blank"><?php echo func_truncate ( $l['url'] , 20, '...'); ?></a>
                            </td>
                            <td><?php echo date ('Y-m-d H:i:s', $l['created']); ?></td>
                            <td>
                                <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>" href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>/<?php echo $l['lang']; ?>">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }} ?>
                        <?php else:?>
                        <tr>
                            <td>
                                <div class="alert alert-block">
                                    <h4>Ошибка</h4>
                                    Нет недавно добавленых страниц
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <h4><?php echo lang ('a_updated_pages'); ?></h4>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ('a_title'); ?></th>
                    <?php if(count($latest)>0): ?>
                    <th><?php echo lang ('a_category'); ?></th>
                    <th>URL</th>
                    <th><?php echo lang ('a_date_and_time_cr'); ?></th>
                    <th class="span1"></th>
                    <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($updated)>0): ?>
                        <?php if(is_true_array($updated)){ foreach ($updated as $l){ ?>
                        <tr>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>"><?php echo func_truncate ( $l['title'] , 40, '...'); ?></a>
                            </td>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/<?php echo $l['category']; ?>" class="pjax">
                                    <?php echo func_truncate (get_category_name( $l['category'] ), 20, '...'); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?><?php echo $l['cat_url']; ?><?php echo $l['url']; ?>" target="_blank"><?php echo func_truncate ( $l['url'] , 20, '...'); ?></a>
                            </td>
                            <td><?php echo date ('Y-m-d H:i:s', $l['created']); ?></td>
                            <td>
                                <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="<?php echo lang ('a_edit'); ?>" href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>/<?php echo $l['lang']; ?>">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }} ?>
                        <?php else:?>
                        <tr>
                            <td>
                                <div class="alert alert-block">
                                    <h4>Ошибка</h4>
                                    Нет недавно обновлённых страниц
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td" style="margin-top: 40px;">
                    <thead>
                    <th><?php echo lang ('a_system'); ?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <?php echo lang ('a_version'); ?>: <?php if(isset($cms_number)){ echo $cms_number; } ?> <br />
                                    <?php if($sys_status['is_update']  == TRUE): ?>
                                    <a href="#" onclick="ajax_div('page', base_url + 'admin/sys_upgrade');return false;"><?php echo lang ('a_updates_to_version'); ?> <?php if(isset($next_v)){ echo $next_v; } ?></a>
                                    <?php else:?>
                                    <?php echo lang ('a_no_updates'); ?>.
                                    <?php endif; ?>
                                    <br/>
                                    <a href="/admin/sys_info" class="pjax"><?php echo lang ('a_info'); ?></a> 
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ('a_stat'); ?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <?php echo lang ('a_pages'); ?>: <?php if(isset($total_pages)){ echo $total_pages; } ?> <br />
                                    <?php echo lang ('a_cats'); ?>: <?php if(isset($total_cats)){ echo $total_cats; } ?> <br />
                                    <?php echo lang ('a_comments'); ?>: <?php if(isset($total_comments)){ echo $total_comments; } ?> <br />
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if(count($comments)>0): ?>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ('a_last_comm'); ?></th>
                    </thead>
                    <tbody>
                        <?php if(is_true_array($comments)){ foreach ($comments as $c){ ?>
                        <tr>
                            <td>
                                <span style="font-size:11px;"><?php echo date ('d-m-Y H:i',  $c['date'] ); ?></span>
                                <br/>
                                <i><?php echo $c['user_name']; ?>:</i>
                                <a class="pjax" href="/admin/components/cp/comments">
                                    <?php echo func_truncate ( $c['text'] , 50, '...'); ?>
                                </a>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <?php if(count($api_news) > 1): ?>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ('a_cms_news'); ?></th>
                    </thead>
                    <tbody> 
                        <?php if(is_true_array($api_news)){ foreach ($api_news as $a){ ?>
                        <tr><td>
                                <span><?php echo date ('d-m-Y H:i',  $a['publish_date'] ); ?>
                                    <a style="padding-left:10px;" target="_blank" href="http://www.imagecms.net/blog/news/<?php echo $a['url']; ?>?utm_source=imagecms&utm_medium=admin&utm_campaign=<?php echo str_replace (array("http://", "/"), "",site_url()); ?>">>>></a>
                                </span>
                                <br/> <?php echo func_truncate (strip_tags( $a['prev_text'] ), 100); ?>
                            </td></tr>
                        <?php }} ?>
                    </tbody>
                </table>        
                <?php endif; ?>
            </div>
        </div>
    </section>
</div><?php $mabilis_ttl=1357819563; $mabilis_last_modified=1357732082; ///var/www/sportek.loc//templates/administrator/dashboard.tpl ?>