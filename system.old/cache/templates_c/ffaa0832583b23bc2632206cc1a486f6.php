<!-- Start. Show banner. -->
<?php $CI->load->module('banners')->render()?>
<!-- End. Show banner. -->
<?php echo widget ('benefits'); ?>
<div class="fon-noise">
    <div class="container">
        <div class="left">
            <div class="blog-news">
                <?php echo widget ('blog'); ?>
                <div class="btn btn-link-rss ">
                    <a href="<?php echo site_url ('/rss'); ?>"><span class="icon-rss"></span><?php echo lang ('Подписаться  на блог','corporate'); ?></a>
                </div>
                <?php $Comments = $CI->load->module('comments')->init($page)?>

                <script type="text/javascript">
                        $(function() {
                            renderPosts($('.for_comments'));
                        })
                    
                </script>
                <div id="comment">
                    <div class="for_comments"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <?php echo widget ('news'); ?>
        </div>
    </div>
</div><?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/homepage.tpl ?>