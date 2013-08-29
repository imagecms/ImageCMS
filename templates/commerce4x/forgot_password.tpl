<article class="container">
    {if validation_errors() OR $info_message}
        <div class="errors">
            {validation_errors()}
            {$info_message}
        </div>
    {/if}
    <div class="t-a_c">
        <div class="row d_i-b t-a_l">
            <div class="span6">
                <div class="frameGroupsForm">
                    <div class="header_title">{lang("Forgot your password?","admin")}</div>
                    <div class="standart_form horizontal_form">
                        <form method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/forgot_password', 'forgot_password_form');
                                            return false;">
                            <div class="groups_form">
                                <label>
                                    <span class="title">{lang("Email","admin")}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <input type="text" name="email" id="login" />
                                        <span class="help_inline">Введите e-mail указаный при регистрации</span>
                                        <label id="for_email" class="for_validations"></label>
                                    </span>
                                </label>
                                <div class="frameLabel c_t">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field">
                                        <input type="submit" class="btn btn_cart" value="{lang("Send","admin")}" />
                                    </span>
                                </div>
                            </div>
                            {form_csrf()}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

