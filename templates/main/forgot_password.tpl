<h1>{lang('lang_forgot_password')}</h1>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">
<p>
    <label for="login">{lang('lang_username_or_mail')}</label>
    <input type="text" class="text" size="30" name="login" />
</p>

<p>
    <label for="submit">&nbsp;</label> 
    <input type="submit" id="submit" class="button" value="{lang('lang_submit')}" /> 
</p>

{form_csrf()}
</form>

        <div align="center">
            <a href="{site_url($modules.auth . '/login')}">{lang('lang_login_page')}</a>
            &nbsp;
            <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>
        </div>

      </div>
    </div>
</div>
<p>&nbsp;</p>
