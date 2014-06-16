<div class="drop drop-style drop-forgot">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="drop-header">
        <div class="title">{lang('Забыли Пароль','corporate')}?</div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                {if validation_errors() OR $info_message}
                    <div class="msg">
                        <div class="error">
                            <div class="text-el">
                                {validation_errors()}
                                {$info_message}
                            </div>
                        </div>
                    </div>
                {/if}
                <form  method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('{site_url('/auth/authapi/forgot_password')}', '#forgot_password_form', {literal}{drop: '.drop-forgot', callback: function(msg, status, form, DS) {
                                if (status) {
                                    hideDrop(DS.drop, form, DS.durationHideForm);
                                }
                            }}{/literal});
                        return false;">
                    <label>
                        <span class="title">{lang('E-mail','corporate')}</span>
                        <span class="frame-form-field">
                            <input type="text" size="30" name="email"/>
                        </span>
                    </label>
                    <div class="frame-label">
                        <div class="title"></div>
                        <div class="frame-form-field">
                            <div class="frame-label">
                                <div class="btn">
                                    <input type="submit" id="submit" class="submit" value="{lang('Отправить','corporate')}" />
                                </div>
                            </div>
                            <div>
                                <button class="d_l" data-drop=".drop-enter" data-source="{site_url('auth')}">{lang('Вход','corporate')}</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{site_url('auth/register')}">{lang('Регистрация','corporate')}</a>
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>