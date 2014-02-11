<div class="wrap">
    <div class="content" style="margin: auto; float: none">
        <div class="content_bottom">
            <h2>{lang('Register', 'houseFraming')}</h2>
            <div class="contact-form">
                <form method="post" action="{site_url('auth/register')}">
                    {if validation_errors()}<div class="errors">{validation_errors()}</div>{/if}
                    {if $auth_message}
                        <div style="color: green;">{$auth_message}</div>
                    {else:}
                        <div>
                            <span><label>{lang('User E-mail', 'houseFraming')}</label></span>
                            <span><input name="email" type="text" class="textbox"></span>
                        </div>
                        <div>
                            <span><label>{lang('User Name', 'houseFraming')}</label></span>
                            <span><input name="username" type="text" class="textbox"></span>
                        </div>
                        <div>
                            <span><label>{lang('Password', 'houseFraming')}</label></span>
                            <span><input name="password" type="password"></span>
                        </div>
                        <div>
                            <span><label>{lang('Confirm Password', 'houseFraming')}</label></span>
                            <span><input name="confirm_password" type="password"></span>
                        </div>
                        <div>
                            <span><input type="submit" class="mybutton" value="Submit"></span>
                        </div>
                        {form_csrf()}
                    {/if}
                </form>
            </div>            
        </div>
    </div>   
    <div class="clear"></div>
</div>