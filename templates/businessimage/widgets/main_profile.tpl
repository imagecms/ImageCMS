<ul class="b-userbar">
	{if !$is_logged_in}
	<li class="b-userbar__item">
		<i class="b-userbar__icon fa fa-unlock-alt"></i>
		<a class="b-userbar__link g-link_footer" href="{site_url('auth')}">{tlang('Sign in')}</a>
	</li>
	<li class="b-userbar__item">
		<i class="b-userbar__icon fa fa-user"></i>
		<a class="b-userbar__link g-link_footer" href="{site_url('auth/register')}">{tlang('Create Account')}</a>
	</li>
	{else:}
	<li class="b-userbar__item">
		<span>{tlang('Hello, ')}{echo $CI->dx_auth->get_username()}</span>
	</li>
	<li class="b-userbar__item">
		<i class="b-userbar__icon fa fa-sign-out"></i>
		<a class="b-userbar__link g-link_footer" href="{site_url('auth/logout')}">{tlang('Sign out')}</a>
	</li>
	{/if}
</ul>