{
/**
* @file template file for creating drop-down login form uses imagecms.api.js for submiting and appending validation errors
*/
}
<div class="drop-enter drop drop-style" id="enter">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Вход в магазин','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/login")}', '#login_form');
                        return false;">
                    <label>
                        <span class="frame-form-field">
                            <input type="text" name="email" placeholder="{lang('E-mail', 'newLevel')}"/>
                            <span class="must">*</span>
                        </span>
                    </label>
                    <label>
                        <span class="frame-form-field">
                            <input type="password" name="password" placeholder="{lang('Пароль', 'newLevel')}"/>
                            <span class="must">*</span>
                        </span>
                    </label>
                    <!-- captcha block -->
                    <lable id="captcha_block">

                    </lable>
                    <div class="frame-label">
                        <div class="frame-form-field">
                            <div class="clearfix">
                                <span class="btn-form">
                                    <button type="submit">
                                        <span class="text-el">{lang('Войти на сайт','newLevel')}</span>
                                    </button>
                                </span>
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
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>