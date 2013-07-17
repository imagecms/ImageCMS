<div class="groups-form">
    <div class="frame-label" for="giftcert">
        <span class="title">{lang('s_cert_code')}</span>
        <div class="frame-form-field">
            <div class="o_h">
                {echo $gift->key} на сумму:{echo $gift->value}
                <input type="hidden" name="giftkey" value="{echo $gift->key}"/>
            </div>
        </div>
    </div>
</div>