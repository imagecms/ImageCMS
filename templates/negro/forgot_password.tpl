<div class="inside">
    <div class="container">
        <div class="title_h2">{lang('lang_forgot_password')}</div>
        <div class="frame-register">
            <form method="post" action="{site_url('auth/forgot_password')}" id="login_form">
                <div class="grey-b_r-bord inside-padd">
                    <div class="title_h4">На вашу электронную почту будет выслано письмо с указаниями по восстановлению пароля.</div>
                    <div class="horizontal-form">
                        {if $info_message || validation_errors()}
                            <div class="control-group">
                                <div class="msg">
                                    <div class="error">
                                        {validation_errors()}
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
                            <div class="btn btn-order f_l">
                                <input type="submit" value="Войти"/>
                            </div>
                        </div>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>