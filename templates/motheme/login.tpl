<div class="grid_6">
    <h2>{lang('lang_login_page')}</h2>
    {if validation_errors() OR $info_message}
        <div class="success">
            {validation_errors()}
            {$info_message}
        </div>
    {/if}
    <form id="form" action="{site_url('auth/login')}" method="post">
        <fieldset>
            <label class="email">
                <input type="text" id="email" name="email" class="text" value="" placeholder="{lang('lang_email_form')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильный email адрес.</span><span class="empty error-empty">*Это поле объязательно.</span>
            </label>
            <label class="password">
                <input type="text" name="password" value="" placeholder="{lang('lang_password')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильное имя.</span><span class="empty error-empty">*Это поле объязательно для заполнения.</span>
            </label>
            <div class="clear"></div>

            {if $cap_image}
                <div class="textbox captcha" style="margin-top: 15px;">
                    {$cap_image}
                    <input type="text" name="captcha" id="recaptcha_response_field" value="" placeholder="Код протекции"/>
                </div>
            {/if}
            <br class="clear">
            <div class="btn">
                <a data-type="submit" class="btn" onclick="document.getElementById('form').submit()"> {lang('lang_submit')} </a>
                <a class="btn" href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>

                {form_csrf()}
            </div>
        </fieldset>
    </form>
</div>