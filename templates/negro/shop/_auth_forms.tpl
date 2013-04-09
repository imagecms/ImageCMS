<!-- Order call form -->
<div class="drop-popup drop drop-order-call">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="header-title">
        Заказ звонка
    </div>
    <div class="drop-content">
        <div class="drop-content-inside">
            <div class="inside-padd">
                <div class="standart_form horizontal-form">
                    <form method="post" action="{site_url('/shop/shop/callback')}" id="callback_form">
                        <div class="popup_container">
                            {include_tpl('callback')}
                        </div>
                        {form_csrf()}
                        <span class="datas"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>

<!-- Enter form -->
<div class="drop-popup drop drop-enter">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="header-title">
        Вход в магазин
    </div>
    <div class="drop-content">
        <div class="drop-content-inside">
            <div class="inside-padd">
                <div class="horizontal-form standart_form">
                    <form method="post" action="{site_url('auth/login')}" id="enter_form">
                        <div class="popup_container">
                            {include_tpl('../../login_popup')}
                        </div>
                        <div class="control-group">
                            <span class="control-label">&nbsp;</span>
                            <span class="controls c_n">
                                <span class="d_i-b">
                                    <span class="btn btn-drop">
                                        <input type="submit" value="Войти"/>
                                    </span>
                                </span>
                                <span class="d_b"><span class="d_l_b"  data-drop=".drop-forget" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">Напомнить пароль</span></span>
                            </span>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>

<!-- Register form -->
<div class="drop-popup drop drop-register">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="header-title">
        Регистрация
    </div>
    <div class="drop-content">
        <div class="drop-content-inside">
            <div class="inside-padd">
                <div class="horizontal-form standart_form">
                    <form method="post" action="{site_url('auth/login')}" id="register_form">
                        <div class="popup_container">
                            {include_tpl('../../register_popup')}
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>

<!-- Forgot Password form -->
<div class="drop-popup drop drop-forget">
    <div class="icon-times-drop" data-closed="closed-js"></div>
    <div class="header-title">
        Напоминание пароля
    </div>
    <div class="drop-content">
        <div class="drop-content-inside">
            <div class="inside-padd">
                <div class="horizontal-form standart_form">
                    <form method="post" action="{site_url('auth/forgot_password')}" id="remember_form">
                        <div class="popup_container">
                            {include_tpl('../../forgot_popup')}
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>

<!-- Report Appearance form -->                        
<div class="drop-popup drop drop-report">
    <button type="button" class="icon-times-drop" data-closed="closed-js"></button>
    <div class="drop-content">
        <div class="header-title">Сообщить о появлении</div>
        <div class="drop-content-inside">
            <div class="inside-padd">
                <div class="horizontal-form standart_form">
                    <form method="post" action="" id="notifMe_form">
                        reportFormData
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="d_n reportFormData">
    <input type="hidden" name="notifme" value="1" />
    <div class="popup_container">
        {include_tpl('report_popup')}
    </div>
    <span class="datas"></span>
</div>

{if $CI->uri->segment(2) == "product"}    
    <div class="frame-drop-comment" data-rel="whoCloneAddPaste">
        <div class="form-comment horizontal-form">
            <div class="title_h3">Ваш ответ</div>
            <form method="post" action="/comments/add" class="comment_form">
                <div class="drop_comm_container"></div>
                <label class="control-group" for="text_author">
                    <span class="control-label">Ваше имя:</span>
                    <span class="controls">
                        <input type="text" name="comment_author" id="text_author" class="required" />
                    </span>
                </label>
                <label class="control-group">
                    <span class="control-label">Комментарий</span>
                    <span class="controls">
                        <textarea name="comment_text" class="required"></textarea>
                    </span>
                </label>
                <div class="control-group">
                    <span class="control-label">&nbsp;</span>
                    <span class="controls">
                        <span class="btn btn-order-product">
                            <input type="submit" value="Отправить"/>
                        </span>
                    </span>
                </div>
                <span class="datas">
                    <input type="hidden" name="comment_item_id" value="{echo $model->getId()}" />
                    <input type="hidden" name="comment_parent" value="0" />
                    <input type="hidden" name="module" value="shop"/>
                </span>
            </form>
        </div>
    </div>
{/if}

<div class="apply">
    <div>
        <div class="description">Найдено <span id="apply-count">5</span> тов.</div>
        <a href="#">Показать</a>
    </div>
    <span class="icon-times-apply"></span>
</div>