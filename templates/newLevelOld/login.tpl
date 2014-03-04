<div class="frame-inside page-login">
    <div class="container">
        <div class="f-s_0 title-login without-crumbs">
            <div class="frame-title">
                <h1 class="d_i">{lang('Вход','newLevel')}</h1>
            </div>
        </div>
        <div class="horizontal-form frame-register">
            <form method="post" id="login_form_main" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/login")}', '#login_form_main');
                    return false;">
                <label>
                    <span class="title">{lang('Почта','newLevel')}</span>
                    <span class="frame-form-field">
                        <input type="text" name="email"/>
                        <span class="must">*</span>
                    </span>
                </label>
                <label>
                    <span class="title">{lang('Пароль','newLevel')}</span>
                    <span class="frame-form-field">
                        <input type="password" name="password"/>
                        <span class="must">*</span>
                    </span>
                </label>
                <!-- captcha block -->
                <lable id="captcha_block">

                </lable>
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <div class="frame-form-field">
                        <div class="clearfix">
                            <span class="btn-form f_l">
                                <button type="submit">
                                    <span class="icon_enter_drop"></span>
                                    <span class="text-el">{lang('Войти','newLevel')}</span>
                                </button>
                            </span>
                            <div class="f_r neigh-buttonform">
                                <span class="helper"></span>
                                <button type="button" class="d_l_1" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('Забыли Пароль?','newLevel')}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <div class="frame-form-field">
                        <div class="help-block">{lang('Я еще не зарегистрирован','newLevel')}</div>
                        <a href="/auth/register">{lang('Перейти к регистрации','newLevel')}</a>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>