<article class="container">
    {if count($products)>0}
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>{lang('Unsubscribe', 'pricespy')}</th>
                    <th>{lang('Product', 'pricespy')}</th>
                    <th>{lang('New price', 'pricespy')}</th>
                    <th>{lang('Old price', 'pricespy')}</th>
                    <th>{lang('Percentage of price reduction', 'pricespy')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $products as $key => $product}

                    <tr id='{$product[hash]}'>
                        <td>{echo $key+1}</td>
                        <td>
                            <input type="submit" 
                                   class="btn" 
                                   value="{lang('Unsubscribe', 'pricespy')}"
                                   onclick="unspy('{$product[hash]}')"/>
                        </td>
                        <td>
                            <a href="{shop_url('product/' . $product[url])}" 
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
        {lang('Watch list is empty', 'pricespy')}
    {/if}
</article>