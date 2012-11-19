{literal}
<style type="text/css">

#box-table-a {
text-align:left;
width:100%;
margin-top: 20px;
}

#box-table-a th {
background:#F2F2F2;
border-bottom:1px solid #FFFFFF;
border-top:4px solid #019FDE;
padding:8px;
}

#box-table-a td {
background:#f8f8f8 none repeat scroll 0 0;
border-bottom:1px solid #FFFFFF;
border-top:1px solid transparent;
color:#666;
padding:8px;
border-radius: 3px;
}

#box-table-a tr:hover td {
background:#fafafa none repeat scroll 0 0;
}

.pagination {
font-size:14px;
text-align:center;
}
.pagination a {
padding:4px;
}
.pagination .active {
font-weight:bold;
margin-left:4px;
padding:2px;
}

</style>
{/literal}

<h3>Мои билеты</h3>
<div class="button_middle_blue buttons t-a_c">
    <a href="{site_url('user_support/create_ticket')}">Создать билет</a>
</div>
<div class="button_middle_blue buttons t-a_c">
    <a href="{site_url('user_support')}">Главный раздел</a>
</div>

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

<p align="center" class="pagination">
    {$pagination}
</p>
