<div class="top-navigation">
<ul><li>
    <form id="tableFilter1" style="width:100%;" onsubmit="users_table1.filter(this.id); return false;">{lang('amt_filter')}:
        <select id="column">
            <option value="1">{lang('amt_user_login')}</option>
            <option value="2">{lang('amt_email')}</option>
            <option value="3">{lang('amt_group')}</option>
        </select>
        <input type="text" id="keyword" />
        <input type="submit" value="{lang('amt_search')}" />
        <input type="reset" value="{lang('amt_clean')}" />
    {form_csrf()}</form>
</li></ul>
</div>
<div class="form_overflow"></div>

<form action="{$SELF_URL}/actions/" id="users_f" method="post" style="width:100%">
<div id="sortable">
		  <table id="users_table1" >
		  	<thead>
				<th axis="string" width="">{lang('amt_login')}</th>
				<th axis="string">{lang('amt_user_login')}</th>
				<th axis="string">{lang('amt_email')}</th>
				<th axis="string">{lang('amt_group')}</th>
				<th axis="string">{lang('amt_ban')}</th>
				<th axis="string">{lang('amt_last_ip')}</th>
				<th axis="date">{lang('amt_last_entry')}</th>
				<th axis="date">{lang('amt_cr')}</th>
				<th axis="none"></th>
			</thead>
			<tbody>
                           
		{foreach $users as $user}
		<tr id="{$page.number}">
			<td class="rightAlign">
			<div align="left">
			<input type="checkbox" value="{$user.id}" name="checkbox_{$user.id}" /> {$user.id}
			</div>
			</td>
			<td onclick="edit_user({$user.id}); return false;">{$user.username}</td>
			<td>{$user.email}</td>
			<td>{$user.role_alt_name}</td>
			<td>{$user.banned}</td>
			<td>{$user.last_ip}</td>
			<td>{$user.last_login}</td>
			<td>{$user.created}</td>
			<td  class="rightAlign">
			<img onclick="edit_user({$user.id});" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="{lang('amt_edit')}" />
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
				</tr>
			</tfoot>
		  </table>
</div>

<p align="right">
<br/>
{lang('amt_with_selected')}:
<input type="submit" name="ban"  class="button" value="{lang('amt_to_ban')}" onclick="$('users_f').action='{$SELF_URL}/actions/1/{$cur_page}/'; ajax_form('users_f','users_ajax_table');" />
<input type="submit" name="unban"  class="button" value="{lang('amt_to_unban')}" onclick="$('users_f').action='{$SELF_URL}/actions/2/{$cur_page}/'; ajax_form('users_f','users_ajax_table');" />
<input type="submit" name="delete"  class="button" style="font-weight:bold;" value="{lang('amt_delete')}" onclick="$('users_f').action='{$SELF_URL}/actions/3/{$cur_page}/'; ajax_form('users_f','users_ajax_table');" />
</p>

{form_csrf()}</form>

<div align="center" style="padding:5px;">
{$paginator}
</div>

{literal}
		<script type="text/javascript">
			window.addEvent('domready', function(){
				users_table1 = new sortableTable('users_table1', {overCls: 'over', onClick: function(){}});
			});
		</script>
{/literal}
