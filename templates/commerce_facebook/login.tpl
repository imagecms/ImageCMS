{$this->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW")}

<div id="titleExt"><span class="ext">{lang("Authorization")}</span></h5></div>

{if validation_errors() OR $info_message}
	<div class="errors">
		{validation_errors()}
		{$info_message}
	</div>
{/if}

<br/>

<form action="" method="post" class="form">

		<div class="fieldName">{lang("Email")}</div>
		<div class="field">
		<input type="text" id="username" size="30" name="username" value="Введите Ваш логин" onfocus="if(this.value=='Введите Ваш логин') this.value='';" onblur="if(this.value=='') this.value='Введите Ваш логин';" />
		</div>
		<div class="clear"></div>

		<div class="fieldName">{lang("Password")}</div>
		<div class="field">
		<input type="password" size="30" name="password" id="password" value="{lang("Password")}" onfocus="if(this.value=='{lang("Password")}') this.value='';" onblur="if(this.value=='') this.value='{lang("Password")}';"/>
		</div>
		<div class="clear"></div>

		{if $cap_image}
		<div class="fieldName">{$cap_image}</div>
		{if $captcha_type == 'captcha'}
		<div class="field">
			<input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
		</div>
		{/if}
		<div class="clear"></div>
		{/if}

		<div class="fieldName"></div>
		<div class="field">
			<label><input type="checkbox" name="remember" value="1" id="remember" /> {lang("Remember me")}</label>
		</div>
		<div class="clear"></div>

		<div class="fieldName"></div>
		<div class="field">
			<input type="submit" id="submit" class="submit" value="{lang("Send")}" />
		</div>
		<div class="clear"></div>

		<div class="fieldName"></div>
		<div class="field">
			<a href="{site_url($modules.auth . '/forgot_password')}">{lang("Forgot your password?")}</a>
			&nbsp;
			<a href="{site_url($modules.auth . '/register')}">{lang("Registration")}</a>
		</div>
		<div class="clear"></div>

{form_csrf()}
</form>
