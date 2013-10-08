<div class="frame-inside page-register">
    <div class="container">
        <div class="f-s_0 title-register without-crumbs">
            <div class="frame-title">
                <h1 class="d_i">{lang('Регистрация','newLevel')}</h1>
            </div>
        </div>
        <div class="frame-register">
            <form method="post" id="register-form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', '#register-form');
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
                      
                    {echo ShopCore::app()->CustomFieldsHelper
                                        ->setRequiredHtml(' ')
                                        ->setPatternMain('pattern_custom_field')
                                        ->getOneCustomFieldsByName('city','user')->asHtml()}   
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
                                    <button type="button" data-trigger="#loginButton">
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

