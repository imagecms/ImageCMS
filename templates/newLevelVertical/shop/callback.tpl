<div class="drop-order-call drop drop-style" id="ordercall">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Заказать звонок','newLevelVertical')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form ">
                <form method="post" id="data-callback" onsubmit="ImageCMSApi.formAction('{site_url("/shop/callbackApi")}', '#data-callback', {literal}{drop: '.drop-order-call', 'durationHideForm': 7000, callback: function(msg, status, form, DS) {
                                if (status) {
                                    hideDrop(DS.drop, form, DS.durationHideForm);
                                }
                            }}{/literal});
                                return false;">
                    <label>
                        <span class="title">{lang('Имя: ','newLevelVertical')}</span>
                        <span class="frame-form-field">
                            <span class="must">*</span>
                            <input type="text" name="Name"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('Телефон: ','newLevelVertical')}</span>
                        <span class="frame-form-field">
                            <span class="must">*</span>
                            <input type="text" name="Phone"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">{lang('Комментарий: ','newLevelVertical')}</span>
                        <span class="frame-form-field">
                            <textarea name="Comment"></textarea>
                        </span>
                    </label>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="btn-form">
                                <button type="submit">
                                    <span class="text-el">{lang('Позвоните мне','newLevelVertical')}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>