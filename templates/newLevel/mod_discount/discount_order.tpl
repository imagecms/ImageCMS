{//var_dump($discount->all_active_discount->comulativ)}
{$kitDisc = $CI->load->module('shop/cart_api')->get_kit_discount()}

{if $discount->sum_discount_product > $discount->sum_discount_no_product}
    <li>
        <span class="s-t">Тип скидки:</span>
        <span class="price-item">продуктовая</span>
    </li>
    <li>
        <span class="s-t">Сумма скидки:</span>
        <span class="price-item">
            <span>
                <span class="price">{echo $discount->result_sum_discount_convert+$kitDisc}</span>
                <span class="curr">{$CS}</span>
            </span>
        </span>
    </li>
{else:}
{if $discount->max_discount->type_value == 1} {$type_value = "%"} {else:}{$type_value = "числовый"}{/if}
<li>
    <span class="s-t">Назва скидки:</span>
    <span class="price-item">{echo $discount->max_discount->name}</span>
</li>
<li>
    <span class="s-t">Ключ скидки:</span>
    <span class="price-item">{echo $discount->max_discount->key}</span>
</li>
<li>
    <span class="s-t">Тип скидки:</span>
    <span class="price-item">{echo $discount->max_discount->type_discount}</span>
</li>
<li>
    <span class="s-t">Тип начисления скидки:</span>
    <span class="price-item">{echo $type_value}</span>
</li>
<li>
    <span class="s-t">Размер скидки:</span>
    <span class="price-item">{echo $discount->max_discount->value}</span>
</li>
<li>
    <span class="s-t">Сумма скидки:</span>
    <span class="price-item">{echo $discount->result_sum_discount_convert + $kitDisc}</span>
</li>
{/if}