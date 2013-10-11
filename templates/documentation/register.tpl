<div class="frame-inside">
    <div class="container">
        <h1>{lang('Registration','corporate')}</h1>
        <div class="">
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
            
            <form id="register-form" method="POST">
                <table class="custom_form_table">
                    <tr>
                        <td>
                            <label for="email">{lang('Email','corporate')}</label>
                        </td>
                        <td>
                            <input class="form-control" type="text" size="30" name="email" id="email" value="{set_value('email')}" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="username">{lang('Name','corporate')}</label>
                        </td>
                        <td>
                            <input class="form-control" type="text" size="30" name="username" id="username" value="{set_value('username')}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">{lang('Password','corporate')}</label>
                        </td>
                        <td>
                            <input class="form-control" type="password" size="30" name="password" id="password" value="{set_value('password')}" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="confirm_password">{lang('Repeat password','corporate')}</label>
                        </td>
                        <td>
                            <input class="form-control" type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
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
                                <input type="text" name="captcha" id="captcha"/>
                            </td>
                        </tr>
                    {/if}
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="controls_table_row">
                            <button type="button" class="btn" data-drop=".drop-enter" data-location="{site_url('auth/login')}" onclick="window.location = this.getAttribute('data-location')">
                                {lang('Sign in','corporate')}
                            </button>
                            <button type="button" class="btn" data-drop=".drop-forgot" data-location="{site_url('auth/forgot_password')}" onclick="window.location = this.getAttribute('data-location')">
                                {lang('Forgot password?','corporate')}
                            </button>
                            <input  class="btn btn-primary pull-right" type="submit" id="submit" class="submit" value="{lang('Sing up','corporate')}" />
                        </td>
                    </tr>
                </table>

                <input type="hidden" name="refresh" value="false"/>
                <input type="hidden" name="redirect" value="{site_url('/')}"/>
                {form_csrf()}
            </form>
        </div>
    </div>
</div>