<h3><?php echo lang ('Последнее с блога','corporate'); ?></h3>
<ul class="items items-row items-tiny-blog">
    <?php if(is_true_array($recent_news)){ foreach ($recent_news as $item){ ?>
        <li>
            <div class="date">
                <?php echo date("d.m.Y",  $item['publish_date'] ) ?>
            </div>
            <div class="content-new">
                <a href="<?php echo site_url ( $item['full_url'] ); ?>"><?php echo $item['title']; ?></a>
                <?php echo mb_substr( $item['prev_text'] , 0, 300, 'utf-8') . '...' ?>
            </div>
        </li>     
    <?php }} ?>
</ul><?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/widgets/blog.tpl ?>