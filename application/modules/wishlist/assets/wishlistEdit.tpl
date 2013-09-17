<article class="container">
    <label>
        <span class="frame_form_field__icsi-css">
            <div class="frameLabel__icsi-css error_text" name="error_text"></div>
        </span>
    </label>
    {foreach $wishlists as $key => $wishlist}
        <form method="POST" action="/wishlist/updateWL">
            <table class="table">
                <input type="hidden" name="WLID" value="{echo $wishlist['0']['wish_list_id']}">
                <thead>
                    <tr>
                        <td colspan="3">
                            <input type="text" value="{$wishlist['0']['title']}" name="title"/>
                            <select name="access">
                                <option {if $wishlist['0']['access'] == 'shared'}selected="selected"{/if} value="shared">shared</option>
                                <option {if $wishlist['0']['access'] == 'private'}selected="selected"{/if} value="private">private</option>
                                <option {if $wishlist['0']['access'] == 'public'}selected="selected"{/if} value="public">public</option>
                            </select>
                            <textarea name="description">{$wishlist['0']['description']}</textarea>
                            <a href="/wishlist/deleteWL/{$wishlist['0']['wish_list_id']}"class="btn">{lang('delete', 'wishlist')}</a>
                        </td>
                    </tr>
                    {if $wishlist[0][id] != null}
                        <tr>
                            <th>№</th>
                            <th>{lang('Unsubscribe', 'wishlist')}</th>
                            <th>{lang('Product', 'wishlist')}</th>
                            <th>{lang('Comment', 'wishlist')}</th>
                        </tr>
                    {/if}
                </thead>
                <tbody>
                    {if $wishlist[0][id] != null}
                        {foreach $wishlist as $key => $w}
                            <tr>
                                <td>{echo $key+1}</td>
                                <td>
                                    <a href="/wishlist/deleteItem/{echo $w['variant_id']}/{echo $w['wish_list_id']}"class="btn">{lang('delete', 'wishlist')}</a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/'.$w[url])}"
                                       title="{$w[name]}">
                                        {$w[name]}
                                    </a>
                                </td>
                                <td>
                                    <textarea name="comment[{echo $w[variant_id]}]">{$w[comment]}</textarea>
                                </td>
                            </tr>
                        {/foreach}
                    {/if}
                </tbody>
            </table>
            {form_csrf()}
            <input type="submit" class="btn"/>
        </form>
    {/foreach}
</article>

