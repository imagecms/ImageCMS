<div class="drop drop-report drop-style">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">Сообщить, когда появится в продаже</div>
    </div>
    <div class="drop-content">
        <div class="inside-padd" data-rel="pastehere">
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="d_n" data-clone="data-report">
      <form method="post" action="" id="data-report" onsubmit="Notification.formAction('/shop/ajax/getApiNotifyingRequest', 'data-report', '.items');
          return false;">
        <div class="horizontal-form">
            <label>
                <span class="title">Ваше имя</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserName"/>
                    <label id="for_UserName" class="for_validations"></label>
                    <span class="must">*</span>
                </span>
            </label>
            <label>
                <span class="title">E-mail</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserEmail"/>
                    <label id="for_UserEmail" class="for_validations"></label>
                    <input type="hidden" name="ProductId" value=""/>
                    <input type="hidden" name="notifme" value="true"/>
                    <span class="must">*</span>
                    <span class="help-block">На почту придет уведомление о появлении данного товара</span>
                </span>
            </label>
            <label>
                <span class="title">Телефон</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserPhone"/>
                    <label id="for_UserPhone" class="for_validations"></label>
                </span>
            </label>
            <div class="frame-label">
                <span class="title">&nbsp;</span>
                <span class="frame-form-field">
                    <div class="btn-form">
                        <button type="submit">
                            <span class="text-el">Отправить</span>
                        </button>
                    </div>
                </span>
            </div>
        </div>
    </form>
</div>