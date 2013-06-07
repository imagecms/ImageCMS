<div class="grid_6">
    <h2>{lang('lang_forgot_password')}</h2>
    {if validation_errors() OR $info_message}
        <div class="errors">
            {validation_errors()}
            {$info_message}
        </div>
    {/if}

    <form action=""id="form" class="form" method="post"onsubmit="ImageCMSApi.formAction('/auth/authapi/forgot_password', 'forgot_password_form');
            return false;">

        <div class="comment_form_info">

            <div class="textbox">
                <input type="text" size="30" name="email" id="login" value="{lang('lang_email')}" onfocus="if (this.value == '{lang('lang_email')}')
                this.value = '';" onblur="if (this.value == '')
                this.value = '{lang('lang_email')}';" />
            </div>

            <br /><br /><br /><br />


            <div class="btn">
                <a data-type="submit"
                   class="btn"
                   onclick="document.getElementById('form').submit()"> {lang('lang_submit')}
                </a>
                <a class="btn" href="{site_url($modules.auth . '/register')}">Регистрация</a>
                <a class="btn" href="{site_url($modules.auth . '/login')}">Вход</a>

            </div>
        {form_csrf()}
    </form>
</div>
