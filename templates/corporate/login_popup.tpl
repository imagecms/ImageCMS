<div class="drop drop-enter drop-style">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="drop-header">
        <div class="title">{lang('Вход','corporate')}</div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('{site_url('/auth/authapi/login')}', '#login_form');
                        return false;">
                    <label>
                        <span class="title">E-mail</span>
                        <span class="frame-form-field">               
                            <input type="text" name="email"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('Пароль','corporate')}</span>
                        <span class="frame-form-field">
                            <input type="password" name="password"/>
                        </span>
                    </label>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <span class="frame-form-field">
                            <span class="frame-label">
                                <span class="btn">
                                    <input type="submit" value="{lang('Войти','corporate')}"/>
                                </span>
                            </span>
                            <span class="d_b">
                                <button type="button" class="d_l" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('Забыли Пароль?','corporate')}</button>
                            </span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>