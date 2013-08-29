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
                    <div class="header_title">Смена пароля</div>
                    <div class="standart_form horizontal_form">
                        <form method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/change_password', 'forgot_password_form');
                                            return false;">
                            <div class="groups_form">
                                <label>
                                    <span class="title">Старый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="old_password" id="login" />
                                        <span class="help_inline"></span>
                                        <label id="for_old_password" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Новый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="new_password" id="login" />
                                        <span class="help_inline"></span>
                                        <label id="for_new_password" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Повторите новый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="confirm_new_password" id="login" />
                                        <span class="help_inline"></span>
                                        <label id="for_confirm_new_password" class="for_validations"></label>
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

