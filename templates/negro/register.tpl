<div class="frame-inside">
    <div class="container">
        <div class="title-h2">Регистрация</div>
        <div class="frame-register">
            <form method="post" id="register-form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', 'register-form');
                                                return false;">
                <div class="grey-b_r-bord inside-padd">
                    <div class="title-h4">Все поля обязательны для заполнения</div>
                    <div class="horizontal-form">
                        <div class="control-group">
                            <label class="control-label" for="reg_name">Ваше имя:</label>
                            <div class="controls">
                                <input type="text" class="required" maxlength="30" name="username" value="{set_value('username')}" />
                                <label id="for_username" class="for_validations"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_email">E-mail:</label>
                            <div class="controls">
                                <input id="reg_email" type="text" class="required email" maxlength="30" name="email" value="{set_value('email')}" />
                                <span class="must">*</span>
                                <label id="for_email" class="for_validations"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_pswd">Пароль:</label>
                            <div class="controls">
                                <input type="password" name="password" id="password" value="{set_value('password')}" />
                                <span class="must">*</span>
                                <label id="for_password" class="for_validations"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_rptpswd">Повторите:</label>
                            <div class="controls">
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
                        <div class="control-group">
                            <div class="btn-order">
                                <input type="submit" value="{lang('lang_submit')}"/>
                            </div>
                        </div>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>

