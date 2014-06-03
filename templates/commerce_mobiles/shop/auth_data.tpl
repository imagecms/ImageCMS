{if !$CI->dx_auth->is_logged_in()}
    <a href="{site_url('/auth/login')}" tabindex="2">
        <span class="icon profile_icon"></span><br/>
        {lang('Вход','commerce_mobiles')}
    </a>
{else:}
    <a href="{site_url('/auth/logout')}" tabindex="2">
        <span class="icon profile_icon"></span><br/>
        {echo $CI->dx_auth->get_username()}, {lang('Выход','commerce_mobiles')}
    </a>
{/if}