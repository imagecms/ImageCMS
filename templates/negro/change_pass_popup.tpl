<form method="post" id="form_change_pass">
<label>
    <span class="title">{lang('lang_old_password')}:</span>
    <span class="frame-form-field">
        <input type="password" name="old_password"/>
        <label id="for_old_password" class="for_validations"></label>
    </span>
</label>
<label>
    <span class="title">{lang('lang_new_password')}:</span>
    <span class="frame-form-field">
        <input type="password" name="new_password"/>
        <label id="for_new_password" class="for_validations"></label>
    </span>
</label>
<label>
    <span class="title">{lang('s_newpassword')}:</span>
    <span class="frame-form-field">
        <input type="password" name="confirm_new_password"/>
        <label id="for_confirm_new_password" class="for_validations"></label>
    </span>
</label>
<div class="control-group">
    <span class="control-label">&nbsp;</span>
    <span class="controls">
        <span class="btn-order-product">
        <input type="submit" value="{lang('s_save')}" class="btn" onclick="ImageCMSApi.formAction('/auth/authapi/change_password', 'form_change_pass');
    return false;"/>
        </span>
    </span>
</div>
{form_csrf()}
</form>