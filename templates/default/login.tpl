<h1>{lang('lang_login_page')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" method="post" class="form">

    <label for="username" class="left">{lang('lang_login')}</label> 
    <input type="text" id="username" size="30" name="username" /><br />

    <label for="password" class="left">{lang('lang_password')}</label> 
    <input type="password" size="30" name="password" id="password" /><br />
 
    {if $cap_image}
    <div style="padding-bottom:4px;">
        <label for="captcha" class="left">{lang('lang_captcha')}</label>
        <input type="text" name="captcha" id="captcha" /><br />

        <label class="left">&nbsp;</label>
        {$cap_image}<br />
    </div> 
    {/if}

    <label for="remember" class="left">&nbsp;</label> 
    <input type="checkbox" name="remember" value="1" id="remember" /> {lang('lang_remember_me')} <br />

    <label for="submit" class="left">&nbsp;</label> 
    <input type="submit" id="submit" class="button" value="{lang('lang_submit')}" /> 

<br />

    <label class="left">&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>

{form_csrf()}
</form>
