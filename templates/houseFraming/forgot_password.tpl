<div class="wrap">
    <div class="content" style="margin: auto; float: none">
        <div class="content_bottom">
            <h2>{lang('Forgot Password', 'houseFraming')}</h2>
            <div class="contact-form">
                <form method="post" action="{site_url('auth/forgot_password')}">
                    {if validation_errors()}<div class="errors">{validation_errors()}</div>{/if}
                    {if $info_message}
                        <div style="color: green;">{$info_message}</div>
                    {/if}
                    <div>
                        <span><label>{lang('E-mail', 'houseFraming')}</label></span>
                        <span><input name="email" type="text" class="textbox" value="{if $_POST.email}{$_POST.email}{/if}"></span>
                    </div>                                         
                    <div>
                        <span><input type="submit" class="submit_button" value="{lang('Send', 'houseFraming')}"></span>
                    </div>
                    <input type="hidden" name="theme" value="First Theme" />
                    {form_csrf()}

                </form>
            </div>            
        </div>
    </div>   
    <div class="clear"></div>
</div>