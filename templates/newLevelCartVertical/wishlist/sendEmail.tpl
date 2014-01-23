<div class="drop-sendemail drop drop-style" id="sendMail">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Отправить другу','newLevel')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="POST" onsubmit="return false;">
                    <label class="frame-label">
                        <span class="title">{lang('Email друга','newLevel')}:</span>
                        <span class="frame-form-field">
                            <input type="text" name = "email" />
                        </span>
                    </label>
                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="btn-form">
                                <button type="submit" data-modal="true" data-source="{site_url('/wishlist/wishlistApi/send_email')}" data-drop="#notification" data-type="json" onclick="serializeForm(this)">
                                    <span class="text-el">{lang('Отправить','newLevel')}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name = "wish_list_id" value="{echo $wish_list_id}"/>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>