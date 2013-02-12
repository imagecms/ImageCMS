{if count($items)}
<caption>Корзина</caption>
<colgroup>
    <col span="1" width="120">
    <col span="1" width="396">
    <col span="1" width="160">
    <col span="1" width="140">
    <col span="1" width="160">
    <col span="1" width="25">
</colgroup>
<tbody>
    {foreach $items as $key=>$item}
    {$variants = $item.model->getProductVariants()}
                {foreach $variants as $v}
                    {if $v->getId() == $item.variantId}
                        {$variant = $v}
                    {/if}
                {/foreach}
                {$vprices = currency_convert($variant->getPrice(), $variant->getCurrency())}
    <tr>
        <td>
            <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($item.model->getMainModimage())}{/if}" alt="{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
            </a>
        </td>
        <td>
            <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
        </td>
        <td>
            <div class="price f-s_16 f_l">{echo $vprices.main.price} <sub>{$vprices.main.symbol}</sub>
                <!--<span class="d_b">{echo $item.model->firstVariant->toCurrency('Price', 1)} $</span>-->
                </div>
        </td>
        <td>
            <div class="count">
                <input name="products[{$key}]" type="text" value="{$item.quantity}"/>
                <span class="plus_minus">
                    <button class="count_up inCartProducts">&#9650;</button>
                    <button class="count_down inCartProducts">&#9660;</button>
                </span>
            </div>
        </td>
        <td>
            <div class="price f-s_18 f_l">{$summary = $vprices.main.price * $item.quantity}
                {echo $summary}
                <sub>{$vprices.main.symbol}</sub>
                
                <!--<span class="d_b">{echo $summary_nextc = $item.model->firstVariant->toCurrency('Price', 1) * $item.quantity} $</span>-->
            </div>
        </td>
        <td>
            <a href="{shop_url('cart/delete/'.$key)}" class="delete_text inCartProducts">&times;</a>
        </td>
    </tr>
    {$total     += $summary}
    {$total_nc  += $summary_nextc}
    {/foreach}
</tbody>
<tfoot>
    <tr>
        <td colspan="6">
            <div class="foot_cleaner">
                <div class="f_r">
                        {if $NextCS == $CS}
                            <div class="price f-s_26_lh_50 f_l">
                        {else:}
                            <div class="price f-s_26 f_l">
                        {/if}
                        {if isset($item.delivery_price)}
                                {$dprice =  currency_convert($item.delivery_price, Null)}
                                {$item.delivery_price = $dprice.main.price}
                            {/if}
                        {if $total < $item.delivery_free_from}
                            {$total += $item.delivery_price}
                        {/if}
                        {if isset($item.gift_cert_price)}
                            {$total -= $item.gift_cert_price}
                        {/if}
                        {echo $total}
                        <sub>{$CS}</sub>
                        {if $total < $item.delivery_free_from}<span class="d_b">(+{echo $dprice.main.price} {$dprice.main.symbol})</span>{/if}
                        {if isset($item.gift_cert_price)}<span class="d_b">(-{echo $item.gift_cert_price} руб)</span>{/if}
                        <!--<span class="d_b">{$total_nc} $</span>-->
                        </div>
                </div>
                <div class="f_r sum">Сумма:</div>
            </div>
        </td>
    </tr>
</tfoot>
<input type="hidden" name="forCart" value="1" />
{else:}
    Корзина пуста
{/if}