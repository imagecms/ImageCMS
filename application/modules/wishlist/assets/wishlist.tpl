<article class="container">
    {if count($wishlists)>0}
        {foreach $wishlists as $key => $wishlist}
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="3">
                            <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                            <div class="wishListDescription" >{$wishlist[0][description]}</div>
                            <input type="submit"
                                   class="btn"
                                   value="удалить"
                                   onclick="delWL(this)"/>
                            <input type="submit"
                                   class="btn"
                                   value="изменить"
                                   onclick="editWL(this)"/>
                        </td>
                    </tr>
                    <tr>
                        <th>№</th>
                        <th>Отписатся</th>
                        <th>Товар</th>
                        <th>Коментар</th>
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
                           <td>
                               {$w[comment]}
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

