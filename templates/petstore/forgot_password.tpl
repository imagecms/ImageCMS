<div class="drop-forgot drop drop-style">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Забыли Пароль?','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/forgot_password")}', '#forgot_password_form', {literal}{drop: '.drop-forgot', callback: function(msg, status, form, DS) {
                if (status) {
                hideDrop(DS.drop, form, DS.durationHideForm);
            }
        }}{/literal});
        return false;">
        <div class="horizontal-form">
            <label>
                <span class="frame-form-field">
                    <input type="text" name="email" id="login" placeholder="{lang('E-mail', 'newLevel')}"/>
                    <span class="help-block">{lang('Пароль будет выслан на e-mail ','newLevel')}</span>
                    <span class="must">*</span>
                </span>
            </label>
            <div class="frame-label">
                <div class="frame-form-field">
                    <div class="btn-form">
                        <button type="submit">
                            <span class="icon_forgot_password"></span>
                            <span class="text-el">{lang('Отправить','newLevel')}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="forgot-register_box">
                <div class="d_i-b v-a_m">
                    <button type="button" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('напомнить пароль','newLevel')}</button>
                </div>

                <div class="d_i-b v-a_m">
                    <a href="/auth/register">{lang('зарегистрироваться','newLevel')}</a>
                </div>
            </div>
        </div>
        {form_csrf()}
    </form>
</div>
</div>
</div>
</div>