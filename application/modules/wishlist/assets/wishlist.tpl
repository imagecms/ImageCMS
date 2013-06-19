<article class="container">
    {if count($wishlists)>0}
        {foreach $wishlists as $key => $wishlist}
            <table class="table">
                <thead>
                <div>{$wishlist[0][title]}</div>
                    <tr>
                        <th>№</th>
                        <th>Отписатся</th>
                        <th>Товар</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $wishlist as $key => $w}
                        <tr id='{$w[hash]}'>
                            <td>{echo $key+1}</td>
                            <td>
                                <input type="submit"
                                       class="btn"
                                       value="удалить"
                                       onclick="delFromWL('{$w[hash]}')"/>
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

