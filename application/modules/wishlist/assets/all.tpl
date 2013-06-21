<article class="container">
    {if $lists}
        <table  class="table" style="width:600px">
            {foreach $lists as $list}  
                <tr>
                    <td>
                        <div>
                            <h2>Информация про пользователя</h2>
                            <div>
                                <b>Имя: <a href="{site_url('/wishlist/user/'. $list['user']['id'])}">{$list['user']['user_name']}</a></b>
                            </div>
                            </br>                    
                            <div><img src="{site_url($list['user']['user_image'])}" alt='Ава' width="100"  height="100"/></div>
                            </br>
                            <div>Дата рождения: {$list['user']['user_birthday']}</div>
                            <div>Описание: {$list['user']['description']}</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h2>Списки пользователя</h2>
                            <ul>
                                {foreach $list['lists'] as $listItem}
                                    <li>
                                        <a href="{site_url('/wishlist/show/' . $list['user']['id'] . '/' . $listItem['id'])}">{$listItem['title']}</a>                                    
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    </td>
                </tr>   
            {/foreach}
        </table>
        {else:}
            Списков нет!!
    {/if}
</article>