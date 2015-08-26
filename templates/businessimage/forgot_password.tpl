<div class="b-auth">
    <div class="g-container">
        <h1 class="b-content__title">
            {tlang('Request new password')}
        </h1>
        <div class="g-row">
            <div class="g-col-6 g-col-12_from-m">     
                <form class="g-form-m g-form-m_main" action="{site_url('auth/forgot_password')}" method="post">
                    {if $success}
                    <div class="g-form-m__message g-form-m__message_success">
                        {$success}
                    </div>
                    {/if}
                    {if $errors}
                    <div class="g-form-m__message g-form-m__message_error">
                        {$errors}
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
                        </div>
                        {if form_error('email')}
                        <i class="g-form-m__field-error">{form_error('email')}</i>
                        {/if}
                        <p class="g-form-m__field-desc">{tlang('Please enter the e-mail associated with your account.')}</p>
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
                        <input class="g-form-m__button-submit g-btn_l" type="submit" value="{tlang('Send request')}">
                        <div class="g-form-m__add-links">
                            <a class="g-form-m__add-link g-link" href="{site_url('auth')}">{tlang('Sign in')}</a>
                            <a class="g-form-m__add-link g-link" href="{site_url('auth/register')}">{tlang('Create Account')}</a>
                        </div>
                    </div>  
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>