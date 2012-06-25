<div id="titleExt">{widget('path')}<span class="ext">{lang('lang_forgot_password')}</span></div>

{if validation_errors() OR $info_message}
	<div class="errors">
		{validation_errors()}
		{$info_message}
	</div>
{/if}

<form action="" class="form" method="post">

	<div class="clear"></div>

	<div class="fieldName">{lang('lang_username_or_mail')}</div>
	<div class="field">
		<input type="text" size="30" name="login" id="login" />
	</div>
	<div class="clear"></div>

	<div class="fieldName"></div>
	<div class="field">
		<input type="submit" id="submit" class="submit" value="{lang('lang_submit')}" />
	</div>
	<div class="clear"></div>

	<div class="fieldName"></div>
	<div class="field">
		<a href="{site_url('auth/')}">Вход</a>
		&nbsp;
		<a href="{site_url('auth/register')}">Регистрация</a>
	</div>
	<div class="clear"></div>
	{form_csrf()}
</form>
