<article class="container">
    {if $lists}
        <table  class="table" style="width:600px">
            {foreach $lists as $list}
                <tr>
                    <td>
                        <div>
                            <h2>Информация о пользователе</h2>
                            <div>
                                <b>Имя: <a href="{site_url('/wishlist/user/'. $list['user']['id'])}">{$list['user']['user_name']}</a></b>
                            </div>
                            </br>
                            <div>
                                <img src="{site_url('./uploads/mod_wishlist/'.$list['user']['user_image'])}" alt='Ава' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
                            </div>
                            </br>
                            <div>Дата рождения: {date('Y-m-d', $list['user']['user_birthday'])}</div>
                            <div>Описание: {$list['user']['description']}</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h2>Списки пользователя</h2>
                            <ul>
                                {foreach $list['lists'] as $listItem}
                                    <li>
                                        <a href="{site_url('/wishlist/show/' . $listItem['hash'])}">{$listItem['title']}</a>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    </td>
                </tr>
            {/foreach}
        </table>
    {else:}
        {foreach (array)$errors as $error}
            {echo $error}
        {/foreach}
    {/if}
</article>