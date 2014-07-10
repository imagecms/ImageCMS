<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang("Authorization","admin")}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" method="post" class="form">

    <div class="comment_form_info">

        <div class="textbox">
            <label for="username" class="left">{lang("Email","admin")}</label>
            <input type="text" id="username" size="30" name="email" value="{lang("Enter email","admin")}" onfocus="if (this.value == '{lang("Enter email","admin")}')
                    this.value = '';" onblur="if (this.value == '')
                    this.value = '{lang("Enter email","admin")}';" />
        </div>

        <div class="textbox_spacer"></div>

        <div class="textbox">
            <label for="password" class="left">{lang("Password","admin")}</label> 
            <input type="password" size="30" name="password" id="password" value="{lang("Password","admin")}" onfocus="if (this.value == '{lang("Password","admin")}')
                    this.value = '';" onblur="if (this.value == '')
                    this.value = '{lang("Password","admin")}';"/>
        </div>
    </div>

    {if $cap_image}
        <div class="comment_form_info">
            <div class="textbox captcha">
                <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if (this.value == 'Код протекции')
                    this.value = '';" onblur="if (this.value == '')
                    this.value = 'Код протекции';"/>
            </div>
            {$cap_image}
        </div>
    {/if}

    <p class="clear">
        <label for="remember" class="left">&nbsp;</label> 
        <label><input type="checkbox" name="remember" value="1" id="remember" /> {lang("Remember me","admin")}</label>
    </p>

    <input type="submit" id="submit" class="submit" value="{lang("Send","admin")}" /> 


    <br /><br />

    <label class="left">&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang("Forgot your password?","admin")}</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang("Registration","admin")}</a>

    {form_csrf()}
</form>
