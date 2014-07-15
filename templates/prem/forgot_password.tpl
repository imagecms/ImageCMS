<div class="drop-forgot drop drop-style">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Забыли Пароль?','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="vertical-form">
                <form method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/forgot_password")}', '#forgot_password_form', {literal}{drop: '.drop-forgot', callback: function(msg, status, form, DS) {
                                if (status) {
                                    hideDrop(DS.drop, form, DS.durationHideForm);
                                }
                            }}{/literal});
                        return false;">
                    <div class="horizontal-form">
                        <label>
                            <span class="frame-form-field">
                                <input type="text" name="email" id="login" placeholder="E-mail"/>
                                <span class="help-block">{lang('Пароль будет выслан на e-mail ','newLevel')}</span>
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
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>