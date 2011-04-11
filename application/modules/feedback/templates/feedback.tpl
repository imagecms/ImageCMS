<div id="titleExt"><h5>{widget('path')}<span class="ext">Контакты</span></h5></div>
<div id="contact">
<div class="left">

{if $form_errors}
    <div class="errors"> 
        {$form_errors}
    </div>
{/if}

{if $message_sent}
     Ваше сообщение отправлено.
{/if}

<form action="{site_url('feedback')}" method="post">
    <div class="textbox">
    <input type="text" id="name" name="name" class="text" value="{if $_POST.name}{$_POST.name}{else:}Ваше Имя{/if}" onfocus="if(this.value=='Ваше Имя') this.value='';" onblur="if(this.value=='') this.value='Ваше Имя';"/>
    </div>

    <div class="textbox">
        <input type="text" id="email" name="email" class="text" value="{if $_POST.email}{$_POST.email}{else:}Email{/if}" onfocus="if(this.value=='Email') this.value='';" onblur="if(this.value=='') this.value='Email';"/>
    </div>

    <div class="textbox">
        <input type="text" id="theme" name="theme" class="text" value="{if $_POST.theme}{$_POST.theme}{else:}Тема{/if}" onfocus="if(this.value=='Тема') this.value='';" onblur="if(this.value=='') this.value='Тема';"/>
    </div>

    <div class="textbox">
        <textarea cols="45" rows="10" name="message" id="message" onfocus="if(this.value=='Текст Сообщения') this.value='';" onblur="if(this.value=='') this.value='Текст Сообщения';">{if $_POST.message}{$_POST.message}{else:}Текст Сообщения{/if}</textarea>
    </div>
    
   	<div class="comment_form_info">
	{if $captcha_type =='captcha'}    
    	<div class="textbox captcha">
	    <input type="text" name="captcha" id="recaptcha_response_field" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
   	</div>
	{/if}
    {$cap_image}
    </div>
    
    <input type="submit" class="submit" value="{lang('lang_comment_button')}" />

    {form_csrf()}
</form>
</div>
<div class="right">
<div id="detail">
<h2 id="title">Контакты</h2>
{widget('contacts')}
</div>
</div>
</div>