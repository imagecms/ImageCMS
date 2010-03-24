<h1>{lang('lang_register')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">

    <p class="clear">
        <label for="username" class="left">{lang('lang_login')}</label>
        <input type="text" size="30" name="username" id="username" value="{set_value('username')}" />
    </p>

    <p class="clear">
        <label for="email" class="left">{lang('lang_email')}</label>
        <input type="text" size="30" name="email" id="email" value="{set_value('email')}" />
    </p>

    <p class="clear">
        <label for="password" class="left">{lang('lang_password')}</label>
        <input type="text" size="30" name="password" id="password" value="{set_value('password')}" />
    </p>

    <p class="clear">
        <label for="confirm_password" class="left">{lang('lang_confirm_password')}</label>
        <input type="text" class="text" size="30" name="confirm_password" id="confirm_password" />
    </p>

    {if $cap_image}
    <div style="padding-bottom:4px;">
    <p class="clear"> 
        <label for="captcha" class="left">{lang('lang_captcha')}</label>
        <input type="text" name="captcha" id="captcha" />

        <br/>

        <label class="left">&nbsp;</label>
        {$cap_image}
    </p>
    </div>
    {/if}
 
    <p class="clear">
        <label for="submit" class="left">&nbsp;</label> 
        <input type="submit" id="submit" class="button" value="{lang('lang_submit')}" />
    </p>

    <br/>

    <label class="left">&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>

{form_csrf()}
</form>

