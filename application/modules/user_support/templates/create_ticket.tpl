{if validation_errors()}
    <div class="errors">
    <p class="error_header">Были обнаружены следующие ошибки:</p>
           <div class="errors_list">{validation_errors()}</div>
    </div>
{/if}

<h3>Создать билет</h3>
<div class="button_middle_blue buttons t-a_c">
    <a href="{site_url('user_support/my_tickets')}">Все мои билеты</a>
</div>
    
<div class="button_middle_blue buttons t-a_c"><a href="{site_url('user_support')}">Главный раздел</a></div>

<div class="well">
<h4>
Заполните формуляр, опишите Вашу проблему как можно подробнее и отошлите Ваш запрос нашим консультантам. 
</h4>
<br/>
<form action="{site_url('user_support/create_ticket')}" method="POST">
{form_csrf()}

    <div class="textbox">
        <label for="department" class="left">Отдел</label><br/>
            <select name="department" id="department">
            {foreach $departments as $d}
                <option value="{$d.id}">{$d.name}</option>
            {/foreach}
            </select>
    </div>
<br/>            
    <div class="textbox">
        <label for="priority" class="left">Степень важности</label><br/>
            <select name="priority" id="priority">
            {foreach $priorities as $k => $v}
                <option value="{$k}">{$v}</option>
            {/foreach}
            </select>
    </div>
<br/>
    <div class="textbox">
        <label for="ticket_theme" class="left">Тема</label><br/>
            <input class="textbox" type="text" name="theme" id="ticket_theme" value="" />
    </div>
<br/>
    <div class="textbox">
        <label for="ticket_text" class="left">Описание</label><br/>
        <textarea cols="45" rows="10" class="textarea" name="text" id="ticket_text"></textarea>
    </div>
<br/>
    <p class="clear">
        <label for="" class="left"></label><br/>
        <button type="submit" class="submit">Отослать</button> 
			<a href="{site_url('user_support')}"> Отмена</a> 

    </p>
</form>
</p>
</div>