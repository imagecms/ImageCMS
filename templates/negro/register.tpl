<div class="inside">
    <div class="container">
        <div class="title_h2">Регистрация</div>
        <div class="frame-register">
            <form method="post" action="{site_url('auth/register')}">
                <div class="grey-b_r-bord inside-padd">
                    <div class="title_h4">Все поля обязательны для заполнения</div>
                    <div class="horizontal-form">
                        {if $reg_errors || $info_message}
                            <div class="control-group">
                                <div class="msg">
                                    <div class="error">
                                        {$reg_errors}
                                        {$info_message}
                                    </div>
                                </div>
                            </div>
                        {/if}
                        <div class="control-group">
                            <label class="control-label" for="reg_name">Ваше имя:</label>
                            <div class="controls">
                                <input id="reg_name" type="text" class="required" maxlength="30" name="username" value="{set_value('username')}" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_email">E-mail:</label>
                            <div class="controls">
                                <input id="reg_email" type="text" class="required email" maxlength="30" name="email" value="{set_value('email')}" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_pswd">Пароль:</label>
                            <div class="controls">
                                <input id="reg_pswd" type="password" class="required" maxlength="30" name="password" />
                                <span class="must">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="reg_rptpswd">Повторите:</label>
                            <div class="controls">
                                <input id="reg_rptpswd" type="password" class="required" size="30" name="confirm_password" />
                                <span class="must">*</span>
                            </div>
                        </div>

                        {if $cap_image}
                            <div class="control-group">
                                <div class="fieldName">{$cap_image}</div>
                                {if $captcha_type == 'captcha'}
                                    <div class="field">
                                        <input type="text" name="captcha" id="captcha" />
                                    </div>
                                {/if}
                            </div>
                        {/if}
                        <div class="control-group">
                            <div class="btn btn-order">
                                <input type="submit" value="Зарегистрироваться"/>
                            </div>
                        </div>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>

