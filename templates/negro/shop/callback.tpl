<div class="drop-order-call drop drop-popup" id="ordercall">
    <button type="button" class="icon_times-drop" data-closed="closed-js"></button>
    <div class="drop-content" style="background-color: #E5E5E5; padding: 10px">
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
                            <span class="icon_person"></span>
                            <input type="text" name="Name"/>
                            <label id="for_Name" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Номер телефона</span>
                        <span class="frame_form_field">
                            <span class="icon_phone"></span>
                            <input type="text" name="Phone"/>
                            <label id="for_Phone" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Комментарий</span>
                        <span class="frame_form_field">
                            <textarea name="Comment"></textarea>
                            <label id="for_Comment" class="for_validations"></label>
                        </span>
                    </label>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <input type="submit" value="Позвоните мне" class="btn_cart f_r"/>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>