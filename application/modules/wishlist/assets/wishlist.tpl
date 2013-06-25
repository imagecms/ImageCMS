<article class="container">
    <!-- ***************************ПРОВЕРКА wishlistApi********************************* -->
        <a href="#" class="APItester">Проверка API</a>
        <textarea class="testAPI" style="font-size: 13px; line-height: 26px; padding: 10px; height: 200px; " ></textarea>
    <!-- ******************************************************************************** -->
    <label>
        <span class="frame_form_field__icsi-css">
            <div class="frameLabel__icsi-css error_text" name="error_text"></div>
        </span>
    </label>
    <div>
        <img src="{site_url('./uploads/mod_wishlist/'.$user['user_image'])}" alt='Ава' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
    </div>
    {form_open_multipart('/wishlist/do_upload')}

        <input type="file" name="userfile" size="20" accept="image/gif, image/jpeg, image/png, image/jpg" />

        <br /><br />

        <input type="submit" value="upload" class="btn" />

    </form>
    <form method="POST" action="/wishlist/userUpdate">
        <input type="hidden" value="{echo $user[id]}" name="user_id"/>
        <input type="text" value="{echo $user[user_name]}" name="user_name"/>
        <input type="date" value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
        <textarea name="description">{echo $user[description]}</textarea>
        <input type="submit" class="btn"/>
        {form_csrf()}
    </form>

    <br /><br />

    <form method="POST" action="/wishlist/createWishList">
        <input type="hidden" value="{echo $user[id]}" name="user_id"/>
        <input type="text" value="" name="wishListName"/>
        <input type="submit" value="Создать новий список" class="btn"/>
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
                                <a href="/wishlist/getUserWishListItemsCount/">редактировать</a>
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
                                        <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">удалить</a>
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

