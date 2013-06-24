<div class="groups_form" >
    <label for="giftcert">
        <span class="title">{lang('s_cert_code')}</span>
        <span class="frame_form_field">
            <button class="btn f_r" id="applyGiftCert">{lang('s_apply_sertif')}</button>
            <div class="o_h">
                <input type="text" name="giftcert" value="">
            </div>
            {if $isRequired['giftcert']}
                <span class="must">*</span>
            {/if}
        </span>
    </label>
</div>