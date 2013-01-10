<?php if($is_logged_in): ?>
    <li class='login'><span class="icon-person"></span><a href='<?php echo site_url ('shop/profile'); ?>' rel='nofollow' class='js gray'><?php echo lang ('s_private_office'); ?></a></li>
    <li><span class="icon-exit"></span><a href='<?php echo site_url ('/auth/logout'); ?>' rel='nofollow' class='js gray'><?php echo lang ('lang_logout'); ?></a></li>
<?php else:?>
    <li class="login"><span class="icon-key"></span><a href="<?php echo site_url ('auth'); ?>" rel="nofollow" class="js gray loginAjax"><?php echo lang ('s_login_here'); ?></a></li>
<?php endif; ?>
<script type="text/javascript">
    var b_url = '<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>';
</script><?php $mabilis_ttl=1357909944; $mabilis_last_modified=1357742253; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/auth_data.tpl ?>