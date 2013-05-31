{#
/**
* @file template file for creating drop-down login form uses imagecms.api.js for submiting and appending validation errors
*/
#}
<div class="drop-enter drop">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('lang_login_page')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                  <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/login', 'login_form');
                      return false;">
                    <label>
                        <span class="title">{lang('lang_email')}</span>
                        <span class="frame-form-field">
                            <span class="icon_email"></span>
                            <input type="text" name="email"/>
                            <span class="must">*</span>
                            <label id="for_email" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('lang_password')}</span>
                        <span class="frame-form-field">
                            <span class="icon_password"></span>
                            <input type="password" name="password"/>
                            <span class="must">*</span>
                            <label id="for_password" class="for_validations"></label>
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
                                        <span class="text-el">Войти</span>
                                    </button>
                                </span>
                                <div class="f_r neigh-buttonform">
                                    <span class="helper"></span>
                                    <button type="button" class="d_l_1" data-drop=".drop-forgot" data-source="auth/forgot_password">{lang('lang_forgot_password')}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="help-block">Я еще не зарегистрирован</div>
                            <a href="/auth/register">Перейти к регистрации</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>