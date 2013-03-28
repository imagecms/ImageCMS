<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang("Forgot your password?")}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">

	<div class="comment_form_info">
	
    <div class="textbox">
        <input type="text" size="30" name="email" id="login" value="{lang("Email")}" onfocus="if(this.value=='{lang("Email")}') this.value='';" onblur="if(this.value=='') this.value='{lang("Email")}';" />
    </div>
	
	<br /><br /><br /><br />
    <input type="submit" id="submit" class="submit" value="{lang("Send")}" />
	
    <br/><br />
	</div>
    <label class="left">&nbsp;</label> 
    <a href="{site_url('auth/login')}">Вход</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang("Registration")}</a>

{form_csrf()}
</form>
