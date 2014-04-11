<div class="fancy enter_form" >    
    <h1>{lang("Registration","admin")}</h1>
    {if !$succes}
        <form method="post" action="{site_url('auth/register')}" id="reg">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}
        <label>{lang("Email","admin")}
            <input type="text" name="email" id="email" value="{set_value('email')}" />
        </label>
        <label>{lang("Name","admin")}
            <input type="text" name="username" value="" />
        </label>
        <label>{lang("Password","admin")}
            <input type="password" name="password" id="passwordreg" />
        </label>
        <label>{lang("Repeat Password","admin")}
            <input type="password" name="confirm_password" id="confirm_password" />
        </label>
        {if $cap_image}
            <div class="comment_form_info">
                <div class="textbox captcha">
                    <input type="text" name="captcha" id="captcha" value="{lang("Code protection","admin")}" onfocus="if (this.value == '{lang("Code protection","admin")}')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = '{lang("Code protection","admin")}';"/>
                </div>
                {$cap_image}
            </div>
        {/if}
        <div class="p-t_19 clearfix">
            <div class="p-t_19 t-a_c">
                <div class="buttons button_middle_blue">
                    <input type="submit" value="{lang("Sign up","admin")}">
                </div>
            </div>
            <div class="t-a_c">
                <a href="{$BASE_URL}auth/login" class="button_middle_blue_neigh auth_me">
                    {lang("Authorization","admin")}
                </a><br/>
                <a href="{$BASE_URL}auth/forgot_password" class="button_middle_blue_neigh forgot_password">
                    {lang("Forgot your password?","admin")}
                </a>
            </div>
        </div>

        {form_csrf()}
    </form> 
{else:}

    <div style="height: 42px;">{lang("You have successfully registered. Sign In")}</div>    
{/if}
</div>
