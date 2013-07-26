<div class="groups_form" >
    <label for="giftcert">
        <span class="title">{lang('s_cert_code')}</span>
        <span class="frame_form_field">
            <div class="o_h">
                {echo $gift->key} на сумму:{echo $gift->value}
                <input type="hidden" name="giftkey" value="{echo $gift->key}"/>
            </div>
        </span>
    </label>
</div>