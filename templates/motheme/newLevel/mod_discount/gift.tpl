<div class="groups-form" >
    <label for="giftcert" class="label-gift-cert">
        <span class="title">{lang('Промо код:','newLevel')}</span>
        <span class="frame-form-field p_r">
            <div class="btn-def f_r">
                <button type="button" id="applyGiftCert" onclick="applyGift();
                    return false"><span class="text-el">{lang('Применить','newLevel')}</span></button>
            </div>
            <div class="o_h">
                <input type="text" name="giftcert" value="" />
                <span class="icon_success"></span>
            </div>
            <div class="preloader"></div>
        </span>
    </label>
</div>