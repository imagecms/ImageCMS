{
/**
* @file template file for creating drop-down login form uses imagecms.api.js for submiting and appending validation errors
*/
}
<div class="drop-enter drop drop-style" id="enter">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Вход в систему','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="vertical-form">
                <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('{site_url("/auth/authapi/login")}', '#login_form');
                        return false;">
                    <label>
                        <span class="frame-form-field">
                            <input type="text" name="email" placeholder="E-mail"/>
                        </span>
                    </label>
                    <label>
                        <span class="frame-form-field">
                            <input type="password" name="password" placeholder="{lang('Пароль','newLevel')}"/>
                        </span>
                    </label>
                    <div class="frame-label">
                        <div class="frame-form-field">
                            <div class="clearfix">
                                <span class="btn-form f_l">
                                    <button type="submit">
                                        <span class="icon_enter_drop"></span>
                                        <span class="text-el">{lang('Отправить','newLevel')}</span>
                                    </button>
                                </span>
                                <div class="f_r neigh-buttonform">
                                    <span class="helper"></span>
                                    <button type="button" class="d_l_1" data-scroll="true" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('Напомнить пароль','newLevel')}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
        <div class="drop-footer">
            <div class="inside-padd">
                <span class="help-block">{lang('Для регистрации нужно','newLevel')}</span>
                <a href="/auth/register">{lang('создать свой интернет-магазин','newLevel')}</a>
            </div>
        </div>
    </div>
</div>