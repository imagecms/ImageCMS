{
/**
* @file template file for creating drop-down login form uses imagecms.api.js for submiting and appending validation errors
*/
}
<div class="drop-enter drop drop-style" id="enter">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('lang_login_page')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/login', '#login_form');
                        return false;">
                    <label>
                        <span class="title">{lang('lang_email')}</span>
                        <span class="frame-form-field">
                            <input type="text" name="email"/>
                            <span class="must">*</span>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('lang_password')}</span>
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
                                        <span class="text-el">{lang('Sign in','newLevel')}</span>
                                    </button>
                                </span>
                                <div class="f_r neigh-buttonform">
                                    <span class="helper"></span>
                                    <button type="button" class="d_l_1" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('lang_forgot_password')}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="help-block">{lang('I am not registered yet','newLevel')}</div>
                            <a href="/auth/register">{lang('Go to the registration','newLevel')}</a>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>