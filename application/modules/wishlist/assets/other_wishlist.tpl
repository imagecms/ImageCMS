<article class="container">
    <label>
        <span class="frame_form_field__icsi-css">
            <div class="frameLabel__icsi-css error_text" name="error_text"></div>
        </span>
    </label>

</form>
{if count($wishlists)>0}
    {foreach $wishlists as $key => $wishlist}
        <form method="POST" action="/wishlist/wishlistFront/deleteWL">
            <table class="table">
                <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                <thead>
                    <tr>
                        <td colspan="3">
                            <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                            {echo $wishlist[0][access]}
                            <div class="wishListDescription" >{$wishlist[0][description]}</div>
                        </td>
                    </tr>
                    {if $wishlist[0][variant_id]}
                    <tr>
                        <th>№</th>
                        <th>{lang('Product', 'wishlist')}</th>
                        <th>{lang('Comment', 'wishlist')}</th>
                    </tr>
                    {/if}
                </thead>
                <tbody>
                    {if $wishlist[0][variant_id]}
                    {foreach $wishlist as $key => $w}
                            <tr>
                                <td>{echo $key+1}</td>
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
                            <td>{lang('Emty list', 'wishlist')}</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
            {form_csrf()}
        </form>
    {/foreach}
{else:}
    {lang('Wish list is empty', 'wishlist')}
{/if}
</article>

