<div class="drop-order-call drop" id="ordercall">
    <button type="button" class="icon-times-enter" data-closed="closed-js"></button>
    <div class="drop-content">
        <div class="header_title">
            {lang('Заказ звонка', 'webinger')}
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post" id="data-callback" onsubmit="Notification.formAction('/shop/callbackApi', 'data-callback');
                        return false;">
                    <label>
                        <span class="title">{lang('Ваше имя', 'webinger')}</span>
                        <span class="frame_form_field">
                            <span class="icon-person"></span>
                            <input type="text" name="Name"/>
                            <label id="for_Name" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('Номер телефона', 'webinger')}</span>
                        <span class="frame_form_field">
                            <span class="icon-phone"></span>
                            <input type="text" name="Phone"/>
                            <label id="for_Phone" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('Комментарий', 'webinger')}</span>
                        <span class="frame_form_field">
                            <textarea name="Comment"></textarea>
                            <label id="for_Comment" class="for_validations"></label>
                        </span>
                    </label>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <input type="submit" value="{lang('Позвоните мне', 'webinger')}" class="btn btn_cart f_r"/>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>