<div class="horizontal-form">
    <form method="post" id="form_change_info" onsubmit="ImageCMSApi.formAction('/shop/profileapi/changeInfo', '#form_change_info', {literal}{hideForm: false, durationHideForm: 1000}{/literal});
            return false;">
        <label>
            <span class="title">{lang('s_c_uoy_name_u')}:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getName())}" name="name"/>
                <span class="help-block">{lang('s_email_4_sumbls')}</span>
            </span>
        </label>
        <label>
            <span class="title">{lang('s_phone')}:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
            </span>
        </label>
        <label>
            <span class="title">Email:</span>
            <span class="frame-form-field">
                <input type="text" disabled="disabled" value="{echo encode($profile->getUserEmail())}" name="email"/>
                <input type="hidden" value="{echo encode($profile->getUserEmail())}" name="email"/>
                <span class="help-block">{lang('s_email_is_login')}</span>
            </span>
        </label>
        <label>
            <span class="title">Город:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
            </span>
        </label>
        <label>
            <span class="title">Адрес:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
            </span>
        </label>
        <div class="frame-label">
            <span class="title">&nbsp;</span>
            <span class="frame-form-field">
                <span class="btn-form">
                    <input type="submit" value="Сохранить данные"/>
                </span>
            </span>
        </div>
        {form_csrf()}
    </form>
</div>