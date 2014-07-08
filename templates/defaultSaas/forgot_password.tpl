<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang("Забыли пароль?", "admin")}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<form action="" class="form" method="post">

	<div class="comment_form_info">
	
    <div class="textbox">
        <input type="text" size="30" name="email" id="login" value="{lang("Email","admin")}" onfocus="if(this.value=='{lang("Email","admin")}') this.value='';" onblur="if(this.value=='') this.value='{lang("Email","admin")}';" />
    </div>
	
	<br /><br /><br /><br />
    <input type="submit" id="submit" class="submit" value="{lang("Отправить","admin")}" />
	
    <br/><br />
	</div>
    <label class="left">&nbsp;</label> 
    <a href="{site_url('auth/login')}">Вход</a>
    &nbsp;
    <a href="{site_url($modules.auth . '/register')}">{lang("Регистрация","admin")}</a>

{form_csrf()}
</form>
