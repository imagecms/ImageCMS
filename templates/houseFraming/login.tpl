<div class="wrap">
    <div class="content" style="margin: auto; float: none">
        <div class="content_bottom">
            <h2>{lang('Log in', 'houseFraming')}</h2>
            <div class="contact-form">
                <form method="post" action="{site_url('auth/login')}">
                    {if validation_errors()}<div class="errors">{validation_errors()}</div>{/if}
                    {if $message_sent}
                        <div style="color: green;">{lang('Your message has been sent.', 'feedback')}</div>
                    {else:}
                        <div>
                            <span><label>{lang('E-mail', 'houseFraming')}</label></span>
                            <span><input name="email" type="text" class="textbox" value="{if $_POST.email}{$_POST.email}{/if}"></span>
                        </div>
                        <div>
                            <span><label>{lang('Password', 'houseFraming')}</label></span>
                            <span><input name="password" type="password" class="textbox" value=""></span>
                        </div>                        
                        <div>
                            <span><input type="submit" class="submit_button" value="{lang('Log in', 'houseFraming')}"></span>
                        </div>
                        <input type="hidden" name="theme" value="First Theme" />
                        {form_csrf()}
                    {/if}
                </form>
            </div>            
        </div>
    </div>   
    <div class="clear"></div>
</div>