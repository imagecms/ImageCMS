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
                    <div class="header_title">{lang("Registration","admin")}</div>
                    <div class="standart_form horizontal_form">
                        <form method="post" id="register-form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', 'register-form');
                                                return false;">
                            <div class="groups_form">
                                <label>
                                    <span class="title">E-mail</span>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <input type="text" name="email" id="email" value="{set_value('email')}" />
                                        <span class="help_inline">E-mail являеться логином</span>
                                        <label id="for_email" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Ваше имя</span>
                                    <span class="frame_form_field">
                                        <span class="icon-person"></span>
                                        <input type="text" name="username" value="{set_value('userInfo[fullName]')}" />
                                        <label id="for_username" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">{lang("Password","admin")}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="password" name="password" id="password" value="{set_value('password')}" />
                                        <span class="help_inline">От 6 до 24 символов. Должен включать латинские буквы и цифры.</span>
                                        <label id="for_password" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">{lang("Repeat Password","admin")}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-replay"></span>
                                        <input type="password" class="text" name="confirm_password" id="confirm_password" />
                                        <label id="for_confirm_password" class="for_validations"></label>
                                    </span>
                                </label>
                                {if $cap_image}
                                    <label>
                                        <span class="title">{$cap_image}</span>
                                        <span class="frame_form_field">
                                            <span class="icon-replay"></span>
                                            {if $captcha_type == 'captcha'}
                                                <input type="text" name="captcha" id="captcha" />
                                                <label id="for_captcha" class="for_validations"></label>
                                            {/if}
                                        </span>
                                    </label>
                                {/if}
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

