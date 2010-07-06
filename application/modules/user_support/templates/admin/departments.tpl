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

    <div align="right" style="float:right;">
        <ul>
    
        <li>
            <p><input type="button" class="button_green_130" value="Создать департамент" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support/create_department'); return false;" /></p>
        </li>

        </ul>
    </div>

</div>
<div style="clear:both"></div>

{if $departments}
<div id="sortable" >
		  <table id="departments_table">
		  	<thead>
                <!--<th width="5px"></th>-->
				<th axis="number" width="5px;">ID</th>
                <th axis="string">Название</th>
                <th style="width:32px;"></th>
			</thead>
			<tbody>

		{foreach $departments as $d}
            <tr>
                <!--<td><input type="checkbox" id="chkb_{$d.id}" class="chbx"/></td>-->
                <td>{$d.id}</td>
                <td>
                    <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support/edit_department/{$d.id}'); return false;" >{truncate($d.name, 70, '...')}</a>
                </td>
                <td>
                    <img onclick="confirm_department_delete({$d.id});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
                </td>

            </tr>
		{/foreach}

			</tbody>
			<tfoot>
				<tr>
					<!--<td></td>-->
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

<!--
<div style="padding-left:15px;padding-top:2px;">
<a href="#" onclick="check_all(); return false;">Отметить все</a>  /  <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a> 
</div>

<p align="right" style="padding:5px;padding-top:10px;">
С отмечеными:
<input type="submit" name="delete"  class="button_silver" style="font-weight:bold;" value="Удалить" onclick="delete_sel_tickets(); return false;" />
</p>
-->

<div align="center" style="padding:5px;" id="pagination">
{$paginator}
</div>

{literal}
    <script type="text/javascript">
        window.addEvent('domready', function(){
            d_table = new sortableTable('departments_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
            d_table.altRow();
        });
    </script>
{/literal}

{/if}

{literal}
<script type="text/javascript">

function confirm_department_delete(id)
{
    alertBox.confirm('<h1>Удалить департамент ID ' + id + '?</h1>', {onComplete:
        function(returnvalue) {
        if(returnvalue)
        {
            var req = new Request.HTML({
                method: 'post',
                url: base_url + 'admin/components/cp/user_support/delete_department/',
                evalResponse: true,
                onComplete: function(response) {  
                    ajax_div('page', base_url + 'admin/components/cp/user_support/departments');                     
                }
            }).post({'id': id});
        }
        else
        {

        }
        }
    });
}

    function check_all()
    {
        var items = $('departments_table').getElements('input');
        items.each(function(el,i){
        if(el.hasClass('chbx')) 
        {
            el.checked = true;
        }  
        });
    }

    function uncheck_all()
    {
        var items = $('departments_table').getElements('input');
        items.each(function(el,i){
        if(el.hasClass('chbx')) 
        {
            el.checked = false;
        }  
        });
    }

</script>
{/literal}
