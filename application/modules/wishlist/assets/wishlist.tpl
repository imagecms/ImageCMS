<article class="container">
    <label>
        <span class="frame_form_field__icsi-css">
            <div class="frameLabel__icsi-css error_text" name="error_text"></div>
        </span>
    </label>
    {form_open_multipart('/wishlist/do_upload')}

    <input type="file" name="userfile" size="20" />

    <br /><br />

    <input type="submit" value="upload" class="btn" />

</form>

<form method="POST" action="/wishlist/userUpdate">
    <input type="hidden" value="{echo $user[id]}" name="user_id"/>
    <input type="text" value="{echo $user[user_name]}" name="user_name"/>
    <input type="date" value="{echo $user[user_birthday]}" name="user_birthday"/>
    <textarea name="description">{echo $user[description]}</textarea>
    <input type="submit" class="btn"/>
    {form_csrf()}
</form>

{if count($wishlists)>0}
    {foreach $wishlists as $key => $wishlist}
        <form>
            <table class="table">
                <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                <thead>
                    <tr>
                        <td colspan="3">
                            <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                            {echo $wishlist[0][access]}
                            <div class="wishListDescription" >{$wishlist[0][description]}</div>
                            <a href="/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">удалить</a>
                            <a href="/wishlist/editWL/{$wishlist[0][wish_list_id]}">редактировать</a>
                        </td>
                    </tr>
                    {if $wishlist[0][variant_id]}
                    <tr>
                        <th>№</th>
                        <th>Отписатся</th>
                        <th>Товар</th>
                        <th>Коментарий</th>
                    </tr>
                    {/if}
                </thead>
                <tbody>
                    {if $wishlist[0][variant_id]}
                    {foreach $wishlist as $key => $w}
                            <tr>
                                <td>{echo $key+1}</td>
                                <td>
                                    <a href="/wishlist/wishlistFront/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">удалить</a>
                                    <a href="/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}">Переместить</a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/'.$w[url])}"
                                       title="{$w[name]}">
                                        {$w[name]}
                                    </a>
                                </td>
                                <td>
                                    {$w[comment]}
                                </td>
                            </tr>
                    {/foreach}
                    {else:}
                        <tr>
                            <td>Список пуст</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
            {form_csrf()}
        </form>
    {/foreach}
{else:}
    Список Желания пуст
{/if}
</article>

