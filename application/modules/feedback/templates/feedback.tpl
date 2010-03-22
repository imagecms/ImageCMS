<h1>Обратная связь</h1>



{if $form_errors}
    <div class="errors"> 
        {$form_errors}
    </div>
{/if}

{if $message_sent}
    Ваше сообщение отправлено.
    {return}
{/if}

<form action="{site_url('feedback')}" method="post">
    <p class="clear">
        <label for="name" class="left">Ваше Имя</label>
        <input type="text" id="name" name="name" class="text" value="{$_POST.name}"/>
    </p>

    <p class="clear">
        <label for="email" class="left" >E-mail</label>
        <input type="text" id="email" name="email" class="text" value="{$_POST.email}" />
    </p>

    <p class="clear">
        <label for="theme" class="left">Тема</label>
        <input type="text" id="theme" name="theme" class="text" value="{$_POST.theme}" />
    </p>

    <p class="clear">
        <label for="message" class="left">Текст Сообщения</label>
        <textarea cols="45" rows="10" name="message" id="message">{$_POST.message}</textarea>
    </p>
    
    <p class="clear">
        <label for="captcha" class="left">{lang('lang_captcha')}</label>
        <input type="text" name="captcha" id="captcha" />
        
        <br />

        <label class="left">&nbsp;</label>
        {$cap_image}
    </p>
    
    <p class="submit"><label>&nbsp;</label><input type="submit" value="{lang('lang_submit')}" /></p>

    {form_csrf()}
</form>
