<?php # Comments form for product?>
<script type="text/javascript">
    var currentProductId = '<?php echo $item_id?>';
</script>
<?php if($can_comment == 1 AND !$is_logged_in): ?>
    <p class="m-l_10"><?php echo sprintf (lang('login_for_comments'), site_url( $modules['auth'] )); ?></p>
<?php endif; ?>

<?php if($can_comment == 0 OR $is_logged_in): ?>
<div class="di_b">
    <span class="comment_ajax_refer b-r_4 visible">

        <a href="#" class="t-d_n"><span class="js"><?php echo lang ('s_leave_comment'); ?></span><span class="blue_arrow"></span></a>

        <?php if($is_logged_in): ?>
            <?php echo lang ('s_lang_logged'); ?> <?php if(isset($username)){ echo $username; } ?>
        <?php else:?>
<!--            <span>Для того, чтобы оставить комментарий, Вы должны <a href="<?php echo site_url ('auth/login'); ?>" class="js red">авторизироваться</a> на сайте</span>-->
        <?php endif; ?>
    </span>
</div>
<?php endif; ?>

<?php if($can_comment == 0 OR $is_logged_in): ?>
<form action="" method="post" class="comment_form clearfix">
    <input type="hidden" name="comment_item_id" value="<?php if(isset($item_id)){ echo $item_id; } ?>" />
    <input type="hidden" name="redirect" value="<?php echo uri_string (); ?>" />
    <?php if($comment_errors): ?>
        <span class="red">   <?php if(isset($comment_errors)){ echo $comment_errors; } ?></span>
    <?php endif; ?>

    <?php if(!$is_logged_in): ?>

        <label><?php echo lang ('lang_comment_author'); ?> <span style="color:red;">*</span>
            <input type="text" name="comment_author" id="comment_author" value="<?php echo get_cookie ('comment_author'); ?>"/></label>
        <label><?php echo lang ('lang_comment_email'); ?> <span style="color:red;">*</span>
            <input type="text" name="comment_email" id="comment_email" value="<?php echo get_cookie ('comment_email'); ?>"/></label>
        <label><?php echo lang ('lang_comment_site'); ?>
            <input type="text" name="comment_site" id="comment_site" value="<?php echo get_cookie ('comment_site'); ?>"/></label>

    <?php endif; ?>
    <label>
        <?php echo lang ('s_you_raiting'); ?>
        <div class="star_rating">
            <div id="comment_block" class="rating <?php echo $r?> star_rait" data-id="<?php echo $item_id?>">
                <div id="1" class="rate one">
                    <span title="1" class="clicktemprate">1</span>
                </div>
                <div id="2" class="rate two">
                    <span title="2" class="clicktemprate">2</span>
                </div>
                <div id="3" class="rate three">
                    <span title="3" class="clicktemprate">3</span>
                </div>
                <div id="4" class="rate four">
                    <span title="4" class="clicktemprate">4</span>
                </div>
                <div id="5" class="rate five">
                    <span title="5" class="clicktemprate">5</span>
                </div>
            </div>
        </div>
        <input id="ratec" name="ratec" type="hidden" value=""/>
    </label><br/>

    <label><?php echo lang ('s_text_comment_one'); ?><span style="color:red;">*</span>
        <textarea name="comment_text" id="comment_text" rows="10" cols="50"><?php echo $_POST['comment_text']; ?></textarea> 
    </label>

    <label><?php echo lang ('s_plus'); ?>
        <textarea name="comment_text_plus" id="comment_plus" rows="5" cols="50"><?php echo $_POST['comment_text']; ?></textarea> 
    </label>

    <label><?php echo lang ('s_cons'); ?>
        <textarea name="comment_text_minus" id="comment_minus" rows="5" cols="50"><?php echo $_POST['comment_text']; ?></textarea> 
    </label>
    <?php if($use_captcha): ?>
        <div style="padding-bottom:4px;">
            <p class="clear">
                <?php if($captcha_type == 'captcha'): ?>
                    <label for="captcha" style="width:140px;" class="left"><?php echo lang ('lang_captcha'); ?><span style="color:red;">*</span></label>
                    <input type="text" name="captcha" id="captcha" />
                <?php endif; ?>
                <br/>
                <label class="left" style="width:140px;" >&nbsp;</label>
                <?php if(isset($cap_image)){ echo $cap_image; } ?>
            </p>
        </div>
    <?php endif; ?>
    <label class="buttons button_middle_blue f_l">
        <input type="submit" value="<?php echo lang ('s_leave_comment'); ?>"/>
    </label>

    <?php echo form_csrf (); ?>
</form>

<?php endif; ?>

