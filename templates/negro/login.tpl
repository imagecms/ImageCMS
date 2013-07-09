<div class="frame-inside">
    <div class="container">
        <div class="title-h2">Вход</div>
        <div class="frame-register">
            <form method="post" action="{site_url('auth/login')}" id="login_form">
                <div class="grey-b_r-bord inside-padd">
                    <div class="title-h4">Авторизируйтесь, заполнив поля ниже:</div>
                    <div class="horizontal-form">
                        {if $info_message || $log_errors}
                            <div class="control-group">
                                <div class="msg">
                                    <div class="error">
                                        {$log_errors}
                                        {$info_message}
                                    </div>
                                </div>
                            </div>
                        {/if}
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
                            <div class="btn-order f_l">
                                <input type="submit" value="Войти"/>
                            </div>
                            <span class="f_r d_l_b" onclick="location.href='{site_url('auth/forgot_password')}'">
                                Напоминание пароля
                            </span>
                        </div>
                    </div>
                </div>


                {form_csrf()}
            </form>
        </div>
    </div>
</div>