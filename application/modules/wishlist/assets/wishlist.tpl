<article class="container">
    {if count($wishlists)>0}
        {foreach $wishlists as $key => $wishlist}
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="3">
                            <div>{$wishlist[0][title]}</div>
                            <input type="submit"
                                   class="btn"
                                   value="удалить"
                                   onclick="delWL(this)"/>
                        </td>
                    </tr>
                    <tr>
                        <th>№</th>
                        <th>Отписатся</th>
                        <th>Товар</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $wishlist as $key => $w}
                        <tr>
                            <td>{echo $key+1}</td>
                            <td>
                                <input type="submit"
                                       class="btn"
                                       value="удалить"
                                       onclick="delFromWL(this, '{echo $w[variant_id]}', '{echo $w[wish_list_id]}')"/>
                            </td>
                            <td>
                                <a href="{shop_url('product/'.$w[url])}"
                                   title="{$w[name]}">
                                    {$w[name]}
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {/foreach}
    {else:}
        Список Желания пуст
    {/if}
</article>

