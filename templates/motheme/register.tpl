<div class="grid_6">
    <h2>{lang('lang_register')}</h2>

    {if validation_errors() OR $info_message}
        <div class="errors">
            {validation_errors()}
            {$info_message}
        </div>
    {/if}

    <form method="post" id="form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', 'register-form');
            return false;">
        <fieldset>
            <label class="email">
                <input type="text" id="email" name="email" class="text" value="" placeholder="{lang('lang_email')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильный email адрес.</span>
                <span class="empty error-empty">*Это поле объязательно.</span>
            </label>

            <label class="username">
                <input type="text" id="username" name="username" class="text" value="" placeholder="{lang('s_fio')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильный email адрес.</span>
                <span class="empty error-empty">*Это поле объязательно.</span>
            </label>

            <label class="password">
                <input type="text" name="password" value="" placeholder="{lang('lang_password')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильное имя.</span>
                <span class="empty error-empty">*Это поле объязательно для заполнения.</span>
            </label>
            <label class="confirm_password">
                <input type="text" name="confirm_password" value="" placeholder="{lang('lang_confirm_password')}"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильное имя.</span>
                <span class="empty error-empty">*Это поле объязательно для заполнения.</span>
            </label>
            {if $cap_image}
                <label>
                    <span class="title">{$cap_image}</span>
                    <span class="frame_form_field">
                        <span class="icon-replay"></span>
                        {if $captcha_type == 'captcha'}
                            <input type="text" name="captcha" id="captcha" />
                            <label id="for_captcha" class="for_validations"></label>
                        {/if}
                    </span>
                </label>
            {/if}
            <div class="clear"></div>

            <div class="btn">
                <a class="btn" href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
                <a data-type="submit" class="btn" onclick="document.getElementById('form').submit()"> {lang('lang_submit')} </a>
            </div>

            {form_csrf()}
        </fieldset>
    </form>

</div>