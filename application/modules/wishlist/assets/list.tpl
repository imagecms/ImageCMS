<article class="container">
    {if $wishlist != 'empty'}
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
                <tr>
                    <th>№</th>
                    <th>{lang('Unsubscribe', 'wishlist')}</th>
                    <th>{lang('Product', 'wishlist')}</th>
                    <th>{lang('Comment', 'wishlist')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $wishlist as $key => $w}
                    <tr>
                        <td>{echo $key+1}</td>
                        <td>
                            <a href="/wishlist/wishlistFront/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang('delete', 'wishlist')}</a>
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
            </tbody>
        </table>
    {else:}
        {lang('Emty list', 'wishlist')}
    {/if}
</article>