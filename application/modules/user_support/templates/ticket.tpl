<h3>Тема билета: {$ticket.theme}</h3>

<?php
    $ci = get_instance();
    $ci->load->helper('typography');
?>


    <fieldset class="fieldset">
        <table cellspacing="1" cellpadding="4" border="0" width="100%">
          <tbody><tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Номер билета:</span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{$ticket.id}</span></td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Отдел: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{$department.name}</span></td>
          </tr>
          <tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Статус: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">
                <font color="{get_status_color($ticket.status)}">{$status}</font></span> 
                {if $ticket.status != 1}<a href="{site_url('user_support/close_ticket/' . $ticket.id)}" id="" >Закрыть</a> {/if}
            </td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Степень важности: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext"><font color="{get_priority_color($ticket.priority)}">{$priority}</font></span></td>
          </tr>
          <tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Создан: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{date('l, d F H:i', $ticket.date)}</span></td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">Обновлен: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{date('l, d F H:i', $ticket.updated)}</span></td>
          </tr>
          </tbody></table>
    </fieldset>

    <br/>

    <h3>Описание</h3>
    <p>
    {nl2br_except_pre($ticket.text)}
    </p>

    <p>
        <a href="javascript:history.back(-1);">← Назад</a>
    </p>

    <br/>
    {if $ticket.comments}
    <h3>Корреспонденция</h3>
 
    {foreach $ticket.comments as $c}
    <div class="ticket_comment">

    <div class="ticket_comment_info{$c.user_status}">
        <div class="ticket_comment_author">{$c.user_name}</div>    
        <div class="ticket_comment_date" align="right">Добавлено: {date('l, d F H:i', $c.date)}</div>
    </div>

        <div class="ticket_comment_text" style="clear:both;">
	{nl2br_except_pre($c.text)}
	</div>
    </div>
    {/foreach}
    {/if}

<p>
<br/>
<h3>Оставить сообщение</h3>

{if function_exists('validation_errors') AND validation_errors()}
<div class="errors">
<p class="error_header">Были обнаружены следующие ошибки:</p>
       <div class="errors_list">{validation_errors()}</div>
</div>
{/if}

    <form action="{site_url('user_support/add_comment/' . $ticket.id)}" method="POST">
    {form_csrf()}
        <div class="form"> 
        <p>
            <textarea rows="10" cols="45" class="textarea" name="text"></textarea>
            <br />
            <br />
            <button type="submit" class="button">Отослать</button> 
        </p>
        </div>
    </form>
</p>

