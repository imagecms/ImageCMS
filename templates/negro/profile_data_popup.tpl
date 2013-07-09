<div class="horizontal-form">
    <form method="post" id="form_change_info" onsubmit="ImageCMSApi.formAction('/shop/profileapi/changeInfo', 'form_change_info', {literal}{hideForm: false, messagePlace: 'ahead', durationHideForm: 1000}{/literal});
            return false;">
        <label>
            <span class="title">{lang('s_c_uoy_name_u')}:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getName())}" name="name"/>
                <label id="for_name" class="for_validations"></label>
                <span class="help-block">{lang('s_email_4_sumbls')}</span>
            </span>
        </label>
        <label>
            <span class="title">{lang('s_phone')}:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
                <label id="for_phone" class="for_validations"></label>
            </span>
        </label>
        <label>
            <span class="title">Email:</span>
            <span class="frame-form-field">
                <input type="text" disabled="disabled" value="{echo encode($profile->getUserEmail())}" name="email"/>
                <input type="hidden" value="{echo encode($profile->getUserEmail())}" name="email"/>
                <span class="help-block">{lang('s_email_is_login')}</span>
                <label id="for_email" class="for_validations"></label>
            </span>
        </label>
        <label>
            <span class="title">Город:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                <label id="for_address" class="for_validations"></label>
            </span>
        </label>
        <label>
            <span class="title">Адрес:</span>
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                <label id="for_address" class="for_validations"></label>
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