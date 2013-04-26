<article class="container">
    {if count($products)>0}
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Отписатся</th>
                    <th>Товар</th>
                    <th>Новая цена</th>
                    <th>Старая цена</th>
                    <th>Процент снижения цены</th>
                </tr>
            </thead>
            <tbody>
                {foreach $products as $key => $product}

                    <tr id='{$product[hash]}'>
                        <td>{echo $key+1}</td>
                        <td>
                            <input type="submit" 
                                   class="btn" 
                                   value="Отписаться"
                                   onclick="unspy('{$product[hash]}')"/>
                        </td>
                        <td>
                            <a href="{shop_url($product[url])}" 
                               title="{$product[name]}">
                                {$product[name]}
                            </a>
                        </td>
                        <td>{echo round($product[productPrice], ShopCore::app()->SSettings->pricePrecision)}</td>
                        <td>{echo round($product[oldProductPrice], ShopCore::app()->SSettings->pricePrecision)}</td>
                        <td>{echo round(($product[productPrice]-$product[oldProductPrice])*100/$product[oldProductPrice], 2)} %</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else:}
        Список слежения пуст
    {/if}
</article>