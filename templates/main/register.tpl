<h1>{lang('lang_register')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">

<p>
    <label for="username">{lang('lang_login')}</label>
    <input type="text" class="text" size="30" name="username" value="{set_value('username')}" />
</p>

<p>
    <label for="email">{lang('lang_email')}</label>
    <input type="text" class="text" size="30" name="email" value="{set_value('email')}" />
</p>

<p>
    <label for="password">{lang('lang_password')}</label>
    <input type="text" class="text" size="30" name="password" value="{set_value('password')}" />
</p>

<p>
    <label for="confirm_password">{lang('lang_confirm_password')}</label>
    <input type="text" class="text" size="30" name="confirm_password" />
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
    <label for="submit">&nbsp;</label> 
    <input type="submit" id="submit" class="button" value="{lang('lang_submit')}" /> 
</p>

<p>
    <label>&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>
</p>

{form_csrf()}
</form>
