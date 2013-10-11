<article class="container">
    {/*    <!-- ***************************ПРОВЕРКА wishlistApi********************************* -->
    <a href="#" class="APItester">Проверка API</a>
    <textarea class="testAPI" style="font-size: 13px; line-height: 26px; padding: 10px; height: 200px; " ></textarea>
    <!-- ******************************************************************************** -->*/}
    {if $errors}
        {foreach $errors as $error}
            <div class="msg">
               <div class="error">{$error}</div>
            </div>
        {/foreach}
    {/if}
    <div>
        <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}" alt='pic' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
    </div>
    {form_open_multipart('/wishlist/do_upload')}

    <input type="hidden" value="{echo $user[id]}" name="userID"/>
    <input type="file" name="file" size="20" accept="image/gif, image/jpeg, image/png, image/jpg" />

    <br /><br />

    <input type="submit" value="upload" class="btn" />
    {form_csrf()}
</form>
<form method="POST" action="/wishlist/deleteImage">
    <input type="hidden" value="{echo $user[user_image]}" name="image"/>
    <input type="submit" value="{lang('Delete image', 'wishlist')}" class="btn"/>
    {form_csrf()}
</form>

<form method="POST" action="/wishlist/userUpdate">
    <input type="hidden" value="{echo $user[id]}" name="user_id"/>
    <input type="text" value="{echo $user[user_name]}" name="user_name"/>
    <input type="text" id='datepicker' value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
    <textarea name="description">{echo $user[description]}</textarea>
    <input type="submit" class="btn"/>
    {form_csrf()}
</form>

<br /><br />
<form method="POST" action="/wishlist/createWishList">
    <input type="hidden" value="{echo $user[id]}" name="user_id"/>
    {lang('Lists types', 'wishlist')}
    <br>
    <select name="wlTypes">
        <option value="shared">{lang('shared', 'wishlist')}</option>
        <option value="public">{lang('public', 'wishlist')}</option>
        <option value="private">{lang('private', 'wishlist')}</option>
    </select>
    <br>
   {lang('List name', 'wishlist')}
    <input type="text" value="" name="wishListName"/>
    {lang('List description', 'wishlist')}
    <textarea name="wlDescription"></textarea>
    <input type="submit" value="{lang('Create new list', 'wishlist')}" class="btn"/>
    {form_csrf()}
</form>


{if count($wishlists)>0}
    {foreach $wishlists as $key => $wishlist}
        <form method="post" action="/wishlist/deleteItemsByIds" >
            <table class="table">
                <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                <thead>
                    <tr>
                        <td colspan="4">
                            <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                            {lang('List type', 'wishlist')}: <b>{echo $wishlist[0][access]}</b>
                            <div class="wishListDescription" >{$wishlist[0][description]}</div>
                            <a href="/wishlist/deleteWL/{$wishlist[0][wish_list_id]}"class="btn">{lang('delete', 'wishlist')}</a>
                            <a href="/wishlist/editWL/{$wishlist[0][wish_list_id]}"class="btn">{lang('edit', 'wishlist')}</a>
                        </td>
                    </tr>
                    {if $wishlist[0][variant_id]}
                        <tr>
                            <th>Check</th>
                            <th>№</th>
                            <th>{lang('Unsubscribe', 'wishlist')}</th>
                            <th>{lang('Product', 'wishlist')}</th>
                            <th>{lang('Comment', 'wishlist')}</th>
                        </tr>
                    {/if}
                </thead>
                <tbody>
                    {if $wishlist[0][variant_id]}
                        {foreach $wishlist as $key => $w}
                            <tr>
                                <td><input type="checkbox" name="listItem[]" value="{$w['list_product_id']}" /></td>
                                <td>{echo $key+1}</td>
                                <td>
                                    <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}" class="btn">{lang('Delete', 'wishlist')}</a>
                                    <a href="/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}/{echo $user[id]}"class="btn">{lang('Move', 'wishlist')}</a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/'.$w[url])}"
                                       title="{$w[name]}">
                                        <img src="{site_url('uploads/shop/products/medium/'.$w[image])}"/>
                                        <br>
                                        {$w[name]}
                                    </a>
                                </td>
                                <td>
                                    {$w[comment]}
                                </td>
                                {if $w['access'] == 'shared'}
                                    {echo $CI->load->module('share')->_make_share_form(site_url('wishlist/show/'.$w['hash']))}
                                {/if}
                            </tr>
                        {/foreach}
                    {else:}
                        <tr>
                            <td colspan="4">{lang('Emty list', 'wishlist')}</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
            {form_csrf()}
            {if $wishlist[0][variant_id]}
                <input type="submit" class="btn btn-small" value="{lang('Delete', 'wishlist')}">
            {/if}
        </form>
        <hr/>
    {/foreach}
{else:}
    {lang('Wish list is empty', 'wishlist')}
{/if}
</article>

