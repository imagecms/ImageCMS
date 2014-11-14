<div class="company-news aside-jaw">
    <h3><?php echo lang ('Новости компании','corporate'); ?></h3>
    <ul>
        <?php if(is_true_array($recent_news)){ foreach ($recent_news as $item){ ?>
            <li>
                <div class="date">
                    <span class="day"><?php echo date ('d', $item['publish_date'] ); ?>.</span><span class="mounth"><?php echo date ('m.Y', $item['publish_date'] ); ?></span>
                </div>
                <p><a href="<?php echo site_url ( $item['full_url'] ); ?>"><?php echo $item['title']; ?></a></p>
                <p><?php echo lang ('Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет','corporate'); ?>.</p>
            </li>
        <?php }} ?>
    </ul>        
</div>
<div class="btn">
    <a href="<?php echo site_url ('novosti'); ?>"><?php echo lang ('Архив новостей','corporate'); ?></a>
</div><?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/widgets/news.tpl ?>