{if $is_logged_in}
    <li class='login'><a href='/shop/profile' rel='nofollow' class='js gray'>Личный кабинет</a></li>
	<li><a href='/auth/logout' rel='nofollow' class='js gray'>Выход</a></li>
{else:}
<li class="login"><a href="{site_url('auth')}" rel="nofollow" class="js gray loginAjax" >Вход в магазин</a></li>
{/if}