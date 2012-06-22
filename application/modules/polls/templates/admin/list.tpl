{if $polls->num_rows()==0}
    <div id="notice" style="width:500px;">Список голосований пустой.
    <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/polls/create'); return false;">Создать.</a>
    </div>
    {return}
{/if}

<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Список голосований</p>
            </li>
            </ul>
        </div>

        <div align="right" style="padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Создать" onclick="ajax_div('page', base_url + 'admin/components/cp/polls/create'); return fa;se;" />
        </div>
</div>
<div style="clear:both;"></div>

<div style="clear:both"></div>

<div id="sortable" >
		  <table id="pages_table">
		  	<thead>
                <th width="5px">ID</th>
				<th>Название</th>
				<th width="24px;"></th>
			</thead>
			<tbody>
		{foreach $polls->result_array() as $poll}
		<tr>
            <td>{$poll.id}</td>
            <td onclick="ajax_div('page', base_url + 'admin/components/cp/polls/edit/{$poll.id}');">
                {encode($poll.name)}
            </td>
            <td>
			<img onclick="confirm_delete_poll({$poll.id});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
			</td>
		</tr>
		{/foreach}
			</tbody>
			<tfoot>
				<tr>
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
				pages_table = new sortableTable('pages_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                pages_table.altRow();
			});

        function confirm_delete_poll(id)
        {
            alertBox.confirm('<h1> </h1><p>Удалить голосование ID '+ id +' ? </p>', {onComplete:
            function(returnvalue) {
                if(returnvalue)
                {
                            var req = new Request.HTML({
                            method: 'post',
                            update: 'page',
                            url: base_url + 'admin/components/cp/polls/delete/' + id,
                            onComplete: function(response) { }
                        }).post();
                }
            }
        });
        }
		</script>
{/literal}
