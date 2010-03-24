<h1>{lang('lang_forgot_password')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">

    <p class="clear">
        <label for="login" class="left">{lang('lang_username_or_mail')}</label>
        <input type="text" size="30" name="login" id="login" />
    </p>

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
