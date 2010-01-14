<h1>{lang('lang_login_page')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" method="post" class="form">

<p>
    <label for="username">{lang('lang_login')}</label> 
    <input type="text" id="username" size="30" name="username" class="text" />    
</p>

<p>
    <label for="password">{lang('lang_password')}</label> 
    <input type="password" size="30" name="password" class="text" />
</p>
 
{if $cap_image}
<p>
    <label for="captcha">{$cap_image}</label> 
    <input type="text" size="30" name="captcha" class="text" />
    <br />
    <span class="help_text">Укажите код протекции</span>
</p>
{/if}

<p>
    <label for="remember">&nbsp;</label> 
    <input type="checkbox" name="remember" value="1" id="remember" /> {lang('lang_remember_me')} 
</p>

<p>
    <label for="submit">&nbsp;</label> 
    <input type="submit" id="submit" class="button" value="{lang('lang_submit')}" /> 
</p>

<br />

<p>
    <label>&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>
</p>

{form_csrf()}
</form>
