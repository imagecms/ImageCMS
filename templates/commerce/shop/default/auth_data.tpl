{if $is_logged_in}
    <li class='login'><span class="icon-key"></span><a href='{site_url('shop/profile')}' rel='nofollow' class='js gray'>{lang('s_private_office')}</a></li>
    <li><span class="icon-key"></span><a href='{site_url('/auth/logout')}' rel='nofollow' class='js gray'>{lang('lang_logout')}</a></li>
{else:}
    <li class="login"><span class="icon-key"></span><a href="{site_url('auth')}" rel="nofollow" class="js gray loginAjax">{lang('s_login_here')}</a></li>
{/if}
<script type="text/javascript">
    var b_url = '{$BASE_URL}';
</script>