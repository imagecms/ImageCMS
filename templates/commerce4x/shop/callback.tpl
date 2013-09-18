<div class="drop-order-call drop" id="ordercall">
    <button type="button" class="icon-times-enter" data-closed="closed-js"></button>
    <div class="drop-content">
        <div class="header_title">
            Заказ звонка
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post" id="data-callback" onsubmit="Notification.formAction('/shop/callbackApi', 'data-callback');
                        return false;">
                    <label>
                        <span class="title">Ваше имя</span>
                        <span class="frame_form_field">
                            <span class="icon-person"></span>
                            <input type="text" name="Name" maxlength="50" />
                            <label id="for_Name" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Номер телефона</span>
                        <span class="frame_form_field">
                            <span class="icon-phone"></span>
                            <input type="text" name="Phone"  maxlength="36"/>
                            <label id="for_Phone" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Комментарий</span>
                        <span class="frame_form_field">
                            <textarea name="Comment" maxlength="1000" ></textarea>
                            <label id="for_Comment" class="for_validations"></label>
                        </span>
                    </label>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <input type="submit" value="Позвоните мне" class="btn btn_cart f_r"/>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>