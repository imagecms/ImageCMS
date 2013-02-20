<article>
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
            <a href="{site_url()}" rel="v:url" property="v:title">Главная</a>
        </span>/
        <span typeof="v:Breadcrumb">
            <span rel="v:url" property="v:title">Смена пароля</span>
        </span>
    </div>
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
                        <form method="post" id="forgot_password_form">
                            <div class="groups_form">
                                <label>
                                    <span class="title">Старый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="old_password" id="login" />
                                        <span class="help_inline"></span>
                                        <div id="for_old_password" class="for_validations"></div>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Новый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="new_password" id="login" />
                                        <span class="help_inline"></span>
                                        <div id="for_new_password" class="for_validations"></div>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Повторите новый пароль</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="text" name="confirm_new_password" id="login" />
                                        <span class="help_inline"></span>
                                        <div id="for_confirm_new_password" class="for_validations"></div>
                                    </span>
                                </label>
                                <div class="frameLabel c_t">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field">
                                        <input type="submit" class="btn btn_cart" value="{lang('lang_submit')}" onclick="ImageCMSApi.formAction('/auth/authapi/change_password', 'forgot_password_form');
                                            return false;"/>
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

