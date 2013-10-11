<div class="inside-padd">
    <div class="frame-change-password">
        <div class="horizontal-form big-title">
            <form method="post" id="form_change_pass" onsubmit="ImageCMSApi.formAction('/auth/authapi/change_password', '#form_change_pass', {literal}{hideForm: false, durationHideForm: 1000}{/literal});
                                    return false;">
                <label>
                    <span class="title">{lang('Старый пароль','newLevel')}:</span>
                    <span class="frame-form-field">
                        <input type="password" name="old_password"/>
                    </span>
                </label>
                <label>
                    <span class="title">{lang('Новый пароль','newLevel')}:</span>
                    <span class="frame-form-field">
                        <input type="password" name="new_password"/>
                    </span>
                </label>
                <label>
                    <span class="title">{lang('Повторите пароль','newLevel')}:</span>
                    <span class="frame-form-field">
                        <input type="password" name="confirm_new_password"/>
                    </span>
                </label>
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <span class="frame-form-field">
                        <span class="btn-form">
                            <input type="submit" value="{lang('Изменить пароль','newLevel')}"/>
                        </span>
                    </span>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>