
<div class="frame-inside page-register">
    <div class="container">
        <div class="f-s_0 title-register without-crumbs">
            <div class="frame-title">
                <h1 class="d_i">Регистрация нового пользователя</h1>
            </div>
        </div>
        <div class="frame-register">
            <form method="post" id="register-form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', 'register-form');
                    return false;">
                <div class="horizontal-form">
                    <div class="frame-label">
                        <label class="title" for="reg_name">Ваше имя:</label>
                        <div class="frame-form-field">
                            <input type="text" class="required" maxlength="30" name="username" value="{set_value('username')}" />
                            <label id="for_username" class="for_validations"></label>
                        </div>
                    </div>
                    <div class="frame-label">
                        <label class="title" for="reg_email">E-mail:</label>
                        <div class="frame-form-field">
                            <input id="reg_email" type="text" class="required email" maxlength="30" name="email" value="{set_value('email')}" />
                            <span class="must">*</span>
                            <label id="for_email" class="for_validations"></label>
                        </div>
                    </div>
                    <div class="frame-label">
                        <label class="title" for="reg_pswd">Пароль:</label>
                        <div class="frame-form-field">
                            <input type="password" name="password" id="password" value="{set_value('password')}" />
                            <span class="must">*</span>
                            <label id="for_password" class="for_validations"></label>
                        </div>
                    </div>
                    <div class="frame-label">
                        <label class="title" for="reg_rptpswd">Повторите:</label>
                        <div class="frame-form-field">
                            <input type="password" class="required" name="confirm_password" id="confirm_password" />
                            <span class="must">*</span>
                            <label id="for_confirm_password" class="for_validations"></label>
                        </div>
                    </div>
                    {if $cap_image}
                        <label>
                            <span class="title">{$cap_image}</span>
                            <span class="frame-form-field">
                                <span class="icon_replay"></span>
                                {if $captcha_type == 'captcha'}
                                    <input type="text" name="captcha" id="captcha" />
                                    <label id="for_captcha" class="for_validations"></label>
                                {/if}
                            </span>
                        </label>
                    {/if}
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="btn-form m-b_15">
                                <input type="submit" value="Зарегистрироваться"/>
                            </div>
                            <p class="help-block">Я уже зарегистрирован или покупал здесь</p>
                            <ul class="items items-register-add-ref">
                                <li>
                                    <button type="button" data-trigger="#loginButton">
                                        <span class="text-el d_l_1">Я помню пароль</span>
                                    </button>
                                </li>
                                <li>
                                    <span class="divider">|</span>
                                    <button type="button" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">
                                        <span class="text-el d_l_1">Напомнить пароль</span>
                                    </button>
                                </li>
                        </div>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>

