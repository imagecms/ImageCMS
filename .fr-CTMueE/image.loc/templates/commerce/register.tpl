<div id="titleExt"><h5><span class="ext">{lang("Registration","admin")}</span></h5></div>

{if validation_errors() OR $info_message}
	<div class="errors">
		{validation_errors()}
		{$info_message}
	</div>
{/if}

<br/>

<form action="" class="form" method="post">

		<div class="fieldName">{lang("Email","admin")}</div>
		<div class="field">
			<input type="text" size="30" name="email" id="email" value="{set_value('email')}" />
		</div>
		<div class="clear"></div>

		<div class="fieldName">ФИО</div>
		<div class="field">
			<input type="text" size="30" name="userInfo[fullName]" value="{set_value('userInfo[fullName]')}" />
		</div>
		<div class="clear"></div>

		<div class="fieldName">{lang("Password","admin")}</div>
		<div class="field">
			<input type="password" size="30" name="password" id="password" value="{set_value('password')}" />
		</div>
		<div class="clear"></div>

		<div class="fieldName">{lang("Repeat Password","admin")}</div>
		<div class="field">
			<input type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
		</div>
		<div class="clear"></div>

		{if $cap_image}
		<div class="fieldName">{$cap_image}</div>
		{if $captcha_type == 'captcha'}
		<div class="field">
			<input type="text" name="captcha" id="captcha" />
		</div>
		{/if}
		<div class="clear"></div>
		{/if}

		<div class="fieldName"></div>
		<div class="field">
			<input type="submit" id="submit" class="submit" value="{lang("Send","admin")}" />
		</div>
		<div class="clear"></div>

		<div class="fieldName"></div>
		<div class="field">
			<a href="{site_url($modules.auth . '/forgot_password')}">{lang("Forgot your password?","admin")}</a>
			&nbsp;
			<a href="{site_url('auth/login')}">{lang("Enter","admin")}</a>
		</div>
		<div class="clear"></div>

{form_csrf()}
</form>

