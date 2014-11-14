<div class="frame-side-menu aside-jaw">
    <div class="title-h3"><?php echo lang ('Продукты','corporate'); ?></div>
    <nav>
        <ul>
            <?php if(is_true_array($recent_news)){ foreach ($recent_news as $item){ ?>
                <li <?php if($item['id']  ==  $page['id']): ?> class="active"<?php endif; ?>>
                    <?php if($item['id']  ==  $page['id']): ?>
                        <span><?php echo $item['title']; ?></span>
                    <?php else:?>
                        <a href="<?php echo site_url ( $item['full_url'] ); ?>"><?php echo $item['title']; ?></a>
                    <?php endif; ?>
                </li>
            <?php }} ?>
        </ul>
    </nav>
</div><?php $mabilis_ttl=1415876622; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/widgets/product_all.tpl ?>