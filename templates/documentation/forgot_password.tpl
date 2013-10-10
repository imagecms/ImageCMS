<div class="drop drop-style drop-forgot">


    <h1>{lang('Forgot password?','corporate')}</h1>

    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
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
                <form  method="post" id="forgot_password_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/forgot_password', '#forgot_password_form', {literal}{drop: '.drop-forgot', callback: function(msg, status, form, DS) {
                                if (status) {
                                    hideDrop(DS.drop, form, DS.durationHideForm);
                                }
                            }}{/literal});
                        return false;">

                    <table class="custom_form_table">
                        <tr>
                            <td>
                                <label for="email">
                                    {lang('Email','corporate')}
                                </label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Email" class="form-control"/>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="controls_table_row">
                                <button type="button" class="btn" data-location="{site_url('auth/register')}" onclick="window.location = this.getAttribute('data-location')">
                                    {lang('Sing up','corporate')}
                                </button>
                                <button type="button" class="btn" data-location="{site_url('auth/login')}" onclick="window.location = this.getAttribute('data-location')">
                                    {lang('Sign in','corporate')}
                                </button>
                                <input type="submit" id="submit" class="btn btn-primary pull-right" value="{lang('Send','corporate')}" />
                            </td>
                        </tr>
                    </table>




                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>