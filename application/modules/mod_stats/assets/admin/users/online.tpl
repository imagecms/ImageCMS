<div id="user_information">
    {if count($data) > 0}
        <table class="table table-striped table-bordered table-condensed content_big_td">
            <thead>
                <tr>
                    <th>Пользователь</th>
                    <th>Email</th>
                    <th>Последняя страница</th>
                    <th>Время</th>
                </tr>
            </thead>
            <tbody>
                {foreach $data as $row}
                    <tr>
                        <td>{$row.username}</td>
                        <td>{$row.email}</td>
                        <td>{$row.url}</td>
                        <td>{$row.time_add}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else:}
        <p class="mod_stats_no_online">{lang('No online users','admin')}</p>
    {/if}
</div>