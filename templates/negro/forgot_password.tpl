<div class="inside">
    <div class="container">
        {if validation_errors() OR $info_message}
            <div class="errors">
                {validation_errors()}
                {$info_message}
            </div>
        {/if}
        <div class="title_h2">{lang('lang_forgot_password')}</div>
        <div class="frame-register">
             <form method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/forgot_password', 'forgot_password_form');
                                            return false;">
                <div class="grey-b_r-bord inside-padd">
                    <div class="title_h4">На вашу электронную почту будет выслано письмо с указаниями по восстановлению пароля.</div>
                    <div class="horizontal-form">
                        <div class="control-group">
                            <label class="control-label" for="reg_email">E-mail:</label>
                            <div class="controls">
                                <input type="text" name="email" id="login" />
                                <span class="must">*</span>
                                <label id="for_email" class="for_validations"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="btn btn-order">
                                <input type="submit" value="Отправить"/>
                            </div>
                        </div>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>