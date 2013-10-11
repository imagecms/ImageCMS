<div class="drop drop-report drop-style">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">{lang('Сообщить о появлении','newLevel')}</div>
    </div>
    <div class="drop-content">
        <div class="inside-padd" data-rel="pastehere">

        </div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="d_n" data-clone="data-report">
    <form method="post" action="" id="data-report" onsubmit="ImageCMSApi.formAction('/shop/ajax/getApiNotifyingRequest', '#data-report', {literal}{drop: '.drop-report', callback: function(msg, status, form, DS) {
                    if (status) {
                        $(DS.drop).find('.items > li').children().remove();
                        hideDrop(DS.drop, form, DS.durationHideForm);
                    }
                }}{/literal});
                    return false;">
        <div class="horizontal-form">
            <label>
                <span class="title">{lang('Ваше имя:','newLevel')}</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserName" value="{echo $user_name}"/>
                    <span class="must">*</span>
                </span>
            </label>
            <label>
                <span class="title">E-mail</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserEmail" value="{echo $user_email}"/>
                    <span class="must">*</span>
                    <span class="help-block">{lang('Вы получите письмо, когда товар будет доступен','newLevel')}</span>
                </span>
            </label>
            <label>
                <span class="title">{lang('Телефон:','newLevel')}</span>
                <span class="frame-form-field">
                    <input type="text" id="" name="UserPhone"/>
                </span>
            </label>
            <label>
                <span class="title">{lang('Комментарий:','newLevel')}</span>
                <span class="frame-form-field"><textarea name="UserComment"></textarea></span>
            </label>
            <div class="frame-label">
                <span class="title">&nbsp;</span>
                <span class="frame-form-field">
                    <div class="btn-form">
                        <button type="submit">
                            <span class="text-el">{lang('Отправить','newLevel')}</span>
                        </button>
                    </div>
                </span>
            </div>
        </div>
        <input type="hidden" name="ProductId" value=""/>
        <input type="hidden" name="notifme" value="true"/>
        {form_csrf()}
    </form>
</div>