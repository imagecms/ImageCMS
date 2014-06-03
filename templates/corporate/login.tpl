<div class="frame-inside">
    <div class="container">
        <h1>{lang('Вход','corporate')}</h1>
        <div class="vertical-form w_50">
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