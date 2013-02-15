<div class="drop-forgot-password drop">
    <div class="icon-times-enter" data-closed="closed-js"></div>
    <div class="drop-content">
        <div class="header_title">
            Забыли пароль
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post">
                    <div class="groups_form">
                        <label>
                            <span class="title">{lang('s_email')}</span>
                            <span class="frame_form_field">
                                <span class="icon-email"></span>
                                <input type="text" name="email" id="login" />
                                <span class="help_inline">Введите e-mail указаный при регистрации</span>
                            </span>
                        </label>
                        <div class="frameLabel c_t">
                            <span class="title">&nbsp;</span>
                            <span class="frame_form_field">
                                <input type="submit" class="btn btn_cart" value="{lang('lang_submit')}"/>
                            </span>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>