<?php if($comments_arr): ?>
    <ul class="comments" style="width:100%">
        <?php if(is_true_array($comments_arr)){ foreach ($comments_arr as $comment){ ?>
            <li>
                <?php if($comment['rate']  != 0): ?>
                    <div class="star_rating">
                        <div id="<?php echo  $comment['item_id']  ?>_star_rating" class="rating_nohover <?php echo count_star( $comment['rate'] ) ?> star_rait" data-id="<?php echo  $comment['item_id']  ?>">
                            <div id="1" class="rate one">
                                <span title="1" class="clickrate">1</span>
                            </div>
                            <div id="2" class="rate two">
                                <span title="2" class="clickrate">2</span>
                            </div>
                            <div id="3" class="rate three">
                                <span title="3" class="clickrate">3</span>
                            </div>
                            <div id="4" class="rate four">
                                <span title="4" class="clickrate">4</span>
                            </div>
                            <div id="5" class="rate five">
                                <span title="5" class="clickrate">5</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <b><?php echo $comment['user_name']; ?></b>
                <div class="c_9 f-s_11"><?php echo lang ('s_on_comment'); ?> <?php echo date ('d-m-Y H:i',  $comment['date'] ); ?></div>
                <p><?php echo $comment['text']; ?></p>
                <?php if($comment['text_plus']  != Null): ?>
                    <p><b><?php echo lang ('s_plus'); ?></b></br>
                        <?php echo $comment['text_plus']; ?></p>
                    <?php endif; ?>
                    <?php if($comment['text_minus']  != Null): ?>
                    <p><b><?php echo lang ('s_cons'); ?></b></br>
                        <?php echo $comment['text_minus']; ?></p>
                    <?php endif; ?>
                <div class="di_b">
                    <span class="comment_ajax_refer b-r_4 visible">

                        <?php if($can_comment == 0 OR $is_logged_in): ?>
                        <a href="#" class="t-d_n">
                            <span class="js"><?php echo lang ('s_comment_answer'); ?></span>

                            <span class="blue_arrow"></span></a>

                        <?php endif; ?>

                        <?php echo lang ('s_review_comment'); ?>
                        <span></span>

                        <span class="usefullyes" data-comid="<?php echo  $comment['id']  ?>"><span class="js"><?php echo lang ('s_yes'); ?></span></span><span id="yesholder<?php echo $comment['id']; ?>">(<?php echo  $comment['like']  ?>)</span>/
                        <span class="usefullno" data-comid="<?php echo  $comment['id']  ?>"><span class="js"><?php echo lang ('s_no'); ?></span></span><span id="noholder<?php echo $comment['id']; ?>">(<?php echo  $comment['disslike']  ?>)</span>
                    </span>
                </div>

            <?php if($can_comment == 0 OR $is_logged_in): ?>
                <form action="" method="post" class="comment_form">
                    <input type="hidden" name="comment_item_id" value="<?php if(isset($item_id)){ echo $item_id; } ?>"/>
                    <input type="hidden" name="redirect" value="<?php echo uri_string (); ?>"/>
                    <?php if(!$is_logged_in): ?>
                        <label><?php echo lang ('s_text_comment_one'); ?> <span style="color:red;">*</span>
                            <input type="text" name="comment_author" id="comment_author" value="<?php echo get_cookie ('comment_author'); ?>"/>
                        </label>
                        <label><?php echo lang ('lang_comment_email'); ?> <span style="color:red;">*</span>
                            <input type="text" name="comment_email" id="comment_email" value="<?php echo get_cookie ('comment_email'); ?>"/>
                        </label>
                    <?php endif; ?>
                    <label><?php echo lang ('s_text_comment_one'); ?> <span style="color:red;">*</span>
                        <textarea name="comment_text" id="comment_text" rows="10" cols="50"><?php echo $_POST['comment_text']; ?></textarea> 
                    </label>
                    <input type="hidden" name="parent" value="<?php echo  $comment['id']  ?>">
                    <label class="buttons button_middle_blue f_l">
                        <input type="submit" value="<?php echo lang ('s_leave_comment'); ?>"/>
                    </label>

                    <?php echo form_csrf (); ?>
                </form>
            <?php endif; ?>
                <?php if(is_true_array($comment_ch)){ foreach ($comment_ch as $com_ch){ ?>
                    <?php if($com_ch['parent']  ==  $comment['id']): ?>
                    <li style="padding-left: 50px">
                        <b><?php echo $com_ch['user_name']; ?></b>
                        <div class="c_9 f-s_11"><?php echo lang ('s_on_comment'); ?> <?php echo date ('d-m-Y H:i',  $com_ch['date'] ); ?></div>
                        <p><?php echo $com_ch['text']; ?></p>
                    </li>
                <?php endif; ?>
            <?php }} ?>
        </li>

    <?php }} ?>
    <ul>
    <?php endif; ?><?php $mabilis_ttl=1357909944; $mabilis_last_modified=1357742253; //C:\wamp\www\imagecms.loc\/templates/commerce/comments.tpl ?>