<form method="post" id="form_change_info" onsubmit="ImageCMSApi.formAction('/shop/profileapi/changeInfo', 'form_change_info');return false;">
    <label class="control-group">
        <span class="title">{lang('s_c_uoy_name_u')}:</span>
        <span class="row">
            <span class="frame-form-field">
                <input type="text" value="{echo encode($profile->getName())}" name="name"/>
                <label id="for_name" class="for_validations"></label>
                <span class="help_inline">{lang('s_email_4_sumbls')}</span>
            </span>
        </span>
    </label>
    <label class="control-group">
        <span class="title">{lang('s_c_uoy_user_el')}:</span>
        <span class="frame-form-field">
            <input type="text" disabled="disabled" value="{echo encode($profile->getUserEmail())}" name="email"/>
            <input type="hidden" value="{echo encode($profile->getUserEmail())}" name="email"/>
            <span class="help_inline">{lang('s_email_is_login')}</span>
            <label id="for_email" class="for_validations"></label>
        </span>
    </label>
    <label class="control-group">
        <span class="title">{lang('s_phone')}:</span>
        <span class="frame-form-field">
            <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
            <label id="for_phone" class="for_validations"></label>
        </span>
    </label>
    <label class="control-group">
        <span class="title">{lang('s_profile_me_address')}:</span>
        <span class="frame-form-field">
            <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
            <label id="for_address" class="for_validations"></label>
        </span>
    </label >
    <div class="control-group">
        <span class="control-label">&nbsp;</span>
        <span class="controls">
            <span class="btn-order-product">
                <input type="submit" value="Сохранить данные"/>
            </span>
        </span>
    </div>
    {form_csrf()}
</form>