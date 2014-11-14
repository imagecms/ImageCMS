<div class="contain-cycle">
    <div class="cycle container">
        <ul>
            <?php if(is_true_array($banners)){ foreach ($banners as $banner){ ?>
                <li>
                    <?php if(trim( $banner['url'] )): ?>
                        <a href="<?php echo site_url ( $banner['url'] ); ?>">
                            <img src="<?php echo $banner['photo']?>" alt="<?php echo $banner['name']; ?>"/>
                        </a>
                    <?php else:?>
                        <span>
                            <img src="<?php echo $banner['photo']?>" alt="<?php echo $banner['name']; ?>"/>
                        </span>
                        <?php endif; ?>
                </li>
            <?php }} ?>
        </ul>
        <div class="pager p_r">

        </div>
        <div id="prev_slide"></div>
        <div id="next_slide"></div> 
    </div>
</div><?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; //templates/corporate/banners/main_slider.tpl ?>