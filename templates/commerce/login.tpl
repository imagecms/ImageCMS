{$this->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW")}

<div id="titleExt"><span class="ext">{lang("Authorization","admin")}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors">
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<br/>

<form action="" method="post" class="form">

    <div class="fieldName">{lang("Email","admin")}</div>
    <div class="field">
        <input type="text" id="username" size="30" name="email" value="Введите Ваш логин" onfocus="if (this.value == 'Введите Ваш логин')
                            this.value = '';" onblur="if (this.value == '')
                            this.value = 'Введите Ваш логин';" />
    </div>
    <div class="clear"></div>

    <div class="fieldName">{lang("Password","admin")}</div>
    <div class="field">
        <input type="password" size="30" name="password" id="password" value="{lang("Password","admin")}" onfocus="if (this.value == '{lang("Password","admin")}')
                            this.value = '';" onblur="if (this.value == '')
                            this.value = '{lang("Password","admin")}';"/>
    </div>
    <div class="clear"></div>

    {if $cap_image}
        <div class="fieldName">{$cap_image}</div>
        {if $captcha_type == 'captcha'}
            <div class="field">
                <input type="text" name="captcha" id="captcha" value="{lang("Code protection","admin")}" onfocus="if (this.value == '{lang("Code protection","admin")}')
                            this.value = '';" onblur="if (this.value == '')
                            this.value = '{lang("Code protection","admin")}';"/>
            </div>
        {/if}
        <div class="clear"></div>
    {/if}

    <div class="fieldName"></div>
    <div class="field">
        <label><input type="checkbox" name="remember" value="1" id="remember" /> {lang("Remember me","admin")}</label>
    </div>
    <div class="clear"></div>

    <div class="fieldName"></div>
    <div class="field">
        <input type="submit" id="submit" class="submit" value="{lang("Send","admin")}" />
    </div>
    <div class="clear"></div>

    <div class="fieldName"></div>
    <div class="field">
        <a href="{site_url($modules.auth . '/forgot_password')}">{lang("Forgot your password?","admin")}</a>
        &nbsp;
        <a href="{site_url($modules.auth . '/register')}">{lang("Registration","admin")}</a>
    </div>
    <div class="clear"></div>

    {form_csrf()}
</form>
