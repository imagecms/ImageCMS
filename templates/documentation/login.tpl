<div class="container">
    
        <h1>{lang('Authorization','documentation')}</h1>
    
        {if $errors}
            <div class="alert alert-block alert-danger fade in">
                {echo $errors}
            </div>
        {/if}
        <form method="post" id="login_form" onsubmit="'/auth/authapi/login';">
            <table class="custom_form_table">
                <tr>
                    <td>
                        <label for="email">
                            {lang('Email','corporate')}
                            <span class="must">*</span>
                        </label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Email" class="form-control"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">
                            {lang('Password','newLevel')}
                            <span class="must">*</span>
                        </label>
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Password" class="form-control"/>
                    </td>
                </tr>
                {if $cap_image}
                    <tr>
                        <td colspan="2">
                            {$cap_image}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="captcha" id="captcha" placeholder="{lang("Code protection","admin")}" />
                        </td>
                    </tr>
                {/if}
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2" class="controls_table_row">
                        <button type="button" class="btn" data-drop=".drop-enter" data-location="{site_url('auth/register')}" onclick="window.location = this.getAttribute('data-location')">
                            {lang('Sign up','corporate')}
                        </button>
                        <button type="button" class="btn" data-drop=".drop-forgot" data-location="{site_url('auth/forgot_password')}" onclick="window.location = this.getAttribute('data-location')">
                            {lang('Forgot password?','corporate')}
                        </button>
                        <button type="submit" class="btn btn-primary pull-right">
                            <span class="glyphicon glyphicon-log-in"></span>
                            {lang('Sign in','documentation')}
                        </button>
                    </td>
                </tr>
            </table>

            {form_csrf()}
        </form>
   
</div>