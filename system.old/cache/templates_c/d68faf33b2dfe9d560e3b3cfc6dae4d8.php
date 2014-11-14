<?php include ('/var/www/image-c.loc/application/libraries/mabilis/functions/func.truncate.php');  ?><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"><?php echo lang ('Tools panel', 'admin'); ?></span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a class="btn btn-small pjax btn-success" href="/admin/pages/index"><i class="icon-plus-sign icon-white"></i><?php echo lang ("Create a page","admin"); ?></a>
                    <a class="btn btn-small pjax btn-success" href="/admin/categories/create_form"><i class="icon-plus-sign icon-white"></i><?php echo lang ("Create a category","admin"); ?></a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span8">
                <h4><?php echo lang ("New pages","admin"); ?></h4>
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                    <th><?php echo lang ("Title","admin"); ?></th>
                        <?php if(count($latest)>0): ?>
                        <th><?php echo lang ("Categories","admin"); ?></th>
                        <th>URL</th>
                        <th><?php echo lang ("Time and date of creation","admin"); ?></th>
                        <th class="span1"></th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($latest)>0): ?>
                            <?php if(is_true_array($latest)){ foreach ($latest as $l){ ?>
                                <tr>
                                    <td>
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ("Editing","admin"); ?>"><?php echo func_truncate ( $l['title'] , 40, '...'); ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/<?php echo $l['category']; ?>" class="pjax">
                                            <?php echo func_truncate (get_category_name( $l['category'] ), 20, '...' . lang('Uncategorized','admin')); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?><?php echo $l['cat_url']; ?><?php echo $l['url']; ?>" target="_blank"><?php echo func_truncate ( $l['url'] , 20, '...'); ?></a>
                                    </td>
                                    <td><?php echo date ('Y-m-d H:i:s', $l['created']); ?></td>
                                    <td>
                                        <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="<?php echo lang ("Editing","admin"); ?>" href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>/<?php echo $l['lang']; ?>">
                                            <i class="icon-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php }} ?>
                        <?php else:?>
                            <tr>
                                <td>
                                    <div class="alert alert-block">
                                        <h4><?php echo lang ('Error','admin'); ?></h4>
                                        <?php echo lang ('No recently added pages','admin'); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <h4><?php echo lang ("Updated pages","admin"); ?></h4>
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                    <th>
                        <?php echo lang ("Title","admin"); ?>
                    </th>
                    <?php if(count($latest)>0): ?>
                        <th><?php echo lang ("Categories","admin"); ?></th>
                        <th>URL</th>
                        <th><?php echo lang ("Time and date of creation","admin"); ?></th>
                        <th class="span1">
                        </th>
                    <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($updated)>0): ?>
                            <?php if(is_true_array($updated)){ foreach ($updated as $l){ ?>
                                <tr>
                                    <td>
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ("Editing","admin"); ?>"><?php echo func_truncate ( $l['title'] , 40, '...'); ?></a>
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
                                        <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="<?php echo lang ("Editing","admin"); ?>" href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $l['id']; ?>/<?php echo $l['lang']; ?>">
                                            <i class="icon-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php }} ?>
                        <?php else:?>
                            <tr>
                                <td>
                                    <div class="alert alert-block">
                                        <h4><?php echo lang ('Error','admin'); ?></h4>
                                        <?php echo lang ('No recently updated pages','admin'); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <table class="table table-bordered table-hover table-condensed content_big_td" style="margin-top: 40px;">
                    <thead>
                    <th><?php echo lang ("System","admin"); ?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <?php echo lang ("Version","admin"); ?>: <?php if(isset($cms_number)){ echo $cms_number; } ?> <br />
                                    <a class="pjax" href="/admin/sys_update">
                                        <?php echo lang ('Check version update' , 'admin'); ?>
                                    </a>
                                    <br/>
                                    <a href="/admin/sys_info" class="pjax"><?php echo lang ("Information","admin"); ?></a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th><?php echo lang ("Statistics","admin"); ?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <?php echo lang ("Pages","admin"); ?>: <?php if(isset($total_pages)){ echo $total_pages; } ?> <br />
                                    <?php echo lang ("Categories","admin"); ?>: <?php if(isset($total_cats)){ echo $total_cats; } ?> <br />
                                    <?php echo lang ("Comments","admin"); ?>: <?php if(isset($total_comments)){ echo $total_comments; } ?> <br />
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if(count($comments)>0): ?>

                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th><?php echo lang ('Latest/recent comments', 'admin'); ?></th>
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
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th><?php echo lang ('Interesting articles with blog ImageCMS',"admin"); ?></th>
                        </thead>
                        <tbody>
                            <?php if(is_true_array($api_news)){ foreach ($api_news as $a){ ?>
                                <tr>
                                    <td>
                                        <span><?php echo date ('d-m-Y H:i',  $a['publish_date'] ); ?>
                                            <a style="padding-left:10px;" target="_blank" href="http://www.imagecms.net/<?php echo $a['cat_url']; ?><?php echo $a['url']; ?>?utm_source=imagecms&utm_medium=admin&utm_campaign=<?php echo str_replace (array("http://", "/"), "",site_url()); ?>">>>></a>
                                        </span>
                                        <br/> <?php echo func_truncate (strip_tags( $a['prev_text'] ), 100); ?>
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <?php $this->include_tpl('modules_additions', '/var/www/image-c.loc/templates/administrator'); ?>
        <?php if(!SHOP_INSTALLED): ?>
            <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti?utm_source=imagecmscorporate&utm_medium=admin&utm_campaign=shopview" target="_blank">
                <img src="<?php if(isset($THEME)){ echo $THEME; } ?>images/image.png"/>
            </a>
            <?php endif; ?>
    </section>
</div><?php $mabilis_ttl=1415876668; $mabilis_last_modified=1415789033; ///var/www/image-c.loc/templates/administrator/dashboard.tpl ?>