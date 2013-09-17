<article class="container">
    {if $lists}
        <table  class="table" style="width:600px">
            {foreach $lists as $list}
                {if $list['lists']}
                <tr>
                    <td>
                        <div>
                            <h2>{lang('User Information', 'wishlist')}</h2>
                            <div>
                                <b>{lang('Name', 'wishlist')}: <a href="{site_url('/wishlist/user/'. $list['user']['id'])}">{$list['user']['user_name']}</a></b>
                            </div>
                            </br>
                            <div>
                                <img src="{site_url('./uploads/mod_wishlist/'.$list['user']['user_image'])}" alt='{lang('Ava', 'wishlist')}' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
                            </div>
                            </br>
                            <div>{lang('Birthday', 'wishlist')}: {date('Y-m-d', $list['user']['user_birthday'])}</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h2>{lang('User lists', 'wishlist')}</h2>
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
                {/if}
            {/foreach}
        </table>
    {else:}
        {foreach (array)$errors as $error}
            {echo $error}
        {/foreach}
    {/if}
</article>