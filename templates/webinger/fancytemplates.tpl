<div class="drop-forgot-password drop">
    <button type="button" class="icon-times-enter" data-closed="closed-js"></button>
    <div class="drop-content">
        <div class="header_title">
{lang('Забыли пароль', 'webinger')}
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post">
                    <div class="groups_form">
                        <label>
                            <span class="title">{lang('Email','webinger')}</span>
                            <span class="frame_form_field">
                                <span class="icon-email"></span>
                                <input type="text" name="email" id="login" />
                                <span class="help_inline">{lang('Введите e-mail указаный при регистрации', 'webinger')}</span>
                            </span>
                        </label>
                        <div class="frameLabel c_t">
                            <span class="title">&nbsp;</span>
                            <span class="frame_form_field">
                                <input type="submit" class="btn btn_cart" value="{lang('Отправить','webinger')}"/>
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