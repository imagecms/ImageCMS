<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang('lang_login_page')}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" method="post" class="form">

	<div class="comment_form_info">
   
	<div class="textbox">
		<label for="username" class="left">{lang('lang_login')}</label>
        <input type="text" id="username" size="30" name="username" value="Введите Ваш логин" onfocus="if(this.value=='Введите Ваш логин') this.value='';" onblur="if(this.value=='') this.value='Введите Ваш логин';" />
    </div>
	
	<div class="textbox_spacer"></div>

    <div class="textbox">
        <label for="password" class="left">{lang('lang_password')}</label> 
        <input type="password" size="30" name="password" id="password" value="{lang('lang_password')}" onfocus="if(this.value=='{lang('lang_password')}') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_password')}';"/>
    </div>
	</div>

    {if $cap_image}
    <div class="comment_form_info">
    <div class="textbox captcha">
        <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
   	</div>
    {$cap_image}
    </div>
    {/if}

    <p class="clear">
        <label for="remember" class="left">&nbsp;</label> 
        <label><input type="checkbox" name="remember" value="1" id="remember" /> {lang('lang_remember_me')}</label>
    </p>

    <input type="submit" id="submit" class="submit" value="{lang('lang_submit')}" /> 
	
	
    <br /><br />

    <label class="left">&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>

{form_csrf()}
</form>
