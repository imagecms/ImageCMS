<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><input type="button" class="button_silver_130" value="Все билеты" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support'); return false;" /></p>
        </li>
    
        <li>
            <input type="button" class="button_silver_130" value="Департаменты" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support/departments'); return false;" />
        </li>

        </ul>
    </div>

</div>
<div style="clear:both"></div>

{if $tickets}
<div id="sortable" >
		  <table id="tickets_table">
		  	<thead>
                <th width="5px"></th>
				<th axis="number" width="5px;">ID</th>
                <th axis="string">Тема</th>
                <th axis="string">Отдел</th>
                <th axis="string">Посл. комментарий</th>
		        <th axis="string">Автор</th>
                <th axis="string">Статус</th>
                <th axis="string">Приоритет</th>
                <th axis="date">Создан</th>
                <th axis="date">Обновлен</th>
                <th></th>
			</thead>
			<tbody>

		{foreach $tickets as $t}
            <tr id="{$page.number}">
                <td><input type="checkbox" id="chkb_{$t.id}" class="chbx"/></td>
                <td>{$t.id}</td>
                <td title="{$t.theme}">
                    <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support/view_ticket/{$t.id}'); return false;" >{truncate($t.theme, 70, '...')}</a>
                </td>
                <td>{get_department_name($t.department)}</td>
                <td>{$t.last_comment_author}</td>
                <td>{$t.author}</td>
                <td><font color="{get_status_color($t.status)}">{get_status_text($t.status)}</font></td>
                <td><font color="{get_priority_color($t.priority)}">{get_priority_text($t.priority)}</font></td>
                <td>{date('d-m-Y', $t.date)}</td>
                <td>{date('d-m-Y', $t.updated)}</td>
                <td>
                    <img onclick="confirm_ticket_delete({$t.id});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
                </td>
            </tr>
		{/foreach}

			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

<div style="padding-left:15px;padding-top:2px;">
<a href="#" onclick="check_all(); return false;">Отметить все</a>  /  <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a> 
</div>

<p align="right" style="padding:5px;padding-top:10px;">
С отмечеными:
<input type="submit" name="delete"  class="button_silver" style="font-weight:bold;" value="Удалить" onclick="delete_sel_tickets(); return false;" />
</p>
<div align="center" style="padding:5px;" id="pagination">
{$paginator}
</div>

{literal}
    	<script type="text/javascript">
			window.addEvent('domready', function(){
				pages_table = new sortableTable('tickets_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                pages_table.altRow();
			});
        </script>
{/literal}

{/if}

{literal}
<script type="text/javascript">

    function check_all()
    {
        var items = $('tickets_table').getElements('input');
        items.each(function(el,i){
        if(el.hasClass('chbx')) 
        {
            el.checked = true;
        }  
        });
    }

    function uncheck_all()
    {
        var items = $('tickets_table').getElements('input');
        items.each(function(el,i){
        if(el.hasClass('chbx')) 
        {
            el.checked = false;
        }  
        });
    }

    function confirm_ticket_delete(id)
    {
        alertBox.confirm('<h1>Удалить билет ID' + id + '?</h1>', {onComplete:
        function(returnvalue) {
        if(returnvalue)
        {
            var req = new Request.HTML({
                method: 'post',
                url: base_url + 'admin/components/cp/user_support/delete_ticket/',
                evalResponse: true,
                onComplete: function(response) {  
                    ajax_div('page', base_url + 'admin/components/cp/user_support/');                            
                }
            }).post({'id': id});
        }
        else
        {

        }
        }
    });
    }

    function delete_sel_tickets()
    {
    alertBox.confirm('<h1> </h1><p>Удалить отмеченые билеты? </p>', {onComplete:
    function(returnvalue){
    if(returnvalue)
    {
        var tickets = new Array();     

        var items = $('tickets_table').getElements('input');
        items.each(function(el,i){
                if(el.checked == true) 
                {
                    id = el.id;
                    val = el.value;
                    el_info = id;
                    tickets.include( el_info );
                }  
                });

        var req = new Request.HTML({
           method: 'post',
           url: base_url + 'admin/components/cp/user_support/delete_tickets',
           onRequest: function() { },
           onComplete: function(response) {  
                ajax_div('page', base_url + 'admin/components/cp/user_support');   
            }
        }).post({'tickets': tickets });
    }
    }
    });
    }

</script>
{/literal}
