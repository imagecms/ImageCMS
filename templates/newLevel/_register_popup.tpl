<div class="drop-register drop drop-style" id="register">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Регистрация','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form big-title">
                <form method="post" id="register-form-popup" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', '#register-form-popup');
                    return false;">
                    <div class="horizontal-form">
                        <div class="frame-label">
                            <label class="title" for="reg_name">{lang('Ваше имя:','newLevel')}</label>
                            <div class="frame-form-field">
                                <input type="text" class="required" maxlength="30" name="username" value="{set_value('username')}" />
                            </div>
                        </div>
                        <div class="frame-label">
                            <label class="title" for="reg_email">E-mail:</label>
                            <div class="frame-form-field">
                                <input id="reg_email" type="text" class="required email" maxlength="30" name="email" value="{set_value('email')}" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        <div class="frame-label">
                            <label class="title" for="reg_pswd">{lang('Пароль:','newLevel')}</label>
                            <div class="frame-form-field">
                                <input type="password" name="password" id="password" value="{set_value('password')}" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        <div class="frame-label">
                            <label class="title" for="reg_rptpswd">{lang('Повторите:','newLevel')}</label>
                            <div class="frame-form-field">
                                <input type="password" class="required" name="confirm_password" id="confirm_password" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        {if $cap_image}
                            <label>
                                <span class="title">{$cap_image}</span>
                                <span class="frame-form-field">
                                    <span class="icon_replay"></span>
                                    {if $captcha_type == 'captcha'}
                                        <input type="text" name="captcha" id="captcha" />
                                    {/if}
                                </span>
                            </label>
                        {/if}
                        <div class="frame-label">
                            <span class="title">&nbsp;</span>
                            <div class="frame-form-field">
                                <div class="btn-form m-b_15">
                                    <input type="submit" value="{lang('Зарегистрироваться','newLevel')}"/>
                                </div>
                                <p class="help-block">{lang('Я уже зарегистрирован','newLevel')}</p>
                                <ul class="items items-register-add-ref">
                                    <li>
                                        <button type="button" data-drop=".drop-enter" data-source="{site_url('auth')}">
                                            <span class="text-el d_l_1">{lang('Войти','newLevel')}</span>
                                        </button>
                                    </li>
                                    <li>
                                        <span class="divider">|</span>
                                        <button type="button" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">
                                            <span class="text-el d_l_1">{lang('Напомнить пароль','newLevel')}</span>
                                        </button>
                                    </li>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="refresh" value="false"/>
                    <input type="hidden" name="redirect" value="{shop_url('profile')}"/>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>