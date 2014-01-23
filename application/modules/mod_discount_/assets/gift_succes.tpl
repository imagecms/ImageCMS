<div class="groups_form" >
    <label for="giftcert">
        <span class="title">{lang('Certificate code', 'mod_discount')}</span>
        <span class="frame_form_field">
            <div class="o_h">
                {echo $gift->key} {lang('on amount', 'mod_discount')}:{echo $gift->value}
                <input type="hidden" name="giftkey" value="{echo $gift->key}"/>
            </div>
        </span>
    </label>
</div>