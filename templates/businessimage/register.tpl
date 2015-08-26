<div class="g-container">
    <h1 class="b-content__title">
        {tlang('Create Account')}
    </h1>
    <div class="g-row">
        <div class="g-col-6 g-col-12_from-m">
            <form class="g-form-m g-form-m_main" action="{site_url('auth/register')}" method="post">
                {if $info_message}
                <div class="g-form-m__message g-form-m__message_error">
                    {$info_message}
                </div>
                {/if}
                {if validation_errors()}
                <div class="g-form-m__message g-form-m__message_error">
                    {validation_errors('<p class="g-form-m__message-item">', '</p>')}
                </div>
                {/if}
                <div class="g-form-m__field">
                    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('E-mail')}</div>
                    <div class="g-form-m__field-section">
                        <input class="g-form-m__field-input" type="email" name="email" value="{set_value('email')}" required>
                        {if form_error('email')}
                        <i class="g-form-m__field-error">{form_error('email')}</i>
                        {/if}
                    </div>
                </div>
                <div class="g-form-m__field">
                    <div class="g-form-m__field-title">{tlang('Name')}</div>
                    <div class="g-form-m__field-section">
                        <input class="g-form-m__field-input" type="text" name="username" value="{set_value('username')}">
                        {if form_error('username')}
                        <i class="g-form-m__field-error">{form_error('username')}</i>
                        {/if}
                    </div>
                </div>
                <div class="g-form-m__field">
                    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Password')}</div>
                    <div class="g-form-m__field-section">
                        <input class="g-form-m__field-input" type="password" name="password" value="{set_value('password')}" required>
                    </div>
                    {if form_error('password')}
                    <i class="g-form-m__field-error">{form_error('password')}</i>
                    {/if}
                </div>
                <div class="g-form-m__field">
                    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Reenter password')}</div>
                    <div class="g-form-m__field-section">
                        <input class="g-form-m__field-input" type="password" name="confirm_password" value="{set_value('confirm_password')}" required>
                    </div>                    
                    {if form_error('confirm_password')}
                    <i class="g-form-m__field-error">{form_error('confirm_password')}</i>
                    {/if}
                </div>
                {if $cap_image}
                <div class="g-form-m__field">
                    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Security code')}</div>
                    <div class="g-form-m__field-section">
                        <div class="g-form-m__field-captcha g-clearfix">
                            <input class="g-form-m__field-input" type="text" name="captcha" required>
                            <i class="g-form-m__field-desc">{tlang('Type the characters you see in this image.')}</i>
                            {if form_error('captcha')}
                            <i class="g-form-m__field-error">{form_error('captcha')}</i>
                            {/if}
                            <div class="g-form-m__field-captcha-image">{$cap_image}</div>
                        </div>
                    </div>
                </div>
                {/if}
                <div class="g-form-m__buttons g-clearfix">
                    <input class="g-form-m__button-submit g-btn_l" type="submit" value="{tlang('Sign up')}">
                    <div class="g-form-m__add-links">
                        <a class="g-form-m__add-link g-link" href="{site_url('auth/forgot_password')}">{tlang('Forgot password?')}</a>
                        <a class="g-form-m__add-link g-link" href="{site_url('auth')}">{tlang('Sign in')}</a>
                    </div>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>