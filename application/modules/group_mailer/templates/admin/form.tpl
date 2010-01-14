<div class="top-navigation">
    <ul>
        <li><p>Отправка писем пользователям.</p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/components/cp/group_mailer/send_email" method="post" id="send_mail_form" style="width:100%;">

<div class="form_text">Тема:</div>
<div class="form_input">
    <input type="text" name="subject" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">Ваше Имя:</div>
<div class="form_input">
    <input type="text" name="name" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">Ваш Email:</div>
<div class="form_input">
    <input type="text" name="email" value="{$admin_mail}" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">Сообщение:</div>
<div class="form_input">
    <textarea name="message" rows="15" cols="180"  style="width:700px;height:350px;">Здравствуйте, %username%.






--------------------------------
С уважением,
Администрация {$site_settings.site_title}

{site_url()}

</textarea> 
</div>
<div class="form_overflow"></div>

<div class="form_text">Отправить группам:</div>
<div class="form_input">
    {foreach $roles as $role}
        <label><input type="checkbox" name="roles[]" value="{$role.id}" /> {$role.alt_name}</label>
    {/foreach}
</div>
<div class="form_overflow"></div>

<div class="form_text">Форматирование:</div>
<div class="form_input">
    <select name="mailtype">
        <option value="html" selected="selected">HTML</option>
        <option value="text">Plain Text</option>
    </select>
</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="Отправить" onclick="ajax_me('send_mail_form');" />
</div>

</form>
