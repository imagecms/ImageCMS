<div id="sortable">
    <table id="users_table2">
        <thead>
        <th axis="string" width="">{lang('ID', 'user_manager')}</th>
        <th axis="string">{lang('Login', 'user_manager')}</th>
        <th axis="string">{lang('E-Mail', 'user_manager')}</th>
        <th axis="string">{lang('Group', 'user_manager')}</th>
        <th axis="string">{lang('Ban', 'user_manager')}</th>
        <th axis="string">{lang('Last IP', 'user_manager')}</th>
        <th axis="date">{lang('Latest Entry or Last Entry', 'user_manager')}</th>
        <th axis="date">{lang('Created', 'user_manager')}</th>
        <th axis="none"></th>
        </thead>
        <tbody>
            {if $users}
                {foreach $users as $user}
                    <tr id="{$page.number}">
                        <td class="rightAlign">
                            <div align="left">{$user.id}</div>
                        </td>
                        <td>{$user.username}</td>
                        <td>{$user.email}</td>
                        <td>{$user.role_alt_name}</td>
                        <td>{$user.banned}</td>
                        <td>{$user.last_ip}</td>
                        <td>{$user.last_login}</td>
                        <td>{$user.created}</td>
                        <td  class="rightAlign">
                            <img onclick="edit_user({$user.id});" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="{lang('Edit', 'user_manager')}" />
                        </td>
                    </tr>
                {/foreach}
            {/if}
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

{$pagination}

<p></p>

<!--
<div class="options_bar">
    <form id="tableFilter2" style="width:100%;" onsubmit="users_table2.filter(this.id); return false;">Фильтр:
        <select id="column">
            <option value="1">Логин</option>
            <option value="2">E-Mail</option>
            <option value="3">Группа</option>
        </select>
        <input type="text" id="keyword" />
        <input type="submit" value="Поиск" />
        <input type="reset" value="Очистить" />
{form_csrf()}</form>
</div>
-->

{literal}
    <script type="text/javascript">
        window.addEvent('domready', function(){
        users_table2 = new sortableTable('users_table2', {overCls: 'over', onClick: function(){}});
        });
    </script>
{/literal}
