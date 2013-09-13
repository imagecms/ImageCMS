<div class="frame-inside">
    <div class="container">
        <h1>{lang('lang_register')}</h1>
        <div class="vertical-form w_50">
            {if validation_errors() OR $info_message}
                <div class="msg">
                    <div class="error"> 
                        <div class="text-el">
                            {validation_errors()}
                            {$info_message}
                        </div>
                    </div>
                </div>
            {/if}
            <form id="register-form" onsubmit="ImageCMSApi.formAction('/auth/authapi/register', '#register-form');
                    return false;">
                <label>
                    <span class="title">{lang('lang_email')}</span>
                    <span class="frame-form-field">
                        <input type="text" size="30" name="email" id="email" value="{set_value('email')}" />
                    </span>
                </label>
                <label>
                    <span class="title">{lang('s_fio')}</span>
                    <span class="frame-form-field">
                        <input type="text" size="30" name="username" id="username" value="{set_value('username')}"/>
                    </span>
                </label>
                <label>
                    <span class="title">{lang('lang_password')}</span>
                    <span class="frame-form-field">
                        <input type="password" size="30" name="password" id="password" value="{set_value('password')}" />
                    </span>
                </label>
                <label>
                    <span class="title">{lang('lang_confirm_password')}</span>
                    <span class="frame-form-field">
                        <input type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
                        </spans>
                </label>

                {if $cap_image}
                    <label>
                        <span class="title">&nbsp;</span>
                        <span class="frame-form-field">
                            <input type="text" name="captcha" id="captcha"/>
                        </span>
                        {$cap_image}
                    </label>
                {/if}
                <div class="frame-label">
                    <span class="frame-form-field">
                        <div class="btn">
                            <input type="submit" id="submit" class="submit" value="{lang('lang_submit')}" />
                        </div>
                    </span>
                </div>
                <button class="d_l" data-drop=".drop-forgot" data-source="{site_url('auth/forgot_password')}">{lang('lang_forgot_password')}</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="d_l" data-drop=".drop-enter" data-source="{site_url('auth')}">Вход</button>
                <input type="hidden" name="refresh" value="false"/>
                <input type="hidden" name="redirect" value="{site_url('/')}"/>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>