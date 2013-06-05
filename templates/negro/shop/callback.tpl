<div class="drop-order-call drop drop-style" id="ordercall">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            Заказ звонка
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form ">
                <form method="post" id="data-callback" onsubmit="Notification.formAction('/shop/callbackApi', 'data-callback');
                    return false;">
                    <label>
                        <span class="title">Ваше имя:</span>
                        <span class="frame-form-field">
                            <span class="icon_person"></span>
                            <input type="text" name="Name"/>
                            <label id="for_Name" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Ваш телефон:</span>
                        <span class="frame-form-field">
                            <span class="icon_phone"></span>
                            <input type="text" name="Phone"/>
                            <label id="for_Phone" class="for_validations"></label>
                        </span>
                    </label>
                    <label>
                        <span class="title">Комментарий:</span>
                        <span class="frame-form-field">
                            <textarea name="Comment"></textarea>
                            <label id="for_Comment" class="for_validations"></label>
                        </span>
                    </label>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <span class="frame-form-field">
                            <span class="btn-form">
                                <button type="submit">
                                    <span class="icon_order_drop"></span>
                                    <span class="text-el">Позвоните мне</span>
                                </button>
                            </span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>