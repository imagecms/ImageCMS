{if !$CI->dx_auth->is_logged_in()}
<a href="/auth/login" tabindex="2">
    <span class="icon profile_icon"></span><br/>
    Вход
</a>
{else:}
<a href="/auth/logout" tabindex="2">
    <span class="icon profile_icon"></span><br/>
    {echo $CI->dx_auth->get_username()}, Выход
</a>
{/if}