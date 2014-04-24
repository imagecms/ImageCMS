<div class="sidebar_right_top">
    {widget('news')}
</div>
<div class="sidebar_right_bottom">
    {if $CI->dx_auth->is_logged_in()}
    <h3>{lang('Member Profile', 'houseFraming')}</h3>
    {else:}
    <h3>{lang('Member Login', 'houseFraming')}</h3>
    {/if}
    <div class="login_form">
        {if $CI->dx_auth->is_logged_in()}
            <h4>{lang('Hello,', 'houseFraming')} {echo $CI->dx_auth->get_username()}</h4>
            <h4><a href="{site_url('auth/logout')}">{lang('Log Out', 'houseFraming')}</a></h4>
        {else:}
            <form method="post" action="/auth/login">
                <div>
                    <span><label>{lang('User E-mail', 'houseFraming')}</label></span>
                    <span><input name="email" type="text" class="textbox"></span>
                </div>
                <div>
                    <span><label>{lang('Password', 'houseFraming')}</label></span>
                    <span><input name="password" type="password"></span>
                </div>
                <div>
                    <span><input type="submit" class="mybutton" value="Submit"></span>
                </div>
                <span><a href="{site_url('auth/forgot_password')}">{lang('Forgot Password ?', 'houseFraming')}</a></span>
                {form_csrf()}
            </form>
            <h4>{lang('Free registration', 'houseFraming')} <a href="{site_url('auth/register')}">{lang('Click here', 'houseFraming')}</a></h4>
        {/if}
    </div>
</div>