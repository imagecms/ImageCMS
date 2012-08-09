{$inCart = ShopCore::app()->SCart->getData()}
{if $inCart}
<div class="fancy wish_list">
    <form method="post" action="{shop_url('cart')}" >
        <h1 class="m-l_19">Корзина</h1>
        <table class="cleaner_table"  cellspacing="0">
            <colgroup>
                <col span="1" width="140">
                <col span="1" width="365">
                <col span="1" width="130">
                <col span="1" width="160">
                <col span="1" width="138">
                <col span="1" width="28">
            </colgroup>
            <tbody>
                {foreach $inCart as $key => $catr}
                {$prod = getProduct($catr.productId)}
                {$variants = $prod->getProductVariants()}
                {foreach $variants as $v}
                    {if $v->getId() == $catr.variantId}
                        {$variant = $v}
                    {/if}
                {/foreach}
                <tr>
                    <td>
                        <a href="{shop_url('product/'.$prod->getId())}" class="photo_block">
                            <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($prod->getMainModimage())}{/if}" alt="{echo ShopCore::encode($prod->name)}{if count($variants)>1} - {echo ShopCore::encode($variant->name)} {/if}"/>
                        </a>
                    </td>
                    <td>
                        <a href="{shop_url('product/'.$prod->getId())}">{echo ShopCore::encode($prod->name)}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                    </td>
                    <td>
                        <div class="price f-s_16 f_l">{echo $variant->getPrice()} <sub>{$CS}</sub>
                            <!--<span class="d_b">{echo $prod->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>-->
                        </div>
                    </td>
                    <td>
                        <div class="count f_l">
                            <input type="text" name="products[{$key}]" value="{echo $catr.quantity}"/>                            
                            <span class="plus_minus">
                                <button class="count_up">&#9650;</button>
                                <button class="count_down">&#9660;</button>
                            </span>
                        </div>
<!--                        <div class="buttons button_gs">
                            <input type="submit" value="Добавить в корзину">
                        </div>-->
                    </td>
                    <td>
                        <div class="price f-s_18 f_l">
                            {$summary = $variant->getPrice() * $catr.quantity}
                            {echo $summary}
                            <sub>{$CS}</sub>
                            <!--<span class="d_b">{echo $summary_nextc = $prod->firstVariant->toCurrency('Price', $NextCSId) * $catr.quantity} {$NextCS}</span>-->
                        </div>
                    </td>
                    <td>
                        <a href="{shop_url('cart/delete/'.$key)}" class="delete_text">&times;</a>
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
                            <div class="f_r buttons button_big_blue">
                                <a href="{shop_url('cart')}">Оформить заказ</a>
                            </div>
                            <div class="f_r">
                                {if $NextCS == $CS}
                                    <div class="price f-s_26_lh_50 f_l">{$total} <sub>{$CS}</sub>
                                {else:}
                                    <div class="price f-s_26 f_l">{$total} <sub>{$CS}</sub>
                                {/if}
                                    <!--<span class="d_b">{echo $total_nc} {$NextCS}</span>-->
                                </div>
                            </div>
                            <div class="sum f_r">
                                Сумма:
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        {form_csrf();}        
    </form>
</div>
{else:}
{literal}
    {"close":"true","msg": "<div class='fancy wish_list'><h1>Корзина</h1><div class='comparison_slider'><div class='f-s_18 m-t_29 t-a_c'>Корзина пуста</div></div></div>"}
{/literal}
{/if}