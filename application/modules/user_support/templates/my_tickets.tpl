{literal}
<style type="text/css">

#box-table-a {
border-collapse:collapse;
font-family:"Lucida Sans Unicode","Lucida Grande",Sans-Serif;
font-size:11px;
text-align:left;
width:100%;
}

#box-table-a th {
-moz-background-clip:border;
-moz-background-inline-policy:continuous;
-moz-background-origin:padding;
background:#B9C9FE none repeat scroll 0 0;
border-bottom:1px solid #FFFFFF;
border-top:4px solid #AABCFE;
color:#003399;
font-size:13px;
font-weight:normal;
padding:8px;
}

#box-table-a td {
-moz-background-clip:border;
-moz-background-inline-policy:continuous;
-moz-background-origin:padding;
background:#E8EDFF none repeat scroll 0 0;
border-bottom:1px solid #FFFFFF;
border-top:1px solid transparent;
color:#666699;
padding:8px;
}

#box-table-a tr:hover td {
-moz-background-clip:border;
-moz-background-inline-policy:continuous;
-moz-background-origin:padding;
background:#D0DAFD none repeat scroll 0 0;
color:#333399;
}

</style>
{/literal}

{if $tickets}
<h3>Мои билеты</h3>
<p>
    <a href="{site_url('user_support/create_ticket')}">Создать билет</a> | <a href="{site_url('user_support')}">Главный раздел</a>
</p>

<table id="box-table-a">

<thead>
    <tr>
        <th scope="col">Тема</th>
        <th scope="col">Отдел</th>
        <th scope="col">Посл. Сообщение</th>
        <th scope="col">Статус</th>
        <th scope="col">Приоритет</th>
        <th scope="col">Обновлен</th>
    </tr>
</thead>

<tbody>

{foreach $tickets as $t}
<tr>
    <td><a href="{site_url('user_support/ticket/' . $t.id)}" title="{$t.theme}">{truncate($t.theme, 18)}</a></td>
    <td>{get_department_name($t.department)}</td>
    <td>{$t.last_comment_author}</td>
    <td>
        <font color="{get_status_color($t.status)}">{get_status_text($t.status)}</font>
    </td>
    <td>
        <font color="{get_priority_color($t.priority)}">{get_priority_text($t.priority)}</font>
    </td>
    <td>{date('d-m-Y', $t.updated)}</td>
</tr>
{/foreach}
</tbody>
</table>

<p align="right">
    <a href="{site_url('user_support/my_tickets')}">Все билеты</a>
</p>
{else:}
<p>
    <a href="{site_url('user_support/create_ticket')}">Создать билет</a> | <a href="{site_url('user_support')}">Главный раздел</a>
</p>
{/if}
