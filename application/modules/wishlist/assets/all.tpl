
{foreach $lists as $list}
    <table style="width:600px">
        <tr>
            <td>
                <div>
                    <h2>Информация про пользователя</h2>
                    <div>{$list['user']['user_image']}</div>
                    <div>{$list['user']['user_birthdate']}</div>
                    <div>{$list['user']['description']}</div>
                </div>
            </td>
            <td>
                <div>
                    <h2>Списки пользователя</h2>
                    <ul>
                        {foreach $list['lists'] as $list}
                            <li>
                                     {$list['title']}
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </td>
        </tr>

    </table>


{/foreach}