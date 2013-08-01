<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang("Registration","admin")}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">
	<div class="comment_form_info">
	
	<div class="textbox">
        <label for="email" class="left">{lang("Email","admin")}</label>
        <input type="text" size="30" name="email" id="email" value="{set_value('email')}" />
    </div>
	
	<div class="textbox_spacer"></div>
	
    <div class="textbox">
        <label for="username" class="left">{lang("Name","admin")}</label>
        <input type="text" size="30" name="username" id="username" value="{set_value('username')}"/>
        
    </div>

    <div class="textbox">
        <label for="password" class="left">{lang("Password","admin")}</label>
        <input type="password" size="30" name="password" id="password" value="{set_value('password')}" />
    </div>
	
	<div class="textbox_spacer"></div>

    <div class="textbox"
        <label for="confirm_password" class="left">{lang("Repeat Password","admin")}</label>
        <input type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
    </div>
	</div>
    
<!--	{if $cap_image}
    <div class="comment_form_info">
    <div class="textbox captcha">
        <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
   	</div>
    {$cap_image}
    </div>
    {/if}-->
 
    <p class="clear">
        <label for="submit" class="left">&nbsp;</label> 
        <input type="submit" id="submit" class="submit" value="{lang("Send","admin")}" />
    </p>

	
    <label class="left">&nbsp;</label> 
    <a href="{site_url($modules.auth . '/forgot_password')}">{lang("Forgot your password?","admin")}</a>
    &nbsp;
    <a href="{site_url('auth/login')}">Вход</a>

{form_csrf()}
</form>

