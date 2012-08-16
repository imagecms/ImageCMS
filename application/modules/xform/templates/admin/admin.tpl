<div class="top-navigation">
    <ul style="float:left;">
        <li><p>xForm - Конструктор форм для ImageCMS</p></li>
    </ul>
    <div align="right" style="float:right;padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Создать Форму" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/create_form'); return false;" />
    </div>
</div>

<div style="clear:both"></div> 
{if $forms}
<div id="sortable" >
		  <table id="cats_table">
		  	<thead>
				<th width="5px;">ID</th>
                <th axis="string">Имя</th>
                <th axis="string">URL</th>
                <th axis="string">Тема</th>
                <th axis="string">E-mail</th>
                <th></th>
			</thead>
			<tbody>
		{foreach $forms as $form}
		<tr>
            <td>{$form.id}</td>
            <td><a href="{site_url('xform/show')}/{$form.url}" target="_blank"  title="Посмотреть на сайте">{$form.title}</a></td>
            <td>{$form.url}</td>
            <td>{$form.subject}</td>
            <td>{$form.email}</td>
            <td align="right">
                <img src="{$THEME}/images/edit.png"  onclick="ajax_div('page', base_url + 'admin/components/cp/xform/fields/{$form.id}');" style="cursor:pointer;" title="Редактировать поля" />
                <img src="{$THEME}/images/preferences.png"  onclick="ajax_div('page', base_url + 'admin/components/cp/xform/edit_form/{$form.id}');" style="cursor:pointer;" title="Изменить настройки формы" />
                <img src="{$THEME}/images/delete.png"  onclick="confirm_delete_gcategory({$form.id});" style="cursor:pointer;" title="Удалить форму" />
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
				</tr>
			</tfoot>
		  </table>
</div>

{literal}
    	<script type="text/javascript">
			window.addEvent('domready', function(){
				cats_table = new sortableTable('cats_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                cats_table.altRow();
			});

            function confirm_delete_gcategory(id)
            {
                alertBox.confirm('<h1> </h1><p>Удалить форму ID - ' + id + '? </p>', {onComplete:
                function(returnvalue){
                if(returnvalue)
                {
                        var req = new Request.HTML({
                           method: 'post',
                           url: base_url + 'admin/components/cp/xform/delete_form',
                           onRequest: function() { },
                           onComplete: function(response) {  
                                ajax_div('page', base_url + 'admin/components/cp/xform/');   
                            }
                        }).post({'id': id });
                }
                }
                });
            }

        </script>
{/literal}

{/if}
