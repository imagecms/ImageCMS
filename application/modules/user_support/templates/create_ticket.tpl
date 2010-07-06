{if validation_errors()}
    <div class="errors">
    <p class="error_header">Были обнаружены следующие ошибки:</p>
           <div class="errors_list">{validation_errors()}</div>
    </div>
{/if}

<h3>Создать билет</h3>

<p>
<br/>
Заполните формуляр, опишите Вашу проблему как можно подробнее и отошлите Ваш запрос нашим консультантам. 
<br/>
</p>

<form action="{site_url('user_support/create_ticket')}" method="POST">
{form_csrf()}
    <p class="clear">
        <label for="department" class="left">Отдел</label>
            <select name="department" id="department">
            {foreach $departments as $d}
                <option value="{$d.id}">{$d.name}</option>
            {/foreach}
            </select>
    </p>

    <p class="clear">
        <label for="priority" class="left">Степень важности</label>
            <select name="priority" id="priority">
            {foreach $priorities as $k => $v}
                <option value="{$k}">{$v}</option>
            {/foreach}
            </select>
    </p>

    <p class="clear">
        <label for="ticket_theme" class="left">Тема</label>
            <input class="textbox" type="text" name="theme" id="ticket_theme" value="" />
    </p>

    <p class="clear">
        <label for="ticket_text" class="left">Описание</label>
        <textarea cols="45" rows="10" class="textarea" name="text" id="ticket_text"></textarea>
    </p>

    <p class="clear">
        <label for="" class="left"></label>
        <button type="submit" class="button">Отослать</button> 
        <a href="{site_url('user_support')}"> Отмена</a> 
    </p>
</form>
</p>
