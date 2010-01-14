{if $form_errors}
    <div class="errors"> 
        {$form_errors}
    </div>
{/if}

{if $message_sent}
    Ваше сообщение отправлено.
    {return}
{/if}

<form action="{site_url('feedback')}" method="post" class="form">
    <p><label for="name">Ваше Имя</label> <input type="text" id="name" name="name" class="text"/></p>
    <p><label for="e-mail">E-mail</label> <input type="text" id="e-mail" name="email" class="text"/></p>
    <p><label for="theme">Тема</label> <input type="text" id="theme" name="theme" class="text"/></p>
    <p><label for="message">Текст Сообщения</label>  <textarea cols="45" rows="10" name="message" id="message"></textarea></p>
    <p>
        <label for="message">{$cap_image}</label>
        <input type="text" id="e-mail" name="captcha" class="text"/><br />
        <span class="help_text">Укажите код протекции</span>
    </p>

    <p class="submit"><label>&nbsp;</label><input type="submit" value="{lang('lang_submit')}" /></p>

    {form_csrf()}
</form>
